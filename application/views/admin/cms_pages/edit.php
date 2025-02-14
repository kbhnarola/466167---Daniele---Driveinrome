<!--Page header -->

<div class="page-header page-header-default">

  <div class="page-header-content">

    <div class="page-title">

      <h4>

        <span class="text-semibold"><?php _el('edit_cms_pages'); ?></span>

      </h4>

    </div>

  </div>

  <div class="breadcrumb-line">

    <ul class="breadcrumb">

      <li>

        <a href="<?php echo admin_url('dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a>

      </li>

      <li>

        <a href="<?php echo admin_url('cms-pages'); ?>"><?php _el('cms_pages'); ?></a>

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

            <form action="<?php echo admin_url('cms_pages/edit/' . base64_encode($cmsData['id'])); ?>" id="addCMSform" method="POST" enctype="multipart/form-data">



              <fieldset>

                <legend><?php echo _l('edit_cms_pages'); ?></legend>



                <div class="form-group">

                  <div class="row">

                    <div class="col-md-12">

                      <label class="col-form-label label_text text-lg-right "><?php _el('title'); ?><small class="req text-danger">*</small></label>

                      <input type="text" id="cms_page_title" class="form-control" name="cms_page_title" autocomplete="off" placeholder="<?php _el('title'); ?>" value="<?php echo $cmsData['page_title']; ?>">

                    </div>

                  </div>

                </div>

                <!-- <div class="form-group">

                    <div class="row">

                        <div class="col-md-12">

                            <label  class="col-form-label label_text text-lg-right "><?php //echo _l('description'); 

                                                                                      ?><small class="req text-danger">*</small></label>

                            <textarea name="description" id="description"><?php //echo $cmsData['description'];

                                                                          ?></textarea>

                            <div id="description_err"></div>

                        </div>

                    </div>

                  </div>  -->

                <?php



                if ($cmsData['id'] == 9) {  ?>

                  <div class="fleet_desc">

                    <div class="form-group">

                      <div class="row">

                        <div class="col-md-10">

                          <button name="add_more_fleet" id="add_more_fleet" type="button" class="btn btn-primary"><?php echo _l('add_more_fleets'); ?></button>

                        </div>

                      </div>

                    </div>

                    <?php

                    $fleet_description = @unserialize($cmsData['description']);

                    if (is_array($fleet_description) && sizeof($fleet_description) > 0) {

                      $j = 0;

                      foreach ($fleet_description as $fleet) { ?>

                        <div class="form-group fl<?php echo $j + 1; ?>">

                          <div class="row">

                            <div class="col-md-6 ">

                              <div class="row div_span">

                                <label class="col-form-label label_text text-lg-right ">Title<small class="req text-danger">*</small></label>

                                <input type="text" class="form-control fleet_title" name="fleet_title[<?php echo $j; ?>]" autocomplete="off" placeholder="Title" value="<?php echo $fleet['fleet_title']; ?>">

                              </div>

                              <div class="row div_span">

                                <label class="col-form-label label_text text-lg-right ">Feature Image<small class="req text-danger">*</small></label>

                                <input type="file" class="form-control fl_feature_img fleet_feature_img" name="fleet_feature_img[<?php echo $j; ?>]" autocomplete="off">

                                <a href="<?php echo base_url('uploads/fleets/' . $fleet['feature_image']); ?>" class="imgClass" target="_blank" style="color:blue">View Feature Image</a>

                              </div>

                            </div>

                            <div class="col-md-6">

                              <div class="row div_span">

                                <label class="col-form-label label_text text-lg-right ">Description<small class="req text-danger">*</small></label>

                                <textarea rows="5" name="fleet_description[<?php echo $j; ?>]" class="form-control resize_box fleet_description"><?php echo $fleet['description']; ?></textarea>

                                <div id="description_err"></div>

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="form-group fl<?php echo $j + 1; ?>">

                          <div class="row">

                            <div class="col-md-3">

                              <button name="remove_fleet" data-index="<?php echo $j + 1; ?>" type="button" class="btn btn-primary remove_fleet">Remove</button>

                            </div>

                          </div>

                        </div>

                    <?php $j++;

                      }

                    } ?>

                  </div>

                <?php } elseif ($cmsData['id'] == 11) { ?>

                  <div class="form-group">

                    <div class="row">

                      <div class="col-md-10">

                        <button name="add_more_static_text" id="add_more_static_text" type="button" class="btn btn-primary">Add More</button>

                      </div>

                    </div>

                  </div>

                  <div class="static_text_travel_agent">

                    <?php

                    $get_text = get_cms_page_static_text($cmsData['id']);

                    if (is_array($get_text) && sizeof($get_text) > 0) {

                      $i = 1;

                      foreach ($get_text as $st) { ?>

                        <div class="m-div">

                          <div class="form-group">

                            <div class="row">

                              <div class="col-md-4">

                                <label class="col-form-label label_text text-lg-right">Static Text Title<small class="req text-danger">*</small></label>

                                <input class="form-control static_title_input required" name="static_title[]" autocomplete="off" placeholder="Title" value="<?php echo $st['s_title']; ?>">

                              </div>

                              <div class="col-md-6">

                                <label class="col-form-label label_text text-lg-right">Description<small class="req text-danger">*</small></label>

                                <textarea rows="4" class="form-control resize_box required static_title_output" name="static_description[]" placeholder="Description"><?php echo $st['s_description']; ?></textarea>

                              </div>

                              <?php

                              if ($i > 1) { ?>

                                <div class="col-md-2 mrg-t-32"><button name="remove_static_info" type="button" class="btn btn-primary remove_static_info">Remove</button></div>

                              <?php } ?>

                            </div>

                          </div>

                        </div>

                      <?php $i++;

                      }

                    } else { ?>

                      <div class="m-div">

                        <div class="form-group">

                          <div class="row">

                            <div class="col-md-4">

                              <label class="col-form-label label_text text-lg-right">Static Text Title<small class="req text-danger">*</small></label>

                              <input class="form-control static_title_input required" name="static_title[]" autocomplete="off" placeholder="Title">

                            </div>

                            <div class="col-md-6">

                              <label class="col-form-label label_text text-lg-right">Description<small class="req text-danger">*</small></label>

                              <textarea rows="4" class="form-control resize_box required static_title_output" name="static_description[]" placeholder="Description"></textarea>

                            </div>

                            <!-- <div class="col-md-2 mrg-t-32"><button name="remove_static_info" type="button" class="btn btn-primary remove_static_info">Remove</button></div> -->

                          </div>

                        </div>

                      </div>

                    <?php } ?>

                  </div>

                <?php } elseif ($cmsData['id'] == 12 || $cmsData['parent_id'] != 0) { ?>

                  <div class="form-group">

                    <div class="row">

                      <div class="col-md-6">

                        <label class="col-form-label label_text text-lg-right">Select Option By<small class="req text-danger">*</small></label>

                        <div class="">

                          <label class="radio-inline col-form-label label_text"><input type="radio" id="promo_file_opt" name="select_promo_opt" value="1" <?php if ($cmsData['promo_file']) { ?>checked<?php } ?>>Promo Video file</label>

                          <label class="radio-inline col-form-label label_text">

                            <input type="radio" id="promo_url_opt" name="select_promo_opt" value="2" <?php if ($cmsData['promo_url']) { ?>checked<?php } ?>>Promo url</label>

                          <div id="select_promo_opt_err"></div>

                        </div>

                      </div>



                      <div class="col-md-6">

                        <?php

                        if ($cmsData['promo_file'] == "" && $cmsData['promo_url'] == "") { ?>

                          <div class="promo_video_file hidden">

                          <?php } elseif ($cmsData['promo_file'] != "" && $cmsData['promo_url'] == "") { ?>

                            <div class="promo_video_file">

                            <?php } else { ?>

                              <div class="promo_video_file hidden">

                              <?php } ?>

                              <label class="col-form-label label_text text-lg-right">Promo Video file</label>

                              <input type="file" class="form-control " name="promo_file" id="promo_file" autocomplete="off">

                              <input type="hidden" class="form-control " name="promo_file_value" id="promo_file_value" value="<?php echo $cmsData['promo_file']; ?>" autocomplete="off">

                              <!-- <div id="promo_file_err"></div> -->

                              <?php

                              if ($cmsData['promo_file']) { ?>

                                <div id="promo_file_show" class="col-lg-4 col-md-4 col-sm-12 mr-t-5">

                                  <a href="<?php echo base_url() . 'uploads/promo_file/' . $cmsData['promo_file']; ?>" class="imgClass text_blue" id="view_promo_file" target="_blank">View</a>&nbsp;&nbsp;

                                  <!-- <a href="javascript:" class="text-danger" id="delete_promo_file" data-id="<?php //echo base64_encode($cmsData['id']);

                                                                                                                  ?>">Remove</a> -->

                                </div>

                              <?php } ?>

                              </div>

                              <?php

                              if ($cmsData['promo_file'] == "" && $cmsData['promo_url'] == "") { ?>

                                <div class="promo_video_url hidden">

                                <?php } elseif ($cmsData['promo_file'] == "" && $cmsData['promo_url'] != "") { ?>

                                  <div class="promo_video_url">

                                  <?php } else { ?>

                                    <div class="promo_video_url hidden">

                                    <?php } ?>

                                    <label class="col-form-label label_text text-lg-right">Promo Video URL</label>

                                    <input type="url" class="form-control " name="promo_url" id="promo_url" autocomplete="off" value="<?php echo htmlentities($cmsData['promo_url']); ?>">



                                    </div>

                                    <div id="promo_url_err"></div>

                                    <div id="promo_file_err" <?php if ($cmsData['promo_file']) { ?>class="mr-t-30" <?php } ?>></div>



                                  </div>

                                </div>

                            </div>

                            <!-- <div class="form-group">

                          <div class="row">

                            <div class="col-md-6">

                              <div id="promo_error" ></div>

                            </div>

                          </div>

                      </div> -->

                            <div class="form-group">

                              <div class="row">

                                <div class="<?= $cmsData['review_type'] == 0 ? 'col-md-12' : 'col-md-6' ?> review-list-wrapper">

                                  <label class="col-form-label label_text text-lg-right">Reviews</label>

                                  <select name="review_ids[]" id="review_ids" class="form-control" autocomplete="off" multiple>

                                    <!-- <option value="">Select Review</option> -->

                                    <?php

                                    $review_ids = explode(',', $cmsData['review_ids']);

                                    if (!empty($reviewlist)) {

                                      foreach ($reviewlist as $c) {

                                        if ($cmsData['review_ids']) {

                                          if (in_array($c['id'], $review_ids)) {

                                    ?>

                                            <option value="<?= $c['id'] ?>" selected><?php echo $c['title']; ?></option>

                                          <?php } else { ?>

                                            <option value="<?= $c['id'] ?>"><?php echo $c['title']; ?></option>

                                          <?php }

                                        } else { ?>

                                          <option value="<?= $c['id'] ?>"><?php echo $c['title']; ?></option>

                                    <?php }

                                      }

                                    }

                                    ?>

                                  </select>

                                  <div id="review_id_err"></div>

                                </div>

                              </div>

                            </div>

                            <div class="form-group">

                              <div class="row">

                                <div class="col-md-10">

                                  <button name="add_more_static_text" id="add_more_static_text" type="button" class="btn btn-primary">Add More</button>

                                </div>

                              </div>

                            </div>

                            <div class="static_text_travel_agent">

                              <?php

                              $get_text = get_cms_page_static_text($cmsData['id']);

                              if (is_array($get_text) && sizeof($get_text) > 0) {

                                $i = 1;

                                foreach ($get_text as $st) { ?>

                                  <div class="m-div">

                                    <div class="form-group">

                                      <div class="row">

                                        <div class="col-md-4">

                                          <label class="col-form-label label_text text-lg-right">Static Text Title<small class="req text-danger">*</small></label>

                                          <input class="form-control static_title_input required" name="static_title[]" autocomplete="off" placeholder="Title" value="<?php echo $st['s_title']; ?>">

                                        </div>

                                        <div class="col-md-6">

                                          <label class="col-form-label label_text text-lg-right">Description<small class="req text-danger">*</small></label>

                                          <textarea rows="4" class="form-control resize_box required static_title_output" name="static_description[]" placeholder="Description"><?php echo $st['s_description']; ?></textarea>

                                        </div>

                                        <?php

                                        if ($i > 1) { ?>

                                          <div class="col-md-2 mrg-t-32"><button name="remove_static_info" type="button" class="btn btn-primary remove_static_info">Remove</button></div>

                                        <?php } ?>

                                      </div>

                                    </div>

                                  </div>

                                <?php $i++;

                                }

                              } else { ?>

                                <div class="m-div">

                                  <div class="form-group">

                                    <div class="row">

                                      <div class="col-md-4">

                                        <label class="col-form-label label_text text-lg-right">Static Text Title<small class="req text-danger">*</small></label>

                                        <input class="form-control static_title_input required" name="static_title[]" autocomplete="off" placeholder="Title">

                                      </div>

                                      <div class="col-md-6">

                                        <label class="col-form-label label_text text-lg-right">Description<small class="req text-danger">*</small></label>

                                        <textarea rows="4" class="form-control resize_box required static_title_output" name="static_description[]" placeholder="Description"></textarea>

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              <?php } ?>

                            </div>

                            <?php } else {

                            if ($cmsData['id'] != 10) { ?>

                              <div class="form-group">

                                <div class="row">

                                  <div class="col-md-12">

                                    <label class="col-form-label label_text text-lg-right "><?php echo _l('description'); ?><small class="req text-danger">*</small></label>

                                    <textarea name="description" id="description"><?php echo $cmsData['description']; ?></textarea>

                                    <div id="description_err"></div>

                                  </div>

                                </div>

                              </div>

                            <?php }

                          }



                          if ($cmsData['id'] == 1) { ?>

                            <div class="video_links">

                              <div class="form-group">

                                <div class="row">

                                  <div class="col-md-10">

                                    <button name="add_video_link" id="add_video_link" type="button" class="btn btn-primary"><?php echo _l('add_video_links'); ?></button>

                                  </div>

                                </div>

                              </div>

                              <?php

                              $video_links = unserialize($cmsData['video_links']);

                              if (is_array($video_links) && sizeof($video_links) > 0) {

                                $i = 0;

                                foreach ($video_links as $res) { ?>

                                  <div class="form-group">

                                    <div class="row">

                                      <div class="col-md-3"><input type="text" class="form-control required vd_links" name="video_links[<?php echo $i; ?>]" autocomplete="off" placeholder="Youtube Links" value="<?php echo $res['you_tube_link']; ?>"></div>

                                      <div class="col-md-3">



                                        <input type="file" class="form-control links_feature_img feature_img" name="feature_image[<?php echo $i; ?>]" id="feature_image<?php echo $i; ?>" autocomplete="off" placeholder="Feature image">

                                        <a href="<?php echo base_url('uploads/about_us/' . $res['feature_image']); ?>" class="imgClass" target="_blank" style="color:blue">View Feature Image</a>



                                      </div>

                                      <div class="col-md-3"><input type="text" class="form-control required links_title" name="link_title[<?php echo $i; ?>]" autocomplete="off" placeholder="Title" value="<?php echo $res['title']; ?>" maxlength="30"></div>

                                      <div class="col-md-3"><button name="remove_links" type="button" class="btn btn-primary remove_links">Remove</button></div>

                                    </div>

                                  </div>

                              <?php $i++;

                                }

                              } ?>

                            </div>

                            <input type="hidden" name="about_us_gallery" value='<?php echo $cmsData['video_links']; ?>'>

                          <?php } ?>



                          <div class="row">

                            <h6 class="div_title"><strong>SEO Fields</strong></h6>

                            <hr>

                          </div>

                          <div class="form-group">

                            <div class="row">

                              <div class="col-md-6">

                                <label class="col-form-label label_text text-lg-right "><?php _el('meta_title'); ?></label>

                                <input type="text" id="meta_title" class="form-control" name="meta_title" autocomplete="off" placeholder="<?php _el('meta_title'); ?>" value="<?php echo $cmsData['meta_title']; ?>">

                              </div>

                              <div class="col-md-6">

                                <label class="col-form-label label_text text-lg-right "><?php _el('meta_keywords'); ?></label>

                                <input type="text" id="meta_keywords" class="form-control" name="meta_keywords" autocomplete="off" placeholder="<?php _el('meta_keywords'); ?>" value="<?php echo $cmsData['meta_keyword']; ?>">

                              </div>

                            </div>

                          </div>

                          <div class="form-group">

                            <div class="row">

                              <div class="col-md-6">

                                <label class="col-form-label label_text text-lg-right"><?php _el('meta_description'); ?></label>

                                <input type="text" id="meta_description" class="form-control" name="meta_description" autocomplete="off" placeholder="<?php _el('meta_description'); ?>" value="<?php echo $cmsData['meta_description']; ?>">

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

                              <input type="hidden" name="cms_page_id" id="cms_page_id" value="<?php echo base64_encode($cmsData['id']); ?>">

                              <input type="hidden" name="cms_parent_id" id="cms_parent_id" value="<?php echo base64_encode($cmsData['parent_id']); ?>">

                              <button type="submit" class="btn btn-primary" name="edit_cms_page"><?php _el('update'); ?></button>

                              <a class="btn btn-default cancel_transfer_edit" href="<?php echo admin_url('cms-pages'); ?>"><?php _el('cancel'); ?></a>

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