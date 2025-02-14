<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Authentication_model extends MY_Model
{
	
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('user_autologin');
		// $this->autologin();
		
	}

	/**
	 * Does admin login
	 *
	 * @param  str    $email      email for login
	 * @param  str    $password   User Password
	 * @param  bool   $remember   Set cookies for user if remember me is checked
	 *
	 * @return bool  True if valid user found, False otherwise
	 */
	public function admin_login($email, $password, $remember)
	{

		if ((!empty($email)) && (!empty($password)))
		{
			$this->db->where('email', $email);
			//$this->db->where('is_delete', 0);

			$user = $this->db->get(ADMIN_USERS)->row();

			if ($user)
			{
				if ($user->password != md5($password))
				{
					return ['invalid_password' => true, 'id' => $user->id];
				}
				// if ($user->role != 1)
				// {
				// 	return ['user_not_login' => true, 'id' => $user->id];
				// }
			}
			else
			{
				return ['invalid_email' => true];
			}
			
			if ($user->status == 0)
			{
				return ['user_inactive' => true, 'id' => $user->id];
			}


			$user_data = [
				'admin_user_id'        => $user->id,
				'admin_email'          => $user->email,
				'admin_username'       => $user->username,
				//'is_admin'		 => $user->role,
				'admin_logged_in' => true
			];

			$this->session->set_userdata($user_data);

			if ($remember)
			{
				set_cookie([
					'name'   => 'admin_autologin',
					'value'  => serialize([
						'admin_user_id' => $user->id,
						'admin_email'  => $user->email,
						'admin_username'       => $user->username,
						//'is_admin'	=> $user->role,
						'admin_logged_in' => true
					]),
					'expire' => 60 * 60 * 24 * 7 // 7 days
				]);
			}

			return true;
		}

		return false;
	}	

	/**
	 *
	 * Generates new password key for the user to reset the password
	 *
	 * @param  str   $email  The email from the user
	 *
	 * @return bool  True if user exists & link is sent to user email, False otherwise
	 */
	public function forgot_password($email)
	{
		$this->db->where('email', $email);
		$user = $this->db->get(ADMIN_USERS)->row_array();

		if (is_array($user) && sizeof($user)>0)
		{
			if ($user['status'] == 0)
			{
				return ['user_inactive' => true];
			}

			$new_pass_key = app_generate_hash();
			$this->db->where('id', $user['id']);
			$this->db->update(ADMIN_USERS, [
				'new_pass_key'           => $new_pass_key,
				'new_pass_key_requested' => date('Y-m-d H:i:s')
			]);
			
			if ($this->db->affected_rows() > 0)
			{
				$this->db->where('email', $email);
				$users = $this->db->get(ADMIN_USERS)->row_array();

				$msg['username']=$users['username'];
				$msg['email']=$email;

				$reset_password_link = admin_url('authentication/reset_password/').base64_encode($users['id']).'/'.$users['new_pass_key'];

				$msg['reset_password_link']=$reset_password_link;
				$body=$this->load->view('email_template/admin_forgot_password',$msg,true);
				
                $subject=SITE_TITLE." - Reset Password";                
				
				if(email_send($email,$subject,$body))
				{
					return true;
				}
				return false;
			}

			return false;			
		}

		return ['invalid_user' => true];
	}

	/**
	 * Resets user password after successful validation of the key
	 *
	 * @param  int   $user_id       The user identifier
	 * @param  str   $new_pass_key  The new pass key
	 * @param  str   $password      The password
	 *
	 * @return bool  True if the password is reset, Null otherwise
	 */
	public function reset_password($user_id, $new_pass_key, $password)
	{
		if (!$this->can_reset_password($user_id, $new_pass_key))
		{
			return ['expired' => true];
		}

		$this->db->where('id', $user_id);
		$this->db->where('new_pass_key', $new_pass_key);
		$this->db->update(ADMIN_USERS, ['password' => md5($password)]);

		if ($this->db->affected_rows() > 0)
		{
			$this->db->set('new_pass_key', null);
			$this->db->set('new_pass_key_requested', null);
			$this->db->set('last_password_change', date('Y-m-d H:i:s'));
			$this->db->where('id', $user_id);
			$this->db->where('new_pass_key', $new_pass_key);
			$this->db->update(ADMIN_USERS);

			return true;
		}

		return null;
	}

	/**
	 * Determines if the key is not expired or doesn't exists in database
	 *
	 * @param  int  $user_id       The user identifier
	 * @param  str  $new_pass_key  The new pass key
	 *
	 * @return bool True if key is active, False otherwise
	 */
	public function can_reset_password($user_id, $new_pass_key)
	{
		$this->db->where('id', $user_id);
		$this->db->where('new_pass_key', $new_pass_key);
		$user = $this->db->get(ADMIN_USERS)->row();
		
		if ($user)
		{
			$timestamp_now_minus_1_hour = time() - (60 * 60);
			$new_pass_key_requested     = strtotime($user->new_pass_key_requested);
			
			if ($timestamp_now_minus_1_hour > $new_pass_key_requested)
			{
				return false;
			}

			return true;
		}

		return false;
	}

	/**
	 * Clears the autologin & session
	 */
	public function logout()
	{
		$this->delete_autologin();

		$this->session->sess_destroy();
	}
}
?>