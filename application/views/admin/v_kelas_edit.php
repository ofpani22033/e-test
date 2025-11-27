<?php
$this->load->view('admin/head');
?>

<style>
    /* ==================================== */
    /* VARS & STYLING KOTAK DATA & HEADER */
    /* ==================================== */
    
    :root {
        --color-primary: #0073b7;
        --color-primary-hover: #005f91;
    }

    /* Kotak Utama (Box box-success/primary) - Modern & Flat */
    .box.box-primary, .box.box-success {
        border-top: none !important; 
        border-radius: 8px; 
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); 
    }
    
    .box.box-primary > .box-header,
    .box.box-success > .box-header { 
        background-color: #ffffff !important;
        color: var(--color-primary) !important; 
        border-bottom: 2px solid var(--color-primary) !important;
        padding-bottom: 15px;
    }

    /* Mengubah h4/h3 box-title agar rata kiri dan bold */
    .box-header h4, .box-header h3 {
        margin: 5px 0;
        font-weight: bold;
        text-align: left !important; 
        font-size: 20px;
    }

    /* Tombol Biru (Simpan) */
    .btn-primary, .btn-custom-blue {
        background-color: var(--color-primary) !important;
        border-color: #00629a !important;
        color: #fff !important;
        border-radius: 4px; 
    }

    .btn-primary:hover, .btn-custom-blue:hover {
        background-color: var(--color-primary-hover) !important;
        border-color: var(--color-primary-hover) !important;
    }
</style>

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<section class="content-header">
    <h1>
        Edit Data Kelas
        <small>Mengubah nama Kelas</small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" style="overflow-x: scroll;">
                <div class="box-header with-border">
                    <h4 class="box-title">Formulir Edit Data Kelas</h4>
                </div>
                <?php 
                // Tambahkan pengecekan data agar looping tidak kosong
                if (isset($kelas) && (is_array($kelas) || is_object($kelas)) && count((array)$kelas) > 0) {
                foreach ($kelas as $a) { ?>
                    <form action="<?= base_url('kelas/update'); ?>" method="post" class="form-horizontal">
                        <div class="box-body">
                            <input type="hidden" name="id" value="<?= $a->id_kelas; ?>">
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Kelas</label> <div class="col-sm-8"> <input type="text" class="form-control" name="nama" value="<?= $a->nama_kelas; ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-8">
                                    <a href="<?=base_url('kelas')?>" class="btn btn-default btn-flat">
                                        <span class="fa fa-arrow-left"></span> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-flat" title="Simpan Perubahan Data Kelas">
                                        <span class="fa fa-save"></span> Simpan Perubahan
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                <?php } 
                } else {
                ?>
                    <div class="box-body">
                        <p class="text-danger text-center">Data kelas tidak ditemukan. Harap kembali ke halaman daftar kelas.</p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</section><?php
$this->load->view('admin/js');
?>
<script type="text/javascript">
    $(document).ready(function() {
        // Baris ini tidak relevan di halaman edit
        // $('#data').dataTable(); 
    });

    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('admin/foot');
?>