<!--Page header -->
<div class="page-header">
   <div class="page-header-content">
      <div class="page-title">
         <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('shared_tour_list'); ?></span></h4>
      </div>
   </div>
   <div class="breadcrumb-line breadcrumb-line-component">
      <ul class="breadcrumb">
         <li>
            <a href="<?php echo admin_url(); ?>"><i class="icon-home2 position-left"></i><?= _l('dashboard'); ?></a>
         </li>
         <li class="active"><?php echo _l('shared_tour_list'); ?></li>
      </ul>
   </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
   <div class="panel panel-flat">
      <div class="panel-heading">
         <a href="<?php echo admin_url('shared-tour/add'); ?>" class="btn btn-primary"><?php echo _l('add_shared_tour'); ?><i class="icon-plus-circle2 position-right"></i></a>
         <a href="javascript:delete_selected();" class="btn btn-danger" id="delete_selected">Delete Selected<i style="margin-left:10px;" class="fa fa-trash"></i></a>
      </div>
      <!-- Listing table -->
      <div class="panel-body table-responsive">
         <table id="sharedtour_list_table" class="table table-bordered table-striped" width="100%">
            <thead>
               <tr>
                  <th width="2%">
                     <input type="checkbox" name="select_all" id="select_all" class="styled" onclick="select_all(this);">
                  </th>
                  <th>Passengers</th>
                  <th>Agency</th>
                  <th>Ship</th>
                  <th>Pick up time</th>
                  <th>Notes</th>
                  <th>Date</th>
                  <th>City</th>
                  <th>Tour variable</th>
                  <th>Action</th>
                  <th class="d-none">Id</th>
               </tr>
            </thead>
         </table>
      </div>
      <!-- /Listing table -->
   </div>
   <!-- /Panel -->
</div>