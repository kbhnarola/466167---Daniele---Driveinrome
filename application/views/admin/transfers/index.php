<!-- Page header -->

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('transfer_services'); ?></span></h4>
        </div>

    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li>
                <a href="javascript:"><i class="icon-home2 position-left"></i><?= _l('manage_transfer'); ?></a>
            </li>
            <li class="active"><?php echo _l('transfer_services'); ?></li>
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
            <a href="<?php echo admin_url('transfers/add'); ?>" class="btn btn-primary"><?php _el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a>
        </div>
        <!-- /Panel heading -->
        <div class="row">
            <div class="col-sm-12">
                <hr>
            </div>
        </div>
        
        <!-- Listing table -->
        <div class="panel-body table-responsive">
            <table id="transfer_list_table" class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th></th>
                        <th>Transfer Services</th>
                        <th>Transfer Type</th>
                        <th>Transfer City</th>                        
                        <th>Unique Code</th>
                        <th>Duration</th>
                        <th>Rating</th>
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