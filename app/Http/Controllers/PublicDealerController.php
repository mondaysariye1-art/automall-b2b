<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class PublicDealerController extends Controller
{
    public function show(Request $request, Dealer $dealer)
    {
        if (in_array($dealer->verification_status, ['rejected', 'suspended'], true)) {
            abort(404);
        }

        $dealer->load('user');

        $vehicles = Vehicle::query()
            ->with('media')
            ->where('dealer_id', $dealer->id)
            ->where('status', 'active')
            ->latest()
            ->get();

        $currentDealerId = $request->user()
            ? Dealer::where('user_id', $request->user()->id)->value('id')
            : null;

        return view('dealers.show', [
            'dealer' => $dealer,
            'vehicles' => $vehicles,
            'isSelf' => (int) $dealer->id === (int) $currentDealerId,
        ]);
    }
}
