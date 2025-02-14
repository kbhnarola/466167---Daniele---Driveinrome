<!--Page header -->
<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title">
      <h4>
        <span class="text-semibold"><?php _el('edit_transfer_service'); ?></span>
      </h4>
    </div>
  </div>
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li>
        <a href="<?php echo base_url('admin/transfers'); ?>"><i class="icon-home2 position-left"></i><?php _el('manage_transfer'); ?></a>
      </li>
      <!-- <li>
        <a href="<?php //echo base_url('admin/transfers'); ?>"><?php //_el('transfer_services'); ?></a>
      </li> -->
      <li class="active"><?php _el('edit'); ?></li>
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
              <form action="<?php echo base_url('admin/transfers/edit/'.base64_encode($transferData['id'])); ?>" id="editTransferServiceform" method="POST">
                
                <fieldset>
                  <legend><?php echo _l('edit_transfer_service');?></legend>
                  <div class="row">
                    <h6 class="div_title"><strong><?php echo _l('transfer_service_details');?></strong></h6> 
                    <hr>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('transfer_name'); ?><small class="req text-danger">*</small></label>
                            <input type="text" id="transfer_name" class="form-control" name="transfer_name" autocomplete="off" placeholder="<?php _el('transfer_name');?>" value="<?php echo $transferData['title'];?>">
                        </div>
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right"><?php _el('transfer_unique_code'); ?><small class="req text-danger">*</small></label>
                              <input type="text" id="transfer_unique_code" class="form-control" name="transfer_unique_code" autocomplete="off" placeholder="<?php _el('transfer_unique_code');?>" value="<?php echo $transferData['unique_code'];?>">
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php echo _l('select_',_l('transfer_types')); ?><small class="req text-danger">*</small></label>
                            <select id="transfer_type" name="transfer_type" class="form-control">
                                  <option value=""><?php echo _l('select_',_l('transfer_types'));?></option>
                                  <?php
                                        foreach ($transfer_types as $j) {
                                          if($j['id']==$transferData['transfer_type_id']){
                                          ?>
                                          <option value="<?php echo $j['id']; ?>" selected ><?php echo $j['title']; ?></option>
                                          <?php } else { ?>
                                          <option value="<?php echo $j['id']; ?>" ><?php echo $j['title']; ?></option>
                                        <?php }
                                        }
                                    ?> 
                            </select>
                        </div>
                        <div class="col-md-6 ">
                             <label  class="col-form-label label_text text-lg-right"><?php _el('transfer_category'); ?><small class="req text-danger">*</small></label>
                              <select id="transfer_category" name="transfer_category" class="form-control" placeholder="<?php _el('transfer_category');?>"> 
                                <option value=""><?php echo _l('select_',_l('transfer_category'));?></option>
                                <?php
                                    foreach ($transfer_categories as $c) {
                                      if($c['id']==$transferData['transfer_category_id']){
                                      ?>
                                      <option value="<?php echo $c['id']; ?>" selected ><?php echo $c['title']; ?></option>
                                      <?php } else { ?>
                                      <option value="<?php echo $c['id']; ?>" ><?php echo $c['title']; ?></option>
                                    <?php }
                                    }
                                ?>
                              </select>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php echo _l('duration')." (In Hours)"; ?><small class="req text-danger">*</small></label>
                            <input type="number" id="duration" class="form-control" name="duration" autocomplete="off" placeholder="<?php _el('duration');?>" min="0" value="<?php echo $transferData['duration'];?>">
                        </div>
                        <div class="col-md-6 mr-t-30">
                             <label  class="col-form-label label_text text-lg-right col-md-3"><?php _el('ratings'); ?>:</label>
                            <div class="col-md-9 rating1">    
                                <div class="transfer_rate">
                                  <input type="radio" id="rating10" name="rating" value="5" <?php if($transferData['ratings']==5) { echo "checked"; } ?>/><label for="rating10" title="5 stars"></label>
                                    <input type="radio" id="rating9" name="rating" value="4.5" <?php if($transferData['ratings']=='4.5') { echo "checked"; } ?> /><label class="half" for="rating9" title="4.5 stars"></label>
                                    <input type="radio" id="rating8" name="rating" value="4" <?php if($transferData['ratings']==4) { echo "checked"; } ?>/><label for="rating8" title="4 stars"></label>
                                    <input type="radio" id="rating7" name="rating" value="3.5" <?php if($transferData['ratings']=='3.5') { echo "checked"; } ?>/><label class="half" for="rating7" title="3.5 stars"></label>
                                    <input type="radio" id="rating6" name="rating" value="3" <?php if($transferData['ratings']==3) { echo "checked"; } ?>/><label for="rating6" title="3 stars"></label>
                                    <input type="radio" id="rating5" name="rating" value="2.5" <?php if($transferData['ratings']=='2.5') { echo "checked"; } ?>/><label class="half" for="rating5" title="2.5 stars"></label>
                                    <input type="radio" id="rating4" name="rating" value="2" <?php if($transferData['ratings']==2) { echo "checked"; } ?> /><label for="rating4" title="2 stars"></label>
                                    <input type="radio" id="rating3" name="rating" value="1.5" <?php if($transferData['ratings']=='1.5') { echo "checked"; } ?>/><label class="half" for="rating3" title="1.5 stars"></label>
                                    <input type="radio" id="rating2" name="rating" value="1" <?php if($transferData['ratings']==1) { echo "checked"; } ?>/><label for="rating2" title="1 star"></label>
                                    <input type="radio" id="rating1" name="rating" value="0.5" <?php if($transferData['ratings']=='0.5') { echo "checked"; } ?> /><label class="half" for="rating1" title="0.5 star"></label>
                                     <input type="radio" id="rating0" name="rating" value="0" <?php if($transferData['ratings']=='0') { echo "checked"; } ?>/><label for="rating0" title="No star" class="rate0"></label>
                                </div>
                            </div> 
                        </div>
                    </div>
                  </div>
                  
                   <div class="row set_variation_price">
                    <h6 class="div_title"><strong><?php echo _l('variation_price');?></strong></h6> 
                    <hr> 
                    <div class="transfer_basic_price">
                        <?php
                          $i=0;
                            foreach($transferData['variation_price'] as $v) {
                            if($v['price_type']==1) { ?>
                            
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label  class="col-form-label label_text text-lg-right"><?php echo $v['variation_title']; ?><small class="req text-danger">*</small></label>
                                  <input type="number" id="basic_price<?php echo $i; ?>" class="form-control required" name="basic_price[<?php echo $i; ?>]" autocomplete="off" placeholder="Enter Price" min="1" value="<?php echo $v['price']; ?>">

                                </div>
                              </div>

                            <?php $i++; 
                            if($i % 4 == 0) echo '<div class="clearfix"></div>';
                          } } ?> 
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
                            <input type="text" id="meta_title" class="form-control" name="meta_title" autocomplete="off" placeholder="<?php _el('meta_title');?>" value="<?php echo $transferData['meta_title'];?>">
                        </div>
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('meta_keywords'); ?></label>
                            <input type="text" id="meta_keywords" class="form-control" name="meta_keywords" autocomplete="off" placeholder="<?php _el('meta_keywords');?>" value="<?php echo $transferData['meta_keyword'];?>">
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right"><?php _el('meta_description'); ?></label>
                              <input type="text" id="meta_description" class="form-control" name="meta_description" autocomplete="off" placeholder="<?php _el('meta_description');?>" value="<?php echo $transferData['meta_description'];?>">
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
                      <input type="hidden" name="transfer_id" id="transfer_id" value="<?php echo base64_encode($transferData['id']);?>">
                      <input type="hidden" name="ctransfer_type_id" id="ctransfer_type_id" value="<?php echo base64_encode($transferData['transfer_type_id']);?>">
                      <button type="submit" class="btn btn-primary" name="edit_transfer"><?php _el('update'); ?></button>
                      <a class="btn btn-default cancel_transfer_edit" href="<?php echo base_url('admin/transfers');?>"><?php _el('cancel'); ?></a>
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