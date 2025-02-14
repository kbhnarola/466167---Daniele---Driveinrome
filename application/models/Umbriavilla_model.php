<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Umbriavilla_model extends MY_Model
{

	protected $_table = TBL_UMBRIAVILLA_DETAILS;

	/**

		* Constructor for the class

		*/

	public function __construct()
	{

		parent::__construct();

		$this->table = TBL_UMBRIAVILLA_DETAILS;

	}

	public function insert_umbriavilla_details($data)
	{
		foreach ($data as $title => $value) {
            // Check if the title already exists
            $existing_entry = $this->db->get_where($this->table, ['title' => $title])->row();
			// var_dump($data);die;
            if ($existing_entry) {
                // Update if entry exists
                $this->db->where('title', $title);
                $this->db->update($this->table, ['value' => json_encode($value)]);
				
            } else {
                // Insert if entry doesn't exist
                $this->db->insert($this->table, [
                    'title' => $title,
                    'value' => json_encode($value)
                ]);
            }
			return true;
        }
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

}

?>