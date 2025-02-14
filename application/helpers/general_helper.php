<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Checks if admin is logged in or not
 * @return boolean
 */
function is_admin_logged_in()
{
	$admin_cookie = get_instance()->input->cookie("admin_autologin");
    if ($admin_cookie && isset(unserialize($admin_cookie)['admin_email'])) {
        get_instance()->session->set_userdata('admin_logged_in', unserialize($admin_cookie));
    }
    if (get_instance()->session->has_userdata('admin_logged_in')) {
        return get_user_info(get_instance()->session->userdata('admin_user_id'), 'status');
    }
    return false;
}

/**
 * Checks if user is logged in or not 
 * @return boolean
 */
function is_user_logged_in()
{
	$user_cookie = get_instance()->input->cookie("autologin");
    if ($user_cookie && isset(unserialize($user_cookie)['email'])) {
        get_instance()->session->set_userdata('user_logged_in', unserialize($user_cookie));
    }
    if (get_instance()->session->has_userdata('user_logged_in')) {
        return get_user_info(get_instance()->session->userdata('user_id'), 'status');
    }
    return false;
}

/**
 * Redirects to approprirate URL after login instead of Dashboard all the time.
 */
function redirect_after_login_to_current_url()
{
	$CI         = &get_instance();
	$redirectTo = current_full_url();
	$CI->session->set_userdata(['redirect_url' => $redirectTo]);
}

/**
 * Checks if user accessed some url while not logged in.
 * Sets it to redirect URL so that user can be redirected to it after login
 * @return null
 */
function maybe_redirect_to_previous_url()
{
	$CI = &get_instance();
	if ($CI->session->has_userdata('redirect_url')) {
		$red_url = $CI->session->userdata('redirect_url');
		$CI->session->unset_userdata('redirect_url');
		redirect($red_url);
	}
}

/**
 * Get current url with query vars
 * @return string
 */
function current_full_url()
{
	$CI  = &get_instance();
	$url = $CI->config->site_url($CI->uri->uri_string());
	return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;
}

/**
 * Translates the string to the current selected language.
 *
 * @param  str  $line   The key for the string
 * @param  str  $label  (optional)The sub string if there is any
 *
 * @return str  The translated string
 */
function _l($line, $label = '')
{
	$CI = &get_instance();
	$output = $CI->lang->line($line);
	if ($label != '') {
		$output = str_replace('%s', $label, $output);
	}
	return $output;
}

/**
 * Translates & prints the string to the current selected language.
 *
 * @param  str  $line   The key for the string
 * @param  str  $label  (optional)The sub string if there is any
 *
 * @return str  The translated string
 */
function _el($line, $label = '')
{
	$CI = &get_instance();
	$output = $CI->lang->line($line);
	if ($label != '') {
		$output = str_replace('%s', $label, $output);
	}
	echo $output;
}

/**
 * Sets the notification alert on different evets performed.
 *
 * @param str  $type     The type
 * @param str  $message  The message
 */
function set_alert($type, $message)
{
	get_instance()->session->set_flashdata($type, $message);
}

/**
 * Generates a random hash key for Forgot Password functionality
 *
 * @return str  Hash key
 */
function app_generate_hash()
{
	return md5(rand() . microtime() . time() . uniqid());
}

/**
 * Gets the loggedin user identifier.
 *
 * @return int  The loggedin user identifier.
 */
function get_loggedin_user_id()
{
	if (get_instance()->session->has_userdata('admin_logged_in')) {
		return get_instance()->session->userdata('admin_user_id');
	} else {
		return get_instance()->session->userdata('user_id');
	}
}

/**
 * Gets the requested info of logged in user.
 *
 * @param  str  $info  The key of the information required.
 *
 * @return mixed The information required.
 */
function get_loggedin_info($info)
{
	return get_instance()->session->userdata($info);
}

/**
 * Gets the requested info of user.
 *
 * @param  int  $id    The id of the user.
 * @param  str  $info  The key of the information required.
 *
 * @return mixed The information required.
 */
function get_user_info($id, $info = '')
{
	$CI = &get_instance();
	$CI->load->model('Admin_user_model', 'users');
	$user = $CI->users->get($id);
	if ($info != '') {
		return $user[$info];
	} else {
		return $user;
	}
}

/**
 * Determines if active controller.
 *
 * @param  str  $controller  The controller
 *
 * @return bool True if active controller, False otherwise.
 */
function is_active_controller($controller)
{
	$CI = &get_instance();
	if ($CI->router->fetch_class() == $controller) {
		return TRUE;
	}
	return FALSE;
}

/**
 * Logs an activity into the database if enabled.
 *
 * @param str  $description  The description
 * @param str  $user_id      The id of the user doing the activity
 */
function log_activity($description, $user_id = '')
{
	// if (get_settings('log_activity') == 1)
	// {
	$CI = &get_instance();
	$CI->load->model('activity_log_model', 'activity_log');
	if ($user_id == '') {
		$user_id = get_loggedin_user_id();
	}
	$data = array(
		'description' => $description,
		'date'        => date('Y-m-d H:i:s'),
		'user_id'     => $user_id,
		'ip_address'  => $CI->input->ip_address()
	);
	$CI->activity_log->insert($data);
	//}
}

function get_tour_types($type = 'tour')
{
	$CI = &get_instance();
	$CI->load->model('Tour_type_model', 'tour_types');
	$where = array("status" => 1);
	$CI->db->select(TBL_TOUR_TYPE . '.*');
	$CI->db->from(TBL_TOUR_TYPE);
	$CI->db->join(TBL_TOUR_VARIATION, TBL_TOUR_TYPE . '.id = ' . TBL_TOUR_VARIATION . '.tour_type_id');
	$CI->db->where(TBL_TOUR_TYPE . '.type', $type);
	$CI->db->group_by(TBL_TOUR_TYPE . '.id');
	$tour_types = $CI->db->get();
	//$tour_types =$CI->tour_types->get_many_by($where);
	//return $tour_types;		
	return $tour_types->result_array();
}

function get_tour_categories($get_by_tour = '')
{
	$CI = &get_instance();
	$CI->load->model('Tour_categories_model', 'tour_categories');
	if ($get_by_tour != '') {
		$where = array("status" => 1);
		$tour_categories = $CI->tour_categories->get_by_tourCategory($where);
	} else {
		$where = array("status" => 1);
		//$tour_categories =$CI->tour_categories->get_many_by();
		$tour_categories = $CI->tour_categories->get_all();
	}
	return $tour_categories;
}

function get_extra_services()
{
	$CI = &get_instance();
	$CI->load->model('Extra_services_model', 'extra_services');
	$where = array("status" => 1);
	$extra_services = $CI->extra_services->get_many_by($where);
	//$extra_services =$CI->extra_services->get_all();
	return $extra_services;
}

function get_extra_cost($ids = '')
{
	$CI = &get_instance();
	$CI->load->model('Tour_extra_cost_model', 'extra_cost');
	if ($ids) {
		$extra_cost = $CI->extra_cost->get_extra_cost_by_ids($ids);
	} else {
		$where = array("status" => 1);
		$extra_cost = $CI->extra_cost->get_many_by($where);
	}
	return $extra_cost;
}

function get_tour_type_variations($tour_type_id)
{
	$CI = &get_instance();
	$CI->load->model('Tour_variation_model', 'tour_variation');
	$where = array("tour_type_id" => $tour_type_id);
	$tour_variation = $CI->tour_variation->get_many_by($where);
	return $tour_variation;
}

function get_tour_list()
{
	$CI = &get_instance();
	$CI->load->model('Tours_model', 'tours');
	//$where=array("status"=>1);
	$CI->db->select(TBL_TOUR . '.id,' . TBL_TOUR . '.title, ' . TBL_TOUR . '.unique_code');
	$CI->db->from(TBL_TOUR);
	$CI->db->where(TBL_TOUR . '.status', 1);
	$CI->db->order_by(TBL_TOUR . '.unique_code', "asc");
	$tours = $CI->db->get();
	//$tours =$CI->tours->get_many_by($where);
	return $tours->result_array();
}

function get_transfer_types()
{
	$CI = &get_instance();
	$CI->load->model('Transfer_type_model', 'transfer_types');
	$where = array("status" => 1);
	//$transfer_types =$CI->transfer_types->get_many_by($where);
	$CI->db->select(TBL_TRANSFER_TYPE . '.*');
	$CI->db->from(TBL_TRANSFER_TYPE);
	$CI->db->join(TBL_TRANSFER_VARIATION, TBL_TRANSFER_TYPE . '.id = ' . TBL_TRANSFER_VARIATION . '.transfer_type_id');
	//$CI->db->where(TBL_TRANSFER_TYPE.'.status',1);
	$CI->db->group_by(TBL_TRANSFER_TYPE . '.id');
	$transfer_types = $CI->db->get();
	return $transfer_types->result_array();
}

function get_transfer_categories($get_by_transfer = '')
{
	$CI = &get_instance();
	$CI->load->model('Transfer_categories_model', 'transfer_categories');
	if ($get_by_transfer != '') {
		$where = array("status" => 1);
		$transfer_categories = $CI->transfer_categories->get_by_transferCategory($where);
	} else {
		//$where=array("status"=>1);
		//$transfer_categories =$CI->transfer_categories->get_many_by($where);
		$transfer_categories = $CI->transfer_categories->get_all();
	}
	return $transfer_categories;
}

function get_transfer_type_variations($transfer_type_id)
{
	$CI = &get_instance();
	$CI->load->model('Transfer_variation_model', 'transfer_variation');
	$where = array("transfer_type_id" => $transfer_type_id);
	$transfer_variation = $CI->transfer_variation->get_many_by($where);
	return $transfer_variation;
}

function set_extra_services()
{
	$CI = &get_instance();
	$CI->load->model('Extra_services_model', 'extra_services');
	$where = array("status" => 1);
	$extra_services = $CI->extra_services->get_many_by($where);
	//$extra_services =$CI->extra_services->get_all();
	// print_r($extra_services);
	// exit;
	$array = array();
	foreach ($extra_services as $ext) {
		$array[$ext['id']] = $ext['title'];
	}
	return $array;
}

/**
 * Gets the settings value for the passed key.
 * Returns all the settings values of no key is passed.
 *
 * @param  str  $name  The key of the settings
 *
 * @return str  The settings value.
 */
function get_settings($name = '')
{
	$CI = &get_instance();
	$CI->load->model('setting_model', 'settings');
	if ($name == '') {
		$settings = $CI->settings->get_all();
		return $settings;
	} else {
		$result = $CI->settings->get_by(['name' => $name]);
		if ($result) {
			return $result['value'];
		} else {
			return null;
		}
	}
}

/**
 * Gets the email template for the passed slug.
 *
 * @param  str  $slug  The slug name of the template
 *
 * @return str  The email template.
 */
function get_email_template($slug)
{
	$CI = &get_instance();
	$CI->load->model('email_model', 'emails');
	$result = $CI->emails->get_by(['slug' => $slug]);
	if ($result) {
		return $result;
	} else {
		return null;
	}
}

/**
 * Gets the current controller name.
 *
 * @return str  The current controller name.
 */
function get_current_controller()
{
	$CI = &get_instance();
	return $CI->router->fetch_class();
}

function get_star_ratings($total_stars)
{
	switch ($total_stars) {
		case 0.5:
			$start_rating_html = '<ul class="rating"><li><i class="fas fa-star-half-alt"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li></ul>';
			break;
		case 1:
			$start_rating_html = '<ul class="rating"><li><i class="fas fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li></ul>';
			break;
		case 1.5:
			$start_rating_html = '<ul class="rating"><li><i class="fas fa-star"></i></li><li><i class="fas fa-star-half-alt"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li></ul>';
			break;
		case 2:
			$start_rating_html = '<ul class="rating"><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li></ul>';
			break;
		case 2.5:
			$start_rating_html = '<ul class="rating"><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star-half-alt"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li></ul>';
			break;
		case 3:
			$start_rating_html = '<ul class="rating"><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li></ul>';
			break;
		case 3.5:
			$start_rating_html = '<ul class="rating"><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star-half-alt"></i></li><li><i class="far fa-star"></i></li></ul>';
			break;
		case 4:
			$start_rating_html = '<ul class="rating"><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="far fa-star"></i></li></ul>';
			break;
		case 4.5:
			$start_rating_html = '<ul class="rating"><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star-half-alt"></i></li></ul>';
			break;
		case 5:
			$start_rating_html = '<ul class="rating"><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li></ul>';
			break;
		default:
			$start_rating_html = '<ul class="rating"><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li><li><i class="far fa-star"></i></li></ul>';
	}
	return $start_rating_html;
}

function get_admin_settings($settings_array = '')
{
	// get social links from database
	$CI = &get_instance();
	$CI->db->select('*');
	$CI->db->from(TBL_SETTINGS);
	$query = $CI->db->get();
	$query = $query->result_array();
	return $query;
}

function pr($value, $exit = 0)
{
	echo "<pre>";
	print_r($value);
	echo "</pre>";
	if ($exit == 1)
		exit();
}

function query($exit = 0)
{
	$CI = &get_instance();
	echo $CI->db->last_query();
	if ($exit == 1)
		exit();
}

function active_link($controller = array())
{
	$CI = &get_instance();
	$class = $CI->router->fetch_class();
	// echo "CLASS :".$class;
	return (in_array(strtolower($class), $controller)) ? 'active' : '';
}

function get_city_list_in_menu($tour_type_id = '1', $tour_main_menu = '')
{
	$result_array = array();
	$CI = &get_instance();
	$CI->db->select('tc.title as city_title, tc.slug as tour_category_slug, tc.id as tour_category_id, t.is_city_tour');
	$CI->db->from(TBL_TOUR . ' t');
	$CI->db->join(TBL_TOUR_CATEGORY . ' tc', 'tc.id  = t.tour_category_id ', 'left');
	$CI->db->join(TBL_TOUR_TYPE . ' tt', 'tt.id  = t.tour_type_id ', 'left');
	$where_tour_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 't.tour_type_id' => $tour_type_id);
	if ($tour_main_menu == 'city-tours')
		$where_tour_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 't.tour_type_id' => 7, 't.is_city_tour' => 1);
	$CI->db->where($where_tour_data);
	$CI->db->group_by('tc.id'); // add group_by
	$CI->db->order_by('tc.title', "asc");
	$CI->db->query("SET sql_mode = '' ");
	$query = $CI->db->get();
	// query(1);
	$result_array = $query->result_array();
	return $result_array;
}

function get_tour_transfer_city_list_in_menu($tour_type_ids = [], $tour_main_menu = '')
{
	$result_array = array();
	$CI = &get_instance();
	$CI->db->select('tc.title as city_title, tc.slug as tour_category_slug, tc.id as tour_category_id, t.is_city_tour');
	$CI->db->from(TBL_TOUR . ' t');
	$CI->db->join(TBL_TOUR_CATEGORY . ' tc', 'tc.id  = t.tour_category_id ', 'left');
	$CI->db->join(TBL_TOUR_TYPE . ' tt', 'tt.id  = t.tour_type_id ', 'left');
	$where_tour_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1);
	if ($tour_main_menu == 'city-tours')
		$where_tour_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 't.tour_type_id' => 7, 't.is_city_tour' => 1);
	if ($tour_type_ids)
		$CI->db->where_in('t.tour_type_id', $tour_type_ids);
	$CI->db->where($where_tour_data);
	$CI->db->group_by('tc.id'); // add group_by
	$CI->db->order_by('tc.title', "asc");
	$CI->db->query("SET sql_mode = '' ");
	$query = $CI->db->get();
	// query(1);
	$result_array = $query->result_array();
	return $result_array;
}

function get_transfer_list_in_menu($transfer_type_id = '1')
{
	$result_array = array();
	$CI = &get_instance();
	$CI->db->select('tc.title as city_title, tc.id as transfer_category_id, tc.slug as transfer_category_slug');
	$CI->db->from(TBL_TRANSFER . ' t');
	$CI->db->join(TBL_TRANSFER_CATEGORY . ' tc', 'tc.id  = t.transfer_category_id ', 'left');
	$CI->db->join(TBL_TRANSFER_TYPE . ' tt', 'tt.id  = t.transfer_type_id ', 'left');
	$where_transfer_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 't.transfer_type_id' => $transfer_type_id);
	$CI->db->where($where_transfer_data);
	$CI->db->group_by('tc.id'); // add group_by
	$CI->db->order_by('tc.title', "asc");
	$query = $CI->db->get();
	// query(1);
	$result_array = $query->result_array();
	return $result_array;
}

function get_variation_prices_for_tours($tour_id = '0', $tour_variation_title = array(''), $tour_type_id = 0)
{
	$CI = &get_instance();
	$CI->db->select('tpp.*, tv.*, GROUP_CONCAT(tpp.price ORDER BY tpp.id ASC SEPARATOR ",") as tour_price');
	$CI->db->from(TBL_TOUR_PRICE_PLAN . ' tpp');
	$CI->db->join(TBL_TOUR_VARIATION . ' tv', 'tv.id  = tpp.variation_id ', 'left');
	$where_tour_data = array('tv.status' => 1, 'tv.tour_type_id' => $tour_type_id, 'tpp.price_type' => 1, 'tpp.tour_id' => $tour_id);
	$CI->db->where($where_tour_data);
	//$CI->db->where_in('tv.title', $tour_variation_title);
	$CI->db->group_by(array('tpp.tour_id')); // add group_by
	// $CI->db->query("SET sql_mode = '' ");
	$query = $CI->db->get();
	// query(1);
	$result_array = $query->result_array();
	return $result_array;
}

function get_variation_prices_for_transfers($transfer_id = '0', $transfer_variation_ids = array(''), $transfer_type_id = 1)
{
	$CI = &get_instance();
	$CI->db->select('tpp.*, tv.*, GROUP_CONCAT(tpp.price ORDER BY tpp.id ASC SEPARATOR ",") as price, GROUP_CONCAT(tv.title ORDER BY tv.id ASC SEPARATOR ",") as variation_lable');
	$CI->db->from(TBL_TRANSFER_PRICE_PLAN . ' tpp');
	$CI->db->join(TBL_TRANSFER_VARIATION . ' tv', 'tv.id  = tpp.transfer_variation_id ', 'left');
	$where_transfer_data = array('tv.transfer_type_id' => $transfer_type_id, 'tpp.price_type' => 1, 'tpp.transfer_id' => $transfer_id);
	$CI->db->where($where_transfer_data);
	$CI->db->where_in('tv.id', $transfer_variation_ids);
	$CI->db->group_by(array('tpp.transfer_id')); // add group_by
	$CI->db->query("SET sql_mode = '' ");
	$query = $CI->db->get();
	// query(1);
	$result_array = $query->row_array();
	return $result_array;
}

function get_single_transfers_all_details_by_id($transfer_id = 0, $transfer_type_array = '')
{
	$row_array = array();
	$CI = &get_instance();
	$CI->db->select('transfer.*,transfer.slug as transfer_slug, city.title as city,transfer_type.title as transfer_type,GROUP_CONCAT(price.price ORDER BY price.id ASC SEPARATOR ",") as transfer_price,GROUP_CONCAT(variation.title ORDER BY variation.id ASC SEPARATOR ",") as variation_title');
	$CI->db->from(TBL_TRANSFER . ' as transfer');
	$CI->db->join(TBL_TRANSFER_CATEGORY . ' as city', 'transfer.transfer_category_id=city.id');
	$CI->db->join(TBL_TRANSFER_TYPE . ' as transfer_type', 'transfer.transfer_type_id=transfer_type.id');
	$CI->db->join(TBL_TRANSFER_PRICE_PLAN . ' as price', 'transfer.id=price.transfer_id');
	$CI->db->join(TBL_TRANSFER_VARIATION . ' as variation', 'variation.id=price.transfer_variation_id');
	$CI->db->where(array('transfer.id' => $transfer_id, 'price.price_type' => 1, 'transfer.status' => 1, 'city.status' => 1, 'transfer_type.status' => 1,));
	$CI->db->where_in('transfer_type.id', $transfer_type_array);
	$query = $CI->db->get();
	$row_array = $query->row_array();
	return $row_array;
}

function get_single_tours_all_details_by_id($tour_id = 0, $tour_type_array = '')
{
	$row_array = array();
	$CI = &get_instance();
	$CI->db->select('tour.*,city.title as city,tour_type.title as transfer_type,GROUP_CONCAT(price.price ORDER BY price.id ASC SEPARATOR ",") as transfer_price,GROUP_CONCAT(variation.title ORDER BY variation.id ASC SEPARATOR ",") as variation_title');
	$CI->db->from(TBL_TOUR . ' as tour');
	$CI->db->join(TBL_TOUR_CATEGORY . ' as city', 'tour.tour_category_id=city.id');
	$CI->db->join(TBL_TOUR_TYPE . ' as tour_type', 'tour.tour_type_id=tour_type.id');
	$CI->db->join(TBL_TOUR_PRICE_PLAN . ' as price', 'tour.id=price.tour_id');
	$CI->db->join(TBL_TOUR_VARIATION . ' as variation', 'variation.id=price.variation_id');
	$CI->db->where(array('tour.id' => $tour_id, 'price.price_type' => 1, 'tour.status' => 1, 'city.status' => 1, 'tour_type.status' => 1,));
	$CI->db->where_in('tour_type.id', $tour_type_array);
	$query = $CI->db->get();
	$row_array = $query->row_array();
	return $row_array;
}

function cart_total_items()
{
	$CI = &get_instance();
	$CI->load->library('cart');
	$cart_data = $CI->cart->total_items();
	return $cart_data;
}

// function get_email_template(){
// 	// get social links from database
// 	$CI =& get_instance();
// 	$CI->db->select('*');
// 	$CI->db->from(TBL_EMAIL_TEMPLATES);	
// 	$query = $CI->db->get();
// 	$query = $query->result_array();
// 	return $query;
// }
// function for generate slug
function slugify($text)
{
	// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);
	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);
	// trim
	$text = trim($text, '-');
	// remove duplicate -
	$text = preg_replace('~-+~', '-', $text);
	// lowercase
	$text = strtolower($text);
	if (empty($text)) {
		return 'n-a';
	}
	return $text;
}

function price_format($price = '')
{
	if ($price == '')
		return 0;
	return number_format($price, 2);
}

function get_tour_product_status($tour_id)
{
	if ($tour_id) {
		$CI = &get_instance();
		$CI->db->select('tour.status');
		$CI->db->from(TBL_TOUR . ' as tour');
		$CI->db->where('id', $tour_id);
		$query = $CI->db->get();
		$row_array = $query->row_array();
		if (is_array($row_array) && sizeof($row_array) > 0) {
			if ($row_array['status'] == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function get_extra_servicesId_byPerPersonRate()
{
	$CI = &get_instance();
	$CI->load->model('Extra_services_model', 'extra_services');
	$where = array("status" => 1, "rate_opt" => 1);
	$extra_services = $CI->extra_services->get_many_by($where);
	$array = array();
	foreach ($extra_services as $ext) {
		$array[] = $ext['id'];
	}
	return $array;
}

function global_date_format($global_date = '')
{
	$new_global_date = date("d M Y", strtotime($global_date));
	return date('F dS Y', strtotime($new_global_date));
}

function get_tour_slug_review($tour_id = "")
{
	if ($tour_id) {
		$CI = &get_instance();
		$CI->load->model('Tours_model', 'tours');
		$CI->db->select(TBL_TOUR . '.slug');
		$CI->db->from(TBL_TOUR);
		$CI->db->where(TBL_TOUR . '.id', $tour_id);
		$tours = $CI->db->get();
		$result = $tours->row_array();
		if (is_array($result) && sizeof($result) > 0) {
			return $result['slug'];
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function get_cms_page_static_text($cms_page_id = "")
{
	if ($cms_page_id) {
		$CI = &get_instance();
		$CI->load->model('Cms_page_static_text', 'cms_static_model');
		$CI->db->select(TBL_CMS_PAGES_STATIC_TEXT . '.*');
		$CI->db->from(TBL_CMS_PAGES_STATIC_TEXT);
		$CI->db->where(TBL_CMS_PAGES_STATIC_TEXT . '.page_id', $cms_page_id);
		$CI->db->order_by(TBL_CMS_PAGES_STATIC_TEXT . '.id', 'asc');
		$content = $CI->db->get();
		$result = $content->result_array();
		if (is_array($result) && sizeof($result) > 0) {
			return $result;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function get_cms_tour_landing_page()
{
	$CI = &get_instance();
	$CI->load->model('Cms_model', 'cms_model');
	$CI->db->select(TBL_CMS_PAGES . '.*');
	$CI->db->from(TBL_CMS_PAGES);
	$CI->db->where(TBL_CMS_PAGES . '.status', 1);
	$CI->db->group_start();
	$CI->db->where(TBL_CMS_PAGES . '.id', 12);
	$CI->db->or_where(TBL_CMS_PAGES . '.parent_id !=', '');
	$CI->db->group_end();
	$CI->db->order_by(TBL_CMS_PAGES . '.id', 'asc');
	$content = $CI->db->get();
	$result = $content->result_array();
	if (is_array($result) && sizeof($result) > 0) {
		return $result;
	} else {
		return false;
	}
}

function isValidEmail($email)
{
	if (!$email) {
		return false;
	}
	return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

//this function is used for custom pagignation
if (!function_exists("custom_pagination")) {
	function custom_pagination($url = '', $use_page_numbers = true, $total_rows = 0, $per_page = 0, $uri_segment = 2)
	{
		$CI = &get_instance();
		$CI->load->library(array('pagination'));
		// Pagination Configuration
		$config['base_url']                = $url;
		$config['use_page_numbers']        = $use_page_numbers;
		$config['total_rows']              = $total_rows;
		$config['per_page']                = $per_page;
		$config['uri_segment']             = $uri_segment;
		$config['num_links']               = 8;
		//        $config['use_page_numbers']        = FALSE;
		//        $config['reuse_query_string']      = FALSE;
		$config['full_tag_open']           = '<ul class="custom-pagination">';
		$config['full_tag_close']          = '</ul>';
		$config['first_link']              = FALSE;
		$config['first_tag_open']          = '';
		$config['first_tag_close']         = '';
		$config['cur_tag_open']            = '<li class="active"><a href="javascript:void(0)">';
		$config['cur_tag_close']           = '</a></li>';
		$config['num_tag_open']            = '<li class="paginate">';
		$config['num_tag_close']           = '</li>';
		$config['next_tag_open']           = '<li class="arrow_right">';
		$config['next_tag_close']          = '</li>';
		$config['next_link']               = '<i class="fal fa-long-arrow-right" aria-hidden="true"></i>';
		$config['prev_tag_open']           = '<li class="arrow_left">';
		$config['prev_tag_close']          = '</li>';
		$config['prev_link']               = '<i class="fal fa-long-arrow-left" aria-hidden="true"></i>';
		$config['last_link']               = FALSE;
		$config['last_tag_open']           = '';
		$config['last_tag_close']          = '';
		$config['page_query_string']       = FALSE;
		// Initialize
		$CI->pagination->initialize($config);
		// Initialize $data Array
		$pagination_link                   = $CI->pagination->create_links();
		return $pagination_link;
	}
}

function is_home()
{
	$CI = &get_instance();
	return (!$CI->uri->segment(1)) ? true : false;
}

function is_umbriavilla_page()
{
	$CI = &get_instance();
	return ($CI->uri->segment(1) == 'umbria-villa') ? true : false;
}

function get_active_automation()
{
	// Set up an object instance using our PHP API wrapper.	
	include_once APPPATH . 'third_party/click funnels/includes/ActiveCampaign.class.php';
	$ac = new ActiveCampaign(ACTIVE_CAMPAIGN_URL, ACTIVE_CAMPAIGN_API_KEY);
	return $ac->api("automation/list?offset=0&limit=400");
}

/**	
 * This function is used for adding contact to the active campaign contact list and automation
 */
function api_campaign($post_data, $add_automation = true)
{
	$return_response = array(
		'statusCode' 			=> 0,
		'message'       		=> 'Something went wrong, while subscribe user',
	);
	// start to add contact into active campaign
	$url = ACTIVE_CAMPAIGN_URL;
	$params = array(
		'api_key'      => ACTIVE_CAMPAIGN_API_KEY,
		// this is the action that adds a contact
		'api_action'   => 'contact_add',
		'api_output'   => 'serialize',
	);
	$post = array(
		'email'                    => $post_data['user_email'],
		'first_name'               => $post_data['username'],
		'tags'                     => 'api',
		'p[2]'                     => 2, // list ID
		'status[2]'                => 1,
		'instantresponders[123]' => 1,
	);
	// This section takes the input fields and converts them to the proper format
	$query = "";
	foreach ($params as $key => $value) $query .= urlencode($key) . '=' . urlencode($value) . '&';
	$query = rtrim($query, '& ');
	// This section takes the input data and converts it to the proper format
	$data = "";
	foreach ($post as $key => $value) $data .= urlencode($key) . '=' . urlencode($value) . '&';
	$data = rtrim($data, '& ');
	// clean up the url
	$url = rtrim($url, '/ ');
	if (!function_exists('curl_init')) die('CURL not supported. (introduced in PHP 4.0.2)');
	// If JSON is used, check if json_decode is present (PHP 5.2.0+)
	if ($params['api_output'] == 'json' && !function_exists('json_decode')) {
		$return_response['message'] = 'JSON not supported.';
		return $return_response;
	}
	// define a final API request - GET
	$api = $url . '/admin/api.php?' . $query;
	$request = curl_init($api); // initiate curl object
	curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
	curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
	curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
	$response = (string)curl_exec($request); // execute curl post and store results in $response
	// additional options may be required depending upon your server configuration
	// you can find documentation on curl options at http://www.php.net/curl_setopt
	curl_close($request); // close curl object
	if (!$response) {
		$return_response['message'] = 'Nothing was returned. Connection issue with Email Marketing server';
		return $return_response;
	}
	$result = unserialize($response);
	// end to add contact into active campaign
	if ($add_automation) {
		// start to add contact into automation
		// return false if active campaign automation id is empty
		if (!$post_data['active_campaign_automation_id']) {
			return false;
		}
		include_once APPPATH . 'third_party/click funnels/includes/ActiveCampaign.class.php';
		$ac = new ActiveCampaign(ACTIVE_CAMPAIGN_URL, ACTIVE_CAMPAIGN_API_KEY);
		$post_data = array(
			"contact_email" => $post_data['user_email'], // include this or contact_id
			"automation" => $post_data['active_campaign_automation_id'], // one or more
		);
		$automation_response = $ac->api("automation/contact/add", $post_data);
		if($automation_response){
			if($automation_response->result_code == 1 && $automation_response->http_code == 200){
				$return_response['statusCode'] = 1;
				$return_response['message'] = 'You have successfully subscribed to our newsletter!';
			}
		}
		// end to add contact into automation
	}
	return $return_response;
}

function get_single_tour_details($tour_id = '')
{
	if (!$tour_id) {
		return false;
	}
	$CI = &get_instance();
	$CI->load->model('Tours_model', 'tours');
	$CI->db->select();
	$CI->db->from(TBL_TOUR);
	$CI->db->where(TBL_TOUR . '.id', $tour_id);
	$tours = $CI->db->get();
	return $tours->row_array();
}

// function for get dates between two date range
function getBetweenDates($startDate, $endDate)
{
	$rangArray = [];
	$startDate = strtotime($startDate);
	$endDate = strtotime($endDate);
	for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += (86400)) {
		$date = date('Y-m-d', $currentDate);
		$rangArray[] = $date;
	}
	return $rangArray;
}

function get_cms_landing_page(){
	$CI = &get_instance();
	$CI->load->model('Cms_model', 'cms_model');
	$CI->db->select('slug,page_title');
	$CI->db->from(TBL_CMS_PAGES);
	$CI->db->where(TBL_CMS_PAGES . '.status', 1);	
	$CI->db->order_by(TBL_CMS_PAGES . '.id', 'asc');
	$content = $CI->db->get();
	$result = $content->result_array();
	if (is_array($result) && sizeof($result) > 0) {
		$page_arr = [];
		foreach ($result as $rkey => $res_val) {
			array_push($page_arr, $res_val['slug']);
		}
		return $page_arr;
	} else {
		return false;
	}
}