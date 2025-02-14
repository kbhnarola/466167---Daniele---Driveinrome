jQuery('.addextraservices').click(function(){
        jQuery('#error_msg').html('');
        
        jQuery( ".flate_radio_opt" ).show();
        jQuery( ".add_price_display" ).addClass('hidden');
        jQuery( "#per_person_price_field" ).html('');
        jQuery("#price").attr("disabled", false);
        jQuery(".b_price").show();
        for(var i=1;i<=8;i++) {
            jQuery('#price'+i).rules( 'remove' );    
        }
        var validator = $("#addExtraServiceform").validate();
        validator.resetForm();
        jQuery('.addModalTitle').removeClass('hidden');
        jQuery('.editModalTitle').addClass('hidden');
        jQuery('#extra_service_id').val('');
        jQuery("#addExtraServiceform")[0].reset();
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

jQuery("#addExtraServiceform").validate({
    errorElement: 'span',
    rules:{
        extra_service_title: {
            required:true,
            noSpace:true,
            noHTML:true,
            remote: {
            			url: BASE_URL+"tour_extra_services/istypeExists",
                        type: "POST",
                        data: {
                            record_id: function() {
                                return $('#extra_service_id').val();
                            },
                        }
                     },
            maxlength:500
        },
        price:{
            required:true,
            noSpace:true,
            noHTML:true,
            number:true,
            min:1
        },
        rate_opt:{
            required:true
        }
    },
    messages: {
      extra_service_title:{
      	required:"Please Enter Tour Upgrades Title",
        remote:"Tour Upgrades Title already exist"
      }
    },
    submitHandler:function(form){

        if(jQuery('#extra_service_id').val()) {
            var ajaxSubmit=BASE_URL+"tour_extra_services/edit";
        } else {
            var ajaxSubmit=BASE_URL+"tour_extra_services/add"
        }
            jQuery.ajax({
                url: ajaxSubmit,
                type: 'POST',
                data:jQuery("#addExtraServiceform").serialize(),
                dataType:'JSON',
                beforeSend: function () {
                      jQuery("#addExtraServiceform").hide();
                      jQuery("#loader_cont").removeClass('hidden');    
                }, 
                success: function(response) {

                    jQuery("#addExtraServiceform").show();
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

                          jQuery("#addExtraServiceform")[0].reset();
                          $('#add_extra_service_modal').modal('hide');

                          $('#extra_service_list_table').DataTable().ajax.reload();  
                          jGrowlAlert(response.msg, 'success');
                                       
                        }
                }
            });   
    }
});

$(document).ready(function(){

    $('#extra_service_list_table').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        "searching": true,
        
        // Load data from an Ajax source
        "ajax": {
            "url": BASE_URL+'tour_extra_services/getLists/',
            "type": "POST",
            // columnsDef: [
            //             'RecordID', 'tour_type', 'status', 'action'],
        },
        "columns": [
                { data: 'RecordID', 'sortable': false,"orderable": false }, //0
                { data: 'title'} , //1
                { data: 'price'} , //2
                // { data: 'description'} , //3
                { data: null,"orderable": false  },// 3
                { data: 'action' }, // 4
        ],
        //Set column definition initialisation properties
        "columnDefs": [ 
            {
            'targets': [4],
            'title': 'Actions',
             'searchable': false,
             'orderable': false,
             'className': 'dt-body-center',
             'render': function (data, type, full, meta){
                //var id = data.id;
                if(atob(data)==14 || atob(data)==16){
                    return '<a href="javascript:" data-popup="tooltip" data-placement="top"  title="edit" onclick="edit_record(this)" id="'+data+'" class="text-info"><i class="icon-pencil7"></i></a>';
                } else {
                    return '<a href="javascript:" data-popup="tooltip" data-placement="top"  title="edit" onclick="edit_record(this)" id="'+data+'" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="'+data+'"><i class=" icon-trash"></i></a>';
                }
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
        url:BASE_URL+'tour_extra_services/update_status',
        type: 'POST',
        data: {
            extra_service_id: obj.id,
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
        jQuery(".load-main").removeClass('hidden');
        $.ajax({
            url:BASE_URL+'tour_extra_services/delete',
            type: 'POST',
            data: {
                extra_service_id:obj.id
            },
            dataType:'JSON',
            success: function(response)
            {
                jQuery(".load-main").addClass('hidden');
                if(response.success)
                {                        
                    $('#extra_service_list_table').DataTable().ajax.reload();     
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

jQuery(document).on("change","#flat_rate_opt",function(){
    
    jQuery(".add_price_display").addClass("hidden");
    jQuery("#per_person_price_field").html("");
});
jQuery(document).on("change","#price_rate_opt",function(){
    if(jQuery("#extra_service_id").val()==btoa(14)){
        jQuery(".add_price_display").removeClass("hidden");
         //jQuery(".add_price_display").show();
    } else {
        jQuery(".add_price_display").addClass("hidden");
    }   
});


/**
 * open edit modal
 *
 * @param int  quesion id  
 */
 
function edit_record(obj)
{   
    jQuery(".load-main").removeClass('hidden');
    $.ajax({
        url:BASE_URL+'tour_extra_services/get_record_byID',
        type: 'POST',
        data: {
            extra_service_id: obj.id,
        },
        dataType:'json',
        success: function(data) 
        {
            jQuery(".load-main").addClass('hidden');
            if(data.id){
                
                jQuery('#error_msg').html('');
                var validator = $("#addExtraServiceform").validate();
                validator.resetForm();
                
                jQuery('#per_person_price_field').html('');
                jQuery("#addExtraServiceform")[0].reset();
                jQuery('#extra_service_id').val(btoa(data.id));
                
                jQuery("#extra_service_title").val(data.title);
                //jQuery("#price").val(data.price);
                jQuery("#description").val(data.description);

                if(data.person_custom_rate!="" && data.id==14){
                   // console.log(JSON.parse(data.person_custom_rate));
                    var cust_price_html="";
                    var i=1;
                    $.each(JSON.parse(data.person_custom_rate), function(key, value) {
                        // if(i==0){
                        //     var person_str="Person";
                        // } else {
                        //     var person_str="Persons";
                        // }
                        // cust_price_html+='<div class="form-group"><div class="row"><div class="col-md-4"> <label class="col-form-label label_text text-lg-right per_person_lbl">'+(i+1)+' '+person_str+'<small class="req text-danger">*</small></label> <input type="text" class="form-control cust_per_person_price required" name="per_person['+i+']" autocomplete="off" placeholder="Price" value="'+value+'"></div><div class="col-md-2"> <button name="remove_person_price" type="button" class="btn btn-primary mr-t-30 remove_person_price" >Remove</button></div></div></div>';
                        $('#price'+i).val(value);
                        i++;
                    });
                    
                    jQuery(".cust_per_person_price").each(function(i,v){
        
                            $(this).rules('add',{
                                required:true,
                                number:true
                            });
                                
                        });
                    jQuery( "#per_person_price_field" ).append(cust_price_html);
                    jQuery( ".flate_radio_opt" ).hide();
                    jQuery("#price").attr("disabled", true);
                    jQuery(".b_price").hide();
                } else {
                    jQuery( ".flate_radio_opt" ).show();
                    jQuery("#price").val(data.price);
                    jQuery("#price").attr("disabled", false);
                    jQuery(".b_price").show();
                    for(var i=1;i<=8;i++){
                        jQuery('#price'+i).rules( 'remove' );    
                    }
                }
                //$("input:radio").attr("checked", false);
                //jQuery("input[name='rate_opt']").val(data.rate_opt).prop('checked', true);
                $('input:radio[name=rate_opt][value='+data.rate_opt+']').click();
                jQuery('.addModalTitle').addClass('hidden');
                jQuery('.editModalTitle').removeClass('hidden');

                jQuery("#add_extra_service_modal").modal('show');
            } else {
                jGrowlAlert(data, 'danger');
            }
        }
    }); 
}


jQuery(document).on('click','#add_per_person_price',function(){

    var cust_per_person_price=jQuery(".cust_per_person_price").length;
    $('.jGrowl-notification').trigger('jGrowl.close'); 
    if(cust_per_person_price==8){

        jGrowlAlert("No more than 8 Person Price added", 'danger');
        return false;
    }
    if(cust_per_person_price==0){
        var person_str="Person";
    } else {
        var person_str="Persons";
    }
    var restriction_field=' <div class="form-group"><div class="row"><div class="col-md-4"> <label class="col-form-label label_text text-lg-right per_person_lbl">'+(cust_per_person_price+1)+' '+person_str+'<small class="req text-danger">*</small></label> <input type="text" class="form-control cust_per_person_price required" name="per_person[]" autocomplete="off" placeholder="Price" value=""></div><div class="col-md-2"> <button name="remove_person_price" type="button" class="btn btn-primary mr-t-30 remove_person_price" >Remove</button></div></div></div>';

    jQuery( "#per_person_price_field" ).append(restriction_field);
    var d_cnt = 0 ;
    jQuery(".cust_per_person_price").each(function(i,v){
        $(this).attr("name","per_person["+d_cnt+"]");
        $(this).rules('add',{
            required:true,
            number:true
        });
            d_cnt++;
    });
    var c_cnt = 0 ;
    jQuery(".per_person_lbl").each(function(i,v){
        if(c_cnt==0){
            var p_str="Person";
        } else {
            var p_str="Persons";
        }
        $(this).html((c_cnt+1)+' '+p_str+'<small class="req text-danger">*</small>');
            c_cnt++;
    });
    
});

jQuery(document).on('click','.remove_person_price',function(){
    //var parentId = jQuery(this).closest("fieldset").parent('div').remove();

    var parentId = jQuery(this).parent().parent().parent('div').remove();
    
    var d_cnt = 0 ;
    jQuery(".cust_per_person_price").each(function(i,v){
        $(this).attr("name","per_person["+d_cnt+"]");
        $(this).rules('add',{
            required:true,
            number:true
        });
            d_cnt++;
    });
    var c_cnt = 0 ;
    jQuery(".per_person_lbl").each(function(i,v){
        if(c_cnt==0){
            var p_str="Person";
        } else {
            var p_str="Persons";
        }
        $(this).html((c_cnt+1)+' '+p_str+'<small class="req text-danger">*</small>');
            c_cnt++;
    });
   
});