<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<div class="page-header page-header-default">

    <!-- <div class="page-header-content">

        <div class="page-title">

            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('term'); ?></span></h4>

        </div>

    </div> -->


    <?php //var_dump($umbriavilla_details);
    //die; ?>
    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="<?= admin_url() ?>"><i class="icon-home2 position-left"></i><?php echo _l('term'); ?></a>
            </li>

        </ul>

    </div>

</div>

<!-- /Page header -->



<!-- Content area -->

<div class="content">

    <div class="row">

        <div class="col-md-12">

            <!-- Panel -->



            <form action="#" id="termsDetails" method="POST" enctype="multipart/form-data">

                <div class="panel panel-flat">

                    <div class="panel-body">

                        <div class="custom-form tour-close-wrapper">

                            <fieldset>

                                <legend>Terms & Condtion</legend>

                                <div class="form-group">

                                    <div class="row">
                                    
                                        <!-- Description Input Field (with CKEditor) -->
                                        <div class="col-md-12 mt-3">
                                            <label class="col-form-label label_text">Terms & Condtion <small
                                                    class="req text-danger">*</small></label>
                                            <textarea name="terms_condtion" id="terms_condtion"
                                                class="form-control" rows="12"
                                                required><?= isset($terms_condtion['terms_condtion']) ? htmlspecialchars($terms_condtion['terms_condtion']) : '' ?></textarea>
                                        </div>

                                    <div class="row mr-t-10">

                                        <div class="col-sm-12">
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="btn-bottom-toolbar text-center btn-toolbar-container-out">



                                            <button type="submit" class="btn btn-primary"><?php _el('save'); ?></button>

                                            <button type="reset" class="btn btn-default"
                                                id="reset_open_close_tour"><?php _el('reset'); ?></button>

                                        </div>

                                    </div>

                                </div>

                                </legend>

                            </fieldset>

                        </div>

                    </div>

                </div>

            </form>

            <!-- /Panel -->

        </div>

    </div>

</div>

<!-- /page header -->

<!-- Add CKEditor Script -->
<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/terms.js'); ?>"></script>