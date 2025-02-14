<!--Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4>
				<span class="text-semibold"><?php _el('add_transfer_service'); ?></span>
			</h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo admin_url('transfers'); ?>"><i class="icon-home2 position-left"></i><?php _el('manage_transfer'); ?></a>
			</li>
			<!-- <li>
				<a href="<?php //echo admin_url('transfers'); ?>"><?php //_el('transfer_services'); ?></a>
			</li> -->
			<li class="active"><?php _el('add'); ?></li>
		</ul>
	</div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content ">
      
  
    <div class="row">
      <div class="col-md-12" >
        <!-- Panel -->
        <div class="panel panel-flat">
          <!-- Panel heading -->
          <div class="panel-body">
            <div class="custom-form">
              <form action="<?php echo admin_url('transfers/add'); ?>" id="addTransferServiceform" method="POST" enctype="multipart/form-data">
                
                <fieldset>
                  <legend><?php echo _l('add_transfer_service');?></legend>
                  <div class="row">
                    <h6 class="div_title"><strong><?php echo _l('transfer_service_details');?></strong></h6> 
                    <hr>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('transfer_name'); ?><small class="req text-danger">*</small></label>
                            <input type="text" id="transfer_name" class="form-control" name="transfer_name" autocomplete="off" placeholder="<?php _el('transfer_name');?>">
                        </div>
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right"><?php _el('transfer_unique_code'); ?><small class="req text-danger">*</small></label>
                              <input type="text" id="transfer_unique_code" class="form-control" name="transfer_unique_code" autocomplete="off" placeholder="<?php _el('transfer_unique_code');?>">
                        </div>
                    </div>
                  </div>
                  
                  <div class="form-group ">
                    <div class="row">
                        <div class="col-md-6 ">
                          <div class="row div_span">
                                <label  class="col-form-label label_text text-lg-right "><?php echo _l('select_',_l('transfer_types')); ?><small class="req text-danger">*</small></label>
                                <select id="transfer_type" name="transfer_type" class="form-control">
                                            <option value=""><?php echo _l('select_',_l('transfer_types'));?></option>
                                            <?php
                                                foreach ($transfer_types as $j) {
                                                  ?>
                                                  <option value="<?php echo $j['id']; ?>" ><?php echo $j['title']; ?></option>
                                                  <?php
                                                }
                                            ?> 
                                </select>  
                                <div id="transfer_type_err"></div>                                 
                            </div>
                            <div class="row div_span">
                                <label  class="col-form-label label_text text-lg-right"><?php _el('transfer_category'); ?><small class="req text-danger">*</small></label>
                              <select id="transfer_category" name="transfer_category" class="form-control" placeholder="<?php _el('transfer_category');?>"> 
                                <option value=""><?php echo _l('select_',_l('transfer_category'));?></option>
                                <?php
                                            foreach ($transfer_categories as $j) {
                                              ?>
                                              <option value="<?php echo $j['id']; ?>" ><?php echo $j['title']; ?></option>
                                              <?php
                                            }
                                        ?> 
                              </select>  
                              <div id="transfer_category_err"></div>                            
                            </div>
                            
                            
                           
                        </div>                        
                        <div class="col-md-6">
                            <div class="row div_span">
                                <label  class="col-form-label label_text text-lg-right "><?php _el('description'); ?><small class="req text-danger">*</small></label>
                                <textarea  rows="7" name="description" id="description" class="form-control resize_box"></textarea>
                                <div id="description_err"></div>
                            </div>
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
                            <label  class="col-form-label label_text text-lg-right "><?php _el('feature_image'); ?><small class="req text-danger">*</small></label>
                            <input type="file" id="feature_image" class="form-control" name="feature_image" autocomplete="off" placeholder="<?php _el('feature_image');?>">
                        </div>
                      </div>
                  </div>
                  <div class="form-group mr-t-5">
                      <div class="row">
                        <div class="col-md-6">
                                <label  class="col-form-label label_text text-lg-right "><?php _el('ratings'); ?>:</label>
                                <div class=" rating1">    
                                    <div class="transfer_rate">
                                      <input type="radio" id="rating10" name="rating" value="5" /><label for="rating10" title="5 stars"></label>
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
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                      </div>
                  </div> 
                  <div class="form-group mr-t-5">
                    <div class="row">
                        <div class="col-md-12">
                          <label  class="col-form-label label_text text-lg-right "><?php echo 'Transfer Email Description'; ?>:</label>
                          <textarea id="transfer_email_description" name="transfer_email_description"></textarea>
                        </div>
                    </div>
                  </div> 
                  <div class="row hidden set_variation_price">
                    <h6 class="div_title"><strong><?php echo _l('variation_price');?></strong></h6> 
                    <hr> 
                    <div class="transfer_basic_price">
                    
                    </div> 
                  </div>                  
                  
                  <div class="row">
                    <h6 class="div_title"><strong><?php echo _l('seo_fields');?></strong></h6> 
                    <hr>
                  </div> 
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
                  
                  <div class="row mr-t-25">
                      <div class="col-sm-12">
                          <hr>
                      </div>
                  </div>
                  <div class="row">
                    <div class="btn-bottom-toolbar text-center btn-toolbar-container-out">
                      
                      <button type="submit" class="btn btn-primary" name="add_transfer"><?php _el('add_transfer_service'); ?></button>
                      <button type="reset" class="btn btn-default" name="reset_transfer" id="reset_transfer"><?php _el('reset'); ?></button>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        
          
        </div>
        <!-- /Panel -->
      </div>
    </div>
    
  
      
</div>
<!-- /Content area-->
