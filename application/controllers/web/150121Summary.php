<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summary extends CI_Controller {
	public function __construct()
	{
        parent::__construct();		
        $this->load->library('cart');
		$this->load->model('frontend/summary_model', 'summary');
    }
    
    public function index()
	{   

        $data['title'] = 'Summary';
		$data['header_banner'] = 'no';
		$cart_products_name = array();
		$cart_products_variation_title = array();
		// get cart details
		// pr($this->cart->contents());die;
		$products = $this->cart->contents();
		// print_r($products);
		// exit;
		if(!empty($products)){
			foreach ($products as $product){
				if(!array_key_exists("tours_detail_data", $product)){
					$single_transfer_details = get_single_transfers_all_details_by_id($product['id'], array('1'));
					if(empty($single_transfer_details['id'])){
						$cart_products_name[] = $product['name'];
						$cart_products_variation_title[] = $product['options']['transfer_variation_title'];
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
	function remove_product_from_cart(){
		$return_arr = array();
		if(!empty($_POST['data_id'])){
			$data_id = $_POST['data_id'];			
			if($this->cart->remove(base64_decode($data_id))){
				$cart_total_items = $this->cart->total_items();
				$cart_total = number_format($this->cart->total(), 2);
				$this->session->unset_userdata('tours_data');
				echo json_encode(array( 'is_product_remove' => true, 'cart_total_items' => $cart_total_items, 'cart_total' => $cart_total));
			}else{
				echo json_encode(array( 'is_product_remove' => false));
			}			
		}else{
			echo json_encode(array( 'is_product_remove' => false));
		}	
	}
}