<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Dealer;
use App\Models\Message;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Messages inbox: one row per other dealer.
     */
    public function index(Request $request)
    {
        $currentDealer = $this->currentDealer();

        $this->updateLastSeen($currentDealer);

        $conversations = Conversation::query()
            ->forDealer($currentDealer->id)
            ->with([
                'buyer.user',
                'dealer.user',
                'latestMessage.sender.user',
                'mentionedVehicles',
            ])
            ->withCount([
                'messages as unread_count' => function ($query) use ($currentDealer) {
                    $query
                        ->where('sender_id', '!=', $currentDealer->id)
                        ->whereNull('read_at')
                        ->whereNull('deleted_at');
                },
            ])
            ->orderByDesc('updated_at')
            ->get()
            ->unique(function (Conversation $conversation) {
                return $conversation->pair_key
                    ?: Conversation::pairKey(
                        (int) $conversation->buyer_id,
                        (int) $conversation->dealer_id
                    );
            })
            ->values();

        return view('communication.index', [
            'dealer' => $currentDealer,
            'conversations' => $conversations,
            'search' => trim((string) $request->query('q', '')),
        ]);
    }

    /**
     * Open (or create) the one conversation with this vehicle's dealer.
     */
    public function start(Request $request, Vehicle $vehicle)
    {
        if ($vehicle->status !== 'active') {
            abort(404);
        }

        $vehicle->load('dealer.user');

        if (! $vehicle->dealer) {
            abort(404);
        }

        $currentDealer = $this->currentDealer();

        if ((int) $vehicle->dealer->user_id === (int) auth()->id()) {
            return redirect()->route('vehicles.show', $vehicle);
        }

        $conversation = Conversation::findOrCreateBetween(
            (int) $currentDealer->id,
            (int) $vehicle->dealer_id
        );

        $this->updateLastSeen($currentDealer);

        return redirect()->route('messages.show', [
            'conversation' => $conversation,
            'vehicle' => $vehicle->id,
        ]);
    }

    /**
     * Show one dealer-to-dealer conversation.
     */
    public function show(Request $request, Conversation $conversation)
    {
        $currentDealer = $this->currentDealer();

        $this->authorizeConversation($conversation, $currentDealer);

        $this->updateLastSeen($currentDealer);

        $conversation->load([
            'buyer.user',
            'dealer.user',
            'messages.sender.user',
            'messages.vehicle.media',
        ]);

        $conversation->messages()
            ->where('sender_id', '!=', $currentDealer->id)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        $otherDealer = $conversation->otherDealer($currentDealer);

        $onlineStatusVisible =
            (bool) ($currentDealer->user?->show_online_status ?? true);

        $otherIsOnline = false;
        $otherLastSeen = null;

        if ($onlineStatusVisible && $otherDealer?->user) {
            $otherLastSeen = $otherDealer->user->last_seen_at;

            $otherIsOnline = $otherLastSeen
                && $otherLastSeen->greaterThanOrEqualTo(
                    now()->subMinutes(2)
                );
        }

        $pendingVehicle = $this->pendingVehicle(
            $request,
            $conversation
        );

        return view('communication.show', [
            'conversation' => $conversation,
            'currentDealer' => $currentDealer,
            'otherDealer' => $otherDealer,
            'otherIsOnline' => $otherIsOnline,
            'otherLastSeen' => $otherLastSeen,
            'onlineStatusVisible' => $onlineStatusVisible,
            'pendingVehicle' => $pendingVehicle,
        ]);
    }

    /**
     * Send a message. Optional vehicle_id is context only.
     */
    public function store(Request $request, Conversation $conversation): JsonResponse
    {
        $currentDealer = $this->currentDealer();

        $this->authorizeConversation($conversation, $currentDealer);

        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'max:5000',
            ],
            'vehicle_id' => [
                'nullable',
                'integer',
                'exists:vehicles,id',
            ],
        ]);

        $this->updateLastSeen($currentDealer);

        $vehicle = null;

        if (! empty($validated['vehicle_id'])) {
            $vehicle = Vehicle::with('media')->find($validated['vehicle_id']);

            abort_unless(
                $vehicle && $conversation->involvesDealer((int) $vehicle->dealer_id),
                422
            );
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $currentDealer->id,
            'vehicle_id' => $vehicle?->id,
            'message' => trim($validated['message']),
        ]);

        $conversation->touch();

        $message->load(['sender.user', 'vehicle.media']);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'text' => $message->message,
                'time' => $message->created_at->format('g:i A'),
                'edited' => false,
                'read' => false,
                'vehicle' => $this->vehiclePayload($vehicle),
            ],
        ]);
    }

    /**
     * Edit a message.
     */
    public function update(Request $request, Message $message): JsonResponse
    {
        $currentDealer = $this->currentDealer();

        $message->load('conversation');

        $this->authorizeConversation(
            $message->conversation,
            $currentDealer
        );

        if ((int) $message->sender_id !== (int) $currentDealer->id) {
            return response()->json([
                'message' => 'You can only edit your own messages.',
            ], 403);
        }

        if ($message->deleted_at) {
            return response()->json([
                'message' => 'Deleted messages cannot be edited.',
            ], 422);
        }

        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'max:5000',
            ],
        ]);

        $message->update([
            'message' => trim($validated['message']),
            'edited_at' => now(),
        ]);

        $this->updateLastSeen($currentDealer);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'text' => $message->message,
                'edited' => true,
            ],
        ]);
    }

    /**
     * Delete a message.
     */
    public function destroy(Message $message): JsonResponse
    {
        $currentDealer = $this->currentDealer();

        $message->load('conversation');

        $this->authorizeConversation(
            $message->conversation,
            $currentDealer
        );

        if ((int) $message->sender_id !== (int) $currentDealer->id) {
            return response()->json([
                'message' => 'You can only delete your own messages.',
            ], 403);
        }

        $message->update([
            'deleted_at' => now(),
        ]);

        $this->updateLastSeen($currentDealer);

        return response()->json([
            'success' => true,
            'message_id' => $message->id,
        ]);
    }

    /**
     * Heartbeat / online status.
     */
    public function heartbeat(Request $request): JsonResponse
    {
        $currentDealer = $this->currentDealer();

        $this->updateLastSeen($currentDealer);

        return response()->json([
            'success' => true,
            'online' => true,
        ]);
    }

    /**
     * Update online-status privacy.
     */
    public function updateOnlineStatus(Request $request): JsonResponse
    {
        $currentDealer = $this->currentDealer();

        $validated = $request->validate([
            'show_online_status' => [
                'required',
                'boolean',
            ],
        ]);

        $currentDealer->user->update([
            'show_online_status' => $validated['show_online_status'],
        ]);

        return response()->json([
            'success' => true,
            'show_online_status' => (bool) $validated['show_online_status'],
        ]);
    }

    private function currentDealer(): Dealer
    {
        return Dealer::with('user')
            ->where('user_id', auth()->id())
            ->firstOrFail();
    }

    private function updateLastSeen(Dealer $dealer): void
    {
        if ($dealer->user) {
            $dealer->user->update([
                'last_seen_at' => now(),
            ]);
        }
    }

    private function authorizeConversation(
        Conversation $conversation,
        Dealer $dealer
    ): void {
        abort_unless(
            $conversation->involvesDealer((int) $dealer->id),
            403
        );
    }

    private function pendingVehicle(
        Request $request,
        Conversation $conversation
    ): ?Vehicle {
        $vehicleId = $request->query('vehicle');

        if (! $vehicleId) {
            return null;
        }

        $vehicle = Vehicle::with('media')->find($vehicleId);

        if (! $vehicle || ! $conversation->involvesDealer((int) $vehicle->dealer_id)) {
            return null;
        }

        return $vehicle;
    }

    private function vehiclePayload(?Vehicle $vehicle): ?array
    {
        if (! $vehicle) {
            return null;
        }

        $firstMedia = $vehicle->relationLoaded('media')
            ? $vehicle->media->first()
            : $vehicle->media()->orderBy('sort_order')->first();

        $image = null;

        if ($firstMedia?->file_path) {
            $image = asset('storage/'.ltrim($firstMedia->file_path, '/'));
        }

        return [
            'id' => $vehicle->id,
            'title' => $vehicle->displayName(),
            'price' => $vehicle->price !== null
                ? '₦'.number_format((float) $vehicle->price)
                : null,
            'url' => route('public.vehicles.show', $vehicle),
            'image' => $image,
        ];
    }
}
