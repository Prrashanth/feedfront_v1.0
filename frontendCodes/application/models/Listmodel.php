<?php

class Listmodel extends CI_Model {
    
    public function Fetchlist()
    {
        $q = $this->db->select('*')
                ->from('tm_list_master')
                ->get();
        return $q->result_array();
    }
    public function Fetchlistdetails($data)
    {
        $q = $this->db->select('*')
                ->from('tm_campaign_attributes')
                ->where('List_Id',$data['listId'])
                ->get();
        return $q->result_array();
    }
    public function Addlist($data) {
//        var_dump($data);
        $list = json_decode($data['list'], true);
        $listdata = array(
            "Name" => $data['listname'],
            "Description" => $data['description']
        );
        $this->db->insert('tm_list_master', $listdata);
        $listId = $this->db->insert_id();
        $attrIds = array();
        for ($i = 0; $i < count($list); $i++) {
            $dt = '';
            $transactiondata = array(
                "List_Id" => $listId,
                "Customer_Name" => $list[$i]['Customer Name'],
                "Mobile_Number" => $list[$i]['Phone Number']
            );
            if(isset($list[$i]['Preferred Date']))
            {
                $dt = $list[$i]['Preferred Date']." ";
            }
            if(isset($list[$i]['Preferred Time']))
            {
                $dt .= $list[$i]['Preferred Time'];
            }
            if($dt != '')
            {
                $transactiondata['Preferred_TimrStamp'] = date('Y-m-d H:i:s', strtotime("$dt"));
            }
            $this->db->insert('tm_transaction', $transactiondata);
            $trId = $this->db->insert_id();
            foreach ($list[$i] as $key => $value) {
                if($i == 0)
                {
                    $campAttr = array(
                        "Attributes_Name" => $key,
                        "List_Id" => $listId
                    );
                    $this->db->insert('tm_campaign_attributes', $campAttr);
                    $attrIds[$key] = $this->db->insert_id();
                }
                if($key != 'Customer Name' && $key != 'Phone Number' && $key !='Preferred Date' && $key !='Preferred Time')
                {
                    $attrdata = array(
                        "List_Id" => $listId,
                        "Attribute_Id" => $attrIds[$key],
                        "Attribute_Value" => $value,
                        "Transaction_Id" => $trId
                    );
                    $this->db->insert('tb_attribute_value',$attrdata);
                }
            }
            
        }
        return 1;
    }

}
