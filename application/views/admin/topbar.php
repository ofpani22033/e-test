<style>
/* Style tambahan untuk memastikan gambar profil bulat dan rapi */
.user-image {
    width: 30px !important; 
    height: 30px !important; 
    object-fit: cover !important;
    border-radius: 50%; /* Membuat gambar profil menjadi bulat sempurna */
}

/* Style kustom untuk User Menu di Header (menggunakan warna brand) */
.main-header .navbar-custom-menu .dropdown-toggle {
    transition: background-color 0.3s;
}

/* Menyesuaikan warna hover agar tidak terlalu kontras jika sidebar dilipat */
.main-header .navbar-custom-menu .dropdown-toggle:hover {
    background: rgba(0, 0, 0, 0.1); /* Background transparan ringan saat di-hover */
}

/* Penyesuaian agar teks "E-Test" terlihat jelas di Logo */
.main-header .logo .logo-lg b {
    font-weight: 700;
}

/* Fix: Memastikan tombol Logout menggunakan warna Danger (Merah) yang standar */
.user-footer .btn-danger {
    background-color: #dc3545 !important;
    border-color: #dc3545 !important;
}
.user-footer .btn-danger:hover {
    background-color: #c82333 !important;
    border-color: #c82333 !important;
}

/* Fix: Mengganti warna default tombol 'Ganti Password' agar tidak terlihat seperti primary button */
.user-footer .btn-default {
    background-color: #f8f9fa !important;
    border-color: #f8f9fa !important;
    color: #333 !important;
}
</style>
</head>
<body class="skin-blue sidebar-mini fixed">
<div class="wrapper">

    <header class="main-header">
        <a href="<?php echo base_url('home'); ?>" class="logo">
            <span class="logo-mini">
                <img src="<?= base_url('image/logoutama.png') ?>" alt="E-Test" style="height: 25px;">
            </span>
            <span class="logo-lg"><b>E-Test</b></span>
        </a>
        
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= base_url('image/adm.png') ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
                        </a>
                        
                        <ul class="dropdown-menu">
                            <li class="user-header" style="background-color: #0073b7;">
                                <img src="<?= base_url('image/adm.png') ?>" class="img-circle" alt="User Image">
                                <p>
                                    <?php echo $this->session->userdata('nama'); ?>
                                    <small>
                                        <?php 
                                            $status = $this->session->userdata('status');
                                            if ($status == 'admin_login') {
                                                echo "Administrator E-Test";
                                            } else if ($status == 'guru_login') {
                                                echo "Guru Penguji";
                                            }
                                        ?>
                                    </small>
                                </p>
                            </li>
                            
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo base_url('password'); ?>" class="btn btn-default btn-flat"><i class="fa fa-lock"></i> Ganti Password</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo base_url('logout'); ?>" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Keluar</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </header>

<div class="content-wrapper">