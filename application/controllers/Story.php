<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Story extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Story_model');
        $this->load->model('Curd_model');
        $this->userdata = $this->session->userdata('logged_in');
    }

    /// image story 
    function addImage($story_id = 0) {
        $data = array();
        $storylist = $this->Story_model->storyList();
        $data["storylist"] = $storylist;
        $display_index = count($storylist) + 1;
        $imageobj = array("image" => base_url() . "assets/uploads/default.jpg", "button_title" => "Add Story Image");
        $storyobj = $this->Story_model->singleStory($story_id);
        $is_update = false;
        if ($storyobj) {
            $imageobj["image"] = $storyobj["image"];
            $imageobj["button_title"] = "Update Image";
            $is_update = true;
        }
        $data["imageobj"] = $imageobj;
        if (isset($_POST['submit_data'])) {
            $imagename = "";
            if (!empty($_FILES['picture']['name'])) {
                $imagename = $this->Curd_model->uploadImage($_FILES);
            }
            $timestampobj = new DateTime();
            $imageArray = array(
                "image" => $imagename,
                "timestamp" => $timestampobj->getTimestamp(),
                "display_index" => $display_index
            );
            if ($is_update) {
                $this->db->set($imageArray);
                $this->db->where("id", $story_id);
                $this->db->update('story_images');
            } else {
                $this->db->insert('story_images', $imageArray);
            }
            redirect("Story/addImage");
        }
        $this->load->view('Story/addImage', $data);
    }

    function removeStoryImage($story_id) {
        $this->db->where("id", $story_id);
        $this->db->delete('story_images');
        redirect("Story/addImage");
    }

    //end of story image
    // add content 
    function addStory() {
        $data = array();
        $storylist = $this->Story_model->storyList();
        $data["storylist"] = $storylist;
        $display_index = count($storylist) + 1;
        $imageobj = array("image" => base_url() . "assets/uploads/default.jpg", "button_title" => "Add Story Image");
        $storyobj = $this->Story_model->singleStory(0);
        $is_update = false;
        if ($storyobj) {
            $imageobj["image"] = $storyobj["image"];
            $imageobj["button_title"] = "Update Image";
            $is_update = true;
        }
        $data["imageobj"] = $imageobj;
        $languagelistt = $this->Story_model->storyLanguageList(1);
        $languagelist = array();
        $lenguage_id = 1;
        if ($languagelistt) {
            foreach ($languagelistt as $key => $value) {

                $lenguage_id = $value["is_default"] == 'Yes' ? $value["id"] : 1;

                $languagelist[$value["id"]] = $value;
            }
        }
        $data["active_language"] = $languagelist[$lenguage_id];
        $data["language"] = $languagelist;
        if (isset($_POST["submit"])) {
            $imagename = "";
            if (!empty($_FILES['picture']['name'])) {
                $imagename = $this->Curd_model->uploadImage($_FILES);
            }
            $timestampobj = new DateTime();
            $imageArray = array(
                "image" => $imagename,
                "timestamp" => $timestampobj->getTimestamp(),
                "display_index" => $display_index
            );

            $this->db->insert('story_images', $imageArray);
            $story_id = $this->db->insert_id();

            $insertArray = array(
                "image_id" => $story_id,
                "language_id" => $lenguage_id,
                "content" => $this->input->post("content"),
            );
            $this->db->insert('story_content', $insertArray);
            $last_id = $this->db->insert_id();
            redirect(site_url("Story/viewStoryEdit/$last_id"));
        }
        $this->load->view('Story/addStory', $data);
    }

    //end of story image
    // add content 
    function viewStory($story_id, $lenguage_id = 0) {
        $storyobj = $this->Story_model->singleStory($story_id);
        $languagelistt = $this->Story_model->storyLanguageList(1);
        $languagelist = array();
        if ($languagelistt) {
            foreach ($languagelistt as $key => $value) {
                if (!$lenguage_id) {
                    $lenguage_id = $value["is_default"] == 'Yes' ? $value["id"] : 0;
                }
                if ($value["id"] == $lenguage_id) {
                    $value["active"] = 1;
                } else {
                    $value["active"] = 0;
                }
                $languagelist[$value["id"]] = $value;
            }
        }

        if ($storyobj) {
            $content = $this->Story_model->singleStoryContentLanguageAndStory($story_id, $lenguage_id);

            $data["content"] = $content["content"];
            $data["active_language"] = $languagelist[$lenguage_id];
            $data["language"] = $languagelist;
            $data["storyboj"] = $storyobj;
            if (isset($_POST["submit"])) {
                if ($content["content"]) {
                    $insertArray = array(
                        "content" => $this->input->post("content"),
                    );
                    $this->db->where(array("image_id" => $story_id, "language_id" => $lenguage_id));
                    $this->db->update('story_content', $insertArray);
                } else {
                    $insertArray = array(
                        "image_id" => $story_id,
                        "language_id" => $lenguage_id,
                        "content" => $this->input->post("content"),
                    );
                    $this->db->insert('story_content', $insertArray);
                    $last_id = $this->db->insert_id();
                }
                redirect("Story/viewStory/$story_id/$lenguage_id");
            }
        } else {
            redirect("Story/addStory");
        }
        $this->load->view('Story/viewStory', $data);
    }

    //language 
    public function languageSetting() {
        $data = array();
        $data['title'] = "Set Languages";
        $data['description'] = "Languages";
        $data['form_title'] = "Languages";
        $data['table_name'] = "story_language";
        $data["link"] = "Story/languageSetting";
        $form_attr = array(
            "title" => array("title" => "Title", "width" => "300px", "required" => true, "place_holder" => "Title", "type" => "text", "default" => ""),
            "display_index" => array("title" => "Index", "width" => "300px", "required" => true, "place_holder" => "Index", "type" => "number", "default" => ""),
            "is_default" => array("title" => "Default", "width" => "300px", "required" => false, "place_holder" => "Type Yes or No", "type" => "text", "default" => ""),
            "is_active" => array("title" => "Is Active", "width" => "300px", "required" => true, "place_holder" => "Is Active 0/1", "type" => "number", "default" => ""),
        );
        $data['form_attr'] = $form_attr;
        $rdata = $this->Curd_model->curdForm($data);
        $this->load->view('layout/curd', $rdata);
    }

    //viewStoryList
    public function appViewStory($lenguage_id = 0) {
        $languagelistt = $this->Story_model->storyLanguageList(1);
        $languagelist = array();
        if ($languagelistt) {
            foreach ($languagelistt as $key => $value) {
                if (!$lenguage_id) {
                    $lenguage_id = $value["is_default"] == 'Yes' ? $value["id"] : 0;
                }
                if ($value["id"] == $lenguage_id) {
                    $value["active"] = 1;
                } else {
                    $value["active"] = 0;
                }
                $languagelist[$value["id"]] = $value;
            }
        }
        $storyline = $this->Story_model->storyViewByLenguageId($lenguage_id);

        $data["storylist"] = $storyline;
        $data["lenguage_id"] = $lenguage_id;
        $data["language"] = $languagelist;
        $this->load->view('Story/viewStories', $data);
    }

}

?>
