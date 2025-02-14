
$(document).ready(function () {
    $('#locationDetails').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: BASE_URL +'location',
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


const apiKey = "AIzaSyBK73HewkhHBVVs9nI98-HY_N7cZM_kdjE";
const zoomLevel = 18;
const defaultLocation = "New York, NY";

// Initialize map with a default location
function initializeMap(location) {
    const embedURL = `https://www.google.com/maps/embed/v1/place?key=${apiKey}&q=${encodeURIComponent(location)}&zoom=${zoomLevel}`;
    $("#map-canvas").attr("src", embedURL);
}

// Update map dynamically as user types
function updateMap(address) {
    if (address) {
        // If address is entered, update the map with the input address
        initializeMap(address);
        $("#error-msg").text("");
    } else {
        // If address is empty, show the default location
        initializeMap(defaultLocation);
        $("#error-msg").text("Showing default location.");
    }
}

$(document).ready(function () {
    // Initialize map with the default location
    initializeMap(defaultLocation);
    const address = $("#address").val().trim();
    console.log(address)
    // Update map dynamically on address input
    if (address) {
        updateMap(address);
    }
    $("#address").on("input", function () {
        const address = $(this).val();
        updateMap(address);
    });

});


// Initialize CKEditor with the full toolbar and code view option
jQuery('[name="locationdescription"]')

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