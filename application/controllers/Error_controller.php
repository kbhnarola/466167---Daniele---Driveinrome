<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_controller extends My_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* @author bsm
	*
	* Loads the admin dashboard
	*
	*/
	public function index()
	{
		$this->set_page_title('404 Page Not Found');
        
		//$data['content'] = $this->load->view('admin/cms_pages/index', '', TRUE);
		if ($this->uri->segment(1) == 'folio') {
		     //$this->load->view('admin/404_admin');
			if (!is_admin_logged_in())
			{
				redirect(admin_url('authentication'));
			}
		     $data['content'] = $this->load->view('admin/404_admin', '', TRUE);
        	 $this->load->view('admin/layouts/index', $data);
		     
		} else {
			$data['title'] = '404 Page Not Found';
			$data['header_banner'] = 'no';
			$this->load->frontpage('frontpages', '404', $data);
			//$this->load->view('404');
		}
		
	}
}
?>