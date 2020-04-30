<?php

class Logincontroller extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Loginmodel','login');
    }
    public function index()
    {
        $this->load->view('Login');
    }
    public function Verify()
    {
        $data = $_POST;
        $ret = $this->login->Verify($data);
        if($ret > 0)
        {
            $this->session->set_userdata('username',$data['username']);
        }
        echo $ret;
    }
    public function Logout()
    {
        $this->session->sess_destroy();
        echo "<script>window.location='Logincontroller';</script>";
    }
}