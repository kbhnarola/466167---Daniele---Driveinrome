$(document).ready(function(){

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

    fetch_data();

});

function fetch_data()

{

    var usersDataTable = $('#blog_list_table').DataTable({

        // Processing indicator

        "processing": true,

        // DataTables server-side processing mode

        "serverSide": true,

        // Initial no order.

        "order": [],

        "searching": true,

        //"scrollY": 200,

        //"scrollX": 200,



        // Load data from an Ajax source

        "ajax": {

            "url": BASE_URL+'blogs/getLists/',

            "type": "POST",

            // 'data': function(data){

            //     // Read values

            //     var dropdown1 = $('#dropdown1').val();



            //     // Append to data

            //     data.tag = dropdown1;

            // }

        },

        "columns": [

                { data: 'RecordID', 'sortable': false,"orderable": false }, //0

                { data: 'title' } , //1

                { data: 'categories' } , //2

                { data: null,"orderable": false  },// 3

                { data: 'created_at' } , //4

                { data: 'action' } , //5

        ],

        "columnDefs": [ 

            {

                'targets': [5],

                'title': 'Actions',

                'searchable': false,

                'orderable': false,

                'className': 'dt-body-center',

                'render': function (data, type, full, meta){

                    //var id = data.id;

                    return '<a href="'+BASE_URL+'blogs/edit/'+data+'" data-popup="tooltip" data-placement="top"  title="edit" onclick="remove_tag(this)" id="'+data+'" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="'+data+'"><i class=" icon-trash"></i></a>';

                }

            },

            {

                'targets': [3],

                'title': 'Status',

                'searchable': false,

                'orderable': false,

                'className': 'dt-body-center',

                'render': function (data, type, full, meta){

                    if(data.status == 1){

                        return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'+ btoa(data.id) +'" checked="checked"></label></div>';

                    }else{

                        return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'+btoa(data.id)+'" ></label></div>';

                    }

                }

            },

        ],

        //fixedColumns: true

    });

}







/**

 * Change status when clicked on the status switch

 *

 * @param int  status  

 * @param int  user_id

 */

function change_status(obj)

{

    var checked = 0;



    if(obj.checked) 

    { 

        checked = 1;

    }  

    $('.jGrowl-notification').trigger('jGrowl.close');

    jQuery.ajax({

        url:BASE_URL+'users/update_status',

        type: 'POST',

        data: {

            user_id: obj.id,

            is_subscribe:checked

        },

        dataType:'JSON',

        success: function(response) 

        {

            //$('.jGrowl-notification').trigger('jGrowl.close');

            if(response.success){

                if (response.msg=='true')

                {       

                    jGrowlAlert(response.alert_msg, 'success');

                }

                else

                {                  

                    jGrowlAlert(response.alert_msg, 'success');

                }

            } else {

                jGrowlAlert(response.msg, 'danger');

            }

        }

    }); 

}

$('#blog_categories').select2({placeholder: "Select blog category"});

jQuery('[name="blog_content"]')

.summernote({

    height: 400,

    tabsize: 2,

    fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],

    followingToolbar: true,

    //codeviewFilter: true,

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

        ['insert', ['picture', 'lvideo', 'link', 'hr']],

        ['misc', ['fullscreen', 'codeview','help', 'undo', 'redo']]

      ]

})

.on('summernote.change', function(customEvent, contents, $editable) {

    // Revalidate the content when its value is changed by Summernote

   // validation.revalidateField('summernote_description');

   jQuery('[name="transfer_email_description"]').valid();

});

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



$.validator.addMethod('feature_image_minImageHeight', function(value, element, minWidth) {

    if(jQuery('#'+element.id).attr('uploadheight')<700){ 

        return false;

    }

    else{            

        return true;

    }

});

$.validator.addMethod('banner_image_minImageHeight', function(value, element, minWidth) {

    if(jQuery('#'+element.id).attr('uploadheight')<500){ 

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

$.validator.addMethod('banner_image_minImageWidth', function(value, element, minWidth) {

    console.log(jQuery('#'+element.id).attr('uploadwidth'));

    if(jQuery('#'+element.id).attr('uploadwidth')<1900){ 

        return false;

    }

    else{            

        return true;

    }

});



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

$.validator.addMethod('bannerfilesize', function(value, element, param) {

    // param = size (en bytes) 

    // element = element to validate (<input>)

    // value = value of the element (file name)

    var iSize = ($('#'+element.id)[0].files[0].size / 1024); 

    iSize = (Math.round(iSize * 100) / 100);    

   

    if (iSize > 1000) {

        //alert('File size exceeds 2 MB');

        return false;

    } else {

        return true

    }

    //return this.optional(element) || (element.files[0].size <= param) 

});



jQuery.validator.addMethod("blog_content_validate", function(value, element) {

    // return true - means the field passed validation

    // return false - means the field failed validation and it triggers the error



    if(jQuery('[name="blog_content"]').summernote('isEmpty')) {

        return false;

    } else if(jQuery('[name="blog_content"]').summernote('code') == '' || jQuery('[name="blog_content"]').summernote('code') == '<p><br></p>') {

        return false;

    } else {

        return true;

    }

}, "Please enter blog content");

jQuery.validator.addMethod("noHTMLtags", function(value, element){

    if(this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)){

        return false;

    } else {

        return true;

    }

}, "HTML tags are Not allowed.");

// validate add blog category form

jQuery("#addBlogform").validate({

    errorElement: 'span',

    rules:{

       //ignore: [],

        

        //tour_type: 'required',

        blog_title:{

            required:true,

            noSpace:true,

            noHTMLtags:true,

            remote: {

                url: BASE_URL+"blogs/isBlogExists",

                type: "POST",

                data: {

                    record_id: function() {

                        return $('#blog_id').val();

                    },

                }

            },

            maxlength:60

        },

        'blog_categories[]': {

            required:true,

        },

        feature_image:{

            required:true, 

            extension:"jpg,png,jpeg",

            //filesize: 2097152

            filesize: true,

            feature_image_minImageWidth:true,

            feature_image_minImageHeight:true                            

        }, 

        banner_image:{

            required:true, 

            extension:"jpg,png,jpeg",

            //filesize: 2097152

            bannerfilesize: true,

            banner_image_minImageWidth:true,

            banner_image_minImageHeight:true                            

        }, 

        blog_content: {

            required:true,

            noSpace:true,

            blog_content_validate:true

        }

    },

    messages: {

        blog_title:{

            required:"Please Enter Blog Category",

            remote:"Blog already exist with this name"

        },

        'blog_categories[]':{

            required:"Please Select Blog Category",

        },

        feature_image:{

            required:"Please Select Feature Image",

            extension:'File type must be JPG, JPEG or PNG',

            filesize:'File size must be less than 800 KB',

            feature_image_minImageHeight:'Min Height of image must be 700',

            feature_image_minImageWidth:'Min Width of image must be 1000'

        },

        banner_image:{

            required:"Please Select Feature Image",

            extension:'File type must be JPG, JPEG or PNG',

            bannerfilesize:'File size must be less than 1 MB',

            banner_image_minImageHeight:'Min Height of image must be 500',

            banner_image_minImageWidth:'Min Width of image must be 1900'

        },

        blog_content:{

            required: "Please enter blog content",

            blog_content_validate: "Please enter blog content"

        }

    },

    errorPlacement: function(error, element) {

        if (element.attr("name") == "blog_content")

            error.insertAfter(".blog-cont-wrap");         

        else if (element.attr("name") == "blog_categories[]")

            error.appendTo("#blog_categories_err");         

        else

            error.insertAfter(element); 

    },    

    submitHandler:function(form){

        jQuery('.load-main').removeClass('hidden');

        form.submit();

    }

});

// validate edit blog category form

jQuery("#editBlogform").validate({

    errorElement: 'span',

    rules:{

        blog_title:{

            required:true,

            noSpace:true,

            noHTMLtags:true,

            remote: {

                url: BASE_URL+"blogs/isBlogExists",

                type: "POST",

                data: {

                    record_id: function() {

                        return $('#blog_id').val();

                    },

                }

            },

            maxlength:60

        },

        'blog_categories[]': {

            required:true,

        },

        blog_content: {

            required:true,

            noSpace:true,

            blog_content_validate:true

        }

    },

    messages: {

        blog_title:{

            required:"Please Enter Blog Category",

            remote:"Blog already exist with this name"

        },

        'blog_categories[]':{

            required:"Please Select Blog Category",

        },

        blog_content:{

            required: "Please enter blog content",

            blog_content_validate: "Please enter blog content"

        }

    },

    errorPlacement: function(error, element) {

        if (element.attr("name") == "blog_content")

            error.insertAfter(".blog-cont-wrap");         

        else if (element.attr("name") == "blog_categories[]")

            error.appendTo("#blog_categories_err");         

        else

            error.insertAfter(element); 

    },    

    submitHandler:function(form){

        jQuery('.load-main').removeClass('hidden');

        form.submit();

    }

});



jQuery(document).ready(function(){

    

    if(jQuery("#feature_img").val()==""){

        $("#editBlogform").validate();

        $("#feature_image").rules("add", {

            required:true,

            messages:{

                required:"Please Select Feature Image",

            }

        });

    }

    if(jQuery("#banner_img").val()==""){

        $("#editBlogform").validate();

        $("#banner_image").rules("add", {

            required:true,

            messages:{

                required:"Please Select Banner Image",

            }

        });

    }



});



jQuery('#feature_image').on('change',function(){

    

    element = $(this);

    var files = this.files;

    var _URL = window.URL || window.webkitURL;

    var image, file;

    image = new Image();

    image.src = _URL.createObjectURL(files[0]);

        image.onload = function() {

            element.attr('uploadwidth',this.width);

            element.attr('uploadheigth',this.height);

        }

    jQuery(this).valid();

});

jQuery('#banner_image').on('change',function(){

    

    element = $(this);

    var files = this.files;

    var _URL = window.URL || window.webkitURL;

    var image, file;

    image = new Image();

    image.src = _URL.createObjectURL(files[0]);

        image.onload = function() {

            element.attr('uploadwidth',this.width);

            element.attr('uploadheigth',this.height);

        }

    jQuery(this).valid();

});



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

        feature_image_minImageHeight:true,

        feature_image_minImageWidth:true,

        messages:{

            required:"Please Select Feature Image",

            extension:'File type must be JPG, JPEG or PNG',

            filesize:'File size must be less than 800 KB',

            feature_image_minImageHeight:'Min Height of image must be 700',

            feature_image_minImageWidth:'Min Width of image must be 1000'            

    }});

    $('#feature_image').valid();

});

jQuery("#banner_image").change(function(){



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

    $("#banner_image").rules("add", {

        extension:"jpg,png,jpeg",

        filesize: true,

        banner_image_minImageHeight:true,

        banner_image_minImageWidth:true,

        messages:{

            required:"Please Select Feature Image",

            extension:'File type must be JPG, JPEG or PNG',

            bannerfilesize:'File size must be less than 1 MB',

            banner_image_minImageHeight:'Min Height of image must be 500',

            banner_image_minImageWidth:'Min Width of image must be 1900'

    }});

    $('#banner_image').valid();

});





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

        jQuery('.load-main').removeClass('hidden');

        $.ajax({

            url:BASE_URL+'blogs/delete',

            type: 'POST',

            data: {

                blog_id:obj.id

            },

            dataType:'JSON',

            success: function(response)

            {

                jQuery('.load-main').addClass('hidden');

                if(response.success)

                {                        

                    $('#blog_list_table').DataTable().ajax.reload();     

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



function change_status(obj)

{

    var checked = 0;



    if(obj.checked) 

    { 

        checked = 1;

    }  

    $('.jGrowl-notification').trigger('jGrowl.close');

    jQuery.ajax({

        url:BASE_URL+'blogs/update_status',

        type: 'POST',

        data: {

            blog_id: obj.id,

            is_active:checked

        },

        dataType:'JSON',

        success: function(response) 

        {

            //$('.jGrowl-notification').trigger('jGrowl.close');

            if(response.success){

                if (response.msg=='true')

                {       

                    jGrowlAlert(response.alert_msg, 'success');

                }

                else

                {                  

                    jGrowlAlert(response.alert_msg, 'success');

                }

            } else {

                jGrowlAlert(response.msg, 'danger');

            }

        }

    }); 

}

