<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transfers extends Frontend_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->load->library('cart');

		$this->load->model('Tours_model', 'tours');
		$this->load->model('Tour_type_model', 'tour_types');
		$this->load->model('Tour_categories_model', 'tour_categories');
		$this->load->model('Tour_variation_model', 'tour_variation');
		$this->load->model('Tour_price_plan_model', 'tour_price');
		$this->load->model('Tour_extra_services_model', 'tour_extra_services');
		$this->load->model('Review_model', 'reviews');
	}

	public function index()
	{

		$tour_slug = strtolower(trim($this->uri->segment(2)));
		$toursData = $this->tours->get_tour_details($tour_slug);

		if (is_array($toursData) && sizeof($toursData) > 0) {
			if ($this->session->userdata('quote_data')) {
				$this->session->unset_userdata('quote_data');
			}
			if ($toursData['id'] == '') {
				set_alert('error', "Records Not Found");
				redirect('');
			}
			$data['title'] = 'Tours | ' . $toursData['title'];
			$data['toursData'] = $toursData;
			if ($this->uri->segment(3) != "edit") {
				if ($this->cart->total_items() > 0) {
					$cart_content = $this->cart->contents();

					foreach ($cart_content as $value) {
						if ($value['id'] == $toursData['id']) {
							set_alert('warning_alert', "This Tour is already added in your cart, You can only update your booking details for this tour.");
							break;
						}
					}
				}
			}
			$data['meta_title'] = $toursData['meta_title'];
			$data['meta_description'] = $toursData['meta_description'];
			$data['meta_keyword'] = $toursData['meta_keyword'];

			//$data['reviews']=$this->reviews->get_many_by(array('tour_id'=>$toursData['id'],"is_draft"=>0));
			$data['total_reviews'] = $this->reviews->count_by(array('tour_id' => $toursData['id'], "is_draft" => 0));
			$data['reviews'] = $this->reviews->get_tour_review(array('tour_id' => $toursData['id'], "is_draft" => 0));
			$this->load->frontpage('frontpages', 'transfer_tour_detail', $data);
		} else {
			set_alert('error', "Records Not Found");
			redirect('');
		}
	}

	public function transfer_tours($city_slug)
	{
		$data['tour_details'] = $this->tours->get_tour_list_by_city_slug(($city_slug), array('9', '10'), '', $is_transfer_tours = true);
		$data['tour_details_type'] = "Transfer Tours";
		$table = TBL_TOUR_CATEGORY;
		$meta_details = $this->tours->get_meta_description($table, $city_slug);
		$data['title'] = $data['meta_description'] = $data['meta_keyword'] = 'N/A';
		if ($meta_details) {
			$data['title'] = (!empty($meta_details[0]['meta_title'])) ? $meta_details[0]['meta_title'] : 'N/A';
			$data['meta_description'] = $meta_details[0]['meta_description'];
			$data['meta_keyword'] = $meta_details[0]['meta_keywords'];
		}
		$this->load->frontpage('frontpages', 'list_of_transfer_tours', $data);
	}

	public function get_tour_price()
	{

		$tour_id = base64_decode($this->input->post('tour_id'));
		//$tour_type_id=base64_decode($this->input->post('tour_type_id'));

		$where = array("tour_id" => $tour_id);
		//$result=$this->tour_price->get_many_by($where);
		$result = $this->tour_price->get_price_by($tour_id);

		if (is_array($result) && sizeof($result) > 0) {
			//$where=array("tour_type_id"=>$tour_type_id);
			//$variations=$this->tour_variation->get_many_by($where);
			// $custom_date=$this->tour_price->get_date_by($tour_id);
			// if(is_array($custom_date) && sizeof($custom_date)>0){
			// 	$custom_date_array=array_column($custom_date,'tour_date');
			// } else {
			// 	$custom_date_array=array();
			// }

			$response['success'] = true;
			$response['data'] = $result;
			//$response['custom_date']=$custom_date_array;
			//$response['custom_date']=$custom_date_array;
			//$response['variations']=$variations;
		} else {
			$response['success'] = false;
			$response['data'] = _l('something_wrong');
		}
		echo json_encode($response);
		exit;
	}

	public function get_tour_price_byDate()
	{

		$tour_id = base64_decode($this->input->post('tour_id'));
		$tour_date = date('Y-m-d', strtotime($this->input->post('tour_date')));

		$where = array("tour_id" => $tour_id);
		//$result=$this->tour_price->get_many_by($where);
		$result = $this->tour_price->get_price_by_date($tour_id, $tour_date);

		if (is_array($result) && sizeof($result) > 0) {
			$response['success'] = true;
			$response['data'] = $result;
		} else {
			$response['success'] = false;
			$response['data'] = _l('something_wrong');
		}
		echo json_encode($response);
		exit;
	}

	public function get_quote()
	{
		if ($this->session->userdata('quote_data')) {

			$data['title'] = 'Tours | Request Quote';
			$this->load->frontpage('frontpages', 'request_quote', $data);
		} else {
			set_alert('error', _l('something_wrong'));
			redirect('');
		}
	}

	public function send_me_quote()
	{

		//$data['title'] = 'Driverinrome | Tours | Get Quote';

		$request_date = $this->input->post('selected_date');
		$total_passenger = $this->input->post('total_person_m');
		$total_rate = $this->input->post('final_price');
		$tour_availability = $this->input->post('tour_availability_m');
		$tour_id = base64_decode($this->input->post('tour_id_m'));
		$tour_notes = $this->input->post('tour_notes');
		if ($tour_notes == "") {
			$tour_notes = "-";
		}
		$toursData = $this->tours->get_tour_details_reqQuote($tour_id);
		if (is_array($toursData) && sizeof($toursData) > 0) {
			$data['toursData'] = $toursData;
			$data['request_date'] = $request_date;
			$data['total_passenger'] = $total_passenger;
			$data['total_rate'] = $total_rate;
			$data['tour_availability'] = $tour_availability;
			$data['tour_notes'] = $tour_notes;
			$data['tour_email_description'] = $toursData['tour_email_description'];

			$this->session->set_userdata('quote_data', $data);
			redirect('get_quote');
			//$this->load->frontpage('frontpages', 'request_quote', $data);
		} else {
			set_alert('error', "Records Not Found");
			redirect('');
		}
	}

	public function submit_quote_request()
	{

		$username = ucwords(trim($this->input->post('user_name')));
		$user_email = $this->input->post('user_email');
		$this->form_validation->set_rules('user_name', 'Username', 'trim|required');
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required');
		$this->form_validation->set_rules('user_confirm_email', 'Confirm Email', 'trim|required|matches[user_email]');


		if ($this->form_validation->run() == FALSE) {
			$response['success'] = false;
			$response['msg'] = "All fields are required";
			echo json_encode($response);
			exit;
		} else {
			$toursData = $this->session->userdata('quote_data');
			// START add user details into active campaign automation
			$active_campaign_automation_id = $toursData['toursData']['active_campaign_automation_id'];
			$post_data = array('username' => $username, 'user_email' => $user_email, 'active_campaign_automation_id' => $active_campaign_automation_id);
			$api_campaign_response = api_campaign($post_data);
			// END add user details into active campaign automation

			$email_subject = 'Driver In Rome';
			$email_template_name = '';
			$email_template_name_admin = '';
			$tour_availability = "Available";
			if ($toursData['tour_email_description']) {
				$tour_email_description = $toursData['tour_email_description'];
			} else {
				$tour_email_description = '';
			}
			if ($toursData['tour_availability'] == 0) {
				$get_email_template = get_email_template('get-quote-oops');
				$placeholder = ['{username}', '{tour_date}', '{passenger}', '{tour_email_description}', '{oops_image}'];
				$form_data   = [$username, date('d M Y', strtotime($toursData['request_date'])), $toursData['total_passenger'], $tour_email_description, EMAIL_OOPS_PNG];
				$email_template_name = 'get-quote-oops';
				$tour_availability = "Not Available";
				$tour_rate = "-";
			} else {
				$get_email_template = get_email_template('get-quote');
				$placeholder = ['{username}', '{tour_date}', '{passenger}', '{tour_name}', '{rate_for_tour}', '{tour_email_description}', '{welcome_image}'];
				$form_data   = [$username, date('d M Y', strtotime($toursData['request_date'])), $toursData['total_passenger'], $toursData['toursData']['title'], '€ ' . $toursData['total_rate'], $tour_email_description, EMAIL_WELCOME_PNG];
				$email_template_name = 'get-quote';
				$tour_rate = '€ ' . $toursData['total_rate'];
			}

			$get_email_template_admin = get_email_template('get-quote-admin');
			$placeholder_admin = ['{username}', '{email}', '{enquiry_date}', '{passenger}', '{tour_name}', '{tour_rate}', '{tour_notes}', '{tour_availability}', '{welcome_image}'];
			$form_data_admin   = [$username, $user_email, date('d M Y', strtotime($toursData['request_date'])), $toursData['total_passenger'], $toursData['toursData']['title'], $tour_rate, $toursData['tour_notes'], $tour_availability, EMAIL_WELCOME_PNG];
			$email_template_name_admin = 'get-quote-admin';

			$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';
			$get_email_body_admin = (!empty($get_email_template_admin['message'])) ? $get_email_template_admin['message'] : '';

			if (!empty($get_email_template['subject'])) {
				$email_subject = $get_email_template['subject'];
			}

			$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);
			$get_admin_email_body = str_replace($placeholder_admin, $form_data_admin, $get_email_body_admin);

			$data['email_body'] = $get_new_email_body;
			$data['subject'] = $email_subject;

			if (email_sending($user_email, $data, $email_template_name)) {

				$data_admin['email_body'] = $get_admin_email_body;
				$data_admin['subject'] = $email_subject;
				email_sending($to = '', $data_admin, $email_template_name_admin);

				$response['success'] = true;
				$this->session->unset_userdata('quote_data');
			} else {
				$response['success'] = false;
				$response['msg'] = 'Getting error while sending email, please try again later!';
			}
			echo json_encode($response);
			exit;
		}
	}

	public function availability_ticket()
	{
		if ($this->session->userdata('tours_data')) {
			$data['title'] = 'Tours | Availability Ticket';
			$data['header_banner'] = 'no';
			$this->load->frontpage('frontpages', 'availability_ticket', $data);
		} else {
			set_alert('error', _l('something_wrong'));
			redirect('');
		}
	}

	public function add_ticket()
	{

		$request_date = $this->input->post('selected_date');
		$tour_notes = $this->input->post('tour_notes');
		// $adult_price=$this->input->post('adult_price');
		// $senior_price=$this->input->post('senior_price');
		// $kids_price=$this->input->post('kids_price');
		// $infant_price=$this->input->post('infant_price');

		$adult_ttl_person = $this->input->post('adult_ttl_person');
		$senior_ttl_person = $this->input->post('senior_ttl_person');
		$kids_ttl_person = $this->input->post('kids_ttl_person');
		$infants_ttl_person = $this->input->post('infants_ttl_person');

		$total_passenger = $this->input->post('total_person_m');
		$total_rate = $this->input->post('final_price');
		$tour_availability = $this->input->post('tour_availability_m');
		$edit_booking_detail_m = $this->input->post('edit_booking_detail_m');
		$add_booking_detail_m = $this->input->post('add_booking_detail_m');
		$tour_id = base64_decode($this->input->post('tour_id_m'));
		$toursData = $this->tours->get_tour_details_byId($tour_id);
		// echo $this->db->last_query();
		// exit;
		if (is_array($toursData) && sizeof($toursData) > 0) {
			$data['toursData'] = $toursData;
			$data['request_date'] = $request_date;
			$data['total_passenger'] = $total_passenger;
			$data['tour_notes'] = $tour_notes;
			$data['total_rate'] = $total_rate;

			$data['total_adult_person'] = $adult_ttl_person;
			$data['total_senior_person'] = $senior_ttl_person;
			$data['total_kids'] = $kids_ttl_person;
			$data['total_infants'] = $infants_ttl_person;
			$data['add_tour_booking_detail'] = $add_booking_detail_m;
			$data['edit_tour_booking_detail'] = $edit_booking_detail_m;
			// $data['adult_price']=$adult_price;
			// $data['senior_price']=$senior_price;
			// $data['kids_price']=$kids_price;
			// $data['infants_price']=$infant_price;

			$data['tour_availability'] = $tour_availability;

			$this->session->set_userdata('tours_data', $data);
			$ex_s = 0;
			if ($toursData['extra_services_id']) {
				$ex_services = explode(",", $toursData['extra_services_id']);
				$extra_service_array = get_extra_services();
				if (is_array($extra_service_array) && sizeof($extra_service_array) > 0) {
					foreach ($extra_service_array as $ex) {
						if (in_array($ex['id'], $ex_services)) {
							$ex_s++;
							break;
						}
					}
				}
			}

			if ($ex_s > 0) {
				redirect('availability_ticket');
			} else {
				$ses_list = $this->session->userdata('tours_data');
				$add_tour = 0;
				if (array_key_exists('add_tour_booking_detail', $ses_list)) {
					if ($ses_list['add_tour_booking_detail']) {
						$add_tour++;
					}
					unset($ses_list['add_tour_booking_detail']);
				}
				$update_tour = 0;
				if (array_key_exists('edit_tour_booking_detail', $ses_list)) {
					if ($ses_list['edit_tour_booking_detail']) {
						$update_tour++;
					}
					unset($ses_list['edit_tour_booking_detail']);
				}
				$ses_list['tour_upgrades'] = array();
				$ses_list['total_tour_upgrades_price'] =  0;
				$ses_list['tour_upgrades_passenger_detail'] = array();
				$this->session->set_userdata('tours_data', $ses_list);
				$tour_session_list = $this->session->userdata('tours_data');
				$data = array(
					'id'      => $tour_session_list['toursData']['tour_id'],
					'qty'     => 1,
					'price'   => $tour_session_list['total_rate'],
					'name'    => $tour_session_list['toursData']['title'],
					'tours_detail_data' => $tour_session_list
				);
				$is_tourId = 0;
				if (count($this->cart->contents()) > 0) {
					foreach ($this->cart->contents() as $c) {
						if (array_key_exists('tours_detail_data', $c)) {
							if ($c['id'] == $data['id']) {
								$data = $this->cart->update(array(
									'rowid' => $c['rowid'],
									'price'   => $tour_session_list['total_rate'] + $this->input->post('total_tour_upgrades_price'),
									'name'    => $tour_session_list['toursData']['title'],
									'tours_detail_data' => $tour_session_list
								));
								$this->cart->product_name_rules = '[:print:]';
								$this->cart->update($data);
								$is_tourId = 1;
								$update_tour++;
							}
						}
					}
				}
				if ($is_tourId == 0) {
					//$this->cart->destroy();
					$this->cart->product_name_rules = '[:print:]';
					$this->cart->insert($data);
				}
				if ($tour_session_list['total_passenger'] > 1) {
					$person = " Persons";
				} else {
					$person = " Person";
				}
				if ($update_tour > 0) {
					set_alert('success', "Tour <b>" . $tour_session_list['toursData']['title'] . "</b> for <b>" . $tour_session_list['total_passenger'] . $person . "</b> successfully updated to your cart.");
				} elseif ($add_tour > 0) {
					set_alert('success', "Tour <b>" . $tour_session_list['toursData']['title'] . "</b> for <b>" . $tour_session_list['total_passenger'] . $person . "</b> successfully added to your cart.");
				}
				//$this->session->unset_userdata('tours_data');
				redirect('summary');
				exit;
			}
		} else {
			set_alert('error', "Records Not Found");
			redirect('');
		}
	}

	public function add_tour_upgrades()
	{

		if ($this->input->post()) {
			if (array_key_exists('tour_upgrades', $this->input->post())) {

				$ses_list = $this->session->userdata('tours_data');
				$update_tour = 0;
				if (array_key_exists('add_tour_booking_detail', $ses_list)) {
					if ($ses_list['add_tour_booking_detail'] == 0 && count($this->input->post('tour_upgrades[]')) != $this->input->post('total_tour_upgrades')) {
						$update_tour++;
					}
				} elseif (count($this->input->post('tour_upgrades[]')) != $this->input->post('total_tour_upgrades')) {
					$update_tour++;
				}

				$add_tour = 0;
				if (array_key_exists('add_tour_booking_detail', $ses_list)) {
					if ($ses_list['add_tour_booking_detail']) {
						$add_tour++;
					}
					unset($ses_list['add_tour_booking_detail']);
				}

				if (array_key_exists('edit_tour_booking_detail', $ses_list)) {
					if ($ses_list['edit_tour_booking_detail']) {
						$update_tour++;
					}
					unset($ses_list['edit_tour_booking_detail']);
				}
				$ses_list['tour_upgrades'] = $this->input->post('tour_upgrades[]');
				$ses_list['total_tour_upgrades_price'] =  $this->input->post('total_tour_upgrades_price');
				// check and store vatican ticket passenger details
				if (array_key_exists("first_name", $this->input->post())) {
					$ses_list['tour_upgrades_passenger_detail']['first_name'] =  $this->input->post('first_name[]');
					$ses_list['tour_upgrades_passenger_detail']['last_name'] =  $this->input->post('last_name[]');
					$ses_list['tour_upgrades_passenger_detail']['birth_date'] =  $this->input->post('birth_date[]');
					$ses_list['tour_upgrades_passenger_detail']['birth_place'] =  $this->input->post('birth_place[]');
					if (array_key_exists("pass_age", $this->input->post())) {
						$ses_list['tour_upgrades_passenger_detail']['age'] =  $this->input->post('pass_age[]');
					}
				}
				// check and store Colosseum ticket passenger details
				if (array_key_exists("colo_first_name", $this->input->post())) {
					$ses_list['tour_upgrades_passenger_detail']['colo_first_name'] =  $this->input->post('colo_first_name[]');
					$ses_list['tour_upgrades_passenger_detail']['colo_last_name'] =  $this->input->post('colo_last_name[]');
					// $ses_list['tour_upgrades_passenger_detail']['birth_date'] =  $this->input->post('birth_date[]');
					// $ses_list['tour_upgrades_passenger_detail']['birth_place'] =  $this->input->post('birth_place[]');
					if (array_key_exists("colo_pass_age", $this->input->post())) {
						$ses_list['tour_upgrades_passenger_detail']['colo_age'] =  $this->input->post('colo_pass_age[]');
					}
				}
				if (!array_key_exists("first_name", $this->input->post()) && !array_key_exists("colo_first_name", $this->input->post())) {
					$ses_list['tour_upgrades_passenger_detail'] = array();
				}

				$this->session->set_userdata('tours_data', $ses_list);
				$tour_session_list = $this->session->userdata('tours_data');

				$data = array(
					'id'      => $tour_session_list['toursData']['tour_id'],
					'qty'     => 1,
					'price'   => $tour_session_list['total_rate'] + $this->input->post('total_tour_upgrades_price'),
					'name'    => $tour_session_list['toursData']['title'],
					'tours_detail_data' => $tour_session_list
				);
				$is_tourId = 0;
				if (count($this->cart->contents()) > 0) {

					foreach ($this->cart->contents() as $c) {
						if (array_key_exists('tours_detail_data', $c)) {
							if ($c['id'] == $data['id']) {
								$data = $this->cart->update(array(
									'rowid' => $c['rowid'],
									'price'   => $tour_session_list['total_rate'] + $this->input->post('total_tour_upgrades_price'),
									'name'    => $tour_session_list['toursData']['title'],
									'tours_detail_data' => $tour_session_list
								));

								$this->cart->update($data);
								$is_tourId++;
							}
						}
					}
				}
				if ($is_tourId == 0) {

					//$this->cart->destroy();
					$this->cart->product_name_rules = '[:print:]';
					$this->cart->insert($data);
				}
			} else {

				$ses_list = $this->session->userdata('tours_data');
				$add_tour = 0;
				if (array_key_exists('add_tour_booking_detail', $ses_list)) {
					if ($ses_list['add_tour_booking_detail']) {
						$add_tour++;
					}
					unset($ses_list['add_tour_booking_detail']);
				}
				$update_tour = 0;
				if (array_key_exists('edit_tour_booking_detail', $ses_list)) {
					if ($ses_list['edit_tour_booking_detail']) {
						$update_tour++;
					}
					unset($ses_list['edit_tour_booking_detail']);
				}
				$ses_list['tour_upgrades'] = array();
				$ses_list['total_tour_upgrades_price'] =  0;
				$ses_list['tour_upgrades_passenger_detail'] = array();
				$this->session->set_userdata('tours_data', $ses_list);
				$tour_session_list = $this->session->userdata('tours_data');
				$data = array(
					'id'      => $tour_session_list['toursData']['tour_id'],
					'qty'     => 1,
					'price'   => $tour_session_list['total_rate'],
					'name'    => $tour_session_list['toursData']['title'],
					'tours_detail_data' => $tour_session_list
				);
				$is_tourId = 0;
				if (count($this->cart->contents()) > 0) {
					foreach ($this->cart->contents() as $c) {
						if (array_key_exists('tours_detail_data', $c)) {
							if ($c['id'] == $data['id']) {
								$data = $this->cart->update(array(
									'rowid' => $c['rowid'],
									'price'   => $tour_session_list['total_rate'] + $this->input->post('total_tour_upgrades_price'),
									'name'    => $tour_session_list['toursData']['title'],
									'tours_detail_data' => $tour_session_list
								));
								$this->cart->product_name_rules = '[:print:]';
								$this->cart->update($data);
								$is_tourId = 1;
							}
						}
					}
				}
				if ($is_tourId == 0) {
					//$this->cart->destroy();
					$this->cart->product_name_rules = '[:print:]';
					$this->cart->insert($data);
				}
			}
			if ($tour_session_list['total_passenger'] > 1) {
				$person = " Persons";
			} else {
				$person = " Person";
			}
			if ($update_tour > 0) {
				set_alert('success', "Tour <b>" . $tour_session_list['toursData']['title'] . "</b> for <b>" . $tour_session_list['total_passenger'] . $person . "</b> successfully updated to your cart.");
			} elseif ($add_tour > 0) {
				set_alert('success', "Tour <b>" . $tour_session_list['toursData']['title'] . "</b> for <b>" . $tour_session_list['total_passenger'] . $person . "</b> successfully added to your cart.");
			}
			//print_r($this->cart->contents());
			//$this->session->unset_userdata('tours_data');
			redirect('summary');
			exit;
		} else {

			$ses_list = $this->session->userdata('tours_data');
			$add_tour = 0;
			if (array_key_exists('add_tour_booking_detail', $ses_list)) {
				if ($ses_list['add_tour_booking_detail']) {
					$add_tour++;
				}
				unset($ses_list['add_tour_booking_detail']);
			}
			$update_tour = 0;
			if (array_key_exists('edit_tour_booking_detail', $ses_list)) {
				if ($ses_list['edit_tour_booking_detail']) {
					$update_tour++;
				}
				unset($ses_list['edit_tour_booking_detail']);
			}
			$ses_list['tour_upgrades'] = array();
			$ses_list['total_tour_upgrades_price'] =  0;
			$ses_list['tour_upgrades_passenger_detail'] = array();
			$this->session->set_userdata('tours_data', $ses_list);
			$tour_session_list = $this->session->userdata('tours_data');
			$data = array(
				'id'      => $tour_session_list['toursData']['tour_id'],
				'qty'     => 1,
				'price'   => $tour_session_list['total_rate'],
				'name'    => $tour_session_list['toursData']['title'],
				'tours_detail_data' => $tour_session_list
			);
			$is_tourId = 0;
			if (count($this->cart->contents()) > 0) {
				foreach ($this->cart->contents() as $c) {
					if (array_key_exists('tours_detail_data', $c)) {
						if ($c['id'] == $data['id']) {
							$data = $this->cart->update(array(
								'rowid' => $c['rowid'],
								'price'   => $tour_session_list['total_rate'] + $this->input->post('total_tour_upgrades_price'),
								'name'    => $tour_session_list['toursData']['title'],
								'tours_detail_data' => $tour_session_list
							));
							$this->cart->product_name_rules = '[:print:]';
							$this->cart->update($data);
							$is_tourId = 1;
							$update_tour++;
						}
					}
				}
			}
			if ($is_tourId == 0) {
				//$this->cart->destroy();
				$this->cart->product_name_rules = '[:print:]';
				$this->cart->insert($data);
			}
			//$this->session->unset_userdata('tours_data');
			if ($tour_session_list['total_passenger'] > 1) {
				$person = " Persons";
			} else {
				$person = " Person";
			}
			if ($update_tour > 0) {
				set_alert('success', "Tour <b>" . $tour_session_list['toursData']['title'] . "</b> for <b>" . $tour_session_list['total_passenger'] . $person . "</b> successfully updated to your cart.");
			} elseif ($add_tour > 0) {
				set_alert('success', "Tour <b>" . $tour_session_list['toursData']['title'] . "</b> for <b>" . $tour_session_list['total_passenger'] . $person . "</b> successfully added to your cart.");
			}
			redirect('summary');
			exit;
		}
	}
}
