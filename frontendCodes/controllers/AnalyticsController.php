<?php

class AnalyticsController extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Analyticsmodel','analytics');
        $this->load->model('Campaignmodel','campaign');
    }
    public function index()
    {
        $data['list'] = $this->campaign->FetchCampaign();
        $data['page']='analytics';
        $this->load->Loadpage('Analytics',$data);
    }
    public function Getanlytics()
    {
        $dat = $_POST;
        $pdata = $dat;
        if($pdata['Campaign'] == '')
        {
            $pdata['Campaign'] = 'null';
        }
        if($pdata['fromDate'] == '')
        {
            $pdata['fromDate'] = 'null';
        }
        if($pdata['toDate'] == '')
        {
            $pdata['toDate'] = 'null';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://35.226.185.230:8163/");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($pdata));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(curl_exec($ch) != '[] []')
        {
        $re = str_replace("'", '', curl_exec($ch));
        $re = str_replace(" ", '', $re);
        $expo = explode('][',$re);
        $resp = array();
        $expo[0] = str_replace('[','',$expo[0]);
        $expo[1] = str_replace(']','',$expo[1]);
        $resp = array();
        $resp[0] = explode(',', $expo[0]);
        $resp[1] = explode(',', $expo[1]);
        }else{
            $resp[0] = array();
            $resp[1] = array();
        }
//        var_dump($resp);
        $data['keyword'] = $resp;
        curl_close($ch);
        $data['sentiment'] = $this->analytics->Getsentimentscore($dat);
        echo json_encode($data);
    }
}