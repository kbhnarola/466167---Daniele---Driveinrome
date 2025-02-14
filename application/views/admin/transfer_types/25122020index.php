<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('transfer_type_list'); ?></span></h4>
        </div>

    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li>
                <a href="<?= admin_url(); ?>"><i class="icon-home2 position-left"></i><?= _l('dashboard'); ?></a>
            </li>
            <li class="active"><?= _l('transfer_type_list'); ?></li>
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
            <a data-toggle="modal" data-target="#add_transfer_type_modal" class="btn btn-primary addtransfertypes"><?php _el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a>
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
            <table id="transfer_type_list_table" class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th></th>
                        <th>Product Type</th>
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

<div id="add_transfer_type_modal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog" width="50px">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title addModalTitle"><?php _el('add_transfer_types'); ?></h5>
                <h5 class="modal-title hidden editModalTitle"><?php _el('edit_transfer_types'); ?></h5>
            </div>

            <form  id="addTransferTypeform" method="POST">
                <div class="modal-body">
                      <div class="alert alert-danger hidden" id="error_msg" >
                        
                      </div>
                    <div class="form-group row">
                        <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php _el('transfer_types'); ?><small class="req text-danger">*</small></label>
                        <div class="col-lg-9 col-md-9 col-sm-12">                
                                <input type="text" id="transfer_type" class="form-control" name="transfer_type" autocomplete="off" placeholder="<?php _el('transfer_types');?>">
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer text-center">  
                    <input type="hidden" class="form-control"  id="transfer_type_id" name="transfer_type_id">                  
                    <button name="transfer_type_submit" type="submit" id="add_transfer_type" class="btn btn-primary"><?php _el('save'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _el('close'); ?></button>
                </div>
            </form>
            <div class="text-center hidden" id="loader_cont" >
                <img src="<?php echo ASSET.'images/loader.gif'; ?>">
            </div>
        </div>
    </div>
</div>