<div class="breadcrumb n-breadcrumb">

    <div class="container">

        <p><a href="<?= BASE_URL ?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<span class="title"><?= $title ?></span></p>

    </div>

</div>

<script src="https://js.stripe.com/v3/"></script>

<script src="<?= ASSET ?>js/jquery.payform.min.js"></script>

<?php

// if(isset($success)){

//     echo 'hello success';die;

// }

if (!empty($cart_products_name)) {

    // pr($cart_products_name);

    // pr($cart_products_variation_title);

    $counter = 0;

    foreach ($cart_products_name as $single_product_name) {

?>

        <script>
            jQuery(document).ready(function() {

                var get_single_product_name = "<?= $single_product_name ?>";

                // var get_cart_products_variation_title = '<?= $cart_products_variation_title[$counter] ?>';

                toastrAlert('Product "' + get_single_product_name + '" has been removed from your cart because no longer available!', 'error');

            });
        </script>

<?php

        $counter++;
    }
}

$get_admin_settings = get_admin_settings();

$company_email = 'arj@narola.email';



foreach ($get_admin_settings as $admin_setting) {

    if ($admin_setting['name'] == 'company_email') {

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

                <li class="active">

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

                                <div class="reg-agent-wrapper d-flex align-items-start">

                                    <label>Are you a registered agent with driverinrome?</label>
                                    <?php 
                                        $affiliate_description = get_settings('affiliate_description');   
                                    ?>
                                    <button class="popover-button mt-2 mt-md-0" type="button" data-toggle="popover" data-content="Are you a registered agent with driverinrome? <?php echo !empty($affiliate_description) ? $affiliate_description : ''; ?>" data-placement="bottom" data-original-title="" title=""><i class="fal fa-info-circle"></i></button>

                                </div>

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

                        <form class="card-payment" method="POST" action="<?= base_url('thank_you') ?>" id="cadPayment" name="cadPayment">

                            <input type="hidden" name="token" />

                            <input type="hidden" name="checkoutemail" id="checkoutemail" value="<?= $this->session->userdata('checkoutemail') ?>" />

                            <input type="hidden" name="product_type" id="cart_product_type_payment">

                            <input type="hidden" name="checkout_card" id="checkout_card">

                            <input type="hidden" name="checkout_expiry" id="checkout_expiry">

                            <input type="hidden" name="checkout_cvv" id="checkout_cvv">

                            <hr>

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

                                                <input type="text" class="form-control" id="checkoutcardnumber" name="checkoutcardnumber" placeholder="XXXX XXXX XXXX XXXX" autocomplete="off">

                                            </div>

                                        </fieldset>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group field-group select2-popup">

                                        <fieldset class="fieldset-checkoutexpirymonth">

                                            <legend>Expiry Month<span class="required-star">*</span></legend>

                                            <select name="checkoutexpirymonth" id="checkoutexpirymonth" class="form-control">

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

                                            <select name="checkoutexpiryyear" id="checkoutexpiryyear" class="form-control">

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

                                                <input type="password" class="form-control" id="checkoutcardcvv" name="checkoutcardcvv" placeholder="">

                                            </fieldset>

                                            <button class="popover-button" type="button" data-toggle="popover" data-content="On every transaction you make using your credit or debit card, a unique 3-4 digit CVV code is required to complete the transaction." data-placement="bottom" data-original-title="" title=""><i class="fal fa-info-circle"></i></button>

                                        </div>

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

                                $countries = unserialize(COUNTRIES);

                                ?>

                                <div class="col-md-4">

                                    <div class="form-group field-group select2-popup">

                                        <fieldset class="fieldset-checkoutcountry">

                                            <legend>Country<span class="required-star">*</span></legend>

                                            <input type="text" class="form-control" id="checkoutcountry" name="checkoutcountry" autocomplete="off">

                                        </fieldset>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group field-group select2-popup">

                                        <fieldset class="fieldset-checkoutcity">

                                            <legend>City<span class="required-star">*</span></legend>

                                            <input type="text" class="form-control" id="checkoutcity" name="checkoutcity" autocomplete="off">

                                        </fieldset>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group field-group">

                                        <fieldset class="fieldset-checkoutzipcode">

                                            <legend>Zip Code<span class="required-star">*</span></legend>

                                            <input type="text" class="form-control" id="checkoutzipcode" name="checkoutzipcode" autocomplete="off">

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

                                    <a href="<?= base_url('privacy-policy'); ?>" target="_blank" class="privacy-policy">Privacy Policy.</a>

                                </li>

                                <div id="privacy_policy_err" class="mt-2 mb-2"></div>

                                <li>

                                    <div class="custom-checkbox">

                                        Please keep me updated with driverinrome's offers &amp; tours.

                                        <input type="checkbox" name="kepp_updated" id="kepp_updated">

                                        <span class="checkmark"></span>

                                    </div>

                                </li>

                            </ul>

                            <p class="text-right total-price cart-total-wrapper">Total Price :<strong><span class="currency-symbol-big">€</span><span class="cart-totals"><?= $cart_total ?></span></strong></p>

                            <div class="button-wrap">

                                <a href="<?= base_url('information'); ?>" class="btn btn btn-border">Previous Page</a>

                                <button type="submit" class="btn btn-blue next-checkout">Checkout</button>

                            </div>

                        </form>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="bg-shadow proceed-to-checkout order-summary">

                        <h4>Order Summary</h4>

                        <?php

                        $product_type_in_cart = '';

                        if (!empty($this->cart->contents())) {

                            $transfer_product_in_cart = 'no';

                            $tour_product_in_cart = 'no';

                            foreach ($this->cart->contents() as $product) {

                                $tour_extra_costs_array = $product['tours_detail_data']['tour_extra_cost'];

                                $total_extra_cost = $product['tours_detail_data']['toursData']['total_extra_cost'];

                                $total_tour_cost = $product['tours_detail_data']['toursData']['total_tour_cost'];
                                $tour_base_price = $product['tours_detail_data']['total_rate'];
                                $plus_symbol = '+';

                                if (array_key_exists("tours_detail_data", $product)) {

                                    $tour_product_in_cart = 'yes';

                        ?>

                                    <div class="summary-details">

                                        <h2><?php echo $product['name']; ?></h2>

                                        <h5 class="code-id"><span>Code : </span><strong><?php echo $product['tours_detail_data']['toursData']['unique_code'] ?></strong></h5>

                                        <p>

                                            <i class="far fa-clock"></i>Duration :

                                            <?php

                                            if ($product['tours_detail_data']['toursData']['tour_type_id'] == 8) {

                                                if ($product['tours_detail_data']['toursData']['duration'] > 1) {

                                                    echo $product['tours_detail_data']['toursData']['duration'] . ' Days';
                                                } else {

                                                    echo $product['tours_detail_data']['toursData']['duration'] . ' Day';
                                                }
                                            } else {

                                                if ($product['tours_detail_data']['toursData']['duration'] > 1) {

                                                    echo $product['tours_detail_data']['toursData']['duration'] . ' Hours';
                                                } else {

                                                    echo $product['tours_detail_data']['toursData']['duration'] . ' Hour';
                                                }
                                            } ?>

                                        </p>

                                        <p>

                                            <i class="far fa-users"></i>Total Members :

                                            <span class="variation-title">

                                                <?php echo $product['tours_detail_data']['total_passenger']; ?>

                                            </span>

                                            <?php if ($product['tours_detail_data']['total_passenger'] > 1) {

                                                echo " Persons";
                                            } else {

                                                echo " Person";
                                            } ?>

                                        </p>
                                        <p><i class="fal fa-money-bill"></i>Base price :

                                            <span class="variation-title">

                                                <?php

                                                echo '<b>€ ' . price_format($product['tours_detail_data']['total_rate']) . '</b>';

                                                ?>

                                            </span>

                                        </p>
                                        <?php

                                        if (is_array($product['tours_detail_data']['tour_upgrades']) && sizeof($product['tours_detail_data']['tour_upgrades']) > 0) {

                                            $tour_upgrades = $product['tours_detail_data']['tour_upgrades'];

                                            $extra_services_list = '';

                                            $extra_services = set_extra_services();



                                            foreach ($tour_upgrades as $key => $value) {



                                                if (array_key_exists($value, $extra_services)) {

                                                    $extra_services_list .= $extra_services[$value] . ', ';
                                                }
                                            }

                                        ?>

                                            <p><i class="fal fa-money-bill"></i>Upgrades :

                                                <span class="variation-title">

                                                    <?php

                                                    echo trim($extra_services_list, ', ') . '<b> (€ ' . price_format($product['tours_detail_data']['total_tour_upgrades_price']) . ')</b>';

                                                    ?>

                                                </span>

                                            </p>

                                        <?php

                                        }

                                        ?>
                                        <!-- start to display extra cost -->

                                        <?php

                                        if ($tour_extra_costs_array) {

                                        ?>

                                            <p><i class="fal fa-money-bill"></i>Extra cost :

                                                <span class="variation-title">

                                                    <?php

                                                    $extra_cost_details = '';

                                                    foreach ($tour_extra_costs_array as $tour_extra_cost) {

                                                        $extra_cost_details .= $tour_extra_cost['title'] . ' <b>(€ ' . price_format($tour_extra_cost['price']) . ')</b>' . ', ';
                                                    }

                                                    echo trim($extra_cost_details, ',');

                                                    ?>

                                                </span>

                                            </p>



                                        <?php

                                        }

                                        ?>
                                        <p><i class="fa fa-calculator"></i>Total :
                                            <span class="variation-title">
                                                (
                                                <?php
                                                if (!empty($total_extra_cost)) {
                                                ?>
                                                    Extra Cost: <b>€<?php echo price_format($total_extra_cost); ?></b>
                                                <?php
                                                }

                                                if (!empty($tour_base_price)) {
                                                    if (!empty($total_extra_cost)) {
                                                        echo $plus_symbol;
                                                    }
                                                ?>
                                                    Base Price: <b>€<?php echo price_format($tour_base_price) ?></b>
                                                <?php
                                                }

                                                if (!empty($product['tours_detail_data']['total_tour_upgrades_price'])) {
                                                    if (!empty($tour_base_price)) {
                                                        echo $plus_symbol;
                                                    }
                                                ?>
                                                    Upgrades: <b><?php echo '€ ' . price_format($product['tours_detail_data']['total_tour_upgrades_price']); ?></b>
                                                <?php
                                                }
                                                ?>
                                                )
                                                = <b>€<?php echo price_format($product['price']) ?></b>

                                                <!-- (Extra Cost: <b>€<?php //echo price_format($total_extra_cost) 
                                                                        ?></b> + Base Price: <b>€<?php //echo price_format($tour_base_price) 
                                                                                                    ?></b> + Upgrades: <b><?php //echo '€ ' . price_format($product['tours_detail_data']['total_tour_upgrades_price']); 
                                                                                                                            ?></b>) = <b>€<?php //echo price_format($product['price']) 
                                                                                                                                            ?></b> -->
                                            </span>
                                            <!-- <span class="variation-title">
                                                (Extra Cost: <b>€<?php //echo price_format($total_extra_cost) 
                                                                    ?></b> + Base Price: <b>€<?php //echo price_format($total_tour_cost) 
                                                                                                ?></b>) = <b>€<?php //echo price_format($product['price']) 
                                                                                                                ?></b>
                                            </span> -->

                                        </p>
                                        <h3 class="price">

                                            <span class="currency-symbol">€</span><span class="cart-totals"><?php echo price_format($product['price']); ?>

                                            </span>

                                        </h3>

                                    </div>

                                <?php  } else {

                                    $transfer_product_in_cart = 'yes';



                                    //    $transfer_product_in_cart = true;

                                    // $single_transfer_details = get_single_transfers_all_details_by_id($product['id'], array('1'));

                                    // if(!empty($single_transfer_details['id'])){

                                    // get variation title by variation option added in cart

                                    $variation_price_array = $product['transfer_detail_data']['transfer_variation_prices'];

                                ?>

                                    <div class="summary-details">

                                        <h2>

                                            <?= $product['transfer_detail_data']['title'] ?>

                                        </h2>

                                        <h5 class="code-id">

                                            <span>Code : </span>

                                            <strong><?= $product['transfer_detail_data']['unique_code'] ?></strong>

                                        </h5>

                                        <p>

                                            <i class="far fa-clock"></i>Duration :

                                            <?= ($product['transfer_detail_data']['duration'] > 1) ? $product['transfer_detail_data']['duration'] . ' Hours' : $product['transfer_detail_data']['duration'] . ' Hour' ?>

                                        </p>

                                        <p>

                                            <i class="far fa-users"></i>Total Members : <span class="variation-title"><?= $product['options']['transfer_variation_title']; ?></span> Person

                                        </p>

                                        <!-- start to display extra cost -->

                                        <?php

                                        if ($tour_extra_costs_array) {

                                        ?>

                                            <p><i class="fal fa-money-bill"></i>Extra cost :

                                                <span class="variation-title">

                                                    <?php

                                                    $extra_cost_details = '';

                                                    foreach ($tour_extra_costs_array as $tour_extra_cost) {

                                                        $extra_cost_details .= $tour_extra_cost['title'] . ' <b>(€ ' . price_format($tour_extra_cost['price']) . ')</b>' . ', ';
                                                    }

                                                    echo trim($extra_cost_details, ',');

                                                    ?>

                                                </span>

                                            </p>

                                            <p><i class="fa fa-calculator"></i>Total :

                                                <span class="variation-title">

                                                    (Extra Cost: <b>€<?php echo price_format($total_extra_cost) ?></b> + Base Price: <b>€<?php echo price_format($total_tour_cost) ?></b>) = <b>€<?php echo price_format($product['price']) ?></b> </span>

                                            </p>

                                        <?php

                                        }

                                        ?>

                                        <h3 class="price">

                                            <span class="currency-symbol">€</span>

                                            <span class="cart-totals"><?= price_format($product['price']) ?>

                                            </span>

                                        </h3>

                                    </div>

                        <?php

                                    // }

                                }
                            }

                            if ($tour_product_in_cart == 'yes' && $transfer_product_in_cart == 'yes') {

                                $product_type_in_cart = 'both';
                            } else if ($tour_product_in_cart == 'yes') {

                                $product_type_in_cart = 'tour';
                            } else if ($transfer_product_in_cart == 'yes') {

                                $product_type_in_cart = 'transfer';
                            }
                        }

                        ?>

                        <div class="total-price">

                            <label>Total Price <?= $cart_total_items ?> <?= ($cart_total_items > 1) ? ' items' : ' item' ?> :</label>

                            <strong><span class="currency-symbol-big">€</span><span class="cart-totals"><?= $cart_total ?></span></strong>

                        </div>

                        <div class="pd-30">

                            <ul>

                                <li>

                                    <img src="<?= base_url('assets/images/mastercard.png') ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';">

                                </li>

                                <li>

                                    <img src="<?= base_url('assets/images/Visa.png') ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';">

                                </li>

                                <li>

                                    <img src="<?= base_url('assets/images/american-express-icon.png') ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';">

                                </li>

                                <li>

                                    <img src="<?= base_url('assets/images/secure.jpg') ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';" style="min-width: 90px;">

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

                                            <a class="collapsed card-link" href="mailto:<?= $company_email ?>">

                                                <i class="fas fa-envelope"></i><?= $company_email ?>

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="card">

                                <div class="card-header">

                                    <a class="collapsed card-link" href="#" onclick="smartsupp('chat:open'); return false;">

                                        <img src="<?= base_url('assets/images/live-chat.png') ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';">LIVE CHAT

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

                                        <li id="Ou2Kkc7" class="Itx6XmnV"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g187791-d1638989-Reviews-DriverinRome_Transportation_Tours-Rome_Lazio.html"><img src="https://www.tripadvisor.com/img/cdsi/img2/awards/v2/tchotel_2020_L-14348-2.png" alt="TripAdvisor" class="widCOEImg" id="CDSWIDCOELOGO" /></a></li>

                                    </ul>

                                </div>

                                <script async src="https://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=525&amp;locationId=1638989&amp;lang=en_US&amp;year=2020&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>

                            </div>

                            <div>

                                <div id="TA_cdsratingsonlynarrow238" class="TA_cdsratingsonlynarrow">

                                    <ul id="hVMaHgvP" class="TA_links t9FnV8L">

                                        <li id="u7I8JjhfKg0" class="Qnj6pES3"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g187791-d1638989-Reviews-DriverinRome_Transportation_Tours-Rome_Lazio.html"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/v2/Tripadvisor_lockup_horizontal_secondary_registered-18034-2.svg" alt="TripAdvisor" /></a></li>

                                    </ul>

                                </div>

                                <script async src="https://www.jscache.com/wejs?wtype=cdsratingsonlynarrow&amp;uniq=238&amp;locationId=1638989&amp;lang=en_US&amp;border=true&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>

                            </div>

                        </div>

                    </div>

                    <div class="trustpilot-wrap bg-shadow proceed-to-checkout cart-total-wrapper">

                        <!-- TrustBox widget - Mini Carousel -->

                        <div class="trustpilot-widget" data-locale="en-US" data-template-id="539ad0ffdec7e10e686debd7" data-businessunit-id="5720a2100000ff00058c1686" data-style-height="350px" data-style-width="100%" data-theme="light" data-stars="1,2,3,4,5" data-review-languages="en">

                            <a href="https://www.trustpilot.com/review/driverinrome.com" target="_blank" rel="noopener">Trustpilot</a>

                        </div>

                        <!-- End TrustBox widget -->

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

                <form id="addAffiliateForm" name="addAffiliateForm" method="POST" action="<?php echo base_url('thank_you'); ?>">

                    <div class="modal-body">
                        
                        <div class="modal-form">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <fieldset class="affilate-fieldset">

                                            <legend>Add Affiliate Code</legend>

                                            <input type="text" name="affiliate_code" class="form-control" id="affiliate_code" autocomplete="off">

                                            <input type="hidden" name="product_type" value="<?= $product_type_in_cart ?>" id="cart_product_type">

                                        </fieldset>

                                    </div>

                                </div>

                            </div>

                            <button type="submit" name="submit_affiliate_code" class="btn btn-yellow" id="affiliateSend">Send</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script>
    $("#addAffiliateCode").on("hidden.bs.modal", function() {

        $('#affiliate_code').val('');

        $('#affiliate_code-error').hide();

    });

    jQuery(document).ready(function() {



        jQuery.validator.addMethod("alphanumeric", function(value, element) {

            var regex = /^[A-Za-z0-9]+$/;

            return regex.test(value);

        }, "Please enter letters and numbers only");



        jQuery.validator.addMethod("lettersonly", function(value, element) {

            return this.optional(element) || /^[a-zA-Z," "]+$/i.test(value);

        }, "Numbers and Special characters are not allowed");



        jQuery.validator.addMethod("specical_chars", function(value, element) {

            console.log('test_number');

            return this.optional(element) || !/[~`!#$%\^&*+=\-\[\]\\'';,/{}|\\"":<>\?]/g.test(value);

        }, "Numbers and Special characters are not allowed");





        jQuery('input[type=radio][name=isregisteragent]').change(function() {

            if (this.value == 'no') {

                jQuery('.card-payment').show();

                // jQuery('.is-agent-form').hide();

            } else if (this.value == "yes") {

                jQuery('.card-payment').hide();

                jQuery('#addAffiliateCode').modal('show');

            }

        });

        jQuery('[data-toggle="popover"]').popover();

        jQuery('#checkoutexpirymonth,#checkoutexpiryyear').select2({

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

                var expirymonth = jQuery("#checkoutexpirymonth").val();

                var expiryyear = jQuery("#checkoutexpiryyear").val();



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

        var CVV = $("#checkoutcardcvv");

        CVV.payform('formatCardCVC');



    });

    document.getElementById('checkoutcardnumber').addEventListener('input', function(e) {

        var target = e.target,

            position = target.selectionEnd,

            length = target.value.length;



        target.value = target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();

        target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);

    });

    jQuery("#addAffiliateForm").validate({

        errorClass: 'validation-error',

        rules: {

            affiliate_code: {

                required: true,

                noSpace: true,

                noHTML: true,

                maxlength: 30,

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

        submitHandler: function(form) {

            // ajxLoader('show', 'body');

            jQuery('#affiliateSend').prop('disabled', true);

            form.submit();

        }

    });



    // START validation for payment checkout form

    jQuery("#cadPayment").validate({

        errorClass: 'validation-error',

        rules: {

            nameoncard: {

                required: true,

                noSpace: true,

                noHTML: true,

                lettersonly: true,

                specical_chars: true,

                maxlength: 30,

            },

            checkoutcardnumber: {

                required: true,

                validateCard: true

            },

            checkoutexpirymonth: {

                required: true,

                cstmcheckoutexpirymonth: true

            },

            checkoutexpiryyear: {

                required: true,

            },

            checkoutcardcvv: {

                required: true,

                validateCVV: true

            },

            checkoutaddress: {

                required: true,

                noSpace: true,

                special_chars: true,

                maxlength: 40,

            },

            checkoutcountry: {

                required: true,

                noSpace: true,

                noHTML: true,

                lettersonly: true,

                specical_chars: true,

                maxlength: 20,

            },

            checkoutcity: {

                required: true,

                noSpace: true,

                noHTML: true,

                lettersonly: true,

                specical_chars: true,

                maxlength: 20,

            },

            checkoutzipcode: {

                required: true,

                noSpace: true,

                noHTML: true,

                minlength: 5,

                maxlength: 10,

                alphanumeric: true

            },

            cancellation_policy: {

                required: true

            },

            privacy_policy: {

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

            },

            checkoutexpirymonth: {

                required: 'Please select card expiry month',

            },

            checkoutexpiryyear: {

                required: 'Please select card expiry year',

            },

            checkoutaddress: {

                required: 'Please enter address',

                maxlength: 'Please enter 40 characters only',

            },

            checkoutcardcvv: {

                required: 'Please enter CVV number',

            },

            checkoutcountry: {

                required: 'Please enter country name',

                maxlength: 'Please enter 20 digits only',

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

                minlength: 'Please enter minimum 5 digits',

                maxlength: 'Please enter 10 digits only',

            },

            'credit-card-needed': {

                required: 'Please accept this',

            },

            cancellation_policy: {

                required: 'Please accept our cancellation policy',

            },

            privacy_policy: {

                required: 'Please accept our privacy policy',

            }

        },

        highlight: function(element) {

            $(element).parent().addClass('has-error');

        },

        unhighlight: function(element) {

            $(element).parent().removeClass('has-error');

        },

        errorPlacement: function(error, element) {

            if (element.attr("name") == "checkoutcardnumber")

                error.insertAfter(".fieldset-checkoutcardnumber");

            else if (element.attr("name") == "nameoncard")

                error.insertAfter(".fieldset-nameoncard");

            else if (element.attr("name") == "checkoutexpirymonth")

                error.insertAfter(".fieldset-checkoutexpirymonth");

            else if (element.attr("name") == "checkoutexpiryyear")

                error.insertAfter(".fieldset-checkoutexpiryyear");

            else if (element.attr("name") == "checkoutcardcvv")

                error.insertAfter(".group-checkoutcardcvv");

            else if (element.attr("name") == "checkoutaddress")

                error.insertAfter(".fieldset-checkoutaddress");

            else if (element.attr("name") == "checkoutcountry")

                error.insertAfter(".fieldset-checkoutcountry");

            else if (element.attr("name") == "checkoutcity")

                error.insertAfter(".fieldset-checkoutcity");

            else if (element.attr("name") == "checkoutzipcode")

                error.insertAfter(".fieldset-checkoutzipcode");

            else if (element.attr("name") == "cancellation_policy")

                //error.insertAfter(".cancellation-policy");

                error.appendTo("#cancel_policy_err");

            else if (element.attr("name") == "privacy_policy")

                //error.insertAfter(".privacy-policy");

                error.appendTo("#privacy_policy_err");

            else if (element.attr("name") == "credit-card-needed")

                error.insertAfter(".your-card");

            else

                error.insertAfter(element);

        },

        submitHandler: function(form) {

            // ajxLoader('show', 'body');

            jQuery('.next-checkout').prop('disabled', true);

            form.submit();

        }

    });

    // END validation for payment checkout form



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

            // ajxLoader('show', 'body');

            // In this example, we're simply displaying the token

            // successElement.querySelector('.token').textContent = result.token.id;

            // successElement.classList.add('visible');

            var form = document.querySelector('form#cadPayment');

            jQuery('input[name="token"]').attr('value', result.token.id);

            form.submit();

            // ajxLoader('show', 'body');

            jQuery('.next-checkout').prop('disabled', true);

        } else if (result.error) {

            // console.log('error');

            // console.log(result.error);

            if (result.error.code == 'incomplete_number') {

                errorElement.textContent = result.error.message;

            }

            if (result.error.code == 'incomplete_expiry') {

                expirymonthyearerrorElement.textContent = result.error.message;

            }

            if (result.error.code == 'invalid_expiry_year_past') {

                expirymonthyearerrorElement.textContent = result.error.message;

            }

            if (result.error.code == 'incomplete_cvc') {

                cvverrorElement.textContent = result.error.message;

            }

            // errorElement.textContent = result.error.message;

            errorElement.classList.add('visible');

            expirymonthyearerrorElement.classList.add('visible');

            cvverrorElement.classList.add('visible');

            jQuery('.next-checkout').prop('disabled', false);

        }

    }



    // cardNumberElement.on('change', function(event) {

    //     setOutcome(event);

    // });

    // cardExpiryElement.on('change', function(event) {

    //     setOutcome(event);

    // });

    // cardCvcElement.on('change', function(event) {

    //     setOutcome(event);

    // });

    // jQuery(document).on('submit','form#cadPayment',function(e){

    //     e.preventDefault();

    //     var options = {

    //         email: document.getElementById('checkoutemail').value,

    //         // nameoncard: document.getElementById('name_on_card').value

    //     };

    //     jQuery('.next-checkout').prop('disabled',true);

    //     stripe.createToken(cardNumberElement, options).then(setOutcome);

    // });

    // document.querySelector('form').addEventListener('submit', function(e) {





    // });

    $(function() {



        // var owner = $('#owner');

        var cardNumber = $('#checkoutcardnumber');

        // var cardNumberField = $('#card-number-field');

        // var CVV = $("#checkoutcardcvv");

        // var mastercard = $("#mastercard");

        // var confirmButton = $('#confirm-purchase');

        // var visa = $("#visa");

        // var amex = $("#amex");



        // Use the payform library to format and validate

        // the payment fields.



        cardNumber.payform('formatCardNumber');

        // CVV.payform('formatCardCVC');





        // cardNumber.keyup(function(e) {

        // e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();

        //     amex.removeClass('transparent');

        //     visa.removeClass('transparent');

        //     mastercard.removeClass('transparent');



        //     if ($.payform.validateCardNumber(cardNumber.val()) == false) {

        //         cardNumberField.addClass('has-error');

        //     } else {

        //         cardNumberField.removeClass('has-error');

        //         cardNumberField.addClass('has-success');

        //     }



        //     if ($.payform.parseCardType(cardNumber.val()) == 'visa') {

        //         mastercard.addClass('transparent');

        //         amex.addClass('transparent');

        //     } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {

        //         mastercard.addClass('transparent');

        //         visa.addClass('transparent');

        //     } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {

        //         amex.addClass('transparent');

        //         visa.addClass('transparent');

        //     }

        // });



        // confirmButton.click(function(e) {



        //     e.preventDefault();



        //     var isCardValid = $.payform.validateCardNumber(cardNumber.val());

        //     var isCvvValid = $.payform.validateCardCVC(CVV.val());



        //     if(owner.val().length < 5){

        //         alert("Wrong owner name");

        //     } else if (!isCardValid) {

        //         alert("Wrong card number");

        //     } else if (!isCvvValid) {

        //         alert("Wrong CVV");

        //     } else {

        //         // Everything is correct. Add your form submission code here.

        //         alert("Everything is correct");

        //     }

        // });

    });



    jQuery("#checkoutexpirymonth,#checkoutexpiryyear").select2().change(function() {

        //console.log($("#tour_type").val());

        jQuery(this).valid();

    });
</script>