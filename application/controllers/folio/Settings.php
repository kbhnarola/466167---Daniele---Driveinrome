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
		$data['platform_review_detail'] = '';
		$plat_settings = $this->settings->get_by(['name' => 'platform_review_detail']);
				
		if (array_key_exists("review_links", $this->input->post())) {
			$links = $this->input->post("review_links[]");
			$review_platform_name = $this->input->post("review_platform_name[]");
			$review_platform_rating = $this->input->post("review_platform_rating[]");
			$review_based_on = $this->input->post("review_based_on[]");
			$exclude_footer = $this->input->post("exclude_footer[]") ?? [];
			$exclude_review_page = $this->input->post("exclude_review_page[]") ?? [];
			$links_array = array();
			foreach ($links as $key => $value) {
				$links_array[$key]['review_links'] = $links[$key];
				$links_array[$key]['review_platform_name'] = ucwords(trim($review_platform_name[$key]));
				$links_array[$key]['review_platform_rating'] = ucwords(trim($review_platform_rating[$key]));
				$links_array[$key]['review_based_on'] = ucwords(trim($review_based_on[$key]));
				$links_array[$key]['exclude_footer'] = ucwords(trim($exclude_footer[$key] ?? ''));
				$links_array[$key]['exclude_review_page'] = ucwords(trim($exclude_review_page[$key] ?? ''));
			}
			$data['platform_review_detail'] = $links_array;
		}
		$review_image = array();
		if (isset($_FILES['review_image'])) {
			if(array_key_exists('review_image', $_FILES) && $_FILES['review_image']['tmp_name']!='') {
				$config['upload_path'] = './assets/images/review_imgs';
				$config['allowed_types'] = '*';
				foreach ($_FILES as $key => $value) {
					if ($key == "review_image") {
						$files = $_FILES["review_image"];
						if (is_array($files) && sizeof($files) > 0) {
							foreach ($files['name'] as $key => $value) {
								if ($files['name'][$key]) {
									$_FILES['review_image[]']['name'] = $files['name'][$key];
									$_FILES['review_image[]']['type'] = $files['type'][$key];
									$_FILES['review_image[]']['tmp_name'] = $files['tmp_name'][$key];
									$_FILES['review_image[]']['error'] = $files['error'][$key];
									$_FILES['review_image[]']['size'] = $files['size'][$key];
									$file_name = time().$key;
									$config['file_name'] = $file_name;
									$this->load->library("upload", $config);
									$this->upload->initialize($config);
									if ($this->upload->do_upload('review_image[]')) {
										$upload_data = array('upload_data' => $this->upload->data());
										$imgname = $upload_data['upload_data']['file_name'];
										$data['platform_review_detail'][$key]['review_image'] = $imgname;									
									} else {
										$response['success']=false;
										echo json_encode($response);
										exit;
									}
								}
								else{
									foreach (unserialize($plat_settings['value']) as $file_key => $value) {
										if($key == $file_key){
											$data['platform_review_detail'][$key]['review_image'] = $value['review_image'];	
										}
									}
								}
							}
						}
					}
				}
			}	
			$data['platform_review_detail'] = serialize($data['platform_review_detail']);	
		}

		$postData = array_merge($_POST,$data);
		$keys_to_unset = array("review_links", "review_platform_name", "review_platform_rating", "review_based_on", "exclude_footer", "exclude_review_page");

		foreach ($keys_to_unset as $key) {
			unset($postData[$key]);
		}
		if ($postData)
		{
			foreach ($postData as $key => $value)
			{
				$settig_exists = $this->settings->count_by(['name' => $key]);

				if($key == 'hide_villa_advertisement'){
					if($value == 'on'){
						$value = 1;
					}
				}

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
			$home_banner1='';
			$home_banner2='';
			$home_banner3='';
			$blog_banner='';
			$villa_popup_banner='';
			
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

                if(array_key_exists('home_banner1', $_FILES) && $_FILES['home_banner1']['tmp_name']!='') {
					
					$settings = $this->settings->get_by(['name' => 'home_banner1']);
					// print_r($settings)."test";
					// exit;
					if(is_array($settings) && sizeof($settings)>0){
						$config['upload_path'] = './assets/images/home_page_banner/';
	                 	$config['allowed_types'] = '*';
						$file_name = time();
	                    $config['file_name'] = $file_name;

	                    $this->load->library("upload",$config);
	                    $this->upload->initialize($config);

	                    if($this->upload->do_upload('home_banner1')) {
	                        $data = array('upload_data' => $this->upload->data());
	                        $home_banner1= $data['upload_data']['file_name'];
	                        $this->settings->update($settings['id'], array('value' => $home_banner1));
	                        if($_POST['banner1_saved']!=''){
				                if(file_exists('assets/images/home_page_banner/'.$_POST['banner1_saved'])) {
				                    $deleteimg= 'assets/images/home_page_banner/'.$_POST['banner1_saved'];
				                    unlink($deleteimg);
				                }
				            }
	                    } else {
	                    		$response['success']=false;
	                    		echo json_encode($response);
								exit;
	                    } 
	                }  else {
	                	
	                	$response['success']=false;
	                	echo json_encode($response);
	                    exit;
	                }                     
                }
                if(array_key_exists('blog_banner', $_FILES) && $_FILES['blog_banner']['tmp_name']!='') {
					
					$settings = $this->settings->get_by(['name' => 'blog_banner']);
					// print_r($settings)."test";
					// exit;
					if(is_array($settings) && sizeof($settings)>0){
						$config['upload_path'] = './assets/images/blog_banner/';
	                 	$config['allowed_types'] = '*';
						$file_name = time();
	                    $config['file_name'] = $file_name;

	                    $this->load->library("upload",$config);
	                    $this->upload->initialize($config);

	                    if($this->upload->do_upload('blog_banner')) {
	                        $data = array('upload_data' => $this->upload->data());
	                        $blog_banner= $data['upload_data']['file_name'];
	                        $this->settings->update($settings['id'], array('value' => $blog_banner));
	                        if($_POST['blog_banner_saved']!=''){
				                if(file_exists('assets/images/blog_banner/'.$_POST['blog_banner_saved'])) {
				                    $deleteimg= 'assets/images/blog_banner/'.$_POST['blog_banner_saved'];
				                    unlink($deleteimg);
				                }
				            }
	                    } else {
	                    		$response['success']=false;
	                    		echo json_encode($response);
								exit;
	                    } 
	                }  else {
	                	
	                	$response['success']=false;
	                	echo json_encode($response);
	                    exit;
	                }                     
                }

                if(array_key_exists('home_banner2', $_FILES) && $_FILES['home_banner2']['tmp_name']!='') {
					
					$settings = $this->settings->get_by(['name' => 'home_banner2']);
					if(is_array($settings) && sizeof($settings)>0){
						$config['upload_path'] = './assets/images/home_page_banner/';
	                 	$config['allowed_types'] = '*';
						$file_name = time();
	                    $config['file_name'] = $file_name;

	                    $this->load->library("upload",$config);
	                    $this->upload->initialize($config);

	                    if($this->upload->do_upload('home_banner2')) {
	                        $data = array('upload_data' => $this->upload->data());
	                        $home_banner2= $data['upload_data']['file_name'];
	                        $this->settings->update($settings['id'], array('value' => $home_banner2));
	                        if($_POST['banner2_saved']!=''){
				                if(file_exists('assets/images/home_page_banner/'.$_POST['banner2_saved'])) {
				                    $deleteimg= 'assets/images/home_page_banner/'.$_POST['banner2_saved'];
				                    unlink($deleteimg);
				                }
				            }
	                    } else {
	                    		$response['success']=false;
	                    		echo json_encode($response);
								exit;
	                    } 
	                }  else {
	                	
	                	$response['success']=false;
	                	echo json_encode($response);
	                    exit;
	                }                     
                }

                if(array_key_exists('home_banner3', $_FILES) && $_FILES['home_banner3']['tmp_name']!='') {
					
					$settings = $this->settings->get_by(['name' => 'home_banner3']);
					if(is_array($settings) && sizeof($settings)>0){
						$config['upload_path'] = './assets/images/home_page_banner/';
	                 	$config['allowed_types'] = '*';
						$file_name = time();
	                    $config['file_name'] = $file_name;

	                    $this->load->library("upload",$config);
	                    $this->upload->initialize($config);

	                    if($this->upload->do_upload('home_banner3')) {
	                        $data = array('upload_data' => $this->upload->data());
	                        $home_banner3= $data['upload_data']['file_name'];
	                        $this->settings->update($settings['id'], array('value' => $home_banner3));
	                        if($_POST['banner3_saved']!=''){
				                if(file_exists('assets/images/home_page_banner/'.$_POST['banner3_saved'])) {
				                    $deleteimg= 'assets/images/home_page_banner/'.$_POST['banner3_saved'];
				                    unlink($deleteimg);
				                }
				            }
	                    } else {
	                    		$response['success']=false;
	                    		echo json_encode($response);
								exit;
	                    } 
	                }  else {
	                	
	                	$response['success']=false;
	                	echo json_encode($response);
	                    exit;
	                }                     
                }

				// Villa popup banner image
				if(array_key_exists('villa_popup_banner', $_FILES) && $_FILES['villa_popup_banner']['tmp_name']!='') {
					
					$settings = $this->settings->get_by(['name' => 'villa_popup_banner']);
					// print_r($settings)."test";
					// exit;
					if(is_array($settings) && sizeof($settings)>0){
						$config['upload_path'] = './uploads/villa_popup_banner/';
						$config['allowed_types'] = '*';
						$file_name = time();
						$config['file_name'] = $file_name;

						$this->load->library("upload",$config);
						$this->upload->initialize($config);

						if($this->upload->do_upload('villa_popup_banner')) {
							$data = array('upload_data' => $this->upload->data());
							$villa_popup_banner= $data['upload_data']['file_name'];
							$this->settings->update($settings['id'], array('value' => $villa_popup_banner));
							if($_POST['villa_popup_banner_saved']!=''){
								if(file_exists('uploads/villa_popup_banner/'.$_POST['villa_popup_banner_saved'])) {
									$deleteimg= 'uploads/villa_popup_banner/'.$_POST['villa_popup_banner_saved'];
									unlink($deleteimg);
								}
							}
						} else {
								$response['success']=false;
								echo json_encode($response);
								exit;
						} 
					}  else {
						
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

			if($home_banner1){
				$response['home_banner1_url']=base_url('assets/images/home_page_banner/'.$home_banner1);
				$response['home_banner1']=$home_banner1;
			} else{
				$response['home_banner1_url']='';
				$response['home_banner1']=$home_banner1;
			}
			if($blog_banner){
				$response['blog_banner_url']=base_url('assets/images/blog_banner/'.$blog_banner);
				$response['blog_banner']=$blog_banner;
			} else{
				$response['blog_banner_url']='';
				$response['blog_banner']=$blog_banner;
			}

			if($home_banner2){
				$response['home_banner2_url']=base_url('assets/images/home_page_banner/'.$home_banner2);
				$response['home_banner2']=$home_banner2;
			} else{
				$response['home_banner2_url']='';
				$response['home_banner2']=$home_banner2;
			}

			if($home_banner3){
				$response['home_banner3_url']=base_url('assets/images/home_page_banner/'.$home_banner3);
				$response['home_banner3']=$home_banner3;
			} else{
				$response['home_banner3_url']='';
				$response['home_banner3']=$home_banner3;
			}
			if($villa_popup_banner){
				$response['villa_popup_banner_url']=base_url('uploads/villa_popup_banner/'.$villa_popup_banner);
				$response['villa_popup_banner']=$villa_popup_banner;
			} else{
				$response['villa_popup_banner_url']='';
				$response['villa_popup_banner']=$villa_popup_banner;
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

	public function change_minifyjs_status() {

        $data    = array('value' => $this->input->post('is_active'));
        $update = $this->settings->update_by(array("name"=>"minify_js"), $data);

        if ($update) {
            if ($this->input->post('is_active') == 1)
            {
                $response['success']=true;
                $response['msg']='true';
                $response['alert_msg']=_l('_activated', 'Minify js');
            }
            else
            {
                $response['success']=true;
                $response['msg']='false';
                $response['alert_msg']=_l('_deactivated', 'Minify js');
            }
        } else {
            $response['success']=false;
            $response['alert_msg']=_l('something_wrong');
        }
        echo json_encode($response);
        exit;
	}

	public function hide_show_villa_advertisement() {

        $data    = array('value' => $this->input->post('is_hide'));
        $update = $this->settings->update_by(array("name"=>"hide_villa_advertisement"), $data);

        if ($update) {
            if ($this->input->post('is_hide') == 0)
            {
                $response['success']=true;
                $response['msg']='true';
                $response['alert_msg']= 'Show villa advertisement';
            }
            else
            {
                $response['success']=true;
                $response['msg']='false';
                $response['alert_msg']='Hide villa advertisement';
            }
        } else {
            $response['success']=false;
            $response['alert_msg']=_l('something_wrong');
        }
        echo json_encode($response);
        exit;
	}
}
