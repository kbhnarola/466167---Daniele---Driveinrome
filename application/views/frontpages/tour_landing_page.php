<section class="section-tour-page pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="tour-page-left">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (is_array($cms_page_data) && sizeof($cms_page_data) > 0) {
                                if ($cms_page_data['promo_file'] != "" || $cms_page_data['promo_url'] != "") {  ?>

                                    <!-- <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4"> -->
                                    <!-- <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4"> -->
                                    <?php
                                    if ($cms_page_data['promo_file']) { ?>
                                        <video width="100%" controls>
                                            <source src="<?php echo base_url() . 'uploads/promo_file/' . $cms_page_data['promo_file']; ?>" type="video/ogg">
                                        </video>
                                    <?php } else { ?>
                                        <!-- <source src="<?php //echo $cms_page_data['promo_url']; 
                                                            ?>" type="video/ogg"> -->
                                        <!-- <iframe width="100%" height="100%" src="<?php //echo $cms_page_data['promo_url']; 
                                                                                        ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
                                        <iframe class="embed-responsive-item" src="<?php echo $cms_page_data['promo_url']; ?>" width="100%" height="400px" title="video" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                    <?php } ?>
                                    </video>
                            <?php } else {
                                    echo "<h3>No Content available</h3>";
                                }
                            } else {
                                echo "<h3>No Content available</h3>";
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="tour-page-right">
                    <?php
                    if (is_array($cms_page_data) && sizeof($cms_page_data) > 0) {
                        if ($cms_page_data['review_ids'] != "") {
                            $review_ids = explode(",", $cms_page_data['review_ids']);
                    ?>
                            <div class="reviews-sidebar-landing-page">
                                <h2>Reviews</h2>
                                <div class="review-cat owl-carousel owl-theme" id="landing_page_review_carousel">
                                    <?php
                                    if (is_array($reviews) && sizeof($reviews) > 0) {
                                        $i = 3;
                                        foreach ($reviews as $r) {
                                            if (in_array($r['id'], $review_ids)) {
                                                if ($i % 3 == 0) {   ?>
                                                    <div class="review-cat-item-lp">
                                                    <?php }
                                                $i++; ?>
                                                    <div class="flex-container">
                                                        <?php
                                                        if ($r['tour_id']) {
                                                            if (get_tour_slug_review($r['tour_id'])) { ?>
                                                                <a href="<?php echo base_url() . 'reviews/' . $cms_page_data['slug'] . '/' . $r['slug']; ?>">
                                                                    <div class="img-wrap">
                                                                        <?php
                                                                        if ($r['feature_image']) { ?>
                                                                            <img src="<?php echo base_url() . 'uploads/review_images/' . $r['feature_image']; ?>" onerror="this.src='<?php echo base_url() . "assets/images/blue-logo.svg"; ?>'">
                                                                        <?php } else { ?>
                                                                            <img src="<?php echo base_url() . 'assets/images/blue-logo.svg'; ?>">
                                                                        <?php } ?>
                                                                    </div>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="javascript:">
                                                                    <div class="img-wrap">
                                                                        <?php
                                                                        if ($r['feature_image']) { ?>
                                                                            <img src="<?php echo base_url() . 'uploads/review_images/' . $r['feature_image']; ?>" onerror="this.src='<?php echo base_url() . "assets/images/blue-logo.svg"; ?>'">
                                                                        <?php } else { ?>
                                                                            <img src="<?php echo base_url() . 'assets/images/blue-logo.svg'; ?>">
                                                                        <?php } ?>
                                                                    </div>
                                                                </a>
                                                            <?php }
                                                        } else { ?>
                                                            <a href="<?php echo base_url() . 'page/' . $cms_page_data['slug'] . '/reviews'; ?>">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                    if ($r['feature_image']) { ?>
                                                                        <img src="<?php echo base_url() . 'uploads/review_images/' . $r['feature_image']; ?>" onerror="this.src='<?php echo base_url() . "assets/images/blue-logo.svg"; ?>'">
                                                                    <?php } else { ?>
                                                                        <img src="<?php echo base_url() . 'assets/images/blue-logo.svg'; ?>">
                                                                    <?php } ?>
                                                                </div>
                                                            </a>
                                                        <?php } ?>
                                                        <div class="cat-info">
                                                            <h4>
                                                                <?php
                                                                if ($r['tour_id']) {
                                                                    if (get_tour_slug_review($r['tour_id'])) { ?>
                                                                        <a href="<?php echo base_url() . 'reviews/' . 'reviews/' . $cms_page_data['slug'] . '/' . $r['slug']; ?>"><?= (strlen($r['title']) > 30) ? substr($r['title'], 0, 30) . "..." : $r['title']; ?></a>
                                                                    <?php } else { ?>
                                                                        <a href="javascript:"><?= (strlen($r['title']) > 30) ? substr($r['title'], 0, 30) . "..." : $r['title']; ?></a>
                                                                    <?php }
                                                                } else { ?>
                                                                    <a href="<?php echo base_url() . 'page/' . $cms_page_data['slug'] . '/reviews'; ?>"><?= (strlen($r['title']) > 30) ? substr($r['title'], 0, 30) . "..." : $r['title']; ?></a>
                                                                <?php } ?>
                                                            </h4>
                                                            <?php
                                                            $desc = preg_replace("/<img[^>]+\>/i", " ", $r['description']);
                                                            $final_desc = preg_replace("/<\/?a( [^>]*)?>/i", "", $desc);
                                                            ?>
                                                            <p>
                                                                <?php
                                                                if ($r['tour_id']) {
                                                                    if (get_tour_slug_review($r['tour_id'])) { ?>
                                                                        <a href="<?php echo base_url() . 'reviews/' . get_tour_slug_review($r['tour_id']) . '/' . $r['slug']; ?>">
                                                                            <?php if (strlen(strip_tags($final_desc)) > 30) {
                                                                                echo nl2br(substr(strip_tags($final_desc), 0, 30)) . "...";
                                                                            } else {
                                                                                echo nl2br(strip_tags($final_desc));
                                                                            } ?>
                                                                        </a>
                                                                    <?php } else { ?>
                                                                        <a href="javascript:">
                                                                            <?php if (strlen(strip_tags($final_desc)) > 30) {
                                                                                echo nl2br(substr(strip_tags($final_desc), 0, 30)) . "...";
                                                                            } else {
                                                                                echo nl2br(strip_tags($final_desc));
                                                                            } ?>
                                                                        </a>
                                                                    <?php }
                                                                } else { ?>
                                                                    <a href="<?php echo base_url() . 'page/' . $cms_page_data['slug'] . '/reviews'; ?>">
                                                                        <?php if (strlen(strip_tags($final_desc)) > 30) {
                                                                            echo nl2br(substr(strip_tags($final_desc), 0, 30)) . "...";
                                                                        } else {
                                                                            echo nl2br(strip_tags($final_desc));
                                                                        } ?>
                                                                    </a>
                                                                <?php } ?>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <?php if ($i % 3 == 0) { ?>
                                                    </div>
                                    <?php }
                                                }
                                            }
                                        } ?>
                                </div>
                            </div>
                    <?php }
                    }  ?>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-7">
                <div class="tour-page-content mb-10">
                    <div class="tour-page-text p-2">
                        <?php
                        if (is_array($cms_static_content) && sizeof($cms_static_content) > 0) {
                            foreach ($cms_static_content as $cms_content) { ?>
                                <h3><?php echo $cms_content['s_title']; ?></h3>
                                <p><?php echo $cms_content['s_description']; ?></p>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="custom-form tour-page-form mt-10">
                    <div class="alert alert-danger d-none" id="lp_error_msg">

                    </div>
                    <form id="lpForm" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="title">GET IN TOUCH WITH A MOBILITY SPECIALIST</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group field-group">
                                    <fieldset>
                                        <legend>Name</legend>
                                        <input type="text" class="form-control lp_fieldset" id="lp_name" name="lp_name" autocomplete="off">
                                    </fieldset>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group field-group">
                                    <fieldset>
                                        <legend>Email</legend>
                                        <input type="email" class="form-control lp_fieldset" id="lp_email" name="lp_email" autocomplete="off">
                                    </fieldset>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group field-group">
                                    <fieldset>
                                        <legend>Confirm Email</legend>
                                        <input type="email" class="form-control lp_fieldset" id="lp_confirm_email" name="lp_confirm_email" autocomplete="off">
                                    </fieldset>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group field-group">
                                    <fieldset>
                                        <legend>Phone Number</legend>
                                        <input type="text" class="form-control lp_fieldset" id="lp_phone" name="lp_phone" autocomplete="off">
                                    </fieldset>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group field-group">
                                    <fieldset>
                                        <legend>Notes</legend>
                                        <textarea class="form-control lp_fieldset" id="lp_notes" name="lp_notes" rows="4"></textarea>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="col-md-12 text-right">
                                <!-- <a href="#" class="btn btn-yellow mt-3">Submit</a> -->
                                <button type="submit" name="lp_submit" class="btn btn-yellow mt-3">Send me Request</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    $total_reviews = explode(",", $cms_page_data['review_ids']);
    $total_rv = 0;
    if (is_array($total_reviews) && sizeof($total_reviews) > 0) {
        $total_rv = sizeof($total_reviews);
    }
    ?>
    <input type="hidden" name="total_review_ids" id="total_review_ids" value="<?php echo $total_rv; ?>">
</section>

<script type="text/javascript">
    if (jQuery("#total_review_ids").val() > 3) {
        jQuery('#landing_page_review_carousel').owlCarousel({
            loop: true,
            items: 1,
            responsiveClass: true,
            nav: true,
            margin: 0,
            dots: false,
            autoplay: true,
            center: true,
            autoHeight: true
        });
    } else {
        jQuery('#landing_page_review_carousel').owlCarousel({
            loop: false,
            items: 1,
            responsiveClass: true,
            nav: true,
            margin: 0,
            dots: false,
            autoplay: true,
            center: true,
            autoHeight: false
        });
    }

    jQuery.validator.addMethod("lp_noSpace", function(value, element) {
        if ($.trim(value).length > 0) {
            return true;
        } else {
            return false;
        }
    }, "No space please and don't leave it empty");

    jQuery.validator.addMethod("lp_noHTML", function(value, element) {
        // return true - means the field passed validation
        // return false - means the field failed validation and it triggers the error
        return this.optional(element) || /^([a-zA-Z0-9 _&?=(){},.|*+-]+)$/.test(value);
    }, "Special Characters not allowed!");

    jQuery.validator.addMethod("lp_noHTMLtags", function(value, element) {
        if (this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)) {
            return false;
        } else {
            return true;
        }
    }, "HTML tags are Not allowed.");

    jQuery.validator.addMethod("lp_customEmail", function(value, element, param) {
        return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
    }, 'Enter Correct E-mail Address');

    jQuery.validator.addMethod("lp_only_Number", function(value, element) {
        return this.optional(element) || /^([0-9--/]+)$/.test(value);
    }, "Only Numbers and Hypfens '-' are allowed.");

    jQuery("#lpForm").validate({
        //errorClass: 'validation-error',
        errorElement: 'span',
        rules: {
            lp_name: {
                required: true,
                lp_noSpace: true,
                lp_noHTML: true,
                maxlength: 40,
            },
            lp_email: {
                required: true,
                email: true,
                lp_customEmail: true,
            },
            lp_confirm_email: {
                required: true,
                email: true,
                equalTo: "#lp_email"
            },
            lp_phone: {
                required: true,
                lp_noSpace: true,
                lp_only_Number: true,
                maxlength: 15
            },
            lp_notes: {
                required: true,
                lp_noSpace: true,
                lp_noHTMLtags: true,
                maxlength: 1000
            }
        },
        errorPlacement: function(error, element) {
            //console.log('dd', element.attr("name"))
            if (element.parent().hasClass('input-group')) {
                error.insertAfter(element.parent());
            } else if (element.hasClass('lp_fieldset')) {
                // error.appendTo(element.parent("div").next("div"));
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element)
            }
        },
        submitHandler: function(form) {
            //window.scrollTo(0,0);           
            // ajax call
            $.ajax({
                url: BASE_URL + "home/send_lp_data",
                type: 'POST',
                data: jQuery("#lpForm").serialize(),
                beforeSend: function() {
                    ajxLoader('show', '#lpForm');
                },
                dataType: "JSON",
                success: function(data) {
                    if (data.success) {
                        $('#thankyoumodal .modal-body p').text('Thank you for your request. You will receive an email from our agent shortly.');
                        jQuery("#lpForm")[0].reset();
                        $('#thankyoumodal').modal('show');
                    } else {
                        //$('#errormodal').modal('show');
                        jQuery("#lp_error_msg").html(data.msg);
                        jQuery("#lp_error_msg").removeClass('d-none');

                        setTimeout(function() {
                            jQuery("#lp_error_msg").addClass('d-none');
                            jQuery("#lp_error_msg").html("");
                        }, 10000);
                    }
                    ajxLoader('hide', '#lpForm');
                },
                error: function() {
                    //window.scrollTo(0,0);
                    ajxLoader('hide', '#lpForm');
                    jQuery("#lp_error_msg").html("Something went wrong!");
                    jQuery("#lp_error_msg").removeClass('d-none');

                    setTimeout(function() {
                        jQuery("#lp_error_msg").addClass('d-none');
                        jQuery("#lp_error_msg").html("");
                    }, 10000);
                }
            });
        }
    });
</script>