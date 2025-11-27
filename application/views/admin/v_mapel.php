<?php 
$this->load->view('admin/head');
?>

<style>
/* ... (Semua CSS Anda sudah benar, tidak perlu diubah) ... */
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
.dataTables_length select { border: 1px solid #000 !important; color: #000 !important; }
.dataTables_info { color: #000 !important; }
.dataTables_wrapper .dataTables_paginate .paginate_button.active a,
.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background-color: #0073b7 !important; border-color: #0073b7 !important; color: #fff !important;
    box-shadow: none !important; background-image: none !important; background: #0073b7 !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:not(.disabled):hover {
    background-color: #0073b7 !important; border-color: #0073b7 !important; color: #fff !important;
    background-image: none !important; box-shadow: none !important; background: #0073b7 !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    color: #333 !important; background: #fff !important; border: 1px solid #ddd !important;
}
</style>

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<section class="content">
<div class="row">
    <div class="col-md-12">
      <?= $this->session->flashdata('message'); ?>
        <div class="box box-primary" style="overflow-x: scroll;">
            <div class="box-header">
                <center><h3 class="box-title">Data Mata pelajaran</h3></center><p>
                    
                    <a href="<?= base_url('matapelajaran/create'); ?>" class="btn btn-custom-blue btn-flat">
                        <span class="fa fa-plus"></span> Tambah Mata Pelajaran
                    </a>
            </div>
            <div class="box-body">
                <table id="data" class="table table-bordered table-striped"> 
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th>Kode</th>
                            <th>Nama Mata Pelajaran</th> 
                            <th>Guru Pengajar</th> <th width="12%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        foreach($mapel as $m) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $m->kode_matapelajaran; ?></td>
                                <td><?php echo $m->nama_matapelajaran; ?></td>
                                
                                <td><?php echo ($m->nama_guru) ? $m->nama_guru : '-'; ?></td> 
                                
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning btn-flat btn-xs">Action</button>
                                        <button type="button" class="btn btn-warning btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?= base_url().'matapelajaran/edit/'.$m->id_matapelajaran; ?>">Edit Data</a></li>
                                            <li><a href="<?= base_url().'matapelajaran/hapus/'.$m->id_matapelajaran; ?>" onclick="return confirm('Apakah yakin data peserta ini di hapus?')">Hapus Data</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?> 
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>
</section><?php 
$this->load->view('admin/js');
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#data').dataTable();
    });
    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('admin/foot');
?>