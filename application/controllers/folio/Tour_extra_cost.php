<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tour_extra_cost extends Admin_Controller
{
    /**
     * Constructor for the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tour_extra_cost_model', 'extra_cost');
        //$this->load->model('Tours_model', 'tours');
        // $this->load->model('Tour_categories_model', 'tour_categories');
    }


    /**
     * @author bsm
     *
     * Loads the Tour Extra Cost list page
     *
     */
    public function index()
    {
        $this->set_page_title(_l('extra_cost'));

        $data['content'] = $this->load->view('admin/tours_extra_cost/index', '', TRUE);
        $this->load->view('admin/layouts/index', $data);
    }

    /**
     * @author Bhavesh(bsm)
     *
     * get list of Tour Extra Cost this will use by jquery datatable
     *
     */
    public function getLists()
    {
        $data = $row = array();

        // Fetch Tour Extra Cost's list
        $memData = $this->extra_cost->getRows($_POST);
        $i = $_POST['start'];
        $j = 0;
        foreach ($memData as $extra_cost) {

            $data[$j]['RecordID'] = $i + 1;
            // if($extra_cost->description){
            //   $data[$j]['title'] = $extra_cost->title.'   <a href="javascript:" data-popup="tooltip" data-placement="top"  title="'.$extra_cost->description.'" class="text-success"><i class="fa fa-info-circle" aria-hidden="true"></i></a>';
            // } else {
            $data[$j]['title'] = $extra_cost->title;
            //}
            $data[$j]['price'] = $extra_cost->price;
            $data[$j]['status'] = $extra_cost->status;
            $data[$j]['id'] = $extra_cost->id;
            $data[$j]['action'] = base64_encode($extra_cost->id);
            $j++;
            $i++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->extra_cost->countFiltered($_POST),
            "recordsFiltered" => $this->extra_cost->countFiltered($_POST),
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
     * @param str    $extra_cost_title      Extra Service Title
     * @param int    $price      Price
     *
     */
    public function add()
    {
        if ($this->input->post()) {
            $extra_cost_title = ucwords(trim($this->input->post("extra_cost_title")));
            $this->form_validation->set_rules('extra_cost_title', 'Title', 'trim|required');
            //$this->form_validation->set_rules('price', 'Price', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $response['success'] = false;
                //$response['error_msg']=_l('something_wrong');
                $response['error_msg'] = current($errors);
            } else {

                $price = trim($this->input->post("price"));
                $description = trim($this->input->post("description"));
                $data = array("title" => $extra_cost_title, "price" => $price, "status" => 1);

                $insert = $this->extra_cost->insert($data);

                if ($insert) {
                    $response['success'] = true;
                    $response['msg'] = _l('_added_successfully', _l('extra_cost'));
                } else {
                    $response['success'] = false;
                    $response['msg'] = _l('something_wrong') . _l('not_added', _l('extra_cost'));
                }
            }
        } else {
            $response['success'] = false;
            $response['error_msg'] = _l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * @author bsm
     *
     * Check Tour type already exist or not in Add & Edit Tour Type form Jquery-ajax Remote validation
     *
     * @param str    $tour_extra_cost      tour_extra_cost
     * @param int    $record_id  id
     *
     */
    public function istypeExists()
    {
        $extra_cost_title = ucwords(trim($this->input->post('extra_cost_title')));
        $record_id = base64_decode($this->input->post('record_id'));

        $where = array("title" => $extra_cost_title);
        $check_exist = $this->extra_cost->get_by($where);

        if ($record_id) {

            $where = array("id" => $record_id);
            $check_exist_byid = $this->extra_cost->get_by($where);

            if (is_array($check_exist) && sizeof($check_exist) > 0) {
                if (is_array($check_exist_byid) && sizeof($check_exist_byid) > 0) {
                    if ($check_exist['title'] == $check_exist_byid['title']) {
                        echo (json_encode(true));
                    } else {
                        echo (json_encode(false));
                    }
                } else {
                    echo (json_encode(false));
                }
            } else {
                echo (json_encode(true));
            }
        } else {

            if (is_array($check_exist) && sizeof($check_exist) > 0) {
                echo (json_encode(false));
            } else {
                echo (json_encode(true));
            }
        }
        exit;
    }


    /**
     * @author bsm
     *
     * Check Tour type already exist or not in Add Tour Type form Server side validation
     *
     * @param str    $extra_cost_title      extra_cost_title
     *
     */
    public function check_istypeExists($extra_cost_title)
    {
        $extra_cost_title = ucwords(trim($this->input->post('extra_cost_title')));

        $where = array("title" => $extra_cost_title);
        $check_exist = $this->extra_cost->get_by($where);

        if (is_array($check_exist) && sizeof($check_exist) > 0) {
            $this->form_validation->set_message("check_istypeExists", 'Tour Extra Cost already exist');
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
     * @param str    $extra_cost_title      extra_cost_title
     * @param int    $record_id  id
     *
     */
    public function check_istypeExists_edit($extra_cost_title)
    {
        $where = array("title" => $extra_cost_title);
        $check_exist = $this->extra_cost->get_by($where);

        $record_id = base64_decode($this->input->post('extra_cost_id'));
        $where = array("id" => $record_id);
        $check_exist_byid = $this->extra_cost->get_by($where);

        if (is_array($check_exist) && sizeof($check_exist) > 0) {
            if (is_array($check_exist_byid) && sizeof($check_exist_byid) > 0) {
                if ($check_exist['title'] == $check_exist_byid['title']) {
                    return true;
                } else {
                    $this->form_validation->set_message("check_istypeExists_edit", 'Tour Extra Cost already exist');
                    return false;
                }
            } else {
                $this->form_validation->set_message("check_istypeExists_edit", 'Tour Extra Cost already exist');
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * @author bsm
     *
     * Update Status Tour Extra Cost
     *
     * @param int    $extra_cost_id      extra_cost_id
     * @param int    $status      is_active
     *
     */
    public function update_status()
    {
        $extra_cost_id = base64_decode($this->input->post('extra_cost_id'));
        $data    = array('status' => $this->input->post('is_active'));
        $update = $this->extra_cost->update_by(array("id" => $extra_cost_id), $data);

        if ($update) {
            if ($this->input->post('is_active') == 1) {
                $response['success'] = true;
                $response['msg'] = 'true';
                $response['alert_msg'] = _l('_activated', _l('extra_cost'));
            } else {
                $response['success'] = true;
                $response['msg'] = 'false';
                $response['alert_msg'] = _l('_deactivated', _l('extra_cost'));
            }
        } else {
            $response['success'] = false;
            $response['msg'] = _l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * @author bsm
     *
     * Delete Tour types
     *
     * @param int    $extra_cost_id      extra_cost_id
     *
     */
    public function delete()
    {
        $extra_cost_id = base64_decode($this->input->post('extra_cost_id'));

        $where = array('id' => $extra_cost_id);
        $check_exist = $this->extra_cost->get_by($where);

        $response = array();
        // if (is_array($check_exist) && sizeof($check_exist) > 0) {

        //     $response['success'] = false;
        //     $response['msg'] = "Tour extra cost not deleted, It is used in Tours Product";
        // } else {
        $deleted = $this->extra_cost->delete_by(array("id" => $extra_cost_id));

        if ($deleted) {

            $response['success'] = true;
            $response['msg'] = _l('_deleted_successfully', _l('extra_cost'));
        } else {
            $response['success'] = false;
            $response['msg'] = _l('something_wrong');
        }
        // }
        echo json_encode($response);
        exit;
    }

    /**
     * @author bsm
     *
     * return Extra Cost data by it id
     *
     * @param int    $record_id    extra_cost_id
     *
     */
    public function get_record_byID()
    {
        $record_id = base64_decode($this->input->post('extra_cost_id'));
        $where = array("id" => $record_id);
        $data = $this->extra_cost->get_by($where);

        if (is_array($data) && sizeof($data) > 0) {
            echo json_encode($data);
        } else {
            echo json_encode("Records not found");
        }
        exit;
    }

    /**
     * @author bsm
     *
     * edit Tour types
     *
     * @param str    $extra_cost_title   extra_cost_title
     * @param int    $id      extra_cost_id
     *
     */
    public function edit()
    {
        if ($this->input->post()) {
            $extra_cost_title = ucwords(trim($this->input->post("extra_cost_title")));
            //$this->form_validation->set_rules('extra_cost_title', 'Title', 'trim|required');

            $this->form_validation->set_rules('extra_cost_title', 'Title', 'trim|required|callback_check_istypeExists_edit[' . $extra_cost_title . ']');
            //$this->form_validation->set_rules('price', 'Price', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $response['success'] = false;
                $response['msg'] = current($errors);
            } else {
                $id = base64_decode($this->input->post('extra_cost_id'));

                if ($id) {
                    $price = trim($this->input->post("price"));
                    $data = array("title" => $extra_cost_title, "price" => $price);
                    //$data=array("title"=>$extra_cost_title,"price"=>$price,"rate_opt"=>$rate_opt,"description"=>$description);

                    $update = $this->extra_cost->update_by(array("id" => $id), $data);

                    if ($update) {
                        $response['success'] = true;
                        $response['msg'] = _l('_updated_successfully', _l('extra_cost'));
                    } else {
                        $response['success'] = false;
                        $response['msg'] = _l('something_wrong') . _l('not_updated', _l('extra_cost'));
                    }
                } else {
                    $response['success'] = false;
                    $response['msg'] = _l('something_wrong') . _l('not_updated', _l('extra_cost'));
                }
            }
            echo json_encode($response);
            exit;
        } else {
            redirect('tour-extra-cost');
            exit;
        }
    }
}
