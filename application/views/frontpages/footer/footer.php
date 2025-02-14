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
<style>
    .rating-wrapper {
        background: #00000080 0% 0% no-repeat padding-box;
        border-radius: 5px;
        opacity: 1;
        padding: 30px;
        font-family: 'Trajan Pro 3';
        color: #fff;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .rating-heading {
        font-size: 24px;
        line-height: normal;
        font-family: 'Trajan Pro 3';
        font-weight: bold;
    }
    .main_star_div{
        width: 35px;
        height: 35px;
        position: relative;
        margin-right: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #d4d4d4;
        
    }
    .main_star_div .star_left {
        position: absolute; 
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .main_star_div span.star_span {
        position: relative;
        display: inline-block;
        transform: scale(0.85);
        line-height: 0.85;
    }
    .main_star_div span.star_span svg {
        width: 23px;
    }
    .chk_div{
        background-color: #00b67a !important;
    }

    .tp-stars--5 .tp-star:nth-of-type(-n + 5) .tp-star__canvas, .tp-stars--5 .tp-star:nth-of-type(-n + 5) .tp-star__canvas--half {
        fill: #00b67a;
    }
    .tp-star_halfstar .tp-star__canvas--half {
        fill: #00b67a !important;
    }
    .tp-star_halfstar .tp-star__canvas {
        fill: #dbdcdd !important;
    }
    .contact-section-wrap  .rating-wrapper a {
        color: #ffffff;
    }
    .contact-section-wrap .rating-wrapper a:hover {
        text-decoration: unset;
    }
    @media (max-width: 1499px) {
      .rating-wrapper {
        font-size: 18px;
      }      
    }
</style>
  <section class="contact-section contact-section-wrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-12">
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
        <div class="col-lg-8 col-md-12 col-12">
          <div class="trustpilot">
            <!-- TrustBox widget - Carousel -->
            <div class="trustpilot-widget" data-locale="en-US" data-template-id="53aa8912dec7e10d38f59f36" data-businessunit-id="5720a2100000ff00058c1686" data-style-height="150px" data-style-width="100%" data-theme="dark" data-stars="1,2,3,4,5" data-review-languages="en">
              <a href="https://www.trustpilot.com/review/driverinrome.com" target="_blank" rel="noopener">Trustpilot</a>
            </div>
            <!-- End TrustBox widget -->
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12">
          <?php
        		$review_platform_details = unserialize(get_settings('platform_review_detail'));
            foreach ($review_platform_details as $key => $review_details) {
              $exclude_footer = $review_details['exclude_footer'];
              $review_platform_rating = $review_details['review_platform_rating'];
              $review_platform_name = $review_details['review_platform_name'];
              $review_image = $review_details['review_image'];
              $review_based_on = $review_details['review_based_on'];
              if(empty($exclude_footer)){
              ?>
              <div class="rating-wrapper">
                 <div class="rating-heading d-flex align-items-center justify-content-center">
                   <span class="google-icon mr-3">
                   <div class="review_icon">
                    <a href="<?php echo $review_details['review_links'] ?>" target="_blank">
                      <img src="<?php echo base_url('assets/images/review_imgs/' . $review_image); ?>" class="img-fluid" alt=""/>
                    </a>
                    </div>
                   </span>
                     <span><a href="<?php echo $review_details['review_links'] ?>" target="_blank"><?php echo $review_platform_name; ?></a></span>
                 </div>             
                 <div class="rating-start">
                   <div class="tp-stars tp-stars--5 text-center my-3 justify-content-center d-flex">
                     
                       <title id="starRating-3738td0mll" lang="en"><?php echo $review_platform_rating; ?> out of five star rating on Google</title>                   
                       <div class="d-flex flex-wrap align-items-center">
                           <?php
                               for ($i=1; $i <= 5 ; $i++) {
                                   if($i <= $review_platform_rating){
                           ?>
                                   <div class="main_star_div">
                                       <div class="star_left str_div chk_div">
                                       </div>
                                       <span class="star_span">
                                           <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 23 23" style="enable-background:new 0 0 23 23;" xml:space="preserve">
                                           <style type="text/css">
                                               .st0{fill:#FFFFFF;}
                                           </style>
                                           <g>
                                               <path class="st0" d="M23,8.8L4.4,23l2.7-8.8L0,8.8h8.8L11.5,0l2.7,8.8H23z M11.5,17.6l5.1-1.1l2,6.6L11.5,17.6z"></path>
                                           </g>
                                           </svg>
                                       </span>
                                   </div>
                                    <?php    
                                   }else{ 
                                       $j = $i - 0.5;
                                       if($j == $review_platform_rating){
                                        ?>
                                       <div class="main_star_div">
                                           <div class="star_left str_div chk_div" style="width:50%"></div>
                                           <span class="star_span">
                                               <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 23 23" style="enable-background:new 0 0 23 23;" xml:space="preserve">
                                               <style type="text/css">
                                                   .st0{fill:#FFFFFF;}
                                               </style>
                                               <g>
                                                   <path class="st0" d="M23,8.8L4.4,23l2.7-8.8L0,8.8h8.8L11.5,0l2.7,8.8H23z M11.5,17.6l5.1-1.1l2,6.6L11.5,17.6z"></path>
                                               </g>
                                               </svg>
                                           </span>
                                       </div>
                           <?php       } else{ ?>
                                           <div class="main_star_div">
                                               <div class="star_left str_div ">
                                               </div>
                                               <span class="star_span">
                                                   <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 23 23" style="enable-background:new 0 0 23 23;" xml:space="preserve">
                                                   <style type="text/css">
                                                       .st0{fill:#FFFFFF;}
                                                   </style>
                                                   <g>
                                                       <path class="st0" d="M23,8.8L4.4,23l2.7-8.8L0,8.8h8.8L11.5,0l2.7,8.8H23z M11.5,17.6l5.1-1.1l2,6.6L11.5,17.6z"></path>
                                                   </g>
                                                   </svg>
                                               </span>
                                           </div>
                           <?php       }
                                   }                              
                               }
                           ?>
                       </div>                 
                   </div>
                 </div>
                 <div class="rating-text d-flex align-items-center justify-content-center">
                   <div><span class="font-weight-bold mr-2"><?php echo $review_platform_rating; ?></span>Stars</div>
                   <div class="mx-2">|</div>
                   <div><span class="font-weight-bold mr-2"><?php echo $review_based_on; ?></span>Reviews</div>
                 </div>
             </div>
             <?php
            }
          }
          ?>
           <!-- <div class="rating-wrapper">
              <div class="rating-heading d-flex align-items-center justify-content-center">
                <span class="google-icon mr-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="-3 0 262 262" preserveAspectRatio="xMidYMid"><path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285F4"/><path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"/><path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"/><path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"/></svg>
                </span>
                  <span>Google Reviews</span>
              </div>
              <?php 
                $rating = get_settings('google_rating');
                $user_ratings_total = get_settings('total_review');               
              ?>              
              <div class="rating-start">
                <div class="tp-stars tp-stars--5 text-center my-3 justify-content-center d-flex">
                  
                    <title id="starRating-3738td0mll" lang="en"><?php echo $rating; ?> out of five star rating on Google</title>                   
                    <div class="d-flex flex-wrap align-items-center">
                        <?php
                            for ($i=1; $i <= 5 ; $i++) {
                                if($i <= $rating){
                        ?>
                                <div class="main_star_div">
                                    <div class="star_left str_div chk_div">
                                    </div>
                                    <span class="star_span">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 23 23" style="enable-background:new 0 0 23 23;" xml:space="preserve">
                                        <style type="text/css">
                                            .st0{fill:#FFFFFF;}
                                        </style>
                                        <g>
                                            <path class="st0" d="M23,8.8L4.4,23l2.7-8.8L0,8.8h8.8L11.5,0l2.7,8.8H23z M11.5,17.6l5.1-1.1l2,6.6L11.5,17.6z"></path>
                                        </g>
                                        </svg>
                                    </span>
                                </div>
                        <?php    
                                }else{ 
                                    $j = $i - 0.5;
                                    if($j == $rating){

                        ?>
                                    <div class="main_star_div">
                                        <div class="star_left str_div chk_div" style="width:50%">
                                        </div>
                                        <span class="star_span">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 23 23" style="enable-background:new 0 0 23 23;" xml:space="preserve">
                                            <style type="text/css">
                                                .st0{fill:#FFFFFF;}
                                            </style>
                                            <g>
                                                <path class="st0" d="M23,8.8L4.4,23l2.7-8.8L0,8.8h8.8L11.5,0l2.7,8.8H23z M11.5,17.6l5.1-1.1l2,6.6L11.5,17.6z"></path>
                                            </g>
                                            </svg>
                                        </span>
                                    </div>
                        <?php       } else{ ?>
                                        <div class="main_star_div">
                                            <div class="star_left str_div ">
                                            </div>
                                            <span class="star_span">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 23 23" style="enable-background:new 0 0 23 23;" xml:space="preserve">
                                                <style type="text/css">
                                                    .st0{fill:#FFFFFF;}
                                                </style>
                                                <g>
                                                    <path class="st0" d="M23,8.8L4.4,23l2.7-8.8L0,8.8h8.8L11.5,0l2.7,8.8H23z M11.5,17.6l5.1-1.1l2,6.6L11.5,17.6z"></path>
                                                </g>
                                                </svg>
                                            </span>
                                        </div>
                        <?php       }
                                }                              
                            }
                        ?>
                    </div>                 
                </div>
              </div>
              <div class="rating-text d-flex align-items-center justify-content-center">
                <div><span class="font-weight-bold mr-2"><?php echo $rating; ?></span>Stars</div>
                <div class="mx-2">|</div>
                <div><span class="font-weight-bold mr-2"><?php echo $user_ratings_total; ?></span>Reviews</div>
              </div>
          </div> -->
        </div>
        <div class="col-lg-8 col-md-12 col-12">
          <div class="contact-form">
            <h2>Contact Us</h2>
            <form id="contactUs" name="contactUs" method="POST" onsubmit="return preventFormSubmit(event)">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <fieldset class="fullname-fieldset">
                      <legend>Full Name</legend>
                      <input type="text" class="form-control" id="fullname" name="fullname" autocomplete="off" maxlength="200">
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
                      <input type="text" class="form-control" id="noOfPassenger" name="noOfPassenger" oninput="validateInput(this)" autocomplete="off">
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
                        <fieldset class="qphoneNumber-fieldset">
                          <legend>Service(s) you're interested in</legend>
                          <input type="text" class="form-control" id="interest_service" name="interest_service" maxlength="100">
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <fieldset class="qphoneNumber-fieldset">
                          <legend>Date(s) - please spell out the month</legend>
                          <input type="text" class="form-control" id="c_dates" name="c_dates">
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <fieldset class="qphoneNumber-fieldset">
                          <legend>If going on a cruise, name of ship</legend>
                          <input type="text" class="form-control" id="name_of_ship" name="name_of_ship">
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <fieldset class="message-fieldset">
                      <legend>
                        <!-- Message (please add as many details as possible and do not forget dates travelling) -->
                        Message - all pertinent details, special requests, amount of luggage if inquiring about a transfer
                      </legend>
                      <textarea rows="2" class="form-control" id="message" name="message"></textarea>
                    </fieldset>
                  </div>
                </div>
              </div>
              <div class="remember">
                <label class="accept-plocy-txt"><input type="checkbox" name="acceptPolicy" id="acceptPolicy" />By submitting this form I accept your <a href="<?= base_url('privacy-policy'); ?>" target="_blank">Privacy Policy</a></label>
              </div>
              <div class="g-recaptcha mb-3" data-sitekey="<?php echo get_settings('gr_site_key'); ?>" id="contactUsRecaptcha"></div>
              <input type="hidden" class="hiddencontactUsRecaptcha" name="contact_hiddenRecaptcha" id="contact_hiddenRecaptcha">
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
          <form id="newsletterSubscribe" method="POST" >
            <div class="form-group subscribe-field-wrap">
                <input type="email" class="form-control" id="subscribeemail" placeholder="Enter your email address" name="subscribeemail">
                <button type="submit" class="g-recaptcha btn btn-blue subscribe-btn" data-action="submit"
                    data-sitekey="<?= RE_CAPTCHA_V3_SITE_KEY ?>" data-callback="onSubmit_sub">
                    Subscribe
                </button>           
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
          <?php 
            $cms_page = get_cms_landing_page();
          ?>
          <?php 
            if(in_array('about-us', $cms_page)){
          ?>
            <li>
              <a href="<?= BASE_URL ?>about-us">About Us</a>
            </li>
          <?php 
            }
          ?>
          <?php 
            if(in_array('fleet', $cms_page)){
          ?>
            <li>
              <a href="<?= BASE_URL ?>fleet">Fleet</a>
            </li>
          <?php 
            }
          ?>
            <li>
              <a data-toggle="modal" data-target="#video_galley_popup" class="video-gallery-popup">Video Gallery</a>
            </li>
          <?php 
            if(in_array('travel-agent-landing-page', $cms_page)){
          ?>
            <li>
              <a href="<?php echo BASE_URL . 'travel-agent-landing-page'; ?>">Travel agents affiliate</a>
            </li>
          <?php 
            }
          ?>  
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
          <?php 
            if(in_array('cancellation-policy', $cms_page)){
          ?>
            <li>
              <a href="<?= BASE_URL ?>cancellation-policy">Cancellation Policy</a>
            </li>
          <?php 
            }
          ?>
          <?php 
            if(in_array('our-guarantee', $cms_page)){
          ?>
            <li>
              <a href="<?= BASE_URL ?>our-guarantee">Our Guarantee</a>
            </li>
          <?php 
            }
          ?>
          <?php 
            if(in_array('airport-meeting-instructions', $cms_page)){
          ?>
            <li>
              <a href="<?= BASE_URL ?>airport-meeting-instructions">Airport meeting instructions</a>
            </li>
          <?php 
            }
          ?>
          <?php 
            if(in_array('cruise-arrival-instructions', $cms_page)){
          ?>
            <li>
              <a href="<?= BASE_URL ?>cruise-arrival-instructions">Cruise arrival instructions</a>
            </li>
          <?php 
            }
          ?>
          <?php 
            if(in_array('privacy-policy', $cms_page)){
          ?>
            <li>
              <a href="<?= BASE_URL ?>privacy-policy">Privacy Policy</a>
            </li>
          <?php 
            }
          ?>
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
            <li>
              <a href="<?= BASE_URL ?>review">Write a review</a>
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
              <div class="col-md-6">
                <div class="form-group">
                  <fieldset class="qphoneNumber-fieldset">
                    <legend>Phone Number</legend>
                    <input type="text" class="form-control" id="qphoneNumber" name="qphoneNumber" autocomplete="off">
                  </fieldset>
                </div>
              </div>
              <div class="col-md-6">
                    <div class="form-group">
                        <fieldset class="qnoofpassenger-fieldset">
                          <legend>Number of passengers</legend>
                          <input type="text" class="form-control" oninput="validateInput(this)" id="qnumber_of_passengers" name="qnumber_of_passengers">
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
                        <fieldset class="qinterestService-fieldset">
                          <legend>Service(s) you're interested in</legend>
                          <input type="text" class="form-control" id="qinterest_service" name="qinterest_service">
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <fieldset class="qspellmonth-fieldset">
                          <legend>Date(s) - please spell out the month</legend>
                          <input type="text" class="form-control" id="qdate" name="qdate">
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <fieldset class="qnameShip-fieldset">
                          <legend>If going on a cruise, name of ship</legend>
                          <input type="text" class="form-control" id="qname_of_ship" name="qname_of_ship">
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
              <div class="col-md-12">
                <div class="form-group">
                  <div class="privacy-checkbox-wrapper mt-2">
                      <label class="quick-quote-accept-policy-txt mb-0"><input type="checkbox" name="quickQuoteAcceptPolicy" required />By submitting this form I accept your <a href="<?= base_url('privacy-policy'); ?>" target="_blank">Privacy Policy</a></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="g-recaptcha mb-3" data-sitekey="<?php echo get_settings('gr_site_key'); ?>" id="quickQuoteFrmRecaptcha"></div>
            <input type="hidden" class="hiddenquickQuoteFrmRecaptcha" name="quote_hiddenRecaptcha" id="quote_hiddenRecaptcha">
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
              <div class="col-md-12">
                <div class="g-recaptcha mb-3" data-sitekey="<?php echo get_settings('gr_site_key'); ?>" id="getacallFrmRecaptcha"></div>
                <input type="hidden" class="hiddengetacallFrmRecaptcha" name="call_hiddenRecaptcha" id="call_hiddenRecaptcha">
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
                      <h5 class="code-id"><span>Final Price : </span><strong class="total_price_single_tour"></strong></h5>
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
            <input type="hidden" name="extra_price" id="extra_price" value="">
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
<!-- Check current visiting page is umbria villa page -->
<?php if(!is_umbriavilla_page() && !isset($_COOKIE['viewd-vill-banner-popup'])) {?>
  <?php if(get_settings('hide_villa_advertisement') != 1 && get_settings('hide_villa_advertisement') != ''){ ?>
  <script>
    var villaURL = '<?php echo get_settings('villa_url'); ?>';
  </script>
  <!-- Villa popup banner model -->
  <div id="villa_popup_banner" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <button type="button" class="close top-corner-modal-close" data-dismiss="modal"><i class="fal fa-times"></i></button>      
        <div class="modal-body">
          <img src="<?php echo base_url('uploads/villa_popup_banner/' . get_settings('villa_popup_banner')) ?>">
          <div class="visit-villa-btn">
            <a href="javascript:void(0);" class="btn btn-blue">Visit Now</a>
          </div>          
          <div class="cstm-overlay-section"></div>
        </div>
      </div>
      <!-- <div class="modal-footer">
          <p><b>Click on playlist for other videos</b></p>     
        </div> -->
    </div>
  </div>
  <?php } ?>  
<?php } ?>
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
<?php
}
if ($this->uri->segment(1) == "tours") { ?>
  <script src="<?php echo base_url('assets/js/web/bootstrap-datepicker.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/web/ajax-tour-details.js?v=' . time()); ?>"></script>
<?php
}
if ($this->uri->segment(1) == "transfer") { ?>
  <script src="<?php echo base_url('assets/js/web/bootstrap-datepicker.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/web/ajax-transfer-tour-details.js?ver=' . time()); ?>"></script>
<?php
}
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

    function validateInput(input) {
        // Remove any non-numeric and non-letter characters
        input.value = input.value.replace(/[^A-Za-z0-9 ]/g, '');
    }  
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
<script src="https://www.google.com/recaptcha/api.js?render=<?= get_settings('gr_site_key') ?>" defer async></script>
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


    function onSubmit_sub(token) {
        $('#newsletterSubscribe').submit();
    }

</script>

</body>
</html>