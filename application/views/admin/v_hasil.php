<?php 
$this->load->view('admin/head');
?>
<style> 
    /* ... (Semua CSS Anda sudah benar) ... */
    :root {
        --color-primary: #0073b7;
        --color-primary-hover: #005f91;
    }
    .box.box-primary, .box.box-success {
        border-top: 4px solid var(--color-primary) !important;
    }
    .box.box-primary > .box-header,
    .box.box-success > .box-header { 
        background-color: #ffffff !important;
        color: #000 !important;
        border-bottom: 2px solid var(--color-primary) !important;
    }
    .box-header h4 {
        margin-top: 5px;
        font-weight: bold;
    }
    .btn-primary {
        background-color: var(--color-primary) !important;
        border-color: #00629a !important;
        color: #fff !important;
    }
    .btn-primary:hover {
        background-color: var(--color-primary-hover) !important;
        border-color: var(--color-primary-hover) !important;
    }
    .btn-success {
        background-color: var(--color-primary) !important;
        border-color: var(--color-primary) !important;
    }
    .btn-success:hover {
        background-color: var(--color-primary-hover) !important;
        border-color: var(--color-primary-hover) !important;
    }
    .alert-success {
        color: #fff !important;
        background-color: var(--color-primary) !important;
        border-color: var(--color-primary) !important;
    }
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
    .btn-orange {
        background-color: #FF9800;
        color: white;
    }
    .btn-orange:hover {
        background-color: #F57C00;
        color: white;
    }
</style>

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <div class="box box-primary" style="overflow-x: scroll;">
                <div class="box-header">
                    <center><h4 class="box-title">Hasil Ujian</h4></center>
                </div>
                
                <form action="" method="get" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mata Pelajaran</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control" name="id">
                                    <option value="">- Semua Mata Pelajaran -</option>
                                    
                                    <?php if (isset($data_matapelajaran) && is_array($data_matapelajaran)): ?>
                                        <?php foreach ($data_matapelajaran as $a) { ?>
                                            <option value="<?= html_escape($a->id_matapelajaran) ?>" 
                                                <?php if ($this->input->get('id') == $a->id_matapelajaran) echo 'selected'; ?>>
                                                <?= html_escape($a->kode_matapelajaran); ?> | <?= html_escape($a->nama_matapelajaran); ?>
                                            </option>
                                        <?php } ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kelas</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control" name="id_kelas">
                                    <option value="">- Semua Kelas -</option>
                                    <?php if (isset($data_kelas) && is_array($data_kelas)): ?>
                                        <?php foreach ($data_kelas as $k) { ?>
                                            <option value="<?= html_escape($k->id_kelas) ?>"
                                                <?php if ($this->input->get('id_kelas') == $k->id_kelas) echo 'selected'; ?>>
                                                <?= html_escape($k->nama_kelas); ?>
                                            </option>
                                        <?php } ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a href="<?= base_url('hasil_ujian'); ?>" class="btn btn-default btn-flat"><span class="fa fa-refresh"></span> Refresh</a>
                                <button type="submit" class="btn btn-primary btn-flat" title="Filter Data Soal Ujian"><span class="fa fa-filter"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="box box-primary" style="overflow-x: scroll;">
                <div class="box-header" >
                    
                    <?php 
                    $id_mapel = $this->input->get('id');
                    $id_kelas = $this->input->get('id_kelas');
                    
                    $params = [];
                    if ($id_mapel) $params['id'] = $id_mapel; 
                    if ($id_kelas) $params['id_kelas'] = $id_kelas;
                    $query_string = http_build_query($params);

                    if ($id_mapel || $id_kelas) {
                    ?>
                    <a href="<?= base_url('hasil_ujian/print_all?') . $query_string ?>" class="btn btn-orange btn-flat" target="_blank">
                        <i class="fa fa-file-pdf-o"></i> Cetak Sesuai Filter
                    </a>
                    <?php } ?>

                    <a href="<?=base_url('hasil_ujian/print_all')?>" class="btn btn-primary btn-flat pull-right" target="_blank"><i class="fa fa-print"></i> Cetak Semua Hasil Ujian</a>
                </div>
                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped"> 
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Siswa</th>
                                <th>NIS</th>
                                <th>Kelas</th> <th>Mata Pelajaran</th>
                                <th>Tanggal Ujian</th>
                                <th>Jam Ujian</th>
                                <th>Jenis Ujian</th>
                                <th>Benar</th>
                                <th>Salah</th>
                                <th>Nilai</th>
                                <th>Cetak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            if (isset($hasil) && !empty($hasil)):
                                foreach($hasil as $d) { 
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?= html_escape($d->nama_siswa); ?></td>
                                    <td><?= html_escape($d->nis); ?></td>
                                    <td><?= html_escape($d->nama_kelas); ?></td> <td><?= html_escape($d->nama_matapelajaran); ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($d->tanggal_ujian)); ?></td>
                                    <td><?php echo date('H:i:s',strtotime($d->jam_ujian)); ?></td>
                                    <td><?= html_escape($d->jenis_ujian); ?></td>
                                    <td>
                                        <?php
                                        if($d->benar == '' || $d->benar === null){
                                            echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                        }else {
                                            echo $d->benar;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($d->salah == '' || $d->salah === null){
                                            echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                        }else {
                                            echo $d->salah;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($d->nilai == '' || $d->nilai === null){
                                            echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                        }else {
                                            echo $d->nilai;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($d->nilai == '' || $d->nilai === null){
                                            echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                        }else {
                                            echo "<a href='".base_url('hasil_ujian/cetak/'.$d->id_peserta)."' class='btn btn-xs btn-success' title='Cetak Hasil Ujian' target='_blank'><span class='fa fa-print'></span></a>";;
                                        }
                                        ?>
                                    </td> 
                                </tr>
                            <?php 
                                } 
                            else:
                            ?>
                                <tr>
                                    <td colspan="12" class="text-center">Tidak ada data hasil ujian yang ditemukan.</td>
                                </tr>
                            <?php endif; ?>
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

    $(function(){
        $('#data').dataTable();
        $('.select2').select2();
    });

    $('.alert-message').alert().delay(3000).slideUp('slow');

</script>

<?php
$this->load->view('admin/foot');
?>