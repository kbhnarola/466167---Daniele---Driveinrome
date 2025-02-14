<?php

$transfer_category_feature_image = (!empty($transfer_details[0]['transfer_category_feature_image'])) ? $transfer_details[0]['transfer_category_feature_image'] : 'N/A';

// get_variation_prices();

?>

<section class="page-title-section single-transfer">

      <div class="image-wrap">

        <img src="<?=BASE_URL?>uploads/transfer_city/<?=$transfer_category_feature_image?>"  onerror="this.src='<?=DEFAULT_IMAGE?>/banner_default.png';" alt="Trasfer banner">

      <!-- <h1><?php //echo $title;?></h1> -->

    </div>

    <div class="breadcrumb">

      <div class="container">

        <p><a href="<?=BASE_URL?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<a href="javascript:" class="b_crum"><?=$transfer_details_type?></a>&nbsp&nbsp/&nbsp&nbsp<span class="title"><?=$title?></span></p>        

      </div>

    </div>

  </section>

<section class="text-section">

    <div class="container">

      <h2 class="title">Transfers</h2>

      <div class="text">

        <p>Avoid the hassles and risks of getting a taxi when you arrive by air or by train!  We provide all kinds of transfers with every size of vehicle.</p>

        <p>With a pre-arranged transfer (also with the option of pre-payment) you won’t have to worry about finding the taxi stand, waiting in long lines, or being taken for a ride (in the figurative sense). </p>

        <p>In the Rome area we service both Fiumicino and Ciampiano airports, but we can arrange transfers from other major Italian airports as well.  At Fiumicino airport the meeting point is right outside baggage claim for maximum convenience.</p>

        <p>If you’re arriving Rome by train we can fetch you from Roma Termini as well as any other metropolitan Rome train station.  Your driver will meet you at the end of the train platform, facilissimo!</p>

      </div>

    </div>

  </section>

  <section class="transfer-section">

    <div class="container">

        <?php

        if(!empty($transfer_details)){

          // pr($transfer_details);die;

            foreach($transfer_details as $single_transfer_detail){

                ?>

                <div class="transfer-item">

                    <div class="image-wrap">

                        <img src="<?php echo base_url('uploads/'.$single_transfer_detail['transfer_feature_image'])?>" onerror="this.src='<?=DEFAULT_IMAGE?>/transfers_default.png';" alt="Trasfer">

                    </div>

                    <div class="text-content">

                        <?php

                            $get_start_ratings = get_star_ratings($single_transfer_detail['ratings']);

                            echo $get_start_ratings;

                        ?>

                        <h5 class="code-id"><span>Code : </span><strong><?=$single_transfer_detail['unique_code']?></strong></h5>

                        <h4><?=$single_transfer_detail['transfer_title']?></h4>

                        <p><?=$single_transfer_detail['transfer_description']?></p>

                        <div class="div-wrap div_warp1">

                            <p><i class="far fa-clock"></i>Duration : <?=($single_transfer_detail['duration'] > 1) ? $single_transfer_detail['duration'].' Hours' : $single_transfer_detail['duration'] . ' Hour'?></p>                            

                            <p><i class="fas fa-map-marker-alt"></i>City : <?=$single_transfer_detail['transfer_category_title']?></p>                            

                        </div>

                    </div>

                    <div class="pricing-section">

                      <?php

                      $transfer_variations = array('');

                      $get_variation_prices_for_transfer = array('');

                      if($single_transfer_detail['transfer_type_table_id'] == 1){

                        $transfer_variations = array('1', '2', '3');

                      }

                      $get_variation_prices_for_transfer = get_variation_prices_for_transfers($single_transfer_detail['transfer_id'], $transfer_variations, $single_transfer_detail['transfer_type_table_id']);

                      // echo $single_transfer_detail['transfer_id'] . $single_transfer_detail['transfer_type_table_id'];

                      // pr($get_variation_prices_for_transfer);die;

                      $variation_prices = $get_variation_prices_for_transfer['price'];

                      $variation_lable = $get_variation_prices_for_transfer['variation_lable'];

                      $prices_array = explode (", ", $variation_prices);  

                      $variation_title_array = explode (", ", $variation_lable); 

                      // print_r($prices_array); die;

                      ?>

                      <form id="transferVariationPrice<?=$single_transfer_detail['unique_code']?>" name="transferVariationPrice" method="POST" onsubmit="return preventFormSubmit(event)" novalidate="novalidate" data-id=<?=$single_transfer_detail['transfer_id']?>>

                        

                        <div class="select-person">

                          <?php

                          $counter = 0;

                          $first_transfer_variation_price = 0;

                          if(is_array($prices_array) && !empty($prices_array)){

                            foreach($prices_array as $single_price){

                              if($counter == 0){

                                  $first_transfer_variation_price = $single_price;

                              }

                              ?>

                              <div class="custom-radio">

                                <?=$variation_title_array[$counter]?> person

                                <input type="radio" name="transfer-price-plan" <?=($counter == 0) ?"checked='checked'" : ""?> value="<?=price_format($single_price)?>" data-id=<?=$single_transfer_detail['transfer_id']?> data-code=<?=$single_transfer_detail['unique_code']?> data-variation="<?=$transfer_variations[$counter]?>" class="transfer-price-plan" data-person="<?=$variation_title_array[$counter]?>">

                                <span class="checkmark"></span>

                              </div>

                              <?php

                              $counter++;

                            }

                          }

                          ?>

                        </div>

                        <input type="hidden" name="transfer_name" value="<?=$single_transfer_detail['transfer_title']?>" class="transfer_name">

                        <input type="hidden" name="transfer_price" value="<?=price_format($first_transfer_variation_price)?>" class="transfer_price">

                        <input type="hidden" name="total_person" value="<?=$variation_title_array[0]?>" class="total_person">

                        <input type="hidden" name="breadcrumb_title" value="<?=$title?>" class="breadcrumb_title">

                        <input type="hidden" name="featured" value="<?=$single_transfer_detail['transfer_feature_image']?>" class="featured">

                        <input type="hidden" name="transfer_md" value="<?=base64_encode($single_transfer_detail['transfer_id'])?>" class="transfer_md">

                      

                        <div class="price">

                            <h5 class="trans-variation-price"><span class="currency-symbol-big">€</span><span class="variation-price"><?=price_format($first_transfer_variation_price)?></span></h5>

                            <button type="submit" class="btn btn-blue transfer-add-to-cart" data-id=<?=$single_transfer_detail['transfer_id']?> data-code=<?=$single_transfer_detail['unique_code']?>>Add to Cart</button>   

                            <button name="send_me_transfer_quote" type="submit" class="btn btn-yellow send_me_transfer_quote">Email me Quote</button>                     

                        </div>                      

                      </form>

                    </div>

                </div>

                <?php

            }

        }else{

            ?>

            <div class="not-found">

                <h2>No Transfers found in '<?=$title?>'  city</h2>

            </div>

            <?php

        }

        ?>        

    </div>

  </section>

<!-- // thank you modal -->



<div id="transaddtocartmodal" class="modal fade" data-backdrop="static" role="dialog" tabindex="-1" style="display: none !important;" aria-hidden="true">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-body">

        <div class="modal-content-wrap">

          <img src="<?=EMAIL_WELCOME_PNG?>" alt="Smile Expression" class="smile-popup">

          <img src="<?=EMAIL_OOPS_PNG?>" alt="Oops Expression" class="oops-popup">

          <h4 class="modal-title text-center cstm-modal-title"></h4>

        </div>

        <p class="cstm-modal-content"></p>

        <div class="modal-form">

          <!-- <button type="button" class="btn btn-yellow mt-3" data-dismiss="modal">Ok</button> -->

          <a href="<?php echo base_url().'summary';?>" class="btn btn-yellow mt-3 cart_success_url" >Ok</a>

        </div>

      </div>

    </div>

  </div>

</div>

<script>

jQuery('.custom-radio input[type="radio"]').change(function() {

  if(jQuery(this).is(":checked")) {      

    jQuery(this).parents('form').find('.variation-price').text(jQuery(this).val());    

    jQuery(this).parents('form').find('.transfer_price').val(jQuery(this).val());

    jQuery(this).parents('form').find('.total_person').val(jQuery(this).data('person'));

  }  

});

jQuery(".send_me_transfer_quote").click(function(){

    jQuery(this).parents('form').removeAttr('onsubmit');

    jQuery(this).parents('form').attr('action',BASE_URL+'send-me-transfer-quote');

});

// ajxLoader('show', 'body');

jQuery('.transfer-add-to-cart').click(function(e){

    e.preventDefault();

    var get_data_id = jQuery(this).attr("data-id");

    var get_data_code = jQuery(this).attr("data-code");

    var get_data_variaton = jQuery("#transferVariationPrice" + get_data_code + " input[name='transfer-price-plan']:checked").attr('data-variation');

    var form_data = {

      'data_id': get_data_id,

      'data_code': get_data_code,

      'data_variaton': get_data_variaton,

    };

    ajxLoader('show', 'body'); 

    jQuery.ajax({

    url: BASE_URL + "web/Transfers/add_to_cart_transfer",

    type: 'POST',

    dataType: "JSON",

    data: form_data,

        success: function(data) {           

            // console.log('Hello', data[0].produdt_title);

            if (data.length > 0) {

              var modal_content = '';

              if(data[0].is_exist == 'no'){

                  jQuery('.cstm-modal-title').text('Thanks you!');

                  modal_content = 'Your Product "' + data[0].produdt_title + '" for "' + data[0].variation_title + ' Person" successfully added to your cart!';     

                  jQuery('.smile-popup').css('display', 'inline-block');

                  jQuery('.oops-popup').css('display', 'none');

                  jQuery('.cart_success_url').attr('href',BASE_URL+'summary');

              }else if(data[0].is_exist == 'yes'){

                  jQuery('.cstm-modal-title').text('Oops!');

                  modal_content = 'Product "' + data[0].produdt_title + '" for "' + data[0].variation_title + ' Person" already exist in your cart!';

                  jQuery('.smile-popup').css('display', 'none');

                  jQuery('.oops-popup').css('display', 'inline-block');

                  jQuery('.cart_success_url').attr('href','javascript:');

              }              

            } else {

                jQuery('.cstm-modal-title').text('Oops!');

                modal_content = 'Getting error while adding product, may be product no longer available!';

                jQuery('.smile-popup').css('display', 'none');

                jQuery('.oops-popup').css('display', 'inline-block');

                jQuery('.cart_success_url').attr('href','javascript:');

            }

            jQuery('.cstm-modal-content').text(modal_content);

            jQuery('#transaddtocartmodal').modal('show');

            ajxLoader('hide', 'body');                



        },

    });

});



</script>