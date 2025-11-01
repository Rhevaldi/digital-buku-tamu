<x-app-layout>
    <!-- Content Header (Page header) -->
    <section class="content-header bg-gradient-white mb-3">
        <div class="container-fluid">
            <div class="row mb-0">
                <div class="col-sm-6">
                    <h1>Manajemen Tamu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manajemen Tamu</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <p class="float-left mb-0 pt-1 font-weight-bold">{{ $title_page }}</p>
                            <a href="{{ route('tamu.create') }}" class="btn btn-light btn-sm float-right"
                                style="color:black !important">
                                <i class="fas fa-plus mr-1"></i> Tamu Baru
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped tamusTable nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama</th>
                                            <th>Instansi</th>
                                            <th>No KTP</th>
                                            <th>Alamat</th>
                                            <th>No WA</th>
                                            <th>Keperluan</th>
                                            <th>Bidang</th>
                                            <th>Tanggal</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tamu as $data)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->instansi }}</td>
                                                <td>{{ mask_identity($data->no_identitas) }}</td>
                                                <td>{{ $data->alamat }}</td>
                                                <td>{{ $data->no_wa }}</td>
                                                <td>{{ $data->keperluan }}</td>
                                                <td>{{ optional($data->bidang)->name }}</td>
                                                <td>{{ $data->tanggal }}</td>
                                                <td>{{ $data->jam_masuk }}</td>
                                                <td>
                                                    @if ($data->jam_keluar)
                                                        {{ $data->jam_keluar }}
                                                    @else
                                                        <span class="badge badge-warning">Belum keluar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <a href="{{ route('tamu.edit', $data->id) }}"
                                                            class="btn btn-sm btn-primary mr-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('tamu.destroy', $data->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
