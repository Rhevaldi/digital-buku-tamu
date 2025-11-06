<x-app-layout>
    @php
        $user = Auth::user();
    @endphp

    {{-- ====================== DASHBOARD ADMIN ====================== --}}
   @role('Admin')
<link rel="stylesheet" href="{{ asset('assets/css/dashboard-admin.css') }}">

<div class="dashboard-admin">
    <div class="overlay"></div>
    <div class="dashboard-content text-center text-white">
        <h1 class="fw-bold mb-3">📘 Buku Tamu Digital</h1>
        <p class="lead mb-5">
            Selamat datang, <strong>Admin Dinas!</strong><br>
            Berikut adalah ringkasan sistem Buku Tamu Digital.
        </p>

        <!-- === Statistik Ringkas === -->
        <div class="stat-row">
            <div class="stat-card">
                <h2>{{ $totalUser ?? 0 }}</h2>
                <p>Total Pengguna</p>
            </div>
            <div class="stat-card">
                <h2>{{ $tamuHariIni ?? 0 }}</h2>
                <p>Tamu Hari Ini</p>
            </div>
        </div>

        <!-- === Menu Navigasi === -->
        <div class="menu-row mt-4">
            <div class="menu-card">
                <h3>📄 Data Tamu</h3>
                <p>Lihat, tambah, atau kelola data tamu.</p>
                <a href="{{ route('tamu.index') }}" class="btn btn-light btn-sm fw-semibold mt-2">
                    Kelola Tamu
                </a>
            </div>

            <div class="menu-card">
                <h3>👤 Profil Saya</h3>
                <p>Edit data akun, email, password, dan lainnya.</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-light btn-sm fw-semibold mt-2">
                    Edit Profil
                </a>
            </div>

            <div class="menu-card">
                <h3>📊 Statistik</h3>
                <p>Lihat statistik pengunjung harian, mingguan, dll.</p>
                <button class="btn btn-light btn-sm fw-semibold mt-2" disabled>Segera Hadir</button>
            </div>
        </div>
    </div>
</div>
@endrole

    {{-- ====================== DASHBOARD TAMU ====================== --}}
    @role('Tamu')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard-tamu.css') }}">

        <div class="dashboard-tamu">
            <div class="overlay"></div>
            <div class="dashboard-content text-center text-white">
                <h1 class="fw-bold mb-3">📘 Buku Tamu Digital</h1>
                <p class="lead mb-4">
                    Selamat datang, <strong>{{ $user->name ?? 'Tamu Umum' }}</strong>
                </p>
                <a href="{{ route('tamu.create') }}" class="btn btn-light btn-lg shadow-sm rounded-pill px-4">
                    Isi Buku Tamu
                </a>
            </div>
        </div>
    @endrole
</x-app-layout>
