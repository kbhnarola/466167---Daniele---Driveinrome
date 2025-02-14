<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// require_once('PHPExcel.php');

class Blogs extends Admin_Controller

{

    /**

     * Constructor for the class

     */

    public function __construct()

    {

        parent::__construct();

        $this->load->model('Blogs_model', 'blogs_model');

    }

    /**

     * Loads the list of Users.

     */

    public function index()

    {

        // $this->set_page_title(_l('blogs'));

        

        $data['content'] = $this->load->view('admin/blogs/index', '', TRUE);

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

        foreach($memData as $blogs){            

            // $data[$j]['userID']=$i+1;

            $data[$j]['RecordID']=$i+1;

            $data[$j]['title'] = $blogs->title;

            $data[$j]['categories'] = $blogs->categories;

            $data[$j]['id'] = $blogs->id;

            $data[$j]['status'] =  $blogs->status;

            $data[$j]['created_at'] =  date( 'Y-m-d', strtotime($blogs->created_at));

            $data[$j]['id'] = $blogs->id;

            $data[$j]['action']=base64_encode($blogs->id);

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

    public function add()    

	{

		if ($this->input->post())

		{   

            // pr($_POST);die;                     

            $this->form_validation->set_rules('blog_title', 'blog title', 'trim|required');

            $this->form_validation->set_rules('blog_content', 'blog content', 'trim|required');



            if($this->form_validation->run() == FALSE) {

                

                set_alert('error', _l('something_wrong'));

               

                //set_alert('error', current(validation_errors()));

                redirect(admin_url('blogs'));

            } else {

                $seperate_blog_categories = '';

                $blog_title=trim($this->input->post("blog_title"));

                $blog_categories=$this->input->post("blog_categories");

                $blog_content=trim($this->input->post("blog_content"));

                foreach($blog_categories as $single_cat){

                    $seperate_blog_categories .= $single_cat.',';

                }

                $seperate_blog_categories = rtrim($seperate_blog_categories, ',');

                $meta_title=trim($this->input->post("meta_title"));

                $meta_keywords=trim($this->input->post("meta_keywords"));

                $meta_description=trim($this->input->post("meta_description"));



                $image_name=$banner_image_name="";



                if(is_array($_FILES) && sizeof($_FILES)>0){

                    if(array_key_exists('feature_image', $_FILES) && $_FILES['feature_image']['tmp_name']!='') {

                        

                        $config['upload_path'] = './uploads/blogs/';

                        $config['allowed_types'] = '*';

                        $file_name = time();

                        $config['file_name'] = $file_name;



                        $this->load->library("upload",$config);

                        $this->upload->initialize($config);



                        if($this->upload->do_upload('feature_image')) {

                            $data = array('upload_data' => $this->upload->data());

                            $image_name= $data['upload_data']['file_name'];

                        } else {

                            set_alert('error',current($this->upload->display_errors()));

                            redirect(admin_url('blogs'));

                            exit;

                        } 

                    }

                    if(array_key_exists('banner_image', $_FILES) && $_FILES['banner_image']['tmp_name']!='') {

                        

                        $config['upload_path'] = './uploads/blogs/';

                        $config['allowed_types'] = '*';

                        $file_name = time();

                        $config['file_name'] = $file_name;



                        $this->load->library("upload",$config);

                        $this->upload->initialize($config);



                        if($this->upload->do_upload('banner_image')) {

                            $data = array('upload_data' => $this->upload->data());

                            $banner_image_name= $data['upload_data']['file_name'];

                        } else {

                            set_alert('error',current($this->upload->display_errors()));

                            redirect(admin_url('blogs'));

                            exit;

                        } 

                    }                     

                }



    	        $data=array(

                    "title"=>$blog_title,

                    "slug"=>slugify($blog_title),

                    "content"=>$blog_content,

                    "featured_image"=>$image_name,

                    "banner_image"=>$banner_image_name,

                    "category_ids"=>$seperate_blog_categories,

                    "meta_title"=>$meta_title,

                    "meta_keyword"=>$meta_keywords,

                    "meta_description"=>$meta_description

                    );

                if($this->input->post('is_draft')==1) {

                    $data['is_draft']=1;

                }

                $insert=$this->blogs_model->insert_blog($data);



                if($insert){



                    set_alert('success', _l('_added_successfully', _l('blog')));

                    

                    redirect(admin_url('blogs'));

                } else {

                	set_alert('error', _l('something_wrong'));

                    

                    redirect(admin_url('blogs'));

                }	   

            }     

		}

		else

		{

            $this->set_page_title(_l('blogs').' | '._l('add'));



            $cdata['blog_categories'] = $this->blogs_model->get_blog_category();

            

			$data['content'] = $this->load->view('admin/blogs/add', $cdata, TRUE);

            $this->load->view('admin/layouts/index', $data);

		}

    }

    public function isBlogExists(){

        $blog_title = ucwords(trim($this->input->post('blog_title')));

        $record_id = base64_decode($this->input->post('record_id'));



        $where=array("title"=>$blog_title);

        $check_exist=$this->blogs_model->get_blog($where);

        

        if($record_id) {     



            $where=array("id"=>$record_id);

            $check_exist_byid=$this->blogs_model->get_blog($where);

            // echo '<pre>';

            // pr($check_exist);die;

            if(is_array($check_exist) && sizeof($check_exist) > 0) {

                if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){

                    if($check_exist[0]['title']==$check_exist_byid[0]['title']){

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



    public function delete()

    {

        $blog_id = base64_decode($this->input->post('blog_id'));



        $where=array('id'=>$blog_id);

        $check_exist=$this->blogs_model->get_blog($where);



        $response=array();

        if(is_array($check_exist) && sizeof($check_exist)>0){

            $deleted = $this->blogs_model->delete_blog(array("id"=>$blog_id));

            if ($deleted) {

                

               $response['success']=true;

               $response['msg']=_l('_deleted_successfully', _l('blog'));

                

            } else {

                $response['success']=false;

                $response['msg']=_l('something_wrong');

            }            

        } else {            

            $response['success']=false;

            $response['msg']="Either caqtegory not exist or deleted";

        }

        echo json_encode($response);

        exit;

    }

    public function update_status(){

        $blog_id = base64_decode($this->input->post('blog_id'));

        $data    = array('status' => $this->input->post('is_active'));

        $update = $this->blogs_model->update_blog(array("id"=>$blog_id), $data);



        if ($update) {

            if ($this->input->post('is_active') == 1)

            {

                $response['success']=true;

                $response['msg']='true';

                $response['alert_msg']=_l('_activated', _l('blog'));

            }

            else

            {

                $response['success']=true;

                $response['msg']='false';

                $response['alert_msg']=_l('_deactivated', _l('blog'));

            }

        } else {

            $response['success']=false;

            $response['msg']=_l('something_wrong');

        }

        echo json_encode($response);

        exit;

    }

    public function edit($id = '')

    {

        // echo "<pre>";

        // print_r($this->input->post());

        // exit;

        $blog_id = base64_decode($id);

        $this->set_page_title(_l('blogs').' | '._l('edit'));

        if ($id)

        {

            if ($this->input->post()) {

                $this->form_validation->set_rules('blog_title', 'blog title', 'trim|required');

                $this->form_validation->set_rules('blog_content', 'blog content', 'trim|required');

                

                if($this->form_validation->run() == FALSE) {

                    set_alert('error', _l('something_wrong'));

                    redirect(admin_url('blogs'));

                } else {

                    $seperate_blog_categories = '';

                    $blog_title=trim($this->input->post("blog_title"));

                    $blog_categories=$this->input->post("blog_categories");

                    $blog_content=trim($this->input->post("blog_content"));

                    foreach($blog_categories as $single_cat){

                        $seperate_blog_categories .= $single_cat.',';

                    }

                    $seperate_blog_categories = rtrim($seperate_blog_categories, ',');

                    $meta_title=trim($this->input->post("meta_title"));

                    $meta_keywords=trim($this->input->post("meta_keywords"));

                    $meta_description=trim($this->input->post("meta_description"));

                    

                    $image_name=$banner_image_name="";



                    if(is_array($_FILES) && sizeof($_FILES)>0){

                        if(array_key_exists('feature_image', $_FILES) && $_FILES['feature_image']['tmp_name']!='') {

                            

                            $config['upload_path'] = './uploads/blogs/';

                            $config['allowed_types'] = '*';

                            $file_name = time();

                            $config['file_name'] = $file_name;



                            $this->load->library("upload",$config);

                            $this->upload->initialize($config);



                            if($this->upload->do_upload('feature_image')) {

                                $data = array('upload_data' => $this->upload->data());

                                $image_name= $data['upload_data']['file_name'];

                            } else {

                                   

                                    set_alert('error',current($this->upload->display_errors()));

                                         redirect('blogs');

                                         exit;

                            } 

                        } 

                        if(array_key_exists('banner_image', $_FILES) && $_FILES['banner_image']['tmp_name']!='') {

                            

                            $config['upload_path'] = './uploads/blogs/';

                            $config['allowed_types'] = '*';

                            $file_name = time();

                            $config['file_name'] = $file_name;



                            $this->load->library("upload",$config);

                            $this->upload->initialize($config);



                            if($this->upload->do_upload('banner_image')) {

                                $data = array('upload_data' => $this->upload->data());

                                $banner_image_name= $data['upload_data']['file_name'];

                            } else {                                   

                                set_alert('error',current($this->upload->display_errors()));

                                redirect('blogs');

                                exit;

                            } 

                        }                     

                    }



                    $data=array(

                        "title"=>$blog_title,

                        "slug"=>slugify($blog_title),

                        "content"=>$blog_content,

                        "category_ids"=>$seperate_blog_categories,

                        "is_draft"=>$this->input->post('is_draft'),

                        "meta_title"=>$meta_title,

                        "meta_keyword"=>$meta_keywords,

                        "meta_description"=>$meta_description

                        );

                    if($image_name){

                        $data["featured_image"]=$image_name;   

                    }

                    if($banner_image_name){

                        $data["banner_image"]=$banner_image_name;   

                    }

                    $update = $this->blogs_model->update_blog(array("id"=>$blog_id), $data);



                    if($update){

                        set_alert('success', _l('_updated_successfully', _l('blog')));

                        

                        redirect(admin_url('blogs'));

                    } else {

                        set_alert('error', _l('something_wrong'));

                        

                        redirect(admin_url('blogs'));

                    }      

                }



            } else {

                $blogdata = $this->blogs_model->get_blogs_with_categories($blog_id);

                if(is_array($blogdata) && sizeof($blogdata)>0) {

                    $cdata['blogData']=$blogdata;

                    $cdata['blog_categories']=$this->blogs_model->get_blog_category();

                    $data['content'] = $this->load->view('admin/blogs/edit', $cdata, TRUE);

                    $this->load->view('admin/layouts/index', $data);

                } else {

                    set_alert('error', 'Records not found');

                    redirect(admin_url("blogs"));

                    exit;

                }                

            }

        } else {

            redirect(admin_url("blogs"));

            exit;

        }

    }

}