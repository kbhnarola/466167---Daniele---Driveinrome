<?php
if(empty($single_blog)){
    set_alert('error',"Records Not Found");
    redirect('');
}else{

?>
    <section class="page-title-section">
        <div class="image-wrap">
            <img src="<?php echo base_url().'uploads/blogs/'.$single_blog['banner_image'];?>" onerror="this.src='<?=DEFAULT_IMAGE?>/banner_default.png';">
        </div>
    </section>
    <section class="single-blog">
        <div class="blog-detail-wrapper">
            <h1 class="entry__title"><?=$title?></h1>
            <div class="entry__meta">
                <span class="posted-on">Posted on 
                <a href="">
                    <time class="entry__date published updated"><?=date('F jS Y', strtotime($single_blog['created_at']));?></time>
                </a>
                </span>
            </div>
            <div class="img-wrap">
                <img src="<?php echo base_url().'uploads/blogs/'.$single_blog['featured_image'];?>" onerror="this.src='<?=DEFAULT_IMAGE?>/banner_default.png';">
            </div>
            <div class="single-blog-content"><?=$single_blog['content']?></div>
        </div>
    </section>
   <?php
   if(!empty($related_blogs)){
      ?>
      <section class="related-blogs">
         <div class="container">                                          
            <h2 class="title">Related Blogs</h2>
            <div class="row">
               <?php
               foreach($related_blogs as $single_related_blog){
               ?>
                  <div class="col-md-4">
                     <div class="product-wrap">
                        <div class="image-wrap">
                           <a href="<?=BASE_URL.'blogs/'.$single_related_blog['slug']?>"><img src="<?php echo base_url().'uploads/blogs/'.$single_related_blog['featured_image'];?>" onerror="this.src='<?=DEFAULT_IMAGE?>/banner_default.png';"></a>
                        </div>
                        <div class="content-div">
                           <a href="<?=BASE_URL.'blogs/'.$single_related_blog['slug']?>">
                              <h3 class="blog-card-list-single-title"><?=$single_related_blog['title']?></h3>
                           </a>
                           <p class="blog-card-list-single-details">Posted on <span class="date-posted"><?=date('F jS Y', strtotime($single_related_blog['created_at']));?></span> in
                           <?php
                           // convert cat ids to array
                           $cat_slug = explode(",",$single_related_blog['cat_slug']);
                           $categories = explode(",",$single_related_blog['categories']);
                           $i = 0;
                           if(!empty($categories)){
                              foreach($categories as $single_cat){
                                    ?><a class="category-list" href="<?=BASE_URL.'blogs/category/'.trim($cat_slug[$i])?>"><?=$single_cat?></a>
                                    &nbsp;<?php
                                    $i++;
                              }
                           }
                           ?>
                        </p>
                        <div class="blog-card-list-single-intro">
                           <?php echo strlen(strip_tags($single_related_blog['content'])) > 200 ? substr(strip_tags($single_related_blog['content']),0,200)."..." : strip_tags($single_related_blog['content']);?>
                        </div>
                        <a href="<?=BASE_URL.'blogs/'.$single_related_blog['slug']?>" class="read-more">Read More <i class="far fa-long-arrow-right"></i></a>
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
<?php
}
?>