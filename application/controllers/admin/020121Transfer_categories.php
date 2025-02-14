<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_categories extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transfer_categories_model', 'transfer_categories');
        $this->load->model('Transfers_model', 'transfers');
	}

	
	/**
	* @author bsm
	*
	* Loads the admin dashboard
	*
	*/
	public function index()
	{
		$this->set_page_title(_l('transfer_categories'));
        
		$data['content'] = $this->load->view('admin/transfer_categories/index', '', TRUE);
		$this->load->view('admin/layouts/index', $data);

	}

	/**
    * @author Bhavesh(bsm)
    *
    * get list of county this will use by jquery datatable
    *
    */
    public function getLists()
    {
        $data = $row = array();

        // Fetch Transfer category's list
        $memData = $this->transfer_categories->getRows($_POST);
        
        $i = $_POST['start'];
        $j=0;
        foreach($memData as $categories){         
            
            $data[$j]['RecordID']=$i+1;
            $data[$j]['transfer_categories'] = $categories->title;
            //$data[$j]['tour_type'] = $categories->tour_type_name;
            $data[$j]['status'] = $categories->status;
            $data[$j]['id'] = $categories->id;
            $data[$j]['action']=base64_encode($categories->id);
            $j++;
            $i++;
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->transfer_categories->countFiltered($_POST),
            "recordsFiltered" => $this->transfer_categories->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
        exit;
    }

    /**
     * @author bsm
     *
     * Check transfer Categories already exist or not in Add & Edit transfer Category form Jquery-ajax Remote validation
     *
     * @param str    $transfer_category  transfer_category
     * @param int    $record_id  id
     *
     */
    public function isCategoryExists()
    {
        $transfer_category = ucwords(trim($this->input->post('transfer_category')));
        $record_id = base64_decode($this->input->post('record_id'));

        $where=array("title"=>$transfer_category);
        $check_exist=$this->transfer_categories->get_by($where);
        
        if($record_id) {            

            $where=array("id"=>$record_id);
            $check_exist_byid=$this->transfer_categories->get_by($where);

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
     * Add New transfer Type Form
     *
     * @param int    $transfer_type_id   transfer_type_id
     * @param str    $transfer_category      transfer_category
     *
     */
    public function add()
    {
        if ($this->input->post())
        {
            $transfer_category=ucwords(trim($this->input->post("transfer_category")));
            //$this->form_validation->set_rules('transfer_type', 'transfer type', 'required');
            $this->form_validation->set_rules('transfer_category', 'City', 'trim|required|callback_check_isCategoryExists[' . $transfer_category . ']');
            //$this->form_validation->set_rules('tour_Category', 'transfer Category', 'trim|required');
            
            if($this->form_validation->run() == FALSE){
                 $errors = $this->form_validation->error_array();
                 $response['success']=false;
                 //$response['error_msg']=_l('something_wrong');
                 $response['error_msg']=current($errors);

            } else {

                //$transfer_type_id=$this->input->post("transfer_type");
                $meta_title=$this->input->post("meta_title");
                $meta_keywords=$this->input->post("meta_keywords");
                $meta_description=$this->input->post("meta_description");
                
                $data=array(
                    "title"=>$transfer_category,
                    "slug"=>slugify($transfer_category),
                    "status"=>1,
                    "meta_title"=>$meta_title,
                    "meta_keywords"=>$meta_keywords,
                    "meta_description"=>$meta_description
                    );

                $insert=$this->transfer_categories->insert($data);
                
                if($insert){
                    $response['success']=true;
                    $response['msg']=_l('_added_successfully', _l('transfer_category'));
                } else {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_added', _l('transfer_category'));
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

    /**
     * @author bsm
     *
     * Check transfer type already exist or not in Add transfer Type form Server side validation
     *
     * @param str    $transfer_category      transfer_category
     *
     */
    public function check_isCategoryExists($transfer_category)
    {
        $transfer_category = ucwords(trim($this->input->post('transfer_category')));

        $where=array("title"=>$transfer_category);
        $check_exist=$this->transfer_categories->get_by($where);

        if(is_array($check_exist) && sizeof($check_exist) > 0) {          
            $this->form_validation->set_message("check_isCategoryExists",'City already exist');
            return false;       
        } else {
            return true;
        }
    }

    /**
     * @author bsm
     *
     * Check transfer type already exist or not in edit transfer Type form Server side validation
     *
     * @param str    $transfer_category      transfer_category
     * @param int    $record_id  id
     *
     */
    public function check_iscategoryExists_edit($transfer_category)
    {
        $where=array("title"=>ucwords(trim($transfer_category)));        
        $check_exist=$this->transfer_categories->get_by($where);

        $record_id=base64_decode($this->input->post('transfer_category_id'));
        $where=array("id"=>$record_id);
        $check_exist_byid=$this->transfer_categories->get_by($where);

        if(is_array($check_exist) && sizeof($check_exist) > 0) {
            if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){
                if($check_exist['title']==$check_exist_byid['title']){
                     return true;
                } else {
                    $this->form_validation->set_message("check_iscategoryExists_edit",'City already exist');
                    return false;
                }
            } else {
                $this->form_validation->set_message("check_iscategoryExists_edit",'City already exist');
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * @author bsm
     *
     * Update Status transfer Categories
     *
     * @param int    $transfer_category_id      transfer_category_id
     * @param int    $status      is_active
     *
     */
    public function update_status()
    {
        $transfer_category_id = base64_decode($this->input->post('transfer_category_id'));
        $data    = array('status' => $this->input->post('is_active'));
        $update = $this->transfer_categories->update_by(array("id"=>$transfer_category_id), $data);

        if ($update) {
            if ($this->input->post('is_active') == 1)
            {
                $response['success']=true;
                $response['msg']='true';
                $response['alert_msg']=_l('_activated', _l('transfer_categories'));
            }
            else
            {
                $response['success']=true;
                $response['msg']='false';
                $response['alert_msg']=_l('_deactivated', _l('transfer_categories'));
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
     * Delete transfer types
     *
     * @param int    $transfer_category_id      transfer_category_id
     *
     */
    public function delete()
    {
        $transfer_category_id = base64_decode($this->input->post('transfer_category_id'));

        $where=array('transfer_category_id'=>$transfer_category_id);
        $check_exist=$this->transfers->get_by($where);

        $response=array();
        if(is_array($check_exist) && sizeof($check_exist)>0){

            $response['success']=false;
            $response['msg']="City not deleted, It is used in Transfers Product";

        } else {
            $deleted = $this->transfer_categories->delete_by(array("id"=>$transfer_category_id));
            if ($deleted) {
                
               $response['success']=true;
               $response['msg']=_l('_deleted_successfully', _l('transfer_category'));
                
            } else {
                $response['success']=false;
                $response['msg']=_l('something_wrong');
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
    * @author bsm
    *
    * return user data by it id
    *
    * @param int    $id    transfer_category_id
    *
    */
    public function get_record_byID()
    {
        $record_id = base64_decode($this->input->post('transfer_category_id'));
       
        $where=array("id"=>$record_id);
        $data=$this->transfer_categories->get_by($where);

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

    /**
     * @author bsm
     *
     * edit transfer types
     *
     * @param str    $transfer_type   transfer_type_id
     * @param str    $transfer_category   transfer_category
     * @param int    $id      transfer_category_id
     *
     */
    public function edit()
    {
        if ($this->input->post())
        {
            $transfer_category=ucwords(trim($this->input->post("transfer_category")));
            //$this->form_validation->set_rules('transfer_type', 'transfer type', 'required');
            //$this->form_validation->set_rules('transfer_category', 'transfer Category', 'trim|required');
            $this->form_validation->set_rules('transfer_category', 'City', 'trim|required|callback_check_isCategoryExists_edit[' . $transfer_category . ']');

            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                $response['success']=false;
                $response['msg']=current($errors);              
            }
            else
            {
                $id = base64_decode($this->input->post('transfer_category_id'));               

                if ($id)
                {
                    //$transfer_type_id=$this->input->post("transfer_type");
                    $meta_title=$this->input->post("meta_title");
                    $meta_keywords=$this->input->post("meta_keywords");
                    $meta_description=$this->input->post("meta_description");
                    

                    $data=array(
                        "title"=>$transfer_category,
                        "slug"=>slugify($transfer_category),
                        "status"=>1,
                        "meta_title"=>$meta_title,
                        "meta_keywords"=>$meta_keywords,
                        "meta_description"=>$meta_description
                        );
                    $update = $this->transfer_categories->update_by(array("id"=>$id), $data);
                    
                    if ($update)
                    {
                        $response['success']=true;
                        $response['msg']=_l('_updated_successfully', _l('transfer_categories'));
                        
                    }
                    else
                    {
                        $response['success']=false;
                        $response['msg']=_l('something_wrong')._l('not_updated', _l('transfer_categories'));
                        
                    }
                }
                else
                {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_updated', _l('transfer_categories'));
                }
            }
            echo json_encode($response);
            exit;
        }
        else
        {
            redirect(admin_url('transfer-categories'));
            exit;
        }
    }
}
?>