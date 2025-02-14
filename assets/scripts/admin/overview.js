
$('#overviewAdd').on('click', function () {
    $('#iconImagePreview').attr('src', '').hide();
    $('#id').val('');
    $('#numberField').hide();
    $('#overviewModal').modal('show');
})
document.getElementById('iconImage').addEventListener('change', function (event) {
    const file = event.target.files[0];

    // Check if a file is selected and it is an SVG
    if (file && file.type === 'image/svg+xml') {
        const reader = new FileReader();

        // Once file is read, set it as the src of the preview image
        reader.onload = function (e) {
            const iconPreview = document.getElementById('iconImagePreview');
            iconPreview.src = e.target.result;
            iconPreview.style.display = 'block'; // Show the image
        };

        reader.readAsDataURL(file); // Read the file as a data URL
    } else {
        toastr.error('Please select a valid SVG image.');
        event.target.value = ''; // Clear the file input if invalid
    }
});

// Initialize CKEditor for the overview description textarea
document.getElementById('highlightType').addEventListener('change', function () {
    var numberField = document.getElementById('numberField');
    if (this.value === 'non_highlight') {
        numberField.style.display = 'block';
    } else {
        numberField.style.display = 'none';
    }
});

$(document).ready(function () {
    // Initialize DataTable
    fetch_data();
});

function fetch_data() {
    var overviewDataTable = $('#overview_table').DataTable({
        // Processing indicator

        "processing": true,

        // DataTables server-side processing mode

        "serverSide": true,

        // Initial no order.

        "order": [],

        "searching": true,

        //"scrollY": 200,

        //"scrollX": 200,



        // Load data from an Ajax source

        "ajax": {

            "url": BASE_URL + 'get_overview_list',

            "type": "POST"

        },

        "columns": [

            { data: 'icon', 'sortable': false, "orderable": false }, //0

            { data: 'title', "orderable": false }, //1

            //{ data: 'description',"orderable": false  },// 2

            // { data: 'page_url', "orderable": false },// 2

            { data: 'is_active', "orderable": false },// 3

            { data: 'id' }, // 4

        ],

        //Set column definition initialisation properties

        "columnDefs": [

            {

                'targets': [0],

                'title': 'Icon',

                'searchable': false,

                'orderable': false,

                'className': 'dt-body-center',

                'render': function (data, type, full, meta) {
                    return '<img src="' + data + '" class="img-thumbnail" width="50" height="50" alt="Icon">';
                }


            },
            {

                'targets': [1],

                'title': 'Title',

                'searchable': false,

                'orderable': false,

                'className': 'dt-body-center',

                'render': function (data, type, full, meta) {

                    return  data ;

                }

            },

            {

                'targets': [2],

                'title': 'Status',

                'searchable': false,

                'orderable': false,

                'className': 'dt-body-center',

                'render': function (data, type, full, meta) {

                    if (data === "1") {

                        return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" checked="checked"></label></div>';

                    } else {

                        return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" ></label></div>';

                    }


                }

            },

            {

                'targets': [3],

                'title': 'Actions',

                'searchable': false,

                'orderable': false,

                'className': 'dt-body-center',

                'render': function (data, type, full, meta) {

                    //var id = data.id;

                    return '<input type="hidden" value="' + data + '" id="hiddenId"><a href="javascript:" onclick="edit_record(' + data + ')" data-popup="tooltip" data-placement="top"  title="edit" id="' + data + '" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(' + data + ')" class="text-danger delete" id="' + data + '"><i class=" icon-trash"></i></a>';



                    // return '<a href="'+BASE_URL+'cms_pages/edit/'+data+'" data-popup="tooltip" data-placement="top"  title="edit" id="edit'+data+'" class="text-info"><i class="icon-pencil7"></i></a>';

                }

            }

        ],
    });
}



$('#overviewForm').on('submit', function (e) {
    e.preventDefault();

    // Create a FormData object to gather all the input values, including files
    var formData = new FormData(this);

    $.ajax({
        url: BASE_URL +'overviews', // Replace with your server-side URL
        type: 'POST',
        data: formData,
        processData: false, // Prevent jQuery from converting the FormData object to a string
        contentType: false, // Let jQuery set the correct Content-Type for file upload
        dataType: 'json',
        success: function (response) {

            if (response.status === 'success') {
                toastr.success(response.message);

                // Reload DataTable to show the new data
                $('#overview_table').DataTable().ajax.reload();

                // Reset the form
                $('#overviewForm')[0].reset();
                $('#overviewModal').modal('hide');
            } else {
                toastr.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while saving the overview item.');
        }
    });
});


function edit_record(id) {
    // Fetch the overview details based on the id
    $.ajax({
        url: BASE_URL +"get_overview_details", // URL to your controller method
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                // Populate fields
                $('#iconTitle').val(response.data.title);
                $('#description').val(response.data.description);
                $('#highlightType').val(response.data.highlight_type);
                $('#iconImagefile').val(response.data.icon);
                $('#id').val(response.data.id);

                // Enable/disable 'number' field based on 'highlight_type'
                var numberField = document.getElementById('numberField');
                if (response.data.highlight_type === 'proper_highlight') {
                    numberField.style.display = 'none';
                } else {
                    numberField.style.display = 'block';
                    $('#highlightNumber').val(response.data.number); // Set value if available
                }

                // Set image preview if available
                if (response.data.icon) {
                    $('#iconImagePreview').attr('src', response.data.icon).show();
                } else {
                    $('#iconImagePreview').hide(); // Hide preview if no icon is available
                }

                // Show the modal
                $('#overviewModal').modal('show');

            } else {
                alert('Failed to fetch overview details: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while fetching the overview details.');
        }
    });
}


function change_status(checkbox) {
    // Fetch the overview details based on the id
    var closestRow = $(checkbox).closest('tr');

    // Find the closest hidden <input> element inside the <tr>
    var hiddenInput = closestRow.find('input[type="hidden"]');

    // Get the value of the hidden input (in this case, '123')
    var hiddenValue = hiddenInput.val();
    var status = $(checkbox).prop('checked') ? 'Active' : 'Inactive'

    $.ajax({
        url: BASE_URL +"overviews/change_status", // URL to your controller method
        type: 'POST',
        data: { id: hiddenValue, status: status },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                // Populate fields
                toastr.success(response.message);
                $('#overview_table').DataTable().ajax.reload();
            } else {
                toastr.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while fetching the overview details.');
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
                url: BASE_URL +"delete_overview", // URL to your controller method
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#overview_table').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the overview details.');
                }
            });
        });
    // }
}


$(document).ready(function () {
    // Auto-save Overview Title when input loses focus
    $("#overview_title").on("blur", function () {
        // const title = $(this).val().trim();
        const title = $(this).val();

        if (title) {
            // Save data via AJAX
            $.ajax({
                url: BASE_URL +'save_overview_title', // Replace with your controller endpoint
                type: "POST",
                data: { overview_title: title },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert("An error occurred while saving the overview title: " + error);
                }
            });
        }
    });
});
