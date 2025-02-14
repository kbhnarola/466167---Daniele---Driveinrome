<section class="banner-section">
    <div id="demo" class="carousel slide">

      <!-- Indicators -->
      
      
      <!-- The slideshow -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?=ASSET?>images/Banner.jpg" alt="Los Angeles">
          <div class="carousel-caption">
            <h3>VACATION IN</h3>
            <h2>ROME</h2>
            <a href="#" class="btn btn-blue">DISCOVER</a>
          </div>
        </div>
        <div class="carousel-item">
          <img src="<?=ASSET?>images/Banner.jpg" alt="Chicago">
          <div class="carousel-caption">
            <h3>VACATION IN</h3>
            <h2>ROME</h2>
            <a href="#" class="btn btn-blue">DISCOVER</a>
          </div>
        </div>
        <div class="carousel-item">
          <img src="<?=ASSET?>images/Banner.jpg" alt="New York">
          <div class="carousel-caption">
            <h3>VACATION IN</h3>
            <h2>ROME</h2>
            <a href="#" class="btn btn-blue">DISCOVER</a>
          </div>
        </div>
      </div>
      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
      </ul>
    </div>
  </section>
  
  <section class="topselling-section">
    <div class="container"> 
      <h2 class="title">Top Selling Tours</h2>
      <div class="slider-wrap">
        <div id="topselling">
            <div id="screenshot_slider" class="screenshot_slider owl-carousel">
              
            <?php
            if(!empty($tours_list)){
              foreach($tours_list as $tour_list){
                ?>
                <div class="item">
                    <div class="product-wrap">
                      <div class="image-wrap">
                        <img src="<?=BASE_URL?>uploads/<?=$tour_list['feature_image']?>">
                      </div>
                      <div class="content-div">
                        <h2><?=$tour_list['tour_type_title']?></h2>
                        <h5>From the Port of <?=$tour_list['tour_category_title']?></h5>
                        <h6><?=$tour_list['tour_title']?></h6>
                        <?php
                        $get_start_ratings = get_star_ratings($tour_list['rating']);
                        echo $get_start_ratings;
                        ?>
                        
                        <div class="discover">
                          <p><i class="far fa-clock"></i>Duration : <?=$tour_list['duration']?> Hours</p>
                          <a href="<?=BASE_URL . base64_encode($tour_list['id'])?>" class="btn btn-blue">Discover</a>
                        </div>
                      </div>
                    </div>
                </div>
                <?php
              }
            }else{              
              echo '<h4>No Top Selling Tours available</h4>';
            }
            ?>
                    </div>
                </div>            
            </div>
        </div>
      </div>
    </div>
  </section>