<?php 
$this->load->view('admin/head');
?>

<style>
/* ... (CSS Anda sudah benar, tidak perlu diubah) ... */
.box.box-primary {
    border-top-color: #0073b7 !important; 
}
/* (Sisa CSS Anda) */
</style>

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary"> <div class="box-header with-border">
                <center><h3 class="box-title">Edit Data Mata Pelajaran</h3></center>
            </div>
            <?php foreach($mapel as $m) { ?>
            <form action="<?=base_url('matapelajaran/update');?>" method="post" class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kode Mata Pelajaran</label>
                        <input type="hidden" name="id" value="<?= $m->id_matapelajaran;?>">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kode" value="<?= $m->kode_matapelajaran;?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Mata Pelajaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value="<?= $m->nama_matapelajaran;?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Guru Pengajar</label>
                        <div class="col-sm-10">
                            <select name="id_guru" class="form-control select2" style="width: 100%;">
                                <option value="">-- Pilih Guru --</option>
                                <?php foreach ($guru as $g) { ?>
                                    <option value="<?= $g->id_guru; ?>" 
                                        <?= ($m->id_guru == $g->id_guru) ? 'selected' : ''; ?>>
                                        <?= $g->nama_guru; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <small class="text-danger"><?= form_error('id_guru'); ?></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="<?=base_url('matapelajaran')?>" class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span> Batal</a>
                            <button type="submit" class="btn btn-primary btn-flat" title="Update Data Mapel"><span class="fa fa-save"></span> Update</button>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    
                </div> 
                </form>
            <?php } ?>
        </div>
    </div>
</div>

</section><?php 
$this->load->view('admin/js');
?>
<script type="text/javascript">
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2').select2();

        $('#data').dataTable();
    });

    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('admin/foot');
?>