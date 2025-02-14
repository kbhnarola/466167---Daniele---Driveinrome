<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends MY_Model
{
	protected $_table = TBL_BOOKING;
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->table=TBL_BOOKING;
		// Set orderable column fields
        $this->column_order = array(null,TBL_BOOKING.'.type',TBL_BOOKING.'.tour_or_transfer_name',TBL_USERS.'.name',TBL_USERS.'.email',TBL_USERS.'.phone_number',TBL_BOOKING.'.service_booked_date',null);
        // Set searchable column fields
        $this->column_search = array(TBL_USERS.'.name',TBL_USERS.'.email',TBL_USERS.'.subscribe',TBL_USERS.'.phone_number',TBL_BOOKING.'.tour_or_transfer_name',TBL_BOOKING.'.type');
        // Set default order
        $this->order = array(TBL_BOOKING.'.created_at' => 'desc');

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
         
        $this->db->select(TBL_BOOKING.'.*, '.TBL_USERS.'.name,'.TBL_USERS.'.email,'.TBL_USERS.'.phone_number,'.TBL_USERS.'.subscribe');
        $this->db->from($this->table);
        $this->db->join(TBL_USERS, TBL_USERS.'.id = '. TBL_BOOKING.'.user_id');
        if($postData['is_date_search'] == 'yes'){
            $this->db->where('service_booked_date >=', $postData["start_date"]);
            $this->db->where('service_booked_date <=', $postData["end_date"]);
        }

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
?>