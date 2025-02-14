<?php


defined('BASEPATH') OR exit('No direct script access allowed');





class Bookings extends Admin_Controller


{


	/**


	 * Constructor for the class


	 */


	public function __construct()


	{


		parent::__construct();





		$this->load->model('Booking_model', 'booking');


	}





	/**


	 * Loads the list of Bookings.


	 */


	public function index()


	{


		$this->set_page_title(_l('booking'));





		// $this->booking->order_by('created_at', 'DESC');


		// $data['booking']  = $this->booking->get_all();


		$data['content'] = $this->load->view('admin/booking/index', '', TRUE);


		$this->load->view('admin/layouts/index', $data);


    }


    


    public function getLists()


    {


        $data = $row = array();





        // Fetch Booking list


        $memData = $this->booking->getRows($_POST);


        // pr($memData);die;


        $i = $_POST['start'];


        $j=0;


        foreach($memData as $booking){         


            


            $data[$j]['RecordID']=$i+1;


            $data[$j]['username'] = $booking->name;


            $data[$j]['email'] = $booking->email;            


            $data[$j]['phone_number'] = $booking->phone_number;            


            $data[$j]['tour_name'] = $booking->tour_or_transfer_name;


            if($booking->type == 0){


                $data[$j]['type'] = "Tour";


            }else{


                $data[$j]['type'] = "Transfer";                


            }


            if($booking->created_at == '0000-00-00' || $booking->created_at == ''){


                $data[$j]['created_date'] =  '--';


            }else{


                $data[$j]['created_date'] =  date( 'Y-m-d', strtotime($booking->created_at));


            }


            if($booking->service_booked_date == '0000-00-00' || $booking->service_booked_date == ''){


                $data[$j]['service_booked_date'] =  '--';


            }else{


                $data[$j]['service_booked_date'] =  date( 'Y-m-d', strtotime($booking->service_booked_date));


            }   


            if($booking->subscribe == 0){


                $data[$j]['is_subscribe'] = "Unsubscribed";


            }else{


                $data[$j]['is_subscribe'] = "Subscribed";                


            }      


            


            $j++;


            $i++;


        }


        


        $output = array(


            "draw" => $_POST['draw'],


            "recordsTotal" => $this->booking->countFiltered($_POST),


            "recordsFiltered" => $this->booking->countFiltered($_POST),


            "data" => $data,


        );


        


        // Output to JSON format


        echo json_encode($output);


        exit;


    }


}