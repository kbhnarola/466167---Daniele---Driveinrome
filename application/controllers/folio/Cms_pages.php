<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Cms_pages extends Admin_Controller

{

    /**

     * Constructor for the class

     */

    public function __construct()

    {

        parent::__construct();

        $this->load->model('Cms_model', 'cms_model');

        $this->load->model('Cms_page_static_text', 'cms_static_model');

        $this->load->model('Tours_model', 'tours');

        $this->load->model('Review_model', 'reviews');

    }





    /**

     * @author bsm

     *

     * Loads the admin dashboard

     *

     */

    public function index()

    {

        $this->set_page_title(_l('cms_pages'));



        $data['content'] = $this->load->view('admin/cms_pages/index', '', TRUE);

        $this->load->view('admin/layouts/index', $data);

    }



    /**

     * @author Bhavesh(bsm)

     *

     * get list of Cms Pages this will use by jquery datatable

     *

     */

    public function getLists()

    {

        $data = $row = array();



        // Fetch CMS Page's list

        $memData = $this->cms_model->getRows($_POST);



        $i = $_POST['start'];

        $j = 0;

        foreach ($memData as $cms) {



            $data[$j]['RecordID'] = $i + 1;

            $data[$j]['title'] = $cms->page_title;

            // if(strlen($cms->description)>500){

            //     $data[$j]['description']=substr($cms->description,0,500).'...';

            // } else {

            //    $data[$j]['description']=substr($cms->description,0,500); 

            // }

            //$data[$j]['description'] = $cms->description;



            $data[$j]['page_url'] = base_url() . $cms->slug;



            $data[$j]['status'] = $cms->status;

            $data[$j]['id'] = $cms->id;

            $data[$j]['action'] = base64_encode($cms->id);

            $data[$j]['parent_id'] = $cms->parent_id;

            $j++;

            $i++;

        }



        $output = array(

            "draw" => $_POST['draw'],

            "recordsTotal" => $this->cms_model->countFiltered($_POST),

            "recordsFiltered" => $this->cms_model->countFiltered($_POST),

            "data" => $data,

        );



        // Output to JSON format

        echo json_encode($output);

        exit;

    }



    /**

     * @author bsm

     *

     * Check CMS Page already exist or not in Add & Edit CMS Pages form Jquery-ajax Remote validation

     *

     * @param str    $page_title  page_title

     * @param int    $record_id  id

     *

     */

    public function isCmsExists()

    {

        $page_title = ucwords(trim($this->input->post('cms_page_title')));

        $record_id = base64_decode($this->input->post('record_id'));



        $where = array("page_title" => $page_title);

        $check_exist = $this->cms_model->get_by($where);



        if ($record_id) {



            $where = array("id" => $record_id);

            $check_exist_byid = $this->cms_model->get_by($where);



            if (is_array($check_exist) && sizeof($check_exist) > 0) {

                if (is_array($check_exist_byid) && sizeof($check_exist_byid) > 0) {

                    if ($check_exist['page_title'] == $check_exist_byid['page_title']) {

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

     * Add New CMS Page Form

     *

     * @param int    $cms_page_id   cms_page_id

     * @param str    $page_title      page_title

     * @param str    $page_description      page_description

     *

     */

    // public function add()

    // {

    //     if ($this->input->post())

    //     {

    //         $cms_page_title=ucwords(trim($this->input->post("cms_page_title")));

    //         $this->form_validation->set_rules('cms_page_title', 'Title', 'trim|required');

    //         if(array_key_exists("description", $this->input->post())) {

    //             $this->form_validation->set_rules('description', 'Description', 'trim|required');

    //         }



    //         if($this->form_validation->run() == FALSE) {



    //             $errors = $this->form_validation->error_array();



    //             //$response['msg']=current($errors);  

    //             set_alert('error', _l('something_wrong'));



    //             redirect(admin_url('cms-pages'));

    //         } else {



    //             $description=$this->input->post("description");



    //             $meta_title=$this->input->post("meta_title");

    //             $meta_keywords=$this->input->post("meta_keywords");

    //             $meta_description=$this->input->post("meta_description");

    //             if(array_key_exists("video_links", $this->input->post())){

    //                 $links=$this->input->post("video_links[]");

    //                 $video_links=json_encode($links,JSON_FORCE_OBJECT);

    //             } else {

    //                 $video_links="";

    //             }

    //             if(array_key_exists("description", $this->input->post())) {

    //                 $description=$this->input->post("description");

    //             } else {

    //                 $description="";

    //             }

    //             $data=array(

    //                 "page_title"=>$cms_page_title,

    //                 "description"=>$description,

    //                 "video_links"=>$video_links,

    //                 "status"=>1,

    //                 "meta_title"=>$meta_title,

    //                 "meta_keyword"=>$meta_keywords,

    //                 "meta_description"=>$meta_description

    //                 );



    //             $insert=$this->cms_model->insert($data);



    //             if($insert){



    //                 set_alert('success', _l('_added_successfully', _l('cms_page')));



    //                 redirect(admin_url('cms-pages'));

    //             } else {

    //                 set_alert('error', _l('something_wrong'));



    //                 redirect(admin_url('cms-pages'));

    //             }      

    //         }     

    //     }

    //     else

    //     {

    //         $this->set_page_title(_l('cms_pages').' | '._l('add'));



    //         $data['content'] = $this->load->view('admin/cms_pages/add', '', TRUE);

    //         $this->load->view('admin/layouts/index', $data);

    //     }

    // }



    /**

     * @author bsm

     *

     * Check CMS Page already exist or not in Add CMS page form Server side validation

     *

     * @param str    $page_title      page_title

     *

     */

    public function check_isCmsExists($page_title)

    {

        $page_title = ucwords(trim($this->input->post('page_title')));



        $where = array("page_title" => $page_title);

        $check_exist = $this->cms_model->get_by($where);



        if (is_array($check_exist) && sizeof($check_exist) > 0) {

            $this->form_validation->set_message("check_isCmsExists", 'Cms Page title already exist');

            return false;

        } else {

            return true;

        }

    }



    /**

     * @author bsm

     *

     * Check CMS Page already exist or not in edit CMS page form Server side validation

     *

     * @param str    $page_title      page_title

     * @param int    $record_id  id

     *

     */

    public function check_isCmsExists_edit($page_title)

    {

        $where = array("page_title" => ucwords(trim($page_title)));

        $check_exist = $this->cms_model->get_by($where);



        $record_id = base64_decode($this->input->post('cms_page_id'));

        $where = array("id" => $record_id);

        $check_exist_byid = $this->cms_model->get_by($where);



        if (is_array($check_exist) && sizeof($check_exist) > 0) {

            if (is_array($check_exist_byid) && sizeof($check_exist_byid) > 0) {

                if ($check_exist['page_title'] == $check_exist_byid['page_title']) {

                    return true;

                } else {

                    $this->form_validation->set_message("check_isCmsExists_edit", 'Cms Page title already exist');

                    return false;

                }

            } else {

                $this->form_validation->set_message("check_isCmsExists_edit", 'Cms Page title already exist');

                return false;

            }

        } else {

            return true;

        }

    }



    /**

     * @author bsm

     *

     * Update Status CMS Pages

     *

     * @param int    $cms_page_id      cms_page_id

     * @param int    $status      is_active

     *

     */

    public function update_status()

    {

        $cms_page_id = base64_decode($this->input->post('cms_page_id'));

        $data    = array('status' => $this->input->post('is_active'));

        $update = $this->cms_model->update_by(array("id" => $cms_page_id), $data);



        if ($update) {

            if ($this->input->post('is_active') == 1) {

                $response['success'] = true;

                $response['msg'] = 'true';

                $response['alert_msg'] = _l('_activated', _l('cms_page'));

            } else {

                $response['success'] = true;

                $response['msg'] = 'false';

                $response['alert_msg'] = _l('_deactivated', _l('cms_page'));

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

     * Delete CMS Page

     *

     * @param int    $cms_page_id      cms_page_id

     *

     */

    public function delete()

    {

        $cms_page_id = base64_decode($this->input->post('cms_page_id'));



        $deleted = $this->cms_model->delete_by(array("id" => $cms_page_id));

        if ($deleted) {



            $response['success'] = true;

            $response['msg'] = _l('_deleted_successfully', _l('cms_page'));

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

     * return user data by it id

     *

     * @param int    $id    cms_page_id

     *

     */

    public function get_record_byID()

    {

        $record_id = base64_decode($this->input->post('transfer_category_id'));



        $where = array("id" => $record_id);

        $data = $this->transfer_categories->get_by($where);



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

     * edit transfer types

     *

     * @param str    $cms_page_title   cms_page_title

     * @param str    $description   description

     * @param int    $cms_page_id      cms_page_id

     *

     */

    public function edit($id = '')

    {

        $this->set_page_title(_l('cms_page') . ' | ' . _l('edit'));

        if ($id) {

            if ($this->input->post()) {



                $cms_page_title = ucwords(trim($this->input->post("cms_page_title")));

                $this->form_validation->set_rules('cms_page_title', 'Title', 'trim|required');

                if (!array_key_exists("fleet_title", $this->input->post())) {

                    if (array_key_exists("description", $this->input->post())) {

                        $this->form_validation->set_rules('description', 'Description', 'trim|required');

                    }

                }



                if ($this->form_validation->run() == FALSE) {

                    set_alert('error', _l('something_wrong'));



                    redirect(admin_url('cms-pages'));

                } else {



                    // if(!array_key_exists("fleet_title", $this->input->post())){

                    //     $description=$this->input->post("description");

                    // }



                    $meta_title = $this->input->post("meta_title");

                    $meta_keywords = $this->input->post("meta_keywords");

                    $meta_description = $this->input->post("meta_description");

                    $cms_page_id = base64_decode($this->input->post('cms_page_id'));



                    if (array_key_exists("video_links", $this->input->post())) {

                        $links = $this->input->post("video_links[]");

                        $link_title = $this->input->post("link_title[]");



                        $imgArray = array();



                        $config['upload_path'] = './uploads/about_us/';

                        $config['allowed_types'] = '*';

                        $i = 0;

                        foreach ($_FILES as $key => $value) {

                            if ($key == "feature_image") {

                                $files = $_FILES["feature_image"];

                                if (is_array($files) && sizeof($files) > 0) {

                                    foreach ($files['name'] as $key => $value) {

                                        if ($files['name'][$key]) {

                                            $_FILES['feature_image[]']['name'] = $files['name'][$key];

                                            $_FILES['feature_image[]']['type'] = $files['type'][$key];

                                            $_FILES['feature_image[]']['tmp_name'] = $files['tmp_name'][$key];

                                            $_FILES['feature_image[]']['error'] = $files['error'][$key];

                                            $_FILES['feature_image[]']['size'] = $files['size'][$key];



                                            $file_name = time();

                                            $config['file_name'] = $file_name;



                                            $this->load->library("upload", $config);

                                            $this->upload->initialize($config);



                                            if ($this->upload->do_upload('feature_image[]')) {

                                                $data = array('upload_data' => $this->upload->data());

                                                $imgname = $data['upload_data']['file_name'];

                                                $imgArray[] = $imgname;

                                            } else {

                                                //$data['optional_document_upload_error'] = $this->upload->display_errors();

                                                //print_r($data);

                                                set_alert('error', current($this->upload->display_errors()));

                                                redirect(admin_url('cms-pages'));

                                                exit;

                                            }

                                        } else {

                                            $imgArray[] = "";

                                        }

                                        $i++;

                                    }

                                }

                            }

                        }

                        $links_array = array();

                        if (array_key_exists('about_us_gallery', $this->input->post())) {

                            $vid_links = @unserialize($this->input->post('about_us_gallery'));

                            if (is_array($vid_links) && sizeof($vid_links) > 0) {

                                foreach ($links as $key => $value) {

                                    $links_array[$key]['you_tube_link'] = $links[$key];

                                    if ($imgArray[$key] == "") {

                                        $links_array[$key]['feature_image'] = $vid_links[$key]['feature_image'];

                                    } else {

                                        $links_array[$key]['feature_image'] = $imgArray[$key];

                                    }

                                    $links_array[$key]['title'] = ucwords(trim($link_title[$key]));

                                }

                            } else {

                                if (is_array($links) && sizeof($links) > 0) {

                                    foreach ($links as $key => $value) {

                                        $links_array[$key]['you_tube_link'] = $value;

                                        $links_array[$key]['feature_image'] = $imgArray[$key];

                                        $links_array[$key]['title'] = ucwords(trim($link_title[$key]));

                                    }

                                }

                            }

                        } else {

                            if (is_array($links) && sizeof($links) > 0) {

                                foreach ($links as $key => $value) {

                                    $links_array[$key]['you_tube_link'] = $value;

                                    $links_array[$key]['feature_image'] = $imgArray[$key];

                                    $links_array[$key]['title'] = ucwords(trim($link_title[$key]));

                                }

                            }

                        }



                        $video_links = serialize($links_array);

                    } else {

                        $video_links = "";

                    }

                    $description = "";

                    if (array_key_exists("fleet_title", $this->input->post())) {

                        $fleet_title = $this->input->post("fleet_title[]");

                        $fleet_desc = $this->input->post("fleet_description[]");



                        $imgArray = array();



                        $config['upload_path'] = './uploads/fleets/';

                        $config['allowed_types'] = '*';

                        $i = 0;

                        foreach ($_FILES as $key => $value) {

                            if ($key == "fleet_feature_img") {

                                $files = $_FILES["fleet_feature_img"];

                                if (is_array($files) && sizeof($files) > 0) {

                                    foreach ($files['name'] as $key => $value) {

                                        if ($files['name'][$key]) {

                                            $_FILES['fleet_feature_img[]']['name'] = $files['name'][$key];

                                            $_FILES['fleet_feature_img[]']['type'] = $files['type'][$key];

                                            $_FILES['fleet_feature_img[]']['tmp_name'] = $files['tmp_name'][$key];

                                            $_FILES['fleet_feature_img[]']['error'] = $files['error'][$key];

                                            $_FILES['fleet_feature_img[]']['size'] = $files['size'][$key];



                                            $file_name = time();

                                            $config['file_name'] = $file_name;



                                            $this->load->library("upload", $config);

                                            $this->upload->initialize($config);



                                            if ($this->upload->do_upload('fleet_feature_img[]')) {

                                                $data = array('upload_data' => $this->upload->data());

                                                $imgname = $data['upload_data']['file_name'];

                                                $imgArray[] = $imgname;

                                            } else {

                                                //$data['optional_document_upload_error'] = $this->upload->display_errors();

                                                //print_r($data);

                                                set_alert('error', current($this->upload->display_errors()));

                                                redirect(admin_url('cms-pages'));

                                                exit;

                                            }

                                        } else {

                                            $imgArray[] = "";

                                        }

                                        $i++;

                                    }

                                }

                            }

                        }

                        // print_r($imgArray);

                        // exit;

                        $description_array = array();

                        $where = array("id" => $cms_page_id);

                        $fleet_query = $this->cms_model->get_by($where);

                        if (is_array($fleet_query) && sizeof($fleet_query) > 0) {

                            $fleets = @unserialize($fleet_query['description']);



                            if (is_array($fleets) && sizeof($fleets) > 0) {

                                foreach ($fleet_title as $key => $value) {

                                    $description_array[$key]['fleet_title'] = ucwords(trim($fleet_title[$key]));

                                    if ($imgArray[$key] == "") {

                                        $description_array[$key]['feature_image'] = $fleets[$key]['feature_image'];

                                    } else {

                                        $description_array[$key]['feature_image'] = $imgArray[$key];

                                    }

                                    $description_array[$key]['description'] = $fleet_desc[$key];

                                }

                            } else {

                                if (is_array($fleet_title) && sizeof($fleet_title) > 0) {



                                    foreach ($fleet_title as $key => $value) {

                                        $description_array[$key]['fleet_title'] = ucwords(trim($value));

                                        $description_array[$key]['feature_image'] = $imgArray[$key];

                                        $description_array[$key]['description'] = $fleet_desc[$key];

                                    }

                                }

                            }

                        } else {

                            if (is_array($fleet_title) && sizeof($fleet_title) > 0) {



                                foreach ($fleet_title as $key => $value) {

                                    $description_array[$key]['fleet_title'] = ucwords(trim($value));

                                    $description_array[$key]['feature_image'] = $imgArray[$key];

                                    $description_array[$key]['description'] = $fleet_desc[$key];

                                }

                            }

                        }



                        $description = serialize($description_array);

                    } else {

                        if (array_key_exists("description", $this->input->post())) {

                            $description = $this->input->post("description");

                        }

                    }



                    if (array_key_exists("static_title", $this->input->post())) {

                        $static_title = $this->input->post('static_title[]');

                        $static_description = $this->input->post('static_description[]');

                        if (is_array($static_title) && sizeof($static_title) > 0) {

                            $get_static_text = $this->cms_static_model->get_many_by(array("page_id" => $cms_page_id));

                            if (is_array($get_static_text) && sizeof($get_static_text) > 0) {

                                $this->cms_static_model->delete_text(array("page_id" => $cms_page_id));

                            }

                            foreach ($static_title as $key => $value) {

                                if ($value && ($static_description[$key] != "")) {

                                    $data = array('page_id' => $cms_page_id, 's_title' => $value, 's_description' => $static_description[$key]);

                                    $this->cms_static_model->insert($data);

                                }

                            }

                        }

                    }



                    $promofile = "";

                    if (is_array($_FILES) && sizeof($_FILES) > 0) {

                        if (array_key_exists("promo_file", $_FILES)) {

                            // print_r($_FILES);

                            // exit;

                            $config1['upload_path'] = './uploads/promo_file/';

                            $config1['allowed_types'] = '*';

                            if ($_FILES['promo_file']["name"]) {



                                $file_name = pathinfo($_FILES['promo_file']["name"], PATHINFO_FILENAME) . '-' . time();

                                $config1['file_name'] = $file_name;



                                $this->load->library("upload", $config1);

                                $this->upload->initialize($config1);



                                if ($this->upload->do_upload('promo_file')) {

                                    $data = array('upload_data' => $this->upload->data());

                                    $promofile = $data['upload_data']['file_name'];

                                } else {

                                    if (is_array($this->upload->display_errors())) {

                                        set_alert('error', current($this->upload->display_errors()));

                                    } else {

                                        set_alert('error', $this->upload->display_errors());

                                    }



                                    redirect(admin_url('cms-pages'));

                                    exit;

                                }

                            }

                        }

                    }

                    $data = array(

                        "page_title" => $cms_page_title,

                        //"slug"=>slugify($cms_page_title),

                        "description" => $description,

                        "video_links" => $video_links,

                        "meta_title" => $meta_title,

                        "meta_keyword" => $meta_keywords,

                        "meta_description" => $meta_description

                    );



                    // if($cms_page_id==10) {

                    //     $data['slug']="";

                    // }

                    $cms_parent_id = $this->input->post('cms_parent_id');

                    if ($cms_page_id == 12 || $cms_parent_id != 0) {

                        $data['slug'] = slugify($cms_page_title);

                    }

                    if ($promofile) {

                        $data['promo_file'] = $promofile;

                        $data['promo_url'] = "";

                    } else {

                        if (array_key_exists("promo_url", $this->input->post())) {

                            if ($this->input->post("promo_url")) {

                                $data['promo_url'] = $this->input->post("promo_url");

                                $data['promo_file'] = "";

                            }

                        }

                    }



                    if (array_key_exists("tour_id", $this->input->post())) {

                        $tour_ids = $this->input->post("tour_id[]");

                        if (is_array($tour_ids) && sizeof($tour_ids) > 0) {

                            $data['tour_id'] = implode(",", $tour_ids);

                        }

                    } else {

                        $data['tour_id'] = '';

                    }

                    if (array_key_exists("review_ids", $this->input->post())) {

                        $review_ids = $this->input->post("review_ids[]");

                        if (is_array($review_ids) && sizeof($review_ids) > 0) {

                            $data['review_ids'] = implode(",", $review_ids);

                        }

                    }

                    $select_tour_type_opt = $this->input->post('select_tour_type_opt');

                    $data['review_type'] = $select_tour_type_opt;

                    $update = $this->cms_model->update_by(array("id" => $cms_page_id), $data);



                    if ($update) {



                        set_alert('success', _l('_updated_successfully', _l('cms_page')));

                        redirect(admin_url('cms-pages'));

                    } else {

                        set_alert('error', _l('something_wrong'));



                        redirect(admin_url('cms-pages'));

                    }

                }

            } else {



                $where = array("id" => base64_decode($id));

                $cmsData = $this->cms_model->get_by($where);

                if (is_array($cmsData) && sizeof($cmsData) > 0) {

                    $cdata['cmsData'] = $cmsData;

                    $cdata['tourlist'] = get_tour_list();

                    // pr(get_review_list());die;

                    // if($cmsData['tour_id']) {

                    //     $cdata['reviewlist']=$this->reviews->get_many_by(array("tour_id"=>$cmsData['tour_id']));

                    // } else {

                    //     $cdata['reviewlist']=array();

                    // }

                    if ($cmsData['tour_id']) {

                        $tour_id = explode(",", $cmsData['tour_id']);

                        $rev_ids = array();

                        if (is_array($tour_id) && sizeof($tour_id) > 0) {

                            foreach ($tour_id as $t) {

                                $rev = $this->reviews->get_many_by(array("tour_id" => $t));

                                if (is_array($rev) && sizeof($rev) > 0) {

                                    foreach ($rev as $r) {

                                        $rev_ids[] = $r;

                                    }

                                }

                            }

                            $cdata['reviewlist'] = $rev_ids;

                        } else {

                            $cdata['reviewlist'] = array();

                        }

                    } else {

                        $cdata['reviewlist'] = array();

                    }

                    if ($cmsData['review_type'] == 0) {

                        $reviews = $this->cms_model->get_list_of_reviews();

                        $cdata['reviewlist'] = $reviews;

                    }

                    $data['content'] = $this->load->view('admin/cms_pages/edit', $cdata, TRUE);

                    $this->load->view('admin/layouts/index', $data);

                } else {

                    set_alert('error', 'Records not found');

                    redirect(admin_url("cms-pages"));

                    exit;

                }

            }

        } else {

            redirect(admin_url("cms-pages"));

            exit;

        }

    }



    public function get_reviews()

    {

        if ($this->input->post()) {



            $tour_id = $this->input->post('tour_id');



            if (is_array($tour_id) && sizeof($tour_id) > 0) {

                $review_list = '<option value="">Select Review</option>';

                foreach ($tour_id as $t) {

                    $get_reviewlist = $this->reviews->get_many_by(array('tour_id' => $t));

                    //print_r($get_reviewlist);

                    if (is_array($get_reviewlist) && sizeof($get_reviewlist) > 0) {

                        foreach ($get_reviewlist as $key => $value) {

                            if ($value['id']) {

                                $review_list .= '<option value="' . $value['id'] . '">' . $value['title'] . '</option>';

                            }

                        }

                    }

                }

                $response['success'] = true;

                $response['msg'] = "";

                $response['review_list'] = $review_list;

                // } else {

                //     $response['success']=false;

                //     $response['msg']="Something went wrong";

                // }

            } else {

                $response['success'] = false;

                $response['msg'] = "Something went wrong";

            }

            echo json_encode($response);

            exit;

        } else {

            redirect(admin_url('cms-pages'));

            exit;

        }

    }



    public function delete_attachment()

    {



        $cms_page_id = base64_decode($this->input->post('cms_page_id'));



        if ($cms_page_id) {

            $data = $this->cms_model->get_by(array('id' => $cms_page_id));

            if (is_array($data) && sizeof($data) > 0) {



                $upd_data = array("promo_file" => "");

                $update = $this->cms_model->update_by(array("id" => $cms_page_id), $upd_data);

                if ($update) {

                    if ($data['promo_file'] != '') {

                        if (file_exists('uploads/promo_file/' . $data['promo_file'])) {

                            $deleteimg = 'uploads/promo_file/' . $data['promo_file'];

                            unlink($deleteimg);

                        }

                    }

                    $response['success'] = true;

                    $response['msg'] = _l('_deleted_successfully', "Promo file");

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



    public function add_duplicate()

    {

        if ($this->input->post()) {

            $cms_page_id = $this->input->post('cms_page_id');

            $cms_parent_id = $this->input->post('cms_parent_id');

            if ($cms_page_id != '' && $cms_parent_id != '') {

                $get_page_content = $this->cms_model->get_by(array('id' => $cms_page_id));

                if (is_array($get_page_content) && sizeof($get_page_content) > 0) {



                    $total_duplicates = $this->cms_model->count_by(array('parent_id' => $cms_page_id));

                    $copy_name = $get_page_content['page_title'];

                    if ($total_duplicates) {

                        $copy_name = "copy_" . ($total_duplicates + 1) . ' ' . $get_page_content['page_title'];

                    } else {

                        $copy_name = "copy_1" . ' ' . $get_page_content['page_title'];

                    }

                    // $copy_id=1;

                    // if ($get_page_content['copy_ids']) {

                    //     if(is_array(@unserialize($get_page_content['copy_ids']))) {



                    //         $r=@unserialize($get_page_content['copy_ids']);

                    //         for ($i=1; $i <= (sizeof($r)+1); $i++) { 

                    //             if(!array_key_exists((string)$i, $r)) {

                    //                 $copy_id=$i;

                    //                 break;

                    //             }

                    //         }



                    //         $copy_name="copy_".$copy_id." ".$get_page_content['page_title']; 

                    //     } else {

                    //         $copy_name="copy_1 ".$get_page_content['page_title']; 

                    //     }                                                      

                    // } else {

                    //     $copy_name="copy_1 ".$get_page_content['page_title'];                        

                    // } 

                    if (strlen($copy_name) > 150) {

                        $duplicate_name = substr($copy_name, 0, 150);

                    } else {

                        $duplicate_name = $copy_name;

                    }

                    $data = array(

                        "page_title" => $duplicate_name,

                        "slug" => slugify($duplicate_name),

                        "promo_url" => $get_page_content['promo_url'],

                        "tour_id" => $get_page_content['tour_id'],

                        "review_ids" => $get_page_content['review_ids'],

                        "parent_id" => $cms_page_id,

                        "status" => 0

                    );

                    if ($get_page_content['promo_file']) {

                        $imagePath = FCPATH . "/uploads/promo_file/" . $get_page_content['promo_file'];

                        $newPath = FCPATH . "/uploads/promo_file/";

                        $ext = pathinfo($get_page_content['promo_file'], PATHINFO_EXTENSION);

                        $file_name = pathinfo($get_page_content['promo_file'], PATHINFO_FILENAME) . '-' . time() . '.' . $ext;

                        $newName  = $newPath . $file_name;



                        $copied = copy($imagePath, $newName);



                        if ($copied) {

                            $data['promo_file'] = $file_name;

                        }

                    }



                    $insert_id = $this->cms_model->insert($data);



                    if ($insert_id) {

                        $get_static_content = $this->cms_static_model->get_many_by(array("page_id" => $cms_page_id));

                        if (is_array($get_static_content) && sizeof($get_static_content) > 0) {

                            foreach ($get_static_content as $key => $value) {

                                if ($value['s_title']) {

                                    $data = array('page_id' => $insert_id, 's_title' => $value['s_title'], 's_description' => $value['s_description']);

                                    $this->cms_static_model->insert($data);

                                }

                            }

                        }



                        // if($get_page_content['copy_ids']) {

                        //     if(is_array(@unserialize($get_page_content['copy_ids']))) {

                        //         $r=@unserialize($get_page_content['copy_ids']);

                        //         $r[$copy_id]=$insert_id;



                        //         $data_array=array('copy_ids'=>serialize($r));

                        //         $update=$this->cms_model->update_by(array("id"=>$cms_page_id), $data_array);

                        //     } else {

                        //         $data_array=array('copy_ids'=>serialize(array($copy_id=>$insert_id)));

                        //         $update=$this->cms_model->update_by(array("id"=>$cms_page_id), $data_array);

                        //     }

                        // } else {

                        //     $data_array=array('copy_ids'=>serialize(array($copy_id=>$insert_id)));

                        //     $update=$this->cms_model->update_by(array("id"=>$cms_page_id), $data_array);

                        // } 

                        $response['success'] = true;

                        $response['alert_msg'] = _l('_added_successfully', _l('cms_page'));

                    } else {

                        $response['success'] = false;

                        $response['msg'] = "Something went wrong!";

                    }

                } else {

                    $response['success'] = false;

                    $response['msg'] = "Something went wrong!";

                }

            } else {

                $response['success'] = false;

                $response['msg'] = "Something went wrong!";

            }

            echo json_encode($response);

            exit;

        } else {

            redirect(admin_url("cms-pages"));

            exit;

        }

    }

    public function get_review_list()

    {

        $reviews = $this->cms_model->get_list_of_reviews();

        $response['success'] = false;

        $response['data'] = '';

        if ($reviews) {

            $response['success'] = true;

            $response['data'] = $reviews;

        }

        echo json_encode($response);

    }

}

