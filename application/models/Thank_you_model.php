<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thank_you_model extends CI_Model{
    function __construct() {
            parent::__construct();
    }
    function get_upselling_tour_details(){
        $result_array = array();
        $this->db->select('tour.*');
        $this->db->from(TBL_TOUR.' as tour');
        // $this->db->join(TBL_TOUR_CATEGORY.' as city','tour.tour_category_id=city.id');
        // $this->db->join(TBL_TOUR_TYPE.' as tour_type','tour.tour_type_id=tour_type.id');
        $this->db->where(array('tour.status' => 1, 'tour.upselling_tours' => 1));
        $this->db->group_by(array('tour.id'));// add group_by
        // $this->db->order_by('t.title', "asc");
        $this->db->query("SET sql_mode = '' ");
        $query=$this->db->get();
        // pr($this->db->last_query());die;
        $result_array = $query->row_array();
        return $result_array;
    } 
}