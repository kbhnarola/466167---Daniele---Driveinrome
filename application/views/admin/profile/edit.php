<!-- Page header -->
<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title">
      <h4>
      	<span class="text-semibold"><?php _el('edit_profile'); ?></span>
      </h4>
    </div>
  </div>
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
			<li><a href="<?php echo admin_url('dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a></li>			
			<li class="active"><?php _el('edit_profile'); ?></li>
		</ul>
  </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
	<div class="row">
		<!-- Left column -->
		<div class="col-md-7">
			<form action="<?php echo admin_url('profile/edit/') ?>" id="myprofileform" method="POST">
				<!-- Panel -->
				<div class="panel panel-flat">
					<!-- Panel heading -->
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-10">
								<h5 class="panel-title"><?php echo get_loggedin_info('admin_email'); ?></h5>
							</div>
						</div>
					</div>
					<!-- /Panel heading -->
					<!-- Panel body -->
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									
									<label class="col-form-label label_text text-lg-right"><?php _el('username'); ?>:<small class="req text-danger">* </small></label>
									<input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>">
								</div>
								
								<div class="form-group">
									<label class="col-form-label label_text text-lg-right"><?php _el('email'); ?>:</label>
									<input type="text" class="form-control" disabled readonly id="email" name="email" class="email" value="<?php echo $user['email']; ?>">
								</div>	
								
								<div class="form-group" align="right">
									<button type="submit" class="btn btn-success " name="submit" id="save"><?php _el('save'); ?></button>
								</div>
							</div>
						</div>	
					</div>
					<!-- /Panel body -->
				</div>
				<!-- /Panel -->
			</form>
		</div>
		<!-- /Left column -->
		<!-- Right column -->
		<div class="col-md-5">
			<form action="<?php echo admin_url('profile/edit_password/') ?>" id="mypasswordform" method="POST">
				<!-- Panel -->
				<div class="panel panel-flat">
					<!-- Panel heading -->
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-10">
								<h5 class="panel-title"><?php _el('change_password'); ?></h5>
							</div>
						</div>
					</div>
					<!-- /Panel heading -->
					<!-- Panel body -->
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								
								<div class="form-group">
									<!-- <small class="req text-danger">* </small> -->
									<label class="col-form-label label_text text-lg-right"><?php _el('old_password'); ?>:<small class="req text-danger">* </small></label>
									<input type="password" name="old_password" class="form-control" id="old_password" autocomplete="off">							
									<i class="fa fa-eye toggle-password" id="toggleOldPassword"></i>
								</div>
								<div class="form-group">
									<!-- <small class="req text-danger">* </small> -->
									<label class="col-form-label label_text text-lg-right"><?php _el('new_password'); ?>:<small class="req text-danger">* </small></label>
									<input type="password" class="form-control" id="new_password" name="new_password" autocomplete="off">
									<i class="fa fa-eye toggle-password" id="toggleNewPassword"></i>	
								</div>
								<div class="form-group">
									<!-- <small class="req text-danger">* </small> -->
									<label class="col-form-label label_text text-lg-right"><?php _el('confirm_password'); ?>:<small class="req text-danger">* </small></label>
									<input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="off">
									<i class="fa fa-eye toggle-password" id="toggleConfirmPassword"></i>						
								</div>
								<div class="form-group" align="right">
									<button type="submit" class="btn btn-success" name="submit_password" id="submit_password"><?php _el('save'); ?></button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Panel body -->
				</div>
				<!-- /Panel -->
			</form>
		</div>
		<!-- /Right column -->
	</div>
</div>
<!-- /Content area -->
