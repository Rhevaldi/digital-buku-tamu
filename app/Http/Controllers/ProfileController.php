<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Halaman untuk ADMIN: Menampilkan daftar semua pengguna.
     */
    public function index(): View
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin) {
            abort(403, 'Hanya admin yang dapat mengakses halaman ini.');
        }

        $users = User::all();

        return view('profile.index', [
            'title_page' => 'Data User',
            'users' => $users,
        ]);
    }

    /**
     * Halaman untuk USER/ADMIN: Menampilkan form edit profil pribadi.
     */
    public function edit(Request $request): View
    {
        $authUser = $request->user();
        $totalUser = User::count();

        // Hanya admin bisa melihat semua pengguna (jika diperlukan untuk view)
        $users = $authUser->is_admin ? User::all() : [];

        return view('profile.edit', [
            'user' => $authUser,
            'title_page' => 'Profil Saya',
            'totalUser' => $totalUser,
            'users' => $users,
        ]);
    }

    /**
     * Update informasi profil pengguna (nama, email, dll).
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        // Reset verifikasi email jika email diubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun pengguna (setelah konfirmasi password).
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
