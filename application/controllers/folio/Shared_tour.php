<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shared_tour extends Admin_Controller
{
    /**
     * Constructor for the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Shared_tour_model', 'shared_tour');
    }
    /**
     * Loads the list of Shared tour.
     */
    public function index()
    {
        $this->set_page_title(_l('shared_tour'));
        $this->session->flashdata('message');
        $data['content'] = $this->load->view('admin/shared_tour/index', '', TRUE);
        $this->load->view('admin/layouts/index', $data);
    }

    public function getLists()
    {
        $data = $row = array();
        // Fetch shared tour list
        // pr($_POST);
        // die;
        $sharedTourData = $this->shared_tour->getRows($_POST);
        $i = $_POST['start'];
        $j = 0;
        foreach ($sharedTourData as $shared_tour) {
            // $data[$j]['userID']=$i+1;
            $data[$j]['RecordID'] = $i + 1;
            $data[$j]['passengers'] = $shared_tour->passengers;
            $data[$j]['agency'] = $shared_tour->agency;
            $data[$j]['ship'] = $shared_tour->ship;
            $data[$j]['pick_up_time'] = $shared_tour->pick_up_time;
            $data[$j]['notes'] = $shared_tour->notes;
            $data[$j]['tour_date'] = $shared_tour->tour_date;
            $data[$j]['shared_tour_city_name'] = $shared_tour->shared_tour_city_name;
            $data[$j]['shared_tour_variable_name'] = $shared_tour->shared_tour_variable_name;
            $data[$j]['action'] = base64_encode($shared_tour->id);
            $data[$j]['id'] = $shared_tour->id;
            $j++;
            $i++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->shared_tour->countFiltered($_POST),
            "recordsFiltered" => $this->shared_tour->countFiltered($_POST),
            "data" => $data,
        );
        // echo "<pre>";
        // print_r($data); exit;
        // Output to JSON format
        echo json_encode($output);
        exit;
    }

    public function add()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules('tour_date', 'Tour date', 'trim|required');
            $this->form_validation->set_rules('tour_variable_id', 'Tour', 'trim|required');
            $this->form_validation->set_rules('passengers', 'Passengers', 'trim|required');
            $this->form_validation->set_rules('agency', 'Agency', 'trim|required');
            $this->form_validation->set_rules('ship', 'Ship', 'trim|required');
            $this->form_validation->set_rules('time', 'Time', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                set_alert('error', _l('something_wrong'));
                redirect(admin_url('shared-tour'));
            } else {
                $passengers = trim($this->input->post('passengers'));
                $agency = trim($this->input->post('agency'));
                $ship = trim($this->input->post('ship'));
                $time = trim($this->input->post('time'));
                $notes = trim($this->input->post('notes'));
                $tour_date = trim($this->input->post('tour_date'));
                $tour = trim($this->input->post('tour'));
                $tour_variable_id = trim($this->input->post('tour_variable_id'));

                $shared_tour_data = array(
                    'passengers' => $passengers,
                    'agency' => $agency,
                    'ship' => $ship,
                    'pick_up_time' => $time,
                    'notes' => $notes,
                    'tour_date' => date('Y-m-d', strtotime($tour_date)),
                    'shared_tour_city_id' => $tour,
                    'shared_tour_variable_id' => $tour_variable_id
                );

                $ins_id = $this->shared_tour->insert($shared_tour_data);
                if ($ins_id) {
                    set_alert('success', _l('_added_successfully', _l('shared_tour')));
                } else {
                    set_alert('error', _l('something_wrong'));
                }
                redirect(admin_url('shared-tour'));
            }
        } else {
            $this->set_page_title(_l('add_shared_tour'));
            $cdata['shared_tour_variable'] = $this->shared_tour->get_shared_tour_variable(array('shared_tour_city_id' => 1));
            $data['content'] = $this->load->view('admin/shared_tour/add', $cdata, TRUE);
            $this->load->view('admin/layouts/index', $data);
        }
    }

    public function shared_tour_variable()
    {
        if (!$this->input->post('tour_id'))
            return false;

        $tour_id = $this->input->post('tour_id');
        $shared_tour_variable = $this->shared_tour->get_shared_tour_variable(array('shared_tour_city_id' => $tour_id));
        $output = array('msg' => 'Something went wrong', 'data' => '');
        if ($shared_tour_variable) {
            $output = array('msg' => 'Success!', 'data' => $shared_tour_variable);
        }
        echo json_encode($output);
        exit;
    }

    public function delete()
    {
        $shared_tour_city_ids = array();
        if (isset($_POST['single'])) {
            $shared_tour_city_ids[] = base64_decode($_POST['id']);
        } else {
            $all_ids = explode(",", $_POST['ids']);
            foreach ($all_ids as $id) {
                $shared_tour_city_ids[] = base64_decode($id);
            }
        }
        $deleted = $this->shared_tour->delete_shared_tour_list($shared_tour_city_ids);
        if ($deleted) {
            $response['success'] = true;
            $response['msg'] = _l('_deleted_successfully', _l('shared_tour'));
        } else {
            $response['success'] = false;
            $response['msg'] = _l('something_wrong');
        }
        echo json_encode($response);
        exit;
    }

    public function edit($id = '')
    {
        if ($id) {
            $this->set_page_title(_l('edit_shared_tour'));
            if ($this->input->post()) {
                $this->form_validation->set_rules('tour_date', 'Tour date', 'trim|required');
                $this->form_validation->set_rules('tour_variable_id', 'Tour', 'trim|required');
                $this->form_validation->set_rules('passengers', 'Passengers', 'trim|required');
                $this->form_validation->set_rules('agency', 'Agency', 'trim|required');
                $this->form_validation->set_rules('ship', 'Ship', 'trim|required');
                $this->form_validation->set_rules('time', 'Time', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    set_alert('error', _l('something_wrong'));
                    redirect(admin_url('shared-tour'));
                } else {
                    $passengers = trim($this->input->post('passengers'));
                    $agency = trim($this->input->post('agency'));
                    $ship = trim($this->input->post('ship'));
                    $time = trim($this->input->post('time'));
                    $notes = trim($this->input->post('notes'));
                    $tour_date = trim($this->input->post('tour_date'));
                    $tour = trim($this->input->post('tour'));
                    $tour_variable_id = trim($this->input->post('tour_variable_id'));

                    $shared_tour_data = array(
                        'passengers' => $passengers,
                        'agency' => $agency,
                        'ship' => $ship,
                        'pick_up_time' => $time,
                        'notes' => $notes,
                        'tour_date' => date('Y-m-d', strtotime($tour_date)),
                        'shared_tour_city_id' => $tour,
                        'shared_tour_variable_id' => $tour_variable_id
                    );
                    $update = $this->shared_tour->update_by(array("id" => base64_decode($id)), $shared_tour_data);
                    if ($update) {
                        set_alert('success', _l('_updated_successfully', _l('shared_tour')));
                    } else {
                        set_alert('error', _l('something_wrong'));
                    }
                    redirect(admin_url('shared-tour'));
                }
            } else {
                $where = array("id" => base64_decode($id));
                $sharedTourData = $this->shared_tour->get_by($where);
                if (is_array($sharedTourData) && sizeof($sharedTourData) > 0) {
                    $cdata['shared_tour_variable'] = $this->shared_tour->get_shared_tour_variable(array('shared_tour_city_id' => $sharedTourData['shared_tour_city_id']));
                    $cdata['sharedTourData'] = $sharedTourData;
                    $data['content'] = $this->load->view('admin/shared_tour/edit', $cdata, TRUE);
                    $this->load->view('admin/layouts/index', $data);
                } else {
                    set_alert('error', 'Records not found');
                    redirect(admin_url("newsletter"));
                    exit;
                }
            }
        } else {
            redirect(admin_url("shared-tour"));
            exit;
        }
    }

    public function update()
    {

        if ($this->input->post()) {
            $subject = trim(ucfirst($this->input->post('newsletter_subject')));
            $newsletter_content = trim($this->input->post('newsletter_content'));
            $newsletter_content_more = trim($this->input->post('newsletter_content_more'));

            $tour_image1 = "";
            $tour_image2 = "";
            $newsletter_data = array(
                'email_content' => $newsletter_content,
                'newsletter_subject' => $subject,
                'tour_image1_url' => trim($this->input->post('tour_image1_url')),
                'tour_image2_url' => trim($this->input->post('tour_image2_url')),
                'newsletter_content_2' => $newsletter_content_more,
                'is_draft' => $this->input->post('is_draft')
            );
            if ($tour_image1) {
                $newsletter_data["tour_image_1"] = $tour_image1;
            }
            if ($tour_image2) {
                $newsletter_data["tour_image_2"] = $tour_image2;
            }
            $newsletter_id = base64_decode($this->input->post('newsletter_id'));
            if ($newsletter_id) {

                $update_data = $this->newsletter->update_by(array("id" => $newsletter_id), $newsletter_data);
                if ($update_data) {
                    set_alert('success', _l('_updated_successfully', _l('newsletter')));
                } else {
                    set_alert('error', _l('something_wrong'));
                }
            } else {
                set_alert('error', _l('something_wrong'));
            }
            redirect(admin_url('newsletter'));
        } else {
            redirect(admin_url('newsletter'));
        }
    }



    public function preview_newsletter()
    {
        if ($this->input->post()) {
            $subject = trim($this->input->post('newsletter_subject'));
            $newsletter_content = trim($this->input->post('newsletter_content'));
            $newsletter_content_more = trim($this->input->post('newsletter_content_more'));

            $tour_image1 = "";
            $tour_image2 = "";
            if (!empty($this->input->post('tour_img_1'))) {
                $tour_image1 = $this->input->post('tour_img_1');
            }
            if (!empty($this->input->post('tour_img_2'))) {
                $tour_image2 = $this->input->post('tour_img_2');
            }
            if (is_array($_FILES) && $_FILES['tour_image1'] > 0) {

                $config['upload_path'] = './uploads/newsletter_images/';
                $config['allowed_types'] = '*';

                foreach ($_FILES as $key => $value) {
                    if ($key == "tour_image1") {
                        if ($value["name"]) {

                            $file_name = pathinfo($value["name"], PATHINFO_FILENAME) . '-' . time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload", $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $tour_image1 = $data['upload_data']['file_name'];
                            } else {
                                //set_alert('error',current($this->upload->display_errors()));

                                $response['success'] = false;
                                if (is_array($this->upload->display_errors())) {
                                    $response['error_msg'] = current($this->upload->display_errors());
                                } else {
                                    $response['error_msg'] = $this->upload->display_errors();
                                }

                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                    if ($key == "tour_image2") {
                        if ($value["name"]) {

                            $file_name = pathinfo($value["name"], PATHINFO_FILENAME) . '-' . time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload", $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $tour_image2 = $data['upload_data']['file_name'];
                            } else {
                                $response['success'] = false;
                                if (is_array($this->upload->display_errors())) {
                                    $response['error_msg'] = current($this->upload->display_errors());
                                } else {
                                    $response['error_msg'] = $this->upload->display_errors();
                                }
                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                }
            }
            $data['title'] = $subject;
            $data['username'] = $this->session->userdata('admin_username');
            $data['newsletter_content'] = $newsletter_content;
            $data['newsletter_content_more'] = $newsletter_content_more;
            $data['tour_image1'] = $tour_image1;
            if ($this->input->post('tour_image1_url')) {
                $data['tour_image1_url'] = trim($this->input->post('tour_image1_url'));
            } else {
                $data['tour_image1_url'] = "javascript:";
            }
            $data['tour_image2'] = $tour_image2;
            if ($this->input->post('tour_image2_url')) {
                $data['tour_image2_url'] = trim($this->input->post('tour_image2_url'));
            } else {
                $data['tour_image2_url'] = "javascript:";
            }

            $template_path = 'email_template/';
            $message = $this->load->view($template_path . 'header', $data, TRUE);
            //$message = $this->load->view($template_path.'newsletter_template_header', $data, TRUE);
            $message .= $this->load->view($template_path . 'admin_newsletter_temp', $data, TRUE);
            //$message .= $this->load->view($template_path.'newsletter_template_footer', $data, TRUE);
            $message .= $this->load->view($template_path . 'footer', $data, TRUE);
            //echo $message;
            $response['success'] = true;
            $response['message'] = $message;
            echo json_encode($response);
            exit;
        } else {
            redirect(admin_url('dashboard'));
            exit;
        }
    }

    public function isNewsletterTitleExists()
    {
        $newsletter_subject = trim($this->input->post('newsletter_subject'));
        $newsletter_id = base64_decode($this->input->post('newsletter_id'));

        $where = array("newsletter_subject" => $newsletter_subject);
        $check_exist = $this->newsletter->get_by($where);

        if ($newsletter_id) {
            $where = array("id" => $newsletter_id);
            $check_exist_byid = $this->newsletter->get_by($where);

            if (is_array($check_exist) && sizeof($check_exist) > 0) {
                if (is_array($check_exist_byid) && sizeof($check_exist_byid) > 0) {
                    if ($check_exist['newsletter_subject'] == $check_exist_byid['newsletter_subject']) {
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

    public function delete_attachment()
    {

        $newsletter_id = base64_decode($this->input->post('newsletter_id'));

        if ($newsletter_id) {
            $data = $this->newsletter->get_by(array('id' => $newsletter_id));
            if (is_array($data) && sizeof($data) > 0) {

                $upd_data = array("tour_image_1" => "");
                $update = $this->newsletter->update_by(array("id" => $newsletter_id), $upd_data);
                if ($update) {
                    if ($data['tour_image_1'] != '') {
                        if (file_exists('uploads/newsletter_images/' . $data['tour_image_1'])) {
                            $deleteimg = 'uploads/newsletter_images/' . $data['tour_image_1'];
                            unlink($deleteimg);
                        }
                    }
                    $response['success'] = true;
                    $response['msg'] = _l('_deleted_successfully', _l('tour_image_1'));
                } else {
                    $response['success'] = false;
                    $response['msg'] = "Something went wrong, Please try again later!";
                }
            } else {
                $response['success'] = false;
                $response['msg'] = "Something went wrong, Please try again later!";
            }
        } else {
            $response['success'] = false;
            $response['msg'] = "Something went wrong, Please try again later!";
        }
        echo json_encode($response);
        exit;
    }
    public function delete_second_attachment()
    {

        $newsletter_id = base64_decode($this->input->post('newsletter_id'));

        if ($newsletter_id) {
            $data = $this->newsletter->get_by(array('id' => $newsletter_id));
            if (is_array($data) && sizeof($data) > 0) {

                $upd_data = array("tour_image_2" => "");
                $update = $this->newsletter->update_by(array("id" => $newsletter_id), $upd_data);
                if ($update) {
                    if ($data['tour_image_2'] != '') {
                        if (file_exists('uploads/newsletter_images/' . $data['tour_image_2'])) {
                            $deleteimg = 'uploads/newsletter_images/' . $data['tour_image_2'];
                            unlink($deleteimg);
                        }
                    }
                    $response['success'] = true;
                    $response['msg'] = _l('_deleted_successfully', _l('tour_image_2'));
                } else {
                    $response['success'] = false;
                    $response['msg'] = "Something went wrong, Please try again later!";
                }
            } else {
                $response['success'] = false;
                $response['msg'] = "Something went wrong, Please try again later!";
            }
        } else {
            $response['success'] = false;
            $response['msg'] = "Something went wrong, Please try again later!";
        }
        echo json_encode($response);
        exit;
    }
}
