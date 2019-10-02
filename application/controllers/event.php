<?php
  
class Event extends CI_Controller 
{
   
    public function __construct() { 
        parent::__construct(); 
        $this->load->helper(array('form', 'url'));
        $this->load->model('login_model');
        $this->load->model('event_model');
        $this->layout->add_css('style');
        $this->layout->add_js('javascript');
    } 
    
    public function index() {
        $data['events'] = $this->event_model->listEvent();
        $this->layout->view('event_list', $data);
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
               } else { 
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
            redirect('/login');
        }
    }

    public function plan($id) {
        if($this->login_model->checkLogin() > 0) {

            $data['event'] = $this->event_model->showEvent($id);
            $data['needs'] = $this->event_model->getEventNeeds($id);
            $data['participants'] = $this->event_model->participantsList($id);
            $data['p_needs'] = $this->event_model->participantsNeeds($id);
            $data['p_rank'] = $this->event_model->participantsRank($id)[0];
            $data['total_fees'] = $this->event_model->totalFees($id);
            //var_dump($data['participants']);

            if ($this->event_model->isParticipants($id, $this->session->userdata('id'), TRUE)) {

               $this->layout->view('event_plan', $data);

            } else if ($this->event_model->isParticipants($id, $this->session->userdata('id'), FALSE)){

                $data['event'] = $this->event_model->showEvent($id);
                $data['msg'] = 'Votre invitation n\'a pas encore été acceptée';

                $this->layout->view('event_invit',$data);

            } else {

                $data['event'] = $this->event_model->showEvent($id);

                $this->layout->view('event_invit',$data);
            }
        } else {

            redirect('/login');
        }
    }
}