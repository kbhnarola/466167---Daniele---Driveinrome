<section class="section-title">
    <div class="container">
      <h3>Review</h3>
    </div>
</section>
<section class="pt-80 pb-80 review-section">
  <div class="container">
      <div class="inner-two_titles">
        <h5>Read the latest reviews and testimonials from our clients</h5>
      </div>
      <div class="review-list">
        <?php 
        if (is_array($reviews) && sizeof($reviews)>0) { 
          foreach($reviews as $r) { ?>
          <div class="review-item">
            <div class="img-wrap">
              <?php
                  if($r['feature_image']) { ?>
                  <img src="<?php echo base_url().'/uploads/review_images/'.$r['feature_image'];?>" onerror="this.src='<?php echo base_url().'assets/images/blue-logo.svg';?>">
              <?php } else { ?>
                    <img src="<?php echo base_url().'assets/images/blue-logo.svg';?>">
              <?php } ?>
            </div>
            <div class="text-content">
              <h3>
                <?php 
                if($r['tour_id']) {
                  if(get_tour_slug_review($r['tour_id'])) { ?>
                    <a href="<?php echo base_url().'reviews/'.get_tour_slug_review($r['tour_id']).'/'.$r['slug']; ?>"><?php echo $r['title']; ?></a>
                  <?php } else { ?>
                    <a href="javascript:"><?php echo $r['title']; ?></a>
                  <?php } } else { ?>
                    <a href="javascript:"><?php echo $r['title']; ?></a>
                <?php } ?>
              </h3>
              <?php
              if($r['description']) {
                $desc=preg_replace("/<img[^>]+\>/i", " ", $r['description']); 
                $final_desc=preg_replace("/<\/?a( [^>]*)?>/i", "", $desc);
                if(strlen($final_desc) > 200) { 
                   ?>
                <p> <?php echo substr($final_desc,0,200); ?>&nbsp; 
                  <?php 
                  if($r['tour_id']) {
                    if(get_tour_slug_review($r['tour_id'])) { ?>
                      <a href="<?php echo base_url().'reviews/'.get_tour_slug_review($r['tour_id']).'/'.$r['slug']; ?>">Read more</a>
                    <?php } else { ?>
                    <strong><a href="javascript:">Read more</a></strong>
                  <?php } } else { ?>
                    <strong><a href="javascript:">Read more</a></strong>
                <?php } ?>
                </p>
                <?php } else { ?>
                <p><?php echo $final_desc; ?></p>
              <?php } } else {
                  echo "<p></p>";
              } ?>
            </div>
          </div>
        <?php } } else { ?>
          <h5>No Reviews Found</h5>
        <?php } ?>
      </div>
  </div>
</section>