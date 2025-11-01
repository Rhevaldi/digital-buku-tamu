<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Halaman untuk ADMIN: Menampilkan daftar semua pengguna.
     */
    public function index(): View
    {
        $users = User::with('roles')->get();

        return view('users.index', [
            'title_page' => 'Data Pengguna',
            'users' => $users,
        ]);
    }

  
    public function create(): View
    {
        $roles = Role::all();

        return view('users.create', [
            'title_page' => 'Tambah Pengguna',
            'roles' => $roles,
        ]);
    }

   
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
            'role'                  => 'required|exists:roles,name',
        ]);

        
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        
        $user->assignRole($validated['role']);

        return redirect()->route('users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

  
    public function edit(string $id): View
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('users.edit', [
            'title_page' => 'Edit Pengguna',
            'user' => $user,
            'roles' => $roles,
        ]);
    }

  
    public function update(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->email,
            'role'     => 'required|exists:roles,name',
            'password' => 'nullable|min:6|confirmed',
        ]);

       
        $user->update([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password']
                ? Hash::make($validated['password'])
                : $user->password,
        ]);

   
        $user->syncRoles([$validated['role']]);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    
    public function destroy(string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
