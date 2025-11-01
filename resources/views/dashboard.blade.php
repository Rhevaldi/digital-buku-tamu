<x-app-layout>
    @php
        $user = Auth::user();
    @endphp

    <div class="container py-4">
        @role('Admin')
            {{-- ====================== DASHBOARD ADMIN ====================== --}}
            <div class="text-center mb-4">
                <h1 class="h3 text-primary font-weight-bold">📘 Buku Tamu Digital</h1>
                <p class="text-muted">Selamat datang, <strong>Admin</strong>! Berikut adalah ringkasan sistem Buku Tamu
                    Digital.</p>
            </div>

            <div class="row justify-content-center mb-4">
                <!-- Total Pengguna -->
                <div class="col-md-3">
                    <div class="card shadow border-left-warning">
                        <div class="card-body text-center">
                            <h2 class="text-warning">{{ $totalUser ?? 0 }}</h2>
                            <p class="mb-2 font-weight-bold">Total Pengguna</p>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-users"></i> Kelola Pengguna
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Tamu Hari Ini -->
                <div class="col-md-3">
                    <div class="card shadow border-left-danger">
                        <div class="card-body text-center">
                            <h2 class="text-danger">{{ $tamuHariIni ?? 0 }}</h2>
                            <p class="mb-2 font-weight-bold">Total Tamu Hari Ini</p>
                            <a href="{{ route('tamu.index') }}" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-user-check"></i> Detail Tamu
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Navigasi -->
            <div class="row justify-content-center">
                <!-- Data Tamu -->
                <div class="col-md-3 mb-3">
                    <div class="card bg-secondary text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">📄 Data Tamu</h5>
                            <br>
                            <p>Lihat, tambah, atau kelola data tamu.</p>
                            <a href="{{ route('tamu.index') }}" class="btn btn-light btn-sm">Kelola Tamu</a>
                        </div>
                    </div>
                </div>

                <!-- Profil Saya -->
                <div class="col-md-3 mb-3">
                    <div class="card bg-dark text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">👤 Profil Saya</h5>
                            <br>
                            <p>Edit data akun, email, password, dll.</p>
                            <a href="{{ route('profile.edit') }}" class="btn btn-light btn-sm">Edit Profil</a>
                        </div>
                    </div>
                </div>

                <!-- Statistik -->
                <div class="col-md-3 mb-3">
                    <div class="card bg-info text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">📊 Statistik</h5>
                            <br>
                            <p>Lihat statistik pengunjung harian, mingguan, dll.</p>
                            <button class="btn btn-light btn-sm" disabled>Segera Hadir</button>
                        </div>
                    </div>
                </div>
            </div>
        @endrole
        @role('Tamu')
            {{-- ====================== DASHBOARD USER BIASA ====================== --}}
            <div class="text-center">
                <h1 class="h3 text-primary font-weight-bold">📘 Buku Tamu Digital</h1>
                <p class="text-muted">Selamat datang, {{ $user->name ?? 'Tamu' }}!</p>
            </div>
        @endrole
    </div>
</x-app-layout>
