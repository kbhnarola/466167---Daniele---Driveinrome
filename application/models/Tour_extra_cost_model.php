<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tour_extra_cost_model extends MY_Model
{
	protected $_table = TBL_EXTRA_COST;
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->table = TBL_EXTRA_COST;
		// Set orderable column fields
		$this->column_order = array(null, 'title', 'price', 'created_at', 'updated_at', null);
		// Set searchable column fields
		$this->column_search = array('title', 'price');
		// Set default order
		$this->order = array('created_at' => 'desc');
	}

	public function getRows($postData)
	{

		$this->_get_datatables_query($postData);
		if ($postData['length'] != -1) {
			$this->db->limit($postData['length'], $postData['start']);
		}
		$query = $this->db->get();

		return $query->result();
	}

	public function countFiltered($postData)
	{
		$this->_get_datatables_query($postData);
		$query = $this->db->get();
		return $query->num_rows();
	}

	private function _get_datatables_query($postData)
	{

		$this->db->from($this->table);

		$i = 0;
		// loop searchable columns 
		foreach ($this->column_search as $item) {
			// if datatable send POST for search
			if ($postData['search']['value']) {
				// first loop
				if ($i === 0) {
					// open bracket
					$this->db->group_start();
					$this->db->like($item, $postData['search']['value']);
				} else {
					$this->db->or_like($item, $postData['search']['value']);
				}

				// last loop
				if (count($this->column_search) - 1 == $i) {
					// close bracket
					$this->db->group_end();
				}
			}
			$i++;
		}

		if (isset($postData['order'])) {
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_extra_cost_by_ids($ids = '')
	{
		if (!$ids) {
			return false;
		}
		$result_array = array();
		$this->db->select('title, price');
		$this->db->from(TBL_EXTRA_COST);
		$this->db->where(array('status' => 1));
		$this->db->where_in('id', explode(',', $ids));
		$query = $this->db->get();
		$result_array = $query->result_array();
		return $result_array;
	}
}
