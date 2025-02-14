<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Overview_model extends MY_Model
{

	protected $_table = TBL_OVERVIEW_DETAILS;

	/**

		* Constructor for the class

		*/

	public function __construct()
	{

		parent::__construct();

		$this->table = TBL_OVERVIEW_DETAILS;

	}

	public function insert_overview_details($data, $id = null)
{
    // Check if an ID is provided and fetch the existing entry
    if ($id !== null) {
        $existing_entry = $this->db->get_where($this->table, ['id' => $id])->row();

        if ($existing_entry) {
            // Update if entry exists
            $this->db->where('id', $id);
            $updated = $this->db->update($this->table, $data);

            if ($updated) {
                return true; // Return true on successful update
            } else {
                return false; // Return false if update fails
            }
        }
    }
    // var_dump($data);die;
    // Insert if entry doesn't exist
    $inserted = $this->db->insert($this->table, $data);
    return $inserted ? true : false; // Return true if insert is successful, otherwise false
}


	public function get_umbriavilla_details($title)
	{
        $existing_entry = $this->db->get_where($this->table, ['title' => $title])->row();
		if($existing_entry){
			return json_decode($existing_entry->value, true);
		}else{
			return false;
		}
	}

     // Fetch data for DataTable
     public function get_overviews($postData) {
        // var_dump($postData);die;
        $this->db->select('id,title,icon,is_active');
        $this->db->where(['is_deleted' => 0]);
        $this->db->from($this->table);

        // Apply filters, pagination, and sorting
        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $this->db->like('title', $postData['search']['value']);
        }

        if (isset($postData['order'])) {
            $column = $postData['order'][0]['column'];
            $dir = $postData['order'][0]['dir'];
            $this->db->order_by($column, $dir);
        }else{
            $this->db->order_by('id','DESC');
        }

        // Total records
        $totalRecords = $this->db->count_all_results('', false);

        // Limit and offset for pagination
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }

        $query = $this->db->get();
        $data = $query->result_array();
        foreach ($data as $key => $img) {
            $data[$key]['icon'] = base_url('uploads/icon/') . $img['icon'];
        }
        // var_dump($data);die;
        return [
            "draw" => $_POST['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
        ];
    }

    public function get_overview_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table); // Replace with your actual table name
    
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return the row as an associative array
        } else {
            return false;
        }
    }
    
    public function get_overviews_details($highlight_type){
        $this->db->where('highlight_type', $highlight_type);
        $this->db->where('is_deleted', 0);
        $this->db->where('is_active', 1);
        $query = $this->db->get($this->table);
        $data = $query->result_array();
        if ($data > 0) {
            return $data; // Return the row as an associative array
        } else {
            return false;
        }
    }
}

?>