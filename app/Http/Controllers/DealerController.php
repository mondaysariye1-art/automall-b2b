<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealerController extends Controller
{
    /**
     * Show the dealer profile creation form.
     */
    public function create()
    {
        return view('dealer.create');
    }

    /**
     * Store a new dealer profile.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],
        ]);

        $validated['user_id'] = Auth::id();

        Dealer::create($validated);

        return redirect('/dashboard')
            ->with('success', 'Dealer profile created successfully.');
    }
}