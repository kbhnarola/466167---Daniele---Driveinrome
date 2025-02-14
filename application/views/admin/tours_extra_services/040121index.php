<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?= _l('tour_extra_services'); ?></span></h4>
        </div>

    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li>
                <a href="<?= admin_url('/tours'); ?>"><i class="icon-home2 position-left"></i><?= _l('manage_tour'); ?></a>
            </li>
            <li class="active"><?= _l('tour_extra_services'); ?></li>
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
            <a data-toggle="modal" data-target="#add_extra_service_modal" class="btn btn-primary addextraservices"><?php _el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a>
            <!-- <a href="<?php //echo base_url('admin/tour_types/add'); ?>" class="btn btn-primary"><?php //_el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a> -->
        </div>
        <!-- /Panel heading -->
        <div class="row">
            <div class="col-sm-12">
                <hr>
            </div>
        </div>
        
        <!-- Listing table -->
        <div class="panel-body table-responsive">
            <table id="extra_service_list_table" class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th></th>
                        <th>Tour Upgrades</th>
                        <th>Price</th>
                        <!-- <th>Description</th> -->
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

<div id="add_extra_service_modal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog" width="50px">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title addModalTitle"><?php _el('add_extra_services'); ?></h5>
                <h5 class="modal-title hidden editModalTitle"><?php _el('edit_extra_services'); ?></h5>
            </div>

            <form  id="addExtraServiceform" method="POST">
                <div class="modal-body">
                      <div class="alert alert-danger hidden" id="error_msg" >
                        
                      </div>
                    <div class="form-group row">
                        <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php _el('extra_service_title'); ?><small class="req text-danger">*</small></label>
                        <div class="col-lg-8 col-md-8 col-sm-12">                
                                <input type="text" id="extra_service_title" class="form-control" name="extra_service_title" autocomplete="off" placeholder="<?php _el('extra_service_title');?>">
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php _el('price'); ?><small class="req text-danger">*</small></label>
                        <div class="col-lg-8 col-md-8 col-sm-12">                
                                <input type="number" id="price" class="form-control" name="price" autocomplete="off" placeholder="<?php _el('price');?>" min="1">
                        </div>                        
                    </div>
                    <div class="form-group row">
                        <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12 ">Select Rate Option<small class="req text-danger">*</small></label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            
                            <label class="radio-inline col-form-label label_text">
                              <input type="radio" id="rate_opt" name="rate_opt" value="0">Flat Rate
                              
                            </label>
                            <label class="radio-inline col-form-label label_text">
                                <input type="radio" id="rate_opt1" name="rate_opt" value="1">Per Person Rate
                              
                            </label>  
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php _el('description'); ?></label>
                        <div class="col-lg-8 col-md-8 col-sm-12">                
                                <textarea rows="5" class="form-control resize_box" name="description" id="description"></textarea>
                        </div>                        
                    </div>
                </div>
                <!-- <div class="row">
                            <div class="col-sm-12">
                                <hr>
                            </div>
                        </div> -->
                <div class="modal-footer text-center">  
                    <input type="hidden" class="form-control"  id="extra_service_id" name="extra_service_id">                  
                    <button name="tour_type_submit" type="submit" id="add_tour_type" class="btn btn-primary"><?php _el('save'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _el('close'); ?></button>
                </div>
            </form>
            <div class="text-center hidden" id="loader_cont" >
                <img src="<?php echo ASSET.'images/loader.gif'; ?>">
            </div>
        </div>
    </div>
</div>