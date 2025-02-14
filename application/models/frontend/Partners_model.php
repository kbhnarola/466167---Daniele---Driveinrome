<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partners_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function get_search_shared_tour($filter_array = array(), $is_get_total_record = 0)
    {
        $result_array = array();

        $page_no = isset($filter_array['page_no']) ? $filter_array['page_no'] : '';
        $row_per_page = isset($filter_array['row_per_page']) ? $filter_array['row_per_page'] : '';
        $order_by = isset($filter_array['order_by']) ? $filter_array['order_by'] : 'asc';

        $city_id = isset($filter_array['city_id']) ? $filter_array['city_id'] : '';
        $tour_id = isset($filter_array['tour_id']) ? $filter_array['tour_id'] : '';
        $date = isset($filter_array['date']) ? $filter_array['date'] : '';

        if ($is_get_total_record == 1) {
            $this->db->select('count(tl.id) as all_count');
        } else {
            $this->db->select('tl.*, tc.name as shared_tour_city_name, tc.city_image, tv.name as shared_tour_variable_name');
        }
        $this->db->from(TBL_SHARED_TOUR_LIST . ' tl');
        $this->db->join(TBL_SHARED_TOUR_CITY . ' tc', 'tc.id  = tl.shared_tour_city_id ', 'left');
        $this->db->join(TBL_SHARED_TOUR_VARIABLE . ' tv', 'tv.id  = tl.shared_tour_variable_id ', 'left');
        if ($city_id != '') {
            $this->db->where(array('tl.shared_tour_city_id' => $city_id));
        }
        if ($tour_id != '') {
            $this->db->where(array('tl.shared_tour_variable_id' => $tour_id));
        }
        if ($date != '') {
            $this->db->where(array('tl.tour_date' => $date));
        }
        $this->db->where(array('tl.tour_date >=' => date('Y-m-d')));
        $this->db->order_by("tl.tour_date", 'asc');
        if ($is_get_total_record == 0) {
            $this->db->limit($row_per_page, $page_no);
        }
        //group by id
        if ($is_get_total_record == 0) {
            $this->db->group_by('tl.id');
        }

        // if ($filter_array) {
        //     $this->db->limit($limit);
        // } else {
        //     $this->db->limit(20);
        // }
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    public function get_shared_tour_variable($where = '')
    {
        $this->db->select('id, name');
        $this->db->from(TBL_SHARED_TOUR_VARIABLE);
        if ($where)
            $this->db->where($where);

        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }
}
