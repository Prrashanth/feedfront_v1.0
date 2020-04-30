<?php

class MY_Loader extends CI_Loader {
    public function Loadpage($template_name, $vars = array(), $return = FALSE)
    {
        $CI =& get_instance();
        if($CI->session->userdata('username') != '')
        {
        if($return):
        $content  = $this->view('Header', $vars, $return);
        $content .= $this->view($template_name, $vars, $return);
        $content .= $this->view('Footer', $vars, $return);

        return $content;
    else:
        $this->view('Header', $vars);
        $this->view($template_name, $vars);
        $this->view('Footer', $vars);
    endif;
        }else{
            echo "<script>window.location='Logincontroller';</script>";
        }
    }
}