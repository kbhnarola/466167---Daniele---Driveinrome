<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?= _l('tour_city_list'); ?></span></h4>
        </div>

    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li>
                <a href="<?= admin_url(); ?>"><i class="icon-home2 position-left"></i><?= _l('dashboard'); ?></a>
            </li>
            <li class="active"><?= _l('tour_city_list'); ?></li>
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
            <a data-toggle="modal" data-target="#add_tour_city_modal" class="btn btn-primary addtourcities"><?php _el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a>
        </div>
        <!-- /Panel heading -->
        <div class="row">
            <div class="col-sm-12">
                <hr>
            </div>
        </div>
        
        <!-- Listing table -->
        <div class="panel-body table-responsive">
            <table id="tour_city_list_table" class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tour Cities</th>
                        <th>Tour Types</th>
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

<div id="add_tour_city_modal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog" width="50px">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title addModalTitle"><?php _el('add_tour_cities'); ?></h5>
                <h5 class="modal-title hidden editModalTitle"><?php _el('edit_tour_cities'); ?></h5>
            </div>

            <form id="addTourCityform" method="POST">
                <div class="modal-body">
                      <div class="alert alert-danger hidden" id="error_msg">
                        
                      </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label><strong><?php echo _l('select_',_l('tour_type')); ?></strong></label>
                                <small class="req text-danger">*</small> 
                                <select id="tour_type" name="tour_type" class="form-control">
                                    <option value=""><?php echo _l('select_',_l('tour_type'));?></option>
                                    <?php
                                        foreach ($tour_types as $j) {
                                          ?>
                                          <option value="<?php echo $j['id']; ?>" ><?php echo $j['title']; ?></option>
                                          <?php
                                        }
                                    ?> 
                                </select>                           
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label><strong><?php _el('tour_city'); ?></strong></label>
                                <small class="req text-danger">*</small>                               
                                <input type="text" id="tour_city" class="form-control" name="tour_city" autocomplete="off" placeholder="<?php _el('tour_city');?>">
                                        
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer text-left">  
                    <input type="hidden" class="form-control"  id="tour_city_id" name="tour_city_id">                  
                    <button name="tour_city_submit" type="submit" id="add_tour_city" class="btn btn-primary"><?php _el('save'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _el('close'); ?></button>
                </div>
            </form>
            <div class="text-center hidden" id="loader_cont" >
                <img src="<?php echo ASSET.'images/loader.gif'; ?>">
            </div>
        </div>
    </div>
</div>