<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata'); 
class SchedulerModel extends CI_Model {
     
    
    public function fetchData() {
        
        $f = fopen("date.csv", "r");
        chmod("date.csv",0777);               
        $dt=date('d/m/Y H:i');
        echo date('h:i:s');        
        $csvarray=array();
        while ($row = fgetcsv($f)){ 
            $x=date($row[0]); 
            echo "<br>".$row[0];    
            $flag=0;
           //echo "<br>********".date('d-m-Y',strtotime($x));
            echo "<br>********".$row[0]."************".$dt;
            echo "\r\n";
            if ($row[0] == $dt){                
                    
                $q = $this->db->select('Customer_Name,Mobile_Number,Message,Preferred_TimrStamp,t.List_Id,t.id,c.id as campid')
                ->from('tm_transaction t')
                ->join('tm_feedback f','t.id=f.id','left outer')
                ->join('tm_campaign c','t.List_Id=c.List_Id')
                ->where("f.id IS NULL and DATE_FORMAT(StartDate, '%d/%m/%Y %H:%i') ='".$dt."'")
                ->get();
                $resultdata=$q->result_array();
                $framearray=array();
               // print_r($resultdata);
                foreach($resultdata as $arr){ 
                    
                    // framing of msg with variable replace
                    $q1 = $this->db->select('Attributes_Name,Attribute_Value')
                        ->from('tm_campaign_attributes c,tb_attribute_value a')                        
                        ->where("c.List_Id=a.List_Id AND Attribute_Id=c.id and c.List_id='".$arr['List_Id']."' and a.Transaction_Id='".$arr['id']."'")
                        ->get();
                        $resultdata1=$q1->result_array();
                        foreach($resultdata1 as $msg){                         
                            $arr['Message']=str_replace('['.$msg['Attributes_Name'].']', $msg['Attribute_Value'], $arr['Message']);                          
                        }
                        $arr['Message']=str_replace('[Customer Name]', $arr['Customer_Name'], $arr['Message']); 
                     
                   //  if($arr['Preferred_TimrStamp']==''){
                            $frame=$arr['Mobile_Number'].'<$$>'.$arr['Message'].'<$$>'.$arr['id'].'<$$>'.$arr['campid'];
                   //  }else{
                            array_push($framearray, $frame);
                   //  }
                     
                    // echo "<br>".$frame."<br>";
                }
                 print_r($framearray);
                   $ch = curl_init();  //http://104.198.235.125:8080/
                   curl_setopt($ch,CURLOPT_URL, "http://35.226.185.230:8111");              
                   curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
                   curl_setopt($ch,CURLOPT_POST,1);
                   curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($framearray));
                   curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
                   $response = curl_exec($ch);

                 $flag=1;
            }
            if($flag==0){             
                array_push($csvarray,$row[0]);
            }
            
        } // while



        fclose($f);
         //commented fo regression testing

         unlink("date.csv");
         $f = fopen("date.csv", "a+");
         //echo"enjoy";
         print_r($csvarray);
         for($i=0;$i<count($csvarray);$i++)
         {
            fputcsv($f,array($csvarray[$i]));
        }
         chmod("date.csv",0777);
         fclose($f); 
       

    }

    public function Addcampaign($data) {
        $f = fopen("date.csv", "r");
        $res = false;
        while ($row = fgetcsv($f)) {
            if ($row[0] == date('d/m/Y', strtotime($data['stime']))) {
                $res = true;
                break;
            }
        }
        fclose($f);
        if(!$res)
        {
        $file = fopen("date.csv", "a");
        fputcsv($file, array(date('d/m/Y', strtotime($data['stime']))));
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