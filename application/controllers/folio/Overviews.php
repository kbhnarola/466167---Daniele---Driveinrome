<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Overviews extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Overview_model', 'overview_model');
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
			$this->form_validation->set_rules('highlight_type', 'Hightlight type', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');

			if ($this->form_validation->run() === TRUE) {
				$post_data = $this->input->post();

				if (($_FILES['icon']['name'])) {


					// File upload configuration
					$config['upload_path'] = './uploads/icon/';
					$config['allowed_types'] = 'svg';
					// $config['max_size'] = 102400; // 100MB limit
					$config['file_name'] = uniqid('svg_');

					// var_dump($exists_image['icon'] );die;
					// Create directory if it doesn't exist
					if (!is_dir($config['upload_path'])) {
						mkdir($config['upload_path'], 0777, TRUE);
					}

					$this->upload->initialize($config);

					if ($this->upload->do_upload('icon')) {
						// File upload success
						$uploadedData = $this->upload->data();
						$post_data['icon'] = $uploadedData['file_name'];

					} else {
						// File upload failed
						$error = $this->upload->display_errors();
						$response = ['status' => 'error', 'message' => "File upload failed: $error"];
					}
				} else {
					$exists_image = $this->overview_model->get_overview_by_id($this->input->post('id'));
					$post_data['icon'] = $exists_image['icon'];
				}
				// Prepare data for insertion
				$data = $post_data;
				// Save data to database
				if ($this->input->post('id')) {
					$result = $this->overview_model->insert_overview_details($data, $this->input->post('id'));
				} else {
					$result = $this->overview_model->insert_overview_details($data);
				}

				if ($result) {
					// Set success message
					$response = ['status' => 'success', 'message' => 'Overview Details added successfully!'];
				} else {
					// Set error message
					$response = ['status' => 'error', 'message' => 'Failed to add Overview Details.'];
				}

			} else {
				// Validation failed
				$response = ['status' => 'error', 'message' => validation_errors()];
			}

			// Send JSON response for AJAX
			echo json_encode($response);
			exit;
		} else {
			$this->set_page_title('Overview');
			$data['overview_title'] = $this->umbriavilla_model->get_umbriavilla_details('overview_title');
			$data['content'] = $this->load->view('admin/overviews/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}


	public function get_overview_list()
	{
		$result = $this->overview_model->get_overviews($_POST);
		echo json_encode($result);
		exit;
	}

	public function get_overview_details()
	{
		$id = $this->input->post('id');


		// Fetch the details from the model
		$overview = $this->overview_model->get_overview_by_id($id);
		$overview['icon'] = base_url('uploads/icon/') . $overview['icon'];
		if ($overview) {
			echo json_encode([
				'status' => 'success',
				'data' => $overview
			]);
			exit;
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Overview not found.'
			]);
			exit;
		}
	}

	public function change_status()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$status = ($status == 'Active') ? 1 : 0;
		$this->db->where('id', $id);
		$updated = $this->db->update('overview', ['is_active' => $status]);
		$get_overview = $this->overview_model->get_overview_by_id($id);
		if ($updated) {
			echo json_encode([
				'status' => 'success',
				'message' => $get_overview['title']." iocn has been ". ($get_overview['is_active'] == 1 ? "enabled" : "disabled")
			]);
			exit; // Return true on successful update
		} else {
			echo json_encode([
				'status' => 'success',
				'message' => 'Failed to change status'
			]);
			exit;
		}
	}
	public function delete_overview()
	{
		$id = $this->input->post('id');
		// $overview = $this->overview_model->get_overview_by_id($id);
		// $filePath = base_url('uploads/icon/') . $overview['icon'];

		// // Check if file exists before attempting to delete
		// if (file_exists($filePath)) {
		// 	unlink($filePath);

		// }
		$this->db->where('id', $id);
		$updated = $this->db->update('overview', ['is_deleted' => 1]);

		if ($updated) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Overview Deleted Successfully'
			]);
			exit; // Return true on successful update
		} else {
			echo json_encode([
				'status' => 'success',
				'message' => 'Failed to Deleted Overview'
			]);
			exit;
		}
	}

	public function save_overview_title()
	{
		$post_data = $this->input->post();

		// Prepare data for insertion
		$data = [
			'overview_title' => $post_data,
		];
		// Save data to database
		$result = $this->umbriavilla_model->insert_umbriavilla_details($data);

		if ($result) {
			// Set success message
			$response = ['status' => 'success', 'message' => 'Overview Title added successfully!'];
		} else {
			// Set error message
			$response = ['status' => 'error', 'message' => 'Failed to add Overview Title.'];
		}

		echo json_encode($response);
		exit;
	}

}

