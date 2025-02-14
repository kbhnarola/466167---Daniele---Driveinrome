<section class="page-title-section">
    <div class="image-wrap">
        <img src="<?=ASSET?>images/fireworks_banner.jpg">
        <h1>Write a Review</h1>
    </div>
    <div class="breadcrumb">
        <div class="container">
        <p><a href="<?=BASE_URL?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<span class="title">Write a Review</span></p>
        </div>
    </div>
</section>
<?php
if (empty($review_details['description'])) {
    echo '<h2 class="no-cms-page-content">Page has no contents!</h2>';
} else {
    echo $review_details['description'];
    if(!empty($review_platform_details)){
        ?>
           <section class="videos-section">
            <div class="container">
                <div class="row justify-content-center">
                    <?php
                        foreach ($review_platform_details as $review_details) {
                            $star_rating = $review_details['review_platform_rating'];
                            $exclude_review_page = $review_details['exclude_review_page'];
                            if(empty($exclude_review_page)){
                            ?>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4 mb-lg-0">
                                <div class="review_card mb-3">
                                    <div class="review_icon">
                                        <img src="<?php echo base_url('assets/images/review_imgs/' . $review_details['review_image']); ?>" class="img-fluid" alt=""/>
                                    </div>
                                    <div class="review_info">
                                        <h3><?php echo $review_details['review_platform_name']; ?></h3>
                                        <div class="review_count">
                                            <span><?php echo $star_rating; ?></span>
                                            <div class="product-wrap">
                                                <div class="content-div p-0">
                                                    <?php 
                                                        $maxStars = 5;
                                                        // Calculate the number of filled stars
                                                        $filledStars = floor($star_rating);
                                                        
                                                        // Check if we need to show a half star
                                                        $halfStar = ($star_rating - $filledStars) >= 0.5;
                                                    ?>
                                                    <ul class="rating">
                                                        <?php 
                                                        $html = '';
                                                            // Filled stars
                                                            for ($i = 0; $i < $filledStars; $i++) {
                                                                $html .= '<li><i class="fas fa-star"></i></li>';
                                                            }
                                                            
                                                            // Half star if necessary
                                                            if ($halfStar) {
                                                                $html .= '<li><i class="fas fa-star-half-alt"></i></li>';
                                                                $filledStars++;
                                                            }
                                                            
                                                            // Empty stars
                                                            for ($i = $filledStars; $i < $maxStars; $i++) {
                                                                $html .= '<li><i class="far fa-star"></i></li>';
                                                            }
                                                            echo $html;
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <p>Based on <?php echo $review_details['review_based_on']; ?> reviews</p>
                                        <div class="review_link text-center">
                                            <a href="<?php echo $review_details['review_links']; ?>" class="btn btn-blue"> Write a Review </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
?>
<a href="#" data-toggle="modal" data-target="#platform_modal">
    <!-- <img src="<?//=ASSET?>images/Getacall.png" alt="Call"> -->
</a>
<div id="platform_modal" class="modal fade platform_modal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
            </div>
            <div class="modal-body mt-2 mb-1">
                <div class="modal-form">
                    <div class="review_card_modal">
                        <?php 
                            if(!empty($review_platform_details)){
                                foreach ($review_platform_details as $review_details) {
                                    $exclude_review_page = $review_details['exclude_review_page'];
                                    if(empty($exclude_review_page)){
                                    ?>
                                    <div class="review_card mt-3 mb-3" onclick="window.open('<?php echo $review_details['review_links']; ?>', '_blank')">
                                        <div class="review_icon">
                                            <img src="<?php echo base_url('assets/images/review_imgs/' . $review_details['review_image']); ?>" class="img-fluid" alt="">
                                        </div>
                                        <div class="review_info">
                                            <h3><?php echo $review_details['review_platform_name']; ?></h3> 
                                        </div>
                                    </div>
                                    <?php 
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            if($('.review_card').length > 0){
                $('#platform_modal').modal('show');
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    });
    
</script>