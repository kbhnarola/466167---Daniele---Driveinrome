<!--Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4>
				<span class="text-semibold"><?php _el('add_blog'); ?></span>
			</h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo admin_url('blogs'); ?>"><i class="icon-home2 position-left"></i><?php _el('manage_blogs'); ?></a>
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
              <form action="<?php echo admin_url('blogs/add'); ?>" id="addBlogform" method="POST" enctype="multipart/form-data">
                
                <fieldset>
                  <legend><?php echo _l('add_blog');?></legend>
                  <div class="row">
                    <h6 class="div_title"><strong><?php echo _l('blog_details');?></strong></h6> 
                    <hr>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('blog_title'); ?><small class="req text-danger">*</small></label>
                            <input type="text" id="blog_title" class="form-control" name="blog_title" autocomplete="off" placeholder="<?php _el('blog_title');?>">
                        </div>
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('blog_category'); ?><small class="req text-danger">*</small></label>
                            <select name="blog_categories[]" id="blog_categories" class="form-control" autocomplete="off" placeholder="<?php _el('select_blog_category');?>" multiple="true">
                                <?php
                                if(!empty($blog_categories)){
                                    foreach($blog_categories as $single_cat){
                                        ?><option value="<?=$single_cat['id']?>"><?=$single_cat['name']?></option><?php
                                    }
                                }
                                ?>
                            </select>
                            <div id="blog_categories_err"></div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('feature_image'); ?><small class="req text-danger">*</small></label>
                            <input type="file" id="feature_image" class="form-control" name="feature_image" autocomplete="off" placeholder="<?php _el('feature_image');?>">
                        </div>
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php _el('banner_image'); ?><small class="req text-danger">*</small></label>
                            <input type="file" id="banner_image" class="form-control" name="banner_image" autocomplete="off" placeholder="<?php _el('banner_image');?>">
                        </div>
                      </div>
                  </div> 
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                            <label class="col-form-label label_text text-lg-right">Save as Draft</label>
                            <div class="" > 
                                <label class="radio-inline col-form-label label_text">
                                <input type="radio" name="is_draft" value="1">Yes</label>
                                <label class="radio-inline col-form-label label_text">
                                <input type="radio" name="is_draft" value="0" checked>No</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                      </div>
                  </div>
                  <div class="form-group mr-t-5">
                    <div class="row blog-cont-wrap">
                        <div class="col-md-12">
                          <label  class="col-form-label label_text text-lg-right "><?php  _el('blog_content'); ?>:</label>
                          <textarea id="blog_content" name="blog_content"></textarea>
                        </div>
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
                        <div class="col-md-12">
                            <label  class="col-form-label label_text text-lg-right"><?php _el('meta_description'); ?></label>
                            <textarea rows="4" name="meta_description" id="meta_description" class="form-control" autocomplete="off" placeholder="<?php _el('meta_description');?>"></textarea>                              
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
                      
                      <button type="submit" class="btn btn-primary" name="add_blog"><?php _el('add_blog'); ?></button>
                      <button type="reset" class="btn btn-default" name="reset_blog" id="reset_blog"><?php _el('reset'); ?></button>
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
