<?php
$this->load->view('admin/head');
?>

<style>
    /* ==================================== */
    /* 1. STYLING KOTAK DATA & HEADER */
    /* ==================================== */
    
    /* Kotak Utama (Box box-primary) - Lebih modern dan flat */
    .box.box-primary {
        /* Hilangkan garis atas 4px lama, ganti dengan shadow dan sudut membulat */
        border-top: none !important; 
        border-radius: 8px; 
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); 
    }

    .box.box-primary > .box-header {
        background-color: #ffffff !important;
        color: #0073b7 !important; /* Judul berwarna biru */
        border-bottom: 2px solid #0073b7 !important;
        padding-bottom: 15px;
    }
    
    .box-header h4 {
        margin-top: 5px;
        font-weight: bold;
        text-align: left !important; 
        font-size: 20px;
    }

    /* ==================================== */
    /* 2. STYLING TOMBOL CUSTOM (BIRU) */
    /* ==================================== */

    /* Tombol Tambah (Primary Blue) */
    .btn-custom-blue {
        background-color: #0073b7 !important;
        border-color: #00629a !important;
        color: #fff !important;
        border-radius: 6px; 
    }

    .btn-custom-blue:hover {
        background-color: #005f91 !important;
    }
    
    /* Tombol Aksi (Edit/Hapus) di Tabel - Ikon Ramping dan Sejajar */
    .btn-table-edit,
    .btn-table-delete {
        font-size: 10px; /* Ukuran font lebih kecil */
        padding: 3px 6px; /* Padding sangat kecil */
        line-height: 1;
        height: auto;
        border-radius: 4px;
        margin: 0 1px; /* Jarak antar tombol sangat rapat */
    }

    .btn-table-edit {
        background-color: #ffc107; /* Kuning/Warning */
        border-color: #ffc107;
        color: #333;
    }

    .btn-table-delete {
        background-color: #dc3545; /* Merah/Danger */
        border-color: #dc3545;
        color: #fff;
    }


    /* ==================================== */
    /* 3. STYLING DATATABLES & PAGINATION */
    /* ==================================== */
    
    .dataTables_length select {
        border: 1px solid #ccc !important; 
        color: #333 !important;
        border-radius: 4px;
    }

    .dataTables_info {
        color: #666 !important; 
    }
    
    #data thead th {
        background-color: #f8f8f8;
        color: #333;
        border-bottom: 2px solid #ddd !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.active a, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background-color: #0073b7 !important;
        border-color: #0073b7 !important;
        color: #fff !important;
        box-shadow: none !important; 
        background-image: none !important; 
        background: #0073b7 !important; 
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:not(.disabled):hover {
        background-color: #e6f2f8 !important; 
        border-color: #ddd !important;
        color: #0073b7 !important; 
        background-image: none !important;
        box-shadow: none !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #333 !important;
        background: #fff !important;
        border: 1px solid #ddd !important;
        border-radius: 4px;
        margin: 0 2px;
    }
</style>

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<section class="content-header">
    <h1>
        Manajemen Data Guru
        <small>Daftar lengkap pengguna dengan peran Guru</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <?= $this->session->flashdata('message'); ?>

            <div class="box box-primary" style="overflow-x: auto;">
                <div class="box-header clearfix">
                    <h4 class="box-title">Daftar Data Guru E-Test</h4> 
                    
                    <div class="box-tools pull-right">
                        <a href="<?= base_url('guru/create'); ?>" class="btn btn-custom-blue btn-flat">
                            <span class="fa fa-plus"></span> Tambah Guru
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>NIK</th>
                                <th>Nama Guru</th>
                                <th>Username</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (isset($guru) && (is_array($guru) || is_object($guru))):
                            foreach ($guru as $m): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $m->id_guru; ?></td>
                                    <td><?= $m->nama_guru; ?></td>
                                    <td><?= $m->username; ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('guru/edit/') . $m->id_guru; ?>" class="btn btn-table-edit btn-xs" title="Edit Data">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('guru/hapus/') . $m->id_guru; ?>" onclick="return confirm('Apakah yakin data peserta ini dihapus?')" class="btn btn-table-delete btn-xs" title="Hapus Data">
                                            <i class="fa fa-trash"></i> 
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; 
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>

<?php
$this->load->view('admin/js');
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#data').dataTable();
        $('.alert-message').alert().delay(3000).slideUp('slow');
    });
</script>

<?php
$this->load->view('admin/foot');
?>