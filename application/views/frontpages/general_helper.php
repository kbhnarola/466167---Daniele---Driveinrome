<?php defined('BASEPATH') or exit('No direct script access allowed');



/**

 * Checks if admin is logged in or not

 * @return boolean

 */

function is_admin_logged_in()

{

	if(isset(unserialize(get_instance()->input->cookie("admin_autologin"))['admin_email'])){

		get_instance()->session->set_userdata('admin_logged_in', unserialize(get_instance()->input->cookie("admin_autologin")));

	}

	if (get_instance()->session->has_userdata('admin_logged_in') )

	{

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

	if(isset(unserialize(get_instance()->input->cookie("autologin"))['email'])){

		get_instance()->session->set_userdata('user_logged_in', unserialize(get_instance()->input->cookie("autologin")));

	}

	if (get_instance()->session->has_userdata('user_logged_in'))

	{

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



	if ($CI->session->has_userdata('redirect_url'))

	{

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



	return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;

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



	if ($label != '')

	{

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



	if ($label != '')

	{

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

	return md5(rand().microtime().time().uniqid());

}



/**

 * Gets the loggedin user identifier.

 *

 * @return int  The loggedin user identifier.

 */

function get_loggedin_user_id()

{

	if(get_instance()->session->has_userdata('admin_logged_in')){



		return get_instance()->session->userdata('admin_user_id');

	}else{

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



	if ($info != '')

	{

		return $user[$info];

	}

	else

	{

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



	if ($CI->router->fetch_class() == $controller)

	{

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



		if ($user_id == '')

		{

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



function get_tour_types() {

	$CI = &get_instance();

	$CI->load->model('Tour_type_model', 'tour_types');



	$where=array("status"=>1);

					$CI->db->select(TBL_TOUR_TYPE.'.*');

					$CI->db->from(TBL_TOUR_TYPE);

					$CI->db->join(TBL_TOUR_VARIATION, TBL_TOUR_TYPE.'.id = '. TBL_TOUR_VARIATION.'.tour_type_id');

					//$CI->db->where(TBL_TOUR_TYPE.'.status',1);

					$CI->db->group_by(TBL_TOUR_TYPE.'.id');

	$tour_types =$CI->db->get();

	//$tour_types =$CI->tour_types->get_many_by($where);

	//return $tour_types;		

	return $tour_types->result_array();	

}



function get_tour_categories($get_by_tour='') {

	$CI = &get_instance();

	$CI->load->model('Tour_categories_model', 'tour_categories');



	if($get_by_tour!=''){

		$where=array("status"=>1);

		$tour_categories =$CI->tour_categories->get_by_tourCategory($where);

	} else {

		$where=array("status"=>1);

		//$tour_categories =$CI->tour_categories->get_many_by();

		$tour_categories =$CI->tour_categories->get_all();

	}



	return $tour_categories;		

}



function get_extra_services() {

	$CI = &get_instance();

	$CI->load->model('Extra_services_model', 'extra_services');

	

	$where=array("status"=>1);

	$extra_services =$CI->extra_services->get_many_by($where);

	//$extra_services =$CI->extra_services->get_all();



	return $extra_services;		

}



function get_tour_type_variations($tour_type_id) {

	$CI = &get_instance();

	$CI->load->model('Tour_variation_model', 'tour_variation');



	$where=array("tour_type_id"=>$tour_type_id);

	$tour_variation =$CI->tour_variation->get_many_by($where);



	return $tour_variation;		

}



function get_tour_list() {

	$CI = &get_instance();

	$CI->load->model('Tours_model', 'tours');



	//$where=array("status"=>1);

				$CI->db->select(TBL_TOUR.'.id,'.TBL_TOUR.'.title');

				$CI->db->from(TBL_TOUR);

				$CI->db->where(TBL_TOUR.'.status',1);

				$CI->db->order_by(TBL_TOUR.'.id',"desc");

	$tours =$CI->db->get();

	//$tours =$CI->tours->get_many_by($where);



	return $tours->result_array();		

}



function get_transfer_types() {

	$CI = &get_instance();

	$CI->load->model('Transfer_type_model', 'transfer_types');



	$where=array("status"=>1);

	//$transfer_types =$CI->transfer_types->get_many_by($where);

					$CI->db->select(TBL_TRANSFER_TYPE.'.*');

					$CI->db->from(TBL_TRANSFER_TYPE);

					$CI->db->join(TBL_TRANSFER_VARIATION, TBL_TRANSFER_TYPE.'.id = '. TBL_TRANSFER_VARIATION.'.transfer_type_id');

					//$CI->db->where(TBL_TRANSFER_TYPE.'.status',1);

					$CI->db->group_by(TBL_TRANSFER_TYPE.'.id');

	$transfer_types =$CI->db->get();



	return $transfer_types->result_array();		

}



function get_transfer_categories($get_by_transfer='') {

	$CI = &get_instance();

	$CI->load->model('Transfer_categories_model', 'transfer_categories');



	if($get_by_transfer!=''){

		$where=array("status"=>1);

		$transfer_categories =$CI->transfer_categories->get_by_transferCategory($where);

	} else {

		//$where=array("status"=>1);

		//$transfer_categories =$CI->transfer_categories->get_many_by($where);

		$transfer_categories =$CI->transfer_categories->get_all();

	}



	return $transfer_categories;		

}



function get_transfer_type_variations($transfer_type_id) {

	$CI = &get_instance();

	$CI->load->model('Transfer_variation_model', 'transfer_variation');



	$where=array("transfer_type_id"=>$transfer_type_id);

	$transfer_variation =$CI->transfer_variation->get_many_by($where);



	return $transfer_variation;		

}



function set_extra_services() {

	$CI = &get_instance();

	$CI->load->model('Extra_services_model', 'extra_services');

	

	$where=array("status"=>1);

	$extra_services =$CI->extra_services->get_many_by($where);

	//$extra_services =$CI->extra_services->get_all();

	// print_r($extra_services);

	// exit;

	$array=array();

	foreach($extra_services as $ext){

		$array[$ext['id']]=$ext['title'];

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



	if ($name == '')

	{

		$settings = $CI->settings->get_all();



		return $settings;

	}

	else

	{

		$result = $CI->settings->get_by(['name' => $name]);



		if ($result)

		{

			return $result['value'];

		}

		else

		{

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



	if ($result)

	{

		return $result;

	}

	else

	{

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



function get_star_ratings($total_stars){

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



function get_admin_settings($settings_array = ''){

	// get social links from database

	$CI =& get_instance();

	$CI->db->select('*');

	$CI->db->from(TBL_SETTINGS);	

	$query = $CI->db->get();

	$query = $query->result_array();

	return $query;

}

function pr($value, $exit = 0) {

	echo "<pre>";

	print_r($value);

	echo "</pre>";

	if ($exit == 1)

		exit();

}

function query($exit = 0) {

	$CI = & get_instance();

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

function get_city_list_in_menu($tour_type_id = '1'){

	$result_array = array();

	$CI =& get_instance();

	$CI->db->select('tc.title as city_title, tc.slug as tour_category_slug, tc.id as tour_category_id');

	$CI->db->from(TBL_TOUR . ' t');

	$CI->db->join(TBL_TOUR_CATEGORY . ' tc', 'tc.id  = t.tour_category_id ', 'left');          

	$CI->db->join(TBL_TOUR_TYPE . ' tt', 'tt.id  = t.tour_type_id ', 'left');         

	$where_tour_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 't.tour_type_id' => $tour_type_id);

	$CI->db->where($where_tour_data);

	$CI->db->group_by('tc.id');// add group_by

	$CI->db->order_by('tc.title', "asc");

	$query = $CI->db->get();

	// query(1);

	$result_array = $query->result_array();

	return $result_array;

}

function get_transfer_list_in_menu($transfer_type_id = '1'){

	$result_array = array();

	$CI =& get_instance();

	$CI->db->select('tc.title as city_title, tc.id as transfer_category_id, tc.slug as transfer_category_slug');

	$CI->db->from(TBL_TRANSFER . ' t');

	$CI->db->join(TBL_TRANSFER_CATEGORY . ' tc', 'tc.id  = t.transfer_category_id ', 'left');          

	$CI->db->join(TBL_TRANSFER_TYPE . ' tt', 'tt.id  = t.transfer_type_id ', 'left');        

	$where_transfer_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 't.transfer_type_id' => $transfer_type_id);

	$CI->db->where($where_transfer_data);

	$CI->db->group_by('tc.id');// add group_by

	$CI->db->order_by('tc.title', "asc");

	$query = $CI->db->get();

	// query(1);

	$result_array = $query->result_array();

	return $result_array;

}

function get_variation_prices_for_tours($tour_id = '0', $tour_variation_title = array(''), $tour_type_id = 0){



	$CI =& get_instance();

	$CI->db->select('tpp.*, tv.*, GROUP_CONCAT(tpp.price ORDER BY tpp.id ASC SEPARATOR ",") as transfer_price');

	$CI->db->from(TBL_TOUR_PRICE_PLAN . ' tpp');        

	$CI->db->join(TBL_TOUR_VARIATION . ' tv', 'tv.id  = tpp.variation_id ', 'left');         

	$where_tour_data = array('tv.status' => 1, 'tv.tour_type_id' => $tour_type_id, 'tpp.price_type' => 1, 'tpp.tour_id' => $tour_id);

	$CI->db->where($where_tour_data);

	$CI->db->where_in('tv.title', $tour_variation_title);

	$CI->db->group_by(array('tpp.tour_id'));// add group_by

	// $CI->db->query("SET sql_mode = '' ");

	$query = $CI->db->get();

	// query(1);

	$result_array = $query->result_array();

	return $result_array;

}

function get_variation_prices_for_transfers($transfer_id = '0', $transfer_variation_ids = array(''), $transfer_type_id = 1){



	$CI =& get_instance();

	$CI->db->select('tpp.*, tv.*, GROUP_CONCAT(tpp.price ORDER BY tpp.id ASC SEPARATOR ",") as price, GROUP_CONCAT(tv.title ORDER BY tv.id ASC SEPARATOR ",") as variation_lable');

	$CI->db->from(TBL_TRANSFER_PRICE_PLAN . ' tpp');        

	$CI->db->join(TBL_TRANSFER_VARIATION . ' tv', 'tv.id  = tpp.transfer_variation_id ', 'left');         

	$where_transfer_data = array('tv.transfer_type_id' => $transfer_type_id, 'tpp.price_type' => 1, 'tpp.transfer_id' => $transfer_id);

	$CI->db->where($where_transfer_data);

	$CI->db->where_in('tv.id', $transfer_variation_ids);

	$CI->db->group_by(array('tpp.transfer_id'));// add group_by

	$CI->db->query("SET sql_mode = '' ");

	$query = $CI->db->get();

	// query(1);

	$result_array = $query->row_array();

	return $result_array;

}



function get_single_transfers_all_details_by_id($transfer_id = 0, $transfer_type_array = ''){

	$row_array = array();

	$CI =& get_instance();

	$CI->db->select('transfer.*,transfer.slug as transfer_slug, city.title as city,transfer_type.title as transfer_type,GROUP_CONCAT(price.price ORDER BY price.id ASC SEPARATOR ",") as transfer_price,GROUP_CONCAT(variation.title ORDER BY variation.id ASC SEPARATOR ",") as variation_title');

	$CI->db->from(TBL_TRANSFER.' as transfer');

	$CI->db->join(TBL_TRANSFER_CATEGORY.' as city','transfer.transfer_category_id=city.id');

	$CI->db->join(TBL_TRANSFER_TYPE.' as transfer_type','transfer.transfer_type_id=transfer_type.id');

	$CI->db->join(TBL_TRANSFER_PRICE_PLAN.' as price','transfer.id=price.transfer_id');

	$CI->db->join(TBL_TRANSFER_VARIATION.' as variation','variation.id=price.transfer_variation_id');

	$CI->db->where(array('transfer.id' => $transfer_id, 'price.price_type'=> 1, 'transfer.status' => 1, 'city.status' => 1, 'transfer_type.status' => 1, ));

	$CI->db->where_in('transfer_type.id', $transfer_type_array);

	$query=$CI->db->get();

	$row_array = $query->row_array();

	return $row_array;

}

function get_single_tours_all_details_by_id($tour_id = 0, $tour_type_array = ''){

	$row_array = array();

	$CI =& get_instance();

	$CI->db->select('tour.*,city.title as city,tour_type.title as transfer_type,GROUP_CONCAT(price.price ORDER BY price.id ASC SEPARATOR ",") as transfer_price,GROUP_CONCAT(variation.title ORDER BY variation.id ASC SEPARATOR ",") as variation_title');

	$CI->db->from(TBL_TOUR.' as tour');

	$CI->db->join(TBL_TOUR_CATEGORY.' as city','tour.tour_category_id=city.id');

	$CI->db->join(TBL_TOUR_TYPE.' as tour_type','tour.tour_type_id=tour_type.id');

	$CI->db->join(TBL_TOUR_PRICE_PLAN.' as price','tour.id=price.tour_id');

	$CI->db->join(TBL_TOUR_VARIATION.' as variation','variation.id=price.variation_id');

	$CI->db->where(array('tour.id' => $tour_id, 'price.price_type'=> 1, 'tour.status' => 1, 'city.status' => 1, 'tour_type.status' => 1, ));

	$CI->db->where_in('tour_type.id', $tour_type_array);

	$query=$CI->db->get();

	$row_array = $query->row_array();

	return $row_array;

}

function cart_total_items(){

	$CI =& get_instance();

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

function price_format($price = ''){

	if($price == '')

		return 0;



	return number_format($price, 2);

}



function get_tour_product_status($tour_id){

	if($tour_id){

		$CI =& get_instance();

		$CI->db->select('tour.status');

		$CI->db->from(TBL_TOUR.' as tour');

		$CI->db->where('id',$tour_id);

		$query=$CI->db->get();

		$row_array = $query->row_array();

		if(is_array($row_array) && sizeof($row_array)>0) {

			if($row_array['status']==1){

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

