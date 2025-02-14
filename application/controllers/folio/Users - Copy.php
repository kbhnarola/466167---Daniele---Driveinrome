<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once('PHPExcel.php');
class Users extends Admin_Controller
{
    /**
     * Constructor for the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model', 'users_model');
        $this->load->model('Newsletter_model', 'newsletter_model');
        
        // Load file helper
        $this->load->helper('file');
        //print_r($this->session->userdata('admin_username'));
        
    }
    /**
     * Loads the list of Users.
     */
    public function index()
    {
        $this->set_page_title(_l('users'));
        // $this->users->order_by('created_at', 'DESC');
        // $data['users']  = $this->users->get_all();
        // pass user data
        $data['all_users'] = $this->users_model->get_users('', 'id, email');
        $data['all_active_tags'] = $this->users_model->get_tag_of_users();
        $data['newsletter_subject_list']=$this->newsletter_model->get_all();
        $data['content'] = $this->load->view('admin/users/index', $data, TRUE);
        $this->load->view('admin/layouts/index', $data);
    }
    
    public function getLists()
    {
        $data = $row = array();
        // Fetch users list
        // $this->users_model->get_users_with_tag();
        $memData = $this->users_model->getRows($_POST);
        // pr($_POST);die;
        $i = $_POST['start'];
        $j=0;
        foreach($memData as $users){            
            // $data[$j]['userID']=$i+1;
            $data[$j]['RecordID']=$i+1;
            $data[$j]['id'] = $users->id; 
            if($users->name == ''){
                $data[$j]['username'] = "--";
            }else{
                $data[$j]['username'] = $users->name;                
            }
            $data[$j]['email'] = $users->email;  
            if($users->phone_number == ''){
                $data[$j]['phone_number'] = "--";
            }else{
                $data[$j]['phone_number'] = $users->phone_number;                
            }
            if($users->tag_name == ''){
                $data[$j]['tag'] = "--";
            }else{
                $data[$j]['tag'] = strtoupper($users->tag_name); 
            }
            if($users->notes == ''){
                $data[$j]['notes'] = "--";
            }else{
                $data[$j]['notes'] = $users->notes;                
            }
            $data[$j]['is_subscribe'] =  $users->subscribe; 
            $data[$j]['id'] = $users->id;      
            $data[$j]['created_at'] =  date( 'Y-m-d', strtotime($users->created_at));
            $data[$j]['id'] = $users->id;
            $data[$j]['action']=base64_encode($users->id);
            $j++;
            $i++;
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->users_model->countFiltered($_POST),
            "recordsFiltered" => $this->users_model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
        exit;
    }
    /**
     * @author bsm
     *
     * Update Status Tour types
     *
     * @param int    $tour_id      user_id
     * @param int    $status      is_subscribe
     *
     */
    public function update_status()
    {
        $user_id = base64_decode($this->input->post('user_id'));
        $defult_token = md5($this->input->post('user_id').time());
        if ($this->input->post('is_subscribe') == 1)
        {
            $data    = array('subscribe' => $this->input->post('is_subscribe'), 'token' => $defult_token);
        }else{
            $data    = array('subscribe' => $this->input->post('is_subscribe'), 'send_unsubscribe_email' => '0', 'token' => '');
        }
        
        $update = $this->users_model->update_user($user_id, $data);
        if ($update) {
            if ($this->input->post('is_subscribe') == 1)
            {
                $response['success']=true;
                $response['msg']='true';
                $response['alert_msg']=_l('_subscribed', _l('users'));
            }
            else
            {
                $response['success']=true;
                $response['msg']='false';
                $response['alert_msg']=_l('_unsubscribed', _l('users'));
            }
        } else {
            $response['success']=false;
            $response['msg']=_l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }
    public function store_selected_user_for_send_newsletter(){
        if(empty($_POST['ids'])){
            echo 'false';
        }else{
            $all_ids = explode (",", $_POST['ids']);
            foreach($all_ids as $id) { 
                $where_users = array('id' => base64_decode($id), 'subscribe' => 1);
                $get_subscribed_users = $this->users_model->get_users($where_users, 'name, email');
                if(!empty($get_subscribed_users)){
                    $newsletter_data = array('user_id' => base64_decode($id), 'email_content' => trim($_POST['email_content']));
                    $this->users_model->insert_newsletter_content($newsletter_data);                
                }             
            }               
            echo 'true';            
        }
    }
    public function unsubscribe_users(){
        if(empty($_POST['ids'])){
            echo 'false';
        }else{
            $success = 'false';
            $all_ids = explode (",", $_POST['ids']);
            foreach($all_ids as $id) {
                $data    = array('subscribe' => 0);
                if($this->users_model->update_user(base64_decode($id), $data)){
                    $success = 'true';
                }
            }
            if($success == 'true'){
                // $data    = array('send_unsubscribe_email' => 0);
                // $this->users_model->update_user(base64_decode($id), $data);
                echo 'true';
            }else{
                echo 'already unsubscribed';
            }
            
        }
    }   
    public function import_users(){
        $response = $csvData = $userData = array();
        $successMsg = 'Something went wrong';
        $msg_type = 'error';
        $insertCount = $updateCount = $rowCount = $notAddCount = 0;
        $tag_id = '';
        // If import request is submitted
        // echo 'kjbk : '.$this->input->post('users_csv');die;
        if($this->input->post('import_csv')){            
         $allowed = array('xls', 'xlsx');
            $filename = $_FILES['users_csv']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);                        
            if (in_array($ext, $allowed)) {
                // Excel file
                if(isset($_FILES['users_csv']['tmp_name'])){
                    //upload file
                    $path = 'uploads/import_user/';
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'xlsx|xls';
                    $config['remove_spaces'] = TRUE;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);            
                    if (!$this->upload->do_upload('users_csv')) {
                        $error = array('error' => $this->upload->display_errors());
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                    }
                    if(empty($error)){
                        if (!empty($data['upload_data']['file_name'])) {
                            $import_xls_file = $data['upload_data']['file_name'];
                        } else {
                            $import_xls_file = 0;
                        }
                    }else{
                        set_alert('error', 'Something went wrong');
                        redirect(admin_url('users'));
                    }
                    $inputFileName = $path . $import_xls_file;
                    $this->load->library('excel');
                    $path = $_FILES["users_csv"]["tmp_name"];
                    $object = PHPExcel_IOFactory::load($path);
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true, true, true);
                    $flag = true;
                    $i=0;
                    foreach ($allDataInSheet as $value) {
                        if($flag){
                            $flag =false;
                            continue;
                        }
                        if(!empty($value['B']) && !empty($value['D'])){
                            // START import
                            $rowCount++;
                            // echo $value['B'];die;
                            // // Check whether email already exists in the database
                            $where = array(
                                    'email' => $value['B']
                                );
                            $existing_user = $this->users_model->get_users($where);

                            // check tag is exist with given name
                            if(!empty($value['C'])){
                                $tag_array = array(
                                    'name' => strtolower($value['C'])
                                );
                                $get_tags = $this->users_model->get_tag($tag_array);
                                if(!empty($get_tags)){
                                    $tag_id = $get_tags['id'];
                                }else{
                                    $tag_id = $this->users_model->insert_tag($tag_array);
                                }
                            }
                            // print_r($get_tags);die;
                            // echo ' $tag_id : '.$tag_id;die;
                            // print_r($existing_user);die;
                            if(count($existing_user) > 0){
                                // Prepare data for DB updation
                                $Created_date = !empty($value['D']) ? date("Y-m-d", strtotime(str_replace("-","/",$value['D']))) : '';
                                $userData = array(
                                    'name' => $value['A'],
                                    'tag_id' => $tag_id,
                                    'created_at' => $Created_date,
                                );
                                // Update user data
                                // if (!empty($value['C'])){
                                    $update = $this->users_model->update_user($existing_user[0]['id'], $userData);
                                // }
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                if (!empty($value['D'])){
                                    // Prepare data for DB insertion
                                    $Created_date = date("Y-m-d", strtotime(str_replace("-","/",$value['D'])));
                                    $userData = array(
                                        'name' => $value['A'],
                                        'email' => $value['B'],
                                        'created_at' => $Created_date,
                                        'send_subscribe_email' => 1,
                                        'token' => md5($value['B'].time()),
                                        'tag_id' => $tag_id
                                    );
                                    // Insert user data
                                    $insert = $this->users_model->insert_user($userData);
                                    
                                    if($insert){
                                        $insertCount++;
                                    }
                                }
                            }
                            // END import
                            $i++;
                        }
                        $tag_id = '';
                    }
                    $notAddCount = ($rowCount - ($insertCount + $updateCount));
                    $total_users = ($insertCount > 1) ? ' Users ' : ' User ';
                    if($insertCount == 0){
                        $successMsg = 'Either issue in user import or user already exist';
                        $msg_type = 'error';
                    }else{
                        $successMsg = 'Total '.$insertCount . $total_users .'imported successfully';
                        $msg_type = 'success';
                    }
                }
            }else{
                // CSV file
                if(is_uploaded_file($_FILES['users_csv']['tmp_name'])){                   
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                            
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['users_csv']['tmp_name']);
                }
                // Insert/update CSV data into database            
                if(!empty($csvData)){
                    foreach($csvData as $row){ 
                        $rowCount++;
                                            
                        // Check whether email already exists in the database
                        $where = array('email' => $row['Email']);
                        
                        $existing_user = $this->users_model->get_users($where);
                        // print_r($existing_user);die;
                        
                        // check tag is exist with given name
                        if(!empty($row['Tag'])){
                            $tag_array = array(
                                'name' => strtolower($row['Tag'])
                            );
                            $get_tags = $this->users_model->get_tag($tag_array);
                            if(!empty($get_tags)){
                                $tag_id = $get_tags['id'];
                            }else{
                                $tag_id = $this->users_model->insert_tag($tag_array);
                            }
                        }

                        if(count($existing_user) > 0){
                            // Prepare data for DB updation
                            $Created_date = !empty($row['Created date']) ? date("Y-m-d", strtotime(str_replace("-","/",$row['Created date']))) : '';
                            $userData = array('name' => $row['Name'],'tag_id' => $tag_id,'created_at' => $Created_date,);
                            // Update user data
                            $update = $this->users_model->update_user($existing_user[0]['id'], $userData);
                            
                            if($update){
                                $updateCount++;
                            }
                        }else{
                            if (!empty($row['Created date'])) {
                                // Prepare data for DB insertion
                                $Created_date = date("Y-m-d", strtotime(str_replace("-","/",$row['Created date'])));
                                $userData = array(
                                    'name' => $row['Name'],
                                    'email' => $row['Email'],
                                    'created_at' => $Created_date,
                                    'send_subscribe_email' => 1,
                                    'token' => md5($row['Email'].time()),
                                    'tag_id' => $tag_id
                                );
                                // Insert user data
                                $insert = $this->users_model->insert_user($userData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            }                        
                        }
                        $tag_id = '';
                    }                
                //     // Status message with imported data count
                    $notAddCount = ($rowCount - ($insertCount + $updateCount));
                    $total_users = ($insertCount > 1) ? ' Users ' : ' User ';
                    if($insertCount == 0){
                        $successMsg = 'User is already exist';
                        $msg_type = 'error';
                    }else{
                        $successMsg = 'Total '.$insertCount . $total_users .'imported successfully';
                        $msg_type = 'success';
                    }
                    
                    // $this->session->set_userdata('success_msg', $successMsg);
                }
            }            
        }        
        set_alert($msg_type, $successMsg);
        redirect(admin_url('users'));    
    }
    public function delete(){  
        $user_ids = array();
        if(isset($_POST['multiple'])){
            $all_ids = explode (",", $_POST['ids']);
            foreach($all_ids as $id) {
                $user_ids[] = base64_decode($id);              
            } 
            $deleted = $this->users_model->delete_user($user_ids, $_POST['multiple']);
        }else{
            $user_id = base64_decode($this->input->post('user_id'));
            $deleted = $this->users_model->delete_user(array("id"=>$user_id));
        }        
        if ($deleted) {
            
            $response['success']=true;
            $response['msg']= 'User deleted successfully';
            
        } else {
            $response['success']=false;
            $response['msg']=_l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }
    public function remove_tag(){  
        $user_ids = array();
        $user_id = base64_decode($this->input->post('user_id'));
        $userData = array(
            'tag_id' => NULL,
        );
        // Update user data
        if($this->users_model->update_user($user_id, $userData)){            
            $response['success']=true;
            $response['msg']= 'Tag removed successfully';
        }else{            
            $response['success']=false;
            $response['msg']=_l('something_wrong');          
        }
        echo json_encode($response);
        exit;
    }
    public function add_user_notes(){
        // print_r($this->input->post());die;
        $user_id = base64_decode($this->input->post('user_id'));
        $userData = array(
            'notes' => (trim($this->input->post('user_notes')) == '') ? NULL : trim($this->input->post('user_notes')),
        );
        // Update user data
        if($this->users_model->update_user($user_id, $userData)){
            if(empty(trim($this->input->post('user_notes')))){
                $data['msg'] = 'Notes removed successfully';
            }else{
                $data['msg'] = 'Notes added successfully';
            }
            $data['success'] = true;
        }else{            
            $data['msg'] = 'Getting error while adding user notes, try again later';            
            $data['success'] = false;
        }        
        echo json_encode($data);
    }
    public function assign_user_tag(){
        // print_r($this->input->post());die;
        $user_ids = $this->input->post('users_list');
        $tag_name = $this->input->post('tag_name');
        // check tag is exist with given name
        $tag_array = array(
            'name' => strtolower($tag_name)
        );
        $get_tags = $this->users_model->get_tag($tag_array);
        // echo 'count : '.count($get_tags);die;
        if(count($get_tags) > 0){
            $tag_id = $get_tags['id'];
        }else{
            $tag_id = $this->users_model->insert_tag($tag_array);
        }
        foreach($user_ids as $user_id){
            $userData = array(
                'tag_id' => $tag_id
            );
            $this->users_model->update_user($user_id, $userData);
        }
        
        // print_r($user_id);die;
        // $userData = array(
        //     'notes' => trim($this->input->post('user_notes')),
        // );
        // // Update user data
        // if($this->users_model->update_user($user_id, $userData)){            
        //     $data['msg'] = 'Notes added successfully';
        //     echo json_encode($data);
        // }else{            
        //     $data['msg'] = 'Getting error while adding user notes, try again later';            
        // }
        $data['success'] = true;
        $data['msg'] = 'Tag assigned to selected users';
        // $data['user_id'] = $user_ids;
        echo json_encode($data);
    }
    public function get_record_byID()
    {
        $record_id = base64_decode($this->input->post('user_id'));
        $where=array("id"=>$record_id);
        $data=$this->users_model->get_by($where);
        // $this->db->last_query();exit;
        if(is_array($data) && sizeof($data) > 0)    
        {
            echo json_encode($data);
        }
        else
        {
            echo json_encode("Records not found");
        }
        exit;
    }

    public function send_newsletter_email() {
        if($this->input->post()) {
            // print_r(explode(',',$_POST['ids']));
            // exit;
            if(empty($_POST['ids'])) {
                $response['success']=false;
                $response['msg']=_l('something_wrong');
            } else {
                             
                $subject=trim(ucfirst($this->input->post('newsletter_subject')));
                $newsletter_content=trim($this->input->post('newsletter_content'));
                $newsletter_content_more=trim($this->input->post('newsletter_content_more'));
                
                $tour_image1="";
                $tour_image2="";
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
                $data['username'] = "Customer";

                // $newsletter_data = array('user_id' => base64_decode($id), 'email_content' => trim($_POST['email_content']));
                $newsletter_data = array(
                        //'user_id' => base64_decode($id), 
                        'email_content' => $newsletter_content,
                        'newsletter_subject' => $subject,
                        'tour_image_1' => $tour_image1,
                        'tour_image1_url' =>trim($this->input->post('tour_image1_url')),
                        'tour_image_2' => $tour_image2,
                        'tour_image2_url' => trim($this->input->post('tour_image2_url')),
                        'newsletter_content_2' => $newsletter_content_more
                    );
                $get_newsletter_data = $this->newsletter_model->get_by(array('newsletter_subject'=>$subject));

                if(is_array($get_newsletter_data) && sizeof($get_newsletter_data)>0) {
                    $this->newsletter_model->update_by(array("id"=>$get_newsletter_data['id']),$newsletter_data);
                } else {
                    $this->newsletter_model->insert($newsletter_data);
                }

                $template_path = 'email_template/';
                
                $all_ids = explode (",", $_POST['ids']);
                foreach($all_ids as $id) { 
                    $where_users = array('id' => base64_decode($id), 'subscribe' => 1);
                    $get_subscribed_users = $this->users_model->get_users($where_users, 'name, email');
                    //print_r($get_subscribed_users);
                    if(!empty($get_subscribed_users)){
                         
                        if($get_subscribed_users[0]['email']) {
                            if($get_subscribed_users[0]['name']){
                                $data['username'] = $get_subscribed_users[0]['name'];
                            }
                            // echo $get_subscribed_users[0]['name']."<br>";
                            // echo $get_subscribed_users[0]['email']."<br>";
                            //exit;
                            $message = $this->load->view($template_path.'header', $data, TRUE);
                            $message .= $this->load->view($template_path.'admin_newsletter_temp', $data, TRUE);
                            $message .= $this->load->view($template_path.'footer', $data, TRUE);
                            email_send($get_subscribed_users[0]['email'],$subject,$message);
                        }               
                    }             
                }  
                $response['success']= true;
                $response['message']= "Newsletter Mail Sent to subscriber users only!";
            }
            echo json_encode($response);
            exit;
        } else {
            redirect(admin_url('dashboard'));
            exit;   
        }
        
        echo json_encode($response);
        exit;
    }

    public function preview_newsletter() {
        if($this->input->post()) {
            $subject=trim($this->input->post('newsletter_subject'));
            $newsletter_content=trim($this->input->post('newsletter_content'));
            $newsletter_content_more=trim($this->input->post('newsletter_content_more'));

            $tour_image1="";
            $tour_image2="";
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

    public function edit()
    {
        if ($this->input->post())
        {
            $edit_user_email=trim($this->input->post("edit_user_email"));
            $this->form_validation->set_rules('edit_username', 'Username', 'required');
            $this->form_validation->set_rules('edit_user_email', 'Email', 'trim|required|callback_check_isuserExists_edit[' . $edit_user_email . ']');

            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                $response['success']=false;
                $response['msg']=current($errors);              
            }
            else
            {
                $id = base64_decode($this->input->post('edit_user_id'));               

                if ($id)
                {
                    $edit_username=ucwords(trim($this->input->post("edit_username")));
                    $edit_user_phone=$this->input->post("edit_user_phone");

                    $data=array(
                        "name"=>$edit_username,  
                        "email"=>$edit_user_email,
                        "phone_number"=>$edit_user_phone
                    );
                    
                    $update = $this->users_model->update_by(array("id"=>$id), $data);
                    
                    if ($update)
                    {
                        $response['success']=true;
                        $response['msg']=_l('_updated_successfully', "User's Details");
                    }
                    else
                    {
                        $response['success']=false;
                        $response['msg']=_l('something_wrong')._l('not_updated', "User's Details");   
                    }
                }
                else
                {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_updated', "User's Details");
                }
            }
            echo json_encode($response);
            exit;
        }
        else
        {
            redirect(admin_url('users'));
            exit;
        }
    }

    public function isUserEmailExists()
    {
        $edit_user_email = trim($this->input->post('edit_user_email'));
        $record_id = base64_decode($this->input->post('record_id'));

        $where=array("email"=>$edit_user_email);
        $check_exist=$this->users_model->get_by($where);
        
        if($record_id) {            

            $where=array("id"=>$record_id);
            $check_exist_byid=$this->users_model->get_by($where);

            if(is_array($check_exist) && sizeof($check_exist) > 0) {
                if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){
                    if($check_exist['email']==$check_exist_byid['email']){
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
        } else {
            
            if(is_array($check_exist) && sizeof($check_exist) > 0) {          
                echo(json_encode(false));           
            } else {
                echo(json_encode(true));
            }
        }
        exit;
    }

    public function check_isuserExists_edit($edit_user_email)
    {
        $where=array("email"=>trim($edit_user_email));        
        $check_exist=$this->users_model->get_by($where);

        $record_id=base64_decode($this->input->post('edit_user_id'));
        $where=array("id"=>$record_id);
        $check_exist_byid=$this->users_model->get_by($where);

        if(is_array($check_exist) && sizeof($check_exist) > 0) {
            if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){
                if($check_exist['email']==$check_exist_byid['email']) {
                     return true;
                } else {
                    $this->form_validation->set_message("check_isuserExists_edit",'Email already exist');
                    return false;
                }
            } else {
                $this->form_validation->set_message("check_isuserExists_edit",'Email already exist');
                return false;
            }
        } else {
            return true;
        }
    }

    
    public function isNewsletterTitleExists()
    {
        $newsletter_subject = trim($this->input->post('newsletter_subject'));

        $where=array("newsletter_subject"=>$newsletter_subject);
        $check_exist=$this->newsletter_model->get_by($where);
        
        if(is_array($check_exist) && sizeof($check_exist) > 0) {          
            echo(json_encode(false));           
        } else {
            echo(json_encode(true));
        }        
        exit;
    }
}