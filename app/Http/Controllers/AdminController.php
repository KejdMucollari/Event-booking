<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display all users with search functionality
    public function index(Request $request)
    {
        $search = $request->query('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('email', 'like', "%{$search}%");
        })->with('role')->paginate(10);

        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles', 'search'));
    }

    // Update user's role
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}
