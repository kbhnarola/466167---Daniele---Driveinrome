<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- SweetAlert2 CDN -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->


<div class="page-header page-header-default">

    <!-- <div class="page-header-content">

        <div class="page-title">

            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('experiences'); ?></span></h4>

        </div>

    </div> -->


    <?php //var_dump($umbriavilla_details);
    //die; ?>
    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="<?= admin_url() ?>"><i
                        class="icon-home2 position-left"></i><?php echo _l('experiences'); ?></a>
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


            <div class="panel panel-flat">

                <div class="panel-body">

                    <div class="custom-form tour-close-wrapper">
                        <fieldset>
                            <legend>Experiences</legend>

                            <div class="row">

                                <!-- Overview Title Input Field -->
                                <div class="col-md-9 mt-3">
                                    <label class="col-form-label label_text">Experience Title <small
                                            class="req text-danger">*</small></label>
                                    <input type="text" id="experiences_title" class="form-control"
                                        placeholder="Enter Experience Title"
                                        value="<?= isset($experiences_title['experiences_title']) ? htmlspecialchars($experiences_title['experiences_title']) : '' ?>">
                                </div>

                                <div class="text-right mb-2" style="margin-top: 35px; margin-right: 10px;">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        id="experiencesAdd">
                                        Add Experiences
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Status Switch -->
                                <div class="col-md-6 mt-3">
                                    <div class="checkbox checkbox-switch">
                                        <label for="status-switch" class="col-form-label label_text">Allow user to See this Section: </label>
                                        <?php if($experiences_status['status'] == 1){
                                            $checked = 'checked';
                                        } else{ 
                                            $checked = '';
                                        }?>
                                        <input type="checkbox" id="status-switch" data-on-color="success"
                                            data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch"
                                            onchange="change_status(this);" <?php echo $checked ?>>
                                    </div>
                                </div>
                            </div>
                            <!-- DataTable for displaying experiences items -->
                            <table id="experiences_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                    </div>
                    </fieldset>
                </div>

            </div>

        </div>

        <!-- Modal Structure -->
        <div class="modal fade" id="experiencesModal" tabindex="-1" role="dialog"
            aria-labelledby="experiencesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data" id="experiencesForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="experiencesModalLabel">Experience Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" id="id" name="id" class="form-control">

                                <!-- Title Input Field -->
                                <div class="col-md-12 mt-3">
                                    <label class="col-form-label label_text">Title <small
                                            class="req text-danger">*</small></label>
                                    <input type="text" id="Title" name="title" class="form-control"
                                        placeholder="Enter title" required>
                                </div>

                                <!-- Description Text Area -->
                                <div class="col-md-12 mt-3">
                                    <label class="col-form-label label_text">Description <small
                                            class="req text-danger">*</small></label>
                                    <textarea id="Description" name="description" class="form-control" rows="3"
                                        placeholder="Enter description" required></textarea>
                                </div>


                                <!-- Price Input Field -->
                                <div class="col-md-6 mt-3">
                                    <label class="col-form-label label_text">Price <small
                                            class="req text-danger">*</small></label>
                                    <input type="number" id="Price" name="price" class="form-control"
                                        placeholder="Enter price" required>
                                </div>

                                <!-- PDF Upload -->
                                <div class="col-md-6 mt-3">
                                    <label class="col-form-label label_text">PDF <small
                                            class="req text-danger">*</small></label>
                                    <input type="file" id="pdfFile" name="pdf" class="form-control" accept=".pdf">
                                </div>

                                <!-- Image Upload (PNG, JPG, JPEG, GIF) -->
                                <div class="col-md-6 mt-3">
                                    <label class="col-form-label label_text">Side Image <small
                                            class="req text-danger">*</small></label>
                                    <input type="file" id="Image" name="image" class="form-control"
                                        accept=".png, .jpg, .jpeg, .gif">
                                    <!-- Image Preview -->
                                    <img id="iconImagePreview" src="" alt="Image Preview"
                                        style="display: none; max-width: 100px; margin-top: 10px;">
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- /Panel -->

    </div>

</div>

</div>

<!-- /page header -->

<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/experiences.js'); ?>"></script>