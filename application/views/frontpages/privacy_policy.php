<div class="breadcrumb n-breadcrumb">
    <div class="container">
      <p><a href="<?=BASE_URL?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<span class="title"><?=$title?></span></p>
    </div>
</div>
<?php
if(empty($privacy_policy_details['description'])){
  echo '<h2 class="no-cms-page-content">Page has no contents!</h2>';
}else{
    echo $privacy_policy_details['description'];
}
?>
 