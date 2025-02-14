<?php
$tour_title = (!empty($tour_details[0]['tour_category_title'])) ? $tour_details[0]['tour_category_title'] : 'N/A';
$tour_feature_image = (!empty($tour_details[0]['tour_feature_image'])) ? $tour_details[0]['tour_feature_image'] : 'N/A';

?>
<link rel="stylesheet" href="<?= ASSET ?>css/popup_video_style.css?ver=<?php echo time(); ?>" async>
<section class="page-title-section single-city">
  <div class="image-wrap">
    <img src="<?= BASE_URL ?>uploads/tour_city/<?= $tour_feature_image ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/banner_default.png';" alt="Tour Banner">
    <!-- <h1><?php //echo $tour_title;?></h1> -->
  </div>
  <div class="breadcrumb">
    <div class="container">
      <p><a href="<?= BASE_URL ?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<a href="javascript:" class="b_crum"><?= $tour_details_type ?></a>&nbsp&nbsp/&nbsp&nbsp<span class="title"><?= $tour_title ?></span></p>
    </div>
  </div>
</section>

<section class="topselling-section">
  <div class="container">
    <h2 class="title"><?= $tour_title ?></h2>
    <div class="row">
<?php
    if (!empty($tour_details)) {
        // pr($tour_details);
        // die;
        // echo 'hello :'.strpos($tour_title, ' Civitavecchia') !== false;die;
        foreach ($tour_details as $single_tour_detail) {
?>
        <div class="col-md-4">

            <div class="product-wrap">
                <div class="tag-label">
                <?php
                    if ($single_tour_detail['tour_type_table_id'] == 1) {
                        if (strpos(strtolower($tour_title), 'livorno') !== false || strpos(strtolower($tour_title), 'civitavecchia') !== false) {
                ?>
                        <img src="<?php echo base_url('assets/images/private.png'); ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';" alt="Private">
                <?php
                        }
                    }
                    if ($single_tour_detail['tour_type_table_id'] == 7) {
                        if (strpos(strtolower($tour_title), 'livorno') !== false || strpos(strtolower($tour_title), 'civitavecchia') !== false) {
                ?>
                            <img src="<?php echo base_url('assets/images/small-group.png'); ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';" alt="Small group">
                <?php
                        }
                    }
                ?>
                </div>
                <div class="image-wrap">
                  <?php
                    if ($single_tour_detail['video_url']) {
                        ?>
                        <div class="slider-popup">
                            <button class="popup-btn video-btn" data-src="<?php echo $single_tour_detail['video_url'] ?>"><i class="fas fa-play"></i></button>
                        </div>
                        <?php
                    }
                ?>
                    <a href="<?php echo base_url('transfer/' . $single_tour_detail['tour_slug']); ?>"><img class="lazyload" src="<?= DEFAULT_IMAGE ?>/transfers_default.png" data-src="<?= BASE_URL ?>uploads/<?= $single_tour_detail['feature_image'] ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';" alt="Featured"></a>
                </div>
                <div class="content-div">
            <?php
                $tour_type = 'Transfer tours';
            ?>
                    <h2><?= $tour_type ?></h2>
            <?php
                if ($tour_type == 'City Tours' || $tour_type == 'Package Tours') {
                  $tour_from = implode(' ', array_unique(explode(' ', 'Tour From ' . $single_tour_detail['tour_category_title'])));
            ?>
                    <h5><?php echo $tour_from ?></h5>
            <?php
                } else {
            ?>
                    <h5>From <?php echo str_replace('From', '', $single_tour_detail['tour_category_title']);  ?></h5>
            <?php
                } 
            ?>
                    <h6><?= $single_tour_detail['tour_title'] ?></h6>
                <div class="n-product-detail">

            <?php
                  $get_start_ratings = get_star_ratings($single_tour_detail['rating']);
                  echo $get_start_ratings;
            ?>
                <div class="p-info-wrap">
                    <div class="left">
                        <h5 class="code-id"><span>Code : </span><strong><?= $single_tour_detail['unique_code'] ?></strong></h5>
                        <h5 class="code-id"><span>Type : </span><strong><?= $single_tour_detail['tour_type_title'] ?></strong></h5>
                        <p class="duration"><i class="far fa-clock"></i>Duration : <?= $single_tour_detail['duration'] ?> 
                    <?php   if ($single_tour_detail['tour_type_table_id'] == 8) {
                                if ($single_tour_detail['duration'] > 1) { 
                                    ?>Days <?php 
                                } else { 
                                    ?> Day<?php 
                                }
                            } else {                                                                                                            if ($single_tour_detail['duration'] > 1) { 
                                    ?> Hours<?php 
                                } else { 
                                    ?>Hour<?php 
                                } 
                            } ?>
                    </p>
                    </div>
                    <div class="right">
                <?php
                      if ($single_tour_detail['tour_type_table_id'] != 8) { ?>
                        <div class="price-tag">
                          <img src="<?= ASSET ?>images/euro-price-tag.png" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';" alt="Price tag">
                          Starting From:<br>
                          <?php
                          $tour_variations = array();
                          $get_variation_prices_for_tours = '';
                          if ($single_tour_detail['tour_type_table_id'] == 9) {
                            $tour_variations[] = '1-3';
                          } else if ($single_tour_detail['tour_type_table_id'] == 10) {
                            $tour_variations[] = 'Adult';
                          }
                          $get_variation_prices_for_tours = get_variation_prices_for_tours($single_tour_detail['tour_id'], $tour_variations, $single_tour_detail['tour_type_table_id']);
                ?>
                        <span>* <?php
                                  // (!empty($get_variation_prices_for_tours)) ? $get_variation_prices_for_tours[0]['price'] : 'N/A'

                                  if (!empty($get_variation_prices_for_tours)) {
                                    if ($get_variation_prices_for_tours[0]['tour_price']) {
                                      $price = explode(",", $get_variation_prices_for_tours[0]['tour_price']);
                                      echo number_format(($price[0]), 2) . ' €';
                                      // if ($get_variation_prices_for_tours[0]['tour_type_id'] == 1) {
                                      //   echo number_format(($price[3] / 8), 2) . ' €';
                                      // } elseif ($get_variation_prices_for_tours[0]['tour_type_id'] == 3) {
                                      //   echo number_format(($price[2] / 8), 2) . ' €';
                                      // } elseif ($get_variation_prices_for_tours[0]['tour_type_id'] == 7) {
                                      //   echo $price[0] . ' €';
                                      // } 
                                    }
                                  }
                                ?> 
                        </span>
                        </div>
                      <?php } ?>
                      <a href="<?= base_url('transfer/' . $single_tour_detail['tour_slug']) ?>" class="btn btn-blue">Details</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    <?php
        }
      } else {
    ?>
        <div class="not-found">
          <h2>No Tours found in '<?= $title ?>' city</h2>
        </div>
    <?php
        }
    ?>
    </div>

    <!-- <div class="pagination-div">

        <ul class="custom-pagination">
          <li>
            <a href="#"><i class="fal fa-long-arrow-left"></i></a>
          </li>
          <li>
            <a href="#">1</a>
          </li>
          <li>
            <a href="#">2</a>
          </li>
          <li>
            <a href="#">3</a>
          </li>
          <li>
            <a href="#"><i class="fal fa-long-arrow-right"></i></a>
          </li>
        </ul>
      </div> -->

  </div>
</section>
<div id="video_modal_lg" class="modal fade video_tour_modal_lg" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
            <div class="modal-body">
                <iframe src="" id="video_url"
                    allow="autoplay; encrypted-media" width="100%" height="100%" frameborder="0"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
<?php 
    if(isset($video_modal))
    {
        echo $video_modal;
    }
?>