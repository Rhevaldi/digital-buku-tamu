<section>
    <h5 class="mb-3"><i class="fas fa-lock mr-2"></i> Ganti Password</h5>
    <p class="text-muted mb-4">
        Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk keamanan maksimal.
    </p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <!-- Password Lama -->
        <div class="form-group mb-3">
            <label for="current_password">Password Lama</label>
            <input type="password" id="current_password" name="current_password" class="form-control" autocomplete="current-password">
            @if ($errors->updatePassword->has('current_password'))
                <small class="text-danger">{{ $errors->updatePassword->first('current_password') }}</small>
            @endif
        </div>

        <!-- Password Baru -->
        <div class="form-group mb-3">
            <label for="password">Password Baru</label>
            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password">
            @if ($errors->updatePassword->has('password'))
                <small class="text-danger">{{ $errors->updatePassword->first('password') }}</small>
            @endif
        </div>

        <!-- Konfirmasi Password Baru -->
        <div class="form-group mb-4">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
            @if ($errors->updatePassword->has('password_confirmation'))
                <small class="text-danger">{{ $errors->updatePassword->first('password_confirmation') }}</small>
            @endif
        </div>

        <!-- Tombol Simpan -->
        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success small">Password berhasil diperbarui.</span>
            @endif
        </div>
    </form>
</section>
