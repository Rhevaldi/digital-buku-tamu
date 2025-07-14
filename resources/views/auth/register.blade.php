@extends('layouts.guest')

@section('content')
    <p class="login-box-msg">Daftar akun baru untuk masuk ke sistem</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required autofocus value="{{ old('name') }}">
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-user"></span></div>
            </div>
        </div>
        @error('name')
            <div class="text-danger mb-2">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
            </div>
        </div>
        @error('email')
            <div class="text-danger mb-2">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>
        @error('password')
            <div class="text-danger mb-2">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
            </div>
        </div>
    </form>

    <p class="mt-3 mb-1 text-center">
        <a href="{{ route('login') }}">Sudah punya akun? Masuk</a>
    </p>
@endsection
