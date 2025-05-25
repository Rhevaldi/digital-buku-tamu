<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index()
    {
        // create Logic to list users
        View::share([
            'title_page' => 'Daftar Pengguna',
            'users' => User::orderBy('created_at', 'DESC')->get()
        ]); // Assuming you have a User model

        return view('users.index'); // Assuming you have a view for listing users
    }
    public function create()
    {
        // Logic to show user creation form
        View::share('title_page', 'Tambah Pengguna');
        return view('users.create'); // Assuming you have a view for creating users
    }
    public function store(Request $request)
    {
        // Logic to store a new user with role assignment from laravel permission package
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name', // Assuming you have roles defined
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->assignRole($request->role); // Assign role using Spatie Laravel Permission package
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }
    public function edit($id)
    {
        // Logic to show user edit form
        $user = User::findOrFail($id);
        View::share([
            'title_page' => 'Edit Pengguna',
            'user' => $user
        ]);
        return view('users.edit'); // Assuming you have a view for editing users
    }
    public function update(Request $request, $id)
    {
        // Logic to update user information with  role update from laravel permission package 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,name', // Assuming you have roles defined
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        $user->syncRoles($request->role); // Sync roles using Spatie Laravel Permission package
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }
    public function destroy($id)
    {
        // Logic to delete a user
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
