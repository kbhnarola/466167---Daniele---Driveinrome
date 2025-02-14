<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Terms extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Umbriavilla_model', 'umbriavilla_model');
		$this->load->helper(['form', 'url']);

	}

	public function index()
	{
		if ($_POST) {
			// Load form validation library
			$this->load->library('form_validation');

			// Set form validation rules
			$this->form_validation->set_rules('terms_condtion', 'Terms & Condition', 'required');

			if ($this->form_validation->run() === TRUE) {
				$post_data = $this->input->post();

				// Prepare data for insertion
				$data = [
					'terms_condtion' => $post_data,
				];

				// Save data to database
				$result = $this->umbriavilla_model->insert_umbriavilla_details($data);

				if ($result) {
					// Set success message
					$response = ['status' => 'success', 'message' => 'Terms & Condition added successfully!'];
				} else {
					// Set error message
					$response = ['status' => 'error', 'message' => 'Failed to add Terms & Condition.'];
				}

			} else {
				// Validation failed
				$response = ['status' => 'error', 'message' => validation_errors()];
			}

			// Send JSON response for AJAX
			echo json_encode($response);
			exit;
		} else {
			$data['title'] = 'Terms and Conditions';
			$data['page'] = 'terms';
			$result = $this->umbriavilla_model->get_umbriavilla_details('terms_condtion');
			if ($result) {
				$data['terms_condtion'] = $result;
			} else {
				$data['terms_condtion'] = array();
			}
			$data['content'] = $this->load->view('admin/terms_condition/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

}

