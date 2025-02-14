<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_cities extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tour_cities_model', 'tour_cities');
	}

	
	/**
	* @author bsm
	*
	* Loads the admin dashboard
	*
	*/
	public function index()
	{
		$this->set_page_title(_l('tour_cities'));
        
        $cdata['tour_types'] = get_tour_types();
		$data['content'] = $this->load->view('admin/tour_cities/index', $cdata, TRUE);
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

        // Fetch Tour category's list
        $memData = $this->tour_cities->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($memData as $cities){
            
            $i++;
            if($cities->status == 1){
                $status='<div class="checkbox checkbox-switch">
                        <label>
                            <input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'.base64_encode($cities->id).'" checked="checked">                            
                        </label>
                    </div>';
                
            }else{
                $status='<div class="checkbox checkbox-switch">
                        <label>
                            <input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'.base64_encode($cities->id).'" >
                        </label>
                    </div>';
                
            }         
            
            $action='<a href="javascript:" data-popup="tooltip" data-placement="top"  title="'._l("edit").'" onclick="edit_record(this)" id="'.base64_encode($cities->id).'" class="text-info"><i class="icon-pencil7"></i></a>
                <a data-popup="tooltip" data-placement="top"  title="'._l('delete').'" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="'.base64_encode($cities->id).'"><i class=" icon-trash"></i></a>
             ';
            $data[] = array($i, $cities->title,$cities->tour_type_name,$status,$action);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tour_cities->countFiltered($_POST),
            "recordsFiltered" => $this->tour_cities->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
        exit;
    }

    /**
     * @author bsm
     *
     * Check Tour Cities already exist or not in Add & Edit Tour City form Jquery-ajax Remote validation
     *
     * @param str    $tour_city  tour_city
     * @param int    $record_id  id
     *
     */
    public function iscityExists()
    {
        $tour_city = ucwords(trim($this->input->post('tour_city')));
        $record_id = base64_decode($this->input->post('record_id'));

        $where=array("title"=>$tour_city);
        $check_exist=$this->tour_cities->get_by($where);
        
        if($record_id) {            

            $where=array("id"=>$record_id);
            $check_exist_byid=$this->tour_cities->get_by($where);

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
     * Add New Tour Type Form
     *
     * @param int    $tour_type_id   tour_type_id
     * @param str    $tour_city      tour_city
     *
     */
    public function add()
    {
        if ($this->input->post())
        {
            $tour_city=ucwords(trim($this->input->post("tour_city")));
            $this->form_validation->set_rules('tour_type', 'Tour type', 'required');
            $this->form_validation->set_rules('tour_city', 'Tour city', 'trim|required|callback_check_iscityExists[' . $tour_city . ']');
            //$this->form_validation->set_rules('tour_city', 'Tour city', 'trim|required');
            
            if($this->form_validation->run() == FALSE){
                 $errors = $this->form_validation->error_array();
                 $response['success']=false;
                 //$response['error_msg']=_l('something_wrong');
                 $response['error_msg']=current($errors);

            } else {

                $tour_type_id=$this->input->post("tour_type");
                $category_code=explode(" ",$tour_city);
                $code="";
                if(count($category_code)>1){
                    $c1=substr($category_code[0], 0, 1);
                    $c2=substr($category_code[1], 0, 1);
                    $code=strtoupper($c1.$c2);
                } else {
                    $c2=substr($category_code[0], 0, 2);
                    $code=strtoupper($c2);
                }
                
                $data=array("title"=>$tour_city,"tour_type_id"=>$tour_type_id,"category_code"=>$code,"status"=>1);

                $insert=$this->tour_cities->insert($data);
                
                if($insert){
                    $response['success']=true;
                    $response['msg']=_l('_added_successfully', _l('tour_city'));
                } else {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_added', _l('tour_city'));
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
     * Check Tour type already exist or not in Add Tour Type form Server side validation
     *
     * @param str    $tour_city      tour_city
     *
     */
    public function check_iscityExists($tour_city)
    {
        $tour_city = ucwords(trim($this->input->post('tour_city')));

        $where=array("title"=>$tour_city);
        $check_exist=$this->tour_cities->get_by($where);

        if(is_array($check_exist) && sizeof($check_exist) > 0) {          
            $this->form_validation->set_message("check_iscityExists",'Tour City already exist');
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
     * @param str    $tour_city      tour_city
     * @param int    $record_id  id
     *
     */
    public function check_iscityExists_edit($tour_city)
    {
        $where=array("title"=>ucwords(trim($tour_city)));        
        $check_exist=$this->tour_cities->get_by($where);

        $record_id=base64_decode($this->input->post('tour_city_id'));
        $where=array("id"=>$record_id);
        $check_exist_byid=$this->tour_cities->get_by($where);

        if(is_array($check_exist) && sizeof($check_exist) > 0) {
            if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){
                if($check_exist['title']==$check_exist_byid['title']){
                     return true;
                } else {
                    $this->form_validation->set_message("check_iscityExists_edit",'Tour city already exist');
                    return false;
                }
            } else {
                $this->form_validation->set_message("check_iscityExists_edit",'Tour city already exist');
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * @author bsm
     *
     * Update Status Tour Categories
     *
     * @param int    $tour_city_id      tour_city_id
     * @param int    $status      is_active
     *
     */
    public function update_status()
    {
        $tour_city_id = base64_decode($this->input->post('tour_city_id'));
        $data    = array('status' => $this->input->post('is_active'));
        $update = $this->tour_cities->update_by(array("id"=>$tour_city_id), $data);

        if ($update) {
            if ($this->input->post('is_active') == 1)
            {
                $response['success']=true;
                $response['msg']='true';
                $response['alert_msg']=_l('_activated', _l('tour_cities'));
            }
            else
            {
                $response['success']=true;
                $response['msg']='false';
                $response['alert_msg']=_l('_deactivated', _l('tour_cities'));
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
    public function delete()
    {
        $tour_city_id = base64_decode($this->input->post('tour_city_id'));
        $deleted = $this->tour_cities->delete_by(array("id"=>$tour_city_id));

        if ($deleted) {
            
           $response['success']=true;
           $response['msg']=_l('_deleted_successfully', _l('tour_city'));
            
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
    * @param int    $id    tour_city_id
    *
    */
    public function get_record_byID()
    {
        $record_id = base64_decode($this->input->post('tour_city_id'));
       
        $where=array("id"=>$record_id);
        $data=$this->tour_cities->get_by($where);

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
     * @param str    $tour_type   tour_type_id
     * @param str    $tour_city   tour_city
     * @param int    $id      tour_city_id
     *
     */
    public function edit()
    {
        if ($this->input->post())
        {
            $tour_city=ucwords(trim($this->input->post("tour_city")));
            $this->form_validation->set_rules('tour_type', 'Tour type', 'required');
            //$this->form_validation->set_rules('tour_city', 'Tour city', 'trim|required');
            $this->form_validation->set_rules('tour_city', 'Tour city', 'trim|required|callback_check_iscityExists_edit[' . $tour_city . ']');

            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                $response['success']=false;
                $response['msg']=current($errors);              
            }
            else
            {
                $id = base64_decode($this->input->post('tour_city_id'));               

                if ($id)
                {
                    $tour_type_id=$this->input->post("tour_type");
                    $category_code=explode(" ",$tour_city);

                    $code="";
                    if(count($category_code)>1){
                        $c1=substr($category_code[0], 0, 1);
                        $c2=substr($category_code[1], 0, 1);
                        $code=strtoupper($c1.$c2);
                    } else {
                        $c2=substr($category_code[0], 0, 2);
                        $code=strtoupper($c2);
                    }

                    $data=array("title"=>$tour_city,"tour_type_id"=>$tour_type_id,"category_code"=>$code,"status"=>1);
                    $update = $this->tour_cities->update_by(array("id"=>$id), $data);
                    
                    if ($update)
                    {
                        $response['success']=true;
                        $response['msg']=_l('_updated_successfully', _l('tour_cities'));
                        
                    }
                    else
                    {
                        $response['success']=false;
                        $response['msg']=_l('something_wrong')._l('not_updated', _l('tour_cities'));
                        
                    }
                }
                else
                {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_updated', _l('tour_cities'));
                }
            }
            echo json_encode($response);
            exit;
        }
        else
        {
            redirect(admin_url('tour_cities'));
            exit;
        }
    }
}
?>