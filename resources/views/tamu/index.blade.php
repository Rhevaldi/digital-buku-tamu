<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4">
<h3 class="card-title">Daftar Tamu</h3>
                            </div>
                            <div class="col-lg-8">
                                <a href="{{route('tamu.create')}}" class="btn btn-success float-right">Tambah</a>
                            </div>
                        </div>
                        
                        
                    </div>
                    <!-- /.card-header -->


                    <div class="card-body">
                        <table id="tableTamu" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama</th>
                                    <th>NO KTP</th>
                                    <th>Alamat</th>
                                    <th>NO WA</th>
                                    <th>Keperluan</th>
                                    <th>Bidang</th>
                                    <th>hari</th>
                                    <th>tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tamu as $data)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration}}
                                        </td>
                                        <td class="text-center">
                                            {{ $data->nama}}
                                        </td>
                                        <td class="text-center">
                                            {{ $data->no_ktp}}
                                        </td>
                                        <td class="text-center">
                                            {{ $data->alamat}}
                                        </td>
                                        <td class="text-center">
                                            {{ $data->no_wa}}
                                        </td>
                                        <td class="text-center">
                                            {{ $data->keperluan}}
                                        </td>
                                        <td class="text-center">
                                            {{ $data->bidang->name}}
                                        </td>
                                        <td class="text-center">
                                            {{ $data->hari}}
                                        </td>
                                        <td class="text-center">
                                            {{ $data->tanggal}}
                                        </td>
                                        <td class="text-center">
                                            {{ $data->jam_masuk}}
                                        </td>
                                        <td class="text-center">
                                            {{ $data->jam_keluar}}
                                        </td>
                                        <td>
                                            <a href="{{ route('tamu.edit', $data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('tamu.destroy', $data->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    


                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

     
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</x-app-layout>
