<aside class="main-sidebar bg-success elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-white">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BUKU TAMU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                @php
                    $user = Auth::user();
                    $isAdmin = optional($user)->is_admin;
                @endphp
                <a href="#" class="d-block text-white">
                    {{ $isAdmin ? 'ADMIN' : 'TAMU' }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-widget="treeview" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Data Tamu -->
                <li class="nav-item">
                    <a href="{{ route('tamu.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data Tamu</p>
                    </a>
                </li>

                <!-- Data Profil -->
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>Data Profil</p>
                    </a>
                </li>

                <!-- Data User (Hanya Admin) -->
                @if ($isAdmin)
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Data User</p>
                    </a>
                </li>
                @endif

                <!-- Logout -->
                <li class="nav-item">
                    <a href="javascript:;" onclick="logout()" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Script logout -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<script>
    function logout() {
        if (confirm('Yakin ingin keluar?')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>
