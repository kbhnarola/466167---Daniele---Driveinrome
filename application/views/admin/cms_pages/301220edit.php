<!--Page header -->
<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title">
      <h4>
        <span class="text-semibold"><?php _el('add_cms_pages'); ?></span>
      </h4>
    </div>
  </div>
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li>
        <a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a>
      </li>
      <li>
        <a href="<?php echo base_url('admin/cms-pages'); ?>"><?php _el('cms_pages'); ?></a>
      </li>
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
              <form action="<?php echo base_url('admin/cms_pages/edit/'.base64_encode($cmsData['id'])); ?>" id="addCMSform" method="POST">
                
                <fieldset>
                  <legend><?php echo _l('add_cms_pages');?></legend>
                  
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('title'); ?><small class="req text-danger">*</small></label>
                            <input type="text" id="cms_page_title" class="form-control" name="cms_page_title" autocomplete="off" placeholder="<?php _el('title');?>" value="<?php echo $cmsData['page_title'];?>">
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label  class="col-form-label label_text text-lg-right "><?php echo _l('description'); ?><small class="req text-danger">*</small></label>
                            <textarea name="description" id="description"><?php echo $cmsData['description'];?></textarea>
                            <div id="description_err"></div>
                        </div>
                    </div>
                  </div>  
                  <?php
                  
                  if($cmsData['id']==1){ ?>  
                  <div class="video_links">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-10">
                              <button name="add_video_link" id="add_video_link" type="button" class="btn btn-primary"><?php echo _l('add_video_links');?></button>
                            </div>
                          </div>
                        </div>
                        <?php
                      $video_links=json_decode($cmsData['video_links'],true);
                      if(is_array($video_links) && sizeof($video_links)>0) { 
                        $i=0;
                        foreach($video_links as $res){ ?>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-10"><input type="text" class="form-control required vd_links" name="video_links[<?php echo $i;?>]" autocomplete="off" placeholder="Video Links" value="<?php echo $res;?>"></div>
                              <div class="col-md-2"><button name="remove_links" type="button" class="btn btn-primary remove_links">Remove</button></div>
                           </div>
                        </div>
                        <?php $i++;} } ?>
                  </div> 
                  <?php } ?>             
                  
                  <div class="row">
                    <h6 class="div_title"><strong>SEO Fields</strong></h6> 
                    <hr>
                  </div> 
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('meta_title'); ?></label>
                            <input type="text" id="meta_title" class="form-control" name="meta_title" autocomplete="off" placeholder="<?php _el('meta_title');?>" value="<?php echo $cmsData['meta_title'];?>">
                        </div>
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('meta_keywords'); ?></label>
                            <input type="text" id="meta_keywords" class="form-control" name="meta_keywords" autocomplete="off" placeholder="<?php _el('meta_keywords');?>" value="<?php echo $cmsData['meta_keyword'];?>">
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right"><?php _el('meta_description'); ?></label>
                              <input type="text" id="meta_description" class="form-control" name="meta_description" autocomplete="off" placeholder="<?php _el('meta_description');?>" value="<?php echo $cmsData['meta_description'];?>">
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
                      <input type="hidden" name="cms_page_id" id="cms_page_id" value="<?php echo base64_encode($cmsData['id']);?>">
                      <button type="submit" class="btn btn-primary" name="edit_cms_page"><?php _el('update'); ?></button>
                      <a class="btn btn-default cancel_transfer_edit" href="<?php echo base_url('admin/cms-pages');?>"><?php _el('cancel'); ?></a>
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