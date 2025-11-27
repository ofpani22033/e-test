<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Test</title>
    <link rel="shortcut icon" href="image/logoutama.png">
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dataTables/DataTables/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/style.css">

    <style>
        /* Definisi Variabel Warna Utama */
        :root {
            --etest-primary-color: #0073b7; /* Biru Spesifik Anda */
            --etest-primary-dark: #00609b;  /* Biru gelap */
            --etest-light-bg: #f4f5f7; /* Background content wrapper */
        }
        
        /* =========================================== */
        /* 🚀 FIX LAYOUT (Space Samping & Cutting) */
        /* =========================================== */
        
        /* 1. FIX AGRESIF untuk Space Kosong Samping (Fixed Layout) */
        @media (min-width: 768px) {
            /* Layout Normal (Sidebar Terbuka 230px) */
            .fixed .content-wrapper,
            .fixed .right-side,
            .fixed .main-footer {
                margin-left: 120px !important; 
                left: 0 !important;
            }
            
            /* Layout Mini (Sidebar Tertutup 50px) */
            .fixed.sidebar-collapse .content-wrapper, 
            .fixed.sidebar-collapse .right-side,
            .fixed.sidebar-collapse .main-footer {
                margin-left: 50px !important; 
                left: 0 !important;
            }
        }

        /* 2. FIX Konten Terpotong dan Padding Vertikal */
        .content-wrapper {
            /* Mengembalikan sedikit padding atas untuk menghindari pemotongan box */
            padding-top: 30px !important; 
            background-color: var(--etest-light-bg); /* Background content wrapper */
            min-height: auto;
        }
        .content-header {
            /* Padding Content Header yang proporsional */
            padding: 10px 15px 10px 15px; 
        }

        /* =========================================== */
        /* 🎨 SKIN & MODERNISASI */
        /* =========================================== */
        
        /* Sidebar dan Header Utama */
        .skin-blue .main-header .navbar,
        .skin-blue .main-header .logo {
            background-color: var(--etest-primary-color);
        }
        .skin-blue .sidebar-menu > li.active > a,
        .skin-blue .sidebar-menu > li:hover > a,
        .skin-blue .sidebar-menu > li.menu-open > a {
            color: #ffffff;
            background: var(--etest-primary-dark);
        }
        .skin-blue .sidebar-menu > li.active {
            border-left-color: #fff;
        }

        /* Tombol dan Warna Utama */
        .btn-primary, .bg-blue,
        .box.box-primary > .box-header,
        .box.box-primary.box-solid > .box-header {
            background-color: var(--etest-primary-color) !important;
            border-color: var(--etest-primary-color) !important;
            color: #fff;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--etest-primary-dark) !important;
            border-color: var(--etest-primary-dark) !important;
        }

        /* Modernisasi Box (Card) */
        .box {
            border-radius: 8px; 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); /* Shadow sedikit lebih jelas */
            border-top: none; /* Hilangkan garis biru tebal di atas box default */
        }
        
        /* Box Solid Kustom */
        .box.box-primary.box-solid {
            border-top-color: var(--etest-primary-color) !important;
        }
        .box.box-primary.box-solid > .box-body {
            background-color: #f0f8ff; /* Biru muda lembut untuk body solid box */
        }

        /* Form dan Input */
        .form-control, .btn {
            border-radius: 6px;
        }
        
        /* Dropdown User Menu Fix (dari topbar.php) */
        .user-image {
            border-radius: 50%; 
        }
        .user-footer .btn-danger {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }
        .user-footer .btn-default {
            background-color: #f8f9fa !important;
            border-color: #f8f9fa !important;
            color: #333 !important;
        }
        
    </style>
    
    </head>