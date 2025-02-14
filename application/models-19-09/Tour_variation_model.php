<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_variation_model extends MY_Model
{
    protected $_table = TBL_TOUR_VARIATION;
	
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

	}

	public function get_variation_by($tour_type_id){
	    	$this->db->select('*');
		    $this->db->from(TBL_TOUR_VARIATION);
		    $this->db->where('tour_type_id', $tour_type_id);
		    $this->db->order_by('id','asc');
		 $query=   $this->db->get();
	    return $query->result_array();
	}

}
?>