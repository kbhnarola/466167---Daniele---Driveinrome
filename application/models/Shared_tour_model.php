<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shared_tour_model extends MY_Model
{
    protected $_table = TBL_SHARED_TOUR_LIST;
    /**
     * Constructor for the class
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = TBL_SHARED_TOUR_LIST;
        // Set orderable column fields
        $this->column_order = array(null, TBL_SHARED_TOUR_LIST . '.passengers', TBL_SHARED_TOUR_LIST . '.agency', TBL_SHARED_TOUR_LIST . '.ship', TBL_SHARED_TOUR_LIST . '.pick_up_time', TBL_SHARED_TOUR_LIST . '.notes', TBL_SHARED_TOUR_LIST . '.tour_date', TBL_SHARED_TOUR_CITY . '.name', TBL_SHARED_TOUR_VARIABLE . '.name', TBL_SHARED_TOUR_CITY . '.name', TBL_SHARED_TOUR_LIST . '.id');
        // Set searchable column fields
        $this->column_search = array(TBL_SHARED_TOUR_LIST . '.passengers', TBL_SHARED_TOUR_LIST . '.agency', TBL_SHARED_TOUR_LIST . '.ship', TBL_SHARED_TOUR_LIST . '.pick_up_time', TBL_SHARED_TOUR_LIST . '.notes', TBL_SHARED_TOUR_LIST . '.tour_date', TBL_SHARED_TOUR_LIST . '.shared_tour_city_id', TBL_SHARED_TOUR_LIST . '.shared_tour_variable_id', TBL_SHARED_TOUR_CITY . '.name', TBL_SHARED_TOUR_VARIABLE . '.name');
        // Set default order
        $this->order = array(TBL_SHARED_TOUR_LIST . '.created_at' => 'desc');
    }

    public function getRows($postData)
    {

        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();
        // die;
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
        $this->db->select(TBL_SHARED_TOUR_LIST . '.*, ' . TBL_SHARED_TOUR_CITY . '.name as shared_tour_city_name, ' . TBL_SHARED_TOUR_VARIABLE . '.name  as shared_tour_variable_name');
        $this->db->from($this->table);

        $this->db->join(TBL_SHARED_TOUR_CITY, TBL_SHARED_TOUR_CITY . '.id = ' . TBL_SHARED_TOUR_LIST . '.shared_tour_city_id', 'left');
        $this->db->join(TBL_SHARED_TOUR_VARIABLE, TBL_SHARED_TOUR_VARIABLE . '.id = ' . TBL_SHARED_TOUR_LIST . '.shared_tour_variable_id', 'left');

        $i = 0;
        // loop searchable columns 
        // $this->columns[4][search][value]
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
        // echo 'Col : ' . $postData['order']['0']['dir'];
        // die;
        if (isset($postData['order'])) {
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function get_shared_tour_variable($where = '')
    {
        if (!$where)
            return false;

        $this->db->select('id, name');
        $this->db->from(TBL_SHARED_TOUR_VARIABLE);
        $this->db->where($where);
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }
    public function update_user($user_id, $postData, $subscribe_user = '')
    {
        $this->db->where('id', $user_id);
        if (!empty($subscribe_user)) {
            $this->db->where('subscribe', $subscribe_user);
        }
        $this->db->update(TBL_SHARED_TOUR_LIST, $postData);
        if ($this->db->affected_rows() == '1')
            return true;
        else
            return false;
    }
    public function delete_shared_tour_list($shared_tour_list_data)
    {
        if (!$shared_tour_list_data)
            return false;

        $this->db->where_in('id', $shared_tour_list_data);
        $delete = $this->db->delete(TBL_SHARED_TOUR_LIST);
        return $delete ? true : false;
    }
}
