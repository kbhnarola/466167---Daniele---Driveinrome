jQuery(document).ready(function () {
    if (jQuery("#url_segment_1").val()) {
        jQuery('.topselling-section .row, .transfer-section .container').paginathing(
            {
                perPage: 6,
                limitPagination: false,
                prevText: '<i class="fal fa-long-arrow-left"></i>',
                nextText: '<i class="fal fa-long-arrow-right"></i>',
                firstText: '',
                lastText: '',
                containerClass: 'pagination-div',
                ulClass: 'custom-pagination',
                liClass: 'page',
                activeClass: 'active',
                disabledClass: 'disabled',
                pageNumbers: false
            }
        );
    }
    jQuery(document).on('click', 'li.page a, li.prev a, li.next a', function () {
        if (jQuery('.topselling-section').length) {
            jQuery('html, body').animate({
                scrollTop: jQuery(".topselling-section").offset().top
            }, 500);
        }
        if (jQuery('.transfer-section').length) {
            jQuery('html, body').animate({
                scrollTop: jQuery(".transfer-section").offset().top
            }, 500);
        }
    });
    // hide pagination if there is not more than tour/transfer as per the per page
    if (jQuery('.prev').hasClass('disabled') && jQuery('.next').hasClass('disabled')) {
        jQuery('.custom-pagination').hide();
    }
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
    // // This is needed if the user scrolls down during page load and you want to make sure the page is scrolled to the top once it's fully loaded. This has Cross-browser support.
    window.scrollTo(0, 0);

    jQuery('#howDidFind, #timezone, #contactHowDidFind').select2({ minimumResultsForSearch: -1 });

    //jQuery('#howDidFind, #timezone').select2({minimumResultsForSearch: -1});

    // no html validation
    jQuery.validator.addMethod("noHTML", function (value, element) {
        // return true - means the field passed validation
        // return false - means the field failed validation and it triggers the error
        return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value);
    }, "Please enter valid input");
    jQuery.validator.addMethod("onlyNumber", function (value, element) {
        return this.optional(element) || /^([0-9--/]+)$/.test(value);
    }, "Only Numbers and Hypfens '-' are allowed.");
    jQuery.validator.addMethod("special_chars", function (value, element) {
        // return true - means the field passed validation
        // return false - means the field failed validation and it triggers the error

        return this.optional(element) || /^[a-zA-Z0-9wÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ'."’,!@#$%^&?(//)-:/\s]+$/.test(value);
    }, "Special Characters not allowed!");
    jQuery.validator.addMethod("cstmEmail",
        function (value, element) {
            return /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|email|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i.test(value);
        }, "Please enter a valid email address"
    );
    jQuery.validator.addMethod("noSpace", function (value, element) {
        if ($.trim(value).length > 0) {
            return true;
        } else {
            return false;
        }
    }, "No space please and don't leave it empty");
    // START validation for Contact us form
    jQuery("#contactUs").validate({
        errorClass: 'validation-error',
        rules: {
            fullname: {
                required: true,
                noSpace: true,
                noHTML: true,
                maxlength: 200,
            },
            email: {
                email: true,
                required: true,
                cstmEmail: true,
            },
            confEmail: {
                required: true,
                email: true,
                equalTo: "#email"
            },
            phoneNumber: {
                required: true,
                noSpace: true,
                //number: true,
                onlyNumber: true,
                maxlength: 15,
            },
            noOfPassenger: {
                required: true,
                noSpace: true,
                // number: true,
                maxlength: 20,
            },
            contactHowDidFind: {
                required: true
            },
            interest_service:{
                maxlength: 100,
            },
            message: {
                required: true,
                noSpace: true,
                special_chars: true,
                maxlength: 500
            },
            acceptPolicy: {
                required: true,
            },
        },
        messages: {
            fullname: {
                required: 'Please enter full name',
                maxlength: 'Please enter no more than 200 characters',
            },
            email: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            },
            confEmail: {
                required: 'Please enter confirm email',
                email: 'Please enter valid email',
                equalTo: 'Confirm email is not match with the actual email'
            },
            phoneNumber: {
                required: 'Please enter phone number',
                maxlength: 'Please enter no more than 15 digits',
            },
            contactHowDidFind: {
                required: 'Please select found us',
            },
            noOfPassenger: {
                required: 'Please enter number of passengers',
                maxlength: 'Please enter no more than 2 digits',
            },
            interest_service:{
                maxlength: 'Please enter no more than 100 digits',
            },
            message: {
                required: 'Please enter message',
                maxlength: 'Please enter no more than 500 characters',
            },
            acceptPolicy: {
                required: 'Please accept our privacy policy',
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "fullname")
                error.insertAfter(".fullname-fieldset");
            else if (element.attr("name") == "email")
                error.insertAfter(".email-fieldset");
            else if (element.attr("name") == "confEmail")
                error.insertAfter(".confEmail-fieldset");
            else if (element.attr("name") == "phoneNumber")
                error.insertAfter(".phoneNumber-fieldset");
            else if (element.attr("name") == "noOfPassenger")
                error.insertAfter(".noOfPassenger-fieldset");
            else if (element.attr("name") == "contactHowDidFind")
                error.insertAfter(".contact-find-us-fieldset");
            else if (element.attr("name") == "message")
                error.insertAfter(".message-fieldset");
            else if (element.attr("name") == "acceptPolicy")
                error.insertAfter(".accept-plocy-txt");
            else
                error.insertAfter(element);
        },
        submitHandler: function (form) {
            let grecaptcha_error = $('#contactUs').find('.g-recaptcha');
            if ($('#contact_hiddenRecaptcha').val() == '') {
                grecaptcha_error.append('<label class="validation-error">The reCAPTCHA field is required.</label>');
                return false;
            }

            ajxLoader('show', 'body');
            var form_data = {
                'fullname': $('#fullname').val(),
                'email': $('#email').val(),
                'phoneNumber': $('#phoneNumber').val(),
                'noOfPassenger': $('#noOfPassenger').val(),
                'how_did_you_find_us': $('#contactHowDidFind').val(),
                'message': $('#message').val(),
                'interest_service' : $('#interest_service').val(),
                'c_dates' : $('#c_dates').val(),
                'name_of_ship' : $('#name_of_ship').val(),
                'for_form_data': 'contact_us',
                'origin': $(location).attr('href'),
                // 'captcha': $('#g-recaptcha-response').val()
                'captcha': $('#contact_hiddenRecaptcha').val()
            };
            // ajax call
            $.ajax({
                url: BASE_URL + "welcome/send_contact_us_details",
                type: 'POST',
                data: form_data,
                success: function (data) {
                    $('#thankyoumodal .modal-body p').text('Thank you for your request. You will receive an email from our agent shortly.');
                    $('#contactUs').find("input[type=text], input[type=email], input[type=number], textarea").val("");
                    $('#acceptPolicy').prop('checked', false); // Unchecks it
                    jQuery('#contactHowDidFind').val(null).trigger('change');
                    if (data == 1) {
                        $('#thankyoumodal').modal('show');
                    } else {
                        $('#errormodal').modal('show');
                    }
                    ajxLoader('hide', 'body');
                },
            });
        }

    });
    // END validation for Contact us form

    // START validation for Quick quote form
    jQuery("#quickQuoteFrm").validate({
        errorClass: 'validation-error',
        rules: {
            qfullname: {
                required: true,
                noSpace: true,
                noHTML: true,
                maxlength: 40
            },
            qemail: {
                email: true,
                required: true,
                cstmEmail: true,
            },
            qconfEmail: {
                required: true,
                email: true,
                equalTo: "#qemail"
            },
            qphoneNumber: {
                required: true,
                noSpace: true,
                //number: true,
                onlyNumber: true,
                maxlength: 15
            },
            howDidFind: {
                required: true
            },
            notes: {
                required: true,
                noSpace: true,
                special_chars: true,
                maxlength: 200
            },
            quickQuoteAcceptPolicy: {
                required: true,
            },
        },
        messages: {
            qfullname: {
                required: 'Please enter full name',
                maxlength: 'Please enter no more than 40 characters',
            },
            qemail: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            },
            qconfEmail: {
                required: 'Please enter confirm email',
                email: 'Please enter valid email',
                equalTo: 'Confirm email is not match with the actual email'
            },
            qphoneNumber: {
                required: 'Please enter phone number',
                maxlength: 'Please enter no more than 15 digits',
            },
            howDidFind: {
                required: 'Please select found us',
            },
            notes: {
                required: 'Please enter notes',
                maxlength: 'Please enter no more than 200 characters',
            },
            quickQuoteAcceptPolicy: {
                required: 'Please accept our privacy policy',
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "qfullname")
                error.insertAfter(".qfullname-fieldset");
            else if (element.attr("name") == "qemail")
                error.insertAfter(".qemail-fieldset");
            else if (element.attr("name") == "qconfEmail")
                error.insertAfter(".qconfEmail-fieldset");
            else if (element.attr("name") == "qphoneNumber")
                error.insertAfter(".qphoneNumber-fieldset");
            else if (element.attr("name") == "howDidFind")
                error.insertAfter(".howDidFind-fieldset");
            else if (element.attr("name") == "notes")
                error.insertAfter(".notes-fieldset");
            else if (element.attr("name") == "quickQuoteAcceptPolicy")
                error.insertAfter(".quick-quote-accept-policy-txt");
            else
                error.insertAfter(element);
        },
        submitHandler: function (form) {
            let grecaptcha_error = $('#quickQuoteFrm').find('.g-recaptcha');
            if ($('#quote_hiddenRecaptcha').val() == '') {
                grecaptcha_error.append('<label class="validation-error">The reCAPTCHA field is required.</label>');
                return false;
            }
            ajxLoader('show', 'body');
            var qfullname = $('#qfullname').val();
            var qemail = $('#qemail').val();
            var qphoneNumber = $('#qphoneNumber').val();
            var howDidFind = $('#howDidFind').val();
            var notes = $('#notes').val();
            var number_of_passengers = $('#qnumber_of_passengers').val();
            var interest_service = $('#qinterest_service').val();
            var qdate = $('#qdate').val();
            var name_of_ship = $('#qname_of_ship').val();

            var captcha = $('#quote_hiddenRecaptcha').val();
            var form_data = {
                'qfullname': qfullname,
                'qemail': qemail,
                'qphoneNumber': qphoneNumber,
                'howDidFind': howDidFind,
                'notes': notes,
                'captcha': captcha,
                'number_of_passengers': number_of_passengers,
                'interest_service': interest_service,
                'qdate': qdate,
                'name_of_ship': name_of_ship
            };
            // ajax call
            $.ajax({
                url: BASE_URL + "welcome/send_quick_quote_details",
                type: 'POST',
                data: form_data,
                success: function (data) {
                    $('#thankyoumodal .modal-body p').text('Thank you for your request. You will receive an email from our agent shortly.');
                    $('#quickQuoteFrm').find("input[type=text], input[type=email], input[type=number], textarea").val("");
                    jQuery('#howDidFind').val(null).trigger('change');
                    $('#quickquote').modal('hide');
                    if (data == 1) {
                        $('#thankyoumodal').modal('show');
                    } else {
                        $('#errormodal').modal('show');
                    }
                    ajxLoader('hide', 'body');
                },
            });
        }
    });
    // END validation for Quick quote form
    $("#getacall").on("hidden.bs.modal", function () {
        var validator = $("#getacallFrm").validate();
        validator.resetForm();
    });
    // START validation for Get a call form
    jQuery("#getacallFrm").validate({
        errorClass: 'validation-error',
        rules: {
            callfullname: {
                required: true,
                noSpace: true,
                noHTML: true,
                maxlength: 40
            },
            callemail: {
                email: true,
                required: true,
                cstmEmail: true,
            },
            callconfEmail: {
                required: true,
                email: true,
                equalTo: "#callemail"
            },
            callcity: {
                required: true,
                noSpace: true,
                maxlength: 20
            },
            callcountry: {
                required: true,
                noSpace: true,
                maxlength: 30
            },
            callphoneNumber: {
                required: true,
                noSpace: true,
                //number: true,
                onlyNumber: true,
                maxlength: 15
            },
            besttimecall: {
                required: true,
                noSpace: true,
                // noHTML: true,
                maxlength: 100
            },
        },
        messages: {
            callfullname: {
                required: 'Please enter full name',
                maxlength: 'Please enter no more than 40 characters',
            },
            callemail: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            },
            callconfEmail: {
                required: 'Please enter confirm email',
                email: 'Please enter valid email',
                equalTo: 'Confirm email is not match with the actual email'
            },
            callcity: {
                required: 'Please enter city name',
            },
            callcountry: {
                required: 'Please enter country name',
            },
            callphoneNumber: {
                required: 'Please enter phone number',
                maxlength: 'Please enter no more than 15 digits',
            },
            besttimecall: {
                required: 'Please enter best time to call',
                maxlength: 'Please enter no more than 100 characters',
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "callfullname")
                error.insertAfter(".callfullname-fieldset");
            else if (element.attr("name") == "callemail")
                error.insertAfter(".callemail-fieldset");
            else if (element.attr("name") == "callconfEmail")
                error.insertAfter(".callconfEmail-fieldset");
            else if (element.attr("name") == "callcity")
                error.insertAfter(".callcity-fieldset");
            else if (element.attr("name") == "callcountry")
                error.insertAfter(".callcountry-fieldset");
            else if (element.attr("name") == "callphoneNumber")
                error.insertAfter(".callphoneNumber-fieldset");
            else if (element.attr("name") == "besttimecall")
                error.insertAfter(".besttimecall-fieldset");
            else
                error.insertAfter(element);
        },
        submitHandler: function (form) {
            let grecaptcha_error = $('#getacallFrm').find('.g-recaptcha');
            if ($('#call_hiddenRecaptcha').val() == '') {
                grecaptcha_error.append('<label class="validation-error">The reCAPTCHA field is required.</label>');
                return false;
            }
            ajxLoader('show', 'body');
            var form_data = {
                'callfullname': $('#callfullname').val(),
                'callemail': $('#callemail').val(),
                'callcity': $('#callcity').val(),
                'callcountry': $('#callcountry').val(),
                'callphoneNumber': $('#callphoneNumber').val(),
                'besttimecall': $('#besttimecall').val(),
                'captcha': $('#call_hiddenRecaptcha').val()
            };
            // ajax call
            $.ajax({
                url: BASE_URL + "welcome/send_email_to_admin_for_get_a_call_details",
                type: 'POST',
                data: form_data,
                success: function (data) {
                    $('#thankyoumodal .modal-body p').text(jQuery('#getacallFrm .succ_msg').val());
                    $('#getacallFrm').find("input[type=text], input[type=email], input[type=number], textarea").val("");

                    $('#getacall').modal('hide');
                    if (data == 1) {
                        $('#thankyoumodal').modal('show');
                    } else {
                        $('#errormodal').modal('show');
                    }
                    ajxLoader('hide', 'body');
                },
            });
        }
    });
    // END validation for Get a call form
    jQuery("#newsletterSubscribe").validate({
        errorClass: 'validation-error',
        rules: {
            subscribeemail: {
                email: true,
                required: true,
                cstmEmail: true,
            }            
        },
        messages: {
            subscribeemail: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            }            
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "subscribeemail")
                error.insertAfter(".subscribe-btn");
            else
                error.insertAfter(element);
        },
        submitHandler: function (form) {

            ajxLoader('show', 'body');
            var form_data = $("#newsletterSubscribe").serialize();
            // var form_data = {
            //     'subscribeemail': $('#subscribeemail').val()
            // };
            // ajax call
            $.ajax({
                url: BASE_URL + "welcome/send_email_to_admin_for_subscribe_newsletter",
                dataType: 'JSON',
                type: 'POST',
                data: form_data,
                success: function (data) {
                    $('#thankyoumodal .modal-body p').text(data.msg);
                    $('#errormodal .modal-body p').text(data.msg);
                    $('#newsletterSubscribe').find("input[type=email]").val("");
                    if (data.status == true && data.already_subscribed == false) {
                        $('#thankyoumodal').modal('show');
                    } else {
                        $('#errormodal').modal('show');
                    }
                    ajxLoader('hide', 'body');
                },
            });
        }
    });

    $("#quickquote").on("hidden.bs.modal", function () {
        //$('#quickquote label.validation-error').hide();
        var validator = $("#quickQuoteFrm").validate();
        validator.resetForm();
    });
    jQuery.validator.setDefaults({
        focusCleanup: true,
        errorClass: "validation-error-label",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).next("span").addClass("csc-helper-text");
        }
    });

    jQuery(".contact-link").click(function (e) {
        e.preventDefault();
        jQuery('html, body').animate({
            scrollTop: jQuery(".contact-section").offset().top
        }, 1000);
    });
    jQuery(".popup-notification-close").click(function (e) {
        jQuery('.custom-notification-popup').hide();
    });
    jQuery(".contact-top-link").click(function (e) {
        e.preventDefault();
        jQuery('html, body').animate({
            scrollTop: jQuery(".contact-section").offset().top
        }, 2000);
    });
    // notify if coockie is disabled
    if (!navigator.cookieEnabled) {
        var cookieText = 'Cookie is disabled in your browser please enable cookie for better user experience and functioning of site.';
        var cookieMsg = '<div class="top-notify-danger"><div class="container"><p>' + cookieText + ' </p></div></div>';
        jQuery('body').prepend(cookieMsg);
    }
    // add targte="_blank" attribute in cookie open pricay link
    setTimeout(function () {
        jQuery('#gdpr-cookie-message a').attr('target', '_blank');
    }, 1000);
    //remove cookie advance button from coookie popup
    setTimeout(function () {
        jQuery('#gdpr-cookie-advanced').remove();
    }, 1000);
    jQuery(".collapse").on('show.bs.collapse', function () {
        jQuery(this).prev(".card-header").find(".up-down-arrow .fas").removeClass("fa-chevron-down").addClass("fa-chevron-up");
    }).on('hide.bs.collapse', function () {
        jQuery(this).prev(".card-header").find(".up-down-arrow .fas").removeClass("fa-chevron-up").addClass("fa-chevron-down");
    });
    if (jQuery("#error").val()) {
        var error = jQuery("#error").val();
        toastrAlert(error, 'error');
    }
    if (jQuery("#success").val()) {
        var success = jQuery("#success").val();
        toastrAlert(success, 'success');
    }
    if (jQuery("#warning_alert").val()) {
        var warning_msg = jQuery("#warning_alert").val();
        toastrAlert(warning_msg, 'warning');
    }
    // hide bootstrap popover on click outside
    jQuery('body').on('click', function (e) {
        jQuery('[data-toggle=popover]').each(function () {
            // hide any open popovers when the anywhere else in the body is clicked
            if (!jQuery(this).is(e.target) && $(this).has(e.target).length === 0 && jQuery('.popover').has(e.target).length === 0) {
                jQuery(this).popover('hide');
            }
        });
    });
    // disable copy, paste and cut from all the forms
    jQuery(':input').on("cut copy paste", function (e) {
        e.preventDefault();
    });
    jQuery("#yt_link").click(function (e) {
        jQuery(".video-gallery-popup").trigger("click");
    });
    // START tour search from top menu
    // focus in search input box
    $('.search-btn-wrapper .fa-search').on('click', function () {
        setTimeout(function () {
            $('#searchTour').focus();
        }, 10);
    });
    $('.search-btn-wrapper .fa-times').on('click', function () {
        $('#searchTour').val('');
        $('.search-list-wrapper').remove();
    });

    $('#searchTour').keyup(function () {
        var tour_name = $(this).val();
        if (tour_name.length == 0) {
            $('.search-list-wrapper').remove();
        }
        if (tour_name.length > 2) {
            $.ajax({
                url: BASE_URL + 'web/search/search_tour',
                method: "POST",
                data: { tour_name: $(this).val() },
                success: function (data) {
                    $('.load-search-result').html(data);
                }
            });
        } else if (tour_name.length > 0) {
            $('.load-search-result').html('<div class="search-list-wrapper"><ul><li class="not-tour-found">Please enter 3 characters!</li></ul></div>');
        }
    });
    $('.search-tour').tooltip({
        trigger: 'hover'
    });
    // END tour search from top menu
});
function preventFormSubmit(e) {
    e.preventDefault();
    return false;
}
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
setTimeout(function () {
    jQuery('.css-mak9h4').css("margin-top", "100px !important");
}, 4000);
var ajxurl = BASE_URL + 'welcome/get_cart_count';
var ajxasync = true;
function get_notification() {
    $.ajax({
        url: ajxurl,
        dataType: 'JSON',
        method: 'POST',
        async: ajxasync,
        data: {
            'ajax': true
        },
        success: function (data) {
            if (data.status) {
                jQuery('.cart-notification .count').text(data.count);
            }
            ajxasync = false;
            setTimeout(function () {
                get_notification();
            }, 10000);
        }
    });
}
document.addEventListener('readystatechange', event => {
    // if (event.target.readyState === 'interactive') {
    //     let loading_screen = document.getElementById('loading_screen');
    //     if (loading_screen) {
    //         loading_screen.style.display = 'flex';
    //     }
    // }

    if (document.readyState === 'ready' || document.readyState === 'complete') {
        // let loading_screen = document.getElementById('loading_screen');
        //loading_screen.style.display = 'none';
        get_notification();
    } else {
        document.onreadystatechange = function () {
            if (document.readyState == "complete") {
                // let loading_screen = document.getElementById('loading_screen');
                // loading_screen.style.display = 'none';
                get_notification();
            }
        }
    }
});

var owl = $('#screenshot_slider').owlCarousel({
    loop: true,
    item: 3,
    responsiveClass: true,
    nav: true,
    margin: 0,
    dots: false,
    autoplayTimeout: 4000,
    smartSpeed: 400,
    center: true,
    slideBy: 3,
    navText: ['<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>'],
    responsive: {
        1024: {
            items: 3
        },
        600: {
            items: 2,
            nav: true,
            center: false
        },
        0: {
            items: 1,
            nav: true,
            center: false
        }
    }
});
/****************************/
jQuery(document.documentElement).keydown(function (event) {
    // var owl = jQuery("#carousel");
    // handle cursor keys
    if (event.keyCode == 37) {
        // go left
        owl.trigger('prev.owl.carousel', [400]);
        //owl.trigger('owl.prev');
    } else if (event.keyCode == 39) {
        // go right
        owl.trigger('next.owl.carousel', [400]);
        //owl.trigger('owl.next');
    }
});
// <!-- Smartsupp Live Chat script -->
var _smartsupp = _smartsupp || {};
_smartsupp.key = '5928f4c195426b84a39ac761cdd43d9ac53d9cf8';
window.smartsupp || (function (d) {
    var s, c, o = smartsupp = function () { o._.push(arguments) }; o._ = [];
    s = d.getElementsByTagName('script')[0]; c = d.createElement('script');
    c.type = 'text/javascript'; c.charset = 'utf-8'; c.async = true;
    c.src = 'https://www.smartsuppchat.com/loader.js?'; s.parentNode.insertBefore(c, s);
})(document);
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
jQuery('#email, #confEmail, #qemail, #qconfEmail, #subscribeemail, #checkoutemail, #checkoutconfirmemail').on("cut copy paste", function (e) {
    e.preventDefault();
});
// $(window).on('beforeunload', function() {

//   $(window).scrollTop(0);
// });


$(document).on('click', '.video-btn', function (event) {
    event.preventDefault();
    var src = $(this).attr('data-src');
    $('.video_tour_modal_lg iframe').attr('src', src);
    $('.video_tour_modal_lg').modal('show');  
});
$(document).on('click', '.video_tour_modal_lg .close', function (event) {
    $('.video_tour_modal_lg iframe').attr('src','');
});

$(document).on('click', '.small_video_div button', function (event) {
    event.preventDefault();
    var src = $(this).parent().siblings('iframe').attr('src');
    $('#video_modal_lg iframe').attr('src', src);
});

// Open villa banner popup after some time interval
setTimeout(function () {
    $('#villa_popup_banner').modal('show');
}, 5000);

// Apply z-index on header menu based on modal hide and show
$(".modal").on('hide.bs.modal', function () {
    $('header').css('z-index', 1041);
});
$(".modal").on('show.bs.modal', function () {
    $('header').css('z-index', 1040);
});

// START store the value in cookie for villa popup banner
function storeVillBannerCookie(){    
    Cookies.set('viewd-vill-banner-popup', 'yes', { expires: 30 }); // Expires in 30 days
}

$("#villa_popup_banner").on('hide.bs.modal', function () {
    storeVillBannerCookie();
});

$(".visit-villa-btn a").on("click", function () {
    $('#villa_popup_banner').modal('hide');
    setTimeout(() => {        
        window.open(villaURL, '_blank');    
    }, 100);
});
// END store the value in cookie for villa popup banner
