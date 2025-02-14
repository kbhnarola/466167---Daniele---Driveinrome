<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Photos_model extends MY_Model
{

	protected $_table = TBL_PHOTOS_DETAILS;

	/**

		* Constructor for the class

		*/

	public function __construct()
	{

		parent::__construct();

		$this->table = TBL_PHOTOS_DETAILS;

	}

	public function insert_photo($data, $id = null)
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


     // Fetch data for DataTable
     public function get_photo($postData) {
        // var_dump($postData);die;
        $this->db->select('id,name');
        $this->db->where(['is_deleted' => 0]);
        $this->db->from($this->table);

        // Apply filters, pagination, and sorting
        if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
            $this->db->like('title', $postData['search']['value']);
        }

        if (!empty($postData['order'])) {
            $columnIndex = $postData['order'][0]['column'];
            $columnName = $postData['columns'][$columnIndex]['data'];
            $sortDirection = $postData['order'][0]['dir'];
            $this->db->order_by($columnName, $sortDirection);
        } else {
            $this->db->order_by('sequence_id', 'ASC');
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
            $data[$key]['name'] = base_url('uploads/photos/') . $img['name'];
        }
        // var_dump($data);die;
        return [
            "draw" => $_POST['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
        ];
    }

    public function get_photos_web() {
        $this->db->where('is_deleted', 0); // Filter by is_deleted = 0
        $this->db->order_by('sequence_id', 'ASC'); // Order by sequence_id in ascending order
        $existing_entries = $this->db->get($this->table)->result_array(); // Fetch the results as an array

        if ($existing_entries) {
            return $existing_entries; // Return the array directly
        } else {
            return false; // Return false if no entries are found
        }
    }
    
    public function get_photo_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table); // Replace with your actual table name
    
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return the row as an associative array
        } else {
            return false;
        }
    }

    public function update_photos_sequence($sequence) {
        foreach ($sequence as $order => $id) {
            $this->db->where('id', $id);
            $this->db->update($this->table, ['sequence_id' => $order + 1]);
        }
        return true;
    }
}

?>