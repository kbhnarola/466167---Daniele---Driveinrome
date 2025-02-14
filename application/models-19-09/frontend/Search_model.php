<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_tours_by_name($tour_name = '', $limit = false)
    {
        if (!$tour_name) {
            return false;
        }
        if ($limit) {
            return $this->db->select(TBL_TOUR . '.title, ' . TBL_TOUR . '.slug')->from(TBL_TOUR)->where("title LIKE '%$tour_name%' AND status = 1")->order_by(TBL_TOUR . '.id', 'DESC')->limit(5)->get()->result_array();
        } else {
            return $this->db->select(TBL_TOUR . '.title, ' . TBL_TOUR . '.slug')->from(TBL_TOUR)->where("title LIKE '%$tour_name%' AND status = 1")->order_by(TBL_TOUR . '.id', 'DESC')->get()->result_array();
        }
    }
    function get_tour_list_by_name($tour_name, $limit, $start)
    {
        $result_array = array();
        $this->db->select('t.id as tour_id, t.title as tour_title, t.tour_category_id, t.tour_type_id, t.duration, t.rating, t.feature_image, t.top_selling_tour , t.status, t.unique_code, t.slug as tour_slug, t.meta_title, tc.id as as_tour_category_id, tc.title as tour_category_title, tc.slug as tour_category_slug, tc.feature_image as tour_feature_image,  tt.title as tour_type_title, tt.id as tour_type_table_id');

        $this->db->from(TBL_TOUR . ' t');
        $this->db->join(TBL_TOUR_CATEGORY . ' tc', 'tc.id  = t.tour_category_id ', 'left');
        $this->db->join(TBL_TOUR_TYPE . ' tt', 'tt.id  = t.tour_type_id ', 'left');
        $where_tour_data = array('t.status' => 1);
        $this->db->where($where_tour_data);
        $this->db->like('t.title', $tour_name);
        $this->db->group_by(array('t.id')); // add group_by
        $this->db->order_by('t.id', "desc");
        $this->db->limit($limit, $start);
        $this->db->query("SET sql_mode = '' ");
        $query = $this->db->get();
        //query(1);
        $result_array = $query->result_array();
        return $result_array;
    }
}
