<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
        $this->load->model('Tag_model', 'tag');

        // Load file helper
        $this->load->helper('file');
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
        $data['newsletter_subject_list'] = $this->newsletter_model->get_all();
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
        $j = 0;
        foreach ($memData as $users) {
            // $data[$j]['userID']=$i+1;
            $data[$j]['RecordID'] = $i + 1;
            $data[$j]['id'] = $users->id;
            if ($users->name == '') {
                $data[$j]['username'] = "--";
            } else {
                $data[$j]['username'] = $users->name;
            }
            $data[$j]['email'] = $users->email;
            if ($users->phone_number == '') {
                $data[$j]['phone_number'] = "--";
            } else {
                $data[$j]['phone_number'] = $users->phone_number;
            }
            if ($users->tag_name == '') {
                $data[$j]['tag'] = "--";
            } else {
                $data[$j]['tag'] = strtoupper($users->tag_name);
            }
            if ($users->notes == '') {
                $data[$j]['notes'] = "--";
            } else {
                $data[$j]['notes'] = $users->notes;
            }
            $data[$j]['is_subscribe'] =  $users->subscribe;
            $data[$j]['id'] = $users->id;
            $data[$j]['created_at'] =  date('Y-m-d', strtotime($users->created_at));
            $data[$j]['id'] = $users->id;
            $data[$j]['action'] = base64_encode($users->id);
            $j++;
            $i++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->users_model->countFiltered($_POST),
            "recordsFiltered" => $this->users_model->countFiltered($_POST),
            "data" => $data,
        );
        // echo "<pre>";
        // print_r($data); exit;
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
        $defult_token = md5($this->input->post('user_id') . time());
        if ($this->input->post('is_subscribe') == 1) {
            $data    = array('subscribe' => $this->input->post('is_subscribe'), 'token' => $defult_token);
        } else {
            $data    = array('subscribe' => $this->input->post('is_subscribe'), 'send_unsubscribe_email' => '0', 'token' => '');
        }

        $update = $this->users_model->update_user($user_id, $data);
        if ($update) {
            if ($this->input->post('is_subscribe') == 1) {
                $response['success'] = true;
                $response['msg'] = 'true';
                $response['alert_msg'] = _l('_subscribed', _l('users'));
            } else {
                $response['success'] = true;
                $response['msg'] = 'false';
                $response['alert_msg'] = _l('_unsubscribed', _l('users'));
            }
        } else {
            $response['success'] = false;
            $response['msg'] = _l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }
    public function store_selected_user_for_send_newsletter()
    {
        if (empty($_POST['ids'])) {
            echo 'false';
        } else {
            $all_ids = explode(",", $_POST['ids']);
            foreach ($all_ids as $id) {
                $where_users = array('id' => base64_decode($id), 'subscribe' => 1);
                $get_subscribed_users = $this->users_model->get_users($where_users, 'name, email');
                if (!empty($get_subscribed_users)) {
                    $newsletter_data = array('user_id' => base64_decode($id), 'email_content' => trim($_POST['email_content']));
                    $this->users_model->insert_newsletter_content($newsletter_data);
                }
            }
            echo 'true';
        }
    }
    public function unsubscribe_users()
    {
        if (empty($_POST['ids'])) {
            echo 'false';
        } else {
            $success = 'false';
            $all_ids = explode(",", $_POST['ids']);
            foreach ($all_ids as $id) {
                $data    = array('subscribe' => 0);
                if ($this->users_model->update_user(base64_decode($id), $data)) {
                    $success = 'true';
                }
            }
            if ($success == 'true') {
                // $data    = array('send_unsubscribe_email' => 0);
                // $this->users_model->update_user(base64_decode($id), $data);
                echo 'true';
            } else {
                echo 'already unsubscribed';
            }
        }
    }
    public function import_users()
    {
        $response = $csvData = $userData = array();
        $successMsg = 'Something went wrong';
        $msg_type = 'error';
        $insertCount = $updateCount = $rowCount = $notAddCount = 0;
        $tag_id = '';
        // If import request is submitted
        // echo 'kjbk : '.$this->input->post('users_csv');die;
        if ($this->input->post('import_csv')) {
            $allowed = array('xlsx');
            $filename = $_FILES['users_csv']['name'];
            // echo 'filename : ' . $filename;
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (in_array($ext, $allowed)) {
                // Excel file
                if (isset($_FILES['users_csv']['tmp_name'])) {
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
                    if (empty($error)) {
                        if (!empty($data['upload_data']['file_name'])) {
                            $import_xls_file = $data['upload_data']['file_name'];
                        } else {
                            $import_xls_file = 0;
                        }
                    } else {
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
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i = 0;
                    foreach ($allDataInSheet as $value) {
                        if (!empty($value['B']) && !empty($value['D'])) {
                            // START import
                            $rowCount++;
                            // echo $value['B'];die;
                            // // Check whether email already exists in the database
                            $where = array(
                                'email' => $value['B']
                            );
                            $existing_user = $this->users_model->get_users($where);

                            // check tag is exist with given name
                            if (!empty($value['C'])) {
                                $tag_array = array(
                                    'name' => strtolower($value['C'])
                                );
                                $get_tags = $this->users_model->get_tag($tag_array);
                                if (!empty($get_tags)) {
                                    $tag_id = $get_tags['id'];
                                } else {
                                    $tag_id = $this->users_model->insert_tag($tag_array);
                                }
                            }
                            // print_r($get_tags);die;
                            // echo ' $tag_id : '.$tag_id;die;
                            // print_r($existing_user);die;
                            if (count($existing_user) > 0) {
                                // Prepare data for DB updation
                                $Created_date = !empty($value['D']) ? date("Y-m-d", strtotime(str_replace("-", "/", $value['D']))) : '';
                                $userData = array(
                                    'name' => $value['A'],
                                    'tag_id' => $tag_id,
                                    'created_at' => $Created_date,
                                );
                                // Update user data
                                // if (!empty($value['C'])){
                                $update = $this->users_model->update_user($existing_user[0]['id'], $userData);
                                // }

                                if ($update) {
                                    $updateCount++;
                                }
                            } else {
                                if (!empty($value['D'])) {
                                    // Prepare data for DB insertion
                                    $Created_date = date("Y-m-d", strtotime(str_replace("-", "/", $value['D'])));
                                    if (isValidEmail($value['B'])) {
                                        $userData = array(
                                            'name' => $value['A'],
                                            'email' => $value['B'],
                                            'created_at' => $Created_date,
                                            'send_subscribe_email' => 1,
                                            'token' => md5($value['B'] . time()),
                                            'tag_id' => $tag_id
                                        );
                                        // Insert user data
                                        $insert = $this->users_model->insert_user($userData);

                                        if ($insert) {
                                            $insertCount++;
                                        }
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
                    if ($insertCount == 0) {
                        $successMsg = 'Either issue in user import or user already exist';
                        $msg_type = 'error';
                    } else {
                        $successMsg = 'Total ' . $insertCount . $total_users . 'imported successfully';
                        $msg_type = 'success';
                    }
                }
            } else {
                // CSV file
                if (is_uploaded_file($_FILES['users_csv']['tmp_name'])) {
                    // Load CSV reader library
                    $this->load->library('CSVReader');

                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['users_csv']['tmp_name']);
                }
                // Insert/update CSV data into database            
                if (!empty($csvData)) {
                    foreach ($csvData as $row) {
                        $rowCount++;

                        // Check whether email already exists in the database
                        $where = array('email' => $row['Email']);

                        $existing_user = $this->users_model->get_users($where);
                        // print_r($existing_user);die;

                        // check tag is exist with given name
                        if (!empty($row['Tag'])) {
                            $tag_array = array(
                                'name' => strtolower($row['Tag'])
                            );
                            $get_tags = $this->users_model->get_tag($tag_array);
                            if (!empty($get_tags)) {
                                $tag_id = $get_tags['id'];
                            } else {
                                $tag_id = $this->users_model->insert_tag($tag_array);
                            }
                        }

                        if (count($existing_user) > 0) {
                            // Prepare data for DB updation
                            $Created_date = !empty($row['Created date']) ? date("Y-m-d", strtotime(str_replace("-", "/", $row['Created date']))) : '';
                            $userData = array('name' => $row['Name'], 'tag_id' => $tag_id, 'created_at' => $Created_date,);
                            // Update user data
                            $update = $this->users_model->update_user($existing_user[0]['id'], $userData);

                            if ($update) {
                                $updateCount++;
                            }
                        } else {
                            if (!empty($row['Created date'])) {
                                // Prepare data for DB insertion
                                $Created_date = date("Y-m-d", strtotime(str_replace("-", "/", $row['Created date'])));
                                if (isValidEmail($row['Email'])) {
                                    $userData = array(
                                        'name' => $row['Name'],
                                        'email' => $row['Email'],
                                        'created_at' => $Created_date,
                                        'send_subscribe_email' => 1,
                                        'token' => md5($row['Email'] . time()),
                                        'tag_id' => $tag_id
                                    );
                                    // Insert user data
                                    $insert = $this->users_model->insert_user($userData);

                                    if ($insert) {
                                        $insertCount++;
                                    }
                                }
                            }
                        }
                        $tag_id = '';
                    }
                    //     // Status message with imported data count
                    $notAddCount = ($rowCount - ($insertCount + $updateCount));
                    $total_users = ($insertCount > 1) ? ' Users ' : ' User ';
                    if ($insertCount == 0) {
                        $successMsg = 'User is already exist';
                        $msg_type = 'error';
                    } else {
                        $successMsg = 'Total ' . $insertCount . $total_users . 'imported successfully';
                        $msg_type = 'success';
                    }

                    // $this->session->set_userdata('success_msg', $successMsg);
                }
            }
        }
        set_alert($msg_type, $successMsg);
        redirect(admin_url('users'));
    }

    public function import_user()
    {

        $successMsg = 'Something went wrong';
        $msg_type = 'error';
        $insertCount = $updateCount = $rowCount = $notAddCount = $error =  0;
        $tag_id = '';
        $valid_email = true;
        // If import request is submitted

        $post = $this->input->post();

        if (!empty($post['add_user_email'])) {
            $where = array(
                'email' => $post['add_user_email']
            );
            $existing_user = $this->users_model->get_users($where);
        }

        if (!empty($post['add_user_tag'])) {
            $tag_array = array(
                'name' => strtolower($post['add_user_tag'])
            );
            $get_tags = $this->users_model->get_tag($tag_array);
            if (!empty($get_tags)) {
                $tag_id = $get_tags['id'];
            } else {
                $tag_id = $this->users_model->insert_tag($tag_array);
            }
        }

        if (count($existing_user) > 0) {
            $error = 1;
        } else {
            if (!empty($post['add_user_email']) && $error == 0) {
                // Prepare data for DB insertion
                $Created_date = date('Y-m-d');
                if (isValidEmail($post['add_user_email'])) {
                    $userData = array(
                        'name' => $post['add_username'],
                        'email' => $post['add_user_email'],
                        'created_at' => $Created_date,
                        'send_subscribe_email' => 1,
                        'token' => md5($post['add_user_email'] . time()),
                        'tag_id' => $tag_id,
                        'phone_number' => $post['add_user_phone']
                    );
                    // Insert user data
                    $insert = $this->users_model->insert_user($userData);

                    if ($insert) {
                        $insertCount = 1;
                    }
                } else {
                    $valid_email = false;
                }
            }
        }
        // echo 'insertCount - '.$insertCount.' updateCount - '.$updateCount; 
        if ($insertCount == 0) {
            if ($valid_email) {
                $successMsg = 'Email address is not valid';
                $msg_type = 'error';
            } else {
                $successMsg = 'Either issue in user import or user already exist';
                $msg_type = 'error';
            }
        } else if ($insertCount == 1 && $error == 0) {
            $successMsg = 'User added successfully';
            $msg_type = 'success';
        } else if ($error == 1) {
            $successMsg = 'User already exist';
            $msg_type = 'error';
        }

        set_alert($msg_type, $successMsg);
        redirect(admin_url('users'));
    }
    public function delete()
    {
        $user_ids = array();
        if (isset($_POST['multiple'])) {
            $all_ids = explode(",", $_POST['ids']);
            foreach ($all_ids as $id) {
                $user_ids[] = base64_decode($id);
            }
            $deleted = $this->users_model->delete_user($user_ids, $_POST['multiple']);
        } else {
            $user_id = base64_decode($this->input->post('user_id'));
            $deleted = $this->users_model->delete_user(array("id" => $user_id));
        }
        if ($deleted) {

            $response['success'] = true;
            $response['msg'] = 'User deleted successfully';
        } else {
            $response['success'] = false;
            $response['msg'] = _l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }
    public function remove_tag()
    {
        $user_ids = array();
        $user_id = base64_decode($this->input->post('user_id'));
        $userData = array(
            'tag_id' => NULL,
        );
        // Update user data
        if ($this->users_model->update_user($user_id, $userData)) {
            $response['success'] = true;
            $response['msg'] = 'Tag removed successfully';
        } else {
            $response['success'] = false;
            $response['msg'] = _l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }
    public function add_user_notes()
    {
        // print_r($this->input->post());die;
        $user_id = base64_decode($this->input->post('user_id'));
        $userData = array(
            'notes' => (trim($this->input->post('user_notes')) == '') ? NULL : trim($this->input->post('user_notes')),
        );
        // Update user data
        if ($this->users_model->update_user($user_id, $userData)) {
            if (empty(trim($this->input->post('user_notes')))) {
                $data['msg'] = 'Notes removed successfully';
            } else {
                $data['msg'] = 'Notes added successfully';
            }
            $data['success'] = true;
        } else {
            $data['msg'] = 'Getting error while adding user notes, try again later';
            $data['success'] = false;
        }
        echo json_encode($data);
    }
    public function assign_user_tag()
    {
        // print_r($this->input->post());die;
        $user_ids = $this->input->post('users_list');
        $tag_name = $this->input->post('tag_name');
        // check tag is exist with given name
        $tag_array = array(
            'name' => strtolower($tag_name)
        );
        $get_tags = $this->users_model->get_tag($tag_array);
        // echo 'count : '.count($get_tags);die;
        if (count($get_tags) > 0) {
            $tag_id = $get_tags['id'];
        } else {
            $tag_id = $this->users_model->insert_tag($tag_array);
        }
        foreach ($user_ids as $user_id) {
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
        $where = array("id" => $record_id);
        $data = $this->users_model->get_by($where);

        if ($data['tag_id']) {
            $tag_array = array(
                'id' => strtolower($data['tag_id'])
            );
            $get_tags = $this->users_model->get_tag($tag_array);
            $data['tag_name'] = $get_tags['name'];
        }
        // $this->db->last_query();exit;
        if (is_array($data) && sizeof($data) > 0) {
            echo json_encode($data);
        } else {
            echo json_encode("Records not found");
        }
        exit;
    }

    public function send_newsletter_email()
    {
        if ($this->input->post()) {

            //$this->form_validation->set_rules('ta_name', 'Name', 'trim|required');
            $r = 1;
            if (array_key_exists('select_tag_name_filter', $_POST)) {
                if (is_array($_POST['select_tag_name_filter']) && sizeof($_POST['select_tag_name_filter']) > 0) {
                    $r++;
                }
            }

            if (array_key_exists('select_tag_name', $_POST)) {
                if (is_array($_POST['select_tag_name']) && sizeof($_POST['select_tag_name']) > 0) {
                    $r++;
                }
            }

            if ($r == 1) {
                $response['success'] = false;
                $response['msg'] = _l('something_wrong');
            } else {
                $response['newsletter_id'] = "";
                $response['newsletter_subject'] = "";
                if (array_key_exists('select_newsletter_subject', $_POST)) {

                    $subject = "DriverInRome";
                    $subjec_id = trim($this->input->post('select_newsletter_subject'));
                    if ($subjec_id) {
                        $get_newsletter_data = $this->newsletter_model->get_by(array('id' => $subjec_id));

                        if (is_array($get_newsletter_data) && sizeof($get_newsletter_data) > 0) {
                            $subject = $get_newsletter_data['newsletter_subject'];
                            $newsletter_content = $get_newsletter_data['email_content'];
                            $newsletter_content_more = $get_newsletter_data['newsletter_content_2'];

                            $tour_image1 = $get_newsletter_data['tour_image_1'];
                            $tour_image2 = $get_newsletter_data['tour_image_2'];
                            $tour_image1_url = $get_newsletter_data['tour_image1_url'];
                            $tour_image2_url = $get_newsletter_data['tour_image2_url'];
                        } else {
                            $response['success'] = false;
                            $response['msg'] = _l('something_wrong');

                            echo json_encode($response);
                            exit;
                        }
                    } else {
                        $response['success'] = false;
                        $response['msg'] = _l('something_wrong');

                        echo json_encode($response);
                        exit;
                    }
                } else {

                    $subject = trim(ucfirst($this->input->post('newsletter_subject')));
                    $newsletter_content = trim($this->input->post('newsletter_content'));
                    $newsletter_content_more = trim($this->input->post('newsletter_content_more'));

                    $tour_image1 = "";
                    $tour_image2 = "";
                    if (is_array($_FILES) && $_FILES['tour_image1']['tmp_name'] != "") {

                        $config['upload_path'] = './uploads/newsletter_images/';
                        $config['allowed_types'] = '*';

                        foreach ($_FILES as $key => $value) {
                            if ($key == "tour_image1") {
                                if ($value["name"]) {

                                    $file_name = pathinfo($value["name"], PATHINFO_FILENAME) . '-' . time();
                                    $config['file_name'] = $file_name;

                                    $this->load->library("upload", $config);
                                    $this->upload->initialize($config);

                                    if ($this->upload->do_upload($key)) {
                                        $data = array('upload_data' => $this->upload->data());
                                        $tour_image1 = $data['upload_data']['file_name'];
                                    } else {
                                        //set_alert('error',current($this->upload->display_errors()));
                                        $response['success'] = false;
                                        if (is_array($this->upload->display_errors())) {
                                            $response['error_msg'] = current($this->upload->display_errors());
                                        } else {
                                            $response['error_msg'] = $this->upload->display_errors();
                                        }
                                        echo json_encode($response);
                                        exit;
                                    }
                                }
                            }
                            if ($key == "tour_image2") {
                                if ($value["name"]) {

                                    $file_name = pathinfo($value["name"], PATHINFO_FILENAME) . '-' . time();
                                    $config['file_name'] = $file_name;

                                    $this->load->library("upload", $config);
                                    $this->upload->initialize($config);

                                    if ($this->upload->do_upload($key)) {
                                        $data = array('upload_data' => $this->upload->data());
                                        $tour_image2 = $data['upload_data']['file_name'];
                                    } else {
                                        $response['success'] = false;
                                        if (is_array($this->upload->display_errors())) {
                                            $response['error_msg'] = current($this->upload->display_errors());
                                        } else {
                                            $response['error_msg'] = $this->upload->display_errors();
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
                        'tour_image1_url' => trim($this->input->post('tour_image1_url')),
                        'tour_image_2' => $tour_image2,
                        'tour_image2_url' => trim($this->input->post('tour_image2_url')),
                        'newsletter_content_2' => $newsletter_content_more
                    );
                    $ins_id = $this->newsletter_model->insert($newsletter_data);
                    $tour_image1_url = trim($this->input->post('tour_image1_url'));
                    $tour_image2_url = trim($this->input->post('tour_image2_url'));
                    $response['newsletter_id'] = $ins_id;
                    $response['newsletter_subject'] = $subject;
                }
                $data['title'] = $subject;
                $data['newsletter_content'] = $newsletter_content;
                //$data['newsletter_content'] = iconv('UTF-8', 'windows-1252', $newsletter_content);
                $data['newsletter_content_more'] = $newsletter_content_more;
                //$data['newsletter_content_more'] = iconv('UTF-8', 'windows-1252', $newsletter_content_more);
                $data['tour_image1'] = $tour_image1;
                if ($tour_image1_url) {
                    $data['tour_image1_url'] = $tour_image1_url;
                } else {
                    $data['tour_image1_url'] = "javascript:";
                }
                $data['tour_image2'] = $tour_image2;
                if ($tour_image2_url) {
                    $data['tour_image2_url'] = $tour_image2_url;
                } else {
                    $data['tour_image2_url'] = "javascript:";
                }
                $data['username'] = "Customer";

                $template_path = 'email_template/';

                //$all_ids = explode (",", $_POST['ids']);
                $tag_id = array();
                if (array_key_exists('select_tag_name_filter', $_POST)) {
                    $tag_id = $this->input->post('select_tag_name_filter');
                    $all_tags = $this->tag->get_tags_by($tag_id);
                } else {
                    if (array_key_exists('select_tag_name', $_POST)) {
                        $tag_id = $this->input->post('select_tag_name');
                    }
                }

                $all_ids = $this->users_model->get_users_by($tag_id);
                if (is_array($all_ids) && sizeof($all_ids) > 0) {
                    foreach ($all_ids as $user_data) {
                        if ($user_data['email']) {
                            if ($user_data['name']) {
                                $data['username'] = $user_data['name'];
                            }
                            $simple_string = $user_data['email'];
                            $ciphering = "AES-128-CTR";
                            $iv_length = openssl_cipher_iv_length($ciphering);
                            $options = 0;
                            $encryption_iv = '1234567891011121';
                            $encryption_key = "driveinrome";
                            $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
                            $url = base_url() . 'unsubscribed/' . $encryption;
                            $data['unsubscribe_url'] = $url;

                            //echo $user_data['email']." ".$subject."<br>";
                            $message = $this->load->view($template_path . 'header', $data, TRUE);
                            $message .= $this->load->view($template_path . 'admin_newsletter_temp', $data, TRUE);
                            $message .= $this->load->view($template_path . 'footer', $data, TRUE);
                            // echo $message."<br>";
                            // die();
                            $newsletter_data = array(
                                'user_id' => $user_data['id'],
                                'email_content' => $newsletter_content,
                                'newsletter_subject' => $subject,
                                'tour_image_1' => $tour_image1,
                                'tour_image1_url' => trim($this->input->post('tour_image1_url')),
                                'tour_image_2' => $tour_image2,
                                'tour_image2_url' => trim($this->input->post('tour_image2_url')),
                                'newsletter_content_2' => $newsletter_content_more
                            );
                            $ins_id = $this->users_model->insert_data(TBL_NEWSLETTER_EMAILS, $newsletter_data);
                            // email_send($user_data['email'],$subject,$message);
                        }
                    }
                }
                $sent_tag_names = '';
                if ($all_tags) {
                    foreach ($all_tags as $single_tag) {
                        $sent_tag_names = $sent_tag_names . ', ' . strtoupper($single_tag['name']);
                    }
                }
                $response['success'] = true;
                $response['message'] = "Newsletter was sent to the following tags: " . trim($sent_tag_names, ', ');
            }
            // echo $tag_id.'<br>';
            // echo $get_tag_data['name'];
            echo json_encode($response);
            exit;
        } else {
            redirect(admin_url('dashboard'));
            exit;
        }

        echo json_encode($response);
        exit;
    }

    public function preview_newsletter()
    {
        if ($this->input->post()) {
            $subject = trim($this->input->post('newsletter_subject'));
            $newsletter_content = trim($this->input->post('newsletter_content'));
            $newsletter_content_more = trim($this->input->post('newsletter_content_more'));

            $tour_image1 = "";
            $tour_image2 = "";
            if (is_array($_FILES) && $_FILES['tour_image1'] > 0) {

                $config['upload_path'] = './uploads/newsletter_images/';
                $config['allowed_types'] = '*';

                foreach ($_FILES as $key => $value) {
                    if ($key == "tour_image1") {
                        if ($value["name"]) {

                            $file_name = pathinfo($value["name"], PATHINFO_FILENAME) . '-' . time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload", $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $tour_image1 = $data['upload_data']['file_name'];
                            } else {
                                //set_alert('error',current($this->upload->display_errors()));
                                $response['success'] = false;
                                if (is_array($this->upload->display_errors())) {
                                    $response['error_msg'] = current($this->upload->display_errors());
                                } else {
                                    $response['error_msg'] = $this->upload->display_errors();
                                }
                                //$response['error_msg']=current($this->upload->display_errors());
                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                    if ($key == "tour_image2") {
                        if ($value["name"]) {

                            $file_name = pathinfo($value["name"], PATHINFO_FILENAME) . '-' . time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload", $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $tour_image2 = $data['upload_data']['file_name'];
                            } else {
                                $response['success'] = false;
                                if (is_array($this->upload->display_errors())) {
                                    $response['error_msg'] = current($this->upload->display_errors());
                                } else {
                                    $response['error_msg'] = $this->upload->display_errors();
                                }
                                //$response['error_msg']=current($this->upload->display_errors());
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
            if ($this->input->post('tour_image1_url')) {
                $data['tour_image1_url'] = trim($this->input->post('tour_image1_url'));
            } else {
                $data['tour_image1_url'] = "javascript:";
            }
            $data['tour_image2'] = $tour_image2;
            if ($this->input->post('tour_image2_url')) {
                $data['tour_image2_url'] = trim($this->input->post('tour_image2_url'));
            } else {
                $data['tour_image2_url'] = "javascript:";
            }

            $template_path = 'email_template/';
            $message = $this->load->view($template_path . 'header', $data, TRUE);
            //$message = $this->load->view($template_path.'newsletter_template_header', $data, TRUE);
            $message .= $this->load->view($template_path . 'admin_newsletter_temp', $data, TRUE);
            //$message .= $this->load->view($template_path.'newsletter_template_footer', $data, TRUE);
            $message .= $this->load->view($template_path . 'footer', $data, TRUE);
            //echo $message;
            $response['success'] = true;
            $response['message'] = $message;
            echo json_encode($response);
            exit;
        } else {
            redirect(admin_url('dashboard'));
            exit;
        }
    }

    public function preview_newsletter_default()
    {
        if ($this->input->post()) {
            $subject = "DriverInRome";
            $subjec_id = trim($this->input->post('select_newsletter_subject'));

            $get_newsletter_data = $this->newsletter_model->get_by(array('id' => $subjec_id));
            $newsletter_content = "";
            $newsletter_content_more = "";

            $tour_image1 = "";
            $tour_image2 = "";
            $tour_image1_url = "";
            $tour_image2_url = "";

            if (is_array($get_newsletter_data) && sizeof($get_newsletter_data) > 0) {
                $subject = $get_newsletter_data['newsletter_subject'];
                $newsletter_content = $get_newsletter_data['email_content'];
                $newsletter_content_more = $get_newsletter_data['newsletter_content_2'];

                $tour_image1 = $get_newsletter_data['tour_image_1'];
                $tour_image2 = $get_newsletter_data['tour_image_2'];
                $tour_image1_url = $get_newsletter_data['tour_image1_url'];
                $tour_image2_url = $get_newsletter_data['tour_image2_url'];
            } else {
                $response['success'] = false;
                $response['msg'] = _l('something_wrong');

                echo json_encode($response);
                exit;
            }

            $data['title'] = $subject;
            $data['username'] = $this->session->userdata('admin_username');
            $data['newsletter_content'] = $newsletter_content;
            $data['newsletter_content_more'] = $newsletter_content_more;
            $data['tour_image1'] = $tour_image1;
            if ($tour_image1_url) {
                $data['tour_image1_url'] = trim($tour_image1_url);
            } else {
                $data['tour_image1_url'] = "javascript:";
            }
            $data['tour_image2'] = $tour_image2;
            if ($tour_image2_url) {
                $data['tour_image2_url'] = trim($tour_image2_url);
            } else {
                $data['tour_image2_url'] = "javascript:";
            }

            $template_path = 'email_template/';
            $message = $this->load->view($template_path . 'header', $data, TRUE);
            //$message = $this->load->view($template_path.'newsletter_template_header', $data, TRUE);
            $message .= $this->load->view($template_path . 'admin_newsletter_temp', $data, TRUE);
            //$message .= $this->load->view($template_path.'newsletter_template_footer', $data, TRUE);
            $message .= $this->load->view($template_path . 'footer', $data, TRUE);
            //echo $message;
            $response['success'] = true;
            $response['message'] = $message;
            echo json_encode($response);
            exit;
        } else {
            redirect(admin_url('dashboard'));
            exit;
        }
    }

    public function edit()
    {
        if ($this->input->post()) {
            $tag_id = "";

            $edit_user_email = trim($this->input->post("edit_user_email"));
            $edit_user_tag = $this->input->post("edit_user_tag");
            $edit_user_notes = $this->input->post("edit_user_notes");

            if (!empty($edit_user_tag)) {
                $tag_array = array(
                    'name' => strtolower($edit_user_tag)
                );
                $get_tags = $this->users_model->get_tag($tag_array);
                if (!empty($get_tags)) {
                    $tag_id = $get_tags['id'];
                } else {
                    $tag_id = $this->users_model->insert_tag($tag_array);
                }
            }

            $this->form_validation->set_rules('edit_username', 'Username', 'required');
            $this->form_validation->set_rules('edit_user_email', 'Email', 'trim|required|callback_check_isuserExists_edit[' . $edit_user_email . ']');

            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $response['success'] = false;
                $response['msg'] = current($errors);
            } else {
                $id = base64_decode($this->input->post('edit_user_id'));

                if ($id) {
                    $edit_username = ucwords(trim($this->input->post("edit_username")));
                    $edit_user_phone = $this->input->post("edit_user_phone");

                    $data = array(
                        "name" => $edit_username,
                        "email" => $edit_user_email,
                        "phone_number" => $edit_user_phone,
                        "tag_id" => $tag_id,
                        "notes" => $edit_user_notes
                    );

                    $update = $this->users_model->update_by(array("id" => $id), $data);

                    if ($update) {
                        $response['success'] = true;
                        $response['msg'] = _l('_updated_successfully', "User's Details");
                    } else {
                        $response['success'] = false;
                        $response['msg'] = _l('something_wrong') . _l('not_updated', "User's Details");
                    }
                } else {
                    $response['success'] = false;
                    $response['msg'] = _l('something_wrong') . _l('not_updated', "User's Details");
                }
            }
            echo json_encode($response);
            exit;
        } else {
            redirect(admin_url('users'));
            exit;
        }
    }

    public function isUserEmailExists()
    {
        if (!empty($this->input->post('edit_user_email'))) {
            $edit_user_email = trim($this->input->post('edit_user_email'));
        } else {
            $edit_user_email = trim($this->input->post('add_user_email'));
        }

        $record_id = base64_decode($this->input->post('record_id'));

        $where = array("email" => $edit_user_email);
        $check_exist = $this->users_model->get_by($where);

        if ($record_id) {

            $where = array("id" => $record_id);
            $check_exist_byid = $this->users_model->get_by($where);

            if (is_array($check_exist) && sizeof($check_exist) > 0) {
                if (is_array($check_exist_byid) && sizeof($check_exist_byid) > 0) {
                    if ($check_exist['email'] == $check_exist_byid['email']) {
                        echo (json_encode(true));
                    } else {
                        echo (json_encode(false));
                    }
                } else {
                    echo (json_encode(false));
                }
            } else {
                echo (json_encode(true));
            }
        } else {

            if (is_array($check_exist) && sizeof($check_exist) > 0) {
                echo (json_encode(false));
            } else {
                echo (json_encode(true));
            }
        }
        exit;
    }

    public function check_isuserExists_edit($edit_user_email)
    {
        $where = array("email" => trim($edit_user_email));
        $check_exist = $this->users_model->get_by($where);

        $record_id = base64_decode($this->input->post('edit_user_id'));
        $where = array("id" => $record_id);
        $check_exist_byid = $this->users_model->get_by($where);

        if (is_array($check_exist) && sizeof($check_exist) > 0) {
            if (is_array($check_exist_byid) && sizeof($check_exist_byid) > 0) {
                if ($check_exist['email'] == $check_exist_byid['email']) {
                    return true;
                } else {
                    $this->form_validation->set_message("check_isuserExists_edit", 'Email already exist');
                    return false;
                }
            } else {
                $this->form_validation->set_message("check_isuserExists_edit", 'Email already exist');
                return false;
            }
        } else {
            return true;
        }
    }

    public function isNewsletterTitleExists()
    {
        $newsletter_subject = trim($this->input->post('newsletter_subject'));

        $where = array("newsletter_subject" => $newsletter_subject);
        $check_exist = $this->newsletter_model->get_by($where);

        if (is_array($check_exist) && sizeof($check_exist) > 0) {
            echo (json_encode(false));
        } else {
            echo (json_encode(true));
        }
        exit;
    }
}
