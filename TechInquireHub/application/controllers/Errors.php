<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Controller class to handle errors
class Errors extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    // Function to handle 404 errors
    public function error_404() {
        $this->output->set_status_header('404');
        $this->load->view('error_404');
    }
}
