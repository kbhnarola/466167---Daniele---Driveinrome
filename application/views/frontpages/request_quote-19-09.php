<?php 
$toursData=$this->session->userdata('quote_data');
// print_r($toursData);
// exit;
?>
<section class="page-title-section">
      <div class="image-wrap">
        <img src="images/rome-tours1.jpg" onerror="this.src='<?php echo base_url("assets/images/banner/product-details.jpg");?>'">
      <!-- <h2><?php // echo $toursData['toursData']['title'];?></h2> -->
    </div>
    <div class="breadcrumb">
      <div class="container">
        <p><a href="<?=BASE_URL?>">Home</a>&nbsp&nbsp/&nbsp&nbsp
        <?php
          if($toursData['toursData']['tour_type_id']==1 || $toursData['toursData']['tour_type_id']==7) {
          ?>
            <a href="javascript:" class="b_crum">Shore Excursions</a> 
          <?php 
          } elseif ($toursData['toursData']['tour_type_id']==8) { 
          ?>
            <a href="javascript:" class="b_crum">Package Tours</a>
          <?php 
          } else { 
          ?> 
            <a href="javascript:" class="b_crum">City Tours</a> <?php 
          } 
        ?>&nbsp&nbsp/&nbsp&nbsp
        <?php 
          if($toursData['toursData']['tour_type_id']==1 || $toursData['toursData']['tour_type_id']==7){ 
          ?>
            <a href="<?php echo base_url('shore-excursions/'.$toursData['toursData']['city_slug']);?>"><?php echo $toursData['toursData']['city'];?></a>
          <?php  
          } elseif($toursData['toursData']['tour_type_id']==8){
          ?>
            <a href="<?php echo base_url('package-tour/'.$toursData['toursData']['city_slug']);?>"><?php echo $toursData['toursData']['city'];?></a>
          <?php
          }else {
          ?>
            <a href="<?php echo base_url('city-tours/'.$toursData['toursData']['city_slug']);?>"><?php echo $toursData['toursData']['city'];?></a>
          <?php 
          } 
          ?>&nbsp&nbsp/&nbsp&nbsp
        <span class="title"><?php echo $toursData['toursData']['title'];?></span></p>
      </div>
    </div>
  </section>
  <section class="quote-section">
    <div class="container">
      <h2 class="title">Request a Written Quote</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="img-wrap">
            <img src="<?php echo base_url('uploads/'.$toursData['toursData']['feature_image']);?>" onerror="this.src='<?=DEFAULT_IMAGE?>/transfers_default.png';">
          </div>
        </div>
        <div class="col-md-8">
          <div class="light-form">
            <div class="contact-form custom-form request_quote_form">
              <!-- <form id="requestQuoteForm" method="post" action="<?php //echo base_url('submit_quote_request');?>"> -->
              <form id="requestQuoteForm" method="post" >
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <fieldset>
                        <legend>Full Name</legend>
                        <input type="text" class="form-control fieldset" id="user_name" name="user_name" autocomplete="off" value="">
                      </fieldset>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <fieldset>
                        <legend>Email</legend>
                        <input type="text" class="form-control fieldset" id="user_email" name="user_email" autocomplete="off">
                      </fieldset>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <fieldset>
                        <legend>Confirm Email</legend>
                        <input type="text" class="form-control fieldset" id="user_confirm_email" name="user_confirm_email" autocomplete="off">
                      </fieldset>
                    </div>
                  </div>
                 </div>
                 <div class="form-group">
                  <div class="row">
                    <div class="col-sm-12 remember">
                      <label class="checkbox-inline ">
                        <input type="checkbox" name="accept_privacy_policy" id="accept_privacy_policy" class="accept_privacy_policy">
                          By submitting this form I accept your <a href="<?=base_url('privacy-policy')?>" target="_blank">Privacy Policy</a>
                          </label>
                          <div id="accept_privacy_policy_errr" class="mt-3"></div>
                    </div>                                    
                  </div>
                </div>
                <div class="button-wrap">
                  <a href="<?php echo base_url('tours/'.$toursData['toursData']['tour_slug']);?>" name="go_back_tour_details" type="button" id="go_back_tour_details" class="btn btn-border" >Go Back</a>
                  <button type="submit" class="btn btn-yellow btn_sub">submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>