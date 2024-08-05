<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Model class to handle user authentication related database operations
class Auth_model extends CI_Model {

    // Function to register a new user
    public function register_user($data) {
        $this->db->insert('users', $data);
    }

    // Function to check user login credentials
    public function check_login($username, $password) {

        // Retrieve user data based on the provided username
        $user = $this->db->get_where('users', ['username' => $username])->row();
    
        // Check if user exists and the provided password matches the hashed password stored in the database
        if ($user && password_verify($password, $user->password)) {
            return $user->user_id;
        }
        
        return false;
    }
}
