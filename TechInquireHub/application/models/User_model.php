<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Model class to handle the requests related to user
class User_model extends CI_Model {

    // Function to get details of a user
    public function getUserDetails($userId) {
        $query = $this->db->get_where('users', array('user_id' => $userId));
        return $query->row_array();
    }

    // Function to update details of a user
    public function updateUserDetails($userId, $displayName, $title, $bio) {
        $data = array(
            'display_name' => $displayName,
            'title' => $title,
            'bio' => $bio
        );

        $this->db->where('user_id', $userId);
        return $this->db->update('users', $data);
    }
}
