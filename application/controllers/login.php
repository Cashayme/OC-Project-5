<?php
  
   class Login extends CI_Controller {
   
      public function __construct() { 
         parent::__construct(); 
         $this->load->helper(array('form', 'url'));
         $this->load->library('bcrypt');
      } 
	
      public function index() {
			
         /* Load form validation library */ 
         $this->load->library('form_validation');
			
	 /* Validation rule */
	 $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	 $this->form_validation->set_rules('password', 'Password', 'required');	 
			
         if ($this->form_validation->run() == FALSE) { 
            $this->layout->view('login'); 
         } 
         else { 
			$this->load->model('login_model');
			$result = $this->login_model->login();
			if ($result > 0)
			redirect('login/dashboard');
			else 
			  { 
				$msg = "L'email et le mot de passe ne correspondent pas ou sont invalides";
				$this->layout->view('login', compact('msg'));
			  } 
		}
	} 
		
	public function dashboard()
	  {
	    $this->layout->view('dashboard');	
	  }
 }
 
?>