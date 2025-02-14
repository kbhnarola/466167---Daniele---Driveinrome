<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_types extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
  		parent::__construct();
  		$this->load->model('Transfer_type_model', 'transfer_types');
      $this->load->model('Transfer_variation_model', 'transfer_variation');
      $this->load->model('Transfers_model', 'transfers');
	}

	
	/**
	* @author bsm
	*
	* Loads the Transfer type list page
	*
	*/
	public function index()
	{
		$this->set_page_title(_l('transfer_types'));
        
		$data['content'] = $this->load->view('admin/transfer_types/index', '', TRUE);
		$this->load->view('admin/layouts/index', $data);

	}

	/**
    * @author Bhavesh(bsm)
    *
    * get list of Transfer types this will use by jquery datatable
    *
    */
    public function getLists()
    {
        $data = $row = array();

        // Fetch Transfer type's list
        $memData = $this->transfer_types->getRows($_POST);
        
        $i = $_POST['start'];
        $j=0;
        foreach($memData as $types){
            
            $data[$j]['RecordID']=$i+1;
            $data[$j]['transfer_type'] = $types->title;
            $data[$j]['status'] = $types->status;
            $data[$j]['id'] = $types->id;
            $data[$j]['action']=base64_encode($types->id);
            $j++;
            $i++;
        
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->transfer_types->countFiltered($_POST),
            "recordsFiltered" => $this->transfer_types->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
        exit;
    }

    /**
     * @author bsm
     *
     * Add New Transfer Type Form
     *
     * @param str    $transfer_type      transfer_type
     *
     */
	  public function add()
    {
        if ($this->input->post())
        {
            $transfer_type=ucwords(trim($this->input->post("transfer_type")));
            $this->form_validation->set_rules('transfer_type', 'Transfer Type', 'trim|required|callback_check_istypeExists[' . $transfer_type . ']');
            
            if($this->form_validation->run() == FALSE){
                 $errors = $this->form_validation->error_array();
                 $response['success']=false;
                 //$response['error_msg']=_l('something_wrong');
                 $response['error_msg']=current($errors);

            } else {

                $data=array("title"=>$transfer_type,"status"=>1);

                $insert=$this->transfer_types->insert($data);

                if($insert){
                    $private=array('1-3','4-5','6-8');

                    if(trim(strtolower($transfer_type))=="private Transfer" || trim(strtolower($transfer_type))=="private"){
                        foreach($private as $v) {
                          $data=array("title"=>$v,"transfer_type_id"=>$insert);
                          $this->transfer_variation->insert($data);
                        }
                    } else {}
                    
                    $response['success']=true;
                    $response['msg']=_l('_added_successfully', _l('transfer_types'));
                } else {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_added', _l('transfer_types'));
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
     * Check transfer type already exist or not in Add & Edit transfer Type form Jquery-ajax Remote validation
     *
     * @param str    $transfer_type      transfer_type
     * @param int    $record_id  id
     *
     */
	  public function istypeExists()
    {
        $transfer_type = ucwords(trim($this->input->post('transfer_type')));
        $record_id = base64_decode($this->input->post('record_id'));

        $where=array("title"=>$transfer_type);
        $check_exist=$this->transfer_types->get_by($where);
        
        if($record_id) {            

            $where=array("id"=>$record_id);
            $check_exist_byid=$this->transfer_types->get_by($where);

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
     * Check transfer type already exist or not in Add transfer Type form Server side validation
     *
     * @param str    $transfer_type      transfer_type
     *
     */
    public function check_istypeExists($transfer_type)
    {
        $transfer_type = ucwords(trim($this->input->post('transfer_type')));

        $where=array("title"=>$transfer_type);
        $check_exist=$this->transfer_types->get_by($where);

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
     * Check transfer type already exist or not in edit transfer Type form Server side validation
     *
     * @param str    $transfer_type      transfer_type
     * @param int    $record_id  id
     *
     */
    public function check_istypeExists_edit($transfer_type)
    {
        $where=array("title"=>$transfer_type);        
        $check_exist=$this->transfer_types->get_by($where);

        $record_id=base64_decode($this->input->post('transfer_type_id'));
        $where=array("id"=>$record_id);
        $check_exist_byid=$this->transfer_types->get_by($where);

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
     * Update Status transfer types
     *
     * @param int    $transfer_type_id      transfer_type_id
     * @param int    $status      is_active
     *
     */
    public function update_status()
    {
        $transfer_type_id = base64_decode($this->input->post('transfer_type_id'));
        $data    = array('status' => $this->input->post('is_active'));
        $update = $this->transfer_types->update_by(array("id"=>$transfer_type_id), $data);

        if ($update) {
            if ($this->input->post('is_active') == 1)
            {
                $response['success']=true;
                $response['msg']='true';
                $response['alert_msg']=_l('_activated', _l('transfer_types'));
            }
            else
            {
                $response['success']=true;
                $response['msg']='false';
                $response['alert_msg']=_l('_deactivated', _l('transfer_types'));
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
     * @param int    $transfer_type_id      transfer_type_id
     *
     */
    // public function delete()
    // {
    //     $transfer_type_id = base64_decode($this->input->post('transfer_type_id'));

    //     $where=array('transfer_type_id'=>$transfer_type_id);
    //     $check_exist=$this->transfers->get_by($where);

    //     $response=array();
    //     if(is_array($check_exist) && sizeof($check_exist)>0){

    //         $response['success']=false;
    //         $response['msg']="transfer type not deleted, It is used in transfers Product";

    //     } else {
    //         $deleted = $this->transfer_types->delete_by(array("id"=>$transfer_type_id));

    //         if ($deleted) {

    //            $where=array('transfer_type_id'=>$transfer_type_id);
    //            $this->transfer_variation->delete_by($where);

    //            $response['success']=true;
    //            $response['msg']=_l('_deleted_successfully', _l('transfer_types'));
                
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
    * @param int    $id    transfer_type_id
    *
    */
    public function get_record_byID()
    {
        $record_id = base64_decode($this->input->post('transfer_type_id'));
        $where=array("id"=>$record_id);
        $data=$this->transfer_types->get_by($where);

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
     * edit Transfer types
     *
     * @param str    $Transfer_type   Transfer_type
     * @param int    $id      Transfer_type_id
     *
     */
    public function edit()
    {
        if ($this->input->post())
        {
            $transfer_type=ucwords(trim($this->input->post("transfer_type")));
            $this->form_validation->set_rules('transfer_type', 'Product Type', 'trim|required|callback_check_istypeExists_edit[' . $transfer_type . ']');

            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                $response['success']=false;
                $response['msg']=current($errors);              
            }
            else
            {
                $id = base64_decode($this->input->post('transfer_type_id'));               

                if ($id)
                {
                    $data=array("title"=>$transfer_type);
                    $update = $this->transfer_types->update_by(array("id"=>$id), $data);
                    
                    if ($update)
                    {

                        $response['success']=true;
                        $response['msg']=_l('_updated_successfully', _l('transfer_types'));
                        
                    }
                    else
                    {
                        $response['success']=false;
                        $response['msg']=_l('something_wrong')._l('not_updated', _l('transfer_types'));
                        
                    }
                }
                else
                {
                    $response['success']=false;
                    $response['msg']=_l('something_wrong')._l('not_updated', _l('transfer_types'));
                }
            }
            echo json_encode($response);
            exit;
        }
        else
        {
            redirect(admin_url('transfer-types'));
            exit;
        }
    }
}
?>