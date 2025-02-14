<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<div class="page-header page-header-default">
    <!-- <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('inquire'); ?></span></h4>
        </div>
    </div> -->

    <?php //var_dump($umbriavilla_details);
    //die; ?>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?= admin_url() ?>"><i class="icon-home2 position-left"></i><?php echo _l('inquire'); ?></a>
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
            <form action="#" id="inquireDetails" method="POST">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="custom-form tour-close-wrapper">
                            <fieldset>
                                <legend>Inquire</legend>
                                <div class="form-group">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-form-label label_text">Inquire Description <small
                                                    class="req text-danger">*</small></label>
                                            <textarea name="inquire_description" id="inquire_description" class="form-control" rows="5" required><?= isset($umbriavilla_details['inquire_description']) ? htmlspecialchars($umbriavilla_details['inquire_description']) : '' ?></textarea>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Inquire Button Text</label>
                                            <input type="text" id="inquire_button_text" name="inquire_button_text" class="form-control"
                                                placeholder="Enter inquire button text" required
                                                value="<?= isset($umbriavilla_details['inquire_button_text']) ? htmlspecialchars($umbriavilla_details['inquire_button_text']) : '' ?>">
                                        </div>
                                    </div>
                                    <div class="row mr-t-10">
                                        <div class="col-sm-12">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="btn-bottom-toolbar text-center btn-toolbar-container-out">
                                            <button type="submit" class="btn btn-primary"><?php _el('save'); ?></button>
                                            <button type="reset" class="btn btn-default" name="reset_open_close_tour"
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
<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/inquire.js'); ?>"></script>