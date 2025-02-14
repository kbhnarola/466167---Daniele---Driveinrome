<!--Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4>
				<span class="text-semibold"><?php _el('edit_tours'); ?></span>
			</h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a>
			</li>
			<li>
				<a href="<?php echo base_url('admin/tours'); ?>"><?php _el('tours'); ?></a>
			</li>
			<li class="active"><?php _el('edit'); ?></li>
		</ul>
	</div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content ">
	          <!-- <div class="progress">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span class="sr-only">0% Complete</span>
                </div>
            </div> -->
      
      <form class="form-horizontal msf" id="editTourform" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/tours/edit/'.base64_encode($toursData['id'])); ?>"> 
        
              <div class="msf-header col-md-offset-1">
                <div class="row text-center">
                  <div class="msf-step col-md-3"><i class="fa fa-info"></i> <span>Basic Tour Details</span></div>
                  <div class="msf-step col-md-3"><i class="fa fa-file-text" aria-hidden="true"></i><span>Tour Description</span></div>
                  <div class="msf-step col-md-3"><!-- <i class="fa fa-check"></i> --><i class="fa fa-image"></i> <span>Tour Images</span></div>
                  <div class="msf-step col-md-3"><i class="fa fa-money" aria-hidden="true"></i> <span>Tour Price</span></div>
                </div>
              </div>

              <div class="msf-content">
                
                
                <div class="msf-view">
                  <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                      <div class="form-group row">
                              <label  class="col-form-label label_text text-lg-right "><?php _el('tour_name'); ?><small class="req text-danger">*</small></label>
                              <!-- <div class="col-lg-9 col-md-9 col-sm-12">     -->
                                <input type="text" id="tour_name" class="form-control" name="tour_name" autocomplete="off" placeholder="<?php _el('tour_name');?>" value="<?php echo $toursData['title'];?>">
                              <!-- </div>                         -->
                      </div>
                      <div class="form-group row">
                          <label  class="col-form-label label_text text-lg-right"><?php _el('tour_unique_code'); ?><small class="req text-danger">*</small></label>
                          <!-- <div class="col-lg-9 col-md-9 col-sm-12">     -->
                            <input type="text" id="tour_unique_code" class="form-control" name="tour_unique_code" autocomplete="off" placeholder="<?php _el('tour_unique_code');?>" value="<?php echo $toursData['unique_code'];?>">
                          <!-- </div>                         -->
                      </div>
                       <div class="form-group row">
                          <label  class="col-form-label label_text text-lg-right "><?php echo _l('duration')." (In Hours)"; ?><small class="req text-danger">*</small></label>
                          <!-- <div class="col-lg-9 col-md-9 col-sm-12">     -->
                            <input type="number" id="duration" class="form-control" name="duration" autocomplete="off" placeholder="<?php _el('duration');?>" value="<?php echo $toursData['duration'];?>">
                          <!-- </div>                         -->
                      </div> 
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                      <div class="form-group row">
                          <label  class="col-form-label label_text text-lg-right"><?php echo _l('select_',_l('tour_type')); ?><small class="req text-danger">*</small></label>
                              <!-- <div class="col-lg-9 col-md-9 col-sm-12"> -->
                                  <select id="tour_type" name="tour_type" class="form-control">
                                      <option value=""><?php echo _l('select_',_l('tour_type'));?></option>
                                          <?php
                                              foreach ($tour_types as $j) {
                                                if($j['id']==$toursData['tour_type_id']){
                                                ?>
                                                <option value="<?php echo $j['id']; ?>" selected ><?php echo $j['title']; ?></option>
                                                <?php } else { ?>
                                                <option value="<?php echo $j['id']; ?>" ><?php echo $j['title']; ?></option>
                                              <?php }
                                              }
                                          ?> 
                                  </select>                           
                              <!-- </div> -->
                      </div>
                      <div class="form-group row">
                          <label  class="col-form-label label_text text-lg-right"><?php _el('tour_category'); ?><small class="req text-danger">*</small></label>
                          <!-- <div class="col-lg-9 col-md-9 col-sm-12">    -->
                            <select id="tour_category" name="tour_category" class="form-control" placeholder="<?php _el('tour_category');?>"> 
                              <option value=""><?php echo _l('select_',_l('tour_category'));?></option>
                              <?php
                                              foreach ($tour_categories as $c) {
                                                if($c['id']==$toursData['tour_category_id']){
                                                ?>
                                                <option value="<?php echo $c['id']; ?>" selected ><?php echo $c['title']; ?></option>
                                                <?php } else { ?>
                                                <option value="<?php echo $c['id']; ?>" ><?php echo $c['title']; ?></option>
                                              <?php }
                                              }
                                          ?>
                            </select>
                          <!-- </div>                         -->
                      </div>                     
                    </div>
                  </div>
                </div>
                <div class="msf-view">
                  <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                        <div class="form-group row">
                              <label  class="col-form-label label_text text-lg-right"><?php _el('tour_description'); ?><small class="req text-danger">*</small></label>
                              
                                <textarea rows="10" id="tour_description" class="form-control resize_box" name="tour_description" placeholder="<?php _el('tour_description');?>" value="<?php echo $toursData['description'];?>"><?php echo $toursData['description'];?></textarea>
                              
                          </div>
                           <div class="form-group row">
                              <label  class="col-form-label label_text text-lg-right"><?php _el('tour_included'); ?><small class="req text-danger">*</small></label>
                              
                                <textarea rows="10" id="tour_included" class="form-control resize_box" name="tour_included" placeholder="<?php _el('tour_included');?>" value="<?php echo $toursData['tour_included'];?>"><?php echo $toursData['tour_included'];?></textarea>
                              
                          </div>
                           <div class="form-group row">
                              <label  class="col-form-label label_text text-lg-right"><?php _el('tour_restrictions'); ?><small class="req text-danger">*</small></label>
                              
                                <textarea rows="10" id="tour_restrictions" class="form-control resize_box" name="tour_restrictions" placeholder="<?php _el('tour_restrictions');?>" value="<?php echo $toursData['tour_restrictions'];?>"><?php echo $toursData['tour_restrictions'];?></textarea>
                              
                          </div>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                           <div class="form-group row">
                              <label  class="col-form-label label_text text-lg-right "><?php _el('tour_meeting_point'); ?><small class="req text-danger">*</small></label>
                              
                                <textarea rows="10" id="tour_meeting_point" class="form-control resize_box" name="tour_meeting_point" placeholder="<?php _el('tour_meeting_point');?>" value="<?php echo $toursData['tour_meeting_point'];?>"><?php echo $toursData['tour_meeting_point'];?></textarea>
                              
                          </div>
                           <div class="form-group row">
                              <label  class="col-form-label label_text text-lg-right"><?php _el('tour_faqs'); ?><small class="req text-danger">*</small></label>
                              
                                <textarea rows="10" id="tour_faqs" class="form-control resize_box" name="tour_faqs" placeholder="<?php _el('tour_faqs');?>" value="<?php echo $toursData['tour_faqs'];?>"><?php echo $toursData['tour_faqs'];?></textarea>
                              
                          </div>
                          <div class="form-group row">
                              <label  class="col-form-label label_text text-lg-right"><?php _el('tour_cancellation_policy'); ?><small class="req text-danger">*</small></label>
                              
                                <textarea rows="10" id="tour_cancellation_policy" class="form-control resize_box" name="tour_cancellation_policy" placeholder="<?php _el('tour_cancellation_policy');?>" value="<?php echo $toursData['tour_cancellation_policy'];?>"><?php echo $toursData['tour_cancellation_policy'];?></textarea>
                              
                          </div>
                    </div>
                  </div>
                </div>
                <div class="msf-view">
                  <div class="row">
                      <div class="col-md-5 col-md-offset-1">
                          <div class="form-group row ">
                              <label  class="col-form-label label_text text-lg-right"><?php _el('tour_featured_image'); ?><small class="req text-danger">*</small></label>
                              <!-- <div class="col-lg-9 col-md-9 col-sm-12 ">     -->
                                <input type="file" id="tour_featured_image" class="form-control " name="tour_featured_image" autocomplete="off" placeholder="<?php _el('tour_featured_image');?>" >
                                <input type="hidden" name="tour_feature_img" id="tour_feature_img" value="<?php echo $toursData['feature_image']; ?>">
                                <?php if($toursData['feature_image']!="") { ?>
                                <div id="feature_img_show" class="mr-t-5">
                                  <a href="<?php echo base_url('uploads/'.$toursData['feature_image']); ?>" class="imgClass" target="_blank"><img src="<?php echo base_url('uploads/'.$toursData['feature_image']);?>" width="50" height="50"></a>
                                  <button title="close" type="button" class="btn remove_feature_img" value="<?php echo base64_encode($toursData['id']);?>" data-imgname="<?php echo $toursData['feature_image']; ?>"><i class="fa fa-close"></i></button>
                                </div>
                                <?php } ?>
                              <!-- </div>                         -->
                          </div>
                      </div>
                      <div class="col-md-5 col-md-offset-1">
                          <div class="form-group row">
                              <label  class="col-form-label label_text text-lg-right "><?php _el('tour_gallery_image'); ?><small class="req text-danger">*</small></label>
                              <!-- <div class="col-lg-9 col-md-9 col-sm-12">     -->
                                <input type="file" id="tour_gallery_image" class="form-control" name="tour_gallery_image[]" autocomplete="off" placeholder="<?php _el('tour_gallery_image');?>" multiple >
                                <small class="text-info gallery-info ">*Upload Multiple Files</small>
                                <input type="hidden" name="tour_gallery_img" id="tour_gallery_img" value="<?php echo count(explode(',',$toursData['gallery_image'])); ?>">
                                <?php
                                  if($toursData['gallery_image']) {
                                    $gallery_img=explode(",",$toursData['gallery_image']);?>
                                <div id="gallery_img_show">
                                  <?php
                                  foreach($gallery_img as $img){ ?>
                                  <div class="col-lg-4 col-md-4 col-sm-12 mr-t-5">
                                    <a href="<?php echo base_url('uploads/'.$img); ?>" class="imgClass" target="_blank"><img src="<?php echo base_url('uploads/'.$img);?>" width="50" height="50"> </a>
                                    <button title="close" type="button" class="btn remove_gallery_img" value="<?php echo base64_encode($toursData['id']);?>" data-imgname="<?php echo $img; ?>"><i class="fa fa-close"></i></button>
                                  </div>
                                  <?php } ?>
                                </div>
                                  <?php }   ?>
                              <!-- </div>                         -->
                          </div>
                      </div>
                  </div>
                </div>
                <div class="msf-view">
                  <div class="row">
                      <div class="col-md-5 col-md-offset-1">
                        <div class="form-group row">
                              <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php _el('ratings'); ?></label>
                              <div class="col-lg-9 col-md-9 col-sm-12 rating">    
                                  <fieldset class="rate">
                                    <input type="radio" id="rating10" name="rating" value="5" <?php if($toursData['rating']==5) { echo "checked"; } ?>/><label for="rating10" title="5 stars"></label>
                                    <input type="radio" id="rating9" name="rating" value="4.5" <?php if($toursData['rating']=='4.5') { echo "checked"; } ?> /><label class="half" for="rating9" title="4.5 stars"></label>
                                    <input type="radio" id="rating8" name="rating" value="4" <?php if($toursData['rating']==4) { echo "checked"; } ?>/><label for="rating8" title="4 stars"></label>
                                    <input type="radio" id="rating7" name="rating" value="3.5" <?php if($toursData['rating']=='3.5') { echo "checked"; } ?>/><label class="half" for="rating7" title="3.5 stars"></label>
                                    <input type="radio" id="rating6" name="rating" value="3" <?php if($toursData['rating']==3) { echo "checked"; } ?>/><label for="rating6" title="3 stars"></label>
                                    <input type="radio" id="rating5" name="rating" value="2.5" <?php if($toursData['rating']=='2.5') { echo "checked"; } ?>/><label class="half" for="rating5" title="2.5 stars"></label>
                                    <input type="radio" id="rating4" name="rating" value="2" <?php if($toursData['rating']==2) { echo "checked"; } ?> /><label for="rating4" title="2 stars"></label>
                                    <input type="radio" id="rating3" name="rating" value="1.5" <?php if($toursData['rating']=='1.5') { echo "checked"; } ?>/><label class="half" for="rating3" title="1.5 stars"></label>
                                    <input type="radio" id="rating2" name="rating" value="1" <?php if($toursData['rating']==1) { echo "checked"; } ?>/><label for="rating2" title="1 star"></label>
                                    <input type="radio" id="rating1" name="rating" value="0.5" <?php if($toursData['rating']=='0.5') { echo "checked"; } ?> /><label class="half" for="rating1" title="0.5 star"></label>
                                     <input type="radio" id="rating0" name="rating" value="0" <?php if($toursData['rating']=='0') { echo "checked"; } ?>/><label for="rating0" title="No star" class="rate0"></label>
                                  </fieldset>
                              </div>                        
                          </div>
                          <?php
                          if(is_array($extra_services) && sizeof($extra_services)>0) { ?>
                          <div class="form-group row">
                              <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php echo _l('extra_services'); ?></label>
                              <div class="col-lg-9 col-md-9 col-sm-12">
                                <?php
                                $tour_extra_service=explode(",",$toursData['extra_services_id']);
                                foreach($extra_services as $ex) {
                                   ?>    
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="extra_services[]" value="<?php echo $ex['id'];?>" <?php if(in_array($ex['id'],$tour_extra_service)) { echo "checked"; } ?>><?php echo $ex['title'];?></label>
                                  </div>
                                <?php } ?>
                              </div>                        
                          </div>
                          <?php } ?>
                          <fieldset class="custom_price">
                            <?php 
                                 if($toursData['variation_price']){  ?>
                                    <legend class="scheduler-border">Variation Price</legend>
                                    <?php
                                      $i=0;
                                    foreach($toursData['variation_price'] as $v) { ?>
                                    <div class="form-group row">
                                      <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php echo $v['variation_title']; ?><small class="req text-danger">*</small></label>
                                      <div class="col-lg-9 col-md-9 col-sm-12">
                                        <input type="number" id="custom_price<?php echo $i; ?>" class="form-control required" name="custom_price[<?php echo $i; ?>]" autocomplete="off" placeholder="Custom Price" min="0" value="<?php echo $v['price']; ?>">
                                      </div>
                                    </div>
                                <?php $i++; } } ?>                           
                          </fieldset>
                      </div>
                      <div class="col-md-5 col-md-offset-1">
                        <div class="form-group row">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('meta_title'); ?></label> 
                            <input type="text" id="meta_title" class="form-control" name="meta_title" autocomplete="off" placeholder="<?php _el('meta_title');?>" value="<?php echo $toursData['meta_title'];?>">
                        </div>
                        <div class="form-group row">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('meta_keywords'); ?></label> 
                            <input type="text" id="meta_keywords" class="form-control" name="meta_keywords" autocomplete="off" placeholder="<?php _el('meta_keywords');?>" value="<?php echo $toursData['meta_keyword'];?>">
                        </div>
                        <div class="form-group row">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('meta_description'); ?></label> 
                            <input type="text" id="meta_description" class="form-control" name="meta_description" autocomplete="off" placeholder="<?php _el('meta_description');?>" value="<?php echo $toursData['meta_description'];?>">
                        </div>                        
                      </div>
                  </div>                  
                </div>
                
                
              </div>

              <div class="msf-navigation">
                <div class="row">
                  <input type="hidden" class="form-control"  id="tour_id" name="tour_id" value="<?php echo base64_encode($toursData['id']);?>">
                  <div class="col-md-3">
                    <button type="button" data-type="back" class="btn btn-default msf-nav-button"><i class="fa fa-chevron-left"></i> Back </button>
                  </div>

                  <div class="col-md-3 col-md-offset-6">
                    <button type="button" data-type="next" class="btn btn-success msf-nav-button">Next <i class="fa fa-chevron-right"></i></button>

                    <button type="submit" name="btn_tour_update_submit" data-type="submit" id="btn_tour_submit" class="btn btn-success msf-nav-button">Update</button>
                    <a class="btn btn-default hidden cancel_tour_edit" href="<?php echo base_url('admin/tours');?>"><?php _el('cancel'); ?></a>
                  </div>

                </div>
              </div>
        
      </form>
</div>
<!-- /Content area-->