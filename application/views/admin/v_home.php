<?php 
// Memuat Head (diharapkan sudah berisi semua fix CSS layout)
$this->load->view('admin/head');
?>

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<section class="content-header">
    <h1>
        Dashboard Administrator
        <small>E-Test</small>
    </h1>
</section>

<section class="content">

    <div class="callout callout-info">
        <h4>Selamat Datang di E-Test!</h4>
        <p>Anda login sebagai <?php echo $this->session->userdata('nama'); ?>. Gunakan panel navigasi di sebelah kiri untuk mengelola data ujian secara terpusat.</p>
    </div>

    <div class="row">
        <div class="col-md-12"> 
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> Petunjuk Penggunaan Administrator</h3>
                </div>
                <div class="box-body">
                    <p>
                        Selamat datang di <b>E-Test!</b> Sistem ini dirancang untuk memfasilitasi ujian online. 
                        Silakan ikuti panduan penggunaan di bawah ini sesuai dengan peran Anda.
                    </p>

                    <p>
                        <b>Sebagai Admin</b>, Anda memiliki kontrol penuh atas seluruh data terpusat. Anda bertanggung jawab untuk mempersiapkan data pengguna (Guru dan Siswa) serta mengelola pelaksanaan ujian secara keseluruhan.
                    </p>

                    <p>Berikut adalah urutan langkah penggunaan aplikasi untuk Admin:</p>

                    <ol>
                        <li><b>Login ke Sistem</b>
                            <ul>
                                <li>Buka halaman login aplikasi E-Test.</li>
                                <li>Masukkan Username dan Password Anda sebagai Admin.</li>
                                <li>Klik “Login” untuk masuk ke Dashboard utama Admin.</li>
                            </ul>
                        </li>
                        <li><b>Mengelola Akun Pengguna (Guru)</b>
                            <ul>
                                <li>Buka menu “Data Guru”.</li>
                                <li>Tambahkan data guru baru (NIP, nama, mata pelajaran, dll.).</li>
                                <li>Edit atau hapus data guru yang sudah ada.</li>
                            </ul>
                        </li>
                        <li><b>Mengelola Akun Pengguna (Siswa)</b>
                            <ul>
                                <li>Buka menu “Data Siswa”.</li>
                                <li>Tambah data siswa baru (NIS, nama, dll.).</li>
                                <li>Edit atau hapus data siswa dari sistem.</li>
                            </ul>
                        </li>
                        <li><b>Mengelompokkan Siswa ke Kelas</b>
                            <ul>
                                <li>Buka menu “Kelola Kelas”.</li>
                                <li>Buat kelas baru (misal: “X-A”, “XI-B”) lalu masukkan siswa yang sesuai.</li>
                            </ul>
                        </li>
                        <li><b>Mengelola Bank Soal Ujian</b>
                            <ul>
                                <li>Buka menu “Kelola Soal Ujian”.</li>
                                <li>Tambah, impor, atau validasi soal yang dibuat oleh guru.</li>
                            </ul>
                        </li>
                        <li><b>Membuat Sesi Ujian</b>
                            <ul>
                                <li>Buka menu “Ujian”.</li>
                                <li>Klik “Tambah Ujian Baru”.</li>
                                <li>Isi detail ujian seperti nama, mata pelajaran, durasi, dan jadwal.</li>
                            </ul>
                        </li>
                        <li><b>Menetapkan Peserta Ujian</b>
                            <ul>
                                <li>Buka menu “Kelola Peserta Ujian”.</li>
                                <li>Pilih sesi ujian dan tetapkan peserta berdasarkan kelas atau individu.</li>
                            </ul>
                        </li>
                        <li><b>Reset Password</b>
                            <ul>
                                <li><b>Reset Password:</b> mengatur ulang kata sandi akun Guru atau Siswa.</li>
                            </ul>
                        </li>
                    </ol>
                </div>
            </div>
            
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-server"></i> Status Sistem</h3>
                </div>
                <div class="box-body">
                    <p>Sistem E-Test berjalan normal. Pastikan semua data terkelola dengan baik sebelum sesi ujian dimulai.</p>
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
    // Inisialisasi DataTable di sini jika memang ada tabel di halaman ini
    // $('#data-tables').dataTable();
});
$('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('admin/foot');
?>