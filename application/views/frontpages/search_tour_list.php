<div class="breadcrumb n-breadcrumb">
    <div class="container">
        <ul>
            <li><a href="<?= BASE_URL ?>">Home</a></li>
            <li>Search tour</li>
        </ul>
    </div>
</div>
<section class="text-section">
    <div class="container">
        <h2 class="title">Search tour</h2>
        <h4 class="searchresult-txt">Search result for : <?= $search_term . " ($total_tours " . ($total_tours > 1 ? 'Results' : 'Results') . ")" ?></h4>
        <div class="row">
            <?php
            // pr($tours, 1);
            // $tours = '';
            if ($tours) {
                $total_per_tours = count($tours);
            ?>
                <?php
                foreach ($tours as $tour) {
                    $tour_type_table_id = $tour['tour_type_table_id'];
                ?>
                    <div class="col-sm-12 col-md-12 col-lg-12 <?= ($total_per_tours > 1) ? 'col-xl-6' : 'col-xl-12' ?> ">
                        <div class="order-info">
                            <!-- load result -->
                            <div class="order-item">
                                <div class=" order-img">
                                    <div class="img-wrap">
                                        <a href="<?= BASE_URL . "tours/" . $tour['tour_slug'] ?>">
                                            <img src="<?= BASE_URL . 'uploads/' . $tour['feature_image'] ?>" onerror="this.src='https://eros.narola.online:551/pma/shs/data/driverinrome/assets/images/default//transfers_default.png';">
                                        </a>
                                    </div>
                                </div>
                                <div class="searchtour-orderinfo order-info">
                                    <a href="<?= BASE_URL . "tours/" . $tour['tour_slug'] ?>">
                                        <h4><?= $tour['tour_title'] ?></h4>
                                    </a>
                                    <h5 class="code-id">
                                        <span>Code : </span><strong><?= $tour['unique_code'] ?></strong>
                                        <ul class="searchtour-rating">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><i class="far fa-clock"></i>Duration : <?= $tour['duration'] ?>
                                                <?php if ($tour_type_table_id == 8) {
                                                    if ($tour['duration'] > 1) {
                                                ?>Days <?php
                                                    } else {
                                                        ?> Day <?php }
                                                        } else {
                                                            if ($tour['duration'] > 1) { ?> Hours<?php } else { ?>Hour<?php }
                                                                                                                } ?>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <p><i class="fas fa-map-marker-alt"></i>City : <?= $tour['tour_category_title'] ?></p>
                                        </div>

                                        <div class="col-md-12">
                                            <p><i class="fas fa-globe"></i>Type : <span class="variation-title"><?= $tour['tour_type_title'] ?></span></p>
                                        </div>
                                    </div>
                                    <div class="action-btn">
                                        <a href="<?= BASE_URL . "tours/" . $tour['tour_slug'] ?>" class="btn btn-blue">Deails</a>
                                        <?php
                                        if ($tour['tour_type_table_id'] != 8) {
                                        ?>
                                            <div class="ml-auto price-wrapper">
                                                <p class="text-right total-price"><strong><span class="currency-symbol">€</span><span class="cart-totals">
                                                            <?php
                                                            $tour_variations = array('');
                                                            $get_variation_prices_for_tours = '';
                                                            if ($tour['tour_type_table_id'] == 1) {
                                                                $tour_variations[] = '1-2';
                                                            } else if ($tour['tour_type_table_id'] == 3) {
                                                                $tour_variations[] = '1-3';
                                                            } else if ($tour['tour_type_table_id'] == 7) {
                                                                $tour_variations[] = 'Adults';
                                                            } else if ($tour['tour_type_table_id'] == 8) {
                                                                $tour_variations[] = '1';
                                                            }
                                                            $get_variation_prices_for_tours = get_variation_prices_for_tours($tour['tour_id'], $tour_variations, $tour['tour_type_table_id']);
                                                            if (!empty($get_variation_prices_for_tours)) {
                                                                if ($get_variation_prices_for_tours[0]['tour_price']) {
                                                                    $price = explode(",", $get_variation_prices_for_tours[0]['tour_price']);
                                                                    if ($get_variation_prices_for_tours[0]['tour_type_id'] == 1) {
                                                                        echo number_format(($price[3] / 8), 2);
                                                                    } elseif ($get_variation_prices_for_tours[0]['tour_type_id'] == 3) {
                                                                        echo number_format(($price[2] / 8), 2);
                                                                    } elseif ($get_variation_prices_for_tours[0]['tour_type_id'] == 7) {
                                                                        echo $price[0];
                                                                    } else {
                                                                        echo '0';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </span></strong></p>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <input type="hidden" name="tourname" class="tourname" value="Amalfi Coast Business-Shopping Private Driver">

                                <input type="hidden" name="totalmember" class="totalmember" value="1">
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="text-center review-pagination-btn mt-20 search-tour-pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            <?php
            } else {
                // echo 'No tour found for "' . $search_term . '"';
            }
            ?>
        </div>
    </div>
</section>