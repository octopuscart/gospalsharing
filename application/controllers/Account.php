<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

        $this->db->select("password");
        $this->db->where("user_type", "admin");
        $query = $this->db->get('admin_users');

        $passwordq = $query->row();
        $this->gblpassword = $passwordq->password;
        $this->userdata = $this->session->userdata('logged_in');
    }

   

}

?>
