<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<div class="page-header page-header-default">

    <!-- <div class="page-header-content">

        <div class="page-title">

            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('owner'); ?></span></h4>

        </div>

    </div> -->


    <?php //var_dump($umbriavilla_details);
    //die; ?>
    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="<?= admin_url() ?>"><i class="icon-home2 position-left"></i><?php echo _l('owner'); ?></a>
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



            <form action="#" id="ownerDetails" method="POST" enctype="multipart/form-data">

                <div class="panel panel-flat">

                    <div class="panel-body">

                        <div class="custom-form tour-close-wrapper">

                            <fieldset>

                                <legend>Owner Details</legend>
                                <?php //var_dump( $owner_details); die; ?>
                                <div class="form-group">

                                    <div class="row">
                                        <!-- Owner Name Input Field -->
                                        <div class="col-md-6 mt-3">
                                                <label class="col-form-label label_text">Owner Name <small
                                                        class="req text-danger">*</small></label>
                                                <input type="text" id="ownerName" name="owner_name" class="form-control"
                                                    placeholder="Enter owner name" required
                                                    value="<?= isset($owner_details['owner_name']) ? htmlspecialchars($owner_details['owner_name']) : '' ?>">
                                            </div>
                                            <!-- Owner Name Input Field -->
                                            <div class="col-md-6 mt-3">
                                                <label class="col-form-label label_text">Owner Contact Number <small
                                                        class="req text-danger">*</small></label>
                                                <input type="text" id="ownerNumber" name="owner_number" class="form-control"
                                                    placeholder="Enter owner contact number" required
                                                    value="<?= isset($owner_details['owner_number']) ? htmlspecialchars($owner_details['owner_number']) : '' ?>">
                                            </div>
                                            <!-- Owner Name Input Field -->
                                            <div class="col-md-6 mt-3">
                                                <label class="col-form-label label_text">Owner Email <small
                                                        class="req text-danger">*</small></label>
                                                <input type="email" id="ownerEmail" name="owner_email" class="form-control"
                                                    placeholder="Enter owner email" required
                                                    value="<?= isset($owner_details['owner_email']) ? htmlspecialchars($owner_details['owner_email']) : '' ?>">
                                            </div>
                                        <!-- Owner Image Upload Section -->
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text text-lg-right">Owner Image
                                                <small class="req text-danger">*</small>
                                            </label>
                                            
                                            <!-- File input for uploading the image -->
                                            <input type="file" id="ownerImage" name="owner_image" class="form-control"
                                                accept="image/*">
                                            <?php if ($owner_details['owner_image']) { ?>
                                                <img id="imagePreview"
                                                    src="<?php echo (base_url('uploads/owner_image/') . $owner_details['owner_image']); ?>"
                                                    alt="Image Preview"
                                                    style="display: block; max-width: 100px; margin-top: 10px;">
                                            <?php } else { ?>
                                                <img id="imagePreview" src="" alt="Image Preview"
                                                    style="display: none; max-width: 100px; margin-top: 10px;" required>
                                            <?php } ?>
                                        </div>



                                        <!-- Description Input Field (with CKEditor) -->
                                        <div class="col-md-12 mt-3">
                                            <label class="col-form-label label_text">Owner Description <small
                                                    class="req text-danger">*</small></label>
                                            <textarea name="owner_description" id="ownerDescription"
                                                class="form-control" rows="12"
                                                required><?= isset($owner_details['owner_description']) ? htmlspecialchars($owner_details['owner_description']) : '' ?></textarea>
                                        </div>

                                        <div class="row mr-t-10">

                                            <div class="col-sm-12">
                                            </div>

                                        </div>

                                        <div class="row">

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


<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/owner_details.js'); ?>"></script>