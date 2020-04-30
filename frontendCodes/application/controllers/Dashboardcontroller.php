<?php

class Dashboardcontroller extends CI_Controller
{
	public function __construct() {
        parent::__construct();
        $this->load->model('DashboardModel','dashmod');
    }
    public function index()
    {
        $data['page'] = 'dashboard';
        $this->load->Loadpage('Dashboard',$data);
        
    }
    public function getMinutes(){
    	$data = $this->dashmod->getMinutes();
        echo json_encode($data);
    }
}