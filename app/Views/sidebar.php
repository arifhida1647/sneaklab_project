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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/summernote/summernote-bs4.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

</head>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url() ?>" class="brand-link">
        <span class="brand-text font-weight-light ms-3 text-xl text-bold">Sneakslab</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if (session()->get('role') == 'Admin' || (session()->get('role') == 'Owner')): ?>
                    <li class="nav-item">
                        <a href="/" class="nav-link <?= (service('uri')->getSegment(1) == '') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-house" style="color: #63E6BE;"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('role') == 'Admin' || (session()->get('role') == 'Owner')): ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('items') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'items') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-cart-shopping" style="color: #63E6BE;"></i>
                            <p>
                                Items
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?php echo base_url('users') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'users') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users" style="color: #63E6BE;"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <?php if (session()->get('role') == 'Admin' || (session()->get('role') == 'Owner')): ?>
                <li class="nav-item">
                    <a href="<?php echo base_url('orders') ?>"
                        class="nav-link <?= (service('uri')->getSegment(1) == 'orders') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-store" style="color: #63E6BE;"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (session()->get('role') == 'Operator' || (session()->get('role') == 'Owner')): ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('log') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'log') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-table-list" style="color: #63E6BE;"></i>
                            <p>
                                Log
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- <?php if (session()->get('role') == 'Admin' || (session()->get('role') == 'Owner')): ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('inbox') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'inbox') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-inbox" style="color: #63E6BE;"></i>
                            <p>
                                Inbox
                            </p>
                        </a>
                    </li>
                <?php endif; ?> -->
                <?php if (session()->get('role') == 'Operator' || (session()->get('role') == 'Owner')): ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'admin') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users" style="color: #63E6BE;"></i>
                            <p>
                                Admin
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?php echo base_url('logout') ?>"
                        class="nav-link <?= (service('uri')->getSegment(1) == 'logout') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-sign-out-alt" style="color: #63E6BE;"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<script src="https://kit.fontawesome.com/81847efb62.js" crossorigin="anonymous"></script>