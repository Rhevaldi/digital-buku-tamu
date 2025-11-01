<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestBookController;
use App\Models\User;
use App\Models\GuestBook;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ================= HALAMAN AWAL =================
Route::get('/', function () {
    return view('welcome');
});

// ================= DASHBOARD =================
Route::get('/dashboard', function () {
    $today = Carbon::today();

    $totalTamuMasuk = GuestBook::whereDate('created_at', $today)->count();
    $totalTamuKeluar = GuestBook::whereDate('updated_at', $today)
        ->whereNotNull('jam_keluar')
        ->count();
    $totalUser = User::count();
    $tamuHariIni = $totalTamuMasuk;

    return view('dashboard', [
        'title_page' => 'Dashboard',
        'totalTamuMasuk' => $totalTamuMasuk,
        'totalTamuKeluar' => $totalTamuKeluar,
        'totalUser' => $totalUser,
        'tamuHariIni' => $tamuHariIni,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// ================= PROFILE =================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ✅ Tambahkan route untuk melihat data user jika admin
    Route::get('/data-user', [ProfileController::class, 'index'])->name('profile.index');
});

// ================= BUKU TAMU =================
Route::middleware(['auth'])->group(function () {
    Route::resource('tamu', GuestBookController::class);
});

// ================= RESET PASSWORD MANUAL =================
Route::post('/check-email', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $user = User::where('email', $request->email)->first();

    if ($user) {
        session(['reset_email' => $user->email]);
        return redirect()->route('password.reset.form');
    }

    return back()->withErrors(['email' => 'Email tidak ditemukan.']);
})->name('password.check');

Route::get('/reset-password-manual', function () {
    if (!session()->has('reset_email')) {
        return redirect()->route('password.request')
            ->withErrors(['email' => 'Silakan masukkan email terlebih dahulu.']);
    }

    return view('auth.reset-password-manual', [
        'email' => session('reset_email'),
    ]);
})->name('password.reset.form');

Route::post('/reset-password-manual', function (Request $request) {
    $request->validate(['password' => ['required', 'confirmed', 'min:8']]);
    $user = User::where('email', session('reset_email'))->first();

    if (!$user) {
        return redirect()->route('password.request')
            ->withErrors(['email' => 'Terjadi kesalahan.']);
    }

    $user->update(['password' => bcrypt($request->password)]);
    session()->forget('reset_email');

    return redirect()->route('login')->with('status', 'Password berhasil diperbarui.');
})->name('password.reset.manual');

// ================= AUTH DEFAULT (Login/Register) =================
require __DIR__.'/auth.php';
