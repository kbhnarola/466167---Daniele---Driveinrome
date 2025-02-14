<div class="breadcrumb n-breadcrumb">

  <div class="container">

    <p><a href="<?= BASE_URL ?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<span class="title"><?= $title ?></span></p>

  </div>

</div>



<?php

// pr($this->cart->contents(), 1);

if (!empty($cart_products_name)) {

  $counter = 0;

  foreach ($cart_products_name as $single_product_name) {

?>

    <script>
      jQuery(document).ready(function() {

        var get_single_product_name = "<?= $single_product_name ?>";

        //var get_cart_products_variation_title = '<?= $cart_products_variation_title[$counter] ?>';

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



$cart_total_items = $this

  ->cart

  ->total_items();



$cart_total = price_format($this

  ->cart

  ->total(), 2);

$is_hide_checkout = false;

$add_another_button_label = "Add Another Tour";

if ($cart_total_items == 0) {

  $is_hide_checkout = true;

  $add_another_button_label = "Add New Tour";
}

?>



<section class="pt-80 pb-80">

  <div class="container">

    <div class="wizzard-step">

      <ul>

        <li class="completed in-progress">

          <span class="circle"></span>

          Summary

        </li>

        <li>

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

      <h2 class="title">Your Order</h2>

      <div class="row">

        <div class="col-md-8">

          <p class="alert-msg"><strong>You have <span class="cart-total-items"><?= $cart_total_items ?></span> <?= ($cart_total_items > 1) ? 'items' : 'item' ?></span> in your cart</strong></p>

          <div class="order-info">

            <?php

            if (!empty($this->cart->contents())) {


              $cart_counter = 1;



              foreach ($this->cart->contents() as $product) {


                $transfer_or_tour = 'tours';

                // check is tranefr tour or simple tour

                if ($product['tours_detail_data']['toursData']['tour_type_id'] == 9 || $product['tours_detail_data']['toursData']['tour_type_id'] == 10) {

                  $transfer_or_tour = 'transfer';
                }

                // echo "<pre>";

                // print_r($product);

                // exit;

                if (array_key_exists("tours_detail_data", $product)) {

                  // echo "<pre>";
                  // print_r($product);
                  // die();

            ?>

                  <div class="order-item" data-parent-id="<?= base64_encode($product['rowid']) ?>">

                    <div class="order-img">

                      <div class="img-wrap">

                        <img src="<?php echo base_url('uploads/' . $product['tours_detail_data']['toursData']['feature_image']) ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';">

                      </div>

                    </div>

                    <div class="order-info">

                      <h4><?php echo $product['name'] ?></h4>

                      <h5 class="code-id"><span>Code : </span><strong><?php echo $product['tours_detail_data']['toursData']['unique_code']; ?></strong></h5>

                      <div class="row">

                        <div class="col-md-6">

                          <p><i class="far fa-clock"></i>Duration : <?php

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
                                                                    } ?></p>

                        </div>

                        <div class="col-md-6">

                          <p><i class="fas fa-map-marker-alt"></i>City : <?php echo $product['tours_detail_data']['toursData']['city'] ?></p>

                        </div>

                        <?php

                        //get variation title by variation option added in cart

                        // $variation="";

                        // if($product['tours_detail_data']['toursData']['tour_type_id']==1){

                        //       if($product['tours_detail_data']['total_passenger']<=2){

                        //           $variation="1-2";

                        //       } elseif($product['tours_detail_data']['total_passenger']<=4){

                        //          $variation="3-4";

                        //       } elseif($product['tours_detail_data']['total_passenger']<=6){

                        //          $variation="5-6";

                        //       } else {

                        //           $variation="7-8";

                        //       }

                        // } elseif ($product['tours_detail_data']['toursData']['tour_type_id']==3) {

                        //       if($product['tours_detail_data']['total_passenger']<=3){

                        //           $variation="1-3";

                        //       } elseif($product['tours_detail_data']['total_passenger']<=5){

                        //          $variation="4-5";

                        //       } else {

                        //           $variation="6-8";

                        //       }

                        // } else {

                        //      $variation=$product['tours_detail_data']['total_passenger'];

                        // }



                        ?>



                        <div class="col-md-6">

                          <p><i class="far fa-users"></i>Total Members : <span class="variation-title"><?php echo $product['tours_detail_data']['total_passenger']; ?></span><?php if ($product['tours_detail_data']['total_passenger'] > 1) {                                                                                               ' Persons';                                                                                                                                                                             } else {                                                                                                                                                                                ' Person';                                                                                                                                                                              } ?></p>

                        </div>

                        <div class="col-md-6">

                          <p><i class="fa fa-calendar-alt"></i>Date : <span class="variation-title"><?php echo date('d M Y', strtotime($product['tours_detail_data']['request_date'])); ?></span></p>

                        </div>

                        <?php

                        $tour_extra_costs_array = $product['tours_detail_data']['tour_extra_cost'];

                        $total_extra_cost = $product['tours_detail_data']['toursData']['total_extra_cost'];

                        $total_tour_cost = $product['tours_detail_data']['toursData']['total_tour_cost'];
                        $tour_base_price = $product['tours_detail_data']['total_rate'];
                        $plus_symbol = '+';

                        if (!empty($product['tours_detail_data']['tour_upgrades'])) {
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
                          <?php

                          }
                        }



                        if ($tour_extra_costs_array) {

                          ?>

                          <div class="col-md-12">

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

                          </div>



                        <?php

                        }

                        ?>
                        <div class="col-md-12">

                          <p><i class="fa fa-calculator" aria-hidden="true"></i>Total :

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
                                                    ?></b> + Base Price: <b>€<?php //echo price_format($tour_base_price)                                                                                                                          ?></b> + Upgrades: <b><?php //echo '€ ' . price_format($product['tours_detail_data']['total_tour_upgrades_price']);                                                                                                                                                                                             ?></b>) = <b>€<?php //echo price_format($product['price'])                                                                                ?></b> -->
                            </span>

                          </p>

                        </div>
                      </div>

                      <div class="action-btn">

                        <a href="<?php echo base_url($transfer_or_tour . '/' . $product['tours_detail_data']['toursData']['tour_slug'] . '/edit'); ?>" class="btn btn-blue"><i class="far fa-edit"></i>Edit</a>



                        <a href="#" class="btn-red cart-remove-product" data-id="<?= base64_encode($product['rowid']) ?>" data-toggle="modal" data-target="#removecartItem"><i class="fas fa-trash-alt"></i>Remove</a>



                        <div class="ml-auto price-wrapper">

                          <p class="text-right total-price"><strong><span class="currency-symbol">€</span><span class="cart-totals"><?php echo price_format($product['price']) ?></span></strong></p>

                        </div>

                      </div>

                    </div>

                    <input type="hidden" name="tourname" class="tourname" value="<?php echo $product['name']; ?>">



                    <input type="hidden" name="totalmember" class="totalmember" value="<?php echo $product['tours_detail_data']['total_passenger']; ?>">

                  </div>



            <?php

                }
              }
            }

            ?>



          </div>



          <div class="custom-form">

            <p class="text-right total-price cart-total-wrapper">Total Price :<strong><span class="currency-symbol-big">€</span><span class="cart-totals"><?= $cart_total ?></span></strong></p>

            <div class="button-wrap">

              <a href="<?= BASE_URL?>" class="btn btn btn-border"><?= $add_another_button_label ?></a>

              <?php

              if (!$is_hide_checkout) {

              ?>

                <a href="<?= base_url('information'); ?>" class="btn btn btn-blue cstm-proceed-checkout">Checkout</a>

              <?php

              }

              ?>

            </div>

          </div>

        </div>

        <div class="col-md-4">

          <div class="bg-shadow proceed-to-checkout cart-total-wrapper">

            <div class="total-price">

              <label>Total Price :</label><strong><span class="currency-symbol-big">€</span><span class="cart-totals"><?= $cart_total  ?></span></strong>

            </div>

            <div class="pd-30">

              <?php

              if (!$is_hide_checkout) {

              ?>

                <a href="<?= base_url('information'); ?>" class="btn btn-blue cstm-proceed-checkout">Proceed to Checkout</a>

              <?php

              }

              ?>

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



<!-- cart item product confirmation -->







<div id="removecartItem" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-body">

        <div class="modal-content-wrap">

          <h4 class="modal-title text-center">Remove</h4>

        </div>

        <p class="remove-cart-msg">Are you sure you want to remove "<span class="deleting-product-name"></span>" for "<span class="deleting-product-variation"></span>" variation?</p>

        <div class="modal-form">

          <button type="button" class="btn btn-border" data-dismiss="modal">No</button>

          <button type="button" class="btn btn-blue confirm-remove-product" data-id="">Yes</button>

        </div>

      </div>

    </div>

  </div>

</div>



<div id="successcartItemRemove" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-body">

        <div class="modal-content-wrap">

          <h4 class="modal-title text-center">Success!</h4>

        </div>

        <p class="sucees-remove-cart-msg">Product "<span class="removed-product-name"></span>" for "<span class="removed-product-variation"></span>" variation?</p>

        <div class="modal-form">

          <button type="button" class="btn btn-blue" data-dismiss="modal">Ok</button>

        </div>

      </div>

    </div>

  </div>

</div>



<div id="updateCartItem" class="modal fade update-cart" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-body">

        <div class="modal-content-wrap">

          <h4 class="modal-title text-center">Update cart</h4>

        </div>

        <div class="transfer-item">

          <div class="text-content left-update">

            <h4>Service Test1</h4>

            <h5 class="code-id"><span>Code : </span><strong>JH78678Y</strong></h5>

            <div class="div-wrap">

              <div class="row">

                <div class="col-md-6">

                  <p><i class="far fa-clock"></i>Duration : <span class="tour-duration-modal">5</span></p>

                </div>

                <div class="col-md-6">

                  <p><i class="fas fa-map-marker-alt"></i>City : <span class="tour-city-modal">Ephesus</span></p>

                </div>

                <div class="col-md-12">

                  <p><i class="far fa-users"></i>Total Members : <span class="tour-member-modal">1-3</span>&nbspPerson</p>

                </div>

              </div>

            </div>

          </div>

          <div class="pricing-section right-update">

            <form id="transferVariationPriceJH78678Y" name="transferVariationPrice" method="POST" onsubmit="return preventFormSubmit(event)" novalidate="novalidate" data-id="5">

              <div class="select-person">

                <div class="custom-radio">

                  1-3 person

                  <input type="radio" name="transfer-price-plan" value="100" data-id="5" data-code="JH78678Y" data-variation="1" class="transfer-price-plan-one">

                  <span class="checkmark"></span>

                </div>

                <div class="custom-radio">

                  4-5 person

                  <input type="radio" name="transfer-price-plan" value="200" data-id="5" data-code="JH78678Y" data-variation="2" class="transfer-price-plan-two">

                  <span class="checkmark"></span>

                </div>

                <div class="custom-radio">

                  6-8 person

                  <input type="radio" name="transfer-price-plan" value="300" data-id="5" data-code="JH78678Y" data-variation="3" class="transfer-price-plan-three">

                  <span class="checkmark"></span>

                </div>

              </div>

            </form>

            <div class="price">

              <h5 class="trans-variation-price"><span class="currency-symbol-big">€</span><span class="variation-price">100</span></h5>

              <button type="button" class="btn btn btn-border" data-dismiss="modal">cancel</button>

              <button type="button" class="btn btn-blue btn-update-cart">Update Cart</button>

            </div>

          </div>

        </div>

        <!-- <p>Thank you for your request. You will receive an email from our agent shortly.</p> -->

      </div>

    </div>

  </div>

</div>

<script>
  jQuery('.custom-radio input[type="radio"]').change(function() {



    if (jQuery(this).is(":checked")) {



      jQuery(this).parents('form').next().find('.variation-price').text(jQuery(this).val());



    }



  });



  jQuery('.update-cart-product').click(function(e) {



    jQuery('.left-update h4').text(jQuery(this).closest('.order-item').find('.tourname').val());

    jQuery('.left-update .code-id strong').text(jQuery(this).closest('.order-item').find('.tourcode').val());

    jQuery('.left-update span.tour-duration-modal').text(jQuery(this).closest('.order-item').find('.tourduration').val());

    jQuery('.left-update span.tour-member-modal').text(jQuery(this).closest('.order-item').find('.totalmember').val());

    jQuery('.left-update span.tour-city-modal').text(jQuery(this).closest('.order-item').find('.tourcity').val());

    jQuery('.right-update .transfer-price-plan-one').val(jQuery(this).closest('.order-item').find('.firstvariation').val());

    jQuery('.right-update .transfer-price-plan-two').val(jQuery(this).closest('.order-item').find('.secondvariation').val());

    jQuery('.right-update .transfer-price-plan-three').val(jQuery(this).closest('.order-item').find('.thirdvariation').val());

    jQuery('.right-update .variation-price').text(jQuery(this).attr('data-price'));



    // get clicked data-variation



    var data_variation = jQuery(this).attr('data-variation');

    jQuery('input[name=transfer-price-plan]').attr('checked', false);

    jQuery('input[name=transfer-price-plan][data-variation="' + data_variation + '"]').prop("checked", true).trigger("click");



    // set data in confirm update cart button



    jQuery('.btn-update-cart').attr('data-id', jQuery(this).attr('data-id'));

    jQuery('.btn-update-cart').attr('data-cart', jQuery(this).attr('data-cart'));

    jQuery('.btn-update-cart').attr('data-name', jQuery(this).attr('data-name'));



  });



  jQuery("#updateCartItem").on("hidden.bs.modal", function() {

    jQuery('input[name=transfer-price-plan]').attr('checked', false);

  });



  jQuery('.cart-remove-product').click(function(e) {



    var tourname = jQuery(this).closest('.order-item').find('.tourname').val();

    var totalmember = jQuery(this).closest('.order-item').find('.totalmember').val() + ' Person';



    jQuery('.remove-cart-msg .deleting-product-name').text(tourname);

    jQuery('.remove-cart-msg .deleting-product-variation').text(totalmember);

    jQuery('.confirm-remove-product').attr('data-id', jQuery(this).attr('data-id'));

    jQuery('.confirm-remove-product').attr('data-name', tourname);

    jQuery('.confirm-remove-product').attr('data-variation', totalmember);



  });



  // confirm delete cart product



  jQuery('.confirm-remove-product').click(function(e) {



    var data_id = jQuery(this).attr('data-id');

    var data_name = jQuery(this).attr('data-name');

    var data_variation = jQuery(this).attr('data-variation');



    var form_data = {

      'data_id': data_id

    };



    ajxLoader('show', 'body');

    jQuery.ajax({

      url: BASE_URL + "web/summary/remove_product_from_cart",

      method: 'POST',

      dataType: "JSON",

      data: form_data,

      success: function(data) {

        if (data.is_product_remove) {

          if (data.cart_total_items == 0) {

            jQuery('.cstm-proceed-checkout').remove();

          }

          jQuery('div[data-parent-id="' + data_id + '"]').remove();

          jQuery('.cart-total-wrapper .cart-totals').text(data.cart_total);

          jQuery('.cart-total-items').text(data.cart_total_items);

          toastrAlert('Product "' + data_name + '" for "' + data_variation + '" has been removed from your cart!', 'success');

        } else {

          toastrAlert('Getting error while removing "' + data_name + '" for "' + data_variation + '" product from cart!', 'error');

        }

        // jQuery('.cstm-modal-content').text(modal_content);        

        ajxLoader('hide', 'body');

        jQuery('#removecartItem').modal('hide');

      }



    });



  });



  // confirm update cart product



  jQuery('.btn-update-cart').click(function(e) {



    var data_id = jQuery(this).attr('data-id');

    var data_cart_row_id = jQuery(this).attr('data-cart');

    var selected_variation = jQuery('input[name="transfer-price-plan"]:checked').attr("data-variation");

    var data_name = jQuery(this).attr('data-name');

    var form_data = {

      'data_id': data_id,

      'selected_variation': selected_variation,

      'data_cart_row_id': data_cart_row_id

    };



    ajxLoader('show', 'body');

    jQuery.ajax({

      url: BASE_URL + "web/summary/update_cart_item",

      method: 'POST',

      dataType: "JSON",

      data: form_data,

      success: function(data) {

        if (data.is_product_update) {

          jQuery('.cart-total-wrapper .cart-totals').text(data.cart_total);

          jQuery('.update-cart-product[data-cart="' + data_cart_row_id + '"]').attr('data-variation', selected_variation);

          jQuery('.update-cart-product[data-cart="' + data_cart_row_id + '"]').attr('data-price', data.variation_price);

          jQuery('div[data-parent-id="' + data_cart_row_id + '"]').find('.variation-title').text(data.variation_title);

          jQuery('div[data-parent-id="' + data_cart_row_id + '"]').find('.price-wrapper .cart-totals').text(data.variation_price);

          toastrAlert('Cart product "' + data.product_name + '" for "' + data.variation_title + '" has been updated!', 'success');

        } else if (!data.is_product_update && data.is_product_exist) {

          toastrAlert('Product "' + data.product_name + '" for "' + data.variation_title + ' Person" is already exist in cart!', 'error');

        } else {

          toastrAlert('Getting error while updating "' + data_name + '" product in cart, may be product no longer available!', 'error');

        }

        jQuery('#updateCartItem').modal('hide');

        ajxLoader('hide', 'body');



      }



    });



  });
</script>