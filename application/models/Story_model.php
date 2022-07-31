<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Story_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function storyList() {
        $imagepath = base_url() . "assets/uploads/";
        $storylistquery = $this->db->select("id, concat('$imagepath', image) as image, display_index")->order_by("display_index")->get("story_images");
        $storylist = $storylistquery ? $storylistquery->result_array() : array();
        return $storylist;
    }

    public function singleStory($id) {
        $imagepath = base_url() . "assets/uploads/";
        $storyquery = $this->db->select("id, concat('$imagepath', image) as image, display_index")->where("id", $id)->get("story_images");
        $story = $storyquery ? $storyquery->row_array() : array();
        return $story;
    }

    public function storyLanguageList() {
        $lang_listquery = $this->db->select("*, '0' as 'active'")->order_by("is_default desc, display_index")->get("story_language");
        $lang_list = $lang_listquery ? $lang_listquery->result_array() : array();
        return $lang_list;
    }

    public function singleStoryContent($id) {
        $storyquery = $this->db->where("id", $id)->get("story_content");
        $story = $storyquery ? $storyquery->row_array() : array();
        return $story;
    }
    
    public function singleStoryContentLanguageAndStory($image_id, $leng_id) {
        $storyquery = $this->db->where(array("image_id"=> $image_id, "language_id"=>$leng_id))->get("story_content");
        $story = $storyquery->row_array() ?? array("content"=>"");
        return $story;
    }
    
    function storyViewByLenguageId($lenguage_id){
        $storyContent = array();
        $storyList = $this->storyList();
        foreach ($storyList as $key => $story) {
            $story_content = $this->singleStoryContentLanguageAndStory($story["id"], $lenguage_id);
            $story["content"] = $story_content["content"];
            array_push($storyContent, $story);
        }
        return $storyContent;
    }

}

?>  