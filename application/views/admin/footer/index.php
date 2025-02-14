<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<div class="page-header page-header-default">

    <!-- <div class="page-header-content">

        <div class="page-title">

            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('footer'); ?></span></h4>

        </div>

    </div> -->


    <?php //var_dump($umbriavilla_details);
    //die; ?>
    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="<?= admin_url() ?>"><i class="icon-home2 position-left"></i><?php echo _l('footer'); ?></a>
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



            <form action="#" id="footerDetails" method="POST" enctype="multipart/form-data">

                <div class="panel panel-flat">

                    <div class="panel-body">

                        <div class="custom-form tour-close-wrapper">

                            <fieldset>

                                <legend>Footer Details</legend>
                                <?php //var_dump( $footer_details); die; ?>
                                <div class="form-group">

                                    <div class="row">
                                        <!-- footer Name Input Field -->
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Title<small
                                                    class="req text-danger">*</small></label>
                                            <input type="text" id="footertitle" name="footer_title" class="form-control"
                                                placeholder="Enter footer title" required
                                                value="<?= isset($footer_details['footer_title']) ? htmlspecialchars($footer_details['footer_title']) : '' ?>">
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Sub Title<small
                                                    class="req text-danger">*</small></label>
                                            <input type="text" id="footerSubtitle" name="footer_sub_title" class="form-control"
                                                placeholder="Enter footer Sub title" required
                                                value="<?= isset($footer_details['footer_sub_title']) ? htmlspecialchars($footer_details['footer_sub_title']) : '' ?>">
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Contact Number 1<small
                                                    class="req text-danger">*</small></label>
                                            <input type="text" id="footercontact1" name="footer_contact1" class="form-control"
                                                placeholder="Enter footer contact number 1" required
                                                value="<?= isset($footer_details['footer_contact1']) ? htmlspecialchars($footer_details['footer_contact1']) : '' ?>">
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Contact Number 2</label>
                                            <input type="text" id="footercontact2" name="footer_contact2" class="form-control"
                                            placeholder="Enter footer contact number 2" 
                                            value="<?= isset($footer_details['footer_contact2']) ? htmlspecialchars($footer_details['footer_contact2']) : '' ?>">
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">WhatsApp Number<small
                                                    class="req text-danger">*</small></label>
                                            <input type="text" id="footerwhatsapp" name="footer_whatsapp" class="form-control"
                                                placeholder="Enter footer whatsapp number" required
                                                value="<?= isset($footer_details['footer_whatsapp']) ? htmlspecialchars($footer_details['footer_whatsapp']) : '' ?>">
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Email<small
                                                    class="req text-danger">*</small></label>
                                            <input type="email" id="footeremail" name="footer_email" class="form-control"
                                                placeholder="Enter footer email" required
                                                value="<?= isset($footer_details['footer_email']) ? htmlspecialchars($footer_details['footer_email']) : '' ?>">
                                        </div>
                                       
                                        <div class="row mr-t-10">

                                            <div class="col-sm-12">
                                            </div>

                                        </div>

                                        <div class="row mt-5">

                                            <div class="btn-bottom-toolbar text-center btn-toolbar-container-out">



                                                <button type="submit"
                                                    class="btn btn-primary"><?php _el('save'); ?></button>

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

<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/footer.js'); ?>"></script>