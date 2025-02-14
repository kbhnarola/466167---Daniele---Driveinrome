<?php
// pr($blogs);die;
?>
<section class="page-title-section">
    <div class="image-wrap">
        <img src="<?=ASSET?>images/blog_banner/<?=get_settings('blog_banner')?>">
      <h1><?php echo get_settings('blog_banner_text');?></h1>
    </div>
    <div class="breadcrumb">
      <div class="container">
        <p><a href="<?=BASE_URL?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<span class="title"><?=$title?></span></p>
      </div>
    </div>
</section>
<section class="blog-list-section">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
            <div class="blog-card-list-layout">
                <?php
                if(empty($blogs)){
                    if(!empty($_GET['s'])){
                      echo '<h1 class="not-found">No blogs found with your search!</h1>';
                    }else{
                      echo '<h1 class="not-found">No blogs exist!</h1>';
                    }
                }else{
                    ?>
                    <div class="blogs-wrapper">
                      <?php
                      // pr($blogs);die;
                      foreach($blogs as $single_blog){
                          ?>
                          <div class="blog-card-list-single herehere">
                              <div class="blog-card-list-single-image">
                                  <div class="img-wrap">
                                  <a href="<?=BASE_URL.'blogs/'.$single_blog['slug']?>"><img src="<?php echo base_url().'uploads/blogs/'.$single_blog['featured_image'];?>" onerror="this.src='<?=DEFAULT_IMAGE?>/banner_default.png';"></a>
                                  </div>
                              </div>
                              <div class="blog-card-list-single-content">
                                  <a href="<?=BASE_URL.'blogs/'.$single_blog['slug']?>">
                                    <h1 class="blog-card-list-single-title"><?=$single_blog['title']?></h1>
                                  </a>                                
                                  <p class="blog-card-list-single-details">Posted on <span class="date-posted"><?=date('F jS Y', strtotime($single_blog['created_at']));?></span> in
                                      <?php
                                      // convert cat ids to array
                                      $cat_slug = explode(",",$single_blog['cat_slug']);
                                      $categories = explode(",",$single_blog['categories']);
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
                                      <?php echo strlen(strip_tags($single_blog['content'])) > 200 ? substr(strip_tags($single_blog['content']),0,200)."..." : strip_tags($single_blog['content']);?>
                                  </div>
                                  <a href="<?=BASE_URL.'blogs/'.$single_blog['slug']?>" class="read-more">Read More <i class="far fa-long-arrow-right"></i></a>
                              </div>
                          </div>      
                          <?php
                      }
                      ?>
                    </div>
                    <?php
                    // display pagination only if more than $per_page properties
                    $total_pages = ceil($total_blogs / $per_page);
                    if($total_pages > 1){
                      ?>
                      <div class="pagination-div">
                        <ul class="custom-pagination">
                          <li class="pre disabled">
                            <a href="javascript:void(0);"><i class="fal fa-long-arrow-left"></i></a>
                          </li>
                          <?php                                                       
                          for($i = 1; $i<=$total_pages; $i++){      
                              $class=($i ==1) ? 'active' : '';
                              echo '<li data-pageno="'.$i.'" class="paginate '.$class.'"><a href="javascript:void(0);">'.$i.'</a></li>';
                          }
                          ?>
                          <li>
                            <a href="javascript:void(0);"><i class="fal fa-long-arrow-right paginate-next"></i></a>
                          </li>
                        </ul>
                      </div>
                      <?php
                    }
                    ?>                    
                    <?php
                }
                ?>                            
            </div>
        </div>
        <div class="col-md-4">
          <div class="blog-search">
            <form name="blogSearch" id="blogSearch" method="get" action="<?=BASE_URL.'/blogs'?>">            
              <input type="text" placeholder="Search" class="form-control" name="s" value="<?=!empty($_GET['s']) ? $_GET['s'] : ''?>">
              <a href="javascript:void(0);"><i class="fas fa-search"></i></a>
            </form>
              <input type="hidden" name="paging" value="1" id="paging">                               
              <input type="hidden" name="search" value="<?=!empty($_GET['s']) ? $_GET['s'] : ''?>" id="search">                               
              <input type="hidden" name="category" value="<?=(isset($category_slug) && !empty($category_slug)) ? $category_slug : ''?>" id="category">
          </div>
          <div class="blog-category">
            <h4>Categories</h4>
            <ul class="categories-list">
                <?php
                // pr($blog_categories);die;
                if(empty($blog_categories)){
                  echo '<h6>No category exist</h6>';
                }else{
                  foreach($blog_categories as $single_cat){
                      ?>
                      <li className="cat-item">
                          <a href="<?=BASE_URL.'blogs/category/'.$single_cat['slug']?>"><?=$single_cat['name']?></a>
                      </li>
                      <?php
                  }
                }
                ?>
            </ul>
          </div>
          <div class="blog-category">
            <h4>Recent Post</h4>
            <div class="recent-cat">
              <?php
                  if(empty($recent_blogs)){
                      echo '<h1>No recent blogs!</h1>';
                  }else{
                      foreach($recent_blogs as $single_blog){
                          ?>
                          <div class="recent-cat-item">
                              <div class="img-wrap">
                                  <img src="<?php echo base_url().'uploads/blogs/'.$single_blog['featured_image'];?>" onerror="this.src='<?=DEFAULT_IMAGE?>/banner_default.png';">
                              </div>
                              <div class="cat-info">
                                  <h4><?=$single_blog['title']?></h4>
                                  <span class="date-posted"><?=date('F jS Y', strtotime($single_blog['created_at']));?></span>
                              </div>
                          </div>
                          <?php
                      }
                  }
              ?>            
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    $('#blogSearch .fa-search').on('click', function(){
      $('#blogSearch').submit();
    });
    jQuery.validator.addMethod("noSpace", function(value, element) { 
        if($.trim(value).length > 0){
            return true;
        } else {
            return false;
        }
    }, "No space please and don't leave it empty");

    jQuery.validator.addMethod("noHTML", function(value, element) {
        // return true - means the field passed validation
        // return false - means the field failed validation and it triggers the error
        return this.optional(element) || /^([a-zA-Z0-9 _&?=(){},.|*+-]+)$/.test(value);
    }, "Special Characters not allowed!");
    jQuery("#blogSearch").validate({
        errorElement: 'span',
        rules:{
            s:{
                required:true,
                noSpace:true,
                noHTML:true,
                maxlength:20
            },
        },
        messages: {
            s:{
                required:"Please Enter Search Terms",
            },
        },    
        submitHandler:function(form){
            form.submit();
        }
    });

    // START ajax pagination
    $(document).on('click', '.paginate-next', function(){
        $('#paging').val( parseInt($('#paging').val()) + 1 );
        $('.paginate').removeClass('active');
        ajx_search_and_pagination();
        $('[data-pageno="'+$('#paging').val()+'"]').addClass('active');
    });
    $(document).on('click', '.paginate-prev', function(){
        $('#paging').val( parseInt($('#paging').val()) - 1 );
        $('.paginate').removeClass('active');
        ajx_search_and_pagination();
        $('[data-pageno="'+$('#paging').val()+'"]').addClass('active');
    });
    $(document).on('click', '.paginate', function(){
        if($(this).data('pageno') != $('#paging').val()){
            $('#paging').val($(this).data('pageno'));
            $('.paginate').removeClass('active');
            ajx_search_and_pagination();
            $('[data-pageno="'+$(this).data('pageno')+'"]').addClass('active');        
        }
    });

    function ajx_search_and_pagination(){
        $.ajax({
            url: BASE_URL + "welcome/get_result_html",
            type: 'POST',
            async: false,
            beforeSend: function(){ ajxLoader('show', 'body'); },
            data: {paging : $('#paging').val(), search: $('#search').val(), category: $('#category').val()},
            success: function(data){
                if(data){
                    $('.blogs-wrapper').html(data.resdata);
                    $('.custom-pagination').html(data.pagination);
                    $('.head-sell-one .total-property span').html(data.total_prop);                
                    // $('.totalcount').text(data.resultCount);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                }
            },
            error:function(data){            
            },
            complete: function(){ 
                ajxLoader('hide', 'body'); 
                $('.main-img-list img').lazy({
            placeholder: "data:image/gif;base64,R0lGODlhEALAPQAPzl5uLr9Nrl8e7..."
          });
            },
            dataType: 'json',
        });
    }
    // END ajax pagination

  </script>