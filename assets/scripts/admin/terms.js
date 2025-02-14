$(document).ready(function () {
    $('#termsDetails').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: BASE_URL +'terms',
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



jQuery('[name="terms_condtion"]')

.summernote({

height: 400,

tabsize: 2,

fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],

followingToolbar: true,

//codeviewFilter: true,

toolbar: [

    // [groupName, [list of button]]

    ['style', ['style','bold', 'italic', 'underline', 'clear']],

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

    ['misc', ['fullscreen', 'codeview','help', 'undo', 'redo']]

  ]

});