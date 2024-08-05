<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Model class to handle the requests related to saved questions
class SavedQuestions_model extends CI_Model {

    // Function to check if a question is saved by a user
    public function is_question_saved($user_id, $question_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('question_id', $question_id);
        $query = $this->db->get('saved_questions');
        return $query->num_rows() > 0;
    }

    // Function to save a question for a user
    public function save_question($user_id, $question_id) {
        $data = array(
            'user_id' => $user_id,
            'question_id' => $question_id
        );
        $this->db->insert('saved_questions', $data);
    }

    // Function to unsave a question for a user
    public function unsave_question($user_id, $question_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('question_id', $question_id);
        $this->db->delete('saved_questions');
    }

    // Function to get all saved questions related to a user
    public function get_saved_questions($user_id) {
        $this->db->select('questions.*, users.username as user_name, tags.tag_name as question_tag');
        $this->db->select('(SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "upvote") AS upvotes', false);
        $this->db->select('(SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "downvote") AS downvotes', false);
        $this->db->select('(SELECT COUNT(*) FROM answers WHERE answers.question_id = questions.question_id) AS answer_count', false);
        $this->db->from('questions');
        $this->db->join('users', 'users.user_id = questions.user_id', 'left');
        $this->db->join('question_tags', 'question_tags.question_id = questions.question_id', 'left');
        $this->db->join('tags', 'tags.tag_id = question_tags.tag_id', 'left');
        $this->db->join('saved_questions', 'questions.question_id = saved_questions.question_id AND saved_questions.user_id = ' . $user_id, 'left');
        $this->db->where('saved_questions.user_id', $user_id);
        $this->db->order_by('questions.created_at', 'DESC');

        $query = $this->db->get();
        $result = $query->result_array();

        // Check if result is empty or not an array
        if (empty($result) || !is_array($result)) {
            return array();
        }

        $formatted_result = array();

        foreach ($result as $row) {
            $formatted_result[$row['question_id']]['question_id'] = $row['question_id'];
            $formatted_result[$row['question_id']]['user_name'] = $row['user_name'];
            $formatted_result[$row['question_id']]['upvotes'] = $row['upvotes'];
            $formatted_result[$row['question_id']]['downvotes'] = $row['downvotes'];
            $formatted_result[$row['question_id']]['answer_count'] = $row['answer_count'];
            $formatted_result[$row['question_id']]['title'] = $row['title'];
            $formatted_result[$row['question_id']]['content'] = $row['content'];
            $formatted_result[$row['question_id']]['created_at'] = $row['created_at'];
            $formatted_result[$row['question_id']]['tags'][] = $row['question_tag'];
        }

        return array_values($formatted_result);
    }

}
