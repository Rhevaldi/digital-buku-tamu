@extends('layouts.guest')

@section('content')
    <p class="login-box-msg">Masukkan email yang terdaftar untuk ubah password</p>

    <form method="POST" action="{{ route('password.check') }}">
        @csrf

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus value="{{ old('email') }}">
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
            </div>
        </div>
        @error('email')
            <div class="text-danger mb-2">{{ $message }}</div>
        @enderror

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Lanjut ke Ubah Password</button>
            </div>
        </div>
    </form>

    <p class="mt-3 mb-1 text-center">
        <a href="{{ route('login') }}">Kembali ke Login</a>
    </p>
@endsection
