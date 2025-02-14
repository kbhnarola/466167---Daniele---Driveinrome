<?php
use Stripe\Stripe;
use Stripe\Stripe_CardError;
use Stripe\Error;
require APPPATH.'libraries/stripe/autoload.php';
include APPPATH.'libraries/stripe/stripe/stripe-php/init.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller {
	public function __construct()
	{
        parent::__construct();		
        $this->load->library('cart');
        $this->load->library('session');
		// $this->load->model('frontend/information_model', 'information');
    }
    public function index()
	{
        if($this->cart->total_items() == 0)
            redirect('summary');
        $data['title'] = 'Payment';
        $data['header_banner'] = 'no';
        
        if(!empty($_POST)){
            $user_information = array(
                'checkoutfirstname'  => $_POST['checkoutfirstname'],
                'checkoutlastname'  => $_POST['checkoutlastname'],
                'checkoutemail'  => $_POST['checkoutemail'],
                'checkoutneeds'  => $_POST['checkoutneeds'],
                'checkoutfoundus'  => $_POST['checkoutfoundus'],
                'checkouttravellingphone'  => $_POST['checkouttravellingphone'],
            );
            $this->session->set_userdata($user_information);
            $this->load->frontpage('frontpages', 'payment', $data);
            // echo 'In-progress';
        }else{
            // echo 'hello';die;
            redirect('information');
        }
    }
    public function charge(){
        // echo $this->input->post('token');
        // echo $this->input->post('checkoutemail');die;
		// echo "<pre>";
		// 	print_r($this->input->post());
		// echo "</pre>"; die;
		\Stripe\Stripe::setApiKey(SECRET_KEY);
		$token  = $this->input->post('token');
		$email  = $this->input->post('checkoutemail');
		$charge = false;
		if(!isset($token) || empty($token)){
			redirect(base_url());
			exit;
		}
        // $customer = \Stripe\Customer::create([
        //     'email' => $email,
        //     'source'  => $token,
        // ]);
        // $charge = \Stripe\Charge::create([
        //     'customer' => $customer->id,
        //     'amount'   => 999,
        //     'currency' => 'GBP',
        //     "description" => "Test payment from itsolutionstuff.com."
        // ]);
        // echo '$customer->id'.$customer->id;die;
		try{
			$charge =  \Stripe\Charge::create ([
                "amount" => 100,
                "currency" => "usd",
                "source" => $token,
                "description" => "Test payment from itsolutionstuff.com." 
            ]);
		}catch(\Stripe\Error\Card $e ){
			$body = $e->getJsonBody();
            $err  = $body['error'];            
			$data['payment_error'] =  $err['message']; //$response->withJson(array('error' => $err['message'] , 'statusText' => 'body text'))->withStatus(402);
		} catch (\Stripe\Error\InvalidRequest $e) {
			$data['payment_error'] = 'Invalid request';
			// return $response->withJson(array('error' => 'Invalid request' ))->withStatus(402);;
		} catch (\Stripe\Error\Authentication $e) {
			$data['payment_error'] = 'Authentication failed';
			// return $response->withJson(array('error' => 'Authentication failed' ))->withStatus(402);;
		} catch (\Stripe\Error\ApiConnection $e) {
			$data['payment_error'] = 'API Connection failed';
			// return $response->withJson(array('error' => 'API Connection failed' ))->withStatus(402);;
		} catch (\Stripe\Error\Base $e) {
			$data['payment_error'] = 'Something went wrong';
			// return $response->withJson(array('error' => 'Something went wrong' ))->withStatus(402);;
		} catch (Exception $e) {
			$data['payment_error'] = 'Something went wrong';
			// return $response->withJson(array('error' => 'Something went wrong' ))->withStatus(402);;
        }
        // pr($err);die;
        echo $data['payment_error'];die;
		if($charge){
            // redirect('information');
			// $this->load->model('Payment_model', 'payment');
			// $this->payment->sqlinsert('payment', array(
			// 		'email' => $email,
			// 		'fullname' => $this->input->post('name_on_card'),
			// 		'brand' => $this->input->post('brand'),
			// 		'model' => $this->input->post('model'),
			// 		'payment_data' => serialize($charge)
			// ));
			// send email to user 
			// $data['fullname'] = $this->input->post('name_on_card');
			// $data['email'] = $email;
			// $data['brand'] = $this->input->post('brand');
			// $data['model'] = $this->input->post('model');
			// $data['subject'] = 'Payment Received';
			// $data['payment_success'] = 'Payment Successful';
			// send_email($email, $data, 'payment_success_user');
			// send_email('contact@all-instructions.co.uk', $data, 'payment_success_admin');
			
			// echo "Thank you for Payment.";
			// echo "<pre>";
			// 	print_r($charge);
            // echo "</pre>";
            $data['success'] = 'yes';
            $this->load->frontpage('frontpages', 'payment', $data);
		}
		// $this->template->view('wb_template', 'pages/checkout_thankyou',$data);
	}

	public function submit_order(){
		if($this->input->post()){
			if(array_key_exists('affiliate_code', $this->input->post())) {
				$affiliate_code=$this->input->post('affiliate_code');
				$cart_data=$this->cart->contents();
				if($this->cart->total_items()>0){
					foreach($cart_data as $c){
						if(array_key_exists('tours_detail_data', $c)){
							
						}
					}
				}
			}
		} else {
			redirect('');
		}	
	}
	public function thank_you(){
		
		$cart_amount = price_format($this->cart->total(), 2);
		if($this->cart->total_items() == 0)
			redirect('summary');
			
		$data['title'] = 'Payment';
		$data['header_banner'] = 'no';

		\Stripe\Stripe::setApiKey(SECRET_KEY);

		$token  = $this->input->post('token');
		$email  = $this->input->post('checkoutemail');
		$charge = false;
		if(!isset($token) || empty($token)){
			redirect(base_url());
			exit;
		}
		try{
            // $customer = \Stripe\Customer::create([
			// 	'email' => $email,
			// 	'source'  => $token,
            // ]);
            // pr($customer);die;
			$charge =  \Stripe\Charge::create ([
                // 'customer' => $customer->id,
                "amount" => $cart_amount * 100,
                "currency" => "eur",
                "source" => $token,
                "description" => "Test payment from itsolutionstuff.com." 
            ]);
		}catch(\Stripe\Error\Card $e ){
			$body = $e->getJsonBody();
            $err  = $body['error'];            
			$data['payment_error'] =  $err['message']; //$response->withJson(array('error' => $err['message'] , 'statusText' => 'body text'))->withStatus(402);
		} catch (\Stripe\Error\InvalidRequest $e) {
			$data['payment_error'] = 'Invalid request';
			// return $response->withJson(array('error' => 'Invalid request' ))->withStatus(402);;
		} catch (\Stripe\Error\Authentication $e) {
			$data['payment_error'] = 'Authentication failed';
			// return $response->withJson(array('error' => 'Authentication failed' ))->withStatus(402);;
		} catch (\Stripe\Error\ApiConnection $e) {
			$data['payment_error'] = 'API Connection failed';
			// return $response->withJson(array('error' => 'API Connection failed' ))->withStatus(402);;
		} catch (\Stripe\Error\Base $e) {
			$data['payment_error'] = 'Something went wrong';
			// return $response->withJson(array('error' => 'Something went wrong' ))->withStatus(402);;
		} catch (Exception $e) {
			$data['payment_error'] = 'Something went wrong';
			// return $response->withJson(array('error' => 'Something went wrong' ))->withStatus(402);;
        }
        // pr($err);die;
        // echo $data['payment_error'];die;
		if($charge){
			$data['title'] = 'Thank you';
			$data['header_banner'] = 'yes';
			$this->cart->destroy();
			// send email to user 
			// $data['fullname'] = $this->input->post('name_on_card');
			// $data['email'] = $email;
			// $data['brand'] = $this->input->post('brand');
			// $data['model'] = $this->input->post('model');
			// $data['subject'] = 'Payment Received';
			// $data['payment_success'] = 'Payment Successful';
			// send_email($email, $data, 'payment_success_user');
			// send_email('contact@all-instructions.co.uk', $data, 'payment_success_admin');
			
			// echo "Thank you for Payment.";
			// echo "<pre>";
			// 	print_r($charge);
            // echo "</pre>";
            $data['success'] = 'yes';
            $this->load->frontpage('frontpages', 'thank_you', $data);
		}
		$this->load->frontpage('frontpages', 'payment', $data);
	}
}