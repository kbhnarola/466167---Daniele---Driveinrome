<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
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
	
	<link href="<?php echo base_url('assets/css/icons/icomoon/styles.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/core.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/components.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/colors.css'); ?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	<link href="<?php echo base_url('assets/css/loader.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/icons/fontawesome/styles.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/admin_custom.css'); ?>" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" type="image/png" href="<?php echo ASSET.'images/favicon.png';?>"/>
	<!-- Core JS files -->
	
	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/loaders/pace.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/core/libraries/jquery.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/core/libraries/bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/loaders/blockui.min.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/forms/validation/validate.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/forms/styling/uniform.min.js'); ?>"></script>
	<!-- /core JS files -->


	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/core/app.js'); ?>"></script>
	<!-- /theme JS files -->
	<style type="text/css">
		.error{
			color: red !important;
		}
	</style>
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

		});	
		</script>
</head>

<body class="login-container">
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
	<!-- <div class="navbar navbar-inverse"> -->
		<!-- <div class="navbar-header">
			<a class="navbar-brand" href="<?= admin_url(); ?>"><?php //echo WEBSITE_NAME ?></a>

		
		</div> -->

		
	<!-- </div> -->
	<!-- /main navbar -->

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">
			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">
					

					<?php echo $content; ?>


					<!-- Footer -->
					<div class="footer text-muted text-center">
						&copy; <?= date('Y') ?>. <a href="#">Created</a> by <?= WEBSITE_NAME ?>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
