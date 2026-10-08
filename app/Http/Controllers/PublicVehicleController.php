<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class PublicVehicleController extends Controller
{
    public function show(Request $request, Vehicle $vehicle)
    {
        $vehicle->load(['dealer.user', 'media']);

        if (! $vehicle->dealer) {
            abort(404);
        }

        if (
            $request->user()
            && (int) $vehicle->dealer->user_id === (int) $request->user()->id
        ) {
            return redirect()->route('vehicles.show', $vehicle);
        }

        if ($vehicle->status !== 'active') {
            abort(404);
        }

        if (in_array($vehicle->dealer->verification_status, ['rejected', 'suspended'], true)) {
            abort(404);
        }

        return view('vehicles.public-show', [
            'vehicle' => $vehicle,
            'dealer' => $vehicle->dealer,
            'isSelf' => false,
        ]);
    }
}
