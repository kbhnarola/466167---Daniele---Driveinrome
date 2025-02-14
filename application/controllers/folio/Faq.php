<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Faq extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('FAQ_model', 'faq_model');
		$this->load->helper(['form', 'url']);
		$this->load->library('upload');

	}

	public function index()
	{
		if ($_POST) {
			// Load form validation library
			$this->load->library('form_validation');

			// Set form validation rules
			$this->form_validation->set_rules('title', 'FAQ Title', 'required');
			$this->form_validation->set_rules('description', 'FAQ Description', 'required');

			if ($this->form_validation->run() === TRUE) {
				$post_data = $this->input->post();

				// Prepare data for insertion

				// Save data to database
				if ($this->input->post('id')) {
					$result = $this->faq_model->insert_faq_details($post_data, $this->input->post('id'));
				} else {
					$result = $this->faq_model->insert_faq_details($post_data);
				}

				if ($result) {
					// Set success message
					$response = ['status' => 'success', 'message' => 'FAQ added successfully!'];
				} else {
					// Set error message
					$response = ['status' => 'error', 'message' => 'Failed to add FAQ.'];
				}

			} else {
				// Validation failed
				$response = ['status' => 'error', 'message' => validation_errors()];
			}

			// Send JSON response for AJAX
			echo json_encode($response);
			exit;
		} else {
			$data['title'] = 'FAQ';
			$data['page'] = 'faq';
			$data['content'] = $this->load->view('admin/faq/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

	public function get_faq_list()
	{
		$result = $this->faq_model->get_faq($_POST);
		echo json_encode($result);
		exit;
	}

	public function update_faq_sequence()
	{
		$sequence = $this->input->post('sequence');

		if ($this->faq_model->update_faq_sequence($sequence)) {
			$response = array('status' => 'success', 'message' => 'Sequence updated successfully');
		} else {
			$response = array('status' => 'error', 'message' => 'Failed to update sequence');
		}

		echo json_encode($response);
		exit;
	}

	public function get_faq_details()
	{
		$id = $this->input->post('id');


		// Fetch the details from the model
		$faq = $this->faq_model->get_faq_by_id($id);
		if ($faq) {
			echo json_encode([
				'status' => 'success',
				'data' => $faq
			]);
			exit;
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'FAQ not found.'
			]);
			exit;
		}
	}

	public function delete_faq()
	{
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$updated = $this->db->update('faq', ['is_deleted' => 1]);

		if ($updated) {
			echo json_encode([
				'status' => 'success',
				'message' => 'FAQ Deleted Successfully'
			]);
			exit; // Return true on successful update
		} else {
			echo json_encode([
				'status' => 'success',
				'message' => 'Failed to Deleted FAQ'
			]);
			exit;
		}
	}

}

