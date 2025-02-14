<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("pagination");
        $this->load->model('frontend/Search_model', 'search');
        // $this->load->model('frontend/common_model', 'common');
    }
    public function search_tour()
    {
        $tour_name = $this->input->post('tour_name');
        if (!$tour_name) {
            return false;
        }
        $data['tours'] = $this->search->get_tours_by_name($tour_name, true);
        $data['tour_name'] = $tour_name;
        $data['total_tours'] = count($this->search->get_tours_by_name($tour_name));
        $result = $this->load->view('frontpages/load_tour_search_result', $data, TRUE);
        echo $result;
    }
    public function search_tour_list($search_term)
    {
        // allow only when more than two charcaters of search
        // var_dump(strlen($search_term));
        // die;
        // if ((int)strlen($search_term) < 3) {
        // redirect("");
        // echo 'hello';
        // }
        // echo 'else';
        // die;
        $count = $this->search->get_tours_by_name($search_term);
        $config = array();
        $config["base_url"] = base_url() . "search-tour/" . $search_term;
        $config["total_rows"] = count($count);
        $config["per_page"] = 6;
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
        // echo '$page ; ' . $config["per_page"];
        // die;
        $data['tours'] = $this->search->get_tour_list_by_name($search_term, $config["per_page"], $page);
        $data['title'] = 'Search | ' . $search_term;
        $data['meta_description'] = 'Search result for ' . $search_term;
        $data['meta_keyword'] = 'Driverinrome | search tour';
        $data['header_banner'] = 'no';
        $data['search_term'] = $search_term;
        $data['total_tours'] = $config["total_rows"];
        $this->load->frontpage('frontpages', 'search_tour_list', $data);
    }
}
