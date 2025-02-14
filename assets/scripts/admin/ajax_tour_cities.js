jQuery('.addtourcities').click(function(){
        jQuery('#error_msg').html('');
        jQuery('#tour_type').val('').trigger('change');
        jQuery('#tour_type-error').hide();
        jQuery('#tour_city-error').hide();
        jQuery('#tour_city_id').val('');
        jQuery('.addModalTitle').removeClass('hidden');
        jQuery('.editModalTitle').addClass('hidden');
        jQuery("#addTourCityform")[0].reset();
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
    return this.optional(element) || /^([a-zA-Z0-9 ]+)$/.test(value);
}, "Special Characters not allowed!");

jQuery("#addTourCityform").validate({
    rules:{
        ignore: [],
        tour_type: 'required',
        tour_city:{
            required:true,
            noSpace:true,
            noHTML:true,
            remote: {
                        url: BASE_URL+"admin/tour_cities/iscityExists",
                        type: "POST",
                        data: {
                            record_id: function() {
                                return $('#tour_city_id').val();
                            },
                        }
                     },
            maxlength:20
        }   
    },
    messages: {
      tour_city:{
      	required:"Please enter tour city",
        remote:"Tour city already exist"
      }
    },
    submitHandler:function(form){

        if(jQuery('#tour_city_id').val()) {
            var ajaxSubmit=BASE_URL+"admin/tour_cities/edit";
        } else {
            var ajaxSubmit=BASE_URL+"admin/tour_cities/add"
        }
            jQuery.ajax({
                url: ajaxSubmit,
                type: 'POST',
                data:jQuery("#addTourCityform").serialize(),
                dataType:'JSON',
                beforeSend: function () {
                      jQuery("#addTourCityform").hide();
                      jQuery("#loader_cont").removeClass('hidden');    
                }, 
                success: function(response) {

                    jQuery("#addTourCityform").show();
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

                          jQuery("#addTourCityform")[0].reset();
                          $('#add_tour_city_modal').modal('hide');

                          $('#tour_city_list_table').DataTable().ajax.reload();  
                          jGrowlAlert(response.msg, 'success');
                                       
                        }
                }
            });   
    }
});

$(document).ready(function(){

    jQuery("#tour_type").select2();
    $('#tour_city_list_table').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        "searching": true,
        
        // Load data from an Ajax source
        "ajax": {
            "url": BASE_URL+'admin/tour_cities/getLists/',
            "type": "POST"
        },
        //Set column definition initialisation properties
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
            },
            {
            "targets": [3],
            "orderable": false
            },  
            {
            "targets": [4],
            "orderable": false
            }           
        ]
    });   
});

$("#tour_type").select2().change(function() {
    //console.log($("#tour_type").val());
    $(this).valid();
});

/**
 * Change status when clicked on the status switch
 *
 * @param int  status  
 * @param int  tour_city_id
 */
function change_status(obj)
{
    var checked = 0;

    if(obj.checked) 
    { 
        checked = 1;
    }  
    $.ajax({
        url:BASE_URL+'admin/tour_cities/update_status',
        type: 'POST',
        data: {
            tour_city_id: obj.id,
            is_active:checked
        },
        dataType:'JSON',
        success: function(response) 
        {
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
        $.ajax({
            url:BASE_URL+'admin/tour_cities/delete',
            type: 'POST',
            data: {
                tour_city_id:obj.id
            },
            dataType:'JSON',
            success: function(response)
            {
                if(response.success)
                {                        
                    $('#tour_city_list_table').DataTable().ajax.reload();     
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

/**
 * open edit modal
 *
 * @param int  quesion id  
 */
 
function edit_record(obj)
{    
    $.ajax({
        url:BASE_URL+'admin/tour_cities/get_record_byID',
        type: 'POST',
        data: {
            tour_city_id: obj.id,
        },
        dataType:'json',
        success: function(data) 
        {
            if(data.id){

                jQuery('#error_msg').html('');
                jQuery('#tour_type-error').hide();
                jQuery('#tour_city-error').hide();
                jQuery("#addTourCityform")[0].reset();

                jQuery('#tour_city_id').val(btoa(data.id));

                //$('#inputID').select2('data', {id: 100, a_key: 'Lorem Ipsum'});
                jQuery('#tour_type').val(data.tour_type_id).trigger('change');
                jQuery("#tour_city").val(data.title);
                
                jQuery('.addModalTitle').addClass('hidden');
                jQuery('.editModalTitle').removeClass('hidden');

                jQuery("#add_tour_city_modal").modal('show');
            } else {
                jGrowlAlert(data, 'danger');
            }
        }
    }); 
}