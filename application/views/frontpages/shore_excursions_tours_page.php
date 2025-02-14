<div class="breadcrumb n-breadcrumb">
    <div class="container">
      <p><a href="<?=BASE_URL?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<span class="title"><?=$title?></span></p>
    </div>
</div>
<section class="topselling-section fleet-section">
<div class="container">
	<div class="col-md-12">
		<h2 class="title"><?php echo $cms_page_data['page_title'];?></h2>
		<div class="content-div">
<?php
	if(empty($cms_page_data['description'])){
	  echo '<h2 class="no-cms-page-content">Page has no contents!</h2>';
	}else{
	    echo $cms_page_data['description'];
	}
?>
</div>
</div>
</div>
</section>