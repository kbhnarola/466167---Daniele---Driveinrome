<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Setting_model', 'settings');
        //$this->load->model('Tours_model', 'tours');
	}

	/**
	 * Loads the settings page
	 */
	public function index()
	{	
		$this->set_page_title(_l('settings'));
		$data['settings'] = get_settings();
		$data['content']  = $this->load->view('admin/settings/index', $data, TRUE);
		$this->load->view('admin/layouts/index', $data);		
	}

	/**
	 * Adds or updates setting options
	 */
	// public function add()
	// {
	// 	$this->set_page_title(_l('settings').' | '._l('add'));

	// 	if ($this->input->post())
	// 	{
	// 		foreach ($this->input->post() as $key => $value)
	// 		{
	// 			$settig_exists = $this->settings->count_by(['name' => $key]);

	// 			if ($settig_exists == 0 && $value != '')
	// 			{
	// 				$data = [
	// 					'name'  => $key,
	// 					'value' => $value
	// 				];

	// 				$this->settings->insert($data);
	// 				//log_activity("New Settings Option Created [Name: $key, Value: $value]");
	// 			}

	// 			if ($settig_exists == 1)
	// 			{
	// 				$settings = $this->settings->get_by(['name' => $key]);

	// 				if ($settings['value'] != $value && $value != '')
	// 				{
	// 					$this->settings->update($settings['id'], array('value' => $value));

	// 					//log_activity("Settings Option Updated [Name: $key, Value: $value]");
	// 				}
	// 				else

	// 				if ($value == '' || $value == null)
	// 				{
	// 					$delete = $this->settings->delete_by(['name' => $key]);
	// 					//log_activity("Settings Option Deleted [Name: $key]");
	// 				}
	// 			}
	// 		}

	// 		echo 'true';
	// 	}
	// 	else
	// 	{
	// 		redirect('admin/settings');
	// 	}
	// }
	public function add()
	{
		$this->set_page_title(_l('settings').' | '._l('add'));

		if ($this->input->post())
		{
			foreach ($this->input->post() as $key => $value)
			{
				$settig_exists = $this->settings->count_by(['name' => $key]);

				if ($settig_exists == 0 && $value != '')
				{
					$data = [
						'name'  => $key,
						'value' => $value
					];

					$this->settings->insert($data);
					//log_activity("New Settings Option Created [Name: $key, Value: $value]");
				}

				if ($settig_exists == 1)
				{
					$settings = $this->settings->get_by(['name' => $key]);

					if ($settings['value'] != $value && $value != '')
					{
						$this->settings->update($settings['id'], array('value' => $value));

						//log_activity("Settings Option Updated [Name: $key, Value: $value]");
					}
					else

					if ($value == '' || $value == null)
					{
						$delete = $this->settings->delete_by(['name' => $key]);
						//log_activity("Settings Option Deleted [Name: $key]");
					}
				}
			}
			$image_name='';
			if(is_array($_FILES) && sizeof($_FILES)>0){
				if(array_key_exists('company_logo', $_FILES) && $_FILES['company_logo']['tmp_name']!='') {
					
					$settings = $this->settings->get_by(['name' => 'company_logo']);
					if(is_array($settings) && sizeof($settings)>0){
						$config['upload_path'] = './assets/images/';
	                 	$config['allowed_types'] = '*';
						$file_name = time();
	                    $config['file_name'] = $file_name.'_company_logo';

	                    $this->load->library("upload",$config);
	                    $this->upload->initialize($config);

	                    if($this->upload->do_upload('company_logo')) {
	                        $data = array('upload_data' => $this->upload->data());
	                        $image_name= $data['upload_data']['file_name'];
	                        $this->settings->update($settings['id'], array('value' => $image_name));
	                        if($_POST['company_logo_saved']!=''){
				                if(file_exists('assets/images/'.$_POST['company_logo_saved'])) {
				                    $deleteimg= 'assets/images/'.$_POST['company_logo_saved'];
				                    unlink($deleteimg);
				                }
				            }
	                    } else {
	                           //set_alert('error',current($this->upload->display_errors()));
	                           //echo 'false';
	                    		$response['success']=false;
	                    		echo json_encode($response);
								exit;
	                    } 
	                }  else {
	                	//echo 'false';
	                	$response['success']=false;
	                	echo json_encode($response);
	                    exit;
	                }                     
                }
			}

			$response['success']=true;
			if($image_name){
				$response['imgurl']=base_url('assets/images/'.$image_name);
				$response['img_name']=$image_name;
			} else{
				$response['imgurl']='';
				$response['img_name']=$image_name;
			}
			
			//echo 'true';
			echo json_encode($response);
			exit;
		} elseif(is_array($_FILES) && sizeof($_FILES)>0){
			$image_name='';
			if(array_key_exists('company_logo', $_FILES) && $_FILES['company_logo']['tmp_name']!='') {
					
					$settings = $this->settings->get_by(['name' => 'company_logo']);
					if(is_array($settings) && sizeof($settings)>0){
						$config['upload_path'] = './assets/images/';
	                 	$config['allowed_types'] = '*';
						$file_name = time();
	                    $config['file_name'] = $file_name.'_company_logo';

	                    $this->load->library("upload",$config);
	                    $this->upload->initialize($config);

	                    if($this->upload->do_upload('company_logo')) {
	                        $data = array('upload_data' => $this->upload->data());
	                        $image_name= $data['upload_data']['file_name'];
	                        $this->settings->update($settings['id'], array('value' => $image_name));
	                       $response['success']=true;
							if($image_name){
								$response['imgurl']=base_url('assets/images/'.$image_name);
								$response['img_name']=$image_name;
							} else{
								$response['imgurl']='';
								$response['img_name']=$image_name;
							}
							echo json_encode($response);
	                   		exit;
	                    } else {
	                           //set_alert('error',current($this->upload->display_errors()));
	                          // echo 'false';
	                    	$response['success']=false;
	                    	echo json_encode($response);
	                   		exit;
	                          
	                    } 
	                }  else {
	                	//echo 'false';
	                	$response['success']=false;
	                	echo json_encode($response);
	                    exit;
	                   
	                }                     
                } else {
                	//echo 'true';
                	$response['success']=true;
                	if($image_name){
						$response['imgurl']=base_url('assets/images/'.$image_name);
						$response['img_name']=$image_name;
					} else{
						$response['imgurl']='';
						$response['img_name']=$image_name;
					}
					echo json_encode($response);
	                exit;
                }
		}
		else
		{
			//echo "fgf";
			$response['success']=false;
			echo json_encode($response);
	        exit;
			//redirect('admin/settings');
		}
	}
	/**
	 * Sends an smtp test email.
	 */
	public function send_smtp_test_email()
	{
		if ($this->input->post())
		{
			$subject = 'SMTP Setup Testing';
			$message = get_settings('email_header');
			$message .= 'This is test SMTP email. <br />If you have received this message that means your SMTP settings are set correctly.';

			$message .= str_replace('{company_name}', get_settings('company_name'), get_settings('email_footer'));
			$sent = send_email($this->input->post('test_email'), $subject, $message);

			if ($sent)
			{
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}
	}
}
