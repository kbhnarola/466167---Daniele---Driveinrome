<!--Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4>
				<span class="text-semibold"><?php _el('add_tours'); ?></span>
			</h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo base_url('admin/tours'); ?>"><i class="icon-home2 position-left"></i><?php _el('manage_tour'); ?></a>
			</li>
			<!-- <li>
				<a href="<?php //echo base_url('admin/tours'); ?>"><?php //_el('tours'); ?></a>
			</li> -->
			<li class="active"><?php _el('add'); ?></li>
		</ul>
	</div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content ">
      
      <form class="form-horizontal msf" id="addTourform" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/tours/add'); ?>"> 
        
              <div class="msf-header">
                <div class="row text-center">
                  <div class="msf-step col-md-3 "><i class="fa fa-info"></i> <span><?php echo _l('enter_tour_details');?></span></div>
                  <div class="msf-step col-md-3"><i class="fa fa-file-text" aria-hidden="true"></i><span><?php echo _l('tour_description');?></span></div>
                  <div class="msf-step col-md-3"><i class="fa fa-image"></i> <span><?php echo _l('tour_images');?></span></div>
                  <div class="msf-step col-md-3"><i class="fa fa-money" aria-hidden="true"></i> <span><?php echo _l('tour_price');?></span></div>
                </div>
              </div>

              <div class="msf-content">

                <div class="msf-view">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                              <label  class="col-form-label label_text text-lg-right "><?php _el('tour_name'); ?><small class="req text-danger">*</small></label>
                              <input type="text" id="tour_name" class="form-control" name="tour_name" autocomplete="off" placeholder="<?php _el('tour_name');?>">
                          </div>
                          <div class="col-md-6">
                              <label  class="col-form-label label_text text-lg-right"><?php _el('tour_unique_code'); ?><small class="req text-danger">*</small></label>
                              <input type="text" id="tour_unique_code" class="form-control" name="tour_unique_code" autocomplete="off" placeholder="<?php _el('tour_unique_code');?>">
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php echo _l('select_',_l('tour_type')); ?><small class="req text-danger">*</small></label>
                            <select id="tour_type" name="tour_type" class="form-control">
                                        <option value=""><?php echo _l('select_',_l('tour_type'));?></option>
                                        <?php
                                            foreach ($tour_types as $j) {
                                              ?>
                                              <option value="<?php echo $j['id']; ?>" ><?php echo $j['title']; ?></option>
                                              <?php
                                            }
                                        ?> 
                            </select> 
                            <div id="tour_type_err"></div>
                      </div>
                      <div class="col-md-6">
                          <label  class="col-form-label label_text text-lg-right"><?php _el('tour_category'); ?><small class="req text-danger">*</small></label>
                          <select id="tour_category" name="tour_category" class="form-control" placeholder="<?php _el('tour_category');?>"> 
                            <option value=""><?php echo _l('select_',_l('tour_category'));?></option>
                            <?php
                                        foreach ($tour_categories as $j) {
                                          ?>
                                          <option value="<?php echo $j['id']; ?>" ><?php echo $j['title']; ?></option>
                                          <?php
                                        }
                                    ?> 
                          </select>
                          <div id="tour_category_err"></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php echo _l('duration')." (In Hours)"; ?><small class="req text-danger">*</small></label>
                            <input type="number" id="duration" class="form-control" name="duration" autocomplete="off" placeholder="<?php _el('duration');?>" min="0">
                      </div>
                      <div class="col-md-6">
                            
                      </div>
                    </div>
                  </div>
                  <fieldset class="">
                        <legend class=""><strong><?php echo _l('seo_fields');?></strong></legend>
                        <div class="form-group">
                          <div class="row">
                            
                              <div class="col-md-6">
                                  <label  class="col-form-label label_text text-lg-right "><?php _el('meta_title'); ?></label>
                                  <input type="text" id="meta_title" class="form-control" name="meta_title" autocomplete="off" placeholder="<?php _el('meta_title');?>">
                              </div>
                              <div class="col-md-6">
                                  <label  class="col-form-label label_text text-lg-right "><?php _el('meta_keywords'); ?></label>
                                  <input type="text" id="meta_keywords" class="form-control" name="meta_keywords" autocomplete="off" placeholder="<?php _el('meta_keywords');?>">
                              </div>
                            
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                              <div class="col-md-6">
                                  <label  class="col-form-label label_text text-lg-right"><?php _el('meta_description'); ?></label>
                                  <input type="text" id="meta_description" class="form-control" name="meta_description" autocomplete="off" placeholder="<?php _el('meta_description');?>">
                              </div>
                              <div class="col-md-6">
                                  
                              </div>
                            </div>
                        </div>
                  </fieldset>
                  <!-- <div class="row mr-t-15">
                    
                        
                  </div> -->
                </div>
                <div class="msf-view">
                  <div class="row">
                    <!--Accordion wrapper-->
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title">
                          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <?php echo _l('tour_description');?>
                          </a>
                        </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <div class="form-group">
                              <label  class="col-form-label label_text text-lg-right "><?php _el('tour_description'); ?><small class="req text-danger">*</small></label>                          
                              <textarea id="tour_description" name="tour_description"></textarea> 
                              <div id="tour_description_err"></div>
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                          <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <?php echo _l('tour_included');?>
                          </a>
                        </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <div class="form-group">
                              <label  class="col-form-label label_text text-lg-right"><?php _el('tour_included'); ?></label>   
                              <textarea id="tour_included" name="tour_included"></textarea>
                              <div id="tour_included_err"></div>
                          </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingthree">
                          <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            <?php _el('tour_restrictions'); ?>
                          </a>
                        </h4>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingthree">
                          
                          <div class="panel-body tour_restrictions">
                            <div class="form-group">
                              <div class="col-md-10">
                                <button name="add_restriction" id="add_restriction" type="button" class="btn btn-primary"><?php echo _l('add_restriction');?></button>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading4">
                          <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                            <?php _el('tour_meeting_point'); ?>
                          </a>
                        </h4>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                          <div class="panel-body tour_meeting_point">
                            <div class="form-group">
                              <div class="col-md-10">
                                <button name="add_meeting_point" id="add_meeting_point" type="button" class="btn btn-primary"><?php echo _l('add_tour_meeting_point');?></button>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading5">
                          <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                              <?php _el('tour_faqs'); ?>
                          </a>
                        </h4>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                          <div class="panel-body tour_faqs">
                            <div class="form-group">
                              <div class="col-md-10">
                                <button name="add_faqs" id="add_faqs" type="button" class="btn btn-primary"><?php echo _l('add_tour_faqs');?></button>
                              </div>
                            </div>
                            <!-- <div class="form-group">
                             <label  class="col-form-label label_text text-lg-right"><?php _el('tour_faqs'); ?><small class="req text-danger">*</small></label>
                              </div> -->
                            <div class="m-div">
                               
                            </div>                           
                            </div>
                          </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                          <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <?php _el('tour_cancellation_policy');?>
                          </a>
                        </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <div class="form-group">
                              <label  class="col-form-label label_text text-lg-right"><?php _el('tour_cancellation_policy'); ?></label>
                              <textarea id="tour_cancellation_policy" name="tour_cancellation_policy"></textarea>
                              <div id="tour_cancellation_err"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Accordion wrapper -->
                  </div>
                </div>
                <div class="msf-view">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label  class="col-form-label label_text text-lg-right "><?php _el('tour_featured_image'); ?><small class="req text-danger">*</small></label>
                            <input type="file" id="tour_featured_image" class="form-control" name="tour_featured_image" autocomplete="off" placeholder="<?php _el('tour_featured_image');?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label  class="col-form-label label_text text-lg-right"><?php _el('tour_gallery_image'); ?><small class="req text-danger">*</small></label>
                            <input type="file" id="tour_gallery_image" class="form-control" name="tour_gallery_image[]" autocomplete="off" placeholder="<?php _el('tour_gallery_image');?>" multiple>
                            <small class="text-info"><strong>*<?php echo _l('upload_multiple_files');?></strong></small>
                        </div>
                      </div>                      
                  </div>
                </div>
                <div class="msf-view">
                  <div class="row mr-t-add mr-t-30">
                    <fieldset class="">
                      <legend class=""><strong><?php echo _l('rating_and_extra_services');?></strong></legend>
                      <div class="col-md-12">
                         <div class="form-group">
                            <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php echo _l('add_top_selling_tours'); ?>:</label>
                              <div class="col-lg-9 col-md-9 col-sm-12">
                                <label class="radio-inline">
                                  <input type="radio" name="top_selling_tour" value="1"><?php echo _l('yes');?>
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="top_selling_tour" checked value="0"><?php echo _l('no');?>
                                </label>                                
                              </div>                        
                          </div>  
                        <div class="form-group">
                            <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php _el('ratings'); ?>:</label>
                            <div class="col-lg-9 col-md-9 col-sm-12 rating">    
                                <fieldset class="rate">
                                  <input type="radio" id="rating10" name="rating" value="0" /><label for="rating10" title="5 stars"></label>
                                  <input type="radio" id="rating9" name="rating" value="4.5" /><label class="half" for="rating9" title="4.5 stars"></label>
                                  <input type="radio" id="rating8" name="rating" value="4" /><label for="rating8" title="4 stars"></label>
                                  <input type="radio" id="rating7" name="rating" value="3.5" /><label class="half" for="rating7" title="3.5 stars"></label>
                                  <input type="radio" id="rating6" name="rating" value="3" /><label for="rating6" title="3 stars"></label>
                                  <input type="radio" id="rating5" name="rating" value="2.5" /><label class="half" for="rating5" title="2.5 stars"></label>
                                  <input type="radio" id="rating4" name="rating" value="2" /><label for="rating4" title="2 stars"></label>
                                  <input type="radio" id="rating3" name="rating" value="1.5" /><label class="half" for="rating3" title="1.5 stars"></label>
                                  <input type="radio" id="rating2" name="rating" value="1" /><label for="rating2" title="1 star"></label>
                                  <input type="radio" id="rating1" name="rating" value="0.5" /><label class="half" for="rating1" title="0.5 star"></label>
                                   <input type="radio" id="rating0" name="rating" value="0" /><label for="rating0" title="No star"></label>
                                </fieldset>
                            </div>                        
                        </div>
                        <?php
                          if(is_array($extra_services) && sizeof($extra_services)>0) { ?>
                          <div class="form-group">
                            <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php echo _l('extra_services'); ?>:</label>
                              <div class="col-lg-9 col-md-9 col-sm-12">
                                <?php
                                  foreach($extra_services as $k_index=>$ex) { ?> 
                                  <div class="col-md-4">    
                                    <div class="checkbox">
                                      <label><input type="checkbox" name="extra_services[]" value="<?php echo $ex['id'];?>"><?php echo $ex['title'];?></label>
                                    </div>
                                  </div>
                                <?php if(($k_index+1)%3==0){echo '<div class="clearfix"></div>';} } ?>
                              </div>                        
                          </div>
                        <?php } ?>                        
                      </div> 
                    </fieldset>                     
                  </div>   
                  <div class="row">
                    <fieldset class="basic_price">
                                                       
                    </fieldset>                    
                  </div>
                 <!--  <div class="row bs_price hidden mr-t-30">
                    <fieldset class="custom_price">
                      <legend class=""><strong>Custom Variation Price</strong></legend>
                        
                    </fieldset>
                  </div> -->
                                 
                </div>
              </div>

              <div class="msf-navigation">
                <div class="row">
                  <div class="col-md-3">
                    <button type="button" data-type="back" class="btn btn-default msf-nav-button"><i class="fa fa-chevron-left"></i> <?php echo _l('back');?> </button>
                  </div>

                  <div class="col-md-3 col-md-offset-6">
                    <button type="button" data-type="next" class="btn btn-success msf-nav-button"><?php echo _l('next');?> <i class="fa fa-chevron-right"></i></button>

                    <button type="submit" name="btn_tour_submit" data-type="submit" id="btn_tour_submit" class="btn btn-success msf-nav-button"><?php echo _l('add_tour');?></button>
                  </div>

                </div>
              </div>
        
      </form>
      
</div>
<!-- /Content area-->
