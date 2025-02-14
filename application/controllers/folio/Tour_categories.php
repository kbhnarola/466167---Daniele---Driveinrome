<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tour_categories extends Admin_Controller
{
    /**
     * Constructor for the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tour_categories_model', 'tour_categories');
        $this->load->model('Tours_model', 'tours');
    }

    /**
     * @author bsm
     *
     * Loads the admin dashboard
     *
     */
    public function index()
    {
        $this->set_page_title(_l('tour_categories'));
        //$cdata['tour_types'] = get_tour_types();
        $data['content'] = $this->load->view('admin/tour_categories/index', '', TRUE);
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
        $memData = $this->tour_categories->getRows($_POST);
        $i = $_POST['start'];
        $j = 0;
        foreach ($memData as $categories) {
            $data[$j]['RecordID'] = $i + 1;
            $data[$j]['tour_categories'] = $categories->title;
            //$data[$j]['tour_type'] = $categories->tour_type_name;
            $data[$j]['status'] = $categories->status;
            $data[$j]['id'] = $categories->id;
            $data[$j]['action'] = base64_encode($categories->id);
            $j++;
            $i++;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tour_categories->countFiltered($_POST),
            "recordsFiltered" => $this->tour_categories->countFiltered($_POST),
            "data" => $data,
        );
        // Output to JSON format
        echo json_encode($output);
        exit;
    }

    /**
     * @author bsm
     *
     * Check Tour Categories already exist or not in Add & Edit Tour Category form Jquery-ajax Remote validation
     *
     * @param str    $tour_category  tour_category
     * @param int    $record_id  id
     *
     */
    public function isCategoryExists()
    {
        $tour_category = ucwords(trim($this->input->post('tour_category')));
        $record_id = base64_decode($this->input->post('record_id'));
        $where = array("title" => $tour_category);
        $check_exist = $this->tour_categories->get_by($where);
        if ($record_id) {
            $where = array("id" => $record_id);
            $check_exist_byid = $this->tour_categories->get_by($where);
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
     * Add New Tour Type Form
     *
     * @param int    $tour_type_id   tour_type_id
     * @param str    $tour_category      tour_category
     *
     */
    public function add()
    {
        if ($this->input->post()) {
            $tour_category = ucwords(trim($this->input->post("tour_category")));
            //$this->form_validation->set_rules('tour_type', 'Tour type', 'required');
            $this->form_validation->set_rules('tour_category', 'City', 'trim|required|callback_check_isCategoryExists[' . $tour_category . ']');
            //$this->form_validation->set_rules('tour_Category', 'Tour Category', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $response['success'] = false;
                //$response['error_msg']=_l('something_wrong');
                $response['error_msg'] = current($errors);
            } else {
                //$tour_type_id=$this->input->post("tour_type");
                $meta_title = $this->input->post("meta_title");
                $meta_keywords = $this->input->post("meta_keywords");
                $meta_description = $this->input->post("meta_description");
                $youtube_embed_video_url = $this->input->post("youtube_embed_video_url");
                $image_name = $city_image_name = "";
                if (is_array($_FILES) && sizeof($_FILES) > 0) {
                    if (array_key_exists('featured_image', $_FILES) && $_FILES['featured_image']['tmp_name'] != '') {
                        $config['upload_path'] = './uploads/tour_city/';
                        $config['allowed_types'] = '*';
                        $file_name = time();
                        $config['file_name'] = $file_name;
                        $this->load->library("upload", $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('featured_image')) {
                            $data = array('upload_data' => $this->upload->data());
                            $image_name = $data['upload_data']['file_name'];
                        } else {
                            //set_alert('error',current($this->upload->display_errors()));
                            //echo 'false';
                            $response['success'] = false;
                            $response['msg'] = _l('something_wrong') . ' Feature Image not upload';
                            echo json_encode($response);
                            exit;
                        }
                    }
                }
                if (is_array($_FILES) && sizeof($_FILES) > 0) {
                    if (array_key_exists('city_image', $_FILES) && $_FILES['city_image']['tmp_name'] != '') {
                        $config['upload_path'] = './uploads/tour_city/';
                        $config['allowed_types'] = '*';
                        $file_name = time();
                        $config['file_name'] = $file_name;
                        $this->load->library("upload", $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('city_image')) {
                            $data = array('upload_data' => $this->upload->data());
                            $city_image_name = $data['upload_data']['file_name'];
                        } else {
                            //set_alert('error',current($this->upload->display_errors()));
                            //echo 'false';
                            $response['success'] = false;
                            $response['msg'] = _l('something_wrong') . ' City Image not upload';
                            echo json_encode($response);
                            exit;
                        }
                    }
                }
                $data = array(
                    "title" => $tour_category,
                    "slug" => slugify($tour_category),
                    "feature_image" => $image_name,
                    "city_image" => $city_image_name,
                    "status" => 1,
                    "meta_title" => $meta_title,
                    "meta_keywords" => $meta_keywords,
                    "meta_description" => $meta_description,
                    "youtube_embed_video_url" => $youtube_embed_video_url
                );
                $insert = $this->tour_categories->insert($data);
                if ($insert) {
                    $response['success'] = true;
                    $response['msg'] = _l('_added_successfully', _l('tour_category'));
                    $this->tour_categories->updateSharedTourCity(array('city_image' => $city_image_name), $where = $tour_category);
                } else {
                    $response['success'] = false;
                    $response['msg'] = _l('something_wrong') . _l('not_added', _l('tour_category'));
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
     * Check Tour type already exist or not in Add Tour Type form Server side validation
     *
     * @param str    $tour_category      tour_category
     *
     */
    public function check_isCategoryExists($tour_category)
    {
        $tour_category = ucwords(trim($this->input->post('tour_category')));
        $where = array("title" => $tour_category);
        $check_exist = $this->tour_categories->get_by($where);
        if (is_array($check_exist) && sizeof($check_exist) > 0) {
            $this->form_validation->set_message("check_isCategoryExists", 'City already exist');
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
     * @param str    $tour_category      tour_category
     * @param int    $record_id  id
     *
     */
    public function check_iscategoryExists_edit($tour_category)
    {
        $where = array("title" => ucwords(trim($tour_category)));
        $check_exist = $this->tour_categories->get_by($where);
        $record_id = base64_decode($this->input->post('tour_category_id'));
        $where = array("id" => $record_id);
        $check_exist_byid = $this->tour_categories->get_by($where);
        if (is_array($check_exist) && sizeof($check_exist) > 0) {
            if (is_array($check_exist_byid) && sizeof($check_exist_byid) > 0) {
                if ($check_exist['title'] == $check_exist_byid['title']) {
                    return true;
                } else {
                    $this->form_validation->set_message("check_iscategoryExists_edit", 'City already exist');
                    return false;
                }
            } else {
                $this->form_validation->set_message("check_iscategoryExists_edit", 'City already exist');
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
     * @param int    $tour_category_id      tour_category_id
     * @param int    $status      is_active
     *
     */
    public function update_status()
    {
        $tour_category_id = base64_decode($this->input->post('tour_category_id'));
        $data    = array('status' => $this->input->post('is_active'));
        $update = $this->tour_categories->update_by(array("id" => $tour_category_id), $data);
        if ($update) {
            if ($this->input->post('is_active') == 1) {
                $response['success'] = true;
                $response['msg'] = 'true';
                $response['alert_msg'] = _l('_activated', _l('tour_categories'));
            } else {
                $response['success'] = true;
                $response['msg'] = 'false';
                $response['alert_msg'] = _l('_deactivated', _l('tour_categories'));
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
     * @param int    $tour_category_id      tour_category_id
     *
     */
    public function delete()
    {
        $tour_category_id = base64_decode($this->input->post('tour_category_id'));
        $where = array('tour_category_id' => $tour_category_id);
        $check_exist = $this->tours->get_by($where);
        $response = array();
        if (is_array($check_exist) && sizeof($check_exist) > 0) {
            $response['success'] = false;
            $response['msg'] = "City not deleted, It is used in Tours Product";
        } else {
            $deleted = $this->tour_categories->delete_by(array("id" => $tour_category_id));
            if ($deleted) {
                $response['success'] = true;
                $response['msg'] = _l('_deleted_successfully', _l('tour_category'));
            } else {
                $response['success'] = false;
                $response['msg'] = _l('something_wrong');
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
     * @param int    $id    tour_category_id
     *
     */
    public function get_record_byID()
    {
        $record_id = base64_decode($this->input->post('tour_category_id'));
        $where = array("id" => $record_id);
        $data = $this->tour_categories->get_by($where);
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
     * @param str    $tour_type   tour_type_id
     * @param str    $tour_category   tour_category
     * @param int    $id      tour_category_id
     *
     */
    public function edit()
    {
        if ($this->input->post()) {
            $tour_category = ucwords(trim($this->input->post("tour_category")));
            //$this->form_validation->set_rules('tour_type', 'Tour type', 'required');
            //$this->form_validation->set_rules('tour_category', 'Tour Category', 'trim|required');
            $this->form_validation->set_rules('tour_category', 'City', 'trim|required|callback_check_isCategoryExists_edit[' . $tour_category . ']');
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $response['success'] = false;
                $response['msg'] = current($errors);
            } else {
                $id = base64_decode($this->input->post('tour_category_id'));
                if ($id) {
                    $meta_title = $this->input->post("meta_title");
                    $meta_keywords = $this->input->post("meta_keywords");
                    $meta_description = $this->input->post("meta_description");
                    $youtube_embed_video_url = $this->input->post("youtube_embed_video_url");
                    $image_name = $city_image_name = "";
                    if (is_array($_FILES) && sizeof($_FILES) > 0) {
                        if (array_key_exists('featured_image', $_FILES) && $_FILES['featured_image']['tmp_name'] != '') {
                            $config['upload_path'] = './uploads/tour_city/';
                            $config['allowed_types'] = '*';
                            $file_name = time();
                            $config['file_name'] = $file_name;
                            $this->load->library("upload", $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload('featured_image')) {
                                $data = array('upload_data' => $this->upload->data());
                                $image_name = $data['upload_data']['file_name'];
                            } else {
                                //set_alert('error',current($this->upload->display_errors()));
                                //echo 'false';
                                $response['success'] = false;
                                $response['msg'] = _l('something_wrong') . ' Feature Image not upload';
                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                    if (is_array($_FILES) && sizeof($_FILES) > 0) {
                        if (array_key_exists('city_image', $_FILES) && $_FILES['city_image']['tmp_name'] != '') {
                            $config['upload_path'] = './uploads/tour_city/';
                            $config['allowed_types'] = '*';
                            $file_name = time();
                            $config['file_name'] = $file_name;
                            $this->load->library("upload", $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload('city_image')) {
                                $data = array('upload_data' => $this->upload->data());
                                $city_image_name = $data['upload_data']['file_name'];
                            } else {
                                //set_alert('error',current($this->upload->display_errors()));
                                //echo 'false';
                                $response['success'] = false;
                                $response['msg'] = _l('something_wrong') . ' Feature Image not upload';
                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                    $data = array(
                        "title" => $tour_category,
                        "slug" => slugify($tour_category),
                        "status" => 1,
                        "meta_title" => $meta_title,
                        "meta_keywords" => $meta_keywords,
                        "meta_description" => $meta_description,
                        "youtube_embed_video_url" => $youtube_embed_video_url
                    );
                    if ($image_name) {
                        $data["feature_image"] = $image_name;
                    }
                    if ($city_image_name) {
                        $data["city_image"] = $city_image_name;
                    }
                    $update = $this->tour_categories->update_by(array("id" => $id), $data);
                    if ($update) {
                        $response['success'] = true;
                        $response['msg'] = _l('_updated_successfully', _l('tour_categories'));
                        $tour_category_array = explode(' ', $tour_category);
                        $this->tour_categories->updateSharedTourCity(array('city_image' => $city_image_name), $where = $tour_category_array[0]);
                    } else {
                        $response['success'] = false;
                        $response['msg'] = _l('something_wrong') . _l('not_updated', _l('tour_categories'));
                    }
                } else {
                    $response['success'] = false;
                    $response['msg'] = _l('something_wrong') . _l('not_updated', _l('tour_categories'));
                }
            }
            echo json_encode($response);
            exit;
        } else {
            redirect(admin_url('tour-categories'));
            // redirect('tour-categories');
            exit;
        }
    }
}