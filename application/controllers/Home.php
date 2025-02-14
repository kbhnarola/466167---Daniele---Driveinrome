<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends Frontend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('frontend/home_model', 'home');
		$this->load->model('Cms_model', 'cms_model');
		$this->load->model('Cms_page_static_text', 'cms_static_model');
		$this->load->model('Tours_model', 'tours');
		$this->load->model('Review_model', 'reviews');
	}
	public function index()
	{
		$data['title'] = 'Home';
		$home_meta_details = $this->cms_model->get_by(array("id" => 10));
		if (is_array($home_meta_details) && sizeof($home_meta_details) > 0) {
			if ($home_meta_details['meta_title']) {
				$data['title'] = $home_meta_details['meta_title'];
				//$data['title']="Home";
			} else {
				$data['title'] = "Best Private Shore Excursions of Rome";
				//$data['title']="Home";
			}
			if ($home_meta_details['meta_description']) {
				$data['meta_description'] = $home_meta_details['meta_description'];
			} else {
				$data['meta_description'] = "Explore the beauty of Italy. Discover the best Italian destinations with our private shore tours and land excursions to Rome, Tuscan and more.";
			}
			if ($home_meta_details['meta_keyword']) {
				$data['meta_keyword'] = $home_meta_details['meta_keyword'];
			} else {
				$data['meta_keyword'] = "shore excursions Civitavecchia, excursion rome, excursion, limousine tour of Rome, Pompeii tours, shore excursions Naples, shore excursions Naples Sorrento, shore excursion Palermo, shore excursion, shore, private, private excursion, Positano, Florence tour, Amalfi Coast tour, Rome excursions, Rome tour, private sightseeing";
			}
		} else {
			$data['title'] = "Best Private Shore Excursions of Rome";
			//$data['title']="Home";
			$data['meta_keyword'] = "shore excursions Civitavecchia, excursion rome, excursion, limousine tour of Rome, Pompeii tours, shore excursions Naples, shore excursions Naples Sorrento, shore excursion Palermo, shore excursion, shore, private, private excursion, Positano, Florence tour, Amalfi Coast tour, Rome excursions, Rome tour, private sightseeing";
			$data['meta_description'] = "Explore the beauty of Italy. Discover the best Italian destinations with our private shore tours and land excursions to Rome, Tuscan and more.";
		}
		//$data['meta_description'] = 'Shore excursions Civitavecchia, Italy limousine services for taxi excursion in Rome, limousine tour of Rome. Pompeii tours, shore excursions Naples and Sorrento, shore excursion of Palermo, Positano, Florence, Amalfi Coast tour, Rome excursions, Rome tour, airport transfers, private sightseeing';
		//$data['meta_keyword'] = 'shore excursions civitavecchia Italy limousine services,limousine,limo, excursion rome, excursion,rome, limousine tour of Rome,tour, Pompeii tours, shore excursions Naples, shore excursions Naples Sorrento, shore excursion Palermo, shore excursion, shore, private, private excursion, Positano, Florence tour, Amalfi Coast tour, Rome excursions, Rome tour, private sightseeing';
		$limit_top_selling_product = get_settings('top_selling_product_limit');
		$data['tours_list'] = $this->home->get_top_selling_tours($limit_top_selling_product);
		$this->load->frontpage('frontpages', 'home', $data);
	}
	public function travel_landing_page()
	{
		$data['title'] = "Travel Agent Landing Page";
		$data['travel_landing_page_details'] = $this->cms_model->get_by(array('id' => 11));
		$data['travel_static_content'] = $this->cms_static_model->get_many_by(array('page_id' => 11));
		if (is_array($data['travel_landing_page_details']) && sizeof($data['travel_landing_page_details']) > 0) {
			if ($data['travel_landing_page_details']['meta_title']) {
				$data['title'] = $data['travel_landing_page_details']['meta_title'];
			}
			$data['meta_description'] = $data['travel_landing_page_details']['meta_description'];
			$data['meta_keyword'] = $data['travel_landing_page_details']['meta_keyword'];
		} else {
			$data['meta_description'] = "";
			$data['meta_keyword'] = "";
		}
		$data['header_banner'] = 'no';
		$this->load->frontpage('frontpages', 'travel_landing_page', $data);
	}
	public function send_affiliate_data()
	{

		if($this->input->post('g-recaptcha-response')){

			$secret_key = get_settings('gr_secret_key');
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) .  '&response=' . urlencode($this->input->post('g-recaptcha-response'));

			$response = file_get_contents($url);
			$response_keys = json_decode($response,true);
			
			if($response_keys["success"]) {

				$this->form_validation->set_rules('ta_name', 'Name', 'trim|required');
				$this->form_validation->set_rules('ta_email', 'Email', 'trim|required');
				$this->form_validation->set_rules('ta_phone', 'Phone', 'trim|required');
				$this->form_validation->set_rules('ta_confirm_email', 'Confirm Email', 'trim|required|matches[ta_email]');
				$this->form_validation->set_rules('ta_company_name', 'Company name', 'trim|required');
				//$this->form_validation->set_rules('ta_company_website', 'Company website', 'trim|required');
				$this->form_validation->set_rules('ta_iatacode', 'IATA code', 'trim|required');
				$this->form_validation->set_rules('ta_notes', 'Notes', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$ret_response['flag'] = false;
					if (is_array(validation_errors())) {
						$ret_response['msg'] = current(validation_errors());
					} else {
						$ret_response['msg'] = validation_errors();
					}
					//$response['msg']="All fields are required";
				} else {
					$ta_name = $this->input->post('ta_name');
					$ta_email = $this->input->post('ta_email');
					$ta_phone = $this->input->post('ta_phone');
					$ta_confirm_email = $this->input->post('ta_confirm_email');
					$ta_company_name = $this->input->post('ta_company_name');
					$ta_company_website = $this->input->post('ta_company_website');
					$ta_iatacode = $this->input->post('ta_iatacode');
					$ta_notes = nl2br($this->input->post('ta_notes'));
					$placeholder = $form_data = array();
					$email_subject = 'Driver In Rome';
					$get_email_template = get_email_template('travel-agent-landing-page');
					$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';
					if (!empty($get_email_template['subject'])) {
						$email_subject = $get_email_template['subject'];
					}
					// replace eplaceholder with te actual form data
					$placeholder = ['{name}', '{email}', '{phone}', '{company_name}', '{company_website}', '{iata_code}', '{message}', '{welcome_image}'];
					$form_data   = [ucwords(trim($ta_name)), trim($ta_email), trim($ta_phone), trim($ta_company_name), trim($ta_company_website), trim($ta_iatacode), trim($ta_notes), EMAIL_WELCOME_PNG];
					$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);
					$data['email_body'] = $get_new_email_body;
					$data['subject'] = $email_subject;
					if (email_sending($to = 'dnp@narola.com', $data, 'travel-agent-landing-page')) {
						$ret_response['flag'] = true;
						$ret_response['msg'] = 'Sent successfully.';
					} else {
						$ret_response['flag'] = false;
						$ret_response['msg'] = 'Something went wrong.';
					}
				}
				echo json_encode($ret_response);
				exit;
			}
		}
	}
	public function custom_booking_page()
	{
		$data['title'] = "Custom Booking";
		$data['meta_description'] = "";
		$data['meta_keyword'] = "";
		$data['header_banner'] = 'no';
		$this->load->frontpage('frontpages', 'custom_booking', $data);
	}
	public function send_custombooking_data()
	{
		$this->form_validation->set_rules('cb_firstname', 'First name', 'trim|required');
		$this->form_validation->set_rules('cb_lastname', 'Last name', 'trim|required');
		$this->form_validation->set_rules('cb_email', 'Email', 'trim|required');
		$this->form_validation->set_rules('cb_confirmemail', 'Confirm Email', 'trim|required|matches[cb_email]');
		$this->form_validation->set_rules('cb_needs', 'Special needs', 'trim|required');
		$this->form_validation->set_rules('cb_foundus', 'Found us', 'trim|required');
		$this->form_validation->set_rules('cb_travellingphone', 'Phone number', 'trim|required');
		$this->form_validation->set_rules('nameoncard', 'Name on card', 'trim|required');
		$this->form_validation->set_rules('cb_cardnumber', 'Card number', 'trim|required');
		$this->form_validation->set_rules('cb_expirymonth', 'Expiry month', 'trim|required');
		$this->form_validation->set_rules('cb_expiryyear', 'Expiry Year', 'trim|required');
		$this->form_validation->set_rules('cb_address', 'Address', 'trim|required');
		$this->form_validation->set_rules('cb_cardcvv', 'CVV', 'trim|required');
		$this->form_validation->set_rules('cb_country', 'Country', 'trim|required');
		$this->form_validation->set_rules('cb_city', 'City', 'trim|required');
		$this->form_validation->set_rules('cb_zipcode', 'Zipcode', 'trim|required');
		$this->form_validation->set_rules('cancellation_policy', 'Cancellation policy', 'trim|required');
		$this->form_validation->set_rules('privacy_policy', 'Privacy policy', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$response['success'] = false;
			if (is_array(validation_errors())) {
				$response['msg'] = current(validation_errors());
			} else {
				$response['msg'] = validation_errors();
			}
			//$response['msg']="All fields are required";
		} else {
			$cb_firstname = $this->input->post('cb_firstname');
			$cb_lastname = $this->input->post('cb_lastname');
			$cb_email = $this->input->post('cb_email');
			$cb_needs = $this->input->post('cb_needs');
			$cb_foundus = $this->input->post('cb_foundus');
			$cb_travellingphone = $this->input->post('cb_travellingphone');
			$nameoncard = $this->input->post('nameoncard');
			$cb_cardnumber = $this->input->post('cb_cardnumber');
			$cb_expirymonth = $this->input->post('cb_expirymonth');
			$cb_expiryyear = $this->input->post('cb_expiryyear');
			$cb_address = $this->input->post('cb_address');
			$cb_cardcvv = $this->input->post('cb_cardcvv');
			$cb_country = $this->input->post('cb_country');
			$cb_city = $this->input->post('cb_city');
			$cb_zipcode = $this->input->post('cb_zipcode');
			$placeholder = $form_data = array();
			$email_subject = 'Driver In Rome';
			$get_email_template = get_email_template('custom-booking');
			$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';
			if (!empty($get_email_template['subject'])) {
				$email_subject = $get_email_template['subject'];
			}
			// replace placeholder with te actual form data
			$placeholder = ['{name}', '{email}', '{special_needs}', '{found_us}', '{phone_no}', '{name_on_card}', '{card_number}', '{expiry_month}', '{expiry_year}', '{card_cvv}', '{address}', '{city}', '{country}', '{zip_code}'];
			$form_data   = [ucfirst(trim($cb_firstname)) . ' ' . ucfirst(trim($cb_lastname)), trim($cb_email), trim($cb_needs), trim($cb_foundus), trim($cb_travellingphone), ucwords(trim($nameoncard)), trim($cb_cardnumber), trim($cb_expirymonth), trim($cb_expiryyear), trim($cb_cardcvv), trim($cb_address), trim($cb_city), trim($cb_country), trim($cb_zipcode)];
			$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);
			$data['email_body'] = $get_new_email_body;
			$data['subject'] = $email_subject;
			// echo $get_email_body;
			// exit;
			if (email_sending($to = '', $data, 'custom-booking')) {
				$response['success'] = true;
				// send email to user
				$email_data['full_name'] = ucfirst(trim($cb_firstname)) . ' ' . ucfirst(trim($cb_lastname));
				$email_data['email'] = trim($cb_email);
				$email_data['phone_no'] = trim($cb_travellingphone);
				$email_data['special_needs'] = trim($cb_needs);
				$email_data['found_us'] =  trim($cb_foundus);
				$email_data['address'] =  trim($cb_address);
				$email_data['country'] =  trim($cb_country);
				$email_data['city'] =  trim($cb_city);
				$email_data['zipcode'] =  trim($cb_zipcode);
				$mail_content = $this->load->view('email_template/custom-booking', $email_data, TRUE);
				$to = trim($cb_email);
				$data['email_body'] = $mail_content;
				$data['subject'] = SITE_TITLE . ' | We have received your Itinerary';
				email_sending($to, $data, 'custom-booking', $bcc = TRUE);
				// START add user details into active campaign automation
				$custom_booking_active_campaign = get_settings('custom_booking_active_campaign') ? get_settings('custom_booking_active_campaign') : DEFAULT_ACTIVE_CAMPAIGN_ID;
				$post_data = array('username' => $email_data['full_name'], 'user_email' => $cb_email, 'active_campaign_automation_id' => $custom_booking_active_campaign);
				$api_campaign_response = api_campaign($post_data, $add_automation = false);
				// END add user details into active campaign automation
			} else {
				$response['success'] = false;
			}
		}
		echo json_encode($response);
		exit;
	}
	public function tour_landing_page()
	{
		$data['title'] = "Tour landing page";
		$data['meta_description'] = "";
		$data['meta_keyword'] = "";
		$data['header_banner'] = 'no';
		$page_slug = $this->uri->segment(2);
		if ($page_slug) {
			$cms_page_data = $this->cms_model->get_by(array('slug' => $page_slug, 'status' => 1));
			if (is_array($cms_page_data) && sizeof($cms_page_data) > 0) {
				$data['cms_page_data'] = $cms_page_data;
				if ($cms_page_data['meta_title']) {
					$data['title'] = $cms_page_data['meta_title'];
				}
				$data['meta_description'] = $cms_page_data['meta_description'];
				$data['meta_keyword'] = $cms_page_data['meta_keyword'];
				$data['cms_static_content'] = $this->cms_static_model->get_many_by(array('page_id' => $cms_page_data['id']));
				$data['reviews'] = $this->reviews->get_many_by(array("is_draft" => 0));
				$this->load->frontpage('frontpages', 'tour_landing_page', $data);
			} else {
				set_alert('error', "Records Not Found");
				redirect("");
				exit;
			}
		} else {
			redirect("");
			exit;
		}
	}
	public function send_lp_data()
	{
		$this->form_validation->set_rules('lp_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('lp_email', 'Email', 'trim|required');
		$this->form_validation->set_rules('lp_confirm_email', 'Confirm Email', 'trim|required|matches[lp_email]');
		$this->form_validation->set_rules('lp_phone', 'Phone number', 'trim|required');
		$this->form_validation->set_rules('lp_notes', 'Notes', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$response['success'] = false;
			if (is_array(validation_errors())) {
				$response['msg'] = current(validation_errors());
			} else {
				$response['msg'] = validation_errors();
			}
			//$response['msg']="All fields are required";
		} else {
			$lp_name = $this->input->post('lp_name');
			$lp_email = $this->input->post('lp_email');
			$lp_phone = $this->input->post('lp_phone');
			$lp_notes = nl2br($this->input->post('lp_notes'));
			$placeholder = $form_data = array();
			$email_subject = 'Driver In Rome';
			$get_email_template = get_email_template('tour-landing-page');
			$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';
			if (!empty($get_email_template['subject'])) {
				$email_subject = $get_email_template['subject'];
			}
			// replace eplaceholder with te actual form data
			$placeholder = ['{name}', '{email}', '{phone_number}', '{notes}'];
			$form_data   = [ucwords(trim($lp_name)), trim($lp_email), trim($lp_phone), trim($lp_notes)];
			$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);
			$data['email_body'] = $get_new_email_body;
			$data['subject'] = $email_subject;
			if (email_sending($to = '', $data, 'tour-landing-page')) {
				$response['success'] = true;
			} else {
				$response['success'] = false;
			}
		}
		echo json_encode($response);
		exit;
	}


	public function indian_shore_excursions_tours(){
		$data['title'] = "Indian Shore Excursions Tours";
		$this->hore_excursions_tours();
	}	

	public function chinese_shore_excursions_tours(){
		$data['title'] = "chinese Shore Excursions Tours";
		$this->hore_excursions_tours();
	}

	public function jappanese_shore_excursions_tours(){
		$data['title'] = "Jappanese Shore Excursions Tours";
		$this->hore_excursions_tours();
	}

	public function russian_shore_excursions_tours(){
		$data['title'] = "Russian Shore Excursions Tours";
		$this->hore_excursions_tours();
	}

	public function thai_shore_excursions_tours(){
		$data['title'] = "Thai Shore Excursions Tours";
		$this->hore_excursions_tours();
	}

	public function hore_excursions_tours(){
		$data['meta_description'] = "";
		$data['meta_keyword'] = "";
		$data['header_banner'] = 'no';
		$page_slug = $this->uri->segment(1);

		// $page_slug = str_replace('-', '_', $page_slug);
		if ($page_slug) {
			$cms_page_data = $this->cms_model->get_by(array('slug' => $page_slug, 'status' => 1));
			if (is_array($cms_page_data) && sizeof($cms_page_data) > 0) {

				$data['cms_page_data'] = $cms_page_data;
				if ($cms_page_data['meta_title']) {
					$data['title'] = $cms_page_data['meta_title'];
				}
				$data['meta_description'] = $cms_page_data['meta_description'];
				$data['meta_keyword'] = $cms_page_data['meta_keyword'];
				$data['cms_static_content'] = $this->cms_static_model->get_many_by(array('page_id' => $cms_page_data['id']));
				$data['reviews'] = $this->reviews->get_many_by(array("is_draft" => 0));
				$this->load->frontpage('frontpages', 'shore_excursions_tours_page', $data);
			} else {
				set_alert('error', "Records Not Found");
				redirect("");
				exit;
			}
		} else {
			redirect("");
			exit;
		}
	}

}