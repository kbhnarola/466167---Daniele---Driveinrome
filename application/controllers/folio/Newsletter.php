<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends Admin_Controller
{
    /**
    * Constructor for the class
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Newsletter_model', 'newsletter');
        $this->load->model('Users_model', 'users_model');
        $this->load->model('Tours_model', 'tours');
        $this->load->helper('file');
    }
    /**
    * Loads the list of Users.
    */
    public function index()
    {
        $this->set_page_title(_l('newsletter'));
        $data['content'] = $this->load->view('admin/manage_newsletter/index', '', TRUE);
        $this->load->view('admin/layouts/index', $data);
    }

    public function getLists()
    {
        $data = $row = array();

        // Fetch newsletter list
        $memData = $this->newsletter->getRows($_POST);
        // echo $this->db->last_query();
        // exit;
        $i = $_POST['start'];
        $j=0;
        foreach($memData as $newsletter){
            
            // $data[$j]['RecordID']=$i+1;
            $data[$j]['subject'] = $newsletter->newsletter_subject;
            $data[$j]['status'] = $newsletter->status;
            $data[$j]['id'] = $newsletter->id;
            $data[$j]['action']=base64_encode($newsletter->id);
            $j++;
            $i++;
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->newsletter->countFiltered($_POST),
            "recordsFiltered" => $this->newsletter->countFiltered($_POST),
            "aaData" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
        exit;
    }

    public function add() {
        if($this->input->post()) {
            $subject=trim(ucfirst($this->input->post('newsletter_subject')));
            $newsletter_content=trim($this->input->post('newsletter_content'));
            $newsletter_content_more=trim($this->input->post('newsletter_content_more'));
        
            $tour_image1="";
            $tour_image2="";
            if(is_array($_FILES) && $_FILES['tour_image1']['tmp_name']!="") {
            
                $config['upload_path'] = './uploads/newsletter_images/';
                $config['allowed_types'] = '*';

                foreach ($_FILES as $key=>$value) {
                    if($key == "tour_image1") {
                        if($value["name"]) {
                            
                            $file_name = pathinfo($value["name"], PATHINFO_FILENAME).'-'.time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload",$config);
                            $this->upload->initialize($config);

                            if($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $tour_image1= $data['upload_data']['file_name'];
                            } 
                            else {
                                //set_alert('error',current($this->upload->display_errors()));
                                $response['success']=false;
                                if(is_array($this->upload->display_errors())) {
                                    $response['error_msg']=current($this->upload->display_errors());
                                } else {
                                    $response['error_msg']=$this->upload->display_errors();
                                }
                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                    if($key == "tour_image2") {
                        if($value["name"]) {
                            
                            $file_name = pathinfo($value["name"], PATHINFO_FILENAME).'-'.time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload",$config);
                            $this->upload->initialize($config);

                            if($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $tour_image2= $data['upload_data']['file_name'];
                            } 
                            else {
                                $response['success']=false;
                                if(is_array($this->upload->display_errors())) {
                                    $response['error_msg']=current($this->upload->display_errors());
                                } else {
                                    $response['error_msg']=$this->upload->display_errors();
                                }
                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                }
            }
            $newsletter_data = array( 
                    'email_content' => $newsletter_content,
                    'newsletter_subject' => $subject,
                    'tour_image_1' => $tour_image1,
                    'tour_image1_url' =>trim($this->input->post('tour_image1_url')),
                    'tour_image_2' => $tour_image2,
                    'tour_image2_url' => trim($this->input->post('tour_image2_url')),
                    'newsletter_content_2' => $newsletter_content_more,
                    'is_draft' => $this->input->post('is_draft')
                );
            
            $ins_id=$this->newsletter->insert($newsletter_data);   
            if($ins_id) {
                set_alert('success', _l('_added_successfully', _l('newsletter')));                
            } else {
                set_alert('error', _l('something_wrong'));
            }
            redirect(admin_url('newsletter'));
        } else {
            $this->set_page_title('Add Newsletter');
            
            $data['content'] = $this->load->view('admin/manage_newsletter/add', '', TRUE);
            $this->load->view('admin/layouts/index', $data);
        }
    }

    public function delete()
    {
        $newsletter_id = base64_decode($this->input->post('newsletter_id'));
        
        $where=array('id'=>$newsletter_id);
        $getNewsletter=$this->newsletter->get_by($where);
        $tour_image1 = $tour_image2 = "";
        if(is_array($getNewsletter) && sizeof($getNewsletter)>0) {
            $tour_image1=$getNewsletter['tour_image_1'];
            $tour_image2=$getNewsletter['tour_image_2'];
        }
        $deleted = $this->newsletter->delete_by(array("id"=>$newsletter_id));

        $response=array();
        if ($deleted) {
            
            if($tour_image1!='') {
                if(file_exists('uploads/newsletter_images/'.$tour_image1)) {
                    $deleteimg= 'uploads/newsletter_images/'.$tour_image1;
                    unlink($deleteimg);
                }
            }
            if($tour_image2!='') {
                if(file_exists('uploads/newsletter_images/'.$tour_image2)) {
                    $deleteimg= 'uploads/newsletter_images/'.$tour_image2;
                    unlink($deleteimg);
                }
            }

           $response['success']=true;
           $response['msg']=_l('_deleted_successfully', _l('newsletter'));
            
        } else {
            $response['success']=false;
            $response['msg']=_l('something_wrong');
        }
        
        echo json_encode($response);
        exit;
    }

    public function edit($id = '') {
        if ($id) {
            $this->set_page_title(_l('edit_newsletter'));
            $where=array("id"=>base64_decode($id));
            $newsletterData = $this->newsletter->get_by($where);
            if(is_array($newsletterData) && sizeof($newsletterData)>0) {
                $data['newsletterData']=$newsletterData;
                $data['content'] = $this->load->view('admin/manage_newsletter/edit', $data, TRUE);
                $this->load->view('admin/layouts/index', $data);
            } else {
                set_alert('error', 'Records not found');
                redirect(admin_url("newsletter"));
                exit;
            }   
        } else {
            redirect(admin_url("newsletter"));
            exit;
        }
    }

    public function update() {

        if($this->input->post()) {
            $subject=trim(ucfirst($this->input->post('newsletter_subject')));
            $newsletter_content=trim($this->input->post('newsletter_content'));
            $newsletter_content_more=trim($this->input->post('newsletter_content_more'));
        
            $tour_image1="";
            $tour_image2="";
            if(is_array($_FILES) && sizeof($_FILES)>0) {
            
                $config['upload_path'] = './uploads/newsletter_images/';
                $config['allowed_types'] = '*';
                foreach ($_FILES as $key=>$value) {
                    if($key == "tour_image1") {
                        if($value["name"]) {
                            
                            $file_name = pathinfo($value["name"], PATHINFO_FILENAME).'-'.time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload",$config);
                            $this->upload->initialize($config);

                            if($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $tour_image1= $data['upload_data']['file_name'];
                            } 
                            else {
                                //set_alert('error',current($this->upload->display_errors()));
                                $response['success']=false;
                                if(is_array($this->upload->display_errors())) {
                                    $response['error_msg']=current($this->upload->display_errors());
                                } else {
                                    $response['error_msg']=$this->upload->display_errors();
                                }
                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                    if($key == "tour_image2") {
                        if($value["name"]) {
                            
                            $file_name = pathinfo($value["name"], PATHINFO_FILENAME).'-'.time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload",$config);
                            $this->upload->initialize($config);

                            if($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $tour_image2= $data['upload_data']['file_name'];
                            } 
                            else {
                                $response['success']=false;
                                if(is_array($this->upload->display_errors())) {
                                    $response['error_msg']=current($this->upload->display_errors());
                                } else {
                                    $response['error_msg']=$this->upload->display_errors();
                                }
                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                }
            }
            $newsletter_data = array( 
                    'email_content' => $newsletter_content,
                    'newsletter_subject' => $subject,                   
                    'tour_image1_url' =>trim($this->input->post('tour_image1_url')),
                    'tour_image2_url' => trim($this->input->post('tour_image2_url')),
                    'newsletter_content_2' => $newsletter_content_more,
                    'is_draft' => $this->input->post('is_draft')
                );
            if($tour_image1) {
                $newsletter_data["tour_image_1"]=$tour_image1;
            }
            if($tour_image2) {
                $newsletter_data["tour_image_2"]=$tour_image2;
            }
            $newsletter_id=base64_decode($this->input->post('newsletter_id'));
            if($newsletter_id) {

                $update_data=$this->newsletter->update_by(array("id"=>$newsletter_id),$newsletter_data);                
                if($update_data) {
                    set_alert('success', _l('_updated_successfully', _l('newsletter')));
                } else {
                    set_alert('error', _l('something_wrong'));
                }
            } else {
                set_alert('error', _l('something_wrong'));
            }
            redirect(admin_url('newsletter'));
        } else {
            redirect(admin_url('newsletter'));
        }
    }



    public function preview_newsletter() {
        if($this->input->post()) {
            $subject=trim($this->input->post('newsletter_subject'));
            $newsletter_content=trim($this->input->post('newsletter_content'));
            $newsletter_content_more=trim($this->input->post('newsletter_content_more'));

            $tour_image1="";
            $tour_image2="";
            if(!empty($this->input->post('tour_img_1'))){
                $tour_image1 = $this->input->post('tour_img_1');
            }
            if(!empty($this->input->post('tour_img_2'))){
                $tour_image2 = $this->input->post('tour_img_2');
            }
            if(is_array($_FILES) && $_FILES['tour_image1']>0) {
            
                $config['upload_path'] = './uploads/newsletter_images/';
                $config['allowed_types'] = '*';

                foreach ($_FILES as $key=>$value) {
                    if($key == "tour_image1") {
                        if($value["name"]) {
                            
                            $file_name = pathinfo($value["name"], PATHINFO_FILENAME).'-'.time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload",$config);
                            $this->upload->initialize($config);

                            if($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $tour_image1= $data['upload_data']['file_name'];
                            } 
                            else {
                                //set_alert('error',current($this->upload->display_errors()));

                                $response['success']=false;
                                if(is_array($this->upload->display_errors())) {
                                    $response['error_msg']=current($this->upload->display_errors());
                                } else {
                                    $response['error_msg']=$this->upload->display_errors();
                                }
                                
                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                    if($key == "tour_image2") {
                        if($value["name"]) {
                            
                            $file_name = pathinfo($value["name"], PATHINFO_FILENAME).'-'.time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload",$config);
                            $this->upload->initialize($config);

                            if($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $tour_image2= $data['upload_data']['file_name'];
                            } 
                            else {
                                $response['success']=false;
                                if(is_array($this->upload->display_errors())) {
                                    $response['error_msg']=current($this->upload->display_errors());
                                } else {
                                    $response['error_msg']=$this->upload->display_errors();
                                }
                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                }
            }
            $data['title'] = $subject;
            $data['username'] = $this->session->userdata('admin_username');
            $data['newsletter_content'] = $newsletter_content;
            $data['newsletter_content_more'] = $newsletter_content_more;
            $data['tour_image1'] = $tour_image1;
            if($this->input->post('tour_image1_url')){
                $data['tour_image1_url'] = trim($this->input->post('tour_image1_url'));
            } else {
                $data['tour_image1_url'] = "javascript:";
            }
            $data['tour_image2'] = $tour_image2;
            if($this->input->post('tour_image2_url')){
                $data['tour_image2_url'] = trim($this->input->post('tour_image2_url'));
            } else {
                $data['tour_image2_url'] = "javascript:";
            }

            $template_path = 'email_template/';
            $message = $this->load->view($template_path.'header', $data, TRUE);
            //$message = $this->load->view($template_path.'newsletter_template_header', $data, TRUE);
            $message .= $this->load->view($template_path.'admin_newsletter_temp', $data, TRUE);
            //$message .= $this->load->view($template_path.'newsletter_template_footer', $data, TRUE);
            $message .= $this->load->view($template_path.'footer', $data, TRUE);
            //echo $message;
            $response['success']= true;
            $response['message']= $message;
            echo json_encode($response);
            exit;
        } else {
            redirect(admin_url('dashboard'));
            exit;   
        }
    }

    public function isNewsletterTitleExists()
    {
        $newsletter_subject = trim($this->input->post('newsletter_subject'));
        $newsletter_id = base64_decode($this->input->post('newsletter_id'));

        $where=array("newsletter_subject"=>$newsletter_subject);
        $check_exist=$this->newsletter->get_by($where);
        
        if($newsletter_id) { 
            $where=array("id"=>$newsletter_id);
            $check_exist_byid=$this->newsletter->get_by($where);

            if(is_array($check_exist) && sizeof($check_exist) > 0) {
                if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){
                    if($check_exist['newsletter_subject']==$check_exist_byid['newsletter_subject']){
                          echo(json_encode(true));
                    } else {
                          echo(json_encode(false));
                    }
                } else {
                    echo(json_encode(false)); 
                }
            } else {
                echo(json_encode(true));
            }
        }
        else{
            if(is_array($check_exist) && sizeof($check_exist) > 0) {          
                echo(json_encode(false));           
            } else {
                echo(json_encode(true));
            }
        }               
        exit;
    }

    public function delete_attachment() {
        
        $newsletter_id=base64_decode($this->input->post('newsletter_id'));
        
        if($newsletter_id){
            $data=$this->newsletter->get_by(array('id'=>$newsletter_id));
            if(is_array($data) && sizeof($data)>0){

                $upd_data=array("tour_image_1"=>"");
                $update=$this->newsletter->update_by(array("id"=>$newsletter_id), $upd_data);
                if($update) {
                    if($data['tour_image_1']!='') {
                        if(file_exists('uploads/newsletter_images/'.$data['tour_image_1'])) {
                            $deleteimg= 'uploads/newsletter_images/'.$data['tour_image_1'];
                            unlink($deleteimg);
                        }
                    }
                    $response['success']=true;
                    $response['msg']=_l('_deleted_successfully', _l('tour_image_1'));
                } else {
                    $response['success']=false;
                    $response['msg']="Something went wrong, Please try again later!";
                }
            } else {
                $response['success']=false;
                $response['msg']="Something went wrong, Please try again later!";
            }
        } else {
            $response['success']=false;
            $response['msg']="Something went wrong, Please try again later!";
        }
        echo json_encode($response);
        exit;  
    }
    public function delete_second_attachment() {
        
        $newsletter_id=base64_decode($this->input->post('newsletter_id'));
        
        if($newsletter_id){
            $data=$this->newsletter->get_by(array('id'=>$newsletter_id));
            if(is_array($data) && sizeof($data)>0){

                $upd_data=array("tour_image_2"=>"");
                $update=$this->newsletter->update_by(array("id"=>$newsletter_id), $upd_data);
                if($update) {
                    if($data['tour_image_2']!='') {
                        if(file_exists('uploads/newsletter_images/'.$data['tour_image_2'])) {
                            $deleteimg= 'uploads/newsletter_images/'.$data['tour_image_2'];
                            unlink($deleteimg);
                        }
                    }
                    $response['success']=true;
                    $response['msg']=_l('_deleted_successfully', _l('tour_image_2'));
                } else {
                    $response['success']=false;
                    $response['msg']="Something went wrong, Please try again later!";
                }
            } else {
                $response['success']=false;
                $response['msg']="Something went wrong, Please try again later!";
            }
        } else {
            $response['success']=false;
            $response['msg']="Something went wrong, Please try again later!";
        }
        echo json_encode($response);
        exit;  
    }
}