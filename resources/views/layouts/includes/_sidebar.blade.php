<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img class="img-fluid" style="max-width: 35px" src="../../assets/img/ap2-bulet-tok.png" alt="" />
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size: 1rem">
            <img class="img-fluid" style="max-width: 140px" src="../../assets/img/AP2-white.png" alt="" />
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    @can('admin')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/dashboardatk">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Kelola Barang
    </div>

    <!-- Nav Item - Barang Masuk -->
    <li class="nav-item">
        <a class="nav-link" href="/masukga">
            <i class="fas fa-fw fa-download"></i>
            <span>Barang Masuk</span></a>
    </li>

    <!-- Nav Item - Barang Keluar -->
    <li class="nav-item">
        <a class="nav-link" href="/keluarga">
            <i class="fas fa-fw fa-upload"></i>
            <span>Barang Keluar</span></a>
    </li>
    @endcan

    
    <!-- Nav Item - Daftar Barang -->
    <li class="nav-item">
        <a class="nav-link" href="/daftar">
            <i class="fas fa-fw fa-archive"></i>
            <span>Daftar Barang</span></a>
    </li>

    @can('staff')
    <!-- Nav Item - Request -->
    <li class="nav-item">
        <a class="nav-link" href="/requests">
            <i class="fas fa-fw fa-eject"></i>
            <span>Request Barang</span></a>
    </li>
    @endcan

    @can('admin')
    <!-- Nav Item - Validate -->
    <li class="nav-item">
        <a class="nav-link" href="/validations">
            <i class="fas fa-fw fa-clipboard-check"></i>
            <span>Validasi Barang</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-table"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/barangga">Barang</a>
                <a class="collapse-item" href="/unit">Unit</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Reports
    </div>

    <!-- Nav Item - Cetak Laporan -->
    <li class="nav-item">
        <a class="nav-link" href="/laporan">
            <i class="fas fa-fw fa-print"></i>
            <span>Cetak Laporan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>

    <!-- Nav Item - Daftar User -->
    <li class="nav-item">
        <a class="nav-link" href="/users">
            <i class="fas fa-fw fa-users"></i>
            <span>User Management</span></a>
    </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
