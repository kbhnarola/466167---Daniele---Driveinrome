<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reviews extends Admin_Controller
{
    /**
     * Constructor for the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Review_model', 'reviews');
        $this->load->model('Review_gallery_images', 'review_gallery');
        $this->load->model('Users_model', 'users_model');
        $this->load->model('Tours_model', 'tours');
    }
    /**
     * Loads the list of Users.
     */
    public function index()
    {
        $this->set_page_title(_l('reviews'));
        $data['content'] = $this->load->view('admin/manage_review/index', '', TRUE);
        $this->load->view('admin/layouts/index', $data);
    }

    public function getLists()
    {
        $data = $row = array();

        // Fetch review list
        $memData = $this->reviews->getRows($_POST);
        // echo $this->db->last_query();
        // exit;
        $i = $_POST['start'];
        $j = 0;
        foreach ($memData as $reviews) {

            $data[$j]['RecordID'] = $i + 1;
            $data[$j]['title'] = $reviews->title;
            $data[$j]['username'] = $reviews->username;
            $data[$j]['tour_name'] = ($reviews->tour_id) ? $reviews->tour_name : 'Landing Page';
            $data[$j]['city'] = $reviews->city;
            $data[$j]['country'] = $reviews->country;
            $data[$j]['review_date'] = ($reviews->review_date != "0000-00-00") ? date('d M,Y', strtotime($reviews->review_date)) : "";
            $data[$j]['id'] = $reviews->id;
            $data[$j]['action'] = base64_encode($reviews->id);
            $j++;
            $i++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->reviews->countFiltered($_POST),
            "recordsFiltered" => $this->reviews->countFiltered($_POST),
            "aaData" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
        exit;
    }

    public function add()
    {
        if ($this->input->post()) {
            $title = trim(ucfirst($this->input->post('review_title')));
            $username = trim(ucfirst($this->input->post('username')));
            $tour_id = $this->input->post('tour_id');
            $city = trim(ucfirst($this->input->post('city')));
            $country = trim(ucfirst($this->input->post('country')));
            $review_date = "0000-00-00";
            if ($this->input->post('review_date')) {
                $review_date = date("Y-m-d", strtotime($this->input->post('review_date')));
            }

            $review_description = $this->input->post('review_description');
            $feature_img_name = "";
            $gallery_img = array();
            if (is_array($_FILES) && sizeof($_FILES) > 0) {

                $config['upload_path'] = './uploads/review_images/';
                $config['allowed_types'] = '*';

                foreach ($_FILES as $key => $value) {
                    if ($key == "feature_image") {
                        if ($value["name"]) {

                            $file_name = time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload", $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $feature_img_name = $data['upload_data']['file_name'];
                            } else {
                                set_alert('error', current($this->upload->display_errors()));
                                redirect(admin_url('reviews'));
                                exit;
                            }
                        }
                    }
                    if ($key == "gallery_image") {
                        $files = $_FILES["gallery_image"];
                        if (is_array($files) && sizeof($files) > 0) {
                            foreach ($files['name'] as $key => $value) {
                                if ($files['name'][$key]) {
                                    $_FILES['gallery_image[]']['name'] = $files['name'][$key];
                                    $_FILES['gallery_image[]']['type'] = $files['type'][$key];
                                    $_FILES['gallery_image[]']['tmp_name'] = $files['tmp_name'][$key];
                                    $_FILES['gallery_image[]']['error'] = $files['error'][$key];
                                    $_FILES['gallery_image[]']['size'] = $files['size'][$key];

                                    $file_name = time();
                                    $config['file_name'] = $file_name;

                                    $this->load->library("upload", $config);
                                    $this->upload->initialize($config);

                                    if ($this->upload->do_upload('gallery_image[]')) {
                                        $data = array('upload_data' => $this->upload->data());
                                        $imgname = $data['upload_data']['file_name'];
                                        $gallery_img[] = $imgname;
                                    } else {
                                        set_alert('error', current($this->upload->display_errors()));
                                        redirect(admin_url('reviews'));
                                        exit;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $data = array(
                "title" => $title,
                "slug" => slugify($title),
                "username" => $username,
                "tour_id" => $tour_id,
                "city" => $city,
                "country" => $country,
                "review_date" => $review_date,
                "description" => $review_description,
                "feature_image" => $feature_img_name,
            );
            if ($this->input->post('is_draft') == 1) {
                $data['is_draft'] = 1;
            }
            $insert = $this->reviews->insert($data);
            $insert_id = $this->db->insert_id();
            if ($insert_id) {
                foreach ($gallery_img as $key => $value) {
                    $gallery_data = array(
                        "review_id" => $insert_id,
                        "gallery_image_name" => $value
                    );
                    $this->db->insert(TBL_REVIEW_GALLERY_IMAGES, $gallery_data);
                }
                set_alert('success', _l('_added_successfully', _l('review')));
            } else {
                set_alert('error', _l('something_wrong'));
            }

            redirect(admin_url('reviews'));
        } else {
            $this->set_page_title(_l('add_review'));
            //$data['userlist']=$this->users_model->get_all();
            $data['tourlist'] = get_tour_list();
            $data['content'] = $this->load->view('admin/manage_review/add', $data, TRUE);
            $this->load->view('admin/layouts/index', $data);
        }
    }

    public function delete()
    {
        $review_id = base64_decode($this->input->post('review_id'));

        $where = array('id' => $review_id);
        $getReview = $this->reviews->get_by($where);
        $review_feature_img = "";
        if (is_array($getReview) && sizeof($getReview) > 0) {
            $review_feature_img = $getReview['feature_image'];
        }
        $deleted = $this->reviews->delete_by(array("id" => $review_id));

        $response = array();
        if ($deleted) {

            if ($review_feature_img != '') {
                if (file_exists('uploads/review_images/' . $review_feature_img)) {
                    $deleteimg = 'uploads/review_images/' . $review_feature_img;
                    unlink($deleteimg);
                }
            }
            $where1 = array('review_id' => $review_id);
            $getReview_gallery = $this->review_gallery->get_many_by($where1);
            if (is_array($getReview_gallery) && sizeof($getReview_gallery) > 0) {
                foreach ($getReview_gallery as $value) {
                    if (file_exists('uploads/review_images/' . $value['gallery_image_name'])) {
                        $deleteimg = 'uploads/review_images/' . $value['gallery_image_name'];
                        unlink($deleteimg);
                    }
                }
                $deleted = $this->review_gallery->delete_by(array("review_id" => $review_id));
            }

            $response['success'] = true;
            $response['msg'] = _l('_deleted_successfully', _l('review'));
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
            $this->set_page_title(_l('edit_review'));
            $where = array("id" => base64_decode($id));
            $reviewData = $this->reviews->get_by($where);
            if (is_array($reviewData) && sizeof($reviewData) > 0) {
                $data['reviewData'] = $reviewData;
                $where1 = array("review_id" => base64_decode($id));
                $reviewGallery = $this->review_gallery->get_many_by($where1);
                $data['reviewGallery'] = $reviewGallery;
                $data['tourlist'] = get_tour_list();
                $data['content'] = $this->load->view('admin/manage_review/edit', $data, TRUE);
                $this->load->view('admin/layouts/index', $data);
            } else {
                set_alert('error', 'Records not found');
                redirect(admin_url("reviews"));
                exit;
            }
        } else {
            redirect(admin_url("reviews"));
            exit;
        }
    }

    public function update()
    {

        if ($this->input->post()) {

            $title = trim(ucfirst($this->input->post('review_title')));
            $username = trim(ucfirst($this->input->post('username')));
            $tour_id = $this->input->post('tour_id');
            $city = trim(ucfirst($this->input->post('city')));
            $country = trim(ucfirst($this->input->post('country')));
            $review_date = "0000-00-00";
            if ($this->input->post('review_date')) {
                $review_date = date("Y-m-d", strtotime($this->input->post('review_date')));
            }

            $review_description = $this->input->post('review_description');
            $feature_img_name = "";
            $gallery_img = array();
            if (is_array($_FILES) && sizeof($_FILES) > 0) {

                $config['upload_path'] = './uploads/review_images/';
                $config['allowed_types'] = '*';

                foreach ($_FILES as $key => $value) {
                    if ($key == "feature_image") {
                        if ($value["name"]) {

                            $file_name = time();
                            $config['file_name'] = $file_name;

                            $this->load->library("upload", $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload($key)) {
                                $data = array('upload_data' => $this->upload->data());
                                $feature_img_name = $data['upload_data']['file_name'];
                            } else {
                                set_alert('error', current($this->upload->display_errors()));
                                redirect(admin_url('reviews'));
                                exit;
                            }
                        }
                    }
                    if ($key == "gallery_image") {
                        $files = $_FILES["gallery_image"];
                        if (is_array($files) && sizeof($files) > 0) {
                            foreach ($files['name'] as $key => $value) {
                                if ($files['name'][$key]) {
                                    $_FILES['gallery_image[]']['name'] = $files['name'][$key];
                                    $_FILES['gallery_image[]']['type'] = $files['type'][$key];
                                    $_FILES['gallery_image[]']['tmp_name'] = $files['tmp_name'][$key];
                                    $_FILES['gallery_image[]']['error'] = $files['error'][$key];
                                    $_FILES['gallery_image[]']['size'] = $files['size'][$key];

                                    $file_name = time();
                                    $config['file_name'] = $file_name;

                                    $this->load->library("upload", $config);
                                    $this->upload->initialize($config);

                                    if ($this->upload->do_upload('gallery_image[]')) {
                                        $data = array('upload_data' => $this->upload->data());
                                        $imgname = $data['upload_data']['file_name'];
                                        $gallery_img[] = $imgname;
                                    } else {
                                        set_alert('error', current($this->upload->display_errors()));
                                        redirect(admin_url('reviews'));
                                        exit;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $data = array(
                "title" => $title,
                "slug" => slugify($title),
                "username" => $username,
                "tour_id" => $tour_id,
                "city" => $city,
                "country" => $country,
                "review_date" => $review_date,
                "description" => $review_description,
                "is_draft" => $this->input->post('is_draft')
            );
            if ($feature_img_name) {
                $data["feature_image"] = $feature_img_name;
            }
            $review_id = base64_decode($this->input->post('review_id'));

            if ($review_id) {

                $update_data = $this->reviews->update_by(array("id" => $review_id), $data);

                if (is_array($gallery_img) && sizeof($gallery_img) > 0) {
                    foreach ($gallery_img as $key => $value) {
                        $gallery_data = array(
                            "review_id" => $review_id,
                            "gallery_image_name" => $value
                        );
                        $this->db->insert(TBL_REVIEW_GALLERY_IMAGES, $gallery_data);
                    }
                }
                if ($update_data) {
                    set_alert('success', _l('_updated_successfully', _l('review')));
                } else {
                    set_alert('error', _l('something_wrong'));
                }
            } else {
                set_alert('error', _l('something_wrong'));
            }
            redirect(admin_url('reviews'));
        } else {
            redirect(admin_url('reviews'));
        }
    }

    public function delete_attachment()
    {

        $review_id = base64_decode($this->input->post('review_id'));

        if ($review_id) {
            $data = $this->reviews->get_by(array('id' => $review_id));
            if (is_array($data) && sizeof($data) > 0) {

                $upd_data = array("feature_image" => "");
                $update = $this->reviews->update_by(array("id" => $review_id), $upd_data);
                if ($update) {
                    if ($data['feature_image'] != '') {
                        if (file_exists('uploads/review_images/' . $data['feature_image'])) {
                            $deleteimg = 'uploads/review_images/' . $data['feature_image'];
                            unlink($deleteimg);
                        }
                    }
                    $response['success'] = true;
                    $response['msg'] = _l('_deleted_successfully', _l('feature_image'));
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

    public function delete_gallery_attachment()
    {

        $review_gallery_id = base64_decode($this->input->post('review_gallery_id'));

        if ($review_gallery_id) {
            $data = $this->review_gallery->get_by(array('id' => $review_gallery_id));
            if (is_array($data) && sizeof($data) > 0) {

                $deleted = $this->review_gallery->delete_by(array("id" => $review_gallery_id));
                if ($deleted) {
                    if ($data['gallery_image_name'] != '') {
                        if (file_exists('uploads/review_images/' . $data['gallery_image_name'])) {
                            $deleteimg = 'uploads/review_images/' . $data['gallery_image_name'];
                            unlink($deleteimg);
                        }
                    }
                    $response['success'] = true;
                    $response['msg'] = _l('_deleted_successfully', _l('gallery_image'));
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

    public function isReviewTitleExists()
    {
        $title = ucfirst(trim($this->input->post('review_title')));

        $where = array("title" => $title);
        $check_exist = $this->reviews->get_by($where);

        if (is_array($check_exist) && sizeof($check_exist) > 0) {
            echo (json_encode(false));
        } else {
            echo (json_encode(true));
        }
        exit;
    }

    public function isReviewTitleExistsEdit()
    {
        $title = ucfirst(trim($this->input->post('review_title')));
        $record_id = base64_decode($this->input->post('record_id'));

        $where = array("title" => $title);
        $check_exist = $this->reviews->get_by($where);

        if ($record_id) {

            $where = array("id" => $record_id);
            $check_exist_byid = $this->reviews->get_by($where);

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
}
