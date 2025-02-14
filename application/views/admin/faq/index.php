<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>



<div class="page-header page-header-default">

    <!-- <div class="page-header-content">

        <div class="page-title">

            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('faq'); ?></span></h4>

        </div>

    </div> -->


    <?php //var_dump($umbriavilla_details);
    //die; ?>
    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="<?= admin_url() ?>"><i class="icon-home2 position-left"></i><?php echo _l('faq'); ?></a>
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
                            <legend>FAQ</legend>

                            <!-- "Add faq" Button Aligned to the Right -->
                            <div class="text-right mb-2" style="padding: 10px;
    margin-bottom: 10px; margin-top: -20px;">
                                <button type="button" class="btn btn-primary" data-toggle="modal" id="faqAdd">
                                    Add FAQ
                                </button>
                            </div>

                            <!-- DataTable for displaying faq items -->
                            <table id="faq_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Drag</th>
                                        <th>Title</th>
                                        <th>Description</th>
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
        <div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="faqModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data" id="faqForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="faqModalLabel">FAQ Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" id="id" name="id" class="form-control">

                                <!-- FAQ Title Input Field -->
                                <div class="col-md-12 mt-3">
                                    <label class="col-form-label label_text">FAQ Title <small
                                            class="req text-danger">*</small></label>
                                    <input type="text" id="faqTitle" name="title" class="form-control"
                                        placeholder="Enter FAQ title" required>
                                </div>

                                <!-- FAQ Description Input Field -->
                                <div class="col-md-12 mt-3">
                                    <label class="col-form-label label_text">FAQ Description <small
                                            class="req text-danger">*</small></label>
                                    <textarea id="faqDescription" name="description" class="form-control"
                                        placeholder="Enter FAQ description" rows="4" required></textarea>
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

<!-- Add CKEditor Script -->

<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/faq.js'); ?>"></script>