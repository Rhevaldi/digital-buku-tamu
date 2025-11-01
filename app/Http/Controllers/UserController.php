<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Halaman untuk ADMIN: Menampilkan daftar semua pengguna.
     */
    public function index(): View
    {
        $users = User::all();

        return view('users.index', [
            'title_page' => 'Data Pengguna',
            'users' => $users,
        ]);
    }
}
