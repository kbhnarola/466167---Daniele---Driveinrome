<!DOCTYPE html>

<html lang="en">

<head>

  <title><?=$title?></title>

  <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : '' ?>">

  <meta name="keywords" content="<?php echo isset($meta_keyword) ? $meta_keyword : '' ?>">

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php
    if($this->uri->segment(1)=="tours"){?>
    <link rel="stylesheet" type="text/css" href="<?php echo ASSET.'css/web/bootstrap-datepicker.css';?>">
  <?php }?>
  <link rel="stylesheet" href="<?=ASSET?>css/bootstrap.min.css">

  <link rel="stylesheet" href="<?=ASSET?>css/style.css">

  <link rel="stylesheet" href="<?=ASSET?>css/responsive.css">


  <link rel="stylesheet" href="<?=ASSET?>css/arj_style.css">
  <link rel="stylesheet" href="<?=ASSET?>css/bm_style.css">



  <link href="<?=ASSET?>css/all.min.css" rel="stylesheet">

  <link href="<?=ASSET?>css/fontawesome.css" rel="stylesheet">

  <link href="<?=ASSET?>css/solid.css" rel="stylesheet">

  <link rel="stylesheet" href="<?=ASSET?>css/brands.css">

  <link rel="stylesheet" href="<?=ASSET?>css/owl.carousel.min.css">

  <link rel="stylesheet" href="<?=ASSET?>css/owl.theme.default.min.css">

  <script src="<?=ASSET?>js/jquery.min.js"></script>
  
  <script src="<?=ASSET?>js/popper.min.js"></script>

  <script src="<?=ASSET?>js/bootstrap.min.js"></script>


  <script src="<?=ASSET?>js/owl.carousel.min.js"></script>  

  <script src="<?=ASSET?>js/plugins/forms/validation/validate.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/forms/validation/additional_methods.min.js'); ?>"></script>
  <script src="<?=ASSET?>js/jquery.ihavecookies.min.js"></script>

  <script type="text/javascript">var BASE_URL = "<?=BASE_URL?>";</script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>

  <script src="https://www.google.com/recaptcha/api.js?render=6Ld_NRQaAAAAAMrhlLry1M6bC_G4MHv5zE9-O-WR"></script>

  
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/notifications/jgrowl.min.js'); ?>"></script>
  <!-- TrustBox script -->

    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>

  <!-- End TrustBox script -->
<script type="text/javascript">

      // For GDPR cookie

      var options = {

        title: '&#x1F36A; Accept Cookies & Privacy Policy?',

        message: 'We use cookies to improve your site experinece by contunieing to use this site, you agree to our cookies policy.',

        delay: 600,

        expires: 1,

        link: 'privacy',

        onAccept: function(){

          var myPreferences = $.fn.ihavecookies.cookie();

          console.log('Yay! The following preferences were saved...');

          console.log(myPreferences);

        },

        uncheckBoxes: false,

        acceptBtnLabel: 'Accept Cookies',

        moreInfoLabel: 'View Policy',

        cookieTypesTitle: 'Select which cookies you want to accept',

        fixedCookieTypeLabel: 'Essential',

        fixedCookieTypeDesc: 'These are essential for the website to work correctly.'

      }



      $(document).ready(function() {

          $('body').ihavecookies(options);



          if ($.fn.ihavecookies.preference('marketing') === true) {

            console.log('This should run because marketing is accepted.');

          }



          $('#ihavecookiesBtn').on('click', function(){

            $('body').ihavecookies(options, 'reinit');

          });

      });

      // GDPR code ends
  function jGrowlAlert(message, alertType) {

        var header_msg = alertType == 'success' ? 'Success!' : 'Oh Snap!';
        $.jGrowl(message, {
            header: header_msg,
            theme: 'bg-' + alertType
        });
    }
  </script>
</head>

<body>

  

<?php

$header_class = '';

if(isset($header_banner)){

  $header_class = "n-header";

}

$get_settings = get_admin_settings();

$company_logo = '';

foreach($get_settings as $single_settings){if($single_settings['name'] == 'company_logo'){

      $company_logo = ASSET.'images/'.$single_settings['value'];

  }

}

if(empty($company_logo)){

  $company_logo = ASSET.'images/logo.svg';

}

?>

  <header class="<?=$header_class?>">

    <nav class="navbar">

      <div class="container">

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">

            <i class="fal fa-bars"></i>                       

          </button>

        <div class="navbar-header">

          <a class="navbar-brand" href="<?=BASE_URL?>">

            <img src="<?=$company_logo?>"/>

          </a>

        </div>

        <div class="collapse navbar-collapse" id="myNavbar">

          <ul class="nav navbar-nav">

            <li class="dropdown">

              <a class="dropdown-toggle <?=($this->uri->segment(1)== 'shore-excursions') ? 'active' : '' ?>" data-toggle="dropdown" href="#">Shore Excursions<span class="caret"></span></a>

              <ul class="dropdown-menu">

                <?php

                if(!empty(get_city_list_in_menu(31))){

                  $city_list_in_menus = get_city_list_in_menu(31);

                  foreach($city_list_in_menus as $city_list_in_menu){

                      ?><li><a href="<?=base_url('shore-excursions/'.$city_list_in_menu['tour_category_slug'])?>" <?=($this->uri->segment(1)== 'shore-excursions' && $this->uri->segment(2)== $city_list_in_menu['tour_category_slug']) ? 'class="active"' : '' ?>><?=$city_list_in_menu['city_title']?></a></li><?php

                  }

                }                

                else if(!empty(get_city_list_in_menu(32))){

                  $city_list_in_menus = get_city_list_in_menu(32);

                  foreach($city_list_in_menus as $city_list_in_menu){

                      ?><li><a href="<?=base_url('shore-excursions/'.$city_list_in_menu['tour_category_slug'])?>" <?=($this->uri->segment(1)== 'shore-excursions' && $this->uri->segment(2)== $city_list_in_menu['tour_category_slug']) ? 'class="active"' : '' ?>><?=$city_list_in_menu['city_title']?></a></li><?php

                  }

                }else{

                  ?><li><a href="#">N/A</a></li><?php

                }                

                ?>

              </ul>

            </li>

            <li class="dropdown">

              <a class="dropdown-toggle <?=($this->uri->segment(1)== 'city-tours') ? 'active' : '' ?>" data-toggle="dropdown" href="#">City Tours<span class="caret"></span></a>

              <ul class="dropdown-menu">

                <?php

                  if(!empty(get_city_list_in_menu(30))){

                    $city_list_in_menus = get_city_list_in_menu(30);

                    foreach($city_list_in_menus as $city_list_in_menu){

                        ?><li><a href="<?=base_url('city-tours/'.$city_list_in_menu['tour_category_slug'])?>" <?=($this->uri->segment(1)== 'city-tours' && $this->uri->segment(2)== $city_list_in_menu['tour_category_slug']) ? 'class="active"' : '' ?>><?=$city_list_in_menu['city_title']?></a></li><?php

                    }

                  }else{

                    ?><li><a href="#">N/A</a></li><?php

                  } 

                ?>

              </ul>

            </li>

            <li class="dropdown">

              <a class="dropdown-toggle <?=($this->uri->segment(1)== 'transfers') ? 'active' : '' ?>" data-toggle="dropdown" href="#">Transfers<span class="caret"></span></a>

              <ul class="dropdown-menu">

                <?php

                  if(!empty(get_transfer_list_in_menu(1))){

                    $city_list_in_menus = get_transfer_list_in_menu(1);

                    foreach($city_list_in_menus as $city_list_in_menu){

                        ?><li><a href="<?=base_url('transfers/'.$city_list_in_menu['transfer_category_slug'])?>" <?=($this->uri->segment(1)== 'transfers' && $this->uri->segment(2)== $city_list_in_menu['transfer_category_slug']) ? 'class="active"' : '' ?>><?=$city_list_in_menu['city_title']?></a></li><?php

                    }

                  }else{

                    ?><li><a href="#">N/A</a></li><?php

                  } 

                ?>

              </ul>

            </li>            

            <li class="dropdown">

              <a class="dropdown-toggle <?=($this->uri->segment(1)== 'package-tour') ? 'active' : '' ?>" data-toggle="dropdown" href="#">Package Tour<span class="caret"></span></a>

              <ul class="dropdown-menu">

                <?php

                  if(!empty(get_city_list_in_menu(33))){

                    $city_list_in_menus = get_city_list_in_menu(33);

                    foreach($city_list_in_menus as $city_list_in_menu){

                        ?><li><a href="<?=base_url('package-tour/'.$city_list_in_menu['tour_category_slug'])?>" <?=($this->uri->segment(1)== 'package-tour' && $this->uri->segment(2)== $city_list_in_menu['tour_category_slug']) ? 'class="active"' : '' ?>><?=$city_list_in_menu['city_title']?></a></li><?php

                    }

                  }else{

                    ?><li><a href="#">N/A</a></li><?php

                  } 

                ?>

              </ul>

            </li>            

            <li><a href="#" class="contact-top-link">Contact Us</a></li>

          </ul>

        </div>



        <a href="#" class="cart-notification">

          <i class="fas fa-shopping-cart"></i>

          <span class="count">0</span>

        </a>

      </div>

    </nav>

  </header>