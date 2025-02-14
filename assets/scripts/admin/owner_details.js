document.getElementById('ownerImage').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const imagePreview = document.getElementById('imagePreview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;  // Set the preview image source
            imagePreview.style.display = 'block'; // Show the image preview
        }
        reader.readAsDataURL(file); // Convert the image file to a data URL
    } else {
        imagePreview.src = '';  // Clear the image preview if no file is selected
        imagePreview.style.display = 'none';
    }
});

// Initialize CKEditor with the full toolbar and code view option
jQuery('[name="owner_description"]')

    .summernote({

        height: 400,

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

$(document).ready(function () {
    $('#ownerDetails').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: BASE_URL +'owner_details',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                // console.log(response.status);
                if (response.status === 'success') {
                    // Show success message in right corner
                    toastr.success(response.message);
                    // Optionally, reset the form or update parts of the page

                } else {
                    // Show error message
                    toastr.error(response.message);
                }
            },
            error: function () {
                toastr.error('An unexpected error occurred. Please try again.');
            }
        });
    });
});