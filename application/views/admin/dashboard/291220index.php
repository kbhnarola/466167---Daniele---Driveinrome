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
	<form action="<?php echo base_url('admin/dashboard/update_tour_price'); ?>" id="updateTourPrice" method="POST">
		<div class="row">
			<div class="col-md-12" >
				<!-- Panel -->
				<div class="panel panel-flat">
					<!-- Panel heading -->
					<div class="panel-body">
						<div class="custom-form">
							
						<fieldset>
							<legend>Tours</legend>
								<div class="form-group">
					                <div class="row">
					                    <div class="col-md-6">
					                            <label class="col-form-label label_text text-lg-right">Select Date<small class="req text-danger">*</small></label>
					                            <div class="input-group date tour_datepicker" > 
				                                    <input type="text" name="tour_date" class="form-control  tour_date" placeholder="Select Date" autocomplete="off">
				                                    <div class="input-group-addon"> 
				                                      <span class="glyphicon glyphicon-th"></span>
				                                    </div>
				                                </div>
					                    </div>
					                    <div class="col-md-6 mr-t-30">
					                            <label  class="col-md-4 col-form-label label_text text-lg-right">Open or Close Tour:</label>
					                            <div class="col-md-8">
					                                <div class="checkbox checkbox-switch">
					                                	<label>
					                                		<input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Open" data-off-text="Close" class="switch" name="tour_open_close" id="tour_open_close" checked="checked">
					                                	</label>
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
					                            <div class="" > 
					                                    <label class="radio-inline col-form-label label_text"><input type="radio" id="tour_category_opt" name="select_update_price_opt" value="1">Tour City</label>
				                                		<label class="radio-inline col-form-label label_text">
				                                		<input type="radio" id="tour_name_opt" name="select_update_price_opt" value="2">Tour Name</label>
					                                </div>
				                        </div>
				                        <div class="col-md-6">
				                            <div class="category_list hidden">
						                        <label  class="col-form-label label_text text-lg-right "><?php _el('tour_city'); ?><small class="req text-danger">*</small></label>
							                    <select id="tour_category" name="tour_category" class="form-control select_group" placeholder="<?php _el('tour_category');?>"> 
								                    <option value=""><?php echo _l('select_',_l('tour_category'));?></option>
						                              <?php
			                                              foreach ($tour_categories as $c) { ?>
			                                                <option value="<?php echo $c['id']; ?>" ><?php echo $c['title']; ?></option>
			                                              <?php }
			                                          ?>
								                </select>
							                </div>
								            <div class="tour_list hidden">
								                <label  class="col-form-label label_text text-lg-right"><?php _el('tour_list'); ?><small class="req text-danger">*</small></label>
							                    <select id="tour_name" name="tour_name" class="form-control select_group" placeholder="<?php _el('tour');?>"> 	
							                    	<option value=""><?php echo _l('select_',_l('tour'));?></option>
						                              <?php
				                                          foreach ($tour_list as $c) { ?>
				                                            <option value="<?php echo $c['id']; ?>" ><?php echo $c['title']; ?></option>
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
								<div class="form-group price_div">
					                <div class="row">
					                    <div class="col-md-6">
					                            <label  class="col-md-4 col-form-label label_text text-lg-right"><?php echo _l('price'); ?> <span class="text-info">(Increase in %)</span><small class="req text-danger">*</small></label>
					                            <div class="col-md-8">  
		      								  		<input id="price" class="form-control " name="price" type="text" />      					
		      								 	</div>
					                    </div>
				                        <div class="col-md-6">
				                            
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
										
										<button type="submit" class="btn btn-primary" name="update_tour_price"><?php _el('save'); ?></button>
										<button type="reset" class="btn btn-default" name="reset_tour_price" id="reset_tour_price"><?php _el('reset'); ?></button>
									</div>
								</div>
							</fieldset>							
						</div>
					</div>
				
					
				</div>
				<!-- /Panel -->
			</div>
		</div>
		
	</form>
</div>
<!-- /page header -->	