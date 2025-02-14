<section class="pt-80 pb-80">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="custom-form affiliate-reg-form">
					<div class="alert alert-danger d-none" id="ta_error_msg">
					</div>
					<form id="travelAgentLandingForm" method="post">
						<div class="row">
							<div class="col-md-12">
								<h3 class="title">Register for our affiliate program</h3>
							</div>
							<div class="col-md-12">
								<div class="form-group field-group">
									<fieldset>
										<legend>Name</legend>
										<input type="text" class="form-control ta_fieldset" id="ta_name" name="ta_name" autocomplete="off">
									</fieldset>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group field-group">
									<fieldset>
										<legend>Email</legend>
										<input type="text" class="form-control ta_fieldset" id="ta_email" name="ta_email" autocomplete="off">
									</fieldset>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group field-group">
									<fieldset>
										<legend>Confirm Email</legend>
										<input type="text" class="form-control ta_fieldset" id="ta_confirm_email" name="ta_confirm_email" autocomplete="off">
									</fieldset>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group field-group">
									<fieldset>
										<legend>Phone Number</legend>
										<input type="text" class="form-control ta_fieldset" id="ta_phone" name="ta_phone" autocomplete="off" maxlength="15">
									</fieldset>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group field-group">
									<fieldset>
										<legend>Company Name</legend>
										<input type="text" class="form-control ta_fieldset" id="ta_company_name" name="ta_company_name" autocomplete="off">
									</fieldset>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group field-group">
									<fieldset>
										<legend>Company Website</legend>
										<input type="text" class="form-control ta_fieldset" id="ta_company_website" name="ta_company_website" autocomplete="off">
									</fieldset>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group field-group">
									<fieldset>
										<legend>IATA Code</legend>
										<input type="text" class="form-control ta_fieldset" id="ta_iatacode" name="ta_iatacode" autocomplete="off">
									</fieldset>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group field-group">
									<fieldset>
										<legend>Notes</legend>
										<textarea class="form-control ta_fieldset" id="ta_notes" name="ta_notes" rows="4"></textarea>
									</fieldset>
								</div>
							</div>
							<div class="col-md-12">
								<div class="g-recaptcha mb-3" data-sitekey="<?php echo get_settings('gr_site_key'); ?>" id="travelLandingRecaptcha"></div>
              					<input type="hidden" class="hiddentravelLandingRecaptcha" name="travel_LandingRecaptcha" id="travel_LandingRecaptcha">
							</div>
							<div class="col-md-12">
								<!-- <a href="#" class="btn btn-yellow mt-3">Send a request</a> -->
								<button type="submit" name="ta_submit" class="btn btn-yellow mt-3">Send a request</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-6">
				<div class="affiliate-reg-content">
					<div class="row">
						<div class="col-md-12">
							<div class="affiliate-text p-2">
								<?php
								if (is_array($travel_static_content) && sizeof($travel_static_content) > 0) {
									foreach ($travel_static_content as $travel_content) { ?>
										<h3><?php echo $travel_content['s_title']; ?></h3>
										<p><?php echo $travel_content['s_description']; ?></p>
								<?php }
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	jQuery.validator.addMethod("ta_noSpace", function(value, element) {
		if ($.trim(value).length > 0) {
			return true;
		} else {
			return false;
		}
	}, "No space please and don't leave it empty");
	jQuery.validator.addMethod("ta_noHTML", function(value, element) {
		// return true - means the field passed validation
		// return false - means the field failed validation and it triggers the error
		return this.optional(element) || /^([a-zA-Z0-9 _&?=(){},.|*+-/\\]+)$/.test(value);
	}, "Special Characters not allowed!");
	jQuery.validator.addMethod("noHTMLtags", function(value, element) {
		if (this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)) {
			return false;
		} else {
			return true;
		}
	}, "HTML tags are Not allowed.");
	jQuery.validator.addMethod("ta_customEmail", function(value, element, param) {
		return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
	}, 'Enter Correct E-mail Address');
	jQuery.validator.addMethod("ta_customWebsite", function(value, element, param) {
		return value.match(/^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/);
	}, 'Enter Correct Website Address');
	jQuery("#travelAgentLandingForm").validate({
		//errorClass: 'validation-error',
		errorElement: 'span',
		rules: {
			ta_name: {
				required: true,
				ta_noSpace: true,
				ta_noHTML: true,
				maxlength: 40,
			},
			ta_email: {
				required: true,
				email: true,
				ta_customEmail: true,
			},
			ta_confirm_email: {
				required: true,
				email: true,
				equalTo: "#ta_email"
			},
			ta_company_name: {
				required: true,
				ta_noSpace: true,
				ta_noHTML: true,
				maxlength: 100,
			},
			ta_phone: {
				required: true,
				ta_noSpace: true,
				ta_noHTML: true,
				maxlength: 15,
			},
			ta_company_website: {
				required: true,
				ta_noSpace: true,
				ta_noHTML: true,
				// ta_customWebsite: true,
			},
			ta_iatacode: {
				required: true,
				ta_noSpace: true,
				ta_noHTML: true,
				maxlength: 100,
			},
			ta_notes: {
				required: true,
				ta_noSpace: true,
				noHTMLtags: true,
				maxlength: 1000
			}
		},
		errorPlacement: function(error, element) {
			//console.log('dd', element.attr("name"))
			if (element.parent().hasClass('input-group')) {
				error.insertAfter(element.parent());
			} else if (element.hasClass('ta_fieldset')) {
				// error.appendTo(element.parent("div").next("div"));
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element)
			}
		},
		submitHandler: function(form) {

			let grecaptcha_error = $('#travelAgentLandingForm').find('.g-recaptcha');
            if ($('#travel_LandingRecaptcha').val() == '') {
                grecaptcha_error.append('<label class="validation-error">The reCAPTCHA field is required.</label>');
                return false;
            }

			window.scrollTo(0, 0);
			// ajax call
			$.ajax({
				url: BASE_URL + "home/send_affiliate_data",
				type: 'POST',
				data: jQuery("#travelAgentLandingForm").serialize(),
				beforeSend: function() {
					ajxLoader('show', 'body');
				},
				dataType: "JSON",
				success: function(data) {
					if (data.flag) {
						$('#thankyoumodal .modal-body p').text('Thank you for your request. You will receive an email from our agent shortly.');
						jQuery("#travelAgentLandingForm")[0].reset();
						$('#thankyoumodal').modal('show');
					} else {
						//$('#errormodal').modal('show');
						jQuery("#ta_error_msg").html(data.msg);
						jQuery("#ta_error_msg").removeClass('d-none');
						setTimeout(function() {
							jQuery("#ta_error_msg").addClass('d-none');
							jQuery("#ta_error_msg").html("");
						}, 10000);
					}
					ajxLoader('hide', 'body');
				},
				error: function() {
					//window.scrollTo(0,0);
					ajxLoader('hide', 'body');
					jQuery("#ta_error_msg").html("Something went wrong!");
					jQuery("#ta_error_msg").removeClass('d-none');
					setTimeout(function() {
						jQuery("#ta_error_msg").addClass('d-none');
						jQuery("#ta_error_msg").html("");
					}, 10000);
				}
			});
		}
	});
</script>