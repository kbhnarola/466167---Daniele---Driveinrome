<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model{
    function __construct() {
            parent::__construct();
    }
    public function get_top_selling_tours($limit=""){
        $result_array = array();
        $this->db->select('t.id, t.title as tour_title,t.slug as tour_slug, t.tour_category_id, t.tour_type_id, t.duration, t.rating, t.feature_image, t.top_selling_tour , t.status, tc.title as tour_category_title,  tt.title as tour_type_title, tt.id as tour_type_table_id, t.meta_title');
        $this->db->from(TBL_TOUR . ' t');
        $this->db->join(TBL_TOUR_CATEGORY . ' tc', 'tc.id  = t.tour_category_id ', 'left');
        $this->db->join(TBL_TOUR_TYPE . ' tt', 'tt.id  = t.tour_type_id ', 'left');         
        $where_tour_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 't.top_selling_tour' => 1);
        $this->db->where($where_tour_data);
        $this->db->group_by('t.id');// add group_by
        $this->db->order_by("t.id", "desc");
        if($limit) {
            $this->db->limit($limit);
        } else {
            $this->db->limit(20);
        }
        $query = $this->db->get();        
        $result_array = $query->result_array();
        return $result_array;
        
    }   
}
?>