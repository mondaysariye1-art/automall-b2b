<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    private function requireSuperAdmin(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->isSuperAdmin(),
            403
        );
    }

    public function index(): View
    {
        $this->requireSuperAdmin();

        $users = User::query()
            ->select('id', 'name', 'email', 'role', 'created_at')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $this->requireSuperAdmin();

        if (strtolower($user->email) === 'mondaysariye1@gmail.com') {
            return back()->with('error', 'The Super Admin account is protected.');
        }

        $validated = $request->validate([
            'role' => 'required|in:dealer,staff,admin',
        ]);

        $user->role = $validated['role'];
        $user->save();

        return back()->with('success', 'User role updated successfully.');
    }
}