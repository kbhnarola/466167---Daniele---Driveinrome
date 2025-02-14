jQuery.validator.addMethod(
    "noSpace",
    function (value, element) {
      if ($.trim(value).length > 0) {
        return true;
      } else {
        return false;
      }
    },
    "No space please and don't leave it empty"
  );
  
  jQuery.validator.addMethod(
    "no_HTML",
    function (value, element) {
      // return true - means the field passed validation
  
      // return false - means the field failed validation and it triggers the error
  
      return (
        this.optional(element) || /^([a-zA-Z0-9 _&?=(){},.|*+-]+)$/.test(value)
      );
    },
    "Special Characters not allowed!"
  );
  
  jQuery.validator.addMethod(
    "customEmail",
    function (value, element, param) {
      return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
    },
    "Enter Correct E-mail Address"
  );
  jQuery.validator.addMethod(
    "customPhoneNumber",
    function (value, element, param) {
      return value.match(/^([\+()0-9--/]+)$/);
    },
    "Enter Correct Phone Number"
  );
  jQuery("#requestQuoteForm").validate({
    errorElement: "span",
  
    rules: {
      user_name: {
        required: true,
  
        noSpace: true,
  
        no_HTML: true,
  
        maxlength: 100,
      },
  
      user_email: {
        required: true,
  
        noSpace: true,
  
        customEmail: true,
  
        maxlength: 150,
      },
  
      user_confirm_email: {
        required: true,
  
        noSpace: true,
  
        customEmail: true,
  
        equalTo: "#user_email",
      },
  
      phoneNumber: {
        required: true,
  
        customPhoneNumber: true,
  
        maxlength: 15,
      },
  
      contactHowDidFind: {
        required: true,
  
        noSpace: true,
      },
      accept_privacy_policy: {
        required: true,
      },
    },
  
    errorPlacement: function (error, element) {
      //console.log('dd', element.attr("name"))
  
      if (element.parent().hasClass("input-group")) {
        // error.appendTo(element.parent("div").next("div"));
  
        error.insertAfter(element.parent());
      } else if (element.hasClass("fieldset")) {
        // error.appendTo(element.parent("div").next("div"));
  
        error.insertAfter(element.parent());
      } else if (element.hasClass("accept_privacy_policy")) {
        error.appendTo("#accept_privacy_policy_errr");
      } else if (element.hasClass("contact-found-us")) {
        error.insertAfter(element.parent());
      } else {
        error.insertAfter(element);
      }
    },
  
    messages: {
      user_name: {
        required: "Please Enter Your Full Name",
      },
  
      user_email: {
        required: "Please Enter Email",
      },
  
      user_confirm_email: {
        required: "Please Enter Confirm Email",
  
        equalTo: "Email and Confirm Email not match",
      },
  
      phoneNumber: {
        required: "Please Enter Phone Number",
      },
  
      contactHowDidFind: {
        required: "Please Enter How Did you find us",
      },
  
      accept_privacy_policy: {
        required: "Please Accept Privacy and Policy",
      },
    },
  
    submitHandler: function (form) {
      let grecaptcha_error = $('#requestQuoteForm').find('.g-recaptcha');
          if ($('#rqquote_hiddenRecaptcha').val() == '') {
              grecaptcha_error.append('<label class="validation-error">The reCAPTCHA field is required.</label>');
              return false;
          }
      jQuery.ajax({
        url: BASE_URL + "submit_quote_request",
  
        method: "POST",
  
        data: jQuery("#requestQuoteForm").serialize(),
  
        dataType: "JSON",
  
        beforeSend: function () {
          ajxLoader("show", "body");
        },
  
        success: function (response) {
          ajxLoader("hide", "body");
  
          if (response.success) {
            jQuery("#thankyoumodal").modal("show");
  
            jQuery("#requestQuoteForm")[0].reset();
          } else {
            jQuery("#err_msg").html(response.msg);
  
            jQuery("#errormodal").modal("show");
          }
        },
      });
    },
  });
  
  jQuery(document).on("click", "#thankyou_modal_close", function () {
    window.location.href = "" + BASE_URL;
  });
  
  jQuery(document).ready(function () {
    $("#user_email, #user_confirm_email").bind("cut copy paste", function (e) {
      e.preventDefault();
    });
  });
  