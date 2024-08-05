<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Controller class to handle user authentication
class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Load necessary helpers, libraries, and database
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }
 
    // Function to display registration form
    public function register() {
        $this->load->view('register_form');
    }

    // Function to display login form
    public function login() {
        $this->load->view('login_form');
    }
    
    // Function to handle user logout
    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        $this->load->view('login_form');
    }
}
