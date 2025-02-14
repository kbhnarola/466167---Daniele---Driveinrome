<div class="breadcrumb n-breadcrumb">

    <div class="container">

        <p><a href="<?= BASE_URL ?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<span class="title">Information</span></p>

    </div>

</div>

<?php

if (!empty($cart_products_name)) {

    // pr($cart_products_name);

    // pr($cart_products_variation_title);

    $counter = 0;

    foreach ($cart_products_name as $single_product_name) {

?>

        <script>
            jQuery(document).ready(function() {

                var get_single_product_name = '<?= $single_product_name ?>';

                var get_cart_products_variation_title = '<?= $cart_products_variation_title[$counter] ?>';

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

                        <form id="checkoutUserInfo" name="checkoutUserInfo" method="POST" action="<?= base_url('payment') ?>">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group field-group">

                                        <fieldset class="checkoutfirstname-fieldset">

                                            <legend>First Name</legend>

                                            <input type="text" class="form-control" id="checkoutfirstname" name="checkoutfirstname" value="<?= $this->session->userdata('checkoutfirstname') ?>" autocomplete="off">

                                        </fieldset>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group field-group">

                                        <fieldset class="checkoutlastname-fieldset">

                                            <legend>Last Name</legend>

                                            <input type="text" class="form-control" id="checkoutlastname" name="checkoutlastname" value="<?= $this->session->userdata('checkoutlastname') ?>" autocomplete="off">

                                        </fieldset>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group field-group">

                                        <fieldset class="checkoutemail-fieldset">

                                            <legend>Email</legend>

                                            <input type="text" class="form-control" id="checkoutemail" name="checkoutemail" value="<?= $this->session->userdata('checkoutemail') ?>" autocomplete="off">

                                        </fieldset>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group field-group">

                                        <fieldset class="checkoutconfirmemail-fieldset">

                                            <legend>Confirm Email</legend>

                                            <input type="text" class="form-control" id="checkoutconfirmemail" name="checkoutconfirmemail" value="<?= $this->session->userdata('checkoutemail') ?>" autocomplete="off">

                                        </fieldset>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group field-group">

                                        <fieldset class="checkoutneeds-fieldset">

                                            <legend>Special Needs</legend>

                                            <textarea class="form-control" rows="5" placeholder="When booking a transfer service please add your travelling information such us : Date , exact number of passengers , Airport , Port , Hotel , Name of ship , Flight number , Train number and any other necessary info we should know. Thanks" name="checkoutneeds"><?= $this->session->userdata('checkoutneeds') ?></textarea>

                                        </fieldset>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group field-group select2-popup">

                                        <fieldset class="checkoutfoundus-fieldset">

                                            <legend>Found Us</legend>

                                            <select class="form-control checkout-found-us" name="checkoutfoundus" id="checkoutfoundus">

                                                <option value="">--Select--</option>

                                                <option value="Travel Agent" <?= ($this->session->userdata('checkoutfoundus') == 'Travel Agent' ? 'selected="selected"' : '') ?>>Travel Agent</option>

                                                <option value="Friend Suggestion" <?= ($this->session->userdata('checkoutfoundus') == 'Friend Suggestion' ? 'selected="selected"' : '') ?>>Friend Suggestion</option>

                                                <option value="Internet Search" <?= ($this->session->userdata('checkoutfoundus') == 'Internet Search' ? 'selected="selected"' : '') ?>>Internet Search</option>

                                                <option value="I am a Previous Guest" <?= ($this->session->userdata('checkoutfoundus') == 'I am a Previous Guest' ? 'selected="selected"' : '') ?>>I am a Previous Guest</option>

                                                <option value="Tripadvisor" <?= ($this->session->userdata('checkoutfoundus') == 'Tripadvisor' ? 'selected="selected"' : '') ?>>Tripadvisor</option>

                                                <option value="Other" <?= ($this->session->userdata('checkoutfoundus') == 'Other' ? 'selected="selected"' : '') ?>>Other</option>

                                            </select>

                                        </fieldset>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group field-group">

                                        <div class="input-group">

                                            <fieldset class="checkouttravellingphone-fieldset">

                                                <legend>Phone Number While Travelling</legend>

                                                <input type="text" class="form-control" id="checkouttravellingphone" name="checkouttravellingphone" value="<?= $this->session->userdata('checkouttravellingphone') ?>" autocomplete="off">

                                            </fieldset>

                                            <button class="popover-button" type="button" data-toggle="popover" data-content="We ask for a phone number of someone in your party in case we need to reach you urgently once you’re on your trip. We’ll only call you in the event of real need." data-placement="bottom" data-original-title="" title=""><i class="fal fa-info-circle"></i></button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="button-wrap">

                                <a href="<?= base_url('summary'); ?>" class="btn btn btn-border">Previous Page</a>

                                <button type="submit" class="btn btn-blue next-checkout">Next</button>

                            </div>

                        </form>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="bg-shadow proceed-to-checkout order-summary">

                        <h4>Order Summary</h4>

                        <?php

                        if (!empty($this->cart->contents())) {

                            foreach ($this->cart->contents() as $product) {

                                $tour_extra_costs_array = $product['tours_detail_data']['tour_extra_cost'];

                                $total_extra_cost = $product['tours_detail_data']['toursData']['total_extra_cost'];

                                $total_tour_cost = $product['tours_detail_data']['toursData']['total_tour_cost'];
                                $tour_base_price = $product['tours_detail_data']['total_rate'];
                                $plus_symbol = '+';
                                if (array_key_exists("tours_detail_data", $product)) {

                        ?>

                                    <div class="summary-details">

                                        <h2>

                                            <?php echo $product['name'] ?>

                                        </h2>

                                        <h5 class="code-id">

                                            <span>Code : </span>

                                            <strong><?php echo $product['tours_detail_data']['toursData']['unique_code'] ?></strong>

                                        </h5>

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

                                        <p><i class="far fa-users"></i>Total Members :

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

                                        <!-- start to display tour upgrades cost -->

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

                                        <!-- end to display tour upgrades cost -->

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
                                        <!-- end to display extra cost -->

                                        <h3 class="price">

                                            <span class="currency-symbol">€</span>

                                            <span class="cart-totals"><?php echo price_format($product['price']); ?></span>

                                        </h3>

                                    </div>

                                <?php  } else {

                                    // $single_transfer_details = get_single_transfers_all_details_by_id($product['id'], array('1'));

                                    // if(!empty($single_transfer_details['id'])){                            

                                    //get variation title by variation option added in cart

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

                                            <i class="far fa-users"></i>Total Members :

                                            <span class="variation-title"><?= $product['options']['transfer_variation_title']; ?>

                                            </span> Person

                                        </p>

                                        <!-- start to display tour upgrades cost -->

                                        <?php

                                        if (is_array($product['tours_detail_data']['tour_upgrades']) && sizeof($product['tours_detail_data']['tour_upgrades']) > 0) {

                                            $tour_upgrades = $product['tours_detail_data']['tour_upgrades'];

                                            $extra_services_list = '';

                                            $extra_services = set_extra_services();



                                            foreach ($tour_upgrades as $key => $value) {



                                                if (array_key_exists($value, $extra_services)) {

                                                    $extra_services_list = $extra_services[$value] . ', ';
                                                }
                                            }

                                        ?>

                                            <p><i class="fal fa-money-bill"></i>Upgrades :

                                                <span class="variation-title">

                                                    <?php

                                                    echo trim($extra_services_list, ',') . ' (€ ' . price_format($product['tours_detail_data']['total_tour_upgrades_price']) . ')';

                                                    ?>

                                                </span>

                                            </p>

                                        <?php

                                        }

                                        ?>

                                        <!-- end to display tour upgrades cost -->

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

                                        <!-- end to display extra cost -->

                                        <h3 class="price"><span class="currency-symbol">€</span>

                                            <span class="cart-totals"><?= price_format($product['price']) ?></span>

                                        </h3>

                                    </div>

                        <?php

                                    // }

                                }
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

<script>
    jQuery.validator.addMethod("onlyNumber", function(value, element) {

        return this.optional(element) || /^([0-9--/]+)$/.test(value);

    }, "Only Numbers and Hypfens '-' are allowed.");

    jQuery(document).ready(function() {



        jQuery('.checkout-found-us').select2({

            minimumResultsForSearch: -1

        });

        jQuery('[data-toggle="popover"]').popover();

        // start validation for user information form

        jQuery("#checkoutUserInfo").validate({

            errorClass: 'validation-error',

            rules: {

                checkoutfirstname: {

                    required: true,

                    noSpace: true,

                    noHTML: true,

                    maxlength: 40,

                },

                checkoutlastname: {

                    required: true,

                    noSpace: true,

                    noHTML: true,

                    maxlength: 40,

                },

                checkoutemail: {

                    email: true,

                    required: true,

                    cstmEmail: true,

                },

                checkoutconfirmemail: {

                    required: true,

                    email: true,

                    equalTo: "#checkoutemail"

                },

                checkoutneeds: {

                    required: true,

                    noSpace: true,

                    special_chars: true,

                    maxlength: 200,

                },

                checkoutfoundus: {

                    required: true,

                },

                checkouttravellingphone: {

                    required: true,

                    noSpace: true,

                    //number: true,

                    onlyNumber: true,

                    maxlength: 15,

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

                    required: 'Please enter email',

                    email: 'Please enter valid email address'

                },

                checkoutconfirmemail: {

                    required: 'Please enter confirm email',

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

                    maxlength: 'Please enter no more than 15 digits',

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

                    // error.insertAfter(".popover-button");  

                    error.insertAfter(element.parent().parent('div'));

                else

                    error.insertAfter(element);

            }

        });

        // END validation for user information form

        jQuery("#checkoutfoundus").select2().change(function() {

            //console.log($("#tour_type").val());

            jQuery(this).valid();

        });

    });
</script>