jQuery.validator.addMethod("noSpace", function (value, element) {
  if ($.trim(value).length > 0) {
    return true;
  } else {
    return false;
  }
}, "No space please and don't leave it empty");

jQuery.validator.addMethod("noHTML", function (value, element) {
  // return true - means the field passed validation
  // return false - means the field failed validation and it triggers the error

  return this.optional(element) || /^([a-zA-Z0-9 _&?=(){},.'|*+-\/]+)$/.test(value);
}, "Special Characters not allowed!");

$.validator.addMethod('filesize', function (value, element, param) {
  // param = size (en bytes) 
  // element = element to validate (<input>)
  // value = value of the element (file name)
  var iSize = ($('#' + element.id)[0].files[0].size / 1024);
  iSize = (Math.round(iSize * 100) / 100);

  if (iSize > 800) {
    //alert('File size exceeds 2 MB');
    return false;
  } else {
    return true
  }
  //return this.optional(element) || (element.files[0].size <= param) 
});
$.validator.addMethod('minImageHeight', function (value, element, minWidth) {
  // console.log(jQuery('#'+element.id).attr('uploadheight'));
  if (jQuery('#' + element.id).attr('uploadheight') < 530) {
    return false;
  }
  else {
    return true;
  }
});

$.validator.addMethod('minImageWidth', function (value, element, minWidth) {
  if (jQuery('#' + element.id).attr('uploadwidth') < 1920) {
    return false;
  }
  else {
    return true;
  }
});

$.validator.addMethod('feature_image_minImageHeight', function (value, element, minWidth) {
  if (jQuery('#' + element.id).attr('uploadheight') < 700) {
    return false;
  }
  else {
    return true;
  }
});

$.validator.addMethod('feature_image_minImageWidth', function (value, element, minWidth) {
  if (jQuery('#' + element.id).attr('uploadwidth') < 1000) {
    return false;
  }
  else {
    return true;
  }
});

$.validator.addMethod(
  "validate_file_type",
  function (val, elem) {
    //console.log(elem.id);
    var files = $('#' + elem.id)[0].files;

    for (var i = 0; i < files.length; i++) {
      var fname = files[i].name.toLowerCase();
      var re = /(\.jpg|\.jpeg|\.png)$/i;
      if (!re.exec(fname)) {
        return false;
      }
      // var FileSize = files[i].size / 1024 / 1024; // in MB
      // if (FileSize > 2) {
      //     //alert('File size exceeds 2 MB');
      //     return false;
      // } 
    }
    return true;
  },
  "File type must be JPG, JPEG or PNG"
);
$.validator.addMethod(
  "validate_file_size",
  function (val, elem) {
    //console.log(elem.id);
    var files = $('#' + elem.id)[0].files;
    //console.log(files);
    for (var i = 0; i < files.length; i++) {
      var iSize = files[i].size / 1024;
      iSize = (Math.round(iSize * 100) / 100);
      //var FileSize = files[i].size / 1024 / 1024; // in MB
      if (iSize > 800) {
        //alert('File size exceeds 800 KB');
        return false;
      }
    }
    return true;
  },
  "File size must be less than 800 KB"
);
jQuery.validator.addMethod("tour_description_validate", function (value, element) {
  // return true - means the field passed validation
  // return false - means the field failed validation and it triggers the error

  if (jQuery('[name="tour_description"]').summernote('isEmpty')) {
    return false;
  } else if (jQuery('[name="tour_description"]').summernote('code') == '' || jQuery('[name="tour_description"]').summernote('code') == '<p><br></p>') {
    return false;
  } else {
    return true;
  }
}, "This field is required.");
jQuery.validator.addMethod("tour_included_validate", function (value, element) {
  // return true - means the field passed validation
  // return false - means the field failed validation and it triggers the error

  if (jQuery('[name="tour_included"]').summernote('isEmpty')) {

    return false;
  }
  else if (jQuery('[name="tour_included"]').summernote('code') == '' || jQuery('[name="tour_included"]').summernote('code') == '<p><br></p>') {
    return false;
  }
  else {
    return true;
  }
}, "This field is required.");
jQuery(document).on("msf:viewChanged", function (event, data) {

  var progress = Math.round((data.currentIndex / data.totalSteps) * 100);
  jQuery(".progress-bar").css("width", progress + "%").attr('aria-valuenow', progress);
});
jQuery.validator.addMethod("tour_cancellation_policy_validate", function (value, element) {
  // return true - means the field passed validation
  // return false - means the field failed validation and it triggers the error

  if (jQuery('[name="tour_cancellation_policy"]').summernote('isEmpty')) {

    return false;
  } else if (jQuery('[name="tour_cancellation_policy"]').summernote('code') == '' || jQuery('[name="tour_cancellation_policy"]').summernote('code') == '<p><br></p>') {
    return false;
  }
  else {
    return true;
  }
}, "This field is required.");

$.validator.addMethod(
  "validate_file_w",
  function (val, elem) {
    var w = 0;
    if (jQuery("#width_gallery_img").val()) {
      var width_img_arr = jQuery("#width_gallery_img").val().split(',');

      jQuery.each(width_img_arr, function (i, v) {
        if (v < 700) {
          w++;
        }
      });
    }
    if (w > 0) {
      return false;
    } else {
      return true;
    }

  },
  "File Width must be greater than 700"
);
$.validator.addMethod(
  "validate_file_h",
  function (val, elem) {
    var h = 0;
    if (jQuery("#height_gallery_img").val()) {
      var height_img_arr = jQuery("#height_gallery_img").val().split(',');

      jQuery.each(height_img_arr, function (i, v) {
        if (v < 500) {
          h++;
        }
      });
    }
    if (h > 0) {
      return false;
    } else {
      return true;
    }

  },
  "File Height must be greater than 500"
);

(function (factory) {
  'use strict';
  if (typeof define === 'function' && define.amd) {
    // AMD is used - Register as an anonymous module.
    define(['jquery', 'jquery-validation'], factory);
  } else if (typeof exports === 'object') {
    factory(require('jquery'), require('jquery-validation'));
  } else {
    // Neither AMD nor CommonJS used. Use global variables.
    if (typeof jQuery === 'undefined') {
      throw 'multi-step-form-js requires jQuery to be loaded first';
    }
    if (typeof jQuery.validator === 'undefined') {
      throw 'multi-step-form-js requires requires jquery.validation.js to be loaded first';
    }
    factory(jQuery);
  }
}(function ($) {
  'use strict';

  const msfCssClasses = {
    header: "msf-header",
    step: "msf-step",
    statuses: {
      stepComplete: "msf-step-complete",
      stepIncomplete: "msf-step-incomplete",
      stepActive: "msf-step-active"
    },
    content: "msf-content",
    view: "msf-view",
    navigation: "msf-navigation",
    navButton: "msf-nav-button"
  };

  const msfNavTypes = {
    back: "back",
    next: "next",
    submit: "submit"

  };

  const msfJqueryData = {
    validated: "msf-validated",
    visited: "msf-visited"
  };

  const msfEventTypes = {
    viewChanged: "msf:viewChanged"
  };

  $.fn.multiStepForm = function (options) {
    var form = this;

    var defaults = {
      activeIndex: 0,
      validate: {},
      hideBackButton: false,
      allowUnvalidatedStep: false,
      allowClickNavigation: false
    };

    var settings = $.extend({}, defaults, options);

    //find the msf-content object
    form.content = this.find("." + msfCssClasses.content).first();

    if (form.content.length === 0) {
      throw new Error('Multi-Step Form requires a child element of class \'' + msfCssClasses.content + '\'');
    }

    //find the msf-views within the content object
    form.views = $(this.content).find("." + msfCssClasses.view);

    if (form.views.length === 0) {
      throw new Error('Multi-Step Form\'s element of class \'' + msfCssClasses.content + '\' requires n elements of class \'' + msfCssClasses.view + '\'');
    }

    form.header = this.find("." + msfCssClasses.header).first();
    form.navigation = this.find("." + msfCssClasses.navigation).first();
    form.steps = [];
    //form.completedSteps = 0;

    form.getActiveView = function () {
      return form.views.filter(function () {
        return this.style && this.style.display !== '' && this.style.display !== 'none'
      });
    };

    form.setActiveView = function (index) {
      var previousView = form.getActiveView()[0];
      var previousIndex = form.views.index(previousView);

      $(previousView).hide();
      //if(previousView)
      //    previousView.hide();

      var view = form.views.eq(index);
      view.show();
      view.find(':input').first().focus();

      var completedSteps = 0;
      $.each(form.views, function (index, view) {
        if ($.data(view, msfJqueryData.validated)) {
          completedSteps++;
        }
      });

      //trigger the 'view has changed' event
      form.trigger(msfEventTypes.viewChanged, {
        currentIndex: index,
        previousIndex: previousIndex,
        totalSteps: form.steps.length,
        completedSteps: completedSteps
      });
    }

    form.setStatusCssClass = function (step, cssClass) {
      $(step).removeClass(msfCssClasses.statuses.stepComplete);
      $(step).removeClass(msfCssClasses.statuses.stepIncomplete);

      $(step).addClass(cssClass);
    }

    form.tryNavigateToView = function (currentIndex, targetIndex) {
      if (targetIndex <= currentIndex) {

        form.validateView(form.views[currentIndex]);

        if (!settings.hideBackButton)
          form.setActiveView(targetIndex);
        return;
      }

      if (!form.validateViews(currentIndex, targetIndex - currentIndex, function (i) {
        if (!settings.allowUnvalidatedStep) {
          form.setActiveView(i);
          return false;
        }

        return true;
      })) {
        if (!settings.allowUnvalidatedStep) {
          return;
        }
      }
      form.setActiveView(targetIndex);
    }

    form.init = function () {

      this.initHeader = function () {
        if (form.header.length === 0) {
          form.header = $("<div/>", {
            "class": msfCssClasses.header,
            "display": "none"
          });

          $(form).prepend(form.header);
        }

        form.steps = $(form.header).find("." + msfCssClasses.step);

        this.initStep = function (index, view) {

          //append steps to header if they do not exist
          if (form.steps.length < index + 1) {
            $(form.header).append($("<div/>", {
              "class": msfCssClasses.step,
              "display": "none"
            }));
          }

          if (settings.allowClickNavigation) {
            //bind the click event to the header step
            $(form.steps[index]).click(function (e) {
              var view = form.getActiveView()[0];
              var currentIndex = form.views.index(view);
              var targetIndex = form.steps.index($(e.target).closest("." + msfCssClasses.step)[0]);

              form.tryNavigateToView(currentIndex, targetIndex);
            });
          }
        }

        $.each(form.views, this.initStep);

        form.steps = $(form.header).find("." + msfCssClasses.step);
      };


      this.initNavigation = function () {

        if (form.navigation.length === 0) {
          form.navigation = $("<div/>", {
            "class": msfCssClasses.navigation
          });

          $(form.content).after(form.navigation);
        }

        this.initNavButton = function (type) {
          var element = this.navigation.find("button[data-type='" + type + "'], input[type='button']"),
            type;
          if (element.length === 0) {
            element = $("<button/>", {
              "class": msfCssClasses.navButton,
              "data-type": type,
              "html": type
            });
            element.appendTo(form.navigation);
          }
          return element;
        };

        form.backNavButton = this.initNavButton(msfNavTypes.back);
        form.nextNavButton = this.initNavButton(msfNavTypes.next);
        form.submitNavButton = this.initNavButton(msfNavTypes.submit);
      };

      this.initHeader();
      this.initNavigation();

      this.views.each(function (index, view) {

        $.data(view, msfJqueryData.validated, false);
        $.data(view, msfJqueryData.visited, false);

        //if this is not the last view do not allow the enter key to submit the form as it is not completed yet                  
        if (index !== form.views.length - 1) {
          $(view).find(':input').not('textarea').keypress(function (e) {
            if (e.which === 13) // Enter key = keycode 13
            {
              form.nextNavButton.click();
              return false;
            }
          });
        }

        $(view).on('show', function (e) {
          if (this !== e.target)
            return;

          var view = e.target;
          $.data(view, msfJqueryData.visited, true);

          var index = form.views.index(view);
          var step = form.steps[index];

          $(step).addClass(msfCssClasses.statuses.stepActive);
          //form.setStatusCssClass(step, msfCssClasses.statuses.stepActive);

          //choose which navigation buttons should be displayed based on index of view 
          if (index > 0 && !settings.hideBackButton) {
            form.backNavButton.show();
          }

          if (index == form.views.length - 1) {
            form.nextNavButton.hide();
            form.submitNavButton.show();
          } else {
            form.submitNavButton.hide();
            form.nextNavButton.show();
          }
        });

        $(view).on('hide', function (e) {
          if (this !== e.target)
            return;

          var index = form.views.index(e.target);
          var step = form.steps[index];

          $(step).removeClass(msfCssClasses.statuses.stepActive);

          if ($.data(e.target, msfJqueryData.validated) && $.data(e.target, msfJqueryData.visited)) {
            form.setStatusCssClass(step, msfCssClasses.statuses.stepComplete);
          } else if ($.data(e.target, msfJqueryData.visited)) {
            form.setStatusCssClass(step, msfCssClasses.statuses.stepIncomplete);
          } else {
            form.setStatusCssClass(step, "");
          }

          //hide all navigation buttons, display choices will be set on show event
          form.backNavButton.hide();
          form.nextNavButton.hide();
          form.submitNavButton.hide();
        });

        //initially hide each view
        $(view).hide();
      });


      if (settings.activeIndex > 0) {
        $(form).ready(function () {
          form.tryNavigateToView(0, settings.activeIndex);
        });
      } else {
        form.setActiveView(0);
      }

    };

    form.validateView = function (view) {
      var index = form.views.index(view);

      if (form.validate().subset(view)) {
        $.data(view, msfJqueryData.validated, true);
        form.setStatusCssClass(form.steps[index], msfCssClasses.statuses.stepComplete);
        return true;
      } else {
        $.data(view, msfJqueryData.validated, false);
        form.setStatusCssClass(form.steps[index], msfCssClasses.statuses.stepIncomplete);
        var i = form.views.index(view);
        return false;
      }

    };

    form.validateViews = function (currentIndex, length, invalid) {
      currentIndex = typeof currentIndex === 'undefined' ? 0 : currentIndex;
      length = typeof length === 'undefined' ? form.views.length : length;


      var validationIgnore = ""; // Saving the existing validator ignore settings to reset them after validating multi-step form
      var isValid = true;

      //remember original validation setings for ignores
      if ($(form).data("validator")) {
        var formValidatorSettings = $(form).data("validator").settings;
        validationIgnore = formValidatorSettings.ignore;

        var currentValidationIgnoreSettingsArray = validationIgnore.split(",");
        if (currentValidationIgnoreSettingsArray.length >= 1) {
          // Remove the ":hidden" selector from validator ignore settings as we want our hidden fieldsets/steps to be validated before final submit
          var hiddenIndex = $.inArray(":hidden", currentValidationIgnoreSettingsArray);
          currentValidationIgnoreSettingsArray.splice(hiddenIndex, 1);
          $(form).data("validator").settings.ignore = currentValidationIgnoreSettingsArray.toString();
        }
      }

      for (var i = currentIndex; i < currentIndex + length; i++) {
        if (!form.validateView(form.views[i])) {
          isValid = false;

          if (!invalid(i)) {
            break;
          }
        }
      }

      if ($(form).data("validator")) {
        $(form).data("validator").settings.ignore = validationIgnore;
      }

      return isValid;

    }

    form.init();
    var v = jQuery("#editTourform").validate({
      //ignore: [],
      errorElement: 'span',
      rules: {
        tour_type: "required",
        tour_category: "required",
        tour_name: {
          required: true,
          noSpace: true,
          noHTML: true,
          remote: {
            url: BASE_URL + "tours/istourExists",
            type: "POST",
            data: {
              record_id: function () {
                return $('#tour_id').val();
              },
            }
          },
          maxlength: 100
        },
        tour_unique_code: {
          required: true,
          noSpace: true,
          noHTML: true,
          remote: {
            url: BASE_URL + "tours/istourcodeExists",
            type: "POST",
            data: {
              record_id: function () {
                return $('#tour_id').val();
              },
            }
          },
          maxlength: 20
        },
        tour_description: {
          required: true,
          noSpace: true,
          tour_description_validate: true
        },
        // tour_included:{
        //     required:true,
        //     noSpace:true,
        //     tour_included_validate:true
        // },
        // "tour_restrictions[]":{
        //     required:true,
        //     noSpace:true
        // },
        // "tour_meeting_point[]":{
        //     required:true,
        //     noSpace:true
        // },
        // "tour_faqs_question[]":{
        //     required:true,
        //     noSpace:true
        // },
        // "tour_faqs_answer[]":{
        //     required:true,
        //     noSpace:true
        // },
        // tour_cancellation_policy:{
        //     required:true,
        //     noSpace:true,
        //     tour_cancellation_policy_validate:true
        // },
        // tour_featured_image:{
        //     required:true, 
        //     extension:"jpg,png,jpeg",
        //     //filesize: 2097152
        //     filesize: true
        // },
        // 'tour_gallery_image[]':{
        //     required:true, 
        //     validate_file_type: true,
        //     validate_file_size: true
        // },
        duration: {
          required: true,
          noSpace: true,
          number: true,
          min: 1,
          max: 99999
          //maxlength:20
        },
        //ratings:"required"
        //'custom_price[]':"required"
      },
      errorPlacement: function (error, element) {
        //console.log('dd', element.attr("name"))
        if (element.attr("name") == "tour_description") {
          error.appendTo("#tour_description_err");
        } else if (element.attr("name") == "tour_included") {
          error.appendTo("#tour_included_err");
        } else if (element.attr("name") == "tour_cancellation_policy") {
          error.appendTo("#tour_cancellation_err");
        } else if (element.attr("name") == "tour_type") {
          error.appendTo("#tour_type_err");
        } else if (element.attr("name") == "tour_category") {
          error.appendTo("#tour_category_err");
        } else if (element.parent().hasClass('input-group')) {
          // error.appendTo(element.parent("div").next("div"));
          error.insertAfter(element.parent());
        } else {
          error.insertAfter(element);
        }

      },
      messages: {
        tour_name: {
          //required:"Please Enter Tour Name",
          remote: "Tour Name Already Exists"
        },
        tour_unique_code: {
          //required:"Please Enter Tour Unique Code",
          remote: "Tour Unique Code Already Exists"
        },
        duration: {
          max: "Please Enter Valid length of Duration"
        }

      },
      submitHandler: function (form) {

        //jQuery("#btn_tour_submit").attr("disabled",true);
        jQuery('.load-main').removeClass('hidden');
        form.submit();
      }
    });
    form.nextNavButton.click(function () {
      var view = form.getActiveView()[0];
      var index = form.views.index(view);

      if (form.validateView(view)) {
        form.setActiveView(index + 1);
      } else if (settings.allowUnvalidatedStep) {
        form.setActiveView(index + 1);
      }
      var i = form.views.index(view);
      if ((i + 1) == 3) {

        jQuery(".cancel_tour_edit").removeClass('hidden');
      }
    });

    form.backNavButton.click(function () {
      var view = form.getActiveView()[0];
      var index = form.views.index(view);

      form.validateView(view);

      form.setActiveView(index - 1);
      var i = form.views.index(view);
      if (i <= 3) {

        jQuery(".cancel_tour_edit").addClass('hidden');
      }
    });

    form.submit(function (e) {
      var validationIgnore = "";

      form.validateViews(0, form.views.length, function () {
        e.preventDefault();
        return true;
      });
    });
    return form;
  };

  $.validator.prototype.subset = function (container) {
    var ok = true;
    var self = this;
    $(container).find(':input').each(function () {
      if (!self.element($(this))) ok = false;
    });
    return ok;
  };

  $.each(['show', 'hide'], function (i, ev) {
    var el = $.fn[ev];
    $.fn[ev] = function () {
      this.trigger(ev);
      return el.apply(this, arguments);
    };
  });
}));


$(".msf:first").multiStepForm({
  activeIndex: 0,
  validate: {},
  hideBackButton: false,
  allowUnvalidatedStep: false,
  allowClickNavigation: true
});


var custom_price = "";

jQuery(document).ready(function () {

  jQuery("#tour_type, #tour_category, #active_campaign_automation").select2();

  var variation_title_arr = jQuery("#variation_title_arr").val().split(',');

  var count = variation_title_arr.length;

  var columns = [
    { data: 'RecordID', 'sortable': false, "orderable": false }, //0
    { data: 'tour_date' }
  ];

  for (var v = 0; v <= count - 1; v++) {
    columns.push({ "data": variation_title_arr[v], "orderable": false, "sortable": false });
  }
  columns.push({ data: 'action' });
  //console.log(columns.length);

  jQuery('#custom_variation_price_table').DataTable({
    // Processing indicator
    "processing": true,
    // DataTables server-side processing mode
    "serverSide": true,
    // Initial no order.
    "order": [],
    "searching": true,

    // Load data from an Ajax source
    "ajax": {
      "url": BASE_URL + 'tours/getCustomPriceLists/',
      "type": "POST",
      "data": {
        tour_id: jQuery("#tour_id").val()
      }
    },
    "columns": columns,
    //Set column definition initialisation properties
    "columnDefs": [
      {
        'targets': [(columns.length - 1)],
        'title': 'Actions',
        'searchable': false,
        'orderable': false,
        'className': 'dt-body-center',
        'render': function (data, type, full, meta) {
          //var id = data.id;
          var d = jQuery.parseJSON(data);

          if (d.tour_availability == 1) {
            return '<a href="javascript:" data-popup="tooltip"  data-placement="left"  title="edit"  data-tourdate="' + d.tour_date + '" class="text-info edit_record"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="right"  title="delete" href="javascript:" data-tourdate="' + d.tour_date + '" class="text-danger delete delete_record" ><i class=" icon-trash"></i></a>';
          } else {
            return '<a data-popup="tooltip" data-placement="right"  title="delete" href="javascript:" data-tourdate="' + d.tour_date + '" class="text-danger delete delete_record" ><i class=" icon-trash"></i></a>';
          }
          //return '<a href="javascript:" data-popup="tooltip"  data-placement="left"  title="edit"  data-tourdate="'+data+'" class="text-info edit_record"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="right"  title="delete" href="javascript:" data-tourdate="'+data+'" class="text-danger delete delete_record" ><i class=" icon-trash"></i></a>';
        }
      }
    ]
  });

  if (jQuery("#tour_feature_img").val() == "") {

    $("#editTourform").validate();
    $("#tour_featured_image").rules("add", {
      required: true,
      messages: {
        required: "Please Select Feature Image",
      }
    });
  }
  if (jQuery("#tour_gallery_img").val() == "") {
    $("#editTourform").validate();
    $("#tour_gallery_image").rules("add", {
      required: true,
      messages: {
        required: "Please Select Gallery Image",
      }
    });
  }
  if (jQuery("#tour_banner_img").val() == "") {

    $("#editTourform").validate();
    $("#tour_banner_image").rules("add", {
      required: true,
      messages: {
        required: "Please Select Banner Image",
      }
    });
  }

  jQuery("#tour_type").select2().change(function () {
    if (jQuery(this).val() == 7) {
      jQuery('.is-city-tour-wrap').removeClass('hide');
    } else {
      jQuery('.is-city-tour-wrap').addClass('hide');
    }
  });

});
jQuery('[name="tour_description"]')
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
  })
  .on('summernote.change', function (customEvent, contents, $editable) {
    // Revalidate the content when its value is changed by Summernote
    // validation.revalidateField('summernote_description');
    jQuery('[name="tour_description"]').valid();
  });
jQuery('[name="tour_included"]')
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
  })
  .on('summernote.change', function (customEvent, contents, $editable) {
    // Revalidate the content when its value is changed by Summernote
    // validation.revalidateField('summernote_description');
    jQuery('[name="tour_included"]').valid();
  });
jQuery('[name="tour_cancellation_policy"]')
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
  })
  .on('summernote.change', function (customEvent, contents, $editable) {
    // Revalidate the content when its value is changed by Summernote
    // validation.revalidateField('summernote_description');
    jQuery('[name="tour_cancellation_policy"]').valid();
  });
jQuery('[name="tour_email_description"]').summernote({
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
jQuery("#tour_type").select2().change(function () {
  //console.log($("#tour_type").val());
  jQuery(this).valid();
  if (jQuery(this).val() == 8) {
    jQuery(".duration_lbl").html(' (In Days)');
  } else {
    jQuery(".duration_lbl").html(' (In Hours)');
  }
  jQuery.ajax({
    url: BASE_URL + 'tours/getTourVariantion',
    type: 'POST',
    data: {
      tour_type_id: jQuery(this).val(),
    },
    dataType: 'JSON',
    success: function (response) {
      if (response.success) {

        var variation_field = '<legend class="scheduler-border"><strong>Variation Price</strong></legend>';
        //console.log(response.variation_list);
        var vv = 0;
        jQuery(response.variation_list).each(function (i, v) {
          if ((v.title.toLowerCase()).trim() == "enfants") {
            variation_field += '<div class="col-md-2"><div class="form-group"><label  class="col-form-label label_text text-lg-right">' + v.title + '<small class="req text-danger">*</small></label><input type="number" id="basic_price' + i + '" class="form-control required" name="basic_price[' + i + ']" autocomplete="off" placeholder="Enter Price" min="0"></div></div>';
          } else {
            variation_field += '<div class="col-md-2"><div class="form-group"><label  class="col-form-label label_text text-lg-right">' + v.title + '<small class="req text-danger">*</small></label><input type="number" id="basic_price' + i + '" class="form-control required" name="basic_price[' + i + ']" autocomplete="off" placeholder="Enter Price" min="1" ></div></div>';
          }

          vv++;

          if (vv % 6 == 0) { variation_field += '<div class="clearfix"></div>'; }

        });
        //variation_field+='<div class="col-md-2"><div class="form-group"> <button type="button" class="btn btn-primary" name="add_custom_price" id="add_custom_price">Add More</button></div></div>';

        jQuery(".basic_price").html(variation_field);
      } else {
        // jGrowlAlert(response.msg, 'danger');
        console.log(response.msg);

      }
    }
  });
});

jQuery("#tour_category").select2().change(function () {
  //console.log($("#tour_type").val());
  jQuery(this).valid();
});

jQuery('.remove_feature_img').click(function () {
  var remove_id = $(this).attr('value');
  var imgname = $(this).data('imgname');
  swal({
    title: jQuery("#swal_title").val(),
    text: jQuery("#swal_text").val(),
    type: "warning",
    showCancelButton: true,
    cancelButtonText: jQuery("#swal_cancelButtonText").val(),
    confirmButtonText: jQuery("#swal_confirmButtonText").val(),
  },
    function (result) {
      if (result) {
        jQuery.ajax({
          url: BASE_URL + 'tours/remove_feature_img/',
          method: "POST",
          data: { remove_id: remove_id, imgname: imgname },
          dataType: "JSON",
          success: function (response) {
            if (response.success) {
              jQuery("#feature_img_show").hide();
              jQuery("#tour_feature_img").val('');

              $("#editTourform").validate();
              $("#tour_featured_image").rules("add", {
                required: true,
                extension: "jpg,png,jpeg",
                filesize: true,
                feature_image_minImageWidth: true,
                feature_image_minImageHeight: true,
                messages: {
                  required: "Please Select Feature Image",
                  extension: 'File type must be JPG, JPEG or PNG',
                  filesize: 'File size must be less than 800 KB',
                  feature_image_minImageWidth: 'Min Width of image must be 1000',
                  feature_image_minImageHeight: 'Min Height of image must be 700'
                }
              });

              jGrowlAlert(response.msg, 'success');
            } else {
              jGrowlAlert(response.msg, 'warning');
            }
          }
        });
      }
    });
});

$('#tour_banner_image').on('change', function () {
  //jQuery('#tour_banner_image').attr('name', 'featured_image');
  element = $(this);
  var files = this.files;
  var _URL = window.URL || window.webkitURL;
  var image, file;
  image = new Image();
  image.src = _URL.createObjectURL(files[0]);
  image.onload = function () {
    element.attr('uploadwidth', this.width);
    element.attr('uploadheight', this.height);
  }
  $("#tour_banner_image").rules("add", {
    extension: "jpg,png,jpeg",
    filesize: true,
    minImageWidth: true,
    minImageHeight: true,
    messages: {
      extension: 'File type must be JPG, JPEG or PNG',
      filesize: 'File size must be less than 800 KB',
      minImageWidth: 'Min Width of image must be 1920',
      minImageHeight: 'Min Height of image must be 530'
    }
  });
  jQuery(this).valid();
});
jQuery(document).on('click', ".remove_gallery_img", function () {
  var remove_id = $(this).attr('value');
  var imgname = $(this).data('imgname');

  swal({
    title: jQuery("#swal_title").val(),
    text: jQuery("#swal_text").val(),
    type: "warning",
    showCancelButton: true,
    cancelButtonText: jQuery("#swal_cancelButtonText").val(),
    confirmButtonText: jQuery("#swal_confirmButtonText").val(),
  },
    function (result) {
      if (result) {
        jQuery.ajax({
          url: BASE_URL + 'tours/remove_gallery_img/',
          method: "POST",
          data: { remove_id: remove_id, imgname: imgname },
          dataType: "JSON",
          success: function (response) {
            //console.log(response);
            if (response.success) {
              if (response.total == 0) {
                $('#gallery_img_show').hide();
                jQuery("#tour_gallery_img").val('');

                $("#editTourform").validate();
                $("#tour_gallery_image").rules("add", {
                  required: true,
                  validate_file_type: true,
                  validate_file_size: true,
                  validate_file_w: true,
                  validate_file_h: true,
                  messages: {
                    required: "Please Select Gallery Image",
                    //extension:'File type must be JPG, JPEG or PNG',
                    //filesize:'File size must be less than 800 KB'
                  }
                });

              } else {
                var gallery_img = "";
                jQuery(response.gallery_img).each(function (i, v) {

                  gallery_img += '<div class="col-lg-4 col-md-4 col-sm-12 mr-t-5"><a href="' + BASE_URL + 'uploads/' + v + '" class="imgClass" target="_blank"><img src="' + BASE_URL + 'uploads/' + v + '" width="50" height="50"></a><button title="close" type="button" class="btn remove_gallery_img" value="' + response.id + '" data-imgname="' + v + '"><i class="fa fa-close"></i></button></div>';
                });
                jQuery("#gallery_img_show").html(gallery_img);
              }

              jGrowlAlert(response.msg, 'success');
            } else {
              jGrowlAlert(response.msg, 'warning');
            }
          }
        });
      }
    });
});

// jQuery(document).on('click','.add_gallery_img',function(){
//     jQuery(this).addClass('hidden');
//     $('#tour_gallery_image').removeClass('hidden');
//     $('#gallery-info').removeClass('hidden');
//     jQuery("#tour_gallery_image").prop("disabled", false);
//     jQuery(".cancel_add_gallery_img").removeClass('hidden'); 
// });

jQuery(document).on('click', '.cancel_add_gallery_img', function () {
  jQuery(this).addClass('hidden');
  $('#tour_gallery_image').addClass('hidden');
  $('#gallery-info').addClass('hidden');
  jQuery("#tour_gallery_image").prop("disabled", true);
  jQuery(".add_gallery_img").removeClass('hidden');
  jQuery("#tour_gallery_image-error").hide();

});

// jQuery("#tour_featured_image").change(function(){
//     var iSize = ($(this)[0].files[0].size / 1024); 
//     iSize = (Math.round(iSize * 100) / 100);
//     //alert(iSize);
//     //$("#size").html( iSize  + "kb"); 
// });

jQuery("#tour_featured_image").change(function () {

  element = $(this);
  var files = this.files;
  var _URL = window.URL || window.webkitURL;
  var image, file;
  image = new Image();
  image.src = _URL.createObjectURL(files[0]);
  image.onload = function () {
    element.attr('uploadwidth', this.width);
    element.attr('uploadheight', this.height);
  }

  //sets up the validator
  //if(jQuery("#tour_gallery_img").val()==""){        
  jQuery("#editTourform").validate();
  jQuery(this).rules("add", {
    extension: "jpg,png,jpeg",
    filesize: true,
    feature_image_minImageWidth: true,
    feature_image_minImageHeight: true,
    messages: {
      extension: 'File type must be JPG, JPEG or PNG',
      filesize: 'File size must be less than 800 KB',
      feature_image_minImageWidth: 'Min Width of image must be 1000',
      feature_image_minImageHeight: 'Min Height of image must be 700'
    }
  });
  //} 
  $('#tour_featured_image').valid();
});

jQuery('#tour_gallery_image').on('change', function () {

  jQuery("#width_gallery_img").val('');
  jQuery("#height_gallery_img").val('');
  element = $(this);
  var files = this.files;
  var width_img = [];
  var height_img = [];
  for (var i = 0; i <= (files.length - 1); i++) {
    var _URL = window.URL || window.webkitURL;
    var image, file;
    image = new Image();
    image.src = _URL.createObjectURL(files[i]);
    image.onload = function () {
      //console.log(this.width);
      var wid = this.width;
      var hight = this.height;
      var w = jQuery("#width_gallery_img").val();
      var h = jQuery("#height_gallery_img").val();
      if (w != "") {
        var c = w.split(',');
        var d = [];
        c.push(wid);
        jQuery.each(c, function (i, v) {
          if (jQuery.inArray("v", d) != -1) {

          } else {
            d.push(v);
          }
        });


        jQuery("#width_gallery_img").val(d.join(','));
      } else {
        jQuery("#width_gallery_img").val(wid);
      }
      if (h != "") {
        var ch = h.split(',');
        var dh = [];
        ch.push(hight);
        jQuery.each(ch, function (i, v) {
          if (jQuery.inArray("v", dh) != -1) {

          } else {
            dh.push(v);
          }
        });


        jQuery("#height_gallery_img").val(dh.join(','));
      } else {
        jQuery("#height_gallery_img").val(hight);
      }

      //height_img.push(hight);
      //element.attr('uploadWidth',this.width);
      //element.attr('uploadheight',this.width);
    }
  }



  //if(jQuery("#tour_gallery_img").val()==""){
  $("#editTourform").validate(); //sets up the validator

  $(this).rules("add", {
    validate_file_type: true,
    validate_file_size: true,
    validate_file_w: true,
    validate_file_h: true
    // messages:{
    //     extension:'File type must be JPG, JPEG or PNG',
    //     filesize:'File size must be less than 800 KB'
    // }
  });
  //}
  $('#tour_gallery_image').valid(); // <- force re-validation
});
$.validator.addMethod(
  "check_date_exists",
  function (val, elem) {

    var c = jQuery(".tour_date").length;

    var k = 0;
    var date_array = [];
    jQuery(".tour_date").each(function (ii, v) {

      if (c > 1 && v.value != "") {
        date_array.push(v.value);
      }
    });
    var r = [];

    if (date_array.length) {
      $.each(date_array, function (index, value) {
        if (val == value) {
          r.push(value);
        }
      });
    }

    if (r.length == 1 || r.length == 0) {
      return true;
    } else {
      return false;
    }
  },
  "Date already Selected"
);
jQuery(document).on("change", ".tour_date", function () {
  $(this).rules("add",
    {
      required: true,
      check_date_exists: true
    });
  $(this).valid();

});

jQuery(document).on('click', '#add_custom_price', function () {

  jQuery(".bs_price").removeClass("hidden");
  jQuery(".bs_price").append(custom_price);
  var d_cnt = c_cnt = 0;
  jQuery(".tour_date").each(function (i, v) {
    $(this).attr("name", "tour_date[" + d_cnt + "]");
    d_cnt++;
  });
  jQuery(".custom_price_set").each(function (i, v) {
    $(this).attr("name", "custom_price[" + c_cnt + "]");
    c_cnt++;
  });
  var expireDate = new Date();
  expireDate.setFullYear(expireDate.getFullYear() + 2);

  jQuery('.tour_datepicker').datepicker({
    format: 'yyyy-mm-dd',
    // daysOfWeekDisabled: [1,2,3,4,5],
    startDate: new Date(),
    endDate: expireDate,
    // datesDisabled: ['2020-12-21'],
    autoclose: true
    //datesDisabled: ['2020/11/21'],
    //multidate: true
  });

});

jQuery(document).on('click', '.remove_add_custom_price', function () {
  //var parentId = jQuery(this).closest("fieldset").parent('div').remove();

  var parentId = jQuery(this).parent().parent().parent('div').remove();
  if (jQuery(".cs_price").length == 0) {
    jQuery(".bs_price").addClass("hidden");
  } else {
    var d_cnt = c_cnt = 0;
    jQuery(".tour_date").each(function (i, v) {
      $(this).attr("name", "tour_date[" + d_cnt + "]");
      d_cnt++;
    });
    jQuery(".custom_price_set").each(function (i, v) {
      $(this).attr("name", "custom_price[" + c_cnt + "]");
      c_cnt++;
    });
  }
});

jQuery(document).on('click', '#add_restriction', function () {

  var tour_res_input = jQuery(".tour_res_input").length;
  var restriction_field = '<div class="form-group"><div class="col-md-10"><input type="text" class="form-control required tour_res_input" name="tour_restrictions[]" autocomplete="off" placeholder="Tour Restrictions"></div><div class="col-md-2"><button name="remove_restriction" type="button" class="btn btn-primary remove_restriction">Remove</button></div></div>';

  jQuery(".tour_restrictions").append(restriction_field);
  var d_cnt = 0;
  jQuery(".tour_res_input").each(function (i, v) {
    $(this).attr("name", "tour_restrictions[" + d_cnt + "]");
    d_cnt++;
  });

});

jQuery(document).on('click', '.remove_restriction', function () {
  //var parentId = jQuery(this).closest("fieldset").parent('div').remove();

  var parentId = jQuery(this).parent().parent('div').remove();

  var d_cnt = 0;
  jQuery(".tour_res_input").each(function (i, v) {
    $(this).attr("name", "tour_restrictions[" + d_cnt + "]");
    d_cnt++;
  });

});

jQuery(document).on('click', '#add_meeting_point', function () {

  var tour_meeting_input = jQuery(".tour_meeting_input").length;
  var tour_meeting_field = '<div class="form-group"><div class="col-md-10"><input type="text" class="form-control required tour_meeting_input" name="tour_meeting_point[]" autocomplete="off" placeholder="Tour Meeting Point"></div><div class="col-md-2"><button name="remove_meeting_point" type="button" class="btn btn-primary remove_meeting_point">Remove</button></div></div>';

  jQuery(".tour_meeting_point").append(tour_meeting_field);
  var d_cnt = 0;
  jQuery(".tour_meeting_input").each(function (i, v) {
    $(this).attr("name", "tour_meeting_point[" + d_cnt + "]");
    d_cnt++;
  });

});

jQuery(document).on('click', '.remove_meeting_point', function () {

  var parentId = jQuery(this).parent().parent('div').remove();

  var d_cnt = 0;
  jQuery(".tour_meeting_input").each(function (i, v) {
    $(this).attr("name", "tour_meeting_point[" + d_cnt + "]");
    d_cnt++;
  });

});

jQuery(document).on('click', '#add_faqs', function () {

  //var tour_meeting_input=jQuery(".tour_meeting_input").length;
  var faqs_field = '<div class="m-div"><div class="form-group"> <label class="col-form-label label_text text-lg-right">Question<small class="req text-danger">*</small></label> <input type="text" class="form-control tour_faqs_input required" name="tour_faqs_question[]" autocomplete="off" placeholder="Question"></div><div class="form-group"> <label class="col-form-label label_text text-lg-right">Answer<small class="req text-danger">*</small></label><textarea rows="7" class="form-control resize_box required tour_faqs_output" name="tour_faqs_answer[]" placeholder="Answer"></textarea></div><div class="form-group"><button name="remove_faqs" type="button" class="btn btn-primary remove_faqs">Remove</button></div></div>';

  jQuery(".tour_faqs").append(faqs_field);
  var d_cnt = 0;
  var c_cnt = 0;
  jQuery(".tour_faqs_input").each(function (i, v) {
    $(this).attr("name", "tour_faqs_question[" + d_cnt + "]");
    d_cnt++;
  });
  jQuery(".tour_faqs_output").each(function (i, v) {
    $(this).attr("name", "tour_faqs_answer[" + c_cnt + "]");
    c_cnt++;
  });

});

jQuery(document).on('click', '.remove_faqs', function () {

  var parentId = jQuery(this).parent().parent('div').remove();

  var d_cnt = 0;
  var c_cnt = 0;
  jQuery(".tour_faqs_input").each(function (i, v) {
    $(this).attr("name", "tour_faqs_question[" + d_cnt + "]");
    d_cnt++;
  });
  jQuery(".tour_faqs_output").each(function (i, v) {
    $(this).attr("name", "tour_faqs_answer[" + c_cnt + "]");
    c_cnt++;
  });

});

jQuery(document).on("click", ".delete_record", function () {
  var tourdate = jQuery(this).data('tourdate');
  //console.log("#tourdate"+tourdate.replace(/-/g, ""));
  swal({
    title: jQuery("#swal_title").val(),
    text: jQuery("#swal_text").val(),
    type: "warning",
    showCancelButton: true,
    cancelButtonText: jQuery("#swal_cancelButtonText").val(),
    confirmButtonText: jQuery("#swal_confirmButtonText").val(),
  },
    function () {
      jQuery('.load-main').removeClass('hidden');
      $.ajax({
        url: BASE_URL + 'tours/delete_record_price',
        type: 'POST',
        data: {
          tour_id: jQuery("#tour_id").val(),
          tour_date: tourdate,
        },
        dataType: 'JSON',
        success: function (response) {
          jQuery('.load-main').addClass('hidden');
          if (response.success) {
            //$("#custom_var_price").load(location.href + " #custom_var_price");
            //$("#tourdate"+tourdate.replace(/-/g, "")).hide();
            jQuery('#custom_variation_price_table').DataTable().ajax.reload();
            jGrowlAlert(response.msg, 'success');
          }
          else {
            jGrowlAlert(response.msg, 'danger');
          }
        }
      });
    });
})
/**
 * open edit modal
 *
 * @param int  quesion id  
 */

jQuery(document).on("click", ".edit_record", function () {

  var tourdate = jQuery(this).data('tourdate');
  var tour_id = jQuery("#tour_id").val();
  var tour_type = jQuery("#tour_type").val();

  jQuery('.load-main').removeClass('hidden');

  $.ajax({
    url: BASE_URL + 'tours/get_record_byID',
    type: 'POST',
    data: {
      tour_id: jQuery("#tour_id").val(),
      tour_date: tourdate,
    },
    dataType: 'json',
    success: function (data) {
      jQuery('.load-main').addClass('hidden');
      //console.log(data);
      jQuery('#error_msg').html('');

      jQuery("#editVariantionPrice")[0].reset();
      if (data.success) {
        var html_data = '<div class="row">';
        var vc = 0;
        var variation_title_arr = jQuery("#variation_title_arr").val().split(',');
        $.each(data.variation_price, function (i, item) {
          if ((variation_title_arr[i].toLowerCase()).trim() == "enfants") {
            html_data += '<div class="col-md-3"><div class="form-group"><label  class="col-form-label label_text text-lg-right">' + variation_title_arr[i] + '<small class="req text-danger">*</small></label><input type="number" class="form-control required" name="upd_custom_price[' + i + ']" autocomplete="off" placeholder="Enter Price" min="0" value="' + item.price + '"></div></div>';
          } else {
            html_data += '<div class="col-md-3"><div class="form-group"><label  class="col-form-label label_text text-lg-right">' + variation_title_arr[i] + '<small class="req text-danger">*</small></label><input type="number" class="form-control required" name="upd_custom_price[' + i + ']" autocomplete="off" placeholder="Enter Price" min="1" value="' + item.price + '"></div></div>';
          }

          vc++;

          if (vc % 4 == 0) { html_data += '<div class="clearfix"></div>'; }
        });
        html_data += '<input type="hidden" name="utour_date" id="utour_date" value="' + tourdate + '"><input type="hidden" name="utours_id" id="utours_id" value="' + tour_id + '"><input type="hidden" name="utour_type_id" id="utour_type_id" value="' + tour_type + '"></div>';
        jQuery(".edit_price_form").html(html_data);
        jQuery("#edit_price_modal").modal('show');
      } else {
        jGrowlAlert(data.msg, 'danger');
      }

    }
  });
});

jQuery("#editVariantionPrice").validate({
  submitHandler: function (form) {
    //jQuery("#btn_tour_submit").attr("disabled",true);
    //jQuery('.load-main').removeClass('hidden');
    jQuery.ajax({
      url: BASE_URL + "tours/updateTourCustomPrice",
      type: 'POST',
      data: jQuery("#editVariantionPrice").serialize(),
      dataType: 'JSON',
      beforeSend: function () {
        jQuery("#editVariantionPrice").hide();
        jQuery("#loader_cont").removeClass('hidden');
      },
      success: function (response) {

        jQuery("#editVariantionPrice").show();
        jQuery("#loader_cont").addClass('hidden');

        if (response.success == false) {

          jQuery("#error_msg").html(response.msg);
          //jQuery("#error_msg").show();
          jQuery("#error_msg").removeClass('hidden');

          setTimeout(function () {

            jQuery("#error_msg").addClass('hidden');
            jQuery("#error_msg").html("");

          }, 3000);

        } else if (response.success == true) {

          jQuery("#editVariantionPrice")[0].reset();
          $('#edit_price_modal').modal('hide');

          $('#custom_variation_price_table').DataTable().ajax.reload();
          jGrowlAlert(response.msg, 'success');

        }
      }
    });
    //form.submit();
  }
});

$('.chk_upsell').click(function () {
  //$('.hli').removeClass('hli');
  $(this).find('input').prop('checked', true)
});

$('.chk_topsell').click(function () {
  //$('.hli').removeClass('hli');
  $(this).find('input').prop('checked', true)
});

jQuery('.msf-step').click(function () {
  var c = jQuery(this).data('id');
  if (c == 4) {
    jQuery(".cancel_tour_edit").removeClass('hidden');
  } else {
    jQuery(".cancel_tour_edit").addClass('hidden');
  }
});