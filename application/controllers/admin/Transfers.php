<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfers extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transfers_model', 'transfers');
        $this->load->model('Transfer_type_model', 'transfer_types');
        $this->load->model('Transfer_categories_model', 'transfer_categories');
        $this->load->model('Transfer_variation_model', 'transfer_variation');
        $this->load->model('Transfer_price_plan_model', 'transfer_price');

	}

	
	/**
	* @author bsm
	*
	* Loads the admin dashboard
	*
	*/
	public function index()
	{
		$this->set_page_title(_l('manage_transfer'));
        
		$data['content'] = $this->load->view('admin/transfers/index', '', TRUE);
        $this->load->view('admin/layouts/index', $data);
    }

	/**
    * @author Bhavesh(bsm)
    *
    * get list of transfers this will use by jquery datatable
    *
    */
    public function getLists()
    {
        $data = $row = array();

        // Fetch transfers's list
        $memData = $this->transfers->getRows($_POST);
        // echo $this->db->last_query();
        // exit;
        $i = $_POST['start'];
        $j=0;
        foreach($memData as $transfers){
            
            $data[$j]['RecordID']=$i+1;
            $data[$j]['transfer_type'] = $transfers->transfer_type;
            $data[$j]['transfer_category'] = $transfers->transfer_category;
            $data[$j]['transfer_name'] = $transfers->title;
            $data[$j]['unique_code'] = $transfers->unique_code;
            $data[$j]['duration'] = $transfers->duration;
            if($transfers->ratings==0){
                $data[$j]['ratings'] = "N/A";
            } else {
                $data[$j]['ratings'] = $transfers->ratings;
            }            
            $data[$j]['status'] = $transfers->status;
            $data[$j]['id'] = $transfers->id;
            $data[$j]['action']=base64_encode($transfers->id);
            $j++;
            $i++;
            
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->transfers->countFiltered($_POST),
            "recordsFiltered" => $this->transfers->countFiltered($_POST),
            "aaData" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
        exit;
    }

	/**
     * @author bsm
     *
     * Add New transfer Type Form
     *
     * @param str    $title      title
     *
     */
	public function add()
	{
		if ($this->input->post())
		{
            
            $transfer_name=ucwords(trim($this->input->post("transfer_name")));
            $this->form_validation->set_rules('transfer_type', 'transfer Type', 'trim|required');
            $this->form_validation->set_rules('transfer_category', 'transfer Category', 'trim|required');
            $this->form_validation->set_rules('transfer_name', 'transfer Name', 'trim|required');
            $this->form_validation->set_rules('transfer_unique_code', 'Unique code', 'trim|required');
            $this->form_validation->set_rules('duration', 'Duration', 'trim|required');
            //$this->form_validation->set_rules('transfer_description', 'transfer Description', 'trim|required');

            if($this->form_validation->run() == FALSE) {
                
                set_alert('error', _l('something_wrong'));
               
                //set_alert('error', current(validation_errors()));
                redirect(admin_url('transfers'));
            } else {
               
                $transfer_type=trim($this->input->post("transfer_type"));
                $transfer_category=trim($this->input->post("transfer_category"));
                $unique_code=trim($this->input->post("transfer_unique_code"));
                $transfer_description=$this->input->post("description");
                $duration=trim($this->input->post("duration"));
                
                $ratings=trim($this->input->post("rating"));
                
                $meta_title=$this->input->post("meta_title");
                $meta_keywords=$this->input->post("meta_keywords");
                $meta_description=$this->input->post("meta_description");

                $image_name="";

                if(is_array($_FILES) && sizeof($_FILES)>0){
                    if(array_key_exists('feature_image', $_FILES) && $_FILES['feature_image']['tmp_name']!='') {
                        
                        $config['upload_path'] = './uploads/';
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
                                     redirect('admin/transfers');
                                     exit;
                        } 
                    }                     
                }

    	        $data=array(
                    "title"=>$transfer_name,
                    "description"=>$transfer_description,
                    "transfer_type_id"=>$transfer_type,
                    "transfer_category_id"=>$transfer_category,
                    "unique_code"=>$unique_code,
                    "duration"=>$duration,                   
                    "ratings"=>$ratings,
                    "feature_image"=>$image_name,
                    "status"=>1,
                    "meta_title"=>$meta_title,
                    "meta_keyword"=>$meta_keywords,
                    "meta_description"=>$meta_description
                    );
                $insert=$this->transfers->insert($data);

                if($insert){

                    $where=array("transfer_type_id"=>$transfer_type);
                    $transfer_variations=$this->transfer_variation->get_many_by($where);

                    if(is_array($transfer_variations) && sizeof($transfer_variations)>0) {

                        $variation_price=$this->input->post("basic_price[]");
                        
                        foreach($variation_price as $key=>$v){
                            $data=array(
                                "transfer_id"=>$insert,
                                "transfer_variation_id"=>$transfer_variations[$key]['id'],
                                "price"=>$v,
                                "price_type"=>1
                            );
                            $insert_variation_price=$this->transfer_price->insert($data);
                        }                        
                    }

                    set_alert('success', _l('_added_successfully', _l('transfer_services')));
                    
                    redirect('admin/transfers');
                } else {
                	set_alert('error', _l('something_wrong'));
                    
                    redirect('admin/transfers');
                }	   
            }     
		}
		else
		{
            $this->set_page_title(_l('transfer_services').' | '._l('add'));

            $cdata['transfer_types'] = get_transfer_types();
            $cdata['transfer_categories'] = get_transfer_categories();
            
			$data['content'] = $this->load->view('admin/transfers/add', $cdata, TRUE);
            $this->load->view('admin/layouts/index', $data);
		}
	}

    /**
     * @author bsm
     *
     * Get transfer Category based on transfer_type_id
     *
     * @param int    $transfer_type_id      transfer_type_id
     *
     */

    public function getTransferVariantion(){

        $transfer_type_id = $this->input->post('transfer_type_id');

        $where=array("transfer_type_id"=>$transfer_type_id);
        $transfer_variention=$this->transfer_variation->get_many_by($where);
            
        if(is_array($transfer_variention) && sizeof($transfer_variention)>0) {
            $response['success']=true;
            $response['variation_list']=$transfer_variention;        
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
     * Check transfer Title already exist or not in Add & Edit transfer Title form Jquery-ajax Remote validation
     *
     * @param str    $transfer_name  transfer_name
     * @param int    $record_id  id
     *
     */
    public function isTransferServiceExists()
    {
        $transfer_name = ucwords(trim($this->input->post('transfer_name')));
        $record_id = base64_decode($this->input->post('record_id'));

        $where=array("title"=>$transfer_name);
        $check_exist=$this->transfers->get_by($where);
        
        if($record_id) {            

            $where=array("id"=>$record_id);
            $check_exist_byid=$this->transfers->get_by($where);

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
     * Check transfer Title already exist or not in Add & Edit transfer Title form Jquery-ajax Remote validation
     *
     * @param str    $transfer_unique_code  transfer_unique_code
     * @param int    $record_id  id
     *
     */
    public function isTransferCodeExists()
    {
        $transfer_unique_code = trim($this->input->post('transfer_unique_code'));
        $record_id = base64_decode($this->input->post('record_id'));

        $where=array("unique_code"=>$transfer_unique_code);
        $check_exist=$this->transfers->get_by($where);
        
        if($record_id) {            

            $where=array("id"=>$record_id);
            $check_exist_byid=$this->transfers->get_by($where);

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
     * Update Status transfer types
     *
     * @param int    $transfer_id      transfer_id
     * @param int    $status      is_active
     *
     */
    public function update_status()
    {
        $transfer_id = base64_decode($this->input->post('transfer_id'));
        $data    = array('status' => $this->input->post('is_active'));
        $update = $this->transfers->update_by(array("id"=>$transfer_id), $data);

        if ($update) {
            if ($this->input->post('is_active') == 1)
            {
                $response['success']=true;
                $response['msg']='true';
                $response['alert_msg']=_l('_activated', _l('transfer_services'));
            }
            else
            {
                $response['success']=true;
                $response['msg']='false';
                $response['alert_msg']=_l('_deactivated', _l('transfer_services'));
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
     * @param int    $transfer_id      transfer_id
     *
     */
    public function delete()
    {
        $transfer_id = base64_decode($this->input->post('transfer_id'));
        
        $deleted = $this->transfers->delete_by(array("id"=>$transfer_id));

        $response=array();
        if ($deleted) {
            
           $delet_variation_price=$this->transfer_price->delete_by(array("transfer_id"=>$transfer_id));
           $response['success']=true;
           $response['msg']=_l('_deleted_successfully', _l('transfer_services'));
            
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
     * @param int  $id  transfer id
     */
    public function edit($id = '')
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $this->set_page_title(_l('transfers').' | '._l('edit'));
        if ($id)
        {
            if ($this->input->post()) {
                 
                $transfer_name=ucwords(trim($this->input->post("transfer_name")));
                $this->form_validation->set_rules('transfer_type', 'transfer Type', 'trim|required');
                $this->form_validation->set_rules('transfer_category', 'transfer Category', 'trim|required');
                $this->form_validation->set_rules('transfer_name', 'transfer Name', 'trim|required');
                $this->form_validation->set_rules('transfer_unique_code', 'Unique code', 'trim|required');
                $this->form_validation->set_rules('duration', 'Duration', 'trim|required');
                //$this->form_validation->set_rules('transfer_description', 'transfer Description', 'trim|required');
                
                if($this->form_validation->run() == FALSE) {
                    set_alert('error', _l('something_wrong'));

                    redirect(admin_url('transfers'));
                } else {
                    
                    $transfer_type=trim($this->input->post("transfer_type"));
                    $transfer_category=trim($this->input->post("transfer_category"));
                    $unique_code=trim($this->input->post("transfer_unique_code"));
                    $transfer_description=$this->input->post("description");
                    
                    $duration=trim($this->input->post("duration"));
                    $ratings=trim($this->input->post("rating"));
                    
                    $meta_title=$this->input->post("meta_title");
                    $meta_keywords=$this->input->post("meta_keywords");
                    $meta_description=$this->input->post("meta_description");
                    $transfer_id=base64_decode($this->input->post('transfer_id'));

                    $image_name="";

                    if(is_array($_FILES) && sizeof($_FILES)>0){
                        if(array_key_exists('feature_image', $_FILES) && $_FILES['feature_image']['tmp_name']!='') {
                            
                            $config['upload_path'] = './uploads/';
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
                                         redirect('admin/transfers');
                                         exit;
                            } 
                        }                     
                    }

                    $data=array(
                        "title"=>$transfer_name,
                        "description"=>$transfer_description,
                        "transfer_type_id"=>$transfer_type,
                        "transfer_category_id"=>$transfer_category,
                        "unique_code"=>$unique_code,
                        "duration"=>$duration, 
                        "ratings"=>$ratings,
                        "status"=>1,
                        "meta_title"=>$meta_title,
                        "meta_keyword"=>$meta_keywords,
                        "meta_description"=>$meta_description
                        );
                    if($image_name){
                        $data["feature_image"]=$image_name;   
                    }
                    $update=$this->transfers->update_by(array("id"=>$transfer_id),$data);

                    if($update){

                        $where=array("transfer_type_id"=>$transfer_type);
                        
                        $transfer_variations=$this->transfer_variation->get_many_by($where);

                        if(is_array($transfer_variations) && sizeof($transfer_variations)>0) {

                            if(base64_decode($this->input->post('ctransfer_type_id'))!=$transfer_type) {
                                
                                $deleted = $this->transfer_price->delete_by(array("transfer_id"=>$transfer_id));
                                $variation_price=$this->input->post("basic_price[]");
                            
                                foreach($variation_price as $key=>$v){
                                    $data=array(
                                        "transfer_id"=>$transfer_id,
                                        "transfer_variation_id"=>$transfer_variations[$key]['id'],
                                        "price"=>$v,
                                        "price_type"=>1
                                    );
                                    $insert_variation_price=$this->transfer_price->insert($data);
                                }
                            } else {
                                
                                //$deleted = $this->transfer_price->delete_by(array("transfer_id"=>$transfer_id,"price_type"=>1));
                                $variation_price=$this->input->post("basic_price[]");
                                //$where1=array("transfer_id"=>$transfer_id,"price_type"=>1);
                                //$transfer_price_get=$this->transfer_price->get_rows($where1);
                                $transfer_price_get=$this->transfer_price->get_rows($transfer_id,'',1);
                                // echo "<pre>";
                                // print_r($transfer_price_get);
                                // exit;
                                if(is_array($transfer_price_get) && sizeof($transfer_price_get)>0){
                                    foreach($transfer_price_get as $key=>$v){
                                        $data=array(
                                            "price"=>$variation_price[$key],                                    
                                        );
                                        $insert_variation_price=$this->transfer_price->update_by(array('id'=>$v['id']),$data);
                                    }
                                }
                            }
                            
                        }

                        set_alert('success', _l('_updated_successfully', _l('transfer_services')));
                        
                        redirect('admin/transfers');
                    } else {
                        set_alert('error', _l('something_wrong'));
                        
                        redirect('admin/transfers');
                    }      
                }

            } else {

                $where=array("id"=>base64_decode($id));
                $transferData = $this->transfers->get_by($where);
                
                if(is_array($transferData) && sizeof($transferData)>0) {
                    $transferData['variation_price'] = $this->transfers->getTransfersPriceDetails(base64_decode($id));
                    $cdata['transferData']=$transferData;
                    $cdata['transfer_types'] = get_transfer_types();
                    $cdata['transfer_categories'] = get_transfer_categories();
                    
                    $data['content'] = $this->load->view('admin/transfers/edit', $cdata, TRUE);
                    $this->load->view('admin/layouts/index', $data);
                } else {
                    set_alert('error', 'Records not found');
                    redirect(admin_url("transfers"));
                    exit;
                }                
            }
        } else {
            redirect(admin_url("transfers"));
            exit;
        }
    }
}
?>