<?php
// 1. MEMUAT TEMPLATE HEADER
$this->load->view('admin/head');
?>

<style>
    /* ==================================== */
    /* STYLING KOTAK DATA & HEADER DARI LIST GURU */
    /* ==================================== */
    .box.box-primary {
        /* Menghilangkan garis atas default, ganti dengan shadow dan sudut membulat */
        border-top: none !important; 
        border-radius: 8px; 
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); 
    }
    
    .box.box-primary > .box-header {
        /* Warna background dan border bawah seperti di list */
        background-color: #ffffff !important;
        color: #0073b7 !important;
        border-bottom: 2px solid #0073b7 !important;
        padding-bottom: 15px;
    }

    /* Mengubah h3 box-title agar rata kiri dan bold */
    .box-header h3 {
        margin: 5px 0;
        font-weight: bold;
        text-align: left !important; 
        font-size: 20px;
    }

    /* Tombol Custom Blue */
    .btn-custom-blue {
        background-color: #0073b7 !important;
        color: white !important;
        border-color: #006aa8 !important;
        border-radius: 4px; 
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
        Tambah Data Siswa
        <small>Menambah data Siswa baru</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulir Tambah Data Siswa</h3>
                </div>
                
                <form action="<?= base_url('siswa/create'); ?>" method="post" class="form-horizontal">
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Siswa</label> <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" value="<?= set_value('nama'); ?>">
                                <small class="text-danger"><?php echo form_error('nama'); ?></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">NIS</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nis" value="<?= set_value('nis'); ?>">
                                <small class="text-danger"><?php echo form_error('nis'); ?></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kelas</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="kelas">
                                    <option value="">-- Pilih Kelas --</option> 
                                    <?php foreach ($kelas as $k) { ?>
                                        <option value="<?= $k->id_kelas ?>" <?= set_select('kelas', $k->id_kelas); ?>>
                                            <?= $k->nama_kelas; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <small class="text-danger"><?php echo form_error('kelas'); ?></small>
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
                        <a href="<?= base_url('siswa'); ?>" class="btn btn-default btn-flat">
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
?>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2').select2();
    });
</script>
<?php
$this->load->view('admin/foot');
?>