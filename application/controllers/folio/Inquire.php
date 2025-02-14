<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Inquire extends Admin_Controller
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
			$this->form_validation->set_rules('inquire_description', 'Inquire Description', 'required');

			if ($this->form_validation->run() === TRUE) {
				$post_data = $this->input->post();
				$post_data['inquire_description'] = $post_data['inquire_description'];
				$post_data['inquire_button_text'] = ($post_data['inquire_button_text']) ? $post_data['inquire_button_text'] :  'Inquire';
				// Prepare data for insertion
				$data = [
					'umbriavilla_inquire_details' => $post_data,
				];
				// Save data to database
				$result = $this->umbriavilla_model->insert_umbriavilla_details($data);

				if ($result) {
					// Set success message
					$response = ['status' => 'success', 'message' => 'Inquire details updated successfully!'];
				} else {
					// Set error message
					$response = ['status' => 'error', 'message' => 'Failed to update inquire.'];
				}

			} else {
				// Validation failed
				$response = ['status' => 'error', 'message' => validation_errors()];
			}

			// Send JSON response for AJAX
			echo json_encode($response);
			exit;
		} else {
			$this->set_page_title('inquire');
			$result = $this->umbriavilla_model->get_umbriavilla_details('umbriavilla_inquire_details');
			if ($result) {
				$data['umbriavilla_details'] = $result;
			} else {
				$data['umbriavilla_details'] = array();
			}
			$data['content'] = $this->load->view('admin/inquire/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

}

