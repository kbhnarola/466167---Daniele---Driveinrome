<section class="banner-section">
  <div id="demo" class="carousel slide">
    <!-- Indicators -->
    <!-- The slideshow -->
    <div class="carousel-inner">
      <?php
      if (get_settings('home_banner1')) {
      ?>
        <div class="carousel-item active">
          <img src="<?= ASSET ?>images/home_page_banner/<?= get_settings('home_banner1') ?>" alt="Los Angeles" onerror="this.src='<?= DEFAULT_IMAGE ?>/banner_default.png';">
          <div class="carousel-caption">
            <button class="popup-btn"><i class="fas fa-play"></i></button>
            <h3><?php echo get_settings('banner1_text_small'); ?></h3>
            <h2><?php echo get_settings('banner1_text_big'); ?></h2>
          </div>

          <div class="video-popup">
            <div class="popup-bg"></div>
            <div class="popup-content">
              <video class="js-player" loop muted>
                <source src="<?php echo base_url('uploads/home/home-page-video.mp4') ?>" type="video/mp4">
              </video>
              <button class="fullscreen-btn" onclick="openFullscreen();"><i class="fas fa-expand"></i></button>
              <button class="close-btn"><i class="fas fa-times"></i></button>
            </div>
          </div>

        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>
<section class="topselling-section">
  <div class="container">
    <h2 class="title">Top Selling Tours</h2>
    <div class="slider-wrap">
      <div id="topselling">
        <div id="screenshot_slider" class="screenshot_slider owl-carousel">
          <?php
          if (!empty($tours_list)) {
            foreach ($tours_list as $tour_list) {
          ?>
              <div class="item">
                <div class="product-wrap">
                  <div class="tag-label">
                    <?php
                    if ($tour_list['tour_type_table_id'] == 1) {
                    ?>
                      <img src="<?php echo base_url('assets/images/private.png'); ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';" alt="Private Label">
                    <?php
                    } else if ($tour_list['tour_type_table_id'] == 7) {
                    ?>
                      <img src="<?php echo base_url('assets/images/small-group.png'); ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';" alt="Small group Label">
                    <?php
                    }
                    ?>
                  </div>
                  <div class="image-wrap">
                    <a href="<?php echo base_url('tours/' . $tour_list['tour_slug']); ?>"><img src="<?= BASE_URL ?>uploads/<?= $tour_list['feature_image'] ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';" alt="Feature"></a>
                  </div>
                  <div class="content-div">
                    <?php
                    $tour_type = 'Shore Excursions';
                    $tour_type_table_id = $tour_list['tour_type_table_id'];
                    if ($tour_type_table_id == 1 || $tour_type_table_id == 7) {
                      $tour_type = 'Shore Excursions';
                    } else if ($tour_type_table_id == 3) {
                      $tour_type = 'City Tours';
                    } else if ($tour_type_table_id == 8) {
                      $tour_type = 'Package Tours';
                    }
                    ?>
                    <h2><?= $tour_type ?></h2>
                    <h5>From the Port of <?= $tour_list['tour_category_title'] ?></h5>
                    <h6><?= !empty($tour_list['meta_title']) ? $tour_list['meta_title'] : $tour_list['tour_title'] ?></h6>
                    <?php
                    $get_start_ratings = get_star_ratings($tour_list['rating']);
                    echo $get_start_ratings;
                    ?>

                    <div class="discover">
                      <p><i class="far fa-clock"></i>Duration : <?= $tour_list['duration'] ?>
                        <?php if ($tour_type_table_id == 8) {
                          if ($tour_list['duration'] > 1) { ?>Days <?php } else { ?> Day<?php }
                                                                                    } else {
                                                                                      if ($tour_list['duration'] > 1) { ?> Hours<?php } else { ?>Hour<?php }
                                                                                                                                                  } ?></p>
                      <a href="<?php echo base_url('tours/' . $tour_list['tour_slug']); ?>" class="btn btn-blue">Discover</a>
                    </div>
                  </div>
                </div>
              </div>
          <?php
            }
          } else {
            echo '<h4>No Top Selling Tours available</h4>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="video-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-6 right-wrapper ">
        <div class="youtube-body">
          <iframe src="<?php echo get_settings('home_video') ?>" frameborder="0" width="100%" height="100%"></iframe>
        </div>
      </div>
      <div class="col-md-12 col-lg-12 col-xl-6 left-wrapper mt-4 mt-xl-0">
        <h2 class="title text-left mb-3"><?php echo get_settings('home_video_title') ?></h2>
        <div class="description">
          <?php
          $charactersToDisplay = 400;
          $lessDescription = substr(get_settings('home_video_description'), 0, $charactersToDisplay);
          $moreDescription = substr(get_settings('home_video_description'), $charactersToDisplay);
          ?>
          <p>
            <?php
            echo $lessDescription;
            if (strlen(get_settings('home_video_description')) > $charactersToDisplay) {
            ?>
              <span id="dots">...</span>
            <?php
            }
            ?>
            <span id="more">
              <?php echo $moreDescription ?>
            </span>
          </p>
          <a onclick="myFunction()" id="myBtn" class="readMore">Read more</a>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function() {
    $(".popup-btn").on("click", function() {
      $(".video-popup").fadeIn("slow");
      return false;
    });

    $(".popup-bg").on("click", function() {
      $(".video-popup").slideUp("slow");
      return false;
    });

    $(".close-btn").on("click", function() {
      $(".video-popup").fadeOut("slow");
      return false;
    });
    $(".popup-btn").on("click", function() {
      $(".plyr__control").trigger("click");
    });
  });
  // read more
  function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");

    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "Read more";
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "Read less";
      moreText.style.display = "inline";
    }
  }

  // Full screenvideo java - script
  var elem = document.getElementById("myvideo");

  function openFullscreen() {
    if (elem.requestFullscreen) {
      elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) {
      /* Safari */
      elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) {
      /* IE11 */
      elem.msRequestFullscreen();
    }
  }

  // Player video start
  var playerSettings = {
    controls: ['play-large'],
    fullscreen: {
      enabled: false
    },
    resetOnEnd: true,
    hideControls: true,
    clickToPlay: true,
    // keyboard: true,
  }
  const players = Plyr.setup('.js-player', playerSettings);
  players.forEach(function(instance, index) {
    instance.on('play', function() {
      players.forEach(function(instance1, index1) {
        if (instance != instance1) {
          instance1.pause();
        }
      });
    });
  });
  // Player video end
</script>