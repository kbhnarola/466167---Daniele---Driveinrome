<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Banner extends Admin_Controller
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
			// Load form validation library
			$this->load->library('form_validation');
			$this->load->library('upload');

			// Set form validation rules
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('contact1', 'Contact 1', 'required');
			// $this->form_validation->set_rules('contact2', 'Contact 2', 'required');
			$this->form_validation->set_rules('youtube_link', 'YouTube Link', 'required|valid_url');

			if ($this->form_validation->run() === TRUE) {
				$post_data = $this->input->post();

				$exists_video = $this->umbriavilla_model->get_umbriavilla_details('umbriavilla_banner_detals');
				if (($_FILES['banner_video']['name'])) {


					// File upload configuration
					$config['upload_path'] = './uploads/banner_video/';
					$config['allowed_types'] = 'mp4|avi|mov|wmv|webm';
					// $config['max_size'] = 102400; // 100MB limit
					$config['file_name'] = uniqid('video_');

					// var_dump(($config['upload_path'] . $exists_video['banner_video']));die;
					if ($exists_video['banner_video'] && file_exists($config['upload_path'] . $exists_video['banner_video'])) {
						unlink($config['upload_path'] . $exists_video['banner_video']); // Delete the old video
					}
					// Create directory if it doesn't exist
					if (!is_dir($config['upload_path'])) {
						mkdir($config['upload_path'], 0777, TRUE);
					}

					$this->upload->initialize($config);

					if ($this->upload->do_upload('banner_video')) {
						// File upload success
						$uploadedData = $this->upload->data();
						$post_data['banner_video'] = $uploadedData['file_name'];

					} else {
						// File upload failed
						$error = $this->upload->display_errors();
						$response = ['status' => 'error', 'message' => "File upload failed: $error"];
					}
				} else {
					$post_data['banner_video'] = $exists_video['banner_video'];
				}
				// Prepare data for insertion
				$data = [
					'umbriavilla_banner_detals' => $post_data,
				];
				// Save data to database
				$result = $this->umbriavilla_model->insert_umbriavilla_details($data);

				if ($result) {
					// Set success message
					$response = ['status' => 'success', 'message' => 'Banner added successfully!'];
				} else {
					// Set error message
					$response = ['status' => 'error', 'message' => 'Failed to add banner.'];
				}

			} else {
				// Validation failed
				$response = ['status' => 'error', 'message' => validation_errors()];
			}

			// Send JSON response for AJAX
			echo json_encode($response);
			exit;
		} else {
			$this->set_page_title('Banner');
			$result = $this->umbriavilla_model->get_umbriavilla_details('umbriavilla_banner_detals');
			if ($result) {
				$data['umbriavilla_details'] = $result;
			} else {
				$data['umbriavilla_details'] = array();
			}
			$data['content'] = $this->load->view('admin/banner/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

}

