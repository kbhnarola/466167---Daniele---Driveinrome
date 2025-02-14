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

    return this.optional(element) || /^([a-zA-Z0-9 _&?=(){},.'|*+-\/]+)$/.test(value);
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
    if(jQuery('#'+element.id).attr('uploadheight')<350){ 
        return false;
    }
    else{            
        return true;
    }
});

$.validator.addMethod('minImageWidth', function(value, element, minWidth) {
    if(jQuery('#'+element.id).attr('uploadwidth')<550){ 
        return false;
    }
    else{            
        return true;
    }
});

jQuery.validator.addMethod("description_validate", function(value, element) {
    // return true - means the field passed validation
    // return false - means the field failed validation and it triggers the error

    if(jQuery('[name="description"]').summernote('isEmpty')) {
        return false;
    } else if(jQuery('[name="description"]').summernote('code') == '' || jQuery('[name="description"]').summernote('code') == '<p><br></p>') {
        return false;
    } else {
        return true;
    }
}, "This field is required.");

jQuery("#editTransferServiceform").validate({
                    errorElement: 'span',
                    rules:{
                        transfer_type: "required",
                        transfer_category:"required",
                        transfer_name:{
                            required:true,
                            noSpace:true,
                            noHTML:true,
                            remote: {
                                    url: BASE_URL+"transfers/isTransferServiceExists",
                                    type: "POST",
                                    data: {
                                        record_id: function() {
                                            return $('#transfer_id').val();
                                        },
                                    }
                                 },
                                maxlength:100
                            },
                        transfer_unique_code:{
                            required:true,
                            noSpace:true,
                            noHTML:true,
                            remote: {
                                        url: BASE_URL+"transfers/isTransferCodeExists",
                                        type: "POST",
                                        data: {
                                            record_id: function() {
                                                return $('#transfer_id').val();
                                            },
                                        }
                                     },
                            maxlength:20
                        },
                        duration:{
                            required:true,
                            noSpace:true,
                            number:true,
                            min:1,
                            max:99999
                            //maxlength:20
                        },
                        description:{
                            required:true, 
                            //description_validate:true,
                            maxlength:300  
                        }
                    },
                    errorPlacement: function (error, element) {
                        //console.log('dd', element.attr("name"))
                        if (element.attr("name") == "description") {
                            error.appendTo("#description_err");
                        } else if (element.attr("name") == "transfer_type") {
                            error.appendTo("#transfer_type_err");
                        } else if (element.attr("name") == "transfer_category") {
                            error.appendTo("#transfer_category_err");
                        } else {
                            error.insertAfter(element)
                        }
                    },
                    messages: {
                      transfer_name:{
                        //required:"Please Enter Tour Name",
                        remote:"Transfer Service Already Exists"
                      },
                     transfer_unique_code:{
                        //required:"Please Enter Tour Unique Code",
                        remote:"Transfer Service Unique Code Already Exists"
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


jQuery(document).ready(function(){

    jQuery("#transfer_type").select2();
    jQuery("#transfer_category").select2();
    
    if(jQuery("#feature_img").val()==""){
        $("#editTransferServiceform").validate();
        $("#feature_image").rules("add", {
                    required:true,
                    messages:{
                        required:"Please Select Feature Image",
                        }
                    });
    }

});

// jQuery('[name="description"]')
//         .summernote({
//             height: 300,
//             tabsize: 2,
//             followingToolbar: true,
            
//         }).on('summernote.change', function(customEvent, contents, $editable) {
//             jQuery('[name="description"]').valid();
//         });
        
jQuery("#feature_image").change(function(){

    element = $(this);
    var files = this.files;
    var _URL = window.URL || window.webkitURL;
    var image, file;
    image = new Image();
    image.src = _URL.createObjectURL(files[0]);
    image.onload = function() {
        element.attr('uploadwidth',this.width);
        element.attr('uploadheight',this.height);
    }
        
    $("#editTransferServiceform").validate();
    $("#feature_image").rules("add", {
        extension:"jpg,png,jpeg",
        filesize: true,
        minImageHeight:true,
        minImageWidth:true,
        messages:{
            //required:"Please Select Feature Image",
            extension:'File type must be JPG, JPEG or PNG',
            filesize:'File size must be less than 800 KB',
            minImageWidth:'Min Width of image must be 550',
            minImageHeight:'Min Height of image must be 350'            
    }});
    $('#feature_image').valid();
});

jQuery("#transfer_type").select2().change(function() {
    //console.log($("#tour_type").val());
    jQuery(this).valid();
    jQuery(".set_variation_price").addClass('hidden');
    jQuery(".transfer_basic_price").html('');
    jQuery.ajax({
        url:BASE_URL+'transfers/getTransferVariantion',
        type: 'POST',
        data: {
           transfer_type_id: jQuery(this).val(),
        },
        dataType:'JSON',
        success: function(response) 
        {
            if(response.success){
                
                var variation_field='';
                
                var vv=0;
                jQuery(response.variation_list).each(function(i,v){
                    
                    variation_field+='<div class="col-md-3"><div class="form-group"><label  class="col-form-label label_text text-lg-right">'+v.title+'<small class="req text-danger">*</small></label><input type="number" id="basic_price'+i+'" class="form-control required" name="basic_price['+i+']" autocomplete="off" placeholder="Enter Price" min="1"></div></div>';
                     
                    vv++;
                    
                    if(vv % 6 == 0) { variation_field+='<div class="clearfix"></div>';}

                });

                jQuery(".transfer_basic_price").html(variation_field);
                jQuery(".set_variation_price").removeClass('hidden');
                
            } else {
               // jGrowlAlert(response.msg, 'danger');
               console.log(response.msg);
            }
        }
    }); 
});

jQuery("#transfer_category").select2().change(function() {
    //console.log($("#tour_type").val());
    jQuery(this).valid();
});