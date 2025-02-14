<div class="breadcrumb n-breadcrumb">
    <div class="container">
      <ul>
        <li><a href="<?=BASE_URL?>">Home</a></li>
        <li>Our Guarantee</li> 
      </ul>
    </div>
</div>
<?php
if(empty($our_guarantee_details['description'])){
  echo '<h2 class="no-cms-page-content">Page has no contents!</h2>';
}else{
    echo $our_guarantee_details['description'];
}
?>
 