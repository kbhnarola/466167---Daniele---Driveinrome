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

jQuery.validator.addMethod("description_validate", function (value, element) {
    // return true - means the field passed validation
    // return false - means the field failed validation and it triggers the error

    if (jQuery('[name="description"]').summernote('isEmpty')) {
        return false;
    } else if (jQuery('[name="description"]').summernote('code') == '' || jQuery('[name="description"]').summernote('code') == '<p><br></p>') {
        return false;
    } else {
        return true;
    }
}, "This field is required.");

$.validator.addMethod('file_size', function (value, element, param) {
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
$.validator.addMethod('minImageWidth', function (value, element, minWidth) {
    if (jQuery('#' + element.id).attr('uploadwidth') < 500) {
        return false;
    }
    else {
        return true;
    }
});

$.validator.addMethod('minImageHeight', function (value, element, minWidth) {
    if (jQuery('#' + element.id).attr('uploadheigth') < 300) {
        return false;
    }
    else {
        return true;
    }
});
$.validator.addMethod("youtube", function (value, element) {
    //var p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
    var p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
    //var p = /^https?:\/\/(?:[a-zA_Z]{2,3}.)?(?:youtube\.com\/watch\?)((?:[\w\d\-\_\=]+&amp;(?:amp;)?)*v(?:&lt;[A-Z]+&gt;)?=([0-9a-zA-Z\-\_]+))/i;
    return (value.match(p)) ? RegExp.$1 : false;
}, "Enter correct URL");
$.validator.addMethod(
    "check_link_exists",
    function (val, elem) {

        var c = jQuery(".vd_links").length;

        var k = 0;
        var date_array = [];
        jQuery(".vd_links").each(function (ii, v) {

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
        //alert(k);
        if (r.length == 1 || r.length == 0) {
            return true;
        } else {
            return false;
        }
    },
    "Youtube Link already exists"
);
$.validator.addMethod('total_review_check', function (value, element) {
    var review_ids = jQuery("#review_ids").val();

    if (review_ids.length > 6) {
        return false;
    } else {
        return true;
    }
}, 'You can not select more than 6 review from list.');

$.validator.addMethod('promo_file_size', function (value, element, param) {

    //var iSize = ($('#'+element.id)[0].files[0].size / 1024); 
    //iSize = (Math.round(iSize * 100) / 100);    
    var iSize = Math.round($('#' + element.id)[0].files[0].size / (1024 * 1024));
    //var a=(this.files[0].size);

    //if (a > 2000000) {
    if (iSize > 2) {
        //alert('File size exceeds 2 MB');
        return false;
    } else {
        return true
    }

});

jQuery("#addCMSform").validate({
    errorElement: 'span',
    rules: {
        ignore: [],
        //tour_type: 'required',
        cms_page_title: {
            required: true,
            noSpace: true,
            noHTML: true,
            remote: {
                url: BASE_URL + "cms_pages/isCmsExists",
                type: "POST",
                data: {
                    record_id: function () {
                        return $('#cms_page_id').val();
                    },
                }
            },
            maxlength: 500
        },
        // promo_file: {
        //   require_from_group: [1, ".search_promo_group"],
        //   promo_file_size:true
        // },
        // promo_url: {
        //     require_from_group: [1, ".search_promo_group"]
        // },
        select_promo_opt: {
            required: true
        },
        // 'tour_id[]': {
        //     required: true
        // },
        'review_ids[]': {
            required: true,
            total_review_check: true
        },
        description: {
            required: true,
            noSpace: true,
            description_validate: true
        }
    },
    errorPlacement: function (error, element) {
        //console.log('dd', element.attr("name"))
        if (element.attr("name") == "description") {
            error.appendTo("#description_err");
        }
        else if (element.attr("name") == "tour_id[]") {
            error.appendTo("#tour_id_err");
        }
        else if (element.attr("name") == "review_ids[]") {
            error.appendTo("#review_id_err");
        } else if (element.attr("name") == "promo_file") {
            error.appendTo("#promo_file_err");
        } else if (element.attr("name") == "promo_url") {
            error.appendTo("#promo_url_err");
        } else if (element.attr("name") == "select_promo_opt") {
            error.appendTo("#select_promo_opt_err");
        } else {
            error.insertAfter(element)
        }
    },
    messages: {
        cms_page_title: {
            //required:"Please Enter City",
            remote: "Cms Page title already exist"
        },
        // promo_file: {
        //       promo_file_size:"File size must be less than 2 MB"
        //   }
    },
    // groups: {
    //     promo_file: "promo_file promo_url"
    // },
    submitHandler: function (form) {
        jQuery('.load-main').removeClass('hidden');
        form.submit();
    }
});

$(document).ready(function () {

    //jQuery("#transfer_type").select2();
    $('#cms_pages_list_table').DataTable({

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
            "url": BASE_URL + 'cms_pages/getLists/',
            "type": "POST"
        },
        "columns": [
            { data: 'RecordID', 'sortable': false, "orderable": false }, //0
            { data: 'title' }, //1
            //{ data: 'description',"orderable": false  },// 2
            { data: 'page_url', "orderable": false },// 2
            { data: null, "orderable": false },// 3
            { data: 'action' }, // 4
        ],
        //Set column definition initialisation properties
        "columnDefs": [
            {
                'targets': [2],
                'title': 'Page Url',
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta) {
                    return '<a href="' + data + '" class="" target="_blank">' + data + '</a>';
                }
            },
            {
                'targets': [3],
                'title': 'Status',
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta) {
                    if (data.id != 10) {
                        if (data.status == 1) {
                            return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="' + btoa(data.id) + '" checked="checked"></label></div>';
                        } else {
                            return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="' + btoa(data.id) + '" ></label></div>';
                        }
                    } else {
                        return "";
                    }
                }
            },
            {
                'targets': [4],
                'title': 'Actions',
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta) {
                    //var id = data.id;
                    //return '<a href="'+BASE_URL+'admin/cms_pages/edit/'+data+'" data-popup="tooltip" data-placement="top"  title="edit" id="edit'+data+'" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="'+data+'"><i class=" icon-trash"></i></a>';
                    if (full.parent_id != 0 || full.id == 12) {
                        if (full.id == 12) {
                            return '<a href="' + BASE_URL + 'cms_pages/edit/' + data + '" data-popup="tooltip" data-placement="top"  title="edit" id="edit' + data + '" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="Duplicate" href="javascript:" onclick="add_duplicate(' + full.id + ',' + full.parent_id + ')" class="text-primary duplicate" id="' + data + '" data-parent-id="' + full.parent_id + '"><i class="fa fa-clone" aria-hidden="true"></i></a>';
                        } else {
                            return '<a href="' + BASE_URL + 'cms_pages/edit/' + data + '" data-popup="tooltip" data-placement="top"  title="edit" id="edit' + data + '" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="Duplicate" href="javascript:" onclick="add_duplicate(' + full.id + ',' + full.parent_id + ')" class="text-primary duplicate" id="' + data + '" data-parent-id="' + full.parent_id + '"><i class="fa fa-clone" aria-hidden="true"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="' + data + '"><i class=" icon-trash"></i></a>';
                        }
                    } else {
                        return '<a href="' + BASE_URL + 'cms_pages/edit/' + data + '" data-popup="tooltip" data-placement="top"  title="edit" id="edit' + data + '" class="text-info"><i class="icon-pencil7"></i></a>';
                    }
                    //return '<a href="'+BASE_URL+'cms_pages/edit/'+data+'" data-popup="tooltip" data-placement="top"  title="edit" id="edit'+data+'" class="text-info"><i class="icon-pencil7"></i></a>';
                }
            }
        ],
        //fixedColumns: true
    });


    if (jQuery(".vd_links").length > 0) {
        var d_cnt = 0;
        jQuery(".vd_links").each(function (i, v) {
            $(this).attr("name", "video_links[" + d_cnt + "]");
            $("#addCMSform").validate();
            $('input[name="video_links[' + d_cnt + ']"]').rules("add", {
                required: true,
                youtube: true,
                check_link_exists: true
            });
            d_cnt++;
        });
    }
    if (jQuery("#error").val()) {
        var error = jQuery("#error").val();
        jGrowlAlert(error, 'danger');
    }
    if (jQuery("#success").val()) {
        var success = jQuery("#success").val();
        jGrowlAlert(success, 'success');
    }
    jQuery("#tour_id").select2();
    jQuery("#review_ids").select2({
        placeholder: "Select a review",
    });
});

if (jQuery("#description").length) {
    jQuery('[name="description"]')
        .summernote({
            height: 400,
            tabsize: 2,
            followingToolbar: true,
        }).on('summernote.change', function (customEvent, contents, $editable) {
            // Revalidate the content when its value is changed by Summernote
            // validation.revalidateField('summernote_description');

            jQuery('[name="description"]').valid();
        });
}

/**
 * Change status when clicked on the status switch
 *
 * @param int  status  
 * @param int  transfer_category_id
 */
function change_status(obj) {
    var checked = 0;

    if (obj.checked) {
        checked = 1;
    }
    $('.jGrowl-notification').trigger('jGrowl.close');
    $.ajax({
        url: BASE_URL + 'cms_pages/update_status',
        type: 'POST',
        data: {
            cms_page_id: obj.id,
            is_active: checked
        },
        dataType: 'JSON',
        success: function (response) {
            //$('.jGrowl-notification').trigger('jGrowl.close');
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
                url: BASE_URL + 'cms_pages/delete',
                type: 'POST',
                data: {
                    cms_page_id: obj.id
                },
                dataType: 'JSON',
                success: function (response) {
                    jQuery('.load-main').addClass('hidden');
                    if (response.success) {
                        $('#cms_pages_list_table').DataTable().ajax.reload();
                        jGrowlAlert(response.msg, 'success');
                    }
                    else {
                        jGrowlAlert(response.msg, 'danger');
                    }
                }
            });
        });
}



jQuery(document).on('click', '#add_video_link', function () {

    var video_links = jQuery(".vd_links").length;
    var links_field = '<div class="form-group"><div class="row"><div class="col-md-3"><input type="text" class="form-control required vd_links" name="video_links[]" autocomplete="off" placeholder="Youtube Link"></div><div class="col-md-3"><input type="file" class="form-control required links_feature_img" name="feature_image[]" autocomplete="off" placeholder="Feature image" value=""></div><div class="col-md-3"><input type="text" class="form-control required links_title" name="link_title[]" autocomplete="off" placeholder="Title" value=""></div><div class="col-md-3"><button name="remove_links" type="button" class="btn btn-primary remove_links">Remove</button></div></div></div>';

    jQuery(".video_links").append(links_field);
    var d_cnt = 0;
    jQuery(".vd_links").each(function (i, v) {
        $(this).attr("name", "video_links[" + d_cnt + "]");
        $("#addCMSform").validate();
        $('input[name="video_links[' + d_cnt + ']"]').rules("add", {
            required: true,
            youtube: true,
            check_link_exists: true
        });
        d_cnt++;
    });
    var c_cnt = 0;
    jQuery(".links_feature_img").each(function (i, v) {
        $(this).attr("name", "feature_image[" + c_cnt + "]");
        $(this).attr("id", "feature_image" + c_cnt);
        if (!$(this).hasClass("feature_img")) {
            $("#addCMSform").validate();
            $('input[name="feature_image[' + c_cnt + ']"]').rules("add", {
                required: true,
                extension: "jpg,png,jpeg",
                file_size: true,
                messages: {
                    //required:"Please Upload Feature Image",
                    extension: 'File type must be JPG, JPEG or PNG',
                    file_size: 'File size must be less than 800 KB'
                }
            });
        }
        c_cnt++;
    });
    var v_cnt = 0;
    jQuery(".links_title").each(function (i, v) {
        $(this).attr("name", "link_title[" + v_cnt + "]");
        $('input[name="link_title[' + v_cnt + ']"]').rules("add", {
            required: true,
            maxlength: 30
        });
        v_cnt++;
    });

});

jQuery(document).on('click', '.remove_links', function () {

    var parentId = jQuery(this).parent().parent('div').remove();

    var d_cnt = 0;
    jQuery(".vd_links").each(function (i, v) {
        $(this).attr("name", "video_links[" + d_cnt + "]");
        $("#addCMSform").validate();
        $('input[name="video_links[' + d_cnt + ']"]').rules("add", {
            required: true,
            youtube: true,
            check_link_exists: true
        });
        d_cnt++;
    });
    var c_cnt = 0;
    jQuery(".links_feature_img").each(function (i, v) {
        $(this).attr("name", "feature_image[" + c_cnt + "]");
        $(this).attr("id", "feature_image" + c_cnt);
        if (!$(this).hasClass("feature_img")) {
            $("#addCMSform").validate();
            $('input[name="feature_image[' + c_cnt + ']"]').rules("add", {
                required: true,
                extension: "jpg,png,jpeg",
                file_size: true,
                messages: {
                    //required:"Please Upload Feature Image",
                    extension: 'File type must be JPG, JPEG or PNG',
                    file_size: 'File size must be less than 800 KB'
                }
            });
        }
        c_cnt++;
    });
    var v_cnt = 0;
    jQuery(".links_title").each(function (i, v) {
        $(this).attr("name", "link_title[" + v_cnt + "]");
        $("#addCMSform").validate();
        $('input[name="link_title[' + v_cnt + ']"]').rules("add", {
            required: true,
            maxlength: 30
        });
        v_cnt++;
    });
});

jQuery(document).on('change', '.feature_img', function () {
    $("#addCMSform").validate();
    $(this).rules("add", {
        extension: "jpg,png,jpeg",
        file_size: true,
        messages: {
            //required:"Please Upload Feature Image",
            extension: 'File type must be JPG, JPEG or PNG',
            file_size: 'File size must be less than 800 KB'
        }
    });
    $(this).valid();
});

jQuery(document).on('click', '#add_more_fleet', function () {

    var fleet_total = jQuery(".fleet_title").length;
    var c = parseInt(fleet_total) + parseInt(1);
    var fleets_field = '<div class="form-group fl' + c + '"><div class="row"><div class="col-md-6 "><div class="row div_span"> <label class="col-form-label label_text text-lg-right ">Title<small class="req text-danger">*</small></label> <input type="text" id="fleet_title" class="form-control fleet_title" name="fleet_title[]" autocomplete="off" placeholder="Title"></div><div class="row div_span"> <label class="col-form-label label_text text-lg-right ">Feature Image<small class="req text-danger">*</small></label> <input type="file" class="form-control fleet_feature_img" name="fleet_feature_image[]" autocomplete="off" placeholder="Feature Image"></div></div><div class="col-md-6"><div class="row div_span"> <label class="col-form-label label_text text-lg-right ">Description<small class="req text-danger">*</small></label><textarea rows="5" name="fleet_description[]" class="form-control required fleet_description resize_box" ></textarea><div id="description_err"></div></div></div></div></div><div class="form-group fl' + c + '"><div class="row"><div class="col-md-3"> <button name="remove_fleet" type="button" data-index="' + c + '" class="btn btn-primary remove_fleet">Remove</button></div></div></div>';

    jQuery(".fleet_desc").append(fleets_field);
    var d_cnt = 0;
    jQuery(".fleet_title").each(function (i, v) {
        $(this).attr("name", "fleet_title[" + d_cnt + "]");
        $("#addCMSform").validate();
        $('input[name="fleet_title[' + d_cnt + ']"]').rules("add", {
            required: true,
            //check_title_exists:true
        });
        d_cnt++;
    });
    var c_cnt = 0;
    jQuery(".fleet_feature_img").each(function (i, v) {
        $(this).attr("name", "fleet_feature_img[" + c_cnt + "]");
        $(this).attr("id", "fleet_feature_img" + c_cnt);
        if (!$(this).hasClass("fl_feature_img")) {
            $("#addCMSform").validate();
            $('input[name="fleet_feature_img[' + c_cnt + ']"]').rules("add", {
                required: true,
                // extension:"jpg,png,jpeg",
                // filesize: true,
                // messages:{
                //     //required:"Please Upload Feature Image",
                //     extension:'File type must be JPG, JPEG or PNG',
                //     filesize:'File size must be less than 800 KB'
                // }
            });
        }
        c_cnt++;
    });
    var v_cnt = 0;
    jQuery(".fleet_description").each(function (i, v) {
        $(this).attr("name", "fleet_description[" + v_cnt + "]");
        $("#addCMSform").validate();
        $('input[name="fleet_description[' + v_cnt + ']"]').rules("add", {
            required: true,
            //check_title_exists:true
        });
        v_cnt++;
    });

});

jQuery(document).on('click', '.remove_fleet', function () {

    //var parentId = jQuery(this).parent().parent('div').remove();
    var parentId = jQuery(this).data('index');

    jQuery('.fl' + parentId).remove();
    var d_cnt = 0;
    jQuery(".fleet_title").each(function (i, v) {
        $(this).attr("name", "fleet_title[" + d_cnt + "]");
        $("#addCMSform").validate();
        $('input[name="fleet_title[' + d_cnt + ']"]').rules("add", {
            required: true,
            //check_title_exists:true
        });
        d_cnt++;
    });
    var c_cnt = 0;
    jQuery(".fleet_feature_img").each(function (i, v) {
        $(this).attr("name", "fleet_feature_img[" + c_cnt + "]");
        $(this).attr("id", "fleet_feature_img" + c_cnt);
        if (!$(this).hasClass("fl_feature_img")) {
            $("#addCMSform").validate();
            $('input[name="fleet_feature_img[' + c_cnt + ']"]').rules("add", {
                required: true,
                // extension:"jpg,png,jpeg",
                // filesize: true,
                // messages:{
                //     //required:"Please Upload Feature Image",
                //     extension:'File type must be JPG, JPEG or PNG',
                //     filesize:'File size must be less than 800 KB'
                // }
            });
        }
        c_cnt++;
    });
    var v_cnt = 0;
    jQuery(".fleet_description").each(function (i, v) {
        $(this).attr("name", "fleet_description[" + v_cnt + "]");
        $('input[name="fleet_description[' + v_cnt + ']"]').rules("add", {
            required: true,
            //check_title_exists:true
        });
        v_cnt++;
    });
});

jQuery(document).on('change', '.fleet_feature_img', function () {
    $("#addCMSform").validate();
    $(this).rules("add", {
        extension: "jpg,png,jpeg",
        file_size: true,
        minImageWidth: true,
        minImageHeight: true,
        messages: {
            //required:"Please Upload Feature Image",
            extension: 'File type must be JPG, JPEG or PNG',
            file_size: 'File size must be less than 800 KB',
            minImageWidth: 'Min Width of image must be 500',
            minImageHeight: 'Min Height of image must be 300',
        }
    });
    element = $(this);
    var files = this.files;

    var _URL = window.URL || window.webkitURL;
    var image, file;
    image = new Image();
    image.src = _URL.createObjectURL(files[0]);
    image.onload = function () {
        element.attr('uploadwidth', this.width);
        element.attr('uploadheigth', this.height);
    }
    jQuery(this).valid();

});

jQuery(document).on('change', '.links_feature_img', function () {
    $("#addCMSform").validate();
    $(this).rules("add", {
        minImageWidth: true,
        minImageHeight: true,
        messages: {
            minImageWidth: 'Min Width of image must be 500',
            minImageHeight: 'Min Height of image must be 300',
        }
    });
    element = $(this);
    var files = this.files;

    var _URL = window.URL || window.webkitURL;
    var image, file;
    image = new Image();
    image.src = _URL.createObjectURL(files[0]);
    image.onload = function () {
        element.attr('uploadwidth', this.width);
        element.attr('uploadheigth', this.height);
    }
    jQuery(this).valid();

});

jQuery(document).on('click', '#add_more_static_text', function () {

    //var tour_meeting_input=jQuery(".tour_meeting_input").length;
    var faqs_field = '<div class="m-div"><div class="form-group"><div class="row"><div class="col-md-4"><label class="col-form-label label_text text-lg-right">Static Text Title<small class="req text-danger">*</small></label><input class="form-control static_title_input required" name="static_title[]" autocomplete="off" placeholder="Title"></div><div class="col-md-6"><label class="col-form-label label_text text-lg-right">Description<small class="req text-danger">*</small></label><textarea rows="4" class="form-control resize_box required static_title_output" name="static_description[]" placeholder="Description"></textarea></div><div class="col-md-2 mrg-t-32"><button name="remove_static_info" type="button" class="btn btn-primary remove_static_info">Remove</button></div></div></div></div>';

    jQuery(".static_text_travel_agent").append(faqs_field);
    var d_cnt = 0;
    var c_cnt = 0;
    jQuery(".static_title_input").each(function (i, v) {
        $(this).attr("name", "static_title[" + d_cnt + "]");
        d_cnt++;
    });
    jQuery(".static_title_output").each(function (i, v) {
        $(this).attr("name", "static_description[" + c_cnt + "]");
        c_cnt++;
    });

});

jQuery(document).on('click', '.remove_static_info', function () {

    var parentId = jQuery(this).parent().parent('div').remove();

    var d_cnt = 0;
    var c_cnt = 0;
    jQuery(".static_title_input").each(function (i, v) {
        $(this).attr("name", "static_title[" + d_cnt + "]");
        d_cnt++;
    });
    jQuery(".static_title_output").each(function (i, v) {
        $(this).attr("name", "static_description[" + c_cnt + "]");
        c_cnt++;
    });

});

jQuery("#review_ids").select2().change(function () {
    jQuery(this).valid();
});

jQuery("#promo_file").change(function () {
    jQuery(this).valid();
});

jQuery("#tour_id").select2().change(function () {
    jQuery(this).valid();
    jQuery("#review_ids").html('');
    jQuery.ajax({
        url: BASE_URL + 'cms_pages/get_reviews',
        type: 'POST',
        data: {
            tour_id: jQuery("#tour_id").val()
        },
        dataType: 'JSON',
        beforeSend: function () {
            jQuery(".load-main").removeClass('hidden');
        },
        success: function (response) {
            jQuery(".load-main").addClass('hidden');
            if (response.success) {
                $('#review_ids').html(response.review_list);
                //jGrowlAlert(response.msg, 'success');
            }
            else {
                //jGrowlAlert(response.msg, 'danger');
            }
        },
        error: function (response) {
            jQuery(".load-main").addClass('hidden');
            jGrowlAlert("Something Went Wrong!", 'danger');
        }
    });
});

jQuery(document).on('click', '#delete_promo_file', function () {
    var cms_page_id = jQuery(this).data('id');
    swal({
        title: jQuery("#swal_title").val(),
        text: jQuery("#swal_text").val(),
        type: "warning",
        showCancelButton: true,
        cancelButtonText: jQuery("#swal_cancelButtonText").val(),
        confirmButtonText: jQuery("#swal_confirmButtonText").val(),
    },
        function () {
            jQuery(".load-main").removeClass('hidden');
            $.ajax({
                url: BASE_URL + 'cms_pages/delete_attachment',
                type: 'POST',
                data: {
                    cms_page_id: cms_page_id
                },
                dataType: 'JSON',
                success: function (response) {
                    jQuery(".load-main").addClass('hidden');
                    if (response.success) {
                        jQuery('#promo_file_show').addClass('hidden');
                        jQuery("#promo_file_value").val('');
                        jQuery("#promo_file").rules('add', 'required');
                        jQuery("#promo_file_err").removeClass('mr-t-30');
                        jGrowlAlert(response.msg, 'success');
                    }
                    else {
                        jGrowlAlert(response.msg, 'warning');
                    }
                }
            });
        });
});

function add_duplicate(id, parent_id) {
    console.log(id);
    console.log(parent_id);
    $('.jGrowl-notification').trigger('jGrowl.close');
    $.ajax({
        url: BASE_URL + 'cms_pages/add_duplicate',
        type: 'POST',
        data: {
            cms_page_id: id,
            cms_parent_id: parent_id
        },
        beforeSend: function () {
            jQuery(".load-main").removeClass('hidden');
        },
        dataType: 'JSON',
        success: function (response) {
            jQuery(".load-main").addClass('hidden');
            if (response.success) {
                $('#cms_pages_list_table').DataTable().ajax.reload();
                jGrowlAlert(response.alert_msg, 'success');
            } else {
                jGrowlAlert(response.msg, 'danger');
            }
        },
        error: function (response) {
            jQuery(".load-main").addClass('hidden');
            jGrowlAlert("Something Went Wrong!", 'danger');
        }
    });
}

jQuery(document).on("change", "#promo_file_opt", function () {

    jQuery(".promo_video_file").removeClass("hidden");
    jQuery(".promo_video_url").addClass("hidden");
    jQuery('#promo_file-error').hide();
    jQuery('#promo_url-error').hide();
    jQuery("#promo_file").prop("disabled", false);
    jQuery("#addCMSform").validate();
    if (jQuery("#promo_file_value").val() == '') {
        jQuery("#promo_file").rules('add', 'required');
    }
    jQuery("#promo_url").rules('remove', 'required');
});
jQuery(document).on("change", "#promo_url_opt", function () {

    jQuery(".promo_video_file").addClass("hidden");
    jQuery(".promo_video_url").removeClass("hidden");

    jQuery('#promo_file-error').hide();
    jQuery('#promo_url-error').hide();
    jQuery("#promo_url").prop("disabled", false);
    jQuery("#addCMSform").validate();
    jQuery("#promo_url").rules('add', 'required');
    jQuery("#promo_file").rules('remove', 'required');
});

jQuery("#promo_file").change(function () {
    $("#addCMSform").validate();
    jQuery("#promo_file").rules('add', {
        extension: "mp4",
        promo_file_size: true,
        messages: {
            //required:"Please Upload Feature Image",
            //extension:'File type must be JPG, JPEG or PNG',
            extension: 'File type must be mp4',
            promo_file_size: "File size must be less than 2 MB"
        }
    });
    jQuery(this).valid();
    if ($(this).val() != "") {
        jQuery("#promo_url").prop("disabled", true);
    } else {
        jQuery("#promo_url").prop("disabled", false);
    }
});

jQuery("#promo_url").change(function () {

    jQuery(this).valid();
    if ($(this).val() != "") {
        jQuery("#promo_file").prop("disabled", true);
    } else {
        jQuery("#promo_file").prop("disabled", false);
    }
});
jQuery(document).on("change", "#page_review_opt", function () {

    jQuery(".review-list-wrapper").removeClass("col-md-6").addClass('col-md-12');
    jQuery(".tour-name-wrapper").addClass("hidden");
    $("#tour_id, #review_ids").val(null).trigger('change');
    // jQuery(".promo_video_file").removeClass("hidden");
    // jQuery(".promo_video_url").addClass("hidden");
    // jQuery('#promo_file-error').hide(); 
    // jQuery('#promo_url-error').hide();
    // jQuery("#promo_file").prop("disabled", false);
    jQuery("#addCMSform").validate();
    // if(jQuery("#promo_file_value").val()=='') {
    //     jQuery("#promo_file").rules('add','required');
    // }
    // jQuery('#tour_review_opt').rules('add', 'required');
    jQuery("#tour_id").rules('remove', 'required');
    $.ajax({
        url: BASE_URL + 'cms_pages/get_review_list',
        type: 'POST',
        dataType: 'JSON',
        success: function (response) {
            jQuery('.load-main').addClass('hidden');
            if (response.success) {

                $.each(response.data, function (index, value) {
                    var newOption = new Option(value.title, value.id, false, false);
                    $('#review_ids').append(newOption).trigger('change');
                });
            }
            else {
                jGrowlAlert(response.msg, 'danger');
            }
        }
    });
});

jQuery(document).on("change", "#tour_review_opt", function () {
    jQuery(".review-list-wrapper").addClass("col-md-6").removeClass('col-md-12');
    jQuery(".tour-name-wrapper").removeClass("hidden");
    $("#tour_id, #review_ids").val(null).trigger('change');
    jQuery("#tour_id").rules('add', 'required');
    jQuery("#addCMSform").validate();
});