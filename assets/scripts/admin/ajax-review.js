jQuery(document).ready(function () {

    if (jQuery("#review_list_table").length) {

        $('#review_list_table').DataTable({
            // Processing indicator
            "processing": true,
            // DataTables server-side processing mode
            "serverSide": true,
            // Initial no order.
            "order": [],
            "searching": true,

            // Load data from an Ajax source
            "ajax": {
                "url": BASE_URL + 'reviews/getLists/',
                "type": "POST"
            },
            "columns": [
                { data: 'RecordID', 'sortable': false, "orderable": false }, //0
                { data: 'title' }, //1
                { data: 'username' }, //2
                { data: 'tour_name' }, //3
                { data: 'review_date' }, //4
                { data: 'city' }, //5
                { data: 'country' }, //6
                // { data: null,"orderable": false  },// 8
                { data: 'action' }, // 7
            ],
            //Set column definition initialisation properties
            "columnDefs": [
                {
                    'targets': [7],
                    'title': 'Actions',
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        //var id = data.id;
                        return '<a href="' + BASE_URL + 'reviews/edit/' + data + '" data-popup="tooltip" data-placement="top"  title="edit" id="edit' + data + '" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="' + data + '"><i class=" icon-trash"></i></a>';
                    }
                }
                // {
                //  'targets': [8],
                //  'title': 'Status',
                //  'searchable': false,
                //  'orderable': false,
                //  'className': 'dt-body-center',
                //  'render': function (data, type, full, meta){
                //     if(data.status == 1){
                //         return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'+ btoa(data.id) +'" checked="checked"></label></div>';
                //     }else{
                //         return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'+btoa(data.id)+'" ></label></div>';
                //     }
                //  }
                // }       
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
                url: BASE_URL + 'reviews/delete',
                type: 'POST',
                data: {
                    review_id: obj.id
                },
                dataType: 'JSON',
                success: function (response) {
                    jQuery(".load-main").addClass('hidden');
                    if (response.success) {
                        $('#review_list_table').DataTable().ajax.reload();
                        jGrowlAlert(response.msg, 'success');
                    }
                    else {
                        jGrowlAlert(response.msg, 'warning');
                    }
                }
            });
        });
}

jQuery(document).on("change", ".review-for", function () {
    jQuery(".tour-id-selction").removeClass("hidden");
    $("#tour_id").val(null).trigger('change');
    jQuery("#tour_id").rules('add', 'required');
    if ($(this).val() == 'page') {
        jQuery(".tour-id-selction").addClass("hidden");
        $("#tour_id").val(null).trigger('change');
        jQuery("#tour_id").rules('remove', 'required');
    }
});
jQuery(document).on("change", "#tour_id", function () {
    jQuery("#tour_id").rules('add', 'required');
});