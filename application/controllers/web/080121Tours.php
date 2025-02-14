<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tours extends Frontend_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->model('Tours_model', 'tours');

	}

	public function index(){        

		//$this->set_page_title(_l('tours'));
		$data['title'] = 'Driverinrome | Tours | Tour Details';
		$tour_slug=strtolower(trim($this->uri->segment(2)));

		$toursData = $this->tours->get_tour_details($tour_slug);
		
		if(is_array($toursData) && sizeof($toursData)>0){
			$data['toursData']=$toursData;
			// echo "<pre>";
			// print_r($toursData);
			// exit;
			$this->load->frontpage('frontpages', 'tour_details', $data);
		} else {
			set_alert('error',"Records Not Found");
			redirect('');
		}	
	}	

}

?>