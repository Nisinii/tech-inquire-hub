<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Model class to handle the requests related to the profile
class Profile_model extends CI_Model {

    // Function to get user by ID
    public function getUserById($user_id) {
        $query = $this->db->get_where('users', array('user_id' => $user_id));
        return $query->row_array();
    }

    // Function to get questions by User
    public function getQuestionsByUser($user_id) {
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Function to get answers by User
    public function getAnswersByUser($user_id) {
        $this->db->select('*');
        $this->db->from('answers');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Function to delete a question
    public function deleteQuestion($question_id) {

        // Delete associated question tags
        $this->db->where('question_id', $question_id);
        $this->db->delete('question_tags');

        // Delete associated answers and votes
        $this->deleteAnswersAndVotes($question_id);

        // Delete saved questions (if any)
        $this->db->where('question_id', $question_id);
        $this->db->delete('saved_questions');

        // Delete the question itself
        $this->db->where('question_id', $question_id);
        $this->db->delete('questions');
    }

    // Function to delete answers and votes
    private function deleteAnswersAndVotes($question_id) {

        // Fetch associated answer IDs
        $this->db->select('answer_id');
        $this->db->where('question_id', $question_id);
        $query = $this->db->get('answers');
        $answer_ids = $query->result_array();

        // Delete associated votes
        foreach ($answer_ids as $answer) {
            $this->db->where('answer_id', $answer['answer_id']);
            $this->db->delete('votes');
        }

        // Delete associated answers
        $this->db->where('question_id', $question_id);
        $this->db->delete('answers');
    }

    // Function to delete an answer
    public function deleteAnswer($answer_id) {

        // Delete the votes records for the answer
        $this->db->where('answer_id', $answer_id);
        $this->db->delete('votes');

        // Delete the answer record
        $this->db->where('answer_id', $answer_id);
        $this->db->delete('answers');
    }

    // Function to get questions by ID
    public function getQuestionById($question_id) {
        $query = $this->db->get_where('questions', array('question_id' => $question_id));
        return $query->row_array();
    }
    
    // Function to update a question
    public function updateQuestion($question_id, $data) {
        $this->db->where('question_id', $question_id);
        $this->db->update('questions', $data);
    }
    
    // Function to get an answer by ID
    public function getAnswerById($answer_id) {
        $query = $this->db->get_where('answers', array('answer_id' => $answer_id));
        return $query->row_array();
    }
    
    // Function to update an answer
    public function updateAnswer($answer_id, $data) {
        $this->db->where('answer_id', $answer_id);
        $this->db->update('answers', $data);
    }

    // Function to verify password
    public function verifyPassword($user_id, $current_password){
        // Retrieve hashed password from the database based on user_id
        $this->db->select('password');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('users');
    
        if($query->num_rows() == 1) {
            $row = $query->row();
            $hashed_password = $row->password;
    
            // Verify password
            if (password_verify($current_password, $hashed_password)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE; // User not found
        }
    }
    
    // Function to update password
    public function updatePassword($user_id, $new_password){
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
        // Update password in the database
        $data = array(
            'password' => $hashed_password
        );
    
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }
}
?>