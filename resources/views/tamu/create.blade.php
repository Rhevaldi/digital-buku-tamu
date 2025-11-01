<x-app-layout>
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <p class="float-left mb-0 pt-1 font-weight-bold">{{ $title_page }}</p>
                            <a href="{{ route('tamu.index') }}" class="btn btn-light btn-sm float-right"
                                style="color:black !important">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>
                        <form action="{{ route('tamu.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap <code>*</code></label>
                                            <input type="text" name="nama" id="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required
                                                autofocus>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="no_identitas">No. Identitas <code>*</code></label>
                                            <input type="text" name="no_identitas" id="no_identitas"
                                                class="form-control @error('no_identitas') is-invalid @enderror"
                                                value="{{ old('no_identitas') }}" placeholder="Masukkan No. Identitas"
                                                required autofocus>
                                            @error('no_identitas')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="no_wa">No. WhatsApp <code>*</code></label>
                                            <input type="text" name="no_wa" id="no_wa"
                                                class="form-control @error('no_wa') is-invalid @enderror"
                                                value="{{ old('no_wa') }}" placeholder="Masukkan No. WhatsApp" required
                                                autofocus>
                                            @error('no_wa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="instansi">Instansi <code>*</code></label>
                                            <input type="text" name="instansi" id="instansi"
                                                class="form-control @error('instansi') is-invalid @enderror"
                                                value="{{ old('instansi') }}" placeholder="Masukkan Instansi" required
                                                autofocus>
                                            @error('instansi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="alamat">Alamat Instansi <code>*</code></label>
                                            <input type="text" name="alamat" id="alamat"
                                                class="form-control @error('alamat') is-invalid @enderror"
                                                value="{{ old('alamat') }}" placeholder="Masukkan alamat" required
                                                autofocus>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="purpose_id">Jenis Keperluan <code>*</code></label>
                                            <select name="purpose_id" id="purpose_id"
                                                class="form-control @error('purpose_id') is-invalid @enderror" required
                                                autofocus>
                                                <option value="" disabled
                                                    {{ old('purpose_id') ? '' : 'selected' }}>Pilih Jenis
                                                    Keperluan</option>
                                                @foreach ($purposes as $purpose)
                                                    <option value="{{ $purpose->id }}"
                                                        {{ old('purpose_id') == $purpose->id ? 'selected' : '' }}>
                                                        {{ $purpose->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('purpose_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="bidang_id">Bidang Dituju <code>*</code></label>
                                            <select name="bidang_id" id="bidang_id"
                                                class="form-control @error('bidang_id') is-invalid @enderror" required
                                                autofocus>
                                                <option value="" disabled
                                                    {{ old('bidang_id') ? '' : 'selected' }}>
                                                    Pilih Bidang Dituju
                                                </option>
                                                @foreach ($bidangs as $bidang)
                                                    <option value="{{ $bidang->id }}"
                                                        {{ old('bidang_id') == $bidang->id ? 'selected' : '' }}>
                                                        {{ $bidang->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('bidang_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                                placeholder="Sudah buat janji dengan siapa?" required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="reset" class="btn btn-secondary">
                                        <i class="fas fa-undo mr-1"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save mr-1"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->



</x-app-layout>
