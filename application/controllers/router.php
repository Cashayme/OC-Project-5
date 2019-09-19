<?php

class Router extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->CI =& get_instance();
        
        $this->var['output'] = '';
        
    }
    
    public function view($name, $data = array())
    {
        $this->output .= $this->CI->load->view($name, $data, true);
        
        $this->CI->load->view('../themes/default', array('output' => $this->output));
    }

    public function accueil()
    {
        $this->load->library('layout');
        $this->layout->view('accueil');
    }   
}