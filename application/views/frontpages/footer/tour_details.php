<section class="page-title-section single_tour">
      <div class="image-wrap">
        <img src="<?php echo base_url('uploads/'.$toursData['banner_image']);?>" onerror="this.src='<?php echo base_url("assets/images/banner/product-details.jpg");?>'">
      <h1><?php echo $toursData['title'];?></h1>
    <?php
    // echo "<pre>";
    // print_r($toursData);
    // exit;?>
    <div class="breadcrumb">
      <div class="container">
        <ul>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li>
            <?php 
              if($toursData['tour_type_id']==1 || $toursData['tour_type_id']==7){ ?>
              <a href="<?php echo base_url('shore-excursions/'.$toursData['city_slug']);?>"><?php echo $toursData['city'];?></a>
             <?php  } elseif($toursData['tour_type_id']==8){?>
              <a href="<?php echo base_url('package-tour/'.$toursData['city_slug']);?>"><?php echo $toursData['city'];?></a>
              <?php } else {?>
             <a href="<?php echo base_url('city-tours/'.$toursData['city_slug']);?>"><?php echo $toursData['city'];?></a>
             <?php } ?></li> 
          <li><?php echo $toursData['title'];?></li>
        </ul>
      </div>
    </div>
  </section>
  <section class="availability-section">
    <div class="container"> 
      <h2 class="title"><?php echo $toursData['title'];?></h2>
      <div class="row">
        <div class="col-md-8">
          <div class="product-wrap">
            <div class="image-wrap">
              <!-- <img src="<?php //echo base_url('uploads/'.$toursData['feature_image']);?>"> -->
               <!-- <div class="owl-carousel  owl-theme"> -->
                <div id="gallery_tour_slider" class="carousel slide gallery_tour_slider">
                  <div class="carousel-inner">
                  <?php
                    if($toursData['gallery_image']){
                      $gallery_image=explode(",",$toursData['gallery_image']);
                      $i=0;
                      foreach ($gallery_image as $value) { ?>
                        <div class="carousel-item  <?php if($i==0) {?>active<?php } ?>">
                          <img src="<?php echo base_url('uploads/'.$value);?>" alt='<?php echo $toursData['title'];?>' onerror="this.src='<?php echo DEFAULT_IMAGE.'transfers_default.png';?>" class="img-responsive" height="300">
                        </div>
                       <?php $i++; } }  else { ?>
                        <div class="carousel-item  active">
                          <img src="<?php echo base_url('uploads/'.$toursData['feature_image']);?>" alt="<?php echo $toursData['title'];?>" onerror="this.src='<?php echo DEFAULT_IMAGE.'transfers_default.png';?>" class="img-responsive">
                        </div>
                      <?php } ?>
                    </div>
                    <a class="carousel-control-prev" href="#gallery_tour_slider" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#gallery_tour_slider" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
               </div>
            </div>
            <div class="content-div">
              <h2>
                <?php
                if($toursData['tour_type_id']==1 || $toursData['tour_type_id']==7) {?>
                SHORE EXCURSION <?php } elseif ($toursData['tour_type_id']==8) { ?>
                  Package Tour
                <?php } else { ?> City Tours <?php } ?> 
              </h2>
              <h5>From the Port of <?php echo $toursData['city'];?></h5>
              <?php
              $extra_services=$toursData['extra_services_id'];
              //echo $extra_services;

              if($extra_services){
                $services=explode(',',$extra_services);
                $set_extra_services=set_extra_services();
                $array=array();
                foreach ($services as $key => $value) {
                  if(array_key_exists($value,$set_extra_services)){
                  
                      $array[]=$set_extra_services[$value];
                  }
                }
                
                $service_titles=implode(' & ',$array);
              } else {
                $service_titles="";
              } ?>
              <h6><?php echo $service_titles;?></h6>
              <div class="n-product-detail">
                <ul class="rating">
                  <?php
                      if($toursData['rating']) {
                        $int_array=array(1,2,3,4,5);
                        for($i=0.5;$i<=5;$i += 0.5) {
                          
                          if(in_array($i,$int_array) && $i<=$toursData['rating']){
                           ?>
                            <li>
                              <i class="fas fa-star"></i>
                            </li>
                            
                        <?php } elseif ($i==$toursData['rating']) { ?>
                              <li>
                               <i class="fas fa-star-half"></i>
                              </li>
                        <?php } elseif(in_array($i,$int_array) && ($i-0.5!=$toursData['rating'])) { ?>
                              <li>
                                <i class="far fa-star"></i>
                              </li>
                        <?php } }
                      } else {?>
                        <li>
                          <i class="far fa-star"></i>
                        </li>
                        <li>
                          <i class="far fa-star"></i>
                        </li>
                        <li>
                          <i class="far fa-star"></i>
                        </li>
                        <li>
                          <i class="far fa-star"></i>
                        </li>
                        <li>
                          <i class="far fa-star"></i>
                        </li>
                      <?php } ?>
                </ul>
                <div class="p-info-wrap">
                  <div class="left">
                    <h5 class="code-id"><span>Code : </span><strong><?php echo $toursData['unique_code'];?></strong></h5>
                    <h5 class="code-id"><span>Type : </span><strong><?php echo $toursData['tour_type'];?></strong></h5>
                    <p class="duration"><i class="far fa-clock"></i>Duration : <?php echo $toursData['duration'].' Hours';?></p>
                  </div>
                  <div class="right">
                    <div class="price-tag">
                      <img src="<?php echo base_url('assets/images/euro-price-tag.png');?>">
                      Starting From:<br/>
                      <span>*<?php echo $toursData['tour_price'];?> €</span>
                    </div>
                    <a href="javascript:" class="btn btn-blue contact-top-link">Contact us</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="availability-form form-bg">
            <form method="post" id="tourAvailabilityForm" class="form-content">
              <h2>Check Availability</h2>
              <div class="form-group">
                <label>1. Select Tour Date</label>
                <!-- <div class="input-group">
                  <input type="text" class="form-control tour_datepicker" name="tour_date" id="tour_date" placeholder="Select Date" autocomplete="off">
                  <i class="fas fa-calendar-alt"></i>
                </div> -->
                <div class="input-group datepicker_tour " > 
                    <input type="text" name="tour_date" id="tour_date" class="form-control  tour_datepicker tour_date" placeholder="Select Date" autocomplete="off">
                    <div class="input-group-addon"> 
                      <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
              </div>
              <div class="form-group mb-0">
                <label>2. How many Passengers</label>
                <div class="row">
                  <div class="col-md-6">
                    <fieldset>
                      <legend>Adults < 64</legend>
                      <select class="form-control select_person_group" name="adults" id="adults">
                        <option value="">Select</option>
                        <?php
                          for($i=1;$i<=8;$i++){ ?>
                          <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-md-6">
                    <fieldset>
                      <legend>Kids (4-14)</legend>
                      <select class="form-control select_person_group" name="kids" id="kids">
                        <option value="">Select</option>
                        <?php
                          for($i=1;$i<=8;$i++){ ?>
                          <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-md-6">
                    <fieldset>
                      <legend>Senior > 65</legend>
                      <select class="form-control select_person_group" name="senior_person" id="senior_person">
                        <option value="">Select</option>
                        <?php
                          for($i=1;$i<=8;$i++){ ?>
                          <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-md-6">
                    <fieldset>
                      <legend>Infant (0-3)</legend>
                      <select class="form-control select_person_group" name="infants" id="infants">
                        <option value="">Select</option>
                        <?php
                          for($i=1;$i<=8;$i++){ ?>
                          <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                      </select>
                    </fieldset>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>3. Notes</label>
                  <div class="input-group">
                    <input type="text" name="tour_availability_notes" id="tour_availability_notes" class="form-control">
                     <?php
                  $content='Please tell us where your service will be starting from.
- If it is a cruise ship, please state the name of the ship (for example, "Carnival Legend").
-If its an airpot, please tell us which one, along with your flight details (for example, "Rome (FCO),Alitalia AZ609 Arriving at 6:50am")
-If its lodgings in Rome, please tell us the name of the hotel or address of the apartment. ';?>
                    <button  class="popover-button" type="button" data-toggle="popover" data-content='<?php echo $content;?>' data-placement="bottom"><i class="fal fa-info-circle"></i></button>
                  </div>
              </div>
              <div class="form-group mb-0">
                <label class="red-label">*Large group click here</label>
                <div class="row">
                  <div class="col-md-6 mb-0">
                    <a href="#" class="btn btn btn-border contact-top-link">Enquiry</a>
                  </div>
                  <div class="col-md-6 mb-0">
                    <!-- <a href="#" class="btn btn btn-blue">Get a Quote</a> -->
                    <button name="get_quote_button" id="get_quote_button" type="submit" class="btn btn btn-blue">Get a Quote</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-section">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#Description">
              <svg xmlns="http://www.w3.org/2000/svg" width="31.886" height="19.995" viewBox="0 0 31.886 19.995">
                <g id="Group_311" data-name="Group 311" transform="translate(-410.939 -134.5)">
                  <rect id="Rectangle_145" data-name="Rectangle 145" width="31.886" height="2.702" rx="1.351" transform="translate(410.939 134.5)" fill="#ff984a"/>
                  <rect id="Rectangle_146" data-name="Rectangle 146" width="23.51" height="2.702" rx="1.351" transform="translate(410.939 143.147)" fill="#ff984a"/>
                  <rect id="Rectangle_147" data-name="Rectangle 147" width="16.758" height="2.702" rx="1.351" transform="translate(410.939 151.793)" fill="#ff984a"/>
                </g>
              </svg>
              Description
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Included">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="26.811" viewBox="0 0 30 26.811">
                <g id="Group_312" data-name="Group 312" transform="translate(-75.708 -114.719)">
                  <path id="Path_118" data-name="Path 118" d="M94.083,140.213v2.649a.21.21,0,0,1-.21.21H79a.21.21,0,0,0-.21.21V161.24a.21.21,0,0,0,.21.21h21.01a.21.21,0,0,0,.21-.21v-7.208a.21.21,0,0,1,.21-.21H103.1a.21.21,0,0,1,.21.21v.177c0,2.366,0,4.732,0,7.1a3.084,3.084,0,0,1-2.6,3.184,3.746,3.746,0,0,1-.624.035c-7.049,0-14.1-.012-21.146.012A3.163,3.163,0,0,1,75.8,162.19a3.6,3.6,0,0,1-.091-.826q-.007-9.1,0-18.193a3.071,3.071,0,0,1,3.1-3.165q7.531-.014,15.062,0h0A.21.21,0,0,1,94.083,140.213Z" transform="translate(0 -23.008)"/>
                  <path id="Path_119" data-name="Path 119" d="M174.682,115.065l.876.8a1.328,1.328,0,0,1,.086,1.873L160.8,134.068a1.328,1.328,0,0,1-1.921.046l-5.607-5.6a1.327,1.327,0,0,1,0-1.881l.781-.776a1.327,1.327,0,0,1,1.876.007l3.724,3.749,13.15-14.462A1.328,1.328,0,0,1,174.682,115.065Z" transform="translate(-70.282 0)"/>
                </g>
              </svg>
              Included
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Restrictions">
              <svg xmlns="http://www.w3.org/2000/svg" width="31.001" height="31" viewBox="0 0 31.001 31">
                <g id="Group_313" data-name="Group 313" transform="translate(-564.2 -330.49)">
                  <path id="Path_120" data-name="Path 120" d="M579.7,330.99a15,15,0,1,0,15,15A15.017,15.017,0,0,0,579.7,330.99Zm-12.657,15a12.651,12.651,0,0,1,20.736-9.736l-17.815,17.815A12.6,12.6,0,0,1,567.043,345.99ZM579.7,358.647a12.6,12.6,0,0,1-8.078-2.921l17.815-17.815a12.651,12.651,0,0,1-9.737,20.736Z" transform="translate(0)" stroke="#000" stroke-width="1"/>
                </g>
              </svg>
              Restrictions
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Meeting-Point">
              <svg xmlns="http://www.w3.org/2000/svg" width="22.493" height="29.991" viewBox="0 0 22.493 29.991">
                <g id="Group_318" data-name="Group 318" transform="translate(-412 -145)">
                  <g id="Group_315" data-name="Group 315" transform="translate(412 145)">
                    <g id="Group_314" data-name="Group 314">
                      <path id="Path_121" data-name="Path 121" d="M423.247,145A11.26,11.26,0,0,0,412,156.247c0,5.806,9.234,17.034,10.288,18.3a1.25,1.25,0,0,0,1.918,0c1.053-1.262,10.288-12.489,10.288-18.3A11.26,11.26,0,0,0,423.247,145Zm0,26.76c-3.11-3.916-8.747-11.787-8.747-15.513a8.747,8.747,0,0,1,17.495,0C431.994,159.973,426.357,167.843,423.247,171.76Z" transform="translate(-412 -145)"/>
                    </g>
                  </g>
                  <g id="Group_317" data-name="Group 317" transform="translate(416.999 149.999)">
                    <g id="Group_316" data-name="Group 316">
                      <path id="Path_122" data-name="Path 122" d="M482.248,209a6.248,6.248,0,1,0,4.472,10.611,1.25,1.25,0,0,0-1.789-1.745A3.749,3.749,0,1,1,486,215.248a1.25,1.25,0,1,0,2.5,0A6.255,6.255,0,0,0,482.248,209Z" transform="translate(-476 -209)"/>
                    </g>
                  </g>
                </g>
              </svg>
              Meeting Point
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Faq">
              <svg xmlns="http://www.w3.org/2000/svg" width="30.633" height="30.567" viewBox="0 0 30.633 30.567">
                <g id="Group_319" data-name="Group 319" transform="translate(-887.683 -180.75)">
                  <path id="Path_123" data-name="Path 123" d="M918,201.3a9.719,9.719,0,0,0-7.1-9.345,11.455,11.455,0,1,0-21.311,6.32l-1.546,5.59,5.591-1.546a11.412,11.412,0,0,0,5.325,1.576,9.7,9.7,0,0,0,14.279,5.754l4.721,1.306-1.306-4.721A9.664,9.664,0,0,0,918,201.3Zm-24.09-.882-3.347.926.926-3.347-.211-.33a9.693,9.693,0,1,1,2.962,2.962Zm21.527,8.016-2.484-.687-.331.215a7.942,7.942,0,0,1-11.846-4.132,11.475,11.475,0,0,0,10.058-10.058,7.943,7.943,0,0,1,4.131,11.847l-.215.331Z" stroke="#000" stroke-width="0.5"/>
                  <path id="Path_124" data-name="Path 124" d="M898.576,196.879h1.758v1.758h-1.758Z" stroke="#000" stroke-width="0.5"/>
                  <path id="Path_125" data-name="Path 125" d="M901.213,189.789a1.741,1.741,0,0,1-.572,1.3l-2.065,1.889v2.145h1.758V193.75l1.493-1.367a3.516,3.516,0,1,0-5.888-2.594H897.7a1.758,1.758,0,1,1,3.516,0Z" stroke="#000" stroke-width="0.5"/>
                </g>
              </svg>
              Faq
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Cancellation-Policy">
              <svg xmlns="http://www.w3.org/2000/svg" width="29.999" height="29.998" viewBox="0 0 29.999 29.998">
                <g id="Group_320" data-name="Group 320" transform="translate(-929.788 -194.001)">
                  <path id="Path_126" data-name="Path 126" d="M957.383,224H940.626a3.186,3.186,0,0,1-1.377-.655.776.776,0,0,0-.708-.28.774.774,0,0,1-.463-.139,19.089,19.089,0,0,1-4.458-3.618A14.534,14.534,0,0,1,930,212.021c-.087-.516-.145-1.037-.216-1.556V207.77a1.337,1.337,0,0,1,.833-.756c2.449-.99,4.891-2,7.339-2.985a.363.363,0,0,0,.27-.4c-.01-1.659-.016-3.319,0-4.979a2.725,2.725,0,0,1,2.331-2.708,18.8,18.8,0,0,1,2.279-.058.3.3,0,0,0,.324-.207,2.765,2.765,0,0,1,1.991-1.613,1.342,1.342,0,0,0,.16-.059H952.7c.063.021.124.048.188.063a2.294,2.294,0,0,1,1.665,1.137c.313.682.78.727,1.383.68a8.826,8.826,0,0,1,1.054,0,3.358,3.358,0,0,1,.693.092,2.809,2.809,0,0,1,2.106,2.849q0,10.455,0,20.911c0,.508.007,1.016,0,1.523a2.82,2.82,0,0,1-1.958,2.612C957.677,223.913,957.53,223.955,957.383,224ZM940.5,222.036a6.9,6.9,0,0,0,.721.085q7.791.006,15.582,0c.753,0,1.1-.354,1.1-1.117v-9.841q0-6.18,0-12.36a.95.95,0,0,0-1.047-1.055c-.567,0-1.133,0-1.7,0a.281.281,0,0,0-.31.184,2.745,2.745,0,0,1-2.646,1.691q-3.207.014-6.415,0a3.156,3.156,0,0,1-.78-.1,2.8,2.8,0,0,1-1.947-1.774c-.651,0-1.3,0-1.956,0a.939.939,0,0,0-1.01,1c0,1.8,0,3.593-.006,5.39a.31.31,0,0,0,.231.339c.951.379,1.895.774,2.845,1.154a1.2,1.2,0,0,0,.424.078c1.26,0,2.519,0,3.779,0q3.573,0,7.146,0a.973.973,0,0,1,.9.443.869.869,0,0,1,.029.944.928.928,0,0,1-.871.49h-7.212v1.875h.4c2.256,0,4.511,0,6.766,0a.954.954,0,0,1,.95.553.933.933,0,0,1-.908,1.324q-3.469.008-6.941,0h-.355l-.364,1.873h7.622a.954.954,0,0,1,.983.633.937.937,0,0,1-.946,1.241c-2.645,0-5.291.006-7.937-.008a.507.507,0,0,0-.547.341,16.1,16.1,0,0,1-5.365,6.415C940.665,221.879,940.621,221.929,940.5,222.036Zm4.993-12.364c0-.283.015-.567-.009-.848a.373.373,0,0,0-.181-.27q-3.27-1.346-6.551-2.665a.477.477,0,0,0-.329,0q-3.294,1.324-6.58,2.671a.337.337,0,0,0-.177.242,12.384,12.384,0,0,0,1.815,7.206,15.45,15.45,0,0,0,4.994,4.935.308.308,0,0,0,.274-.033c.774-.575,1.591-1.1,2.3-1.752A12.612,12.612,0,0,0,945.5,209.672ZM949,197.749v0c1.074,0,2.148,0,3.221,0a.937.937,0,1,0,.019-1.872q-3.206-.009-6.413,0a.942.942,0,1,0,.01,1.872Q947.421,197.751,949,197.749Z"/>
                  <path id="Path_127" data-name="Path 127" d="M948.975,203.844c-1.845,0-3.691,0-5.536,0a.935.935,0,0,1-.92-1.3.916.916,0,0,1,.906-.574h3.633q3.749,0,7.5,0a.939.939,0,1,1,.014,1.874Q951.773,203.846,948.975,203.844Z"/>
                </g>
              </svg>
              Cancellation Policy
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div id="Description" class="tab-pane active">
            <h3>Description</h3>
            <div class="n-text">
                <?php echo $toursData['description'];?>
            </div>
          </div>
          <div id="Included" class="tab-pane fade">
            <h3>Included</h3>
            <div class="n-text">
              <?php echo $toursData['tour_included'];?>
            </div>
          </div>
          <div id="Restrictions" class="tab-pane fade">
            <h3>Restrictions</h3>
            <div class="n-text">
              <ul>
                <?php 
                if($toursData['tour_restrictions']){
                  $restrictions=json_decode($toursData['tour_restrictions'],true);
                  if(is_array($restrictions) && sizeof($restrictions)>0){
                    foreach($restrictions as $r){ ?>
                      <li><?php echo $r;?></li>
                   <?php }
                  }
                }
                ?>
                
              </ul>
            </div>
          </div>
          <div id="Meeting-Point" class="tab-pane fade">
            <h3>Meeting Point</h3>
            <div class="n-text">
              <ul>
                <?php 
                if($toursData['tour_meeting_point']){
                  $tour_meeting_point=json_decode($toursData['tour_meeting_point'],true);
                  if(is_array($tour_meeting_point) && sizeof($tour_meeting_point)>0){
                    foreach($tour_meeting_point as $m){ ?>
                      <li><?php echo $m;?></li>
                   <?php }
                  }
                }
                ?>
              </ul>              
            </div>
          </div>
          <div id="Faq" class="tab-pane fade">
            <h3>Faq</h3>
            <div class="n-text">
              <?php 
                if($toursData['tour_faqs']){
                  $tour_faqs=json_decode($toursData['tour_faqs'],true);
                  // print_r($tour_faqs);
                  // exit;
                  if(is_array($tour_faqs) && sizeof($tour_faqs)>0){
                    foreach($tour_faqs as $value){ ?>
                      <h4><?php echo key($value);?></h4>
                      <p><?php echo $value[key($value)];?></p>
                   <?php }
                  }
                }
                ?>               
            </div>
          </div>
          <div id="Cancellation-Policy" class="tab-pane fade">
            <h3>Cancellation Policy</h3>
            <div class="n-text">
              <?php echo $toursData['tour_cancellation_policy'];?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<input type="hidden" name="tour_name" id="tour_name" value="<?php echo $toursData['title'];?>">
<input type="hidden" name="tour_code" id="tour_code" value="<?php echo $toursData['unique_code'];?>">
<input type="hidden" name="tour_id" id="tour_id" value="<?php echo base64_encode($toursData['id']);?>">
<input type="hidden" name="tour_duration" id="tour_duration" value="<?php echo $toursData['duration'];?>">
<input type="hidden" name="tour_type_id" id="tour_type_id" value="<?php echo base64_encode($toursData['tour_type_id']);?>">