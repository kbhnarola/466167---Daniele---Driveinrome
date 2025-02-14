<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?= _l('tour_category'); ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li>
                <a href="<?= admin_url('tours'); ?>"><i class="icon-home2 position-left"></i><?= _l('manage_tour'); ?></a>
            </li>
            <li class="active"><?= _l('tour_category'); ?></li>
        </ul>
    </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
    <!-- Panel -->
    <div class="panel panel-flat">
        <!-- Panel heading -->
        <div class="panel-heading">
            <a data-toggle="modal" data-target="#add_tour_category_modal" class="btn btn-primary addtourcategories"><?php _el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a>
        </div>
        <!-- /Panel heading -->
        <div class="row">
            <div class="col-sm-12">
                <hr>
            </div>
        </div>
        <!-- Listing table -->
        <div class="panel-body table-responsive">
            <table id="tour_category_list_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>City</th>
                        <!-- <th>Tour Types</th> -->
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /Listing table -->
    </div>
    <!-- /Panel -->
</div>
<!-- /Content area -->
<div id="add_tour_category_modal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog" width="60px">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title addModalTitle"><?php _el('add_tour_categories'); ?></h5>
                <h5 class="modal-title hidden editModalTitle"><?php _el('edit_tour_categories'); ?></h5>
            </div>
            <form id="addTourCategoryform" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger hidden" id="error_msg">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-form-label label_text text-lg-right "><?php echo _l('tour_category'); ?><small class="req text-danger">*</small></label>
                                <input type="text" id="tour_category" class="form-control" name="tour_category" autocomplete="off" placeholder="<?php _el('tour_category'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label label_text text-lg-right "><?php _el('city_featured_image'); ?><small class="req text-danger">*</small></label>
                                <input type="file" id="featured_image" class="form-control " name="featured_image" autocomplete="off" placeholder="<?php _el('city_featured_image'); ?>">
                                <a href="javascript:" class="imgClass hidden" id="view_feature_img" target="_blank" style="color:blue">View Feature Image</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-form-label label_text text-lg-right "><?php _el('city_image'); ?><small class="req text-danger"></small></label>
                                <input type="file" id="city_image" class="form-control " name="city_image" autocomplete="off" placeholder="<?php _el('city_image'); ?>">
                                <a href="javascript:" class="imgClass hidden" id="view_city_img" target="_blank" style="color:blue">View City Image</a>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label label_text text-lg-right "><?php _el('meta_title'); ?></label>
                                <input type="text" id="meta_title" class="form-control" name="meta_title" autocomplete="off" placeholder="<?php _el('meta_title'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-form-label label_text text-lg-right "><?php _el('meta_keywords'); ?></label>
                                <input type="text" id="meta_keywords" class="form-control" name="meta_keywords" autocomplete="off" placeholder="<?php _el('meta_keywords'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label label_text text-lg-right"><?php _el('meta_description'); ?></label>
                                <input type="text" id="meta_description" class="form-control" name="meta_description" autocomplete="off" placeholder="<?php _el('meta_description'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-form-label label_text text-lg-right "><?php _el('youtube_embed_video_url'); ?></label>
                                <input type="text" id="youtube_embed_video_url" class="form-control" name="youtube_embed_video_url" autocomplete="off" placeholder="<?php _el('youtube_embed_video_url'); ?>">
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" class="form-control" id="tour_category_id" name="tour_category_id">
                    <button name="tour_category_submit" type="submit" id="add_tour_category" class="btn btn-primary"><?php _el('save'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _el('close'); ?></button>
                </div>
            </form>
            <div class="text-center hidden" id="loader_cont">
                <img src="<?php echo ASSET . 'images/loader.gif'; ?>">
            </div>
        </div>
    </div>
</div>