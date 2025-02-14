
    $(document).ready(function () {

        $('#availabilityDetails').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: BASE_URL +'availability',
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



    jQuery('[name="availability_title"]')

        .summernote({

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

    jQuery('[name="availability_description"]')

        .summernote({

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


    $(function () {
        let mode = "single"; // Default mode is Single Date
        let rangeStart = null; // Start date for range selection
        let rangeEnd = null; // End date for range selection
        var bookedDates = [];
        var optionedDates = [];
        // Initialize Datepicker
        $("#datepicker").datepicker({
            numberOfMonths: 2,
            dateFormat: "mm/dd/yy",
            minDate: 0,
            onChangeMonthYear: function (year, month, inst) {
                // On month change, get the availability dates for the selected month
                getAvailabilityDates(month, year);
            },
            onSelect: function (dateText) {
                $('#bookingOption').val(1);
                if (mode === "single") {
                    // Single date mode: set the single date input
                    $("#single_date").val(dateText);
                    const [month, day, year] = dateText.split('/');
                    const formattedDate = `${day}/${month}/${year}`;
                    // Assign the same date to both rangeStart and rangeEnd for single date mode
                    rangeStart = $.datepicker.parseDate("mm/dd/yy", dateText);
                    rangeEnd = rangeStart; // Set end date same as start date

                    // Open modal and show selected date with the dropdown
                    $("#selectedDateDisplay").html(`Selected Date: <strong>${formattedDate}</strong>`);
                    $('#dateModal').modal('show'); // Show the modal
                    $('.modal-backdrop').remove();
                } else if (mode === "range") {
                    const selectedDate = $.datepicker.parseDate("mm/dd/yy", dateText);

                    if (!rangeStart || (rangeStart && rangeEnd)) {
                        // If no start date or both dates are set, reset and start a new range
                        rangeStart = selectedDate;
                        rangeEnd = null;
                        $("#checkin").val($.datepicker.formatDate("mm/dd/yy", rangeStart));
                        $("#checkout").val("");
                        $("#dates").val("");
                    } else if (!rangeEnd) {
                        // If only start date is set, determine if the new date is before or after it
                        if (selectedDate < rangeStart) {
                            // If the selected date is before the start date, make it the new start
                            rangeEnd = rangeStart;
                            rangeStart = selectedDate;
                        } else {
                            // Otherwise, set it as the end date
                            rangeEnd = selectedDate;
                        }

                        // Populate inputs with the start and end dates
                        $("#checkin").val($.datepicker.formatDate("mm/dd/yy", rangeStart));
                        $("#checkout").val($.datepicker.formatDate("mm/dd/yy", rangeEnd));
                        $("#dates").val(
                            `${$.datepicker.formatDate("mm/dd/yy", rangeStart)} - ${$.datepicker.formatDate(
                                "mm/dd/yy",
                                rangeEnd
                            )}`
                        );
                        const [startMonth, startDay, startYear] = ($.datepicker.formatDate("mm/dd/yy", rangeStart)).split('/');
                        const startDateFormat = `${startDay}/${startMonth}/${startYear}`;
                        const [endMonth, endDay, endYear] = ($.datepicker.formatDate("mm/dd/yy", rangeEnd)).split('/');
                        const endDateFormat = `${endDay}/${endMonth}/${endYear}`;
                        // Open modal and show selected date range
                        $("#selectedDateDisplay").html(`Selected Date Range: <strong>${startDateFormat} - ${endDateFormat}</strong>`);
                        $('#dateModal').modal('show'); // Show the modal
                        $('.modal-backdrop').remove();
                    }
                }
            },
            beforeShowDay: function (date) {
                var currentDate = $.datepicker.formatDate("yy-mm-dd", date); // Format date as yyyy-mm-dd

                // Check if the current date is in the "booked" or "optioned" arrays
                if (bookedDates.includes(currentDate)) {
                    return [true, "booked"]; // Apply the "booked" class to booked dates
                } else if (optionedDates.includes(currentDate)) {
                    return [true, "optioned"]; // Apply the "optioned" class to optioned dates
                }

                return [true, ""]; // Default class for available dates
            }
        });

        var availableDates = [];
        // Function to fetch availability dates from the backend
        function getAvailabilityDates(month, year) {
            $.ajax({
                url: BASE_URL +"get_availability_dates",
                method: 'GET',
                data: { month: month, year: year },
                success: function (response) {
                    // Parse the response into arrays for booked and optioned dates
                    var data = JSON.parse(response);
                    bookedDates = data.booked || [];
                    optionedDates = data.optioned || [];

                    // Refresh the calendar to apply the new date classes
                    $("#datepicker").datepicker("refresh");
                }
            });
        }
        var currentMonth = new Date().getMonth() + 1; // Get current month (1-based)
        var currentYear = new Date().getFullYear();  // Get current year
        getAvailabilityDates(currentMonth, currentYear);
        // Radio Button Change Event
        $("input[name='date_mode']").on("change", function () {
            mode = $(this).val();
            resetInputs();

            if (mode === "single") {
                $("#single_date").show();
                $("#checkin, #checkout, #dates").hide();
            } else if (mode === "range") {
                $("#single_date").hide();
                $("#checkin, #checkout, #dates").show();
            }
        });

        // Reset Inputs
        function resetInputs() {
            rangeStart = null;
            rangeEnd = null;
            $("#single_date").val("");
            $("#checkin").val("");
            $("#checkout").val("");
            $("#dates").val("");
        }

        // Initialize form to show the correct inputs for the default mode
        if (mode === "single") {
            $("#single_date").show();
            $("#checkin, #checkout, #dates").hide();
        } else {
            $("#single_date").hide();
            $("#checkin, #checkout, #dates").show();
        }

        // Save the selected option when the user clicks "Save" in the modal
        $('#saveOption').on('click', function () {
            var selectedOption = $('#bookingOption').val();
            var selectedDate = $("#single_date").val() || $("#checkin").val(); // Get the selected date for both single and range mode

            // For range mode, ensure both start and end dates are sent
            var dateRange = mode === "range" ? {
                startDate: $.datepicker.formatDate("mm/dd/yy", rangeStart),
                endDate: $.datepicker.formatDate("mm/dd/yy", rangeEnd)
            } : {
                startDate: $.datepicker.formatDate("mm/dd/yy", rangeStart),
                endDate: $.datepicker.formatDate("mm/dd/yy", rangeStart)  // In single date mode, start and end are the same
            };

            // Send the date data and selected option to the server via AJAX
            $.ajax({
                url: BASE_URL +"availability_calendar", // Replace with your controller's save method
                method: 'POST',
                data: {
                    option: selectedOption,
                    startDate: dateRange.startDate,
                    endDate: dateRange.endDate
                },
                dataType: 'json',
                success: function (response) {
                    // console.log(response.status);
                    if (response.status === 'success') {
                        // Show success message in right corner
                        toastr.success(response.message);
                        getAvailabilityDates();
                        $('#dateModal').modal('hide');
                        // Optionally, reset the form or update parts of the page

                    } else {
                        // Show error message
                        toastr.error(response.message);
                    }
                    // $('#dateModal').modal('hide'); // Hide the modal after saving
                    // $('body').removeClass('modal-open'); // Ensure the modal-open class is removed
                    // $('.modal-backdrop').remove(); // Explicitly remove any backdrop
                }
            });
        });
    });


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
        });
    }



    $('#ratesForm').on('submit', function (e) {
        e.preventDefault();

        // Create a FormData object to gather all the input values, including files
        var formData = new FormData(this);

        $.ajax({
            url: BASE_URL +'availability_rates', // Replace with your server-side URL
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
            url: BASE_URL +"get_rates_details", // URL to your controller method
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
            title: "Are you sure you want to delete selected records?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "No",
            confirmButtonText: "Yes",
        },
            function () {
                $.ajax({
                    url: BASE_URL +"delete_rates", // URL to your controller method
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
