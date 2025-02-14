<section class="section-tour-page pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <div class="tour-page-left">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                if(is_array($cms_page_data) && sizeof($cms_page_data)>0) {
                                   if($cms_page_data['promo_file']!="" || $cms_page_data['promo_url']!=""){  ?>
                                    <video width="100%" controls>
                                      <!-- <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4"> -->
                                      <!-- <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4"> -->
                                      <?php
                                      if($cms_page_data['promo_file']) { ?>
                                        <source src="<?php echo base_url().'uploads/promo_file/'.$cms_page_data['promo_file']; ?>" type="video/ogg">
                                      <?php } else { ?>
                                        <source src="<?php echo $cms_page_data['promo_url']; ?>" type="video/ogg">
                                      <?php } ?>
                                    </video>
                                <?php }  else {
                                    echo "<h3>No Content available</h3>";
                                } } else { 
                                    echo "<h3>No Content available</h3>";
                                } ?> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="tour-page-right">
                        <?php
                        if(is_array($cms_page_data) && sizeof($cms_page_data)>0) {
                           if($cms_page_data['review_ids']!="") {
                                $review_ids=explode(",",$cms_page_data['review_ids']);
                                ?>
                                  <div class="reviews-sidebar-landing-page">
                                    <h2>Reviews</h2>
                                    <div class="review-cat owl-carousel owl-theme" id="landing_page_review_carousel">
                                      <?php
                                      if(is_array($reviews) && sizeof($reviews)>0) { 
                                        foreach($reviews as $r) { 
                                            if(in_array($r['id'],$review_ids)) { ?>
                                              <div class="review-cat-item-lp">
                                                <?php 
                                                if($r['tour_id']) {
                                                  if(get_tour_slug_review($r['tour_id'])) { ?>
                                                    <a href="<?php echo base_url().'reviews/'.get_tour_slug_review($r['tour_id']).'/'.$r['slug']; ?>">
                                                          <div class="img-wrap">
                                                            <?php
                                                            if($r['feature_image']) { ?>
                                                            <img src="<?php echo base_url().'uploads/review_images/'.$r['feature_image'];?>" onerror="this.src='<?php echo base_url()."assets/images/blue-logo.svg";?>'">
                                                            <?php } else { ?>
                                                              <img src="<?php echo base_url().'assets/images/blue-logo.svg';?>">
                                                            <?php } ?>
                                                          </div>
                                                    </a>
                                                  <?php } else { ?>
                                                    <a href="javascript:">
                                                          <div class="img-wrap">
                                                            <?php
                                                            if($r['feature_image']) { ?>
                                                            <img src="<?php echo base_url().'uploads/review_images/'.$r['feature_image'];?>" onerror="this.src='<?php echo base_url()."assets/images/blue-logo.svg";?>'">
                                                            <?php } else { ?>
                                                              <img src="<?php echo base_url().'assets/images/blue-logo.svg';?>">
                                                            <?php } ?>
                                                          </div>
                                                    </a>
                                                  <?php } } else { ?>
                                                    <a href="javascript:">
                                                          <div class="img-wrap">
                                                            <?php
                                                            if($r['feature_image']) { ?>
                                                            <img src="<?php echo base_url().'uploads/review_images/'.$r['feature_image'];?>" onerror="this.src='<?php echo base_url()."assets/images/blue-logo.svg";?>'">
                                                            <?php } else { ?>
                                                              <img src="<?php echo base_url().'assets/images/blue-logo.svg';?>">
                                                            <?php } ?>
                                                          </div>
                                                    </a>
                                                  <?php } ?>
                                                <div class="cat-info">
                                                  <h4>
                                                    <?php 
                                                      if($r['tour_id']) {
                                                        if(get_tour_slug_review($r['tour_id'])) { ?>
                                                          <a href="<?php echo base_url().'reviews/'.get_tour_slug_review($r['tour_id']).'/'.$r['slug']; ?>"><?=(strlen($r['title']) > 30) ? substr($r['title'],0,30)."..." : $r['title'];?></a>
                                                        <?php } else { ?>
                                                          <a href="javascript:"><?=(strlen($r['title']) > 30) ? substr($r['title'],0,30)."..." : $r['title'];?></a>
                                                        <?php } } else { ?>
                                                          <a href="javascript:"><?=(strlen($r['title']) > 30) ? substr($r['title'],0,30)."..." : $r['title'];?></a>
                                                      <?php } ?>
                                                  </h4>
                                                  <?php
                                                    $desc=preg_replace("/<img[^>]+\>/i", " ", $r['description']); 
                                                    $final_desc=preg_replace("/<\/?a( [^>]*)?>/i", "", $desc);
                                                  ?>
                                                  <p>
                                                    <?php 
                                                      if($r['tour_id']) {
                                                        if(get_tour_slug_review($r['tour_id'])) { ?>
                                                          <a href="<?php echo base_url().'reviews/'.get_tour_slug_review($r['tour_id']).'/'.$r['slug']; ?>">
                                                              <?php if(strlen(strip_tags($final_desc)) > 30) { echo nl2br(substr(strip_tags($final_desc),0,30))."..."; } else { echo nl2br(strip_tags($final_desc)); }?>
                                                          </a>
                                                    <?php } else { ?>
                                                          <a href="javascript:">
                                                            <?php if(strlen(strip_tags($final_desc)) > 30) { echo nl2br(substr(strip_tags($final_desc),0,30))."..."; } else { echo nl2br(strip_tags($final_desc)); }?>
                                                          </a>
                                                    <?php } } else { ?>
                                                          <a href="javascript:">
                                                            <?php if(strlen(strip_tags($final_desc)) > 30) { echo nl2br(substr(strip_tags($final_desc),0,30))."..."; } else { echo nl2br(strip_tags($final_desc)); }?>
                                                          </a>
                                                    <?php } ?>
                                                  </p>
                                                </div>
                                              </div>
                                      <?php } } ?>
                                    </div>
                                  </div>
                                  <?php } ?>
                        <?php } }  ?>
                    </div>
                </div>

            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="trustpilot-widget rimage-wrap">
                        <!-- <h4>Trust Pilot Widget</h4> -->
                        <div id="TA_selfserveprop474" class="TA_selfserveprop">
                            <ul id="W7FYqAsJCLkN" class="TA_links oPiBzrYL">
                              <li id="e7J3dL0J5aiU" class="Q6SuU3"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g187791-d1638989-Reviews-DriverinRome_Transportation_Tours-Rome_Lazio.html">
                                <img src="https://www.tripadvisor.com/img/cdsi/img2/branding/v2/Tripadvisor_lockup_horizontal_secondary_registered-11900-2.svg" alt="TripAdvisor"/></a>
                              </li>
                            </ul>
                        </div>
                        <script async  src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=474&amp;locationId=1638989&amp;lang=en_US&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=true&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tripadvisor-widget trustpilot">
                        <!-- <h4>Trip Advisor Widget</h4> -->
                        <!-- TrustBox widget - Carousel -->
                        <div class="trustpilot-widget" data-locale="en-US" data-template-id="53aa8912dec7e10d38f59f36" data-businessunit-id="5720a2100000ff00058c1686" data-style-height="130px" data-style-width="100%" data-theme="dark" data-stars="1,2,3,4,5" data-review-languages="en">
                            <a href="https://www.trustpilot.com/review/driverinrome.com" target="_blank" rel="noopener">Trustpilot</a>
                        </div>
                        <!-- End TrustBox widget -->
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="tour-page-content">
                        <div class="tour-page-text">
                            <?php
                            if(is_array($cms_static_content) && sizeof($cms_static_content)>0) {
                                foreach($cms_static_content as $cms_content) { ?>
                                    <h3><?php echo $cms_content['s_title']; ?></h3>
                                    <p><?php echo $cms_content['s_description']; ?></p>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="custom-form tour-page-form">
                        <div class="alert alert-danger d-none" id="lp_error_msg">
                        
                        </div>
                        <form id="lpForm" method="post">
                            <div class="row">
                                <!-- <div class="col-md-12">
                                    <h3 class="title"></h3>
                                </div> -->
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

                                <div class="col-md-12 text-right">
                                    <!-- <a href="#" class="btn btn-yellow mt-3">Submit</a> -->
                                    <button type="submit" name="lp_submit" class="btn btn-yellow mt-3">Submit</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

<script type="text/javascript">
    jQuery('#landing_page_review_carousel').owlCarousel({
        loop: true,
        items: 1,
        responsiveClass: true,
        nav: true,
        margin: 0,   
        dots:false, 
        autoplay: true,
        center: true,
        autoHeight:false
    });

jQuery.validator.addMethod("lp_noSpace", function(value, element) { 
    if($.trim(value).length > 0){
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

jQuery.validator.addMethod("lp_noHTMLtags", function(value, element){
    if(this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)){
        return false;
    } else {
        return true;
    }
}, "HTML tags are Not allowed.");

jQuery.validator.addMethod("lp_customEmail", function(value, element, param) {
  return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Enter Correct E-mail Address');

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
            lp_confirm_email : {
                required: true,
                email: true,
                equalTo : "#lp_email"
            },
            lp_phone: {
                required: true,
                lp_noSpace: true,
                lp_only_Number: true,
                maxlength: 15
            }
        }, 
        errorPlacement: function (error, element) {
            //console.log('dd', element.attr("name"))
            if (element.parent().hasClass('input-group')) {
                 error.insertAfter( element.parent() );
            } else if (element.hasClass('lp_fieldset')) {
                // error.appendTo(element.parent("div").next("div"));
                 error.insertAfter( element.parent());
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
                    beforeSend:function() {
                        ajxLoader('show', '#lpForm');
                    },
                    dataType:"JSON",
                    success: function(data) { 
                        if (data.success) {
                            $('#thankyoumodal .modal-body p').text('Thank you for your request. You will receive an email from our agent shortly.'); 
                            jQuery("#lpForm")[0].reset();
                            $('#thankyoumodal').modal('show');
                        } else {
                            //$('#errormodal').modal('show');
                            jQuery("#lp_error_msg").html(data.msg);
                            jQuery("#lp_error_msg").removeClass('d-none');

                            setTimeout(function(){
                                jQuery("#lp_error_msg").addClass('d-none');
                                jQuery("#lp_error_msg").html("");                                    
                            }, 10000);                
                        }
                        ajxLoader('hide', '#lpForm');
                    },
                    error:function(){
                        //window.scrollTo(0,0);
                        ajxLoader('hide', '#lpForm');
                        jQuery("#lp_error_msg").html("Something went wrong!");
                        jQuery("#lp_error_msg").removeClass('d-none');

                        setTimeout(function(){
                            jQuery("#lp_error_msg").addClass('d-none');
                            jQuery("#lp_error_msg").html("");                                 
                        }, 10000);
                    }
                });
            }
    });
</script>