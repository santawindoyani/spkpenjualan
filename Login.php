<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mlogin');
		
    }

    public function index() {
        // Tampilkan halaman login
		
        $this->load->view('login/index');
    }

    public function process_login() {
        // Tangkap data input dari form
        $username = $this->input->post('username');
        $password = $this->input->post('password');
	
        // Panggil fungsi untuk melakukan proses login
        $login_data = $this->Mlogin->process_login($username, $password);
		
        if ($login_data) {
            // Jika login berhasil, simpan data login ke session
            $this->session->set_userdata('user_id', $login_data['user_id']);
            $this->session->set_userdata('username', $login_data['username']);
            $this->session->set_userdata('isLogin', true);
			
            
            // Redirect ke halaman dashboard atau halaman lainnya
			redirect(base_url());
           

        } else {
            // Jika login gagal, tampilkan pesan error
            redirect(base_url('login'));
        }
    }

    public function logout() {
        // Hapus semua data login dari session
        $this->session->sess_destroy();

        // Redirect ke halaman login
        redirect(base_url());
    }

}
