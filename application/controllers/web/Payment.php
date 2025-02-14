<?php

use Stripe\Stripe;
use Stripe\Stripe_CardError;
use Stripe\Error;

require APPPATH . 'libraries/stripe/autoload.php';
include APPPATH . 'libraries/stripe/stripe/stripe-php/init.php';
defined('BASEPATH') or exit('No direct script access allowed');
class Payment extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->library('cart');
		$this->load->library('session');
		$this->load->model('frontend/thank_you_model', 'thank_you');
	}
	public function index()
	{
		if ($this->cart->total_items() == 0) {
			redirect('summary');
		} elseif ($this->cart->total_items() == 1) {
			foreach ($this->cart->contents() as $product) {
				if (array_key_exists("tours_detail_data", $product)) {
					$get_single_tour_detail = get_tour_product_status($product['id']);
					if (!$get_single_tour_detail) {

						redirect('summary');
						exit;
					}
				} else {
					$single_transfer_details = get_single_transfers_all_details_by_id($product['id'], array('1'));
					if (empty($single_transfer_details['id'])) {
						redirect('summary');
						exit;
					}
				}
			}
		}
		$data['title'] = 'Payment';
		$data['header_banner'] = 'no';
		$data['meta_description'] = '';
		$data['meta_keyword'] = '';

		if (!empty($_POST)) {
			$cart_products_name = array();
			$cart_products_variation_title = array();
			// get cart details
			// pr($this->cart->contents());die;
			$products = $this->cart->contents();
			if (!empty($products)) {
				foreach ($products as $product) {
					if (array_key_exists("transfer_detail_data", $product)) {
						// pr($product);die;
						$single_transfer_details = get_single_transfers_all_details_by_id($product['id'], array('1'));
						if (empty($single_transfer_details['id'])) {
							$cart_products_name[] = $product['name'];
							$cart_products_variation_title[] = $product['options']['transfer_variation_title'];
							$this->cart->remove($product['rowid']);
						}
					} else if (array_key_exists("tours_detail_data", $product)) {
						// $single_tour_details = get_single_tours_all_details_by_id($product['id'], array('1','3','7','8'));
						// // pr($single_tour_details);die;
						// if(empty($single_tour_details['id'])){
						// 	$cart_products_name[] = $product['tours_detail_data']['toursData']['title'];
						// 	$cart_products_variation_title[] = $product['tours_detail_data']['toursData']['title'];
						// 	$this->cart->remove($product['rowid']);
						// }
						$get_single_tour_detail = get_tour_product_status($product['id']);
						if (!$get_single_tour_detail) {
							$cart_products_name[] = $product['name'];
							$cart_products_variation_title[] = $product['name'];
							$this->cart->remove($product['rowid']);
						}
					}
				}
			}
			$data['cart_products_name'] = $cart_products_name;
			if ($this->cart->total_items() == 0) {
				set_alert('error', "Products has been removed from your cart because no longer available!'");
				redirect('summary');
			}
			$data['cart_products_variation_title'] = $cart_products_variation_title;
			$user_information = array(
				'checkoutfirstname'  => trim($_POST['checkoutfirstname']),
				'checkoutlastname'  => trim($_POST['checkoutlastname']),
				'checkoutemail'  => trim($_POST['checkoutemail']),
				'checkoutneeds'  => trim($_POST['checkoutneeds']),
				'checkoutfoundus'  => trim($_POST['checkoutfoundus']),
				'checkouttravellingphone'  => trim($_POST['checkouttravellingphone']),
			);
			$this->session->set_userdata($user_information);
			$this->load->frontpage('frontpages', 'payment', $data);
			// echo 'In-progress';
		} else {
			// echo 'hello';die;
			redirect('information');
		}
	}
	public function thank_you()
	{
		// echo "<pre>";
		// 	print_r($this->input->post());
		// echo "</pre>"; die;

		if (empty($this->input->post())) {
			redirect('summary');
		} else if (empty($this->cart->contents())) {
			redirect('summary');
		}
		// pr($_POST);die;
		$cart_amount = price_format($this->cart->total(), 2);
		$data['title'] = 'Payment';
		$data['header_banner'] = 'yes';
		$data['meta_description'] = '';
		$data['meta_keyword'] = '';

		$data['upselling_tours'] = $this->thank_you->get_upselling_tours();
		$send_email = false;
		$cart_data['cart_contents'] = $this->cart->contents();
		$cart_data['cart_total'] = price_format($this->cart->total(), 2);;
		$cart_data['full_name'] = $this->session->userdata('checkoutfirstname') . ' ' . $this->session->userdata('checkoutlastname');
		$cart_data['email'] = $this->session->userdata('checkoutemail');
		$cart_data['special_needs'] = $this->session->userdata('checkoutneeds');
		$cart_data['found_us'] = $this->session->userdata('checkoutfoundus');
		$cart_data['phone_no'] = $this->session->userdata('checkouttravellingphone');
		$cart_data['cart_product_type'] = trim($this->input->post('product_type'));

		$user_info_session_array_items = array('checkoutfirstname', 'checkoutlastname', 'checkoutemail', 'checkoutneeds', 'checkoutfoundus', 'checkouttravellingphone');

		// redirect user to thank you page if user has added affiliate code
		if (!empty($this->input->post('affiliate_code'))) {
			$data['title'] = 'Thank you';
			$data['header_banner'] = 'yes';

			$data['success'] = 'yes';
			$send_email = true;
			$cart_data['affiliate_code'] = trim($this->input->post('affiliate_code'));
			$this->send_email_to_user($cart_data);
		} else if (!empty($this->input->post('checkoutcardnumber'))) {

			$data['title'] = 'Thank you';
			$data['header_banner'] = 'yes';
			$send_email = true;
			// card details
			$cart_data['nameoncard'] = trim($this->input->post('nameoncard'));
			$cart_data['cardnumber'] = trim($this->input->post('checkoutcardnumber'));
			$cart_data['exp_date'] = trim($this->input->post('checkoutexpirymonth')) . '/' . trim($this->input->post('checkoutexpiryyear'));
			$cart_data['cvc'] = trim($this->input->post('checkoutcardcvv'));
			// contact details
			$cart_data['checkoutaddress'] = trim($this->input->post('checkoutaddress'));
			$cart_data['checkoutcountry'] = trim($this->input->post('checkoutcountry'));
			$cart_data['checkoutcity'] = trim($this->input->post('checkoutcity'));
			$cart_data['checkoutzipcode'] = trim($this->input->post('checkoutzipcode'));

			$data['success'] = 'yes';
			$this->send_email_to_user($cart_data);
		}
		if ($send_email) {
			$booking_data = array();
			$products = $this->cart->contents();
			$subscribe = 0;
			$defult_token = '';
			$send_subscribe_email = false;
			if (isset($_POST['kepp_updated']) && !empty($_POST['kepp_updated'])) {
				$subscribe = 1;
				$defult_token = md5($cart_data['email'] . time());
			}
			if (!empty($products)) {

				// check user exist || if not store user details
				$user_details = $this->thank_you->check_user_exist($cart_data['email']);
				$user_id = 0;
				if (!empty($user_details)) {
					$user_id = $user_details['id'];
					if ($user_details['subscribe'] == 0 && (isset($_POST['kepp_updated']) && !empty($_POST['kepp_updated']))) {
						$user_data = array(
							'name' => $cart_data['full_name'],
							'email' => $cart_data['email'],
							'phone_number' => $cart_data['phone_no'],
							'subscribe' => $subscribe,
							'token' => $defult_token,
						);
						$send_subscribe_email = true;
					} else {
						$user_data = array(
							'name' => $cart_data['full_name'],
							'email' => $cart_data['email'],
							'phone_number' => $cart_data['phone_no'],
							// 'subscribe' => $subscribe,
							'token' => $defult_token,
						);
					}
					$this->thank_you->update_user($user_id, $user_data);
				} else {
					$user_data = array(
						'name' => $cart_data['full_name'],
						'email' => $cart_data['email'],
						'phone_number' => $cart_data['phone_no'],
						'subscribe' => $subscribe,
						'token' => $defult_token,
					);
					if (isset($_POST['kepp_updated']) && !empty($_POST['kepp_updated'])) {
						$send_subscribe_email = true;
					}
					$user_id = $this->thank_you->add_user($user_data);
				}

				if ($send_subscribe_email) {
					$email_subject = 'Driver In Rome | Subscribe Newsletter';
					$email_template_name = 'user-subscribe-newsletter';

					$get_email_template = get_email_template('user-subscribe-newsletter');

					if (!empty($get_email_template['subject'])) {
						$email_subject = $get_email_template['subject'];
					}
					$placeholder = ['{username}', '{welcome_image}'];
					$form_data   = [$cart_data['full_name'], EMAIL_WELCOME_PNG];

					$get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';

					$get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);

					$data['email_body'] = $get_new_email_body;
					$data['subject'] = $email_subject;

					email_sending($cart_data['email'], $data, $email_template_name);
				}


				foreach ($products as $product) {
					if (array_key_exists("transfer_detail_data", $product)) {
						// pr($product);die;
						$single_transfer_details = get_single_transfers_all_details_by_id($product['id'], array('1'));
						if (!empty($single_transfer_details['id'])) {
							// $booking_data[] = $product['name'];
							$booking_data[] = array('user_id' => $user_id, 'tour_or_transfer_id' => $product['id'], 'type' => 1, 'tour_or_transfer_name' => $product['name'], 'service_booked_date' => '');
						}
					} else if (array_key_exists("tours_detail_data", $product)) {
						$get_single_tour_detail = get_tour_product_status($product['id']);
						if ($get_single_tour_detail) {

							$convert_request_date = date("Y-m-d", strtotime($product['tours_detail_data']['request_date']));

							$booking_data[] = array('user_id' => $user_id, 'tour_or_transfer_id' => $product['id'], 'type' => 0, 'tour_or_transfer_name' => $product['name'], 'service_booked_date' => $convert_request_date);
						}
					}
				}
			}
			//  remove cart items
			if (!empty($booking_data))
				$this->db->insert_batch(TBL_BOOKING, $booking_data);

			// START add user details into active campaign automation
			$post_data = array('username' => $cart_data['full_name'], 'user_email' => $cart_data['email'], 'active_campaign_automation_id' => 0);
			$api_campaign_response = api_campaign($post_data, $add_automation = false);
			// END add user details into active campaign automation

			$this->cart->destroy();
			$this->session->unset_userdata($user_info_session_array_items);
			// array of insert data in booking table
			// $boking_data = array($cart_data['full_name'], $cart_data['email'], $cart_data['phone_no'], );

		}
		unset($_POST);
		$this->load->frontpage('frontpages', 'thank_you', $data);
	}
	public function send_email_to_user($cart_data)
	{
		// send email to user
		$cart_data['to_admin'] = false;
		$mail_content = $this->load->view('email_template/order', $cart_data, TRUE);
		$to = $cart_data['email'];
		$data['email_body'] = $mail_content;
		$data['subject'] = SITE_TITLE . ' | We have received your Itinerary';
		email_sending($to, $data, 'order', $bcc = TRUE);
		// send email to admin
		$cart_data['to_admin'] = true;
		$admin_mail_content = $this->load->view('email_template/order', $cart_data, TRUE);
		$data['email_body'] = $admin_mail_content;
		$data['subject'] = SITE_TITLE . '| Itinerary has been booked';
		email_sending($to = '', $data, 'order');
	}
}
