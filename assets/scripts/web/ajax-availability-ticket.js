$(function () {
	$('[data-toggle="popover"]').popover({
		html: true
	});
});

jQuery(document).on("change", ".select_tour_upgrades", function () {
	var tour_upgrade_id = jQuery(this).val();
	var tour_rate_opt = jQuery("#tour_rate_opt" + tour_upgrade_id).val();
	var tour_upgrade_rate = jQuery("#tour_upgrade_rate" + tour_upgrade_id).val();
	var tour_upgrade_rate_opt = jQuery("#tour_upgrade_rate_opt" + tour_upgrade_id).val();
	var total_tour_upgrades_price = jQuery("#total_tour_upgrades_price").val();
	var tour_upgrade_custom_rate = jQuery("#tour_upgrade_custom_rate" + tour_upgrade_id).val();
	var totl_person = jQuery("#total_person").val();
	var price_totl = 0;

	if (tour_upgrade_rate_opt == 1) {
		if (tour_upgrade_id == 14) {
			var custom_rate = JSON.parse(tour_upgrade_custom_rate);
			var count = Object.keys(custom_rate).length;

			if (count >= totl_person) {
				var obj_values = Object.values(custom_rate);
				var price_val = obj_values[(totl_person - 1)];
				price_totl = price_val;
			} else {
				price_totl = tour_upgrade_rate * totl_person;
			}
		} else {
			price_totl = tour_upgrade_rate * totl_person;
		}
	} else {
		if (tour_upgrade_id == 14) {
			var custom_rate = JSON.parse(tour_upgrade_custom_rate);
			var count = Object.keys(custom_rate).length;

			if (count >= totl_person) {
				var obj_values = Object.values(custom_rate);
				var price_val = obj_values[(totl_person - 1)];
				price_totl = price_val;
			} else {
				price_totl = tour_upgrade_rate;
			}
		} else {
			price_totl = tour_upgrade_rate;
		}
	}
	var tour_upgrades_array = [];
	jQuery("input:checkbox[name='tour_upgrades[]']:checked").each(function () {
		tour_upgrades_array.push($(this).val());
	});
	if (jQuery.inArray("16", tour_upgrades_array) !== -1 && jQuery.inArray("17", tour_upgrades_array) !== -1) {
		jQuery('.copy-details-wrapper span').remove();
		if (tour_upgrade_id == 16) {
			jQuery('.tour-upgrade-' + tour_upgrade_id).html('<span>[Copy Colosseum ticket\'s passengers details]</span>');
		}
		else if (tour_upgrade_id == 17) {
			jQuery('.tour-upgrade-' + tour_upgrade_id).html('<span>[Copy Vatican ticket\'s passengers details]</span>');
		}
	} else {
		jQuery('.copy-details-wrapper span').remove();
	}
	if (jQuery(this).prop('checked')) {
		if (tour_upgrade_id == 16) {
			if (tour_upgrade_rate_opt == 1) {
				var get_personal_detail = '';
				for (var i = 0; i <= (parseInt(totl_person) - 1); i++) {
					var j = parseInt(i) + parseInt(1);
					if (j == 1) {
						var bdate_p = tour_upgrade_id + "" + i;

						get_personal_detail += '<label>Passenger ' + j + ':</label><div class="form-group"><div class="row"><div class="col-md-6 field-group"><div class="form-group"><fieldset><legend>First Name</legend> <input type="text" class="form-control fname_tour_up fieldset_element" name="first_name[' + tour_upgrade_id + '][' + i + ']" data-id="' + tour_upgrade_id + '" autocomplete="off"></fieldset></div></div><div class="col-md-6 field-group"><div class="form-group"><fieldset><legend>Last Name</legend> <input type="text" class="form-control lname_tour_up fieldset_element" name="last_name[' + tour_upgrade_id + '][' + i + ']"  autocomplete="off" data-id="' + tour_upgrade_id + '"></fieldset></div></div></div></div><div class="form-group"><div class="row"><div class="col-md-6"> <label>Date Of Birth</label><div class="input-group datepicker_tour " > <input type="text" name="birth_date[' + tour_upgrade_id + '][' + i + ']" class="form-control birth_datepicker birth_date fieldset_element"  autocomplete="off" id="' + bdate_p + '" data-id="' + tour_upgrade_id + '" ><input type="hidden" name="date_p' + bdate_p + '" id="date_p' + bdate_p + '" ><div class="input-group-addon" > <i class="fas fa-calendar-alt btnPicker" data-picker="' + i + '" data-upgrade-id="' + tour_upgrade_id + '"></i></div></div></div><div class="col-md-6 field-group mt-20"><fieldset><legend>Birth Place</legend> <input type="text" class="form-control birth_place fieldset_element" name="birth_place[' + tour_upgrade_id + '][' + i + ']" autocomplete="off" data-id="' + tour_upgrade_id + '"></fieldset></div></div></div>';
					} else {
						get_personal_detail += '<label>Passenger ' + j + ':</label><div class="form-group"><div class="row"><div class="col-md-4 field-group"><div class="form-group"><fieldset><legend>First Name</legend> <input type="text" class="form-control fname_tour_up fieldset_element" name="first_name[' + tour_upgrade_id + '][' + i + ']" data-id="' + tour_upgrade_id + '" autocomplete="off"></fieldset></div></div><div class="col-md-4 field-group"><div class="form-group"><fieldset><legend>Last Name</legend> <input type="text" class="form-control lname_tour_up fieldset_element" name="last_name[' + tour_upgrade_id + '][' + i + ']"  autocomplete="off" data-id="' + tour_upgrade_id + '"></fieldset></div></div><div class="col-md-4 field-group"><div class="form-group"><fieldset><legend>Age</legend><input type="text" name="pass_age[' + tour_upgrade_id + '][' + i + ']" class="form-control age_tour_up fieldset_element"  autocomplete="off" data-id="' + tour_upgrade_id + '" ></fieldset></div></div></div></div>';
					}

				}

				jQuery("#person_info" + tour_upgrade_id).html(get_personal_detail);
				var maxdate = new Date();
				maxdate.setDate(maxdate.getDate() - 1);
				jQuery('.birth_datepicker').datepicker({
					//showOn: "both",
					format: 'dd-mm-yyyy',
					//startDate: new Date(),
					//endDate: new Date(),
					endDate: maxdate,
					todayHighlight: true,
					autoclose: true,
					//orientation: "bottom"
					pickerPosition: 'bottom'
				});

			}
		}

		if (tour_upgrade_id == 17) {
			if (tour_upgrade_rate_opt == 1) {
				var get_personal_detail = '';
				for (var i = 0; i <= (parseInt(totl_person) - 1); i++) {
					var j = parseInt(i) + parseInt(1);
					if (j == 1) {
						var bdate_p = tour_upgrade_id + "" + i;

						get_personal_detail += '<label>Passenger ' + j + ':</label><div class="form-group"><div class="row"><div class="col-md-6 field-group"><div class="form-group"><fieldset><legend>First Name</legend> <input type="text" class="form-control colo_fname_tour_up fieldset_element" name="colo_first_name[' + tour_upgrade_id + '][' + i + ']" data-id="' + tour_upgrade_id + '" autocomplete="off"></fieldset></div></div><div class="col-md-6 field-group"><div class="form-group"><fieldset><legend>Last Name</legend> <input type="text" class="form-control colo_lname_tour_up fieldset_element" name="colo_last_name[' + tour_upgrade_id + '][' + i + ']"  autocomplete="off" data-id="' + tour_upgrade_id + '"></fieldset></div></div></div></div><div class="form-group"><div class="row"><div class="col-md-6"> <label>Date Of Birth</label><div class="input-group colo_datepicker_tour " > <input type="text" name="colo_birth_date[' + tour_upgrade_id + '][' + i + ']" class="form-control birth_datepicker colo_b_date fieldset_element"  autocomplete="off" id="' + bdate_p + '" data-id="' + tour_upgrade_id + '" ><input type="hidden" name="date_p' + bdate_p + '" id="colo_date_p' + bdate_p + '" ><div class="input-group-addon" > <i class="fas fa-calendar-alt btnPicker" data-picker="' + i + '" data-upgrade-id="' + tour_upgrade_id + '"></i></div></div></div><div class="col-md-6 field-group mt-20"><fieldset><legend>Birth Place</legend> <input type="text" class="form-control colo_birth_place fieldset_element" name="colo_birth_place[' + tour_upgrade_id + '][' + i + ']" autocomplete="off" data-id="' + tour_upgrade_id + '"></fieldset></div></div></div>';
					} else {
						get_personal_detail += '<label>Passenger ' + j + ':</label><div class="form-group"><div class="row"><div class="col-md-4 field-group"><div class="form-group"><fieldset><legend>First Name</legend> <input type="text" class="form-control colo_fname_tour_up fieldset_element" name="colo_first_name[' + tour_upgrade_id + '][' + i + ']" data-id="' + tour_upgrade_id + '" autocomplete="off"></fieldset></div></div><div class="col-md-4 field-group"><div class="form-group"><fieldset><legend>Last Name</legend> <input type="text" class="form-control colo_lname_tour_up fieldset_element" name="colo_last_name[' + tour_upgrade_id + '][' + i + ']"  autocomplete="off" data-id="' + tour_upgrade_id + '"></fieldset></div></div><div class="col-md-4 field-group"><div class="form-group"><fieldset><legend>Age</legend><input type="text" name="colo_pass_age[' + tour_upgrade_id + '][' + i + ']" class="form-control colo_age_tour_up fieldset_element"  autocomplete="off" data-id="' + tour_upgrade_id + '" ></fieldset></div></div></div></div>';
					}

				}

				jQuery("#person_info" + tour_upgrade_id).html(get_personal_detail);
				var maxdate = new Date();
				maxdate.setDate(maxdate.getDate() - 1);
				jQuery('.birth_datepicker').datepicker({
					//showOn: "both",
					format: 'dd-mm-yyyy',
					//startDate: new Date(),
					//endDate: new Date(),
					endDate: maxdate,
					todayHighlight: true,
					autoclose: true,
					//orientation: "bottom"
					pickerPosition: 'bottom'
				});

			}
		}

		if (total_tour_upgrades_price) {

			jQuery("#total_tour_upgrades_price").val((parseFloat(price_totl) + parseFloat(total_tour_upgrades_price)));
		} else {
			jQuery("#total_tour_upgrades_price").val(price_totl);
		}

		jQuery(".total-price").removeClass('d-none');

	} else {

		if (total_tour_upgrades_price) {
			var c = parseFloat(total_tour_upgrades_price) - parseFloat(price_totl);
			if (c > 0) {
				jQuery(".total-price").removeClass('d-none');
			} else {
				jQuery(".total-price").addClass('d-none');
			}
			jQuery("#total_tour_upgrades_price").val(c);

		} else {
			jQuery("#total_tour_upgrades_price").val('');
		}
		jQuery("#person_info" + tour_upgrade_id).html('');
	}
	jQuery(".total_tour_upgrades_price_lbl").html('€ ' + jQuery("#total_tour_upgrades_price").val());
});

jQuery(document).ready(function () {

	jQuery("#addTourUpgrades")[0].reset();
	if (jQuery('.birth_datepicker').length > 0) {
		var maxdate = new Date();
		maxdate.setDate(maxdate.getDate() - 1);
		jQuery('.birth_date').each(function (i, obj) {
			var c = jQuery(this).attr('id');

			var d = jQuery('#date_p' + c).val();

			jQuery(this).datepicker({
				//showOn: "both",
				format: 'dd-mm-yyyy',
				//startDate: new Date(),
				//endDate: new Date(),
				endDate: maxdate,
				todayHighlight: true,
				autoclose: true,
				//orientation: "bottom"
				pickerPosition: 'bottom'
			}).datepicker('setDate', d);

		});
		jQuery('.colo_b_date').each(function (i, obj) {
			var c = jQuery(this).attr('id');

			var d = jQuery('#colo_date_p' + c).val();

			jQuery(this).datepicker({
				//showOn: "both",
				format: 'dd-mm-yyyy',
				//startDate: new Date(),
				//endDate: new Date(),
				endDate: maxdate,
				todayHighlight: true,
				autoclose: true,
				//orientation: "bottom"
				pickerPosition: 'bottom'
			}).datepicker('setDate', d);

		});
	}
});

jQuery(document).on('click', '.btnPicker', function () {

	var i = jQuery(this).data('picker');
	var j = jQuery(this).data('upgrade-id');
	$('input[name="birth_date[' + j + '][' + i + ']"]').datepicker('show');
	$('input[name="colo_birth_date[' + j + '][' + i + ']"]').datepicker('show');
});


$.validator.addMethod("minDate", function (value, element) {

	//var parts =value.split('-');
	var date_input = jQuery("#date_p" + (element.id)).val();
	var parts = date_input.split('-');
	var min = new Date();
	var inputDate = new Date(parts[2] + '-' + parts[1] + '-' + parts[0]);
	// console.log(inputDate.setHours(0,0,0,0));
	// console.log(min.setHours(0,0,0,0));
	if (inputDate.setHours(0, 0, 0, 0) === min.setHours(0, 0, 0, 0)) {
		return true;
	} else if (inputDate <= min) {
		return true;
	} else {
		return false;
	}

}, "Date not valid");
$.validator.addMethod("colominDate", function (value, element) {

	//var parts =value.split('-');
	var date_input = jQuery("#colo_date_p" + (element.id)).val();
	var parts = date_input.split('-');
	var min = new Date();
	var inputDate = new Date(parts[2] + '-' + parts[1] + '-' + parts[0]);
	// console.log(inputDate.setHours(0,0,0,0));
	// console.log(min.setHours(0,0,0,0));
	if (inputDate.setHours(0, 0, 0, 0) === min.setHours(0, 0, 0, 0)) {
		return true;
	} else if (inputDate <= min) {
		return true;
	} else {
		return false;
	}

}, "Date not valid");

jQuery.validator.addMethod("noSpace", function (value, element) {
	if ($.trim(value).length > 0) {
		return true;
	} else {
		return false;
	}
}, "No space please and don't leave it empty");

jQuery.validator.addMethod("no_HTML", function (value, element) {
	// return true - means the field passed validation
	// return false - means the field failed validation and it triggers the error
	return this.optional(element) || /^([a-zA-Z0-9 _&?=(){},.|*+-]+)$/.test(value);
}, "Special Characters not allowed!");

$("#addTourUpgrades").validate({
	errorElement: 'span',
	errorPlacement: function (error, element) {
		//console.log('dd', element.attr("name"))
		if (element.parent().hasClass('input-group')) {
			// error.appendTo(element.parent("div").next("div"));
			error.insertAfter(element.parent());
		} else if (element.hasClass('fieldset_element')) {
			// error.appendTo(element.parent("div").next("div"));
			error.insertAfter(element.parent());
		} else {

			error.insertAfter(element)
		}
	}
});
// copy vatican passenger details into colosseum tickets
jQuery(document).on("click", ".tour-upgrade-16 span", function () {
	$('input[name^="tour_upgrades"]').each(function () {
		var tour_upgrade_id = this.value;
		if (jQuery(this).prop('checked') && jQuery("#tour_rate_opt" + tour_upgrade_id).val() == 1) {
			var d_cnt = 0;
			$('.colo_fname_tour_up').each(function () {
				var colo_first_name = $('input[name="colo_first_name[17][' + d_cnt + ']"]').val();
				if (colo_first_name) {
					$('input[name="first_name[16][' + d_cnt + ']"]').val(colo_first_name);
				}
				d_cnt++;
			});
			var l_cnt = 0;
			$('.colo_lname_tour_up').each(function () {
				var colo_last_name = $('input[name="colo_last_name[17][' + l_cnt + ']"]').val();
				if (colo_last_name) {
					$('input[name="last_name[16][' + l_cnt + ']"]').val(colo_last_name);
				}
				l_cnt++;
			});
			if ($('.colo_age_tour_up').length > 0) {
				var age_cnt = 1;
				$('.age_tour_up').each(function () {
					var colo_pass_age = $('input[name="colo_pass_age[17][' + age_cnt + ']"]').val();
					if (colo_pass_age) {
						$('input[name="pass_age[16][' + age_cnt + ']"]').val(colo_pass_age);
					}
					age_cnt++;
				});
			}
			var bd_cnt = 0;
			$('.colo_b_date').each(function () {
				var colo_birth_date = $('input[name="colo_birth_date[17][' + bd_cnt + ']"]').val();
				var colo_birth_date_hidden = $('#colo_date_p170').val();
				if (colo_birth_date) {
					$('input[name="birth_date[16][' + bd_cnt + ']"]').val(colo_birth_date);
				}
				if (colo_birth_date_hidden) {
					$('#date_p160').val(colo_birth_date_hidden);
				}
				bd_cnt++;
			});
			var bp_cnt = 0;
			$('.colo_birth_place').each(function () {
				var colo_birth_place = $('input[name="colo_birth_place[17][' + bp_cnt + ']"]').val();
				if (colo_birth_place) {
					$('input[name="birth_place[16][' + bp_cnt + ']"]').val(colo_birth_place);
				}
				bp_cnt++;
			});
		}
	});
});
// copy colosseum passenger details into vatican tickets
jQuery(document).on("click", ".tour-upgrade-17 span", function () {
	$('input[name^="tour_upgrades"]').each(function () {
		var tour_upgrade_id = this.value;
		if (jQuery(this).prop('checked') && jQuery("#tour_rate_opt" + tour_upgrade_id).val() == 1) {
			var d_cnt = 0;
			$('.fname_tour_up').each(function () {
				var vat_first_name = $('input[name="first_name[16][' + d_cnt + ']"]').val();
				if (vat_first_name) {
					$('input[name="colo_first_name[17][' + d_cnt + ']"]').val(vat_first_name);
				}
				d_cnt++;
			});
			var l_cnt = 0;
			$('.lname_tour_up').each(function () {
				var vat_last_name = $('input[name="last_name[16][' + l_cnt + ']"]').val();
				if (vat_last_name) {
					$('input[name="colo_last_name[17][' + l_cnt + ']"]').val(vat_last_name);
				}
				l_cnt++;
			});
			if ($('.age_tour_up').length > 0) {
				var age_cnt = 1;
				$('.age_tour_up').each(function () {
					var vat_pass_age = $('input[name="pass_age[16][' + age_cnt + ']"]').val();
					if (vat_pass_age) {
						$('input[name="colo_pass_age[17][' + age_cnt + ']"]').val(vat_pass_age);
					}
					age_cnt++;
				});
			}
			var bd_cnt = 0;
			$('.birth_date').each(function () {
				var vat_birth_date = $('input[name="birth_date[16][' + bd_cnt + ']"]').val();
				var vat_birth_date_hidden = $('#date_p160').val();
				if (vat_birth_date) {
					$('input[name="colo_birth_date[17][' + bd_cnt + ']"]').val(vat_birth_date);
				}
				if (vat_birth_date_hidden) {
					$('#colo_date_p170').val(vat_birth_date_hidden);
				}
				bd_cnt++;
			});
			var bp_cnt = 0;
			$('.birth_place').each(function () {
				var vat_birth_place = $('input[name="birth_place[16][' + bp_cnt + ']"]').val();
				if (vat_birth_place) {
					$('input[name="colo_birth_place[17][' + bp_cnt + ']"]').val(vat_birth_place);
				}
				bp_cnt++;
			});
		}
	});
});
$('#btn_add_tour_cart').click(function () {
	$("#addTourUpgrades").validate();
	$('input[name^="tour_upgrades"]').each(function () {
		var tour_upgrade_id = this.value;
		if (jQuery(this).prop('checked') && jQuery("#tour_rate_opt" + tour_upgrade_id).val() == 1) {
			// start validate for vatican tickets
			var d_cnt = 0;
			$('.fname_tour_up').each(function () {
				if (jQuery(this).data('id') == tour_upgrade_id) {
					$('input[name="first_name[' + tour_upgrade_id + '][' + d_cnt + ']"]').rules("add", {
						required: true,
						noSpace: true,
						no_HTML: true,
						maxlength: 30
					});
					d_cnt++;
				}
			});
			var l_cnt = 0;
			$('.lname_tour_up').each(function () {
				if (jQuery(this).data('id') == tour_upgrade_id) {
					$('input[name="last_name[' + tour_upgrade_id + '][' + l_cnt + ']"]').rules("add", {
						required: true,
						noSpace: true,
						no_HTML: true,
						maxlength: 30
					});
					l_cnt++;
				}
			});
			if ($('.age_tour_up').length > 0) {
				var age_cnt = 1;
				$('.age_tour_up').each(function () {

					if (jQuery(this).data('id') == tour_upgrade_id) {
						$('input[name="pass_age[' + tour_upgrade_id + '][' + age_cnt + ']"]').rules("add", {
							required: true,
							number: true,
							noSpace: true,
							no_HTML: true,
							maxlength: 3,
							max: 150
						});
						age_cnt++;
					}
				});
			}
			var bd_cnt = 0;
			$('.birth_date').each(function () {
				if (jQuery(this).data('id') == tour_upgrade_id) {
					$('input[name="birth_date[' + tour_upgrade_id + '][' + bd_cnt + ']"]').rules("add", {
						required: true,
						minDate: true
					});
					bd_cnt++;
				}
			});
			var bp_cnt = 0;
			$('.birth_place').each(function () {
				if (jQuery(this).data('id') == tour_upgrade_id) {
					$('input[name="birth_place[' + tour_upgrade_id + '][' + bp_cnt + ']"]').rules("add", {
						required: true,
						noSpace: true,
						no_HTML: true,
						maxlength: 30
					});
					bp_cnt++;
				}
			});
			// end validate for vatican tickets

			// start validate for vatican tickets
			var d_cnt = 0;
			$('.colo_fname_tour_up').each(function () {
				if (jQuery(this).data('id') == tour_upgrade_id) {
					$('input[name="colo_first_name[' + tour_upgrade_id + '][' + d_cnt + ']"]').rules("add", {
						required: true,
						noSpace: true,
						no_HTML: true,
						maxlength: 30
					});
					d_cnt++;
				}
			});
			var l_cnt = 0;
			$('.colo_lname_tour_up').each(function () {
				if (jQuery(this).data('id') == tour_upgrade_id) {
					$('input[name="colo_last_name[' + tour_upgrade_id + '][' + l_cnt + ']"]').rules("add", {
						required: true,
						noSpace: true,
						no_HTML: true,
						maxlength: 30
					});
					l_cnt++;
				}
			});
			var bd_cnt = 0;
			$('.colo_b_date').each(function () {
				if (jQuery(this).data('id') == tour_upgrade_id) {
					$('input[name="colo_birth_date[' + tour_upgrade_id + '][' + bd_cnt + ']"]').rules("add", {
						required: true,
						colominDate: true
					});
					bd_cnt++;
				}
			});
			var bp_cnt = 0;
			$('.colo_birth_place').each(function () {
				if (jQuery(this).data('id') == tour_upgrade_id) {
					$('input[name="colo_birth_place[' + tour_upgrade_id + '][' + bp_cnt + ']"]').rules("add", {
						required: true,
						noSpace: true,
						no_HTML: true,
						maxlength: 30
					});
					bp_cnt++;
				}
			});
			if ($('.colo_age_tour_up').length > 0) {
				var age_cnt = 1;
				$('.colo_age_tour_up').each(function () {
					if (jQuery(this).data('id') == tour_upgrade_id) {
						$('input[name="colo_pass_age[' + tour_upgrade_id + '][' + age_cnt + ']"]').rules("add", {
							required: true,
							number: true,
							noSpace: true,
							no_HTML: true,
							maxlength: 3,
							max: 150
						});
						age_cnt++;
					}
				});
			}
			// end validate for vatican tickets

		}
	});

	if ($("#addTourUpgrades").valid()) {

		$("#addTourUpgrades").submit();
	}
});

jQuery(document).on("change", ".birth_date, .colo_b_date", function () {
	var date = jQuery(this).val();
	var data_id = jQuery(this).attr('id');

	if (date) {
		var date_1 = date.split('-');

		var suffix = "";
		if (date_1[0] == 1 || date_1[0] == 21 || date_1[0] == 31) {
			suffix = 'st';
		} else if (date_1[0] == 2 || date_1[0] == 22) {
			suffix = 'nd';
		} else if (date_1[0] == 3 || date_1[0] == 23) {
			suffix = 'rd';
		} else {
			suffix = 'th';
		}

		var month_names = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

		var month_value = month_names[date_1[1] - 1];
		jQuery("#date_p" + data_id).val(date);
		jQuery("#colo_date_p" + data_id).val(date);
		jQuery(this).val(month_value + " " + date_1[0] + suffix + " " + date_1[2]);
	} else {
		jQuery(this).val('');
		jQuery("#date_p" + data_id).val('');
		jQuery("#colo_date_p" + data_id).val('');
	}

	$(this).valid();
});
jQuery(document).on("keydown", ".birth_date, .colo_b_date", function () {
	return false;
});