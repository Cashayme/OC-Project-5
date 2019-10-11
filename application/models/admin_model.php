<?php
class Admin_model extends CI_Model
{
    public function checkPowers($id)
    {
        $this->db->select('*') -> from('admin') -> where(['user_id' => $id]);
        $query = $this->db->get();
        
        if (!empty($query->result())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function listEvent($offset) 
    {
        $data = array();
        $this->db->select('*') -> from('event_plan') -> limit(15) -> offset($offset) -> order_by("event_id", "desc");
        $query = $this->db->get();
        return $query;
    }

    public function listUser($offset) 
    {
        $data = array();
        $this->db->select('*') -> from('user') -> limit(15) -> offset($offset) -> order_by("id_user", "desc");
        $query = $this->db->get();
        return $query;
    }

    public function deleteUser($userId)
    {
        $this->db->delete('user', array('id_user' => $userId));
    }
}