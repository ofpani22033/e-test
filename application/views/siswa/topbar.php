<style>
.user-image {
    width: 30px !important;   /* ukuran boleh disesuaikan */
    height: 30px !important;  /* harus sama dengan width */
    object-fit: cover !important;
}
.main-header .navbar {
    background-color: #0073b7 !important;
}

.main-header .logo {
    background-color: #0073b7 !important;
}

.main-header .logo:hover {
    background-color: #0073b7 !important;
}

/* Mengatur warna hover untuk tombol Sidebar Toggle */
.main-header .navbar .sidebar-toggle:hover {
    /* Memberikan kontras dengan warna sedikit lebih gelap dari #0073b7 */
    background-color: #005a8b;
}
</style>
</head>
<body class=" skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <img src="<?= base_url('image/logoutama.png') ?>" alt="E-Test" style="height: 25px;">
        </span>
      <span class="logo-lg"><b>E-Test</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url('image/profil.png')?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Halo, <?php echo $this->session->userdata('nama');?></span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>