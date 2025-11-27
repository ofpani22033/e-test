<aside class="main-sidebar">
    <section class="sidebar">
        
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('image/logologin.png') ?>" class="img-circle" alt="Foto Profil">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('nama'); ?></p>
                <small class="text-muted">
                    <?php 
                        $status = $this->session->userdata('status');
                        if ($status == 'admin_login') {
                            echo "Administrator";
                        } else if ($status == 'guru_login') {
                            echo "Guru Penguji";
                        } else {
                            echo "Pengguna";
                        }
                    ?>
                </small>
                <a href="#" style="display: block;"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            
            <li class="header">NAVIGASI UTAMA</li> 
            
            <li <?= $this->uri->segment(1) == 'home' ? 'class="active"' : '' ?>>
                <a href="<?php echo base_url('home'); ?>">
                    <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php if ($this->session->userdata('status') == 'admin_login') { ?>
                <li class="header">MANAJEMEN DATA</li>
            
                <li <?= $this->uri->segment(1) == 'guru' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url('guru'); ?>">
                        <i class="fa fa-users"></i> <span>Data Guru</span>
                    </a>
                </li>
                
                <li <?= $this->uri->segment(1) == 'siswa' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url('siswa'); ?>">
                        <i class="fa fa-graduation-cap"></i> <span>Data Siswa</span>
                    </a>
                </li>
                
                <li class="header">MANAJEMEN UJIAN</li>
                
                <li <?= $this->uri->segment(1) == 'soal_ujian' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url('soal_ujian'); ?>">
                        <i class="fa fa-book"></i> <span>Kelola Soal Ujian</span>
                    </a>
                </li>
                
                <li <?= $this->uri->segment(1) == 'peserta' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url('peserta'); ?>">
                        <i class="fa fa-list-alt"></i> <span>Kelola Peserta Ujian</span>
                    </a>
                </li>
                
                <li <?= $this->uri->segment(1) == 'hasil_ujian' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url('hasil_ujian'); ?>">
                        <i class="fa fa-bar-chart"></i> <span>Laporan Hasil Ujian</span>
                    </a>
                </li>
                
            <?php } else if ($this->session->userdata('status') == 'guru_login') { ?>
                <li class="header">MENU GURU</li>

                <li <?= $this->uri->segment(1) == 'soal_ujian' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url('soal_ujian'); ?>">
                        <i class="fa fa-pencil-square-o"></i> <span>Kelola Soal Ujian</span>
                    </a>
                </li>

                <li <?= $this->uri->segment(1) == 'hasil_ujian' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url('hasil_ujian'); ?>">
                        <i class="fa fa-trophy"></i> <span>Hasil Ujian Siswa</span>
                    </a>
                </li>
            <?php } ?>
            
            <li class="header">AKUN</li>

            <li <?= $this->uri->segment(1) == 'password' ? 'class="active"' : '' ?>>
                <a href="<?php echo base_url('password'); ?>">
                    <i class="fa fa-lock"></i> <span>Ganti Password</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('logout'); ?>">
                    <i class="fa fa-sign-out"></i> <span>Keluar Akun</span>
                </a>
            </li>


        </ul>
    </section>
</aside>

<div class="content-wrapper">