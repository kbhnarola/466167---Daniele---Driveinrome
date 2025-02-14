<section class="page-title-section single-transfer">
   <div class="image-wrap">
      <img src="<?=BASE_URL?>assets/images/product-details.jpg"  onerror="this.src='<?=DEFAULT_IMAGE?>/banner_default.png';">
      <h1><?=$title?></h1>
   </div>
   <div class="breadcrumb">
      <div class="container">
         <p><a href="<?=BASE_URL?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<span class="title"><?=$title?></span></p>
      </div>
   </div>
</section>
<section class="text-section">
   <div class="container">
      <h2 class="title">Thank You</h2>
      <div class="text">
         <p>Thank you for your booking request!</p>
         <p><strong>Please allow us up to 24 hours to provide you with a confirmation. </strong></p>
         <p>The confirmation will contain all the details of your booking, including complete meeting instructions and the number to call if you have trouble finding your driver or guide, or need to reach us urgently for any matter.</p>
         <!-- <p class="mb-0">Should you not hear from us within 24 hours please contact <a href="mailto:office@driverinrome.com">office@driverinrome.com</a>.
         </p>-->
         <p class="mb-0">Please contact us at <a href="mailto:office@driverinrome.com">office@driverinrome.com</a>, if you don't hear from us.
         </p> 
      </div>
   </div>
</section>
<section class="topselling-section pt-0">
   <div class="container">
      <div class="owl-carousel" id="upsellingTours">
         <?php         
         foreach($upselling_tours as $single_upselling_tour){            
            ?>
            <div class="product-wrap">
               <div class="image-wrap">
                  <img src="<?=base_url('uploads/'.$single_upselling_tour['feature_image'])?>" onerror="this.src='<?=ASSET.'images/default/transfers_default.png'?>';">
               </div>
               <div class="content-div">
                  <?php
                  $tour_type = 'Shore Excursions';
                  $tour_type_table_id = $single_upselling_tour['tour_type_id'];
                  if($tour_type_table_id == 1 || $tour_type_table_id == 7){
                        $tour_type = 'Shore Excursions';
                  }else if($tour_type_table_id == 3){
                     $tour_type = 'City Tours';
                  }else if($tour_type_table_id == 8){
                     $tour_type = 'Package Tours';
                  }
                  ?>
                  <h2><?=$tour_type?></h2>
                  <h5>From the Port of <?=$single_upselling_tour['city']?></h5>                  
                  <h6><?=$single_upselling_tour['title'] ?></h6>
                  <div class="n-product-detail">
                     <?php
                     $get_start_ratings = get_star_ratings($single_upselling_tour['rating']);
                     echo $get_start_ratings;
                     ?>
                     <div class="p-info-wrap">
                        <div class="left">
                           <p class="duration"><i class="far fa-clock"></i>City : <?=$single_upselling_tour['city']?></p>
                        </div>
                        <div class="right">
                           <a href="<?=base_url('tours/'.$single_upselling_tour['slug'])?>" class="btn btn-blue">Book Now</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php
         }
         ?>
      </div>
   </div>
</section>
<script>
var owl = $('#upsellingTours').owlCarousel({
    loop: true,
    item: 3,
    autoHeight:false,
    responsiveClass: true,
    nav: true,
    margin: 10,   
    dots:false, 
    autoplayTimeout: 4000,
    smartSpeed: 400,
    center: true,
    navText: ['<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>'],
     responsive:{
          1024:{
              items:3
          },
          600:{
              items:2,
              nav:true,
              center:false
          },
          0:{
              items:1,
              nav:true,
              center:false
          }
      }
});
/****************************/
jQuery(document.documentElement).keydown(function (event) {    
    // var owl = jQuery("#carousel");
    // handle cursor keys
    if (event.keyCode == 37) {
       // go left
      owl.trigger('prev.owl.carousel', [400]);
      //owl.trigger('owl.prev');
    } else if (event.keyCode == 39) {
       // go right
        owl.trigger('next.owl.carousel', [400]);
       //owl.trigger('owl.next');
    }
});   
</script>