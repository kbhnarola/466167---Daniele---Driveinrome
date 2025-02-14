<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_extra_services extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		  parent::__construct();
      $this->load->model('Extra_services_model', 'extra_services');
      $this->load->model('Tour_extra_services_model', 'tour_extra_services');
		  //$this->load->model('Tours_model', 'tours');
       // $this->load->model('Tour_categories_model', 'tour_categories');
	}

	
	/**
	* @author bsm
	*
	* Loads the Tour Extra Services list page
	*
	*/
	public function index()
	{
		$this->set_page_title(_l('extra_services'));
        
		$data['content'] = $this->load->view('admin/tours_extra_services/index', '', TRUE);
		$this->load->view('admin/layouts/index', $data);

	}

	/**
    * @author Bhavesh(bsm)
    *
    * get list of Tour Extra Services this will use by jquery datatable
    *
    */
    public function getLists()
    {
        $data = $row = array();

        // Fetch Tour Extra Services's list
        $memData = $this->extra_services->getRows($_POST);
        
        $i = $_POST['start'];
        $j=0;
        foreach($memData as $extra_services){
            
            $data[$j]['RecordID']=$i+1;
            // if($extra_services->description){
            //   $data[$j]['title'] = $extra_services->title.'   <a href="javascript:" data-popup="tooltip" data-placement="top"  title="'.$extra_services->description.'" class="text-success"><i class="fa fa-info-circle" aria-hidden="true"></i></a>';
            // } else {
              $data[$j]['title'] = $extra_services->title;
            //}
            $data[$j]['price'] = $extra_services->price;
            $data[$j]['description'] = $extra_services->description;
            $data[$j]['status'] = $extra_services->status;
            $data[$j]['id'] = $extra_services->id;
            $data[$j]['action']=base64_encode($extra_services->id);
            $j++;
            $i++;
        
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->extra_services->countFiltered($_POST),
            "recordsFiltered" => $this->extra_services->countFiltered($_POST),
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
     * @param str    $extra_service_title      Extra Service Title
     * @param int    $price      Price
     *
     */
	  public function add()
    {
        if ($this->input->post())
        {
            $extra_service_title=ucwords(trim($this->input->post("extra_service_title")));
            $this->form_validation->set_rules('extra_service_title', 'Title', 'trim|required');
            //$this->form_validation->set_rules('price', 'Price', 'trim|required');
            $this->form_validation->set_rules('rate_opt', 'Rate Option', 'required');
            
            if($this->form_validation->run() == FALSE){
                 $errors = $this->form_validation->error_array();
                 $response['success']=false;
                 //$response['error_msg']=_l('something_wrong');
                 $response['error_msg']=current($errors);

            } else {

                $price=trim($this->input->post("price"));
                $rate_opt=trim($this->input->post("rate_opt"));
                
                $description=trim($this->input->post("description"));
                if(array_key_exists("per_person", $this->input->post())){
                    $price_per_person=$this->input->post("per_person[]");
                    $price_per_person=json_encode($price_per_person,JSON_FORCE_OBJECT);
                } else {
                    $price_per_person="";
                }
                $data=array("title"=>$extra_service_title,"price"=>$price,"rate_opt"=>$rate_opt,"person_custom_rate"=>$price_per_person,"description"=>$description,"status"=>1);

                $insert=$this->extra_services->insert($data);

                if($insert){
                    $response['success']=true;
                    $response['msg']=_l('_added_successfully', _l('extra_services'));
                } else {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_added', _l('extra_services'));
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
     * @param str    $tour_extra_services      tour_extra_services
     * @param int    $record_id  id
     *
     */
	public function istypeExists()
    {
        $extra_service_title = ucwords(trim($this->input->post('extra_service_title')));
        $record_id = base64_decode($this->input->post('record_id'));

        $where=array("title"=>$extra_service_title);
        $check_exist=$this->extra_services->get_by($where);
        
        if($record_id) {            

            $where=array("id"=>$record_id);
            $check_exist_byid=$this->extra_services->get_by($where);

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
     * @param str    $extra_service_title      extra_service_title
     *
     */
    public function check_istypeExists($extra_service_title)
    {
        $extra_service_title = ucwords(trim($this->input->post('extra_service_title')));

        $where=array("title"=>$extra_service_title);
        $check_exist=$this->extra_services->get_by($where);

        if(is_array($check_exist) && sizeof($check_exist) > 0) {          
            $this->form_validation->set_message("check_istypeExists",'Tour Upgrades already exist');
            return false;       
        } else {
            return true;
        }
    }

    /**
     * @author bsm
     *
     * Check Tour Extra Service already exist or not in edit Tour Type form Server side validation
     *
     * @param str    $extra_service_title      extra_service_title
     * @param int    $record_id  id
     *
     */
    public function check_istypeExists_edit($extra_service_title)
    {
        $where=array("title"=>$extra_service_title);        
        $check_exist=$this->extra_services->get_by($where);

        $record_id=base64_decode($this->input->post('extra_service_id'));
        $where=array("id"=>$record_id);
        $check_exist_byid=$this->extra_services->get_by($where);

        if(is_array($check_exist) && sizeof($check_exist) > 0) {
            if(is_array($check_exist_byid) && sizeof($check_exist_byid) > 0){
                if($check_exist['title']==$check_exist_byid['title']){
                     return true;
                } else {
                    $this->form_validation->set_message("check_istypeExists_edit",'Tour Upgrades already exist');
                    return false;
                }
            } else {
                $this->form_validation->set_message("check_istypeExists_edit",'Tour Upgrades already exist');
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * @author bsm
     *
     * Update Status Tour Extra Services
     *
     * @param int    $extra_service_id      extra_service_id
     * @param int    $status      is_active
     *
     */
    public function update_status()
    {
        $extra_service_id = base64_decode($this->input->post('extra_service_id'));
        $data    = array('status' => $this->input->post('is_active'));
        $update = $this->extra_services->update_by(array("id"=>$extra_service_id), $data);

        if ($update) {
            if ($this->input->post('is_active') == 1)
            {
                $response['success']=true;
                $response['msg']='true';
                $response['alert_msg']=_l('_activated', _l('extra_services'));
            }
            else
            {
                $response['success']=true;
                $response['msg']='false';
                $response['alert_msg']=_l('_deactivated', _l('extra_services'));
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
     * @param int    $extra_service_id      extra_service_id
     *
     */
    public function delete()
    {
        $extra_service_id = base64_decode($this->input->post('extra_service_id'));

        $where=array('extra_service_id'=>$extra_service_id);
        $check_exist=$this->tour_extra_services->get_by($where);

        $response=array();
        if(is_array($check_exist) && sizeof($check_exist)>0){

            $response['success']=false;
            $response['msg']="Tour Upgrades not deleted, It is used in Tours Product";

        } else {
            $deleted = $this->extra_services->delete_by(array("id"=>$extra_service_id));

            if ($deleted) {
                
               $response['success']=true;
               $response['msg']=_l('_deleted_successfully', _l('extra_services'));
                
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
    * return Extra Services data by it id
    *
    * @param int    $record_id    extra_service_id
    *
    */
    public function get_record_byID()
    {
        $record_id = base64_decode($this->input->post('extra_service_id'));
        $where=array("id"=>$record_id);
        $data=$this->extra_services->get_by($where);

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
     * @param str    $extra_services_title   extra_services_title
     * @param int    $id      extra_service_id
     *
     */
    public function edit()
    {
        if ($this->input->post())
        {
            $extra_service_title=ucwords(trim($this->input->post("extra_service_title")));
            //$this->form_validation->set_rules('extra_service_title', 'Title', 'trim|required');
            
            $this->form_validation->set_rules('extra_service_title', 'Title', 'trim|required|callback_check_istypeExists_edit[' . $extra_service_title . ']');
            //$this->form_validation->set_rules('price', 'Price', 'trim|required');
            $this->form_validation->set_rules('rate_opt', 'Rate Option', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                $response['success']=false;
                $response['msg']=current($errors);              
            }
            else
            {
                $id = base64_decode($this->input->post('extra_service_id'));               

                if ($id)
                {
                    $price=trim($this->input->post("price"));
                    $rate_opt=trim($this->input->post("rate_opt"));
                    $description=trim($this->input->post("description"));
                  
                    if(array_key_exists("per_person", $this->input->post())){
                      $price_per_person=$this->input->post("per_person[]");
                      $price_per_person=json_encode($price_per_person,JSON_FORCE_OBJECT);
                    } else {
                        $price_per_person="";
                    }
                    $data=array("title"=>$extra_service_title,"price"=>$price,"rate_opt"=>$rate_opt,"person_custom_rate"=>$price_per_person,"description"=>$description);
                //$data=array("title"=>$extra_service_title,"price"=>$price,"rate_opt"=>$rate_opt,"description"=>$description);
                    
                    $update = $this->extra_services->update_by(array("id"=>$id), $data);
                    
                    if ($update)
                    {
                        $response['success']=true;
                        $response['msg']=_l('_updated_successfully', _l('extra_services'));
                        
                    }
                    else
                    {
                        $response['success']=false;
                        $response['msg']=_l('something_wrong')._l('not_updated', _l('extra_services'));
                        
                    }
                }
                else
                {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_updated', _l('extra_services'));
                }
            }
            echo json_encode($response);
            exit;
        }
        else
        {
            redirect('tour-extra-services');
            exit;
        }
    }
}
?>