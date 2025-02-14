<!--Page header -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/editors/summernote/summernote.min.js'); ?>"></script>
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('blogs_categories_list'); ?></span></h4>
        </div>

    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>"><i class="icon-home2 position-left"></i><?= _l('dashboard'); ?></a>
            </li>
            <li class="active"><?php echo _l('blogs_categories_list'); ?></li>
        </ul>

    </div>
</div>
<!-- /Page header -->


<!-- Content area -->
<div class="content">
    <div class="panel panel-flat"> 
        <!-- Panel heading -->
        <div class="panel-heading">
            <a data-toggle="modal" data-target="#add_blog_category_modal" class="btn btn-primary addblogcat"><?php _el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a>
        </div>
        <!-- /Panel heading -->
        <div class="row">
            <div class="col-sm-12">
                <hr>
            </div>
        </div>       
        <!-- Listing table -->
        <div class="panel-body table-responsive">
            <table id="blog_cat_list_table" class="table table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
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

<div id="add_blog_category_modal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog" width="50px">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title addModalTitle"><?php _el('add_blog_category'); ?></h5>
                <h5 class="modal-title hidden editModalTitle"><?php _el('edit_blog_category'); ?></h5>
            </div>

            <form id="addBlogCategoryform" method="POST">
                <div class="modal-body">
                    <div class="alert alert-danger hidden" id="error_msg">
                    
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label  class="col-form-label label_text text-lg-right "><?php echo _l('blog_category'); ?><small class="req text-danger">*</small></label>
                                <input type="text" id="blog_category" class="form-control" name="blog_category" autocomplete="off" placeholder="<?php _el('blog_category');?>">
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label  class="col-form-label label_text text-lg-right "><?php echo _l('blog_parent_category'); ?></label>
                                <select id="blog_parent_category" class="form-control" name="blog_parent_category" autocomplete="off" placeholder="<?php _el('blog_parent_category');?>">
                                    <option></option>
                                    <?php
                                    if(!empty($blog_cat)){
                                        foreach($blog_cat as $single_cat){
                                            ?><option value="<?=$single_cat['id']?>"><?=$single_cat['name']?></option><?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                  <label  class="col-form-label label_text text-lg-right "><?php _el('meta_title'); ?></label>
                                  <input type="text" id="meta_title" class="form-control" name="meta_title" autocomplete="off" placeholder="<?php _el('meta_title');?>">
                            </div>
                            <div class="col-md-6">
                                  <label  class="col-form-label label_text text-lg-right "><?php _el('meta_keywords'); ?></label>
                                  <input type="text" id="meta_keywords" class="form-control" name="meta_keywords" autocomplete="off" placeholder="<?php _el('meta_keywords');?>">
                            </div>                            
                        </div>
                    </div>
                   <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label  class="col-form-label label_text text-lg-right"><?php _el('meta_description'); ?></label>
                                <input type="text" id="meta_description" class="form-control" name="meta_description" autocomplete="off" placeholder="<?php _el('meta_description');?>">
                            </div>
                            <div class="col-md-6">
                                  
                            </div>
                        </div>
                    </div>                  
                </div>
                <div class="modal-footer text-center">  
                    <input type="hidden" class="form-control"  id="blog_category_id" name="blog_category_id" value="">                  
                    <button name="transfer_category_submit" type="submit" id="add_transfer_category" class="btn btn-primary"><?php _el('save'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _el('close'); ?></button>
                </div>
            </form>
            <div class="text-center hidden" id="loader_cont" >
                <img src="<?php echo ASSET.'images/loader.gif'; ?>">
            </div>
        </div>
    </div>
</div>