@extends('layouts.guest')

@section('content')
    <p class="login-box-msg">
        Silakan masukkan kata sandi baru untuk akun <strong>{{ session('reset_email') }}</strong>
    </p>

    <form method="POST" action="{{ route('password.reset.manual') }}">
        @csrf

        <!-- Password Baru -->
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Kata Sandi Baru" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>
        @error('password')
            <div class="text-danger mb-2">{{ $message }}</div>
        @enderror

        <!-- Konfirmasi Password -->
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Kata Sandi" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>
        @error('password_confirmation')
            <div class="text-danger mb-2">{{ $message }}</div>
        @enderror

        <!-- Tombol Submit -->
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">
                    Simpan Kata Sandi Baru
                </button>
            </div>
        </div>
    </form>

    <!-- Kembali ke Login -->
    <p class="mt-3 mb-1 text-center">
        <a href="{{ route('login') }}">Kembali ke Halaman Login</a>
    </p>
@endsection
