<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Controller class to handle requests related to the profile
class Profile extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Load the database and session libraries, url and form helpers, and necessary models
        $this->load->model('Profile_model');
        $this->load->model('User_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
    }

    // Function to display the profile
    public function index() {

        // Retrieve user id from session
        $user_id = $this->session->userdata('user_id');

        if($user_id){
            // Retrieve user details, questions, and answers
            $data['user'] = $this->Profile_model->getUserById($user_id);
            $data['questions'] = $this->Profile_model->getQuestionsByUser($user_id);
            $data['answers'] = $this->Profile_model->getAnswersByUser($user_id);

            // Load the view with user data
            $this->load->view('profile_view', $data);
        } else{
            $this->load->view('login_form');
        }
    }

    // Function to delete question
    public function deleteQuestion($question_id) {
        $this->Profile_model->deleteQuestion($question_id);
        redirect('profileController/index');
    }

    // Function to delete answer
    public function deleteAnswer($answer_id) {
        $this->Profile_model->deleteAnswer($answer_id);
        redirect('profileController/index');
    }

    // Function to edit question
    public function editQuestion($question_id) {
        $data['question'] = $this->Profile_model->getQuestionById($question_id);
        $this->load->view('edit_question_view', $data);
    }
    
    // Function to edit answer
    public function editAnswer($answer_id) {
        $data['answer'] = $this->Profile_model->getAnswerById($answer_id);
        $this->load->view('edit_answer_view', $data);
    }
    
    // Function to edit user details
    public function editDetails() {
        $userId = $this->session->userdata('user_id');
        $userDetails = $this->User_model->getUserDetails($userId);
        $data['userDetails'] = $userDetails;
        $this->load->view('edit_profile', $data);
    }
    
}

