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
    public function GetFeedbackCat($data){
       if($data['Campaign']==''){
          $q=$this->db->query("CALL r_Topic_Clasification(0,'".$data['fromDate']."','".$data['toDate']."')");
       }else{
          $q=$this->db->query("CALL r_Topic_Clasification(".$data['Campaign'].",'NA','NA')");
       }
       $result=$q->result_array();
       $catarray=array();
       $cat1=array();
       foreach($q->result() as $val){
          $catarray=array();
          array_push($catarray,$val->Category_Name);
          array_push($catarray,floatval($val->Total_CategoryValue));
          array_push($cat1,$catarray);
       }
       return $cat1;

    }
    public function GetCatScore($data){
      //print_r($data);
       if($data['Campaign']==''){
          $q=$this->db->query("CALL r_Sentence_Score(0,'".$data['fromDate']."','".$data['toDate']."')");
        //  echo "CALL r_Sentence_Score(0,".$data['fromDate'].",".$data['toDate'].")";
       }else{
          $q=$this->db->query("CALL r_Sentence_Score(".$data['Campaign'].",'NA','NA')");
       }

       $result=$q->result_array();
       $catarray=array();
       $valarray=array('positive');
       $negvalarray=array('negative');
       foreach($q->result() as $val){
          array_push($catarray,$val->Category_Name);
          $valneg=100-$val->Avg_Score;
          array_push($valarray,floatval($val->Avg_Score));
          array_push($negvalarray,-$valneg);
       }
       $a['catarr']=$catarray;
       $a['positivearr']=$valarray;
       $a['negarr']=$negvalarray;
       return $a;

    }
	 public function GetFeedbackCatDet($data,$type){
       if($data['Campaign']==''){
          $q=$this->db->query("CALL r_Topic_SubClasification(0,'$type','".$data['fromDate']."','".$data['toDate']."')");
       }else{
          $q=$this->db->query("CALL r_Topic_SubClasification(".$data['Campaign'].",'$type','NA','NA')");
       }
       $result=$q->result_array();
       $catarray=array();
       $cat1=array();
       foreach($q->result() as $val){
          $catarray=array();
          array_push($catarray,$val->Category_Name);
          array_push($catarray,floatval($val->Total_CategoryValue));
          array_push($cat1,$catarray);
       }
       return $cat1;

    }
	public function GetCatScoreSub($data,$type){
      //print_r($data);
       if($data['Campaign']==''){
          $q=$this->db->query("CALL r_Sentence_SubScore(0,'$type','".$data['fromDate']."','".$data['toDate']."')");
        //  echo "CALL r_Sentence_Score(0,".$data['fromDate'].",".$data['toDate'].")";
//          mysqli_next_result($this->db->conn_id);
       }else{
          $q=$this->db->query("CALL r_Sentence_SubScore(".$data['Campaign'].",'$type','NA','NA')");
//          mysqli_next_result($this->db->conn_id);
       }

       $result=$q->result_array();
       
       $catarray=array();
       $valarray=array('positive');
       $negvalarray=array('negative');
       foreach($q->result() as $val){
          array_push($catarray,$val->Category_Name);
          $valneg=100-$val->Avg_Score;
          array_push($valarray,floatval($val->Avg_Score));
          array_push($negvalarray,-$valneg);
       }
       $a['catarr']=$catarray;
       $a['positivearr']=$valarray;
       $a['negarr']=$negvalarray;
       return $a;

    }
	function NPSRepDetails($data)
    {
        if($data['Campaign']==''){
          $q=$this->db->query("CALL r_NPS_Discription(0,'".$data['fromDate']."','".$data['toDate']."')");
       }else{
          $q=$this->db->query("CALL r_NPS_Discription(".$data['Campaign'].",'NA','NA')");
       }
       return $q->result_array();
    }
}

