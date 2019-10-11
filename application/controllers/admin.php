<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('login_model');
        $this->load->model('event_model');
        $this->load->model('admin_model');
        $this->layout->add_css('style');
        $this->layout->add_js('jquery-3.4.1.min');
        $this->layout->add_js('front');
        $this->layout->add_js('main');
    }

    public function index()
    {   
        if ($this->login_model->checkLogin() > 0) {
            if($this->admin_model->checkPowers($this->session->userdata('id'))) {
                $this->layout->add_js('ajax/admin_listevent');
                $data['events'] = $this->admin_model->listEvent(0);
                $this->layout->view('admin',$data);
            } else {
                show_404();
            }
        } else {
            redirect('/login');
        }
    }

    public function moreEvent($offset) {
        if ($this->login_model->checkLogin() > 0) {
            if($this->admin_model->checkPowers($this->session->userdata('id'))) {
                $data['events'] = $this->admin_model->listEvent($offset);
                $data['admin'] = 1;
                $this->load->view('more',$data);
            } else {
                show_404();
            }
        } else {
            redirect('/login');
        }
    }

    public function moreUser($offset) {
        if ($this->login_model->checkLogin() > 0) {
            if($this->admin_model->checkPowers($this->session->userdata('id'))) {
                $data['users'] = $this->admin_model->listUser($offset);
                $data['admin'] = 1;
                $this->load->view('more',$data);
            } else {
                show_404();
            }
        } else {
            redirect('/login');
        }
    }

    public function delEvent($eventId, $userId) {
        if ($this->login_model->checkLogin() > 0) {
            if($this->admin_model->checkPowers($this->session->userdata('id'))) {
                $this->event_model->deleteEvent($eventId, $userId);
                redirect('/admin');
            } else {
                show_404();
            }
        } else {
            redirect('/login');
        }
    }

    public function listUser() {
        if ($this->login_model->checkLogin() > 0) {
            if($this->admin_model->checkPowers($this->session->userdata('id'))) {
                $this->layout->add_js('ajax/admin_listuser');
                $data['users'] = $this->admin_model->listUser(0);
                $this->layout->view('admin',$data);
            } else {
                show_404();
            }
        } else {
            redirect('/login');
        }
    }

    public function delUser($userId) {
        if ($this->login_model->checkLogin() > 0) {
            if($this->admin_model->checkPowers($this->session->userdata('id'))) {
                $this->admin_model->deleteUser($userId);
                redirect('/admin/listuser');
            } else {
                show_404();
            }
        } else {
            redirect('/login');
        }
    }
}