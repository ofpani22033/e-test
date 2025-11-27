<?php
$this->load->view('admin/head');
?>
<style>
    /* ==================================== */
    /* 1. STYLING KOTAK DATA & HEADER */
    /* ==================================== */
    
    /* Warna Biru Primary */
    :root {
        --color-primary: #0073b7;
        --color-primary-hover: #005f91;
    }

    /* Kotak Utama (Box box-primary) */
    .box.box-primary, .box.box-success {
        border-top: 4px solid var(--color-primary) !important; /* Garis atas biru */
    }

    .box.box-primary > .box-header,
    .box.box-success > .box-header { 
        background-color: #ffffff !important;
        color: #000 !important; /* Judul hitam */
        border-bottom: 2px solid var(--color-primary) !important;
    }

    .box-header h4 {
        margin-top: 5px;
        font-weight: bold;
    }

    /* ==================================== */
    /* 2. STYLING TOMBOL CUSTOM (BIRU) */
    /* ==================================== */

    /* Tombol Default (btn-primary) dan Custom Blue (Tambah, Jenis Ujian, dll) */
    .btn-primary, .btn-custom-blue {
        background-color: var(--color-primary) !important;
        border-color: #00629a !important;
        color: #fff !important;
    }

    .btn-primary:hover, .btn-custom-blue:hover {
        background-color: var(--color-primary-hover) !important;
        border-color: var(--color-primary-hover) !important;
    }

    /* Tombol Status 'Selesai Ujian' (btn-success) diubah jadi Biru */
    .btn-success {
        background-color: var(--color-primary) !important;
        border-color: var(--color-primary) !important;
    }
    .btn-success:hover {
        background-color: var(--color-primary-hover) !important;
        border-color: var(--color-primary-hover) !important;
    }
    
    /* Tombol Action (btn-warning) - TIDAK DIOVERRIDE (TETAP KUNING/ORANGE BAWAAN) */
    
    /* Flash Message (Agar alert-success juga biru) */
    .alert-success {
        color: #fff !important;
        background-color: var(--color-primary) !important;
        border-color: var(--color-primary) !important;
    }

    /* ==================================== */
    /* 3. STYLING DATATABLES & PAGINATION */
    /* ==================================== */
    
    /* (Styling Pagination dan DataTables tetap sama) */
    .dataTables_length select { border: 1px solid #000 !important; color: #000 !important; }
    .dataTables_info { color: #000 !important; } 
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
        background-color: var(--color-primary) !important;
        border-color: var(--color-primary) !important;
        color: #fff !important;
        background-image: none !important;
        box-shadow: none !important;
        background: var(--color-primary) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #333 !important;
        background: #fff !important;
        border: 1px solid #ddd !important;
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
                    <center><h4 class="box-title">Daftar Peserta Ujian</h4></center><p>
                    <h3 class="box-title"></h3>
                    
                    <a href="<?php echo base_url('peserta_tambah'); ?>"><button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#peserta_tambah" ><span class="fa fa-plus"></span> Tambah </button></a>
                    <a href="<?php echo base_url('jenis_ujian'); ?>"><button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#" ><span ></span>Data Jenis Ujian</button></a>
                </div>
                <div class="box-body" style="overflow-x: scroll;">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Nama Mata Pelajaran</th>
                                <th>Jenis Ujian</th>
                                <th>Waktu Ujian</th>
                                <th>Durasi Ujian</th>
                                <th width="7%">Action</th>
                                <th>Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (isset($peserta) && is_array($peserta)): 
                                foreach ($peserta as $d): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?= html_escape($d->nama_siswa); ?></td>
                                    <td><?= html_escape($d->nama_kelas); ?></td>
                                    <td><?= html_escape($d->nama_matapelajaran); ?></td>
                                    <td><?= html_escape($d->jenis_ujian); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($d->tanggal_ujian)); ?> | <?php echo $d->jam_ujian; ?></td>
                                    <td><?php echo $d->durasi_ujian; ?> Menit</td>
                                    <td>
                                        <?php if ($d->nilai == null) { ?>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning btn-flat btn-xs">Action</button>
                                                <button type="button" class="btn btn-warning btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="<?= base_url() . 'peserta/edit/' . $d->id_peserta; ?>">Edit Data</a></li>
                                                    <li><a href="<?= base_url() . 'peserta/hapus/' . $d->id_peserta; ?>" onclick="return confirm('Apakah yakin data peserta ini di hapus?')">Hapus Data</a></li>
                                                </ul>
                                            </div>
                                        <?php } else {
                                            echo '-';
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($d->status_ujian == "1") {
                                                echo "<span class='btn btn-xs btn-default'> Belum Ujian </span>";
                                            } else if ($d->status_ujian == "2") {
                                                // Status Selesai Ujian menggunakan btn-success yang di-override jadi biru
                                                echo "<span class='btn btn-xs btn-success'> Selesai Ujian </span>";
                                            }
                                            ?>
                                    </td>
                                </tr>
                            <?php 
                                endforeach; 
                            else:
                            ?>
                                <tr>
                                    <td colspan="10" class="text-center">Tidak ada data peserta ujian yang ditemukan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section><div class="modal fade" id="modal-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <center><h4 class="modal-title">Tambah Data siswa</h4></center>
            </div>
            <div class="modal-body">
                <div id="modal-data-body">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('admin/js');
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#data').DataTable({
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    });

    $('.select2').select2();

    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>
<?php
$this->load->view('admin/foot');
?>