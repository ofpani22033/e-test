<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_jadwal_ujian extends CI_Model
{
    public function jadwal_ujian()
    {
        $this->db->select('*');
        $this->db->from('tb_hasil_ujian');
        $this->db->join('tb_matapelajaran', 'tb_hasil_ujian.id_matapelajaran=tb_matapelajaran.id_matapelajaran');
        $this->db->join('tb_siswa', 'tb_hasil_ujian.id_siswa=tb_siswa.id_siswa');
        $this->db->where('tb_hasil_ujian.id_peserta', $id);
        $query = $this->db->get();
        return $query->result();
    }
}
