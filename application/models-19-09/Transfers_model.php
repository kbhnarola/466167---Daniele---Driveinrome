<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfers_model extends MY_Model
{
	protected $_table = TBL_TRANSFER;
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->table=TBL_TRANSFER;
		// Set orderable column fields
        $this->column_order = array(null,TBL_TRANSFER_TYPE.'.title',TBL_TRANSFER_CATEGORY.'.title',TBL_TRANSFER.'.title',TBL_TRANSFER.'.unique_code',TBL_TRANSFER.'.duration',TBL_TRANSFER.'.ratings',TBL_TRANSFER.'.created_at',TBL_TRANSFER.'.updated_at',null);
        // Set searchable column fields
        $this->column_search = array(TBL_TRANSFER_TYPE.'.title',TBL_TRANSFER_CATEGORY.'.title',TBL_TRANSFER.'.title',TBL_TRANSFER.'.unique_code',TBL_TRANSFER.'.duration',TBL_TRANSFER.'.ratings');
        // Set default order
        $this->order = array(TBL_TRANSFER.'.created_at' => 'desc');

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
         
        $this->db->select(TBL_TRANSFER_TYPE.'.title as transfer_type,'.TBL_TRANSFER_CATEGORY.'.title as transfer_category,'.TBL_TRANSFER.'.*');
        $this->db->from($this->table);
        $this->db->join(TBL_TRANSFER_TYPE, TBL_TRANSFER_TYPE.'.id = '. TBL_TRANSFER.'.transfer_type_id');
        $this->db->join(TBL_TRANSFER_CATEGORY, TBL_TRANSFER_CATEGORY.'.id = '. TBL_TRANSFER.'.transfer_category_id');

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


    public function getTransfersPriceDetails($transfer_id){

        $this->db->select(TBL_TRANSFER_VARIATION.".id as variation_id,".TBL_TRANSFER_VARIATION.'.title as variation_title,'.TBL_TRANSFER_PRICE_PLAN.'.price,'.TBL_TRANSFER_PRICE_PLAN.'.transfer_service_date,'.TBL_TRANSFER_PRICE_PLAN.'.price_type');
        $this->db->from(TBL_TRANSFER_PRICE_PLAN);
        $this->db->join(TBL_TRANSFER_VARIATION,TBL_TRANSFER_PRICE_PLAN.".transfer_variation_id=".TBL_TRANSFER_VARIATION.".id");
        $this->db->where(TBL_TRANSFER_PRICE_PLAN.'.transfer_id',$transfer_id);
        //$this->db->where(TBL_TRANSFER_PRICE_PLAN.'.price_type',2);
        $this->db->order_by(TBL_TRANSFER_PRICE_PLAN.".id", "asc");
        $query = $this->db->get();
    
        return $query->result_array();

    }

    public function getPriceRows($postData){

        $this->_get_datatables_priceQuery($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->query("SET sql_mode = '' ");
        $query = $this->db->get();
    
        return $query->result();
    }

    public function countPriceFiltered($postData){
        $this->_get_datatables_priceQuery($postData);
        $this->db->query("SET sql_mode = '' ");
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_priceQuery($postData){
         
        $this->db->select(TBL_TRANSFER_PRICE_PLAN.'.transfer_service_date,GROUP_CONCAT('.TBL_TRANSFER_PRICE_PLAN.'.price SEPARATOR ",") as transfer_price,GROUP_CONCAT('.TBL_TRANSFER_PRICE_PLAN.'.variation_id SEPARATOR ",") as transfer_variantion,GROUP_CONCAT('.TBL_TRANSFER_VARIATION.'.title SEPARATOR ",") as variation_title');
        $this->db->from(TBL_TRANSFER_PRICE_PLAN);
        $this->db->join(TBL_TRANSFER_VARIATION, TBL_TRANSFER_VARIATION.'.id = '. TBL_TRANSFER_PRICE_PLAN.'.variation_id');
        $this->db->where(TBL_TRANSFER_PRICE_PLAN.'.transfer_id',base64_decode($postData['transfer_id']));
        $this->db->where(TBL_TRANSFER_PRICE_PLAN.'.price_type',2);
        $this->db->group_by(TBL_TRANSFER_PRICE_PLAN.'.transfer_service_date');
        //$this->db->order_by(TBL_TRANSFER_PRICE_PLAN.'.id','asc');

        $i = 0;       
        $column_order = array(TBL_TRANSFER_PRICE_PLAN.'.id');
        // Set searchable column fields
        $column_search = array(TBL_TRANSFER_PRICE_PLAN.'.transfer_service_date');
        // Set default order
        $order = array(TBL_TRANSFER_PRICE_PLAN.'.id' => 'asc'); 
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