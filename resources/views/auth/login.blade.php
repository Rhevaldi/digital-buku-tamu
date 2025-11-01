@extends('layouts.guest')

@section('content')
    <p class="login-box-msg">Login untuk masuk ke sistem</p>

    <form method="POST" action="{{ route('login') }}">
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

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>
        @error('password')
            <div class="text-danger mb-2">{{ $message }}</div>
        @enderror

        <div class="row mb-3">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ingat saya</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
        </div>
    </form>

    <p class="mb-1 mt-3 text-center">
        <a href="{{ route('password.request') }}">Lupa Password?</a>
    </p>
@endsection
