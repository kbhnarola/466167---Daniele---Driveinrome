<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class setting_model extends MY_Model
{
	protected $_table = TBL_SETTINGS;
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

	}
}
