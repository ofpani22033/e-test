<?php 
$this->load->view('admin/head');
?>
<style>
.box.box-primary {
    border-top-color: #0073b7 !important;  
}
.btn-custom-blue {
    background-color: #0073b7 !important;
    color: white !important;
    border-color: #006aa8 !important;
}

.btn-custom-blue:hover {
    background-color: #005f96 !important;
    border-color: #005f96 !important;
}
</style>
<?php 
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Mata Pelajaran</h3>
            </div>
            <form role="form" action="<?= base_url('matapelajaran/create'); ?>" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label>Kode Mata Pelajaran</label>
                        <input type="text" class="form-control" name="kode" placeholder="Masukkan Kode" value="<?= set_value('kode'); ?>">
                        <small class="text-danger"><?= form_error('kode'); ?></small>
                    </div>
                    <div class="form-group">
                        <label>Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Mapel" value="<?= set_value('nama'); ?>">
                        <small class="text-danger"><?= form_error('nama'); ?></small>
                    </div>

                    <div class="form-group">
                        <label>Guru Pengajar</label>
                        <select name="id_guru" class="form-control select2" style="width: 100%;">
                            <option value="">-- Pilih Guru --</option>
                            <?php foreach ($guru as $g) { ?>
                                <option value="<?= $g->id_guru; ?>" <?= set_select('id_guru', $g->id_guru); ?>>
                                    <?= $g->nama_guru; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <small class="text-danger"><?= form_error('id_guru'); ?></small>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?= base_url('matapelajaran'); ?>" class="btn btn-default btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-custom-blue btn-flat pull-right"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</section><?php 
$this->load->view('admin/js');
?>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>
<?php
$this->load->view('admin/foot');
?>