<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Information extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->library('cart');
		// $this->load->model('frontend/information_model', 'information');
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

		$data['title'] = 'Information';
		$data['header_banner'] = 'no';
		$data['meta_description'] = '';
		$data['meta_keyword'] = '';

		$cart_products_name = array();
		$cart_products_variation_title = array();
		$products = $this->cart->contents();
		if (!empty($products)) {
			foreach ($products as $product) {
				if (array_key_exists("transfer_detail_data", $product)) {
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
		$this->load->frontpage('frontpages', 'information', $data);
	}
	public function payment()
	{
		echo 'hello';
		die;
		if ($this->cart->total_items() == 0)
			redirect('summary');

		$data['title'] = 'Payment';
		$data['header_banner'] = 'no';

		if (!empty($_POST)) {
			echo 'name : ' . $_POST['checkoutfirstname'];
			die;
		} else {
			redirect('information');
		}


		// $cart_products_name = array();
		// $cart_products_variation_title = array();
		// $products = $this->cart->contents();
		// if(!empty($products)){
		// 	foreach ($products as $product){
		// 		$single_transfer_details = get_single_transfers_all_details_by_id($product['id'], array('1'));
		// 		if(empty($single_transfer_details['id'])){
		// 			$cart_products_name[] = $product['name'];
		// 			$cart_products_variation_title[] = $product['options']['transfer_variation_title'];
		// 			$this->cart->remove($product['rowid']);
		// 		}
		// 	}
		// }
		// $data['cart_products_name'] = $cart_products_name;
		// $data['cart_products_variation_title'] = $cart_products_variation_title;
		// $this->load->frontpage('frontpages', 'information', $data);
	}
}
