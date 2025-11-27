<?php
$this->load->view('admin/head');
?>

<style>
    /* Variabel Warna */
    :root {
        --color-primary: #0073b7;
        --color-primary-hover: #005f91;
    }

    /* ==================================== */
    /* 1. STYLING KOTAK DATA & HEADER */
    /* ==================================== */
    
    /* Kotak Utama (Box box-primary) - Modern & Flat */
    .box.box-primary {
        border-top: none !important; 
        border-radius: 8px; 
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); 
    }
    .box.box-primary > .box-header {
        background-color: #ffffff !important;
        color: var(--color-primary) !important; 
        border-bottom: 2px solid var(--color-primary) !important;
        padding-bottom: 15px;
    }
    .box-header h3 { /* Mengubah h4 di kode guru menjadi h3 sesuai kode soal */
        margin: 5px 0;
        font-weight: bold;
        text-align: left !important; 
        font-size: 20px;
    }


    /* ==================================== */
    /* 2. STYLING TOMBOL CUSTOM (BIRU) & Aksi Tabel */
    /* ==================================== */

    /* Tombol Biru (Untuk Tambah Soal, Filter, dll.) */
    .btn-custom-blue {
        background-color: var(--color-primary) !important;
        border-color: #00629a !important;
        color: #fff !important;
        border-radius: 6px; 
    }
    .btn-custom-blue:hover {
        background-color: var(--color-primary-hover) !important;
        border-color: var(--color-primary-hover) !important;
    }

    /* Badge Kunci Jawaban */
    .label-kunci {
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 4px;
        background-color: #00a65a !important; /* Hijau */
        color: white;
        font-weight: bold;
        display: inline-block;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    
    /* Tombol Aksi (Edit/Hapus) di Tabel */
    .btn-table-edit,
    .btn-table-delete {
        font-size: 10px; 
        padding: 3px 6px; 
        line-height: 1;
        height: auto;
        border-radius: 4px;
        margin: 0 1px; 
    }

    .btn-table-edit {
        background-color: #ffc107 !important; /* Kuning/Warning */
        border-color: #ffc107 !important;
        color: #333 !important;
    }
    .btn-table-edit:hover {
        background-color: #e0a800 !important;
        border-color: #e0a800 !important;
    }

    .btn-table-delete {
        background-color: #dc3545 !important; /* Merah/Danger */
        border-color: #dc3545 !important;
        color: #fff !important;
    }
    .btn-table-delete:hover {
        background-color: #c82333 !important;
        border-color: #c82333 !important;
    }
    
    /* ==================================== */
    /* 3. STYLING DATATABLES & PAGINATION (Baru/Diperbarui) */
    /* ==================================== */
    
    /* Dropdown Show Entries */
    .dataTables_length select {
        border: 1px solid #ccc !important; 
        color: #333 !important;
        border-radius: 4px;
    }

    /* Text Info */
    .dataTables_info {
        color: #666 !important; 
    }
    
    /* Table Header */
    #data thead th {
        background-color: #f8f8f8;
        color: #333;
        border-bottom: 2px solid #ddd !important;
    }

    /* Pagination Button (Active/Current) */
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

    /* Pagination Button (Hover) */
    .dataTables_wrapper .dataTables_paginate .paginate_button:not(.disabled):hover {
        background-color: #e6f2f8 !important; /* Biru sangat muda */
        border-color: #ddd !important;
        color: var(--color-primary) !important; 
        background-image: none !important;
        box-shadow: none !important;
    }

    /* Pagination Button (Default) */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #333 !important;
        background: #fff !important;
        border: 1px solid #ddd !important;
        border-radius: 4px;
        margin: 0 2px;
    }

    /* FIX PENTING: Agar Action Button selalu di atas meski teks soal panjang */
    table.table td {
        vertical-align: top !important; 
    }
    
    /* Styling Pilihan Jawaban */
    ol.jawaban-list {
        padding-left: 20px;
        margin-left: 0;
    }
    ol.jawaban-list li {
        margin-bottom: 3px;
        line-height: 1.4;
    }
</style>

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<section class="content-header">
    <h1>
        Manajemen Soal Ujian
        <small>Daftar lengkap soal berdasarkan mata pelajaran</small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <?= $this->session->flashdata('message'); ?>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter Soal Ujian</h3>
                </div>
                <form action="" method="get" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mata Pelajaran</label>
                            <div class="col-sm-7">
                                <select class="select2 form-control" name="id" required>
                                    <option selected disabled value="">- Pilih Mata Pelajaran -</option>
                                    <?php foreach ($kelas as $a) { ?>
                                        <option value="<?= $a->id_matapelajaran ?>"><?= $a->kode_matapelajaran; ?> | <?= $a->nama_matapelajaran; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-custom-blue btn-flat btn-block">
                                    <span class="fa fa-filter"></span> Filter
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <a href="<?= current_url(); ?>" class="btn btn-default btn-flat btn-sm">
                                    <span class="fa fa-refresh"></span> Reset Filter
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Soal Ujian</h3>
                    <div class="box-tools pull-right">
                        <a href="<?= base_url('soal') ?>" class="btn btn-custom-blue btn-flat btn-sm">
                            <span class="fa fa-plus"></span> Tambah Soal
                        </a>
                        <a href="<?= base_url('matapelajaran'); ?>" class="btn btn-custom-blue btn-flat btn-sm">
                            <span class="fa fa-book"></span> Data Mapel
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table id="data" class="table table-bordered table-striped" style="width:100%; min-width: 1100px;">
                            <thead>
                                <tr>
                                    <th width="40px">No</th>
                                    <th width="80px">Kode</th>
                                    <th width="150px">Mata Pelajaran</th>
                                    <th>Pertanyaan & Pilihan</th>
                                    <th width="80px" class="text-center">Kunci</th>
                                    <th width="100px" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (isset($soal_ujian) && is_array($soal_ujian)) {
                                foreach ($soal_ujian as $d) { 
                                    $clean_pertanyaan = $d->pertanyaan; 
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $d->kode_matapelajaran; ?></td>
                                        <td><?= $d->nama_matapelajaran; ?></td>
                                        <td>
                                            <div style="font-weight: bold; margin-bottom: 8px;">
                                                <?= $clean_pertanyaan; ?>
                                            </div>
                                            
                                            <ol type="A" class="jawaban-list">
                                                <li style="<?= ('A' == $d->kunci_jawaban) ? 'color:#00a65a; font-weight:bold;' : ''; ?>">
                                                    <?= strip_tags($d->a); ?>
                                                </li>
                                                <li style="<?= ('B' == $d->kunci_jawaban) ? 'color:#00a65a; font-weight:bold;' : ''; ?>">
                                                    <?= strip_tags($d->b); ?>
                                                </li>
                                                <li style="<?= ('C' == $d->kunci_jawaban) ? 'color:#00a65a; font-weight:bold;' : ''; ?>">
                                                    <?= strip_tags($d->c); ?>
                                                </li>
                                                <li style="<?= ('D' == $d->kunci_jawaban) ? 'color:#00a65a; font-weight:bold;' : ''; ?>">
                                                    <?= strip_tags($d->d); ?>
                                                </li>
                                                <li style="<?= ('E' == $d->kunci_jawaban) ? 'color:#00a65a; font-weight:bold;' : ''; ?>">
                                                    <?= strip_tags($d->e); ?>
                                                </li>
                                            </ol>
                                        </td>
                                        
                                        <td class="text-center">
                                            <span class="label-kunci"><?= $d->kunci_jawaban; ?></span>
                                        </td>

                                        <td class="text-center">
                                            <a href="<?= base_url('soal_ujian/edit/' . $d->id_soal_ujian); ?>" class="btn btn-table-edit btn-xs btn-flat" title="Edit Data">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            
                                            <a href="<?= base_url('soal_ujian/hapus/' . $d->id_soal_ujian); ?>" onclick="return confirm('Apakah yakin data soal ini akan dihapus?')" class="btn btn-table-delete btn-xs btn-flat" title="Hapus Data">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } 
                                } else { ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data soal ditemukan. Harap filter Mata Pelajaran.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div> </div>
            </div>
        </div>
    </div>
</section>

<?php
$this->load->view('admin/js');
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#data').dataTable({
            "scrollX": true, 
            "autoWidth": false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }, 
                { "width": "8%", "targets": 1 }, 
                { "width": "15%", "targets": 2 }, 
                { "width": "48%", "targets": 3 }, 
                { "width": "8%", "targets": 4, "className": "text-center" }, 
                { "width": "10%", "targets": 5, "className": "text-center" } 
            ]
        });
    });
    
    $('.select2').select2();
    $('.alert-message').alert().delay(3000).slideUp('slow');
    $('.alert-dismissible').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('admin/foot');
?>