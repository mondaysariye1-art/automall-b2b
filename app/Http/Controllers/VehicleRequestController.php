<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\VehicleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleRequestController extends Controller
{
    public function index(Request $request): View
    {
        $dealer = Dealer::where('user_id', $request->user()->id)
            ->firstOrFail();

        $requests = VehicleRequest::with('dealer')
            ->where('status', 'open')
            ->latest()
            ->get();

        return view('requests.index', compact('dealer', 'requests'));
    }

    public function create(Request $request): View
    {
        $dealer = Dealer::where('user_id', $request->user()->id)
            ->firstOrFail();

        return view('requests.create', compact('dealer'));
    }

    public function store(Request $request): RedirectResponse
    {
        $dealer = Dealer::where('user_id', $request->user()->id)
            ->firstOrFail();

        $validated = $request->validate([
            'make' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'trim' => ['nullable', 'string', 'max:100'],
            'body_type' => ['nullable', 'string', 'max:100'],

            'usage_type' => [
                'required',
                'in:nigerian_used,foreign_used,brand_new',
            ],

            'min_budget' => ['nullable', 'integer', 'min:0'],
            'max_budget' => ['nullable', 'integer', 'min:0'],

            'location_scope' => [
                'required',
                'in:state,nationwide',
            ],

            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],

            'description' => ['nullable', 'string'],
        ]);

        if (
            isset($validated['min_budget'], $validated['max_budget']) &&
            $validated['min_budget'] > $validated['max_budget']
        ) {
            return back()
                ->withErrors([
                    'max_budget' => 'Maximum budget must be greater than or equal to minimum budget.',
                ])
                ->withInput();
        }

        if ($validated['location_scope'] === 'state') {
            if (empty($validated['state'])) {
                return back()
                    ->withErrors([
                        'state' => 'Please select your preferred state.',
                    ])
                    ->withInput();
            }
        }

        if ($validated['location_scope'] === 'nationwide') {
            $validated['state'] = null;
            $validated['city'] = null;
        }

        $validated['dealer_id'] = $dealer->id;
        $validated['status'] = 'open';

        VehicleRequest::create($validated);

        return redirect()
            ->route('requests.index')
            ->with('success', 'Vehicle request created successfully.');
    }

    public function show(
        Request $request,
        VehicleRequest $vehicleRequest
    ): View {
        $dealer = Dealer::where('user_id', $request->user()->id)
            ->firstOrFail();

        $vehicleRequest->load('dealer');

        return view('requests.show', compact(
            'dealer',
            'vehicleRequest'
        ));
    }

    public function edit(
        Request $request,
        VehicleRequest $vehicleRequest
    ): View {
        $dealer = Dealer::where('user_id', $request->user()->id)
            ->firstOrFail();

        abort_unless(
            $vehicleRequest->dealer_id === $dealer->id,
            403
        );

        return view('requests.edit', compact(
            'dealer',
            'vehicleRequest'
        ));
    }

    public function update(
        Request $request,
        VehicleRequest $vehicleRequest
    ): RedirectResponse {
        $dealer = Dealer::where('user_id', $request->user()->id)
            ->firstOrFail();

        abort_unless(
            $vehicleRequest->dealer_id === $dealer->id,
            403
        );

        $validated = $request->validate([
            'make' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'trim' => ['nullable', 'string', 'max:100'],
            'body_type' => ['nullable', 'string', 'max:100'],

            'usage_type' => [
                'required',
                'in:nigerian_used,foreign_used,brand_new',
            ],

            'min_budget' => ['nullable', 'integer', 'min:0'],
            'max_budget' => ['nullable', 'integer', 'min:0'],

            'location_scope' => [
                'required',
                'in:state,nationwide',
            ],

            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],

            'description' => ['nullable', 'string'],
        ]);

        if (
            isset($validated['min_budget'], $validated['max_budget']) &&
            $validated['min_budget'] > $validated['max_budget']
        ) {
            return back()
                ->withErrors([
                    'max_budget' => 'Maximum budget must be greater than or equal to minimum budget.',
                ])
                ->withInput();
        }

        if ($validated['location_scope'] === 'state' && empty($validated['state'])) {
            return back()
                ->withErrors([
                    'state' => 'Please select your preferred state.',
                ])
                ->withInput();
        }

        if ($validated['location_scope'] === 'nationwide') {
            $validated['state'] = null;
            $validated['city'] = null;
        }

        $vehicleRequest->update($validated);

        return redirect()
            ->route('requests.show', $vehicleRequest)
            ->with('success', 'Vehicle request updated successfully.');
    }

    public function cancel(
        Request $request,
        VehicleRequest $vehicleRequest
    ): RedirectResponse {
        $dealer = Dealer::where('user_id', $request->user()->id)
            ->firstOrFail();

        abort_unless(
            $vehicleRequest->dealer_id === $dealer->id,
            403
        );

        $vehicleRequest->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('requests.index')
            ->with('success', 'Vehicle request cancelled.');
    }
}
