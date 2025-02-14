<!--Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4>
				<span class="text-semibold">Add Newsletter</span>
			</h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo admin_url('newsletter'); ?>"><i class="icon-home2 position-left"></i> Manage Newsletter</a>
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
              <form action="<?php echo admin_url('newsletter/add'); ?>" id="addNewsletterContent" method="POST" enctype="multipart/form-data">
                <fieldset>
                  <legend>Add Newsletter</legend>
                  <!-- <div class="row">
                    <hr>
                  </div> -->
                  <div class="alert alert-danger hidden" id="error_msg_newsletter" >
                            
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                              <label  class="col-form-label label_text text-lg-right ">Newsletter Subject<small class="req text-danger">*</small></label>
                              <input type="text" id="newsletter_subject" class="form-control" name="newsletter_subject" autocomplete="off" placeholder="Newsletter Subject">
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label label_text text-lg-right">Publish Newsletter</label>
                            <div class="" > 
                                <label class="radio-inline col-form-label label_text">
                                <input type="radio" name="is_draft" value="0" checked>Yes</label>
                                <label class="radio-inline col-form-label label_text">
                                <input type="radio" name="is_draft" value="1" >No</label>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                          <div class="col-md-12">
                              <label  class="col-form-label label_text text-lg-right ">Please add newsletter content!</label>
                              <textarea id="newsletter_content" name="newsletter_content"></textarea>
                              <div class="error newsletter-error" id="newsletter_err"></div>
                          </div> 
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right ">Tour Image 1<small class="req text-danger">*</small></label>
                              <input type="file" id="tour_image1" class="form-control" name="tour_image1" autocomplete="off" >
                        </div>
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right ">Tour Image 1 Url</label>
                            <input type="url" id="tour_image1_url" class="form-control" name="tour_image1_url" autocomplete="off" >
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right ">Tour Image 2</label>
                            <input type="file" id="tour_image2" class="form-control" name="tour_image2" autocomplete="off" >
                        </div>
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right ">Tour Image 2 Url</label>
                            <input type="url" id="tour_image2_url" class="form-control" name="tour_image2_url" autocomplete="off" >
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-12">
                            <label  class="col-form-label label_text text-lg-right ">Description</label>
                            <textarea id="newsletter_content_more" name="newsletter_content_more"></textarea>
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
                      <button type="button" class="btn btn-success" id="preview_newsletter">Preview Newsletter</button>
                      <button type="submit" class="btn btn-primary" name="add_newsletter">Add Newsletter</button>
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
