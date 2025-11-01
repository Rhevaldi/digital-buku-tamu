<section>
    <h5 class="mb-3"><i class="fas fa-user-times mr-2"></i> Hapus Akun</h5>
    <p class="text-muted mb-3">
        Setelah akun Anda dihapus, semua data akan hilang secara permanen.
        Pastikan Anda sudah mencadangkan informasi penting.
    </p>

    <form id="delete-account-form" method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')
        
        <div class="form-group">
            <label for="password">Konfirmasi Kata Sandi</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password Anda" required>
            @if ($errors->userDeletion->has('password'))
                <small class="text-danger">
                    {{ $errors->userDeletion->first('password') }}
                </small>
            @endif
        </div>

        <button type="button" onclick="confirmDelete()" class="btn btn-danger">
            <i class="fas fa-trash-alt mr-1"></i> Hapus Akun
        </button>
    </form>
</section>
