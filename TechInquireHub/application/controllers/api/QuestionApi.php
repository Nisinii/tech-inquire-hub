<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// Include the necessary RestController and Format libraries
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

// Import the RestController
use chriskacerguis\RestServer\RestController;

// Controller class to handle rest api requests related to questions
class QuestionApi extends RestController {

    function __construct() {
        parent::__construct();
        
        // Load the Question_model model, url helper, session library, and database library
        $this->load->model('Question_model');
        $this->load->model('Answer_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
    }

    // Function to save question POST request
    public function save_question_post() {
        // Retrieving the form data
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'title' => $this->input->post('title'),
            'content' => $this->input->post('answer_content'),
            'created_at' => date('Y-m-d H:i:s')
        );

        // Check if an image file is provided
        if (!empty($_FILES['image']['name'])) {
            // Ensure the uploads directory exists
            $upload_path = './uploads/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }

            // Load the upload library
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB max
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                // Respond with upload errors
                $upload_error = $this->upload->display_errors();
                $this->response([
                    'status' => FALSE,
                    'message' => 'Error in uploading the image',
                    'errors' => $upload_error
                ], RestController::HTTP_INTERNAL_SERVER_ERROR);
                return;
            } else {
                $upload_data = $this->upload->data();
                $image_path = 'uploads/' . $upload_data['file_name'];
                $data['image'] = $image_path; // Set image path in data array
            }
        }

        // Get tags from the form and split them into an array
        $tags = explode(', ', $this->input->post('tags'));

        $question_id = $this->Question_model->add_question($data, $tags);

        // Respond with success message
        $this->response([
            'status' => TRUE,
            'message' => 'Save question successful'
        ], RestController::HTTP_OK);
    }
    
    // Function to save question POST request
    public function save_answer_post($question_id) {
        // Retrieving the form data
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'question_id' => $question_id,
            'content' => $this->input->post('answer_content'),
            'created_at' => date('Y-m-d H:i:s')
        );

        // Check if an image file is provided
        if (!empty($_FILES['image']['name'])) {
            // Ensure the uploads directory exists
            $upload_path = './uploads/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }

            // Load the upload library
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB max
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                // Respond with upload errors
                $upload_error = $this->upload->display_errors();
                $this->response([
                    'status' => FALSE,
                    'message' => 'Error in uploading the image',
                    'errors' => $upload_error
                ], RestController::HTTP_INTERNAL_SERVER_ERROR);
                return;
            } else {
                $upload_data = $this->upload->data();
                $image_path = 'uploads/' . $upload_data['file_name'];
                $data['image'] = $image_path; // Set image path in data array
            }
        }

        // Call the model to add the answer
        $this->Answer_model->add_answer($data);

        // Respond with success message
        $this->response([
            'status' => TRUE,
            'message' => 'Save answer successful'
        ], RestController::HTTP_OK);
        
    }
    
}
