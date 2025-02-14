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

    return this.optional(element) || /^([a-zA-Z0-9 _&?=(){},.|*+-]+)$/.test(value);
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

$.validator.addMethod('minImageHeight', function(value, element, minWidth) {
    if(jQuery('#'+element.id).attr('uploadHeigth')<530){ 
        return false;
    }
    else{            
        return true;
    }
});

$.validator.addMethod('minImageWidth', function(value, element, minWidth) {
    if(jQuery('#'+element.id).attr('uploadWidth')<1920){ 
        return false;
    }
    else{            
        return true;
    }
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
$.validator.addMethod(
            "validate_file_w",
            function(val,elem) {
                var w=0;
                if(jQuery("#width_gallery_img").val()){
                    var width_img_arr=jQuery("#width_gallery_img").val().split(',');
                    console.log(width_img_arr);
                    jQuery.each(width_img_arr,function(i,v){
                        if(v<700){
                            w++;
                        }
                    });
                }
                if(w>0){
                    return false;
                } else {
                    return true;
                }
                
            },
            "File Width must be greater than 700"
    );
$.validator.addMethod(
            "validate_file_h",
            function(val,elem) {
                var h=0;
                if(jQuery("#height_gallery_img").val()){
                    var height_img_arr=jQuery("#height_gallery_img").val().split(',');
                    console.log(height_img_arr);
                    jQuery.each(height_img_arr,function(i,v){
                        if(v<300){
                            h++;
                        }
                    });
                }
                if(h>0){
                    return false;
                } else {
                    return true;
                }
                
            },
            "File Height must be greater than 300"
    );
jQuery.validator.addMethod("tour_description_validate", function(value, element) {
    // return true - means the field passed validation
    // return false - means the field failed validation and it triggers the error

    if(jQuery('[name="tour_description"]').summernote('isEmpty')) {
        return false;
    } else if(jQuery('[name="tour_description"]').summernote('code') == '' || jQuery('[name="tour_description"]').summernote('code') == '<p><br></p>') {
        return false;
    } else {
        return true;
    }
}, "This field is required.");
jQuery.validator.addMethod("tour_included_validate", function(value, element) {
    // return true - means the field passed validation
    // return false - means the field failed validation and it triggers the error

     if(jQuery('[name="tour_included"]').summernote('isEmpty')) {
            
            return false;
       } 
       else if(jQuery('[name="tour_included"]').summernote('code') == '' || jQuery('[name="tour_included"]').summernote('code') == '<p><br></p>') {
           return false;
       } 
       else {
            return true;            
       }
}, "This field is required.");
jQuery.validator.addMethod("tour_cancellation_policy_validate", function(value, element) {
    // return true - means the field passed validation
    // return false - means the field failed validation and it triggers the error

     if(jQuery('[name="tour_cancellation_policy"]').summernote('isEmpty')) {                    
                        
            return false;
       } else if(jQuery('[name="tour_cancellation_policy"]').summernote('code') == '' || jQuery('[name="tour_cancellation_policy"]').summernote('code') == '<p><br></p>') {                     
            return false;
       } 
       else {
             return true;            
       }
}, "This field is required.");

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
                    //ignore: ".note-editable.panel-body",
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
                            noSpace:true,
                            tour_description_validate:true
                        },
                        // tour_included:{
                        //     //required:true,
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
                        //     //required:true,
                        //     noSpace:true,
                        //     tour_cancellation_policy_validate:true
                        // },
                        tour_featured_image:{
                            required:true, 
                            extension:"jpg,png,jpeg",
                            //filesize: 2097152
                            filesize: true
                        },
                        tour_banner_image:{
                            required:true, 
                            extension:"jpg,png,jpeg",
                            minImageHeight:true,
                            minImageWidth:true,
                            filesize: true
                        },
                        'tour_gallery_image[]':{
                            required:true, 
                            validate_file_type: true,
                            validate_file_size: true,
                            validate_file_w: true,
                            validate_file_h: true
                        },
                        duration:{
                            required:true,
                            noSpace:true,
                            number:true,
                            min:1,
                            max:99999
                            //maxlength:20
                        }
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
                             error.insertAfter( element.parent() );
                        } else {
                            error.insertAfter(element)
                        }
                    },
                    messages: {
                      tour_name:{
                        //required:"Please Enter Tour Name",
                        remote:"Tour Name Already Exists"
                      },
                      tour_unique_code:{
                        //required:"Please Enter Tour Unique Code",
                        remote:"Tour Unique Code Already Exists"
                      },
                      // tour_type:{
                      //   required:"Please Select Tour type",
                      // },
                      // tour_category:{
                      //   required:"Please Select Tour category",
                      // },
                      // duration:{
                      //   required:"Please Enter Duration",
                      // },
                      tour_featured_image:{
                        required:"Please Select Feature Image",
                        extension:'File type must be JPG, JPEG or PNG',
                        filesize:'File size must be less than 800 KB'
                       },
                       tour_banner_image:{
                        required:"Please Select Banner Image",
                        extension:'File type must be JPG, JPEG or PNG',
                        minImageHeight:'Min Height of image must be 530',
                        minImageWidth:'Min Width of image must be 1920',
                        filesize:'File size must be less than 800 KB'
                       },
                       duration:{
                        max:"Please Enter Valid length of Duration"
                       }
                    },
                    submitHandler: function (form) {

                        //jQuery("#btn_tour_submit").attr("disabled",true);
                        jQuery('.load-main').removeClass('hidden');
                        form.submit();
                    }
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

$('#tour_banner_image').on('change',function(){
    //jQuery('#tour_banner_image').attr('name', 'featured_image');
    element = $(this);
    var files = this.files;
    var _URL = window.URL || window.webkitURL;
    var image, file;
    image = new Image();
    image.src = _URL.createObjectURL(files[0]);
        image.onload = function() {
            element.attr('uploadWidth',this.width);
            element.attr('uploadHeigth',this.height);
        }
    jQuery(this).valid();
});

$('#tour_gallery_image').on('change',function(){
    
    jQuery("#width_gallery_img").val('');
    jQuery("#height_gallery_img").val('');
    element = $(this);
    var files = this.files;
    var width_img=[];
    var height_img=[];
    for(var i=0;i<=(files.length-1);i++){
        var _URL = window.URL || window.webkitURL;
        var image, file;
        image = new Image();
        image.src = _URL.createObjectURL(files[i]);
        image.onload = function() {
            //console.log(this.width);
            var wid=this.width;
            var hight=this.height;
            var w=jQuery("#width_gallery_img").val();
            var h=jQuery("#height_gallery_img").val();
            if(w!=""){
                var c=w.split(',');
                var d=[];
                c.push(wid);
                jQuery.each(c,function(i,v){
                    if(jQuery.inArray("v", d) != -1){

                    } else {
                        d.push(v);
                    }
                });
               

                jQuery("#width_gallery_img").val(d.join(','));
            } else {
                jQuery("#width_gallery_img").val(wid);
            }
            if(h!=""){
                var ch=h.split(',');
                var dh=[];
                ch.push(hight);
                jQuery.each(ch,function(i,v){
                    if(jQuery.inArray("v", dh) != -1){

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
            //element.attr('uploadHeigth',this.width);
        }
    }
    
    
    jQuery(this).valid();
});

jQuery('[name="tour_description"]')
        .summernote({
            height: 400,
            tabsize: 2,
            followingToolbar: true,
        }).on('summernote.change', function(customEvent, contents, $editable) {
            // Revalidate the content when its value is changed by Summernote
           // validation.revalidateField('summernote_description');
          
          // jQuery('[name="tour_description"]').val(jQuery('[name="tour_description"]').summernote('isEmpty') ? "" : contents);

           jQuery('[name="tour_description"]').valid();
        });
jQuery('[name="tour_included"]')
        .summernote({
            height: 400,
            tabsize: 2,
            followingToolbar: true,
            
        }).on('summernote.change', function(customEvent, contents, $editable) {
            jQuery('[name="tour_included"]').valid();
        });
       
jQuery('[name="tour_cancellation_policy"]')
        .summernote({
            height: 400,
            tabsize: 2,
            followingToolbar: true,
            
        }).on('summernote.change', function(customEvent, contents, $editable) {
            jQuery('[name="tour_cancellation_policy"]').valid();
        });
var custom_price;
jQuery("#tour_type").select2().change(function() {
    //console.log($("#tour_type").val());
    jQuery(this).valid();
    
    //delete custom_price;
    
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
                
                var variation_field='<legend class="scheduler-border"><strong>Variation Price</strong></legend>';
                //console.log(response.variation_list);
                var vv=0;
                jQuery(response.variation_list).each(function(i,v){
                    if((v.title.toLowerCase()).trim()=="enfants"){
                        variation_field+='<div class="col-md-2"><div class="form-group"><label  class="col-form-label label_text text-lg-right">'+v.title+'<small class="req text-danger">*</small></label><input type="number" id="basic_price'+i+'" class="form-control required" name="basic_price['+i+']" autocomplete="off" placeholder="Enter Price" min="0" ></div></div>';
                    } else {
                        variation_field+='<div class="col-md-2"><div class="form-group"><label  class="col-form-label label_text text-lg-right">'+v.title+'<small class="req text-danger">*</small></label><input type="number" id="basic_price'+i+'" class="form-control required" name="basic_price['+i+']" autocomplete="off" placeholder="Enter Price" min="1" ></div></div>';
                    }
                    
                     
                    vv++;
                    
                    if(vv % 6 == 0) { variation_field+='<div class="clearfix"></div>';}

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

jQuery("#tour_category").select2().change(function() {
                    //console.log($("#tour_type").val());
                    jQuery(this).valid();
                });

jQuery("#tour_featured_image").change(function(){
    $('#tour_featured_image').valid();
});

// jQuery('#tour_gallery_image').on('change', function() {
//     $('#tour_gallery_image').valid(); // <- force re-validation
// });
$.validator.addMethod(
            "check_date_exists",
            function(val,elem) {
                
                var c=jQuery(".tour_date").length;
                
                var k=0;
                var date_array=[];
               jQuery(".tour_date").each(function(ii,v){               
                
                    if(c>1 && v.value!=""){
                        date_array.push(v.value);
                    } 
               });
               var r=[];
               
               if(date_array.length){
                    $.each(date_array, function( index, value ) {
                         if(val==value){
                                r.push(value);
                            }
                    });
                }
               //alert(k);
               if(r.length==1 || r.length==0){
                    return true;
               } else {
                    return false;
               }
            },
            "Date already Selected"
    );
jQuery(document).on("change",".tour_date",function(){
    //console.log($('.tour_date').length);
    //$('.tour_date').each(function() {
        $(this).rules("add", 
            {
                required:true,
                check_date_exists: true
            });
                //$(this).valid();
    //});    
    $(this).valid();    
});

jQuery(document).on('click','#add_custom_price',function(){
    
    jQuery( ".bs_price" ).removeClass("hidden");
    jQuery( ".bs_price" ).append(custom_price);
    var d_cnt = c_cnt = 0 ;
    jQuery(".tour_date").each(function(i,v){
        $(this).attr("name","tour_date["+d_cnt+"]");
            d_cnt++;
    });
    jQuery(".custom_price_set").each(function(i,v){
        $(this).attr("name","custom_price["+c_cnt+"]");
            c_cnt++;
    });
    var expireDate = new Date();
    expireDate.setFullYear(expireDate.getFullYear() + 2);

    jQuery('.tour_datepicker').datepicker({
        format: 'yyyy-mm-dd',
        //startDate: '2016/08/19 10:00',
       // daysOfWeekDisabled: [1,2,3,4,5],
        startDate: new Date(),
        endDate: expireDate,
        //datesDisabled: ['2020-12-21'],
        autoclose: true,        
        //multidate: true
    });

});

jQuery(document).on('click','.remove_add_custom_price',function(){
    //var parentId = jQuery(this).closest("fieldset").parent('div').remove();

    var parentId = jQuery(this).parent().parent().parent('div').remove();
    if(jQuery(".cs_price").length==0){
        jQuery(".bs_price").addClass("hidden");
    } else {
        var d_cnt = c_cnt = 0 ;
        jQuery(".tour_date").each(function(i,v){
            $(this).attr("name","tour_date["+d_cnt+"]");
                d_cnt++;
        });
        jQuery(".custom_price_set").each(function(i,v){
            $(this).attr("name","custom_price["+c_cnt+"]");
                c_cnt++;
        });
    }
});


jQuery(document).on('click','#add_restriction',function(){

    var tour_res_input=jQuery(".tour_res_input").length;
    var restriction_field='<div class="form-group"><div class="col-md-10"><input type="text" class="form-control required tour_res_input" name="tour_restrictions[]" autocomplete="off" placeholder="Tour Restrictions"></div><div class="col-md-2"><button name="remove_restriction" type="button" class="btn btn-primary remove_restriction">Remove</button></div></div>';

    jQuery( ".tour_restrictions" ).append(restriction_field);
    var d_cnt = 0 ;
    jQuery(".tour_res_input").each(function(i,v){
        $(this).attr("name","tour_restrictions["+d_cnt+"]");
            d_cnt++;
    });
    
});

jQuery(document).on('click','.remove_restriction',function(){
    //var parentId = jQuery(this).closest("fieldset").parent('div').remove();

    var parentId = jQuery(this).parent().parent('div').remove();
    
    var d_cnt = 0 ;
    jQuery(".tour_res_input").each(function(i,v){
        $(this).attr("name","tour_restrictions["+d_cnt+"]");
            d_cnt++;
    });
   
});

jQuery(document).on('click','#add_meeting_point',function(){

    var tour_meeting_input=jQuery(".tour_meeting_input").length;
    var tour_meeting_field='<div class="form-group"><div class="col-md-10"><input type="text" class="form-control required tour_meeting_input" name="tour_meeting_point[]" autocomplete="off" placeholder="Tour Meeting Point"></div><div class="col-md-2"><button name="remove_meeting_point" type="button" class="btn btn-primary remove_meeting_point">Remove</button></div></div>';

    jQuery( ".tour_meeting_point" ).append(tour_meeting_field);
    var d_cnt = 0 ;
    jQuery(".tour_meeting_input").each(function(i,v){
        $(this).attr("name","tour_meeting_point["+d_cnt+"]");
            d_cnt++;
    });
    
});

jQuery(document).on('click','.remove_meeting_point',function(){
    
    var parentId = jQuery(this).parent().parent('div').remove();
    
    var d_cnt = 0 ;
    jQuery(".tour_meeting_input").each(function(i,v){
        $(this).attr("name","tour_meeting_point["+d_cnt+"]");
            d_cnt++;
    });
   
});

jQuery(document).on('click','#add_faqs',function(){

    //var tour_meeting_input=jQuery(".tour_meeting_input").length;
    var faqs_field='<div class="m-div"><div class="form-group"> <label class="col-form-label label_text text-lg-right">Question<small class="req text-danger">*</small></label> <input type="text" class="form-control tour_faqs_input required" name="tour_faqs_question[]" autocomplete="off" placeholder="Question"></div><div class="form-group"> <label class="col-form-label label_text text-lg-right">Answer<small class="req text-danger">*</small></label><textarea rows="7" class="form-control resize_box required tour_faqs_output" name="tour_faqs_answer[]" placeholder="Answer"></textarea></div><div class="form-group"><button name="remove_faqs" type="button" class="btn btn-primary remove_faqs">Remove</button></div></div>';

    jQuery( ".tour_faqs" ).append(faqs_field);
    var d_cnt = 0 ;
    var c_cnt = 0 ;
    jQuery(".tour_faqs_input").each(function(i,v){
        $(this).attr("name","tour_faqs_question["+d_cnt+"]");
            d_cnt++;
    });
    jQuery(".tour_faqs_output").each(function(i,v){
        $(this).attr("name","tour_faqs_answer["+c_cnt+"]");
            c_cnt++;
    });
    
});

jQuery(document).on('click','.remove_faqs',function(){
    
    var parentId = jQuery(this).parent().parent('div').remove();
    
    var d_cnt = 0 ;
    var c_cnt = 0 ;
    jQuery(".tour_faqs_input").each(function(i,v){
        $(this).attr("name","tour_faqs_question["+d_cnt+"]");
            d_cnt++;
    });
    jQuery(".tour_faqs_output").each(function(i,v){
        $(this).attr("name","tour_faqs_answer["+c_cnt+"]");
            c_cnt++;
    });
   
});