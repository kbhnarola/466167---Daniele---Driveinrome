
    $('#photosAdd').on('click', function () {
        $('#photosImagePreview').attr('src', '').hide();
        $('#id').val('');
        $('#photosModal').modal('show');
    })

    //Preview Image
    function previewImage(event) {
        const preview = document.getElementById('photosImagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    }

    $(document).ready(function () {
        // Initialize DataTable
        fetch_data();
    });

    function fetch_data() {
        var photosDataTable = $('#photos_table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "searching": false,
            "ajax": {
                "url": BASE_URL + 'get_photos_list',
                "type": "POST"
            },
            "columns": [
                { data: 'name' } // Assuming this is the image URL field
            ],
            "columnDefs": [
                {
                    'targets': [0],
                    'title': 'Photos',
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        var imageUrl = data; // Assuming the data has the image URL
                        return `
                    <div class="photo-container" data-id="${full['id']}">
                        
                        <img src="${imageUrl}" alt="Photo" class="drag-handle" title="Drag to rearrange">
                        <div class="action-icons">
                            <a href="javascript:" onclick="edit_record(${full['id']})" title="Edit">
                                <i class="icon-pencil7"></i>
                            </a>
                            <a href="javascript:" onclick="delete_record(${full['id']})" title="Delete">
                                <i class="icon-trash"></i>
                            </a>
                        </div>
                    </div>`;
                    }
                }
            ],
            "drawCallback": function () {
                // Initialize sortable functionality on each table redraw
                $('#photos_table tbody tr').each(function() {
                var rowData = photosDataTable.row(this).data();
                if (rowData) {
                    $(this).attr('data-id', rowData.id); // Assign row's id as data-id
                }
            });
                makeSortable();
            }
        });

        // Function to make rows sortable
        function makeSortable() {
            $('#photos_table tbody').sortable({
                handle: '.drag-handle', // Only allow dragging by the drag handle
                cursor: 'move',
                update: function (event, ui) {
                    // Get the new order of elements
                    var orderedIds = $(this).sortable('toArray', { attribute: 'data-id' });

                    // Send the new order to the server to save it
                    saveOrder(orderedIds);
                }
            });
        }

        // Function to save new order to the server
        function saveOrder(orderedIds) {
            $.ajax({
                url: BASE_URL + 'save_photo_order',
                type: 'POST',
                data: { orderedIds: orderedIds },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success("Sequence updated successfully");
                    } else {
                        toastr.error("Failed to update sequence");
                    }
                },
                error: function (error) {
                    toastr.error("An error occurred while updating the sequence.");
                }
            });
        }
    }

    $('#photosForm').on('submit', function (e) {
        e.preventDefault();

        // Create a FormData object to gather all the input values, including files
        var formData = new FormData(this);

        $.ajax({
            url: BASE_URL +'photos', // Replace with your server-side URL
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from converting the FormData object to a string
            contentType: false, // Let jQuery set the correct Content-Type for file upload
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.status === 'success') {
                    toastr.success(response.message);

                    // Reload DataTable to show the new data
                    $('#photos_table').DataTable().ajax.reload();

                    // Reset the form
                    $('#photosForm')[0].reset();
                    $('#photosModal').modal('hide');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while saving the Photos.');
            }
        });
    });


    function edit_record(id) {
        // Fetch the overview details based on the id
        $.ajax({
            url: BASE_URL + "get_photo", // URL to your controller method
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {

                    $('#photos').val(response.data.name);
                    $('#id').val(response.data.id);

                    // Set image preview if available
                    if (response.data.name) {
                        $('#photosImagePreview').attr('src', response.data.name).show();
                    } else {
                        $('#photosImagePreview').hide(); // Hide preview if no icon is available
                    }

                    // Show the modal
                    $('#photosModal').modal('show');

                } else {
                    alert('Failed to fetch photos: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while fetching the photos.');
            }
        });
    }


    function delete_record(id) {

        swal({
            title: 'Are you sure you want to delete selected records?',
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "No",
            confirmButtonText: "Yes",
        },
            function () {
                $.ajax({
                    url: BASE_URL +"delete_photo", // URL to your controller method
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#photos_table').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the photo.');
                    }
                });
            });
        // }
    }
