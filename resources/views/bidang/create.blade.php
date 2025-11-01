<x-app-layout>
    <!-- Content Header (Page header) -->
    <section class="content-header bg-gradient-white mb-3">
        <div class="container-fluid">
            <div class="row mb-0">
                <div class="col-sm-6">
                    <h1>Manajemen Bidang/Departemen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('bidang.index') }}">Manajemen Bidang/Departemen</a>
                        </li>
                        <li class="breadcrumb-item active">Bidang/Departemen Baru</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <p class="float-left mb-0 pt-1 font-weight-bold">{{ $title_page }}</p>
                            <a href="{{ route('bidang.index') }}" class="btn btn-light btn-sm float-right"
                                style="color:black !important">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>
                        <form action="{{ route('bidang.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Bidang/Departemen <code>*</code></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="Masukkan nama bidang/departemen"
                                        required autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi <code>*</code></label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Masukkan deskripsi bidang/departemen" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
