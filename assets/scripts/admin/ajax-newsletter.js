jQuery(document).ready(function(){
    
    if(jQuery("#newsletter_list_table").length){
        
        $('#newsletter_list_table').DataTable({
            // Processing indicator
            "processing": true,
            // DataTables server-side processing mode
            "serverSide": true,
            // Initial no order.
            "order": [],
            "searching": true,
            
            // Load data from an Ajax source
            "ajax": {
                "url": BASE_URL+'newsletter/getLists/',
                "type": "POST"
            },
            "columns": [
                    // { data: 'RecordID', 'sortable': false,"orderable": false }, //0
                    { data: 'subject'} , //1
                    // { data: null,"orderable": false  },// 2
                    { data: 'action' }, // 3
            ],
            //Set column definition initialisation properties
            "columnDefs": [ 
                {
                 'targets': [1],
                 "width": "6%",
                 'title': 'Actions',
                 'searchable': false,
                 'orderable': false,
                 'className': 'dt-body-center',
                 'render': function (data, type, full, meta){
                    //var id = data.id;
                    return '<a href="'+BASE_URL+'newsletter/edit/'+data+'" data-popup="tooltip" data-placement="top"  title="edit" id="edit'+data+'" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="'+data+'"><i class=" icon-trash"></i></a>';
                 }
                },
                // {
                //  'targets': [2],
                //  'title': 'Status',
                //  'searchable': false,
                //  'orderable': false,
                //  'className': 'dt-body-center',
                //  'render': function (data, type, full, meta){
                //     if(data.status == 1){
                //         return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'+ btoa(data.id) +'" checked="checked"></label></div>';
                //     }else{
                //         return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'+btoa(data.id)+'" ></label></div>';
                //     }
                //  }
                // }       
            ]
        }); 
    }  

    if(jQuery("#error").val()) 
    {
        var error=jQuery("#error").val();
        jGrowlAlert(error, 'danger');
    }
    if(jQuery("#success").val()) 
    {
        var success=jQuery("#success").val();
        jGrowlAlert(success, 'success');
    }   
});

/**
 * Deletes a single record when clicked on delete icon
 *
 * @param {int}  id  The identifier
 */
function delete_record(obj) 
{ 
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
            url:BASE_URL+'newsletter/delete',
            type: 'POST',
            data: {
                newsletter_id:obj.id
            },
            dataType:'JSON',
            success: function(response)
            {
                jQuery(".load-main").addClass('hidden');
                if(response.success)
                {                        
                    $('#newsletter_list_table').DataTable().ajax.reload();     
                    jGrowlAlert(response.msg, 'success');
                }
                else
                {
                    jGrowlAlert(response.msg, 'danger');
                }  
            }
        });
    });
}

jQuery('[name="newsletter_content"]')
.summernote({
    height: 400,
    tabsize: 2,
    fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
    followingToolbar: true,
    disableResizeEditor: true,
    dialogsInBody: true,
    fontNamesIgnoreCheck: ['Montserrat'],
    toolbar: [
        // [groupName, [list of button]]
        ['style', ['style','bold', 'italic', 'underline', 'clear']],
        // ['style', ['bold', 'italic', 'underline', 'clear']],
        // ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['table', ['table']],
        ['para', ['ul', 'ol', 'paragraph']],
        //['height', ['height']],
        ['codeviewFilter', true],
        //['insert', ['picture', 'lvideo', 'link', 'hr']],
        ['insert', ['link', 'hr']],
        ['misc', ['fullscreen', 'codeview','help', 'undo', 'redo']]
      ],
      callbacks: {
                onPaste: function (e) {
                    if (document.queryCommandSupported("insertText")) {
                        var text = $(e.currentTarget).html();
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
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
    // Revalidate the content when its value is changed by Summernote
   // validation.revalidateField('summernote_description');
//    jQuery('[name="newsletter_content"]').valid();
// $("#newsletter_content").summernote('code')
//                .replace(/<\/p>/gi, "\n")
//                .replace(/<br\/?>/gi, "\n")
//                .replace(/<\/?[^>]+(>|$)/g, "");
});
jQuery('[name="newsletter_content_more"]')
.summernote({
    height: 400,
    tabsize: 2,
    fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
    followingToolbar: true,
    disableResizeEditor: true,
    dialogsInBody: true,
    fontNamesIgnoreCheck: ['Montserrat'],
    toolbar: [
        // [groupName, [list of button]]
        ['style', ['style','bold', 'italic', 'underline', 'clear']],
       // ['style', ['bold', 'italic', 'underline', 'clear']],
        // ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
         ['table', ['table']],
        ['para', ['ul', 'ol', 'paragraph']],
        //['height', ['height']],
        ['codeviewFilter', true],
        //['insert', ['picture', 'lvideo', 'link', 'hr']],
        ['insert', ['link', 'hr']],
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
    // Revalidate the content when its value is changed by Summernote
   // validation.revalidateField('summernote_description');
//    jQuery('[name="newsletter_content"]').valid();
// $("#newsletter_content_more").summernote('code')
//                .replace(/<\/p>/gi, "\n")
//                .replace(/<br\/?>/gi, "\n")
//                .replace(/<\/?[^>]+(>|$)/g, "");
});
//$('.note-editable').css('font-size','18px');
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
jQuery.validator.addMethod("newsletter_content_validate", function(value, element) {
    // return true - means the field passed validation
    // return false - means the field failed validation and it triggers the error

    if(jQuery('[name="newsletter_content"]').summernote('isEmpty')) {
        return false;
    } else if(jQuery('[name="newsletter_content"]').summernote('code') == '' || jQuery('[name="newsletter_content"]').summernote('code') == '<p><br></p>') {
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

jQuery.validator.addMethod("noSpace", function(value, element) { 
    if($.trim(value).length > 0){
        return true;
    } else {
        return false;
    }
}, "No space please and don't leave it empty");

jQuery.validator.addMethod("noHTML", function(value, element) {
    return this.optional(element) || /^([a-zA-Z0-9 \r\n_&?=(){},.|*+-]+)$/.test(value);
}, "Special Characters not allowed!");

jQuery("#addNewsletterContent").validate({
    errorElement: 'span',
    rules:{
        newsletter_subject: {
            required:true,
            noSpace:true,
            noHTMLtags:true,
            maxlength:100,
            remote: {
                url: BASE_URL+"newsletter/isNewsletterTitleExists",
                type: "POST"
            }
        },
        tour_image1:{
           required:true,
           extension:"jpg,png,jpeg",
           //filesize: 2097152
            filesize: true
        }
    },
    // errorPlacement: function (error, element) {
    //     error.insertAfter(element);
    // },
    messages: {
        newsletter_subject: {
            remote:"Newsletter subject already exists"
        },
        tour_image1:{
            extension:'File type must be JPG, JPEG or PNG',
            filesize:'File size must be less than 800 KB'
       }
    },
    submitHandler:function(form){
        jQuery('.load-main').removeClass('hidden');
        form.submit(); 
    }
});
jQuery("#editNewsletterContent").validate({
    errorElement: 'span',
    rules:{
        newsletter_subject: {
            required:true,
            noSpace:true,
            noHTMLtags:true,
            maxlength:100,
            remote: {
                url: BASE_URL+"newsletter/isNewsletterTitleExists",
                type: "POST",
                data: {
                    newsletter_id: function() {
                        return $('#newsletter_id').val();
                    },
                }
            }
        },
    },
    messages: {
        newsletter_subject: {
            remote:"Newsletter subject already exists"
        },
    },
    submitHandler:function(form){
        jQuery('.load-main').removeClass('hidden');
        form.submit(); 
    }
});

$('#tour_image2').on('change',function(){
    if($("#editNewsletterContent").length) {
        var formID = 'editNewsletterContent';
    }else{
        var formID = 'addNewsletterContent';
    }
    $("#" + formID).validate();
    
    if($(this).val()) {
    
        $("#tour_image2").rules("add", {
            //required:true,
            extension:"jpg,png,jpeg",
            filesize: true,
            //feature_image_minImageWidth:true,
            //feature_image_minImageHeight:true,
            messages:{
                //required:"Please Select Feature Image",
                extension:'File type must be JPG, JPEG or PNG',
                filesize:'File size must be less than 800 KB',
                //feature_image_minImageWidth:'Min Width of image must be 500',
                //feature_image_minImageHeight:'Min Height of image must be 400'
        }});
    } else {
       //$("#tour_image2_url").rules('remove', 'required');
       //jQuery("#tour_image2_url").valid();
       $("#tour_image2").rules("remove");
    }

    jQuery(this).valid();
});
$('#tour_image1').on('change',function(){    
    if(!$('#first_tour_img_show').length){
        $("#tour_image1").rules("add", {
            required:true,
            extension:"jpg,png,jpeg",
            filesize: true,
            //feature_image_minImageWidth:true,
            //feature_image_minImageHeight:true,
            messages:{
                //required:"Please Select Feature Image",
                extension:'File type must be JPG, JPEG or PNG',
                filesize:'File size must be less than 800 KB',
                //feature_image_minImageWidth:'Min Width of image must be 500',
                //feature_image_minImageHeight:'Min Height of image must be 400'
        }});   
    }
    // $('#tour_image1').valid();  
});

jQuery(document).on('click','#preview_newsletter',function(){
    if($("#editNewsletterContent").length) {
        var formID = 'editNewsletterContent';
    }else{
        var formID = 'addNewsletterContent';
    }
    if($("#" + formID).valid()) {
        var ajaxSubmit=BASE_URL+'newsletter/preview_newsletter';
        var form1 = $('#' + formID)[0];
        var formData = new FormData(form1);
        if($('#first_tour_img_show').length){  
            var parts = $('#first_tour_img_show img').attr('src').split("/");            
            formData.append('tour_img_1', parts[parts.length - 1]);
        }
        if($('#second_tour_img_show').length){
            var parts = $('#second_tour_img_show img').attr('src').split("/");            
            formData.append('tour_img_2', parts[parts.length - 1]);
        }
        jQuery.ajax({
            url: ajaxSubmit,
            type: 'POST',
            data:formData,
            dataType:'JSON',
            contentType: false,
            processData: false,
            success: function(response) {
                    if(response.success == false) {
                        
                      jQuery("#error_msg_newsletter").html(response.error_msg);
                      //jQuery("#error_msg").show();
                      jQuery("#error_msg_newsletter").removeClass('hidden');

                      setTimeout(function(){

                        jQuery("#error_msg_newsletter").addClass('hidden');
                        jQuery("#error_msg_newsletter").html("");
                             
                        }, 10000);
                      
                    } else if(response.success == true) {

                        var x = window.open('', '', 'location=no,toolbar=0');
                        //var html = "<p style='color:blue'>vvv</p>";
                        x.document.body.innerHTML = response.message;                                  
                    }
            }
        });
    }
});

jQuery("#reset_newsletter").click(function(){
    if($("#editNewsletterContent").length) {
        var formID = 'editNewsletterContent';
    }else{
        var formID = 'addNewsletterContent';
    }
    var validator = $("#" + formID).validate();
    validator.resetForm();

    $('#newsletter_content').summernote('reset');
    $('#newsletter_content_more').summernote('reset');
});

jQuery(document).on('click','#delete_first_tour_img',function(){
    var newsletter_id=jQuery(this).data('id');
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
            url:BASE_URL+'newsletter/delete_attachment',
            type: 'POST',
            data: {
                newsletter_id:newsletter_id
            },
            dataType:'JSON',
            success: function(response)
            {
                jQuery(".load-main").addClass('hidden');
                if(response.success)
                {                               
                    jQuery('#first_tour_img_show').remove();   
                    jQuery('#tour_image1').change();
                    jQuery('#tour_image1').val('');
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
jQuery(document).on('click','#delete_second_tour_img',function(){
    var newsletter_id=jQuery(this).data('id');
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
            url:BASE_URL+'newsletter/delete_second_attachment',
            type: 'POST',
            data: {
                newsletter_id:newsletter_id
            },
            dataType:'JSON',
            success: function(response)
            {
                jQuery(".load-main").addClass('hidden');
                if(response.success)
                {                        
                    jQuery('#second_tour_img_show').remove();   
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