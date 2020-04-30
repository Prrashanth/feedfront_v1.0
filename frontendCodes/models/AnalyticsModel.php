<?php

class AnalyticsModel extends CI_Model
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
    public function Getsentimentscore($data)
    {
        $this->db->select("avg(Overall_Score) as score")
                ->from('tm_feedback');
        if($data['Campaign'] != '')
        {
            $this->db->where("Campaign_Id='".$data['Campaign']."'");
        }else{
            $this->db->where("CAST(TimeStamp AS DATE) between '".$data['fromDate']."' and '".$data['toDate']."'");
        }
        $this->db->where("Audio_Status='True' and Feedback_Status='True'");
        $q = $this->db->get();
        foreach ($q->result_array() as $r); 
        return $r['score'];
    }
}

