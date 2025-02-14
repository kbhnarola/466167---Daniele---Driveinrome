<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs_model extends MY_Model
{
	protected $_table = TBL_BLOGS;
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->table=TBL_BLOGS;
		// Set orderable column fields
        $this->column_order = array(null,TBL_BLOGS.'.title',TBL_BLOG_CATEGORIES.'.name',TBL_BLOGS.'.status',TBL_BLOGS.'.created_at',null);
        // Set searchable column fields
        $this->column_search = array(TBL_BLOGS.'.title',TBL_BLOGS.'.status',TBL_BLOGS.'.created_at', TBL_BLOG_CATEGORIES.'.name');
        // Set default order
        $this->order = array(TBL_BLOGS.'.created_at' => 'desc');

	}

    public function getRows($postData){

        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }        
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }

    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){
         
        // $this->db->select(TBL_USERS.'.*');
        $this->db->select(TBL_BLOGS.'.*, '.TBL_BLOG_CATEGORIES.'.name as cat_name, GROUP_CONCAT('.TBL_BLOG_CATEGORIES.'.name ORDER BY '.TBL_BLOG_CATEGORIES.'.id SEPARATOR ",") as "categories"');
        $this->db->from($this->table);

        $this->db->join(TBL_BLOG_CATEGORIES, TBL_BLOG_CATEGORIES.'.id = SUBSTRING_INDEX(SUBSTRING_INDEX('.TBL_BLOGS.'.category_ids, ",", FIND_IN_SET('.TBL_BLOG_CATEGORIES.'.id, '.TBL_BLOGS.'.category_ids)), ",", -1)');

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
        $this->db->group_by(TBL_BLOGS.'.id');
        $this->db->where(array(TBL_BLOG_CATEGORIES.'.status' => 1));
    }
    public function get_blog_category($where = ''){
        $this->db->select();
        $this->db->from(TBL_BLOG_CATEGORIES);
        if(!empty($where))
            $this->db->where($where);
        else
            $this->db->where(array('status' => 1));
        
        $query = $this->db->get();
        return $query->result_array();        
    }
    public function insert_blog($data){
        if($this->db->insert(TBL_BLOGS, $data)){
            return $this->db->insert_id();
        }else{
            return FALSE;
        }
    }
    public function get_blog($where = ''){
        $this->db->select();
        $this->db->from(TBL_BLOGS);
        if(!empty($where))
            $this->db->where($where);
        else
            $this->db->where(array('status' => 1));
        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function delete_blog($data){
        if($this->db->delete(TBL_BLOGS, $data))
            return TRUE;
        else
            return FALSE;
    }
    public function update_blog($where, $data){
        $this->db->where($where);
        $this->db->update(TBL_BLOGS, $data);
        return true;
    }
    public function get_blogs_with_categories($where_id = ''){
        $method = 'result_array';
        $this->db->select(TBL_BLOGS.'.*, '.TBL_BLOGS.'.id as blog_id'.', GROUP_CONCAT('.TBL_BLOG_CATEGORIES.'.name ORDER BY '.TBL_BLOG_CATEGORIES.'.id SEPARATOR ",") as "categories", GROUP_CONCAT('.TBL_BLOG_CATEGORIES.'.id ORDER BY '.TBL_BLOG_CATEGORIES.'.id SEPARATOR ",") as "category_ids"');
        $this->db->from($this->table);
        if(!empty($where_id))
            $this->db->where(array(TBL_BLOGS.'.id' => $where_id));
            $method = 'row_array';

        $this->db->join(TBL_BLOG_CATEGORIES, TBL_BLOG_CATEGORIES.'.id = SUBSTRING_INDEX(SUBSTRING_INDEX('.TBL_BLOGS.'.category_ids, ",", FIND_IN_SET('.TBL_BLOG_CATEGORIES.'.id, '.TBL_BLOGS.'.category_ids)), ",", -1)');

        $this->db->order_by(TBL_BLOGS.'.id');
        $this->db->group_by(TBL_BLOGS.'.id');

        $query = $this->db->get();
        return $query->$method();
    }
}
?>