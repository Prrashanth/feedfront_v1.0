<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class DatatableController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DatatableModel','datatable');
    }
 
    public function ajax_list()
    {
        $list = $this->datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dat) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $dat->Customer_Name;
            $row[] = $dat->Mobile_Number;
            if($dat->Status == 'Message Played')
            {
                $row[] = '<b class="text-warning">'.$dat->Status."</b>";
            }elseif ($dat->Status == 'Not Answered') {
                $row[] = '<b class="text-danger">'.$dat->Status."</b>";
            }elseif ($dat->Status != ''){
              $row[] = '<button class="btn btn-sm btn-success" onclick="playAudio(\''.$dat->Status.'\',\''.$dat->Mobile_Number.'\')" type="button"><i class="fa fa-play"></i>&nbsp;&nbsp;<span class="bold">Play Audio</span></button>';  
            }else{
                $row[] = "";
            }
            $row[] = $dat->Overall_Score;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->datatable->count_all(),
                        "recordsFiltered" => $this->datatable->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
 
}