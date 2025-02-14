<div class="breadcrumb n-breadcrumb">
   <div class="container">
      <ul>
         <li><a href="<?=BASE_URL?>">Home</a></li>
         <li>Information</li>
      </ul>
   </div>
</div>
<?php
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
            <li class="active in-progress">
               <span class="circle"></span>
               Information
            </li>
            <li>
               <span class="circle"></span>
               Payment
            </li>
         </ul>
      </div>
      <div class="wizzard-content">
         <h2 class="title">Information</h2>
         <div class="row">
            <div class="col-md-8">
               <div class="custom-form">
                    <form id="checkoutUserInfo" name="checkoutUserInfo" method="POST" action="<?=base_url('payment')?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group field-group">
                                    <fieldset class="checkoutfirstname-fieldset">
                                        <legend>First Name</legend>
                                        <input type="text" class="form-control" id="checkoutfirstname" name="checkoutfirstname" value="<?=$this->session->userdata('checkoutfirstname')?>">
                                    </fieldset>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group field-group">
                                    <fieldset class="checkoutlastname-fieldset">
                                        <legend>Last Name</legend>
                                        <input type="text" class="form-control" id="checkoutlastname" name="checkoutlastname" value="<?=$this->session->userdata('checkoutlastname')?>">
                                    </fieldset>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group field-group">
                                    <fieldset class="checkoutemail-fieldset">
                                        <legend>Email</legend>
                                        <input type="text" class="form-control" id="checkoutemail" name="checkoutemail" value="<?=$this->session->userdata('checkoutemail')?>">
                                    </fieldset>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group field-group">
                                    <fieldset class="checkoutconfirmemail-fieldset">
                                        <legend>Confirm Email</legend>
                                        <input type="text" class="form-control" id="checkoutconfirmemail" name="checkoutconfirmemail" value="<?=$this->session->userdata('checkoutemail')?>">
                                    </fieldset>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group field-group">
                                    <fieldset class="checkoutneeds-fieldset">
                                        <legend>Special Needs</legend>
                                        <textarea class="form-control" rows="5" name="checkoutneeds"><?=$this->session->userdata('checkoutneeds')?></textarea>
                                    </fieldset>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group field-group select2-popup">
                                    <fieldset class="checkoutfoundus-fieldset">
                                        <legend>Found Us</legend>
                                        <select class="form-control checkout-found-us" name="checkoutfoundus">
                                            <option value="">--Select--</option>
                                            <option value="Travel Agent" <?=($this->session->userdata('checkoutfoundus') == 'Travel Agent' ? 'selected="selected"' : '')?>>Travel Agent</option>
                                            <option value="Friend Suggestion" <?=($this->session->userdata('checkoutfoundus') == 'Friend Suggestion' ? 'selected="selected"' : '')?>>Friend Suggestion</option>
                                            <option value="Internet Search" <?=($this->session->userdata('checkoutfoundus') == 'Internet Search' ? 'selected="selected"' : '')?>>Internet Search</option>
                                            <option value="I am a Previous Guest" <?=($this->session->userdata('checkoutfoundus') == 'I am a Previous Guest' ? 'selected="selected"' : '')?>>I am a Previous Guest</option>
                                            <option value="Tripadvisor" <?=($this->session->userdata('checkoutfoundus') == 'Tripadvisor' ? 'selected="selected"' : '')?>>Tripadvisor</option>
                                            <option value="Other" <?=($this->session->userdata('checkoutfoundus') == 'Other' ? 'selected="selected"' : '')?>>Other</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group field-group">
                                    <div class="input-group">
                                        <fieldset class="checkouttravellingphone-fieldset">
                                            <legend>Phone Number While Travelling</legend>
                                            <input type="text" class="form-control" id="checkouttravellingphone" name="checkouttravellingphone" value="<?=$this->session->userdata('checkouttravellingphone')?>">
                                        </fieldset>
                                        <button class="popover-button" type="button" data-toggle="popover" data-content="Colosseum or Vatican museums: Please note that skip-the-line tickets enable you to skip the line for people without a reservation.  It will still be necessary to go through a security screening, and we will need to factor in time for this.Please note the skip the line tickets are not refundable and rarely changeable)" data-placement="bottom" data-original-title="" title=""><i class="fal fa-info-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-wrap">
                            <a href="<?=base_url('summary');?>" class="btn btn btn-border">Previous Page</a>
                            <button type="submit" class="btn btn-blue next-checkout">Next</button>
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
                                <p><i class="far fa-clock"></i>Duration : <?=($single_transfer_details['duration'] > 1) ? $single_transfer_details['duration']. ' Days' : $single_transfer_details['duration'] . ' Days'?></p>
                                <p><i class="far fa-users"></i>Total Members : <span class="variation-title"><?=$variation_title_array[$get_added_transfer_variation_id];?></span> Person</p>
                                <h3 class="price"><span class="currency-symbol">€</span><span class="cart-totals"><?=price_format($product['price'])?></span></h3>
                            </div>
                            <?php
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
<script>
jQuery(document).ready(function(){
    jQuery('.checkout-found-us').select2({minimumResultsForSearch: -1});
    jQuery('[data-toggle="popover"]').popover();
    // start validation for user information form
    jQuery("#checkoutUserInfo").validate({
        errorClass: 'validation-error',
        rules: {
            checkoutfirstname: {
                required: {
                    depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                    }
                },
                noHTML: true,
                maxlength: 40,
            },
            checkoutlastname: {
                required: {
                    depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                    }
                },
                noHTML: true,
                maxlength: 40,
            },            
            checkoutemail: {
                email: true,
                required: true,
                cstmEmail: true,
            },
            checkoutconfirmemail : {
                email: true,
                equalTo : "#checkoutemail"
            },
            checkoutneeds: {
                required: {
                    depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                    }
                },
                noHTML: true,
                maxlength: 40,
            },
            checkoutfoundus : {
                required: true,
            },
            checkouttravellingphone: {
                required: {
                    depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                    }
                },
                number: true,
                minlength: 10,
                maxlength: 12,
            }
        }, 
        messages: {
                checkoutfirstname: {
                    required: 'Please enter first name',
                    maxlength: 'Please enter no more than 40 characters',
                },
                checkoutlastname: {
                    required: 'Please enter last name',
                    maxlength: 'Please enter no more than 40 characters',
                },
                checkoutemail: {
                    required: 'Please enter email address',
                    email: 'Please enter valid email address'
                },
                checkoutconfirmemail: {
                    required: 'Please enter email address',
                    email: 'Please enter valid email address',
                    equalTo: 'Confirm email is not match with the actual email'
                },
                checkoutneeds: {
                    required: 'Please enter special needs',
                },
                checkoutfoundus: {
                    required: 'Please select found us',
                },
                checkouttravellingphone: {
                    required: 'Please enter phone number',
                    minlength: 'Please enter valid phone number',
                    maxlength: 'Please enter no more than 12 digits',
                }
        }, 
        errorPlacement: function(error, element) {
            if (element.attr("name") == "checkoutfirstname")
                    error.insertAfter(".checkoutfirstname-fieldset");  
                else if (element.attr("name") == "checkoutlastname")
                    error.insertAfter(".checkoutlastname-fieldset");  
                else if (element.attr("name") == "checkoutemail")
                    error.insertAfter(".checkoutemail-fieldset");  
                else if (element.attr("name") == "checkoutconfirmemail")
                    error.insertAfter(".checkoutconfirmemail-fieldset");  
                else if (element.attr("name") == "checkoutneeds")
                    error.insertAfter(".checkoutneeds-fieldset");  
                else if (element.attr("name") == "checkoutfoundus")
                    error.insertAfter(".checkoutfoundus-fieldset");  
                else if (element.attr("name") == "checkouttravellingphone")
                    error.insertAfter(".popover-button");  
                else
                    error.insertAfter(element); 
        }        
    });
    // END validation for user information form
});
</script>