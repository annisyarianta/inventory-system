<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion position-fixed" style = "overflow-x: auto;"
    id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img class="img-fluid" style="max-width: 35px;" src="../../assets/img/ap2-bulet-tok.png" alt="" />
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
            Kelola ATK
        </div>

        <!-- Nav Item - Barang Masuk -->
        <li class="nav-item">
            <a class="nav-link" href="/atkmasuk">
                <i class="fas fa-fw fa-download"></i>
                <span>ATK Masuk</span></a>
        </li>

        <!-- Nav Item - Barang Keluar -->
        <li class="nav-item">
            <a class="nav-link" href="/atkkeluar">
                <i class="fas fa-fw fa-upload"></i>
                <span>ATK Keluar</span></a>
        </li>
    @endcan


    <!-- Nav Item - Daftar Barang -->
    <li class="nav-item">
        <a class="nav-link" href="/daftar">
            <i class="fas fa-fw fa-archive"></i>
            <span>Daftar ATK</span></a>
    </li>

    @can('staff')
        <!-- Nav Item - Request -->
        <li class="nav-item">
            <a class="nav-link" href="/requests">
                <i class="fas fa-fw fa-eject"></i>
                <span>Request ATK</span></a>
        </li>
    @endcan

    @can('admin')
        <!-- Nav Item - Validate -->
        <li class="nav-item">
            <a class="nav-link" href="/validations">
                <i class="fas fa-fw fa-clipboard-check"></i>
                <span>Validasi ATK</span></a>
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
                    <a class="collapse-item" href="/masteratk">Data ATK</a>
                    <a class="collapse-item" href="/unit">Data Unit</a>
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

        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Logs
        </div>

        <!-- Nav Item - Daftar User -->
        <li class="nav-item">
            <a class="nav-link" href="/log_login">
                <i class="fas fa-fw fa-print"></i>
                <span>Log Login</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/log_activity">
                <i class="fas fa-fw fa-print"></i>
                <span>Log Activity</span></a>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
