<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soal_ujian extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        if ($this->session->userdata('status') !='admin_login') {
            if ($this->session->userdata('status') !='guru_login'){
                redirect('auth');
            }
        }
        $this->load->model('m_soal');
        $this->load->model('m_data'); // Pastikan model ini diload
    }

    public function index()
    {   
        // Ambil ID mapel dari URL (jika ada filter)
        $id = $this->input->get('id');

        // GUNAKAN QUERY BUILDER (LEBIH AMAN & RAPI)
        $this->db->select('tb_soal_ujian.*, tb_matapelajaran.nama_matapelajaran, tb_matapelajaran.kode_matapelajaran');
        $this->db->from('tb_soal_ujian');
        $this->db->join('tb_matapelajaran', 'tb_soal_ujian.id_matapelajaran = tb_matapelajaran.id_matapelajaran');
        
        // Jika ada filter ID Mapel
        if ($id) {
            $this->db->where('tb_soal_ujian.id_matapelajaran', $id);
        }
        
        $this->db->order_by('id_soal_ujian', 'desc');
        
        // Masukkan ke variabel data
        $data['soal_ujian'] = $this->db->get()->result();
        
        // Ambil data kelas untuk dropdown filter
        $data['kelas'] = $this->m_data->get_data('tb_matapelajaran')->result();

        // Load View
        $this->load->view('admin/v_soal_ujian', $data);
    }

    public function tambah()
    {
        // Fungsi untuk menampilkan halaman tambah
        $data['soal'] = $this->m_data->get_data('tb_matapelajaran')->result();
        // Pastikan Anda punya file view v_soal_ujian_tambah.php atau sesuaikan namanya
        // Jika file tambah Anda namanya 'v_tambah', ubah baris bawah ini.
        $this->load->view('admin/v_soal_ujian_tambah', $data); 
    }

    public function insert()
    {
        $nama_matapelajaran = $this->input->post('id_matapelajaran'); // Sesuaikan name di form
        $soal               = $this->input->post('soal');
        $a                  = $this->input->post('a');
        $b                  = $this->input->post('b');
        $c                  = $this->input->post('c');
        $d                  = $this->input->post('d');
        $e                  = $this->input->post('e');
        $kunci              = $this->input->post('kunci');

        $data = array(
            'id_matapelajaran' => $nama_matapelajaran,
            'pertanyaan'       => $soal,
            'a'                => $a,
            'b'                => $b,
            'c'                => $c,
            'd'                => $d,
            'e'                => $e,
            'kunci_jawaban'    => $kunci
        );

        $this->m_data->insert_data($data, 'tb_soal_ujian');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Data Berhasil Ditambahkan!</h4></div>');
        redirect(base_url('soal_ujian'));
    }

    public function edit($id)
    {
        // Pastikan model m_soal punya fungsi get_joinsoal
        // Jika error, ganti query manual disini
        $this->db->select('*');
        $this->db->from('tb_soal_ujian');
        $this->db->join('tb_matapelajaran', 'tb_soal_ujian.id_matapelajaran = tb_matapelajaran.id_matapelajaran');
        $this->db->where('id_soal_ujian', $id);
        $data['soal'] = $this->db->get()->result();
        
        $data['kelas'] = $this->m_data->get_data('tb_matapelajaran')->result();       
        $this->load->view('admin/v_soal_ujian_edit', $data);        
    }

    public function update()
    {
        $id                 = $this->input->post('id');
        $nama_matapelajaran = $this->input->post('nama_matapelajaran');
        $soal               = $this->input->post('soal');
        $a                  = $this->input->post('a');
        $b                  = $this->input->post('b');
        $c                  = $this->input->post('c');
        $d                  = $this->input->post('d');
        $e                  = $this->input->post('e');
        $kunci              = $this->input->post('kunci');

        $where = array('id_soal_ujian' => $id);
        $data = array(
            'id_matapelajaran' => $nama_matapelajaran,
            'pertanyaan'       => $soal,
            'a'                => $a,
            'b'                => $b,
            'c'                => $c,
            'd'                => $d,
            'e'                => $e,
            'kunci_jawaban'    => $kunci
        );

        $this->m_data->update_data($where, $data, 'tb_soal_ujian');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Data Berhasil Diupdate!</h4></div>');
        redirect(base_url('soal_ujian'));
    }   

    public function hapus($id) 
    {
        $where = array('id_soal_ujian' => $id);
        $this->m_data->delete_data($where,'tb_soal_ujian');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Data Berhasil Dihapus!</h4></div>');
        redirect(base_url('soal_ujian'));
    }
}