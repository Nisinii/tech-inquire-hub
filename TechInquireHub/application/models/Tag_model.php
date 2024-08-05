<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Model class to handle the requests related to tags
class Tag_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        // Load the database library and url helper
        $this->load->database();
        $this->load->helper('url');
    }

    // Function to get all tags
    public function get_all_tags() {
        $this->db->select('*');
        $this->db->from('tags');
        $query = $this->db->get();
        return $query->result_array();
    } 
    
    // Function to get all questions related to a tag
    public function get_questions_by_tag($tag_id) {
        $this->db->select('questions.*, users.username as user_name, 
                          (SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "upvote") AS upvotes, 
                          (SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "downvote") AS downvotes, 
                          (SELECT COUNT(*) FROM answers WHERE answers.question_id = questions.question_id) AS answer_count');
        $this->db->select('GROUP_CONCAT(tags.tag_name) as tags', false);
        $this->db->from('questions');
        $this->db->join('users', 'users.user_id = questions.user_id', 'left');
        $this->db->join('question_tags', 'question_tags.question_id = questions.question_id', 'left');
        $this->db->join('tags', 'tags.tag_id = question_tags.tag_id', 'left');
        $this->db->where('questions.question_id IN (SELECT question_id FROM question_tags WHERE tag_id = ' . $tag_id . ')');
        $this->db->group_by('questions.question_id');
        $this->db->order_by('questions.created_at', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
    
        // Process the result to extract all tags related to each question
        $formatted_result = array();
        foreach ($result as $row) {
            $row['tags'] = explode(',', $row['tags']);
            $formatted_result[] = $row;
        }
    
        return $formatted_result;
    }
    
    // Function to tag name
    public function get_tag_name($tag_id) {
        $this->db->select('tag_name');
        $this->db->from('tags');
        $this->db->where('tag_id', $tag_id);
        $query = $this->db->get();

        // Check if the query has a result
        if ($query->num_rows() > 0) {
            // Return the tag name
            $result = $query->row_array();
            return $result['tag_name'];
        } else {
            // Return false if no tag found
            return false;
        }
    }

}