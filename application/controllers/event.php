<?php
  
class Event extends CI_Controller 
{
   
    public function __construct() { 
        parent::__construct(); 
        $this->load->helper(array('form', 'url'));
        $this->load->library('layout');
        $this->load->model('login_model');
    } 
	
    public function create() {			
        if($this->login_model->checkLogin() > 0) {
            $this->load->library('form_validation');
			
            /* Validation rule */
           $this->form_validation->set_rules('event_name', 'Nom de l\'évènement', 'required');
           $this->form_validation->set_rules('event_description', 'Description', 'required');
           $this->form_validation->set_rules('city_address', 'Ville de l\'évènement', 'required');
           $this->form_validation->set_rules('zip_code_address', 'Code postal', 'required');
           $this->form_validation->set_rules('address', 'Adresse', 'required');
           $this->form_validation->set_rules('event_date', 'Date de l\'évènement', 'required');
                   
               if ($this->form_validation->run() == FALSE) {
                   $this->layout->view('event_form'); 
               } 
               else { 
                   $this->load->model('event_model');
                   $userId = $this->login_model->getInfos($this->session->userdata('email'), 'id_user');

                   /* Config upload images*/
                   $config['upload_path']= './assets/images/uploaded_images';
                   $config['allowed_types']= 'gif|jpg|png';
                   $this->load->library('upload', $config);
                   $this->upload->do_upload('file_name');
                   $file_name = $this->upload->data();

                   $this->event_model->createEvent($userId, $file_name['file_name']);
               } 

        } else {
            redirect('/login/');
        }
    }
}