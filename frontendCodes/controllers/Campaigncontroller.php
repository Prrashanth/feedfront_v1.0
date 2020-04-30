<?php

class Campaigncontroller extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Campaignmodel','campaign');
    }
    public function index()
    {
        $list = $this->campaign->FetchCampaign();
        for($i=0;$i<count($list);$i++)
        {
            $list[$i]['Status'] = $this->campaign->Getstatus($list[$i]['List_Id'],$list[$i]['Id']);
        }
        $data['list'] = $list;
        $data['page'] = 'campaign';
        $this->load->Loadpage('Campaign',$data);
    }
    public function Addcampaign()
    {
        $data = $_POST;
        $da = $this->campaign->Addcampaign($data);
        echo json_encode($da);
    }
    public function Viewcampaign()
    {
        $data['list'] = $this->campaign->FetchCampaignbyid($_GET['Id']);
        $data['vals'] = $this->campaign->RateCalculations($_GET['Id']);
        $data['page'] = 'campaign';
        $this->load->Loadpage('Campaigndetails',$data);
    }
}
