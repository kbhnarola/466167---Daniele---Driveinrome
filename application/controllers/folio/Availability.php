<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Availability extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Umbriavilla_model', 'umbriavilla_model');
        $this->load->model('Availability_model', 'availability_model');
        $this->load->helper(['form', 'url']);
        $this->load->library('upload');

    }

    public function index()
    {
        if ($_POST) {
            // var_dump($_POST);die;
            // Load form validation library
            $this->load->library('form_validation');
            $this->load->library('upload');

            // Set form validation rules
            $this->form_validation->set_rules('availability_title', 'Availability Title', 'required');
            $this->form_validation->set_rules('availability_description', 'Availability Description', 'required');

            if ($this->form_validation->run() === TRUE) {
                $post_data = $this->input->post();

                // Prepare data for insertion
                $data = [
                    'availability_details' => $post_data,
                ];
                // Save data to database
                $result = $this->umbriavilla_model->insert_umbriavilla_details($data);

                if ($result) {
                    // Set success message
                    $response = ['status' => 'success', 'message' => 'Availability Details added successfully!'];
                } else {
                    // Set error message
                    $response = ['status' => 'error', 'message' => 'Failed to add Availability Details.'];
                }

            } else {
                // Validation failed
                $response = ['status' => 'error', 'message' => validation_errors()];
            }

            // Send JSON response for AJAX
            echo json_encode($response);
            exit;
        } else {
            $this->set_page_title('Availability Details');
            $result = $this->umbriavilla_model->get_umbriavilla_details('availability_details');
            if ($result) {
                $data['availability_details'] = $result;
            } else {
                $data['availability_details'] = array();
            }
            $data['content'] = $this->load->view('admin/availability_details/index', $data, TRUE);
            $this->load->view('admin/layouts/index', $data);
        }
    }

    public function availability_calendar()
    {
        // Get the booking option and the start and end dates
        $option = $this->input->post('option');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');

        // Convert the dates to timestamps for comparison and iteration
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);

        // If start date and end date are the same, save that date directly
        if ($startTimestamp === $endTimestamp) {
            $currentDate = date('Y-m-d', $startTimestamp);
            if ($this->check_date_exists($currentDate)) {
                // If the date exists, update the option
                $this->update_option($currentDate, $option);
            } else {
                // If the date does not exist, insert a new record
                $this->save_date($currentDate, $option);
            }
        } else {
            // If the dates are different, loop from start date to end date
            while ($startTimestamp <= $endTimestamp) {
                // Format the current date
                $currentDate = date('Y-m-d', $startTimestamp);

                // Check if the date already exists in the database
                if ($this->check_date_exists($currentDate)) {
                    // If the date exists, update the option
                    $this->update_option($currentDate, $option);
                } else {
                    // If the date does not exist, insert a new record
                    $this->save_date($currentDate, $option);
                }

                // Increment to the next day
                $startTimestamp = strtotime('+1 day', $startTimestamp);
            }
        }
        // Return a response
        echo json_encode(['status' => 'success', 'message' => 'Availability Calender Details added successfully!']);
        exit;
    }

    // Function to check if the date already exists in the database
    private function check_date_exists($date)
    {
        $query = $this->db->get_where('availability_calendar', ['date' => $date]);
        return $query->num_rows() > 0;
    }

    // Function to save the date in the database
    private function save_date($date, $option)
    {
        $data = [
            'status' => $option,
            'date' => $date,
        ];
        $this->db->insert('availability_calendar', $data);
    }

    // Function to update the option for an existing date
    private function update_option($date, $option)
    {
        if ($option == 3) {
            $this->db->delete('availability_calendar', ['date' => $date]);
        } else {
            $this->db->where('date', $date);
            $this->db->update('availability_calendar', ['status' => $option]);
        }
    }

    public function get_availability_dates()
    {
        $month = $this->input->get('month') ? str_pad($this->input->get('month'), 2, '0', STR_PAD_LEFT) : date('m');

        $year = $this->input->get('year') ? $this->input->get('year') : date('Y');
        $result['booked'] = $this->availability_model->get_availability_dates($month, $year, 1); // 1 for booked
        $result['optioned'] = $this->availability_model->get_availability_dates($month, $year, 2); // 2 for optioned
        echo json_encode($result);
        exit;
    }

    public function availability_rates()
    {

        if ($_POST) {
            // Load form validation library
            $this->load->library('form_validation');

            // Set form validation rules
            $this->form_validation->set_rules('from_date', 'From Date', 'required');
            $this->form_validation->set_rules('to_date', 'To Date', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');
            
            if ($this->form_validation->run() === TRUE) {
                $post_data = $this->input->post();

                // var_dump($this->input->post('from_date') > $this->input->post('to_date'));die;
                if($this->input->post('from_date') > $this->input->post('to_date')){
                    $response = ['status' => 'error', 'message' => 'To date should be greater than from date.'];
                    echo json_encode($response);
                    exit;
                }

                // Save data to database
                if ($this->input->post('id')) {
                    $result = $this->availability_model->insert_rates_details($post_data, $this->input->post('id'));
                } else {
                    $result = $this->availability_model->insert_rates_details($post_data);
                }

                if ($result) {
                    // Set success message
                    $response = ['status' => 'success', 'message' => 'Rates added successfully!'];
                } else {
                    // Set error message
                    $response = ['status' => 'error', 'message' => 'Failed to add Rates.'];
                }

            } else {
                // Validation failed
                $response = ['status' => 'error', 'message' => validation_errors()];
            }

            // Send JSON response for AJAX
            echo json_encode($response);
            exit;
        } else {
            $this->set_page_title('Availability Rates');
            $this->load->view('admin/availability_details/availability_rates');
        }
    }


    public function get_rates_list()
	{
		$result = $this->availability_model->get_rates($_POST);
		echo json_encode($result);
		exit;
	}

    public function get_rates_details()
	{
		$id = $this->input->post('id');


		// Fetch the details from the model
		$faq = $this->availability_model->get_rate_by_id($id);
		if ($faq) {
			echo json_encode([
				'status' => 'success',
				'data' => $faq
			]);
			exit;
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'FAQ not found.'
			]);
			exit;
		}
	}

    public function delete_rates()
	{
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$updated = $this->db->update('availability_rates', ['is_deleted' => 1]);

		if ($updated) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Rates Deleted Successfully'
			]);
			exit; // Return true on successful update
		} else {
			echo json_encode([
				'status' => 'success',
				'message' => 'Failed to Deleted Rates'
			]);
			exit;
		}
	}
    
}

