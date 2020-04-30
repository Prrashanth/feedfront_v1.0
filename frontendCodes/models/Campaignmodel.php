<?php

class Campaignmodel extends CI_Model {

    public function FetchCampaign() {
        $q = $this->db->select('*')
                ->from('tm_campaign')
                ->get();
        return $q->result_array();
    }

    public function Addcampaign($data) {

        $listid=$data['list'];

        $q1=$this->db->query("Call minscalculation($listid)"); 
        mysqli_next_result($this->db->conn_id);       
        foreach($q1->result_array() as $count);              
       // echo $count['actualcount'].'\n';
       // echo $count['scheduledcount'].'****';
       // echo $count['listcount'].'**';
        $flagcount=$count['actualcount']-($count['scheduledcount']+$count['listcount']);
      //  echo $flagcount;

        if($flagcount<0){          
            return $flagcount;
        }else{
            $q1->free_result();
            $f = fopen("date.csv", "r");
            $res = false;
            while ($row = fgetcsv($f)) {
                if ($row[0] == date('d/m/Y H:i', strtotime($data['stime']))) {
                    $res = true;
                    break;
                }
            }
            fclose($f);
            if(!$res)
            {
            $file = fopen("date.csv", "a");
            fputcsv($file, array(date('d/m/Y H:i', strtotime($data['stime']))));
            chmod("date.csv",0777);
            fclose($file);
            }

            $Cdata = array(
                "Name" => $data['campaignname'],
                "List_Id" => $data['list'],
                "StartDate" => $data['stime'],
                "Message" => $data['message']
            );
            $this->db->insert('tm_campaign', $Cdata);
            return 1;
        }        
    }
    public function Getstatus($Listid,$CampId)
    {
        $q1 = $this->db->select('*')
                ->from('tm_transaction')
                ->where("List_Id='$Listid'")
                ->get();
        $q2 = $this->db->select('*')
                ->from("tm_feedback")
                ->where("Campaign_Id='$CampId'")
                ->get();
        if($q1->num_rows() > $q2->num_rows() && $q2->num_rows() != 0)
        {
            return "<b style='color:orange'>Ongoing</b>";
        }else if($q1->num_rows() == $q2->num_rows())
        {
            return "<b style='color:green'>Completed</b>";
        }else if($q2->num_rows() == 0)
        {
            return "<b style='color:black'>Scheduled</b>";
        }
    }
    public function FetchCampaignbyid($Id)
    {
        $q = $this->db->select('tm_campaign.*,tm_list_master.Name as list')
                ->from('tm_campaign')
                ->join("tm_list_master","tm_campaign.List_Id=tm_list_master.Id",'left')
                ->where('tm_campaign.Id',$Id)
                ->get();
        foreach ($q->result_array() as $r);
        return $r;
    }
    public function RateCalculations($Id)
    {
        $data = array();
        $q = $this->db->select("count(*) as allcount")
                ->from('tm_feedback')
                ->where('Campaign_Id',$Id)
                ->get();
        foreach ($q->result_array() as $r);
        $q1 = $this->db->select("count(*) as reached")
                ->from('tm_feedback')
                ->where("Campaign_Id='$Id' and Audio_Status='True' and Feedback_Status='True'")
                ->get();
        foreach ($q1->result_array() as $r1);
        $q2 = $this->db->select("count(*) as noanswer")
                ->from('tm_feedback')
                ->where("Campaign_Id='$Id' and Feedback='No_Text'")
                ->get();
        foreach ($q2->result_array() as $r2);
        $q3 = $this->db->select("count(*) as played")
                ->from('tm_feedback')
                ->where("Campaign_Id='$Id' and Feedback='Recording is present but no transcript'")
                ->get();
        foreach ($q3->result_array() as $r3);
        if($r['allcount'] > 0)
        {
        $data['reached'] = ($r1['reached']/$r['allcount'])*100;
        $data['noanswer'] = ($r2['noanswer']/$r['allcount'])*100;
        $data['played'] = ($r3['played']/$r['allcount'])*100;
        }else{
        $data['reached'] = 0;
        $data['noanswer'] = 0;
        $data['played'] = 0;
        }
		
        $q4 = $this->db->query("call r_NPS('".$Id."')");
        if($q4->num_rows()>0)
        {
        foreach ($q4->result_array() as $r4);
        $data['nps'] = number_format($r4['NPS'],2);
        }else{
        $data['nps'] = '0.00';
        }
        return $data;
    }
}
