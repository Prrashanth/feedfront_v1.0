<?php

class Loginmodel extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function Verify($data)
    {
        extract($data);
        $query = $this->db->select("*")
                        ->from("tm_login_details")
                        ->where("User_Name='$username' and Password='".md5($password)."'")
                        ->get();
        return $query->num_rows();
    }
}

