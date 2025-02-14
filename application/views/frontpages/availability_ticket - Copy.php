<?php 
$toursData=$this->session->userdata('tours_data');
// print_r($toursData);
// exit;
?>
<div class="breadcrumb n-breadcrumb">

    <div class="container">

      <ul>

        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li><a href="<?php echo base_url('tours/'.$toursData['toursData']['tour_slug']);?>"><?php echo $toursData['toursData']['title'];?></a></li>

        <li>Tour Upgrades</li> 

      </ul>

    </div>

</div>

<section class="upgrades-section pt-80 pb-80">
    <div class="container">
      <h2 class="title">Upgrades</h2>
      <div class="row">
        <div class="col-md-8">
          <div class="custom-form">
            <form method="post" id="addTourUpgrades">
              <div class="row">
                <?php
                $extra_service_price="";
                if($toursData['toursData']['extra_services_id']){
                    $ex_services=explode(",",$toursData['toursData']['extra_services_id']);
                    $extra_service_array=get_extra_services();
                    
                    foreach($extra_service_array as $ex){
                      if($ex['rate_opt']==1){
                        if(in_array($ex['id'], $ex_services)) {?>
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="flex">
                                <label><?php echo $ex['title'];?></label>
                                <select name='tour_upgrades<?php echo $ex['id'];?>' class="select_tour_upgrades_ticket" data-id="<?php echo $ex['id'];?>">
                                  <option value="">Select</option>
                                  <?php
                                    for($i=1;$i<=$toursData['total_passenger'];$i++){ ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                      <?php } ?>
                                </select>
                                <?php if($ex['description']){ ?>
                                <label class="note-label"><!-- *Skip the line tickets for the Vatican museum at 28.00 € per person. --><button  class="popover-button" type="button" data-toggle="popover" data-content="<?php echo $ex['description'];?>"></i></button></label>
                                <?php } ?>
                                
                                <input type="hidden" name="tour_rate_opt<?php echo $ex['id'];?>" id="tour_rate_opt<?php echo $ex['id'];?>" value="<?php echo $ex['rate_opt'];?>">
                                <input type="hidden" name="tour_upgrade_rate<?php echo $ex['id'];?>" id="tour_upgrade_rate<?php echo $ex['id'];?>" value="<?php echo $ex['price'];?>">
                                <!-- <input type="hidden" name="tour_upgrade_custom_rate<?php //echo $ex['id'];?>" id="tour_upgrade_custom_rate<?php //echo $ex['id'];?>" value='<?php //echo $ex['person_custom_rate'];?>'> -->
                                <input type="hidden" name="tour_add_rate<?php echo $ex['id'];?>" id="tour_add_rate<?php echo $ex['id'];?>" value=''>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12" id="person_info<?php echo $ex['id'];?>">
                            
                          </div>
                          <?php } } } }?>
              </div>
              <ul class="license-checklist">
                <?php
                $extra_service_price="";
                if($toursData['toursData']['extra_services_id']){
                    $ex_services=explode(",",$toursData['toursData']['extra_services_id']);
                    $extra_service_array=get_extra_services();
                    
                    foreach($extra_service_array as $ex){
                      if($ex['rate_opt']==0){
                        if(in_array($ex['id'], $ex_services)) { ?>
                            <li>
                              <div class="custom-checkbox">
                                <?php echo $ex['title'];?>
                                <input type="checkbox" name="tour_upgrades[]" class="select_tour_upgrades" value="<?php echo $ex['id'];?>">
                                <span class="checkmark"></span>
                                <input type="hidden" name="tour_rate_opt<?php echo $ex['id'];?>" id="tour_rate_opt<?php echo $ex['id'];?>" value="<?php echo $ex['rate_opt'];?>">
                                <input type="hidden" name="tour_upgrade_rate<?php echo $ex['id'];?>" id="tour_upgrade_rate<?php echo $ex['id'];?>" value="<?php echo $ex['price'];?>">
                                <input type="hidden" name="tour_upgrade_custom_rate<?php echo $ex['id'];?>" id="tour_upgrade_custom_rate<?php echo $ex['id'];?>" value='<?php echo $ex['person_custom_rate'];?>'>
                              </div>
                              <?php if($ex['description']){ ?>
                                <button  class="popover-button" type="button" data-toggle="popover" data-content="<?php echo $ex['description'];?>" data-placement="bottom"><i class="fal fa-info-circle"></i></button>
                              <?php } ?>
                            </li>
                            <div class="col-md-12" id="person_info<?php echo $ex['id'];?>">
                            
                          </div>
                      <?php  }
                      }
                    }
                } else {
                    
                } ?>               
              </ul>
              <input type="hidden" name="total_person" id="total_person" value="<?php echo $toursData['total_passenger'];?>">
              <input type="hidden" name="total_infants" id="total_infants" value="<?php echo $toursData['total_infants'];?>">
              <p class="text-right total-price d-none">Total Price :<strong><span class="total_tour_upgrades_price_lbl">€170</span></strong></p>

              <div class="button-wrap">
                <a href="<?php echo base_url('tours/'.$toursData['toursData']['tour_slug']);?>" class="btn btn btn-border">Go Back</a>
                <!-- <a href="#" class="btn btn btn-blue">Continue</a> -->
                <button type="button" id="btn_add_tour_cart" class="btn btn btn-blue">Continue</a>
              </div>
            
          </div>
        </div>
        <div class="col-md-4">
          <div class="video-sidebar">
            <div class="video-item">
              <div class="video-wrap">
                <img src="<?php echo base_url('uploads/'.$toursData['toursData']['feature_image']);?>">
              </div>
              <div class="text">
                <h5><?php echo $toursData['toursData']['title'];?></h5>
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
    
      <input type="hidden" name="total_tour_upgrades_price" id="total_tour_upgrades_price">
      <input type="hidden" name="selected_tour_upgrades" id="selected_tour_upgrades">
      <!-- <input type="hidden" name="selected_tour_upgrades" id="selected_tour_upgrades"> -->
    </form>
  </section>