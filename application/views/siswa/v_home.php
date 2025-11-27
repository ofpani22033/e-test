<?php 
$this->load->view('siswa/head');
?>

<style>

:root {
    /* Warna Primer: Biru tua yang elegan */
    --primary-color: #0073b7; /* Midnight Blue */
    --primary-light: #0073b7;
    --secondary-color: #15a9ffff; /* Hijau untuk Aksen/Sukses */
}

/* KARTU SELAMAT DATANG (CALLOUT) */
.callout.callout-info {
    /* Menggunakan warna primer yang baru */
    background-color: var(--primary-color) !important;
    border-left: 5px solid var(--secondary-color) !important; /* Aksen hijau */
    color: #fff !important;
    border-radius: 6px; /* Sudut membulat */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan halus */
    padding: 20px;
}
.callout.callout-info h4 {
    color: #fff !important;
    font-weight: 600; /* Lebih tebal sedikit */
    margin: 0;
    display: flex;
    align-items: center;
}
.callout.callout-info h4 i {
    margin-right: 10px;
}

/* KOTAK UTAMA (BOX) */
.box.box-primary {
    border-top: none !important; /* Hapus border top bawaan */
    border-radius: 6px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Bayangan lebih jelas untuk box utama */
}

.box.box-primary.box-solid > .box-header {
    background-color: var(--primary-color) !important; /* Warna header box */
    color: #fff !important;
    border-bottom: 3px solid var(--secondary-color) !important; /* Border bawah header */
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    padding: 15px;
}
.box.box-primary.box-solid {
    border: 1px solid #ddd !important; /* Border abu-abu terang */
}
.box.box-primary .box-body {
    background-color: #fff !important;
    color: #333 !important; /* Teks lebih gelap agar mudah dibaca */
    padding: 25px;
}

/* STYLING PETUNJUK */
.box-body dl {
    margin: 0;
}
.box-body dd ol {
    padding-left: 20px;
    line-height: 1.8;
}
.box-body dd ol li {
    margin-bottom: 15px;
}
.box-body dd ol li b {
    color: var(--primary-color);
    font-size: 1.1em;
}
</style>

<?php
$this->load->view('siswa/topbar');
$this->load->view('siswa/sidebar');
?>

<section class="content">

    <div class="callout callout-info">
        <h4><i class="fa fa-handshake-o"></i> Selamat Datang, <?php echo $this->session->userdata('nama');?> </h4>
    </div>

    <div class="box box-primary box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-info-circle"></i> Petunjuk Penggunaan Ujian Online</h3>
        </div><div class="box-body">
            <dl>
                <dt></dt>
                <dd>
                    <ol>
                        <li><b>Jadwal Ujian</b></li>
                        Di TAB Jadwal Ujian, Anda dapat melihat daftar ujian yang berhak Anda ikuti. Klik tombol Mulai ketika jam ujian telah tiba. Segera hubungi administrator jika jadwal tidak muncul.
                        <li><b>Hasil Ujian</b></li>
                        Di TAB Hasil Ujian, Anda dapat langsung melihat nilai dan status kelulusan dari setiap ujian yang sudah Anda selesaikan.
                        <li><b>Ganti Password</b></li>
                        Di TAB Ganti Password, Fitur untuk mengubah password bawaan dari administrator menjadi password pribadi Anda. Jika lupa password, hubungi administrator untuk reset.
                    </ol>
                </dd>
            </dl>
        </div></div>

</section><?php 
$this->load->view('siswa/js');
?>

<script type="text/javascript">

    $(function(){
        $('#data-tables').dataTable();
    });

    // Durasi alert message diperpanjang sedikit
    $('.alert-message').alert().delay(4000).slideUp('slow'); 

</script>


<?php
$this->load->view('admin/foot');
?>