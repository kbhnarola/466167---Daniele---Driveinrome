<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->library('cart');
		$this->load->model('Users_model', 'users_model');
		$this->load->model('frontend/welcome_model', 'welcome');
		// $this->load->model('frontend/common_model', 'common');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function send_quick_quote_details()
	{

		$email_subject = 'Driver In Rome';
		$get_email_template = get_email_template('quick-quote');

		$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';

		if (!empty($get_email_template['subject'])) {
			$email_subject = $get_email_template['subject'];
		}
		$placeholder = ['{name}', '{email}', '{phone}', '{find_us}', '{notes}', '{welcome_image}'];
		$form_data   = [ucwords(trim($_POST['qfullname'])), trim($_POST['qemail']), trim($_POST['qphoneNumber']), trim($_POST['howDidFind']), trim($_POST['notes']), EMAIL_WELCOME_PNG];

		$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);

		$data['email_body'] = $get_new_email_body;
		$data['subject'] = $email_subject;

		email_sending(trim($_POST['qemail']), $data, 'quick_quote');
		// START add user details into active campaign automation
		$quick_quote_active_campaign = get_settings('quick_quote_active_campaign') ? get_settings('quick_quote_active_campaign') : DEFAULT_ACTIVE_CAMPAIGN_ID;
		$post_data = array('username' => $_POST['qfullname'], 'user_email' => $_POST['qemail'], 'active_campaign_automation_id' => $quick_quote_active_campaign);
		$api_campaign_response = api_campaign($post_data, $add_automation = false);
		// END add user details into active campaign automation

		echo email_sending($to = '', $data, 'quick_quote');
	}
	public function send_contact_us_details()
	{
		$placeholder = $form_data = array();
		$email_subject = 'Driver In Rome';
		$get_email_template = get_email_template('contact-us');

		$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';

		if (!empty($get_email_template['subject'])) {
			$email_subject = $get_email_template['subject'];
		}

		// replace eplaceholder with te actual form data
		$placeholder = ['{name}', '{email}', '{phone}', '{how_did_you_find_us}',  '{number_of_passenger}', '{message}', '{welcome_image}', '{origin}'];
		$form_data   = [ucwords(trim($_POST['fullname'])), trim($_POST['email']), trim($_POST['phoneNumber']), trim($_POST['how_did_you_find_us']), trim($_POST['noOfPassenger']), trim($_POST['message']), EMAIL_WELCOME_PNG, '<a href="' . $_POST['origin'] . '">' . $_POST['origin'] . '</a>'];

		// START add user details into active campaign automation
		$contact_form_active_campaign = get_settings('contact_form_active_campaign') ? get_settings('contact_form_active_campaign') : DEFAULT_ACTIVE_CAMPAIGN_ID;
		$post_data = array('username' => $_POST['fullname'], 'user_email' => $_POST['email'], 'active_campaign_automation_id' => $contact_form_active_campaign);
		$api_campaign_response = api_campaign($post_data, $add_automation = false);
		// END add user details into active campaign automation

		$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);

		$data['email_body'] = $get_new_email_body;
		$data['subject'] = $email_subject;

		echo email_sending($to = '', $data, 'contact_us');
	}
	public function send_email_to_admin_for_subscribe_newsletter()
	{
		$placeholder = $form_data = array();
		$email_subject = 'Driver In Rome';
		$get_email_template = get_email_template('subscribe-newsletter');

		$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';

		if (!empty($get_email_template['subject'])) {
			$email_subject = $get_email_template['subject'];
		}

		// replace eplaceholder with te actual form data
		$placeholder = ['{email}'];
		$form_data   = [trim($_POST['subscribeemail'])];

		$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);

		$data['email_body'] = $get_new_email_body;
		$data['subject'] = $email_subject;

		// Prepare data for DB insertion
		$where = array(
			'email' => trim($_POST['subscribeemail'])
		);
		$already_subscribed = $send_subscribe_email = false;
		$existing_user = $this->welcome->get_users($where);
		// print_r($existing_user);die;
		$defult_token = md5($_POST['subscribeemail'] . time());
		if (count($existing_user) > 0) {
			$sub_user = array(
				'subscribe' => 1,
				'email' => trim($_POST['subscribeemail'])
			);
			$check_if_user_subscribed = $this->welcome->get_users($sub_user);
			if (count($check_if_user_subscribed) > 0) {
				$already_subscribed = true;
				$msg = 'You are already subscribed with our newsletter!';
			} else {
				// Update user data
				$sub_user = array(
					'email' => trim($_POST['subscribeemail']),
					'subscribe' => 1,
					'token' => $defult_token,
				);
				$update = $this->welcome->update_user($existing_user[0]['id'], $sub_user);
				$msg = 'You have successfully subscribed to our newsletter!';
				$send_subscribe_email = true;
			}
		} else {
			// Prepare data for DB insertion
			$userData = array(
				'email' => trim($_POST['subscribeemail']),
				'token' => $defult_token,
				'send_subscribe_email' => 1
			);
			// Insert user data
			$insert = $this->welcome->insert_user($userData);
			$msg = 'You have successfully subscribed to our newsletter!';
			$send_subscribe_email = true;
		}
		// send sunbscribe newsletter email to user
		if ($send_subscribe_email) {
			$email_subject = 'Driver In Rome | Subscribe Newsletter';
			$email_template_name = 'user-subscribe-newsletter';

			$get_email_template = get_email_template('user-subscribe-newsletter');

			if (!empty($get_email_template['subject'])) {
				$email_subject = $get_email_template['subject'];
			}
			$placeholder = ['{username}', '{welcome_image}'];
			$form_data   = ['User', EMAIL_WELCOME_PNG];

			$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';

			$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);

			$data['email_body'] = $get_new_email_body;
			$data['subject'] = $email_subject;

			email_sending(trim($_POST['subscribeemail']), $data, $email_template_name);
		}
		email_sending($to = '', $data, 'contact_us');
		echo json_encode(array('status' => true, 'msg' => $msg, 'already_subscribed' => $already_subscribed));
	}
	public function send_email_to_admin_for_get_a_call_details()
	{
		$placeholder = $form_data = array();
		$email_subject = 'Driver In Rome';
		$user_email_subject = 'Driver In Rome';
		$get_email_template = get_email_template('get-call');
		$get_user_email_template = get_email_template('get-call-user');

		$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';
		$get_user_email_body = (!empty($get_user_email_template['message'])) ? $get_user_email_template['message'] : '';

		if (!empty($get_email_template['subject'])) {
			$email_subject = $get_email_template['subject'];
		}
		if (!empty($get_user_email_template['subject'])) {
			$user_email_subject = $get_user_email_template['subject'];
		}

		// replace eplaceholder with te actual form data
		$placeholder = ['{fullname}', '{email}', '{phone}', '{city}', '{country}', '{best_time_to_called_back}'];
		$form_data   = [trim($_POST['callfullname']), trim($_POST['callemail']), trim($_POST['callphoneNumber']), trim($_POST['callcity']), trim($_POST['callcountry']), trim($_POST['besttimecall'])];

		$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);
		$get_new_user_email_body = str_replace($placeholder, $form_data, $get_user_email_body);

		$data['email_body'] = $get_new_email_body;
		$data['subject'] = $email_subject;

		email_sending($to = '', $data, 'dummy');
		// send to user		
		$data['email_body'] = $get_new_user_email_body;
		$data['subject'] = $user_email_subject;
		echo email_sending($to = trim($_POST['callemail']), $data, 'dummy');
	}
	public function about_us()
	{
		$data['about_us_details'] = $this->welcome->get_cms_page_details($page_id = 1);
		$data['title'] = $data['about_us_details']['meta_title'];
		$data['meta_description'] = $data['about_us_details']['meta_description'];
		$data['meta_keyword'] = $data['about_us_details']['meta_keyword'];
		$this->load->frontpage('frontpages', 'about_us', $data);
	}
	public function fleet()
	{
		$data['fleet_details'] = $this->welcome->get_cms_page_details($page_id = 9);
		// $data['fleet_details'] = $this->welcome->get_cms_page_details($page_id = 9);
		$data['title'] = $data['fleet_details']['meta_title'];
		$data['meta_description'] = $data['fleet_details']['meta_description'];
		$data['meta_keyword'] = $data['fleet_details']['meta_keyword'];
		$data['header_banner'] = 'no';
		$this->load->frontpage('frontpages', 'fleet', $data);
	}
	public function cancellation_policy()
	{
		$data['cancellation_policy_details'] = $this->welcome->get_cms_page_details($page_id = 6);
		$data['title'] = $data['cancellation_policy_details']['meta_title'];
		$data['meta_description'] = $data['cancellation_policy_details']['meta_description'];
		$data['meta_keyword'] = $data['cancellation_policy_details']['meta_keyword'];
		$data['header_banner'] = 'no';
		$this->load->frontpage('frontpages', 'cancellation_policy', $data);
	}
	public function our_guarantee()
	{
		$data['our_guarantee_details'] = $this->welcome->get_cms_page_details($page_id = 7);
		$data['title'] = $data['our_guarantee_details']['meta_title'];
		$data['meta_description'] = $data['our_guarantee_details']['meta_description'];
		$data['meta_keyword'] = $data['our_guarantee_details']['meta_keyword'];
		$data['header_banner'] = 'no';
		$this->load->frontpage('frontpages', 'our_guarantee', $data);
	}
	public function airport_meeting_instructions()
	{
		$data['airport_meeting_instructions_details'] = $this->welcome->get_cms_page_details($page_id = 3);
		$data['title'] = $data['airport_meeting_instructions_details']['meta_title'];
		$data['meta_description'] = $data['airport_meeting_instructions_details']['meta_description'];
		$data['meta_keyword'] = $data['airport_meeting_instructions_details']['meta_keyword'];
		$data['header_banner'] = 'no';
		$this->load->frontpage('frontpages', 'airport_meeting_instructions', $data);
	}
	public function cruise_arrival_instructions()
	{
		$data['cruise_arrival_instructions_details'] = $this->welcome->get_cms_page_details($page_id = 8);
		$data['title'] = $data['cruise_arrival_instructions_details']['meta_title'];
		$data['meta_description'] = $data['cruise_arrival_instructions_details']['meta_description'];
		$data['meta_keyword'] = $data['cruise_arrival_instructions_details']['meta_keyword'];
		$data['header_banner'] = 'no';
		$this->load->frontpage('frontpages', 'cruise_arrival_instructions', $data);
	}
	public function privacy_policy()
	{
		$data['privacy_policy_details'] = $this->welcome->get_cms_page_details($page_id = 2);
		$data['title'] = $data['privacy_policy_details']['meta_title'];
		$data['meta_description'] = $data['privacy_policy_details']['meta_description'];
		$data['meta_keyword'] = $data['privacy_policy_details']['meta_keyword'];
		$data['header_banner'] = 'no';
		$this->load->frontpage('frontpages', 'privacy_policy', $data);
	}
	public function shore_excursions($city_slug)
	{
		$data['tour_details'] = $this->welcome->get_tour_list_by_city_slug(($city_slug), array('1', '7'));
		$data['tour_details_type'] = "Shore Excursions";
		$table = TBL_TOUR_CATEGORY;
		$meta_details = $this->welcome->get_meta_description($table, $city_slug);
		$data['title'] = $data['meta_description'] = $data['meta_keyword'] = 'N/A';
		if ($meta_details) {
			$data['title'] = (!empty($meta_details[0]['meta_title'])) ? $meta_details[0]['meta_title'] : 'N/A';
			$data['meta_description'] = $meta_details[0]['meta_description'];

			$data['meta_keyword'] = $meta_details[0]['meta_keywords'];
		}
		$this->load->frontpage('frontpages', 'list_of_tours', $data);
	}
	public function city_tours($city_slug)
	{
		$data['tour_details'] = $this->welcome->get_tour_list_by_city_slug(($city_slug), array('3'));
		if (isset($_GET['type']) && $_GET['type'] == 'small-group')
			$data['tour_details'] = $this->welcome->get_tour_list_by_city_slug(($city_slug), array('7'), $is_city_tours = 1);

		$data['tour_details_type'] = "City Tours";
		$table = TBL_TOUR_CATEGORY;
		$meta_details = $this->welcome->get_meta_description($table, $city_slug);
		$data['title'] = $data['meta_description'] = $data['meta_keyword'] = 'N/A';
		if ($meta_details) {
			$data['title'] = (!empty($meta_details[0]['meta_title'])) ? $meta_details[0]['meta_title'] : 'N/A';

			$data['meta_description'] = $meta_details[0]['meta_description'];

			$data['meta_keyword'] = $meta_details[0]['meta_keywords'];
		}
		$this->load->frontpage('frontpages', 'list_of_tours', $data);
	}
	public function transfers($city_slug)
	{
		$data['transfer_details'] = $this->welcome->get_transfers_list_by_city_slug(($city_slug), array('1'));
		$data['transfer_details_type'] = "Transfer";
		$table = TBL_TRANSFER_CATEGORY;
		$meta_details = $this->welcome->get_meta_description($table, $city_slug);
		$data['title'] = $data['meta_description'] = $data['meta_keyword'] = 'N/A';
		if ($meta_details) {
			$data['title'] = (!empty($meta_details[0]['meta_title'])) ? $meta_details[0]['meta_title'] : 'N/A';

			$data['meta_description'] = $meta_details[0]['meta_description'];

			$data['meta_keyword'] = $meta_details[0]['meta_keywords'];
		}
		$this->load->frontpage('frontpages', 'list_of_transfers', $data);
	}
	public function transfer_tours($city_slug)
	{
		$data['tour_details'] = $this->welcome->get_tour_list_by_city_slug(($city_slug), array('9', '10'), '', $is_transfer_tours = true);
		$data['tour_details_type'] = "Transfer Tours";
		$table = TBL_TOUR_CATEGORY;
		$meta_details = $this->welcome->get_meta_description($table, $city_slug);
		$data['title'] = $data['meta_description'] = $data['meta_keyword'] = 'N/A';
		if ($meta_details) {
			$data['title'] = (!empty($meta_details[0]['meta_title'])) ? $meta_details[0]['meta_title'] : 'N/A';
			$data['meta_description'] = $meta_details[0]['meta_description'];
			$data['meta_keyword'] = $meta_details[0]['meta_keywords'];
		}
		$this->load->frontpage('frontpages', 'list_of_transfer_tours', $data);
	}
	public function package_tour($city_slug)
	{
		$data['tour_details'] = $this->welcome->get_tour_list_by_city_slug(($city_slug), array('8'));
		$data['tour_details_type'] = "Package Tours";
		$table = TBL_TOUR_CATEGORY;
		$meta_details = $this->welcome->get_meta_description($table, $city_slug);
		$data['title'] = $data['meta_description'] = $data['meta_keyword'] = 'N/A';
		if ($meta_details) {
			$data['title'] = (!empty($meta_details[0]['meta_title'])) ? $meta_details[0]['meta_title'] : 'N/A';

			$data['meta_description'] = $meta_details[0]['meta_description'];

			$data['meta_keyword'] = $meta_details[0]['meta_keywords'];
		}
		$this->load->frontpage('frontpages', 'list_of_tours', $data);
	}
	public function get_cart_count()
	{
		$cart_count_items = !empty($this->cart->contents()) ? count($this->cart->contents()) : 0;
		echo json_encode(array('status' => true, 'count' => $cart_count_items));
	}
	// cron job for send newsletter to subscriber users
	public function send_newsletter_to_susbscibe_users()
	{
		$this->load->helper('file');
		$email_subject = 'Driver In Rome | Newsletter';
		$email_template_name = 'admin-send-newsletter';
		$get_all_newsletters = $this->welcome->get_newsletter_content();
		// pr($get_all_newsletters);
		// die;
		if (!empty($get_all_newsletters)) {
			foreach ($get_all_newsletters as $single_newsletter) {
				$subject = $single_newsletter['newsletter_subject'];
				$data['title'] = $subject;
				$data['subject'] = $subject;
				$data['newsletter_content'] = $single_newsletter['email_content'];
				//$data['newsletter_content'] = iconv('UTF-8', 'windows-1252', $newsletter_content);
				$data['newsletter_content_more'] = $single_newsletter['newsletter_content_2'];
				//$data['newsletter_content_more'] = iconv('UTF-8', 'windows-1252', $newsletter_content_more);
				$data['tour_image1'] = $single_newsletter['tour_image_1'];
				$tour_image1_url = $single_newsletter['tour_image1_url'];
				$tour_image2_url = $single_newsletter['tour_image2_url'];

				$tour_image1 = $single_newsletter['tour_image_1'];
				$tour_image2 = $single_newsletter['tour_image_2'];

				if ($tour_image1_url) {
					$data['tour_image1_url'] = $tour_image1_url;
				} else {
					$data['tour_image1_url'] = "javascript:";
				}
				$data['tour_image2'] = $tour_image2;
				if ($tour_image2_url) {
					$data['tour_image2_url'] = $tour_image2_url;
				} else {
					$data['tour_image2_url'] = "javascript:";
				}
				$data['username'] = "Customer";


				if ($single_newsletter['name']) {
					$data['username'] = $single_newsletter['name'];
				}
				$url = base_url() . 'unsubscribed/' . $single_newsletter['token'];
				$data['unsubscribe_url'] = $url;

				//echo $user_data['email']." ".$subject."<br>";
				$template_path = 'email_template/';
				$message = $this->load->view($template_path . 'header', $data, TRUE);
				$message .= $this->load->view($template_path . 'admin_newsletter_temp', $data, TRUE);
				$message .= $this->load->view($template_path . 'footer', $data, TRUE);
				// echo $message;
				// email_send($single_newsletter['email'], $subject, $message);
				$data['mail_content'] = $message;
				$data['subject'] = $subject;
				$email_template_name = '';
				if (filter_var($single_newsletter['email'], FILTER_VALIDATE_EMAIL)) {
					if (email_sending($single_newsletter['email'], $data, $email_template_name)) {
						$data    = array('send_subscribe_email' => 1, 'subscribe_email_content' => NULL);
						$this->welcome->update_user($single_newsletter['tbl_user_id'], $data);
						$this->welcome->delete_by($single_newsletter['id']);
						// $this->welcome->update_newsletter($single_newsletter['id']);
					}
				} else {
					$this->welcome->delete_by($single_newsletter['id']);
				}
				sleep(20);
			}
		}
	}
	// blogs
	public function blogs($args = '')
	{
		$this->load->library("pagination");

		$config = array();
		// $data['authors'] = $this->authors_model->get_authors($config["per_page"], $page);
		// $this->load->view('authors/index', $data);	

		$data["per_page"] = 8;
		$data['blog_categories'] = $this->welcome->get_active_categories_of_active_blogs();
		$data['header_banner'] = 'yes';
		// blog listings		
		if (empty($args)) {
			$data['title'] = 'Tour Blogs';
			if (!empty($_GET['s'])) {
				$data['total_blogs'] = count($this->welcome->get_blogs_with_categories('', '', '', $_GET['s']));
				$data['blogs'] = $this->welcome->get_blogs_with_categories('', '', '', $_GET['s'], array('per_page' => $data["per_page"], 'page' => 0));
			} else {
				$data['total_blogs'] = count($this->welcome->get_blogs_with_categories('', '', '', ''));
				$data['blogs'] = $this->welcome->get_blogs_with_categories('', '', '', '', array('per_page' => $data["per_page"], 'page' => 0));
			}
			$data['recent_blogs'] = $this->welcome->get_blogs_with_categories('', '', $limit = true);
			$data['title'] = 'best Rome Tour Blogs| Italy travel guide | DriverInRome';
			$data['meta_description'] = 'From hotel booking to shore excursion in Rome, walking tour to English speaking driver get the best information with DriverInRome tour blogs. Visit now!';
			// $data['meta_keyword'] = $blog_categories_array[0]['meta_keyword'];
			$this->load->frontpage('frontpages', 'blogs', $data);
		}
		// blog by categories
		else if ($args == 'category') {
			$category_slug = strtolower(trim($this->uri->segment(3)));
			$blog_categories_array = $this->welcome->get_blog_category(array('slug' => $category_slug));
			// pr($blog_categories_array);die;
			if (empty($blog_categories_array)) {
				set_alert('error', "Records Not Found");
				redirect('');
			}
			$blog_cat_array = array();
			foreach ($blog_categories_array as $blog_cat) {
				$blog_cat_array[] = $blog_cat['id'];
			}
			$data['total_blogs'] = count($this->welcome->get_blogs_categories_wise($blog_categories_array[0]['id']));
			$data['blogs'] = $this->welcome->get_blogs_categories_wise($blog_categories_array[0]['id'], '', '', '', array('per_page' => $data["per_page"], 'page' => 0));
			$data['title'] = $blog_categories_array[0]['name'];
			$data['category_slug'] = $category_slug;
			$data['recent_blogs'] = $this->welcome->get_blogs_with_categories('', '', $limit = true);
			$data['title'] = !empty($blog_categories_array[0]['meta_title']) ? $blog_categories_array[0]['meta_title'] : $blog_categories_array[0]['name'];
			$data['meta_description'] = $blog_categories_array[0]['meta_description'];
			$data['meta_keyword'] = $blog_categories_array[0]['meta_keyword'];
			$this->load->frontpage('frontpages', 'blogs', $data);
		}
		// single blog details
		else if (!empty($args)) {
			$data['single_blog'] = $this->welcome->get_blogs_with_categories('', $args);
			$data['title'] = $data['single_blog']['title'];
			$cat_ids = $data['single_blog']['category_ids'];

			$cat_id = explode(",", $cat_ids);

			$where_data = array('id' => $data['single_blog']['id'], 'cat_id' => $cat_id[0]);
			$data['related_blogs'] = $this->welcome->get_related_blogs_with_categories($where_data);
			// pr($data['related_blogs']);die;
			$data['title'] = $data['single_blog']['meta_title'];
			$data['meta_description'] = $data['single_blog']['meta_description'];
			$data['meta_keyword'] = $data['single_blog']['meta_keyword'];
			$this->load->frontpage('frontpages', 'single-blog', $data);
		}
	}

	public function get_result_html()
	{
		$paginate_data['limit'] = $limit = 8;
		$postData['paging'] = $_POST['paging'];
		$postData['search'] = $_POST['search'];
		$postData['category'] = $_POST['category'];
		$paginate_data['offset'] = $limit * ($postData['paging'] - 1);
		$searchQuery = $pagQuery = '';
		ob_start();
		if (empty($postData['search']) && empty($postData['category'])) {
			$total_blogs = $this->welcome->get_blogs_with_categories('', '', '', '');
			$blogs = $this->welcome->get_blogs_with_categories('', '', '', '', array('per_page' => $limit, 'page' => $paginate_data['offset']));
		} else if (!empty($postData['search'])) {
			$total_blogs = $this->welcome->get_blogs_with_categories('', '', '', $postData['search']);
			$blogs = $this->welcome->get_blogs_with_categories('', '', '', $postData['search'], array('per_page' => $limit, 'page' =>  $paginate_data['offset']));
		} else if (!empty($postData['category'])) {
			$category_slug = strtolower(trim($postData['category']));
			$blog_categories_array = $this->welcome->get_blog_category(array('slug' => $category_slug));
			if (empty($blog_categories_array)) {
				set_alert('error', "Records Not Found");
				redirect('');
			}
			$total_blogs = $this->welcome->get_blogs_categories_wise($blog_categories_array[0]['id']);
			$blogs = $this->welcome->get_blogs_categories_wise($blog_categories_array[0]['id'], '', '', '', array('per_page' => $limit, 'page' => $paginate_data['offset']));
		}

		if (!empty($blogs)) {
			foreach ($blogs as $single_blog) {
?>
				<div class="blog-card-list-single">
					<div class="blog-card-list-single-image">
						<div class="img-wrap">
							<a href="<?= BASE_URL . 'blogs/' . $single_blog['slug'] ?>"><img src="<?php echo base_url() . 'uploads/blogs/' . $single_blog['featured_image']; ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/banner_default.png';"></a>
						</div>
					</div>
					<div class="blog-card-list-single-content">
						<a href="<?= BASE_URL . 'blogs/' . $single_blog['slug'] ?>">
							<h1 class="blog-card-list-single-title"><?= $single_blog['title'] ?></h1>
						</a>
						<p class="blog-card-list-single-details">Posted on <span class="date-posted"><?= date('F jS Y', strtotime($single_blog['created_at'])); ?></span> in
							<?php
							// convert cat ids to array
							$cat_slug = explode(",", $single_blog['cat_slug']);
							$categories = explode(",", $single_blog['categories']);
							$i = 0;
							if (!empty($categories)) {
								foreach ($categories as $single_cat) {
							?><a class="category-list" href="<?= BASE_URL . 'blogs/category/' . trim($cat_slug[$i]) ?>"><?= $single_cat ?></a>
									&nbsp;<?php
											$i++;
										}
									}
											?>
						</p>
						<div class="blog-card-list-single-intro">
							<p><?= strlen(strip_tags($single_blog['content'])) > 200 ? substr(strip_tags($single_blog['content']), 0, 200) . "..." : strip_tags($single_blog['content']); ?></p>
						</div>
						<a href="<?= BASE_URL . 'blogs/' . $single_blog['slug'] ?>" class="read-more">Read More <i class="far fa-long-arrow-right"></i></a>
					</div>
				</div>
			<?php
			}
		} else {
			?>
			<h1 class="not-found">No blogs exist!</h1>
		<?php
		}
		$data['resdata'] = ob_get_clean();

		ob_start();
		// pagination HTML
		?>
		<?php
		$total_pages = ceil(count($total_blogs) / $limit);
		$prevClass = ($postData['paging'] != 1 && $total_pages > 1) ? 'paginate-prev' : 'disabled';
		$nextClass = ($postData['paging'] != $total_pages) ? 'paginate-next' : 'disabled';
		?>
		<?php
		// display pagination only if more than $limit properties
		if ($total_pages > 1) {
		?>
			<li class="pre <?= $prevClass ?>">
				<a href="javascript:void(0);"><i class="fal fa-long-arrow-left"></i></a>
			</li>
			<?php
			for ($i = 1; $i <= $total_pages; $i++) {
				$class = ($i == $postData['paging']) ? 'active' : '';
				echo '<li data-pageno="' . $i . '" class="paginate ' . $class . '"><a href="javascript:void(0);">' . $i . '</a></li>';
			}
			?>
			<li class="<?= $nextClass ?>">
				<a href="javascript:void(0);"><i class="fal fa-long-arrow-right"></i></a>
			</li>
		<?php
		}
		?>
<?php
		$data['pagination'] = ob_get_clean();
		$data['status'] = true;
		echo json_encode($data);
	}
	// cron job for send email to unsubscribe users (NOT in use)
	public function send_email_to_unsusbscibed_users()
	{
		$email_subject = 'Driver In Rome | Newsletter';
		$email_template_name = 'unsubscribe-user';
		// get unsubscribed user s       
		$where_users = array('subscribe' => 0, 'send_unsubscribe_email' => 0);
		$get_all_unsubscribed_user = $this->welcome->get_users($where_users);
		if (!empty($get_all_unsubscribed_user)) {
			foreach ($get_all_unsubscribed_user as $single_user) {
				// pr($get_all_unsubscribed_user);die;
				$get_email_template = get_email_template('unsubscribe-user');

				if (!empty($get_email_template['subject'])) {
					$email_subject = $get_email_template['subject'];
				}

				$placeholder = ['{username}', '{welcome_image}'];
				$form_data   = [$single_user['name'], EMAIL_WELCOME_PNG];

				$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';

				$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);

				$data['email_body'] = $get_new_email_body;
				$data['subject'] = $email_subject;

				if (email_sending($single_user['email'], $data, $email_template_name)) {
					$data    = array('send_unsubscribe_email' => 1);
					$this->welcome->update_user($single_user['id'], $data);
				}
			}
		}
	}
	public function unsubscribe()
	{
		$data['title'] = 'Unsubscribe';
		$data['meta_description'] = 'Unsubscribe User';
		$data['meta_keyword'] = 'unsubscribe';
		$data['header_banner'] = 'no';
		$msg = '';
		$token_valid = true;
		if (isset($_GET['token']) && isset($_GET['user'])) {
			$user_data = array(
				'id' => base64_decode($_GET['user']),
				'token' => $_GET['token'],
			);
			$check_if_user_subscribed = $this->welcome->get_users($user_data);
		}

		if (empty($check_if_user_subscribed)) {
			$msg = 'Either your token is expired or you have already unsubscribed our newsletter!';
			$token_valid = false;
		} else {
			$update_user_data    = array('subscribe' => 0, 'send_unsubscribe_email' => 0, 'token' => NULL);
			$this->welcome->update_user(base64_decode($_GET['user']), $update_user_data);
			$msg = 'You are successfully unsubscribed from our newsletter!';
			$token_valid = true;
			// send unsubscribe email
			$email_subject = 'Driver In Rome | Unsubscribe Newsletter';
			$email_template_name = 'unsubscribe-user';

			$get_email_template = get_email_template('unsubscribe-user');

			if (!empty($get_email_template['subject'])) {
				$email_subject = $get_email_template['subject'];
			}
			$placeholder = ['{username}', '{welcome_image}'];
			$form_data   = [$check_if_user_subscribed[0]['name'], EMAIL_WELCOME_PNG];

			$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';

			$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);

			$data['email_body'] = $get_new_email_body;
			$data['subject'] = $email_subject;

			email_sending($check_if_user_subscribed[0]['email'], $data, $email_template_name);
		}
		$data['msg'] = $msg;
		$data['token_valid'] = $token_valid;
		$this->load->frontpage('frontpages', 'unsubscibe', $data);
	}

	public function unsubscribed_direct($token)
	{
		$where = array('token' => $token);
		$existing_user = $this->users_model->get_users($where);

		$data['msg'] = 'Either your token is expired or you have already unsubscribed our newsletter!';
		$data['token_valid'] = false;
		$data['title'] = 'Unsubscribe';
		$data['header_banner'] = 'no';

		if (count($existing_user) > 0) {
			// Prepare data for DB updation			
			$userData = array('subscribe' => 0, 'send_unsubscribe_email' => 0, 'token' => NULL);
			// Update user data
			$update = $this->users_model->update_user($existing_user[0]['id'], $userData);

			if ($update) {
				//header("Location:".base_url());
				$data['msg'] = 'You are successfully unsubscribed from our newsletter!';;
				$data['token_valid'] = true;
			}
		}
		$this->load->frontpage('frontpages', 'unsubscibe', $data);
		header('Refresh: 5;url="' . base_url() . '"');
	}
	public function search_tour()
	{
		$tour_name = $this->input->post('tour_name');
		if (!$tour_name) {
			return false;
		}
		$data['tours'] = $this->welcome->get_tours_by_name($tour_name, true);
		$data['tour_name'] = $tour_name;
		$data['total_tours'] = count($this->welcome->get_tours_by_name($tour_name));
		$result = $this->load->view('frontpages/load_tour_search_result', $data, TRUE);
		echo $result;
	}
}
?>