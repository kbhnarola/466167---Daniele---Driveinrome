<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Experiences extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Experiences_model', 'experiences_model');
        $this->load->model('Umbriavilla_model', 'umbriavilla_model');
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

            if ($_FILES['pdf']['name']) {
                // File upload configuration
                $config['upload_path'] = './uploads/experiences/pdf';
                $config['allowed_types'] = 'pdf';
                // $config['max_size'] = 102400; // 100MB limit
                $config['file_name'] = uniqid('pdf_');

                // var_dump($exists_image['icon'] );die;
// Create directory if it doesn't exist
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                $this->upload->initialize($config);

                if ($this->upload->do_upload('pdf')) {
                    // File upload success
                    $uploadedData = $this->upload->data();
                    $post_data['pdf'] = $uploadedData['file_name'];
                } else {
                    // File upload failed
                    $error = $this->upload->display_errors();
                    // var_dump($error);die;
                    $response = ['status' => 'error', 'message' => "File upload failed: $error"];
                }
            } else {
                $exists_pdf = $this->experiences_model->get_experiences_by_id($this->input->post('id'));
                if ($exists_pdf) {
                    $post_data['pdf'] = $exists_pdf['pdf'];
                } else {
                    $response = ['status' => 'error', 'message' => "Please Select Pdf"];
                    echo json_encode($response);
                    exit;
                }
            }
            if (($_FILES['image']['name'])) {
                // File upload configuration
                $config['upload_path'] = './uploads/experiences/images';
                $config['allowed_types'] = 'jpeg|png|jpg';
                // $config['max_size'] = 102400; // 100MB limit
                $config['file_name'] = uniqid('img_');

                // var_dump($exists_image['icon'] );die;
                // Create directory if it doesn't exist
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                $this->upload->initialize($config);

                if ($this->upload->do_upload('image')) {
                    // File upload success
                    $uploadedData = $this->upload->data();
                    $post_data['image'] = $uploadedData['file_name'];
                } else {
                    // File upload failed
                    $error = $this->upload->display_errors();
                    // var_dump($error);die;
                    $response = ['status' => 'error', 'message' => "File upload failed: $error"];
                }
            } else {
                $exists_image = $this->experiences_model->get_experiences_by_id($this->input->post('id'));
                if ($exists_image) {
                    $post_data['image'] = $exists_image['image'];
                } else {
                    $response = ['status' => 'error', 'message' => "Please Select Image"];
                    echo json_encode($response);
                    exit;
                }
            }
            // Prepare data for insertion
            $data = $post_data;
            // Save data to database
            if ($this->input->post('id')) {
                $result = $this->experiences_model->insert_experiences_details($data, $this->input->post('id'));
            } else {
                $result = $this->experiences_model->insert_experiences_details($data);
            }

            if ($result) {
                // Set success message
                $response = ['status' => 'success', 'message' => 'Experiences added successfully!'];
            } else {
                // Set error message
                $response = ['status' => 'error', 'message' => 'Failed to add Experiences.'];
            }

            // Send JSON response for AJAX
            echo json_encode($response);
            exit;
        } else {
            $this->set_page_title('Photos');
            $data['experiences_title'] = $this->umbriavilla_model->get_umbriavilla_details('experiences_title');
            $data['experiences_status'] = $this->umbriavilla_model->get_umbriavilla_details('experiences_status');
            $data['content'] = $this->load->view('admin/experiences/index', $data, TRUE);
            $this->load->view('admin/layouts/index', $data);
        }
    }

    public function get_experiences_list()
    {
        $result = $this->experiences_model->get_experiences($_POST);
        echo json_encode($result);
        exit;
    }

    public function get_experiences_details()
    {
        $id = $this->input->post('id');


        // Fetch the details from the model
        $experiences = $this->experiences_model->get_experiences_by_id($id);
        $experiences['image'] = base_url('uploads/experiences/images/') . $experiences['image'];
        if ($experiences) {
            echo json_encode([
                'status' => 'success',
                'data' => $experiences
            ]);
            exit;
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Experiences not found.'
            ]);
            exit;
        }
    }

    public function delete_experiences()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $updated = $this->db->update('experiences', ['is_deleted' => 1]);

        if ($updated) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Experiences Deleted Successfully'
            ]);
            exit; // Return true on successful update
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Failed to delete Experiences'
            ]);
            exit;
        }
    }

    public function save_experiences_title()
	{
		$post_data = $this->input->post();

		// Prepare data for insertion
		$data = [
			'experiences_title' => $post_data,
		];
		// Save data to database
		$result = $this->umbriavilla_model->insert_umbriavilla_details($data);

		if ($result) {
			// Set success message
			$response = ['status' => 'success', 'message' => 'Experiences Title added successfully!'];
		} else {
			// Set error message
			$response = ['status' => 'error', 'message' => 'Failed to add Experiences Title.'];
		}

		echo json_encode($response);
		exit;
	}

    public function change_status()
	{
		$post_data = $this->input->post();
        
		// Prepare data for insertion
		$data = [
			'experiences_status' => $post_data,
		];
        // var_dump($data);die;
		// Save data to database
		$result = $this->umbriavilla_model->insert_umbriavilla_details($data);

		if ($result) {
			// Set success message
			$response = ['status' => 'success', 'message' => 'Experiences Status added successfully!'];
		} else {
			// Set error message
			$response = ['status' => 'error', 'message' => 'Failed to add Experiences Status.'];
		}

		echo json_encode($response);
		exit;
	}
}

