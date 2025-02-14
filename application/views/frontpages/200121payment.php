<div class="breadcrumb n-breadcrumb">
   <div class="container">
      <ul>
         <li><a href="<?=BASE_URL?>">Home</a></li>
         <li>Payment</li>
      </ul>
   </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<?php
// if(isset($success)){
//     echo 'hello success';die;
// }
if(!empty($cart_products_name)){
    // pr($cart_products_name);
    // pr($cart_products_variation_title);
    $counter = 0;
    foreach($cart_products_name as $single_product_name){
    ?>
        <script>
        jQuery(document).ready(function(){
            var get_single_product_name = '<?=$single_product_name?>';
            var get_cart_products_variation_title = '<?=$cart_products_variation_title[$counter]?>';
            toastrAlert('Product "'+ get_single_product_name + '" has been removed from your cart because no longer available!', 'error');
        });
        </script>
<?php
        $counter++;
    }    
}
$get_admin_settings = get_admin_settings();	
$company_email = 'arj@narola.email';

foreach($get_admin_settings as $admin_setting){
    if($admin_setting['name'] == 'company_email'){
        $company_email = $admin_setting['value'];
    }
}
$cart_total = price_format($this->cart->total(), 2);
$cart_total_items = $this->cart->total_items();
?>
<section class="pt-80 pb-80">
   <div class="container">
      <div class="wizzard-step">
         <ul>
            <li class="completed">
               <span class="circle"></span>
               Summary
            </li>
            <li class="completed">
               <span class="circle"></span>
               Information
            </li>
            <li  class="active">
               <span class="circle"></span>
               Payment
            </li>
         </ul>
      </div>
      <div class="wizzard-content">
         <h2 class="title">Payment Details</h2>
         <div class="row payment-register-agent">
            <div class="col-md-8">
               <div class="custom-form">
                    <form class="is-agent-form">                        
                        <div class="form-group">
                            <label>Are you a registered agent with driverinrome?</label>
                            <div class="radio-wrap">
                            <div class="custom-radio">
                                Yes
                                <input type="radio" name="isregisteragent" value="yes">
                                <span class="checkmark"></span>
                            </div>
                            <div class="custom-radio">
                                No
                                <input type="radio" name="isregisteragent" value="no">
                                <span class="checkmark"></span>
                            </div>
                            </div>
                        </div>
                    </form> 
                    <form class="card-payment" method="POST" action="<?=base_url('thank_you')?>" id="cadPayment" name="cadPayment">
                        <input type="hidden" name="token" />
                        <input type="hidden" name="checkoutemail" id="checkoutemail" value="<?=$this->session->userdata('checkoutemail')?>"/>
                        <div class="form-group">
                        <div class="custom-checkbox">
                            Your credit card is needed purely to secure your booking. WE WILL NOT CHARGE OR PUT A HOLD ON YOUR CARD NOW. Payments are made at the end of the tour day directly to your driver. The given rate is the cash rate. If needed the driver may stop at ATM machines during the day. We do accept credit card payments including Visa, American Express, and Mastercard, but please notice that those payments will incur a 12 % fee. You may cancel this booking up to 72 hours prior tour date free of charge. Only pre-purchased skip the line tickets ( if requested) are not refundable under any circumstance and will be charged to your card.
                            <input type="checkbox" name="credit-card-needed" id="credit_card_needed">
                            <span class="checkmark your-card"></span>
                        </div>
                        </div>
                        <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group field-group">
                                <fieldset class="fieldset-nameoncard">
                                    <legend>NAME ON CARD<span class="required-star">*</span></legend>
                                    <input type="text" class="form-control" id="nameoncard" name="nameoncard">
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group field-group">
                                <fieldset class="fieldset-checkoutcardnumber">
                                    <legend>Card Number<span class="required-star">*</span></legend>
                                    <div class="card-element-wrap">
                                        <!-- <input type="number" maxlength="16" class="form-control" id="checkoutcardnumber" name="checkoutcardnumber" placeholder="●●●● ●●●● ●●●● ●●●●"> -->
                                    </div>
                                </fieldset>
                                <div class="outcome">
                                    <div class="error"></div>
                                    <!-- <div class="success">
                                        Success! Your Stripe token is <span class="token"></span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group field-group">
                                <fieldset class="fieldset-checkoutexpirymonth">
                                    <legend>Expiry Month/Year<span class="required-star">*</span></legend>
                                    <div class="expiry-element-wrap">                                        
                                    </div>
                                    <!-- <input type="number" maxlength="2" class="form-control" id="checkoutexpirymonth" name="checkoutexpirymonth" placeholder="MM"> -->
                                </fieldset>
                                <div class="expirymonthyear"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group field-group">
                                <div class="input-group">
                                    <fieldset class="fieldset-checkoutcvv">
                                        <legend>CVV<span class="required-star">*</span></legend>
                                        <div class="cvv-element-wrap">
                                            <!-- <input type="number" class="form-control" id="checkoutcvv" name="checkoutcvv" placeholder="●●●"> -->
                                        </div>
                                    </fieldset> 
                                    <button class="popover-button" type="button" data-toggle="popover" data-content="On every transaction you make using your credit or debit card, a unique 3-4 digit CVV code is required to complete the transaction." data-placement="bottom" data-original-title="" title=""><i class="fal fa-info-circle"></i></button>                                      
                                </div>
                                <div class="cvverror"></div>                        
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group field-group">
                                <fieldset class="fieldset-checkoutaddress">
                                    <legend>Please Add Your Address<span class="required-star">*</span></legend>
                                    <textarea class="form-control" rows="2" name="checkoutaddress" id="checkoutaddress"></textarea>                                                                      
                                </fieldset>
                            </div>
                        </div>
                        <?php
                        $countries = unserialize (COUNTRIES);
                        ?>
                        <div class="col-md-4">
                            <div class="form-group field-group select2-popup">
                                <fieldset class="fieldset-checkoutcountry">
                                    <legend>Country<span class="required-star">*</span></legend>
                                    <select class="form-control" id="checkoutcountry" name="checkoutcountry">
                                        <option value="">--Select--</option>
                                        <?php
                                        foreach($countries as $country){
                                            ?>
                                            <option value="<?=$country?>"><?=$country?></option>
                                            <?php
                                        }
                                        ?>                                        
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-group select2-popup">
                                <fieldset class="fieldset-checkoutcity">
                                    <legend>City<span class="required-star">*</span></legend>
                                    <input type="text" class="form-control" id="checkoutcity" name="checkoutcity">
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-group">
                                <fieldset class="fieldset-checkoutzipcode">
                                    <legend>Zip Code<span class="required-star">*</span></legend>
                                    <input type="text" class="form-control" id="checkoutzipcode" name="checkoutzipcode">
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
                                <a href="<?=base_url('cancellation-policy');?>" target="_blank" class="cancellation-policy">Cancellation Policy.</a>
                            </div>                            
                        </li>
                        <li>
                            <div class="custom-checkbox">
                                Please keep me updated with driverinrome's offers &amp; tours. 
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </div>
                        </li>
                        </ul>
                        <p class="text-right total-price cart-total-wrapper">Total Price :<strong><span class="currency-symbol-big">€</span><span class="cart-totals"><?=$cart_total?></span></strong></p>
                        <div class="button-wrap">
                            <a href="<?=base_url('information');?>" class="btn btn btn-border">Previous Page</a>
                            <button type="submit" class="btn btn-blue next-checkout">Checkout</button>
                        </div>                        
                    </form>                 
               </div>
            </div>
            <div class="col-md-4">
               <div class="bg-shadow proceed-to-checkout order-summary">
                  <h4>Order Summary</h4>
                  <?php
                  if(!empty($this->cart->contents())){
                    foreach ($this->cart->contents() as $product){
                        if(array_key_exists("tours_detail_data", $product)){
                         ?>
                            <div class="summary-details">
                                  <h2><?php echo $product['name'];?></h2>
                                  <h5 class="code-id"><span>Code : </span><strong><?php echo $product['tours_detail_data']['toursData']['unique_code']?></strong></h5>
                                  <p><i class="far fa-clock"></i>Duration : <?php
                                  if($product['tours_detail_data']['toursData']['duration'] > 1) { echo $product['tours_detail_data']['toursData']['duration']. ' Hours'; } else { echo $product['tours_detail_data']['toursData']['duration'] . ' Hour';}?></p>
                                  <p><i class="far fa-users"></i>Total Members : <span class="variation-title"><?php echo $product['tours_detail_data']['total_passenger'];?></span><?php if($product['tours_detail_data']['total_passenger']>1){ echo " Persons"; }else { echo " Person";}?> </p>
                                  <h3 class="price"><span class="currency-symbol">€</span><span class="cart-totals"><?php echo price_format($product['price']);?></span></h3>
                              </div>
                       <?php  } else {
                        $single_transfer_details = get_single_transfers_all_details_by_id($product['id'], array('1'));
                        if(!empty($single_transfer_details['id'])){
                            // get variation title by variation option added in cart
                            $variation_title_array = explode (", ", $single_transfer_details['variation_title']);
                            $variation_price_array = explode (", ", $single_transfer_details['transfer_price']);
                            $get_added_transfer_variation_id = $product['options']['transfer_variation_id'] - 1;
                            ?>
                            <div class="summary-details">
                                <h2><?=$single_transfer_details['title']?></h2>
                                <h5 class="code-id"><span>Code : </span><strong><?=$single_transfer_details['unique_code']?></strong></h5>
                                <p><i class="far fa-clock"></i>Duration : <?=($single_transfer_details['duration'] > 1) ? $single_transfer_details['duration']. ' Hours' : $single_transfer_details['duration'] . ' Hour'?></p>
                                <p><i class="far fa-users"></i>Total Members : <span class="variation-title"><?=$variation_title_array[$get_added_transfer_variation_id];?></span> Person</p>
                                <h3 class="price"><span class="currency-symbol">€</span><span class="cart-totals"><?=price_format($product['price'])?></span></h3>
                            </div>
                            <?php
                        }
                        }
                    }
                  }
                  ?>
                    <div class="total-price">
                        <label>Total Price <?=$cart_total_items?> <?=($cart_total_items > 1) ? ' items' : ' item' ?> :</label>
                        <strong><span class="currency-symbol-big">€</span><span class="cart-totals"><?=$cart_total?></span></strong>
                    </div>
                  <div class="pd-30">
                     <ul>
                        <li>
                           <img src="<?=base_url('assets/images/mastercard.png')?>" onerror="this.src='<?=DEFAULT_IMAGE?>/transfers_default.png';">
                        </li>
                        <li>
                           <img src="<?=base_url('assets/images/Visa.png')?>" onerror="this.src='<?=DEFAULT_IMAGE?>/transfers_default.png';">
                        </li>
                        <li>
                           <img src="<?=base_url('assets/images/american-express-icon.png')?>" onerror="this.src='<?=DEFAULT_IMAGE?>/transfers_default.png';">
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="bg-shadow getintouch-div">
                  <h4>Get in Touch</h4>
                  <div id="accordion" class="accordion">
                     <div class="card">
                        <div class="card-header">
                           <a class="card-link" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
                           <i class="fas fa-phone-alt"></i>PHONE NUMBER<span class="up-down-arrow"><i class="fas fa-chevron-down"></i></span>
                           </a>
                        </div>
                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                           <div class="card-body card-body-wrapper">
                              <div class="card-header">
                                 <a class="card-link" href="tel:3155440496">
                                 <i class="fas fa-phone-alt"></i>(315) 544-0496</a>
                              </div>
                              <div class="card-header">
                                 <a class="card-link" href="tel:39066244373">
                                 <i class="fas fa-phone-alt"></i>+39 066244373</a>
                              </div>
                              <div class="card-header">
                                 <a class="card-link" href="tel:393924468283">
                                 <i class="fab fa-whatsapp"></i>+39 392 4468283</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-header">
                           <a class="card-link" data-toggle="collapse" href="#collapseTwo" aria-expanded="true">
                           <i class="fas fa-envelope"></i>EMAIL ADDRESS<span class="up-down-arrow"><i class="fas fa-chevron-down"></i></span>
                           </a>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                           <div class="card-body card-body-wrapper">
                              <div class="card-header">
                                 <a class="collapsed card-link" href="mailto:<?=$company_email?>">
                                 <i class="fas fa-envelope"></i><?=$company_email?>
                                 </a> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-header">
                           <a class="collapsed card-link" href="#" onclick="smartsupp('chat:open'); return false;">
                           <img src="<?=base_url('assets/images/live-chat.png')?>" onerror="this.src='<?=DEFAULT_IMAGE?>/transfers_default.png';">LIVE CHAT
                           </a>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                           <div class="card-body">
                              Lorem ipsum dolor sit amet
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="secure-payment">
                     <div>
                        <div id="TA_certificateOfExcellence525" class="TA_certificateOfExcellence">
                           <ul id="SzUNTLikc" class="TA_links gvBb62d5C2px">
                              <li id="Ou2Kkc7" class="Itx6XmnV"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g187791-d1638989-Reviews-DriverinRome_Transportation_Tours-Rome_Lazio.html"><img src="https://www.tripadvisor.com/img/cdsi/img2/awards/v2/tchotel_2020_L-14348-2.png" alt="TripAdvisor" class="widCOEImg" id="CDSWIDCOELOGO"/></a></li>
                           </ul>
                        </div>
                        <script async src="https://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=525&amp;locationId=1638989&amp;lang=en_US&amp;year=2020&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>
                     </div>
                     <div>
                        <div id="TA_cdsratingsonlynarrow238" class="TA_cdsratingsonlynarrow">
                           <ul id="hVMaHgvP" class="TA_links t9FnV8L">
                              <li id="u7I8JjhfKg0" class="Qnj6pES3"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g187791-d1638989-Reviews-DriverinRome_Transportation_Tours-Rome_Lazio.html"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/v2/Tripadvisor_lockup_horizontal_secondary_registered-18034-2.svg" alt="TripAdvisor"/></a></li>
                           </ul>
                        </div>
                        <script async src="https://www.jscache.com/wejs?wtype=cdsratingsonlynarrow&amp;uniq=238&amp;locationId=1638989&amp;lang=en_US&amp;border=true&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<div id="addAffiliateCode" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
            <div class="modal-header">
                <h4 class="modal-title">SEND AFFILIATE CODE</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
            </div>
            <form id="addAffiliateForm" name="addAffiliateForm" method="POST" action="<?php echo base_url('submit_order');?>">
                <div class="modal-body">
                  <div class="modal-form">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <fieldset class="affilate-fieldset">
                              <legend>Add Affiliate Code</legend>
                                <input type="text" name="affiliate_code" class="form-control" id="affiliate_code" >                      
                            </fieldset>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="submit_affiliate_code" class="btn btn-yellow">submit</button>
                  </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
<script>
jQuery(document).ready(function(){
    jQuery('input[type=radio][name=isregisteragent]').change(function() {
        if (this.value == 'no') {
            jQuery('.card-payment').show();
            jQuery('.is-agent-form').hide();
        } else if(this.value=="yes"){
            jQuery('#addAffiliateCode').modal('show');
        }
    });
    jQuery('[data-toggle="popover"]').popover();
    jQuery('#checkoutcountry').select2({minimumResultsForSearch: -1});
});

jQuery("#addAffiliateForm").validate({
        errorClass: 'validation-error',
        rules: {
            affiliate_code:{
                required: true,
                maxlength: 200,
            }
        },
        messages: {
            affiliate_code: {
                required: 'Please enter affiliate code',
                maxlength: 'Please enter no more than 30 characters',
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "affiliate_code") {
                error.insertAfter(".affilate-fieldset");
            }
        },
        submitHandler: function (form) {
            ajxLoader('show', 'body');
            form.submit();
        } 
}); 

// START validation for payment checkout form
jQuery("#cadPayment").validate({
        errorClass: 'validation-error',
        rules: {
            nameoncard: {
                required: {
                    depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                    }
                },
                noHTML: true,
                maxlength: 30,
            },           
            cardnumber: {
                required: true,
                number: true,
            },
            cvc: {
                required: true,
                number: true,
            },
            'exp-date': {
                required: true,
            },
            checkoutcardnumber: {
                required: true,
                number: true,
                minlength: 16,
                maxlength: 16,
            },
            checkoutexpirymonth: {
                required: true,
                number: true,
                minlength: 2,
                maxlength: 2,
            },
            checkoutexpiryyear: {
                required: true,
                number: true,
                minlength: 2,
                maxlength: 2,
            },
            checkoutcvv: {
                required: true,
                number: true,
                minlength: 3,
                maxlength: 4,
            },
            checkoutaddress: {
                required: {
                    depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                    }
                },
                noHTML: true,
                maxlength: 40,
            },
            checkoutcountry: {
                required: true
            },
            checkoutcity: {
                required: {
                    depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                    }
                },
                noHTML: true,
                maxlength: 20,
            },
            checkoutzipcode: {
                required: {
                    depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                    }
                },
                noHTML: true,
                maxlength: 6,
            },
            cancellation_policy: {
                required: true
            },
            cancellation_policy: {
                required: true
            },
            'credit-card-needed': {
                required: true,
            }
        }, 
        messages: {
                nameoncard: {
                    required: 'Please enter name on card',
                    maxlength: 'Please enter no more than 30 characters',
                },
                checkoutcardnumber: {
                    required: 'Please enter card number',
                    minlength: 'Please enter 16 digits',
                    maxlength: 'Please enter 16 digits only',
                },
                checkoutaddress: {
                    required: 'Please enter address',
                    maxlength: 'Please enter 40 characters only',
                },
                checkoutcountry: {
                    required: 'Please select country',
                },
                checkoutcity: {
                    required: 'Please enter city name',
                    maxlength: 'Please enter 20 digits only',
                },
                cardnumber: {
                    required: 'Please enter card number',
                },
                checkoutzipcode: {
                    required: 'Please enter zip code',
                    maxlength: 'Please enter 6 digits only',
                },
                'credit-card-needed': {
                    required: 'Please accept this',
                }
        }, 
        errorPlacement: function(error, element) {
            if (element.attr("name") == "checkoutcardnumber")
                error.insertAfter(".fieldset-checkoutcardnumber");  
            else if (element.attr("name") == "nameoncard")
                error.insertAfter(".fieldset-nameoncard");  
            else if (element.attr("name") == "checkoutaddress")
                error.insertAfter(".fieldset-checkoutaddress");  
            else if (element.attr("name") == "checkoutcountry")
                error.insertAfter(".fieldset-checkoutcountry");  
            else if (element.attr("name") == "checkoutcity")
                error.insertAfter(".fieldset-checkoutcity");  
            else if (element.attr("name") == "checkoutzipcode")
                error.insertAfter(".fieldset-checkoutzipcode");
            else if (element.attr("name") == "cardnumber")
                error.insertAfter(".fieldset-checkoutcardnumber");
            else if (element.attr("name") == "cancellation_policy")
                error.insertAfter(".cancellation-policy");
            else if (element.attr("name") == "credit-card-needed")
                error.insertAfter(".your-card");
            else
                error.insertAfter(element); 
        }        
    });
    // END validation for payment checkout form

var style = {
base: {
    color: "#32325d",
}
};
var stripe = Stripe('<?=PUBLISHABLE_KEY?>');
var elements = stripe.elements();
    
var cardNumberElement = elements.create('cardNumber', {
    style: style,
    placeholder: 'XXXX XXXX XXXX XXXX',
});
cardNumberElement.mount('.card-element-wrap');

var cardExpiryElement = elements.create('cardExpiry', {
    style: style,
    placeholder: 'MM / YY',
});
cardExpiryElement.mount('.expiry-element-wrap');

var cardCvcElement = elements.create('cardCvc', {
    style: style,
    placeholder: 'XXX',
});
cardCvcElement.mount('.cvv-element-wrap');


function setOutcome(result) {
    // var successElement = document.querySelector('.success');
    var errorElement = document.querySelector('.error');
    var expirymonthyearerrorElement = document.querySelector('.expirymonthyear');
    var cvverrorElement = document.querySelector('.cvverror');
    // successElement.classList.remove('visible');
    errorElement.textContent = '';
    errorElement.classList.remove('visible');
    expirymonthyearerrorElement.textContent = '';
    expirymonthyearerrorElement.classList.remove('visible');
    cvverrorElement.textContent = '';
    cvverrorElement.classList.remove('visible');

    if (result.token) {
        console.log('generate');
        // In this example, we're simply displaying the token
        // successElement.querySelector('.token').textContent = result.token.id;
        // successElement.classList.add('visible');
        var form = document.querySelector('form#cadPayment');
        jQuery('input[name="token"]').attr('value', result.token.id);
        form.submit();
    } else if (result.error) {
        // console.log('error');
        // console.log(result.error);
        if(result.error.code == 'incomplete_number'){
            errorElement.textContent = result.error.message;
        }
        if(result.error.code == 'incomplete_expiry'){
            expirymonthyearerrorElement.textContent = result.error.message;
        }
        if(result.error.code == 'invalid_expiry_year_past'){
            expirymonthyearerrorElement.textContent = result.error.message;
        }
        if(result.error.code == 'incomplete_cvc'){
            cvverrorElement.textContent = result.error.message;
        }
        // errorElement.textContent = result.error.message;
        errorElement.classList.add('visible');
        expirymonthyearerrorElement.classList.add('visible');
        cvverrorElement.classList.add('visible');
    }
}

cardNumberElement.on('change', function(event) {
    setOutcome(event);
});
cardExpiryElement.on('change', function(event) {
    setOutcome(event);
});
cardCvcElement.on('change', function(event) {
    setOutcome(event);
});
jQuery(document).on('submit','form#cadPayment',function(e){
    e.preventDefault();
    var options = {
        email: document.getElementById('checkoutemail').value,
        // nameoncard: document.getElementById('name_on_card').value
    };
    stripe.createToken(cardNumberElement, options).then(setOutcome);
});
// document.querySelector('form').addEventListener('submit', function(e) {
    

// });

</script>