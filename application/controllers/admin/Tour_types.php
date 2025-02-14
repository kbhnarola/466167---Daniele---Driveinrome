<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_types extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
  		parent::__construct();
  		$this->load->model('Tour_type_model', 'tour_types');
       // $this->load->model('Tour_categories_model', 'tour_categories');
      $this->load->model('Tour_variation_model', 'tour_variation');
       $this->load->model('Tours_model', 'tours');
	}

	
	/**
	* @author bsm
	*
	* Loads the Tour type list page
	*
	*/
	public function index()
	{
		$this->set_page_title(_l('tour_types'));
        
		$data['content'] = $this->load->view('admin/tour_types/index', '', TRUE);
		$this->load->view('admin/layouts/index', $data);

	}

	/**
    * @author Bhavesh(bsm)
    *
    * get list of Tour types this will use by jquery datatable
    *
    */
    public function getLists()
    {
        $data = $row = array();

        // Fetch Tour type's list
        $memData = $this->tour_types->getRows($_POST);
        
        $i = $_POST['start'];
        $j=0;
        foreach($memData as $types){
            
            $data[$j]['RecordID']=$i+1;
            $data[$j]['tour_type'] = $types->title;
            $data[$j]['status'] = $types->status;
            $data[$j]['id'] = $types->id;
            $data[$j]['action']=base64_encode($types->id);
            $j++;
            $i++;
        
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tour_types->countFiltered($_POST),
            "recordsFiltered" => $this->tour_types->countFiltered($_POST),
            "data" => $data,
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
     * @param str    $tour_type      tour_type
     *
     */
	public function add()
    {
        if ($this->input->post())
        {
            $tour_type=ucwords(trim($this->input->post("tour_type")));
            $this->form_validation->set_rules('tour_type', 'Product Type', 'trim|required|callback_check_istypeExists[' . $tour_type . ']');
            
            if($this->form_validation->run() == FALSE){
                 $errors = $this->form_validation->error_array();
                 $response['success']=false;
                 //$response['error_msg']=_l('something_wrong');
                 $response['error_msg']=current($errors);

            } else {

                $data=array("title"=>$tour_type,"status"=>1);

                $insert=$this->tour_types->insert($data);

                if($insert){
                    $private=array('1-2','3-4','5-6','7-8','Enfants');
                    $private_rome=array('1-3','4-5','6-8','Enfants');
                    $small_group=array('Adults','Senior +65','Child-14','Enfants');
                    $package=array(1,2,3,4,5,6,7,8);

                    if(trim(strtolower($tour_type))=="private"){
                        foreach(array_reverse($private) as $v) {
                          $data=array("title"=>$v,"tour_type_id"=>$insert,"status"=>1);
                          $this->tour_variation->insert($data);
                        }
                    } elseif(trim(strtolower($tour_type))=="private rome") {
                        foreach(array_reverse($private_rome) as $v) {
                          $data=array("title"=>$v,"tour_type_id"=>$insert,"status"=>1);
                          $this->tour_variation->insert($data);
                        }
                    } elseif(trim(strtolower($tour_type))=="small group") {
                        foreach(array_reverse($small_group) as $v) {
                          $data=array("title"=>$v,"tour_type_id"=>$insert,"status"=>1);
                          $this->tour_variation->insert($data);
                        }
                    } elseif(trim(strtolower($tour_type))=="package") {
                        foreach(array_reverse($package) as $v) {
                          $data=array("title"=>$v,"tour_type_id"=>$insert,"status"=>1);
                          $this->tour_variation->insert($data);
                        }
                    } else {}
                    
                    $response['success']=true;
                    $response['msg']=_l('_added_successfully', _l('tour_types'));
                } else {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_added', _l('tour_types'));
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
     * Check Tour type already exist or not in Add & Edit Tour Type form Jquery-ajax Remote validation
     *
     * @param str    $tour_type      tour_type
     * @param int    $record_id  id
     *
     */
	public function istypeExists()
    {
        $tour_type = ucwords(trim($this->input->post('tour_type')));
        $record_id = base64_decode($this->input->post('record_id'));

        $where=array("title"=>$tour_type);
        $check_exist=$this->tour_types->get_by($where);
        
        if($record_id) {            

            $where=array("id"=>$record_id);
            $check_exist_byid=$this->tour_types->get_by($where);

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
     * Check Tour type already exist or not in Add Tour Type form Server side validation
     *
     * @param str    $tour_type      tour_type
     *
     */
    public function check_istypeExists($tour_type)
    {
        $tour_type = ucwords(trim($this->input->post('tour_type')));

        $where=array("title"=>$tour_type);
        $check_exist=$this->tour_types->get_by($where);

        if(is_array($check_exist) && sizeof($check_exist) > 0) {          
            $this->form_validation->set_message("check_istypeExists",'Product Type already exist');
            return false;       
        } else {
            return true;
        }
    }

    /**
     * @author bsm
     *
     * Check Tour type already exist or not in edit Tour Type form Server side validation
     *
     * @param str    $tour_type      tour_type
     * @param int    $record_id  id
     *
     */
    public function check_istypeExists_edit($tour_type)
    {
        $where=array("title"=>$tour_type);        
        $check_exist=$this->tour_types->get_by($where);

        $record_id=base64_decode($this->input->post('tour_type_id'));
        $where=array("id"=>$record_id);
        $check_exist_byid=$this->tour_types->get_by($where);

        if(is_array($check_exist) && sizeof($check_exist) > 0) {
            if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){
                if($check_exist['title']==$check_exist_byid['title']){
                     return true;
                } else {
                    $this->form_validation->set_message("check_istypeExists_edit",'Product Type already exist');
                    return false;
                }
            } else {
                $this->form_validation->set_message("check_istypeExists_edit",'Product Type already exist');
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * @author bsm
     *
     * Update Status Tour types
     *
     * @param int    $tour_type_id      tour_type_id
     * @param int    $status      is_active
     *
     */
    public function update_status()
    {
        $tour_type_id = base64_decode($this->input->post('tour_type_id'));
        $data    = array('status' => $this->input->post('is_active'));
        $update = $this->tour_types->update_by(array("id"=>$tour_type_id), $data);

        if ($update) {
            if ($this->input->post('is_active') == 1)
            {
                $response['success']=true;
                $response['msg']='true';
                $response['alert_msg']=_l('_activated', _l('tour_types'));
            }
            else
            {
                $response['success']=true;
                $response['msg']='false';
                $response['alert_msg']=_l('_deactivated', _l('tour_types'));
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
     * @param int    $tour_type_id      tour_type_id
     *
     */
    // public function delete()
    // {
    //     $tour_type_id = base64_decode($this->input->post('tour_type_id'));

    //     $where=array('tour_type_id'=>$tour_type_id);
    //     $check_exist=$this->tours->get_by($where);

    //     $response=array();
    //     if(is_array($check_exist) && sizeof($check_exist)>0){

    //         $response['success']=false;
    //         $response['msg']="Tour type not deleted, It is used in Tours Product";

    //     } else {
    //         $deleted = $this->tour_types->delete_by(array("id"=>$tour_type_id));

    //         if ($deleted) {

    //            $where=array('tour_type_id'=>$tour_type_id);
    //            $this->tour_variation->delete_by($where);

    //            $response['success']=true;
    //            $response['msg']=_l('_deleted_successfully', _l('tour_types'));
                
    //         } else {
    //             $response['success']=false;
    //             $response['msg']=_l('something_wrong');
    //         }
    //     }
    //     echo json_encode($response);
    //     exit;
    // }

    /**
    * @author bsm
    *
    * return user data by it id
    *
    * @param int    $id    tour_type_id
    *
    */
    public function get_record_byID()
    {
        $record_id = base64_decode($this->input->post('tour_type_id'));
        $where=array("id"=>$record_id);
        $data=$this->tour_types->get_by($where);

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
     * edit Tour types
     *
     * @param str    $tour_type   tour_type
     * @param int    $id      tour_type_id
     *
     */
    public function edit()
    {
        if ($this->input->post())
        {
            $tour_type=ucwords(trim($this->input->post("tour_type")));
            $this->form_validation->set_rules('tour_type', 'Product Type', 'trim|required|callback_check_istypeExists_edit[' . $tour_type . ']');

            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                $response['success']=false;
                $response['msg']=current($errors);              
            }
            else
            {
                $id = base64_decode($this->input->post('tour_type_id'));               

                if ($id)
                {
                    $data=array("title"=>$tour_type);
                    $update = $this->tour_types->update_by(array("id"=>$id), $data);
                    
                    if ($update)
                    {

                        $response['success']=true;
                        $response['msg']=_l('_updated_successfully', _l('tour_types'));
                        
                    }
                    else
                    {
                        $response['success']=false;
                        $response['msg']=_l('something_wrong')._l('not_updated', _l('tour_types'));
                        
                    }
                }
                else
                {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_updated', _l('tour_types'));
                }
            }
            echo json_encode($response);
            exit;
        }
        else
        {
            redirect(admin_url('tour-types'));
            exit;
        }
    }
}
?>