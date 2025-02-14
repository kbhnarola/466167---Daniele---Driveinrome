jQuery.validator.addMethod("noSpace", function(value, element) { 
    if($.trim(value).length > 0){
        return true;
    } else {
        return false;
    }
}, "No space please and don't leave it empty");

jQuery.validator.addMethod("noHTML", function(value, element) {
    // return true - means the field passed validation
    // return false - means the field failed validation and it triggers the error

    return this.optional(element) || /^([a-zA-Z0-9 ]+)$/.test(value);
}, "Special Characters not allowed!");

$.validator.addMethod('filesize', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    var iSize = ($('#'+element.id)[0].files[0].size / 1024); 
    iSize = (Math.round(iSize * 100) / 100);    
   
    if (iSize > 800) {
        //alert('File size exceeds 2 MB');
        return false;
    } else {
        return true
    }
    //return this.optional(element) || (element.files[0].size <= param) 
});
$.validator.addMethod(
            "validate_file_type",
            function(val,elem) {
                //console.log(elem.id);
                    var files    =   $('#'+elem.id)[0].files;
                //console.log(files);
                for(var i=0;i<files.length;i++){
                    var fname = files[i].name.toLowerCase();
                    var re = /(\.jpg|\.jpeg|\.png)$/i;
                    if(!re.exec(fname))
                    {
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
            function(val,elem) {
                //console.log(elem.id);
                var files    =   $('#'+elem.id)[0].files;
                //console.log(files);
                for(var i=0;i<files.length;i++) {
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
        stepComplete: "msf-step-complete",
        stepActive: "msf-step-active",
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

    const msfEventTypes = {
        viewChanged : "msf:viewChanged"
    };

    $.fn.multiStepForm = function (options) {
        var form = this;

        var defaults = {
            activeIndex: 0,
            validate: {}
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

        form.getActiveView = function() {
            return form.views.filter(function () { return this.style && this.style.display !== '' && this.style.display !== 'none' });
        };

        form.setActiveView = function(index) {
            var view = form.getActiveView();
            var previousIndex = form.views.index(view);

            view = form.views.eq(index);
            view.show();
            view.find(':input').first().focus();

            //trigger the 'view has changed' event
            form.trigger(msfEventTypes.viewChanged, {
                currentIndex : index, 
                previousIndex : previousIndex,
                totalSteps : form.steps.length
            });    
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

                    if (form.steps.length < index + 1) {
                        $(form.header).append($("<div/>", {
                            "class": msfCssClasses.step,
                            "display": "none"
                        }));
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
                    var element = this.navigation.find("button[data-type='" + type + "'], input[type='button']"), type;
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

            this.views.each(function (index, element) {

                var view = element,
                    $view = $(element);

                $view.on('show', function (e) {
                    if (this !== e.target)
                        return;

                    //hide whichever view is currently showing
                    form.getActiveView().hide();
              
                    //choose which navigation buttons should be displayed based on index of view 
                    if (index > 0) {
                        form.backNavButton.show();
                    }

                    if (index == form.views.length - 1) {
                        form.nextNavButton.hide();
                        form.submitNavButton.show();
                    }
                    else {
                        form.submitNavButton.hide();
                        form.nextNavButton.show();

                        //if this is not the last view do not allow the enter key to submit the form as it is not completed yet
                        // $(this).find(':input').keypress(function (e) {
                        //     if (e.which == 13) // Enter key = keycode 13
                        //     {
                        //         form.nextNavButton.click();
                        //         return false;
                        //     }
                        // });
                    }

                    //determine if each step is completed or active based in index
                    $.each(form.steps, function (i, element) {
                        if (i < index) {
                            $(element).removeClass(msfCssClasses.stepActive);
                            $(element).addClass(msfCssClasses.stepComplete);
                        }

                        else if (i === index) {
                            $(element).removeClass(msfCssClasses.stepComplete);
                            $(element).addClass(msfCssClasses.stepActive);
                        }
                        else {
                            $(element).removeClass(msfCssClasses.stepComplete);
                            $(element).removeClass(msfCssClasses.stepActive);
                        }
                    });
                });

                $view.on('hide', function (e) {
                    if (this !== e.target)
                        return;

                    //hide all navigation buttons, display choices will be set on show event
                    form.backNavButton.hide();
                    form.nextNavButton.hide();
                    form.submitNavButton.hide();
                });
            });

            form.setActiveView(settings.activeIndex);
        };

        form.init();

        var v = jQuery("#addTourform").validate({
                    //ignore: [],
                    rules:{
                        tour_type: "required",
                        tour_category:"required",
                        tour_name:{
                        required:true,
                        noSpace:true,
                        noHTML:true,
                        remote: {
                                        url: BASE_URL+"admin/tours/istourExists",
                                        type: "POST",
                                        data: {
                                            record_id: function() {
                                                return $('#tour_id').val();
                                            },
                                        }
                                     },
                            maxlength:100
                        },
                        tour_unique_code:{
                            required:true,
                            noSpace:true,
                            noHTML:true,
                            remote: {
                                        url: BASE_URL+"admin/tours/istourcodeExists",
                                        type: "POST",
                                        data: {
                                            record_id: function() {
                                                return $('#tour_id').val();
                                            },
                                        }
                                     },
                            maxlength:20
                        },
                        tour_description:{
                            required:true,
                            noSpace:true
                        },
                        tour_included:{
                            required:true,
                            noSpace:true
                        },
                        tour_restrictions:{
                            required:true,
                            noSpace:true
                        },
                        tour_meeting_point:{
                            required:true,
                            noSpace:true
                        },
                        tour_faqs:{
                            required:true,
                            noSpace:true
                        },
                        tour_cancellation_policy:{
                            required:true,
                            noSpace:true
                        },
                        tour_featured_image:{
                            required:true, 
                            extension:"jpg,png,jpeg",
                            //filesize: 2097152
                            filesize: true
                        },
                        'tour_gallery_image[]':{
                            required:true, 
                            validate_file_type: true,
                            validate_file_size: true
                        },
                        duration:{
                            required:true,
                            noSpace:true,
                            //maxlength:20
                        },
                        //ratings:"required"
                        //'custom_price[]':"required"
                    },
                    messages: {
                      tour_name:{
                        required:"Please Enter Tour Name",
                        remote:"Tour Name Already Exists"
                      },
                      tour_unique_code:{
                        //required:"Please Enter Tour Name",
                        remote:"Tour Unique Code Already Exists"
                      },
                      tour_featured_image:{
                        required:"Please Select Feature Image",
                                extension:'File type must be JPG, JPEG or PNG',
                                filesize:'File size must be less than 800 KB'
                       }
                      
                    },
                    // submitHandler: function (form) {

                    //     jQuery("#btn_tour_submit").attr("disabled",true);
                    //     jQuery('.load-main').removeClass('hidden');
                    //     form.submit();
                    // }
                });

        form.nextNavButton.click(function () {
            var view = form.getActiveView();

            //validate the input in the current view
             if (form.validate(settings.validate).subset(view)) {
                var i = form.views.index(view);
                //if (v.form()) { 
                    form.setActiveView(i+1);
                //}
            }
        });

        form.backNavButton.click(function () {
            var view = form.getActiveView();
            var i = form.views.index(view);
            
            form.setActiveView(i-1);
        });

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




  // $(document).on("msf:viewChanged", function(event, data){

  //          var progress = Math.round((data.currentIndex / data.totalSteps)*100);

  //           $(".progress-bar").css("width", progress + "%").attr('aria-valuenow', progress);   ;
  //       });
        
        
$(".msf:first").multiStepForm();

jQuery(document).ready(function(){

    jQuery("#tour_type").select2();
    jQuery("#tour_category").select2();
});

jQuery("#tour_type").select2().change(function() {
    //console.log($("#tour_type").val());
    jQuery(this).valid();
    jQuery.ajax({
        url:BASE_URL+'admin/tours/getTourVariantion',
        type: 'POST',
        data: {
            tour_type_id: jQuery(this).val(),
        },
        dataType:'JSON',
        success: function(response) 
        {
            if(response.success){
                
                var variation_field='<legend class="scheduler-border">Variation Price</legend>';
                //console.log(response.variation_list);
                jQuery(response.variation_list).each(function(i,v){
                    
                    variation_field+='<div class="form-group row"><label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12">'+v.title+'<small class="req text-danger">*</small></label><div class="col-lg-9 col-md-9 col-sm-12"><input type="number" id="custom_price'+i+'" class="form-control required" name="custom_price['+i+']" autocomplete="off" placeholder="Custom Price" min="0"></div></div>';

                });
                
                jQuery(".custom_price").html(variation_field);
            } else {
               // jGrowlAlert(response.msg, 'danger');
               console.log(response.msg);
                
            }
        }
    }); 
});

jQuery("#tour_category").select2().change(function() {
                    //console.log($("#tour_type").val());
                    jQuery(this).valid();
                });

jQuery('.remove_feature_img').click(function(){
    var remove_id=$(this).attr('value');
    var imgname=$(this).data('imgname');
    swal({
        title: jQuery("#swal_title").val(),
        text: jQuery("#swal_text").val(),
        type: "warning", 
        showCancelButton: true, 
        cancelButtonText: jQuery("#swal_cancelButtonText").val(),
        confirmButtonText: jQuery("#swal_confirmButtonText").val(),  
    },
    function(result)
    {
        if (result) 
        {
            jQuery.ajax({
                            url:BASE_URL+'admin/tours/remove_feature_img/',
                            method:"POST",
                            data:{ remove_id:remove_id,imgname:imgname },
                            dataType:"JSON",
                            success:function(response) {
                                if(response.success) {                                    
                                    jQuery("#feature_img_show").hide();
                                    jQuery("#tour_featured_image").removeClass('hidden');
                                    jQuery("#tour_featured_image").prop("disabled", false); 
                                    jGrowlAlert(response.msg, 'success');
                                } else {
                                    jGrowlAlert(response.msg, 'warning');
                                }   
                            }
                        });
        }
    });
});

jQuery(document).on('click',".remove_gallery_img", function () {
    var remove_id=$(this).attr('value');
    var imgname=$(this).data('imgname');

    swal({
        title: jQuery("#swal_title").val(),
        text: jQuery("#swal_text").val(),
        type: "warning", 
        showCancelButton: true, 
        cancelButtonText: jQuery("#swal_cancelButtonText").val(),
        confirmButtonText: jQuery("#swal_confirmButtonText").val(),  
    },
    function(result)
    {
        if (result) 
        {
            jQuery.ajax({
                            url:BASE_URL+'admin/tours/remove_gallery_img/',
                            method:"POST",
                            data:{ remove_id:remove_id,imgname:imgname },
                            dataType:"JSON",
                            success:function(response) {
                                //console.log(response);
                                if(response.success) { 
                                    if(response.total==0){
                                        $('#gallery_img_show').hide();
                                        $('#tour_gallery_image').removeClass('hidden');
                                        $('#gallery-info').removeClass('hidden');
                                        jQuery("#tour_gallery_image").prop("disabled", false); 
                                        jQuery(".add_gallery_img").addClass('hidden');
                                        jQuery(".cancel_add_gallery_img").addClass('hidden');
                                    } else {
                                        var gallery_img="";
                                        jQuery(response.gallery_img).each(function(i,v){
                                            
                                            gallery_img+='<div class="col-lg-4 col-md-4 col-sm-12"><a href="'+BASE_URL+'uploads/'+v+'" class="imgClass" target="_blank">'+v+'</a><button title="close" type="button" class="btn remove_gallery_img" value="'+response.id+'" data-imgname="'+v+'">Remove</button></div>';
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

jQuery(document).on('click','.add_gallery_img',function(){
    jQuery(this).addClass('hidden');
    $('#tour_gallery_image').removeClass('hidden');
    $('#gallery-info').removeClass('hidden');
    jQuery("#tour_gallery_image").prop("disabled", false);
    jQuery(".cancel_add_gallery_img").removeClass('hidden'); 
});

jQuery(document).on('click','.cancel_add_gallery_img',function(){
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

jQuery("#tour_featured_image").change(function(){
    $('#tour_featured_image').valid();
});

jQuery('#tour_gallery_image').on('change', function() {
    $('#tour_gallery_image').valid(); // <- force re-validation
});