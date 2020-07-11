<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->query('
            INSERT INTO users (name, email, password) 
            VALUES (:name, :email, :password)');
        // bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // login user
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email'); // :email is a named parameter
        $this->db->bind(':email', $email); // bind the variable to the named parameter

        $row = $this->db->single();

        // this option simply returns true or false if the user is found
        // it may make sense to return a user?
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}