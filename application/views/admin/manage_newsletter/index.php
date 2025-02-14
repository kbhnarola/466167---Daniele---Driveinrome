<!--Page header -->
<div class="page-header">
   <div class="page-header-content">
      <div class="page-title">
         <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Newsletter List</span></h4>
      </div>
   </div>
   <div class="breadcrumb-line breadcrumb-line-component">
      <ul class="breadcrumb">
         <li>
            <a href="<?php echo admin_url(); ?>"><i class="icon-home2 position-left"></i><?= _l('dashboard'); ?></a>
         </li>
         <li class="active">Newsletter List</li>
      </ul>
   </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
   <div class="panel panel-flat">
      <div class="panel-heading">
         <a href="<?php echo admin_url('newsletter/add'); ?>" class="btn btn-primary">Add Newsletter<i class="icon-plus-circle2 position-right"></i></a>
      </div>
      <!-- Listing table -->
      <div class="panel-body table-responsive">
         <table id="newsletter_list_table" class="table table-bordered table-striped" width="100%">
            <thead>
               <tr>
                  <!-- <th></th> -->
                  <th>Subject</th>
                  <!-- <th>Status</th> -->
                  <th>Action</th>
               </tr>
            </thead>
         </table>
      </div>
      <!-- /Listing table -->
   </div>
   <!-- /Panel -->
</div>