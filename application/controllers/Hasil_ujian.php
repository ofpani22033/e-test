<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil_ujian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (
            $this->session->userdata('status') != 'admin_login' &&
            $this->session->userdata('status') != 'guru_login'
        ) {
            redirect(base_url('auth'));
        }

        $this->load->model('m_hasil');
        $this->load->model('m_data'); 
        $this->load->library('mypdf');
    }

    public function index()
    {
        $id_mapel = $this->input->get('id');
        $id_kelas = $this->input->get('id_kelas');
        
        $status = $this->session->userdata('status');
        $id_guru_session = $this->session->userdata('id_guru'); 

        if ($status == 'admin_login') {
            $data['data_matapelajaran'] = $this->m_data->get_data('tb_matapelajaran')->result();
        } else {
            $where_guru = array('id_guru' => $id_guru_session);
            $data['data_matapelajaran'] = $this->m_data->edit_data($where_guru, 'tb_matapelajaran')->result();
        }
        $data['data_kelas'] = $this->m_data->get_data('tb_kelas')->result();

        // QUERY UTAMA
        $this->db->select('tb_hasil_ujian.*, tb_siswa.nama_siswa, tb_siswa.nis, tb_kelas.nama_kelas, tb_matapelajaran.nama_matapelajaran, tb_jenis_ujian.jenis_ujian');
        $this->db->from('tb_hasil_ujian');
        
        // Joins Standar
        $this->db->join('tb_siswa', 'tb_hasil_ujian.id_siswa = tb_siswa.id_siswa');
        $this->db->join('tb_matapelajaran', 'tb_hasil_ujian.id_matapelajaran = tb_matapelajaran.id_matapelajaran');
        $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas');

        // --- PERBAIKAN DI SINI ---
        // Sebelumnya error karena 'tb_hasil_ujian.jenis_ujian' tidak ada.
        // Kita ganti menjadi 'tb_hasil_ujian.id_jenis_ujian' (Nama standar ID).
        // Jika ini masih error, berarti kita perlu cek database Anda.
        $this->db->join('tb_jenis_ujian', 'tb_jenis_ujian.id_jenis_ujian = tb_hasil_ujian.id_jenis_ujian', 'left');
        // --------------------------

        if ($id_mapel) {
            $this->db->where('tb_hasil_ujian.id_matapelajaran', $id_mapel);
        }
        if ($id_kelas) {
            $this->db->where('tb_siswa.id_kelas', $id_kelas);
        }
        if ($status == 'guru_login') {
            $this->db->where('tb_matapelajaran.id_guru', $id_guru_session);
        }

        $data['hasil'] = $this->db->get()->result();
        
        $this->load->view('admin/v_hasil', $data);
    }

    public function print_all()
    {
        $id_mapel = $this->input->get('id'); 
        $id_kelas = $this->input->get('id_kelas'); 
        $status = $this->session->userdata('status');
        $id_guru_session = $this->session->userdata('id_guru');

        $this->db->select('tb_hasil_ujian.*, tb_siswa.nama_siswa, tb_siswa.nis, tb_kelas.nama_kelas, tb_matapelajaran.nama_matapelajaran, tb_jenis_ujian.jenis_ujian');
        $this->db->from('tb_hasil_ujian');
        
        $this->db->join('tb_siswa', 'tb_hasil_ujian.id_siswa = tb_siswa.id_siswa');
        $this->db->join('tb_matapelajaran', 'tb_hasil_ujian.id_matapelajaran = tb_matapelajaran.id_matapelajaran');
        $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas');
        
        // --- JOIN DENGAN ID_JENIS_UJIAN ---
        $this->db->join('tb_jenis_ujian', 'tb_jenis_ujian.id_jenis_ujian = tb_hasil_ujian.id_jenis_ujian', 'left');
        // ----------------------------------

        if ($id_mapel) {
            $this->db->where('tb_hasil_ujian.id_matapelajaran', $id_mapel);
        }
        if ($id_kelas) {
            $this->db->where('tb_siswa.id_kelas', $id_kelas);
        }
        if ($status == 'guru_login') {
            $this->db->where('tb_matapelajaran.id_guru', $id_guru_session);
        }

        $data['cetak'] = $this->db->get()->result();
        $this->mypdf->generate('admin/v_cetak', $data, 'Cetak Hasil Ujian', 'A4', 'Landscape');
    }

    public function cetak($id_peserta)
    {
        $this->db->select('tb_hasil_ujian.*, tb_siswa.nama_siswa, tb_siswa.nis, tb_kelas.nama_kelas, tb_matapelajaran.nama_matapelajaran, tb_jenis_ujian.jenis_ujian');
        $this->db->from('tb_hasil_ujian');
        
        $this->db->join('tb_siswa', 'tb_hasil_ujian.id_siswa = tb_siswa.id_siswa');
        $this->db->join('tb_matapelajaran', 'tb_hasil_ujian.id_matapelajaran = tb_matapelajaran.id_matapelajaran');
        $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas');
        
        // --- JOIN DENGAN ID_JENIS_UJIAN ---
        $this->db->join('tb_jenis_ujian', 'tb_jenis_ujian.id_jenis_ujian = tb_hasil_ujian.id_jenis_ujian', 'left');
        // ----------------------------------

        $this->db->where('tb_hasil_ujian.id_peserta', $id_peserta);

        $status = $this->session->userdata('status');
        if ($status == 'guru_login') {
            $id_guru_session = $this->session->userdata('id_guru');
            $this->db->where('tb_matapelajaran.id_guru', $id_guru_session);
        }

        $data['cetak'] = $this->db->get()->result();
        
        if (empty($data['cetak'])) {
             $this->session->set_flashdata(
                'message', 
                '<div class="alert alert-danger alert-message">Hasil ujian tidak ditemukan atau Anda tidak memiliki hak akses.</div>'
            );
            redirect(base_url('hasil_ujian'));
        } else {
             $this->mypdf->generate('admin/v_cetak', $data, 'Cetak Hasil Ujian', 'A4', 'Landscape');
        }
    }
}