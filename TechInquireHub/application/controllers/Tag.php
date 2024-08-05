<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Controller class to handle requests related to the tags
class Tag extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the necessary models
        $this->load->model('Tag_model');
    }

    // Function to display all tags
    public function list_tags() {
        $data['tags'] = $this->Tag_model->get_all_tags();
        $this->load->view('tags_view', $data);
    }

    // Function to display all questions related to a tag
    public function view_questions_by_tag($tag_id) {
        $data['questions'] = $this->Tag_model->get_questions_by_tag($tag_id);
        $data['tag_name'] = $this->Tag_model->get_tag_name($tag_id);
        $this->load->view('questions_by_tag_view', $data);
    }
}