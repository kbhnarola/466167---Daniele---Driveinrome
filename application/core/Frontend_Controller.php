<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Common Controller for all front-end controllers
 */
class Frontend_Controller extends My_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
	}
}
