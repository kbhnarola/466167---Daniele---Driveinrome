<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transfers_old extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->library('cart');
        // $this->load->model('Common_model', 'common');
        $this->load->model('frontend/transfers_model', 'transfers');
    }

    public function add_to_cart_transfer()
    {

        $data_id = $_POST['data_id'];
        $data_code = $_POST['data_code'];
        $data_variaton = $_POST['data_variaton'];
        $return_arr = array();
        $transfer_variation_title = '';
        // $get_variation_prices_for_transfer = get_variation_prices_for_transfers($data_id, array($data_variaton), 1);
        $get_transfer_details = get_single_transfers_all_details_by_id($data_id, array(1));
        // pr($get_transfer_details);die;
        if (!empty($get_transfer_details['id'])) {

            $variation_prices = $get_transfer_details['transfer_price'];
            $variation_title = $get_transfer_details['variation_title'];

            $variation_prices_array = explode(", ", $variation_prices);
            $variation_title_array = explode(", ", $variation_title);

            switch ($data_variaton) {
                case 2:
                    // $transfer_variation_title = '4-5 person';
                    $transfer_variation_title = $variation_title_array['1'];
                    $transfer_variation_price = $variation_prices_array['1'];
                    break;
                case 3:
                    // $transfer_variation_title = '6-8 person';
                    $transfer_variation_title = $variation_title_array['2'];
                    $transfer_variation_price = $variation_prices_array['2'];
                    break;
                default:
                    // $transfer_variation_title = '1-3 person';
                    $transfer_variation_title = $variation_title_array['0'];
                    $transfer_variation_price = $variation_prices_array['0'];
            }
            $data = array(
                'id'      => $data_id,
                'qty'     => 1,
                'price'   => $transfer_variation_price,
                'name'    => $get_transfer_details['title'],
                'options' => array('transfer_variation_id' => $data_variaton, 'transfer_variation_title' => $transfer_variation_title),
                'transfer_detail_data' => array('title' => $get_transfer_details['title'], 'transfer_id' => $data_id, 'unique_code' => $get_transfer_details['unique_code'], 'duration' => $get_transfer_details['duration'], 'city' => $get_transfer_details['city'], 'transfer_slug' => $get_transfer_details['transfer_slug'], 'feature_image' => $get_transfer_details['feature_image'], 'transfer_variation_prices' =>  $variation_prices_array)
            );

            // check product is already exist in cart
            $is_exist = 'no';
            foreach ($this->cart->contents() as $product) {
                // pr();
                if (!array_key_exists("tours_detail_data", $product)) {
                    if ($product['options']['transfer_variation_id'] == $data_variaton && $product['id'] == $data_id) {
                        $is_exist = 'yes';
                    }
                }
            }
            if ($is_exist == 'no') {
                $this->cart->product_name_rules = '[:print:]';
                if ($this->cart->insert($data)) {
                    $return_arr[] = array(
                        "produdt_title" => $get_transfer_details['title'],
                        "variation_title" => $transfer_variation_title,
                        "is_exist" => $is_exist
                    );
                    echo json_encode($return_arr);
                } else {
                    echo json_encode($return_arr);
                }
            } else {
                $return_arr[] = array(
                    "produdt_title" => $get_transfer_details['title'],
                    "variation_title" => $transfer_variation_title,
                    "is_exist" => $is_exist
                );
                echo json_encode($return_arr);
            }
        } else {
            echo json_encode($return_arr);
        }
    }
    public function send_me_transfer_quote()
    {
        $data['transfer_name'] = $this->input->post('transfer_name');
        $data['transfer_price'] = $this->input->post('transfer_price');
        $data['total_person'] = $this->input->post('total_person');
        $data['breadcrumb_title'] = $this->input->post('breadcrumb_title');
        $data['featured'] = $this->input->post('featured');
        $data['for_transfer'] = true;

        $get_transfer_details = get_single_transfers_all_details_by_id(base64_decode($this->input->post('transfer_md')), array(1));

        $data['transfer_email_description'] = $get_transfer_details['transfer_email_description'];

        $this->session->set_userdata('quote_data_for_transfer', $data);
        redirect('get_transfer_quote');
    }
    public function get_transfer_quote()
    {
        if ($this->session->userdata('quote_data_for_transfer')) {

            $data['title'] = 'Transfer | Request Quote';
            $this->load->frontpage('frontpages', 'request_quote_for_transfer', $data);
        } else {
            set_alert('error', _l('something_wrong'));
            redirect('');
        }
    }
    public function submit_quote_request_for_transfer()
    {

        $username = ucwords(trim($this->input->post('user_name')));
        $user_email = $this->input->post('user_email');
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required');
        $this->form_validation->set_rules('user_confirm_email', 'Confirm Email', 'trim|required|matches[user_email]');
        if ($this->form_validation->run() == FALSE) {
            $response['success'] = false;
            $response['msg'] = "All fields are required";
            echo json_encode($response);
            exit;
        } else {
            $transferData = $this->session->userdata('quote_data_for_transfer');
            $email_subject = 'Driver In Rome';
            $email_template_name = '';
            $email_template_name_admin = '';
            $get_email_template = get_email_template('get-quote-for-transfer');

            $placeholder = ['{username}', '{passenger}', '{transfer_name}', '{transfer_rate}', '{email_description}', '{welcome_image}'];
            $form_data   = [$username, $transferData['total_person'], $transferData['transfer_name'], '€ ' . $transferData['transfer_price'], $transferData['transfer_email_description'], EMAIL_WELCOME_PNG];

            $email_template_name = 'get-quote-for-transfer';
            // $tour_rate='€ '.$transferData['total_rate'];		

            $get_email_template_admin = get_email_template('get-quote-admin-for-transfer');
            $placeholder_admin = ['{username}', '{passenger}', '{transfer_name}', '{transfer_rate}', '{email}', '{welcome_image}'];
            $form_data_admin   = [$username, $transferData['total_person'], $transferData['transfer_name'], '€ ' . $transferData['transfer_price'], $user_email, EMAIL_WELCOME_PNG];
            $email_template_name_admin = 'get-quote-admin-for-transfer';

            $get_email_body = (!empty($get_email_template['message'])) ? $get_email_template['message'] : '';
            $get_email_body_admin = (!empty($get_email_template_admin['message'])) ? $get_email_template_admin['message'] : '';

            if (!empty($get_email_template['subject'])) {
                $email_subject = $get_email_template['subject'];
            }
            if (!empty($get_email_template_admin['subject'])) {
                $email_subject_admin = $get_email_template_admin['subject'];
            }

            $get_new_email_body = str_replace($placeholder, $form_data, $get_email_body);
            $get_admin_email_body = str_replace($placeholder_admin, $form_data_admin, $get_email_body_admin);

            $data['email_body'] = $get_new_email_body;
            $data['subject'] = $email_subject;

            if (email_sending($user_email, $data, $email_template_name)) {

                $data_admin['email_body'] = $get_admin_email_body;
                $data_admin['subject'] = $email_subject_admin;
                email_sending($to = '', $data_admin, $email_template_name_admin);

                $response['success'] = true;
                $this->session->unset_userdata('quote_data_for_transfer');
            } else {
                $response['success'] = false;
                $response['msg'] = 'Getting error while sending email, please try again later!';
            }
            echo json_encode($response);
            exit;
        }
    }
}
