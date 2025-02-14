<!--Page header -->

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/editors/summernote/summernote.min.js'); ?>"></script>

<div class="page-header">

    <div class="page-header-content">

        <div class="page-title">

            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('blogs_list'); ?></span></h4>

        </div>



    </div>



    <div class="breadcrumb-line breadcrumb-line-component">

        <ul class="breadcrumb">

            <li>

                <a href="<?php echo admin_url(); ?>"><i class="icon-home2 position-left"></i><?= _l('manage_blogs'); ?></a>

            </li>

            <li class="active"><?php echo _l('blogs_list'); ?></li>

        </ul>



    </div>

</div>

<!-- /Page header -->





<!-- Content area -->

<div class="content">

    <div class="panel panel-flat">

        <div class="panel-heading">

            <a href="<?php echo admin_url('blogs/add'); ?>" class="btn btn-primary"><?php _el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a>

        </div>        

        <!-- Listing table -->

        <div class="panel-body table-responsive">

            <table id="blog_list_table" class="table table-bordered table-striped" width="100%">

                <thead>

                    <tr>

                        <th></th>

                        <th>Title</th>

                        <th>Categories</th>

                        <th>Status</th>

                        <th>Created at</th>

                        <th>Action</th>

                    </tr>

                </thead>

                

            </table>          

        </div>

        <!-- /Listing table -->

    </div>

    <!-- /Panel -->

</div>