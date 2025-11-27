<?php
// 1. MEMUAT TEMPLATE HEADER
$this->load->view('admin/head');
?>

<style>
    /* Mengambil style dari list guru: Judul Box diubah ke kiri */
    .box.box-primary {
        border-top: none !important; 
        border-radius: 8px; 
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); 
    }
    
    .box.box-primary > .box-header {
        background-color: #ffffff !important;
        color: #0073b7 !important;
        border-bottom: 2px solid #0073b7 !important;
        padding-bottom: 15px;
    }

    /* Mengubah h3 box-title agar tidak di tengah */
    .box-header h3 {
        margin: 5px 0;
        font-weight: bold;
        text-align: left !important; /* Diratakan kiri */
        font-size: 20px;
    }

    .btn-custom-blue {
        background-color: #0073b7 !important;
        color: white !important;
        border-color: #006aa8 !important;
        border-radius: 4px; /* Sudut membulat */
    }

    .btn-custom-blue:hover {
        background-color: #005f96 !important;
        border-color: #005f96 !important;
    }
</style>

<?php
// 2. MEMUAT TEMPLATE TOPBAR & SIDEBAR
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<section class="content-header">
    <h1>
        Tambah Data Guru
        <small>Menambah data Guru</small>
    </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Formulir Tambah Data Guru</h3>
            </div>
            
            <form action="<?= base_url('guru/create'); ?>" method="post" class="form-horizontal">
                <div class="box-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Guru</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value="<?= set_value('nama'); ?>">
                            <small class="text-danger"><?php echo form_error('nama'); ?></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nik" value="<?= set_value('nik'); ?>">
                            <small class="text-danger"><?php echo form_error('nik'); ?></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" value="<?= set_value('username'); ?>">
                            <small class="text-danger"><?php echo form_error('username'); ?></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password">
                            <small class="text-danger"><?php echo form_error('password'); ?></small>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <a href="<?= base_url('guru'); ?>" class="btn btn-default btn-flat">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-custom-blue btn-flat pull-right">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
                </form>

        </div>
        </div>
  </div>
</section>
<?php
// 4. MEMUAT TEMPLATE JS & FOOTER
$this->load->view('admin/js');
$this->load->view('admin/foot');
?>