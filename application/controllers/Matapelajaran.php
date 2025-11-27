<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class matapelajaran extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('status') !='admin_login') {
            redirect(base_url('auth'));
        }
        // Pastikan model m_data sudah di-load, bisa di-autoload atau di sini
        // $this->load->model('m_data');
    }

    public function index()
    {
        // [PERBAIKAN] JOIN dengan tb_guru untuk menampilkan nama guru di tabel
        $data['mapel'] = $this->db->query("
            SELECT tb_matapelajaran.*, tb_guru.nama_guru 
            FROM tb_matapelajaran 
            LEFT JOIN tb_guru ON tb_matapelajaran.id_guru = tb_guru.id_guru
        ")->result();
        
        $this->load->view('admin/v_mapel', $data);
    }

    // [UBAH] Mengganti mapel_aksi() menjadi create() dan menambahkan validasi
    public function create()
    {
        // Aturan validasi
        $this->form_validation->set_rules('kode', 'Kode Mapel', 'required|trim|is_unique[tb_matapelajaran.kode_matapelajaran]', [
            'required' => 'Kode Mapel harus diisi!',
            'is_unique' => 'Kode Mapel ini sudah ada!'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Mapel', 'required|trim', [
            'required' => 'Nama Mapel harus diisi!'
        ]);
        $this->form_validation->set_rules('id_guru', 'Guru', 'required', [
            'required' => 'Guru Pengajar harus dipilih!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal atau halaman baru dibuka
            // [TAMBAHAN] Kirim data semua guru ke view
            $data['guru'] = $this->m_data->get_data('tb_guru')->result();
            
            $this->load->view('admin/v_mapel_tambah', $data); // Load view form tambah
        } else {
            // Jika validasi sukses
            $kode    = $this->input->post('kode');
            $nama    = $this->input->post('nama');
            $id_guru = $this->input->post('id_guru'); // <-- AMBIL DATA BARU

            $data = array(
                'kode_matapelajaran' => $kode,
                'nama_matapelajaran' => $nama,
                'id_guru'            => $id_guru // <-- SIMPAN DATA BARU
            );
            $this->m_data->insert_data($data, 'tb_matapelajaran');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Anda telah berhasil menambahkan data Mata Pelajaran</div>');
            redirect(base_url('matapelajaran'));
        }
    }

    public function hapus($id) 
    {
        $where = array(
            'id_matapelajaran' => $id
        );
        $this->m_data->delete_data($where,'tb_matapelajaran');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Anda telah berhasil menghapus data Mata Pelajaran</div>');
        redirect(base_url('matapelajaran'));
    }

    public function edit($id) 
    {
        $where = array('id_matapelajaran' => $id);
        $data['mapel'] = $this->m_data->edit_data($where,'tb_matapelajaran')->result();

        // [TAMBAHAN] Kirim data semua guru untuk dropdown
        $data['guru'] = $this->m_data->get_data('tb_guru')->result();
        
        $this->load->view('admin/v_mapel_edit', $data);
    }

    public function update()
    {
        $id      = $this->input->post('id');
        $kode    = $this->input->post('kode');
        $nama    = $this->input->post('nama');
        $id_guru = $this->input->post('id_guru'); // <-- AMBIL DATA BARU

        // (Opsional) Anda bisa tambahkan validasi form di sini juga
        // jika kode mapel diedit dan sama dengan yang lain.

        $where = array('id_matapelajaran' => $id);
        $data = array(
            'kode_matapelajaran' => $kode,
            'nama_matapelajaran' => $nama,
            'id_guru'            => $id_guru // <-- UPDATE DATA BARU
        );
        $this->m_data->update_data($where, $data, 'tb_matapelajaran');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Anda telah berhasil mengupdate data Mata Pelajaran</div>');
        redirect(base_url('matapelajaran'));
    }
}