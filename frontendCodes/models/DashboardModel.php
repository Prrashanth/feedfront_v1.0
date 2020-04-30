<?php

class DashboardModel extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getMinutes()
    {
        
        $query = $this->db->query("SELECT (SELECT credit_minutes FROM tm_creditdetails)-(SELECT COUNT(*) FROM tm_feedback WHERE Call_Status='completed') as subval");                                             
                        
        return $query->result();
    }
}

