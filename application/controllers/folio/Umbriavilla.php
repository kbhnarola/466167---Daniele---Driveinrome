<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Umbriavilla extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Umbriavilla_model', 'umbriavilla_model');
		$this->load->model('Overview_model', 'overview_model');
		$this->load->model('FAQ_model', 'faq_model');
		$this->load->model('Photos_model', 'photos_model');
		$this->load->model('Experiences_model', 'experiences_model');
		$this->load->helper(['form', 'url']);
		$this->load->library('upload');

	}

	public function banner()
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

	public function owner_details()
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

	public function overviews()
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
			$data['content'] = $this->load->view('admin/overviews/index', '', TRUE);
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

		if ($updated) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Status change successful'
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


	public function terms()
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

	public function faq()
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

	public function photos()
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
	public function experiences()
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
			$data['content'] = $this->load->view('admin/experiences/index', '', TRUE);
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

	public function footer()
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

	public function location()
	{
		if ($_POST) {
			// var_dump($_POST);die;
			// Load form validation library
			$this->load->library('form_validation');

			// Set form validation rules
			$this->form_validation->set_rules('airport', 'Airport', 'required');
			$this->form_validation->set_rules('trainStation', 'Train station', 'required');
			$this->form_validation->set_rules('highways', 'Highways', 'required');
			$this->form_validation->set_rules('shopServices', 'Shops and services', 'required');
			$this->form_validation->set_rules('parking', 'Parking', 'required');
			$this->form_validation->set_rules('beaches', 'Beaches', 'required');
			$this->form_validation->set_rules('accessRoads', 'Access roads', 'required');
			$this->form_validation->set_rules('attractions', 'Attractions within 100 km', 'required');
			$this->form_validation->set_rules('altitude', 'Altitude', 'required');

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

