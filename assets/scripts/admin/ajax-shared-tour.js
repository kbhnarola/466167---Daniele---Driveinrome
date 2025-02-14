jQuery.validator.addMethod("noSpace", function (value, element) {
    if ($.trim(value).length > 0) {
        return true;
    } else {
        return false;
    }
}, "No space please and don't leave it empty");

jQuery.validator.addMethod("noSpecialChars", function (value, element) {
    // return true - means the field passed validation
    // return false - means the field failed validation and it triggers the error

    return this.optional(element) || /^([a-zA-Z0-9 _&?=(){},.'|*+-\/]+)$/.test(value);
}, "Special Characters not allowed!");

jQuery.validator.addMethod("noHTMLtags", function (value, element) {
    if (this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)) {
        return false;
    } else {
        return true;
    }
}, "HTML tags are Not allowed.");


jQuery(document).ready(function () {

    jQuery("#tour_variable_id").select2({
        placeholder: "Select a tour variable",
        allowClear: true
    });
    var expireDate = new Date();

    // var year = expireDate.getFullYear();
    // var nextOneYearExpirdate = new Date(year + 1);

    expireDate.setFullYear(expireDate.getFullYear() + 1);

    jQuery('.tour_datepicker').datepicker({
        format: 'dd-mm-yyyy',
        endDate: expireDate,
        todayHighlight: true,
        autoclose: true,
    });
    $('#time').datetimepicker({
        format: 'hh:mm a'
    });
    $('#tour_date').focus();
    // get the tour variable by selected city and append it
    $('input[type=radio][name=tour]').change(function () {
        $('#tour_date').focus();
        var tour_id = $(this).val();
        $.ajax({
            url: BASE_URL + 'shared_tour/shared_tour_variable',
            type: 'POST',
            data: {
                tour_id: tour_id
            },
            dataType: 'JSON',
            success: function (response) {
                if (response.data) {
                    $('#tour_variable_id').empty().trigger("change");
                    // Append empty option as first option
                    $('#tour_variable_id').append(new Option('', '')).trigger('change');
                    $.each(response.data, function (index, value) {
                        var newOption = new Option(value.name, value.id);
                        // Append it to the select
                        $('#tour_variable_id').append(newOption).trigger('change');
                    });
                }
                else {
                    jGrowlAlert(response.msg, 'warning');
                }
            }
        });
    });
    // display alert for success/error
    if (jQuery("#error").val()) {
        var error = jQuery("#error").val();
        jGrowlAlert(error, 'danger');
    }
    if (jQuery("#success").val()) {
        var success = jQuery("#success").val();
        jGrowlAlert(success, 'success');
    }
    // Get shared tour data
    fetch_data();
});

$('#reset_shared_tour').on('click', function () {
    $('#tour_date').val('');
    // $('#notes').summernote("reset");
});
$('#reset_shared_tour').click(function () {
    $('#tour_date').val('');
    // $('#notes').summernote("reset");
});

function fetch_data() {
    var usersDataTable = $('#sharedtour_list_table').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        // "order": [],
        "searching": true,
        //"scrollY": 200,
        //"scrollX": 200,

        // Load data from an Ajax source
        "ajax": {
            "url": BASE_URL + 'shared_tour/getLists/',
            "type": "POST",
            // 'data': function(data){
            //     // Read values
            //     var dropdown1 = $('#dropdown1').val();

            //     // Append to data
            //     data.tag = dropdown1;
            // }
        },
        "order": [
            [10, "desc"]
        ],
        "columns": [{
            data: null,
            'sortable': false,
            "orderable": false
        }, //0
        {
            data: 'passengers'
        }, //1
        {
            data: 'agency',
        }, //2
        {
            data: 'ship',
        }, //3
        {
            data: 'pick_up_time',
        }, //4
        {
            data: 'notes',
        }, //5
        {
            data: 'tour_date',
        }, // 6
        {
            data: 'shared_tour_city_name',
        }, //7
        {
            data: 'shared_tour_variable_name',
        }, //8
        {
            data: 'action',
            'sortable': false,
            "orderable": false
        }, //9
        {
            data: 'id',
            'sortable': true,
            "orderable": true,
            "visible": false
        }, //10
        ],
        "columnDefs": [{
            'targets': [0],
            width: "5%",
            'title': '<input type="checkbox" name="select_all" id="select_all" class="styled" onclick="select_all(this);" >',
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta) {
                // return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'+ btoa(data.id) +'" checked="checked"></label></div>';                   
                return '<input type="checkbox" class="checkbox styled"  name="delete"  id="' + btoa(data.id) + '">';
            }
        },
        {
            'targets': [1],
            width: "5%"
        },
        {
            'targets': [2],
            width: "10%"
        },
        {
            "targets": [3],
            width: "5%"
        },
        {
            'targets': [4],
            width: "10%"
        },
        {
            "targets": [5],
            width: "25%"
        },
        {
            'targets': [6],
            width: "10%",
        },
        {
            'targets': [7],
            width: "10%"
        },
        {
            'targets': [8],
            width: "10%"
        },
        {
            'targets': [9],
            width: "10%",
            'title': 'Actions',
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta) {
                //var id = data.id;
                return '<a href="' + BASE_URL + 'shared-tour/edit/' + data + '" data-popup="tooltip" data-placement="top"  title="edit" id="' + data + '" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="' + data + '"><i class=" icon-trash"></i></a>';
            }
        },
        {
            'targets': [10],
            width: "0%"
        },
        ],
        //fixedColumns: true
    });
}
// validate add shared tour
jQuery("#addSharedTour").validate({
    errorElement: 'span',
    rules: {
        tour_date: {
            required: true,
        },
        tour_variable_id: {
            required: true,
        },
        passengers: {
            required: true,
        },
        agency: {
            required: true,
            noSpace: true,
            noSpecialChars: true,
            noHTMLtags: true,
        },
        ship: {
            required: true,
            noSpace: true,
            noSpecialChars: true,
            noHTMLtags: true,
        },
        time: {
            required: true,
        }
    },
    // errorPlacement: function (error, element) {
    //     error.insertAfter(element);
    // },
    messages: {
        newsletter_subject: {
            remote: "Newsletter subject already exists"
        },
        tour_image1: {
            extension: 'File type must be JPG, JPEG or PNG',
            filesize: 'File size must be less than 800 KB'
        }
    },
    submitHandler: function (form) {
        jQuery('.load-main').removeClass('hidden');
        form.submit();
    }
});
// validate edit shared tour
jQuery("#editSharedTour").validate({
    errorElement: 'span',
    rules: {
        tour_date: {
            required: true,
        },
        tour_variable_id: {
            required: true,
        },
        passengers: {
            required: true,
        },
        agency: {
            required: true,
            noSpace: true,
            noSpecialChars: true,
            noHTMLtags: true,
        },
        ship: {
            required: true,
            noSpace: true,
            noSpecialChars: true,
            noHTMLtags: true,
        },
        time: {
            required: true,
        }
    },
    // errorPlacement: function (error, element) {
    //     error.insertAfter(element);
    // },
    messages: {
        newsletter_subject: {
            remote: "Newsletter subject already exists"
        },
        tour_image1: {
            extension: 'File type must be JPG, JPEG or PNG',
            filesize: 'File size must be less than 800 KB'
        }
    },
    submitHandler: function (form) {
        jQuery('.load-main').removeClass('hidden');
        form.submit();
    }
});

/**
     * Delete multiple users
     */
function delete_selected() {
    var shared_tour_ids = '';

    $(".checkbox:checked").each(function () {
        var id = $(this).attr('id');
        shared_tour_ids = id + ',' + shared_tour_ids;
    });
    if (shared_tour_ids == '') {
        jGrowlAlert("Please select some records for delete shared tour list", 'danger');
        // preventDefault();
    } else {
        swal({
            title: "Are you sure you want to delete selected records?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "No, Cancel It",
            confirmButtonText: "Yes, I am sure",
        },
            function () {
                jQuery(".load-main").removeClass('hidden');
                $.ajax({
                    url: BASE_URL + 'shared_tour/delete',
                    dataType: 'JSON',
                    type: 'POST',
                    data: {
                        ids: shared_tour_ids.replace(/,\s*$/, ""),
                    },
                    success: function (msg) {
                        if (msg.success) {
                            setTimeout(function () {
                                jQuery(".load-main").addClass('hidden');
                                swal({
                                    title: "Users deleted successfully",
                                    type: "success",
                                });
                            }, 100);
                            $('#sharedtour_list_table').DataTable().destroy();
                            fetch_data();
                        } else {
                            setTimeout(function () {
                                jQuery(".load-main").addClass('hidden');
                                swal({
                                    title: "You do not have enough permissions to access this page. Please contact to your Administrator.",
                                    type: "error",
                                });
                            }, 100);

                        }
                    }
                });
            });
    }
}

/**
 * Deletes a single record when clicked on delete icon
 *
 * @param {int}  id  The identifier
 */
function delete_record(obj) {
    console.log(obj.id);
    swal({
        title: jQuery("#swal_title").val(),
        text: jQuery("#swal_text").val(),
        type: "warning",
        showCancelButton: true,
        cancelButtonText: jQuery("#swal_cancelButtonText").val(),
        confirmButtonText: jQuery("#swal_confirmButtonText").val(),
    },
        function () {
            jQuery('.load-main').removeClass('hidden');
            $.ajax({
                url: BASE_URL + 'shared_tour/delete',
                type: 'POST',
                data: {
                    id: obj.id,
                    single: true
                },
                dataType: 'JSON',
                success: function (response) {
                    jQuery('.load-main').addClass('hidden');
                    if (response.success) {
                        $('#sharedtour_list_table').DataTable().ajax.reload();
                        jGrowlAlert(response.msg, 'success');
                    } else {
                        jGrowlAlert(response.msg, 'danger');
                    }
                }
            });
        });
}