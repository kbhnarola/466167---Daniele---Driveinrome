<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tour_categories_model extends MY_Model
{
    protected $_table = TBL_TOUR_CATEGORY;
    /**
     * Constructor for the class
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = TBL_TOUR_CATEGORY;
        // Set orderable column fields
        $this->column_order = array(null, 'title', 'created_at', 'updated_at', null);
        // Set searchable column fields
        $this->column_search = array('title');
        // Set default order
        $this->order = array('created_at' => 'desc');
    }

    public function getRows($postData)
    {

        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();

        return $query->result();
    }

    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData)
    {

        //$this->db->select(TBL_TOUR_TYPE.'.title as tour_type_name,'.TBL_TOUR_CATEGORY.'.*');
        $this->db->from($this->table);
        //$this->db->join(TBL_TOUR_TYPE, TBL_TOUR_TYPE.'.id = '. TBL_TOUR_CATEGORY.'.tour_type_id');

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

    public function get_by_tourCategory()
    {

        $this->db->select(TBL_TOUR_CATEGORY . '.*');
        $this->db->from(TBL_TOUR_CATEGORY);
        $this->db->join(TBL_TOUR, TBL_TOUR . ".tour_category_id=" . TBL_TOUR_CATEGORY . ".id");
        $this->db->where(TBL_TOUR_CATEGORY . '.status', 1);
        $this->db->group_by(TBL_TOUR_CATEGORY . '.id');
        //$this->db->order_by(TBL_TOUR_PRICE_PLAN.".id", "asc");
        $query = $this->db->get();

        return $query->result_array();
    }

    public function updateSharedTourCity($updateData = [], $where_city)
    {
        $this->db->where('name LIKE ', '%' . $where_city . '%');
        return $this->db->update(TBL_SHARED_TOUR_CITY, $updateData);
    }
}
