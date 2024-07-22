<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <style>
        .container {
            max-width: 1000px;
            margin-top: 20px;
        }
    </style>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="<?php echo base_url('assets') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

</head>
<nav class="main-header navbar navbar-expand navbar-white navbar-dark" style="background-color: #173B45">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar main-sidebar-custom elevation-4" style="background-color: #173B45">
    <!-- Brand Logo -->
    <div class="user-panel mt-2 mb-2 d-flex align-items-center justify-content-center">
        <div class="image">
            <img src="https://img.freepik.com/premium-vector/flat-store-facade-with-awning_23-2147542588.jpg?w=740"
                class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <p class="brand-text font-weight-light text-lg text-bold text-white pt-3">Toko Sembako Leon</p>
        </div>

    </div>
    <div class="user-panel mt-2 mb-2 d-flex align-items-center justify-content-center">
        <div class="image">
            <img src="https://img.freepik.com/premium-vector/user-profile-icon-flat-style-member-avatar-vector-illustration-isolated-background-human-permission-sign-business-concept_157943-15752.jpg?w=740"
                class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <p class="brand-text font-weight-light text-lg text-bold text-white pt-3"><?= session()->get('role') ?></p>
        </div>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if ((session()->get('role') == 'Owner') || session()->get('role') == 'Admin'): ?>
                    <li class="nav-item">
                        <a href="/" class="nav-link <?= (service('uri')->getSegment(1) == '') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-house" style="color: #FF8225;"></i>
                            <p class="text-white">
                                Dashboard
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ((session()->get('role') == 'Owner') || session()->get('role') == 'Owner'): ?>
                    <li class="nav-item">
                        <a href=""
                            class="nav-link <?= (service('uri')->getSegment(1) == 'items' || service('uri')->getSegment(1) == 'stokin' || service('uri')->getSegment(1) == 'stokout' ||
                                service('uri')->getSegment(1) == 'unit' || service('uri')->getSegment(1) == 'kategori') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-table-list" style="color: #FF8225;"></i>
                            <p class="text-white">
                                Items
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3 ">
                            <li class="nav-item">
                                <a href="<?php echo base_url('items') ?>"
                                    class="nav-link <?= (service('uri')->getSegment(1) == 'items') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-table-list" style="color: #FF8225;"></i>
                                    <p class="text-white">Items</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('stokin') ?>"
                                    class="nav-link <?= (service('uri')->getSegment(1) == 'stokin') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-table-list" style="color: #FF8225;"></i>
                                    <p class="text-white">
                                        Stok In
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('stokout') ?>"
                                    class="nav-link <?= (service('uri')->getSegment(1) == 'stokout') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-table-list" style="color: #FF8225;"></i>
                                    <p class="text-white">
                                        Stok Out
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('unit') ?>"
                                    class="nav-link <?= (service('uri')->getSegment(1) == 'unit') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-table-list" style="color: #FF8225;"></i>
                                    <p class="text-white">
                                        Unit
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('kategori') ?>"
                                    class="nav-link <?= (service('uri')->getSegment(1) == 'kategori') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-table-list" style="color: #FF8225;"></i>
                                    <p class="text-white">
                                        Kategori
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if ((session()->get('role') == 'Owner' || session()->get('role') == 'Kasir' || session()->get('role') == 'Admin')): ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('pelanggan') ?>"
                            class="nav-link <?= (service('uri')->getSegment(1) == 'pelanggan') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users" style="color: #FF8225;"></i>
                            <p class="text-white">
                                Pelanggan
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ((session()->get('role') == 'Owner')): ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin') ?>"
                            class="nav-link <?= (service('uri')->getSegment(1) == 'admin') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users" style="color: #FF8225;"></i>
                            <p class="text-white">
                                Admin
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('role') == 'Kasir' || (session()->get('role') == 'Owner')): ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('keranjang') ?>"
                            class="nav-link <?= (service('uri')->getSegment(1) == 'keranjang') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-cart-shopping" style="color: #FF8225;"></i>
                            <p class="text-white">
                                Orders
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ((session()->get('role') == 'Owner') || session()->get('role') == 'Kasir'): ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('invoice') ?>"
                            class="nav-link <?= (service('uri')->getSegment(1) == 'invoice') ? 'active' : '' ?>">
                            <i class="nav-icon fa-solid fa-file-invoice" style="color: #FF8225;"></i>
                            <p class="text-white">
                                Invoice
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?php echo base_url('logout') ?>"
                        class="nav-link <?= (service('uri')->getSegment(1) == 'logout') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-sign-out-alt" style="color: #FF8225;"></i>
                        <p class="text-white">
                            Logout
                        </p>
                    </a>
                </li>
        </nav>
    </div>
</aside>
<script src="https://kit.fontawesome.com/81847efb62.js" crossorigin="anonymous"></script>