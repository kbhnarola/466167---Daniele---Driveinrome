<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Owner_details extends Admin_Controller
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
			$this->load->library('upload');

			// Set form validation rules
			$this->form_validation->set_rules('owner_name', 'Owner Name', 'required');
			$this->form_validation->set_rules('owner_number', 'Owner Contact Number', 'required');
			$this->form_validation->set_rules('owner_email', 'Owner Email', 'required');
			$this->form_validation->set_rules('owner_description', 'Owner Description', 'required');

			if ($this->form_validation->run() === TRUE) {
				$post_data = $this->input->post();

				$exists_image = $this->umbriavilla_model->get_umbriavilla_details('owner_details');
				if (($_FILES['owner_image']['name'])) {


					// File upload configuration
					$config['upload_path'] = './uploads/owner_image/';
					$config['allowed_types'] = 'jpeg|png|jpg';
					// $config['max_size'] = 102400; // 100MB limit
					$config['file_name'] = uniqid('img_');

					if ($exists_image['owner_image'] && file_exists($config['upload_path'] . $exists_image['owner_image'])) {
						unlink($config['upload_path'] . $exists_image['owner_image']); // Delete the old video
					}
					// var_dump($exists_image['owner_image'] );die;
					// Create directory if it doesn't exist
					if (!is_dir($config['upload_path'])) {
						mkdir($config['upload_path'], 0777, TRUE);
					}

					$this->upload->initialize($config);

					if ($this->upload->do_upload('owner_image')) {
						// File upload success
						$uploadedData = $this->upload->data();
						$post_data['owner_image'] = $uploadedData['file_name'];

					} else {
						// File upload failed
						$error = $this->upload->display_errors();
						$response = ['status' => 'error', 'message' => "File upload failed: $error"];
					}
				} else {
					$post_data['owner_image'] = $exists_image['owner_image'];
				}
				// Prepare data for insertion
				$data = [
					'owner_details' => $post_data,
				];
				// Save data to database
				$result = $this->umbriavilla_model->insert_umbriavilla_details($data);

				if ($result) {
					// Set success message
					$response = ['status' => 'success', 'message' => 'Owner Details added successfully!'];
				} else {
					// Set error message
					$response = ['status' => 'error', 'message' => 'Failed to add Owner Details.'];
				}

			} else {
				// Validation failed
				$response = ['status' => 'error', 'message' => validation_errors()];
			}

			// Send JSON response for AJAX
			echo json_encode($response);
			exit;
		} else {
			$this->set_page_title('Owner Details');
			$result = $this->umbriavilla_model->get_umbriavilla_details('owner_details');
			if ($result) {
				$data['owner_details'] = $result;
			} else {
				$data['owner_details'] = array();
			}
			$data['content'] = $this->load->view('admin/owner_details/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

}

