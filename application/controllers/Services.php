<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('Curd_model');

        $session_user = $this->session->userdata('logged_in');
        if ($session_user) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
        $this->user_type = $this->session->logged_in['user_type'];
    }

    public function index() {
        redirect('/');
    }

    function systemLogReport() {
        $data = array();
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('system_log');
        $systemlog = $query->result();
        $data['systemlog'] = $systemlog;
        $this->load->view("Services/systemLogReport", $data);
    }

    public function appSettings() {
        $data = array();
        $query = $this->db->get('configuration_attr');
        $settingslog = $query->result_array();
        $settings = array(
            "data_version" => array("title" => "Data Version"),
            "story_language" => array("title" => "Default Language Id"),
            "font_size" => array("title" => "Default Text Size"));
        $settingarray = array();
        foreach ($settingslog as $key => $value) {
            $attrtyipe = $value["attr_type"];
            if (isset($settings[$attrtyipe])) {
                $settingarray[$attrtyipe] = array("title" => $settings[$attrtyipe]["title"], "data" => $value);
            }
        }

        if (isset($_POST['submit'])) {
            $attr_value = $this->input->post("attr_value");
            $attr_type = $this->input->post("attr_type");
            $updatedata = array(
                "attr_value" => $attr_value
            );
            $this->db->set($updatedata);
            $this->db->where("attr_type", $attr_type);
            $this->db->update('configuration_attr');
            redirect("Services/appSettings");
        }

        $data['settings'] = $settingarray;
        $this->load->view("Services/settings", $data);
    }

}

?>
