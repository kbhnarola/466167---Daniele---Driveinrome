<!--Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4>
				<span class="text-semibold">Edit Newsletter</span>
			</h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo admin_url('newsletter'); ?>"><i class="icon-home2 position-left"></i> Manage Newsletter</a>
			</li>
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
              <form action="<?php echo admin_url('newsletter/update'); ?>" id="editNewsletterContent" method="POST" enctype="multipart/form-data">
                <fieldset>
                  <legend>Edit Newsletter</legend>
                  <!-- <div class="row">
                    <hr>
                  </div> -->
                  <div class="alert alert-danger hidden" id="error_msg_newsletter" >
                            
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                              <label  class="col-form-label label_text text-lg-right ">Newsletter Subject<small class="req text-danger">*</small></label>
                              <input type="text" id="newsletter_subject" class="form-control" name="newsletter_subject" autocomplete="off" placeholder="Newsletter Subject" value="<?php echo $newsletterData['newsletter_subject'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label label_text text-lg-right">Publish Newsletter</label>
                            <div class="" > 
                                <label class="radio-inline col-form-label label_text">
                                <input type="radio" name="is_draft" value="0" <?php 
                                if($newsletterData['is_draft']==0){ ?>checked<?php } ?>>Yes</label>
                                <label class="radio-inline col-form-label label_text">
                                <input type="radio" name="is_draft" value="1" <?php 
                                if($newsletterData['is_draft']==1){ ?>checked<?php } ?>>No</label>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                          <div class="col-md-12">
                              <label  class="col-form-label label_text text-lg-right ">Please add newsletter content!</label>
                              <textarea id="newsletter_content" name="newsletter_content"><?php echo $newsletterData['email_content'] ?></textarea>
                              <div class="error newsletter-error" id="newsletter_err"></div>
                          </div> 
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right ">Tour Image 1<small class="req text-danger">*</small></label>
                              <input type="file" id="tour_image1" class="form-control" name="tour_image1" autocomplete="off" >
                              <input type="hidden" id="first_tour_img" class="form-control" name="first_tour_img" autocomplete="off" value="<?php echo $newsletterData['tour_image_1']; ?>">
                              <?php 
                              if($newsletterData['tour_image_1']){ ?>
                              <div id="first_tour_img_show" class="col-lg-4 col-md-4 col-sm-12 mr-t-5">
                                <a href="<?php echo base_url('uploads/newsletter_images/'.$newsletterData['tour_image_1']); ?>" class="imgClass" target="_blank"><img src="<?php echo base_url('uploads/newsletter_images/'.$newsletterData['tour_image_1']);?>" width="50" height="50" onerror="this.src=''"> </a>
                                  <button title="close" type="button" class="btn delete_feature_img delete_first_tour_img" id="delete_first_tour_img" data-id="<?php echo base64_encode($newsletterData['id']);?>" ><i class="fa fa-close"></i></button>
                              </div>
                              <?php } ?>
                        </div>
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right ">Tour Image 1 Url</label>
                            <input type="url" id="tour_image1_url" class="form-control" name="tour_image1_url" autocomplete="off" value="<?php echo $newsletterData['tour_image1_url'] ?>">
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right ">Tour Image 2</label>
                            <input type="file" id="tour_image2" class="form-control" name="tour_image2" autocomplete="off" >
                            <input type="hidden" id="second_tour_img" class="form-control" name="second_tour_img" autocomplete="off" value="<?php echo $newsletterData['tour_image_2']; ?>">
                              <?php 
                              if($newsletterData['tour_image_2']){ ?>
                              <div id="second_tour_img_show" class="col-lg-4 col-md-4 col-sm-12 mr-t-5">
                                <a href="<?php echo base_url('uploads/newsletter_images/'.$newsletterData['tour_image_2']); ?>" class="imgClass" target="_blank"><img src="<?php echo base_url('uploads/newsletter_images/'.$newsletterData['tour_image_2']);?>" width="50" height="50" onerror="this.src=''"> </a>
                                  <button title="close" type="button" class="btn delete_feature_img delete_second_tour_img" id="delete_second_tour_img" data-id="<?php echo base64_encode($newsletterData['id']);?>" ><i class="fa fa-close"></i></button>
                              </div>
                              <?php } ?>
                        </div>
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right ">Tour Image 2 Url</label>
                            <input type="url" id="tour_image2_url" class="form-control" name="tour_image2_url" autocomplete="off" value="<?php echo $newsletterData['tour_image2_url'] ?>">
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-12">
                            <label  class="col-form-label label_text text-lg-right ">Description</label>
                            <textarea id="newsletter_content_more" name="newsletter_content_more"><?php echo $newsletterData['newsletter_content_2'] ?></textarea>
                            <div class="error newsletter-error-1"></div>
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
                      <input type="hidden" name="newsletter_id" id="newsletter_id" value="<?php echo base64_encode($newsletterData['id']);?>">
                      <button type="button" class="btn btn-success" id="preview_newsletter">Preview Newsletter</button>
                      <button type="submit" class="btn btn-primary" name="add_newsletter">Save Changes</button>
                      <button type="reset" class="btn btn-default" name="reset_newsletter" id="reset_newsletter"><?php _el('reset'); ?></button>
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
