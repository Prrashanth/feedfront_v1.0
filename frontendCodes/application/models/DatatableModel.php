<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class DatatableModel extends CI_Model {
 
    var $table = 'tm_transaction';
    var $column_order = array(null, 'Customer_Name','Mobile_Number','Status','Overall_Score'); //set column field database for datatable orderable
    var $column_search = array('Customer_Name','Mobile_Number',"(CASE when tm_feedback.Feedback='No_Text' then 'Not Answered' when tm_feedback.Feedback='Recording is present but no transcript' then 'Message Played' else tm_feedback.Feedback_Url END)",'Overall_Score'); //set column field database for datatable searchable 
    var $order = array('Customer_Name' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {        
        $this->db->select("Customer_Name,Mobile_Number,"
                . "(CASE when tm_feedback.Feedback='No_Text' then 'Not Answered' "
                . "when tm_feedback.Feedback='Recording is present but no transcript' then 'Message Played' "
                . "else tm_feedback.Feedback_Url END) as Status,Overall_Score");
        $this->db->from($this->table);
        $this->db->join("tm_campaign","tm_campaign.List_Id=tm_transaction.List_Id","left");
        $this->db->join("tm_feedback","tm_campaign.Id=tm_feedback.Campaign_Id and tm_transaction.Id=tm_feedback.Transaction_Id","left");
        if(isset($_POST['campId']))
        {
            $this->db->where("tm_campaign.Id",$_POST['campId']);
        }
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        if(isset($_POST['campId']))
        {
            $this->db->where("Id",$_POST['campId']);
        }
        return $this->db->count_all_results();
    }
 
}