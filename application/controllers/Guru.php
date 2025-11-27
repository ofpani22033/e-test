<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('status') != 'admin_login') {
            redirect(base_url('auth'));
        }
        
        // PASTIKAN LIBRARY SESSION DAN FORM_VALIDATION DIMUAT
        $this->load->library(['session', 'form_validation']);
        $this->load->model('m_data');
    }

    public function index()
    {
        $data['guru'] = $this->m_data->get_data('tb_guru')->result();
        $this->load->view('admin/v_guru', $data);
    }

    // Fungsi untuk menampilkan form dan memproses tambah data
    public function create()
    {
        // 2. TAMBAHKAN FORM VALIDATION
        $this->form_validation->set_rules('nik', 'NIK/NIP', 'required|trim|is_unique[tb_guru.id_guru]', [
            'required' => 'NIK/NIP harus diisi!',
            'is_unique' => 'NIK/NIP ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Guru', 'required|trim', [
            'required' => 'Nama guru harus diisi!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_guru.username]', [
            'required' => 'Username harus diisi!',
            'is_unique' => 'Username ini sudah digunakan!'
        ]);
        // Untuk Create, password wajib diisi
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password harus diisi!'
        ]);

        // 3. Tambahkan struktur IF/ELSE
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi GAGAL (atau form baru dibuka)
            $this->load->view('admin/v_guru_tambah');
        } else {
            // Jika validasi SUKSES
            $nik      = htmlspecialchars($this->input->post('nik', TRUE));
            $nama     = htmlspecialchars($this->input->post('nama', TRUE));
            $username = htmlspecialchars($this->input->post('username', TRUE));
            // Hashing password SANGAT disarankan
            $password = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT); 

            $data = array(
                'id_guru'   => $nik,
                'nama_guru' => $nama,
                'username'  => $username,
                'password'  => $password,
            );

            $this->m_data->insert_data($data, 'tb_guru');
            $this->session->set_flashdata( // PERBAIKAN: Menggunakan $this->session
                'message',
                '<div class="alert alert-success alert-message">
                    <i class="fa fa-check"></i> Data guru berhasil ditambahkan
                </div>'
            );
            redirect(base_url('guru'));
        }
    }

    public function hapus($id) 
    {
        $where = array('id_guru' => $id);
        $this->m_data->delete_data($where,'tb_guru');
        $this->session->set_flashdata( // PERBAIKAN: Menggunakan $this->session
            'message',
            '<div class="alert alert-danger alert-message">
                <i class="fa fa-check"></i> Data guru berhasil dihapus
            </div>'
        );
        redirect(base_url('guru'));
    }

    public function edit($id) 
    {
        $where = array('id_guru' => $id);
        $data['guru'] = $this->m_data->edit_data($where,'tb_guru')->result();
        $this->load->view('admin/v_guru_edit', $data);
    }

    public function update()
    {
        $id_lama = $this->input->post('id_lama', TRUE); // Ambil NIK lama untuk WHERE
        $id_baru = $this->input->post('nik', TRUE);     // Ambil NIK baru (jika diubah)
        $nama    = htmlspecialchars($this->input->post('nama', TRUE));
        $username_baru = htmlspecialchars($this->input->post('username', TRUE));
        $password = $this->input->post('password', TRUE);

        // Ambil data guru saat ini untuk validasi unik
        $guru_lama = $this->m_data->edit_data(['id_guru' => $id_lama], 'tb_guru')->row();

        // 7. TAMBAHKAN VALIDASI FORM UNTUK UPDATE
        
        // a. Validasi NIK/NIP (hanya unik jika NIK baru berbeda dengan NIK lama)
        if ($id_baru != $guru_lama->id_guru) {
            $this->form_validation->set_rules('nik', 'NIK/NIP', 'required|trim|is_unique[tb_guru.id_guru]', [
                'required' => 'NIK/NIP harus diisi!',
                'is_unique' => 'NIK/NIP ini sudah terdaftar!'
            ]);
        } else {
            $this->form_validation->set_rules('nik', 'NIK/NIP', 'required|trim', [
                'required' => 'NIK/NIP harus diisi!'
            ]);
        }
        
        // b. Validasi Nama
        $this->form_validation->set_rules('nama', 'Nama Guru', 'required|trim', [
            'required' => 'Nama guru harus diisi!'
        ]);
        
        // c. Validasi Username (hanya unik jika username baru berbeda dengan username lama)
        if ($username_baru != $guru_lama->username) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_guru.username]', [
                'required' => 'Username harus diisi!',
                'is_unique' => 'Username ini sudah digunakan!'
            ]);
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|trim', [
                'required' => 'Username harus diisi!'
            ]);
        }
        
        // d. Password (tidak perlu divalidasi required, karena opsional)
        
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi GAGAL, kembali ke halaman edit
            $where = array('id_guru' => $id_lama);
            $data['guru'] = $this->m_data->edit_data($where,'tb_guru')->result();
            $this->load->view('admin/v_guru_edit', $data);
        } else {
            // Jika validasi SUKSES
            $where = array('id_guru' => $id_lama);

            // 6. LOGIKA PASSWORD KOSONG
            if (empty($password)) {
                // Jika password tidak diubah
                $data = array(
                    'id_guru'   => $id_baru, // NIK diupdate
                    'nama_guru' => $nama,
                    'username'  => $username_baru
                );
                $this->m_data->update_data($where, $data, 'tb_guru');
            } else { 
                // Jika password diubah
                $data = array(
                    'id_guru'   => $id_baru, // NIK diupdate
                    'nama_guru' => $nama,
                    'username'  => $username_baru,
                    // Hashing password SANGAT disarankan
                    'password'  => password_hash($password, PASSWORD_DEFAULT), 
                );
                $this->m_data->update_data($where, $data, 'tb_guru');
            }

            // PERBAIKAN: Menggunakan $this->session untuk set_flashdata
            $this->session->set_flashdata( 
                'message',
                '<div class="alert alert-success alert-message">
                    <i class="fa fa-check"></i> Data guru berhasil diperbarui
                </div>'
            );
            redirect(base_url('guru'));
        }
    }
}