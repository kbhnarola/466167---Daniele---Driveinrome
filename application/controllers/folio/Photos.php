<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Photos extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Photos_model', 'photos_model');
		$this->load->helper(['form', 'url']);
		$this->load->library('upload');

	}


	public function index()
	{
		if ($_POST) {
			// Load form validation library
			$this->load->library('upload');

			// Set form validation rules
			$post_data = $this->input->post();

			if (($_FILES['photos']['name'])) {


				// File upload configuration
				$config['upload_path'] = './uploads/photos/';
				$config['allowed_types'] = 'jpeg|png|jpg';
				// $config['max_size'] = 102400; // 100MB limit
				$config['file_name'] = uniqid('photo_');

				// var_dump($exists_image['icon'] );die;
				// Create directory if it doesn't exist
				if (!is_dir($config['upload_path'])) {
					mkdir($config['upload_path'], 0777, TRUE);
				}

				$this->upload->initialize($config);

				if ($this->upload->do_upload('photos')) {
					// File upload success
					$uploadedData = $this->upload->data();
					$post_data['name'] = $uploadedData['file_name'];
				} else {
					// File upload failed
					$error = $this->upload->display_errors();
					// var_dump($error);die;
					$response = ['status' => 'error', 'message' => "File upload failed: $error"];
				}
			} else {
				$exists_image = $this->photos_model->get_photo_by_id($this->input->post('id'));
				$post_data['name'] = $exists_image['name'];
			}
			// Prepare data for insertion
			$data = $post_data;
			// Save data to database
			if ($this->input->post('id')) {
				$result = $this->photos_model->insert_photo($data, $this->input->post('id'));
			} else {
				$result = $this->photos_model->insert_photo($data);
			}

			if ($result) {
				// Set success message
				$response = ['status' => 'success', 'message' => 'Photos added successfully!'];
			} else {
				// Set error message
				$response = ['status' => 'error', 'message' => 'Failed to add Photos.'];
			}

			// Send JSON response for AJAX
			echo json_encode($response);
			exit;
		} else {
			$this->set_page_title('Photos');
			$data['content'] = $this->load->view('admin/photos/index', '', TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

	public function get_photos_list()
	{
		$result = $this->photos_model->get_photo($_POST);
		echo json_encode($result);
		exit;
	}

	public function get_photo()
	{
		$id = $this->input->post('id');


		// Fetch the details from the model
		$photo = $this->photos_model->get_photo_by_id($id);
		$photo['name'] = base_url('uploads/photos/') . $photo['name'];
		if ($photo) {
			echo json_encode([
				'status' => 'success',
				'data' => $photo
			]);
			exit;
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Photo not found.'
			]);
			exit;
		}
	}

	public function delete_photo()
	{
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$updated = $this->db->update('photos', ['is_deleted' => 1]);

		if ($updated) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Photo Deleted Successfully'
			]);
			exit; // Return true on successful update
		} else {
			echo json_encode([
				'status' => 'success',
				'message' => 'Failed to delete Photo'
			]);
			exit;
		}
	}

	public function save_photo_order()
	{
		$sequence = $this->input->post('orderedIds');

		if ($this->photos_model->update_photos_sequence($sequence)) {
			$response = array('status' => 'success', 'message' => 'Sequence updated successfully');
		} else {
			$response = array('status' => 'error', 'message' => 'Failed to update sequence');
		}

		echo json_encode($response);
		exit;
	}

}

