<?php

class Listcontroller extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Listmodel','list');
    }
    public function index()
    {
        $data['list'] = $this->list->Fetchlist();
        $data['page'] = 'list';
        $this->load->Loadpage('CustomerList',$data);
    }
    public function Fetchlist()
    {
        $data = $this->list->Fetchlist();
        echo json_encode($data);
    }
    public function Getlistdetails()
    {
        $data = $this->list->Fetchlistdetails($_POST);
        echo json_encode($data);
    }

    public function Addlist()
    {
        $data = $_POST;
        $this->list->Addlist($data);
//         echo "<script>window.location='List';</script>";
    }
}