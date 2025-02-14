<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<div class="page-header page-header-default">

    <!-- <div class="page-header-content">

        <div class="page-title">

            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('banner'); ?></span></h4>

        </div>

    </div> -->


    <?php //var_dump($umbriavilla_details);
    //die; ?>
    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="<?= admin_url() ?>"><i class="icon-home2 position-left"></i><?php echo _l('banner'); ?></a>
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



            <form action="#" id="bannerDetails" method="POST" enctype="multipart/form-data">

                <div class="panel panel-flat">

                    <div class="panel-body">

                        <div class="custom-form tour-close-wrapper">

                            <fieldset>

                                <legend>Banner</legend>

                                <div class="form-group">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-form-label label_text text-lg-right">Banner Video
                                                <small class="req text-danger">*</small>
                                            </label>

                                            <!-- File input for uploading the video -->
                                            <input type="file" id="bannerVideo" name="banner_video" class="form-control"
                                                accept="video/*" onchange="previewVideo(event)">

                                            <!-- Container for the uploaded video preview, displayed if video already exists -->
                                            <div id="videoContainer" class="mt-3"
                                                style="border: 2px solid #ddd; padding: 10px; text-align: center; <?= empty($umbriavilla_details['banner_video']) ? 'display: none;' : '' ?>">
                                                <!-- Video tag to display the uploaded video preview -->
                                                <video id="videoPreview" controls autoplay muted
                                                    style="max-width: 100%; height: auto;">
                                                    <?php if (!empty($umbriavilla_details['banner_video'])): ?>
                                                        <source
                                                            src="<?= base_url('uploads/banner_video/' . $umbriavilla_details['banner_video']) ?>"
                                                            type="video/mp4">
                                                    <?php endif; ?>
                                                </video>
                                            </div>
                                        </div>

                                        <!-- Input fields for title, email, contact1, contact2, and YouTube link -->
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Title <small
                                                    class="req text-danger">*</small></label>
                                            <input type="text" id="title" name="title" class="form-control"
                                                placeholder="Enter your title" required
                                                value="<?= isset($umbriavilla_details['title']) ? htmlspecialchars($umbriavilla_details['title']) : '' ?>">
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Email <small
                                                    class="req text-danger">*</small></label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Enter your email" required
                                                value="<?= isset($umbriavilla_details['email']) ? htmlspecialchars($umbriavilla_details['email']) : '' ?>">
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Contact 1 <small
                                                    class="req text-danger">*</small></label>
                                            <input type="tel" id="contact1" name="contact1" class="form-control"
                                                placeholder="Enter primary contact number" required
                                                value="<?= isset($umbriavilla_details['contact1']) ? htmlspecialchars($umbriavilla_details['contact1']) : '' ?>">
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">Contact 2 <small
                                                    class="req text-danger">*</small></label>
                                            <input type="tel" id="contact2" name="contact2" class="form-control"
                                                placeholder="Enter secondary contact number" 
                                                value="<?= isset($umbriavilla_details['contact2']) ? htmlspecialchars($umbriavilla_details['contact2']) : '' ?>">
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label label_text">YouTube Link <small
                                                    class="req text-danger">*</small></label>
                                            <input type="url" id="youtubeLink" name="youtube_link" class="form-control"
                                                placeholder="Enter your YouTube link" required
                                                value="<?= isset($umbriavilla_details['youtube_link']) ? htmlspecialchars($umbriavilla_details['youtube_link']) : '' ?>">
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

<!-- /page header -->
<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/banner.js'); ?>"></script>