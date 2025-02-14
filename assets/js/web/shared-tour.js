jQuery(document).ready(function () {
    jQuery("#sharedTourCity").select2({
        placeholder: "Select a city",
        minimumResultsForSearch: -1,
        allowClear: true
    });
    jQuery("#sharedTour").select2({
        placeholder: "Select a tour",
        minimumResultsForSearch: -1,
        allowClear: true
    });

    var expireDate = new Date();
    expireDate.setFullYear(expireDate.getFullYear() + 1);

    jQuery('#sharedTourDate').datepicker({
        format: 'dd-mm-yyyy',
        endDate: expireDate,
        todayHighlight: true,
        autoclose: true,
    });

    // get the tour variable by selected city and append it
    $('#sharedTourCity').on('select2:unselect', function (e) {
        $('#sharedTour').empty().trigger("change");
        $(this).val('');
    });
    jQuery(document).on("change", "#sharedTourCity", function () {
        var tour_id = $(this).val();
        $.ajax({
            url: BASE_URL + 'partners/shared_tour_variable',
            type: 'POST',
            data: {
                tour_id: tour_id
            },
            dataType: 'JSON',
            success: function (response) {
                if (response.data) {
                    $('#sharedTour').empty().trigger("change");
                    // Append empty option as first option
                    $('#sharedTour').append(new Option('', '')).trigger('change');
                    $.each(response.data, function (index, value) {
                        var newOption = new Option(value.name, value.id);
                        // Append it to the select
                        $('#sharedTour').append(newOption).trigger('change');
                    });
                }
                else {
                    jGrowlAlert(response.msg, 'warning');
                }
            }
        });
    });
});
jQuery(document).on("change", "#sharedTourCity, #sharedTour", function () {
    if ($(this).val()) {
        setTimeout(() => {
            $('#searchSharedTour').trigger('click');
        }, 100);
    }
});

jQuery(document).on("change", "#sharedTourDate", function () {

    var date = $(this).val();
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
        $("#sharedTourDate1").val($(this).val());
        $(this).val(month_value + " " + date_1[0] + suffix + " " + date_1[2]);
    } else {
        $("#sharedTourDate1").val('');
        $(this).val('');
    }
    $(this).valid();
    if (date) {
        $('#searchSharedTour').trigger('click');
    }
});


// START validation for search shared tour
//  for your custom message
// jQuery.extend(jQuery.validator.messages, {
//     require_from_group: jQuery.format("'Please enter either username/ email address to recover password'/Please fill out at least {0} of these fields.")
// });
// jQuery.validator.addMethod("require_from_group",
//     function (value, element) {
//         return "Please enter a valid email address"
//     },
// );
jQuery("#sharedTourSearch").validate({
    groups: {  // consolidate messages into one
        theGroup: "sharedTour sharedTourCity sharedTourDate"
    },
    rules: {
        sharedTour: {
            require_from_group: [1, ".search-tour"]
        },
        sharedTourCity: {
            require_from_group: [1, ".search-tour"]
        },
        sharedTourDate: {
            require_from_group: [1, ".search-tour"]
        }
    },
    errorClass: 'validation-error',
    messages: {
        sharedTour: {
            require_from_group: "Please select at least one "
        },
        sharedTourCity: {
            require_from_group: "Please select at least city, tour or date"
        },
        sharedTourDate: {
            require_from_group: "Please select at least city, tour or date"
        },
    },
    errorPlacement: function (error, element) {
        if (element.hasClass("search-tour")) {
            error.insertAfter(".search-shared-btn");
        } else {
            error.insertAfter(element);
        }
    },
    invalidHandler: function (event, validator) {
        $('.search-result-wrapper').html('');
    },
    submitHandler: function (form) {
        ajxLoader('show', 'body');
        var form_data = {
            'city_id': $('#sharedTourCity').val(),
            'tour_id': $('#sharedTour').val(),
            'date': $('#sharedTourDate1').val(),
        };
        // ajax call
        $.ajax({
            url: BASE_URL + "web/partners/search_shared_tour",
            dataType: 'JSON',
            type: 'POST',
            data: form_data,
            success: function (data) {
                $('.search-result-wrapper').html(data.html);
                ajxLoader('hide', 'body');
            },
        });
    }

});
// END validation for search shared tour

// START custom pagination for search shared tour

var create_parameter_array = [];
create_parameter_array.get_order_by = 'desc';
create_parameter_array.get_page_no = '';
create_parameter_array.get_row_per_page = '9';
create_parameter_array.get_city_id = '';
create_parameter_array.get_tour_id = '';
create_parameter_array.get_date = '';
$(document).on('click', '.custom-pagination li:not(.active) a', function (e) {
    e.preventDefault();
    var city_id = $('#sharedTourCity').val();
    var tour_id = $('#sharedTour').val();
    var date = $('#sharedTourDate1').val();
    var get_page_no = $(this).attr('data-ci-pagination-page');
    var page_no = get_page_no != undefined ? get_page_no : $(this).text();

    create_parameter_array.get_city_id = city_id;
    create_parameter_array.get_tour_id = tour_id;
    create_parameter_array.get_date = date;
    create_parameter_array.get_page_no = page_no;
    var order_by = create_parameter_array.get_order_by;

    load_pagination(page_no, order_by, create_parameter_array);
});

// Load product data and pagination

function load_pagination(page_no, order_by, parameter_array = '') {
    var city_id = parameter_array.get_city_id;
    var tour_id = parameter_array.get_tour_id;
    var date = parameter_array.get_date;
    var order_by = parameter_array.get_order_by;
    var row_per_page = parameter_array.get_row_per_page;
    $.ajax({
        url: BASE_URL + 'partners/' + page_no + '/' + order_by + '/' + row_per_page,
        type: 'POST',
        data: {
            'city_id': city_id,
            'tour_id': tour_id,
            'date': date,
            'page_no': page_no,
            'order_by': order_by,
            'row_per_page': row_per_page

        },
        beforeSend: function (formData, jqForm, options) {
            // $('.custom-pagination').hide();
            ajxLoader('show', 'body');
        },
        complete: function () {
            // $('.custom-pagination').show();
            ajxLoader('hide', 'body');
        },
        dataType: 'JSON',
        success: function (data) {
            if (data) {
                $('.custom-pagination').html(data.pagination);
                $('.search-result-wrapper').html(data.html);
                $('html, body').animate({
                    scrollTop: $(".text-section").offset().top
                }, 1000);
            }
        }
    });
}
// END custom pagination for search shared tour

// Append read more data in modal popup
$(document).on('click', '.lh-cstm a', function (e) {
    var read_more_data = $(this).parents('.searchtour-list-block').find('p.d-none').text();
    var agency_name = $(this).parents('.searchtour-list-block').find('label.agency-name').text();
    $('#notes .modal-body p.brief-notes').html('').append(read_more_data);
    $('#notes .modal-body h5.modal-agency-name span').html('').append(agency_name);
});

// clear searched filter
$(document).on('click', '.clear-tour-search', function (e) {
    $('.search-result-wrapper').html('');
    $('#sharedTourDate').datepicker('setDate', null);
    document.getElementById("sharedTourSearch").reset();
    $("#sharedTourCity, #sharedTour").val('').trigger('change');
});