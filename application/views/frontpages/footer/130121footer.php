<?php
$get_settings = get_admin_settings();
$youtube_url = '';
foreach($get_settings as $single_settings){
  if($single_settings['name'] == 'youtube_url'){
      $youtube_url = $single_settings['value'];
  }
}
?>
  <section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="rimage-wrap">
              <div id="TA_selfserveprop474" class="TA_selfserveprop">
                <ul id="W7FYqAsJCLkN" class="TA_links oPiBzrYL">
                  <li id="e7J3dL0J5aiU" class="Q6SuU3"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g187791-d1638989-Reviews-DriverinRome_Transportation_Tours-Rome_Lazio.html">
                    <img src="https://www.tripadvisor.com/img/cdsi/img2/branding/v2/Tripadvisor_lockup_horizontal_secondary_registered-11900-2.svg" alt="TripAdvisor"/></a>
                  </li>
                </ul>
              </div>
              <script async src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=474&amp;locationId=1638989&amp;lang=en_US&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=true&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>
              <!-- #home-trip-advisor -->
          </div>
        </div>
        <div class="col-md-8">
          <div class="trustpilot">
              <!-- TrustBox widget - Carousel -->
              <div class="trustpilot-widget" data-locale="en-US" data-template-id="53aa8912dec7e10d38f59f36" data-businessunit-id="5720a2100000ff00058c1686" data-style-height="130px" data-style-width="100%" data-theme="dark" data-stars="1,2,3,4,5" data-review-languages="en">
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
                      <input type="text" class="form-control" id="fullname" name="fullname">
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <fieldset class="email-fieldset">
                      <legend>Email</legend>
                      <input type="email" class="form-control" id="email" name="email">
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <fieldset class="confEmail-fieldset">
                      <legend>Confirm Email</legend>
                      <input type="email" class="form-control" id="confEmail" name="confEmail">
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <fieldset class="phoneNumber-fieldset">
                      <legend>Phone Number</legend>
                      <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <fieldset class="noOfPassenger-fieldset">
                      <legend>Number of Pessangers</legend>
                      <input type="number" class="form-control" id="noOfPassenger" name="noOfPassenger">
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
                <input type="checkbox" name="acceptPolicy" id="acceptPolicy"/>
                <span class="accept-plocy-txt">By submitting this form I accept your Privacy Policy</span>
              </div>
              <button type="submit" class="btn btn-yellow">submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="subscribe-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="sub-content">
            <img src="<?=ASSET?>images/subscribe-icon.svg">
            <span>Subscribe to our newsletter to get new promos!</span>
          </div>
        </div>
        <div class="col-md-6">
          <form>
            <div class="form-group">
              <input type="text" class="form-control" id="fname" placeholder="Enter your email address" name="fname">
              <button type="submit" class="btn btn-blue">Subscribe</button>
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
            <a href="<?=BASE_URL?>" alt="footer logo">
              <img src="<?=ASSET?>images/blue-logo.svg">
            </a>
          </div>
        </div>
        <div class="col-md-3">
          <h3>Quick Links</h3>
          <ul>
            <li>
              <a href="<?=BASE_URL?>about-us">About Us</a>
            </li>
            <li>
              <a href="<?=BASE_URL?>fleet">Fleet</a>
            </li>
            <li>
              <a href="<?=$youtube_url?>" target="_blank">Video Gallery</a>
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <h3>Policies</h3>
          <ul>
            <li>
              <a href="<?=BASE_URL?>cancellation-policy">Cancellation Policy</a>
            </li>
            <li>
              <a href="<?=BASE_URL?>our-guarantee">Our Guarantee</a>
            </li>
            <li>
              <a href="<?=BASE_URL?>airport-meeting-instructions">Airport meeting instructions</a>
            </li>
            <li>
              <a href="<?=BASE_URL?>cruise-arrival-instructions">Cruise arrival instructions</a>
            </li>
            <li>
              <a href="<?=BASE_URL?>privacy-policy">Privacy Policy</a>
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
      <p class="text-center">In Associazione con Agenzia di Viaggio e Turismo Driver & Tours di Driverinrome Societa' Cooperativa a R.L. Licenza rilasciata dalla Provincia di Roma Numero 32888/15. Partita Iva 13627291001 Assicurazione Allianz Polizza Numero 198630 E-mail: genziadiviaggio@driverinrome.com - www.driverandtours.it Tel. (+39) 066244373 - US number (315) 544-0496 - Whatsapp: (0039)392 4468283</p>
      <hr>
      <p class="copyright">DRIVERINROME - © <?=date("Y");?> All Rights Reserved</p>
    </div>
  </footer>
 <?php
  if ($this->session->flashdata('error')) { ?>
              <input type="hidden" name="error" id="error" value="<?php echo $this->session->flashdata('error'); ?>">
          <?php   }
  if ($this->session->flashdata('success')) { ?>
              <input type="hidden" name="success" id="success" value="<?php echo $this->session->flashdata('success'); ?>">
          <?php  }   ?>
  <!-- // thank you modal -->
  <div id="thankyoumodal" class="modal fade" role="dialog" tabindex="-1" style="display: none !important;" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <div class="modal-content-wrap">
            <img src="<?=EMAIL_WELCOME_PNG?>" alt="Smile Expression" class="smile-popup">
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
            <img src="<?=EMAIL_OOPS_PNG?>" alt="Oops Expression" class="oops-popup">
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
  <div id="quickquote" class="modal fade" role="dialog">
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
                        <input type="text" class="form-control" id="qfullname" name="qfullname">
                      </fieldset>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <fieldset class="qemail-fieldset">
                        <legend>Email</legend>
                        <input type="email" class="form-control" id="qemail" name="qemail">
                      </fieldset>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <fieldset class="qconfEmail-fieldset">
                        <legend>Confirm Email</legend>
                        <input type="email" class="form-control" id="qconfEmail" name="qconfEmail">
                      </fieldset>
                  </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <fieldset class="qphoneNumber-fieldset">
                        <legend>Phone Number</legend>
                        <input type="text" class="form-control" id="qphoneNumber" name="qphoneNumber">
                      </fieldset>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                      <fieldset class="howDidFind-fieldset">
                        <legend>How Did You Find Us</legend>
                          <textarea rows="2" class="form-control" id="howDidFind" name="howDidFind"></textarea>                      
                      </fieldset>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                      <fieldset class="notes-fieldset">
                        <legend>Notes.</legend>
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
  <!-- // tour check availability modal -->
  <div id="tour_select_date_modal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" style="max-width: 900px!important;">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title addModalTitle"><?php _el('availability'); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="cursor:pointer">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" id="availabilityForm">
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="error_msg" >
                
                </div>
                <!-- <div class="text-right">
                    <h6><span class="tour_detail_m mr-3"></span><span class="tour_code_text">Code: </span><span class="tour_code_val"></span></h6>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                      <hr>
                    </div>
                </div> -->
                <div class="row align-items-center h-100">
                  <div class="col-md-5 ">
                      <span class="float-left "><i class="fas fa-user"></i>  <span class="user_detail"></span></span>
                      <span class="float-right "><i class="fas fa-pen-square edit_tour_person_m" ></i></span>
                      
                  </div>
                  <div class="col-md-7">
                    <!-- <span class="float-left"><i class="far fa-calendar-alt"></i> <span class="selected_tour_date"></span></span>
                    <span class="float-right "><i class="fas fa-pen-square edit_tour_date_m" ></i></span> -->
                    <span class="float-right "><h6><span class="tour_detail_m mr-3"></span><span class="tour_code_text">Code: </span><span class="tour_code_val"></span></h6></span>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                      <hr>
                    </div>
                </div>
                <div class="row align-items-center h-100">
                  <div class="col-md-12">
                        <div class="tour_date_price_slider owl-carousel owl-theme">
                          <?php
                          $current_date=date('d M Y');
                          $endDate=date("d M Y",strtotime('+2 years'));
                          while(strtotime($current_date) <= strtotime($endDate)) { ?>
                            <div class="item text-center" onclick="get_tour_price('<?php echo date("Y-m-d",strtotime($current_date)); ?>')">
                              <div class="single_tour_date"><?php echo date('d M Y',strtotime($current_date)); ?></div>
                              <div class="single_tour_price" data-tour-date="<?php echo date('Y-m-d',strtotime($current_date)); ?>"></div>
                            </div>
                            
                        <?php
                            $current_date=date('d M Y', strtotime('+1 days', strtotime($current_date)));
                          }?>
                        </div>
                        <input type="hidden" name="selected_tour_price" id="selected_tour_price" value="">
                        <input type="hidden" name="base_price_value" id="base_price_value" value="">
                  </div>
                </div>
                <div class="row price_div_m">
                    <div class="col-sm-12">
                      <hr>
                    </div>
                </div>
                <div class="row align-items-center h-100 price_div_m" >
                  <div class="col-md-6">
                    <span class="toggle_price" data-angle="right"><i class="fas fa-angle-right"></i></span>
                    Date: <span class="selected_tour_date"></span>
                  </div>
                  <div class="col-md-6">
                    Total Price: <span id="total_price"></span>
                    <!-- <button type="button" name="book_now" class="btn btn-yellow">Book Now</button> -->
                  </div>
                </div>
                <div class="row align-items-center h-100 d-none price_div_m" id="price_details">
                  <div class="col-md-6">
                    Duration: <span id="tour_duration_m"></span><br>
                    
                  </div>
                  <!-- <div class="col-md-6">
                    <span class="adults_person"></span><br>
                    <span class="kids_total"></span><br>
                    <span class="senior_person_ttl"></span><br>
                    <span class="infants_ttl"></span>
                  </div> -->
                </div>
                
            </div>
            <div class="modal-footer text-center">
                <!-- <input type="hidden" name="adult_price" id="adult_price" value="">
                <input type="hidden" name="senior_price" id="senior_price" value="">
                <input type="hidden" name="kids_price" id="kids_price" value="">
                <input type="hidden" name="infant_price" id="infant_price" value=""> -->
                <input type="hidden" name="selected_date" id="selected_date" value="">
                <input type="hidden" name="final_price" id="final_price" value="">
                <input type="hidden" name="adult_ttl_person" id="adult_ttl_person" value="">
                <input type="hidden" name="senior_ttl_person" id="senior_ttl_person" value="">
                <input type="hidden" name="kids_ttl_person" id="kids_ttl_person" value="">
                <input type="hidden" name="infants_ttl_person" id="infants_ttl_person" value="">
                <input type="hidden" name="total_person_m" id="total_person_m" value="">
                <input type="hidden" name="tour_id_m" id="tour_id_m" value="">
                <input type="hidden" name="tour_availability_m" id="tour_availability_m" value="1">
                
                <button name="go_back_tour_details" type="button" id="go_back_tour_details" class="btn btn-default" data-dismiss="modal"><?php _el('go_back'); ?></button>
                <button name="send_me_quote" type="submit" id="send_me_quote" class="btn btn-primary"><?php _el('send_me_quote'); ?></button>
                <button type="submit" name="continue_tour_add" id="continue_tour_add" class="btn btn-yellow" ><?php _el('continue'); ?></button>
            </div>
          </form>
          <!-- <div class="text-center d-none" id="loader_cont" >
                    <img src="<?php //echo ASSET.'images/loader.gif'; ?>">
          </div> -->
        </div>
      </div>
  </div>


<?php
if($this->uri->segment(1)=="tours"){?>
<script type="text/javascript" src="<?php echo base_url('assets/js/web/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/web/ajax-tour-details.js');?>"></script>
<?php } 
if($this->uri->segment(1)=="get_quote"){ ?>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/web/ajax-request-quote.js');?>"></script>
<?php } 
if($this->uri->segment(1)=="availability_ticket"){ ?>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/web/ajax-availability-ticket.js');?>"></script>
<?php } ?>
<script type="text/javascript">
  var owl = $('#screenshot_slider').owlCarousel({
    loop: true,
    item: 3,
    responsiveClass: true,
    nav: true,
    margin: 0,   
    dots:false, 
    autoplayTimeout: 4000,
    smartSpeed: 400,
    center: true,
    navText: ['<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>'],
     responsive:{
          1024:{
              items:3
          },
          600:{
              items:2,
              nav:true,
              center:false
          },
          0:{
              items:1,
              nav:true,
              center:false
          }
      }
});
/****************************/
jQuery(document.documentElement).keydown(function (event) {    
    // var owl = jQuery("#carousel");
    // handle cursor keys
    if (event.keyCode == 37) {
       // go left
      owl.trigger('prev.owl.carousel', [400]);
      //owl.trigger('owl.prev');
    } else if (event.keyCode == 39) {
       // go right
        owl.trigger('next.owl.carousel', [400]);
       //owl.trigger('owl.next');
    }
});
</script>

<script>
// START validation for Contact us form
jQuery("#contactUs").validate({
  errorClass: 'validation-error',
  rules: {
      fullname: {
          required: true,
      },
      email: {
          email: true,
          required: true,
      },
      confEmail : {
          email: true,
          equalTo : "#email"
      },
      phoneNumber: {
          required: true,
          number: true,
          minlength: 10,
      },
      noOfPassenger: {
          required: true,
          number: true,
      },
      message: {
          required: true,
      },
      acceptPolicy: {
          required: true,
      },
  }, 
  messages: {
        fullname: {
            required: 'Please enter full name',
        },
        email: {
            required: 'Please enter email address',
            email: 'Please enter valid email address'
        },
        confEmail: {
            required: 'Please enter email address',
            email: 'Please enter valid email address',
            equalTo: 'Confirm email is not match with the actual email'
        },
        phone_number: {
            required: 'Please enter phone number',
            minlength: 'Please enter valid phone number',
        },
        noOfPassenger: {
            required: 'Please enter number of passengers',
        },
        message: {
            required: 'Please enter message',
        },
        acceptPolicy: {
            required: 'Please accept our pricavy policy',
        }
  }, 
  errorPlacement: function(error, element) {
    if (element.attr("name") == "fullname")
            error.insertAfter(".fullname-fieldset");  
        else if (element.attr("name") == "email")
            error.insertAfter(".email-fieldset");  
        else if (element.attr("name") == "confEmail")
            error.insertAfter(".confEmail-fieldset");  
        else if (element.attr("name") == "phoneNumber")
            error.insertAfter(".phoneNumber-fieldset");  
        else if (element.attr("name") == "noOfPassenger")
            error.insertAfter(".noOfPassenger-fieldset");  
        else if (element.attr("name") == "message")
            error.insertAfter(".message-fieldset");  
        else if (element.attr("name") == "acceptPolicy")
            error.insertAfter(".accept-plocy-txt");  
        else
            error.insertAfter(element); 
  },
  submitHandler: function(form) {
        ajxLoader('show', 'body');
        var form_data = {
            'fullname': $('#fullname').val(),
            'email': $('#email').val(),
            'phoneNumber': $('#phoneNumber').val(),
            'noOfPassenger': $('#noOfPassenger').val(),
            'message': $('#message').val(),
            'for_form_data': 'contact_us',
        };
        // ajax call
        $.ajax({
            url: BASE_URL + "welcome/send_contact_us_details",
            type: 'POST',
            data: form_data,
            success: function(data) {                             
                $('#contactUs').find("input[type=text], input[type=email], input[type=number], textarea").val("");
                $('#acceptPolicy').prop('checked', false); // Unchecks it
                if (data == 1) {
                    $('#thankyoumodal').modal('show');
                 } else {
                    $('#errormodal').modal('show');                  
                 }
                ajxLoader('hide', 'body');
            },
        });
    }
  
});
// END validation for Contact us form
// START validation for Quick quote form
jQuery("#quickQuoteFrm").validate({
  errorClass: 'validation-error',
  rules: {
      qfullname: {
          required: true,
      },
      qemail: {
          email: true,
          required: true,
      },
      qconfEmail : {
          email: true,
          equalTo : "#qemail"
      },
      qphoneNumber: {
          required: true,
          number: true,
          minlength: 10,
      },
      howDidFind: {
          required: true,
      },
      notes: {
          required: true,
      },
  }, 
  messages: {
        qfullname: {
            required: 'Please enter full name',
        },
        qemail: {
            required: 'Please enter email address',
            email: 'Please enter valid email address'
        },
        qconfEmail: {
            required: 'Please enter email address',
            email: 'Please enter valid email address',
            equalTo: 'Confirm email is not match with the actual email'
        },
        qphoneNumber: {
            required: 'Please enter phone number',
            minlength: 'Please enter valid phone number',
        },
        howDidFind: {
            required: 'Please enter message',
        },
        notes: {
            required: 'Please enter notes',
        }
  }, 
  errorPlacement: function(error, element) {
      if (element.attr("name") == "qfullname")
          error.insertAfter(".qfullname-fieldset");  
      else if (element.attr("name") == "qemail")
          error.insertAfter(".qemail-fieldset");  
      else if (element.attr("name") == "qconfEmail")
          error.insertAfter(".qconfEmail-fieldset");  
      else if (element.attr("name") == "qphoneNumber")
          error.insertAfter(".qphoneNumber-fieldset");  
      else if (element.attr("name") == "howDidFind")
          error.insertAfter(".howDidFind-fieldset");  
      else if (element.attr("name") == "notes")
          error.insertAfter(".notes-fieldset");  
      else
          error.insertAfter(element);
  }, 
  submitHandler: function(form) {
        ajxLoader('show', 'body');
        var qfullname = $('#qfullname').val();
        var qemail = $('#qemail').val();
        var qphoneNumber = $('#qphoneNumber').val();
        var howDidFind = $('#howDidFind').val();
        var notes = $('#notes').val();
        var form_data = {
            'qfullname': qfullname,
            'qemail': qemail,
            'qphoneNumber': qphoneNumber,
            'howDidFind': howDidFind,
            'notes': notes,
        };
        // ajax call
        $.ajax({
            url: BASE_URL + "welcome/send_quick_quote_details",
            type: 'POST',
            data: form_data,
            success: function(data) {                
                $('#quickQuoteFrm').find("input[type=text], input[type=email], input[type=number], textarea").val(""); 
                $('#quickquote').modal('hide');
                if (data == 1) {
                    $('#thankyoumodal').modal('show');                       
                } else {
                    $('#errormodal').modal('show');
                }
                ajxLoader('hide', 'body');                
            },
        });
    }
});
// END validation for Quick quote form
$("#quickquote").on("hidden.bs.modal", function () {
    $('#quickquote label.validation-error').hide();
});
jQuery.validator.setDefaults({
  focusCleanup: true,
  errorClass: "validation-error-label",
  errorElement: "span",
  highlight: function ( element, errorClass, validClass ) {
    $( element ).next( "span" ).addClass( "csc-helper-text" );
  }
});
function preventFormSubmit(e){
    e.preventDefault();
    return false;
}
function ajxLoader(showstatus, elem) {
    jQuery.LoadingOverlaySetup({
        background: "rgba(0, 0, 0, 0.5)",
        imageColor: "#FFF",
        imageAutoResize: false,
        size: 50,
        maxSize: 50,
        minSize: 20
    });
    if (elem === undefined)
        jQuery.LoadingOverlay(showstatus);
    else
        jQuery(elem).LoadingOverlay(showstatus);
}
// <!-- Smartsupp Live Chat script -->
      var _smartsupp = _smartsupp || {};
      _smartsupp.key = '5928f4c195426b84a39ac761cdd43d9ac53d9cf8';
      window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
      })(document);
    
jQuery(".contact-link").click(function(e) {
    e.preventDefault();
    jQuery('html, body').animate({
        scrollTop: jQuery(".contact-section").offset().top
    }, 1000);
});
jQuery(".contact-top-link").click(function(e) {
    e.preventDefault();
    jQuery('html, body').animate({
        scrollTop: jQuery(".contact-section").offset().top
    }, 2000);
});
setTimeout(function(){
  jQuery('.css-mak9h4').css("margin-top", "100px !important");
}, 4000);
var ajxurl = BASE_URL + 'welcome/get_cart_count';
var ajxasync = true;
function get_notification(){	
	$.ajax({
		url: ajxurl,
		dataType: 'JSON',
		method: 'POST',
		async: ajxasync,
		data: {
			'ajax': true
		},
		success: function(data){
			if(data.status){
        jQuery('.cart-notification .count').text(data.count);
			}
			ajxasync = false;
			// setTimeout(function(){
			// 	get_notification();
			// }, 5000);
		}
	});
}
setTimeout(function(){
  get_notification();
}, 5000);
get_notification();
// For GDPR cookie
var options = {
    title: '&#x1F36A; Accept Cookies & Privacy Policy?',
    message: 'We use cookies to improve your site experinece by contunieing to use this site, you agree to our cookies policy.',
    delay: 600,
    expires: 1,
    link: 'privacy',
    onAccept: function(){
      var myPreferences = $.fn.ihavecookies.cookie();
      console.log('Yay! The following preferences were saved...');
      console.log(myPreferences);
    },
    uncheckBoxes: false,
    acceptBtnLabel: 'Accept Cookies',
    moreInfoLabel: 'View Policy',
    cookieTypesTitle: 'Select which cookies you want to accept',
    fixedCookieTypeLabel: 'Essential',
    fixedCookieTypeDesc: 'These are essential for the website to work correctly.'
  }
  $(document).ready(function() {
      $('body').ihavecookies(options);
      if ($.fn.ihavecookies.preference('marketing') === true) {
        console.log('This should run because marketing is accepted.');
      }
      $('#ihavecookiesBtn').on('click', function(){
        $('body').ihavecookies(options, 'reinit');
      });

      
  });
  // GDPR code ends  
</script>

</body>
</html>