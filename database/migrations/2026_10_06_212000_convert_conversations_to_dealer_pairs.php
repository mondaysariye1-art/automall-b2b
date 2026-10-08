<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Convert one-conversation-per-vehicle into one conversation
     * per unordered dealer pair. Existing messages are preserved.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('messages', 'vehicle_id')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->foreignId('vehicle_id')
                    ->nullable()
                    ->after('sender_id')
                    ->constrained('vehicles')
                    ->nullOnDelete();
            });
        }

        if (! Schema::hasColumn('conversations', 'pair_key')) {
            Schema::table('conversations', function (Blueprint $table) {
                $table->string('pair_key', 32)
                    ->nullable()
                    ->after('vehicle_id');
            });
        }

        DB::statement("
            UPDATE messages
            INNER JOIN conversations
                ON messages.conversation_id = conversations.id
            SET messages.vehicle_id = conversations.vehicle_id
            WHERE messages.vehicle_id IS NULL
              AND conversations.vehicle_id IS NOT NULL
        ");

        $conversations = DB::table('conversations')
            ->orderBy('id')
            ->get();

        $groups = [];

        foreach ($conversations as $conversation) {
            $key = $this->pairKey(
                (int) $conversation->buyer_id,
                (int) $conversation->dealer_id
            );

            $groups[$key][] = $conversation;
        }

        foreach ($groups as $pairKey => $items) {
            $keep = $this->chooseConversationToKeep($items);

            foreach ($items as $conversation) {
                if ((int) $conversation->id === (int) $keep->id) {
                    continue;
                }

                DB::table('messages')
                    ->where('conversation_id', $conversation->id)
                    ->update([
                        'conversation_id' => $keep->id,
                    ]);

                DB::table('conversations')
                    ->where('id', $conversation->id)
                    ->delete();
            }

            $latestMessageAt = DB::table('messages')
                ->where('conversation_id', $keep->id)
                ->max('created_at');

            DB::table('conversations')
                ->where('id', $keep->id)
                ->update([
                    'pair_key' => $pairKey,
                    'vehicle_id' => null,
                    'updated_at' => $latestMessageAt ?: $keep->updated_at,
                ]);
        }

        Schema::table('conversations', function (Blueprint $table) {
            $table->unique('pair_key');
        });
    }

    public function down(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropUnique(['pair_key']);
        });

        if (Schema::hasColumn('conversations', 'pair_key')) {
            Schema::table('conversations', function (Blueprint $table) {
                $table->dropColumn('pair_key');
            });
        }

        if (Schema::hasColumn('messages', 'vehicle_id')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->dropConstrainedForeignId('vehicle_id');
            });
        }
    }

    private function pairKey(int $dealerA, int $dealerB): string
    {
        $ids = [$dealerA, $dealerB];
        sort($ids);

        return $ids[0].':'.$ids[1];
    }

    /**
     * Keep the conversation that already has the newest message.
     * If none have messages, keep the oldest record.
     */
    private function chooseConversationToKeep(array $items)
    {
        $withActivity = collect($items)
            ->sortByDesc(function ($conversation) {
                $latest = DB::table('messages')
                    ->where('conversation_id', $conversation->id)
                    ->max('created_at');

                return $latest ?: $conversation->updated_at;
            })
            ->values();

        return $withActivity->first();
    }
};
