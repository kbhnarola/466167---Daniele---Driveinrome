<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authentication extends My_Controller
{

	/**
	 * Constructor for the class
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Authentication_model');
		$this->load->model('Admin_user_model', 'users');
	}

	/**
	* @author bsm
	* 
	* redirect to login page
	*/
	public function index()
	{
		$this->login();
	}

	/**
	* @author bsm
	*
	* Check login credentials are valid or not otherwise return to login page
	*
	* @param str 	$email	Email of user
	* @param str 	$password	User password
	* @param str 	$remember	remeber me value on or null
	*
	* @return error message or success message
	*
	*/
	public function login()
	{
		if (is_admin_logged_in())
		{
			redirect(admin_url('dashboard'));
		}

		if ($this->input->post())
		{
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			$remember = $this->input->post('remember');
			$user     = $this->Authentication_model->admin_login($email, $password, $remember);
			
			
			if (is_array($user) && isset($user['user_inactive']))
			{
				set_alert('error', _l('your_account_is_not_active'));
				redirect(admin_url('authentication'));
			}
			elseif (is_array($user) && isset($user['invalid_email']))
			{
				set_alert('error', _l('incorrect_email'));
				redirect(admin_url('authentication'));
			}
			elseif (is_array($user) && isset($user['invalid_password']))
			{
				set_alert('error', _l('incorrect_password'));
				redirect(admin_url('authentication'));
			}
			elseif (is_array($user) && isset($user['user_not_login']))
			{
				set_alert('error', _l('user_not_login'));
				redirect(admin_url('authentication'));
			}
			elseif ($user == false)
			{
				set_alert('error', _l('incorrect_email_or_password'));
				redirect(admin_url('authentication'));
			}


			//If previous redirect URL is set in session, redirect to that URL
			maybe_redirect_to_previous_url();

			//Else rediret to home page.
			redirect(admin_url());
		}

		$this->set_page_title(_l('login'));
		$data['content'] = $this->load->view('admin/authentication/login', '', true);
		$this->load->view('admin/authentication/index', $data);
	}

	/**
	* @author bsm
	 * Loads forgot password form & performs forgot password
	 */
	public function forgot_password()
	{
		$this->set_page_title(_l('forgot_password'));

		if (is_user_logged_in())
		{
			redirect(admin_url());
		}

		if ($this->input->post())
		{
			$success = $this->Authentication_model->forgot_password($this->input->post('email'), true);

			if (is_array($success) && isset($success['user_inactive']))
			{
				set_alert('error', _l('your_account_is_not_active'));
			}
			elseif (is_array($success) && isset($success['invalid_user']))
			{
				set_alert('error', _l('incorrect_email'));
			}
			elseif ($success == true)
			{
				set_alert('success', _l('check_email_for_resetting_password'));
			}
			else
			{
				set_alert('error', _l('error_setting_new_password_key'));
			}

			redirect(admin_url('authentication/forgot_password'));
		}

		$data['content'] = $this->load->view('admin/authentication/forgot_password', '', true);
		$this->load->view('admin/authentication/index', $data);
	}

	/**
	*@author bsm
	 * Loads reset password form & resets the password
	 *
	 * @param int  $user_id       The user identifier
	 * @param str  $new_pass_key  The new pass key
	 */
	public function reset_password($user_id = null, $new_pass_key = '')
	{		
		if (($user_id == null) || ($new_pass_key == ''))
		{
			redirect(admin_url());
		}

		$this->set_page_title(_l('reset_password'));
		$user_id=base64_decode($user_id);
		if (!$this->Authentication_model->can_reset_password($user_id, $new_pass_key))
		{
			set_alert('error', _l('password_reset_key_expired'));
			redirect(admin_url('authentication'));
		} 

		if ($this->input->post())
		{
			$success = $this->Authentication_model->reset_password($user_id, $new_pass_key, $this->input->post('password'));

			if (is_array($success) && $success['expired'] == true)
			{
				set_alert('error', _l('password_reset_key_expired'));
			}
			elseif ($success == true)
			{
				set_alert('success', _l('password_reset_message'));
				//log_activity('User Resetted the Password', $user_id);
			}
			else
			{
				set_alert('error', _l('new_password_is_same_as_old_password'));
				redirect(site_url($this->uri->uri_string()));
			}

			redirect(admin_url('authentication'));
		}

		$data['content'] = $this->load->view('admin/authentication/reset_password', '', true);
		$this->load->view('admin/authentication/index', $data);
	}

	/**
	* @author bsm
	 * Checks if user with provided email id exists or not
	 */
	public function email_exists()
	{
		$exists = $this->users->count_by('email', $this->input->post('email'));

		echo $exists;
	}


	/**
	* @author bsm
	* Does logout
	*/
	public function logout()
	{
		delete_cookie('admin_autologin');
		$this->session->sess_destroy();
		redirect(admin_url());
	}

	
}
