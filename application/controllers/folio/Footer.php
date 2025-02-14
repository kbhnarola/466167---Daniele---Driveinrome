<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Footer extends Admin_Controller
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
			// var_dump($_POST);die;
			// Load form validation library
			$this->load->library('form_validation');

			// Set form validation rules
			$this->form_validation->set_rules('footer_title', 'Title', 'required');
			$this->form_validation->set_rules('footer_sub_title', 'Sub title', 'required');
			$this->form_validation->set_rules('footer_contact1', 'Contact Number 1', 'required');
			$this->form_validation->set_rules('footer_whatsapp', 'WhatsApp Number', 'required');
			$this->form_validation->set_rules('footer_email', 'Email', 'required');

			if ($this->form_validation->run() === TRUE) {
				$post_data = $this->input->post();

				// Prepare data for insertion
				$data = [
					'footer_details' => $post_data,
				];
				// Save data to database
				$result = $this->umbriavilla_model->insert_umbriavilla_details($data);

				if ($result) {
					// Set success message
					$response = ['status' => 'success', 'message' => 'Footer Details added successfully!'];
				} else {
					// Set error message
					$response = ['status' => 'error', 'message' => 'Failed to add Footer Details.'];
				}

			} else {
				// Validation failed
				$response = ['status' => 'error', 'message' => validation_errors()];
			}

			// Send JSON response for AJAX
			echo json_encode($response);
			exit;
		} else {
			$this->set_page_title('Footer Details');
			$result = $this->umbriavilla_model->get_umbriavilla_details('footer_details');
			if ($result) {
				$data['footer_details'] = $result;
			} else {
				$data['footer_details'] = array();
			}
			$data['content'] = $this->load->view('admin/footer/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

}

