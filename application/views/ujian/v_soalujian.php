<?php $this->load->view('ujian/head'); ?>

<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }

    /* --- SIDEBAR TIMER & INFO (STICKY) --- */
    .sticky-info {
        position: -webkit-sticky;
        position: sticky;
        top: 20px;
        z-index: 100;
    }
    
    .timer-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border-top: 4px solid #0073b7;
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
    }

    #counter {
        font-size: 2.8em;
        font-weight: 700;
        color: #333;
        line-height: 1;
        margin: 15px 0;
        font-family: 'Courier New', Courier, monospace;
    }

    .timer-label {
        font-size: 0.85em;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
    }

    /* Status Autosave */
    #status-save {
        margin-top: 10px;
        padding: 5px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        color: #777;
        background-color: #f9f9f9;
        display: inline-block;
        width: 100%;
    }

    /* --- KARTU SOAL --- */
    .soal-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        padding: 30px;
        border-left: 5px solid #e2e6ea;
        transition: all 0.3s ease;
    }

    .soal-card:hover {
        border-left-color: #0073b7;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .soal-header {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
    }

    .nomor-soal {
        background-color: #0073b7;
        color: #fff;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
        border-radius: 10px;
        flex-shrink: 0;
    }

    .teks-pertanyaan {
        font-size: 17px;
        line-height: 1.6;
        color: #2c3e50;
        margin-top: 5px;
        font-weight: 500;
    }

    /* --- PILIHAN JAWABAN (CUSTOM RADIO) --- */
    .pilihan-container {
        margin-left: 65px;
    }

    .radio-custom {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        margin-bottom: 12px;
        cursor: pointer;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        transition: all 0.2s;
        background-color: #fff;
    }

    .radio-custom:hover {
        background-color: #f8f9fa;
        border-color: #b3d7ff;
    }

    .radio-custom input[type="radio"] {
        appearance: none;
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid #adb5bd;
        border-radius: 50%;
        margin-right: 15px;
        outline: none;
        flex-shrink: 0;
        position: relative;
    }

    /* Saat Radio Dipilih */
    .radio-custom input[type="radio"]:checked {
        border-color: #0073b7;
        background-color: #0073b7;
        box-shadow: 0 0 0 3px rgba(0, 115, 183, 0.2);
    }

    .radio-custom input[type="radio"]:checked::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 8px;
        height: 8px;
        background: #fff;
        border-radius: 50%;
    }

    .radio-custom:has(input:checked) {
        background-color: #ebf7ff;
        border-color: #0073b7;
    }
    
    .radio-selected-js {
        background-color: #ebf7ff !important;
        border-color: #0073b7 !important;
    }

    .jawaban-text {
        font-size: 16px;
        color: #495057;
    }
    
    .btn-finish-exam {
        width: 100%;
        padding: 12px;
        font-weight: bold;
        letter-spacing: 1px;
        margin-top: 15px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .box.box-primary { border-top-color: #0073b7 !important; }
    .btn-custom-blue { background-color: #0073b7 !important; color: white !important; border-color: #006aa8 !important; }
</style>

<?php $this->load->view('ujian/topbar'); ?>

<?php
// Logika Perhitungan Waktu PHP
if(isset($_SESSION["waktu_start"])){
    $lewat = time() - $_SESSION["waktu_start"];
}else{
    $_SESSION["waktu_start"] = time();
    $lewat = 0;
}

// KEAMANAN: Cek apakah variabel jawaban_siswa dikirim dari controller
// Jika belum dikirim (controller belum diupdate), set jadi array kosong biar gak error
$jawaban_siswa = isset($jawaban_siswa) ? $jawaban_siswa : [];
?>

<section class="content" style="padding-top: 30px; padding-bottom: 50px;">
    
    <form id="formSoal" role="form" action="<?php echo base_url(); ?>ruang_ujian/jawab_aksi" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan ujian ini? Pastikan semua soal telah terjawab.')">
        
        <input type="hidden" name="id_peserta" value="<?php echo $id['id_peserta']; ?>">
        <input type="hidden" name="jumlah_soal" value="<?php echo $total_soal; ?>">

        <div class="row">
            
            <div class="col-md-3">
                <div class="sticky-info">
                    
                    <div class="timer-card">
                        <div class="timer-label">Sisa Waktu</div>
                        <div id="counter">--:--:--</div>
                        <div id="status-save">
                            <i class="fa fa-circle-o-notch fa-spin hidden"></i> Menunggu Jawaban...
                        </div>
                    </div>

                    <div class="box box-primary box-solid">
                        <div class="box-body">
                            <strong><i class="fa fa-user margin-r-5"></i> Peserta</strong>
                            <p class="text-muted mb-0">
                                <?php echo $this->session->userdata('nama'); ?>
                            </p>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-custom-blue btn-finish-exam btn-flat">
                                <i class="fa fa-check-circle"></i> SELESAI UJIAN
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-9">
                
                <div class="alert alert-info alert-dismissible" style="background-color: #0073b7 !important; border-color: #bee5eb; color: #fff;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> Petunjuk!</h4>
                    Pilihlah jawaban yang paling benar. Jawaban akan <strong>disimpan otomatis</strong>.
                </div>

                <?php $no = 0; foreach ($soal as $s) { $no++; ?>
                
                <div class="soal-card" id="soal_container_<?php echo $s->id_soal_ujian; ?>">
                    
                    <div class="soal-header">
                        <div class="nomor-soal"><?php echo $no; ?></div>
                        <div class="teks-pertanyaan">
                            <?php echo $s->pertanyaan; ?>
                        </div>
                    </div>

                    <input type='hidden' name='soal[]' value='<?php echo $s->id_soal_ujian; ?>' />

                    <div class="pilihan-container">
                        <?php 
                        $opsi = ['A', 'B', 'C', 'D', 'E'];
                        foreach($opsi as $huruf) {
                            $isi_jawaban = $s->{strtolower($huruf)};
                            
                            // --- LOGIKA MENAMPILKAN JAWABAN YANG TERSIMPAN ---
                            $checked = '';
                            $class_selected = ''; 
                            
                            // Cek jika ID soal ini ada di daftar jawaban siswa
                            if(isset($jawaban_siswa[$s->id_soal_ujian]) && $jawaban_siswa[$s->id_soal_ujian] == $huruf){
                                $checked = 'checked';
                                $class_selected = 'radio-selected-js'; // Class biar visualnya biru
                            }
                        ?>
                            <label class="radio-custom <?php echo $class_selected; ?>" onclick="selectRow(this)">
                                <input type="radio" name="jawaban[<?php echo $s->id_soal_ujian; ?>]" value="<?php echo $huruf; ?>" required <?php echo $checked; ?>>
                                
                                <span class="jawaban-text">
                                    <strong><?php echo $huruf; ?>.</strong> 
                                    <?php echo htmlspecialchars($isi_jawaban); ?>
                                </span>
                            </label>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>

                <div class="box-footer text-right" style="background:none; border:none;">
                    <button type="submit" class="btn btn-success btn-lg btn-flat">
                        <i class="fa fa-save"></i> SIMPAN SEMUA JAWABAN
                    </button>
                </div>

            </div>
        </div>
    </form>
</section>

<?php $this->load->view('ujian/js'); ?>

<script type="text/javascript">
    
    // 1. Fungsi Visual: Highlight Pilihan
    function selectRow(label) {
        var container = $(label).closest('.pilihan-container');
        container.find('.radio-custom').removeClass('radio-selected-js');
        $(label).addClass('radio-selected-js');
    }

    // 2. LOGIKA TIMER
    function waktuHabis(){
        swal({
            title: "Waktu Habis!",
            text: "Jawaban Anda akan disimpan secara otomatis.",
            icon: "warning",
            button: "OK",
        }).then(() => {
             document.getElementById("formSoal").submit();
        });
        setTimeout(function(){ document.getElementById("formSoal").submit(); }, 2000);
    }

    function hampirHabis(periods){
        if($.countdown.periodsToSeconds(periods) <= 60){
            $("#counter").css({color: "#dc3545", fontWeight: "bold"});
            $(".timer-card").css({borderTopColor: "#dc3545"});
        }
    }

    $(function(){
        var waktu = '<?= $max_time; ?>'; 
        var sisa_waktu = waktu - <?php echo $lewat ?>;
        var longWayOff = sisa_waktu;
        
        $("#counter").countdown({
            until: longWayOff,
            compact: true,
            format: 'HMS', 
            onExpiry: waktuHabis,
            onTick: hampirHabis
        });
    });

    // 3. LOGIKA AUTOSAVE (AJAX)
    $(document).ready(function() {
        $('input[type="radio"]').on('change', function() {
            var id_soal     = $(this).attr('name').replace('jawaban[', '').replace(']', '');
            var jawaban     = $(this).val();
            var id_peserta  = $('input[name="id_peserta"]').val();

            $('#status-save').html('<span style="color:#f39c12"><i class="fa fa-spinner fa-spin"></i> Menyimpan...</span>').css('background', '#fff3cd');

            $.ajax({
                url: "<?php echo base_url(); ?>ruang_ujian/simpan_satu_jawaban", 
                type: "POST",
                dataType: "json",
                data: {
                    id_peserta: id_peserta,
                    id_soal: id_soal,
                    jawaban: jawaban
                },
                success: function(response) {
                    $('#status-save').html('<span style="color:#28a745"><i class="fa fa-check"></i> Jawaban Tersimpan</span>').css('background', '#d4edda');
                },
                error: function(xhr, status, error) {
                    console.log("Autosave Error: Pastikan controller simpan_satu_jawaban sudah dibuat.");
                    $('#status-save').html('<span style="color:#dc3545"><i class="fa fa-exclamation-circle"></i> Gagal Autosave (Simpan Manual)</span>').css('background', '#f8d7da');
                }
            });
        });
    });

    // 4. Mencegah Back Button
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };

</script>

<?php $this->load->view('ujian/foot'); ?>