<?php

$transferData = $this->session->userdata('quote_data_for_transfer');

// print_r($transferData);

// exit;

?>

<section class="page-title-section">

  <div class="image-wrap">

    <img src="images/rome-tours1.jpg" onerror="this.src='<?php echo base_url("assets/images/banner/product-details.jpg"); ?>'">

    <!-- <h2><?php // echo $transferData['breadcrumb_title'];
              ?></h2> -->

  </div>

  <div class="breadcrumb">

    <div class="container">

      <p><a href="<?= BASE_URL ?>">Home</a>&nbsp&nbsp/&nbsp&nbsp

        <a href="javascript:" class="b_crum">Transfer</a> <?php

                                                          ?>&nbsp&nbsp/&nbsp&nbsp

        <span class="title"><?php echo $transferData['breadcrumb_title']; ?></span>
      </p>

    </div>

  </div>

</section>

<section class="quote-section">

  <div class="container">

    <h2 class="title">Request a Written Quote</h2>

    <div class="row">

      <div class="col-md-4">

        <div class="img-wrap">

          <img src="<?php echo base_url('uploads/' . $transferData['featured']); ?>" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';">

        </div>

      </div>

      <div class="col-md-8">

        <div class="light-form">

          <div class="contact-form custom-form request_quote_form">

            <!-- <form id="requestQuoteForm" method="post" action="<?php //echo base_url('submit_quote_request');
                                                                    ?>"> -->

            <form id="requestQuoteForm" method="post">

              <div class="row">

                <div class="col-md-12">

                  <div class="form-group">

                    <fieldset>

                      <legend>Full Name</legend>

                      <input type="text" class="form-control fieldset" id="user_name" name="user_name" autocomplete="off" value="">

                    </fieldset>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <fieldset>

                      <legend>Email</legend>

                      <input type="text" class="form-control fieldset" id="user_email" name="user_email" autocomplete="off">

                    </fieldset>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <fieldset>

                      <legend>Confirm Email</legend>

                      <input type="text" class="form-control fieldset" id="user_confirm_email" name="user_confirm_email" autocomplete="off">

                    </fieldset>

                  </div>

                </div>

              </div>

              <div class="form-group">

                <div class="row">

                  <div class="col-sm-12 remember">

                    <label class="checkbox-inline ">

                      <input type="checkbox" name="accept_privacy_policy" id="accept_privacy_policy" class="accept_privacy_policy">

                      By submitting this form I accept your <a href="<?= base_url('privacy-policy') ?>" target="_blank">Privacy Policy</a>

                    </label>

                    <div id="accept_privacy_policy_errr" class="mt-3"></div>

                  </div>

                </div>

              </div>

              <div class="button-wrap">

                <a href="<?php echo base_url('transfers/' . $transferData['breadcrumb_title']); ?>" name="go_back_tour_details" type="button" id="go_back_tour_details" class="btn btn-border">Go Back</a>

                <button type="submit" class="btn btn-yellow btn_sub">submit</button>

              </div>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>

</section>

<script>
  jQuery.validator.addMethod("no_HTML", function(value, element) {

    // return true - means the field passed validation

    // return false - means the field failed validation and it triggers the error

    return this.optional(element) || /^([a-zA-Z0-9 _&?=(){},.|*+-]+)$/.test(value);

  }, "Special Characters not allowed!");



  jQuery.validator.addMethod("customEmail", function(value, element, param) {

    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);

  }, 'Enter Correct E-mail Address');





  jQuery(document).on('click', '#thankyou_modal_close', function() {

    window.location.href = "" + BASE_URL;

  });



  jQuery("#requestQuoteForm").validate({

    errorElement: 'span',

    rules: {

      user_name: {

        required: true,

        noSpace: true,

        no_HTML: true,

        maxlength: 100

      },

      user_email: {

        required: true,

        noSpace: true,

        customEmail: true,

        maxlength: 150

      },

      user_confirm_email: {

        required: true,

        noSpace: true,

        customEmail: true,

        equalTo: "#user_email"

      },

      accept_privacy_policy: {

        required: true

      }

    },

    errorPlacement: function(error, element) {

      //console.log('dd', element.attr("name"))

      if (element.parent().hasClass('input-group')) {

        // error.appendTo(element.parent("div").next("div"));

        error.insertAfter(element.parent());

      } else if (element.hasClass('fieldset')) {

        // error.appendTo(element.parent("div").next("div"));

        error.insertAfter(element.parent());

      } else if (element.hasClass('accept_privacy_policy')) {

        error.appendTo("#accept_privacy_policy_errr");

      } else {

        error.insertAfter(element)

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

        equalTo: "Email and Confirm Email not match"

      },

      accept_privacy_policy: {

        required: "Please Accept Privacy and Policy",

      }

    },

    submitHandler: function(form) {



      jQuery.ajax({

        url: BASE_URL + "submit_quote_request_for_transfer",

        method: 'POST',

        data: jQuery("#requestQuoteForm").serialize(),

        dataType: 'JSON',

        beforeSend: function() {

          ajxLoader('show', 'body');

        },

        success: function(response) {

          ajxLoader('hide', 'body');

          if (response.success) {

            jQuery("#thankyoumodal").modal('show');

            jQuery("#requestQuoteForm")[0].reset();

          } else {



            jQuery("#err_msg").html(response.msg);

            jQuery("#errormodal").modal('show');

          }

        }

      });

    }

  });
</script>