<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_price_plan_model extends MY_Model
{
    protected $_table = TBL_TOUR_PRICE_PLAN;
	
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

	}

	public function delete_custom_record($id,$tour_date){
	    $this->db->where('tour_id', $id);
	    $this->db->where('tour_date',$tour_date);
	    $this->db->delete(TBL_TOUR_PRICE_PLAN);
	    return $this->db->affected_rows();
	}

	public function get_record_by($id,$tour_date){
	    $this->db->select('*');
			    $this->db->from(TBL_TOUR_PRICE_PLAN);
			    $this->db->where('tour_id', $id);
			    $this->db->where('tour_date',$tour_date);
			    $this->db->order_by('id','asc');
			 $query=   $this->db->get();
	    return $query->result_array();
	}

	public function get_rows($tour_id,$tour_date='',$price_type=''){
	    $this->db->select('*');
	    $this->db->from(TBL_TOUR_PRICE_PLAN);
	    $this->db->where('tour_id', $tour_id);
	    if($tour_date){
			$this->db->where('tour_date',$tour_date);
	    } 
	    if($price_type){
	    	$this->db->where('price_type',$price_type);
	    }
	    
	    $this->db->order_by('id','asc');
	 	$query=   $this->db->get();
	    return $query->result_array();
	}

	public function get_price_by($tour_id){
        //$start_date=date('Y-m-d');
		//$end_date=date('Y-m-d', strtotime('+1 Year'));
        $this->db->select('*');
	    $this->db->from(TBL_TOUR_PRICE_PLAN);
	    $this->db->where('tour_id', $tour_id);
	    //$this->db->where("DATE(tour_date) >= '0000-00-00'");
	    //$this->db->or_where('tour_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
	    $this->db->order_by('id','asc');

	   // $this->db->group_by('Date(tour_date)');
        //$this->db->query("select * from ".TBL_TOUR_PRICE_PLAN." as price WHERE price.tour_id = '".$tour_id."' GROUP BY DATE(price.tour_date) ORDER BY price.id ASC");
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_date_by($tour_id){
        
        $this->db->select('tour_date');
	    $this->db->from(TBL_TOUR_PRICE_PLAN);
	    $this->db->where('tour_id', $tour_id);
	    $this->db->group_by('Date(tour_date)');
	    $this->db->query("SET sql_mode = '' ");
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_price_by_date($tour_id,$tour_date){
        
        $this->db->select('*');
	    $this->db->from(TBL_TOUR_PRICE_PLAN);
	    $this->db->where('tour_id', $tour_id);
	    $this->db->where('tour_date', $tour_date);
	    $this->db->order_by('id','asc');
	   
        $query=$this->db->get();
        return $query->result_array();
    }


}
?>