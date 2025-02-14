<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thank_you_model extends CI_Model{
    function __construct() {
            parent::__construct();
    }
    function get_upselling_tours(){
        $result_array = array();
        $this->db->select('tour.*,city.title as city,tour_type.title as tour_type');
        $this->db->from(TBL_TOUR.' as tour');
        $this->db->join(TBL_TOUR_CATEGORY.' as city','tour.tour_category_id=city.id');
        $this->db->join(TBL_TOUR_TYPE.' as tour_type','tour.tour_type_id=tour_type.id');
        $this->db->where(array('tour.status' => 1, 'tour.upselling_tours' => 1, 'city.status' => 1, 'tour_type.status' => 1));
        $this->db->group_by(array('tour.id'));// add group_by
        // $this->db->order_by('t.title', "asc");
        $this->db->query("SET sql_mode = '' ");
        $query=$this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    } 
    function insert_booking_details(){
        $result_array = array();
        $this->db->select('tour.*,city.title as city,tour_type.title as tour_type');
        $this->db->from(TBL_TOUR.' as tour');
        $this->db->join(TBL_TOUR_CATEGORY.' as city','tour.tour_category_id=city.id');
        $this->db->join(TBL_TOUR_TYPE.' as tour_type','tour.tour_type_id=tour_type.id');
        $this->db->where(array('tour.status' => 1, 'tour.upselling_tours' => 1, 'city.status' => 1, 'tour_type.status' => 1));
        $this->db->group_by(array('tour.id'));// add group_by
        // $this->db->order_by('t.title', "asc");
        $this->db->query("SET sql_mode = '' ");
        $query=$this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    } 
    function check_user_exist($user_email){
        $result_array = array();
        $this->db->select('user.*');
        $this->db->from(TBL_USERS.' as user');
        $this->db->where(array('user.email' => $user_email));
        $query=$this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }
    function add_user($user_data){
        $this->db->insert(TBL_USERS, $user_data);
        $insert_id = $this->db->insert_id();     
        return  $insert_id;
    }
    function update_user($user_id, $postData, $subscribe_user = ''){    
        $this->db->where('id', $user_id);
        if(!empty($subscribe_user)){
            $this->db->where('subscribe', $subscribe_user);
        }
        $this->db->update(TBL_USERS, $postData);
        if ($this->db->affected_rows() == '1')
            return true;
        else
            return false;
    }
}