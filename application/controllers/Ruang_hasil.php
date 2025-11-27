<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruang_hasil extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        // Cek status login
        if ($this->session->userdata('status') !='siswa_login') {
            redirect(base_url('auth'));
        }       
    }

    public function index() 
    {
        // 🚀 INI ADALAH PERBAIKANNYA: Ambil ID menggunakan kunci 'id_siswa'
        // dan metode CodeIgniter. Ini akan menghilangkan Notice dan juga redirect.
        $id_siswa = $this->session->userdata('id_siswa'); 
        
        // Pengecekan keamanan: Jika ID tidak ditemukan (walaupun seharusnya sudah dicek di __construct)
        if (!$id_siswa) { 
            // Jika Anda sampai sini, ada masalah sesi yang serius, tapi redirect adalah tindakan aman.
            redirect(base_url('auth')); 
            return;
        }

        $data['hasil'] = $this->m_data->get_peserta($id_siswa);
        $this->load->view('siswa/v_hasil', $data);
    }
}