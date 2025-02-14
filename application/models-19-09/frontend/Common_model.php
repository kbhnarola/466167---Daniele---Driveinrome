<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }    
    
    public function add($table, $data, $bulk_insert = FALSE){
        if($bulk_insert == TRUE){
            $this->db->insert_batch($table, $data);
        }else{
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }

    public function get_all($table = '', $order_by = '', $single = FALSE, $order = '')
    {
        if($single == TRUE) {
            $method = 'row';
        }
        else if($single == FALSE){
            $method = 'result_array';
        }
//        $where = array('is_delete' => '0');
//        $this->db->where($where); 
        $order = (empty($order)) ? 'desc' : 'asc';
        $this->db->order_by($order_by, $order);
        $q = $this->db->get($table)->$method();
        // echo "Query : ".$this->db->last_query();
        if(count((array)$q) > 0)
        {
            return $q;
        }        
        
        return array();
    }
    public function get_by($table = '', $where, $single = FALSE, $order_by = '', $order = ''){
        $this->db->where($where);        
        return $this->get_all($table, $order_by, $single, $order);
    }
        
    public function update($table, $data, $where){
        $this->db->where($where);
        $this->db->update($table, $data);
//        pr($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    public function delete($table, $data, $where){
        $this->db->where($where);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }
    public function force_delete($table, $where){
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
}