<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends MY_Model
{
		
	/**
	 * @var string
	 */
	protected $_table = TBL_EMAIL_TEMPLATES;
	
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->table=TBL_EMAIL_TEMPLATES;
		// Set orderable column fields
        $this->column_order = array(null,'name',null);
        // Set searchable column fields
        $this->column_search = array('name');
        // Set default order
        $this->order = array('id' => 'desc');

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
         
        //$this->db->select(TBL_TOUR_TYPE.'.title as tour_type_name,'.TBL_TOUR_CATEGORY.'.*');
        $this->db->from($this->table);
        //$this->db->join(TBL_TOUR_TYPE, TBL_TOUR_TYPE.'.id = '. TBL_TOUR_CATEGORY.'.tour_type_id');

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
}
