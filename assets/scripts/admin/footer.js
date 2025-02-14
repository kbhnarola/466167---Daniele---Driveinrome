$(document).ready(function () {
    $('#footerDetails').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: BASE_URL +'footer',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
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