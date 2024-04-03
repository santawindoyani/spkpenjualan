<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function process_login($username, $password) {
        // Query untuk memeriksa username dan password di database

        
        $this->db->select('*');
		$this->db->from('users');
		$this->db->where_in('username', $username);
		$this->db->where_in('password', $password);
		$query = $this->db->get();


        if ($query->num_rows() == 1) {
            // Jika username dan password benar, kembalikan data login
            return $query->row_array();
        } else {
            // Jika username atau password salah, kembalikan false
            return false;
        }
    }

}
