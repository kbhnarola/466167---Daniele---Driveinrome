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
				<a href="<?php echo base_url('admin/tours'); ?>"><i class="icon-home2 position-left"></i><?php _el('manage_tour'); ?></a>
			</li>
			<!-- <li>
				<a href="<?php //echo base_url('admin/tours'); ?>"><?php //_el('tours'); ?></a>
			</li> -->
			<li class="active"><?php _el('edit'); ?></li>
		</ul>
	</div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content ">
	          
      
      <form class="form-horizontal msf" id="editTourform" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/tours/edit/'.base64_encode($toursData['id'])); ?>"> 
        
              <div class="msf-header">
                <div class="row text-center">
                  <div class="msf-step col-md-3"><i class="fa fa-info"></i> <span><?php echo _l('basic_tour_details');?></span></div>
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
                              <input type="text" id="tour_name" class="form-control" name="tour_name" autocomplete="off" placeholder="<?php _el('tour_name');?>" value="<?php echo $toursData['title'];?>">
                          </div>
                          <div class="col-md-6">
                              <label  class="col-form-label label_text text-lg-right"><?php _el('tour_unique_code'); ?><small class="req text-danger">*</small></label>
                              <input type="text" id="tour_unique_code" class="form-control" name="tour_unique_code" autocomplete="off" placeholder="<?php _el('tour_unique_code');?>" value="<?php echo $toursData['unique_code'];?>">
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
                                                if($j['id']==$toursData['tour_type_id']){
                                                ?>
                                                <option value="<?php echo $j['id']; ?>" selected ><?php echo $j['title']; ?></option>
                                                <?php } else { ?>
                                                <option value="<?php echo $j['id']; ?>" ><?php echo $j['title']; ?></option>
                                              <?php }
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
                          <div id="tour_category_err"></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php echo _l('duration')." (In Hours)"; ?><small class="req text-danger">*</small></label>
                            <input type="number" id="duration" class="form-control" name="duration" autocomplete="off" placeholder="<?php _el('duration');?>" value="<?php echo $toursData['duration'];?>" min="1">
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
                                  <input type="text" id="meta_title" class="form-control" name="meta_title" autocomplete="off" placeholder="<?php _el('meta_title');?>" value="<?php echo $toursData['meta_title'];?>">
                              </div>
                              <div class="col-md-6">
                                  <label  class="col-form-label label_text text-lg-right "><?php _el('meta_keywords'); ?></label>
                                  <input type="text" id="meta_keywords" class="form-control" name="meta_keywords" autocomplete="off" placeholder="<?php _el('meta_keywords');?>" value="<?php echo $toursData['meta_keyword'];?>">
                              </div>
                            
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                              <div class="col-md-6">
                                  <label  class="col-form-label label_text text-lg-right"><?php _el('meta_description'); ?></label>
                                  <input type="text" id="meta_description" class="form-control" name="meta_description" autocomplete="off" placeholder="<?php _el('meta_description');?>" value="<?php echo $toursData['meta_description'];?>">
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
                              <textarea id="tour_description" name="tour_description"><?php echo $toursData['description'];?></textarea>
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
                              <textarea id="tour_included" name="tour_included" placeholder="<?php _el('tour_included');?>" ><?php echo $toursData['tour_included'];?></textarea>
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
                            <?php
                              $tours_restriction=json_decode($toursData['tour_restrictions'],true);
                              if(is_array($tours_restriction) && sizeof($tours_restriction)>0) { 
                                $i=0;
                                foreach($tours_restriction as $res){ ?>

                                <div class="form-group">
                                  <div class="col-md-10">
                                    <?php 
                                      if($i==0){ ?>
                                   <label  class="col-form-label label_text text-lg-right"><?php _el('tour_restrictions'); ?><small class="req text-danger">*</small></label><?php } ?>
                                   <input type="text" class="form-control tour_res_input required" name="tour_restrictions[<?php echo $i;?>]" autocomplete="off" placeholder="<?php _el('tour_restrictions');?>" value="<?php echo $res;?>">
                                  </div>
                                  <div class="col-md-2 mr-t-30">
                                    <?php 
                                    //if($i==0){ ?>
                                    <!-- <button name="add_restriction" id="add_restriction" type="button" class="btn btn-primary">Add More</button> -->
                                    <?php //} else {?>
                                    <button name="remove_restriction" type="button" class="btn btn-primary remove_restriction mt-point"><?php echo _l('remove');?></button>
                                    <?php //} ?>
                                  </div>
                               </div>
                               <?php $i++;} } ?>
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
                            <?php
                              $tour_meeting_point=json_decode($toursData['tour_meeting_point'],true);
                              if(is_array($tour_meeting_point) && sizeof($tour_meeting_point)>0) { 
                                $m=0;
                                foreach($tour_meeting_point as $meet){ ?>
                                  <div class="form-group">
                                    <div class="col-md-10">
                                      <?php 
                                      if($m==0){ ?>
                                     <label  class="col-form-label label_text text-lg-right"><?php _el('tour_meeting_point'); ?><small class="req text-danger">*</small></label>
                                     <?php } ?>
                                     <input type="text" class="form-control tour_meeting_input required" name="tour_meeting_point[<?php echo $m;?>]" autocomplete="off" placeholder="<?php _el('tour_meeting_point');?>" value="<?php echo $meet;?>">
                                    </div>
                                    <div class="col-md-2 mr-t-30">
                                      <?php 
                                      //if($m==0){ ?>
                                      <!-- <button name="add_meeting_point" id="add_meeting_point" type="button" class="btn btn-primary">Add More</button> -->
                                      <?php //} else { ?>
                                      <button name="remove_meeting_point" type="button" class="btn btn-primary remove_meeting_point mt-point">Remove</button>
                                      <?php //} ?>
                                    </div>
                                 </div>
                                 <?php $m++; } }  ?>
                                  
                                 
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
                           <!--  <div class="form-group">
                                     <label  class="col-form-label label_text text-lg-right"><?php _el('tour_faqs'); ?><small class="req text-danger">*</small></label>
                                      </div> -->
                              <div class="form-group">
                                        <div class="col-md-10">
                                          <button name="add_faqs" id="add_faqs" type="button" class="btn btn-primary"><?php echo _l('add_tour_faqs');?></button>
                                        </div>
                                      </div>
                            <?php
                              $tour_faqs=json_decode($toursData['tour_faqs'],true);
                              // print_r($tour_faqs);
                              // exit;
                              if(is_array($tour_faqs) && sizeof($tour_faqs)>0) { 
                                $f=0;
                                foreach($tour_faqs as $faqs){ ?>
                                    
                                    <div class="m-div">
                                      <div class="form-group">
                                       <label  class="col-form-label label_text text-lg-right"><?php _el('question'); ?><small class="req text-danger">*</small></label>
                                       <input type="text" class="form-control tour_faqs_input required" name="tour_faqs_question[<?php echo $f; ?>]" autocomplete="off" placeholder="<?php _el('question');?>" value="<?php echo key($faqs);?>">
                                      </div>
                                      <div class="form-group">
                                       <label  class="col-form-label label_text text-lg-right"><?php _el('answer'); ?><small class="req text-danger">*</small></label>
                                       <textarea rows="7" class="form-control tour_faqs_output resize_box required" name="tour_faqs_answer[<?php echo $f; ?>]" placeholder="<?php _el('answer');?>" value="<?php echo $faqs[key($faqs)];?>"><?php echo $faqs[key($faqs)];?></textarea>
                                      </div>
                                     <div class="form-group ">
                                      <?php 
                                      //if($f==0){ ?>
                                        <!-- <button name="add_faqs" id="add_faqs" type="button" class="btn btn-primary">Add More</button> -->
                                      <?php //} else {?>
                                        <button name="remove_faqs" type="button" class="btn btn-primary remove_faqs"><?php echo _l('remove');?></button>
                                      <?php //} ?>
                                      </div>   
                                    </div>  
                                <?php $f++; } }  ?>
                                      
                                                                
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
                               <textarea id="tour_cancellation_policy"  name="tour_cancellation_policy" ><?php echo $toursData['tour_cancellation_policy'];?></textarea>
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
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label  class="col-form-label label_text text-lg-right "><?php _el('tour_featured_image'); ?><small class="req text-danger">*</small></label>
                              <input type="file" id="tour_featured_image" class="form-control" name="tour_featured_image" autocomplete="off" placeholder="<?php _el('tour_featured_image');?>">
                              <input type="hidden" name="tour_feature_img" id="tour_feature_img" value="<?php echo $toursData['feature_image']; ?>">
                              <?php if($toursData['feature_image']!="") { ?>
                                <div id="feature_img_show" class="mr-t-5">
                                  <a href="<?php echo base_url('uploads/'.$toursData['feature_image']); ?>" class="imgClass" id="view_feature_img" target="_blank" style="color:blue">View Feature Image</a>
                                  <!-- <a href="<?php //echo base_url('uploads/'.$toursData['feature_image']); ?>" class="imgClass" target="_blank"><img src="<?php //echo base_url('uploads/'.$toursData['feature_image']);?>" width="50" height="50" onerror="this.src='<?php //echo base_url("assets/images/default/transfers_default.png");?>'"></a> -->
                                  <!-- <button title="close" type="button" class="btn remove_feature_img" value="<?php //echo base64_encode($toursData['id']);?>" data-imgname="<?php //echo $toursData['feature_image']; ?>"><i class="fa fa-close"></i></button> -->
                                </div>
                                <?php } ?>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label  class="col-form-label label_text text-lg-right"><?php _el('tour_gallery_image'); ?><small class="req text-danger">*</small></label>
                              <input type="file" id="tour_gallery_image" class="form-control" name="tour_gallery_image[]" autocomplete="off" placeholder="<?php _el('tour_gallery_image');?>" multiple>
                              <small class="text-info"><strong>*<?php echo _l('upload_multiple_files');?></strong></small>
                              <input type="hidden" name="tour_gallery_img" id="tour_gallery_img" value="<?php if($toursData['gallery_image']!=''){ echo count(explode(',',$toursData['gallery_image'])); } ?>">
                              <?php
                                  if($toursData['gallery_image']) {
                                    $gallery_img=explode(",",$toursData['gallery_image']);?>
                                <div id="gallery_img_show">
                                  <?php
                                  foreach($gallery_img as $img){ ?>
                                  <div class="col-lg-4 col-md-4 col-sm-12 mr-t-5">
                                    <a href="<?php echo base_url('uploads/'.$img); ?>" class="imgClass" target="_blank"><img src="<?php echo base_url('uploads/'.$img);?>" width="50" height="50" onerror="this.src='<?php echo base_url("assets/images/default/transfers_default.png");?>'"> </a>
                                    <button title="close" type="button" class="btn remove_gallery_img" value="<?php echo base64_encode($toursData['id']);?>" data-imgname="<?php echo $img; ?>"><i class="fa fa-close"></i></button>
                                  </div>
                                  <?php } ?>
                                </div>
                                  <?php }   ?>
                          </div>
                        </div>                      
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('tour_banner_image'); ?><small class="req text-danger">*</small></label>
                            <input type="file" id="tour_banner_image" class="form-control" name="tour_banner_image" autocomplete="off" placeholder="<?php _el('tour_banner_image');?>">
                            <input type="hidden" name="tour_banner_img" id="tour_banner_img" value="<?php echo $toursData['banner_image']; ?>">
                              <?php if($toursData['banner_image']!="") { ?>
                                <div id="banner_img_show" class="mr-t-5">
                                   <a href="<?php echo base_url('uploads/'.$toursData['banner_image']); ?>" class="imgClass" id="view_banner_img" target="_blank" style="color:blue">View Banner Image</a>
                                  <!-- <a href="<?php //echo base_url('uploads/'.$toursData['banner_image']); ?>" class="imgClass" target="_blank"><img src="<?php //echo base_url('uploads/'.$toursData['banner_image']);?>" width="50" height="50" onerror="this.src='<?php //echo base_url("assets/images/default/transfers_default.png");?>'"></a> -->
                                  <!-- <button title="close" type="button" class="btn remove_feature_img" value="<?php //echo base64_encode($toursData['id']);?>" data-imgname="<?php //echo $toursData['feature_image']; ?>"><i class="fa fa-close"></i></button> -->
                                </div>
                                <?php } ?>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                      </div>
                  </div>
                </div>

                <div class="msf-view">
                  <div class="row ">
                    <fieldset class="">
                      <legend class=""><strong><?php echo _l('rating_and_extra_services');?></strong></legend>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php echo _l('add_top_selling_tours'); ?>:</label>
                              <div class="col-lg-9 col-md-9 col-sm-12">
                                <label class="radio-inline">
                                  <input type="radio" name="top_selling_tour" <?php if($toursData['top_selling_tour']==1){ echo "checked"; } ?> value="1"><?php echo _l('yes');?>
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="top_selling_tour" <?php if($toursData['top_selling_tour']==0){ echo "checked"; } ?> value="0"><?php echo _l('no');?>
                                </label>                                
                              </div>                        
                          </div>
                        <div class="form-group">
                              <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php _el('ratings'); ?>:</label>
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
                          <div class="form-group">
                              <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php echo _l('extra_services'); ?>:</label>
                              <div class="col-lg-9 col-md-9 col-sm-12">
                                <?php
                                $tour_extra_service=explode(",",$toursData['extra_services_id']);
                                foreach($extra_services as $k_index=>$ex) {
                                   ?>  
                                  <div class="col-lg-4 col-md-4 col-sm-12">  
                                      <div class="checkbox">
                                        <label><input type="checkbox" name="extra_services[]" value="<?php echo $ex['id'];?>" <?php if(in_array($ex['id'],$tour_extra_service)) { echo "checked"; } ?>><?php echo $ex['title'];?></label>
                                      </div>
                                  </div>
                                <?php /*if(($k_index+1)%3==0){echo '<div class="clearfix"></div>';} */} ?>
                              </div>                        
                          </div>
                          <?php } ?>
                          
                      </div>
                    </fieldset>
                  </div>  
                  <div class="row mr-t-15">
                    <fieldset class="basic_price">
                        <?php 
                            $variation_title=array();
                             if($toursData['variation_price']){  ?>
                                <legend class="scheduler-border"><strong><?php echo _l('variation_price');?></strong></legend>
                                <!-- <div class="row"> -->
                                <?php
                                  $i=0;
                                foreach($toursData['variation_price'] as $v) {
                                if($v['price_type']==1) { 
                                  //$variation_title[]=$v['variation_title'];
                                  array_push($variation_title,$v['variation_title']);
                                  ?>
                                
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label  class="col-form-label label_text text-lg-right"><?php echo $v['variation_title']; ?><small class="req text-danger">*</small></label>
                                      <input type="number" id="basic_price<?php echo $i; ?>" class="form-control required" name="basic_price[<?php echo $i; ?>]" autocomplete="off" placeholder="Enter Price" <?php if(strtolower(trim($v['variation_title']))=='enfants') {?>min="0" <?php } else {?> min="1" <?php } ?> value="<?php echo $v['price']; ?>">

                                    </div>
                                  </div>

                                <?php $i++; 
                                if($i % 6 == 0) echo '<div class="clearfix"></div>';
                              } } }?> 
                                <!-- <div class="col-md-2">
                                  <div class="form-group"> 
                                    <button type="button" class="btn btn-primary" name="add_custom_price" id="add_custom_price">Add More</button>
                                  </div>
                                </div>  -->                                                
                    </fieldset>                    
                  </div>
                  
                  <?php 
                  // $v=0;
                  // if($toursData['variation_price']){ 
                  //   $custom_var_array=array_column($toursData['variation_price'],"price_type");
                  //   foreach ($custom_var_array as $value) {
                  //     if($value==2){
                  //       $v++;
                  //       break;
                  //     }
                  //   }
                  // } 
                  ?>
                  
                  <?php 

                  //if($v>0){?>
                  <!-- Listing table -->
                  <div class="row panel-body table-responsive" id="custom_var_price">
                    <fieldset class="custom_price">
                      <legend class=""><strong><?php echo _l('custom_variation_price');?></strong></legend>
                      <table id="custom_variation_price_table" class="table table-bordered table-striped" >
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Tour Date</th>
                                  <?php                                  
                                    foreach ($variation_title as $v) { ?>
                                    <th><?php echo $v;?></th>
                                  <?php } ?>
                                  <th>Action</th>
                              </tr>
                          </thead>       
                           
                      </table>  
                    </fieldset>        
                  </div>
                  <!-- /Listing table -->
                  <?php //} ?>
                  <input type="hidden" name="variation_title_arr" id="variation_title_arr" value='<?php echo implode(",",$variation_title);?>'>
                                  
                </div>
             </div>

              <div class="msf-navigation">
                <div class="row">
                  <input type="hidden" class="form-control"  id="tour_id" name="tour_id" value="<?php echo base64_encode($toursData['id']);?>">
                  <input type="hidden" class="form-control"  id="ctour_type_id" name="ctour_type_id" value="<?php echo base64_encode($toursData['tour_type_id']);?>">
                  <div class="col-md-3">
                    <button type="button" data-type="back" class="btn btn-default msf-nav-button"><i class="fa fa-chevron-left"></i> <?php _el('back'); ?> </button>
                  </div>

                  <div class="col-md-3 col-md-offset-6">
                    <button type="button" data-type="next" class="btn btn-success msf-nav-button"><?php _el('next'); ?> <i class="fa fa-chevron-right"></i></button>

                    <button type="submit" name="btn_tour_update_submit" data-type="submit" id="btn_tour_submit" class="btn btn-success msf-nav-button"><?php _el('update'); ?></button>
                    <a class="btn btn-default hidden cancel_tour_edit" href="<?php echo base_url('admin/tours');?>"><?php _el('cancel'); ?></a>
                  </div>

                </div>
              </div>
        
      </form>
</div>
<!-- /Content area-->

<div id="edit_price_modal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog" width="50px">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title editModalTitle"><?php echo _l('edit_price'); ?></h5>
            </div>

            <form  id="editVariantionPrice" method="POST">
                <div class="modal-body">
                    <div class="alert alert-danger hidden" id="error_msg" >
                      
                    </div>
                    <div class="edit_price_form">
                        
                        
                    </div>
                </div>
                <div class="modal-footer text-center">                   
                    <button name="edit_price_submit" type="submit" id="edit_price_submit" class="btn btn-primary"><?php _el('save'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _el('close'); ?></button>
                </div>
            </form>
            <div class="text-center hidden" id="loader_cont" >
                <img src="<?php echo ASSET.'images/loader.gif'; ?>">
            </div>
        </div>
    </div>
</div>