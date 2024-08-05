<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// Include the necessary RestController and Format libraries
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

// Import the RestController
use chriskacerguis\RestServer\RestController;

// Controller class to handle rest api authentication requests
class AuthApi extends RestController {

    function __construct() {
        parent::__construct();
        
        // Load the Auth_model model, form_validation library, url helper, session library, and database library
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
    }

    // Function to handle registration POST request
    public function register_post() {
        // Retrieve data from the POST request
        $username = $this->post('username');
        $password = $this->post('password');
        $email = $this->post('email');

        // Set validation rules
        $this->form_validation->set_data(['username' => $username, 'password' => $password, 'email' => $email]);
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

        // Check if validation fails
        if ($this->form_validation->run() == FALSE) {
            
            // Respond with validation errors
            $this->response([
                'status' => FALSE,
                'message' => 'Registration failed. Validation errors.',
                'errors' => $this->form_validation->error_array()
            ], RestController::HTTP_BAD_REQUEST);

         } else {
            // Validation succeeded, proceed with registration logic
            // Prepare data for registration
            $data = array(
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email' => $email
            );

            // Insert data into the 'users' table
            $this->Auth_model->register_user($data);
                
            // Respond with success message
            $this->response([
                'status' => TRUE,
                'message' => 'Registration successful'
            ], RestController::HTTP_OK);
        }
    }

    // Function to handle login POST request
    public function login_post() {
        // Retrieve data from the POST request
        $username = $this->post('username');
        $password = $this->post('password');

        // Set validation rules
        $this->form_validation->set_data(['username' => $username, 'password' => $password]);
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        // Check if validation fails
        if ($this->form_validation->run() == FALSE) {

            // Respond with validation errors
            $this->response([
                'status' => FALSE,
                'message' => 'Login failed. Validation errors.',
                'errors' => $this->form_validation->error_array()
            ], RestController::HTTP_BAD_REQUEST);

         } else {
            // Validation succeeded, proceed with login logic
            // Check login credentials
            $user_id = $this->Auth_model->check_login($username, $password);
        
            // If login is successful
            if ($user_id) {
                
                // Set session with user_id
                $this->session->set_userdata('user_id', $user_id);
                
                // Respond with success message and user data
                $this->response([
                    'status' => TRUE,
                    'message' => 'Login successful',
                    'userData' => $user_id
                ], RestController::HTTP_OK);
                
            } else {
                // Respond with error message if login fails
                $this->response([
                    'status' => FALSE,
                    'message' => 'Login failed. Email or password incorrect.'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }
}
