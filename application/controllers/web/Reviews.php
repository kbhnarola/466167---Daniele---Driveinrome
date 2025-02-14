<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reviews extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->helper('file');
        $this->load->library("pagination");
        // $this->load->model('Common_model', 'common');
        $this->load->model('Review_model', 'reviews');
        $this->load->model('Review_gallery_images', 'review_gallery');
    }

    public function index()
    {
        $data['title'] = 'Tour Reviews';

        //$data['reviews']=$this->reviews->get_many_by(array("is_draft"=>0));
        // $data['reviews']=$this->reviews->get_all_reviews();
        // $data['header_banner'] = 'no';
        // $this->load->frontpage('frontpages', 'reviews', $data);

        $tour_slug = strtolower(trim($this->uri->segment(2)));
        if ($tour_slug) {
            $get_tour_id = $this->reviews->get_tour_title($tour_slug);

            if (is_array($get_tour_id) && sizeof($get_tour_id) > 0) {

                $data['tour_title'] = $get_tour_id['title'];
                $count = $this->reviews->count_by(array('tour_id' => $get_tour_id['id'], "is_draft" => 0));
                $config = array();
                $config["base_url"] = base_url() . "reviews/" . $tour_slug;
                $config["total_rows"] = $count;
                $config["per_page"] = 10;
                $config["uri_segment"] = 3;
                $config['full_tag_open'] = '<ul class="custom-pagination pagination">';
                $config['full_tag_close'] = '</ul>';
                $config['attributes'] = ['class' => 'page-link'];
                $config['first_link'] = false;
                $config['last_link'] = false;
                $config['first_tag_open'] = '<li class="page-item">';
                $config['first_tag_close'] = '</li>';
                //$config['prev_link'] = '&laquo';
                $config['prev_link'] = '<i class="fal fa-long-arrow-left"></i>';
                $config['prev_tag_open'] = '<li class="page-item">';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = '<i class="fal fa-long-arrow-right"></i>';
                //$config['next_link'] = '&raquo';

                $config['next_tag_open'] = '<li class="page-item">';
                $config['next_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li class="page-item">';
                $config['last_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="page-item active"><a href="javascript:" class="page-link">';
                $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
                $config['num_tag_open'] = '<li class="page-item">';
                $config['num_tag_close'] = '</li>';

                $this->pagination->initialize($config);

                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $where = array("tour_id" => $get_tour_id['id'], "is_draft" => 0);
                $data["reviews"] = $this->reviews->get_all_tour_review($where, $config["per_page"], $page);
                //$data["links"] = $this->pagination->create_links();
                //$data['reviews']=$this->reviews->get_all_tour_review();

                $data['header_banner'] = 'no';
                $this->load->frontpage('frontpages', 'tour_reviews', $data);
            } else {
                set_alert('error', "Records Not Found");
                redirect('reviews');
            }
        } else {
            redirect("");
        }
    }

    public function get_review_details()
    {
        $data['title'] = 'Tour Reviews Details';
        $review_slug = strtolower(trim($this->uri->segment(3)));
        $reviews = $this->reviews->get_by(array("slug" => $review_slug, "is_draft" => 0));
        //$data['reviews']=$this->reviews->get_all_reviews();
        if (is_array($reviews) && sizeof($reviews) > 0) {
            $tour_slug = strtolower(trim($this->uri->segment(2)));

            //$data['get_current_review_id']=$this->reviews->get_review_id($review_slug);

            $tour_title = $this->reviews->get_tour_title($tour_slug);
            if (is_array($tour_title) && sizeof($tour_title) > 0) {
                if ($tour_title['id'] != $reviews['tour_id']) {
                    set_alert('error', "Records Not Found");
                    redirect('reviews');
                }
            }
            $data['get_previous_review'] = $this->reviews->get_previous_review($reviews['id'], $tour_title['id']);
            $data['get_next_review'] = $this->reviews->get_next_review($reviews['id'], $tour_title['id']);
            $data['tour_title'] = $tour_title;
            $data['reviews'] = $reviews;
            $data['review_gallery'] = $this->review_gallery->get_many_by(array("review_id" => $reviews['id']));
            $data['header_banner'] = 'no';
            $this->load->frontpage('frontpages', 'single_review', $data);
        } else {
            set_alert('error', "Records Not Found");
            redirect('reviews');
        }
    }
    public function wheelchair_reviews()
    {
        $landing_page_slug = strtolower(trim($this->uri->segment(2)));
        if ($landing_page_slug) {
            $landing_page = $this->reviews->get_landing_page_title(array('slug' => $landing_page_slug, 'tour_id' => '', 'status' => 1));
            if (is_array($landing_page) && sizeof($landing_page) > 0) {
                // $count = $this->reviews->count_by(array('tour_id' => $get_tour_id['id'], "is_draft" => 0));
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $where = array("tour_id" => '', "is_draft" => 0);
                $data['title'] = $landing_page['page_title'] . ' Reviews';
                $data['landing_page_title'] = $landing_page['page_title'];
                $data["total"] = $this->reviews->get_all_landing_page_review($where, '', '');

                $data['header_banner'] = 'no';
                $data['landing_page_slug'] = $landing_page_slug;
                $config = array();
                $config["per_page"] = 2;
                $config["base_url"] = base_url() . "page/" . $landing_page_slug . '/reviews';
                $config["total_rows"] = count($data["total"]);
                $config["uri_segment"] = 4;
                $config['full_tag_open'] = '<ul class="custom-pagination pagination">';
                $config['full_tag_close'] = '</ul>';
                $config['attributes'] = ['class' => 'page-link'];
                $config['first_link'] = false;
                $config['last_link'] = false;
                $config['first_tag_open'] = '<li class="page-item">';
                $config['first_tag_close'] = '</li>';
                //$config['prev_link'] = '&laquo';
                $config['prev_link'] = '<i class="fal fa-long-arrow-left"></i>';
                $config['prev_tag_open'] = '<li class="page-item">';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = '<i class="fal fa-long-arrow-right"></i>';
                //$config['next_link'] = '&raquo';

                $config['next_tag_open'] = '<li class="page-item">';
                $config['next_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li class="page-item">';
                $config['last_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="page-item active"><a href="javascript:" class="page-link">';
                $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
                $config['num_tag_open'] = '<li class="page-item">';
                $config['num_tag_close'] = '</li>';

                $this->pagination->initialize($config);
                $data["reviews"] = $this->reviews->get_all_landing_page_review($where, $config["per_page"], $page);
                $this->load->frontpage('frontpages', 'landing_page_reviews', $data);
            } else {
                set_alert('error', "Records Not Found");
                redirect('reviews');
            }
        } else {
            redirect("");
        }
    }
    public function review_details()
    {
        $data['title'] = 'Landing Page Reviews Details';
        $review_slug = strtolower(trim($this->uri->segment(4)));
        $reviews = $this->reviews->get_by(array("slug" => $review_slug, "is_draft" => 0, "tour_id" => ''));
        //$data['reviews']=$this->reviews->get_all_reviews();
        if (is_array($reviews) && sizeof($reviews) > 0) {
            $landing_page_slug = $review_slug;
            //$data['get_current_review_id']=$this->reviews->get_review_id($review_slug);
            $data['get_previous_review'] = $this->reviews->get_previous_landing_page_review($reviews['id']);
            $data['get_next_review'] = $this->reviews->get_next_landing_page_review($reviews['id']);
            $data['tour_title'] = '';
            $data['title'] = ucwords(str_replace("-", " ", $review_slug));
            $data['reviews'] = $reviews;
            $data['review_gallery'] = $this->review_gallery->get_many_by(array("review_id" => $reviews['id']));
            $data['header_banner'] = 'no';
            $this->load->frontpage('frontpages', 'single_landing_page_review', $data);
        } else {
            set_alert('error', "Records Not Found");
            redirect('reviews');
        }
    }
}
