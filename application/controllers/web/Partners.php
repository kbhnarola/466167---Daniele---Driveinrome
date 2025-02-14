<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Partners extends Frontend_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/partners_model', 'partners');
        $this->load->model('Cms_model', 'cms_model');
    }

    public function index()
    {
        $data['title'] = 'Partners';
        $data['title'] = "Shared tour for partners";
        $data['meta_keyword'] = "shared tour, partners, tour";
        $data['meta_description'] = "List of shared tour for partners";
        $data['header_banner'] = 'no';
        $data['partner_password'] = get_settings('partners_password');
        $data['shared_tour_variables'] = $this->partners->get_shared_tour_variable();
        $this->load->frontpage('frontpages', 'partners', $data);
    }

    public function search_shared_tour($page_no = 0, $order_by = 'desc', $row_per_page = 12)
    {
        $city_id = trim($this->input->post('city_id'));
        $tour_id = trim($this->input->post('tour_id'));
        $date = ($this->input->post('date')) ? date('Y-m-d', strtotime(trim($this->input->post('date')))) : '';
        $get_page = 0;
        if ($page_no == 0) {
            $get_page = $page_no + 1;
        } else {
            $get_page = $page_no;
        }
        // Row position
        if ($page_no != 0) {
            $page_no = ($page_no - 1) * $row_per_page;
        }
        $filter_array = array(
            'city_id' => $city_id,
            'tour_id' => $tour_id,
            'date' => $date,
            'page_no' => $page_no,
            'order_by' => $order_by,
            'row_per_page' => $row_per_page
        );
        $cdata['search_shared_tour_list'] = $this->partners->get_search_shared_tour($filter_array);
        // custom pagination
        $base_url = base_url('partners');
        $use_page_numbers = TRUE;
        $total_rows = $this->partners->get_search_shared_tour($filter_array, 1);
        $record_count = isset($total_rows[0]['all_count']) ? $total_rows[0]['all_count'] : 0;
        $uri_segment = 2;
        $custom_pagination = custom_pagination($base_url, $use_page_numbers, $record_count, $row_per_page, $uri_segment);
        $cdata['pagination'] = $custom_pagination;
        $data['html'] = $this->load->view('frontpages/list_of_search_shared_tour', $cdata, TRUE);
        echo json_encode($data);
    }

    public function shared_tour_variable()
    {
        if (!$this->input->post('tour_id'))
            return false;

        $tour_id = $this->input->post('tour_id');
        $shared_tour_variable = $this->partners->get_shared_tour_variable(array('shared_tour_city_id' => $tour_id));
        $output = array('msg' => 'Something went wrong', 'data' => '');
        if ($shared_tour_variable) {
            $output = array('msg' => 'Success!', 'data' => $shared_tour_variable);
        }
        echo json_encode($output);
        exit;
    }
}
