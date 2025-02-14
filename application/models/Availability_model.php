<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Availability_model extends MY_Model
{

    protected $_table = TBL_AVAILABILITY_CALENDAR;

    /**

           * Constructor for the class

           */

    public function __construct()
    {

        parent::__construct();

        $this->calendar = TBL_AVAILABILITY_CALENDAR;
        $this->rate = TBL_AVAILABILITY_RATE;

    }

    public function get_availability_dates($month, $year, $status)
    {


        // Get the first and last day of the selected month
        $date = "{$year}-{$month}-01";
        // var_dump($date);die;
        // Query the database for all availability dates within the selected month
        $this->db->where('date >=', $date);
        $this->db->where('status =', $status);
        $query = $this->db->get($this->calendar);

        $availabilityDates = [];
        foreach ($query->result_array() as $row) {
            // Add each availability date to the array (you can format this as needed)
            $availabilityDates[] = $row['date'];
        }

        // Return the available dates in a JSON format
        return json_encode($availabilityDates);
    }

    public function get_dates($month, $year)
    {
        $month = str_pad($month, 2, "0", STR_PAD_LEFT); // Add leading zero if month is single digit
        $date = "{$year}-{$month}-01";
        $dateEnd = date("Y-m-t", strtotime($date)); // Last day of the month
    
        $this->db->select('date, status'); // Select date and status
        $this->db->from($this->calendar);
    
        // Filter by the month and year range
        $this->db->where('date >=', $date);
        $this->db->where('date <=', $dateEnd);
    
            // Retrieve all statuses (1: booked, 2: optioned) for comparison
            $this->db->where_in('status', [1, 2]);
            $query = $this->db->get();
            $datesWithStatus = $query->result_array(); // Array of dates and statuses
    
            // Organize the dates by status
            $bookedDates = [];
            $optionedDates = [];
    
            foreach ($datesWithStatus as $entry) {
                if ($entry['status'] == 1) {
                    $bookedDates[] = $entry['date'];
                } elseif ($entry['status'] == 2) {
                    $optionedDates[] = $entry['date'];
                }
            }
    
            // Generate all dates in the month
            $allMonthDates = [];
            $currentDate = strtotime($date);
    
            while ($currentDate <= strtotime($dateEnd)) {
                $allMonthDates[] = date("Y-m-d", $currentDate);
                $currentDate = strtotime("+1 day", $currentDate);
            }
    
            // Calculate available dates by removing booked and optioned dates
            $busyDates = array_merge($bookedDates, $optionedDates);
            $availableDates = array_diff($allMonthDates, $busyDates);
            $availableDates = array_values($availableDates);
    
            // Return the results categorized by status
            return [
                'booked' => $bookedDates,
                'optioned' => $optionedDates,
                'available' => $availableDates
            ];
    }
    
    public function insert_rates_details($data, $id = null)
    {
        // Check if an ID is provided and fetch the existing entry
        if ($id !== null) {
            $existing_entry = $this->db->get_where($this->rate, ['id' => $id])->row();
            if ($existing_entry) {
                // Update if entry exists
                $this->db->where('id', $id);
                $updated = $this->db->update($this->rate, $data);

                if ($updated) {
                    return true; // Return true on successful update
                } else {
                    return false; // Return false if update fails
                }
            }
        }
        // Insert if entry doesn't exist
        $inserted = $this->db->insert($this->rate, $data);
        return $inserted ? true : false; // Return true if insert is successful, otherwise false
    }

    public function get_rates($postData)
    {
        // var_dump($postData);die;
        $this->db->select('id,from_date,to_date,price');
        $this->db->where(['is_deleted' => 0]);
        $this->db->from($this->rate);

       // Apply filters, pagination, and sorting
        if (!empty($postData['search']['value'])) {
            $searchValue = $postData['search']['value'];
            $this->db->group_start() // Group the conditions for better handling
                ->like('from_date', $searchValue)
                ->or_like('to_date', $searchValue)
                ->or_like('price', $searchValue)
                ->group_end();
        }


        if (!empty($postData['order'])) {
            $columnIndex = $postData['order'][0]['column'];
            $columnName = $postData['columns'][$columnIndex]['data'];
            $sortDirection = $postData['order'][0]['dir'];
            $this->db->order_by($columnName, $sortDirection);
        } 
        // Total records
        $totalRecords = $this->db->count_all_results('', false);

        // Limit and offset for pagination
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }

        $query = $this->db->get();
        $data = $query->result_array();
        // var_dump($data);die;
        return [
            "draw" => $_POST['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
        ];
    }

    public function get_rate_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->rate); // Replace with your actual table name

        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return the row as an associative array
        } else {
            return false;
        }
    }

    public function get_availability_rates() {
        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');
        $currentDate = date('Y-m-d');  // Current date in 'Y-m-d' format
    
        // Query to fetch from_date, to_date, and price for records up to the current month and year
        $this->db->select([
            "DATE_FORMAT(from_date, '%M %d, %Y') AS formatted_from_date",  // Full month name
            "DATE_FORMAT(to_date, '%M %d, %Y') AS formatted_to_date",
            "price"
        ]);
        $this->db->from('availability_rates');  // Replace with your actual table name
        $this->db->where('is_deleted', 0);  // Exclude deleted records
    
        // Ensure that from_date is up to the current month or the to_date extends beyond current date
        $this->db->group_start();  // Start a grouped condition
        // $this->db->where("YEAR(from_date) = ", $currentYear);  // Only consider records from the current year
        // $this->db->where("MONTH(from_date) <= ", $currentMonth);  // Only consider records from current or earlier months
        // $this->db->or_where("YEAR(to_date) = ", $currentYear);  // Ensure to_date is within the current year
        // $this->db->where("MONTH(to_date) >= ", $currentMonth);  // Ensure to_date is from current month or later
        $this->db->where("to_date >= ", $currentDate);  // Ensure to_date is today or in the future
        // $this->db->where("from_date <= ", $currentDate);  // Ensure to_date is today or in the future
        $this->db->group_end();  // End the grouped condition
        $this->db->order_by("from_date", "ASC");
        // Execute the query
        $query = $this->db->get();

        // Return the results
        return $query->result_array();
    }
    
    
    
}

?>