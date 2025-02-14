<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>



<!-- /Page header -->



<!-- Content area -->



<div class="custom-form rate-close-wrapper">
    <fieldset>
        <legend>Rates</legend>

        <!-- "Add rates" Button Aligned to the Right -->
        <div class="text-right mb-2" style="padding: 10px;
    margin-bottom: 10px; margin-top: -20px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" id="ratesAdd">
                Add Rates
            </button>
        </div>

        <!-- DataTable for displaying rates items -->
        <table id="rates_table" class="table table-bordered table-striped">
            <thead>
                <tr>

                    <th>Drag</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
</div>
</fieldset>


<!-- Modal Structure -->
<div class="modal fade" id="ratesModal" tabindex="-1" role="dialog" aria-labelledby="ratesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="ratesForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratesModalLabel">Rates Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id" name="id" class="form-control">

                        <!-- From Date Input Field -->
                        <div class="col-md-6 mt-3">
                            <label class="col-form-label label_text">From Date <small
                                    class="req text-danger">*</small></label>
                            <input type="date" id="fromDate" name="from_date" class="form-control" required>
                        </div>

                        <!-- To Date Input Field -->
                        <div class="col-md-6 mt-3">
                            <label class="col-form-label label_text">To Date <small
                                    class="req text-danger">*</small></label>
                            <input type="date" id="toDate" name="to_date" class="form-control" required>
                        </div>

                        <!-- Price Input Field -->
                        <div class="col-md-6 mt-3">
                            <label class="col-form-label label_text">Price <small
                                    class="req text-danger">*</small></label>
                            <input type="number" id="price" name="price" class="form-control" placeholder="Enter price"
                                min="0" step="0.01" required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- /Panel -->



<!-- /page header -->

<!-- Add CKEditor Script -->

<script>

    $('#ratesAdd').on('click', function () {
        $('#id').val('');
        $('#ratesModal').modal('show');
    })


    $(document).ready(function () {
        // Initialize DataTable
        fetch_data();
    });

    function fetch_data() {
        var ratesDataTable = $('#rates_table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "searching": true,
            "ajax": {
                "url": BASE_URL + 'get_rates_list',
                "type": "POST"
            },
            "columns": [
                { data: 'from_date', 'sortable': true, "orderable": true }, //0
                { data: 'to_date', "orderable": true }, //1
                { data: 'price', "orderable": true }, //2
                { data: 'id' } //3
            ],
            "columnDefs": [
                {
                    'targets': [0],
                    'title': 'From Date',
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return data;
                    }
                },
                {
                    'targets': [1],
                    'title': 'To date',
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return data;
                    }
                },
                {
                    'targets': [2],
                    'title': 'Price',
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return data;
                    }
                },
                {
                    'targets': [3],
                    'title': 'Actions',
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return '<input type="hidden" value="' + data + '" id="hiddenId">' +
                            '<a href="javascript:" onclick="edit_record(' + data + ')" data-popup="tooltip" data-placement="top" title="edit" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;' +
                            '<a href="javascript:" onclick="delete_record(' + data + ')" data-popup="tooltip" data-placement="top" title="delete" class="text-danger delete"><i class="icon-trash"></i></a>';
                    }
                }
            ],
            // "drawCallback": function (settings) {
            //     // Add data-id attribute to each row with the appropriate id
            //     $('#rates_table tbody tr').each(function () {
            //         var rowData = ratesDataTable.row(this).data();
            //         if (rowData) {
            //             $(this).attr('data-id', rowData.id); // Assign row's id as data-id
            //         }
            //     });

            //     // Apply sortable functionality after DataTables draws the table
            //     makeRowsSortable();
            // }
        });
    }

    // Function to make rows sortable
    // function makeRowsSortable() {
    //     $("#rates_table tbody").sortable({
    //         handle: ".drag-handle",
    //         update: function (event, ui) {
    //             var newOrder = $(this).sortable("toArray", { attribute: "data-id" });
    //             $.ajax({
    //                 url: BASE_URL + 'update_rates_sequence',
    //                 type: 'POST',
    //                 data: { sequence: newOrder },
    //                 dataType: 'json',
    //                 success: function (response) {
    //                     if (response.status === 'success') {
    //                         toastr.success("Sequence updated successfully");
    //                     } else {
    //                         toastr.error("Failed to update sequence");
    //                     }
    //                 },
    //                 error: function (xhr, status, error) {
    //                     console.error('Error:', error);
    //                     alert('An error occurred while updating the sequence.');
    //                 }
    //             });
    //         }
    //     }).disableSelection();
    // }





    $('#ratesForm').on('submit', function (e) {
        e.preventDefault();

        // Create a FormData object to gather all the input values, including files
        var formData = new FormData(this);

        $.ajax({
            url: '<?php echo admin_url('availability_rates'); ?>', // Replace with your server-side URL
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from converting the FormData object to a string
            contentType: false, // Let jQuery set the correct Content-Type for file upload
            dataType: 'json',
            success: function (response) {
             
                if (response.status === 'success') {
                    toastr.success(response.message);

                    // Reload DataTable to show the new data
                    $('#rates_table').DataTable().ajax.reload();

                    // Reset the form
                    $('#ratesForm')[0].reset();
                    $('#ratesModal').modal('hide');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while saving the rates item.');
            }
        });
    });


    function edit_record(id) {
        // Fetch the rates details based on the id
        $.ajax({
            url: '<?php echo admin_url("get_rates_details"); ?>', // URL to your controller method
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    // Populate fields
                    $('#fromDate').val(response.data.from_date);
                    $('#toDate').val(response.data.to_date);
                    $('#id').val(response.data.id);
                    $('#price').val(response.data.price);

                    // Show the modal
                    $('#ratesModal').modal('show');

                } else {
                    alert('Failed to fetch rates details: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while fetching the rates details.');
            }
        });
    }

    function delete_record(id) {

        swal({
            title: "<?php echo 'Are you sure you want to delete selected records?'; ?>",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "<?php _el('no_cancel_it'); ?>",
            confirmButtonText: "<?php _el('yes_i_am_sure'); ?>",
        },
            function () {
                $.ajax({
                    url: '<?php echo admin_url("delete_rates"); ?>', // URL to your controller method
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#rates_table').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the rates details.');
                    }
                });
            });
        // }
    }
</script>