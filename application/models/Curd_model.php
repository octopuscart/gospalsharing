<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Curd_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function query($query) {
        $query = $this->db->query($query);
        $data = $query->result_array();
        return $data; //format the array into json data
    }

    public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $insert_id = $this->db->insert_id();
    }

    public function get($table, $order_by = 'asc') {
        $this->db->order_by('id', $order_by);
        $query = $this->db->get($table);
        $data = $query->result_array();
        return $data;
    }

    public function get_single($table, $id) {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        $data = $query->row();
        return $data;
    }

    public function get_perticular($table, $field, $id) {
        $this->db->where($field, $id);
        $query = $this->db->get($table);
        $data = $query->result_array();
        return $data;
    }

    public function delete($table, $id) {
        $this->db->where('id', $id);
        $query = $this->db->delete($table);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function uploadImage($FILEOBJ, $exitimage = "") {
        $config['upload_path'] = 'assets/uploads';
        $config['allowed_types'] = '*';
        $temp = $this->generateRandomString(30);
        $config['overwrite'] = TRUE;
        $ext1 = explode('.', $FILEOBJ['picture']['name']);
        $file_newname = $exitimage ? $exitimage : $temp;
        $picture = $file_newname;
        $config['file_name'] = $file_newname;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('picture')) {
            $uploadData = $this->upload->data();
            $this->resizeImage($uploadData['file_name']);
            return $uploadData['file_name'];
        } else {
            $picture = '';
            return $picture;
        }
    }

    public function resizeImage($filename) {
        $source_path = 'assets/uploads/' . $filename;
        $target_path = 'assets/uploads/';
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'width' => 1000,
        );
        $this->load->library('image_lib', $config_manip);
        if (!$this->image_lib->resize()) {
            $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
    }

    function curdForm($data) {
        $table_name = $data["table_name"];
        $form_attr = $data['form_attr'];
        if (isset($_POST['submitData'])) {
            $postarray = array();
            foreach ($form_attr as $key => $value) {
                $postarray[$key] = $this->input->post($key);
            }
            $this->Curd_model->insert($table_name, $postarray);
            redirect($data["link"]);
        }
        $categories_data = $this->Curd_model->get($table_name);
        $data['list_data'] = $categories_data;
        $fields = array();
        $fields["id"] = array("title" => "ID#", "width" => "100px");
        $fields = array_merge($fields, $form_attr);
        $data['fields'] = $fields;
        $data['form_attr'] = $form_attr;
        return $data;
    }

}

?>