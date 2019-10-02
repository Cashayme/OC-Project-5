<?php
  
   class Registration extends CI_Controller {
   
    public function __construct() { 
        parent::__construct(); 
        $this->load->helper(array('form', 'url'));
        $this->load->library('bcrypt');
        $this->layout->add_css('style');
        $this->layout->add_js('js');
         
    } 
	
    public function index() {			

    $this->load->library('form_validation');
			
	 /* Validation rule */
    $this->form_validation->set_rules('name', 'Nom', 'required');
    $this->form_validation->set_rules('first_name', 'Prénom', 'required');
    $this->form_validation->set_rules('alias', 'Nom de compte', 'required');
    $this->form_validation->set_rules('birth_date', 'Date de naissance', 'required');
    $this->form_validation->set_rules('sex', 'Sexe', 'required');
	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_customer');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[35]');
    $this->form_validation->set_rules('city_address', 'Ville', 'required');
    $this->form_validation->set_rules('zip_code_address', 'Code postal', 'required');
    $this->form_validation->set_rules('address', 'Adresse', 'required');	 
			
        if ($this->form_validation->run() == FALSE) { 
            $this->layout->view('inscription'); 
        } 
        else { 
            $this->load->model('register_model');
		    $this->register_model->saveCustomer();
		    $success = "Vous êtes enregistré !";
            $this->layout->view('inscription', compact('success')); 
        } 
    }

	public function check_customer($email)
	{
	    $query = $this->db->where('email', $email)->get("user");
		if ($query->num_rows() > 0)
		{
			$this->form_validation->set_message('check_customer','L\'email '.$email.' est déjà utilisé par un autre compte');
		    return FALSE;
		}
		else 
			return TRUE;
	  }	
   }