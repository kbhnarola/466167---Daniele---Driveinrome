<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $this->page_title; ?></title>
	<noscript>
		<!-- <meta http-equiv="refresh" content="0; url = <?php //echo BASE_URL;?>" /> -->
		<link href="<?php echo ASSET.'css/no_js.css';?>" rel="stylesheet" type="text/css" >
		<div class="md" id="modal-one" aria-hidden="true">
            <div class="md-dialog">
                <div class="md-header">
                     <h2>Enable Javascript</h2>
                     <!-- <a href="#modal-one" class="bt-close" aria-hidden="true">×</a> -->
                </div>
                <div class="md-body">
                    <h3 class="text-center">Warning!</h3>
                    <p>Sorry, an error has occured, Please Enable javascript in your browser to access website.</p>
                </div>
                <div class="md-footer"> 
                	<!-- <a href="#modal-one" class="btn-md">Ok</a> -->

                </div>
            </div>
        </div> 
    </noscript>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	
	<link href="<?php echo base_url('assets/css/icons/fontawesome/styles.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/icons/icomoon/styles.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/core.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/components.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/colors.css'); ?>" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" type="image/png" href="<?php echo ASSET.'images/favicon.png';?>"/>
	<!-- /global stylesheets -->

	<!-- Custom stylesheets -->

	<link href="<?php echo base_url('assets/css/loader.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/admin_custom.css'); ?>" rel="stylesheet" type="text/css">
	<?php
		if($this->uri->segment(2)=="dashboard" || ($this->uri->segment(2)=="tours" && ($this->uri->segment(3)=="add" || $this->uri->segment(3)=="edit"))) {?>
		<link href="<?php echo base_url('assets/css/bootstrap-datepicker.css'); ?>" rel="stylesheet" type="text/css">
	<?php } ?>
	<?php
		if($this->uri->segment(2)=="dashboard") { ?>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-slider.min.css'); ?>">
	<?php }?>
	<?php
		if($this->uri->segment(2)=="tours" && ($this->uri->segment(3)=="add" || $this->uri->segment(3)=="edit")) {?>
		<link href="<?php echo base_url('assets/css/multistep_form.css'); ?>" rel="stylesheet" type="text/css">
	<?php } ?>	
	<!-- End Custom stylesheets -->

	<!-- Core JS files -->


	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/loaders/pace.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/core/libraries/jquery.min.js'); ?>"></script>
	
	<script type="text/javascript" src="<?php echo base_url('assets/js/core/libraries/bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/loaders/blockui.min.js'); ?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	
	<?php 
	//if($this->uri->segment(2)=="tour_types" && $this->uri->segment(3)=="") { ?>
	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/tables/datatables/datatables.min.js'); ?>"></script>
	<?php //} ?>
	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/forms/selects/select2.min.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('assets/js/core/app.js'); ?>"></script>
	
	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/notifications/sweet_alert.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/forms/validation/validate.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/forms/validation/additional_methods.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/forms/styling/uniform.min.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/notifications/jgrowl.min.js'); ?>"></script>

	<script type="text/javascript" src="<?php //echo base_url('assets/js/plugins/forms/styling/switchery.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/forms/styling/switch.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/pages/datatables_basic.js'); ?>"></script>
	<!-- /theme JS files -->

</head>

<body>
	<div class="load-main hidden" >
        <div class="loader-block">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
	<!-- Main navbar -->
	<div class="navbar navbar-default header-highlight">
		<div class="navbar-header">
			<a class="navbar-brand " href="<?= admin_url(); ?>"><img src="<?php echo base_url('assets/images/logo.svg');?>"></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<div class="navbar-right">
				<ul class="nav navbar-nav">
					

					<li class="dropdown dropdown-user">
						<a class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?= base_url('assets/images/placeholder.jpg'); ?>" alt="">
							<span class=""><?php echo ucfirst(get_loggedin_info('admin_username')); ?></span>
							<i class="caret"></i>
						</a>

						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="<?= admin_url('profile/edit'); ?>"><i class="icon-user-plus"></i> My profile</a></li>
							<li><a href="<?= admin_url('authentication/logout'); ?>"><i class="icon-switch2"></i> <?= _l('logout'); ?></a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					
					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="<?= base_url('assets/images/placeholder.jpg'); ?>" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold "><?php echo ucfirst( get_loggedin_info('admin_username')); ?></span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> &nbsp;Online
									</div>
								</div>

								
							</div>
						</div>
					</div>
					<!-- /user menu -->

					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<!-- <li class="navigation-header"><span></span> <i class="icon-menu" title="Main pages"></i></li> -->
								<li class="navigation-header"></li>
								<li <?php if(is_active_controller('dashboard')) { echo 'class="active"'; } ?> ><a href="<?php echo admin_url('dashboard'); ?>"><i class="icon-home4"></i> <span><?php echo _l('dashboard'); ?></span></a></li>
								
								<li>
									<a href="#"><i class="icon-stack2"></i><span><?php echo _l('manage_tour');?></span></a>
									<ul>
										<li <?php if (is_active_controller('tour_types')) {echo 'class="active"';}?> >
											<a href="<?php echo base_url('folio/tour-types'); ?>">
												<span><?php _el('tour_types'); ?></span>
											</a>
										</li>
										<li <?php if(is_active_controller('tour_categories')) { echo 'class="active"';}?> ><a href="<?php echo base_url('folio/tour-categories'); ?>"><?php _el('tour_categories'); ?></a></li>
										<li <?php if(is_active_controller('tour_extra_services')) { echo 'class="active"';}?> ><a href="<?php echo base_url('folio/tour-extra-services'); ?>"><?php _el('tour_extra_services'); ?></a></li>
										<li <?php if(is_active_controller('tours')) {echo 'class="active"';}?> >
											<a href="<?php echo base_url('folio/tours'); ?>"><span> 
												<?php _el('tours'); ?></span>
											</a>
										</li>
																			
									</ul>
								</li> 
								<li>
									<a href="#"><i class="icon-stack2"></i><span><?php echo _l('manage_transfer');?></span></a>
									<ul>
										<li <?php if (is_active_controller('transfer_types')) {echo 'class="active"';}?> >
											<a href="<?php echo base_url('folio/transfer-types'); ?>">
												<span><?php _el('transfer_types'); ?></span>
											</a>
										</li>
										<li <?php if(is_active_controller('transfer_categories')) { echo 'class="active"';}?> ><a href="<?php echo base_url('folio/transfer-categories'); ?>"><?php _el('transfer_categories'); ?></a></li>
										<li <?php if(is_active_controller('transfers')) {echo 'class="active"';}?> >
											<a href="<?php echo base_url('folio/transfers'); ?>"><span> 
												<?php _el('transfer_services'); ?></span>
											</a>
										</li>
																				
									</ul>
								</li> 
								<li <?php if(is_active_controller('cms_pages')) { echo 'class="active"'; } ?> ><a href="<?php echo admin_url('cms-pages'); ?>"><i class="icon-home4"></i> <span><?php echo _l('manage_cms_pages'); ?></span></a></li>
								<li>
									<a href="#"><i class="icon-cog3"></i><span>Setup</span></a>
									<ul>
										<li <?php if (is_active_controller('emails')) {echo 'class="active"';}?> ><a href="<?php echo base_url('folio/emails'); ?>">Email Templates</a></li>
										
										<li <?php if (is_active_controller('settings')) {echo 'class="active"';}?>>
											<a href="<?php echo base_url('folio/settings'); ?>">		
												<span><?php _el('settings'); ?></span>
											</a>
										</li>
										
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

					<?php //$this->load->view('folio/includes/alerts'); ?>
					<?php
						if ($this->session->flashdata('error'))	{ ?>
                    		<input type="hidden" name="error" id="error" value="<?php echo $this->session->flashdata('error'); ?>">
                    <?php 	}
						if ($this->session->flashdata('success')) { ?>
                    		<input type="hidden" name="success" id="success" value="<?php echo $this->session->flashdata('success'); ?>">
                    <?php  }   ?>

					<?php echo $content; ?>

					
			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

    <!-- Swal Alert text -->
    <input type="hidden" name="swal_title" id="swal_title" value="<?php _el('single_deletion_alert'); ?>">
    <input type="hidden" name="swal_text" id="swal_text" value="<?php _el('single_recovery_alert'); ?>">
    <input type="hidden" name="swal_cancelButtonText" id="swal_cancelButtonText" value="<?php _el('no_cancel_it'); ?>">
    <input type="hidden" name="swal_confirmButtonText" id="swal_confirmButtonText" value="<?php _el('yes_i_am_sure'); ?>">
    <!-- End Swal Alert text -->

    <script>
		var BASE_URL= "<?php echo base_url(); ?>";

		
	</script>

	<script type="text/javascript">
		$.validator.setDefaults({
		  ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
		        errorClass: 'validation-error-label',
		        successClass: 'validation-valid-label',
		        highlight: function(element, errorClass) {
		            $(element).removeClass(errorClass);
		        },
		        unhighlight: function(element, errorClass) {
		            $(element).removeClass(errorClass);
		        },

		        // Different components require proper error label placement
		        errorPlacement: function(error, element) {

		            // Styled checkboxes, radios, bootstrap switch
		            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
		                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
		                    error.appendTo( element.parent().parent().parent().parent() );
		                }
		                 else {
		                    error.appendTo( element.parent().parent().parent().parent().parent() );
		                }
		            }

		            // Unstyled checkboxes, radios
		            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
		                error.appendTo( element.parent().parent().parent() );
		            }

		            // Input with icons and Select2
		            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
		                error.appendTo( element.parent() );
		            }

		            // Inline checkboxes, radios
		            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
		                error.appendTo( element.parent().parent() );
		            }

		            // Input group, styled file input
		            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
		                error.appendTo( element.parent().parent() );
		                
		            }
		            
		            else {
		                error.insertAfter(element);
		            }
		        },
		        validClass: "validation-valid-label",
		        success: function(label) {
		        	label.remove();
		            // label.addClass("validation-valid-label").text("")
		        },
		});
		$(function() {

			// Style checkboxes and radios
			$('.styled').uniform();
			
			//init radio button
			reInitRadio();

			// init swutch checkbox
			$(".switch").bootstrapSwitch();


		    // reset form on modal close 
		   	$('.modal').on('hidden.bs.modal', function(){
			    $(this).find('form')[0].reset();
			});

		   	// Default file input style
			$(".file-styled").uniform({
				fileButtonClass: 'action btn btn-default'
			});


			// Primary file input
			$(".file-styled-primary").uniform({
				fileButtonClass: 'action btn bg-blue'
			});


			$( document ).ajaxComplete(function() {
				$('.styled').uniform();

				// init swutch checkbox
				$(".switch").bootstrapSwitch();

				// var switches = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
				// switches.forEach(function(html) {
					
				//     var switchery = new Switchery(html);
				// });

			});


		});	

		function reInitRadio(){
			// Danger
		    $(".control-danger").uniform({
		        radioClass: 'choice',
		        wrapperClass: 'border-danger-600 text-danger-800'
		    });

		    // Success
		    $(".control-success").uniform({
		        radioClass: 'choice',
		        wrapperClass: 'border-success-600 text-success-800'
		    });

		    // Primary
		    $(".control-primary").uniform({
		        radioClass: 'choice',
		        wrapperClass: 'border-primary-600 text-primary-800'
		    });

		    // Info
		    $(".control-info").uniform({
		        radioClass: 'choice',
		        wrapperClass: 'border-info-600 text-info-800'
		    });
		}

		/* jQuery switch */
			var switches = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
			switches.forEach(function(html) {
				
			    var switchery = new Switchery(html);
			});

		/**
		 * Generates the notification on activity
		 *
		 * @param {str}  message    The message
		 * @param {str}  alertType  The alert type
		 */
		function jGrowlAlert(message, alertType) {

		    var header_msg = alertType == 'success' ? 'Success!' : 'Oh Snap!';
		    $.jGrowl(message, {
		        header: header_msg,
		        theme: 'bg-' + alertType
		    });
		}
		/**
		 * Selects/deselects all the checkboxes
		 *
		 * @param {obj}  obj  The checkbox object
		 */
		function select_all(obj) {

		    if (obj.checked) {
		        $(".checkbox").each(function() {
		            $(this).prop("checked", "checked");
		            $(this).parent().addClass("checked");
		        });
		    } else {
		        $('.checkbox').each(function() {
		            this.checked = false;
		            $(this).parent().removeClass("checked");
		        });
		    }
		}
	</script>
	<!-- Custom js -->
	<?php 
		if($this->uri->segment(2)=="profile") {?>
		<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>-->
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/ajax-admin-users-profile.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="tour-types") {?>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/ajax_tour_type.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="tour-categories") {?>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/ajax_tour_categories.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="tours" && ($this->uri->segment(3)!="add" || $this->uri->segment(3)!="edit")) { ?>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/ajax-tour.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="tour-extra-services") {?>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/ajax-tour-extra-services.js'); ?>"></script>
	<?php } ?>
	<?php
		//if($this->uri->segment(2)=="dashboard" || ($this->uri->segment(2)=="tours" && ($this->uri->segment(3)=="add" || $this->uri->segment(3)=="edit"))) {
		if($this->uri->segment(2)=="dashboard") {?>
		<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
	<?php } ?>
	<?php
		if($this->uri->segment(2)=="tours" && ($this->uri->segment(3)=="add" || $this->uri->segment(3)=="edit")) {?>
		<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/editors/summernote/summernote.min.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="tours" && $this->uri->segment(3)=="add") {
			?>
		<!--<script src="http://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>-->
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/add-tour-details.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="tours" && $this->uri->segment(3)=="edit") {
			?>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/edit-tour-details.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="dashboard") { ?>
		<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-slider.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/ajax-dashboard.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="transfer-types") {?>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/ajax-transfer-types.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="transfer-categories") {?>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/ajax-transfer-categories.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="transfers" && $this->uri->segment(3)!="add" && $this->uri->segment(3)!="edit") { ?>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/ajax-transfer.js'); ?>"></script>
	<?php } ?>
	<?php
		if($this->uri->segment(2)=="transfers" && ($this->uri->segment(3)=="add" || $this->uri->segment(3)=="edit")) {?>
		<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/editors/summernote/summernote.min.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="transfers" && $this->uri->segment(3)=="add") {
			?>
		<!--<script src="http://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>-->
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/add-transfer-details.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="transfers" && $this->uri->segment(3)=="edit") {
			?>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/edit-transfer-details.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="cms_pages" || $this->uri->segment(2)=="cms-pages") {
			if($this->uri->segment(3)=="add" || $this->uri->segment(3)=="edit"){?>
			<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/editors/summernote/summernote.min.js'); ?>"></script>
			<?php }
			?>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/ajax-cms-pages.js'); ?>"></script>
	<?php } ?>
	<?php 
		if($this->uri->segment(2)=="emails") {
			if($this->uri->segment(3)=="email-template"){?>
			<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/editors/summernote/summernote.min.js'); ?>"></script>
			<?php }
			?>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/ajax-email-template.js'); ?>"></script>
	<?php } ?>
	<!--End Custom js-->
</body>
</html>
