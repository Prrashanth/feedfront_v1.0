<?php


class SchedulerController extends CI_Controller
{
    public function __construct() {
        parent::__construct();  
        $this->load->model('SchedulerModel','schedule');      
    }   
    public function setSchedule()
    {
        $data['page']='Analytics';
        $da = $this->schedule->fetchData($data);
      //  $da = $this->analytics->keywordMapping($data);
      //  echo $da;
    }
}


