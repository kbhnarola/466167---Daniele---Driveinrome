<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_variation_model extends MY_Model
{
    protected $_table = TBL_TRANSFER_VARIATION;
	
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

	}

	public function get_variation_by($transfer_type_id){
	    	$this->db->select('*');
		    $this->db->from(TBL_TRANSFER_VARIATION);
		    $this->db->where('transfer_type_id', $transfer_type_id);
		    $this->db->order_by('id','asc');
		 $query=   $this->db->get();
	    return $query->result_array();
	}

}
?>