 <section class="pt-80 pb-80">

     <div class="container">

         <div class="row">

             <div class="offset-md-1 col-md-10">

                 <div class="custom-form">

                     <div class="alert alert-danger d-none" id="cb_error_msg">



                     </div>

                     <form method="POST" id="customBookingForm" name="customBookingForm">

                         <!-- custom tour booking form -->

                         <div class="row">

                             <div class="col-md-12">

                                 <h2 class="title">Custom Tour Booking</h2>

                             </div>

                             <div class="col-md-6">

                                 <div class="form-group field-group">

                                     <fieldset class="checkoutfirstname-fieldset">

                                         <legend>First Name</legend>

                                         <input type="text" class="form-control" id="cb_firstname" name="cb_firstname" autocomplete="off">

                                     </fieldset>

                                 </div>

                             </div>

                             <div class="col-md-6">

                                 <div class="form-group field-group">

                                     <fieldset class="checkoutlastname-fieldset">

                                         <legend>Last Name</legend>

                                         <input type="text" class="form-control" class="form-control" id="cb_lastname" name="cb_lastname" autocomplete="off">

                                     </fieldset>

                                 </div>

                             </div>

                             <div class="col-md-6">

                                 <div class="form-group field-group">

                                     <fieldset class="checkoutemail-fieldset">

                                         <legend>Email</legend>

                                         <input type="text" class="form-control" id="cb_email" name="cb_email" autocomplete="off">

                                     </fieldset>

                                 </div>

                             </div>

                             <div class="col-md-6">

                                 <div class="form-group field-group">

                                     <fieldset class="checkoutconfirmemail-fieldset">

                                         <legend>Confirm Email</legend>

                                         <input type="text" class="form-control" id="cb_confirmemail" name="cb_confirmemail" autocomplete="off">

                                     </fieldset>

                                 </div>

                             </div>

                             <div class="col-md-6">

                                 <div class="form-group field-group">

                                     <fieldset class="checkoutneeds-fieldset">

                                         <legend>Service Details </legend>

                                         <textarea class="form-control" placeholder="Service Details " rows="5" name="cb_needs"></textarea>

                                     </fieldset>

                                 </div>

                             </div>

                             <div class="col-md-6">

                                 <div class="form-group field-group">

                                     <fieldset class="checkoutfoundus-fieldset">

                                         <legend>Found Us</legend>

                                         <select class="form-control checkout-found-us" name="cb_foundus" id="cb_foundus">

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

                             <div class="col-md-6">

                                 <div class="form-group field-group">

                                     <div class="input-group">

                                         <fieldset class="checkouttravellingphone-fieldset">

                                             <legend>Phone Number While Travelling</legend>

                                             <input type="text" class="form-control" id="cb_travellingphone" name="cb_travellingphone" autocomplete="off">

                                         </fieldset>

                                         <button class="popover-button" type="button" data-toggle="popover" data-content="We ask for a phone number of someone in your party in case we need to reach you urgently once you’re on your trip. We’ll only call you in the event of real need." data-placement="bottom" data-original-title="" title=""><i class="fal fa-info-circle"></i></button>

                                     </div>

                                 </div>

                             </div>

                         </div>

                         <!-- end custom tour booking form -->

                         <!-- payment form -->

                         <div class="row mt-10">

                             <div class="col-md-12">

                                 <h2 class="title">Payment Details</h2>

                             </div>

                             <div class="col-md-12">

                                 <div class="form-group">

                                     <div class="custom-checkbox">

                                         Your credit card is needed purely to secure your booking. WE WILL NOT CHARGE OR PUT A HOLD ON YOUR CARD NOW. Payments are made at the end of the tour day directly to your driver. The given rate is the cash rate. If needed the driver may stop at ATM machines during the day. We do accept credit card payments including Visa, American Express, and Mastercard, but please notice that those payments will incur a 10 % fee. You may cancel this booking up to 72 hours prior tour date free of charge. Only pre-purchased skip the line tickets ( if requested) are not refundable under any circumstance and will be charged to your card.

                                         <input type="checkbox" name="credit-card-needed" id="credit_card_needed">

                                         <span class="checkmark your-card"></span>

                                     </div>

                                 </div>

                                 <div class="row">

                                     <div class="col-md-6">

                                         <div class="form-group field-group">

                                             <fieldset class="fieldset-nameoncard">

                                                 <legend>NAME ON CARD<span class="required-star">*</span></legend>

                                                 <input type="text" class="form-control" id="nameoncard" name="nameoncard" autocomplete="off">

                                             </fieldset>

                                         </div>

                                     </div>

                                     <div class="col-md-6">

                                         <div class="form-group field-group">

                                             <fieldset class="fieldset-checkoutcardnumber">

                                                 <legend>Card Number<span class="required-star">*</span></legend>

                                                 <div class="card-element-wrap">

                                                     <input type="text" class="form-control" id="cb_cardnumber" name="cb_cardnumber" placeholder="XXXX XXXX XXXX XXXX" autocomplete="off" maxlength="19">

                                                 </div>

                                             </fieldset>

                                         </div>

                                     </div>

                                     <div class="col-md-4">

                                         <div class="form-group field-group select2-popup">

                                             <fieldset class="fieldset-checkoutexpirymonth">

                                                 <legend>Expiry Month<span class="required-star">*</span></legend>

                                                 <select name="cb_expirymonth" id="cb_expirymonth" class="form-control">

                                                     <option value="">Select</option>

                                                     <?php

                                                        for ($i = 01; $i <= 12; $i++) {

                                                        ?>

                                                         <option vlaue="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>"><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></option>

                                                     <?php

                                                        }

                                                        ?>

                                                 </select>

                                             </fieldset>

                                         </div>

                                     </div>

                                     <div class="col-md-4">

                                         <div class="form-group field-group select2-popup">

                                             <fieldset class="fieldset-checkoutexpiryyear">

                                                 <legend>Expiry Year<span class="required-star">*</span></legend>

                                                 <select name="cb_expiryyear" id="cb_expiryyear" class="form-control">

                                                     <option value="">Select</option>

                                                     <?php

                                                        $date = date("Y");

                                                        $next_thirty_years = date('Y', strtotime($date . ' + 30 year'));

                                                        for ($i = $date; $i <= $next_thirty_years; $i++) {

                                                        ?>

                                                         <option vlaue="<?= $i ?>"><?= $i ?></option>

                                                     <?php

                                                        }

                                                        ?>

                                                 </select>

                                             </fieldset>

                                         </div>

                                     </div>

                                     <div class="col-md-4">

                                         <div class="form-group field-group select2-popup">

                                             <div class="input-group group-checkoutcardcvv">

                                                 <fieldset class="fieldset-checkoutcardcvv">

                                                     <legend>CVV<span class="required-star">*</span></legend>

                                                     <input type="password" class="form-control" id="cb_cardcvv" name="cb_cardcvv" placeholder="">

                                                 </fieldset>

                                                 <button class="popover-button" type="button" data-toggle="popover" data-content="On every transaction you make using your credit or debit card, a unique 3-4 digit CVV code is required to complete the transaction." data-placement="bottom" data-original-title="" title=""><i class="fal fa-info-circle"></i></button>

                                             </div>

                                         </div>

                                     </div>

                                     <div class="col-md-12">

                                         <div class="form-group field-group">

                                             <fieldset class="fieldset-checkoutaddress">

                                                 <legend>Please Add Your Address<span class="required-star">*</span></legend>

                                                 <textarea class="form-control" rows="2" name="cb_address" id="cb_address"></textarea>

                                             </fieldset>

                                         </div>

                                     </div>

                                     <div class="col-md-4">

                                         <div class="form-group field-group select2-popup">

                                             <fieldset class="fieldset-checkoutcountry">

                                                 <legend>Country<span class="required-star">*</span></legend>

                                                 <input type="text" class="form-control" id="cb_country" name="cb_country" autocomplete="off">

                                             </fieldset>

                                         </div>

                                     </div>

                                     <div class="col-md-4">

                                         <div class="form-group field-group select2-popup">

                                             <fieldset class="fieldset-checkoutcity">

                                                 <legend>City<span class="required-star">*</span></legend>

                                                 <input type="text" class="form-control" id="cb_city" name="cb_city" autocomplete="off">

                                             </fieldset>

                                         </div>

                                     </div>

                                     <div class="col-md-4">

                                         <div class="form-group field-group">

                                             <fieldset class="fieldset-checkoutzipcode">

                                                 <legend>Zip Code<span class="required-star">*</span></legend>

                                                 <input type="text" class="form-control" id="cb_zipcode" name="cb_zipcode" autocomplete="off">

                                             </fieldset>

                                         </div>

                                     </div>

                                 </div>

                                 <ul class="license-checklist">

                                     <li>

                                         <div class="custom-checkbox">

                                             I have read and agree to the

                                             <input type="checkbox" name="cancellation_policy" id="cancellation_policy">

                                             <span class="checkmark"></span>

                                         </div>

                                         <a href="<?= base_url('cancellation-policy'); ?>" target="_blank" class="cancellation-policy">Cancellation Policy.</a>

                                     </li>

                                     <div id="cancel_policy_err" class="mt-2 mb-2"></div>

                                     <li>

                                         <div class="custom-checkbox">

                                             By submitting this form I accept your 

                                             <input type="checkbox" name="privacy_policy" id="privacy_policy">

                                             <span class="checkmark"></span>

                                         </div>

                                         <a href="<?= base_url('privacy-policy'); ?>" target="_blank" class="cancellation-policy">Privacy Policy.</a>

                                     </li>

                                     <div id="privacy_policy_err" class="mt-2 mb-2"></div>

                                     <!-- <li>

                            <div class="custom-checkbox">

                                Please keep me updated with driverinrome's offers &amp; tours. 

                                <input type="checkbox" name="kepp_updated" id="kepp_updated">

                                <span class="checkmark"></span>

                            </div>

                        </li> -->

                                 </ul>

                             </div>

                         </div>

                         <div class="text-center">

                             <button type="submit" name="custom_booking_submit" class="btn btn btn-yellow">Submit</button>

                         </div>

                         <!-- end payment form -->

                     </form>

                 </div>

             </div>

         </div>

     </div>

 </section>

 <script src="https://js.stripe.com/v3/"></script>

 <script src="<?= ASSET ?>js/jquery.payform.min.js"></script>

 <script type="text/javascript">

     jQuery.validator.addMethod("only_Number", function(value, element) {

         return this.optional(element) || /^([0-9--/]+)$/.test(value);

     }, "Only Numbers and Hypfens '-' are allowed.");



     jQuery(document).ready(function() {



         jQuery.validator.addMethod("alphanumeric", function(value, element) {

             var regex = /^[A-Za-z0-9]+$/;

             return regex.test(value);

         }, "Please enter letters and numbers only");



         jQuery.validator.addMethod("cb_lettersonly", function(value, element) {

             return this.optional(element) || /^[a-zA-Z," "]+$/i.test(value);

         }, "Numbers and Special characters are not allowed");



         jQuery.validator.addMethod("cb_specical_chars", function(value, element) {

             console.log('test_number');

             return this.optional(element) || !/[~`!#$%\^&*+=\-\[\]\\'';,/{}|\\"":<>\?]/g.test(value);

         }, "Numbers and Special characters are not allowed");



         jQuery.validator.addMethod("cb_noSpace", function(value, element) {

             if ($.trim(value).length > 0) {

                 return true;

             } else {

                 return false;

             }

         }, "No space please and don't leave it empty");



         jQuery('[data-toggle="popover"]').popover();

         jQuery('#cb_expirymonth,#cb_expiryyear').select2({

             minimumResultsForSearch: -1

         });

         jQuery('#cart_product_type_payment').attr('value', jQuery('#cart_product_type').val());



         jQuery.validator.addMethod("validateCard",

             function(value, element) {

                 var return_value = true;

                 if ($.payform.validateCardNumber(value) == false) {

                     return_value = false;

                 } else {

                     return_value = true;

                 }

                 return return_value;

             }, "Please enter a valid card number"

         );

         jQuery.validator.addMethod("validateCVV",

             function(value, element) {

                 var return_value = true;

                 if ($.payform.validateCardCVC(value) == false) {

                     return_value = false;

                 } else {

                     return_value = true;

                 }

                 return return_value;

             }, "Please enter a valid CVV number"

         );

         jQuery.validator.addMethod("cstmcheckoutexpirymonth",

             function(value, element) {

                 var expirymonth = jQuery("#cb_expirymonth").val();

                 var expiryyear = jQuery("#cb_expiryyear").val();



                 var d_obj = new Date();

                 var current_month = d_obj.getMonth();

                 var current_year = d_obj.getFullYear();

                 if (current_year == expiryyear && current_month >= expirymonth) {

                     return false;

                 } else {

                     return true;

                 }

             }, "Please enter a valid expiry month"

         );

         var CVV = $("#cb_cardcvv");

         CVV.payform('formatCardCVC');



     });

     document.getElementById('cb_cardnumber').addEventListener('input', function(e) {

         var target = e.target,

             position = target.selectionEnd,

             length = target.value.length;



         target.value = target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();

         target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);

     });



     jQuery.validator.addMethod("noHTML_tags", function(value, element) {

         if (this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)) {

             return false;

         } else {

             return true;

         }

     }, "HTML tags are Not allowed.");



     jQuery("#customBookingForm").validate({

         errorClass: 'validation-error',

         rules: {

             cb_firstname: {

                 required: true,

                 cb_noSpace: true,

                 noHTML: true,

                 maxlength: 40

             },

             cb_lastname: {

                 required: true,

                 cb_noSpace: true,

                 noHTML: true,

                 maxlength: 40

             },

             cb_email: {

                 email: true,

                 required: true,

                 cstmEmail: true

             },

             cb_confirmemail: {

                 required: true,

                 email: true,

                 equalTo: "#cb_email"

             },

             cb_needs: {

                 required: true,

                 cb_noSpace: true,

                 noHTML_tags: true,

                 maxlength: 500

             },

             cb_foundus: {

                 required: true

             },

             cb_travellingphone: {

                 required: true,

                 cb_noSpace: true,

                 only_Number: true,

                 maxlength: 15

             },

             nameoncard: {

                 required: true,

                 cb_noSpace: true,

                 noHTML: true,

                 cb_lettersonly: true,

                 cb_specical_chars: true,

                 maxlength: 30

             },

             cb_cardnumber: {

                 required: true,

                 validateCard: true

             },

             cb_expirymonth: {

                 required: true,

                 cstmcheckoutexpirymonth: true

             },

             cb_expiryyear: {

                 required: true,

             },

             cb_cardcvv: {

                 required: true,

                 validateCVV: true

             },

             cb_address: {

                 required: true,

                 cb_noSpace: true,

                 noHTML_tags: true,

                 maxlength: 100

             },

             cb_country: {

                 required: true,

                 cb_noSpace: true,

                 noHTML: true,

                 cb_lettersonly: true,

                 cb_specical_chars: true,

                 maxlength: 20

             },

             cb_city: {

                 required: true,

                 cb_noSpace: true,

                 noHTML: true,

                 cb_lettersonly: true,

                 cb_specical_chars: true,

                 maxlength: 20

             },

             cb_zipcode: {

                 required: true,

                 cb_noSpace: true,

                 noHTML: true,

                 minlength: 5,

                 maxlength: 10,

                 alphanumeric: true

             },

             cancellation_policy: {

                 required: true

             },

             cancellation_policy: {

                 required: true

             },

             privacy_policy: {

                 required: true

             },

             'credit-card-needed': {

                 required: true

             }

         },

         messages: {

             cb_firstname: {

                 required: 'Please enter first name',

                 maxlength: 'Please enter no more than 40 characters'

             },

             cb_lastname: {

                 required: 'Please enter last name',

                 maxlength: 'Please enter no more than 40 characters'

             },

             cb_email: {

                 required: 'Please enter email',

                 email: 'Please enter valid email address'

             },

             cb_confirmemail: {

                 required: 'Please enter confirm email',

                 email: 'Please enter valid email address',

                 equalTo: 'Confirm email is not match with the actual email'

             },

             cb_needs: {

                 required: 'Please enter service details '

             },

             cb_foundus: {

                 required: 'Please select found us'

             },

             cb_travellingphone: {

                 required: 'Please enter phone number',

                 minlength: 'Please enter valid phone number',

                 maxlength: 'Please enter no more than 15 digits'

             },

             nameoncard: {

                 required: 'Please enter name on card',

                 maxlength: 'Please enter no more than 30 characters'

             },

             cb_cardnumber: {

                 required: 'Please enter card number'

             },

             cb_expirymonth: {

                 required: 'Please select card expiry month'

             },

             cb_expiryyear: {

                 required: 'Please select card expiry year'

             },

             cb_address: {

                 required: 'Please enter address',

                 maxlength: 'Please enter 40 characters only'

             },

             cb_cardcvv: {

                 required: 'Please enter CVV number'

             },

             cb_country: {

                 required: 'Please enter country name',

                 maxlength: 'Please enter 20 digits only'

             },

             cb_city: {

                 required: 'Please enter city name',

                 maxlength: 'Please enter 20 digits only'

             },

             // cardnumber: {

             //     required: 'Please enter card number',

             // },

             cb_zipcode: {

                 required: 'Please enter zip code',

                 minlength: 'Please enter minimum 5 digits',

                 maxlength: 'Please enter 10 digits only'

             },

             'credit-card-needed': {

                 required: 'Please accept this'

             },

             cancellation_policy: {

                 required: 'Please accept our cancellation policy'

             },

             privacy_policy: {

                 required: 'Please accept our privacy policy'

             }

         },

         highlight: function(element) {

             $(element).parent().addClass('has-error');

         },

         unhighlight: function(element) {

             $(element).parent().removeClass('has-error');

         },

         errorPlacement: function(error, element) {

             if (element.attr("name") == "cb_firstname")

                 error.insertAfter(".checkoutfirstname-fieldset");

             else if (element.attr("name") == "cb_lastname")

                 error.insertAfter(".checkoutlastname-fieldset");

             else if (element.attr("name") == "cb_email")

                 error.insertAfter(".checkoutemail-fieldset");

             else if (element.attr("name") == "cb_confirmemail")

                 error.insertAfter(".checkoutconfirmemail-fieldset");

             else if (element.attr("name") == "cb_needs")

                 error.insertAfter(".checkoutneeds-fieldset");

             else if (element.attr("name") == "cb_foundus")

                 error.insertAfter(".checkoutfoundus-fieldset");

             else if (element.attr("name") == "cb_travellingphone")

                 error.insertAfter(element.parent().parent('div'));

             else if (element.attr("name") == "cb_cardnumber")

                 error.insertAfter(".fieldset-checkoutcardnumber");

             else if (element.attr("name") == "nameoncard")

                 error.insertAfter(".fieldset-nameoncard");

             else if (element.attr("name") == "cb_expirymonth")

                 error.insertAfter(".fieldset-checkoutexpirymonth");

             else if (element.attr("name") == "cb_expiryyear")

                 error.insertAfter(".fieldset-checkoutexpiryyear");

             else if (element.attr("name") == "cb_cardcvv")

                 error.insertAfter(".group-checkoutcardcvv");

             else if (element.attr("name") == "cb_address")

                 error.insertAfter(".fieldset-checkoutaddress");

             else if (element.attr("name") == "cb_country")

                 error.insertAfter(".fieldset-checkoutcountry");

             else if (element.attr("name") == "cb_city")

                 error.insertAfter(".fieldset-checkoutcity");

             else if (element.attr("name") == "cb_zipcode")

                 error.insertAfter(".fieldset-checkoutzipcode");

             else if (element.attr("name") == "cancellation_policy")

                 error.appendTo("#cancel_policy_err");

             else if (element.attr("name") == "privacy_policy")

                 error.appendTo("#privacy_policy_err");

             else if (element.attr("name") == "credit-card-needed")

                 error.insertAfter(".your-card");

             else

                 error.insertAfter(element);

         },

         submitHandler: function(form) {

             window.scrollTo(0, 0);

             // ajax call

             $.ajax({

                 url: BASE_URL + "home/send_custombooking_data",

                 type: 'POST',

                 data: jQuery("#customBookingForm").serialize(),

                 beforeSend: function() {

                     ajxLoader('show', 'body');

                 },

                 dataType: "JSON",

                 success: function(data) {

                     if (data.success) {

                         $('#thankyoumodal .modal-body p').text('Thank you for your request. You will receive an email from our agent shortly.');

                         jQuery("#customBookingForm")[0].reset();

                         $("#cb_expirymonth").val('').trigger('change');

                         $("#cb_expiryyear").val('').trigger('change');



                         var validator = $("#customBookingForm").validate();

                         validator.resetForm();

                         $('#thankyoumodal').modal('show');

                     } else {

                         //$('#errormodal').modal('show');

                         jQuery("#cb_error_msg").html(data.msg);

                         jQuery("#cb_error_msg").removeClass('d-none');



                         setTimeout(function() {

                             jQuery("#cb_error_msg").addClass('d-none');

                             jQuery("#cb_error_msg").html("");

                         }, 10000);

                     }

                     ajxLoader('hide', 'body');

                 },

                 error: function() {

                     //window.scrollTo(0,0);

                     ajxLoader('hide', 'body');

                     jQuery("#cb_error_msg").html("Something went wrong!");

                     jQuery("#cb_error_msg").removeClass('d-none');



                     setTimeout(function() {

                         jQuery("#cb_error_msg").addClass('d-none');

                         jQuery("#cb_error_msg").html("");

                     }, 10000);

                 }

             });

         }

     });



     jQuery("#cb_expirymonth,#cb_expiryyear").select2().change(function() {

         jQuery(this).valid();

     });



     $(function() {



         var cardNumber = $('#cb_cardnumber');



         cardNumber.payform('formatCardNumber');

     });

 </script>