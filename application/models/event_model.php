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

        //Infos sur les besoins qui vont eux dans la table event_needs
        $dataneeds['event_id'] = $this->db->insert_id();

        for($l=0; $l < count($this->input->post('need')); $l++){

            $dataneeds['need_name'] = $this->input->post('need')[$l];
            $dataneeds['category'] = $this->input->post('category')[$l];
            
            $this->db->insert('event_needs', $dataneeds);

        }
    }

    public function showEvent($id)
    {
        $data = array();
        $this->db->select('*') -> from('event_plan') -> where(['event_id' => $id]);
        // Produces: LEFT JOIN comments ON comments.id = blogs.id
        //LEFT join user as u on e.supplier_id = u.id_user
        //SELECT e.*,u.id_user, u.alias FROM `event_needs` as e inner join user as u on e.supplier_id = u.id_user
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getEventNeeds($id)
    {
        $data = array();
        $this->db->select('*') -> from('event_needs') -> where(['event_id' => $id]);
        $this->db->join('user', 'event_needs.supplier_id = user.id_user', 'left');
        $this->db->join('needs_category', 'needs_category.id_category = event_needs.category', 'left');
        $query = $this->db->get();
        return $query;
    }

    public function listEvent() 
    {
        $data = array();
        $this->db->select('*') -> from('event_plan') -> where(['private' => TRUE]);
        $query = $this->db->get();
        return $query;
    }

    public function isParticipants($eventId, $userId, $authorized)
    {
        $data = array();
        $this->db->select('*') -> from('event_participants') -> where(['event_id' => $eventId, 'user_id' => $userId, 'authorized' => $authorized]);
        $query = $this->db->get();
        if($query->row() != null) {
            return (int) $query->num_rows();
        }
    }

    public function participantsList($id) 
    {
        $data = array();
        $this->db->select('*') -> from('event_participants') -> where(['event_participants.event_id' => $id, 'authorized'=> TRUE]);
        $this->db->join('user', 'event_participants.user_id = user.id_user', 'left');
        $this->db->join('membership_fees', 'membership_fees.user_id = user.id_user', 'left');
        //$this->db->join('event_plan', 'event_plan.creator_id = user.id_user', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function participantsRank($id) 
    {
        $this->db->select('*') -> from('event_plan') -> where(['event_participants.event_id' => $id]);
        $this->db->join('event_participants', 'event_participants.event_id = event_plan.event_id', 'outter');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function participantsNeeds($id)
    {
        $data = array();
        $this->db->select('*') -> from('event_needs') -> where(['event_id' => $id]);
        $this->db->join('needs_category', 'needs_category.id_category = event_needs.category', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function totalFees($id)
    {
        $this->db->select_sum('fees') -> from('membership_fees') -> where(['event_id' => $id]);
        $query = $this->db->get()->result_array();
        return $query;
    }
}