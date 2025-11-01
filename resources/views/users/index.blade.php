<x-app-layout>
    <!-- Content Header (Page header) -->
    <section class="content-header bg-gradient-white mb-3">
        <div class="container-fluid">
            <div class="row mb-0">
                <div class="col-sm-6">
                    <h1>Data Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pengguna</li>
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
                            <p class="float-left mb-0 pt-1 font-weight-bold">Daftar Pengguna</p>
                            <a href="{{ route('users.create') }}" class="btn btn-light btn-sm float-right">
                                <i class="fas fa-plus mr-1"></i> Pengguna Baru
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped usersTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Dibuat Pada</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $user->roles()->first()->name == 'Admin' ? 'bg-primary' : 'bg-warning' }}">
                                                    {{ $user->roles()->first()->name }}
                                                </span>
                                            </td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-sm btn-primary mr-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('users.destroy', $user->id) }}"
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
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
