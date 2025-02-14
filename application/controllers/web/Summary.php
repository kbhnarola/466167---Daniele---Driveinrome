<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Summary extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->helper('file');
		$this->load->model('frontend/summary_model', 'summary');
	}

	public function index()
	{
		$data['title'] = 'Rome tour package Summary | DriverInRome';
		$data['header_banner'] = 'no';
		$data['meta_description'] = '  Pick your fav Rome tour private package, get the summary, pay the amount, and your booking to astonishing places in Italy is done. Hurry, book now with DriverInRome!';
		$data['meta_keyword'] = '';

		$cart_products_name = array();
		$cart_products_variation_title = array();
		// get cart details
		// pr($this->cart->contents());+die;
		// $this->cart->destroy();die;
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
		$data['cart_products_variation_title'] = $cart_products_variation_title;

		// $data['transfer_details'] = $this->summary->get_single_transfers_all_details_by_id();
		// pr(get_single_transfers_all_details_by_id());
		// $data = get_single_transfers_all_details_by_id();
		// if(empty($data)){}
		$this->load->frontpage('frontpages', 'summary', $data);
	}
	function remove_product_from_cart()
	{
		$return_arr = array();
		if (!empty($_POST['data_id'])) {
			$data_id = $_POST['data_id'];
			if ($this->cart->remove(base64_decode($data_id))) {
				$cart_total_items = $this->cart->total_items();
				$cart_total = number_format($this->cart->total(), 2);
				$this->session->unset_userdata('tours_data');
				echo json_encode(array('is_product_remove' => true, 'cart_total_items' => $cart_total_items, 'cart_total' => $cart_total));
			} else {
				echo json_encode(array('is_product_remove' => false));
			}
		} else {
			echo json_encode(array('is_product_remove' => false));
		}
	}
	function update_cart_item()
	{
		$return_arr = array();
		if (!empty($_POST['data_id'])) {
			// if($this->cart->remove(base64_decode($data_id))){
			$selected_variation = $_POST['selected_variation'];
			$data_cart_row_id = $_POST['data_cart_row_id'];
			$single_transfer_details = get_single_transfers_all_details_by_id(base64_decode($_POST['data_id']), array('1'));
			// pr($single_transfer_details);die;
			if (!empty($single_transfer_details['id'])) {
				$variation_prices = $single_transfer_details['transfer_price'];
				$variation_title = $single_transfer_details['variation_title'];

				$variation_prices_array = explode(", ", $variation_prices);
				$variation_title_array = explode(", ", $variation_title);

				$variation_price = $variation_prices_array[$selected_variation - 1];
				$variation_title = $variation_title_array[$selected_variation - 1];
				// check updating product is already exist in cart
				$is_exist = 'no';
				foreach ($this->cart->contents() as $product) {
					if (array_key_exists("transfer_detail_data", $product)) {
						if ($product['options']['transfer_variation_id'] == $selected_variation && $product['id'] == base64_decode($_POST['data_id'])) {
							$is_exist = 'yes';
						}
					}
				}
				if ($is_exist == 'no') {
					// update product
					$data = array(
						'rowid'      => base64_decode($data_cart_row_id),
						'price'			=> $variation_price,
						'options' => array('transfer_variation_id' => $selected_variation, 'transfer_variation_title' => $variation_title)
					);
					$this->cart->update($data);

					$cart_total = number_format($this->cart->total(), 2);
					$variation_price = price_format($variation_price);
					echo json_encode(array('is_product_update' => true, 'cart_total' => $cart_total, 'product_name' => $single_transfer_details['title'], 'variation_title' => $variation_title, 'variation_price' => $variation_price));
				} else {
					echo json_encode(array('is_product_update' => false, 'product_name' => $single_transfer_details['title'], 'variation_title' => $variation_title, 'is_product_exist' => true));
				}
			} else {
				echo json_encode(array('is_product_update' => false));
			}
		} else {
			echo json_encode(array('is_product_update' => false));
		}
	}
}
