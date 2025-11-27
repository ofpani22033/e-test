<style>
/* CSS Kustom untuk Menu Sidebar Aktif Siswa */
.sidebar-menu li.active > a {
    /* Mengubah warna latar belakang item menu yang aktif */
    background-color: #0073b7 !important; 
    /* Memastikan teks dan icon tetap putih agar terbaca */
    color: #fff !important; 
}

/* Kustomisasi saat di-hover pada menu yang aktif */
.sidebar-menu li.active > a:hover {
    background-color: #006aa8 !important; /* Sedikit lebih gelap saat di-hover */
    color: #fff !important;
}

/* Memastikan warna ikon juga ikut berubah menjadi putih */
.sidebar-menu li.active > a > .fa {
    color: #fff !important;
}
</style>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=base_url('image/logologin.png')?>" class="img-circle" alt="Foto Profil">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('nama');?></p>
                <small class="text-muted">Siswa/Peserta Ujian</small> 
                <a href="#" style="display: block;"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <ul class="sidebar-menu" data-widget="tree">
            
            <li class="header">NAVIGASI UTAMA</li> 
            
            <li <?= $this->uri->segment(1) == 'home_siswa' ? 'class="active"' : ''?>>
                <a href="<?php echo base_url('home_siswa');?>">
                    <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="header">UJIAN & HASIL</li>

            <li <?= $this->uri->segment(1) == 'jadwal_ujian' || $this->uri->segment(1) == 'ujian' ? 'class="active"' : ''?>>
                <a href="<?php echo base_url('jadwal_ujian');?>">
                    <i class="fa fa-list-alt"></i> <span>Daftar Ujian</span>
                </a>
            </li>

            <li <?= $this->uri->segment(1) == 'ruang_hasil' ? 'class="active"' : ''?>>
                <a href="<?php echo base_url('ruang_hasil');?>">
                    <i class="fa fa-trophy"></i> <span>Hasil Ujian Saya</span>
                </a>
            </li>
            
            <li class="header">AKUN</li>

            <li <?= $this->uri->segment(1) == 'password' ? 'class="active"' : ''?>>
                <a href="<?php echo base_url('password');?>">
                    <i class="fa fa-lock"></i> <span>Ganti Password</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('logout');?>">
                    <i class="fa fa-sign-out"></i> <span>Keluar Akun</span>
                </a>
            </li>

        </ul>
    </section>
    </aside>

<div class="content-wrapper">