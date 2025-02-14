<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<style>
    /*Map Styling*/
    #map-canvas {
        border: groove 3px #ccc;
        height: 395px;
        width: 100%;
    }

    #error-msg {
        color: #C50707;
    }

    .container {
        margin-top: 20px;
    }
</style>
<div class="page-header page-header-default">

    <!-- <div class="page-header-content">

        <div class="page-title">

            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('location'); ?></span></h4>

        </div>

    </div> -->


    <?php //var_dump($umbriavilla_details);
    //die; ?>
    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="<?= admin_url() ?>"><i class="icon-home2 position-left"></i><?php echo _l('location'); ?></a>
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



            <form action="#" id="locationDetails" method="POST" enctype="multipart/form-data">

                <div class="panel panel-flat">

                    <div class="panel-body">

                        <div class="custom-form tour-close-wrapper">

                            <fieldset>

                                <legend>Location Details</legend>
                                <?php //var_dump( $location_details); die; ?>
                                <div class="form-group">

                                    <div class="row">

                                        <!-- Location Description Input Field (with CKEditor) -->
                                        <div class="col-md-12 mt-3">
                                            <label class="col-form-label label_text">Location Description <small
                                                    class="req text-danger">*</small></label>
                                            <textarea name="locationdescription" id="locationdescription"
                                                class="form-control" rows="12"
                                                required><?= isset($location_details['locationdescription']) ? htmlspecialchars($location_details['locationdescription']) : '' ?></textarea>
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Address<small
                                                    class="req text-danger">*</small></label>
                                            <input id="address" name="address" type="text" class="form-control"
                                                placeholder="Enter an address"
                                                value="<?= isset($location_details['address']) ? htmlspecialchars($location_details['address']) : '' ?>"
                                                required>
                                            <p id="error-msg"></p>
                                            <!-- <input type="text" id="address" name="address" class="form-control"
                                                placeholder="Enter address" required
                                                value="<?= isset($location_details['address']) ? htmlspecialchars($location_details['address']) : '' ?>"> -->
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Google Map</label>
                                            <iframe id="map-canvas" src="" allowfullscreen></iframe>
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

<script src="https://maps.googleapis.com/maps/api/js?key=<?= $location_details['apiKey']; ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/location.js'); ?>"></script>