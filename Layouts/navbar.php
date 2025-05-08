<?php
$activeUrl = $_GET['url'] ?? ''; // Get the current URL parameter or default to 'home'
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Rental</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class -->
                <li class="nav-header">LIST DATA</li>
                <li class="nav-item">
                    <a href="./?url=pembayaran" class="nav-link <?php echo $activeUrl === 'pembayaran' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-money-check-alt"></i> <!-- Icon for Pembayaran -->
                        <p>Pembayaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?url=peminjaman" class="nav-link <?php echo $activeUrl === 'peminjaman' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-procedures"></i> <!-- Icon for Peminjaman -->
                        <p>Peminjaman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?url=armada" class="nav-link <?php echo $activeUrl === 'armada' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-car"></i> <!-- Icon for Armada -->
                        <p>Armada</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?url=jeniskendaraan" class="nav-link <?php echo $activeUrl === 'jeniskendaraan' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-list-alt"></i> <!-- Icon for Jenis Kendaraan -->
                        <p>Jenis Kendaraan</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>