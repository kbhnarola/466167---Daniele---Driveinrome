<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summary_model extends CI_Model{
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
//        $where = array('is_delete' => '0');
//        $this->db->where($where); 
        $order = (empty($order)) ? 'desc' : 'asc';
        $this->db->where($where);
        $q = $this->db->get($table)->$method();
        if(count((array)$q) > 0)
        {
            return $q;
        }
        return array();
    }  
    // function get_single_transfers_all_details_by_id($transfer_id = 0, $transfer_type_array = ''){
    //     $this->db->select('transfer.*,city.title as city,transfer_type.title as transfer_type,GROUP_CONCAT(price.price ORDER BY price.id ASC SEPARATOR ",") as tour_price,GROUP_CONCAT(variation.title ORDER BY variation.id ASC SEPARATOR ",") as variation_title');
    //     $this->db->from(TBL_TRANSFER.' as transfer');
    //     $this->db->join(TBL_TRANSFER_CATEGORY.' as city','transfer.transfer_category_id=city.id');
    //     $this->db->join(TBL_TRANSFER_TYPE.' as transfer_type','transfer.transfer_type_id=transfer_type.id');
    //     $this->db->join(TBL_TRANSFER_PRICE_PLAN.' as price','transfer.id=price.transfer_id');
    //     $this->db->join(TBL_TRANSFER_VARIATION.' as variation','variation.id=price.transfer_variation_id');
    //     $this->db->where(array('transfer.id' => $transfer_id, 'price.price_type'=> 1));
    //     $this->db->where_in('transfer_type.id', $transfer_type_array);
    //     $query=$this->db->get();
    //     return $query->row_array();
    // }  
}