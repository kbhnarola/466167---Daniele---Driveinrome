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
        $this->load->model('Blogs_model', 'blogs_model');
        
        // Load file helper
        $this->load->helper('file');
        
    }
    /**
     * Loads the list of Users.
     */
    public function index()
    {
        $this->set_page_title(_l('blogs'));
        // $this->users->order_by('created_at', 'DESC');
        // $data['users']  = $this->users->get_all();
        // pass user data
        $data['all_blogs'] = $this->blogs_model->get_blogs('', 'id, email');
        $data['content'] = $this->load->view('admin/blogs/index', $data, TRUE);
        $this->load->view('admin/layouts/index', $data);
    }

    public function getLists()
    {
        $data = $row = array();
        // Fetch users list
        // $this->blogs_model->get_blogs_with_tag();
        $memData = $this->blogs_model->getRows($_POST);
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
            "recordsTotal" => $this->blogs_model->countFiltered($_POST),
            "recordsFiltered" => $this->blogs_model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
        exit;
    }
}