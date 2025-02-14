<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tours extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tours_model', 'tours');
        $this->load->model('Tour_type_model', 'tour_types');
        $this->load->model('Tour_categories_model', 'tour_categories');
        $this->load->model('Tour_variation_model', 'tour_variation');
        $this->load->model('Tour_price_plan_model', 'tour_price');
        $this->load->model('Tour_extra_services_model', 'tour_extra_services');
	}

	
	/**
	* @author bsm
	*
	* Loads the admin dashboard
	*
	*/
	public function index()
	{
		$this->set_page_title(_l('manage_tour'));
        
		$data['content'] = $this->load->view('admin/tours/index', '', TRUE);
        $this->load->view('admin/layouts/index', $data);
	}

	/**
    * @author Bhavesh(bsm)
    *
    * get list of Tours this will use by jquery datatable
    *
    */
    public function getLists()
    {
        $data = $row = array();

        // Fetch tours's list
        $memData = $this->tours->getRows($_POST);
        // echo $this->db->last_query();
        // exit;
        $i = $_POST['start'];
        $j=0;
        foreach($memData as $tours){
            
            $data[$j]['RecordID']=$i+1;
            $data[$j]['tour_type'] = $tours->tour_type;
            $data[$j]['tour_category'] = $tours->tour_category;
            $data[$j]['tour_name'] = $tours->title;
            $data[$j]['unique_code'] = $tours->unique_code;
            $data[$j]['duration'] = $tours->duration;
            if($tours->rating==0){
                $data[$j]['ratings'] = "N/A";
            } else {
                $data[$j]['ratings'] = $tours->rating;
            }   
            if($tours->extra_services_id){
                $ex_services=explode(",",$tours->extra_services_id);
                $extra_services_title=array();
                $extra_service_array=set_extra_services();
                foreach($ex_services as $ex){
                    if(array_key_exists($ex, $extra_service_array)){
                        $extra_services_title[]=$extra_service_array[$ex];
                    }
                }
                if(is_array($extra_services_title) && sizeof($extra_services_title)>0){
                    $data[$j]['extra_services'] = implode(", ",$extra_services_title);
                } else {
                    $data[$j]['extra_services'] = "N/A";
                }
            } else {
                $data[$j]['extra_services'] = "N/A";
            }
            //$data[$j]['ratings'] = $tours->rating;
            $data[$j]['status'] = $tours->status;
            $data[$j]['id'] = $tours->id;
            $data[$j]['action']=base64_encode($tours->id);
            $j++;
            $i++;
            //$data[] = array($i, $tours->tour_type,$tours->unique_code,$tours->tour_category,$tours->title,$tours->duration,$tours->rating,$status,$action);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tours->countFiltered($_POST),
            "recordsFiltered" => $this->tours->countFiltered($_POST),
            "aaData" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
        exit;
    }

	/**
     * @author bsm
     *
     * Add New Tour Type Form
     *
     * @param str    $title      title
     *
     */
	public function add()
	{
		if ($this->input->post())
		{
            // print_r($this->input->post());
            // exit;
            $tour_name=ucwords(trim($this->input->post("tour_name")));
            $this->form_validation->set_rules('tour_type', 'Tour Type', 'trim|required');
            $this->form_validation->set_rules('tour_category', 'Tour Category', 'trim|required');
            $this->form_validation->set_rules('tour_name', 'Tour Name', 'trim|required');
            $this->form_validation->set_rules('tour_unique_code', 'Unique code', 'trim|required');
            $this->form_validation->set_rules('duration', 'Duration', 'trim|required');
            $this->form_validation->set_rules('tour_description', 'Tour Description', 'trim|required');
            //$this->form_validation->set_rules('tour_included', 'Tour Included', 'trim|required');
            //$this->form_validation->set_rules('tour_restrictions[]', 'Tour Restrictions', 'trim|required');
            //$this->form_validation->set_rules('tour_meeting_point[]', 'Tour Meeting Point', 'trim|required');
            //$this->form_validation->set_rules('tour_faqs', 'Tour Faqs', 'trim|required');
            //$this->form_validation->set_rules('tour_cancellation_policy', 'Tour Cancellation Policy', 'trim|required');
           // $this->form_validation->set_rules('ratings', 'Ratings', 'trim|required|');
             $this->form_validation->set_rules('tour_featured_image', 'Tour Feature Image', 'callback_file_check_feature_image');
                
            if(array_key_exists("tour_gallery_image", $_FILES)) {
                if(is_array($_FILES['tour_gallery_image']['name']) && sizeof($_FILES['tour_gallery_image']['name'])>0) {
                        $this->form_validation->set_rules('tour_gallery_image', 'Tour Galllery Images', 'callback_file_check_gallery_image');
                }
            }

            if($this->form_validation->run() == FALSE) {
                
                set_alert('error', _l('something_wrong'));
               
                //set_alert('error', current(validation_errors()));
                redirect(admin_url('tours'));
            } else {


                $feature_img_name="";
                $gallery_img=array();

                 $config['upload_path'] = './uploads/';
                 $config['allowed_types'] = '*';

                foreach ($_FILES as $key=>$value) {
                    if($key == "tour_featured_image") {
                        if($value["name"]) {
                            
                            $file_name = time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload",$config);
                            $this->upload->initialize($config);

                            if($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $feature_img_name= $data['upload_data']['file_name'];
                            } 
                            else {
                                     //$data['optional_document_upload_error'] = $this->upload->display_errors();
                                     set_alert('error',current($this->upload->display_errors()));
                                     redirect('admin/tours');
                                     exit;
                            }

                        }
                    }
                    if($key=="tour_gallery_image") {
                        $files=$_FILES["tour_gallery_image"];
                        if(is_array($files) && sizeof($files) > 0) {
                            foreach ($files['name'] as $key=>$value) {
                                $_FILES['tour_gallery_image[]']['name']= $files['name'][$key];
                                $_FILES['tour_gallery_image[]']['type']= $files['type'][$key];
                                $_FILES['tour_gallery_image[]']['tmp_name']= $files['tmp_name'][$key];
                                $_FILES['tour_gallery_image[]']['error']= $files['error'][$key];
                                $_FILES['tour_gallery_image[]']['size']= $files['size'][$key];

                                $file_name = time();
                                $config['file_name'] = $file_name;

                                $this->load->library("upload",$config);
                                $this->upload->initialize($config);

                                if($this->upload->do_upload('tour_gallery_image[]')) {
                                    $data = array('upload_data' => $this->upload->data());
                                    $imgname= $data['upload_data']['file_name'];
                                    $gallery_img[]=$imgname;
                                } else {
                                    //$data['optional_document_upload_error'] = $this->upload->display_errors();
                                    set_alert('error',current($this->upload->display_errors()));
                                     redirect('admin/tours');
                                     exit;
                                }
                            }
                        }
                    }
                }
               
                $tour_type=trim($this->input->post("tour_type"));
                $tour_category=trim($this->input->post("tour_category"));
                $unique_code=trim($this->input->post("tour_unique_code"));
                $tour_description=$this->input->post("tour_description");
                $tour_included=$this->input->post("tour_included");
                
                $tour_cancellation_policy=$this->input->post("tour_cancellation_policy");
                $duration=trim($this->input->post("duration"));
                $top_selling_tour=$this->input->post("top_selling_tour");
                $ratings=trim($this->input->post("rating"));
                $extra_services=$this->input->post("extra_services[]");
                $meta_title=$this->input->post("meta_title");
                $meta_keywords=$this->input->post("meta_keywords");
                $meta_description=$this->input->post("meta_description");

                if(array_key_exists("tour_restrictions", $this->input->post())){
                    $tour_restrictions=$this->input->post("tour_restrictions[]");
                    $tour_restrictions_v=json_encode($tour_restrictions,JSON_FORCE_OBJECT);
                } else {
                    $tour_restrictions_v="";
                }
                if(array_key_exists("tour_meeting_point", $this->input->post())){
                    $tour_meeting_point=$this->input->post("tour_meeting_point[]");
                    $tour_meeting_point_v=json_encode($tour_meeting_point,JSON_FORCE_OBJECT);
                } else {
                    $tour_meeting_point_v="";
                }
                if(array_key_exists("tour_faqs_question", $this->input->post())){
                    $tour_faqs=array();

                    $tour_faqs_question=$this->input->post("tour_faqs_question[]");
                    $tour_faqs_answer=$this->input->post("tour_faqs_answer[]");

                    foreach($tour_faqs_question as $k=>$q){
                        $tour_faqs[]=array($q=>$tour_faqs_answer[$k]);
                    }
                    $tour_faqs_v=json_encode($tour_faqs);
                } else {
                    $tour_faqs_v="";
                }

                if(is_array($extra_services) && sizeof($extra_services)>0){
                    $extra_service_id=implode(",",$extra_services);
                } else {
                    $extra_service_id="";
                }
                
    	        $data=array(
                    "title"=>$tour_name,
                    "slug"=>slugify($tour_name),
                    "description"=>$tour_description,
                    "tour_included"=>$tour_included,
                    "tour_restrictions"=>$tour_restrictions_v,
                    "tour_meeting_point"=>$tour_meeting_point_v,
                    "tour_faqs"=>$tour_faqs_v,
                    "tour_cancellation_policy"=>$tour_cancellation_policy,
                    "tour_type_id"=>$tour_type,
                    "tour_category_id"=>$tour_category,
                    "unique_code"=>$unique_code,
                    "duration"=>$duration,
                    "top_selling_tour"=>$top_selling_tour,                    
                    "rating"=>$ratings,
                    "feature_image"=>$feature_img_name,
                    "gallery_image"=>implode(',',$gallery_img),
                    "extra_services_id"=>$extra_service_id,
                    "status"=>1,
                    "meta_title"=>$meta_title,
                    "meta_keyword"=>$meta_keywords,
                    "meta_description"=>$meta_description
                    );
                $insert=$this->tours->insert($data);

                if($insert){

                    $where=array("tour_type_id"=>$tour_type);
                    $tour_variations=$this->tour_variation->get_many_by($where);

                    if(is_array($tour_variations) && sizeof($tour_variations)>0) {

                        $variation_price=$this->input->post("basic_price[]");
                        
                        foreach($variation_price as $key=>$v){
                            $data=array(
                                "tour_id"=>$insert,
                                "variation_id"=>$tour_variations[$key]['id'],
                                "price"=>$v,
                                "price_type"=>1
                            );
                            $insert_variation_price=$this->tour_price->insert($data);
                        }

                        // if(array_key_exists("tour_date", $this->input->post())){
                        //     $custom_price=$this->input->post("custom_price[]");
                        //     $custom_price_chunk=array_chunk($custom_price,sizeof($this->input->post("basic_price[]")));
                        //     // print_r($custom_price_chunk);
                        //     // exit;
                        //     $tour_dates=$this->input->post('tour_date[]');
                        //     $i=0;
                        //     foreach($tour_dates as $tour_date) {
                        //         // $date=explode(",",$tour_date);
                        //         // foreach($date as $d){
                        //             foreach($custom_price_chunk[$i] as $key=>$v){
                        //                 $data=array(
                        //                     "tour_id"=>$insert,
                        //                     "variation_id"=>$tour_variations[$key]['id'],
                        //                     "price"=>$v,
                        //                     "tour_date"=>date('Y-m-d',strtotime($tour_date)),
                        //                     "price_type"=>2
                        //                 );
                        //                 $insert_variation_price=$this->tour_price->insert($data);
                        //             }
                        //         //}
                        //         $i++;
                        //     }
                                
                        // }
                    }

                    set_alert('success', _l('_added_successfully', _l('tours')));
                    
                    redirect('admin/tours');
                } else {
                	set_alert('error', _l('something_wrong'));
                    
                    redirect('admin/tours');
                }	   
            }     
		}
		else
		{
            $this->set_page_title(_l('tours').' | '._l('add'));

            $cdata['tour_types'] = get_tour_types();
            $cdata['tour_categories'] = get_tour_categories();
            $cdata['extra_services'] = get_extra_services();
            
			$data['content'] = $this->load->view('admin/tours/add', $cdata, TRUE);
            $this->load->view('admin/layouts/index', $data);
		}
	}

    public function file_check_feature_image()
    {
        //$allowed_mime_type_arr = array('image/jpeg','image/jpg','image/png');
        $allowed_mime_type_arr = array('jpeg','jpg','png');
        // print_r($_FILES);
        // exit;
        if(isset($_FILES['tour_featured_image']['name']) && $_FILES['tour_featured_image']['name']!="")
        {
            $mime = explode(".",$_FILES['tour_featured_image']['name']);
            if(in_array(end($mime), $allowed_mime_type_arr) && $_FILES['tour_featured_image']['size'] < (2* 1024 * 1024))
            {
                return true;
            }
            else
            {
                $this->form_validation->set_message('check_feature_image', 'File type must be JPG, JPEG or PNG and file size less than 2MB');
                return false;
            }
        }
    }

    public function file_check_gallery_image()
    {
        //$allowed_mime_type_arr = array('image/jpeg','image/jpg','image/png');
        $allowed_mime_type_arr = array('jpeg','jpg','png');
        $array=array();
        // print_r($_FILES);
        // exit;
        foreach ($_FILES['tour_gallery_image']['name'] as $key => $value) 
        {
            if(isset($value) && $value!="") 
            {
                //$mime = get_mime_by_extension($value);
                $mime = explode(".",$value);
                if(in_array(end($mime), $allowed_mime_type_arr) && $_FILES['tour_gallery_image']['size'][$key] < (2* 1024 * 1024))
                {
                    
                }
                else
                {
                    array_push($array,$value);
                }
            }
        }
        if(is_array($array) && sizeof($array)>0)
        {
            $this->form_validation->set_message('file_check_gallery_image', 'File type must be JPG, JPEG or PNG and file size less than 2MB');
            return false;
        } 
        else 
        {
            return true;
        }
    }

    /**
     * @author bsm
     *
     * Get Tour Category based on tour_type_id
     *
     * @param int    $tour_type_id      tour_type_id
     *
     */

    public function getTourVariantion(){

        $tour_type_id = $this->input->post('tour_type_id');

        $where=array("tour_type_id"=>$tour_type_id);
        $tour_variention=$this->tour_variation->get_many_by($where);
            
        if(is_array($tour_variention) && sizeof($tour_variention)>0) {
            $response['success']=true;
            $response['variation_list']=$tour_variention;        
        } else {
            $response['success']=false;
            $response['msg']=_l('something_wrong').' Records not found.';
        }
        
        echo json_encode($response);
        exit;
    }

    /**
     * @author bsm
     *
     * Check Tour Title already exist or not in Add & Edit Tour Title form Jquery-ajax Remote validation
     *
     * @param str    $tour_name  tour_name
     * @param int    $record_id  id
     *
     */
    public function istourExists()
    {
        $tour_name = ucwords(trim($this->input->post('tour_name')));
        $record_id = base64_decode($this->input->post('record_id'));

        $where=array("title"=>$tour_name);
        $check_exist=$this->tours->get_by($where);
        
        if($record_id) {            

            $where=array("id"=>$record_id);
            $check_exist_byid=$this->tours->get_by($where);

            if(is_array($check_exist) && sizeof($check_exist) > 0) {
                if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){
                    if($check_exist['title']==$check_exist_byid['title']){
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

    /**
     * @author bsm
     *
     * Check Tour Title already exist or not in Add & Edit Tour Title form Jquery-ajax Remote validation
     *
     * @param str    $tour_unique_code  tour_unique_code
     * @param int    $record_id  id
     *
     */
    public function istourcodeExists()
    {
        $tour_unique_code = trim($this->input->post('tour_unique_code'));
        $record_id = base64_decode($this->input->post('record_id'));

        $where=array("unique_code"=>$tour_unique_code);
        $check_exist=$this->tours->get_by($where);
        
        if($record_id) {            

            $where=array("id"=>$record_id);
            $check_exist_byid=$this->tours->get_by($where);

            if(is_array($check_exist) && sizeof($check_exist) > 0) {
                if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){
                    if($check_exist['unique_code']==$check_exist_byid['unique_code']){
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

    /**
     * @author bsm
     *
     * Update Status Tour types
     *
     * @param int    $tour_id      tour_id
     * @param int    $status      is_active
     *
     */
    public function update_status()
    {
        $tour_id = base64_decode($this->input->post('tour_id'));
        $data    = array('status' => $this->input->post('is_active'));
        $update = $this->tours->update_by(array("id"=>$tour_id), $data);

        if ($update) {
            if ($this->input->post('is_active') == 1)
            {
                $response['success']=true;
                $response['msg']='true';
                $response['alert_msg']=_l('_activated', _l('tours'));
            }
            else
            {
                $response['success']=true;
                $response['msg']='false';
                $response['alert_msg']=_l('_deactivated', _l('tours'));
            }
        } else {
            $response['success']=false;
            $response['msg']=_l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }

     /**
     * @author bsm
     *
     * Delete Tour types
     *
     * @param int    $tour_id      tour_id
     *
     */
    public function delete()
    {
        $tour_id = base64_decode($this->input->post('tour_id'));
        
        $where=array('id'=>$tour_id);
        $gettour=$this->tours->get_by($where);
        if(is_array($gettour) && sizeof($gettour)>0){

            if($gettour['feature_image']!=''){
                if(file_exists('uploads/'.$gettour['feature_image'])) {
                    $deleteimg= 'uploads/'.$gettour['feature_image'];
                    unlink($deleteimg);
                }
            }
            if($gettour['gallery_image']!=''){
                $gallery_image=explode(",",$gettour['gallery_image']);
                foreach ($gallery_image as $value) {
                   if(file_exists('uploads/'.$value)) {
                        $deleteimg= 'uploads/'.$value;
                        unlink($deleteimg);
                    }
                }
            }

        }
        $deleted = $this->tours->delete_by(array("id"=>$tour_id));

        $response=array();
        if ($deleted) {
            
           $delet_variation_price=$this->tour_price->delete_by(array("tour_id"=>$tour_id));
           $response['success']=true;
           $response['msg']=_l('_deleted_successfully', _l('tours'));
            
        } else {
            $response['success']=false;
            $response['msg']=_l('something_wrong');
        }
        
        echo json_encode($response);
        exit;
    }


    /**
     * Updates the project record
     *
     * @param int  $id  Tour id
     */
    public function edit($id = '')
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $this->set_page_title(_l('tours').' | '._l('edit'));
        if ($id)
        {
            if ($this->input->post()) {
                 
                $tour_name=ucwords(trim($this->input->post("tour_name")));
                $this->form_validation->set_rules('tour_type', 'Tour Type', 'trim|required');
                $this->form_validation->set_rules('tour_category', 'Tour Category', 'trim|required');
                $this->form_validation->set_rules('tour_name', 'Tour Name', 'trim|required');
                $this->form_validation->set_rules('tour_unique_code', 'Unique code', 'trim|required');
                $this->form_validation->set_rules('duration', 'Duration', 'trim|required');
                $this->form_validation->set_rules('tour_description', 'Tour Description', 'trim|required');
                //$this->form_validation->set_rules('tour_included', 'Tour Included', 'trim|required');
                //$this->form_validation->set_rules('tour_restrictions[]', 'Tour Restrictions', 'trim|required');
                //$this->form_validation->set_rules('tour_meeting_point[]', 'Tour Meeting Point', 'trim|required');
                //$this->form_validation->set_rules('tour_faqs', 'Tour Faqs', 'trim|required');
                //$this->form_validation->set_rules('tour_cancellation_policy', 'Tour Cancellation Policy', 'trim|required');
                if(is_array($_FILES) && sizeof($_FILES)>0){
                
                    if(array_key_exists("tour_featured_image", $_FILES)) {
                        if($_FILES['tour_featured_image']['tmp_name']!=''){
                           

                          $this->form_validation->set_rules('tour_featured_image', 'Tour Feature Image', 'callback_file_check_feature_image');
                        }
                    }

                    if(array_key_exists("tour_gallery_image", $_FILES)) {
                        if($_FILES['tour_gallery_image']['tmp_name'][0]!=''){
                            if(is_array($_FILES['tour_gallery_image']['name']) && sizeof($_FILES['tour_gallery_image']['name'])>0) {
                                
                                    $this->form_validation->set_rules('tour_gallery_image', 'Tour Galllery Images', 'callback_file_check_gallery_image');
                            }
                        }
                    }
                }
                
                if($this->form_validation->run() == FALSE) {
                    set_alert('error', _l('something_wrong'));
                    //print_r(validation_errors());

                    redirect(admin_url('tours'));
                } else {
                    
                    $feature_img_name="";
                    $gallery_img=array();
                    if(is_array($_FILES) && sizeof($_FILES)>0){

                         $config['upload_path'] = './uploads/';
                         $config['allowed_types'] = '*';

                        foreach ($_FILES as $key=>$value) {
                            if($key == "tour_featured_image") {
                                if($value["name"]) {
                                    
                                    $file_name = time();
                                    $config['file_name'] = $file_name;

                                    $this->load->library("upload",$config);
                                    $this->upload->initialize($config);

                                    if($this->upload->do_upload($key)) {
                                        $data = array('upload_data' => $this->upload->data());
                                        $feature_img_name= $data['upload_data']['file_name'];
                                    } 
                                    else {
                                             //$data['optional_document_upload_error'] = $this->upload->display_errors();
                                             // print_r($this->upload->display_errors());
                                             // exit;
                                             set_alert('error',current($this->upload->display_errors()));
                                             redirect('admin/tours');
                                             exit;
                                    }

                                }
                            }
                            if($key=="tour_gallery_image") {
                                $files=$_FILES["tour_gallery_image"];
                                if(is_array($files) && sizeof($files) > 0) {
                                    foreach ($files['name'] as $key=>$value) {
                                        if($value){
                                            $_FILES['tour_gallery_image[]']['name']= $files['name'][$key];
                                            $_FILES['tour_gallery_image[]']['type']= $files['type'][$key];
                                            $_FILES['tour_gallery_image[]']['tmp_name']= $files['tmp_name'][$key];
                                            $_FILES['tour_gallery_image[]']['error']= $files['error'][$key];
                                            $_FILES['tour_gallery_image[]']['size']= $files['size'][$key];

                                            $file_name = time();
                                            $config['file_name'] = $file_name;

                                            $this->load->library("upload",$config);
                                            $this->upload->initialize($config);

                                            if($this->upload->do_upload('tour_gallery_image[]')) {
                                                $data = array('upload_data' => $this->upload->data());
                                                $imgname= $data['upload_data']['file_name'];
                                                $gallery_img[]=$imgname;
                                            } else {
                                                //$data['optional_document_upload_error'] = $this->upload->display_errors();
                                                // print_r($this->upload->display_errors());
                                                // exit;
                                                set_alert('error',current($this->upload->display_errors()));
                                                 redirect('admin/tours');
                                                 exit;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }


                    $tour_type=trim($this->input->post("tour_type"));
                    $tour_category=trim($this->input->post("tour_category"));
                    $unique_code=trim($this->input->post("tour_unique_code"));
                    $tour_description=$this->input->post("tour_description");
                    $tour_included=$this->input->post("tour_included");
                    

                    $tour_cancellation_policy=$this->input->post("tour_cancellation_policy");
                    $duration=trim($this->input->post("duration"));
                    $top_selling_tour=$this->input->post("top_selling_tour");
                    $ratings=trim($this->input->post("rating"));
                    $extra_services=$this->input->post("extra_services[]");
                    $meta_title=$this->input->post("meta_title");
                    $meta_keywords=$this->input->post("meta_keywords");
                    $meta_description=$this->input->post("meta_description");
                    $tour_id=base64_decode($this->input->post('tour_id'));

                    if(array_key_exists("tour_restrictions", $this->input->post())){
                        $tour_restrictions=$this->input->post("tour_restrictions[]");
                        $tour_restrictions_v=json_encode($tour_restrictions,JSON_FORCE_OBJECT);
                    } else {
                        $tour_restrictions_v="";
                    }
                    if(array_key_exists("tour_meeting_point", $this->input->post())){
                        $tour_meeting_point=$this->input->post("tour_meeting_point[]");
                        $tour_meeting_point_v=json_encode($tour_meeting_point,JSON_FORCE_OBJECT);
                    } else {
                        $tour_meeting_point_v="";
                    }
                    if(array_key_exists("tour_faqs_question", $this->input->post())){
                        $tour_faqs=array();

                        $tour_faqs_question=$this->input->post("tour_faqs_question[]");
                        $tour_faqs_answer=$this->input->post("tour_faqs_answer[]");

                        foreach($tour_faqs_question as $k=>$q){
                            $tour_faqs[]=array($q=>$tour_faqs_answer[$k]);
                        }
                        $tour_faqs_v=json_encode($tour_faqs);
                    } else {
                        $tour_faqs_v="";
                    }
                    if(is_array($extra_services) && sizeof($extra_services)>0){
                        $extra_service_id=implode(",",$extra_services);
                    } else {
                        $extra_service_id="";
                    }
                    $data=array(
                        "title"=>$tour_name,
                        "slug"=>slugify($tour_name),
                        "description"=>$tour_description,
                        "tour_included"=>$tour_included,
                        "tour_restrictions"=>$tour_restrictions_v,
                        "tour_meeting_point"=>$tour_meeting_point_v,
                        "tour_faqs"=>$tour_faqs_v,
                        "tour_cancellation_policy"=>$tour_cancellation_policy,
                        "tour_type_id"=>$tour_type,
                        "tour_category_id"=>$tour_category,
                        "unique_code"=>$unique_code,
                        "duration"=>$duration,
                        "top_selling_tour"=>$top_selling_tour,                    
                        "rating"=>$ratings,
                        // "feature_image"=>$feature_img_name,
                        // "gallery_image"=>implode(',',$gallery_img),
                        "extra_services_id"=>$extra_service_id,
                        "status"=>1,
                        "meta_title"=>$meta_title,
                        "meta_keyword"=>$meta_keywords,
                        "meta_description"=>$meta_description
                    );
                    if($feature_img_name) {
                        $data["feature_image"]=$feature_img_name;
                    }
                    if(is_array($gallery_img) && sizeof($gallery_img)>0){
                        $where1=array("id"=>$tour_id,"gallery_image !="=>"");

                        $get_tour=$this->tours->get_by($where1);
                        
                        if(is_array($get_tour) && sizeof($get_tour)>0){
                            
                            $get_img=explode(",",$get_tour['gallery_image']);
                            $merge_image=array_merge($get_img,$gallery_img);
                            $gallery_images=implode(",",$merge_image);
                        } else {
                             
                            $gallery_images=implode(',',$gallery_img);
                        }
                        $data["gallery_image"]=$gallery_images;
                    }
                    // print_r($data);
                    // exit;
                    //$old_tour_type_id=$this->tour_variation->get_many_by($where);
                    $update=$this->tours->update_by(array("id"=>$tour_id),$data);

                    if($update){

                        $where=array("tour_type_id"=>$tour_type);
                        
                        $tour_variations=$this->tour_variation->get_many_by($where);

                        if(is_array($tour_variations) && sizeof($tour_variations)>0) {

                            if(base64_decode($this->input->post('ctour_type_id'))!=$tour_type) {
                                
                                $deleted = $this->tour_price->delete_by(array("tour_id"=>$tour_id));
                            } else {
                                
                                $deleted = $this->tour_price->delete_by(array("tour_id"=>$tour_id,"price_type"=>1));
                            }
                            $variation_price=$this->input->post("basic_price[]");
                            
                            foreach($variation_price as $key=>$v){
                                $data=array(
                                    "tour_id"=>$tour_id,
                                    "variation_id"=>$tour_variations[$key]['id'],
                                    "price"=>$v,
                                    "price_type"=>1
                                );
                                $insert_variation_price=$this->tour_price->insert($data);
                            }
                            // if(array_key_exists("tour_date", $this->input->post())){
                            //     $custom_price=$this->input->post("custom_price[]");
                            //     $custom_price_chunk=array_chunk($custom_price,sizeof($this->input->post("basic_price[]")));
                                
                            //     $tour_dates=$this->input->post('tour_date[]');
                            //     $i=0;
                            //     foreach($tour_dates as $tour_date) {
                                    
                            //             foreach($custom_price_chunk[$i] as $key=>$v){
                            //                 $data=array(
                            //                     "tour_id"=>$tour_id,
                            //                     "variation_id"=>$tour_variations[$key]['id'],
                            //                     "price"=>$v,
                            //                     "tour_date"=>date('Y-m-d',strtotime($tour_date)),
                            //                     "price_type"=>2
                            //                 );
                            //                 $insert_variation_price=$this->tour_price->insert($data);
                            //             }
                                    
                            //         $i++;
                            //     }
                                    
                            // }
                        }

                        set_alert('success', _l('_updated_successfully', _l('tours')));
                        
                        redirect('admin/tours');
                    } else {
                        set_alert('error', _l('something_wrong'));
                        
                        redirect('admin/tours');
                    }      
                }

            } else {
                
                $where=array("id"=>base64_decode($id));
                $toursData = $this->tours->get_by($where);
                
                // echo "<pre>";
                // print_r( $toursData['variation_price']);
                // exit;
                if(is_array($toursData) && sizeof($toursData)>0) {
                    $toursData['variation_price'] = $this->tours->getToursPriceDetails(base64_decode($id));
                    $cdata['toursData']=$toursData;
                    $cdata['tour_types'] = get_tour_types();
                    $cdata['tour_categories'] = get_tour_categories();
                    $cdata['extra_services'] = get_extra_services();
                    $data['content'] = $this->load->view('admin/tours/edit', $cdata, TRUE);
                    $this->load->view('admin/layouts/index', $data);
                } else {
                    set_alert('error', 'Records not found');
                    redirect(admin_url("tours"));
                    exit;
                }                
            }
        } else {
            redirect(admin_url("tours"));
            exit;
        }
    }

    /**
    * @author bsm
    *
    * made for remove Feature image of tour product
    *
    */
    public function remove_feature_img()
    {
        $tour_id= base64_decode($this->input->post('remove_id'));
        $imgname= $this->input->post('imgname');
        
        $data=array("feature_image"=>"");
        $update = $this->tours->update_by(array("id"=>$tour_id), $data);
        
        if($this->db->affected_rows()){
             if($imgname!=''){
                if(file_exists('uploads/'.$imgname)) {
                    $deleteimg= 'uploads/'.$imgname;
                    unlink($deleteimg); 
                }
            }
            $response['success']=true;
            $response['msg']=sprintf(_l('_deleted_successfully'),"Feature Image");
        } else {
            $response['success']=false;
            $response['msg']=_l('something_wrong')." Feature Image Not Deleted";
        }
        
        echo json_encode($response);
        exit;
    }

    /**
    * @author bsm
    *
    * made for remove Gallery image of tour product
    *
    */
    public function remove_gallery_img()
    {
        $tour_id= base64_decode($this->input->post('remove_id'));
        $imgname= $this->input->post('imgname');
        
        $where=array("id"=>$tour_id);
        $get_tour_data=$this->tours->get_by($where);
        if(is_array($get_tour_data) && sizeof($get_tour_data)>0){
            $gallery_img=explode(",",$get_tour_data['gallery_image']);

            if(in_array($imgname,$gallery_img)){

                if (($key = array_search($imgname, $gallery_img)) !== false) {
                    unset($gallery_img[$key]);
                }

                if(count($gallery_img)==0){
                    $data=array("gallery_image"=>"");
                } else {
                    $data=array("gallery_image"=>implode(",",$gallery_img));                    
                }
                
                $update = $this->tours->update_by(array("id"=>$tour_id), $data);

                if($this->db->affected_rows()){
                     if($imgname!=''){
                        if(file_exists('uploads/'.$imgname)) {
                            $deleteimg= 'uploads/'.$imgname;
                            unlink($deleteimg); 
                        }
                    }
                    //$gallery_img_arr = array_map('array_values', $gallery_img);
                    $response['success']=true;
                    $response['total']=count($gallery_img);
                    $response['gallery_img']=array_values($gallery_img);
                    $response['id']=base64_encode($tour_id);
                    $response['msg']=sprintf(_l('_deleted_successfully'),"Gallery Image");
                } else {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')." Gallery Image Not Deleted";
                }
            } else {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')." Gallery Image Not Deleted";
            }
        } else {
                $response['success']=false;
                $response['msg']=_l('something_wrong')." Gallery Image Not Deleted";
        }
        
        echo json_encode($response);
        exit;
    }

    
    public function getCustomPriceLists(){
        $data = $row = array();
   
        // Fetch tours's list
        $memData = $this->tours->getPriceRows($_POST);
        // echo "<pre>";
        // print_r($memData);
        // exit;
        // echo $this->db->last_query();
         //exit;
        $i = $_POST['start'];
        $j=0;
        
        foreach($memData as $tours){
            $tour_variation=explode(",",$tours->variation_title);
            $tour_price=explode(",",$tours->tour_price);
            $data[$j]['RecordID']=$i+1;
            $data[$j]['tour_date'] = date("d-m-Y",strtotime($tours->tour_date));
            foreach ($tour_price as $key=>$value) {
                // echo $tour_variation[$key];
                // exit;
                if($tours->tour_availability==1){
                    $data[$j][trim($tour_variation[$key])] = $value;
                } else {
                    $data[$j][trim($tour_variation[$key])] = "N/A";
                }
            }
            //$data[$j]['id'] = $tours->id;
            $data[$j]['action']=$tours->tour_date;
            $j++;
            $i++;
            
        }
        // echo "<pre>";
        // print_r($data);
        // exit;
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tours->countPriceFiltered($_POST),
            "recordsFiltered" => $this->tours->countPriceFiltered($_POST),
            "aaData" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
        exit;
    }

    public function delete_record_price(){

        $tour_id = base64_decode($this->input->post('tour_id'));
        $tour_date= date("Y-m-d",strtotime($this->input->post('tour_date')));
        // print_r($this->input->post());
        // exit;
        $where=array('tour_id'=>$tour_id,"tour_date"=>$tour_date);
        $deleted = $this->tour_price->delete_custom_record($tour_id,$tour_date);
        // echo $this->db->last_query();
        // exit;
        if ($deleted) {
            
           $response['success']=true;
           $response['msg']=_l('_deleted_successfully', _l('tour_price'));
            
        } else {
            $response['success']=false;
            $response['msg']=_l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }

    /**
    * @author bsm
    *
    * return user data by it id
    *
    * @param int    $id    tour_id
    *
    */
    public function get_record_byID()
    {
        $tour_id = base64_decode($this->input->post('tour_id'));
        $tour_date= date("Y-m-d",strtotime($this->input->post('tour_date')));
       
        $where=array("tour_id"=>$tour_id,"tour_date"=>$tour_date);
        $data=$this->tour_price->get_record_by($tour_id,$tour_date);
        // echo $this->db->last_query();
        // print_r($data);
        // exit;

        if(is_array($data) && sizeof($data) > 0)    
        {
            $cdata['success']=true;
            $cdata['variation_price']=$data;
            echo json_encode($cdata);
        }
        else
        {
            $cdata['success']=false;
            $cdata['msg']="Records not found".' '._l("something_wrong");
             echo json_encode($cdata);
        }
        exit;
    }

    public function updateTourCustomPrice(){

        $tour_id=base64_decode($this->input->post('utours_id'));
        $utour_date=date("Y-m-d",strtotime($this->input->post('utour_date')));
        $utour_type_id=$this->input->post('utour_type_id');
        $upd_custom_price=$this->input->post('upd_custom_price[]');

        $get_price=$this->tour_price->get_record_by($tour_id,$utour_date);
        $count=0;
        if(is_array($get_price) && sizeof($get_price)>0){
            foreach ($get_price as $key => $value) {
                //echo $value['price']." ".$upd_custom_price[$key];

                if($value['price']!=$upd_custom_price[$key]){
                    $count++;
                    break;
                }
            }
        }
        // echo $count;
        // exit;
        if($count>0){
            $where_available=array("tour_id"=>$tour_id,"tour_date"=>date('Y-m-d',strtotime($utour_date)));
            $get_tour_by=$this->tour_price->get_by($where_available);
            // echo $this->db->last_query();
            // print_r($get_tour_by);
            // exit;
            if($get_tour_by['tour_availability']==1){
                $deleted = $this->tour_price->delete_custom_record($tour_id,$utour_date);
                //echo $this->db->last_query();
                if($deleted){

                    $where=array("tour_type_id"=>$utour_type_id);
                    $tour_variations=$this->tour_variation->get_many_by($where);

                    foreach ($upd_custom_price as $key => $value) {
                         $data=array(
                                "tour_id"=>$tour_id,
                                "variation_id"=>$tour_variations[$key]['id'],
                                "price"=>$value,
                                "tour_date"=>date('Y-m-d',strtotime($utour_date)),
                                "price_type"=>2
                                //"tour_availability"=>($get_tour_by['tour_availability']==1)?1:0
                            );
                        $insert_variation_price=$this->tour_price->insert($data);
                    }
                    
                    $response['success']=true;
                    $response['msg']=_l('_updated_successfully', _l('tour_price'));
                } else {
                    
                    $response['success']=false;
                    $response['msg']=_l('something_wrong');
                }
            } else {
                $response['success']=false;
                $response['msg']="Tour Price Not Updated, Tour is close on that date";
            }
        } else {
            $response['success']=false;
            $response['msg']="Please Update Any Variation Price";
        }
        echo json_encode($response);
        exit;
    }
}
?>