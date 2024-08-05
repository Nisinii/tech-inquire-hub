<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Controller class to handle the help about page
class HelpAbout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url'); 
    }

    // Function to display the help about page
	public function index(){
		$this->load->view('help_about');
	}
}
