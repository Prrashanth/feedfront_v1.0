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
    public function RateCalculations($data)
    {
        $Id = $data['Campaign'];
        $dat = array();
        $this->db->select("count(*) as allcount")
                ->from('tm_feedback');
        if($data['Campaign'] != '')
        {
            $this->db->where("Campaign_Id='".$data['Campaign']."'");
        }else{
            $this->db->where("CAST(TimeStamp AS DATE) between '".$data['fromDate']."' and '".$data['toDate']."'");
        }
        $q = $this->db->get();
        foreach ($q->result_array() as $r);
        $this->db->select("count(*) as reached")
                ->from('tm_feedback')
                ->where("Audio_Status='True' and Feedback_Status='True'");
        if($data['Campaign'] != '')
        {
            $this->db->where("Campaign_Id='".$data['Campaign']."'");
        }else{
            $this->db->where("CAST(TimeStamp AS DATE) between '".$data['fromDate']."' and '".$data['toDate']."'");
        }
        $q1 = $this->db->get();
        foreach ($q1->result_array() as $r1);
        $this->db->select("count(*) as noanswer")
                ->from('tm_feedback')
                ->where("Call_Status in ('no-answer','failed','rejected','busy')");
        if($data['Campaign'] != '')
        {
            $this->db->where("Campaign_Id='".$data['Campaign']."'");
        }else{
            $this->db->where("CAST(TimeStamp AS DATE) between '".$data['fromDate']."' and '".$data['toDate']."'");
        }
        $q2 = $this->db->get();
        foreach ($q2->result_array() as $r2);
        $this->db->select("count(*) as played")
                ->from('tm_feedback')
                ->where("Call_Status='completed'");
        if($data['Campaign'] != '')
        {
            $this->db->where("Campaign_Id='".$data['Campaign']."'");
        }else{
            $this->db->where("CAST(TimeStamp AS DATE) between '".$data['fromDate']."' and '".$data['toDate']."'");
        }
        $q3 = $this->db->get();
        foreach ($q3->result_array() as $r3);
        if($r['allcount'] > 0)
        {
        $dat['allcount'] = $r['allcount'];
        $dat['reached'] = "<h4 class='no-margins text-navy'>".number_format(($r1['reached']/$r['allcount'])*100,2)."%<h4><b>".$r1['reached']."</b>";
        $dat['played'] = "<h4 class='no-margins text-navy'>".number_format(($r3['played']/$r['allcount'])*100,2)."%<h4><b>".($r3['played'])."</b>";
        $dat['noanswer'] = "<h4 class='no-margins text-navy'>".number_format(($r2['noanswer']/$r['allcount'])*100,2)."%<h4><b>".$r2['noanswer']."</b>";
        }else{
        $dat['allcount'] = 0;
        $dat['reached'] = "<h4 class='no-margins text-navy'>0%</h4><b>0</b>";
        $dat['noanswer'] = "<h4 class='no-margins text-navy'>0%</h4><b>0</b>";
        $dat['played'] = "<h4 class='no-margins text-navy'>0%</h4><b>0</b>";
        }
        if($data['Campaign'] != '')
        {
        $q4 = $this->db->query("call r_NPS('".$Id."','NA','NA')");
        }else{
            $q4 = $this->db->query("call r_NPS('NA','".$data['fromDate']."','".$data['toDate']."')");
        }
        if($q4->num_rows()>0)
        {
        foreach ($q4->result_array() as $r4);
//var_dump($r4);
//NPS_TotalCount
        $dat['nps'] = "<h4 class='no-margins' style='color:";
                                if($r4['NPS'] > 0)
                                {
                                    $dat['nps'].= "#1ab394";
                                }elseif ($r4['NPS'] < 0) {
                                    $dat['nps'].= "red";
                                }else{
                                    $dat['nps'].= "text-navy";
                                }
           $dat['nps'].=  "'>".number_format($r4['NPS'],2)."%</h4>";
		   if($r4['NPS'] == null)
           {
               $dat['npss'] = 0;
           }else{
           $dat['npss'] = number_format($r4['NPS'],2);
           }
//        $dat['nps'] = number_format($r4['NPS'],2);
        }else{
            $dat['nps'] = "<h4 class='no-margins text-navy'>0%</h4><b>0</b>";
			$dat['npss'] = 0;
        }
        return $dat;
    }
}
