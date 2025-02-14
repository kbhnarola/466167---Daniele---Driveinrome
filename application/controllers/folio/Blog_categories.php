<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once('PHPExcel.php');
class Blog_categories extends Admin_Controller
{
    /**
     * Constructor for the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Blog_categories_model', 'blog_categories_model');
    }
    /**
     * Loads the list of Users.
     */
    public function index()
    {
        $this->set_page_title(_l('blogs'));
        $data['blog_cat'] = $this->blog_categories_model->get_blog_category();
        $data['content'] = $this->load->view('admin/blog_categories/index', $data, TRUE);
        $this->load->view('admin/layouts/index', $data);
    }

    public function getLists()
    {
        $data = $row = array();
        $memData = $this->blog_categories_model->getRows($_POST);
        // pr($_POST);die;
        $i = $_POST['start'];
        $j=0;
        foreach($memData as $blog_cat){            
            // $data[$j]['userID']=$i+1;
            $data[$j]['RecordID']=$i+1;
            $data[$j]['name'] = $blog_cat->name;
            $data[$j]['id'] = $blog_cat->id;
            $data[$j]['status'] =  $blog_cat->status;
            $data[$j]['created_at'] =  date( 'Y-m-d', strtotime($blog_cat->created_at));
            $data[$j]['id'] = $blog_cat->id;
            $data[$j]['action']=base64_encode($blog_cat->id);
            $j++;
            $i++;
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->blog_categories_model->countFiltered($_POST),
            "recordsFiltered" => $this->blog_categories_model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
        exit;
    }

    /**
     * @author arj
     *
     * Add New Blog category Form
     * 
     **/
    public function add()
    {
        if ($this->input->post())
        {
            $blog_category=ucwords(trim($this->input->post("blog_category")));
            //$this->form_validation->set_rules('tour_type', 'Tour type', 'required');
            $this->form_validation->set_rules('blog_category', 'Blog Category', 'trim|required');
            
            if($this->form_validation->run() == FALSE){
                 $errors = $this->form_validation->error_array();
                 $response['success']=false;
                 //$response['error_msg']=_l('something_wrong');
                 $response['error_msg']=current($errors);

            } else {
                $blog_parent_category=$this->input->post("blog_parent_category"); 
                $meta_description=trim($this->input->post("meta_description"));                
                $meta_title=trim($this->input->post("meta_title"));                
                $meta_keywords=trim($this->input->post("meta_keywords"));                
                $data=array(
                    "name"=>$blog_category,
                    "slug"=>slugify($blog_category),
                    "parent_cat_id"=>$blog_parent_category,
                    "meta_keyword"=>$meta_keywords,
                    "meta_title"=>$meta_title,
                    "meta_description"=>$meta_description
                );

                $insert = $this->blog_categories_model->insert_blog_category($data);
                
                if($insert){
                    $response['success']=true;
                    $response['insert_id']=$insert;
                    $response['msg']=_l('_added_successfully', _l('blog_category'));
                } else {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_added', _l('blog_category'));
                }      
            }     
        }
        else
        {
            $response['success']=false;
            $response['error_msg']=_l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }

    public function edit()
    {
        if ($this->input->post())
        {
            $blog_category=ucwords(trim($this->input->post("blog_category")));
            $this->form_validation->set_rules('blog_category', 'Blog category', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                $response['success']=false;
                $response['msg']=current($errors);              
            }
            else
            {              
                $blog_parent_category=$this->input->post("blog_parent_category");
                $meta_description=trim($this->input->post("meta_description"));                
                $meta_title=trim($this->input->post("meta_title"));                
                $meta_keywords=trim($this->input->post("meta_keywords"));  
                $id = base64_decode($this->input->post('blog_category_id'));  
                if ($id)
                {
                    $data=array(
                        "name"=>$blog_category,
                        "slug"=>slugify($blog_category),
                        "parent_cat_id"=>$blog_parent_category,
                        "meta_keyword"=>$meta_keywords,
                        "meta_title"=>$meta_title,
                        "meta_description"=>$meta_description
                    );
                    $update = $this->blog_categories_model->update_category(array("id"=>$id), $data);
                    
                    if ($update)
                    {
                        $response['success']=true;
                        $response['edit']=true;
                        $response['msg']=_l('_updated_successfully', _l('blog_category'));
                        
                    }
                    else
                    {
                        $response['success']=false;
                        $response['msg']=_l('something_wrong')._l('not_updated', _l('blog_category'));
                        
                    }
                }
                else
                {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_updated', _l('blog_category'));
                }
            }
            echo json_encode($response);
            exit;
        }
        else
        {
            redirect(admin_url('tour-categories'));
           // redirect('tour-categories');
            exit;
        }
    }
    /**
     * @author arj
     *
     * Check Blog Categories already exist or not in Add & Edit Blog Category form
     *
     * @param str    $blog_category  blog_category
     * @param int    $record_id  id
     *
     */
    public function isCategoryExists()
    {
        $blog_category = ucwords(trim($this->input->post('blog_category')));
        $record_id = base64_decode($this->input->post('record_id'));

        $where=array("name"=>$blog_category);
        $check_exist=$this->blog_categories_model->get_blog_category($where);
        
        if($record_id) {      

            $where=array("id"=>$record_id);
            $check_exist_byid=$this->blog_categories_model->get_blog_category($where);
            // echo '<pre>';
            // pr($check_exist);die;
            if(is_array($check_exist) && sizeof($check_exist) > 0) {
                if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){
                    if($check_exist[0]['name']==$check_exist_byid[0]['name']){
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
        $blog_category_id = base64_decode($this->input->post('blog_category_id'));

        $where=array('id'=>$blog_category_id);
        $check_exist=$this->blog_categories_model->get_category_by($where);

        $response=array();
        if(is_array($check_exist) && sizeof($check_exist)>0){
            $deleted = $this->blog_categories_model->delete_category(array("id"=>$blog_category_id));
            if ($deleted) {
                
               $response['success']=true;
               $response['msg']=_l('_deleted_successfully', _l('blog_category'));
                
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

    public function get_record_byID()
    {
        $record_id = base64_decode($this->input->post('blog_category_id'));
        
        $where=array("id"=>$record_id);
        $data=$this->blog_categories_model->get_category_by($where);       
        
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
    public function update_status(){
        $blog_category_id = base64_decode($this->input->post('blog_category_id'));
        $data    = array('status' => $this->input->post('is_active'));
        $update = $this->blog_categories_model->update_category(array("id"=>$blog_category_id), $data);

        if ($update) {
            if ($this->input->post('is_active') == 1)
            {
                $response['success']=true;
                $response['msg']='true';
                $response['alert_msg']=_l('_activated', _l('blog_category'));
            }
            else
            {
                $response['success']=true;
                $response['msg']='false';
                $response['alert_msg']=_l('_deactivated', _l('blog_category'));
            }
        } else {
            $response['success']=false;
            $response['msg']=_l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }
}