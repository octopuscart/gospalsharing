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

    function addCollection() {

        $data = array();
        $data['categories'] = array();

        $config['upload_path'] = 'assets/collection/front';
        $config['allowed_types'] = '*';
        if (isset($_POST['submit_data'])) {
            $picture = '';

            if (!empty($_FILES['picture']['name'])) {
                $temp1 = rand(100, 1000000);
                $config['overwrite'] = TRUE;
                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . $ext;
                $picture = $file_newname;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            }

            $movieArray = array(
                "image" => $picture,
                "access_code" => $this->input->post("access_code"),
                "title" => $this->input->post("title"),
                "description" => "",
            );

            $this->db->insert('set_collection', $movieArray);
            redirect("Account/getCollection");
        }

        $this->load->view('collection/addCollection', $data);
    }

    function editCollection($collection_id) {
        $data = array();
        $this->db->where("id", $collection_id);
        $query = $this->db->get('set_collection');
        $collectionobj = $query->row_array();

        $data['collectionobj'] = $collectionobj;

        $config['upload_path'] = 'assets/collection/front';
        $config['allowed_types'] = '*';
        if (isset($_POST['submit_data'])) {
            $picture = '';

            if (!empty($_FILES['picture']['name'])) {
                $temp1 = rand(100, 1000000);
                $config['overwrite'] = TRUE;
                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . $ext;
                $picture = $file_newname;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            }

            $movieArray = array(
                "access_code" => $this->input->post("access_code"),
                "title" => $this->input->post("title"),
                "description" => "",
            );
            if ($picture) {
                $this->db->set("image", $picture);
            }
            $this->db->set("title", $movieArray["title"]);
            $this->db->set("access_code", $movieArray["access_code"]);
            $this->db->where("id", $collection_id);
            $query = $this->db->update('set_collection');

            redirect("Account/getCollection");
        }

        $this->load->view('collection/editCollection', $data);
    }

    function getCollection() {
        $query = $this->db->get("set_collection");
        $result = $query->result_array();
        $data['collections'] = $result;
        $this->load->view('collection/collections', $data);
    }

    function removeCollection($collection_id) {
        $this->db->where("id", $collection_id)->delete("set_collection");
        redirect(site_url("Account/getCollection"));
    }

    function viewCollection($collection_id) {
        $this->db->where("collection_id", $collection_id);
        $query = $this->db->order_by("display_index")->get("set_collection_card");
        $result = $query->result_array();
        $data['collectionslist'] = $result;
        $data['ccollection_id'] = $collection_id;

        $this->db->where("id", $collection_id);
        $query = $this->db->get("set_collection");
        $collectobj = $query->row_array();
        $data['collectionsobj'] = $collectobj;
        if (isset($_POST['reindex'])) {
            $index_id = $this->input->post("card_id");
            $index_id_list = explode(",", $index_id);
            foreach ($index_id_list as $key => $value) {
                $this->db->set("display_index", $key)->where("id", $value)->update("set_collection_card");
            }
            redirect("Account/viewCollection/$collection_id");
        }

        $this->load->view('collection/collectionslist', $data);
    }

    function removeCollectionCard($card_id, $collection_id) {
        $this->db->where("id", $card_id)->delete("set_collection_card");
        redirect(site_url("Account/viewCollection/$collection_id"));
    }

    function addCard($collection_id) {
        $data = array();
        $this->db->where("id", $collection_id);
        $query = $this->db->get('set_collection');
        $collectionobj = $query->row_array();
        $data['collectionsobj'] = $collectionobj;

        $data['categories'] = array();
        $config['upload_path'] = 'assets/collection/cards';
        $config['allowed_types'] = '*';
        if (isset($_POST['submit_data'])) {
            $picture = '';

            if (!empty($_FILES['picture']['name'])) {
                $temp1 = rand(100, 1000000);
                $config['overwrite'] = TRUE;
                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . $ext;
                $picture = $file_newname;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            }
//            print_r($picture);
            $cardArray = array(
                "image" => $picture,
                "collection_id" => $collection_id,
                "display_index" => "100",
            );
            $this->db->insert('set_collection_card', $cardArray);
            redirect("Account/viewCollection/$collection_id");
        }
        $this->load->view('collection/addCard', $data);
    }

    function editCard($collection_id, $card_id) {
        $data = array();
        $this->db->where("id", $card_id);
        $query = $this->db->get('set_collection_card');
        $collectionobj = $query->row_array();
        $data['collectionobj'] = $collectionobj;

        $config['upload_path'] = 'assets/collection/card';
        $config['allowed_types'] = '*';
        if (isset($_POST['submit_data'])) {
            $picture = '';

            if (!empty($_FILES['picture']['name'])) {
                $temp1 = rand(100, 1000000);
                $config['overwrite'] = TRUE;
                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . $ext;
                $picture = $file_newname;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            }
            if ($picture) {
                $this->db->set("image", $picture);
            }
            $this->db->where("id", $card_id);
            $query = $this->db->update('set_collection_card');
            redirect("Account/viewCollection/$collection_id");
        }
        $this->load->view('collection/editCollection', $data);
    }

}

?>
