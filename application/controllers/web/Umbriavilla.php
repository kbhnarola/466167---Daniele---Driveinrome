<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Umbriavilla extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->library('cart');
		$this->load->model('Umbriavilla_model', 'umbriavilla_model');
		$this->load->model('Overview_model', 'overview_model');
		$this->load->model('FAQ_model', 'faq_model');
		$this->load->model('Photos_model', 'photos_model');
		$this->load->model('Experiences_model', 'experiences_model');
		$this->load->model('Availability_model', 'availability_model');
		// $this->load->model('frontend/common_model', 'common');
	}
	public function index()
	{
		$data['title'] = 'Umbria Villa';
		$data['header_banner'] = 'no';
		$data['umbriavilla_banner_detals'] = $this->umbriavilla_model->get_umbriavilla_details('umbriavilla_banner_detals');
		$data['owner_details'] = $this->umbriavilla_model->get_umbriavilla_details('owner_details');
		$data['terms_condtion'] = $this->umbriavilla_model->get_umbriavilla_details('terms_condtion');
		$data['footer_details'] = $this->umbriavilla_model->get_umbriavilla_details('footer_details');
		$data['location_details'] = $this->umbriavilla_model->get_umbriavilla_details('location_details');
		$data['overview_title'] = $this->umbriavilla_model->get_umbriavilla_details('overview_title');
		$data['experiences_title'] = $this->umbriavilla_model->get_umbriavilla_details('experiences_title');
		$data['experiences_status'] = $this->umbriavilla_model->get_umbriavilla_details('experiences_status');
		$data['umbriavilla_inquire_details'] = $this->umbriavilla_model->get_umbriavilla_details('umbriavilla_inquire_details');
		$data['ApiKey'] = $this->umbriavilla_model->get_umbriavilla_details('ApiKey');
		$data['availability_details'] = $this->umbriavilla_model->get_umbriavilla_details('availability_details');
		$data['faqs'] = $this->faq_model->get_faq_details_web();
		$data['availability_rates'] = $this->availability_model->get_availability_rates();
		$data['non_highlights'] = $this->overview_model->get_overviews_details('non_highlight');
		$data['proper_highlights'] = $this->overview_model->get_overviews_details('proper_highlight');
		$data['photos'] = $this->photos_model->get_photos_web();
		$data['experiences'] = $this->experiences_model->get_experiences_web();
		$data['title'] = ($data['umbriavilla_banner_detals']) ? $data['umbriavilla_banner_detals']['title'] : 'Umbria Villa';
		$this->load->frontpage('frontpages', 'umbriavilla', $data);
		$this->load->view('frontpages/umbriavilla');
	}

	public function load_experiences()
	{
		$experiences = $this->experiences_model->get_experiences_web();
		foreach ($experiences as &$experience) {
			$experience['image'] = base_url('uploads/experiences/images/') . $experience['image'];
			$experience['pdf'] = base_url('uploads/experiences/pdf/') . $experience['pdf'];
		}
		// var_dump($experiences);die;
		$itemsPerPage = 2;
		$page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
		$totalItems = count($experiences);
		$totalPages = ceil($totalItems / $itemsPerPage);
		$offset = ($page - 1) * $itemsPerPage;

		$paginatedExperiences = array_slice($experiences, $offset, $itemsPerPage);

		// Return paginated data along with pagination details as JSON
		echo json_encode([
			'experiences' => $paginatedExperiences,
			'currentPage' => $page,
			'totalPages' => $totalPages
		]);
		exit;
	}


	public function get_availability_dates()
{
    $month = $this->input->get('month');
    $year = $this->input->get('year');
    
    // Fetch dates from the model
    $dates = $this->availability_model->get_dates($month, $year);
    
    // For debugging purposes, log the response or inspect it
    log_message('debug', 'Available Dates: ' . print_r($dates, true));  // Log the array of dates
    
    // Make sure we are encoding the data properly
    echo json_encode($dates);  // Return the dates in JSON format
    exit;  // Ensure no extra output is sent after this point
}

	public function inquire_villa()
	{
		if($this->input->post('g-recaptcha-response'))
		{
			$secret_key = RE_CAPTCHA_V3_SECRET_KEY ;
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) .  '&response=' . urlencode($this->input->post('g-recaptcha-response'));

			$response 				= file_get_contents($url);
			$response_keys 			= json_decode($response,true);
			$msg = 'Something went wrong, while subscribe user';
			if($response_keys["success"]) {
				$email = $this->input->post('inquireemail');
				
				// START add user details into active campaign automation for villa inquiry
				// $quick_quote_active_campaign = get_settings('quick_quote_active_campaign') ? get_settings('quick_quote_active_campaign') : DEFAULT_ACTIVE_CAMPAIGN_ID;
				$villa_inquiry_active_campaign = VILLA_INQUIRY_ACTIVE_CAMPAIGN_ID;
				$post_data = array('username' => $email, 'user_email' => $email, 'active_campaign_automation_id' => $villa_inquiry_active_campaign);
				$api_campaign_response = api_campaign($post_data, $add_automation = true);
				if($api_campaign_response['statusCode'] == 1){
					$msg = 'Thank you for your inquiry! We will get back to you shortly.';
					echo json_encode(array('status' => true, 'msg' => $msg));
				}else{
					echo json_encode(array('status' => false, 'msg' => $api_campaign_response['message']));					
				}
				// END add user details into active campaign automation for villa inquiry				
			}else{
				$msg = "reCAPTCHA verification failed. Please try again.";
				echo json_encode(array('status' => false, 'msg' => $msg));
			}
		}else{
			$msg = "reCAPTCHA Not found";
			echo json_encode(array('status' => false, 'msg' => $msg));
		}
	}
}
?>