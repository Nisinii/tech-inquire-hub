<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Controller class to handle requests related to the dashboard
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

         // Load necessary models, helpers, libraries, and database
        $this->load->model('Question_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    // Function to display the dashboard and display top 15 questions from the database
    public function index() {
        $data['questions'] = $this->Question_model->get_top_questions_with_most_votes(20);
        $this->load->view('dashboard', $data);
    }

    // Function to display all questions
    public function questions(){
        $data['questions'] = $this->Question_model->get_all_questions();
        $this->load->view('all_questions', $data);
    }

    // Function to search questions based on keyword
    public function search() {
        
        // Get the keyword from the form submission
        $keyword = $this->input->post('keyword');
        if (!empty($keyword)) {
            // If keyword is not empty, search for questions containing the keyword
            $data['questions'] = $this->Question_model->search_questions($keyword);
        } else {
            // If keyword is empty, show top 15 questions
            $data['questions'] = $this->Question_model->get_top_questions(15);
        }
        // Load the dashboard view with the search results
        $this->load->view('dashboard', $data);
    }

    // Function to display the add question form
    public function add_question() {
        $this->load->view('add_question');
    }
   
}
