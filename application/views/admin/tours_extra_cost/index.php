<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?= _l('tour_extra_cost'); ?></span></h4>
        </div>

    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li>
                <a href="<?= admin_url('/tour'); ?>"><i class="icon-home2 position-left"></i><?= _l('manage_tour'); ?></a>
            </li>
            <li class="active"><?= _l('tour_extra_cost'); ?></li>
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
            <a data-toggle="modal" data-target="#add_extra_cost_modal" class="btn btn-primary addextraservices"><?php _el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a>
        </div>
        <!-- /Panel heading -->
        <div class="row">
            <div class="col-sm-12">
                <hr>
            </div>
        </div>

        <!-- Listing table -->
        <div class="panel-body table-responsive">
            <table id="extra_cost_list_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Tour Extra Cost Title</th>
                        <th>Price</th>
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

<div id="add_extra_cost_modal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog tour_upgrade_modal" width="50px">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title addModalTitle"><?php _el('add_extra_cost'); ?></h5>
                <h5 class="modal-title hidden editModalTitle"><?php _el('edit_extra_cost'); ?></h5>
            </div>

            <form id="addExtraCostform" method="POST">
                <div class="modal-body">
                    <div class="alert alert-danger hidden" id="error_msg">

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-form-label label_text text-lg-right "><?php _el('extra_cost_title'); ?><small class="req text-danger">*</small></label>
                                <input type="text" id="extra_cost_title" class="form-control" name="extra_cost_title" autocomplete="off" placeholder="<?php _el('extra_cost_title'); ?>">
                            </div>
                            <div class="col-md-6 b_price">
                                <label class="col-form-label label_text text-lg-right "><?php _el('price'); ?><small class="req text-danger">*</small></label>
                                <input type="number" id="price" class="form-control" name="price" autocomplete="off" placeholder="<?php _el('price'); ?>" min="1">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6"> -->
                    <!-- </div> -->
                </div>
                <!-- <div class="row">
                            <div class="col-sm-12">
                                <hr>
                            </div>
                        </div> -->
                <div class="modal-footer text-center">
                    <input type="hidden" class="form-control" id="extra_cost_id" name="extra_cost_id">
                    <button name="tour_type_submit" type="submit" id="add_tour_type" class="btn btn-primary"><?php _el('save'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _el('close'); ?></button>
                </div>
            </form>
            <div class="text-center hidden" id="loader_cont">
                <img src="<?php echo ASSET . 'images/loader.gif'; ?>">
            </div>
        </div>
    </div>
</div>