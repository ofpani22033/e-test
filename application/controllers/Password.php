<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (
            $this->session->userdata('status') != 'admin_login' &&
            $this->session->userdata('status') != 'guru_login' &&
            $this->session->userdata('status') != 'siswa_login'
        ) {
            redirect(base_url('auth'));
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('password1', 'Password Baru', 'required|trim|min_length[6]|matches[password2]', [
            'required'      => 'Silahkan Masukan Password Baru Anda !',
            'matches'       => 'Password tidak sama !',
            'min_length'    => 'Password Harus Lebih dari 6 Karakter'
        ]);

        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

        // Jika validasi gagal -> tampilkan halaman password
        if ($this->form_validation->run() == false) {

            if ($this->session->userdata('status') == 'admin_login') {
                $this->load->view('admin/v_password');

            } else if ($this->session->userdata('status') == 'guru_login') {
                $this->load->view('admin/v_password_guru');

            } else if ($this->session->userdata('status') == 'siswa_login') {
                $this->load->view('siswa/v_password');
            }

        } 
        // Jika validasi benar -> lakukan UPDATE password
        else {

            $baru = $this->input->post('password1');
            
            // Cek role untuk memilih tabel & field yang benar
            if ($this->session->userdata('status') == 'admin_login') {

                $id = $this->session->userdata('id'); // Ambil session 'id'
                $where = array('id' => $id);
                $data   = array('password' => $baru);
                $this->m_data->update_data($where, $data, 'tb_admin');

            } else if ($this->session->userdata('status') == 'guru_login') {

                $id = $this->session->userdata('id_guru'); // Ambil session 'id_guru'
                $where = array('id_guru' => $id);
                $data   = array('password' => $baru);
                $this->m_data->update_data($where, $data, 'tb_guru');

            } else { // Ini adalah blok untuk siswa_login

                $id = $this->session->userdata('id_siswa'); // Ambil session 'id_siswa'
                $where = array('id_siswa' => $id);
                $data   = array('password' => $baru);
                $this->m_data->update_data($where, $data, 'tb_siswa');
            }

            $this->session->set_flashdata(
                'message', 
                '<div class="alert alert-success alert-message"><b>Sukses!</b> Password berhasil diganti.</div>'
            );

            redirect(base_url('password'));
        }
    }
}