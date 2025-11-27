<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_hasil extends CI_Model
{
    // Fungsi pembantu untuk SELECT eksplisit
    private function _select_columns()
    {
        $this->db->select('
            tb_hasil_ujian.id_peserta, 
            tb_hasil_ujian.id_siswa,
            tb_hasil_ujian.id_matapelajaran,
            tb_hasil_ujian.tanggal_ujian,
            tb_hasil_ujian.jam_ujian,
            tb_hasil_ujian.benar,
            tb_hasil_ujian.salah,
            tb_hasil_ujian.nilai,
            
            /* INI KUNCI AGAR MUNCUL DI VIEW */
            tb_jenis_ujian.jenis_ujian, 
            
            tb_matapelajaran.nama_matapelajaran, 
            tb_siswa.nama_siswa, 
            tb_siswa.nis, 
            tb_siswa.nama_kelas' 
        );
    }

    private function _join_tables()
    {
        // HAPUS ALIAS (t1), GUNAKAN NAMA ASLI
        $this->db->from('tb_hasil_ujian'); 
        
        // Join ke tb_matapelajaran
        $this->db->join('tb_matapelajaran', 'tb_matapelajaran.id_matapelajaran = tb_hasil_ujian.id_matapelajaran', 'left'); 

        // Join ke tb_siswa
        $this->db->join('tb_siswa', 'tb_siswa.id_siswa = tb_hasil_ujian.id_siswa', 'left'); 

        // --- PERBAIKAN UTAMA: TAMBAHKAN 2 JOIN INI ---
        // 1. Join ke tb_ujian (jembatan)
        $this->db->join('tb_ujian', 'tb_ujian.id_ujian = tb_hasil_ujian.id_ujian', 'left');
        
        // 2. Join ke tb_jenis_ujian (target data)
        $this->db->join('tb_jenis_ujian', 'tb_jenis_ujian.id_jenis_ujian = tb_ujian.id_jenis_ujian', 'left');
    }

    // Fungsi untuk mendapatkan hasil berdasarkan ID Mata Pelajaran
    public function get_peserta2($id)
    {
        $this->_select_columns();
        $this->_join_tables();
        
        // Ganti t1 menjadi tb_hasil_ujian
        $this->db->where('tb_hasil_ujian.id_matapelajaran', $id);
        $this->db->group_by('tb_hasil_ujian.id_peserta'); 
        $this->db->order_by('tb_hasil_ujian.nilai', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk mendapatkan semua hasil (Cetak Semua)
    public function get_peserta3()
    {
        $this->_select_columns();
        $this->_join_tables();
        
        // Ganti t1 menjadi tb_hasil_ujian
        $this->db->group_by('tb_hasil_ujian.id_peserta'); 
        $this->db->order_by('tb_hasil_ujian.nilai', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk mendapatkan hasil berdasarkan ID Peserta (Cetak per siswa)
    public function cetak($id)
    {
        $this->_select_columns();
        $this->_join_tables();
        
        // Ganti t1 menjadi tb_hasil_ujian
        $this->db->where('tb_hasil_ujian.id_peserta', $id);
        
        $query = $this->db->get();
        return $query->result();
    }
}