<?php
$toursData = $this->session->userdata('tours_data');
// echo '<pre>';
// print_r($toursData);
// exit;
?>
<div class="breadcrumb n-breadcrumb">
  <div class="container">
    <p><a href="<?= BASE_URL ?>">Home</a>&nbsp&nbsp/&nbsp&nbsp
      <?php
      $is_tour = true;
      if ($toursData['toursData']['tour_type_id'] == 1 || $toursData['toursData']['tour_type_id'] == 7) {
      ?>
        <a href="javascript:" class="b_crum">Shore Excursions</a>
      <?php
      } elseif ($toursData['toursData']['tour_type_id'] == 8) {
      ?>
        <a href="javascript:" class="b_crum">Package Tours</a>
      <?php
      } elseif ($toursData['toursData']['tour_type_id'] == 9 || $toursData['toursData']['tour_type_id'] == 10) {
        $is_tour = false;
      ?>
        <a href="javascript:" class="b_crum">Transfer Tours</a>
      <?php
      } else {
      ?>
        <a href="javascript:" class="b_crum">City Tours</a>
      <?php
      }
      ?>
      &nbsp&nbsp/&nbsp&nbsp
      <a href="<?php echo base_url(($is_tour) ? 'tours' : 'transfer' . '/' . $toursData['toursData']['tour_slug']); ?>"><?php echo $toursData['toursData']['title']; ?></a>&nbsp&nbsp/&nbsp&nbsp<span class="title"><?php echo ($is_tour) ? 'Tour Upgrades' : 'Transfer Tour Upgrades' ?></span>
    </p>
  </div>
</div>

<section class="upgrades-section pt-80 pb-80">
  <div class="container">
    <h2 class="title">Upgrades Available</h2>
    <div class="row">
      <div class="col-md-8">
        <div class="custom-form">
          <form method="post" id="addTourUpgrades" action="<?php echo base_url('add_tour_upgrades'); ?>">
            <?php
            // echo "<pre>";
            // print_r($this->cart->contents());
            // exit;
            $tour_upgrades_cart = array();
            $tour_upgrades_price = "";
            $tour_upgrades_passenger_detail = array();
            $total_passenger = "";
            if ($this->cart->total_items() > 0) {
              $cart_content = $this->cart->contents();
              // pr($cart_content, 1);
              foreach ($cart_content as $value) {
                if ($value['id'] == $toursData['toursData']['tour_id']) {
                  if (isset($value['tours_detail_data']['tour_upgrades'])) {
                    $tour_upgrades_cart = $value['tours_detail_data']['tour_upgrades'];
                    $tour_upgrades_price = $value['tours_detail_data']['total_tour_upgrades_price'];
                    $tour_upgrades_passenger_detail = $value['tours_detail_data']['tour_upgrades_passenger_detail'];
                  }

                  $total_passenger = $value['tours_detail_data']['total_passenger'];
                }
              }
            }
            // pr($tour_upgrades_passenger_detail, 1);
            ?>
            <ul class="license-checklist">
              <?php
              $extra_service_price = "";
              if ($toursData['toursData']['extra_services_id']) {
                $ex_services = explode(",", $toursData['toursData']['extra_services_id']);
                $extra_service_array = get_extra_services();
                $vat_ticket = array();
                $c = 0;
                foreach ($extra_service_array as $key => $value) {
                  if ($value['id'] == 16) {
                    $vat_ticket[] = $value;
                    unset($extra_service_array[$key]);
                    $c++;
                    break;
                  }
                }

                if ($c > 0) {
                  if (is_array($vat_ticket) && sizeof($vat_ticket) > 0) {
                    $extra_service_array[] = $vat_ticket[0];
                  }
                }
                foreach ($extra_service_array as $ex) {
                  if (in_array($ex['id'], $ex_services)) {
              ?>
                    <li>
                      <div class="custom-checkbox">
                        <?php echo $ex['title']; ?>
                        <input type="checkbox" name="tour_upgrades[]" class="select_tour_upgrades" value="<?php echo $ex['id']; ?>" <?php if (in_array($ex['id'], $tour_upgrades_cart)) {
                                                                                                                                      echo "checked";
                                                                                                                                    } ?> data-id="<?php echo $ex['id']; ?>">
                        <span class="checkmark"></span>
                        <input type="hidden" name="tour_rate_opt<?php echo $ex['id']; ?>" id="tour_rate_opt<?php echo $ex['id']; ?>" value="<?php echo $ex['rate_opt']; ?>" disabled>
                        <input type="hidden" name="tour_upgrade_rate<?php echo $ex['id']; ?>" id="tour_upgrade_rate<?php echo $ex['id']; ?>" value="<?php echo $ex['price']; ?>" disabled>
                        <input type="hidden" name="tour_upgrade_custom_rate<?php echo $ex['id']; ?>" id="tour_upgrade_custom_rate<?php echo $ex['id']; ?>" value='<?php echo $ex['person_custom_rate']; ?>' disabled>
                        <input type="hidden" name="tour_upgrade_rate_opt<?php echo $ex['id']; ?>" id="tour_upgrade_rate_opt<?php echo $ex['id']; ?>" value='<?php echo $ex['rate_opt']; ?>' disabled>

                      </div>
                      <?php if ($ex['description']) { ?>
                        <button class="popover-button" type="button" data-toggle="popover" data-content="<?php echo $ex['description']; ?>" data-placement="bottom"><i class="fal fa-info-circle"></i></button>
                      <?php } ?>
                    </li>
                    <div class="col-md-12">
                      <div class="copy-details-wrapper tour-upgrade-<?php echo $ex['id'] ?>">
                      </div>
                    </div>
                    <div class="col-md-12 mt-2" id="person_info<?php echo $ex['id']; ?>">
                      <?php
                      if (in_array($ex['id'], $tour_upgrades_cart)) {
                        // check for vatican ticket
                        if ($ex['rate_opt'] == 1 && $ex['id'] == 16) {
                          if ($total_passenger > 0) {
                            for ($i = 0; $i < $total_passenger; $i++) {
                              if ($i == 0) { ?>
                                <label>Passenger <?php echo $i + 1; ?>:</label>
                                <div class="row">
                                  <div class="col-md-6 field-group">
                                    <div class="form-group">
                                      <fieldset>
                                        <legend>First Name</legend>
                                        <input type="text" class="form-control fname_tour_up fieldset_element" name="first_name[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" data-id="<?php echo $ex['id']; ?>" autocomplete="off" value="<?php echo $tour_upgrades_passenger_detail['first_name'][$ex['id']][$i]; ?>">
                                      </fieldset>
                                    </div>
                                  </div>
                                  <div class="col-md-6 field-group">
                                    <div class="form-group">
                                      <fieldset>
                                        <legend>Last Name</legend>
                                        <input type="text" class="form-control lname_tour_up fieldset_element" name="last_name[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" autocomplete="off" data-id="<?php echo $ex['id']; ?>" value="<?php echo $tour_upgrades_passenger_detail['last_name'][$ex['id']][$i]; ?>">
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label>Date Of Birth</label>
                                      <div class="input-group datepicker_tour ">
                                        <input type="text" name="birth_date[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" class="form-control birth_datepicker birth_date fieldset_element" autocomplete="off" data-id="<?php echo $ex['id']; ?>" value="<?php echo $tour_upgrades_passenger_detail['birth_date'][$ex['id']][$i]; ?>" id="<?php echo $ex['id'] . $i; ?>">
                                        <?php
                                        if ($tour_upgrades_passenger_detail['birth_date'][$ex['id']][$i]) {
                                          $up_date = date('d-m-Y', strtotime($tour_upgrades_passenger_detail['birth_date'][$ex['id']][$i]));
                                        } else {
                                          $up_date = date('d-m-Y');
                                        } ?>
                                        <input type="hidden" name="date_p<?php echo $ex['id'] . $i; ?>" id="date_p<?php echo $ex['id'] . $i; ?>" value="<?php echo $up_date; ?>">
                                        <div class="input-group-addon"> <i class="fas fa-calendar-alt btnPicker" data-picker="<?php echo $i; ?>" data-upgrade-id="<?php echo $ex['id']; ?>"></i></div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 field-group mt-20">
                                      <fieldset>
                                        <legend>Birth Place</legend>
                                        <input type="text" class="form-control birth_place fieldset_element" name="birth_place[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" autocomplete="off" data-id="<?php echo $ex['id']; ?>" value="<?php echo $tour_upgrades_passenger_detail['birth_place'][$ex['id']][$i]; ?>">
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                              <?php } else { ?>
                                <label>Passenger <?php echo $i + 1; ?>:</label>
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-md-4 field-group">
                                      <div class="form-group">
                                        <fieldset>
                                          <legend>First Name</legend>
                                          <input type="text" class="form-control fname_tour_up fieldset_element " name="first_name[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" data-id="<?php echo $ex['id']; ?>" autocomplete="off" value="<?php echo $tour_upgrades_passenger_detail['first_name'][$ex['id']][$i]; ?>">
                                        </fieldset>
                                      </div>
                                    </div>
                                    <div class="col-md-4 field-group">
                                      <div class="form-group">
                                        <fieldset>
                                          <legend>Last Name</legend>
                                          <input type="text" class="form-control lname_tour_up fieldset_element " name="last_name[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" autocomplete="off" data-id="<?php echo $ex['id']; ?>" value="<?php echo $tour_upgrades_passenger_detail['last_name'][$ex['id']][$i]; ?>">
                                        </fieldset>
                                      </div>
                                    </div>
                                    <div class="col-md-4 field-group">
                                      <div class="form-group">
                                        <fieldset>
                                          <legend>Age</legend>
                                          <input type="text" name="pass_age[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" class="form-control age_tour_up fieldset_element " autocomplete="off" data-id="<?php echo $ex['id']; ?>" value="<?php echo $tour_upgrades_passenger_detail['age'][$ex['id']][$i]; ?>">
                                        </fieldset>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php }
                            }
                          }
                        }
                        // check for coloseum ticket
                        // pr($tour_upgrades_passenger_detail, 1);
                        if ($ex['rate_opt'] == 1 && $ex['id'] == 17) {
                          if ($total_passenger > 0) {
                            for ($i = 0; $i < $total_passenger; $i++) {
                              // die($tour_upgrades_passenger_detail['colo_birth_date'][$ex['id']][$i]);
                              if ($i == 0) {
                              ?>
                                <label>Passenger <?php echo $i + 1; ?>:</label>
                                <div class="row">
                                  <div class="col-md-6 field-group">
                                    <div class="form-group">
                                      <fieldset>
                                        <legend>First Name</legend>
                                        <input type="text" class="form-control colo_fname_tour_up fieldset_element " name="colo_first_name[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" data-id="<?php echo $ex['id']; ?>" autocomplete="off" value="<?php echo $tour_upgrades_passenger_detail['colo_first_name'][$ex['id']][$i]; ?>">
                                      </fieldset>
                                    </div>
                                  </div>
                                  <div class="col-md-6 field-group">
                                    <div class="form-group">
                                      <fieldset>
                                        <legend>Last Name</legend>
                                        <input type="text" class="form-control colo_lname_tour_up fieldset_element " name="colo_last_name[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" autocomplete="off" data-id="<?php echo $ex['id']; ?>" value="<?php echo $tour_upgrades_passenger_detail['colo_last_name'][$ex['id']][$i]; ?>">
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Date Of Birth</label>
                                      <div class="input-group datepicker_tour ">
                                        <input type="text" name="colo_birth_date[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" class="form-control birth_datepicker colo_b_date  fieldset_element" autocomplete="off" data-id="<?php echo $ex['id']; ?>" value="<?php echo $tour_upgrades_passenger_detail['colo_birth_date'][$ex['id']][$i]; ?>" id="<?php echo $ex['id'] . $i; ?>">
                                        <?php
                                        if ($tour_upgrades_passenger_detail['colo_birth_date'][$ex['id']][$i]) {
                                          $up_date = date('d-m-Y', strtotime($tour_upgrades_passenger_detail['colo_birth_date'][$ex['id']][$i]));
                                        } else {
                                          $up_date = date('d-m-Y');
                                        } ?>
                                        <input type="hidden" name="date_p<?php echo $ex['id'] . $i; ?>" id="colo_date_p<?php echo $ex['id'] . $i; ?>" value="<?php echo $up_date; ?>">
                                        <div class="input-group-addon"> <i class="fas fa-calendar-alt btnPicker" data-picker="<?php echo $i; ?>" data-upgrade-id="<?php echo $ex['id']; ?>"></i></div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 field-group mt-20">
                                    <div class="form-group">
                                      <fieldset>
                                        <legend>Birth Place</legend>
                                        <input type="text" class="form-control colo_birth_place fieldset_element" name="colo_birth_place[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" autocomplete="off" data-id="<?php echo $ex['id']; ?>" value="<?php echo $tour_upgrades_passenger_detail['colo_birth_place'][$ex['id']][$i]; ?>">
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                              <?php
                              } else {
                              ?>
                                <label>Passenger <?php echo $i + 1; ?>:</label>
                                <div class="row">
                                  <div class="col-md-4 field-group">
                                    <div class="form-group">
                                      <fieldset>
                                        <legend>First Name</legend>
                                        <input type="text" class="form-control colo_fname_tour_up fieldset_element " name="colo_first_name[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" data-id="<?php echo $ex['id']; ?>" autocomplete="off" value="<?php echo $tour_upgrades_passenger_detail['colo_first_name'][$ex['id']][$i]; ?>">
                                      </fieldset>
                                    </div>
                                  </div>
                                  <div class="col-md-4 field-group">
                                    <div class="form-group">
                                      <fieldset>
                                        <legend>Last Name</legend>
                                        <input type="text" class="form-control colo_lname_tour_up fieldset_element " name="colo_last_name[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" autocomplete="off" data-id="<?php echo $ex['id']; ?>" value="<?php echo $tour_upgrades_passenger_detail['colo_last_name'][$ex['id']][$i]; ?>">
                                      </fieldset>
                                    </div>
                                  </div>
                                  <div class="col-md-4 field-group">
                                    <div class="form-group">
                                      <fieldset>
                                        <legend>Age</legend>
                                        <input type="text" name="colo_pass_age[<?php echo $ex['id']; ?>][<?php echo $i; ?>]" class="form-control colo_age_tour_up fieldset_element" autocomplete="off" data-id="<?php echo $ex['id']; ?>" value="<?php echo $tour_upgrades_passenger_detail['colo_age'][$ex['id']][$i]; ?>">
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                              <?php
                              }
                              ?>
                      <?php
                            }
                          }
                        }
                      } ?>
                    </div>
              <?php   }
                }
              } else {
              } ?>
            </ul>
            <input type="hidden" name="total_person" id="total_person" value="<?php echo $toursData['total_passenger']; ?>">
            <input type="hidden" name="total_infants" id="total_infants" value="<?php echo $toursData['total_infants']; ?>">
            <p class="text-right total-price <?php if ($tour_upgrades_price == '') { ?>d-none<?php } ?>">Additional cost :<strong><span class="total_tour_upgrades_price_lbl">€<?php echo $tour_upgrades_price; ?></span></strong></p>

            <div class="button-wrap">
              <a href="<?php echo base_url(($is_tour) ? 'tours' : 'transfer') . '/' . $toursData['toursData']['tour_slug']; ?>" class="btn btn-border">Go Back</a>
              <!-- <a href="#" class="btn btn btn-blue">Continue</a> -->
              <button type="button" id="btn_add_tour_cart" class="btn btn btn-blue btn_sub">Continue</a>
            </div>

        </div>
      </div>
      <div class="col-md-4">
        <div class="video-sidebar">
          <div class="video-item">
            <div class="video-wrap">
              <img src="<?php echo base_url('uploads/' . $toursData['toursData']['feature_image']); ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';" height="300">
            </div>
            <div class="text">
              <h5><?php echo $toursData['toursData']['title']; ?></h5>
              <i class="fal fa-long-arrow-right"></i>
            </div>
          </div>
          <!-- <div class="video-item">
              <div class="video-wrap">
                <img src="images/yt1.jpg">
              </div>
              <div class="text">
                <h5>Lorem Ipsum</h5>
                <i class="fal fa-long-arrow-right"></i>
              </div>
            </div>
            <div class="video-item">
              <div class="video-wrap">
                <img src="images/yt1.jpg">
              </div>
              <div class="text">
                <h5>Lorem Ipsum</h5>
                <i class="fal fa-long-arrow-right"></i>
              </div>
            </div>
            <div class="video-item">
              <div class="video-wrap">
                <img src="images/yt1.jpg">
              </div>
              <div class="text">
                <h5>Lorem Ipsum</h5>
                <i class="fal fa-long-arrow-right"></i>
              </div>
            </div> -->
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" name="total_tour_upgrades_price" id="total_tour_upgrades_price" value="<?php echo $tour_upgrades_price; ?>">
  <input type="hidden" name="total_tour_upgrades" id="total_tour_upgrades" value="<?php echo count($tour_upgrades_cart); ?>">
  <!-- <input type="hidden" name="selected_tour_upgrades" id="selected_tour_upgrades"> -->
  </form>
</section>