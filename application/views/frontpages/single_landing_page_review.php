<section class="section-title review-title">
    <div class="container">
        <h3><?= ucwords(str_replace("-", " ", $this->uri->segment(2))) ?></h3>
    </div>
</section>
<section class="pt-40 pb-80 review-section">
    <div class="container">
        <!-- <div id="single-review-slider" class="single-review-slider owl-carousel"> -->
        <div id="single-review-slider" class="single-review-slider single_rev_feature_img">
            <?php
            if (is_array($reviews) && sizeof($reviews) > 0) {
            ?>
                <div class="item ">
                    <div class="single-review-content">
                        <div class="gallery row">
                            <div class="col-md-4 text-center">
                                <?php
                                if ($reviews['feature_image']) { ?>
                                    <img class="reviewfeature-image imgClass1" src="<?php echo base_url() . '/uploads/review_images/' . $reviews['feature_image']; ?>" onerror="this.src='<?php echo base_url() . "assets/images/blue-logo.svg"; ?>'" alt="Review Feature Image">
                                <?php } else { ?>
                                    <img class="reviewfeature-image review_logo_img imgClass1" src="<?php echo base_url() . 'assets/images/blue-logo.svg'; ?>" alt="Review Feature Image">
                                <?php } ?>

                            </div>
                            <div class="col-md-8 gallery_img owl-carousel">
                                <?php
                                if (is_array($review_gallery) && sizeof($review_gallery) > 0) {
                                    foreach ($review_gallery as $r_g) {
                                        if ($r_g['review_id'] == $reviews['id']) {
                                            if ($r_g['gallery_image_name']) {
                                                if (file_exists('uploads/review_images/' . $r_g['gallery_image_name'])) { ?>
                                                    <div class="item">
                                                        <a class="lightbox-gallery" href="javascript:" title="title-gallery">
                                                            <div class="visual lightbox">
                                                                <img src="<?php echo base_url() . '/uploads/review_images/' . $r_g['gallery_image_name']; ?>" class="imgClass1" alt="image-gallery">
                                                                <span class="moon-zoom"></span>
                                                            </div>
                                                        </a>
                                                    </div>
                                <?php }
                                            }
                                        }
                                    }
                                } ?>
                            </div>
                        </div>
                        <div class="pagination-main">
                            <?php
                            if (is_array($get_previous_review) && sizeof($get_previous_review) > 0) {
                                if ($get_previous_review['slug']) { ?>
                                    <a class="pagination-review prev-btn" href="<?php echo base_url() . 'page/' . $this->uri->segment(2) . '/reviews/' . $get_previous_review['slug']; ?>"><i class="fas fa-chevron-left"></i></a>
                                <?php } else { ?>
                                    <!-- <a class="pagination-review prev-btn" href="javascript:"><i class="fas fa-chevron-left"></i></a>  -->
                                <?php }
                            } else { ?>
                                <!-- <a class="pagination-review prev-btn" href="javascript:"><i class="fas fa-chevron-left"></i></a> -->
                            <?php } ?>
                            <?php
                            if (is_array($get_next_review) && sizeof($get_next_review) > 0) {
                                if ($get_next_review['slug']) { ?>
                                    <a class="pagination-review next-btn" href="<?php echo base_url() . 'page/' . $this->uri->segment(2) . '/reviews/' . $get_next_review['slug']; ?>"><i class="fas fa-chevron-right"></i></a>
                                <?php } else { ?>
                                    <!-- <a class="pagination-review next-btn" href="javascript:"><i class="fas fa-chevron-right"></i></a>  -->
                                <?php }
                            } else { ?>
                                <!-- <a class="pagination-review next-btn" href="javascript:"><i class="fas fa-chevron-right"></i></a> -->
                            <?php } ?>
                        </div>
                        <div class="text-content">
                            <h4><?php echo $reviews['title']; ?></h4>
                            <p><strong><?php if ($reviews['review_date'] != "" && $reviews['review_date'] != "0000-00-00") {
                                            echo date("M Y", strtotime($reviews['review_date']));
                                        } ?></strong></p>
                            <p><?php echo $reviews['description']; ?></p>
                            <p><strong><?php echo $reviews['username']; ?></strong></p>
                        </div>
                    </div>
                </div>
            <?php }  ?>
        </div>
        <hr>
        <div class="mt-20 backbtn-wrapper">
            <!-- <a href="<?php //echo base_url().'reviews/'.$this->uri->segment(2);
                            ?>" class="btn btn-blue float-left"><i class="fal fa-long-arrow-left"></i>&nbsp;&nbsp;Back to Reviews List</a> -->
            <a href="<?php echo base_url() . 'tour-landing-page/' . $this->uri->segment(2); ?>" class="btn btn-blue float-left"><i class="fal fa-long-arrow-left"></i>&nbsp;&nbsp;Back to Landing Page</a>
        </div>
    </div>
</section>
<script src="<?php echo base_url() . 'assets/js/EZView.js'; ?>"></script>
<script>
    $(function() {
        $('[data-toggle="popover"]').popover()
    });

    jQuery(".imgClass1").EZView();
    // $('#single-review-slider').owlCarousel({
    //     loop:true,
    //     margin:10,
    //     nav:true,
    //     navText: ['<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>'],
    //     responsive:{
    //         0:{
    //             items:1
    //         }
    //     }
    // });
    $('.gallery_img').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        navText: ['<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>'],
        responsive: {
            0: {
                items: 1
            }
        }
    });
</script>