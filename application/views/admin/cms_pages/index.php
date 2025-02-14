<!--Page header -->

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('cms_pages_list'); ?></span></h4>
        </div>

    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>"><i class="icon-home2 position-left"></i><?= _l('dashboard'); ?></a>
            </li>
            <li class="active"><?php echo _l('cms_pages_list'); ?></li>
        </ul>

    </div>
</div>
<!-- /Page header -->


<!-- Content area -->
<div class="content">
    <!-- Panel -->
    <div class="panel panel-flat">
      
        <!-- Panel heading -->
        <!-- <div class="panel-heading"> -->
            <!-- <a href="<?php //echo admin_url('cms_pages/add'); ?>" class="btn btn-primary"><?php _el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a> -->
        <!-- </div> -->
        <!-- /Panel heading -->
        <!-- <div class="row">
            <div class="col-sm-12">
                <hr>
            </div>
        </div> -->
        
        <!-- Listing table -->
        <div class="panel-body table-responsive">
            <table id="cms_pages_list_table" class="table table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Page Title</th>
                        <th>Description</th>
                        <!-- <th>Page url</th> -->
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
<!-- /Content area