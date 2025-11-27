<?php 
$this->load->view('admin/head');
?>

<style>
    /* Mengambil style dari list guru: Judul Box diubah ke kiri */
    .box.box-primary {
        border-top: none !important; 
        border-radius: 8px; 
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); 
    }
    
    .box.box-primary > .box-header {
        background-color: #ffffff !important;
        color: #0073b7 !important;
        border-bottom: 2px solid #0073b7 !important;
        padding-bottom: 15px;
    }

    /* Mengubah h3 box-title agar rata kiri dan bold */
    .box-header h3 {
        margin: 5px 0;
        font-weight: bold;
        text-align: left !important; /* Diratakan kiri */
        font-size: 20px;
    }

    .btn-custom-blue {
        background-color: #0073b7 !important;
        color: white !important;
        border-color: #006aa8 !important;
        border-radius: 4px; /* Sudut membulat */
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

<section class="content-header">
    <h1>
        Edit Data Siswa
        <small>Mengubah informasi akun Siswa</small>
    </h1>
</section>
<section class="content">
<div class="row">
    <div class="col-md-12">
        
        <div class="box box-primary" style="overflow-x: auto;">
            <div class="box-header with-border">
                <h3 class="box-title">Formulir Edit Data Siswa</h3> 
            </div>
            
            <?php 
            // Menggunakan pengecekan data yang konsisten seperti pada kode Guru
            if (isset($siswa) && (is_array($siswa) || is_object($siswa)) && count((array)$siswa) > 0) {
            foreach($siswa as $a) { ?>
            
            <form action="<?=base_url('siswa/update');?>" method="post" class="form-horizontal">
              <div class="box-body">
                
                <input type="hidden" name="id_lama" value="<?= $a->id_siswa;?>"> <div class="form-group">
                  <label class="col-sm-3 control-label">NIS (Nomor Induk Siswa)</label> <div class="col-sm-8">
                    <input type="text" class="form-control" name="nis" value="<?= $a->nis;?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Siswa</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="nama" value="<?= $a->nama_siswa;?>" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kelas</label>
                  <div class="col-sm-8">
                    <select class="select2 form-control" name="kelas" required>      
                        <?php foreach($kelas as $k) { ?>
                            <option value="<?=$k->id_kelas?>" <?php if($a->id_kelas==$k->id_kelas){echo "selected='selected'";} ?>> <?= $k->nama_kelas;?>
                            </option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="username" value="<?= $a->username;?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Password Baru</label> <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" title="Kosongkan field ini jika Anda tidak ingin mengubah password akun siswa saat ini.">
                  </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-8">
                        <a href="<?=base_url('siswa')?>" class="btn btn-default btn-flat">
                            <span class="fa fa-arrow-left"></span> Batal
                        </a>
                        <button type="submit" class="btn btn-custom-blue btn-flat" title="Simpan Perubahan Data Siswa"> <span class="fa fa-save"></span> Simpan Perubahan
                        </button>
                    </div>
                </div>

              </div>
              
            </form>
            
            <?php } 
            } else { 
            // Jika data $siswa kosong
            ?>
                <div class="box-body">
                    <p class="text-danger text-center">Data siswa tidak ditemukan. Harap kembali ke halaman daftar siswa.</p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

</section>

<?php 
$this->load->view('admin/js');
?>
<script type="text/javascript">

    $(document).ready(function() {
        // Baris ini dihapus karena tidak relevan di halaman edit
        // $('#data').dataTable(); 
        
        $('.select2').select2();
    });

    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('admin/foot');
?>