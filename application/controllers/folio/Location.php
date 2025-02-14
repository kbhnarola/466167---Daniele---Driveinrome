<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Location extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Umbriavilla_model', 'umbriavilla_model');
		$this->load->helper(['form', 'url']);
		$this->load->library('upload');

	}


	public function index()
	{
		if ($_POST) {
			// var_dump($_POST);die;
			// Load form validation library
			$this->load->library('form_validation');

			// Set form validation rules
			$this->form_validation->set_rules('locationdescription', 'Location Description', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');

			if ($this->form_validation->run() === TRUE) {
				$post_data = $this->input->post();

				// Prepare data for insertion
				$data = [
					'location_details' => $post_data,
				];
				// Save data to database
				$result = $this->umbriavilla_model->insert_umbriavilla_details($data);

				if ($result) {
					// Set success message
					$response = ['status' => 'success', 'message' => 'Location Details added successfully!'];
				} else {
					// Set error message
					$response = ['status' => 'error', 'message' => 'Failed to add Location Details.'];
				}

			} else {
				// Validation failed
				$response = ['status' => 'error', 'message' => validation_errors()];
			}

			// Send JSON response for AJAX
			echo json_encode($response);
			exit;
		} else {
			$this->set_page_title('Location Details');
			$result = $this->umbriavilla_model->get_umbriavilla_details('location_details');
			$result['apiKey'] = $this->umbriavilla_model->get_umbriavilla_details('ApiKey');
			if ($result) {
				$data['location_details'] = $result;
			} else {
				$data['location_details'] = array();
			}
			$data['content'] = $this->load->view('admin/location/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}
}

