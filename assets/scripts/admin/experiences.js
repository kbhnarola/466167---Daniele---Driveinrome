
$('#experiencesAdd').on('click', function () {
    $('#Description').summernote('code', ''); // clear the experi. description
    $('#iconImagePreview').attr('src', '').hide();
    $('#id').val('');
    $('#experiencesModal').modal('show');
})

document.getElementById('Image').addEventListener('change', function (event) {
    const [file] = event.target.files;
    if (file) {
        const preview = document.getElementById('iconImagePreview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});



$(document).ready(function () {
    // Initialize DataTable
    fetch_data();
});

function fetch_data() {
    var experiencesDataTable = $('#experiences_table').DataTable({
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

            "url": BASE_URL + 'get_experiences_list',

            "type": "POST"

        },

        "columns": [

            { data: 'image', 'sortable': false, "orderable": false }, //0

            { data: 'title', "orderable": false }, //1

            { data: 'description', "orderable": false },// 2

            // { data: 'page_url', "orderable": false },// 2

            { data: 'price', "orderable": false },// 3

            { data: 'id' }, // 4

        ],

        //Set column definition initialisation properties

        "columnDefs": [

            {

                'targets': [0],

                'title': 'Images',

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

                'title': 'Price',

                'searchable': false,

                'orderable': false,

                'className': 'dt-body-center',

                'render': function (data, type, full, meta) {

                    return data;

                }

            },

            {

                'targets': [4],

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



$('#experiencesForm').on('submit', function (e) {
    e.preventDefault();

    // Create a FormData object to gather all the input values, including files
    var formData = new FormData(this);

    $.ajax({
        url: BASE_URL +'experiences', // Replace with your server-side URL
        type: 'POST',
        data: formData,
        processData: false, // Prevent jQuery from converting the FormData object to a string
        contentType: false, // Let jQuery set the correct Content-Type for file upload
        dataType: 'json',
        success: function (response) {

            if (response.status === 'success') {
                toastr.success(response.message);

                // Reload DataTable to show the new data
                $('#experiences_table').DataTable().ajax.reload();

                // Reset the form
                $('#experiencesForm')[0].reset();
                $('#experiencesModal').modal('hide');
            } else {
                toastr.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while saving the experiences item.');
        }
    });
});


function edit_record(id) {
    // Fetch the experiences details based on the id
    $.ajax({
        url: BASE_URL +"get_experiences_details", // URL to your controller method
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                // Populate fields
                $('#Title').val(response.data.title);
                $('#Description').summernote('code', response.data.description);
                $('#Price').val(response.data.price);
                $('#image').val(response.data.image);
                $('#pdf').val(response.data.psf);
                $('#id').val(response.data.id);



                // Set image preview if available
                if (response.data.image) {
                    $('#iconImagePreview').attr('src', response.data.image).show();
                } else {
                    $('#iconImagePreview').hide(); // Hide preview if no icon is available
                }

                // Show the modal
                $('#experiencesModal').modal('show');

            } else {
                alert('Failed to fetch experiences details: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while fetching the experiences details.');
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
                url: BASE_URL +"delete_experiences", // URL to your controller method
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#experiences_table').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the experiences details.');
                }
            });
        });
    // }
}

$(document).ready(function () {
    // Auto-save Overview Title when input loses focus
    $("#experiences_title").on("blur", function () {
        const title = $(this).val();

        if (title) {
            // Save data via AJAX
            $.ajax({
                url: BASE_URL +'save_experiences_title', // Replace with your controller endpoint
                type: "POST",
                data: { experiences_title: title },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert("An error occurred while saving the experiences title: " + error);
                }
            });
        }
    });
});


function change_status(checkbox) {
// Determine the status based on the checkbox state
const status = checkbox.checked ? 1 : 0;

// Make an AJAX call to the controller
$.ajax({
    url: BASE_URL +'experiences/change_status', // Replace with your actual controller URL
    type: "POST",
    data: {
        status: status
    },
    dataType: "json",
    success: function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
    error: function () {
        // Handle error
        alert("An error occurred while updating the status.");
    }
});
}

jQuery('[name="description"]').summernote({
    height: 200,
    tabsize: 2,
    fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48', '64', '82', '150'],
    followingToolbar: true,
    //codeviewFilter: true,
    toolbar: [
        // [groupName, [list of button]]
        ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
        // ['style', ['bold', 'italic', 'underline', 'clear']],
        // ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['table', ['table']],
        ['para', ['ul', 'ol', 'paragraph']],
        //['height', ['height']],
        ['codeviewFilter', true],
        ['insert', ['picture', 'lvideo', 'link', 'hr']],
        ['misc', ['fullscreen', 'codeview', 'help', 'undo', 'redo']]
    ]
});
