<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfers_model extends CI_Model{
    function __construct() {
            parent::__construct();
    }
    function get_transfer($table = '', $where = '', $single = FALSE){
        if($single == TRUE) {
            $method = 'row';
        }
        else if($single == FALSE){
            $method = 'result_array';
        }
        $order = (empty($order)) ? 'desc' : 'asc';
        $this->db->where($where);
        $q = $this->db->get($table)->$method();
        if(count((array)$q) > 0)
        {
            return $q;
        }
        return array();
    }         
}