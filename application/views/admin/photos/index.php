<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- SweetAlert2 CDN -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<style>
    /* Container for the grid layout */
    #photos_table_wrapper .dataTables_wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #4c4c4c;
        /* Match background color in your image */
    }

    #photos_table_wrapper .dataTables_processing {
        display: none;
        /* Hides the default processing message */
    }

    /* Style each photo container */
    .photo-container {
        position: relative;
        width: 150px;
        /* Set size as per your requirements */
        height: 150px;
        margin: 10px;
        background-color: #b3e5fc;
        /* Match color in your image */
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Style for the image */
    .photo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 4px;
    }

    /* Position action icons in the top-right corner */
    .action-icons {
        position: absolute;
        top: 5px;
        right: 5px;
        display: flex;
        gap: 5px;
    }

    .action-icons a {
        color: black;
        font-size: 1.2em;
        text-decoration: none;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        padding: 3px;
    }

    .action-icons a:hover {
        background-color: rgba(255, 255, 255, 1);
    }

    /* Adjust DataTable grid layout */
    #photos_table tbody {
        display: flex;
        flex-wrap: wrap;
        /* justify-content: center; */
    }


.drag-handle {
    position: absolute;
    
    cursor: move;
}


</style>



<div class="page-header page-header-default">

    <!-- <div class="page-header-content">

        <div class="page-title">

            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('photos'); ?></span></h4>

        </div>

    </div> -->


    <?php //var_dump($umbriavilla_details);
    //die; ?>
    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="<?= admin_url() ?>"><i class="icon-home2 position-left"></i><?php echo _l('photos'); ?></a>
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
                            <legend>Photos</legend>

                            <!-- "Add Overview" Button Aligned to the Right -->
                            <div class="text-right mb-2" style="padding: 10px;
    margin-bottom: 10px; margin-top: -20px;">
                                <button type="button" class="btn btn-primary" data-toggle="modal" id="photosAdd">
                                    Add Photos
                                </button>
                            </div>

                            <!-- DataTable for displaying overview items -->
                            <table id="photos_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Photos</th>
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
        <div class="modal fade" id="photosModal" tabindex="-1" role="dialog" aria-labelledby="photosModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data" id="photosForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="photosModalLabel">Photos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" id="id" name="id" class="form-control">

                                <!-- Photos Upload -->
                                <div class="col-md-6 mt-3">
                                    <label class="col-form-label label_text">Photos <small
                                            class="req text-danger">*</small></label>
                                    <input type="file" id="photosImage" name="photos" class="form-control"
                                        accept="image/*" onchange="previewImage(event)">
                                    <!-- <input type="hidden" id="photoImagefile" name="photoImagefile" class="form-control"
                                        accept="image/*"> -->

                                    <!-- Image Preview -->
                                    <img id="photosImagePreview" src="" alt="Image Preview"
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
<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/photos.js'); ?>"></script>