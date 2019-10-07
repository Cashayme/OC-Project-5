<?php
  
class Event extends CI_Controller 
{
   
    public function __construct() { 
        parent::__construct(); 
        $this->load->helper(array('form', 'url'));
        $this->load->model('login_model');
        $this->load->model('event_model');
        $this->layout->add_css('style');
        $this->layout->add_js('jquery-3.4.1.min');
        $this->layout->add_js('javascript');
        $this->layout->add_js('mdb.min');
    } 
    
    public function index() {
        $data['events'] = $this->event_model->listEvent();
        $this->layout->view('event_list', $data);
    }

    public function create() {			
        if ($this->login_model->checkLogin() > 0) {
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
                   $config['encrypt_name'] = TRUE;
                   $config['upload_path']= './assets/images/uploaded_images';
                   $config['allowed_types']= 'gif|jpg|png';
                   $this->load->library('upload', $config);
                   $this->upload->do_upload('file_name');
                   $file_name = $this->upload->data();

                   $this->event_model->createEvent($userId, $file_name['file_name']);
                   redirect('/event/myevents');
               } 

        } else {
            redirect('/login');
        }
    }

    public function plan($id) {
        if ($this->login_model->checkLogin() > 0) {

            $data['event'] = $this->event_model->showEvent($id);

            //var_dump($data['participants']);

            if ($this->event_model->isParticipants($id, $this->session->userdata('id'), TRUE)) {
                $data['needs'] = $this->event_model->getEventNeeds($id);
                $data['participants'] = $this->event_model->participantsList($id);
                $data['claimers'] = $this->event_model->claimersList($id);
                $data['p_needs'] = $this->event_model->participantsNeeds($id);
                $data['p_rank'] = $this->event_model->participantsRank($id)[0];
                $data['total_fees'] = $this->event_model->totalFees($id);

                if($this->event_model->isAdmin($id, $this->session->userdata('id')) == 'creator') {
                    $data['creator'] = '1';
                }

                if($this->event_model->isAdmin($id, $this->session->userdata('id')) == 'admin') {
                    $data['admin'] = '1';
                }

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

    public function fees($eventId) {
        if ($this->login_model->checkLogin() > 0) {
            $this->load->library('form_validation');
                
            /* Validation rule */
            $this->form_validation->set_rules('new_fees', 'Nouvelle cotisation', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                redirect('event/plan/'.$eventId.'');
            } else { 
                $this->event_model->newFees($eventId, $this->session->userdata('id'));
                redirect('event/plan/'.$eventId.'#fees');
            } 
        } else {
            redirect('/login');
        }
    }

    public function supplier($eventId, $needId) {
        if ($this->login_model->checkLogin() > 0) {
            $this->event_model->newSupplier($needId,$this->session->userdata('id'));
            redirect('event/plan/'.$eventId.'#participants');
        } else {
            redirect('/login');
        }
    }

    public function myEvents() {
        if ($this->login_model->checkLogin() > 0) {
            $data['events'] = $this->event_model->myEvents($this->session->userdata('id'));
            $data['mine'] = 1;
            $this->layout->view('my_events',$data);
        } else {
            redirect('/login');
        }
    }

    public function iParticipate() {
        if ($this->login_model->checkLogin() > 0) {
            $data['events'] = $this->event_model->iParticipate($this->session->userdata('id'));
            $this->layout->view('my_events',$data);
        } else {
            redirect('/login');
        }
    }

    public function delete($eventId, $image) {
        if ($this->login_model->checkLogin() > 0) {
            if($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') {
                $this->event_model->deleteEvent($eventId, $this->session->userdata('id'));

                if($image != 'default.jpg' ) {
                    unlink("assets/images/uploaded_images/$image");
                }
            }

            redirect('event/myevents');
        } else {
            redirect('/login');
        }
    }

    public function edit($eventId)
    {
        if ($this->login_model->checkLogin() > 0) {
            if($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') {
                $this->load->library('form_validation');
                
                    /* Validation rule */
                $this->form_validation->set_rules('event_name', 'Nom de l\'évènement', 'required');
                $this->form_validation->set_rules('event_description', 'Description', 'required');
                $this->form_validation->set_rules('city_address', 'Ville de l\'évènement', 'required');
                $this->form_validation->set_rules('zip_code_address', 'Code postal', 'required');
                $this->form_validation->set_rules('address', 'Adresse', 'required');
                $this->form_validation->set_rules('event_date', 'Date de l\'évènement', 'required');
            
                    
                if ($this->form_validation->run() == FALSE) {
                    $data['infos'] = $this->event_model->showEvent($eventId);
                    $data['needs'] = $this->event_model->getEventNeeds($eventId);
                    $this->layout->view('event_form', $data);

                } else { 
                    $userId = $this->session->userdata('id');

                    /* Config upload images*/
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path']= './assets/images/uploaded_images';
                    $config['allowed_types']= 'gif|jpg|png';
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('file_name');
                    $file_name = $this->upload->data();
                    

                    //$this->event_model->editEvent($eventId, $userId,$this->input->post('actual_pic'));

                    $this->event_model->editEvent($eventId, $userId, $file_name['file_name']);


                    //var_dump($this->event_model->showEvent($eventId)[0]['event_picture']);
                    redirect('/event/myevents');
                }
            } else {
                redirect('/event/myevents');
            }

        } else {
            redirect('/login');
        }
    }

    public function removeSupplier($eventId, $needId) {
        if ($this->login_model->checkLogin() > 0) {
            if(($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') || ($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'admin')) {
                $this->event_model->removeSupplier($needId);
                redirect('event/plan/'.$eventId.'#needs');
            } else {
                redirect('event/plan/'.$eventId.'#needs');
            }

        } else {
            redirect('/login');
        }
    }

    public function rank($eventId, $userId, $state) {
        if ($this->login_model->checkLogin() > 0) {

            if($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') {

                if($state == 'up') {
                    $this->event_model->rank($eventId, $userId, TRUE);  
                } else {
                    $this->event_model->rank($eventId, $userId, FALSE);
                }
                
                redirect('event/plan/'.$eventId.'#participants');
            } else {
                redirect('event/plan/'.$eventId.'#participants');
            }

        } else {
            redirect('/login');
        }
    }

    public function removeNeed($eventId, $needId) {
        if ($this->login_model->checkLogin() > 0) {
            if(($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') || ($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'admin')) {
                $this->event_model->removeNeed($needId);
                redirect('event/plan/'.$eventId.'#needs');
            } else {
                redirect('event/plan/'.$eventId.'#needs');
            }
        } else {
            redirect('/login');
        }
    }

    public function claim($eventId, $userId)
    {
        if ($this->login_model->checkLogin() > 0) {
            $this->event_model->claim($eventId, $userId);
            redirect('event/plan/'.$eventId.'');
        } else {
            redirect('/login');
        }
    }

    public function acceptClaim($eventId, $userId)
    {
        if ($this->login_model->checkLogin() > 0) {
            if(($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') || ($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'admin')) {
                $this->event_model->acceptClaim($eventId, $userId);
                redirect('event/plan/'.$eventId.'');
            } else {
                redirect('event/plan/'.$eventId.'');
            }
        } else {
            redirect('/login');
        }
    }

    public function deleteParticipant($eventId, $userId)
    {
        if ($this->login_model->checkLogin() > 0) {
            if(($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') || ($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'admin')) {
                $this->event_model->deleteParticipant($eventId, $userId);
                redirect('event/plan/'.$eventId.'');
            } else {
                redirect('event/plan/'.$eventId.'');
            }
        } else {
            redirect('/login');
        }
    }
}