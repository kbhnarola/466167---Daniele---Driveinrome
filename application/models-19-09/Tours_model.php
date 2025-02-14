<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tours_model extends MY_Model
{
    protected $_table = TBL_TOUR;
    /**
     * Constructor for the class
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = TBL_TOUR;
        // Set orderable column fields
        $this->column_order = array(null, TBL_TOUR_TYPE . '.title', TBL_TOUR_CATEGORY . '.title', TBL_TOUR . '.title', TBL_TOUR . '.unique_code', TBL_TOUR . '.duration', TBL_TOUR . '.rating', TBL_TOUR . '.created_at', TBL_TOUR . '.updated_at', null);
        // Set searchable column fields
        $this->column_search = array(TBL_TOUR_TYPE . '.title', TBL_TOUR_CATEGORY . '.title', TBL_TOUR . '.title', TBL_TOUR . '.slug', TBL_TOUR . '.unique_code', TBL_TOUR . '.duration', TBL_TOUR . '.rating');
        // Set default order
        $this->order = array(TBL_TOUR . '.created_at' => 'desc');
    }

    public function getRows($postData)
    {

        $this->_get_datatables_query($postData, $type = "tour");
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->where(TBL_TOUR_TYPE . '.type', $type);
        $query = $this->db->get();

        return $query->result();
    }

    public function countFiltered($postData, $type = "tour")
    {
        $this->_get_datatables_query($postData);
        $this->db->where(TBL_TOUR_TYPE . '.type', $type);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData)
    {

        $this->db->select(TBL_TOUR_TYPE . '.title as tour_type,' . TBL_TOUR_CATEGORY . '.title as tour_category,' . TBL_TOUR . '.*');
        $this->db->from($this->table);
        $this->db->join(TBL_TOUR_TYPE, TBL_TOUR_TYPE . '.id = ' . TBL_TOUR . '.tour_type_id');
        $this->db->join(TBL_TOUR_CATEGORY, TBL_TOUR_CATEGORY . '.id = ' . TBL_TOUR . '.tour_category_id');

        $i = 0;
        // loop searchable columns 
        foreach ($this->column_search as $item) {
            // if datatable send POST for search
            if ($postData['search']['value']) {
                // first loop
                if ($i === 0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }

                // last loop
                if (count($this->column_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData['order'])) {
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    public function getToursPriceDetails($tour_id)
    {

        $this->db->select(TBL_TOUR_VARIATION . ".id as variation_id," . TBL_TOUR_VARIATION . '.title as variation_title,' . TBL_TOUR_PRICE_PLAN . '.price,' . TBL_TOUR_PRICE_PLAN . '.tour_date,' . TBL_TOUR_PRICE_PLAN . '.price_type');
        $this->db->from(TBL_TOUR_PRICE_PLAN);
        $this->db->join(TBL_TOUR_VARIATION, TBL_TOUR_PRICE_PLAN . ".variation_id=" . TBL_TOUR_VARIATION . ".id");
        $this->db->where(TBL_TOUR_PRICE_PLAN . '.tour_id', $tour_id);
        //$this->db->where(TBL_TOUR_PRICE_PLAN.'.price_type',2);
        $this->db->order_by(TBL_TOUR_PRICE_PLAN . ".id", "asc");
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getPriceRows($postData)
    {

        $this->_get_datatables_priceQuery($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->query("SET sql_mode = '' ");
        $query = $this->db->get();

        return $query->result();
    }

    public function countPriceFiltered($postData)
    {
        $this->_get_datatables_priceQuery($postData);
        $this->db->query("SET sql_mode = '' ");
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_priceQuery($postData)
    {

        $this->db->select(TBL_TOUR_PRICE_PLAN . '.tour_date,GROUP_CONCAT(' . TBL_TOUR_PRICE_PLAN . '.price SEPARATOR ",") as tour_price,GROUP_CONCAT(' . TBL_TOUR_PRICE_PLAN . '.variation_id SEPARATOR ",") as tour_variantion,GROUP_CONCAT(' . TBL_TOUR_VARIATION . '.title SEPARATOR ",") as variation_title,' . TBL_TOUR_PRICE_PLAN . '.tour_availability');
        $this->db->from(TBL_TOUR_PRICE_PLAN);
        $this->db->join(TBL_TOUR_VARIATION, TBL_TOUR_VARIATION . '.id = ' . TBL_TOUR_PRICE_PLAN . '.variation_id');
        $this->db->where(TBL_TOUR_PRICE_PLAN . '.tour_id', base64_decode($postData['tour_id']));
        $this->db->where(TBL_TOUR_PRICE_PLAN . '.price_type', 2);
        $this->db->group_by(TBL_TOUR_PRICE_PLAN . '.tour_date');
        //$this->db->order_by(TBL_TOUR_PRICE_PLAN.'.id','asc');

        $i = 0;
        $column_order = array(TBL_TOUR_PRICE_PLAN . '.id');
        // Set searchable column fields
        $column_search = array(TBL_TOUR_PRICE_PLAN . '.tour_date');
        // Set default order
        $order = array(TBL_TOUR_PRICE_PLAN . '.id' => 'asc');
        // loop searchable columns 
        foreach ($column_search as $item) {
            // if datatable send POST for search
            if ($postData['search']['value']) {
                // first loop
                if ($i === 0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }

                // last loop
                if (count($column_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData['order'])) {
            $this->db->order_by($column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_tour_details($tour_slug)
    {
        //$this->db->select('tour.*,city.title as city,tour_type.title as tour_type,GROUP_CONCAT(price.price ORDER BY price.id ASC SEPARATOR ",") as tour_price,GROUP_CONCAT(variation.title ORDER BY variation.id ASC SEPARATOR ",") as variation_title');
        //$this->db->select('tour.*,city.title as city,city.slug as city_slug,tour_type.title as tour_type,price.price as tour_price');
        $this->db->select('tour.*,city.title as city,city.slug as city_slug,tour_type.title as tour_type,GROUP_CONCAT(price.price ORDER BY price.id ASC SEPARATOR ",") as tour_price');
        $this->db->from(TBL_TOUR . ' as tour');
        $this->db->join(TBL_TOUR_CATEGORY . ' as city', 'tour.tour_category_id=city.id');
        $this->db->join(TBL_TOUR_TYPE . ' as tour_type', 'tour.tour_type_id=tour_type.id');
        $this->db->join(TBL_TOUR_PRICE_PLAN . ' as price', 'tour.id=price.tour_id');
        $this->db->join(TBL_TOUR_VARIATION . ' as variation', 'variation.id=price.variation_id');
        $this->db->where('tour.slug', $tour_slug);
        $this->db->where('tour.status', 1);
        $this->db->where('price.price_type', 1);
        $this->db->order_by('price.id', 'asc');
        $this->db->query("SET sql_mode = '' ");
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_tour_details_reqQuote($tour_id)
    {

        $this->db->select('tour.title,tour.id,tour.banner_image,tour.feature_image,tour.tour_type_id,tour.slug as tour_slug,tour.tour_email_description, tour.active_campaign_automation_id, city.title as city,city.slug as city_slug');
        $this->db->from(TBL_TOUR . ' as tour');
        $this->db->join(TBL_TOUR_CATEGORY . ' as city', 'tour.tour_category_id=city.id');
        $this->db->where('tour.id', $tour_id);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_tour_details_byId($tour_id)
    {

        $this->db->select('tour.title,tour.id as tour_id,tour.unique_code,tour.duration,tour.slug as tour_slug,tour.banner_image,tour.feature_image,tour.tour_type_id,tour_type.title as tour_type,tour.extra_services_id,city.title as city,city.slug as city_slug');
        $this->db->from(TBL_TOUR . ' as tour');
        $this->db->join(TBL_TOUR_CATEGORY . ' as city', 'tour.tour_category_id=city.id');
        $this->db->join(TBL_TOUR_TYPE . ' as tour_type', 'tour.tour_type_id=tour_type.id');
        $this->db->where('tour.id', $tour_id);

        $query = $this->db->get();
        return $query->row_array();
    }

    function get_tour_list_by_city_slug($city_slug = 1, $tour_type_array = '', $is_city_tours = '', $is_transfer_tours = false)
    {
        $result_array = array();
        $this->db->select('t.id as tour_id, t.title as tour_title, t.tour_category_id, t.tour_type_id, t.duration, t.rating, t.feature_image, t.top_selling_tour , t.status, t.unique_code, t.slug as tour_slug, t.meta_title, t.is_city_tour, tc.id as as_tour_category_id, tc.title as tour_category_title, tc.slug as tour_category_slug, tc.feature_image as tour_feature_image,  tt.title as tour_type_title, tt.id as tour_type_table_id');

        $this->db->from(TBL_TOUR . ' t');
        $this->db->join(TBL_TOUR_CATEGORY . ' tc', 'tc.id  = t.tour_category_id ', 'left');
        $this->db->join(TBL_TOUR_TYPE . ' tt', 'tt.id  = t.tour_type_id ', 'left');
        $where_tour_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 'tc.slug' => $city_slug);
        if ($is_city_tours)
            $where_tour_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 'tc.slug' => $city_slug, 't.is_city_tour' => 1);

        $this->db->where($where_tour_data);
        $this->db->where_in('tt.id', $tour_type_array);
        if (!$is_transfer_tours)
            $this->db->or_where('`t`.`id` IN (SELECT `t`.`id` FROM `' . TBL_TOUR . '` WHERE `tt`.`id`=7 AND `t`.`is_city_tour` = 1 AND `tc`.`slug` = "' . $city_slug . '")', NULL, FALSE);

        $this->db->group_by(array('t.id')); // add group_by
        $this->db->order_by('t.title', "asc");
        $this->db->query("SET sql_mode = '' ");
        $query = $this->db->get();
        // query(1);
        $result_array = $query->result_array();
        return $result_array;
    }

    function get_meta_description($table = '', $slug = '')
    {
        if (empty($table) && empty($slug)) {
            return false;
        }
        $result_array = array();
        $this->db->select();
        $this->db->from($table);
        $this->db->where(array('slug' => $slug));
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }
}
