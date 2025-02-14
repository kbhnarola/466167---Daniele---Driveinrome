<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_page_static_text extends MY_Model
{
	protected $_table = TBL_CMS_PAGES_STATIC_TEXT;

	public function delete_text($where) {
		$this->db->where($where);
    	$this->db->delete(TBL_CMS_PAGES_STATIC_TEXT);
	}
}