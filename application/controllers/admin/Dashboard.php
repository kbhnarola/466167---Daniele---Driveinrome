<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('Admin_user_model', 'users');
		$this->load->model('Tours_model', 'tours');
		$this->load->model('Tour_variation_model', 'tour_variation');
        $this->load->model('Tour_price_plan_model', 'tour_price');
      
	}

	
	/**
	* @author bsm
	*
	* Loads the admin dashboard
	*
	*/
	public function index()
	{
		$this->set_page_title(_l('dashboard'));
		$cdata['tour_categories'] = get_tour_categories(1);
		$cdata['tour_list'] = get_tour_list();
		//$data = array();
        
		$data['content'] = $this->load->view('admin/dashboard/index', $cdata, TRUE);
		$this->load->view('admin/layouts/index', $data);

	}

	public function update_tour_price(){
		if($this->input->post()){
			// print_r($this->input->post());
			// exit;
			$tour_date=date("Y-m-d",strtotime($this->input->post('tour_date')));
			
			$open_close_tour=$this->input->post('tour_open_close');
			$select_price_opt=$this->input->post('select_price_opt');
			if($select_price_opt==1){
				$price_percentage=$this->input->post('price');
			} else {
				$price_percentage=$this->input->post('price_d');
			}
			if(array_key_exists("tour_open_close", $this->input->post())){
				$tour_availability=1;
			} else {
				$tour_availability=0;
				$price_percentage=0;
			}

			if(array_key_exists("reset_tour_rate", $this->input->post())){
				$reset_tour_rate=1;
			} else {
				$reset_tour_rate=0;
			}

			if(array_key_exists("tour_category", $this->input->post())) {

				$tour_category=$this->input->post('tour_category');

				$where=array("tour_category_id"=>$tour_category);
				$get_tour=$this->tours->get_many_by($where);
				$count=0;
				if(is_array($get_tour) && sizeof($get_tour)>0){
					foreach($get_tour as $tour){

						$where1=array("tour_id"=>$tour['id'],"tour_date"=>$tour_date,"price_type"=>2);
						//$get_tour_price=$this->tour_price->get_many_by($where1);
						$get_tour_price=$this->tour_price->get_rows($tour['id'],$tour_date,2);

						if($reset_tour_rate==1 && count($get_tour)==1) {
							if(count($get_tour_price)==0) {
								$count++;
							}
						}

						if(is_array($get_tour_price) && sizeof($get_tour_price)>0) {
							if($reset_tour_rate==1){
								
        						$deleted = $this->tour_price->delete_custom_record($tour['id'],$tour_date);
							} else {
								foreach($get_tour_price as $v){
		                      		if($price_percentage>0){
		                      			if($select_price_opt==2) {
											$update_price=$v['price']-($v['price'] * $price_percentage / 100);
		                      			} else {
		                      				$update_price=$v['price']+($v['price'] * $price_percentage / 100);
		                      			}
		                        		
		                        	} else {
										$update_price=0;
									}
		                            $data=array(
		                                "price"=>$update_price,
		                                "tour_availability"=>$tour_availability,
		                            );
		                            $update_variation_price=$this->tour_price->update_by(array("id"=>$v['id']),$data);	
		                        }
	                    	}	                      	
	                        
						} else {

							if($reset_tour_rate==0){
								$where2=array("tour_id"=>$tour['id'],"price_type"=>1);
								//$get_tours_price=$this->tour_price->get_many_by($where2);
								$get_tours_price=$this->tour_price->get_rows($tour['id'],'',1);
								
								$where=array("tour_type_id"=>$tour['tour_type_id']);
	                			$tour_variations=$this->tour_variation->get_many_by($where);
	                			if(is_array($get_tours_price) && sizeof($get_tours_price)>0){
									foreach($tour_variations as $key=>$v){
										if($price_percentage > 0) {
											//$update_price=$get_tours_price[$key]['price']+($get_tours_price[$key]['price'] * $price_percentage / 100);
											if($select_price_opt==2) {
												$update_price=$get_tours_price[$key]['price']-($get_tours_price[$key]['price'] * $price_percentage / 100);
			                      			} else {
			                      				$update_price=$get_tours_price[$key]['price']+($get_tours_price[$key]['price'] * $price_percentage / 100);
			                      			}
										} else {
											$update_price=0;
										}
										
			                            $data=array(
			                                "tour_id"=>$tour['id'],
			                                "variation_id"=>$v['id'],
			                                "price"=>$update_price,
			                                "tour_date"=>$tour_date,
			                                "price_type"=>2,
			                                "tour_availability"=>$tour_availability
			                            );
			                            $insert_variation_price=$this->tour_price->insert($data);
			                        }
		                        }
		                    } 
						}
					}
					if($reset_tour_rate==1){
						if($count>0){
							set_alert('error',"Custom Price record not found of tour for selected date");
	                		redirect(admin_url('dashboard'));
						} else {
							set_alert('success',"Tour price reset successfully");
	                		redirect(admin_url('dashboard'));
						}
						
					} elseif($tour_availability==0){
						set_alert('success',"Tour closed successfully");
	                	redirect(admin_url('dashboard'));
					}	else {
						set_alert('success', _l('_added_successfully', _l('tour_price')));
	                	redirect(admin_url('dashboard'));
					}
								
				} else {
					set_alert('error', _l('something_wrong'));                    
                    redirect(admin_url('dashboard'));
				}

			} else if(array_key_exists("tour_name", $this->input->post())){

				$tour_ids=$this->input->post('tour_name[]');
				$count=0;
				if(is_array($tour_ids) && sizeof($tour_ids)>0){
					foreach($tour_ids as $tour_id) {
						$where=array("id"=>$tour_id);
						$get_tour=$this->tours->get_by($where);							

						if(is_array($get_tour) && sizeof($get_tour)>0){

							$where=array("tour_type_id"=>$get_tour['tour_type_id']);
		                	$tour_variations=$this->tour_variation->get_many_by($where);

							$where1=array("tour_id"=>$tour_id,"tour_date"=>$tour_date,"price_type"=>2);
							//$get_tour_price=$this->tour_price->get_record_by($where1);
							$get_tour_price=$this->tour_price->get_rows($tour_id,$tour_date,2);
							if($reset_tour_rate==1 && count($tour_ids)==1) {
								if(count($get_tour_price)==0) {
									$count++;
								}
							}
							if(is_array($get_tour_price) && sizeof($get_tour_price)>0) {
		                      	if($reset_tour_rate==1){
								
	        						$deleted = $this->tour_price->delete_custom_record($tour_id,$tour_date);
								} else {
			                      	foreach($get_tour_price as $v){
			                      		if($price_percentage>0){

			                      			//$update_price=$v['price']+($v['price'] * $price_percentage / 100);
			                      			if($select_price_opt==2) {
												$update_price=$v['price']-($v['price'] * $price_percentage / 100);
			                      			} else {
			                      				$update_price=$v['price']+($v['price'] * $price_percentage / 100);
			                      			}

			                      		} else {
											$update_price=0;
										}
			                      		
			                            $data=array(
			                                "price"=>$update_price,
			                                "tour_availability"=>$tour_availability,
			                            );
			                            $update_variation_price=$this->tour_price->update_by(array("id"=>$v['id']),$data);
			                        }
			                    }
		                        
							} else {
								if($reset_tour_rate==0){
									$where2=array("tour_id"=>$tour_id,"price_type"=>1);
									//$get_tours_price=$this->tour_price->get_many_by($where2);
									$get_tours_price=$this->tour_price->get_rows($tour_id,'',1);
									if(is_array($get_tours_price) && sizeof($get_tours_price)>0){
										foreach($tour_variations as $key=>$v){
											if($price_percentage>0){
												//$update_price=$get_tours_price[$key]['price']+($get_tours_price[$key]['price'] * $price_percentage / 100);
												if($select_price_opt==2) {
													$update_price=$get_tours_price[$key]['price']-($get_tours_price[$key]['price'] * $price_percentage / 100);
				                      			} else {
				                      				$update_price=$get_tours_price[$key]['price']+($get_tours_price[$key]['price'] * $price_percentage / 100);
				                      			}
											} else {
												$update_price=0;
											}

				                            $data=array(
				                                "tour_id"=>$tour_id,
				                                "variation_id"=>$v['id'],
				                                "price"=>$update_price,
				                                "tour_date"=>$tour_date,
				                                "price_type"=>2,
				                                "tour_availability"=>$tour_availability
				                            );
				                            $insert_variation_price=$this->tour_price->insert($data);
				                        }
				                    }
				                }		                        
							}
						} 
					}
					if($reset_tour_rate==1){
						if($count>0){
							set_alert('error',"Custom Price record not found of tour for selected date");
	                		redirect(admin_url('dashboard'));
						} else {
							set_alert('success',"Tour price reset successfully");
	                		redirect(admin_url('dashboard'));
						}
						
					} elseif($tour_availability==0){
						set_alert('success',"Tour closed successfully");
	                	redirect(admin_url('dashboard'));
					}	else {
						set_alert('success', _l('_added_successfully', _l('tour_price')));
	                	redirect(admin_url('dashboard'));
					}
					
				}	else {
					set_alert('error', _l('something_wrong'));
					redirect(admin_url('dashboard'));
					exit;
				}

			} else {
				redirect(admin_url('dashboard'));
				exit;
			}

		} else {
			redirect(admin_url('dashboard'));
			exit;
		}
	}
}
