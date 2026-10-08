<?php

use App\Http\Controllers\DealerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicDealerController;
use App\Http\Controllers\PublicVehicleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleMediaController;
use App\Http\Controllers\VehicleRequestController;
use App\Models\Dealer;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/terms', 'terms')
    ->name('terms');


/*
|--------------------------------------------------------------------------
| PUBLIC VEHICLES
|--------------------------------------------------------------------------
*/

Route::get(
    '/public/vehicles/{vehicle}',
    [PublicVehicleController::class, 'show']
)->name('public.vehicles.show');


/*
|--------------------------------------------------------------------------
| PUBLIC DEALERS
|--------------------------------------------------------------------------
*/

Route::get(
    '/public/dealers/{dealer}',
    [PublicDealerController::class, 'show']
)->name('public.dealers.show');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Current Dealer
        |--------------------------------------------------------------------------
        */

        $dealer = Dealer::where('user_id', $user->id)
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Vehicle Statistics
        |--------------------------------------------------------------------------
        */

        $totalVehicles = Vehicle::where(
            'dealer_id',
            $dealer->id
        )->count();

        $activeVehicles = Vehicle::where(
            'dealer_id',
            $dealer->id
        )
            ->where('status', 'active')
            ->count();

        $soldVehicles = Vehicle::where(
            'dealer_id',
            $dealer->id
        )
            ->where('status', 'sold')
            ->count();

        $archivedVehicles = Vehicle::where(
            'dealer_id',
            $dealer->id
        )
            ->where('status', 'archived')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Dashboard Stats
        |--------------------------------------------------------------------------
        */

        $stats = [
            'total' => $totalVehicles,
            'active' => $activeVehicles,
            'sold' => $soldVehicles,
            'archived' => $archivedVehicles,
        ];


        /*
        |--------------------------------------------------------------------------
        | Recent Vehicles
        |--------------------------------------------------------------------------
        */

        $recentVehicles = Vehicle::where(
            'dealer_id',
            $dealer->id
        )
            ->with('media')
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Dashboard View
        |--------------------------------------------------------------------------
        */

        return view('dashboard', [
            'user' => $user,
            'dealer' => $dealer,

            'stats' => $stats,

            'totalVehicles' => $totalVehicles,
            'activeVehicles' => $activeVehicles,
            'soldVehicles' => $soldVehicles,
            'archivedVehicles' => $archivedVehicles,

            'recentVehicles' => $recentVehicles,
        ]);

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | DEALER PROFILE / REGISTRATION
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dealer/create',
        [DealerController::class, 'create']
    )->name('dealer.create');

    Route::post(
        '/dealer',
        [DealerController::class, 'store']
    )->name('dealer.store');


    /*
    |--------------------------------------------------------------------------
    | VEHICLES
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/vehicles',
        [VehicleController::class, 'index']
    )->name('vehicles.index');

    Route::get(
        '/vehicles/create',
        [VehicleController::class, 'create']
    )->name('vehicles.create');

    Route::post(
        '/vehicles',
        [VehicleController::class, 'store']
    )->name('vehicles.store');

    Route::get(
        '/vehicles/{vehicle}',
        [VehicleController::class, 'show']
    )->name('vehicles.show');

    Route::get(
        '/vehicles/{vehicle}/edit',
        [VehicleController::class, 'edit']
    )->name('vehicles.edit');

    Route::put(
        '/vehicles/{vehicle}',
        [VehicleController::class, 'update']
    )->name('vehicles.update');

    Route::delete(
        '/vehicles/{vehicle}',
        [VehicleController::class, 'destroy']
    )->name('vehicles.destroy');

    Route::patch(
        '/vehicles/{vehicle}/sold',
        [VehicleController::class, 'markSold']
    )->name('vehicles.sold');

    Route::patch(
        '/vehicles/{vehicle}/archive',
        [VehicleController::class, 'archive']
    )->name('vehicles.archive');

    Route::patch(
        '/vehicles/{vehicle}/restore',
        [VehicleController::class, 'restore']
    )->name('vehicles.restore');


    /*
    |--------------------------------------------------------------------------
    | VEHICLE MEDIA
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/vehicles/{vehicle}/media',
        [VehicleMediaController::class, 'store']
    )->name('vehicles.media.store');

    Route::delete(
        '/vehicle-media/{media}',
        [VehicleMediaController::class, 'destroy']
    )->name('vehicles.media.destroy');


    /*
    |--------------------------------------------------------------------------
    | VIN CHECK
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/vin-check',
        [SearchController::class, 'vin']
    )->name('vin.check');


    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | SETTINGS
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/settings',
        'settings.index'
    )->name('settings');

    Route::post(
        '/settings/online-status',
        [MessageController::class, 'updateOnlineStatus']
    )->name('settings.online-status');


    /*
    |--------------------------------------------------------------------------
    | MESSAGES
    |--------------------------------------------------------------------------
    |
    | Specific message routes are placed before dynamic routes.
    |
    */

    Route::get(
        '/messages-requests',
        [MessageController::class, 'index']
    )->name('communication');

    Route::get(
        '/messages/start/{vehicle}',
        [MessageController::class, 'start']
    )->name('messages.start');

    Route::post(
        '/messages/heartbeat',
        [MessageController::class, 'heartbeat']
    )->name('messages.heartbeat');

    Route::post(
        '/messages/{conversation}',
        [MessageController::class, 'store']
    )->name('messages.store');

    Route::patch(
        '/messages/{message}',
        [MessageController::class, 'update']
    )->name('messages.update');

    Route::delete(
        '/messages/{message}',
        [MessageController::class, 'destroy']
    )->name('messages.destroy');

    Route::get(
        '/messages/{conversation}',
        [MessageController::class, 'show']
    )->name('messages.show');


    /*
    |--------------------------------------------------------------------------
    | VEHICLE REQUESTS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/requests',
        [VehicleRequestController::class, 'index']
    )->name('requests.index');

    Route::get(
        '/requests/create',
        [VehicleRequestController::class, 'create']
    )->name('requests.create');

    Route::post(
        '/requests',
        [VehicleRequestController::class, 'store']
    )->name('requests.store');

    Route::get(
        '/requests/{vehicleRequest}',
        [VehicleRequestController::class, 'show']
    )->name('requests.show');

    Route::get(
        '/requests/{vehicleRequest}/edit',
        [VehicleRequestController::class, 'edit']
    )->name('requests.edit');

    Route::put(
        '/requests/{vehicleRequest}',
        [VehicleRequestController::class, 'update']
    )->name('requests.update');

    Route::patch(
        '/requests/{vehicleRequest}/cancel',
        [VehicleRequestController::class, 'cancel']
    )->name('requests.cancel');


    /*
    |--------------------------------------------------------------------------
    | NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/notifications',
        [NotificationController::class, 'index']
    )->name('notifications.index');

    Route::get(
        '/notifications/{notification}',
        [NotificationController::class, 'show']
    )->name('notifications.show');

    Route::post(
        '/notifications/{notification}/read',
        [NotificationController::class, 'markAsRead']
    )->name('notifications.read');

    Route::post(
        '/notifications/read-all',
        [NotificationController::class, 'markAllAsRead']
    )->name('notifications.read-all');


    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/search',
        [SearchController::class, 'index']
    )->name('search');

    Route::get(
        '/search/suggestions',
        [SearchController::class, 'suggestions']
    )->name('search.suggestions');

    Route::get(
        '/search/vin/{vin?}',
        [SearchController::class, 'vin']
    )->name('search.vin');

});


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';