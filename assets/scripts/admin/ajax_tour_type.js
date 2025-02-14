jQuery('.addtourtypes').click(function(){
        jQuery('#error_msg').html('');
        jQuery('#tour_type-error').hide();
        jQuery('.addModalTitle').removeClass('hidden');
        jQuery('.editModalTitle').addClass('hidden');
        jQuery('#tour_type_id').val('');
        jQuery("#addTourTypeform")[0].reset();
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

jQuery("#addTourTypeform").validate({
    errorElement: 'span',
    rules:{
        tour_type: {
            required:true,
            noSpace:true,
            noHTML:true,
            remote: {
            			url: BASE_URL+"tour_types/istypeExists",
                        type: "POST",
                        data: {
                            record_id: function() {
                                return $('#tour_type_id').val();
                            },
                        }
                     },
            maxlength:20
        }
    },
    messages: {
      tour_type:{
      	required:"Please Enter Product Type",
        remote:"Product type already exist"
      }
    },
    submitHandler:function(form){

        if(jQuery('#tour_type_id').val()) {
            var ajaxSubmit=BASE_URL+"tour_types/edit";
        } else {
            var ajaxSubmit=BASE_URL+"tour_types/add"
        }
            jQuery.ajax({
                url: ajaxSubmit,
                type: 'POST',
                data:jQuery("#addTourTypeform").serialize(),
                dataType:'JSON',
                beforeSend: function () {
                      jQuery("#addTourTypeform").hide();
                      jQuery("#loader_cont").removeClass('hidden');    
                }, 
                success: function(response) {

                    jQuery("#addTourTypeform").show();
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

                          jQuery("#addTourTypeform")[0].reset();
                          $('#add_tour_type_modal').modal('hide');

                          $('#tour_type_list_table').DataTable().ajax.reload();  
                          jGrowlAlert(response.msg, 'success');
                                       
                        }
                }
            });   
    }
});

$(document).ready(function(){

    $('#tour_type_list_table').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        "searching": true,
        
        // Load data from an Ajax source
        "ajax": {
            "url": BASE_URL+'tour_types/getLists/',
            "type": "POST",
            // columnsDef: [
            //             'RecordID', 'tour_type', 'status', 'action'],
        },
        "columns": [
                { data: 'RecordID', 'sortable': false,"orderable": false }, //0
                { data: 'tour_type'} , //1
                { data: null,"orderable": false  },// 2
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
             'render': function (data, type, full, meta){
                //var id = data.id;
                //return '<a href="javascript:" data-popup="tooltip" data-placement="top"  title="edit" onclick="edit_record(this)" id="'+data+'" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="'+data+'"><i class=" icon-trash"></i></a>';
                return '<a href="javascript:" data-popup="tooltip" data-placement="top"  title="edit" onclick="edit_record(this)" id="'+data+'" class="text-info"><i class="icon-pencil7"></i></a>';
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
            }         
        ]
    });   
});

/**
 * Change status when clicked on the status switch
 *
 * @param int  status  
 * @param int  tour_type_id
 */
function change_status(obj)
{
    var checked = 0;

    if(obj.checked) 
    { 
        checked = 1;
    }  
    $('.jGrowl-notification').trigger('jGrowl.close');
    $.ajax({
        url:BASE_URL+'tour_types/update_status',
        type: 'POST',
        data: {
            tour_type_id: obj.id,
            is_active:checked
        },
        dataType:'JSON',
        success: function(response) 
        {
            //$('.jGrowl-notification:last').trigger('jGrowl.close');
            
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
            url:BASE_URL+'tour_types/delete',
            type: 'POST',
            data: {
                tour_type_id:obj.id
            },
            dataType:'JSON',
            success: function(response)
            {
                jQuery(".load-main").addClass('hidden');
                if(response.success)
                {                        
                    $('#tour_type_list_table').DataTable().ajax.reload();     
                    jGrowlAlert(response.msg, 'success');
                }
                else
                {
                    jGrowlAlert(response.msg, 'warning');
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
    jQuery(".load-main").removeClass('hidden');
    $.ajax({
        url:BASE_URL+'tour_types/get_record_byID',
        type: 'POST',
        data: {
            tour_type_id: obj.id,
        },
        dataType:'json',
        success: function(data) 
        {
            jQuery(".load-main").addClass('hidden');
            if(data.id){

                jQuery('#error_msg').html('');
                jQuery('#tour_type-error').hide();
                jQuery("#addTourTypeform")[0].reset();

                jQuery('#tour_type_id').val(btoa(data.id));
                
                jQuery("#tour_type").val(data.title);
                
                jQuery('.addModalTitle').addClass('hidden');
                jQuery('.editModalTitle').removeClass('hidden');

                jQuery("#add_tour_type_modal").modal('show');
            } else {
                jGrowlAlert(data, 'danger');
            }
        }
    }); 
}