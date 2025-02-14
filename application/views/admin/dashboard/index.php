<!-- Page header -->
<div class="page-header page-header-default">
	<!-- <div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('dashboard'); ?></span></h4>
		</div>
	</div> -->

	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="<?= admin_url() ?>"><i class="icon-home2 position-left"></i><?php echo _l('dashboard'); ?></a></li>
		</ul>
	</div>
</div>
<!-- /Page header -->

<!-- Content area -->
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Panel -->
			<form action="<?php echo admin_url('dashboard/update_tour_price'); ?>" id="updateTourPrice" method="POST">
				<div class="panel panel-flat">
					<!-- Panel heading -->
					<div class="panel-body">
						<div class="custom-form">

							<fieldset>
								<legend>Tours</legend>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label class="col-form-label label_text text-lg-right">Select date selection type<small class="req text-danger">*</small></label>
											<select id="date_type" name="date_type" class="form-control select_group" placeholder="<?php _el('select_date_type'); ?>">
												<option value=""><?php echo _l('select_date_type'); ?></option>
												<option value="individual"><?php echo _l('individual_multiple_date'); ?></option>
												<option value="range"><?php echo _l('date_range'); ?></option>
											</select>
										</div>
										<div class="col-md-6 date-range-wrapper hidden">
											<label class="col-form-label label_text text-lg-right">Select range of dates<small class="req text-danger">*</small></label>
											<div class="input-group date">
												<input type="text" name="range_of_tour_dates" id="range_of_tour_dates" class="form-control  range_of_tour_dates" placeholder="Select Dates" autocomplete="off">
												<div class="input-group-addon">
													<span class="glyphicon glyphicon-th"></span>
												</div>
											</div>
										</div>
										<div class="col-md-6 multiple-date-wrapper hidden">
											<label class="col-form-label label_text text-lg-right">Select multiple individual dates<small class="req text-danger">*</small></label>
											<div class="input-group date">
												<input type="text" name="individual_multiple_tour_dates" id="individual_multiple_tour_dates" class="form-control  individual_multiple_tour_dates" placeholder="Select Dates" autocomplete="off">
												<div class="input-group-addon">
													<span class="glyphicon glyphicon-th"></span>
												</div>
											</div>
										</div>

									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<!-- <label>Select Category Or Tour Name</label> -->
										<hr>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label class="col-form-label label_text text-lg-right">Select Update Price By<small class="req text-danger">*</small></label>
											<div class="">
												<label class="radio-inline col-form-label label_text"><input type="radio" id="tour_category_opt" name="select_update_price_opt" value="1">Tour City</label>
												<label class="radio-inline col-form-label label_text">
													<input type="radio" id="tour_name_opt" name="select_update_price_opt" value="2">Tour Name</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="category_list hidden">
												<label class="col-form-label label_text text-lg-right "><?php _el('tour_city'); ?><small class="req text-danger">*</small></label>
												<select id="tour_category" name="tour_category[]" class="form-control select_group" placeholder="<?php _el('tour_category'); ?>" multiple="multiple">
													<!-- <option value=""><?php echo _l('select_', _l('tour_category')); ?></option> -->
													<?php
													foreach ($tour_categories as $c) { ?>
														<option value="<?php echo $c['id']; ?>"><?php echo $c['title']; ?></option>
													<?php }
													?>
												</select>
											</div>
											<?php
											?>
											<div class="tour_list hidden">
												<label class="col-form-label label_text text-lg-right"><?php _el('tour_list'); ?><small class="req text-danger">*</small></label>
												<select id="tour_name" name="tour_name[]" class="form-control select_group" placeholder="<?php _el('tour'); ?>" multiple="multiple">
													<!-- <option value=""><?php //echo _l('select_',_l('tour'));
																			?></option> -->
													<?php
													foreach ($tour_list as $c) { ?>
														<option value="<?php echo $c['id']; ?>"><?php echo $c['unique_code'] . ' - ' . $c['title']; ?></option>
													<?php }
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<!-- <label>Select Category Or Tour Name</label> -->
										<hr>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 mr-t-30 open_close_tour">
											<label class="col-md-4 col-form-label label_text text-lg-right">Open or Close Tour:</label>
											<div class="col-md-8">
												<div class="checkbox checkbox-switch">
													<label>
														<input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Open" data-off-text="Close" class="switch" name="tour_open_close" id="tour_open_close" checked="checked">
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-6 mr-t-30 reset_rate">
											<label class="col-md-4 col-form-label label_text text-lg-right">Reset Tour Rate:</label>
											<div class="col-md-8">
												<div class="checkbox checkbox-switch">
													<label>
														<input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" name="reset_tour_rate" id="reset_tour_rate">
													</label>
												</div>
											</div>
										</div>

									</div>
								</div>
								<div class="row hr_line">
									<div class="col-sm-12">
										<!-- <label>Select Category Or Tour Name</label> -->
										<hr>
									</div>
								</div>
								<div class="form-group price_div">
									<div class="row">
										<div class="col-md-6">
											<label class="col-form-label label_text text-lg-right">Select Price Option By<small class="req text-danger">*</small></label>
											<div class="">
												<label class="radio-inline col-form-label label_text"><input type="radio" id="increase_price_opt" name="select_price_opt" value="1">Increase</label>
												<label class="radio-inline col-form-label label_text">
													<input type="radio" id="decrease_price_opt" name="select_price_opt" value="2">Decrease</label>
											</div>
										</div>
										<div class="col-md-6 price_option hidden">

											<label class="col-form-label label_text text-lg-right"><?php echo _l('price'); ?> <span class="text-info price_lbl"></span><small class="req text-danger">*</small></label>
											<div class="mr-t-10 increase_div hidden">
												<input id="price" class="form-control " name="price" type="text" />
											</div>
											<div class="mr-t-10 decrease_div hidden">
												<input id="price_d" class="form-control " name="price_d" type="text" />
											</div>
										</div>
									</div>
								</div>
								<div class="row mr-t-25">
									<div class="col-sm-12">
										<hr>
									</div>
								</div>
								<div class="row">
									<div class="btn-bottom-toolbar text-center btn-toolbar-container-out">
										<input type="hidden" name="tour_start_date" id="tour_start_date">
										<input type="hidden" name="tour_end_date" id="tour_end_date">
										<button type="submit" class="btn btn-primary" name="update_tour_price"><?php _el('save'); ?></button>
										<button type="reset" class="btn btn-default" name="reset_tour_price" id="reset_tour_price"><?php _el('reset'); ?></button>
									</div>
								</div>
							</fieldset>
						</div>
					</div>


				</div>
			</form>
			<form action="<?php echo admin_url('dashboard/open_close_tour'); ?>" id="openCloseTour" method="POST">
				<div class="panel panel-flat">
					<div class="panel-body">
						<div class="custom-form tour-close-wrapper">
							<fieldset>
								<legend>Tour Open/Close</legend>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label class="col-form-label label_text text-lg-right"><?php echo 'Select week day' ?><small class="req text-danger">*</small></label>
											<select id="week_day" name="week_day" class="form-control select_group" placeholder="<?php echo 'Select week day'; ?>">
												<option value=""></option>
												<option value="1">Monday</option>
												<option value="2">Tuesday</option>
												<option value="3">Wednesday</option>
												<option value="4">Thursday</option>
												<option value="5">Friday</option>
												<option value="6">Saturday</option>
												<option value="7">Sunday</option>
											</select>
										</div>
										<div class="col-md-6">
											<div class="list-parent">
												<label class="col-form-label label_text text-lg-right"><?php _el('tour_list'); ?><small class="req text-danger">*</small></label>
												<select id="tour_name_for_close" name="tour_name_for_close[]" class="form-control select_group" placeholder="<?php _el('tour'); ?>" multiple="multiple">
													<!-- <option value=""><?php //echo _l('select_',_l('tour'));
																			?></option> -->
													<?php
													foreach ($tour_list as $c) { ?>
														<option value="<?php echo $c['id']; ?>"><?php echo $c['unique_code'] . ' - ' . $c['title']; ?></option>
													<?php }
													?>
												</select>
											</div>
										</div>
										<hr>
									</div>
									<div class="row mr-t-25">
										<div class="col-sm-12">
											<hr>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 mr-t-10 open_close_tour">
											<label class="col-md-4 col-form-label label_text text-lg-right">Open or Close Tour:</label>
											<div class="col-md-8">
												<div class="checkbox checkbox-switch">
													<label>
														<input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Open" data-off-text="Close" class="switch" name="tour_open_close_for_week" id="tour_open_close_for_week" checked="checked">
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row mr-t-10">
										<div class="col-sm-12">
											<hr>
										</div>
									</div>
									<div class="row">
										<div class="btn-bottom-toolbar text-center btn-toolbar-container-out">

											<button type="submit" class="btn btn-primary" name="open_close_tour"><?php _el('save'); ?></button>
											<button type="reset" class="btn btn-default" name="reset_open_close_tour" id="reset_open_close_tour"><?php _el('reset'); ?></button>
										</div>
									</div>
								</div>
								</legend>
							</fieldset>
						</div>
					</div>
				</div>
			</form>
			<!-- /Panel -->
		</div>
	</div>
</div>
<!-- /page header -->