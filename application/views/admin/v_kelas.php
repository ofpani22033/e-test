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

    /* Kotak Utama (Box box-primary) - Modern & Flat */
    .box.box-primary, .box.box-success {
        /* Hilangkan garis atas 4px lama, ganti dengan shadow dan sudut membulat */
        border-top: none !important; 
        border-radius: 8px; 
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); 
    }

    .box.box-primary > .box-header,
    .box.box-success > .box-header { 
        background-color: #ffffff !important;
        color: var(--color-primary) !important; /* Judul berwarna biru */
        border-bottom: 2px solid var(--color-primary) !important;
        padding-bottom: 15px;
    }

    .box-header h3 {
        margin-top: 5px;
        font-weight: bold;
        text-align: left !important; /* Diratakan kiri */
        font-size: 20px;
    }

    /* Flash Message */
    .alert-success {
        color: #fff !important;
        background-color: var(--color-primary) !important;
        border-color: var(--color-primary) !important;
    }
    
    /* Peringatan Hapus Data (alert-danger) */
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    /* ==================================== */
    /* 2. STYLING TOMBOL CUSTOM (BIRU) */
    /* ==================================== */

    /* Tombol Biru (Tambah & Simpan) */
    .btn-primary, .btn-custom-blue {
        background-color: var(--color-primary) !important;
        border-color: #00629a !important;
        color: #fff !important;
        border-radius: 6px; /* Sudut membulat */
    }

    .btn-primary:hover, .btn-custom-blue:hover {
        background-color: var(--color-primary-hover) !important;
        border-color: var(--color-primary-hover) !important;
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
    /* (Dipertahankan seperti sebelumnya) */
    /* ==================================== */
    
    .dataTables_length select { border: 1px solid #ccc !important; color: #333 !important; border-radius: 4px; }
    .dataTables_info { color: #666 !important; } 
    
    #data thead th {
        background-color: #f8f8f8;
        color: #333;
        border-bottom: 2px solid #ddd !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.active a, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background-color: var(--color-primary) !important;
        border-color: var(--color-primary) !important;
        color: #fff !important;
        box-shadow: none !important; 
        background-image: none !important; 
        background: var(--color-primary) !important; 
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:not(.disabled):hover {
        background-color: #e6f2f8 !important; 
        border-color: #ddd !important;
        color: var(--color-primary) !important; 
        background-image: none !important;
        box-shadow: none !important;
        /* background: var(--color-primary) !important; <-- Dihapus agar hover tidak langsung biru penuh */
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #333 !important;
        background: #fff !important;
        border: 1px solid #ddd !important;
        border-radius: 4px;
        margin: 0 2px;
    }
    
    /* Modal Header Styling */
    .modal-header {
        background-color: var(--color-primary);
        color: white;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
    }
    .modal-header .close {
        color: white;
        opacity: 0.8;
    }
</style>

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<section class="content-header">
    <h1>
        Manajemen Data Kelas
        <small>Daftar lengkap data Kelas untuk Siswa</small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                Apabila Anda menghapus data kelas, maka data **siswa** yang ada pada data kelas tersebut akan terhapus!
            </div>
            <?= $this->session->flashdata('message'); ?>
            
            <div class="box box-primary" style="overflow-x: auto;">
                <div class="box-header clearfix">
                    <h3 class="box-title">Daftar Data Kelas E-Test</h3>
                    
                    <div class="box-tools pull-right">
                        <a href="<?=base_url('siswa')?>" class="btn btn-default btn-flat">
                            <span class="fa fa-arrow-left"></span> Kembali
                        </a>
                        <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default">
                            <span class="fa fa-plus"></span> Tambah Kelas
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Kelas</th>
                                <th width="10%" class="text-center">Aksi</th> </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kelas as $m) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $m->nama_kelas; ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('kelas/edit/') . $m->id_kelas; ?>" class="btn btn-table-edit btn-xs" title="Edit Data">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('kelas/hapus/') . $m->id_kelas; ?>" onclick="return confirm('Apakah yakin data kelas ini dihapus?')" class="btn btn-table-delete btn-xs" title="Hapus Data">
                                            <i class="fa fa-trash"></i> 
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section><div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Data Kelas</h4> </div>
            <form method="post" action="<?php echo base_url('kelas/kelas_aksi'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Kelas</label>
                        <input type="text" class="form-control" name="nama_kelas" placeholder="Masukkan Nama Kelas" required="">
                        <?= form_error('nama_kelas', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
<?php
$this->load->view('admin/js');
?>

<script type="text/javascript">
    $(function() {
        $('#data').dataTable();
    });

    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('admin/foot');
?>