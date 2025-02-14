<!--Page header -->
<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title">
      <h4>
        <span class="text-semibold"><?php _el('edit_review'); ?></span>
      </h4>
    </div>
  </div>
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li>
        <a href="<?php echo admin_url('reviews'); ?>"><i class="icon-home2 position-left"></i><?php _el('manage_review'); ?></a>
      </li>
      <li class="active"><?php _el('edit'); ?></li>
    </ul>
  </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content ">
  <div class="row">
    <div class="col-md-12">
      <!-- Panel -->
      <div class="panel panel-flat">
        <!-- Panel heading -->
        <div class="panel-body">
          <div class="custom-form">
            <form action="<?php echo admin_url('reviews/update'); ?>" id="updateReviewform" method="POST" enctype="multipart/form-data">

              <fieldset>
                <legend><?php echo _l('edit_review'); ?></legend>
                <div class="row">
                  <!-- <h6 class="div_title"><strong><?php //echo _l('review_details');
                                                      ?></strong></h6>  -->
                  <hr>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right "><?php _el('title'); ?><small class="req text-danger">*</small></label>
                      <input type="text" id="review_title" class="form-control" name="review_title" autocomplete="off" placeholder="<?php _el('title'); ?>" value="<?php echo htmlentities($reviewData['title']); ?>">
                    </div>
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right "><?php _el('guest_name'); ?><small class="req text-danger">*</small></label>
                      <input type="text" id="username" class="form-control" name="username" autocomplete="off" placeholder="<?php _el('guest_name'); ?>" value="<?php echo $reviewData['username']; ?>">
                      <div id="user_id_err"></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right">Review for<small class="req text-danger">*</small></label>
                      <div class="">
                        <label class="radio-inline col-form-label label_text">
                          <input type="radio" id="review_for_tour_opt" name="review_for_opt" class="review-for" value="tour" <?= ($reviewData['tour_id']) ? 'checked' : '' ?>>Tour
                        </label>
                        <label class="radio-inline col-form-label label_text">
                          <input type="radio" id="review_for_page_opt" name="review_for_opt" class="review-for" value="page" <?= (!$reviewData['tour_id']) ? 'checked' : '' ?>>Wheelchair tour
                        </label>
                        <div id="review_for_opt_err"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6  tour-id-selction <?= (!$reviewData['tour_id']) ? 'hidden' : '' ?>">
                      <label class="col-form-label label_text text-lg-right "><?php _el('tour_name'); ?><small class="req text-danger">*</small></label>
                      <select name="tour_id" id="tour_id" class="form-control" autocomplete="off">
                        <option value=""><?php _el('select_tour'); ?></option>
                        <?php
                        if (!empty($tourlist)) {
                          foreach ($tourlist as $c) {
                            if ($reviewData['tour_id']) {
                              if ($reviewData['tour_id'] == $c['id']) { ?>
                                <option value="<?= $c['id'] ?>" selected><?php echo $c['unique_code'] . ' - ' . $c['title']; ?></option>
                              <?php } else { ?>
                                <option value="<?= $c['id'] ?>"><?php echo $c['unique_code'] . ' - ' . $c['title']; ?></option>
                              <?php }
                            } else { ?>
                              <option value="<?= $c['id'] ?>"><?php echo $c['unique_code'] . ' - ' . $c['title']; ?></option>
                        <?php }
                          }
                        } ?>
                      </select>
                      <div id="tour_id_err"></div>
                    </div>
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right "><?php _el('city'); ?><small class="req text-danger">*</small></label>
                      <input type="text" id="city" class="form-control" name="city" autocomplete="off" placeholder="<?php _el('city'); ?>" value="<?php echo $reviewData['city']; ?>">
                      <!-- <div id="city_err"></div> -->
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right "><?php _el('country'); ?></label>
                      <input type="text" id="country" class="form-control" name="country" autocomplete="off" placeholder="<?php _el('country'); ?>" value="<?php echo $reviewData['country']; ?>">
                    </div>
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right">Select Date</label>
                      <div class="input-group date review_datepicker">
                        <input type="text" name="review_date" id="review_date" class="form-control  review_date" placeholder="Select Date" autocomplete="off" value="<?php if ($reviewData['review_date'] != "" && $reviewData['review_date'] != "0000-00-00") {
                                                                                                                                                                        echo date('d-m-Y', strtotime($reviewData['review_date']));
                                                                                                                                                                      }; ?>">
                        <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right">Publish Review</label>
                      <div class="">
                        <label class="radio-inline col-form-label label_text">
                          <input type="radio" name="is_draft" value="0" <?php
                                                                        if ($reviewData['is_draft'] == 0) { ?>checked<?php } ?>>Yes</label>
                        <label class="radio-inline col-form-label label_text">
                          <input type="radio" name="is_draft" value="1" <?php
                                                                        if ($reviewData['is_draft'] == 1) { ?>checked<?php } ?>>No</label>
                      </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                  </div>
                </div>
                <div class="form-group mr-t-5">
                  <div class="row blog-cont-wrap">
                    <div class="col-md-12">
                      <label class="col-form-label label_text text-lg-right "><?php _el('description'); ?></label>
                      <textarea id="review_description" name="review_description"><?php echo $reviewData['description']; ?></textarea>
                      <div id="review_description_err"></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right "><?php _el('feature_image'); ?></label>
                      <input type="file" id="feature_image" class="form-control" name="feature_image" autocomplete="off" placeholder="<?php _el('feature_image'); ?>">
                      <input type="hidden" id="feature_img" class="form-control" name="feature_img" autocomplete="off" value="<?php echo $reviewData['feature_image']; ?>">
                      <?php
                      if ($reviewData['feature_image']) { ?>
                        <div id="feature_img_show" class="col-lg-4 col-md-4 col-sm-12 mr-t-5">
                          <a href="<?php echo base_url('uploads/review_images/' . $reviewData['feature_image']); ?>" class="imgClass" target="_blank"><img src="<?php echo base_url('uploads/review_images/' . $reviewData['feature_image']); ?>" width="50" height="50" onerror="this.src=''"> </a>
                          <button title="close" type="button" class="btn delete_feature_img" id="delete_feature_img" data-id="<?php echo base64_encode($reviewData['id']); ?>"><i class="fa fa-close"></i></button>
                          <!-- <a href="<?php //echo base_url().'uploads/review_images/'.$reviewData['feature_image'];
                                        ?>" class="imgClass text_blue" id="view_feature_img" target="_blank" >View Feature Image</a>&nbsp;&nbsp;
                              <a href="javascript:" class="text-danger" id="delete_feature_img" data-id="<?php //echo base64_encode($reviewData['id']);
                                                                                                          ?>">Delete Feature Image</a> -->
                        </div>
                      <?php } ?>
                    </div>
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right "><?php _el('gallery_image'); ?></label>
                      <input type="file" id="gallery_image" class="form-control" name="gallery_image[]" autocomplete="off" multiple>
                      <small class="text-info"><strong>*<?php echo _l('upload_multiple_files'); ?></strong></small>
                      <input type="hidden" name="gallery_img" id="gallery_img" value="<?php if (is_array($reviewGallery) && sizeof($reviewGallery) > 0) {
                                                                                        echo count($reviewGallery);
                                                                                      } ?>">
                      <input type="hidden" name="width_gallery_img" id="width_gallery_img" value="">
                      <input type="hidden" name="height_gallery_img" id="height_gallery_img" value="">
                      <?php
                      if (is_array($reviewGallery) && sizeof($reviewGallery) > 0) { ?>
                        <div id="gallery_img_show">
                          <?php
                          foreach ($reviewGallery as $img) { ?>
                            <div class="col-lg-4 col-md-4 col-sm-12 mr-t-5" id="gallery_img_id<?php echo $img['id']; ?>">
                              <a href="<?php echo base_url('uploads/review_images/' . $img['gallery_image_name']); ?>" class="imgClass" target="_blank"><img src="<?php echo base_url('uploads/review_images/' . $img['gallery_image_name']); ?>" width="50" height="50" onerror="this.src=''"> </a>
                              <button title="close" type="button" class="btn remove_review_gallery_img" data-id="<?php echo base64_encode($img['id']); ?>"><i class="fa fa-close"></i></button>
                            </div>
                          <?php } ?>
                        </div>
                      <?php }   ?>
                    </div>
                  </div>
                </div>


                <!-- <div class="row">
                    <h6 class="div_title"><strong><?php //echo _l('seo_fields');
                                                  ?></strong></h6> 
                    <hr>
                  </div> 
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php //_el('meta_title'); 
                                                                                      ?></label>
                            <input type="text" id="meta_title" class="form-control" name="meta_title" autocomplete="off" placeholder="<?php //_el('meta_title');
                                                                                                                                      ?>">
                        </div>
                        <div class="col-md-6">
                            <label  class="col-form-label label_text text-lg-right "><?php //_el('meta_keywords'); 
                                                                                      ?></label>
                            <input type="text" id="meta_keywords" class="form-control" name="meta_keywords" autocomplete="off" placeholder="<?php //_el('meta_keywords');
                                                                                                                                            ?>">
                        </div>
                    </div>
                  </div> -->
                <!-- <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label  class="col-form-label label_text text-lg-right"><?php //_el('meta_description'); 
                                                                                    ?></label>
                            <textarea rows="4" name="meta_description" id="meta_description" class="form-control" autocomplete="off" placeholder="<?php //_el('meta_description');
                                                                                                                                                  ?>"></textarea>                              
                        </div>
                    </div>
                  </div> -->

                <div class="row mr-t-25">
                  <div class="col-sm-12">
                    <hr>
                  </div>
                </div>
                <div class="row">
                  <div class="btn-bottom-toolbar text-center btn-toolbar-container-out">
                    <input type="hidden" name="review_id" id="review_id" value="<?php echo base64_encode($reviewData['id']); ?>">
                    <button type="submit" class="btn btn-primary" name="edit_review"><?php _el('update'); ?></button>
                    <a class="btn btn-default cancel_review_edit" href="<?php echo admin_url('reviews'); ?>"><?php _el('cancel'); ?></a>
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
<script>
  jQuery(document).ready(function() {
    jQuery("#tour_id").rules('remove', 'required');
  });
</script>