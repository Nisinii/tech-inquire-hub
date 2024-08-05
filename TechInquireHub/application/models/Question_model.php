<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Model class to handle the requests related to questions
class Question_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        // Load the database library, url helper
        $this->load->database();
        $this->load->helper('url');
    }

    // Function to get top questions with the most votes
    public function get_top_questions_with_most_votes($limit) {

        // Fetch top questions with username, tags, vote count, and answer count
        $this->db->select('questions.*, users.username as user_name, tags.tag_name as question_tag');
        $this->db->select('(SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "upvote") AS upvotes', false);
        $this->db->select('(SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "downvote") AS downvotes', false);
        $this->db->select('(SELECT COUNT(*) FROM answers WHERE answers.question_id = questions.question_id) AS answer_count', false);
        $this->db->from('questions');
        $this->db->join('users', 'users.user_id = questions.user_id', 'left');
        $this->db->join('question_tags', 'question_tags.question_id = questions.question_id', 'left');
        $this->db->join('tags', 'tags.tag_id = question_tags.tag_id', 'left');
        $this->db->group_by('questions.question_id, tags.tag_id'); 
        $this->db->order_by('(SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id)', 'DESC'); // Order by total votes
        $this->db->limit($limit);
        $query = $this->db->get();
        $result = $query->result_array();
    
        // Check if result is empty or not an array
        if (empty($result) || !is_array($result)) {
            return array();
        }
    
        $formatted_result = array();
    
        // Group tags by question_id
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
    
    // Function to get all questions
    public function get_all_questions() {

        // Fetch top questions with username, tags, vote count, and answer count
        $this->db->select('questions.*, users.username as user_name, tags.tag_name as tag_name, tags.tag_id as tag_id');
        $this->db->select('(SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "upvote") AS upvotes', false);
        $this->db->select('(SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "downvote") AS downvotes', false);
        $this->db->select('(SELECT COUNT(*) FROM answers WHERE answers.question_id = questions.question_id) AS answer_count', false);
        $this->db->from('questions');
        $this->db->join('users', 'users.user_id = questions.user_id', 'left');
        $this->db->join('question_tags', 'question_tags.question_id = questions.question_id', 'left');
        $this->db->join('tags', 'tags.tag_id = question_tags.tag_id', 'left');
        $this->db->group_by('questions.question_id, tags.tag_id');
        $this->db->order_by('questions.created_at', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
    
        // Check if result is empty or not an array
        if (empty($result) || !is_array($result)) {
            return array();
        }
    
        $formatted_result = array();
    
        // Group tags by question_id
        foreach ($result as $row) {
            $formatted_result[$row['question_id']]['question_id'] = $row['question_id'];
            $formatted_result[$row['question_id']]['user_name'] = $row['user_name'];
            $formatted_result[$row['question_id']]['upvotes'] = $row['upvotes'];
            $formatted_result[$row['question_id']]['downvotes'] = $row['downvotes'];
            $formatted_result[$row['question_id']]['answer_count'] = $row['answer_count'];
            $formatted_result[$row['question_id']]['title'] = $row['title'];
            $formatted_result[$row['question_id']]['content'] = $row['content'];
            $formatted_result[$row['question_id']]['created_at'] = $row['created_at'];
            $formatted_result[$row['question_id']]['tags'][] = array(
                'tag_id' => $row['tag_id'],
                'tag_name' => $row['tag_name']
            );
        }
    
        return array_values($formatted_result);
    }
    
    // Function to search a question using keywords
    public function search_questions($keyword) {

        // Search questions based on keyword and retrieve user name and tags
        $this->db->select('questions.*, users.username as user_name, GROUP_CONCAT(tags.tag_name) as tag_names');
        $this->db->from('questions');
        $this->db->join('users', 'users.user_id = questions.user_id', 'left');
        $this->db->join('question_tags', 'question_tags.question_id = questions.question_id', 'left');
        $this->db->join('tags', 'tags.tag_id = question_tags.tag_id', 'left');
        $this->db->group_by('questions.question_id'); // Group by question ID to avoid duplicate rows
        $this->db->group_start();
        $this->db->like('questions.title', $keyword);
        $this->db->or_like('tags.tag_name', $keyword); // Search within tags
        $this->db->group_end();

        // Count upvotes and downvotes for each question
        $this->db->select('(SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "upvote") AS upvotes');
        $this->db->select('(SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "downvote") AS downvotes');
    
        // Count answers for each question
        $this->db->select('(SELECT COUNT(*) FROM answers WHERE answers.question_id = questions.question_id) AS answer_count');
    
        $query = $this->db->get();
        $result = $query->result_array();
    
        // Check if result is empty or not an array
        if (empty($result) || !is_array($result)) {
            return array();
        }
    
        // Fetch and explode tags for each question separately
        foreach ($result as &$question) {
            if ($question['tag_names']) {
                $tags = explode(',', $question['tag_names']);
                $question['tags'] = $tags;
            } else {
                $question['tags'] = array(); // If no tags found, set an empty array
            }
            unset($question['tag_names']); // Remove the temporary tag_names field
        }
    
        return $result;
    }
    
    // Function to add a question
    public function add_question($data, $tags) {

        // Insert question into the database
        $this->db->insert('questions', $data);
        $question_id = $this->db->insert_id(); // Get the ID of the inserted question
    
        // Insert tags into the question_tags table
        foreach ($tags as $tag) {
            // Check if the tag already exists
            $tag_query = $this->db->get_where('tags', ['tag_name' => $tag]);
            $tag_result = $tag_query->row_array();
    
            if (empty($tag_result)) {
                // If the tag doesn't exist, insert it into the tags table
                $this->db->insert('tags', ['tag_name' => $tag]);
                $tag_id = $this->db->insert_id();
            } else {
                // If the tag exists, get its ID
                $tag_id = $tag_result['tag_id'];
            }
    
            // Insert the relationship into the question_tags table
            $this->db->insert('question_tags', ['question_id' => $question_id, 'tag_id' => $tag_id]);
        }
    
        return $question_id;
    }    
    
    // Function to get a question
    public function get_question($question_id) {

        // Fetch question details from the database
        $this->db->select('questions.*, users.username as user_name, tags.tag_name as question_tag');
        $this->db->select('(SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "upvote") AS upvotes');
        $this->db->select('(SELECT COUNT(*) FROM votes WHERE votes.question_id = questions.question_id AND votes.vote_type = "downvote") AS downvotes');
        $this->db->select('(SELECT COUNT(*) FROM answers WHERE answers.question_id = questions.question_id) AS answer_count');
        $this->db->from('questions');
        $this->db->join('users', 'users.user_id = questions.user_id', 'left');
        $this->db->join('question_tags', 'question_tags.question_id = questions.question_id', 'left');
        $this->db->join('tags', 'tags.tag_id = question_tags.tag_id', 'left');
        $this->db->where('questions.question_id', $question_id);
        $this->db->group_by('questions.question_id');  // Group by question_id to avoid duplicate rows
    
        $query = $this->db->get();
    
        // Check if the query has a result
        if ($query->num_rows() > 0) {
            // Return the first row as an associative array
            $result = $query->row_array();
    
            // Fetch tags separately
            $tagsQuery = $this->db->select('tags.tag_name')->from('question_tags')->join('tags', 'tags.tag_id = question_tags.tag_id')->where('question_tags.question_id', $question_id)->get();
            $tagsResult = $tagsQuery->result_array();
            $result['tags'] = array_column($tagsResult, 'tag_name');
    
            // Fetch answers with their upvotes and downvotes
            $answersQuery = $this->db->select('answers.*, users.username as user_name')
                                     ->select('(SELECT COUNT(*) FROM votes WHERE votes.answer_id = answers.answer_id AND votes.vote_type = "upvote") AS upvotes')
                                     ->select('(SELECT COUNT(*) FROM votes WHERE votes.answer_id = answers.answer_id AND votes.vote_type = "downvote") AS downvotes')
                                     ->from('answers')
                                     ->join('users', 'users.user_id = answers.user_id', 'left')
                                     ->where('answers.question_id', $question_id)
                                     ->get();
            $answersResult = $answersQuery->result_array();
            $result['answers'] = $answersResult;
    
            return $result;
        } else {
            // Return false if no question found
            return false;
        }
    }
    
    // Function to upvote an answer
    public function upvote_answer($answer_id, $question_id) {
        $user_id = $this->session->userdata('user_id');
    
        // Check if the user has already voted on this answer
        $existing_vote = $this->db->get_where('votes', [
            'user_id' => $user_id,
            'answer_id' => $answer_id,
            'question_id' => $question_id,
        ])->row();
    
        if ($existing_vote) {
            // User has voted, check the vote type
            if ($existing_vote->vote_type == 'upvote') {
                // User already upvoted, ignore the action
            } else {
                // User has downvoted, update the vote to upvote
                $this->db->where([
                    'user_id' => $user_id,
                    'answer_id' => $answer_id,
                    'question_id' => $question_id,
                ])->update('votes', ['vote_type' => 'upvote']);
            }
        } else {
            // User hasn't voted, add an upvote
            $this->db->insert('votes', [
                'user_id' => $user_id,
                'answer_id' => $answer_id,
                'question_id' => $question_id,
                'vote_type' => 'upvote',
            ]);
        }
    }
    
    // Function to downvote an answer
    public function downvote_answer($answer_id, $question_id) {
        $user_id = $this->session->userdata('user_id');
    
        // Check if the user has already voted on this answer
        $existing_vote = $this->db->get_where('votes', [
            'user_id' => $user_id,
            'answer_id' => $answer_id,
            'question_id' => $question_id,
        ])->row();
    
        if ($existing_vote) {
            // User has voted, check the vote type
            if ($existing_vote->vote_type == 'downvote') {
                // User already downvoted, ignore the downvote
            } else {
                // User has upvoted, update the vote to downvote
                $this->db->where([
                    'user_id' => $user_id,
                    'answer_id' => $answer_id,
                    'question_id' => $question_id,
                ])->update('votes', ['vote_type' => 'downvote']);
            }
        } else {
            // User hasn't voted, add a downvote
            $this->db->insert('votes', [
                'user_id' => $user_id,
                'answer_id' => $answer_id,
                'question_id' => $question_id,
                'vote_type' => 'downvote',
            ]);
        }
    } 
      
}