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
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @auth
        @can('admin')
            <!-- Data Master (Dropdown) -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataMaster"
                    aria-expanded="false" aria-controls="dataMaster">
                    <i class="fas fa-database"></i>
                    <span>Data Master</span>
                </a>
                <div id="dataMaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.transmission_type.index') }}">
                            <i class="fas fa-cogs"></i> Tipe Transmisi
                        </a>
                        <a class="collapse-item" href="{{ route('admin.fuel_type.index') }}">
                            <i class="fas fa-gas-pump"></i> Bahan Bakar
                        </a>
                        <a class="collapse-item" href="{{ route('admin.car_type.index') }}">
                            <i class="fas fa-truck-pickup"></i> Jenis Mobil
                        </a>
                        <a class="collapse-item" href="{{ route('admin.car_brand.index') }}">
                            <i class="fas fa-warehouse"></i> Merek Mobil
                        </a>
                    </div>
                </div>
            </li>
        @endcan
    @endauth

    <!-- Mobil -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('car.index') }}">
            <i class="fas fa-car"></i>
            <span>Mobil Bekas</span>
        </a>
    </li>

    <!-- Perbandingan Mobil -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('car.compare.form') }}">
            <i class="fas fa-balance-scale"></i>
            <span>Perbandingan Mobil</span>
        </a>
    </li>

    <!-- Rekomendasi Mobil (Dropdown) -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataPenunjang"
            aria-expanded="false" aria-controls="dataPenunjang">
            <i class="fas fa-bullseye"></i>
            <span>Rekomendasi Mobil</span>
        </a>
        <div id="dataPenunjang" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('criteria.index') }}">
                    <i class="fas fa-list"></i> Kriteria
                </a>
                <a class="collapse-item" href="{{ route('subcriteria.index') }}">
                    <i class="fas fa-stream"></i> Sub Kriteria
                </a>                
                <a class="collapse-item" href="{{ route('alternative.index') }}">
                    <i class="fas fa-th"></i> Alternatif
                </a>
            </div>
        </div>
    </li>

    <!-- Proses Perhitungan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('calculation') }}">
            <i class="fas fa-calculator"></i>
            <span>Hitung</span>
        </a>
    </li>

    <!-- Manajemen Pengguna (Dropdown untuk Admin) -->
    @can('admin')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userManagement"
                aria-expanded="false" aria-controls="userManagement">
                <i class="fas fa-users"></i>
                <span>Manajemen Pengguna</span>
            </a>
            <div id="userManagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.user.index') }}">
                        <i class="fas fa-user"></i> Data User
                    </a>
                </div>
            </div>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
