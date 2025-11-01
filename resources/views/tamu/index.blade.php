<x-app-layout>
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-12">

                <!-- Card Utama -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 text-white">
                                <i class="fas fa-users"></i> Daftar Tamu
                            </h4>
                            <a href="{{ route('tamu.create') }}" class="btn btn-outline-light btn-sm">
                                <i class="fas fa-user-plus"></i> Tambah Tamu
                            </a>
                        </div>
                    </div>




                    <div class="card-body table-responsive">
                        <table id="tableTamu" class="table table-striped table-hover table-bordered">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No KTP</th>
                                    <th>Alamat</th>
                                    <th>No WA</th>
                                    <th>Keperluan</th>
                                    <th>Bidang</th>
                                    <th>Hari</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tamu as $data)
                                    <tr class="text-center align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->no_ktp }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>{{ $data->no_wa }}</td>
                                        <td>{{ $data->keperluan }}</td>
                                        <td>{{ $data->bidang->name }}</td>
                                        <td>{{ $data->hari }}</td>
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
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('tamu.destroy', $data->id) }}" method="POST"
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
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center text-muted">Belum ada data tamu.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /Card -->

            </div>
        </div>
    </div>
</x-app-layout>
