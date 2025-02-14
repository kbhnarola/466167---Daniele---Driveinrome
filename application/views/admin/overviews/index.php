<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- SweetAlert2 CDN -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->


<div class="page-header page-header-default">

    <!-- <div class="page-header-content">

        <div class="page-title">

            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('overview'); ?></span></h4>

        </div>

    </div> -->


    <?php //var_dump($umbriavilla_details);
    //die; ?>
    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="<?= admin_url() ?>"><i class="icon-home2 position-left"></i><?php echo _l('overview'); ?></a>
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
                            <legend>Overview</legend>
                            <div class="row">

                                <!-- Overview Title Input Field -->
                                <div class="col-md-9 mt-3">
                                    <label class="col-form-label label_text">Overview Title <small
                                            class="req text-danger">*</small></label>
                                    <input type="text" id="overview_title" class="form-control"
                                        placeholder="Enter Overview Title"
                                        value="<?= isset($overview_title['overview_title']) ? htmlspecialchars($overview_title['overview_title']) : '' ?>">
                                </div>

                                <div class="text-right mb-2" style="margin-top: 35px; margin-right: 10px;">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" id="overviewAdd">
                                        Add Overview
                                    </button>
                                </div>
                            </div>

                            <!-- DataTable for displaying overview items -->
                            <table id="overview_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
        <div class="modal fade" id="overviewModal" tabindex="-1" role="dialog" aria-labelledby="overviewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data" id="overviewForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="overviewModalLabel">overview Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" id="id" name="id" class="form-control" accept=".svg">
                                <!-- Dropdown for Highlight Type -->
                                <div class="col-md-6 mt-3">
                                    <label class="col-form-label label_text">Highlight Type <small
                                            class="req text-danger">*</small></label>
                                    <select id="highlightType" name="highlight_type" class="form-control" required>
                                        <option value="proper_highlight">Proper Highlight</option>
                                        <option value="non_highlight">Non Highlight</option>
                                    </select>
                                </div>


                                <!-- Icon Title Input Field -->
                                <div class="col-md-6 mt-3">
                                    <label class="col-form-label label_text">Icon Title <small
                                            class="req text-danger">*</small></label>
                                    <input type="text" id="iconTitle" name="title" class="form-control"
                                        placeholder="Enter icon title" required>
                                </div>

                                <!-- Icon Image Upload (SVG only) -->
                                <div class="col-md-6 mt-3">
                                    <label class="col-form-label label_text">Icon Image (SVG Only) <small
                                            class="req text-danger">*</small></label>
                                    <input type="file" id="iconImage" name="icon" class="form-control" accept=".svg">
                                    <input type="hidden" id="iconImagefile" name="icon" class="form-control"
                                        accept=".svg">
                                    <!-- Image Preview -->
                                    <img id="iconImagePreview" src="" alt="Image Preview"
                                        style="display: none; max-width: 100px; margin-top: 10px;" required>
                                </div>

                                <!-- Conditional Field: Number Text Box (Shown only for Non Highlight) -->
                                <div class="col-md-6 mt-3" id="numberField" style="display: none;">
                                    <label class="col-form-label label_text">Number <small
                                            class="req text-danger">*</small></label>
                                    <input type="text" id="highlightNumber" name="number" class="form-control"
                                        placeholder="Enter number if applicable">
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


<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/overview.js'); ?>"></script>