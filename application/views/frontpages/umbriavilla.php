<style>
    body{
        font-family: "Times New Roman" !important;
    }
</style>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<!-- <link rel="stylesheet" href="<?= ASSET ?>css/toastr.min.css" async> -->
<!-- Fixed BUtton -->
<!-- <div class="fixed-btn">
    <a href="#" data-toggle="modal" data-target="#getacall">
        <img src="<?= ASSET ?>images/Getacall.png" alt="Call">
    </a>
    <a href="#" data-toggle="modal" data-target="#quickquote">
        <img src="<?= ASSET ?>images/quickquote.png" alt="Quick Call">
    </a>
</div> -->
<div class="breadcrumb n-breadcrumb">
    <div class="container">
        <p><a href="<?= BASE_URL ?>">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;<span class="title">Umbria Villa</span></p>
    </div>
</div>

<!-- Banner Section -->
<section class="banner-section">
    <div class="banner-wrapper">
        <div class="fleetnew_banner">
            <?php if ($umbriavilla_banner_detals['banner_video'] == '') {
                $banner_video = ASSET . "images/home_page_banner/fleet-banner-default.png";
            } else {
                $banner_video = base_url('uploads/banner_video/') . $umbriavilla_banner_detals['banner_video'];
            }

            ?>
            <video id="videoPreview" autoplay muted loop controls style="max-width: 100%; height: auto;">
                <source src="<?= $banner_video ?>" type="video/mp4">
            </video>
            <div class="banner-contect-detail">
                <div class="banner_contact_no">
                    <div class="banner-info"><a href="tel:<?= $umbriavilla_banner_detals['contact1'] ?>"> <i
                                class="fa-solid fa-phone"></i> <?= $umbriavilla_banner_detals['contact1'] ?> </a>
                    </div>
                    <?php if ($umbriavilla_banner_detals['contact2']) { ?>
                        <div> | </div>
                        <div class="banner-info"><a href="tel:<?= $umbriavilla_banner_detals['contact2'] ?>">
                                <?= $umbriavilla_banner_detals['contact2'] ?> </a></div>
                    <?php } ?>
                </div>
                <div class="banner-email-video-wrapper">
                    <div class="banner-divider"> | </div>
                    <div class="banner-info"><a href="mailto:<?= $umbriavilla_banner_detals['email'] ?>"> <i
                                class="fa-solid fa-envelope"></i> <?= $umbriavilla_banner_detals['email'] ?></a>
                    </div>
                    <div class="banner-divider"> | </div>
                    <div class="banner-info"><a href="<?= $umbriavilla_banner_detals['youtube_link'] ?>" target="_blank"> <i class="fa-brands fa-youtube"></i>
                    YouTube - DriverInRome</a></div>
                </div>
            </div>
            <div class="custom-carousel">
                <h4><?= $umbriavilla_banner_detals['title'] ?></h4>
            </div>
        </div>
    </div>
</section>

<!-- Tabination  -->
<section class="tabination-wrapper">
    <div class="tab-link-wrapper sticky-bar">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="photos-tab" data-bs-toggle="tab"
                    data-bs-target="#photos-tab-pane" type="button" role="tab" aria-controls="photos-tab-pane"
                    aria-selected="true">Photos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview-tab-pane"
                    type="button" role="tab" aria-controls="overview-tab-pane"
                    aria-selected="false">Overview</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="availability-tab" data-bs-toggle="tab"
                    data-bs-target="#availability-tab-pane" type="button" role="tab"
                    aria-controls="availability-tab-pane" aria-selected="false">Availability</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location-tab-pane"
                    type="button" role="tab" aria-controls="location-tab-pane"
                    aria-selected="false">Location</button>
            </li>
            <?php if ($experiences_status['status'] == 1) { ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="experience-tab" data-bs-toggle="tab"
                        data-bs-target="#experience-tab-pane" type="button" role="tab"
                        aria-selected="false">Experiences</button>
                </li>
            <?php } ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="inquire-tab" data-bs-toggle="tab" data-bs-target="#inquire-tab-pane"
                    type="button" role="tab" aria-controls="inquire-tab-pane" aria-selected="false">Inquire</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="terms-tab" data-bs-toggle="tab" data-bs-target="#terms-tab-pane"
                    type="button" role="tab" aria-controls="terms-tab-pane" aria-selected="false">Terms</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq-tab-pane"
                    type="button" role="tab" aria-controls="faq-tab-pane" aria-selected="false">FAQ</button>
            </li>
        </ul>

    </div>
    <div class="tab-content-wrapper">
        <div class="tab-content" id="myTabContent">
            <div class="property-section-spacing" id="photos-tab-pane" role="tabpanel" aria-labelledby="photos-tab"
                tabindex="0">
                <div class="gallery-grid">
                    <!-- Display the main image (first in the array) -->
                    <?php if (!empty($photos) && isset($photos[0])): ?>
                        <div class="gallery-grid-col1">
                            <a href="<?php echo base_url('uploads/photos/') . $photos[0]['name']; ?>"
                                data-fancybox="gallery">
                                <img class="img-fluid" src="<?php echo base_url('uploads/photos/') . $photos[0]['name']; ?>"/>
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Display other images in a sub-grid -->
                    <div class="gallery-grid-col2">
                        <div class="gallery-sub-grid">
                            <div class="gallery-grid-sub-col1">
                                <?php if (isset($photos[1])): ?>
                                    <a href="<?php echo base_url('uploads/photos/') . $photos[1]['name']; ?>"
                                        data-fancybox="gallery">
                                        <img class="img-fluid" src="<?php echo base_url('uploads/photos/') . $photos[1]['name']; ?>" />
                                    </a>
                                <?php endif; ?>
                                <?php if (isset($photos[2])): ?>
                                    <a href="<?php echo base_url('uploads/photos/') . $photos[2]['name']; ?>"
                                        data-fancybox="gallery">
                                        <img class="img-fluid" src="<?php echo base_url('uploads/photos/') . $photos[2]['name']; ?>" />
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="gallery-grid-sub-col2">
                                <div class="gallery-grid-sub-col1">
                                    <?php if (isset($photos[3])): ?>
                                        <a href="<?php echo base_url('uploads/photos/') . $photos[3]['name']; ?>"
                                            data-fancybox="gallery">
                                            <img class="img-fluid"
                                                src="<?php echo base_url('uploads/photos/') . $photos[3]['name']; ?>" />
                                        </a>
                                    <?php endif; ?>
                                    <?php if (isset($photos[4])): ?>
                                        <a href="<?php echo base_url('uploads/photos/') . $photos[4]['name']; ?>"
                                            data-fancybox="gallery">
                                            <img class="img-fluid"
                                                src="<?php echo base_url('uploads/photos/') . $photos[4]['name']; ?>" />
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- "View All Gallery" button -->
                            <?php if (count($photos) > 5) { ?>
                                <div class="view-gallery-wrapper">
                                    <a href="<?php echo base_url('uploads/photos/') . $photos[5]['name']; ?>"
                                        data-fancybox="gallery">
                                        View All Gallery (<?php echo count($photos); ?>)
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Include hidden links for the rest of the images if there are more than 5 -->
                    <?php for ($i = 6; $i < count($photos); $i++): ?>
                        <a href="<?php echo base_url('uploads/photos/') . $photos[$i]['name']; ?>"
                            data-fancybox="gallery" style="display:none;">
                            <img src="<?php echo base_url('uploads/photos/') . $photos[$i]['name']; ?>" />
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-container">
        <div class="row">
            <div class="col-lg-7 col-12">
                <div class="property-overview-wrapper property-heading property-section-spacing"
                    id="overview-tab-pane">
                    <h3>Overview</h3>
                    <p><?php echo $overview_title['overview_title']; ?></p>
                    <div class="property-listing">
                        <?php foreach ($non_highlights as $non_highlight) { ?>
                            <div class="d-flex align-items-center gap-2">
                                <img src="<?= base_url('uploads/icon/') . $non_highlight['icon'] ?>" alt="gallery"
                                    class="img-fluid">
                                <h6><?= $non_highlight['title'] . ' ' . $non_highlight['number'] ?></h6>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="property-hightlight-wrapper property-subheading">
                        <h4>Property highlights</h4>
                        <div class="row">
                            <?php foreach ($proper_highlights as $proper_highlight) { ?>
                                <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                                    <div class="d-flex align-items-center gap-2 property-listing-data">
                                        <img src="<?= base_url('uploads/icon/') . $proper_highlight['icon'] ?>"
                                            alt="gallery" class="img-fluid">
                                        <h6><?= $proper_highlight['title'] ?></h6>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="property-availability-wrapper availability-heading-content property-heading property-section-spacing"
                    id="availability-tab-pane">
                    <h3>Availability</h3>
                    <?php echo ($availability_details['availability_title']); ?>
                    <div class="rate-wrapper">
                        <h6>Rates:</h6>
                        <div class="rates-table-warpper">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Period (from/to)</th>
                                        <th scope="col">Minimum Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(!empty($availability_rates)){
                                            foreach ($availability_rates as $availability_rate) { ?>
                                                <tr>
                                                    <td><?php echo ($availability_rate['formatted_from_date']); ?> -
                                                        <?php echo ($availability_rate['formatted_to_date']); ?>
                                                    </td>
                                                    <td><?php echo ($availability_rate['price']); ?> euro per week</td>
                                                </tr>
                                                <?php 
                                            } 
                                        }else{
                                            ?>
                                                <tr>
                                                    <td colspan="2">No Rates Available
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="property-subheading">
                            <h4>Availability Calendar</h4>
                            <div class="row">

                                <div class="container">
                                    <div class="calendar-wrapper">
                                        <!-- Header with navigation -->
                                        <div
                                            class="calendar-navigation d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <button class="reset-calendar btn btn-sm btn-primary">Reset</button>
                                            </div>
                                            <div>
                                                <button class="prev-month btn btn-sm btn-secondary"><i
                                                        class="fa-solid fa-angle-left"></i></button>
                                                <button class="next-month btn btn-sm btn-secondary"><i
                                                        class="fa-solid fa-angle-right"></i></button>
                                            </div>
                                        </div>
                                        <div class="clender-status-wrapper">
                                            <div
                                                class="booked-calender calender-header-main d-flex align-items-center gap-2">
                                                <div class="booked-dot calender-dot"></div>
                                                <p class="m-0">Booked</p>
                                            </div>
                                            <div
                                                class="optional-calender calender-header-main d-flex align-items-center gap-2">
                                                <div class="optioned-dot calender-dot"></div>
                                                <p class="m-0">Optioned</p>
                                            </div>
                                            <div
                                                class="available-calender calender-header-main d-flex align-items-center gap-2">
                                                <div class="availabel-dot calender-dot"></div>
                                                <p class="m-0">Available</p>
                                            </div>
                                        </div>
                                        <div id="calendars-row" class="calender-wrapper-main"></div>
                                    </div>
                                </div>



                            </div>

                            <?php echo $availability_details['availability_description']; ?>

                        </div>
                    </div>
                </div>

                <div class="property-location-wrapper  property-heading property-section-spacing"
                    id="location-tab-pane">
                    <h3>Location</h3>
                    <div class="row">
                        <div class="col-12">
                            <div class="google-map">
                                <iframe
                                    src="https://www.google.com/maps/embed/v1/place?key=<?= $ApiKey['apiKey'] ?>&q=<?php echo rawurlencode($location_details['address']); ?>&zoom=18"
                                    style="border:0;" allowfullscreen=""
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="location-content">
                        <p><?= $location_details['locationdescription']; ?></p>
                    </div>

                </div>
                <?php if ($experiences_status['status'] == 1) { ?>
                    <div class="property-location-wrapper  property-heading availability-heading-content property-section-spacing"
                        id="experience-tab-pane">
                        <div id="experienceSection">
                            <h3>Experiences</h3>
                            <p><?php echo ($experiences_title['experiences_title']); ?></p>

                            <!-- Container for experience details that will be loaded dynamically -->
                            <div id="experienceContainer"></div>
                            <div id="paginationContainer"></div>


                        </div>
                    </div>
                <?php } ?>

                <!-- START inquire tab -->
                <div class="inquire-villa-wrapper  property-heading property-section-spacing" id="inquire-tab-pane">
                    <h3>Inquire</h3>
                    <p><?php echo isset($umbriavilla_inquire_details['inquire_description']) ? $umbriavilla_inquire_details['inquire_description'] : '' ?></p>
                    <div class="inquire-villa-container">
                        <form id="inquireVillaForm" method="POST"> 
                            <div class="row">                                
                                <div class="col-sm-6 col-md-12">
                                    <div class="custom-form">
                                        <div class="form-group field-group">
                                            <fieldset class="inquireemail-fieldset">
                                                <legend class="float-none">Email</legend>
                                                <input type="email" name="inquireemail" id="inquireemail" class="form-control" autocomplete="off"> 
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-12">
                                    <div class="form-group">
                                        <div class="privacy-checkbox-wrapper">
                                            <label class="inquire-accept-plocy-txt mb-0"><input type="checkbox" name="acceptPolicy" required />By submitting this form I accept your <a href="<?= base_url('privacy-policy'); ?>" target="_blank">Privacy Policy</a></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-12 mt-2">
                                    <button type="submit" class="g-recaptcha btn btn-blue inquire-btn mr-0" data-action="submit" data-sitekey="<?= RE_CAPTCHA_V3_SITE_KEY ?>" data-callback="onSubmit_inquiry"><?php echo isset($umbriavilla_inquire_details['inquire_button_text']) ? $umbriavilla_inquire_details['inquire_button_text'] : 'Inquire' ?></button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>
                <!-- END inquire tab -->

                <!-- Modal for Experience -->
                <div class="modal fade property-modal" id="experienceModal" tabindex="-1" role="dialog"
                    aria-labelledby="experienceModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document" style="max-width: 94%;">
                        <!-- Increased width to modal-xl -->
                        <div class="modal-content p-0">
                            <div class="modal-header m-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="experience-detail-wrapper mb-0">
                                    <div class="row align-items-center m-0">
                                        <div class="col-xl-4 col-lg-12 col-md-4 col-12">
                                            <div class="experience-image text-xl-start text-lg-center text-md-start text-center">
                                                <img id="experienceImage" alt="experience" class="img-fluid d-block mx-auto m-auto">
                                            </div>                                            
                                        </div>
                                        <div class="col-xl-8 col-lg-12 col-md-8 col-12">
                                            <div class="experience-content-wrapper">
                                                <h4 id="experienceTitle"></h4>
                                                <!-- Scrollable Description -->
                                                <p id="experienceDescription" class="description-content overflow-auto"></p>
                                                <div class="text-right">
                                                    <!-- <h6 id="experiencePrice"></h6> -->
                                                    <a id="experiencePdf" href="#" download>READ MORE</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="property-location-wrapper  property-heading availability-heading-content property-section-spacing"
                    id="terms-tab-pane">
                    <h3>Terms and Conditions</h3>
                    <?php echo ($terms_condtion['terms_condtion']); ?>
                </div>

                <div class="property-location-wrapper  property-heading availability-heading-content property-section-spacing"
                    id="faq-tab-pane">
                    <h3>FAQ</h3>

                    <div class="faq-wrapper">
                        <div class="accordion" id="accordionExample">
                            <?php foreach ($faqs as $index => $faq) { ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?= $index ?>">
                                        <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?>"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse<?= $index ?>"
                                            aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>"
                                            aria-controls="collapse<?= $index ?>">
                                            <?= $faq['sequence_id'] ?>. <?= $faq['title'] ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $index ?>"
                                        class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>"
                                        aria-labelledby="heading<?= $index ?>" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?= $faq['description'] ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-5 col-12">
                <div class="user-details">
                    <div class="user-detail-wrapper">
                        <div class="user-profile-wrapper d-flex align-items-center gap-3">
                            <?php if ($owner_details['owner_image']) {
                                $user_image = base_url('uploads/owner_image/') . $owner_details['owner_image'];
                            } else {
                                $user_image = ASSET . "images/properties/user-profile.png";
                            }
                            ?>
                            <div class="user-profile-img">
                                <img src="<?= $user_image ?>" alt="gallery" class="img-fluid"
                                    style="height: 63px; width: 63px;">
                            </div>
                            <div class="user-profile-name">
                                <!-- <h5>Selected by <?= $owner_details['owner_name'] ?></h5> -->
                                <h5>About the Owners: <br><?= $owner_details['owner_name'] ?></h5>
                                <!-- <p>Your Expert</p> -->
                            </div>
                        </div>
                        <?= $owner_details['owner_description']; ?>
                    </div>
                    <div class="proerties-info mt-3">
                        <div class="banner-info pb-2"><a href="tel:<?= $owner_details['owner_number'] ?>"
                                class="fw-bold"> <i class="fa-solid fa-phone"></i>
                                <?= $owner_details['owner_number'] ?> </a></div>
                        <div class="banner-info"><a href="mailto:<?= $owner_details['owner_email'] ?>" class="fw-bold"> <i
                                    class="fa-solid fa-envelope"></i>
                                <?= $owner_details['owner_email'] ?></a></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--  -->
</section>

<!-- properties Details Section -->


<section class="driveinrome-contact-wrapper">
    <div class="custom-container">
        <div class="row">
            <div class="col-xl-8 col-lg-6 col-12 mb-lg-0 mb-4 driveinrome-heading">
                <h2><?= $footer_details['footer_title'] ?></h2>
                <h6><?= $footer_details['footer_sub_title'] ?></h6>
            </div>
            <div class="col-xl-4 col-lg-6 col-12 driveinroom-contact-detail">
                <div class="banner_contact_no">
                    <div class="banner-info"><a href="tel:<?= $footer_details['footer_contact1'] ?>"> <i
                                class="fa-solid fa-phone"></i> <?= $footer_details['footer_contact1'] ?></a>
                    </div>
                    <?php if ($footer_details['footer_contact2']) { ?>
                        <div> | </div>
                        <div class="banner-info"><a
                                href="tel:<?= $footer_details['footer_contact2'] ?>"><?= $footer_details['footer_contact2'] ?></a>
                        </div>
                    <?php } ?>
                </div>
                <div class="banner-info banner-email"><a href="mailto:<?= $footer_details['footer_email'] ?>"> <i
                            class="fa-solid fa-envelope"></i><?= $footer_details['footer_email'] ?></a></div>
                <div class="banner-info"><a href="tel:<?= $footer_details['footer_whatsapp'] ?>"> <i
                            class="fa-brands fa-square-whatsapp"></i><?= $footer_details['footer_whatsapp'] ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<!-- <script src="<?= ASSET ?>js/plugins/forms/validation/validate.min.js"></script> -->
<!-- <script src="<?= ASSET ?>js/loadingoverlay.min.js" async defer></script> -->
<!-- <script src="<?= ASSET ?>js/toastr.min.js" async defer></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/scripts/web/umbriavilla.js'); ?>"></script>
<!-- LightBox -->
<script>
    Fancybox.bind("[data-fancybox]", {});
    const video = document.getElementById('videoPreview');

    // Ensure muted is true for autoplay to work
    video.muted = true; // Make sure the video is muted for autoplay to work

    // Try playing the video when the page loads
    window.addEventListener('load', () => {
        video.play().catch((error) => {
            console.error('Autoplay failed:', error);
        });
    });              

    function onSubmit_inquiry(token) {
        $('#inquireVillaForm').submit();
    }
</script>

<!-- // thank you modal -->
<div id="thankyoumodal" class="modal fade umbria_modal" role="dialog" tabindex="-1" style="display: none !important;" aria-hidden="true">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-content-wrap">
          <img src="<?= EMAIL_WELCOME_PNG ?>" alt="Smile Expression" class="smile-popup lazyload">
          <h4 class="modal-title text-center">Thank you</h4>
        </div>
        <p>Thank you for your request. You will receive an email from our agent shortly.</p>
        <div class="modal-form">
          <button type="button" class="btn btn-yellow mt-3" id="thankyou_modal_close" data-bs-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- // error sending email popup   -->
<div id="errormodal" class="modal fade" role="dialog" style="display: none !important;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-content-wrap">
          <img src="<?= EMAIL_OOPS_PNG ?>" alt="Oops Expression" class="oops-popup lazyload">
        </div>
        <h4 class="modal-title text-center">Error</h4>
        <p id="err_msg">Getting error while sending email, please try again later!</p>
        <div class="modal-form">
          <button type="button" class="btn btn-yellow mt-3" data-bs-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>
</div>