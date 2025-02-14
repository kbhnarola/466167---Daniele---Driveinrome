<!--Page header -->
<div class="page-header">
   <div class="page-header-content">
      <div class="page-title">
         <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('review_list'); ?></span></h4>
      </div>
   </div>
   <div class="breadcrumb-line breadcrumb-line-component">
      <ul class="breadcrumb">
         <li>
            <a href="<?php echo admin_url(); ?>"><i class="icon-home2 position-left"></i><?= _l('dashboard'); ?></a>
         </li>
         <li class="active"><?php echo _l('review_list'); ?></li>
      </ul>
   </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
   <div class="panel panel-flat">
      <div class="panel-heading">
         <a href="<?php echo admin_url('reviews/add'); ?>" class="btn btn-primary"><?php _el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a>
      </div>
      <!-- Listing table -->
      <div class="panel-body table-responsive">
         <table id="review_list_table" class="table table-bordered table-striped" width="100%">
            <thead>
               <tr>
                  <th></th>
                  <th>Title</th>
                  <th>User Name</th>
                  <th>Tour Name/CMS Page</th>
                  <th>Date</th>
                  <th>City</th>
                  <th>Country</th>
                  <th>Action</th>
               </tr>
            </thead>
         </table>
      </div>
      <!-- /Listing table -->
   </div>
   <!-- /Panel -->
</div>