<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Admin_user_model', 'users');
	}

	/**
	* @author Nikunj Munjani(NDM)
	* 
	* redirect to edit page
	*/

	public function index(){
		redirect('admin/profile/edit');
	}

	/**
	* @author bsm
	* 
	* Updates user's personal profile details
	*/
	public function edit()
	{
		$this->set_page_title(_l('edit_profile'));
		$id = get_loggedin_user_id();

		if ($id)
		{
			$data['user']    = $this->users->get($id);
			$data['content'] = $this->load->view('admin/profile/edit', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}

		if ($this->input->post())
		{
			$username=ucwords(trim($this->input->post('username')));
			$data = array(
				'username' => $username
				);

			$update = $this->users->update($id, $data);

			if ($update)
			{
				$this->session->set_userdata('admin_username', $username);
				set_alert('success', _l('_updated_successfully', _l('profile')));
				redirect('admin/profile/edit');
			}
		}
	}

	/**
	* @author bsm
	* 
	* Updates user's password
	*/
	public function edit_password()
	{
		$id           = get_loggedin_user_id();
		$data['user'] = $this->users->get($id);

		if ($this->input->post())
		{
			$data = array
				(
				'password'             => md5($this->input->post('new_password')),
			);

			$update = $this->users->update($id, $data);

			if ($update)
			{
				set_alert('success', _l('_updated_successfully', _l('password')));
				redirect('admin/profile/edit');
			}
		}
	}

	public function check_user_oldpassword(){
		$old_password = $this->input->post('old_password');
        $id           = get_loggedin_user_id();

        $where=array("password"=>md5($old_password));
        $check_exist=$this->users->get_by($where);
        
        if($id) {            

            $where=array("id"=>$id);
            $check_exist_byid=$this->users->get_by($where);

            if(is_array($check_exist) && sizeof($check_exist) > 0) {
                if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){
                    if($check_exist['password']==$check_exist_byid['password']){
                          echo(json_encode(true));
                    } else {
                          echo(json_encode(false));
                    }
                } else {
                    echo(json_encode(false)); 
                }
            } else {
                echo(json_encode(false));
            }
        } else {
                 
            echo(json_encode(false));           
        }
        exit;
	}
}
?>