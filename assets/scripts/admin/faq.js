$('#faqAdd').on('click', function () {
    $('#id').val('');
    $('#faqModal').modal('show');
})


$(document).ready(function () {
    // Initialize DataTable
    fetch_data();
});

function fetch_data() {
var faqDataTable = $('#faq_table').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "searching": true,
    "ajax": {
        "url": BASE_URL + 'get_faq_list',
        "type": "POST"
    },
    "columns": [
        { data: 'sequence_id', 'sortable': false, "orderable": false }, //0
        { data: 'title', "orderable": true }, //1
        { data: 'description', "orderable": false }, //2
        { data: 'id' } //3
    ],
    "columnDefs": [
        {
            'targets': [0],
            'title': 'Drag',
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta) {
                return '<i class="fa fa-bars drag-handle" title="Drag"></i>';
            }
        },
        {
            'targets': [1],
            'title': 'Title',
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta) {
                return data;
            }
        },
        {
            'targets': [2],
            'title': 'Description',
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
    "drawCallback": function(settings) {
        // Add data-id attribute to each row with the appropriate id
        $('#faq_table tbody tr').each(function() {
            var rowData = faqDataTable.row(this).data();
            if (rowData) {
                $(this).attr('data-id', rowData.id); // Assign row's id as data-id
            }
        });
        
        // Apply sortable functionality after DataTables draws the table
        makeRowsSortable();
    }
});
}

// Function to make rows sortable
function makeRowsSortable() {
$("#faq_table tbody").sortable({
    handle: ".drag-handle",
    update: function(event, ui) {
        var newOrder = $(this).sortable("toArray", { attribute: "data-id" });
        $.ajax({
            url: BASE_URL + 'update_faq_sequence',
            type: 'POST',
            data: { sequence: newOrder },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    toastr.success("Sequence updated successfully");
                } else {
                    toastr.error("Failed to update sequence");
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while updating the sequence.');
            }
        });
    }
}).disableSelection();
}





$('#faqForm').on('submit', function (e) {
    e.preventDefault();

    // Create a FormData object to gather all the input values, including files
    var formData = new FormData(this);

    $.ajax({
        url: BASE_URL +'faq', // Replace with your server-side URL
        type: 'POST',
        data: formData,
        processData: false, // Prevent jQuery from converting the FormData object to a string
        contentType: false, // Let jQuery set the correct Content-Type for file upload
        dataType: 'json',
        success: function (response) {
            
            if (response.status === 'success') {
                toastr.success(response.message);

                // Reload DataTable to show the new data
                $('#faq_table').DataTable().ajax.reload();

                // Reset the form
                $('#faqForm')[0].reset();
                $('#faqModal').modal('hide');
            } else {
                toastr.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while saving the faq item.');
        }
    });
});


function edit_record(id) {
    // Fetch the faq details based on the id
    $.ajax({
        url: BASE_URL +"get_faq_details", // URL to your controller method
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                // Populate fields
                $('#faqTitle').val(response.data.title);
                $('#id').val(response.data.id);
                $('#faqDescription').val(response.data.description);

                // Show the modal
                $('#faqModal').modal('show');

            } else {
                alert('Failed to fetch faq details: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while fetching the faq details.');
        }
    });
}

function delete_record(id) {

    swal({
        title: "Are you sure you want to delete selected records?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Yes",
    },
        function () {
            $.ajax({
                url: BASE_URL +"delete_faq", // URL to your controller method
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#faq_table').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the faq details.');
                }
            });
        });
    // }
}