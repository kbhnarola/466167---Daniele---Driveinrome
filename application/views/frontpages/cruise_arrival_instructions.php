<div class="breadcrumb n-breadcrumb">
    <div class="container">
      <p><a href="<?=BASE_URL?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<span class="title"><?=$title?></span></p>
    </div>
</div>
<?php
if(empty($cruise_arrival_instructions_details['description'])){
  echo '<h2 class="no-cms-page-content">Page has no contents!</h2>';
}else{
    echo $cruise_arrival_instructions_details['description'];
}
?>
 