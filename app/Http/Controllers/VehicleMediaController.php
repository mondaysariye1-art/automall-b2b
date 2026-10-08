<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Vehicle;
use App\Models\VehicleMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehicleMediaController extends Controller
{
    /**
     * Upload vehicle media.
     *
     * Maximum:
     * - 5 photos per upload
     * - 25 photos total
     * - 1 video per vehicle
     */
    public function store(Request $request, Vehicle $vehicle)
    {
        $this->verifyOwnership($vehicle);

        $request->validate([
            'photos' => [
                'nullable',
                'array',
                'max:5',
            ],

            'photos.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'video' => [
                'nullable',
                'file',
                'mimes:mp4,mov,webm',
                'max:51200',
            ],
        ]);

        $uploadedMedia = [];

        /*
        |--------------------------------------------------------------------------
        | PHOTOS
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photos')) {
            $existingPhotos = $vehicle->media()
                ->where('type', 'photo')
                ->count();

            $newPhotos = count($request->file('photos'));

            if (($existingPhotos + $newPhotos) > 25) {
                $remaining = max(0, 25 - $existingPhotos);

                $message = $remaining > 0
                    ? "You can only upload {$remaining} more photo(s). Maximum is 25 photos per vehicle."
                    : 'This vehicle already has the maximum of 25 photos.';

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => $message,
                    ], 422);
                }

                return back()
                    ->withErrors([
                        'photos' => $message,
                    ])
                    ->withInput();
            }

            foreach ($request->file('photos') as $photo) {
                $path = $photo->store(
                    'vehicles/' . $vehicle->id,
                    'public'
                );

                $nextOrder = $vehicle->media()
                    ->where('type', 'photo')
                    ->max('sort_order');

                $media = VehicleMedia::create([
                    'vehicle_id' => $vehicle->id,
                    'type' => 'photo',
                    'file_path' => $path,
                    'sort_order' => ($nextOrder ?? -1) + 1,
                ]);

                $uploadedMedia[] = [
                    'id' => $media->id,
                    'type' => 'photo',
                    'file_path' => $media->file_path,

                    // Use the exact same URL format as the Blade page.
                    'url' => asset('storage/' . $media->file_path),

                    'sort_order' => $media->sort_order,

                    'delete_url' => route(
                        'vehicles.media.destroy',
                        $media
                    ),
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | VIDEO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('video')) {
            $existingVideo = $vehicle->media()
                ->where('type', 'video')
                ->exists();

            if ($existingVideo) {
                $message = 'This vehicle already has a video. Only 1 video is allowed.';

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => $message,
                    ], 422);
                }

                return back()
                    ->withErrors([
                        'video' => $message,
                    ])
                    ->withInput();
            }

            $path = $request->file('video')->store(
                'vehicles/' . $vehicle->id,
                'public'
            );

            $media = VehicleMedia::create([
                'vehicle_id' => $vehicle->id,
                'type' => 'video',
                'file_path' => $path,
                'sort_order' => 0,
            ]);

            $uploadedMedia[] = [
                'id' => $media->id,
                'type' => 'video',
                'file_path' => $media->file_path,

                'url' => asset(
                    'storage/' . $media->file_path
                ),

                'sort_order' => $media->sort_order,

                'delete_url' => route(
                    'vehicles.media.destroy',
                    $media
                ),
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | AJAX RESPONSE
        |--------------------------------------------------------------------------
        */

        if ($request->expectsJson()) {
            $photosCount = $vehicle->media()
                ->where('type', 'photo')
                ->count();

            $videosCount = $vehicle->media()
                ->where('type', 'video')
                ->count();

            return response()->json([
                'success' => true,
                'message' => 'Media uploaded successfully.',
                'media' => $uploadedMedia,
                'photos_count' => $photosCount,
                'videos_count' => $videosCount,
                'total_media' => $photosCount + $videosCount,
            ]);
        }

        return back()->with(
            'success',
            'Vehicle media uploaded successfully.'
        );
    }

    /**
     * Delete vehicle media.
     */
    public function destroy(Request $request, VehicleMedia $media)
    {
        $vehicle = $media->vehicle;

        $this->verifyOwnership($vehicle);

        $deletedId = $media->id;

        if (
            $media->file_path &&
            Storage::disk('public')->exists($media->file_path)
        ) {
            Storage::disk('public')->delete(
                $media->file_path
            );
        }

        $media->delete();

        if ($request->expectsJson()) {
            $photosCount = $vehicle->media()
                ->where('type', 'photo')
                ->count();

            $videosCount = $vehicle->media()
                ->where('type', 'video')
                ->count();

            return response()->json([
                'success' => true,
                'message' => 'Media deleted successfully.',
                'deleted_id' => $deletedId,
                'photos_count' => $photosCount,
                'videos_count' => $videosCount,
                'total_media' => $photosCount + $videosCount,
            ]);
        }

        return back()->with(
            'success',
            'Vehicle media removed successfully.'
        );
    }

    /**
     * Make sure the logged-in dealer owns the vehicle.
     */
    private function verifyOwnership(Vehicle $vehicle): void
    {
        $dealer = Dealer::where('user_id', Auth::id())
            ->firstOrFail();

        abort_unless(
            $vehicle->dealer_id === $dealer->id,
            403
        );
    }
}