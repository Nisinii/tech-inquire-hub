<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Controller class to handle requests related to the questions
class Question extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load the database and session libraries, url helpers, and necessary models
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('question_model');
        $this->load->model('answer_model');
        $this->load->model('SavedQuestions_model');
    }
    
    // Function to display the questions
    public function view($question_id) {
        $user_id = $this->session->userdata('user_id');

        if($user_id){
            // Get the question details
            $data['question'] = $this->question_model->get_question($question_id);
            
            // Get answers for the question
            $data['answers'] = $this->answer_model->get_answers($question_id);

            // Get top 10 most voted questions from the database
            $data['questions'] = $this->question_model->get_top_questions_with_most_votes(10);

            // Check if the question is saved for the user
            $data['is_saved'] = $this->SavedQuestions_model->is_question_saved($user_id, $question_id);
            
            // Load the view
            $this->load->view('question_view', $data);
        } else {
            $this->load->view('login_form');
        }
    }

    // Function to upvote an answer
    public function upvote_answer($answer_id, $question_id) {
        $this->load->model('question_model');

        // Perform upvote logic
        $this->question_model->upvote_answer($answer_id, $question_id);

        // Redirect back to the question view or other appropriate page
        redirect('question/view/' . $question_id);
    }

    // Function to downvote an answer
    public function downvote_answer($answer_id, $question_id) {
        $this->load->model('question_model');

        // Perform downvote logic
        $this->question_model->downvote_answer($answer_id, $question_id);

        // Redirect back to the question view or other appropriate page
        redirect('question/view/' . $question_id);
    }

}
