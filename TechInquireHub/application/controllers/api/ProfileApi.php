<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// Include the necessary RestController and Format libraries
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

// Import the RestController
use chriskacerguis\RestServer\RestController;

// Controller class to handle rest api requests related to profile
class ProfileApi extends RestController {

    function __construct() {
        parent::__construct();
        
        // Load the models, url helper, session library, and database library
        $this->load->model('Profile_model');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->database();
    }

    public function update_details_post() {
        $userId = $this->session->userdata('user_id');

        // Handle form submission (update user details)
        $displayName = $this->input->post('display_name');
        $title = $this->input->post('title');
        $bio = $this->input->post('bio');

        // Update the user details in the database
        $result = $this->User_model->updateUserDetails($userId, $displayName, $title, $bio);


        // Respond with success message
        $this->response([
            'status' => TRUE,
            'message' => 'Profile Updated successfully'
        ], RestController::HTTP_OK);
        
    }

    public function update_password_post() {
        // Retrieve data from the POST request
        $current_password = $this->post('current_password');
        $new_password = $this->post('new_password');
        $confirm_password = $this->post('confirm_password');

        // Set validation rules
        $this->form_validation->set_data(['current_password' => $current_password, 'new_password' => $new_password, 'confirm_password' => $confirm_password]);

        // Validate form data
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required|min_length[6]|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $this->response([
                'status' => FALSE,
                'message' => 'Update Password failed. Validation errors.',
                'errors' => $this->form_validation->error_array()
            ], RestController::HTTP_BAD_REQUEST);
        } else {

            // Check if current password matches the one in the database
            $user_id = $this->session->userdata('user_id');
            $is_current_password_valid = $this->Profile_model->verifyPassword($user_id, $current_password);

            if ($is_current_password_valid) {
                // Update password
                $this->Profile_model->updatePassword($user_id, $new_password);
                $this->response([
                    'status' => TRUE,
                    'message' => 'Update successful.'
                ], RestController::HTTP_OK);
            } else {
                // Respond with error message if update fails
                $this->response([
                    'status' => FALSE,
                    'message' => 'Update failed.'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function update_question_post($question_id) {
    
        // Update the question in the database
        $updated_data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('question_content'),
        );
        $this->Profile_model->updateQuestion($question_id, $updated_data);
    
        // Respond with success message
        $this->response([
            'status' => TRUE,
            'message' => 'Question updated successfully'
        ], RestController::HTTP_OK);
    }

    public function update_answer_post($answer_id) {
        // Retrieve data from the POST request
        $updated_data = array(
            'content' => $this->input->post('answer_content'),
        );

        // Update the answer in the database
        $this->Profile_model->updateAnswer($answer_id, $updated_data);

        // Respond with success message
        $this->response([
            'status' => TRUE,
            'message' => 'Answer updated successfully'
        ], RestController::HTTP_OK);

    }
    
}