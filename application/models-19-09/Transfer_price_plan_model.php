<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_price_plan_model extends MY_Model
{
    protected $_table = TBL_TRANSFER_PRICE_PLAN;
	
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

	}

	public function delete_custom_record($id,$transfer_date){
	    $this->db->where('transfer_id', $id);
	    $this->db->where('transfer_date',$transfer_date);
	    $this->db->delete(TBL_TRANSFER_PRICE_PLAN);
	    return $this->db->affected_rows();
	}

	public function get_record_by($id,$transfer_date){
	    $this->db->select('*');
			    $this->db->from(TBL_TRANSFER_PRICE_PLAN);
			    $this->db->where('transfer_id', $id);
			    $this->db->where('transfer_date',$transfer_date);
			    $this->db->order_by('id','asc');
			 $query=   $this->db->get();
	    return $query->result_array();
	}

	public function get_rows($transfer_id,$transfer_date='',$price_type=''){
	    $this->db->select('*');
	    $this->db->from(TBL_TRANSFER_PRICE_PLAN);
	    $this->db->where('transfer_id', $transfer_id);
	    if($transfer_date){
			$this->db->where('transfer_date',$transfer_date);
	    } 
	    if($price_type){
	    	$this->db->where('price_type',$price_type);
	    }
	    
	    $this->db->order_by('id','asc');
	 	$query=   $this->db->get();
	    return $query->result_array();
	}

}
?>