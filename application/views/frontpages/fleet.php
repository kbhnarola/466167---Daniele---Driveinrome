<div class="breadcrumb n-breadcrumb">
    <div class="container">
		<p><a href="<?=BASE_URL?>">Home</a>&nbsp&nbsp/&nbsp&nbsp<span class="title"><?=$title?></span></p>
    </div>
</div>
<?php
if(empty($fleet_details['description'])){
  echo '<h2 class="no-cms-page-content">Page has no contents!</h2>';
}else{ ?>
	<section class="topselling-section fleet-section">
		<div class="container"> 
		    <h2 class="title">FLEET</h2>
		    	<div class="row">
	<?php		      
   // echo $fleet_details['description'];
	$fleet_description=@unserialize($fleet_details['description']);
	if(is_array($fleet_description) && sizeof($fleet_description)>0) { 
    foreach($fleet_description as $fleet){?>
		      
		        <div class="col-md-4">
		          <div class="product-wrap">
		            <div class="image-wrap">
		              <img src="<?php echo base_url('uploads/fleets/'.$fleet['feature_image']);?>" onerror="this.src='<?php echo base_url('uploads/fleets/FLEET-1.jpg');?>">
		            </div>
		            <div class="content-div">
		              <h6><?php echo $fleet['fleet_title'];?></h6>
		              <p class="m-0"><?php echo $fleet['description'];?></p>
		            </div>
		          </div>
		        </div>
		      
	<?php } } ?>
			</div>
		</div>
	</section><?php }
?>