<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('homepage') }}">
        <div class="sidebar-brand-icon">
            <i><img src="{{ asset('backend') }}/img/logo.png" alt="logo"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SPK Moora</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.car_types.index') }}">
            <i class="fas fa-car-side"></i>
            <span>Jenis Mobil</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.car_brands.index') }}">
            <i class="fas fa-folder"></i>
            <span>Merek Mobil</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('mobil.index') }}">
            <i class="fas fa-car"></i>
            <span>Mobil Bekas</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('kriteria.index') }}">
            <i class="fas fa-chart-bar"></i>
            <span>Kriteria</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('alternatif.index') }}">
            <i class="fas fa-th-large"></i>
            <span>Alternatif</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Proses Perhitungan
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('hitung') }}">
            <i class="fas fa-calculator"></i>
            <span>Hitung</span></a>
    </li>

    <!-- Menu Manage User (Hanya untuk Admin) -->
    @auth
    @if(auth()->user()->is_admin == 1)
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Manajemen Pengguna
        </div>

        <!-- Menu Manage User -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.user.index') }}">
                <i class="fas fa-users"></i>
                <span>Data User</span></a>
        </li>
    @endif
    @endauth

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
