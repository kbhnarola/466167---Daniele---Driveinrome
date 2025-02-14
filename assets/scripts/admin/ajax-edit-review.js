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
    if(jQuery('#'+element.id).attr('uploadheight')<530){ 
        return false;
    }
    else{            
        return true;
    }
});

$.validator.addMethod('minImageWidth', function(value, element, minWidth) {
    if(jQuery('#'+element.id).attr('uploadwidth')<1920){ 
        return false;
    }
    else{            
        return true;
    }
});

$.validator.addMethod('feature_image_minImageHeight', function(value, element, minWidth) {
    console.log(jQuery('#'+element.id).attr('uploadheight'));
    if(jQuery('#'+element.id).attr('uploadheight')<400){ 
        return false;
    }
    else{            
        return true;
    }
});

$.validator.addMethod('feature_image_minImageWidth', function(value, element, minWidth) {
    if(jQuery('#'+element.id).attr('uploadwidth')<1000){ 
        return false;
    }
    else{            
        return true;
    }
});

$.validator.addMethod(
            "validate_file_w",
            function(val,elem) {
                var w=0;
                if(jQuery("#width_gallery_img").val()){
                    var width_img_arr=jQuery("#width_gallery_img").val().split(',');
                  
                    jQuery.each(width_img_arr,function(i,v){
                        if(v<210){
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
            "File Width must be greater than 210"
    );
$.validator.addMethod(
            "validate_file_h",
            function(val,elem) {
                var h=0;
                if(jQuery("#height_gallery_img").val()){
                    var height_img_arr=jQuery("#height_gallery_img").val().split(',');
                   
                    jQuery.each(height_img_arr,function(i,v){
                        if(v<400){
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
            "File Height must be greater than 400"
    );
$.validator.addMethod(
            "validate_file_type",
            function(val,elem) {
                //console.log(elem.id);
                var files =  $('#'+elem.id)[0].files;
                
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
                var files = $('#'+elem.id)[0].files;
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
jQuery.validator.addMethod("review_description_validate", function(value, element) {
    // return true - means the field passed validation
    // return false - means the field failed validation and it triggers the error

    if(jQuery('[name="review_description"]').summernote('isEmpty')) {
        return false;
    } else if(jQuery('[name="review_description"]').summernote('code') == '' || jQuery('[name="review_description"]').summernote('code') == '<p><br></p>') {
        return false;
    } else {
        return true;
    }
}, "This field is required.");

jQuery.validator.addMethod("noHTMLtags", function(value, element){
    if(this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)){
        return false;
    } else {
        return true;
    }
}, "HTML tags are Not allowed.");

jQuery("#updateReviewform").validate({
                    //ignore: ".note-editable.panel-body",
                    errorElement: 'span',
                    rules:{
                        review_title: {
                            required:true,
                            noSpace:true,
                            //noHTML:true,
                            noHTMLtags: true,
                            remote: {
                                    url: BASE_URL+"reviews/isReviewTitleExistsEdit",
                                    type: "POST",
                                    data: {
                                        record_id: function() {
                                            return $('#review_id').val();
                                        },
                                    }
                            },
                            maxlength:200
                        },
                        username:{
                            required:true,
                            noSpace:true,
                            noHTML:true,
                            //noHTMLtags: true
                        },
                        tour_id:"required",
                        city:{
                            required:true,
                            noSpace:true,
                            noHTML:true,
                            maxlength:20
                        },
                        // country:"required",
                        // review_description:{
                        //     required:true,
                        //     noSpace:true,
                        //     tour_description_validate:true
                        // },
                        // feature_image:{
                        //     required:true, 
                        //     extension:"jpg,png,jpeg",
                        //     //filesize: 2097152
                        //     filesize: true,
                        //     //feature_image_minImageWidth:true,
                        //     //feature_image_minImageHeight:true                            
                        // },
                        // 'gallery_image[]':{
                        //     //required:true, 
                        //     validate_file_type: true,   
                        //     validate_file_size: true,                         
                        //     validate_file_w: true,
                        //     validate_file_h: true                            
                        // }
                    },
                    errorPlacement: function (error, element) {
                        //console.log('dd', element.attr("name"))
                        // if (element.attr("name") == "review_title") {
                        //     error.appendTo("#review_description_err");
                        // } else if (element.attr("name") == "country") {
                        //     error.appendTo("#country_err");
                        // } else if (element.attr("name") == "tour_id") {
                        //     error.appendTo("#tour_id_err");
                        // } else if (element.attr("name") == "user_id") {
                        //     error.appendTo("#user_id_err");
                        // } else if (element.parent().hasClass('input-group')) {
                        //     // error.appendTo(element.parent("div").next("div"));
                        //      error.insertAfter( element.parent() );
                        // } else {
                        //     error.insertAfter(element)
                        // }
                        if (element.attr("name") == "tour_id") {
                            error.appendTo("#tour_id_err");
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    messages: {
                      review_title:{
                        //required:"Please Enter Tour Name",
                        remote:"Title Already Exists"
                      },
                      // feature_image:{
                      //   //required:"Please Select Feature Image",
                      //   extension:'File type must be JPG, JPEG or PNG',
                      //   filesize:'File size must be less than 800 KB',
                      //   //feature_image_minImageHeight:'Min Height of image must be 700',
                      //   //feature_image_minImageWidth:'Min Width of image must be 1000'
                      //  }
                    },
                    submitHandler: function (form) {

                        //jQuery("#btn_tour_submit").attr("disabled",true);
                        jQuery('.load-main').removeClass('hidden');
                        form.submit();
                    }
                });
       


jQuery(document).ready(function(){
    
    jQuery("#tour_id").select2();
    var expireDate = new Date();
    //expireDate.setFullYear(expireDate.getFullYear() + 1);

    jQuery('.review_datepicker').datepicker({
        format: 'dd-mm-yyyy',
        //startDate: '2016/08/19 10:00',
       // daysOfWeekDisabled: [1,2,3,4,5],
        //startDate: new Date(),
        endDate: expireDate,
        todayHighlight: true,
        //showOnFocus: false, 
        //datesDisabled: ['2020-12-21'],
        autoclose: true,             
    });
   
});

$('#feature_image').on('change',function(){
    $("#updateReviewform").validate();
    $("#feature_image").rules("add", {
        //required:true,
        extension:"jpg,png,jpeg",
        filesize: true,
        //feature_image_minImageWidth:true,
        feature_image_minImageHeight:true,
        messages:{
            //required:"Please Select Feature Image",
            extension:'File type must be JPG, JPEG or PNG',
            filesize:'File size must be less than 800 KB',
            //feature_image_minImageWidth:'Min Width of image must be 500',
            feature_image_minImageHeight:'Min Height of image must be 400'
    }});
    
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

    jQuery(this).valid();
});

$('#gallery_image').on('change',function(){
    
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
        }
    }
    
     $("#updateReviewform").validate(); //sets up the validator

        $(this).rules("add", {
            validate_file_type: true,
            validate_file_size: true,
            //validate_file_w: true,
            validate_file_h: true
        });
    jQuery(this).valid();
});

jQuery('[name="review_description"]')
        .summernote({
            height: 400,
            tabsize: 2,
            fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
            followingToolbar: true,
            disableResizeEditor: true,
            toolbar: [
                ['style', ['style','bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['table', ['table']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['codeviewFilter', true],
                ['insert', ['picture', 'lvideo', 'link', 'hr']],
                ['misc', ['fullscreen', 'codeview','help', 'undo', 'redo']]
              ],
              callbacks: {
                onPaste: function (e) {
                    if (document.queryCommandSupported("insertText")) {
                        var text = $(e.currentTarget).html();
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                        setTimeout(function () {
                            document.execCommand('insertText', false, bufferText);
                        }, 10);
                        e.preventDefault();
                    } else { //IE
                        var text = window.clipboardData.getData("text")
                        if (trap) {
                            trap = false;
                        } else {
                            trap = true;
                            setTimeout(function () {
                                document.execCommand('paste', false, text);
                            }, 10);
                            e.preventDefault();
                        }
                    }
                }
            }
        }).on('summernote.change', function(customEvent, contents, $editable) {
           
           //jQuery('[name="review_description"]').valid();
        });


jQuery("#tour_id").select2().change(function() {
    jQuery(this).valid();
});

// jQuery(document).on('click','#reset_review',function(){
//     jQuery('#tour_id').val('').trigger('change');
//     $('#review_description').summernote('code', '');
//     var validator = $("#updateReviewform").validate();
//     validator.resetForm();
// });
jQuery(document).on('click','#delete_feature_img',function(){
    var review_id=jQuery(this).data('id');
    swal({
        title: jQuery("#swal_title").val(),
        text: jQuery("#swal_text").val(),
        type: "warning", 
        showCancelButton: true, 
        cancelButtonText: jQuery("#swal_cancelButtonText").val(),
        confirmButtonText: jQuery("#swal_confirmButtonText").val(),  
    },
    function()
    {
        jQuery(".load-main").removeClass('hidden');
        $.ajax({
            url:BASE_URL+'reviews/delete_attachment',
            type: 'POST',
            data: {
                review_id:review_id
            },
            dataType:'JSON',
            success: function(response)
            {
                jQuery(".load-main").addClass('hidden');
                if(response.success)
                {                        
                    jQuery('#feature_img_show').addClass('hidden');   
                    jGrowlAlert(response.msg, 'success');
                }
                else
                {
                    jGrowlAlert(response.msg, 'warning');
                }  
            }
        });
    });
});

jQuery(document).on('click','.remove_review_gallery_img',function(){
    var review_gallery_id=jQuery(this).data('id');
    swal({
        title: jQuery("#swal_title").val(),
        text: jQuery("#swal_text").val(),
        type: "warning", 
        showCancelButton: true, 
        cancelButtonText: jQuery("#swal_cancelButtonText").val(),
        confirmButtonText: jQuery("#swal_confirmButtonText").val(),  
    },
    function()
    {
        jQuery(".load-main").removeClass('hidden');
        $.ajax({
            url:BASE_URL+'reviews/delete_gallery_attachment',
            type: 'POST',
            data: {
                review_gallery_id:review_gallery_id
            },
            dataType:'JSON',
            success: function(response)
            {
                jQuery(".load-main").addClass('hidden');
                if(response.success)
                {                        
                    jQuery('#gallery_img_id'+atob(review_gallery_id)).hide();   
                    jGrowlAlert(response.msg, 'success');
                }
                else
                {
                    jGrowlAlert(response.msg, 'warning');
                }  
            }
        });
    });
});
