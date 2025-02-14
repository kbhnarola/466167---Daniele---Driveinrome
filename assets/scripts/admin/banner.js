function previewVideo(event) {
    const file = event.target.files[0];

    if (file && file.type.startsWith('video/')) {
        const videoPreview = document.getElementById('videoPreview');
        const videoContainer = document.getElementById('videoContainer');

        // Create a URL for the video file and set it as the src for the video preview
        videoPreview.src = URL.createObjectURL(file);
        videoContainer.style.display = 'block'; // Show the video container
        videoPreview.load(); // Load the new video source
        videoPreview.play(); // Autoplay the video
    }
}

$(document).ready(function () {
    $('#bannerDetails').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: BASE_URL + 'banner',
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