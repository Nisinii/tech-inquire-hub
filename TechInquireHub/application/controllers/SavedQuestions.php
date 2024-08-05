<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Controller class to handle requests related to saved questions
class SavedQuestions extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load necessary models, libraries, helpers and database
        $this->load->model('SavedQuestions_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('user_agent');
    }

    // Function to check if a question is saved
    public function is_question_saved($user_id, $question_id) {
        return $this->SavedQuestions_model->is_question_saved($user_id, $question_id);
    }

    // Function to save a question
    public function save($question_id) {
        // Retrieve user ID from the session
        $user_id = $this->session->userdata('user_id');

        if($user_id) {
            $this->load->model('SavedQuestions_model');
            $this->SavedQuestions_model->save_question($user_id, $question_id);

            // Redirect to the previous page
            redirect($this->agent->referrer());
        } else {
            $this->load->view('login_form');
        }
    }

    // Function to unsave a question
    public function unsave($question_id) {
        // Retrieve user ID from the session
        $user_id = $this->session->userdata('user_id');
    
        if($user_id) {
            $this->load->model('SavedQuestions_model');
            $this->SavedQuestions_model->unsave_question($user_id, $question_id);
        
            // Redirect to the previous page
            redirect($this->agent->referrer());
        } else {
            $this->load->view('login_form');
        }
    }

    // Function to view the saved questions
    public function index() {
        // Retrieve user ID from the session
        $user_id = $this->session->userdata('user_id');

        if($user_id) {        
            $this->load->model('SavedQuestions_model');
            $data['saved_questions'] = $this->SavedQuestions_model->get_saved_questions($user_id);

            $this->load->view('saved_questions', $data);
        } else {
            $this->load->view('login_form');
        }
    }
}
