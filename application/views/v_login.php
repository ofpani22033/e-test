<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Test - Login</title>
    <link rel="shortcut icon" href="image/logoutama.png">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        /* Warna Utama */
        :root {
            --primary-color: #4d4a9e; /* Warna ungu E-Test */
        }

        /* Styling Body - Menggunakan Background Image Anda */
        body {
            /* PENGATURAN BACKGROUND ASLI ANDA */
            background-image:url(image/baground.jpg); 
            background-size:cover; 
            background-attachment: fixed;
            
            /* Penengahan konten tetap dipertahankan */
            display: flex; 
            justify-content: center;
            align-items: center;
            min-height: 100vh; 
            margin: 0;
            padding: 20px;
            font-family: 'Source Sans Pro', sans-serif;
            
            /* Menambahkan lapisan gelap (overlay) tipis agar kotak login lebih menonjol */
            position: relative;
        }
        
        /* OVERLAY (Tambahan opsional agar kotak login lebih mudah dibaca) */
        /* Anda bisa menghapus bagian ini jika dirasa background image sudah cukup jelas */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.1); /* Lapisan hitam transparan 10% */
            z-index: -1; 
        }


        /* Styling Kotak Login */
        .login-box {
            width: 100%;
            max-width: 400px; 
            margin: 0; 
            z-index: 10; /* Pastikan kotak login di atas overlay */
        }

        .login-box-body {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px; /* Sudut melengkung */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); /* Shadow yang sedikit lebih kuat karena background gelap */
            transition: all 0.3s ease;
        }
        
        .login-box-body:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        /* Styling Logo/Header */
        .login-logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-logo img {
            width: 80px; 
            height: auto;
            margin-bottom: 10px;
        }

        .login-logo a {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            text-decoration: none;
            display: block; 
        }
        
        .login-logo p {
            font-size: 14px; 
            color: #777; 
            margin-top: 5px;
        }
        
        /* Styling Input Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 8px; 
            height: 45px;
            border: 1px solid #dcdcdc;
            padding-left: 15px;
        }

        .form-control-feedback {
            line-height: 45px;
            width: 45px;
            height: 45px;
            pointer-events: none; 
            color: var(--primary-color); 
        }

        /* Styling Tombol Login */
        .btn-success {
            background-color: var(--primary-color) !important; 
            border-color: var(--primary-color) !important;
            border-radius: 8px;
            font-weight: 600;
            height: 45px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        
        .btn-success:hover, .btn-success:focus {
            background-color: #3a3885 !important; 
            border-color: #3a3885 !important;
            box-shadow: 0 4px 10px rgba(77, 74, 158, 0.4); 
        }
        
        .btn-block {
            width: 100%;
        }

        /* Styling Footer */
        .copyright {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            color: #888;
            font-size: 12px;
            text-align: center;
        }
        
        .copyright a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        /* Styling Pesan Error/Flashdata */
        .text-danger {
            font-size: 12px;
        }
        
        .alert {
            border-radius: 8px;
        }
        
    </style>
</head>

<body style="background-image:url(image/baground.jpg); background-size:cover; background-attachment: fixed;">
    <div class="login-box">
        <div class="login-box-body">

            <div class="login-logo">
                <img src="image/logologin.png" alt="E-Test Logo"><br>
                <a href="#">E-Test</a>
                <p style="font-size: 14px; color: #777; margin-top: 5px;">Sistem Ujian Berbasis Komputer</p>
            </div><?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-danger alert-dismissible alert-message" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?= $this->session->flashdata('message'); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo base_url('auth') ?>" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username Anda" name="username" value="<?= set_value('username'); ?>" autocomplete="off">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Kata Sandi Anda" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fa fa-sign-in"></i> Masuk Sekarang
                        </button>
                    </div></div>
            </form>
            
            <div class="copyright">
                Copyright &#169; <script type='text/javascript'>var creditsyear = new Date();document.write(creditsyear.getFullYear());</script> E-Test. All rights reserved.
            </div>
            
        </div></div><script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        // Skrip untuk menghilangkan alert secara otomatis
        $(document).ready(function() {
            $('.alert-message').delay(4000).slideUp('slow');
        });
    </script>
</body>
</html>