<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class VehicleController
{
    /*
    |--------------------------------------------------------------------------
    | Vehicle Listing
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $dealer = Dealer::where('user_id', Auth::id())
            ->firstOrFail();

        $activeVehicles = $dealer->vehicles()
            ->where('status', 'active')
            ->latest()
            ->get();

        $soldVehicles = $dealer->vehicles()
            ->where('status', 'sold')
            ->latest()
            ->get();

        $archivedVehicles = $dealer->vehicles()
            ->where('status', 'archived')
            ->latest()
            ->get();

        return view('vehicles.index', compact(
            'dealer',
            'activeVehicles',
            'soldVehicles',
            'archivedVehicles'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Create Vehicle
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $dealer = Dealer::where('user_id', Auth::id())
            ->firstOrFail();

        return view('vehicles.create', compact('dealer'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store Vehicle
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $dealer = Dealer::where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'vin' => [
                'required',
                'string',
                'size:17',
                'regex:/^[A-HJ-NPR-Z0-9]{17}$/',
                Rule::unique('vehicles', 'vin'),
            ],

            'make' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],

            'year' => [
                'required',
                'integer',
                'min:1886',
                'max:' . (date('Y') + 1),
            ],

            'trim' => ['nullable', 'string', 'max:100'],
            'body_type' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:100'],
            'engine' => ['nullable', 'string', 'max:100'],
            'transmission' => ['nullable', 'string', 'max:100'],
            'fuel_type' => ['nullable', 'string', 'max:100'],
            'drivetrain' => ['nullable', 'string', 'max:100'],

            'mileage' => ['nullable', 'integer', 'min:0'],
            'price' => ['nullable', 'numeric', 'min:0'],

            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],

            'description' => ['nullable', 'string'],
        ]);

        $vin = strtoupper(trim($validated['vin']));

        /*
        |--------------------------------------------------------------------------
        | VIN Check Digit
        |--------------------------------------------------------------------------
        */

        if (!$this->isValidVinCheckDigit($vin)) {
            return back()
                ->withErrors([
                    'vin' => 'This VIN has an invalid check digit.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Create Vehicle
        |--------------------------------------------------------------------------
        */

        $vehicle = Vehicle::create([
            'dealer_id' => $dealer->id,

            'vin' => $vin,
            'make' => $validated['make'],
            'model' => $validated['model'],
            'year' => $validated['year'],

            'trim' => $validated['trim'] ?? null,
            'body_type' => $validated['body_type'] ?? null,
            'color' => $validated['color'] ?? null,
            'engine' => $validated['engine'] ?? null,
            'transmission' => $validated['transmission'] ?? null,
            'fuel_type' => $validated['fuel_type'] ?? null,
            'drivetrain' => $validated['drivetrain'] ?? null,

            'mileage' => $validated['mileage'] ?? null,
            'price' => $validated['price'] ?? null,

            'city' => $validated['city'] ?? null,
            'state' => $validated['state'] ?? null,
            'country' => $validated['country'] ?? 'Nigeria',

            'status' => 'active',
            'vin_status' => 'valid',
            'history_checked' => false,

            'description' => $validated['description'] ?? null,
        ]);

        return redirect()
            ->route('vehicles.show', $vehicle)
            ->with('success', 'Vehicle listed successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Show Vehicle
    |--------------------------------------------------------------------------
    */

    public function show(Vehicle $vehicle)
    {
        /*
        | Make sure the logged-in dealer owns this vehicle.
        */
        $this->verifyOwnership($vehicle);

        /*
        | Load the vehicle's dealer and media.
        */
        $vehicle->load([
            'dealer',
            'media',
        ]);

        /*
        | Pass both $vehicle AND $dealer to the Blade view.
        |
        | This fixes:
        | Undefined variable $dealer
        */
        $dealer = $vehicle->dealer;

        return view('vehicles.show', compact(
            'vehicle',
            'dealer'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Vehicle
    |--------------------------------------------------------------------------
    */

    public function edit(Vehicle $vehicle)
    {
        $this->verifyOwnership($vehicle);

        return view('vehicles.edit', compact('vehicle'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update Vehicle
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Vehicle $vehicle)
    {
        $this->verifyOwnership($vehicle);

        $validated = $request->validate([
            'make' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],

            'year' => [
                'required',
                'integer',
                'min:1886',
                'max:' . (date('Y') + 1),
            ],

            'trim' => ['nullable', 'string', 'max:100'],
            'body_type' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:100'],
            'engine' => ['nullable', 'string', 'max:100'],
            'transmission' => ['nullable', 'string', 'max:100'],
            'fuel_type' => ['nullable', 'string', 'max:100'],
            'drivetrain' => ['nullable', 'string', 'max:100'],

            'mileage' => ['nullable', 'integer', 'min:0'],
            'price' => ['nullable', 'numeric', 'min:0'],

            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],

            'description' => ['nullable', 'string'],
        ]);

        $vehicle->update([
            'make' => $validated['make'],
            'model' => $validated['model'],
            'year' => $validated['year'],

            'trim' => $validated['trim'] ?? null,
            'body_type' => $validated['body_type'] ?? null,
            'color' => $validated['color'] ?? null,
            'engine' => $validated['engine'] ?? null,
            'transmission' => $validated['transmission'] ?? null,
            'fuel_type' => $validated['fuel_type'] ?? null,
            'drivetrain' => $validated['drivetrain'] ?? null,

            'mileage' => $validated['mileage'] ?? null,
            'price' => $validated['price'] ?? null,

            'city' => $validated['city'] ?? null,
            'state' => $validated['state'] ?? null,
            'country' => $validated['country'] ?? 'Nigeria',

            'description' => $validated['description'] ?? null,
        ]);

        return redirect()
            ->route('vehicles.show', $vehicle)
            ->with('success', 'Vehicle information updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Permanently Delete Vehicle
    |--------------------------------------------------------------------------
    */

    public function destroy(Vehicle $vehicle)
    {
        $this->verifyOwnership($vehicle);

        $vehicle->load('media');

        foreach ($vehicle->media as $media) {
            if (Storage::disk('public')->exists($media->file_path)) {
                Storage::disk('public')->delete($media->file_path);
            }
        }

        $vehicle->delete();

        return redirect()
            ->route('vehicles.index')
            ->with(
                'success',
                'Vehicle and all associated media were permanently deleted.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle Status
    |--------------------------------------------------------------------------
    */

    public function markSold(Vehicle $vehicle)
    {
        $this->verifyOwnership($vehicle);

        $vehicle->update([
            'status' => 'sold',
        ]);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Vehicle marked as sold.');
    }

    public function archive(Vehicle $vehicle)
    {
        $this->verifyOwnership($vehicle);

        $vehicle->update([
            'status' => 'archived',
        ]);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Vehicle archived successfully.');
    }

    public function restore(Vehicle $vehicle)
    {
        $this->verifyOwnership($vehicle);

        $vehicle->update([
            'status' => 'active',
        ]);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Vehicle re-listed successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Ownership Protection
    |--------------------------------------------------------------------------
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

    /*
    |--------------------------------------------------------------------------
    | VIN Check Digit Validation
    |--------------------------------------------------------------------------
    */

    private function isValidVinCheckDigit(string $vin): bool
    {
        $transliteration = [
            'A' => 1,
            'B' => 2,
            'C' => 3,
            'D' => 4,
            'E' => 5,
            'F' => 6,
            'G' => 7,
            'H' => 8,
            'J' => 1,
            'K' => 2,
            'L' => 3,
            'M' => 4,
            'N' => 5,
            'P' => 7,
            'R' => 9,
            'S' => 2,
            'T' => 3,
            'U' => 4,
            'V' => 5,
            'W' => 6,
            'X' => 7,
            'Y' => 8,
            'Z' => 9,

            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9,
        ];

        $weights = [
            8,
            7,
            6,
            5,
            4,
            3,
            2,
            10,
            0,
            9,
            8,
            7,
            6,
            5,
            4,
            3,
            2,
        ];

        $sum = 0;

        for ($i = 0; $i < 17; $i++) {
            $character = $vin[$i];

            if (!isset($transliteration[$character])) {
                return false;
            }

            $sum += $transliteration[$character] * $weights[$i];
        }

        $remainder = $sum % 11;

        $expectedCheckDigit = $remainder === 10
            ? 'X'
            : (string) $remainder;

        return $vin[8] === $expectedCheckDigit;
    }
}
