<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('login') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.jpeg') }}" alt="logo" width="40" height="40" class="img-fluid">
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
        <a class="nav-link" href="{{ route('admin.transmission_type.index') }}">
            <i class="fas fa-cogs"></i>
            <span>Tipe Transmisi</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.fuel_type.index') }}">
            <i class="fas fa-gas-pump"></i>
            <span>Bahan Bakar</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.car_type.index') }}">
            <i class="fas fa-truck-pickup"></i>
            <span>Jenis Mobil</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.car_brand.index') }}">
            <i class="fas fa-warehouse"></i>
            <span>Merek Mobil</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('car.index') }}">
            <i class="fas fa-car"></i>
            <span>Mobil Bekas</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Penunjang Keputusan
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('criteria.index') }}">
            <i class="fas fa-chart-bar"></i>
            <span>Kriteria</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('alternative.index') }}">
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
        <a class="nav-link" href="{{ route('calculation') }}">
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
