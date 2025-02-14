<section class="page-title-section">

  <div class="image-wrap">

    <img src="<?= ASSET ?>images/aboutus.jpg">

    <h1>About Us</h1>

  </div>

  <div class="breadcrumb">

    <div class="container">

      <p><a href="<?= BASE_URL ?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<span class="title">About Us</span></p>

    </div>

  </div>

</section>

<?php

if (empty($about_us_details['description'])) {

  echo '<h2 class="no-cms-page-content">Page has no contents!</h2>';
} else {

  echo $about_us_details['description'];

?>

  <section class="videos-section">

    <div class="container">

      <div class="row">

        <?php

        // echo $about_us_details['video_links'];

        $video_links = unserialize($about_us_details['video_links']);

        foreach ($video_links as $video_link) {

        ?>

          <div class="col-md-4">

            <div class="content">

              <div class="video-wrap">

                <img src="<?php echo base_url('uploads/about_us/' . $video_link['feature_image']); ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';">

              </div>

              <!-- <a href="<?php //echo $video_link['you_tube_link']
                            ?>" class="play-icon" target="_blank"><i class="fab fa-youtube"></i></a> -->
              <a href="<?= $video_link['you_tube_link'] ?>" class="play-icon youtube-link"><i class="fab fa-youtube"></i></a>

              <div class="text">

                <h5><?= $video_link['title'] ?></h5>

                <i class="fal fa-long-arrow-right"></i>

              </div>

            </div>

          </div>

        <?php

        }

        ?>

      </div>

    </div>

  </section>

<?php

}

?>