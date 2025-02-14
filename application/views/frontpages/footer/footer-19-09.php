<?php
$get_settings = get_admin_settings();
$youtube_url = '';
foreach ($get_settings as $single_settings) {
  if ($single_settings['name'] == 'youtube_url') {
    $youtube_url = $single_settings['value'];
  }
}
if ($this->uri->segment(1) != 'partners') {
?>
  <section class="contact-section contact-section-wrap d-none">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="rimage-wrap">
            <div id="TA_selfserveprop474" class="TA_selfserveprop">
              <ul id="W7FYqAsJCLkN" class="TA_links oPiBzrYL">
                <li id="e7J3dL0J5aiU" class="Q6SuU3"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g187791-d1638989-Reviews-DriverinRome_Transportation_Tours-Rome_Lazio.html">
                    <img src="https://www.tripadvisor.com/img/cdsi/img2/branding/v2/Tripadvisor_lockup_horizontal_secondary_registered-11900-2.svg" alt="TripAdvisor" /></a>
                </li>
              </ul>
            </div>
            <script async defer src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=474&amp;locationId=1638989&amp;lang=en_US&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=true&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>
            <!-- #home-trip-advisor -->
          </div>
        </div>
        <div class="col-md-8">
          <div class="trustpilot">
            <!-- TrustBox widget - Carousel -->
            <div class="trustpilot-widget" data-locale="en-US" data-template-id="53aa8912dec7e10d38f59f36" data-businessunit-id="5720a2100000ff00058c1686" data-style-height="150px" data-style-width="100%" data-theme="dark" data-stars="1,2,3,4,5" data-review-languages="en">
              <a href="https://www.trustpilot.com/review/driverinrome.com" target="_blank" rel="noopener">Trustpilot</a>
            </div>
            <!-- End TrustBox widget -->
          </div>
          <div class="contact-form">
            <h2>Contact Us</h2>
            <form id="contactUs" name="contactUs" method="POST" onsubmit="return preventFormSubmit(event)">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <fieldset class="fullname-fieldset">
                      <legend>Full Name</legend>
                      <input type="text" class="form-control" id="fullname" name="fullname" autocomplete="off">
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <fieldset class="email-fieldset">
                      <legend>Email</legend>
                      <input type="email" class="form-control" id="email" name="email" autocomplete="off">
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <fieldset class="confEmail-fieldset">
                      <legend>Confirm Email</legend>
                      <input type="email" class="form-control" id="confEmail" name="confEmail" autocomplete="off">
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <fieldset class="phoneNumber-fieldset">
                      <legend>Phone Number</legend>
                      <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" autocomplete="off">
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <fieldset class="noOfPassenger-fieldset">
                      <legend>Number of Passengers</legend>
                      <input type="number" class="form-control" id="noOfPassenger" name="noOfPassenger" autocomplete="off">
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <fieldset class="contact-find-us-fieldset">
                      <legend>How Did You Find Us</legend>
                      <select class="form-control contact-found-us" name="contactHowDidFind" id="contactHowDidFind">
                        <option value="">--Select--</option>
                        <option value="Travel Agent">Travel Agent</option>
                        <option value="Friend Suggestion">Friend Suggestion</option>
                        <option value="Internet Search">Internet Search</option>
                        <option value="I am a Previous Guest">I am a Previous Guest</option>
                        <option value="Tripadvisor">Tripadvisor</option>
                        <option value="Other">Other</option>
                      </select>
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <fieldset class="message-fieldset">
                      <legend>Message (please add as many details as possible)</legend>
                      <textarea rows="2" class="form-control" id="message" name="message"></textarea>
                    </fieldset>
                  </div>
                </div>
              </div>
              <div class="remember">
                <label class="accept-plocy-txt"><input type="checkbox" name="acceptPolicy" id="acceptPolicy" />By submitting this form I accept your <a href="<?= base_url('privacy-policy'); ?>" target="_blank">Privacy Policy</a></label>
              </div>
              <button type="submit" class="btn btn-yellow">submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="subscribe-section" id="subscribe-section-id">
    <h2 style="display: none;">Subscribe to our newsletter</h2>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="sub-content">
            <img src="<?= ASSET ?>images/subscribe-icon.svg" alt="Subscribe">
            <span>Subscribe to our newsletter to get new promos!</span>
          </div>
        </div>
        <div class="col-md-6">
          <form name="newsletterSubscribe" id="newsletterSubscribe" method="POST" onsubmit="return preventFormSubmit(event)">
            <div class="form-group subscribe-field-wrap">
              <input type="email" class="form-control" id="subscribeemail" placeholder="Enter your email address" name="subscribeemail">
              <button type="submit" class="btn btn-blue subscribe-btn">Subscribe</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="img-wrap">
            <a href="<?= BASE_URL ?>">
              <img src="<?= ASSET ?>images/blue-logo.svg" alt="Footer Logo">
            </a>
          </div>
        </div>
        <div class="col-md-3">
          <h3>Quick Links</h3>
          <ul>
            <li>
              <a href="<?= BASE_URL ?>about-us">About Us</a>
            </li>
            <li>
              <a href="<?= BASE_URL ?>fleet">Fleet</a>
            </li>
            <li>
              <a data-toggle="modal" data-target="#video_galley_popup" class="video-gallery-popup">Video Gallery</a>
            </li>
            <li>
              <a href="<?php echo BASE_URL . 'travel-agent-landing-page'; ?>">Travel agents affiliate</a>
            </li>
            <li>
              <a href="<?php echo BASE_URL . 'custom-booking'; ?>">Custom Booking</a>
            </li>
            <?php
            $tour_landing_page = get_cms_tour_landing_page();
            if (is_array($tour_landing_page) && sizeof($tour_landing_page) > 0) {
              foreach ($tour_landing_page as $tp) {
                if ($tp['slug'] != "" && $tp['page_title'] != "") { ?>
                  <li>
                    <a href="<?php echo BASE_URL . 'tour-landing-page/' . $tp['slug']; ?>"><?php echo $tp['page_title']; ?></a>
                  </li>
            <?php  }
              }
            }
            ?>
          </ul>
        </div>
        <div class="col-md-3">
          <h3>Policies</h3>
          <ul>
            <li>
              <a href="<?= BASE_URL ?>cancellation-policy">Cancellation Policy</a>
            </li>
            <li>
              <a href="<?= BASE_URL ?>our-guarantee">Our Guarantee</a>
            </li>
            <li>
              <a href="<?= BASE_URL ?>airport-meeting-instructions">Airport meeting instructions</a>
            </li>
            <li>
              <a href="<?= BASE_URL ?>cruise-arrival-instructions">Cruise arrival instructions</a>
            </li>
            <li>
              <a href="<?= BASE_URL ?>privacy-policy">Privacy Policy</a>
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <h3>Help</h3>
          <ul>
            <li>
              <a href="#" class="contact-link">Contact Us</a>
            </li>
            <li>
              <a href="#" onclick="smartsupp('chat:open'); return false;">Chat with Us</a>
            </li>
          </ul>
        </div>
      </div>
      <p class="text-center">In Associazione con Agenzia di Viaggio e Turismo Driver & Tours di Driverinrome Societa' Cooperativa a R.L. Licenza rilasciata dalla Provincia di Roma Numero 32888/15. Partita Iva 13627291001 Assicurazione Allianz Polizza Numero 198630 E-mail: agenziadiviaggio@driverinrome.com - www.driverandtours.it Tel. (+39) 066244373 - US number (315) 544-0496 - Whatsapp: (0039)392 4468283</p>
      <hr>
      <p class="copyright">DRIVERINROME - © <?= date("Y"); ?> All Rights Reserved</p>
    </div>
  </footer>
<?php
}
?>
<!-- // thank you modal -->
<div id="thankyoumodal" class="modal fade" role="dialog" tabindex="-1" style="display: none !important;" aria-hidden="true">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-content-wrap">
          <img data-src="<?= EMAIL_WELCOME_PNG ?>" alt="Smile Expression" class="smile-popup lazyload">
          <h4 class="modal-title text-center">Thank you</h4>
        </div>
        <p>Thank you for your request. You will receive an email from our agent shortly.</p>
        <div class="modal-form">
          <button type="button" class="btn btn-yellow mt-3" id="thankyou_modal_close" data-dismiss="modal">Ok</button>
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
          <img data-src="<?= EMAIL_OOPS_PNG ?>" alt="Oops Expression" class="oops-popup lazyload">
        </div>
        <h4 class="modal-title text-center">Error</h4>
        <p id="err_msg">Getting error while sending email, please try again later!</p>
        <div class="modal-form">
          <button type="button" class="btn btn-yellow mt-3" data-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="quickquote" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">QUICK QUOTE FORM</h4>
        <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
      </div>
      <form id="quickQuoteFrm" name="quickQuoteFrm" method="POST" onsubmit="return preventFormSubmit(event)">
        <div class="modal-body">
          <div class="modal-form">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <fieldset class="qfullname-fieldset">
                    <legend>Full Name</legend>
                    <input type="text" class="form-control" id="qfullname" name="qfullname" autocomplete="off">
                  </fieldset>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <fieldset class="qemail-fieldset">
                    <legend>Email</legend>
                    <input type="email" class="form-control" id="qemail" name="qemail" autocomplete="off">
                  </fieldset>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <fieldset class="qconfEmail-fieldset">
                    <legend>Confirm Email</legend>
                    <input type="email" class="form-control" id="qconfEmail" name="qconfEmail" autocomplete="off">
                  </fieldset>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <fieldset class="qphoneNumber-fieldset">
                    <legend>Phone Number</legend>
                    <input type="text" class="form-control" id="qphoneNumber" name="qphoneNumber" autocomplete="off">
                  </fieldset>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group select2-popup">
                  <fieldset class="howDidFind-fieldset">
                    <legend>How Did You Find Us</legend>
                    <select class="form-control quote-found-us" name="howDidFind" id="howDidFind">>
                      <option value="">--Select--</option>
                      <option value="Travel Agent">Travel Agent</option>
                      <option value="Friend Suggestion">Friend Suggestion</option>
                      <option value="Internet Search">Internet Search</option>
                      <option value="I am a Previous Guest">I am a Previous Guest</option>
                      <option value="Tripadvisor">Tripadvisor</option>
                      <option value="Other">Other</option>
                    </select>
                  </fieldset>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <fieldset class="notes-fieldset">
                    <legend>Notes</legend>
                    <textarea rows="2" class="form-control" id="notes" name="notes"></textarea>
                  </fieldset>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-yellow">submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- get a call model -->
<div id="getacall" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Get a Call</h4>
        <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
      </div>
      <form id="getacallFrm" name="getacallFrm" method="POST" onsubmit="return preventFormSubmit(event)">
        <div class="modal-body">
          <div class="modal-form">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <fieldset class="callfullname-fieldset">
                    <legend>Full Name</legend>
                    <input type="text" class="form-control" id="callfullname" name="callfullname" autocomplete="off">
                  </fieldset>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <fieldset class="callemail-fieldset">
                    <legend>Email</legend>
                    <input type="email" class="form-control" id="callemail" name="callemail" autocomplete="off">
                  </fieldset>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <fieldset class="callconfEmail-fieldset">
                    <legend>Confirm Email</legend>
                    <input type="email" class="form-control" id="callconfEmail" name="callconfEmail" autocomplete="off">
                  </fieldset>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <fieldset class="callcity-fieldset">
                    <legend>City</legend>
                    <input type="text" class="form-control" id="callcity" name="callcity" autocomplete="off">
                  </fieldset>
                </div>
              </div>
              <div class="col-md-6 select2-popup">
                <div class="form-group">
                  <fieldset class="callcountry-fieldset">
                    <legend>Country</legend>
                    <input type="text" class="form-control" id="callcountry" name="callcountry" autocomplete="off">
                  </fieldset>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <fieldset class="callphoneNumber-fieldset">
                    <legend>Phone Number</legend>
                    <input type="text" class="form-control" id="callphoneNumber" name="callphoneNumber" autocomplete="off">
                  </fieldset>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <fieldset class="besttimecall-fieldset">
                    <legend>Best time to be called back (e.g. 10 AM TO 5 PM)</legend>
                    <input type="text" class="form-control" id="besttimecall" name="besttimecall" autocomplete="off">
                    <input type="hidden" class="succ_msg" name="succ_msg" value="<?= get_settings('get_a_call_success'); ?>">
                  </fieldset>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-yellow">submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
if (!is_home()) {
?>
  <!--Check Tour Availability Model-->
  <div id="tour_select_date_modal" class="modal fade tour_select_date_modal" role="dialog" tabindex="-1" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title addModalTitle">Availability</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="cursor:pointer">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="availabilityForm">
          <div class="modal-body">
            <div class="UserDetails">
              <div class="row">
                <div class="col-md-6">
                  <div class="wrapDiv">
                    <div class="left">
                      <i class="fas fa-user"></i><span class="user_detail"></span>
                    </div>
                    <div class="right">
                      <a href="javascript:" class="edit_tour_person_m"><i class="far fa-edit "></i>Edit</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="wrapDiv">
                    <div class="left">
                      <!-- <p class="blueText">Rome to India<br/>Loram Ipsum</p> -->
                      <p class="blueText tour_detail_m"></p>
                    </div>
                    <div class="right">
                      <h5 class="code-id"><span>Code : </span><strong class="tour_code_val"></strong></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="PackageSelectWrap">
              <div class="PackageContent">
                <div class="tour_date_price_slider owl-carousel ">
                  <?php
                  $current_date = date('d M Y');
                  //$endDate=date("d M Y",strtotime('+6 months'));
                  $endDate = date("d M Y", strtotime('+1 year'));
                  $cnt = 0;
                  while (strtotime($current_date) <= strtotime($endDate)) { ?>
                    <div class="item text-center tour_calender_dates item_d<?php echo $cnt; ?> date_hover" onclick="get_tour_price('<?php echo date("Y-m-d", strtotime($current_date)); ?>','<?php echo $cnt; ?>')">
                      <div class="single_tour_date t_dp<?php echo $cnt; ?>"><?php echo date('d M Y', strtotime($current_date)); ?></div>
                      <div class="single_tour_price t_dp<?php echo $cnt; ?>" data-tour-date="<?php echo date('Y-m-d', strtotime($current_date)); ?>" data-cnt="<?php echo $cnt; ?>"></div>
                    </div>

                  <?php
                    $current_date = date('d M Y', strtotime('+1 days', strtotime($current_date)));
                    $cnt++;
                  } ?>
                </div>
                <input type="hidden" name="last_select_date_index" id="last_select_date_index" value="">
                <input type="hidden" name="base_price_value" id="base_price_value" value="">
              </div>
            </div>
            <div class="UserDetails price_div_m">
              <div class="row">
                <div class="col-md-6">
                  <div class="wrapDiv">
                    <div class="left">
                      <h5 class="code-id"><span>Date : </span><strong class="selected_tour_date"></strong></h5>
                      <h5 class="code-id"><span>Duration : </span><strong class="tour_duration_m"></strong></h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="wrapDiv">
                    <div class="left">
                      <h5 class="code-id"><span>Total Price : </span><strong class="total_price_single_tour"></strong></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <input type="hidden" name="adult_price" id="adult_price" value="">
              <input type="hidden" name="senior_price" id="senior_price" value="">
              <input type="hidden" name="kids_price" id="kids_price" value="">
              <input type="hidden" name="infant_price" id="infant_price" value=""> -->
            <input type="hidden" name="selected_date" id="selected_date" value="">
            <input type="hidden" name="tour_notes" id="tour_notes" value="">
            <input type="hidden" name="final_price" id="final_price" value="">
            <input type="hidden" name="adult_ttl_person" id="adult_ttl_person" value="">
            <input type="hidden" name="senior_ttl_person" id="senior_ttl_person" value="">
            <input type="hidden" name="kids_ttl_person" id="kids_ttl_person" value="">
            <input type="hidden" name="infants_ttl_person" id="infants_ttl_person" value="">
            <input type="hidden" name="total_person_m" id="total_person_m" value="">
            <input type="hidden" name="tour_id_m" id="tour_id_m" value="">
            <input type="hidden" name="tour_availability_m" id="tour_availability_m" value="1">
            <input type="hidden" name="edit_booking_detail_m" id="edit_booking_detail_m" value="">
            <input type="hidden" name="add_booking_detail_m" id="add_booking_detail_m" value="">

            <button name="go_back_tour_details" type="button" id="go_back_tour_details" class="btn btn-border" data-dismiss="modal"><?php _el('go_back'); ?></button>
            <button name="send_me_quote" type="submit" id="send_me_quote" class="btn btn-yellow"><?php _el('send_me_quote'); ?></button>
            <button type="submit" name="continue_tour_add" id="continue_tour_add" class="btn btn-blue"><?php _el('book_now'); ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--End Check Tour Availability Model-->
<?php
}
?>
<div class="custom-notification-popup">
  <div class="popup-notification">
    <button class="popup-notification-close">×</button>
    <h4>Success</h4>
    <p>Transfer Services activated.</p>
  </div>
</div>

<!-- get a call model -->
<div id="video_galley_popup" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
      <input type="hidden" name="yt_gallery_link" id="yt_gallery_link" value="https://www.youtube.com/embed/videoseries?list=PL1snaukp8GixAElA2Q0QDKIz62xOyV-bz">
      <div class="modal-body">
        <!-- <iframe width="100%" height="100%" src="https://www.youtube.com/embed/videoseries?list=PL1snaukp8GixAElA2Q0QDKIz62xOyV-bz" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
        <div class="playlist-wrap">
          <p>Click on playlist for other videos</p>
        </div>
      </div>
    </div>
    <!-- <div class="modal-footer">
        <p><b>Click on playlist for other videos</b></p>     
      </div> -->
  </div>
</div>

<?php
if ($this->session->flashdata('error')) { ?>
  <input type="hidden" name="error" id="error" value="<?php echo $this->session->flashdata('error'); ?>">
<?php   }
if ($this->session->flashdata('success')) { ?>
  <input type="hidden" name="success" id="success" value="<?php echo $this->session->flashdata('success'); ?>">
<?php  }
//if ($this->session->flashdata('warning_alert')) { 
?>
<input type="hidden" name="warning_alert" id="warning_alert" value="<?php //echo $this->session->flashdata('warning_alert'); 
                                                                    ?>">
<?php  //} 
?>
<?php
if ($this->uri->segment(1) != "") { ?>
  <script src="<?php echo base_url('assets/js/paginathing.min.js'); ?>"></script>
  <script src="<?= ASSET ?>js/popper.min.js"></script>
<?php } ?>
<?php
if ($this->uri->segment(1) == "tours") { ?>
  <script src="<?php echo base_url('assets/js/web/bootstrap-datepicker.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/web/ajax-tour-details.js?v=7.0.3'); ?>"></script>
<?php }
if ($this->uri->segment(1) == "get_quote") { ?>
  <script src="<?php echo base_url('assets/scripts/web/ajax-request-quote.js'); ?>"></script>
<?php }
if ($this->uri->segment(1) == "availability_ticket") { ?>
  <script src="<?php echo base_url('assets/js/web/bootstrap-datepicker.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/web/ajax-availability-ticket.js'); ?>"></script>
<?php }
if ($this->uri->segment(1) == "partners") {
?>
  <script src="<?php echo base_url('assets/js/web/bootstrap-datepicker.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/web/shared-tour.js'); ?>"></script>
<?php
}
?>
<script>
  $(window).on('load', function() {
    // jQuery("a.youtube-link").YouTubePopUp({
    //   autoplay: 0
    // });
  });
</script>
<?php
$minify_js_css = get_settings('minify_js');
?>
<input type="hidden" name="url_segment_1" id="url_segment_1" value="<?php echo $this->uri->segment(1); ?>">
<?php
if ($minify_js_css == 1) { ?>
  <script src="<?= ASSET ?>js/custom.min.js?ver=<?php echo time(); ?>"></script>
<?php } else { ?>
  <script src="<?= ASSET ?>js/custom.js?ver=<?php echo time(); ?>"></script>
<?php } ?>
<script src="https://afarkas.github.io/lazysizes/lazysizes.min.js"></script>
<script>
  // stop vidoe play after close modal popup
  $("#video_galley_popup").on("hidden.bs.modal", function() {
    $('#video_galley_popup iframe').attr('src', '');
  });
  // reset vidoe popup when open video
  $(".fa-youtube, .video-gallery-popup").on("click", function() {
    $('#video_galley_popup iframe').attr('src', '');
    $('#video_galley_popup iframe').attr('src', $('#yt_gallery_link').val());
  });
</script>
<script src="https://www.google.com/recaptcha/api.js?render=<?= GOOGLE_SITE_KEY ?>" defer async></script>
</body>

</html>