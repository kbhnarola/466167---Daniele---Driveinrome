<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tours_model extends MY_Model
{
	protected $_table = TBL_TOUR;
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->table=TBL_TOUR;
		// Set orderable column fields
        $this->column_order = array(null,TBL_TOUR_TYPE.'.title',TBL_TOUR_CATEGORY.'.title',TBL_TOUR.'.title',TBL_TOUR.'.unique_code',TBL_TOUR.'.duration',TBL_TOUR.'.rating',TBL_TOUR.'.created_at',TBL_TOUR.'.updated_at',null);
        // Set searchable column fields
        $this->column_search = array(TBL_TOUR_TYPE.'.title',TBL_TOUR_CATEGORY.'.title',TBL_TOUR.'.title',TBL_TOUR.'.unique_code',TBL_TOUR.'.duration',TBL_TOUR.'.rating');
        // Set default order
        $this->order = array(TBL_TOUR.'.created_at' => 'desc');

	}

    public function getRows($postData){

        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
    
        return $query->result();
    }

    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){
         
        $this->db->select(TBL_TOUR_TYPE.'.title as tour_type,'.TBL_TOUR_CATEGORY.'.title as tour_category,'.TBL_TOUR.'.*');
        $this->db->from($this->table);
        $this->db->join(TBL_TOUR_TYPE, TBL_TOUR_TYPE.'.id = '. TBL_TOUR.'.tour_type_id');
        $this->db->join(TBL_TOUR_CATEGORY, TBL_TOUR_CATEGORY.'.id = '. TBL_TOUR.'.tour_category_id');

        $i = 0;        
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }                
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    public function getToursPriceDetails($tour_id){

        $this->db->select(TBL_TOUR_VARIATION.".id as variation_id,".TBL_TOUR_VARIATION.'.title as variation_title,'.TBL_TOUR_PRICE_PLAN.'.price,'.TBL_TOUR_PRICE_PLAN.'.tour_date,'.TBL_TOUR_PRICE_PLAN.'.price_type');
        $this->db->from(TBL_TOUR_PRICE_PLAN);
        $this->db->join(TBL_TOUR_VARIATION,TBL_TOUR_PRICE_PLAN.".variation_id=".TBL_TOUR_VARIATION.".id");
        $this->db->where(TBL_TOUR_PRICE_PLAN.'.tour_id',$tour_id);
        //$this->db->where(TBL_TOUR_PRICE_PLAN.'.price_type',2);
        $this->db->order_by(TBL_TOUR_PRICE_PLAN.".id", "asc");
        $query = $this->db->get();
    
        return $query->result_array();

    }

    public function getPriceRows($postData){

        $this->_get_datatables_priceQuery($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->query("SET sql_mode = '' ");
        // $this->db->query('SET SESSION sql_mode =
        //           REPLACE(REPLACE(REPLACE(
        //           @@sql_mode,
        //           "ONLY_FULL_GROUP_BY,", ""),
        //           ",ONLY_FULL_GROUP_BY", ""),
        //           "ONLY_FULL_GROUP_BY", "")');
        $query = $this->db->get();
    
        return $query->result();
    }

    public function countPriceFiltered($postData){
        $this->_get_datatables_priceQuery($postData);
        $this->db->query("SET sql_mode = '' ");
        // $this->db->query('SET SESSION sql_mode =
        //           REPLACE(REPLACE(REPLACE(
        //           @@sql_mode,
        //           "ONLY_FULL_GROUP_BY,", ""),
        //           ",ONLY_FULL_GROUP_BY", ""),
        //           "ONLY_FULL_GROUP_BY", "")');
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_priceQuery($postData){
         
        // $this->db->select(TBL_TOUR_VARIATION.'.title as variation,'.TBL_TOUR_PRICE_PLAN.'.*');
        // $this->db->from(TBL_TOUR_PRICE_PLAN);
        // $this->db->join(TBL_TOUR_VARIATION, TBL_TOUR_VARIATION.'.id = '. TBL_TOUR_PRICE_PLAN.'.variation_id');
        // $this->db->where(TBL_TOUR_PRICE_PLAN.'.tour_id',base64_decode($postData['tour_id']));
        // $this->db->where(TBL_TOUR_PRICE_PLAN.'.price_type',2);
        //$this->db->group_by(TBL_TOUR_PRICE_PLAN.'.tour_date');
        $this->db->select(TBL_TOUR_PRICE_PLAN.'.tour_date,GROUP_CONCAT('.TBL_TOUR_PRICE_PLAN.'.price SEPARATOR ",") as tour_price,GROUP_CONCAT('.TBL_TOUR_PRICE_PLAN.'.variation_id SEPARATOR ",") as tour_variantion,GROUP_CONCAT('.TBL_TOUR_VARIATION.'.title SEPARATOR ",") as variation_title,'.TBL_TOUR_PRICE_PLAN.'.tour_availability');
        $this->db->from(TBL_TOUR_PRICE_PLAN);
        $this->db->join(TBL_TOUR_VARIATION, TBL_TOUR_VARIATION.'.id = '. TBL_TOUR_PRICE_PLAN.'.variation_id');
        $this->db->where(TBL_TOUR_PRICE_PLAN.'.tour_id',base64_decode($postData['tour_id']));
        $this->db->where(TBL_TOUR_PRICE_PLAN.'.price_type',2);
        $this->db->group_by(TBL_TOUR_PRICE_PLAN.'.tour_date');
        //$this->db->order_by(TBL_TOUR_PRICE_PLAN.'.id','asc');

        $i = 0;       
        $column_order = array(TBL_TOUR_PRICE_PLAN.'.id');
        // Set searchable column fields
        $column_search = array(TBL_TOUR_PRICE_PLAN.'.tour_date');
        // Set default order
        $order = array(TBL_TOUR_PRICE_PLAN.'.id' => 'asc'); 
        // loop searchable columns 
        foreach($column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }                
         
        if(isset($postData['order'])){
            $this->db->order_by($column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($order)){
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}
?>