jQuery('.addtourcategories').click(function () {

    jQuery('#error_msg').html('');

    //jQuery('#tour_type').val('').trigger('change');

    //jQuery('#tour_type-error').hide();

    jQuery('#tour_category-error').hide();

    //jQuery('#featured_image1-error').hide();

    //jQuery('#featured_image-error').hide();

    var validator = $("#addTourCategoryform").validate();

    validator.resetForm();

    jQuery('#tour_category_id').val('');

    jQuery('.addModalTitle').removeClass('hidden');

    jQuery('.editModalTitle').addClass('hidden');

    jQuery('#view_feature_img').addClass('hidden');

    jQuery("#addTourCategoryform")[0].reset();

});



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

    return this.optional(element) || /^([a-zA-Z0-9 _&?=(){},.|*+-]+)$/.test(value);

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



    // var file = $('#'+element.id)[0].files[0];



    // var image = new Image();

    // image.src = window.URL.createObjectURL( file );

    // var c=0;

    // image.onload = function () {

    //                 var width = this.width;



    //                 if (width < 1920) {



    //                     c++;//return false;

    //                 }                  

    //             };

    // if(c>0){

    //     return false;

    // } else {

    //     return true;

    // }

});



$.validator.addMethod('minThumbImageHeight', function (value, element, minWidth) {

    if (jQuery('#' + element.id).attr('uploadheight') < 250) {

        return false;

    }

    else {

        return true;

    }

});



$.validator.addMethod('minThumbImageWidth', function (value, element, minWidth) {

    if (jQuery('#' + element.id).attr('uploadwidth') < 450) {

        return false;

    }

    else {

        return true;

    }

});



jQuery("#addTourCategoryform").validate({

    errorElement: 'span',

    rules: {

        //ignore: [],



        //tour_type: 'required',

        tour_category: {

            required: true,

            noSpace: true,

            noHTML: true,

            remote: {

                url: BASE_URL + "tour_categories/isCategoryExists",

                type: "POST",

                data: {

                    record_id: function () {

                        return $('#tour_category_id').val();

                    },

                }

            },

            maxlength: 40

        },

        featured_image: {

            required: true,

            extension: "jpg,png,jpeg",

            filesize: true,

            minImageWidth: true,

            minImageHeight: true

        },

        city_image: {

            extension: "jpg,png,jpeg",

            // filesize: true,

            minThumbImageWidth: true,

            minThumbImageHeight: true

        }

    },

    messages: {

        tour_category: {

            required: "Please Enter City",

            remote: "City Name already exist"

        },

        featured_image: {

            required: "Please Select Feature Image",

            extension: 'File type must be JPG, JPEG or PNG',

            filesize: 'File size must be less than 800 KB',

            minImageWidth: 'Min Width of image must be 1920',

            minImageHeight: 'Min Height of image must be 530'

        },

        city_image: {

            required: "Please Select Feature Image",

            extension: 'File type must be JPG, JPEG or PNG',

            filesize: 'File size must be less than 800 KB',

            minThumbImageWidth: 'Min Width of image must be 450',

            minThumbImageHeight: 'Min Height of image must be 250'

        }

    },

    submitHandler: function (form) {



        if (jQuery('#tour_category_id').val()) {

            var ajaxSubmit = BASE_URL + "tour_categories/edit";

        } else {

            var ajaxSubmit = BASE_URL + "tour_categories/add"

        }

        var form1 = $('#addTourCategoryform')[0];

        var formData = new FormData(form1);

        jQuery.ajax({

            url: ajaxSubmit,

            type: 'POST',

            data: formData,

            dataType: 'JSON',

            contentType: false,

            processData: false,

            beforeSend: function () {

                jQuery("#addTourCategoryform").hide();

                jQuery("#loader_cont").removeClass('hidden');

            },

            success: function (response) {



                jQuery("#addTourCategoryform").show();

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



                    jQuery("#addTourCategoryform")[0].reset();

                    $('#add_tour_category_modal').modal('hide');



                    $('#tour_category_list_table').DataTable().ajax.reload();

                    jGrowlAlert(response.msg, 'success');



                }

            }

        });

    }

});



$('#featured_image').on('change', function () {

    jQuery('#featured_image').attr('name', 'featured_image');

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

    jQuery(this).valid();

});

$('#city_image').on('change', function () {

    jQuery('#city_image').attr('name', 'city_image');

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

    jQuery(this).valid();

});



$(document).ready(function () {



    //jQuery("#tour_type").select2();

    $('#tour_category_list_table').DataTable({

        // Processing indicator

        "processing": true,

        // DataTables server-side processing mode

        "serverSide": true,

        // Initial no order.

        "order": [],

        "searching": true,



        // Load data from an Ajax source

        "ajax": {

            "url": BASE_URL + 'tour_categories/getLists/',

            "type": "POST",

            // columnsDef: [

            //             'RecordID', 'tour_categories', 'tour_type', 'status', 'action'],

        },

        "columns": [

            { data: 'RecordID', 'sortable': false, "orderable": false }, //0

            { data: 'tour_categories' }, //1

            //{ data: 'tour_type'} , //2

            { data: null, "orderable": false },// 2

            { data: 'action' }, // 3

        ],

        //Set column definition initialisation properties

        "columnDefs": [

            {

                'targets': [3],

                'title': 'Actions',

                'searchable': false,

                'orderable': false,

                'className': 'dt-body-center',

                'render': function (data, type, full, meta) {

                    //var id = data.id;

                    return '<a href="javascript:" data-popup="tooltip" data-placement="top"  title="edit" onclick="edit_record(this)" id="' + data + '" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="' + data + '"><i class=" icon-trash"></i></a>';

                }

            },

            {

                'targets': [2],

                'title': 'Status',

                'searchable': false,

                'orderable': false,

                'className': 'dt-body-center',

                'render': function (data, type, full, meta) {

                    if (data.status == 1) {

                        return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="' + btoa(data.id) + '" checked="checked"></label></div>';

                    } else {

                        return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="' + btoa(data.id) + '" ></label></div>';

                    }

                }

            }

        ]

    });





});



// $("#tour_type").select2().change(function() {

//     //console.log($("#tour_type").val());

//     $(this).valid();

// });



/**

 * Change status when clicked on the status switch

 *

 * @param int  status  

 * @param int  tour_category_id

 */

function change_status(obj) {

    var checked = 0;



    if (obj.checked) {

        checked = 1;

    }

    $('.jGrowl-notification').trigger('jGrowl.close');

    $.ajax({

        url: BASE_URL + 'tour_categories/update_status',

        type: 'POST',

        data: {

            tour_category_id: obj.id,

            is_active: checked

        },

        dataType: 'JSON',

        success: function (response) {



            if (response.success) {

                if (response.msg == 'true') {

                    jGrowlAlert(response.alert_msg, 'success');

                }

                else {

                    jGrowlAlert(response.alert_msg, 'success');

                }

            } else {

                jGrowlAlert(response.msg, 'danger');

            }

        }

    });

}



/**

 * Deletes a single record when clicked on delete icon

 *

 * @param {int}  id  The identifier

 */

function delete_record(obj) {



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

                url: BASE_URL + 'tour_categories/delete',

                type: 'POST',

                data: {

                    tour_category_id: obj.id

                },

                dataType: 'JSON',

                success: function (response) {

                    jQuery('.load-main').addClass('hidden');

                    if (response.success) {

                        $('#tour_category_list_table').DataTable().ajax.reload();

                        jGrowlAlert(response.msg, 'success');

                    }

                    else {

                        jGrowlAlert(response.msg, 'danger');

                    }

                }

            });

        });

}



/**

 * open edit modal

 *

 * @param int  quesion id  

 */



function edit_record(obj) {

    jQuery('.load-main').removeClass('hidden');

    $.ajax({

        url: BASE_URL + 'tour_categories/get_record_byID',

        type: 'POST',

        data: {

            tour_category_id: obj.id,

        },

        dataType: 'json',

        success: function (data) {

            jQuery('.load-main').addClass('hidden');

            if (data.id) {



                jQuery('#error_msg').html('');



                //jQuery('#tour_category-error').hide();

                var validator = $("#addTourCategoryform").validate();

                validator.resetForm();

                jQuery("#addTourCategoryform")[0].reset();



                jQuery('#tour_category_id').val(btoa(data.id));



                //$('#inputID').select2('data', {id: 100, a_key: 'Lorem Ipsum'});

                //jQuery('#tour_type').val(data.tour_type_id).trigger('change');

                jQuery("#tour_category").val(data.title);

                if (data.feature_image) {

                    jQuery("#view_feature_img").attr('href', SITE_URL + 'uploads/tour_city/' + data.feature_image);

                    jQuery('#view_feature_img').removeClass('hidden');

                }

                if (data.city_image) {

                    jQuery("#view_city_img").attr('href', SITE_URL + 'uploads/tour_city/' + data.city_image);

                    jQuery('#view_city_img').removeClass('hidden');

                }



                jQuery("#meta_title").val(data.meta_title);

                jQuery("#meta_keywords").val(data.meta_keywords);

                jQuery("#meta_description").val(data.meta_description);
                
                jQuery("#youtube_embed_video_url").val(data.youtube_embed_video_url);



                jQuery('.addModalTitle').addClass('hidden');

                jQuery('.editModalTitle').removeClass('hidden');



                jQuery('#featured_image').attr('name', 'featured_image1');

                //$('#featured_image').removeAttr('required');

                //$("#addTourCategoryform").validate().cancelSubmit = true;

                jQuery("#add_tour_category_modal").modal('show');

            } else {

                jGrowlAlert(data, 'danger');

            }

        }

    });

}