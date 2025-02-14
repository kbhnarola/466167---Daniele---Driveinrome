<?php
use Stripe\Stripe;
use Stripe\Stripe_CardError;
use Stripe\Error;

require APPPATH.'libraries/stripe/autoload.php';
include APPPATH.'libraries/stripe/stripe/stripe-php/init.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
        parent::__construct();        
        $this->load->library('session');
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
		
		$data['title'] = "Home";

		// $data['fullname'] = 'Narola';
		// $data['fullname'] = $this->input->post('name_on_card');
		// $data['brand'] = 'Maruti';
		// $data['model'] = 'Baleno';
		// $data['subject'] = 'Payment Received';
		// $data['mail_content'] = 'Some test from all instructions.co.uk 12';
 		// send_email('demo.narola@gmail.com', $data, 'payment_success_user');

		$this->template->view('wb_template', 'pages/index',$data);
		// $this->load->view('welcome_message');
	}

	public function login(){
		$data['title'] = "Login";

		$this->template->view('wb_template', 'pages/authentication/login',$data);
	}

	public function forgot_password(){
		$data['title'] = "Forgot Password";
		
		$this->template->view('wb_template', 'pages/authentication/forgot_password',$data);
	}

	public function contact_us(){
		$data['title'] = "Contact";
		
		$this->template->view('wb_template', 'pages/contact_us',$data);
	}

	public function terms_condition(){
		$data['title'] = "Terms & Conditions";
		
		$this->template->view('wb_template', 'pages/terms_condition',$data);
	}

	public function privacy_policy(){
		$data['title'] = "Privacy Policy";
		
		$this->template->view('wb_template', 'pages/privacy_policy',$data);
	}

	public function manage_subscription(){
		$data['title'] = "Manage Subscription";
		
		$this->template->view('wb_template', 'pages/manage_subscription',$data);
	}

	public function checkout(){
		$data['title'] = "Checkout";

		$this->template->view('wb_template', 'pages/checkout',$data);
		//$this->template->view('wb_template', 'pages/payment',$data);
	}
	// public function hello(){
	// 	\Stripe\Stripe::setApiKey(SECRET_KEY);

	// 	\Stripe\ApplePayDomain::create([
	// 		'domain_name' => 'all-usermanuals.com',
	// 	]);
	// }
	public function charge(){
		// echo "<pre>";
		// 	print_r($this->input->post());
		// echo "</pre>"; die;

		\Stripe\Stripe::setApiKey(SECRET_KEY);


		// \Stripe\ApplePayDomain::create([
		// 	'domain_name' => 'example.com',
		// ]);


		$token  = $this->input->post('token');
		$email  = $this->input->post('email');
		$charge = false;
		if(!isset($token) || empty($token)){
			redirect(base_url());
			exit;
		}

		$data['brand'] = $this->input->post('brand');
		$data['model'] = $this->input->post('model');
		$data['fullname'] = $this->input->post('name_on_card');

		
		$ip= $_SERVER['REMOTE_ADDR'];
		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=". $ip)); 
		$country_currency = 'USD';
		$converted_price = 999;
		if(!empty($ipdat->geoplugin_currencyCode)){
			$country_currency = $ipdat->geoplugin_currencyCode;
			// $converted_price = round($converted_price * $ipdat->geoplugin_currencyConverter, 2);
		}


		// Fetching JSON
		$req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
		$response_json = file_get_contents($req_url);		
		// Continuing if we got a result
		if(false !== $response_json) {
			// Try/catch for json_decode operation
			try {
				// Decoding
				$response_object = json_decode($response_json);

				// YOUR APPLICATION CODE HERE, e.g.
				$base_price = 9.99; // Your price in USD
				// $converted_price = round(($base_price * $response_object->rates->$country_currency), 2);
				$converted_price = number_format(($base_price * $response_object->rates->$country_currency), 2);
			}
			catch(Exception $e) {
				// Handle JSON parse error...
			}
			
		}
		$converted_price = (int)str_replace(".", "", $converted_price);

		if($ipdat->geoplugin_countryName == 'Canada'){			
			$converted_price = 999;
			$country_currency = 'CAD';
		}
		else if($ipdat->geoplugin_countryName == 'Australia'){			
			$converted_price = 999;
			$country_currency = 'AUD';
		}

		// if(!$this->session->userdata('brand')){
			try{
				$customer = \Stripe\Customer::create([
					'email' => $email,
					'source'  => $token,
				]);

				$charge = \Stripe\Charge::create([
					'customer' => $customer->id,
					'amount'   => $converted_price,
					'currency' => strtolower($country_currency),
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
		// }
		// else{
			// $this->session->unset_userdata('brand'); 
		// }
		if($charge){
			$this->session->set_userdata('brand',$this->input->post('brand'));
			$this->load->model('Payment_model', 'payment');
			$this->payment->sqlinsert('payment', array(
					'email' => $email,
					'fullname' => $this->input->post('name_on_card'),
					'brand' => $this->input->post('brand'),
					'model' => $this->input->post('model'),
					'payment_data' => serialize($charge)
			));

			// send email to user 			
			$data['email'] = $email;			
			$data['subject'] = 'Payment Received';
			$data['payment_success'] = 'Payment Successful';
			send_email($email, $data, 'payment_success_user');
			send_email('manuals@all-usermanuals.com', $data, 'payment_success_admin');
			
			// echo "Thank you for Payment.";
			// echo "<pre>";
			// 	print_r($charge);
			// echo "</pre>";
		}
		$this->template->view('wb_template', 'pages/checkout_thankyou',$data);
	}

	public function secretKey(){
		// load Stripe library
		// Set your secret key. Remember to switch to your live secret key in production!
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey(SECRET_KEY);

		$intent = \Stripe\PaymentIntent::create([
			'amount' => 1000,
			'currency' => 'usd',
			// Verify your integration in this guide by including this parameter
			'metadata' => ['integration_check' => 'accept_a_payment'],
		]);
		echo json_encode($intent);
	}

	public function resetTimer(){
		$updatedTime = date('Y-m-d H:i:s', strtotime('10 hour'));
		update_option('countdown_timer', $updatedTime);
		echo json_encode(array('updatedtime' => $updatedTime));
		exit;
	}
	public function payment(){
		// $to = "bsmistry55@gmail.com";			
		// $data['subject'] = 'Payment Received';
		// $data['fullname'] = "Customer";
		// $data['brand'] = "iphone";
		// $data['model'] = "11";
		// error_reporting(E_ALL);
		// ini_set("display_errors", 1);
	 //    $config = array();
	    
	 //    $config['protocol'] = 'ssmtp';
	 //    $config['smtp_host'] = 'ssl://smtp.gmail.com';
	 //    $config['smtp_port'] = '465';
		// $config['smtp_user'] = 'dev.narola2020@gmail.com'; // Please change the email with your live email
	 //    $config['smtp_pass'] = 'Dev.narola@2020'; // Please change the password with above gmail account password

	    //$config['charset'] = 'utf8';
	    //$config['newline'] = "\r\n";
	    // $config['crlf'] = "\r\n";
	    // $config['priority'] = 3;
	    // $config['mailtype'] = 'html';
	    // $config['smtp_crypto'] = 'security';
	    // //$config['smtp_timeout'] = 60;
	    // //$config['validation'] = FALSE;
	    // $this->load->library('email',$config);
	    // $this->email->initialize($config);

	    // $this->email->to($to);
	    // $this->email->from('contact@all-usermanuals.com', 'All Usermanuals');
	    // $this->email->subject($data['subject']);
	    
	    // $template_path = 'email_templates/';
	    
	    // //$mail_content = $this->load->view($template_path . 'payment_success_user', $data, TRUE);
	    
	    // //$mail_content = str_replace ("\r\n", "<br>", $mail_content );
	    // $mail_content="Testing mail";
	    // $this->email->message($mail_content);
	    // $sent=$this->email->send();
	    

	    
        //echo $this->email->print_debugger();
	   // echo "mail : ".$sent;
	 //    if($sent)
		// 	echo  true;
		// else
		// 	echo false;

		$this->load->view('pages/payment');

	}
	public function success(){
		$this->load->view('pages/success');
	}

	public function charges_apple_pay(){

		\Stripe\Stripe::setApiKey(SECRET_KEY);

		//\Stripe\Stripe::setApiKey('sk_test_51IEbTZHihfPOaqL1vKizHdsOINJJ00qIpKWyr7MowMdcQ6ZFftVKh60VOITPcSUOsBtdeb0cvDANelujPeApaBeE00xbEwzNRf');
		//\Stripe\Stripe::setApiKey('sk_test_4HmT6C5DefU4BzociqBFkK3Q000XUYyKnX');

		$token  = $this->input->post('token');
		$email  = $this->input->post('email');
		$charge = false;
		if(!isset($token) || empty($token)){
			redirect(base_url());
			exit;
		}

		$data['brand'] = $this->input->post('brand');
		$data['model'] = $this->input->post('model');
		$data['fullname'] = "Customer";

		//$ip= $_SERVER['REMOTE_ADDR'];
		//$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=". $ip)); 
		$country_currency = 'USD';
		$converted_price = 999;
		//if(!empty($ipdat->geoplugin_currencyCode)){
		//	$country_currency = $ipdat->geoplugin_currencyCode;
			// $converted_price = round($converted_price * $ipdat->geoplugin_currencyConverter, 2);
		//}

		//echo $country_currency."<br>";
		// Fetching JSON
		//$req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
		//$response_json = file_get_contents($req_url);	
		//print_r($response_json);	
		// Continuing if we got a result
		// if(false !== $response_json) {
		// 	// Try/catch for json_decode operation
		// 	try {
		// 		// Decoding
		// 		$response_object = json_decode($response_json);

		// 		// YOUR APPLICATION CODE HERE, e.g.
		// 		$base_price = 9.99; // Your price in USD
		// 		// $converted_price = round(($base_price * $response_object->rates->$country_currency), 2);
		// 		$converted_price = number_format(($base_price * $response_object->rates->$country_currency), 2);
		// 	}
		// 	catch(Exception $e) {
		// 		// Handle JSON parse error...
		// 	}
			
		// }
		// $converted_price = (int)str_replace(".", "", $converted_price);
		
		// if($ipdat->geoplugin_countryName == 'Canada'){			
		// 	$converted_price = 999;
		// 	$country_currency = 'CAD';
		// }
		// else if($ipdat->geoplugin_countryName == 'Australia'){			
		// 	$converted_price = 999;
		// 	$country_currency = 'AUD';
		// }


		// if(!$this->session->userdata('brand')){
			try{
				$customer = \Stripe\Customer::create([
					'email' => $email,
					'source'  => $token,
				]);
				
				$charge = \Stripe\Charge::create([
					'customer' => $customer->id,
					'amount'   => 999,
					'currency' => strtolower($country_currency),
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
		// }
		// else{
			// $this->session->unset_userdata('brand'); 
		// }
		if($charge){
			$this->session->set_userdata('brand',$this->input->post('brand'));
			$this->load->model('Payment_model', 'payment');
			$this->payment->sqlinsert('payment', array(
					'email' => $email,
					'fullname' => "Customer",
					'brand' => $this->input->post('brand'),
					'model' => $this->input->post('model'),
					'payment_data' => serialize($charge)
			));

			// send email to user 			
			$data['email'] = $email;			
			$data['subject'] = 'Payment Received';
			$data['payment_success'] = 'Payment Successful';
			send_email($email, $data, 'payment_success_user');
			send_email('manuals@all-usermanuals.com', $data, 'payment_success_admin');
			
			// echo "Thank you for Payment.";
			// echo "<pre>";
			// 	print_r($charge);
			// echo "</pre>";
		}
		$this->session->set_flashdata('apple_pay_success',$data);
		echo json_encode($data);
		exit;
	}

	public function checkout_thankyou() {
		$data=$this->session->flashdata('apple_pay_success');
		if(is_array($data) && sizeof($data)>0) {
			$this->template->view('wb_template', 'pages/checkout_thankyou',$data);
		}
	}

	public function apple_pay(){
		$data['title'] = "Checkout";

		$this->template->view('wb_template', 'pages/apple_pay_integrate',$data);
		//$this->load->view('pages/apple_pay_integrate');
	}
}
