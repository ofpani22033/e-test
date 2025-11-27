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

    /* Menggunakan box.box-primary styling modern */
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

    /* Mengubah box-title agar rata kiri dan bold */
    .box-header .box-title {
        margin: 5px 0;
        font-weight: bold;
        text-align: left !important; 
        font-size: 20px;
        display: block; /* Memastikan judul mengambil baris penuh */
    }

    /* Tombol Biru (Simpan) */
    .btn-custom-blue {
        background-color: var(--color-primary) !important;
        color: white !important;
        border-color: #006aa8 !important;
        border-radius: 4px; 
    }

    .btn-custom-blue:hover {
        background-color: var(--color-primary-hover) !important;
        border-color: var(--color-primary-hover) !important;
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
    .modal-header h4 {
        color: white;
        font-weight: bold;
    }
</style>


<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<section class="content-header">
    <h1>
        Tambah Soal Ujian
        <small>Formulir untuk memasukkan soal baru</small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <?= $this->session->flashdata('message'); ?>

            <div class="box box-primary" style="overflow-x: scroll;">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulir Tambah Soal Ujian</h3> 
                </div><form action="<?= base_url('soal/insert'); ?>" method="post" class="form-horizontal"> <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mata Pelajaran</label> <div class="col-sm-8"> <select class="select2 form-control" name="nama_matapelajaran" required>
                                    <option selected disabled value="">- Pilih Mata Pelajaran -</option>
                                    <?php foreach ($soal as $a) { ?>
                                        <option value="<?= $a->id_matapelajaran ?>"><?= $a->kode_matapelajaran; ?> | <?= $a->nama_matapelajaran; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tulis Soal Ujian</label>
                            <div class="col-sm-8">
                                <textarea id="editor_soal" class="form-control" name="soal" rows="5" required></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jawaban A</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="a" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jawaban B</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="b" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jawaban C</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="c" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jawaban D</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="d" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jawaban E</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="e" rows="2" required></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kunci Jawaban</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="kunci" required>
                                    <option selected disabled value="">- Pilih Kunci Jawaban -</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="box-footer">
                        <a href="<?=base_url('soal_ujian')?>" class="btn btn-default btn-flat">
                            <span class="fa fa-arrow-left"></span> Kembali
                        </a>
                        <button type="submit" class="btn btn-custom-blue btn-flat pull-right" title="Simpan Data Soal Ujian">
                            <span class="fa fa-save"></span> Simpan
                        </button>
                    </div>
                </form>
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
                <h4 class="modal-title">Tambah Mata Pelajaran</h4>
            </div>
            <form method="post" action="<?php echo base_url().'matapelajaran/mapel_aksi'; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Kode Mata Pelajaran </label>
                        <input type="text" class="form-control" name="kode" placeholder="Masukkan Kode Mata Pelajaran" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Mata Pelajaran" required>
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

<script src="<?= base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script> 

<script type="text/javascript">
    $(function() {
        // Inisialisasi CKEditor untuk textarea soal
        CKEDITOR.replace('editor_soal', {
            // Pengaturan dasar CKEditor
            filebrowserUploadUrl: '<?= base_url("upload_ckeditor_image"); ?>', // Contoh URL upload
            height: '200px'
        });
    });

    $('.select2').select2();

    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>


<?php
$this->load->view('admin/foot');
?>