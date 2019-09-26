<?php
class Login_model extends CI_Model
{
    public function login($email)
    {
        $this->db->select('password') -> from('user') -> where(['email' => $email]);
        $query = $this->db->get();
        
        if ($query->row() != null) {
            $verify = password_verify($this->input->post('password'), $query->row() -> password);

            if ($verify) {
                $password = $query->row() -> password;
            } else {
                $password = '';
            }

            $query = $this->db->where(['email' => $email, 'password' => $password])->get('user');
            return (int) $query->num_rows();
        }
    }

    public function getInfos($email, $line) 
    {
        $this->db->select('*') -> from('user') -> where(['email' => $email]);
        $query = $this->db->get();
        return $query->row() -> $line;
    }

    public function checkLogin()
    {
        $email = $this->session->userdata('email');
        $password = $this->session->userdata('password');
        $query = $this->db->where(['email' => $email, 'password' => $password])->get('user');
        return (int) $query->num_rows();
    }
}