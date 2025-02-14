jQuery(document).ready(function () {

    if (jQuery("#tour_list_table").length) {

        $('#tour_list_table').DataTable({
            // Processing indicator
            "processing": true,
            // DataTables server-side processing mode
            "serverSide": true,
            // Initial no order.
            "order": [],
            "searching": true,

            // Load data from an Ajax source
            "ajax": {
                "url": BASE_URL + 'transfer_tours/getLists/',
                "type": "POST"
            },
            "columns": [
                { data: 'RecordID', 'sortable': false, "orderable": false }, //0
                { data: 'tour_name' }, //1
                { data: 'tour_type' }, //2
                { data: 'tour_category' }, //3                    
                { data: 'unique_code' }, //4
                { data: 'duration' }, //5
                { data: 'ratings', "orderable": false }, //6
                { data: 'extra_services', "orderable": false }, //7
                { data: 'extra_costs', "orderable": false }, //8
                { data: null, "orderable": false },// 9
                { data: 'action' }, // 10
            ],
            //Set column definition initialisation properties
            "columnDefs": [
                {
                    'targets': [10],
                    'title': 'Actions',
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        //var id = data.id;
                        return '<a href="' + BASE_URL + 'transfer-tours/edit/' + data + '" data-popup="tooltip" data-placement="top"  title="edit" id="edit' + data + '" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="' + data + '"><i class=" icon-trash"></i></a>';
                    }
                },
                {
                    'targets': [9],
                    'title': 'Status',
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        if (data.status == 1) {
                            return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="' + btoa(data.id) + '" checked="checked"></label></div>';
                        } else {
                            return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="' + btoa(data.id) + '" ></label></div>';
                        }
                    }
                }
            ]
        });
    }

    if (jQuery("#error").val()) {
        var error = jQuery("#error").val();
        jGrowlAlert(error, 'danger');

    }
    if (jQuery("#success").val()) {
        var success = jQuery("#success").val();
        jGrowlAlert(success, 'success');
    }


});

/**
 * Change status when clicked on the status switch
 *
 * @param int  status  
 * @param int  tour_id
 */
function change_status(obj) {
    var checked = 0;

    if (obj.checked) {
        checked = 1;
    }
    $('.jGrowl-notification').trigger('jGrowl.close');
    jQuery.ajax({
        url: BASE_URL + 'transfer_tours/update_status',
        type: 'POST',
        data: {
            tour_id: obj.id,
            is_active: checked
        },
        dataType: 'JSON',
        success: function (response) {
            //$('.jGrowl-notification').trigger('jGrowl.close');
            if (response.success) {
                if (response.msg == 'true') {
                    jGrowlAlert(response.alert_msg, 'success');
                }
                else {
                    jGrowlAlert(response.alert_msg, 'success');
                }
            } else {
                jGrowlAlert(response.msg, 'danger');
            }
        }
    });
}

/**
 * Deletes a single record when clicked on delete icon
 *
 * @param {int}  id  The identifier
 */
function delete_record(obj) {
    swal({
        title: jQuery("#swal_title").val(),
        text: jQuery("#swal_text").val(),
        type: "warning",
        showCancelButton: true,
        cancelButtonText: jQuery("#swal_cancelButtonText").val(),
        confirmButtonText: jQuery("#swal_confirmButtonText").val(),
    },
        function () {
            jQuery(".load-main").removeClass('hidden');
            $.ajax({
                url: BASE_URL + 'transfer_tours/delete',
                type: 'POST',
                data: {
                    tour_id: obj.id
                },
                dataType: 'JSON',
                success: function (response) {
                    jQuery(".load-main").addClass('hidden');
                    if (response.success) {
                        $('#tour_list_table').DataTable().ajax.reload();
                        jGrowlAlert(response.msg, 'success');
                    }
                    else {
                        jGrowlAlert(response.msg, 'warning');
                    }
                }
            });
        });
}