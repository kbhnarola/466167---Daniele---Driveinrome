
function previewVideo(event) {
    var video = document.getElementById('videoPreview');
    var videoContainer = document.getElementById('videoContainer');

    // Display the video container
    videoContainer.style.display = 'block';

    // Set the video source
    video.src = URL.createObjectURL(event.target.files[0]);

    // Ensure the video is muted and plays without controls
    video.muted = true;
    video.controls = false;  // Ensures no controls are shown
    video.play();            // Play the video
}


let currentPage = 1;
var experienceDetails = [];
function loadExperiences(page) {
    $.ajax({
        url: BASE_URL + "load_experiences", // PHP endpoint
        type: 'POST',
        data: { page: page },
        dataType: 'json',
        success: function (response) {
            const { experiences, currentPage, totalPages } = response;
            const experienceContainer = $('#experienceContainer');
            experienceContainer.empty(); // Clear current content            

            // Build experience content
            experiences.forEach(experience => {
                // Create an object for each item  
                experienceDetails.push({
                    'id': experience.id,
                    'details': experience.description
                });
                // var expDescription = truncateHTMLText(experience.description, 250); 
                // if there is only text and no p tag then wrap it in p tag   
                var expDescription = experience.description.trim().startsWith('<p') ? experience.description : '<p>' + experience.description +'</p>';
                experienceContainer.append(`
<div class="experience-detail-wrapper">
    <div class="row align-items-center m-0">
        <div class="col-xl-4 col-lg-12 col-md-4 col-12 pe-0">
            <div class="experience-image text-xl-start text-lg-center text-md-start text-center">
                <img src="${experience.image}" alt="experience" class="img-fluid d-block mx-auto m-auto">
            </div>
        </div>
        <div class="col-xl-8 col-lg-12 col-md-8 col-12 ps-2">
            <div class="experience-content-wrapper">
                <h4>
                    <a href="javascript:void(0);" class="experience-link"
                       data-id="${experience.id}"
                       data-title="${experience.title}"
                       data-price="${experience.price}"
                       data-image="${experience.image}"
                       data-pdf="${experience.pdf}">
                       ${experience.title}
                    </a>
                </h4>
                <div class="text-break1">${expDescription}<div>
                <div class="text-right">
                    <a href="${experience.pdf}" download>READ MORE</a>
                </div>
            </div>
        </div>
    </div>
</div>
`);
            });

            // Build pagination
            const paginationContainer = $('#paginationContainer');
            paginationContainer.empty(); // Clear current pagination

            let paginationHTML = `<button id="prevPage" ${currentPage === 1 ? 'disabled' : ''}>←</button>`;
            for (let i = 1; i <= totalPages; i++) {
                paginationHTML += `
    <button class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">
        ${i}
    </button>`;
            }
            paginationHTML += `<button id="nextPage" ${currentPage === totalPages ? 'disabled' : ''}>→</button>`;
            paginationContainer.append(paginationHTML);

            // Scroll to the top of the experience section
            // $('html, body').animate({ scrollTop: $('#experienceSection').offset().top }, 'slow');

            // Bind pagination click events
            $('.page-btn').click(function () {
                const selectedPage = $(this).data('page');
                $('html, body').animate({ scrollTop: $('#experienceSection').offset().top }, 'slow');
                loadExperiences(selectedPage);
            });

            $('#prevPage').click(() => {
                if (currentPage > 1) {
                    $('html, body').animate({ scrollTop: $('#experienceSection').offset().top }, 'slow');
                    loadExperiences(currentPage - 1);
                }
            });

            $('#nextPage').click(() => {
                if (currentPage < totalPages) {
                    $('html, body').animate({ scrollTop: $('#experienceSection').offset().top }, 'slow');
                    loadExperiences(currentPage + 1);
                }
            });

            // Scroll to the top of the experience section
            // $('html, body').animate({ scrollTop: $('#experienceSection').offset().top }, 'slow');

            // Bind modal triggers after new experiences are loaded
            bindModalTriggers();
        }
    });
}

// Function to bind modal triggers to links
function bindModalTriggers() {
    // Select all the modal trigger links
    const modalLinks = document.querySelectorAll('.experience-link');

    modalLinks.forEach(link => {
        link.addEventListener('click', function () {           

            // Get the details, or null if not found  
            var detailsForId2 = item ? item.details : null;
            
            const experienceId = this.getAttribute('data-id');
            const experienceTitle = this.getAttribute('data-title');
            const experiencePrice = this.getAttribute('data-price');
            const experienceImage = this.getAttribute('data-image');
            const experiencePdf = this.getAttribute('data-pdf');

            // Select the modal and update its content
            const modalElement = document.querySelector('#experienceModal');

            // Set the modal content dynamically
            modalElement.querySelector('#experienceTitle').textContent = experienceTitle;
            // Use find to get the object with id 2  
            var item = experienceDetails.find(function (item) {
                return item.id === experienceId;
            });
            // Get the details, or null if not found  
            var experienceDescription = item ? item.details : null;

            $('#experienceModal #experienceDescription').html(experienceDescription);
            // modalElement.querySelector('#experiencePrice').textContent = `€ ${experiencePrice}`;
            modalElement.querySelector('#experienceImage').src = experienceImage;
            modalElement.querySelector('#experiencePdf').href = experiencePdf;

            // Initialize Bootstrap Modal (ensure a new instance isn't created)
            let modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (!modalInstance) {
                modalInstance = new bootstrap.Modal(modalElement, {
                    backdrop: 'static', // Optional: Keep backdrop active
                    keyboard: true       // Optional: Enable closing with Esc key
                });
            }

            // Show the modal
            modalInstance.show();

            // Remove any previous backdrop to ensure a clean state
            const existingBackdrop = document.querySelector('.modal-backdrop');
            if (existingBackdrop) {
                existingBackdrop.remove();
            }

            // Ensure the backdrop is removed when the modal is closed
            modalElement.addEventListener('hidden.bs.modal', function () {
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
            });
        });
    });
}

// Pagination button click events
$('#prevPage').click(() => {
    if (currentPage > 1) {
        currentPage--;
        $('html, body').animate({ scrollTop: $('#experienceSection').offset().top }, 'slow');
        loadExperiences(currentPage);
    }
});

$('#nextPage').click(() => {
    currentPage++;
    $('html, body').animate({ scrollTop: $('#experienceSection').offset().top }, 'slow');
    loadExperiences(currentPage);
});

// Initial load
loadExperiences(currentPage);

$(document).ready(function () {
    // Bind click event to the tabs
    $('#myTab .nav-link').on('click', function (e) {
        // Prevent the default behavior of the tab click
        e.preventDefault();

        // Get the target tab-pane id from the data-bs-target attribute
        var target = $(this).data('bs-target');

        // Scroll to the target tab-pane with a smooth animation
        $('html, body').animate({
            scrollTop: $(target).offset().top - 20 // Adjust -20 to give some padding if needed
        }, 'slow');

        // Optionally, you can trigger the tab to activate here (since we prevented default behavior)
        $(this).tab('show');
    });
});

// Tab Active navigate
document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll(".property-section-spacing");
    const tabs = document.querySelectorAll(".nav-link");

    let isManualClick = false; // Track if the tab was clicked manually

    // Create an Intersection Observer
    const observer = new IntersectionObserver(
        (entries) => {
            if (!isManualClick) { // Only update active state if not manually clicked
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // Get the section's id
                        const sectionId = entry.target.id;
                        // Find the corresponding tab button by matching the sectionId to the tab's data-bs-target
                        const targetTab = document.querySelector(`[data-bs-target="#${sectionId}"]`);

                        // Update active class
                        if (targetTab) {
                            // Remove active class from all tabs
                            tabs.forEach((tab) => tab.classList.remove("active"));
                            targetTab.classList.add("active");
                        }
                    }
                });
            }
        },
        {
            root: null, // Observing within the viewport
            threshold: 0.2, // At least 10% of the section is visible
        }
    );

    // Observe all sections
    sections.forEach((section) => {
        observer.observe(section);
    });

    // Handle manual clicks on tabs
    tabs.forEach((tab) => {
        tab.addEventListener("click", (event) => {
            isManualClick = true; // Set manual click state
            // Remove active class from all tabs
            tabs.forEach((tab) => tab.classList.remove("active"));
            // Add active class to the clicked tab
            event.target.classList.add("active");

            // Scroll to the associated section
            const targetId = tab.getAttribute("data-bs-target").replace("#", "");
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: "smooth", block: "start" });
            }

            // Reset manual click state after a short delay
            setTimeout(() => {
                isManualClick = false;
            }, 500); // Adjust timeout if needed
        });
    });
});



const months = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

// State for the middle (current) calendar
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

// Store initial state
const initialMonth = currentMonth;
const initialYear = currentYear;

// Function to render all three calendars
function renderCalendars() {
    const calendarsRow = document.getElementById("calendars-row");
    calendarsRow.innerHTML = ""; // Clear previous calendars

    for (let offset = -1; offset <= 1; offset++) {
        const month = (currentMonth + offset + 13) % 12; // Handle month overflow
        const year = currentYear + Math.floor((currentMonth + offset + 1) / 12);

        // Create calendar container
        const calendarContainer = document.createElement("div");
        calendarContainer.classList.add("calendar");
        calendarContainer.innerHTML = `
    <div class="calendar-header">
        <span class="month-picker">${months[month]}</span>
        <span class="year-picker">${year}</span>
    </div>
    <div class="calendar-week-day">
        <div>S</div>
        <div>M</div>
        <div>T</div>
        <div>W</div>
        <div>T</div>
        <div>F</div>
        <div>S</div>
    </div>
    <div class="calendar-days"></div>
`;

        calendarsRow.appendChild(calendarContainer);

        // Render days in the calendar
        renderDays(calendarContainer, year, month);
    }
}

// Function to render days for a given year and month
function renderDays(container, year, month) {
    const daysContainer = container.querySelector(".calendar-days");
    daysContainer.innerHTML = ""; // Clear previous days

    const firstDay = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();

    // Add empty slots for previous month's days
    for (let i = 0; i < firstDay; i++) {
        const emptyDay = document.createElement("div");
        emptyDay.classList.add("calendar-day", "empty");
        daysContainer.appendChild(emptyDay);
    }

    // Add days of the current month
    for (let date = 1; date <= totalDays; date++) {
        const dayElement = document.createElement("div");
        dayElement.classList.add("calendar-day");
        dayElement.textContent = date;
        dayElement.dataset.date = `${year}-${String(month + 1).padStart(2, "0")}-${String(date).padStart(2, "0")}`;
        daysContainer.appendChild(dayElement);
    }

    // Fetch availability and highlight dates
    fetchAvailability(year, month, daysContainer);
    
    const calendarDays = document.querySelectorAll(".calendar-day[data-date]");

    calendarDays.forEach((day, index) => {
        const date = new Date(day.dataset.date);
        const dayOfWeek = date.getDay(); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday
        const isFirstDay = index === 0 || day.dataset.date.endsWith("-01");
        const isLastDay =
            index === calendarDays.length - 1 ||
            new Date(day.dataset.date).getDate() === new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
        // Add rounded corners for Monday (start of the week)
        if (dayOfWeek === 0 || isFirstDay) {
            day.classList.add("start-of-week");
        }

        // Add rounded corners for Sunday (end of the week)
        if (dayOfWeek === 6 || isLastDay) {
            day.classList.add("end-of-week");
        }
    });

}

// Fetch and highlight availability dates
function fetchAvailability(year, month, daysContainer) {
    $.ajax({
        url: BASE_URL +"get_availability_dates",
        method: 'GET',
        data: { month: month + 1, year: year },
        success: function (response) {
            let availabilityData = {};
            try {
                availabilityData = JSON.parse(response); // Parse the JSON response
                if (typeof availabilityData !== "object") {
                    availabilityData = {};
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
                return;
            }

            const { booked = [], optioned = [], available = [] } = availabilityData;

            // Highlight dates
            Array.from(daysContainer.children).forEach(day => {
                const date = day.dataset.date;
                if (date) {
                    day.classList.remove("booked", "optioned", "available");
                    if (booked.includes(date)) {
                        day.classList.add("booked");
                    } else if (optioned.includes(date)) {
                        day.classList.add("optioned");
                    } else if (available.includes(date)) {
                        day.classList.add("available");
                    }
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("Error fetching availability data:", error);
        }
    });
}

// Event listeners for navigation
document.querySelector(".prev-month").addEventListener("click", () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    renderCalendars();
});

document.querySelector(".next-month").addEventListener("click", () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    renderCalendars();
});

// Event listener for Reset button
document.querySelector(".reset-calendar").addEventListener("click", () => {
    // Reset to initial state
    currentMonth = initialMonth;
    currentYear = initialYear;
    renderCalendars();
});
// Initialize calendars on page load
document.addEventListener("DOMContentLoaded", () => {
    renderCalendars();
});

jQuery.validator.addMethod("cstmEmail",
    function (value, element) {
        return /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|email|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i.test(value);
    }, "Please enter a valid email address"
);

function ajxLoader(showstatus, elem) {
    jQuery.LoadingOverlaySetup({
        background: "rgba(0, 0, 0, 0.5)",
        imageColor: "#FFF",
        imageAutoResize: false,
        size: 50,
        maxSize: 50,
        minSize: 20
    });
    if (elem === undefined)
        jQuery.LoadingOverlay(showstatus);
    else
        jQuery(elem).LoadingOverlay(showstatus);
}

function toastrAlert(message = 'Message', alertType) {
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "preventDuplicates": true,
        "showEasing": "linear",
        "hideEasing": "swing",
        "showMethod": "slideDown",
        "hideMethod": "slideUp"
    }
    if (alertType == 'success') {
        alertType = 'Success!';
        toastr.success(message, alertType, {
            "closeButton": true,
        });
    } else if (alertType == 'error') {
        alertType = 'Error!';
        toastr.error(message, alertType, {
            "closeButton": true,
        });
    } else {
        alertType = 'Warning!';
        toastr.warning(message, alertType, {
            "closeButton": true,
        });
    }
}

// START Validation for inquire about villa on umbriavilla page
jQuery("#inquireVillaForm").validate({
    errorClass: 'validation-error',
    rules: {
        inquireemail: {
            email: true,
            required: true,
            cstmEmail: true,
        },
        acceptPolicy: {
            required: true,
        },
    },
    messages: {
        inquireemail: {
            required: 'Please enter email',
            email: 'Please enter valid email'
        },
        acceptPolicy: {
            required: 'Please accept our privacy policy',
        }
    },
    errorPlacement: function (error, element) {
        if (element.attr("name") == "inquireemail")
            error.insertAfter(".inquireemail-fieldset");
        else if (element.attr("name") == "acceptPolicy")
            error.insertAfter(".inquire-accept-plocy-txt");
        else
            error.insertAfter(element);
    },
    submitHandler: function (form) {
        ajxLoader('show', 'body');
        var form_data = $("#inquireVillaForm").serialize();
        // ajax call
        $.ajax({
            url: BASE_URL + "inquire-villa",
            dataType: 'JSON',
            type: 'POST',
            data: form_data,
            success: function (data) {
                // $('#newsletterSubscribe').find("input[type=email]").val("");
                if (data.status) {
                    $('#inquireVillaForm')[0].reset(); 
                    $('#thankyoumodal .modal-body p').text(data.msg);
                    $('#thankyoumodal').modal('show');
                } else {
                    $('#errormodal .modal-body p').text(data.msg);
                    $('#errormodal').modal('show');
                }
                ajxLoader('hide', 'body');
            },
        });
    }
});
// END Validation for inquire about villa on umbriavilla page

// prevent user from copy paste the content in input field
jQuery(':input').on("cut copy paste", function (e) {
    e.preventDefault();
});
function htmlspecialchars(str) {
    return str.replace(/[&<>"']/g, function (match) {
        switch (match) {
            case '&': return '&amp;';
            case '<': return '&lt;';
            case '>': return '&gt;';
            case '"': return '&quot;';
            case "'": return '&#039;';
        }
    });
}

function truncateContent(content, maxLength) {
    // Create a temporary div to hold the HTML content and process it
    var tempDiv = $('<div>').html(content);

    // Extract only the text content (no HTML tags) for counting
    var textContent = tempDiv.text();

    // Check if the length of the text content exceeds the max length
    if (textContent.length <= maxLength) {
        return content;  // Return the original HTML if it's within the limit
    }

    // Truncate the text content to the max length
    var truncatedText = textContent.substring(0, maxLength);

    // Create a new temporary div to work with truncated content
    var truncatedDiv = $('<div>').html(content);

    // Traverse through the elements and remove characters until the max length is reached
    var currentLength = 0;
    truncatedDiv.contents().each(function () {
        // If this is a text node, calculate its length and truncate if necessary
        if (this.nodeType === 3) {  // Text node
            var text = this.nodeValue;
            var textLength = text.length;

            if (currentLength + textLength <= maxLength) {
                currentLength += textLength;
            } else {
                // Truncate the text node to fit within the max length
                var truncatedTextNode = document.createTextNode(text.substring(0, maxLength - currentLength));
                $(this).replaceWith(truncatedTextNode);
                currentLength = maxLength;
            }
        }
        // If it's an element like <a>, <span>, <p>, etc., it remains intact in the truncated output
    });

    // Check for links within the content
    var links = truncatedDiv.find('a');
    if (links.length > 0) {
        links.each(function () {
            var link = $(this).attr('href');
            if (truncatedText.indexOf(link) === -1) {
                truncatedText += '... ' + link;  // Append full link at the end
            }
        });
    }

    // Append ellipsis if content is truncated
    truncatedDiv.append('...');
    return truncatedDiv.html();  // Return the truncated HTML content
}

function truncateText(text, maxLength) {
    // Remove HTML tags and get only visible text  
    const plainText = text.replace(/<[^>]+>/g, ''); // Remove HTML tags  
    return plainText.length > maxLength ? plainText.substring(0, maxLength) + '...' : plainText;
} 

// Function to truncate text while preserving HTML  
function truncateHTMLText(html, maxLength) {
    let tempElement = document.createElement('div'); // Create a temp div to manipulate the HTML  
    tempElement.innerHTML = html; // Set the inner HTML to our string  

    let totalLength = 0; // Current visible text length  
    let truncatedHTML = ''; // To store the truncated HTML  

    // Function to recursively process nodes  
    function processNode(node) {
        if (totalLength >= maxLength) return; // Stop if we've reached the limit  
        if (node.nodeType === Node.TEXT_NODE) {
            const textLength = node.textContent.length;
            if (totalLength + textLength > maxLength) {
                // Calculate how much we can take from this text node  
                const remaining = maxLength - totalLength;
                truncatedHTML += node.textContent.substring(0, remaining); // Add remaining text  
                totalLength += remaining; // Update total length  
            } else {
                truncatedHTML += node.textContent; // Add full text  
                totalLength += textLength; // Update total length  
            }
        } else if (node.nodeType === Node.ELEMENT_NODE) {
            truncatedHTML += `<${node.nodeName.toLowerCase()}>`; // Open the tag  
            Array.from(node.childNodes).forEach(processNode); // Recur for child nodes  
            truncatedHTML += `</${node.nodeName.toLowerCase()}>`; // Close the tag  
        }
    }

    Array.from(tempElement.childNodes).forEach(processNode); // Start processing from the root  

    // Return the truncated HTML or original if not truncated  
    return totalLength < maxLength ? html : truncatedHTML + '...';
} 
