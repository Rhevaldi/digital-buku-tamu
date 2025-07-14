<section>
    <h5 class="mb-3"><i class="fas fa-user-edit mr-2"></i> Informasi Akun</h5>
    <p class="text-muted mb-4">
        Perbarui informasi profil dan alamat email Anda.
    </p>

    <!-- Form Kirim Verifikasi Ulang -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Form Update Profile -->
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <!-- Nama -->
        <div class="form-group mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2">
                    <small>
                        Alamat email Anda belum diverifikasi.
                        <button type="submit" form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                            Klik di sini untuk mengirim ulang tautan verifikasi.
                        </button>
                    </small>
                    @if (session('status') === 'verification-link-sent')
                        <div class="text-success mt-1 small">
                            Tautan verifikasi baru telah dikirim ke alamat email Anda.
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Tombol Simpan -->
        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save mr-1"></i> Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-success small">Tersimpan.</span>
            @endif
        </div>
    </form>
</section>
