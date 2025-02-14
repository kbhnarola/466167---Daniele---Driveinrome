<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends MY_Model
{
	protected $_table = TBL_TAG;
	public function get_tags_by($tag_id=array()) {

        $this->db->select('name');
        $this->db->from(TBL_TAG);  
        $this->db->where_in('id', $tag_id);
        $query=$this->db->get();
        $result_array = $query->result_array();
        return $result_array;

    }
}