<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= $title; ?></title>
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-KN2S8KK');
  </script>
  <!-- End Google Tag Manager -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "DriverinRome",
      "url": "https://www.driverinrome.com/",
      "logo": "https://www.driverinrome.com/assets/images/1614157246_company_logo.png",
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "ratingCount": "1228",
        "sameAs": [
          "https://www.instagram.com/driverinrome/",
          "https://www.facebook.com/pages/Driver-in-Rome/159710534093830",
          "https://www.pinterest.ca/driverinrome/"
        ]
      }
    }
  </script>
  </script>
  <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : '' ?>">
  <meta name="keywords" content="<?php echo isset($meta_keyword) ? $meta_keyword : '' ?>">
  <meta charset="utf-8">
  <link rel="canonical" href="<?= current_url(); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= ASSET ?>css/bootstrap.min.css">
  <link rel="shortcut icon" type="image/png" href="<?php echo ASSET . 'images/favicon.png'; ?>" />
  <?php
  if ($this->uri->segment(1) == "tours" || $this->uri->segment(1) == "availability_ticket" ||  $this->uri->segment(1) == "partners") { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo ASSET . 'css/web/bootstrap-datepicker.css'; ?>">
  <?php } ?>
  <?php
  $minify_js_css = get_settings('minify_js');
  ?>
  <!-- <link rel="stylesheet" href="<?= ASSET ?>css/style.css"> -->
  <?php
  if ($minify_js_css == 1) { ?>
    <link rel="stylesheet" href="<?= ASSET ?>css/style.min.css?ver=<?php echo time(); ?>" async>
    <link rel="stylesheet" href="<?= ASSET ?>css/minify_css/responsive.css?ver=<?php echo time(); ?>" async>
    <link rel="stylesheet" href="<?= ASSET ?>css/minify_css/arj_style.css?ver=<?php echo time(); ?>" async>
    <link rel="stylesheet" href="<?= ASSET ?>css/minify_css/bm_style.css?ver=<?php echo time(); ?>" async>
  <?php } else { ?>
    <link rel="stylesheet" href="<?= ASSET ?>css/style.css?ver=<?php echo time(); ?>" async>
    <link rel="stylesheet" href="<?= ASSET ?>css/responsive.css?ver=<?php echo time(); ?>" async>
    <link rel="stylesheet" href="<?= ASSET ?>css/arj_style.css?ver=<?php echo time(); ?>" async>
    <link rel="stylesheet" href="<?= ASSET ?>css/bm_style.css?ver=<?php echo time(); ?>" async>
  <?php } ?>
  <?php
  // if (!is_home()) {
  ?>
  <link href="<?= ASSET ?>css/all.min.css" rel="stylesheet" async>
  <?php
  // }
  ?>
  <?php
  if ($this->uri->segment(1) != "") { ?>
    <link href="<?= ASSET ?>css/jquery.mCustomScrollbar.css" rel="stylesheet">
  <?php }
  if ($minify_js_css == 1) { ?>
    <link href="<?= ASSET ?>css/minify_css/fontawesome.css?ver=<?php echo time(); ?>" rel="stylesheet" async>
  <?php } else { ?>
    <link rel="stylesheet" href="<?= ASSET ?>css/fontawesome.css?ver=<?php echo time(); ?>" async>
  <?php } ?>
  <!-- <link href="<?= ASSET ?>css/fontawesome.css" rel="stylesheet"> -->
  <link href="<?= ASSET ?>css/solid.css" rel="stylesheet" async>
  <link rel="stylesheet" href="<?= ASSET ?>css/brands.css" async>
  <link rel="stylesheet" href="<?= ASSET ?>css/owl.carousel.min.css" async>
  <link rel="stylesheet" href="<?= ASSET ?>css/owl.theme.default.min.css" async>
  <link rel="stylesheet" href="<?= ASSET ?>css/toastr.min.css" async>
  <?php
  if ($minify_js_css == 1) {
    if (!is_home()) {
  ?>
      <link href="<?= ASSET ?>css/minify_css/components.css?ver=<?php echo time(); ?>" rel="stylesheet" type="text/css" async>
    <?php
    }
  } else {
    ?>
    <link href="<?= ASSET ?>css/components.css?ver=<?php echo time(); ?>" async rel="stylesheet" type="text/css" async>
  <?php } ?>
  <link href="<?= ASSET ?>css/icons/icomoon/styles.css" async rel="stylesheet" type="text/css">
  <link href="<?= ASSET ?>youtube_demo/YouTubePopUp.css" async rel="stylesheet" type="text/css">
  <script src="<?= ASSET ?>js/jquery.min.js"></script>
  <?php
  if ($this->uri->segment(1) != "") { ?>
    <!-- <script src="<?= ASSET ?>js/popper.min.js"></script> -->
    <script src="<?= ASSET ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
  <?php } ?>
  <script src="<?= ASSET ?>js/popper.min.js"></script>
  <script src="<?= ASSET ?>js/bootstrap.min.js"></script>
  <script src="<?= ASSET ?>js/owl.carousel.min.js"></script>
  <script src="<?= ASSET ?>js/plugins/forms/validation/validate.min.js"></script>
  <script src="<?= ASSET ?>js/plugins/forms/validation/additional_methods.min.js"></script>

  <script src="<?= ASSET ?>js/jquery.ihavecookies.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/plugins/forms/selects/select2.min.js"></script>
  <script src="<?= ASSET ?>js/loadingoverlay.min.js" async defer></script>
  <!-- <script src="<?= ASSET ?>youtube_demo/YouTubePopUp.jquery.js" async defer></script> -->
  <script>
    var BASE_URL = "<?= BASE_URL ?>";
  </script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script> -->



  <!-- TrustBox script -->
  <script src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" defer async></script>
  <!-- End TrustBox script -->
  <script src="<?= ASSET ?>js/toastr.min.js" async defer></script>
  <?php
  if (!$this->uri->segment(1)) {
  ?>
    <script src="<?= ASSET ?>js/plyr.min.js"></script>
    <link href="<?= ASSET ?>css/plyr.min.css" rel="stylesheet" type="text/css">
  <?php
  }
  if ($this->uri->segment(1) != 'partners') {
  ?>
    <script>
      // For GDPR cookie
      var options = {
        title: '&#x1F36A; Accept Cookies & Privacy Policy?',
        message: 'We use cookies to improve your site experience by continuing to use this site, you agree to our cookies policy.',
        delay: 600,
        expires: 1,
        link: BASE_URL + 'privacy-policy',
        onAccept: function() {
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
        $('#ihavecookiesBtn').on('click', function() {
          $('body').ihavecookies(options, 'reinit');
        });

      });
      // GDPR code ends 
    </script>
  <?php
  }
  ?>
</head>

<body <?= (!$this->uri->segment(1)) ? 'class="home"' : '' ?>>
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KN2S8KK" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End Google Tag Manager (noscript) -->
  <!-- display message if javascript is disable in browser -->
  <noscript>
    <div class="top-notify-danger">
      <div class="container">
        <p>JavaScript is disabled on your browser. Please enable it for better user experience and functioning of site.</p>
      </div>
    </div>
  </noscript>
  <?php
  $header_class = '';
  if (isset($header_banner) && $header_banner == 'no') {
    $header_class = "n-header";
  }
  $get_settings = get_admin_settings();
  $company_logo = '';
  foreach ($get_settings as $single_settings) {
    if ($single_settings['name'] == 'company_logo') {
      $company_logo = ASSET . 'images/' . $single_settings['value'];
    }
  }
  if (empty($company_logo)) {
    $company_logo = ASSET . 'images/logo.svg';
  }
  if ($this->uri->segment(1) != 'partners') {
  ?>
    <header class="<?= $header_class ?>">
      <nav class="navbar">
        <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <i class="fal fa-bars"></i>
          </button>
          <div class="navbar-header">
            <a class="navbar-brand" href="<?= BASE_URL ?>">
              <img src="<?= $company_logo ?>" alt="Logo" width="120" />
            </a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a class="dropdown-toggle <?= ($this->uri->segment(1) == 'shore-excursions') ? 'active' : '' ?>" data-toggle="dropdown" href="#">Shore Excursions<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <?php
                  $empty_private_tour = $empty_small_group = true;
                  $city_slug_array = array();
                  $get_private_tours = get_city_list_in_menu(1);
                  if ($get_private_tours) {
                    $empty_private_tour == false;
                    $city_list_in_menus = $get_private_tours;
                    foreach ($city_list_in_menus as $city_list_in_menu) {
                      $city_slug_array[] = $city_list_in_menu['tour_category_slug'];
                  ?><li><a href="<?= base_url('shore-excursions/' . $city_list_in_menu['tour_category_slug']) ?>" <?= ($this->uri->segment(1) == 'shore-excursions' && $this->uri->segment(2) == $city_list_in_menu['tour_category_slug']) ? 'class="active"' : '' ?>><?= $city_list_in_menu['city_title'] ?></a></li>
                      <?php
                    }
                  }
                  $get_small_group_tours = get_city_list_in_menu(7);
                  // query(1);
                  if ($get_small_group_tours) {
                    $empty_small_group = false;
                    $city_list_in_menus = $get_small_group_tours;
                    foreach ($city_list_in_menus as $city_list_in_menu) {
                      // check city is already exist in private tour
                      if (!in_array($city_list_in_menu['tour_category_slug'], $city_slug_array)) {
                        if ($city_list_in_menu['is_city_tour'] != 1) {
                      ?>
                          <li><a href="<?= base_url('shore-excursions/' . $city_list_in_menu['tour_category_slug']) ?>" <?= ($this->uri->segment(1) == 'shore-excursions' && $this->uri->segment(2) == $city_list_in_menu['tour_category_slug']) ? 'class="active"' : '' ?>><?= $city_list_in_menu['city_title'] ?></a></li>
                    <?php
                        }
                      }
                    }
                  }
                  if ($empty_private_tour == false && $empty_small_group == false) {
                    ?><li><a href="#">N/A</a></li>
                  <?php
                  }
                  ?>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle <?= ($this->uri->segment(1) == 'city-tours') ? 'active' : '' ?>" data-toggle="dropdown" href="#">City Tours<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <?php
                  $city_slug_array = array();
                  $get_private_type_tour = get_city_list_in_menu(3);
                  if ($get_private_type_tour) {
                    $city_list_in_menus = $get_private_type_tour;
                    foreach ($city_list_in_menus as $city_list_in_menu) {
                      $city_slug_array[] = $city_list_in_menu['tour_category_slug'];
                  ?><li><a href="<?= base_url('city-tours/' . $city_list_in_menu['tour_category_slug']) ?>" <?= ($this->uri->segment(1) == 'city-tours' && $this->uri->segment(2) == $city_list_in_menu['tour_category_slug'] && !isset($_GET['type'])) ? 'class="active"' : '' ?>><?= $city_list_in_menu['city_title'] ?></a></li>
                      <?php
                    }
                  }
                  $get_private_type_tour = get_city_list_in_menu(3, 'city-tours');
                  if ($get_private_type_tour) {
                    $city_list_in_menus = $get_private_type_tour;
                    foreach ($city_list_in_menus as $city_list_in_menu) {
                      if (!in_array($city_list_in_menu['tour_category_slug'], $city_slug_array)) {
                      ?>
                        <li>
                          <a href="<?= base_url('city-tours/' . $city_list_in_menu['tour_category_slug']) ?>" <?= ($this->uri->segment(1) == 'city-tours' && $this->uri->segment(2) == $city_list_in_menu['tour_category_slug']) ? 'class="active"' : '' ?>><?= $city_list_in_menu['city_title'] ?></a>
                        </li>
                    <?php
                      }
                    }
                  } else {
                    ?>
                    <!-- <li><a href="#">N/A</a></li> -->
                  <?php
                  }
                  ?>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle <?= ($this->uri->segment(1) == 'transfers') ? 'active' : '' ?>" data-toggle="dropdown" href="#">Transfers<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <?php
                  $get_transfer_list_in_menu = get_transfer_list_in_menu(1);
                  if ($get_transfer_list_in_menu) {
                    $city_list_in_menus = $get_transfer_list_in_menu;
                    foreach ($city_list_in_menus as $city_list_in_menu) {
                  ?><li><a href="<?= base_url('transfers/' . $city_list_in_menu['transfer_category_slug']) ?>" <?= ($this->uri->segment(1) == 'transfers' && $this->uri->segment(2) == $city_list_in_menu['transfer_category_slug']) ? 'class="active"' : '' ?>><?= $city_list_in_menu['city_title'] ?></a></li>
                    <?php
                    }
                  } else {
                    ?><li><a href="#">N/A</a></li>
                  <?php
                  }
                  ?>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle <?= ($this->uri->segment(1) == 'package-tour') ? 'active' : '' ?>" data-toggle="dropdown" href="#">Package Tour<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <?php
                  $get_package_tours = get_city_list_in_menu(8);
                  if ($get_package_tours) {
                    $city_list_in_menus = $get_package_tours;
                    foreach ($city_list_in_menus as $city_list_in_menu) {
                  ?><li><a href="<?= base_url('package-tour/' . $city_list_in_menu['tour_category_slug']) ?>" <?= ($this->uri->segment(1) == 'package-tour' && $this->uri->segment(2) == $city_list_in_menu['tour_category_slug']) ? 'class="active"' : '' ?>><?= $city_list_in_menu['city_title'] ?></a></li>
                    <?php
                    }
                  } else {
                    ?><li><a href="#">N/A</a></li>
                  <?php
                  }
                  ?>
                </ul>
              </li>
              <li><a href="<?= base_url('blogs') ?>" class="<?= ($this->uri->segment(1) == 'blogs') ? 'active' : '' ?>">Blog</a></li>
              <li><a href="#" class="contact-top-link">Contact Us</a></li>
            </ul>
          </div>
          <div class="d-flex align-items-top">
            <div class="btn-group search-btn-wrapper">
              <button type="button" class="search-btn search-tour" data-placement="bottom" title="Search tour" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search"></i>
                <i class="fas fa-times"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="search-input-wrapper">
                  <i class="fas fa-search"></i><input type="text" autocomplete="off" placeholder="Search tour" class="form-control search-control" id="searchTour" aria-describedby="emailHelp">
                </div>
                <div class="load-search-result"></div>
              </div>
            </div>
            <a href="<?= base_url('summary') ?>" class="cart-notification">
              <i class="fas fa-shopping-cart"></i>
              <span class="count"><?= cart_total_items() ?></span>
            </a>
          </div>
        </div>
      </nav>
    </header>
  <?php
  }
  ?>