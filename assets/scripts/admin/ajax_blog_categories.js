jQuery('.addblogcat').click(function(){
    jQuery('#error_msg').html('');
    jQuery('#blog_category-error').hide();
    var validator = $("#addBlogCategoryform").validate();
    validator.resetForm();
    jQuery('#blog_category_id').val('');
    jQuery('.addModalTitle').removeClass('hidden');
    jQuery('.editModalTitle').addClass('hidden');
    jQuery("#addBlogCategoryform")[0].reset();
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

$('#blog_parent_category').select2({placeholder: "Select parent category", allowClear : true});
$('#add_blog_category_modal').on('hidden.bs.modal', function () {    
    $("#addBlogCategoryform")[0].reset();
    $('#blog_parent_category').val(null).trigger('change');
})
$(document).ready(function(){
    fetch_data();
});
function fetch_data()
{
    var usersDataTable = $('#blog_cat_list_table').DataTable({
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
            "url": BASE_URL+'blog_categories/getLists/',
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
                { data: 'name' } , //1
                { data: null,"orderable": false  },// 2
                { data: 'action' } , //3
        ],
        "columnDefs": [ 
            {
                'targets': [3],
                'title': 'Actions',
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    //var id = data.id;
                    return '<a href="javascript:" data-popup="tooltip" data-placement="top"  title="edit" onclick="edit_record(this)" id="'+data+'" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="'+data+'"><i class=" icon-trash"></i></a>';
                }
            },
            {
                'targets': [2],
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
            { "width": "5%", "targets": 0 },
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
        url:BASE_URL+'blog_categories/update_status',
        type: 'POST',
        data: {
            blog_category_id: obj.id,
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

// validate add blog category form
jQuery("#addBlogCategoryform").validate({
    errorElement: 'span',
    rules:{
       //ignore: [],
        
        //tour_type: 'required',
        blog_category:{
            required:true,
            noSpace:true,
            noHTML:true,
            remote: {
                url: BASE_URL+"blog_categories/isCategoryExists",
                type: "POST",
                data: {
                    record_id: function() {
                        return $('#blog_category_id').val();
                    },
                }
            },
            maxlength:40
        },  
    },
    messages: {
        blog_category:{
      	required:"Please Enter Blog Category",
        remote:"Blog category already exist"
      },
    },
    submitHandler:function(form){
        var blog_category = $('#blog_category').val();
        var blog_parent_category = $('#blog_parent_category').val();
        if(jQuery('#blog_category_id').val()) {
            var ajaxSubmit=BASE_URL+"blog_categories/edit";
        } else {
            var ajaxSubmit=BASE_URL+"blog_categories/add"
        }
        var form1 = $('#addBlogCategoryform')[0];
        var formData = new FormData(form1);
            jQuery.ajax({
                url: ajaxSubmit,
                type: 'POST',
                data:formData,
                dataType:'JSON',
                contentType: false,
                processData: false,
                beforeSend: function () {
                      jQuery("#addBlogCategoryform").hide();
                      jQuery("#loader_cont").removeClass('hidden');    
                }, 
                success: function(response) {

                    jQuery("#addBlogCategoryform").show();
                    jQuery("#loader_cont").addClass('hidden');  
                    
                        if(response.success == false) {

                          jQuery("#error_msg").html(response.msg);
                          //jQuery("#error_msg").show();
                          jQuery("#error_msg").removeClass('hidden');

                          setTimeout(function(){

                            jQuery("#error_msg").addClass('hidden');
                            jQuery("#error_msg").html("");
                                 
                            }, 3000);
                          
                        } else if(response.success == true) {

                        jQuery("#addBlogCategoryform")[0].reset();
                        $('#add_blog_category_modal').modal('hide');
                        if(response.insert_id){
                            $("#blog_parent_category").append('<option value="'+response.insert_id+'">'+blog_category+'</option>');
                        }
                        if(response.edit){
                            $("#blog_parent_category").select2("destroy");
                            $('#blog_parent_category option[value="'+atob(jQuery('#blog_category_id').val())+'"]').text(blog_category);
                            window.setTimeout(function () {
                                $('#blog_parent_category').select2({placeholder: "Select parent category", allowClear : true});
                            },0);
                        }

                        $('#blog_cat_list_table').DataTable().ajax.reload();  
                        jGrowlAlert(response.msg, 'success');
                                       
                        }
                }
            });   
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
        jQuery('.load-main').removeClass('hidden');
        $.ajax({
            url:BASE_URL+'blog_categories/delete',
            type: 'POST',
            data: {
                blog_category_id:obj.id
            },
            dataType:'JSON',
            success: function(response)
            {
                jQuery('.load-main').addClass('hidden');
                if(response.success)
                {                        
                    $('#blog_cat_list_table').DataTable().ajax.reload();     
                    jGrowlAlert(response.msg, 'success');
                    $("#blog_parent_category option[value='"+atob(obj.id)+"']").remove();
                }
                else
                {
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
 
function edit_record(obj)
{  
    jQuery('.load-main').removeClass('hidden');  
    $.ajax({
        url:BASE_URL+'blog_categories/get_record_byID',
        type: 'POST',
        data: {
            blog_category_id: obj.id,
        },
        dataType:'json',
        success: function(data) 
        {
            jQuery('.load-main').addClass('hidden');
            if(data.id){

                jQuery('#error_msg').html('');
                //jQuery('#tour_category-error').hide();
                var validator = $("#addBlogCategoryform").validate();
                validator.resetForm();
                jQuery("#addBlogCategoryform")[0].reset();

                jQuery('#blog_category_id').val(btoa(data.id));

                //$('#inputID').select2('data', {id: 100, a_key: 'Lorem Ipsum'});
                jQuery('#blog_parent_category').val(data.parent_cat_id).trigger('change');
                jQuery("#blog_category").val(data.name);
                jQuery("#meta_title").val(data.meta_title);
                jQuery("#meta_keywords").val(data.meta_keyword);
                jQuery("#meta_description").val(data.meta_description);
                
                jQuery('.addModalTitle').addClass('hidden');
                jQuery('.editModalTitle').removeClass('hidden');
                jQuery("#add_blog_category_modal").modal('show');
            } else {
                jGrowlAlert(data, 'danger');
            }
        }
    }); 
}