<?php
class Event_model extends CI_Model
{
    public function createEvent($userId, $image)
    {
        $data['creator_id'] = $userId;
        $data['event_name'] = $this->input->post('event_name');
        $data['event_description'] = $this->input->post('event_description');
        $data['city_address'] = $this->input->post('city_address');
        $data['zip_code_address'] = $this->input->post('zip_code_address');
        $data['address'] = $this->input->post('address');
        $data['event_date'] = $this->input->post('event_date');
        $data['max_fees'] = $this->input->post('max_fees');
        $data['event_picture'] = $image;

        if($this->input->post('private')) {
            $data['private'] = TRUE;
        } else {
            $data['private'] = FALSE;
        }

        if($this->input->post('mandatory_fees')) {
            $data['mandatory_fees'] = TRUE;
        } else {
            $data['mandatory_fees'] = FALSE;
        }

        if($this->input->post('mandatory_needs')) {
            $data['mandatory_needs'] = TRUE;
        } else {
            $data['mandatory_needs'] = FALSE;
        }

        $this->db->insert('event_plan', $data);
    }

    public function showEvent($id)
    {
        $data = array();
        $this->db->select('*') -> from('event_plan') -> where(['event_id' => $id]);
        $query = $this->db->get();
        return $query->result();
    }
}