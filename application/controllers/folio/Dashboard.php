<?php

defined('BASEPATH') or exit('No direct script access allowed');



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



		//$this->db->query('ALTER TABLE cms_pages CHANGE tour_id tour_id TEXT NULL DEFAULT NULL');	

		// $this->db->query('ALTER TABLE `tbl_newsletter` ADD `is_draft` TINYINT NOT NULL AFTER `newsletter_content_2`');	

		// $this->db->query('ALTER TABLE `tbl_blog_categories` ADD `meta_title` TEXT NULL AFTER `parent_cat_id`, ADD `meta_keyword` TEXT NULL AFTER `meta_title`, ADD `meta_description` TEXT NULL AFTER `meta_keyword`; ');	

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



	public function update_tour_price()

	{

		if ($this->input->post()) {

			// pr($this->input->post(), 1);

			// print_r($this->input->post());

			// echo '<pre>';

			// pr(getBetweenDates($this->input->post('tour_start_date'), $this->input->post('tour_end_date')));

			// exit;

			$tour_date = date("Y-m-d", strtotime($this->input->post('tour_date')));

			if ($this->input->post('date_type') == 'individual') {

				$tour_date_range = explode(',', $this->input->post('individual_multiple_tour_dates'));

			} else {

				$tour_date_range = getBetweenDates($this->input->post('tour_start_date'), $this->input->post('tour_end_date'));

			}



			$open_close_tour = $this->input->post('tour_open_close');

			$select_price_opt = $this->input->post('select_price_opt');

			if ($select_price_opt == 1) {

				$price_percentage = $this->input->post('price');

			} else {

				$price_percentage = $this->input->post('price_d');

			}

			if (array_key_exists("tour_open_close", $this->input->post())) {

				$tour_availability = 1;

			} else {

				$tour_availability = 0;

				// $price_percentage = 0;

			}



			if (array_key_exists("reset_tour_rate", $this->input->post())) {

				$reset_tour_rate = 1;

			} else {

				$reset_tour_rate = 0;

			}



			if (array_key_exists("tour_category", $this->input->post())) {

				$tour_categories = $this->input->post('tour_category[]');



				// $tour_ids = $this->input->post('tour_category[]');

				$count = 0;

				if (is_array($tour_categories) && sizeof($tour_categories) > 0) {

					foreach ($tour_categories as $tour_category) {

						$where = array("tour_category_id" => $tour_category);

						$get_tour = $this->tours->get_many_by($where);

						$count = 0;

						if (is_array($get_tour) && sizeof($get_tour) > 0) {

							foreach ($get_tour as $tour) {



								// $where1 = array("tour_id" => $tour['id'], "tour_date" => $tour_date, "price_type" => 2);

								//$get_tour_price=$this->tour_price->get_many_by($where1);

								// $get_tour_price = $this->tour_price->get_rows($tour['id'], $tour_date, 2);



								foreach ($tour_date_range as $single_date) {

									$tour_date = date("Y-m-d", strtotime($single_date));

									$get_tour_price = $this->tour_price->get_rows($tour['id'], $tour_date, 2);

									if ($reset_tour_rate == 1 && count($get_tour) == 1) {

										if (count($get_tour_price) == 0) {

											$count++;

										}

									}



									if (is_array($get_tour_price) && sizeof($get_tour_price) > 0) {

										if ($reset_tour_rate == 1) {



											$deleted = $this->tour_price->delete_custom_record($tour['id'], $tour_date);

										} else {

											foreach ($get_tour_price as $key => $v) {

												if ($price_percentage > 0) {

													if ($v['tour_availability'] == 0 && $tour_availability == 1) {

														$get_tours_basic_price = $this->tour_price->get_rows($tour['id'], '', 1);

														$update_price = $get_tours_basic_price[$key]['price'];

													} else {

														if ($select_price_opt == 2) {

															$update_price = $v['price'] - ($v['price'] * $price_percentage / 100);

														} else {

															$update_price = $v['price'] + ($v['price'] * $price_percentage / 100);

														}

													}

												}

												$data = array(

													"price" => $update_price,

													"tour_availability" => $tour_availability,

												);

												$update_variation_price = $this->tour_price->update_by(array("id" => $v['id']), $data);

											}

										}

									} else {

										if ($reset_tour_rate == 0) {

											// $where2 = array("tour_id" => $tour['id'], "price_type" => 1);

											//$get_tours_price=$this->tour_price->get_many_by($where2);

											$get_tours_price = $this->tour_price->get_rows($tour['id'], '', 1);

											$where = array("tour_type_id" => $tour['tour_type_id']);

											$tour_variations = $this->tour_variation->get_many_by($where);

											if (is_array($get_tours_price) && sizeof($get_tours_price) > 0) {

												foreach ($tour_variations as $key => $v) {

													if ($price_percentage > 0) {

														if ($select_price_opt == 2) {

															$update_price = $get_tours_price[$key]['price'] - ($get_tours_price[$key]['price'] * $price_percentage / 100);

														} else {

															$update_price = $get_tours_price[$key]['price'] + ($get_tours_price[$key]['price'] * $price_percentage / 100);

														}

														// if ($v['tour_availability'] == 0 && $tour_availability == 1) {

														// 	$get_tours_basic_price = $this->tour_price->get_rows($tour['id'], '', 1);

														// 	$update_price = $get_tours_basic_price[$key]['price'];

														// } else {

														// 	if ($select_price_opt == 2) {

														// 		$update_price = $get_tours_price[$key]['price'] - ($get_tours_price[$key]['price'] * $price_percentage / 100);

														// 	} else {

														// 		$update_price = $get_tours_price[$key]['price'] + ($get_tours_price[$key]['price'] * $price_percentage / 100);

														// 	}

														// }

														//$update_price=$get_tours_price[$key]['price']+($get_tours_price[$key]['price'] * $price_percentage / 100);

													}

													$data = array(

														"tour_id" => $tour['id'],

														"variation_id" => $v['id'],

														"price" => $update_price,

														"tour_date" => $tour_date,

														"price_type" => 2,

														"tour_availability" => $tour_availability

													);

													$insert_variation_price = $this->tour_price->insert($data);

												}

											}

										}

									}

								}

							}

						}

					}

					if ($reset_tour_rate == 1) {

						if ($count > 0) {

							set_alert('error', "Custom Price record not found of tour for selected date");

							redirect(admin_url('dashboard'));

						} else {

							set_alert('success', "Tour price reset successfully");

							redirect(admin_url('dashboard'));

						}

					} elseif ($tour_availability == 0) {

						set_alert('success', "Tour closed successfully");

						redirect(admin_url('dashboard'));

					} else {

						set_alert('success', _l('_added_successfully', _l('tour_price')));

						redirect(admin_url('dashboard'));

					}

				} else {

					set_alert('error', _l('something_wrong'));

					redirect(admin_url('dashboard'));

				}

			} else if (array_key_exists("tour_name", $this->input->post())) {



				$tour_ids = $this->input->post('tour_name[]');

				$count = 0;

				if (is_array($tour_ids) && sizeof($tour_ids) > 0) {

					foreach ($tour_ids as $tour_id) {

						$where = array("id" => $tour_id);

						$get_tour = $this->tours->get_by($where);



						if (is_array($get_tour) && sizeof($get_tour) > 0) {



							$where = array("tour_type_id" => $get_tour['tour_type_id']);

							$tour_variations = $this->tour_variation->get_many_by($where);



							// $where1 = array("tour_id" => $tour_id, "tour_date" => $tour_date, "price_type" => 2);

							//$get_tour_price=$this->tour_price->get_record_by($where1);



							foreach ($tour_date_range as $single_date) {

								$tour_date = date("Y-m-d", strtotime($single_date));

								$get_tour_price = $this->tour_price->get_rows($tour_id, $tour_date, 2);



								// $get_tour_price = $this->tour_price->get_rows($tour_id, $tour_date, 2);

								if ($reset_tour_rate == 1 && count($tour_ids) == 1) {

									if (count($get_tour_price) == 0) {

										$count++;

									}

								}

								if (is_array($get_tour_price) && sizeof($get_tour_price) > 0) {

									if ($reset_tour_rate == 1) {



										$deleted = $this->tour_price->delete_custom_record($tour_id, $tour_date);

									} else {

										foreach ($get_tour_price as $key => $v) {

											if ($price_percentage > 0) {

												if ($v['tour_availability'] == 0 && $tour_availability == 1) {

													$get_tours_basic_price = $this->tour_price->get_rows($tour_id, '', 1);

													$update_price = $get_tours_basic_price[$key]['price'];

												} else {

													if ($select_price_opt == 2) {

														$update_price = $v['price'] - ($v['price'] * $price_percentage / 100);

													} else {

														$update_price = $v['price'] + ($v['price'] * $price_percentage / 100);

													}

												}

												//$update_price=$v['price']+($v['price'] * $price_percentage / 100);												

											}



											$data = array(

												"price" => $update_price,

												"tour_availability" => $tour_availability,

											);

											$update_variation_price = $this->tour_price->update_by(array("id" => $v['id']), $data);

										}

									}

								} else {

									if ($reset_tour_rate == 0) {

										// $where2 = array("tour_id" => $tour_id, "price_type" => 1);

										//$get_tours_price=$this->tour_price->get_many_by($where2);

										$get_tours_price = $this->tour_price->get_rows($tour_id, '', 1);

										if (is_array($get_tours_price) && sizeof($get_tours_price) > 0) {

											foreach ($tour_variations as $key => $v) {

												if ($price_percentage > 0) {



													if ($select_price_opt == 2) {

														$update_price = $get_tours_price[$key]['price'] - ($get_tours_price[$key]['price'] * $price_percentage / 100);

													} else {

														$update_price = $get_tours_price[$key]['price'] + ($get_tours_price[$key]['price'] * $price_percentage / 100);

													}



													// if ($v['tour_availability'] == 0 && $tour_availability == 1) {

													// 	$get_tours_basic_price = $this->tour_price->get_rows($tour_id, '', 1);

													// 	$update_price = $get_tours_basic_price[$key]['price'];

													// } else {

													// 	if ($select_price_opt == 2) {

													// 		$update_price = $get_tours_price[$key]['price'] - ($get_tours_price[$key]['price'] * $price_percentage / 100);

													// 	} else {

													// 		$update_price = $get_tours_price[$key]['price'] + ($get_tours_price[$key]['price'] * $price_percentage / 100);

													// 	}

													// }



													//$update_price=$get_tours_price[$key]['price']+($get_tours_price[$key]['price'] * $price_percentage / 100);													

												}



												$data = array(

													"tour_id" => $tour_id,

													"variation_id" => $v['id'],

													"price" => $update_price,

													"tour_date" => $tour_date,

													"price_type" => 2,

													"tour_availability" => $tour_availability

												);

												$insert_variation_price = $this->tour_price->insert($data);

											}

										}

									}

								}

							}

						}

					}

					if ($reset_tour_rate == 1) {

						if ($count > 0) {

							set_alert('error', "Custom Price record not found of tour for selected date");

							redirect(admin_url('dashboard'));

						} else {

							set_alert('success', "Tour price reset successfully");

							redirect(admin_url('dashboard'));

						}

					} elseif ($tour_availability == 0) {

						set_alert('success', "Tour closed successfully");

						redirect(admin_url('dashboard'));

					} else {

						set_alert('success', _l('_added_successfully', _l('tour_price')));

						redirect(admin_url('dashboard'));

					}

				} else {

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



	public function open_close_tour()

	{

		// pr($this->input->post());die;

		if ($this->input->post()) {

			// START get selected week date for current year							

			$start = date('Y-m-d', strtotime(date('Y-01-01')));

			$end = date('Y-m-d', strtotime(date('Y-12-31')));

			// $start = '2021-03-08';

			// $end = '2021-03-08';

			$format = 'Y-m-d';



			// Declare an empty array 

			$week_dates_array = array();



			// Variable that store the date interval 

			// of period 1 day 

			$interval = new DateInterval('P1D');



			$realEnd = new DateTime($end);

			$realEnd->add($interval);



			$period = new DatePeriod(new DateTime($start), $interval, $realEnd);



			// Use loop to store date into array 

			foreach ($period as $date) {

				$curr_date = $date->format($format);

				$number = date('N', strtotime($curr_date));

				if ($number == $this->input->post('week_day')) {

					$week_dates_array[] = $date->format($format);

				}

			}

			// pr($week_dates_array);die;

			// END get selected week date for current year



			// START to open/close tour

			$tour_ids = $this->input->post('tour_name_for_close[]');

			// pr($week_dates_array);die;

			$is_tour_updated = false;

			if (is_array($tour_ids) && sizeof($tour_ids) > 0) {



				if (array_key_exists("tour_open_close_for_week", $this->input->post())) {

					$tour_open_close_for_week = 1;

				} else {

					$tour_open_close_for_week = 0;

				}

				if (is_array($week_dates_array) && sizeof($week_dates_array) > 0) {

					foreach ($week_dates_array as $week_date) {

						foreach ($tour_ids as $tour_id) {

							$get_tour_exist_with_date = $this->tour_price->get_rows($tour_id, $week_date, 2);

							$where = array("id" => $tour_id);

							$get_tour = $this->tours->get_by($where);

							$where = array("tour_type_id" => $get_tour['tour_type_id']);

							$tour_variations = $this->tour_variation->get_many_by($where);



							if (is_array($get_tour) && sizeof($get_tour) > 0) {

								if (is_array($get_tour_exist_with_date) && sizeof($get_tour_exist_with_date) > 0) {

									foreach ($get_tour_exist_with_date as $v) {

										$data = array(

											"tour_availability" => $tour_open_close_for_week,

										);

										$this->tour_price->update_by(array("id" => $v['id']), $data);

										$is_tour_updated = true;

									}

								} else {

									$update_price = 0;

									$get_tours_price = $this->tour_price->get_rows($tour_id, '', 1);

									if (is_array($get_tours_price) && sizeof($get_tours_price) > 0) {

										foreach ($tour_variations as $key => $v) {

											$update_price = $get_tours_price[$key]['price'];



											$data = array(

												"tour_id" => $tour_id,

												"variation_id" => $v['id'],

												"price" => $update_price,

												"tour_date" => $week_date,

												"price_type" => 2,

												"tour_availability" => $tour_open_close_for_week

											);

											$this->tour_price->insert($data);

											$is_tour_updated = true;

										}

									}

								}

							}

						}

					}

				}

			}

			// END to open/close tour

			if ($is_tour_updated == true && $tour_open_close_for_week == 0) {

				set_alert('success', "Tour closed successfully");

				redirect(admin_url('dashboard'));

				exit;

			} else if ($is_tour_updated == true && $tour_open_close_for_week == 1) {

				set_alert('success', "Tour Opened successfully");

				redirect(admin_url('dashboard'));

				exit;

			} else {

				set_alert('error', _l('something_wrong'));

				redirect(admin_url('dashboard'));

				exit;

			}

		}

	}

}

