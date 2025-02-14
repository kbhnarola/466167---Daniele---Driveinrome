<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model
{
	protected $_table = TBL_USERS;
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->table=TBL_USERS;
		// Set orderable column fields
        $this->column_order = array(null,TBL_USERS.'.name',TBL_USERS.'.email',TBL_USERS.'.phone_number',TBL_TAG.'.name',TBL_USERS.'.notes',TBL_USERS.'.subscribe',TBL_USERS.'.created_at',null);
        // Set searchable column fields
        $this->column_search = array(TBL_USERS.'.name',TBL_USERS.'.email',TBL_USERS.'.phone_number',TBL_USERS.'.subscribe',TBL_TAG.'.name',TBL_USERS.'.notes',TBL_USERS.'.created_at');
        // Set default order
        $this->order = array(TBL_USERS.'.created_at' => 'desc');

	}

    public function getRows($postData){

        $this->_get_datatables_query($postData);
        if ($postData['columns'][4]['search']['value'] != '') {
            $this->db->like(TBL_TAG.'.name', $postData['columns'][4]['search']['value']);
        }
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }        
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }

    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        if ($postData['columns'][4]['search']['value'] != '') {
            $this->db->like(TBL_TAG.'.name', $postData['columns'][4]['search']['value']);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){
         
        // $this->db->select(TBL_USERS.'.*');
        //$this->db->select(TBL_USERS.'.*, '.TBL_TAG.'.name as tag_name');
        $this->db->select(TBL_USERS.'.id,'.TBL_USERS.'.name,'.TBL_USERS.'.email,'.TBL_USERS.'.phone_number,'.TBL_USERS.'.subscribe,'.TBL_USERS.'.notes,'.TBL_USERS.'.created_at,'.TBL_TAG.'.name as tag_name');
        $this->db->from($this->table);
        // $this->db->select(TBL_TOUR_TYPE.'.title as tour_type,'.TBL_TOUR_CATEGORY.'.title as tour_category,'.TBL_TOUR.'.*');
        // $this->db->from($this->table);
        $this->db->join(TBL_TAG, TBL_TAG.'.id = '. TBL_USERS.'.tag_id','left');
        if(is_array($postData['tag_name']) && sizeof($postData['tag_name'])>0) {
            $c=1;
            $this->db->group_start();
            foreach ($postData['tag_name'] as $key => $value) {
                if($c==1) {
                    $this->db->like(TBL_TAG.'.name', $value);
                } else {
                    $this->db->or_like(TBL_TAG.'.name', $value);
                }
                $c++;
            }
            $this->db->group_end();
        }
        $i = 0;        
        // loop searchable columns 
        // $this->columns[4][search][value]
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
                if ($postData['columns'][4]['search']['value'] != '') {
                    $this->db->like(TBL_TAG.'.name', $postData['columns'][4]['search']['value']);
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
    public function update_user($user_id, $postData, $subscribe_user = ''){    
        $this->db->where('id', $user_id);
        if(!empty($subscribe_user)){
            $this->db->where('subscribe', $subscribe_user);
        }
        $this->db->update(TBL_USERS, $postData);
        if ($this->db->affected_rows() == '1')
            return true;
        else
            return false;
    }
    public function get_users($where_users, $select = ''){         
        if(!empty($select)){
            $this->db->select($select);   
        }else{
            $this->db->select(TBL_USERS.'.id,'.TBL_USERS.'.name,'.TBL_USERS.'.email,'.TBL_USERS.'.subscribe_email_content');   
        }        
        $this->db->from($this->table); 
        if(!empty($where_users))
            $this->db->where($where_users);

        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }
    public function get_users_with_tag(){
        $result_array = array();
        $this->db->select('users.*, tag.name as tag_name');
        $this->db->from(TBL_USERS.' as users');
        $this->db->join(TBL_TAG.' as tag','tag.id=users.tag_id');
        $this->db->query("SET sql_mode = '' ");
        $query=$this->db->get();
        $result_array = $query->result_object();
        return $result_array;
    }
    public function get_tag_of_users(){
        $result_array = array();
        $this->db->select('users.id,tag.id as tag_id,tag.name as tag_name');
        $this->db->from(TBL_TAG.' as tag');
        $this->db->join(TBL_USERS.' as users','users.tag_id=tag.id');
        $this->db->query("SET sql_mode = '' ");
        $this->db->group_by('tag.id'); 
        $this->db->order_by('tag.id', 'asc');
        $query=$this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }
    public function get_tag($where_tag){
        $this->db->select();       
        $this->db->from(TBL_TAG); 
        if(!empty($where_tag))
            $this->db->where($where_tag);

        $query = $this->db->get();
        $row = $query->row_array();
        return $row;
    }
    public function insert_tag($tag_data){                         
        $this->db->insert(TBL_TAG, $tag_data);
        return $this->db->insert_id();
    }
    public function insert_user($user_data){                         
        if($this->db->insert(TBL_USERS, $user_data)){
            return TRUE;
        }else{
            return TRUE;
        }
    }
    public function delete_user($user_data, $multiple = ''){         
        if($multiple){
            $this->db->where_in('id', $user_data);
        }else{
            $this->db->where($user_data);                        
        }
        $delete = $this->db->delete(TBL_USERS);
        return $delete?true:false;
    }
    public function insert_newsletter_content($newsletter_data){                         
        $this->db->insert(TBL_NEWSLETTER, $newsletter_data);        
    }

    public function get_users_by($tag_id=array()) {

        $this->db->select('id,name,email,phone_number');
        $this->db->from(TBL_USERS);
        $this->db->where('subscribe',1);   
        $this->db->where_in('tag_id', $tag_id);
        $query=$this->db->get();
        $result_array = $query->result_array();
        return $result_array;

    }
}
?>