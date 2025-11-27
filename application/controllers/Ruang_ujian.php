<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruang_ujian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'siswa_login') {
            redirect(base_url() . 'auth?alert=belum_login');
        }
        // Load Model m_data di sini agar bisa dipakai di semua fungsi
        $this->load->model('m_data'); 
    }

    public function soal()
    {
        $id_peserta = $this->uri->segment(3);       
        $id = $this->db->query('SELECT * FROM tb_hasil_ujian WHERE id_peserta="' . $id_peserta . '"  ')->row_array();
        
        // Ambil soal
        $soal_ujian = $this->db->query('SELECT * FROM tb_soal_ujian WHERE id_matapelajaran="'.$id['id_matapelajaran'].'" ORDER BY RAND()');
        
        // Update status ujian
        $where = array('id_peserta' => $id_peserta);
        $data2 = array('status_ujian' => 1);
        $this->m_data->update_data($where,$data2,'tb_hasil_ujian');
        
        // --- TAMBAHAN BARU: AMBIL JAWABAN SISWA YANG TERSIMPAN ---
        $list_jawaban = $this->db->query("SELECT id_soal_ujian, jawaban FROM tb_jawaban WHERE id_peserta = '$id_peserta'")->result();
        
        // Kita ubah formatnya jadi Array biar mudah dicek di View
        // Format: [ID_SOAL => 'JAWABAN'] contoh: [5 => 'A', 8 => 'C']
        $jawaban_siswa = [];
        foreach($list_jawaban as $j){
            $jawaban_siswa[$j->id_soal_ujian] = $j->jawaban;
        }
        // ----------------------------------------------------------

        $time = $id['timer_ujian'];
        $data = array(
            "soal" => $soal_ujian->result(),
            "total_soal" => $soal_ujian->num_rows(),
            "max_time" => $time,
            "id" => $id,
            "jawaban_siswa" => $jawaban_siswa // <--- Kirim data ini ke View
        );
        $this->load->view('ujian/v_soalujian', $data);
    }

    // FUNGSI INI DIUBAH AGAR TIDAK BENTROK DENGAN AUTOSAVE
    public function jawab_aksi()
    {
        $id_peserta = $this->input->post('id_peserta');
        $jumlah     = $this->input->post('jumlah_soal');
        $id_soal    = $this->input->post('soal'); // Array ID Soal
        $jawaban    = $this->input->post('jawaban'); // Array Jawaban
        
        // REVISI: Jangan pakai insert_batch, karena data mungkin sudah ada dari Autosave.
        // Kita loop satu per satu untuk update/insert (Upsert).
        if(!empty($id_soal)){
            for ($i = 0; $i < $jumlah; $i++) {
                $nomor = $id_soal[$i];
                
                // Cek apakah siswa menjawab soal ini?
                if(isset($jawaban[$nomor])){
                    $isi_jawaban = $jawaban[$nomor];
                    // Panggil fungsi yang sama dengan Autosave (Update jika ada, Insert jika baru)
                    $this->m_data->simpan_jawaban_satu($id_peserta, $nomor, $isi_jawaban);
                }
            }
        }

        // --- BAGIAN PENILAIAN (GRADING) ---
        // Logika di bawah ini tetap sama, menghitung skor berdasarkan tb_jawaban yang sudah tersimpan
        
        $cek = $this->db->query('SELECT id_jawaban, jawaban, tb_soal_ujian.kunci_jawaban FROM tb_jawaban join tb_soal_ujian ON tb_jawaban.id_soal_ujian=tb_soal_ujian.id_soal_ujian WHERE id_peserta="' . $id_peserta . '"');
        
        foreach ($cek->result_array() as $d) {
            $where = array('id_jawaban' => $d['id_jawaban']);
            if ($d['jawaban'] == $d['kunci_jawaban']) {
                $data = array('skor' => 1);
            } else {
                $data = array('skor' => 0);
            }
            $this->m_data->UpdateNilai($d['id_jawaban'], $data); // Revisi parameter update
        }

        $benar = 0;
        $salah = 0;
        $total_nilai = 0;
        
        $cek2 = $this->db->query('SELECT id_jawaban, jawaban, skor, tb_soal_ujian.kunci_jawaban FROM tb_jawaban join tb_soal_ujian ON tb_jawaban.id_soal_ujian=tb_soal_ujian.id_soal_ujian WHERE id_peserta="' . $id_peserta . '"');
        $jumlah_soal_dikerjakan = $cek2->num_rows(); // Pakai num_rows jawaban masuk
        
        // Hati-hati pembagian dengan nol
        if($jumlah_soal_dikerjakan > 0){
             foreach ($cek2->result_array() as $c) {
                if ($c['jawaban'] == $c['kunci_jawaban']) {
                    $benar++;
                } else {
                    $salah++;
                }
            }
            // Rumus Nilai: (Benar / Total Soal Ujian) * 100
            // Note: $jumlah diambil dari POST jumlah_soal (total soal asli)
            $total_nilai = ($benar / $jumlah) * 100;
        }

        $data_hasil = array(
            'benar' => $benar,
            'salah' => $salah,
            'status_ujian' => 2,
            'nilai' => $total_nilai
        );
        
        $where_peserta = array('id_peserta' => $id_peserta); // Perbaiki format where
        $this->m_data->UpdateNilai2($id_peserta, $data_hasil);
        
        redirect(base_url('jadwal_ujian'));
    }

    // FUNGSI KHUSUS AUTOSAVE (AJAX)
    public function simpan_satu_jawaban() {
        // 1. Ambil data
        $id_peserta = $this->input->post('id_peserta');
        $id_soal    = $this->input->post('id_soal');
        $jawaban    = $this->input->post('jawaban');

        // 2. Validasi & Eksekusi
        if($id_peserta && $id_soal && $jawaban) {
            
            // Panggil fungsi di M_data yang sudah kita buat tadi
            $this->m_data->simpan_jawaban_satu($id_peserta, $id_soal, $jawaban);
            
            echo json_encode(['status' => 'sukses']);
        } else {
            echo json_encode(['status' => 'gagal']);
        }
    }
}