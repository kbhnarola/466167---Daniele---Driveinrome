<!--Page header -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/editors/summernote/summernote.min.js'); ?>"></script>
<style type="text/css">
/*.note-editor{
    font-family:'Times New Roman' !important;
    font-size: 18px !important;
}*/
</style>
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('users_list'); ?></span></h4>
        </div>

    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>"><i class="icon-home2 position-left"></i><?= _l('dashboard'); ?></a>
            </li>
            <li class="active"><?php echo _l('users_list'); ?></li>
        </ul>

    </div>
</div>
<!-- /Page header -->

<!-- Content area -->
<div class="content">        
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-body tag-filter-wrap">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">                        
                                <select id="tag_name_filter" name="tag_name_filter[]" class="form-control select_group" placeholder="<?php echo 'Select a Tag for filter';?>" multiple="true">
                                    <option></option>
                                <?php
                                if(!empty($all_active_tags)){                                
                                    foreach($all_active_tags as $single_tag){
                                        ?>
                                        <option value="<?=strtoupper($single_tag['tag_name'])?>"><?=strtoupper($single_tag['tag_name'])?></option>      
                                        <?php
                                    }
                                }
                                ?>                                
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn bg-teal">Filter<i style="margin-left:10px;" class="fa fa-filter"></i></button>
                                <button type="button" class="btn bg-pink">Clear<i style="margin-left:10px;" class="fa fa-remove"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 select-tag-wrap" style="display: none;">
                                <label>Please select tag</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <div class="col-md-6">
            <div class="panel panel-flat">                           
                <div class="panel-heading">
                    <form method="post" id="import_csv" action="<?php echo admin_url('users/import_users'); ?>" enctype="multipart/form-data">
                        <div class="frm-import-users">
                            <!-- <label class="col-form-label label_text text-lg-right ">Select CSV file<small class="req text-danger">*</small></label> -->
                            <input type="file" id="users_csv" class="form-control" name="users_csv" autocomplete="off" placeholder="Users CSV">
                            <input type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn" value="Import Users">
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div> 
    <!-- <div class="row"> -->
        <div class="panel panel-flat">
            <div class="panel-body diff-btn-wrapper">
                <!-- <div class="col-md-3"> -->
                    <a href="javascript:send_to_selected();" class="btn btn-info" id="newsletter_selected">Send Newsletter to Selected<i style="margin-left:10px;" class="fa fa-paper-plane"></i></a>
                <!-- </div> -->
                <!-- <div class="col-md-3"> -->
                    <a href="javascript:unsubscribe_selected();" class="btn btn-danger" id="unsubscribe_selected">Unsubscribe Selected<i style="margin-left:10px;" class="fa fa-user-times"></i></a>
                <!-- </div> -->
                <!-- <div class="col-md-3"> -->
                    <a href="javascript:delete_selected();" class="btn btn-danger" id="delete_selected">Delete Selected<i style="margin-left:10px;" class="fa fa-trash"></i></a>
                <!-- </div> -->
                <!-- <div class="col-md-3"> -->
                    <a href="javascript:assign_tag_to_users();" class="btn bg-brown" id="tag_selected">Assign Tag to Users<i style="margin-left:10px;" class="fa fa-tag"></i></a>
                <!-- </div>                                                             -->
            </div>      
        </div>
    <!-- </div>        -->
    <div class="panel panel-flat">        
        <!-- Listing table -->
        <div class="panel-body table-responsive">
            <table id="users_list_table" class="table table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th width="2%">
                            <input type="checkbox" name="select_all" id="select_all" class="styled" onclick="select_all(this);" >
                        </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Tag</th>
                        <th>Notes</th>
                        <th>Is subscribe</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
            </table>          
        </div>
        <!-- /Listing table -->
    </div>
    <!-- /Panel -->
</div>
 <!-- Start modal popup -->
 <div id="newsletter" class="modal fade" role="dialog" tabindex="-1" style="display: none !important;" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="modal-title">Add newsletter content</h4>
            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
        </div>
        <form  id="addNewsletterContent" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="alert alert-danger hidden" id="error_msg_newsletter" >
                            
                </div>
                <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                          <label  class="col-form-label label_text text-lg-right ">Newsletter Subject<small class="req text-danger">*</small></label>
                          <input type="text" id="newsletter_subject" class="form-control" name="newsletter_subject" autocomplete="off" placeholder="Newsletter Subject">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                          <label  class="col-form-label label_text text-lg-right ">Please add newsletter content!</label>
                          <textarea id="newsletter_content" name="newsletter_content"></textarea>
                          <div class="error newsletter-error" id="newsletter_err"></div>
                      </div>                  
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                          <label  class="col-form-label label_text text-lg-right ">Tour Image 1<small class="req text-danger">*</small></label>
                            <input type="file" id="tour_image1" class="form-control" name="tour_image1" autocomplete="off" >
                      </div>
                      <div class="col-md-6">
                          <label  class="col-form-label label_text text-lg-right ">Tour Image 1 Url</label>
                          <input type="url" id="tour_image1_url" class="form-control" name="tour_image1_url" autocomplete="off" >
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                          <label  class="col-form-label label_text text-lg-right ">Tour Image 2</label>
                          <input type="file" id="tour_image2" class="form-control" name="tour_image2" autocomplete="off" >
                      </div>
                      <div class="col-md-6">
                          <label  class="col-form-label label_text text-lg-right ">Tour Image 2 Url</label>
                          <input type="url" id="tour_image2_url" class="form-control" name="tour_image2_url" autocomplete="off" >
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                          <label  class="col-form-label label_text text-lg-right ">Description</label>
                          <textarea id="newsletter_content_more" name="newsletter_content_more"></textarea>
                          <div class="error newsletter-error-1"></div>
                      </div>                  
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <!-- <div class="modal-form"> -->
                    <input type="hidden" value="" class="hiden_users_ids">
                    <button type="button" class="btn btn-success" id="preview_newsletter">Preview Newsletter</button>
                    <button type="submit" class="btn btn-primary" id="send_newsletter">Submit</button>
                <!-- </div> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </form> 
        <div class="text-center hidden" id="loader_cont_newsletter" >
            <img src="<?php echo ASSET.'images/loader.gif'; ?>">
        </div>       
      </div>
    </div>
  </div>
  <!-- // modal popup for add notes -->
  <div id="add_user_note_modal" class="modal fade" data-backdrop="static">
        <div class="modal-dialog" width="50px">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title addModalTitle"><?php echo 'Add notes'; ?></h5>
                </div>
                <form  id="addUserNotes" method="POST">
                    <div class="modal-body">
                        <div class="alert alert-danger hidden" id="error_msg" >
                            
                        </div>
                        <div class="form-group row">                            
                            <div class="col-sm-12"> 
                                <label  class="col-form-label label_text text-lg-right col-md-3 col-lg-3 col-sm-12"><?php echo 'Notes'; ?><small class="req text-danger">*</small></label>
                                <textarea rows="4" name="user_notes" id="user_notes" autocomplete="off" class="form-control resize_box"></textarea>
                            </div>                            
                        </div>
                    </div>
                    <div class="modal-footer text-center">  
                        <input type="hidden" class="form-control"  id="user_id" name="user_id">                  
                        <button name="user_notes_submit" type="submit" id="user_notes_submit" class="btn btn-primary"><?php _el('save'); ?></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php _el('close'); ?></button>
                    </div>
                </form>
                <div class="text-center hidden" id="loader_cont" >
                    <img src="<?php echo ASSET.'images/loader.gif'; ?>">
                </div>
            </div>
        </div>
    </div>
    <!-- // modal popup for assign tag to users -->
  <div id="assign_tag_to_users_modal" class="modal fade" data-backdrop="static">
        <div class="modal-dialog" width="300px">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><?php echo 'Assign tag'; ?></h5>
                </div>
                <form  id="assignTagFrm" method="POST">
                    <div class="modal-body">
                        <div class="alert alert-danger hidden" id="error_msg" >
                            
                        </div>
                        <div class="form-group">  
                            <div class="row">
                                <div class="col-sm-12 tag-name-wrap"> 
                                    <label  class="col-form-label label_text text-lg-right"><?php echo 'Add tag'; ?><small class="req text-danger">*</small></label>
                                    <input type="text" name="tag_name" id="tag_name" class="form-control" autocomplete="off" placeholder="Tag name">                                
                                </div>                            
                                <div class="col-sm-12 user-list-wrap"> 
                                    <label  class="col-form-label label_text text-lg-right"><?php echo 'Select user emails'; ?><small class="req text-danger">*</small></label>
                                    <select name="users_list[]" id="users_list" multiple class="form-control select_group" >
                                        <?php
                                        // echo '<pre>';
                                        // print_r($data);die;
                                        if(empty($data['all_users'])){
                                            foreach($all_users as $single_user){
                                            ?>
                                                <option value="<?=$single_user['id']?>"><?=$single_user['email']?></option>
                                            <?php
                                            }
                                        }                                    
                                        ?>
                                    </select>
                                </div>                            
                            </div>                            
                        </div>
                    </div>
                    <div class="modal-footer text-center">  
                        <input type="hidden" class="form-control"  id="user_id" name="user_id">                  
                        <button name="users_tag_submit" type="submit" id="users_tag_submit" class="btn btn-primary"><?php _el('save'); ?></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php _el('close'); ?></button>
                    </div>
                </form>
                <div class="text-center hidden" id="loader_cont" >
                    <img src="<?php echo ASSET.'images/loader.gif'; ?>">
                </div>
            </div>
        </div>
    </div>
<div id="editUserInfoModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog" width="60px">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Edit User Details</h5>
            </div>

            <form id="editUserdetailsform" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger hidden" id="error_user_det">
                        
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label  class="col-form-label label_text text-lg-right ">Username<small class="req text-danger">*</small></label>
                                <input type="text" id="edit_username" class="form-control" name="edit_username" autocomplete="off" placeholder="Username">
                            </div>
                            <div class="col-md-6">
                                <label  class="col-form-label label_text text-lg-right ">Email<small class="req text-danger">*</small></label>
                                <input type="text" id="edit_user_email" class="form-control" name="edit_user_email" autocomplete="off" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                  <label  class="col-form-label label_text text-lg-right ">Phone number</label>
                                  <input type="text" id="edit_user_phone" class="form-control" name="edit_user_phone" autocomplete="off" placeholder="Phone number">
                            </div>
                            <div class="col-md-6">
                                
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">  
                    <input type="hidden" class="form-control"  id="edit_user_id" name="edit_user_id"><button name="tour_category_submit" type="submit" id="edit_user_details" class="btn btn-primary"><?php _el('save'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _el('close'); ?></button>
                </div>
            </form>
            <div class="text-center hidden" id="loader_cont_user_det" >
                <img src="<?php echo ASSET.'images/loader.gif'; ?>">
            </div>
        </div>
    </div>
</div>
<script>
jQuery("#users_list").select2({
    placeholder: "Select User emails",
});
jQuery("#tag_name_filter").select2({
    placeholder: "Select tag for filter",
});
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

jQuery("#addUserNotes").validate({
    errorElement: 'span',
    // errorClass: 'validation-error-label',
    rules:{
        user_notes: {
            // required:true,
            // noSpace:true,
            noHTML:true,
            maxlength:200
        }
    },
    messages: {
        user_notes:{
      	required:"Please Enter Notes",
      }
    },
    submitHandler:function(form){        
        var ajaxSubmit=BASE_URL+'users/add_user_notes'; 
        jQuery.ajax({
            url: ajaxSubmit,
            type: 'POST',
            data:jQuery("#addUserNotes").serialize(),
            dataType:'JSON',
            beforeSend: function () {
                    jQuery("#addUserNotes").hide();
                    jQuery("#loader_cont").removeClass('hidden');    
            }, 
            success: function(response) {

                jQuery("#addUserNotes").show();
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

                    jQuery("#addUserNotes")[0].reset();
                    $('#add_user_note_modal').modal('hide');

                    $('#users_list_table').DataTable().ajax.reload();  
                    jGrowlAlert(response.msg, 'success');
                                
                }
            }
        });   
    }
});

jQuery("#assignTagFrm").validate({
    // errorElement: 'span',
    // errorClass: 'validation-error-label',
    rules:{
        tag_name: {
            required:true,
            noSpace:true,
            noHTML:true,
            maxlength:40
        },
        'users_list[]': {
            required:true,
        }
    },
    messages: {
        tag_name:{
            required:"Please Enter tag name",
        },
        'users_list[]':{
            required:"Please select user",
        }
    },
    errorPlacement: function(error, element) { 
        if (element.attr("name") == "users_list[]")
            error.insertAfter(".user-list-wrap .select2-container");  
        else
            error.insertAfter(element); 
    },
    submitHandler:function(form){        
        var ajaxSubmit=BASE_URL+'users/assign_user_tag'; 
        jQuery.ajax({
            url: ajaxSubmit,
            type: 'POST',
            data:jQuery("#assignTagFrm").serialize(),
            dataType:'JSON',
            beforeSend: function () {
                    // jQuery("#assign_tag_to_users_modal").hide();
                    jQuery("#loader_cont").removeClass('hidden');    
            }, 
            success: function(response) {

                jQuery("#assign_tag_to_users_modal").show();
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

                    jQuery("#assignTagFrm")[0].reset();                    
                    jQuery("#users_list").val('').trigger('change');
                    $('#assign_tag_to_users_modal').modal('hide');

                    $('#users_list_table').DataTable().ajax.reload();  
                    jGrowlAlert(response.msg, 'success');
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                                
                }
            }
        });   
    }
});

function add_note(obj)
{   
    // jQuery(".load-main").removeClass('hidden');    
    $.ajax({
        url:BASE_URL+'users/get_record_byID',
        type: 'POST',
        data: {
            user_id: obj.id,
        },
        dataType:'json',
        success: function(data) 
        {
            // console.log('Data : ',data);
            jQuery(".load-main").addClass('hidden');
            if(data.id){

                jQuery('#user_id').val(btoa(data.id));
                
                jQuery("#user_notes").val(data.notes);
                
                if(data.notes != null){
                    jQuery('.addModalTitle').text('Edit notes');
                }else{
                    jQuery('.addModalTitle').text('Add notes');
                }                

                jQuery("#add_user_note_modal").modal('show');
            } else {
                jGrowlAlert(data, 'danger');
            }
        }
    }); 
}

$(document).ready(function(){
    fetch_data();
});
function fetch_data()
{
    var usersDataTable = $('#users_list_table').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        "searching": true,
        //"scrollY": 200,
        //"scrollX": 200,
        "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
        // Load data from an Ajax source
        "ajax": {
            "url": BASE_URL+'users/getLists/',
            "type": "POST",
            'data': function(data){
                data.tag_name = $('#tag_name_filter').val();
            },
            beforeSend: function(){
                // Here, manually add the loading message.
                $('#users_list_table > tbody').html(
                  '<tr class="odd">' +
                    '<td valign="top" colspan="9" class="dataTables_empty">Loading&hellip;</td>' +
                  '</tr>'
                );
              },
              error: function() {
                jGrowlAlert("Something Went wrong!", 'danger');
              }
            // 'data': function(data){
            //     // Read values
            //     var dropdown1 = $('#dropdown1').val();

            //     // Append to data
            //     data.tag = dropdown1;
            // }
        },
        "columns": [
                { data: null, 'sortable': false,"orderable": false }, //0
                { data: 'username' } , //1
                { data: 'email','sortable': false,"orderable": false } , //2
                { data: 'phone_number','sortable': false,"orderable": false } , //3
                { data: 'tag','sortable': false,"orderable": false } , //4
                { data: 'notes','sortable': false,"orderable": false } , //5
                { data: null,"orderable": false  },// 6
                { data: 'created_at','sortable': false,"orderable": false  } , //7
                { data: 'action' } , //8
        ],
        "columnDefs": [ 
            {
                'targets': [0],
                 width: "5%",
                'title': '<input type="checkbox" name="select_all" id="select_all" class="styled" onclick="select_all(this);" >',
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){                    
                    // return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'+ btoa(data.id) +'" checked="checked"></label></div>';                   
                    return '<input type="checkbox" class="checkbox styled"  name="delete"  id="'+ btoa(data.id) +'">';                   
                }
            },
            {
                'targets': [1],
                width: "10%"
            },
            {
                'targets': [2],
                width: "10%"
            },
            { "targets": [3],width: "5%" },
            {
                'targets': [4],
                width: "10%"
            },
            { "targets": [5], width: "10%" },
            {
                'targets': [6],
                width: "15%",
                'title': 'Is subscribe',
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    if(data.is_subscribe == 1){
                        return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'+ btoa(data.id) +'" checked="checked"></label></div>';
                    }else{
                        return '<div class="checkbox checkbox-switch"><label><input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" onchange="change_status(this);" id="'+btoa(data.id)+'" ></label></div>';
                    }
                }
            },
            {
                'targets': [7],
                width: "15%"
            },
            {
                'targets': [8],
                 width: "20%",
                'title': 'Actions',
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    //var id = data.id;
                    return '<a href="javascript:" data-popup="tooltip" data-placement="top"  title="edit" onclick="edit_record(this)" id="'+data+'" class="text-info"><i class="icon-pencil7"></i></a>&nbsp;&nbsp;<a href="javascript:" data-popup="tooltip" data-placement="top"  title="notes" onclick="add_note(this)" id="'+data+'" class="text-info"><i class="fa fa-sticky-note fa-lg"></i></a>&nbsp;&nbsp;<a href="javascript:" data-popup="tooltip" data-placement="top"  title="remove tag" onclick="remove_tag(this)" id="'+data+'" class="text-danger"><i class="fa fa-tag fa-lg"></i></a>&nbsp;&nbsp;<a data-popup="tooltip" data-placement="top"  title="delete" href="javascript:" onclick="delete_record(this)" class="text-danger delete" id="'+data+'"><i class=" icon-trash"></i></a>';
                }
            }
        ],
        //fixedColumns: true
    });
    jQuery(document).on('click', 'button.btn.bg-pink', function(event) {        
        jQuery("#tag_name_filter").val('').trigger('change');
        $('#users_list_table').DataTable().destroy();
        jQuery('.select-tag-wrap').hide();
        fetch_data();
        // jQuery('#users_list_table').DataTable().ajax.reload();
    });
    jQuery(document).on('click','button.btn.bg-teal', function (e) {
        var vv=jQuery('#tag_name_filter').val();
        
        if(vv) {
            if(vv.length==0) {
                jQuery('.select-tag-wrap').show();
            } else {
                jQuery('.select-tag-wrap').hide();
                $('#users_list_table').DataTable().ajax.reload();
            }
        } else {
            
            jQuery('.select-tag-wrap').show();
            // console.log("else")
            // jQuery('.select-tag-wrap').hide();
            // $('#users_list_table').DataTable().ajax.reload();
            // jQuery.each(substr, function(index, item) {
            //     console.log(item);
            // });
            //console.log(jQuery('#tag_name').val());
            //usersDataTable.columns(4).search( jQuery('#tag_name').val() ).draw();
        }
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

/**
 * Unsubscribe multiple users
 */
function unsubscribe_selected()
{
    var users_ids = [];

    $(".checkbox:checked").each(function()
    {
        var id = $(this).attr('id');
        users_ids.push(id);
    });
    if (users_ids == '')
    {
        jGrowlAlert("<?php echo 'Please select some records for unsubscribe users'?>", 'danger');
        // preventDefault();
    }else{
    
        swal( {
            title: "<?php echo 'Are you sure you want to unsubscribe selected records?';?>",        
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"<?php _el('no_cancel_it');?>",
            confirmButtonText: "<?php _el('yes_i_am_sure');?>",
        },
        function()
        {
            jQuery('.hiden_users_ids').val(users_ids);
            jQuery(".load-main").removeClass('hidden');
            $.ajax({
                url:BASE_URL+'users/unsubscribe_users',
                type: 'POST',
                data: {
                ids:jQuery('.hiden_users_ids').val()
                },
                success: function(msg)
                {
                    if (msg=="true")
                    {
                        setTimeout(function(){
                            jQuery(".load-main").addClass('hidden');
                            swal({
                                title: "<?php echo 'Users unsubscribe successfully';?>",
                                type: "success",
                            });
                        },100); 
                        $('#users_list_table').DataTable().destroy();
                        fetch_data();                                       
                        // $(users_ids).each(function(index, element)
                        // {
                        //     $("#"+element).closest("tr").remove();
                        // });
                    }
                    else if(msg == "already unsubscribed"){
                        setTimeout(function(){
                            jQuery(".load-main").addClass('hidden');
                            swal({
                                title: "<?php echo 'Selectd users already unsubscribed';?>",
                                type: "error",
                            });
                        },100);
                    }
                    else
                    {
                        setTimeout(function(){
                            jQuery(".load-main").addClass('hidden');
                            swal({
                                title: "<?php _el('access_denied', _l('users'));?>",
                                type: "error",
                            });
                        },100);
                        
                    }
                }
            });
        });
    }
}
/**
 * Add tag to multiple users
 */
function assign_tag_to_users()
{
    jQuery("#assign_tag_to_users_modal").modal('show');
}
/**
 * Insert data into newsletter table for send newsletter later on to user using cron job
 */
function send_to_selected()
{
    var users_ids = [];

    $(".checkbox:checked").each(function()
    {
        var id = $(this).attr('id');
        users_ids.push(id);
    });
    if (users_ids == '')
    {
        jGrowlAlert("<?php _el('select_before_send_alert', _l('users'))?>", 'danger');
        // preventDefault();
    }else{
        $('#newsletter').modal('show');
        jQuery('.hiden_users_ids').val(users_ids);
    }
    
    // swal( {
    //     title: "<?php _el('multiple_deletion_alert');?>",
    //     text: "<?php _el('multiple_recovery_alert');?>",
    //     type: "warning",
    //     showCancelButton: true,
    //     cancelButtonText:"<?php _el('no_cancel_it');?>",
    //     confirmButtonText: "<?php _el('yes_i_am_sure');?>",
    // },
    // function()
    // {
        // $.ajax({
        //     url:BASE_URL+'users/send_to_selected',
        //     type: 'POST',
        //     data: {
        //       ids:users_ids
        //     },
        //     success: function(msg)
        //     {
        //         console.log(msg);
        //         if (msg=="true")
        //         {
        //             swal({
        //                 title: "<?php _el('_deleted_successfully', _l('users'));?>",
        //                 type: "success",
        //             });
        //             // $(users_ids).each(function(index, element)
        //             // {
        //             //     $("#"+element).closest("tr").remove();
        //             // });
        //         }
        //         else
        //         {
        //             swal({
        //                 title: "<?php _el('access_denied', _l('users'));?>",
        //                 type: "error",
        //             });
        //         }
        //     }
        // });
    // });
}
/**
 * Delete multiple users
 */
function delete_selected()
{
    var users_ids = [];

    $(".checkbox:checked").each(function()
    {
        var id = $(this).attr('id');
        users_ids.push(id);
    });
    if (users_ids == '')
    {
        jGrowlAlert("<?php echo 'Please select some records for delete users'?>", 'danger');
        // preventDefault();
    }else{
    
        swal( {
            title: "<?php echo 'Are you sure you want to delete selected records?';?>",        
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"<?php _el('no_cancel_it');?>",
            confirmButtonText: "<?php _el('yes_i_am_sure');?>",
        },
        function()
        {
            jQuery('.hiden_users_ids').val(users_ids);
            jQuery(".load-main").removeClass('hidden');
            $.ajax({
                url:BASE_URL+'users/delete',
                dataType:'JSON',
                type: 'POST',
                data: {
                ids:jQuery('.hiden_users_ids').val(),
                multiple: true
                },
                success: function(msg)
                {
                    if (msg.success)
                    {
                        setTimeout(function(){
                            jQuery(".load-main").addClass('hidden');
                            swal({
                                title: "<?php echo 'Users deleted successfully';?>",
                                type: "success",
                            });
                        },100); 
                        $('#users_list_table').DataTable().destroy();
                        fetch_data(); 
                    }
                    else
                    {
                        setTimeout(function(){
                            jQuery(".load-main").addClass('hidden');
                            swal({
                                title: "<?php _el('access_denied', _l('users'));?>",
                                type: "error",
                            });
                        },100);
                        
                    }
                }
            });
        });
    }
}

jQuery.validator.setDefaults({
  // This will ignore all hidden elements alongside `contenteditable` elements
  // that have no `name` attribute
  ignore: ":hidden, [contenteditable='true']:not([name])"
});

jQuery('[name="newsletter_content"]')
.summernote({
    height: 400,
    tabsize: 2,
    fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
    followingToolbar: true,
    disableResizeEditor: true,
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
      // callbacks: {
      //           onPaste: function (e) {
      //               if (document.queryCommandSupported("insertText")) {
      //                   var text = $(e.currentTarget).html();
      //                   var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
      //                   e.preventDefault();
      //                   setTimeout(function () {
      //                       document.execCommand('insertText', false, bufferText);
      //                   }, 10);
      //                   e.preventDefault();
      //               } else { //IE
      //                   var text = window.clipboardData.getData("text")
      //                   if (trap) {
      //                       trap = false;
      //                   } else {
      //                       trap = true;
      //                       setTimeout(function () {
      //                           document.execCommand('paste', false, text);
      //                       }, 10);
      //                       e.preventDefault();
      //                   }
      //               }

      //           }
      //       }
}).on('summernote.change', function(customEvent, contents, $editable) {
    // Revalidate the content when its value is changed by Summernote
   // validation.revalidateField('summernote_description');
//    jQuery('[name="newsletter_content"]').valid();
$("#newsletter_content").summernote('code')
               .replace(/<\/p>/gi, "\n")
               .replace(/<br\/?>/gi, "\n")
               .replace(/<\/?[^>]+(>|$)/g, "");
});
jQuery('[name="newsletter_content_more"]')
.summernote({
    height: 400,
    tabsize: 2,
    fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
    followingToolbar: true,
    disableResizeEditor: true,
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
      // callbacks: {
      //           onPaste: function (e) {
      //               if (document.queryCommandSupported("insertText")) {
      //                   var text = $(e.currentTarget).html();
      //                   var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

      //                   setTimeout(function () {
      //                       document.execCommand('insertText', false, bufferText);
      //                   }, 10);
      //                   e.preventDefault();
      //               } else { //IE
      //                   var text = window.clipboardData.getData("text")
      //                   if (trap) {
      //                       trap = false;
      //                   } else {
      //                       trap = true;
      //                       setTimeout(function () {
      //                           document.execCommand('paste', false, text);
      //                       }, 10);
      //                       e.preventDefault();
      //                   }
      //               }

      //           }
      //       }
}).on('summernote.change', function(customEvent, contents, $editable) {
    // Revalidate the content when its value is changed by Summernote
   // validation.revalidateField('summernote_description');
//    jQuery('[name="newsletter_content"]').valid();
$("#newsletter_content_more").summernote('code')
               .replace(/<\/p>/gi, "\n")
               .replace(/<br\/?>/gi, "\n")
               .replace(/<\/?[^>]+(>|$)/g, "");
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

jQuery("#addNewsletterContent").validate({
    errorElement: 'span',
    rules:{
        newsletter_subject: {
            required:true,
            noSpace:true,
            noHTMLtags:true,
            maxlength:100,
            remote: {
                url: BASE_URL+"users/isNewsletterTitleExists",
                type: "POST"
            }
        },
        // newsletter_content:{
        //     required:true,
        //     noSpace:true,
        //     newsletter_content_validate:true
        // },
        tour_image1:{
           required:true,
           extension:"jpg,png,jpeg",
           //filesize: 2097152
            filesize: true
        },
        // tour_image1_url:{
        //    required:true
        // }
    },
    // errorPlacement: function (error, element) {
    //    // console.log('dd', element.attr("name"))
    //     // if (element.attr("name") == "newsletter_content") {
    //     //     error.appendTo("#newsletter_err");
    //     // } else {
    //     //     error.insertAfter(element)
    //     // }
    // },
    messages: {
        newsletter_subject: {
            remote:"Newsletter subject already exists"
        },
        tour_image1:{
            //required:"Please Select Feature Image",
            extension:'File type must be JPG, JPEG or PNG',
            filesize:'File size must be less than 800 KB',
            //feature_image_minImageHeight:'Min Height of image must be 700',
            //feature_image_minImageWidth:'Min Width of image must be 1000'
       }
    },
    submitHandler:function(form){

        var ajaxSubmit=BASE_URL+'users/send_newsletter_email';
        var form1 = $('#addNewsletterContent')[0];
        var formData = new FormData(form1);
        var users_ids = jQuery('.hiden_users_ids').val();
        formData.append('ids', users_ids);
        jQuery.ajax({
            url: ajaxSubmit,
            type: 'POST',
            data:formData,
            dataType:'JSON',
            contentType: false,
            processData: false,
            beforeSend: function () {
                  jQuery("#addNewsletterContent").hide();
                  jQuery("#loader_cont_newsletter").removeClass('hidden');    
            }, 
            success: function(response) {

                jQuery("#addNewsletterContent").show();
                jQuery("#loader_cont_newsletter").addClass('hidden');  
                
                    if(response.success == false) {

                      jQuery("#error_msg_newsletter").html(response.message);
                      //jQuery("#error_msg").show();
                      jQuery("#error_msg_newsletter").removeClass('hidden');

                      setTimeout(function(){

                        jQuery("#error_msg_newsletter").addClass('hidden');
                        jQuery("#error_msg_newsletter").html("");
                             
                        }, 3000);
                      
                    } else if(response.success == true) {

                      jQuery("#addNewsletterContent")[0].reset();
                      $('#newsletter_content').summernote('reset');
                      $('#newsletter_content_more').summernote('reset');
                      $('#newsletter').modal('hide');
                       $('#users_list_table').DataTable().ajax.reload();
                      jGrowlAlert(response.message, 'success');                                   
                    }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                jQuery("#addNewsletterContent").show();
                jQuery("#loader_cont_newsletter").addClass('hidden');  
                jGrowlAlert("Something Wrong.", 'danger'); 
            }
        });   
    }
});

$('#tour_image2').on('change',function(){
    $("#addNewsletterContent").validate();
    
    if($(this).val()) {
        
        // $("#tour_image2_url").rules("add", {
        //    required:true
        // });
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
    // element = $(this).val();
    // var files = this.files;
    // var _URL = window.URL || window.webkitURL;
    // var image, file;
    // image = new Image();
    // image.src = _URL.createObjectURL(files[0]);
    //     image.onload = function() {
    //         element.attr('uploadwidth',this.width);
    //         element.attr('uploadheight',this.height);
    //     }

    jQuery(this).valid();
});
$('#tour_image1').on('change',function(){
    jQuery(this).valid();
});
jQuery(document).on('click','#preview_newsletter',function(){
    if($("#addNewsletterContent").valid()) {
        var ajaxSubmit=BASE_URL+'users/preview_newsletter';
        var form1 = $('#addNewsletterContent')[0];
        var formData = new FormData(form1);
        jQuery.ajax({
            url: ajaxSubmit,
            type: 'POST',
            data:formData,
            dataType:'JSON',
            contentType: false,
            processData: false,
            beforeSend: function () {
                  //jQuery("#addNewsletterContent").hide();
                  //jQuery("#loader_cont_newsletter").removeClass('hidden');    
            }, 
            success: function(response) {

                //jQuery("#addNewsletterContent").show();
                //jQuery("#loader_cont_newsletter").addClass('hidden');  
                
                    if(response.success == false) {

                      jQuery("#error_msg_newsletter").html(response.msg);
                      //jQuery("#error_msg").show();
                      jQuery("#error_msg_newsletter").removeClass('hidden');

                      setTimeout(function(){

                        jQuery("#error_msg_newsletter").addClass('hidden');
                        jQuery("#error_msg_newsletter").html("");
                             
                        }, 3000);
                      
                    } else if(response.success == true) {

                      // jQuery("#addNewsletterContent")[0].reset();
                      // $('#newsletter_content').summernote('reset');
                      // $('#newsletter_content_more').summernote('reset');
                      // $('#newsletter').modal('hide');
                        var x = window.open('', '', 'location=no,toolbar=0');
                        //var html = "<p style='color:blue'>vvv</p>";
                        x.document.body.innerHTML = response.message;
                      //jGrowlAlert(response.message, 'success');                                   
                    }
            }
        });
    }
});

$('#newsletter').on('hidden.bs.modal', function () {
    jQuery("#addNewsletterContent")[0].reset();
    var validator = $("#addNewsletterContent").validate();
    validator.resetForm();
    $('#newsletter_content').summernote('reset');
    $('#newsletter_content_more').summernote('reset');
});
$( document ).ready(function() {
    // var x = window.open('', '', 'location=no,toolbar=0');
    // var html = "<p style='color:blue'>vvv</p>";
    // x.document.body.innerHTML = html;
    //var codeContents = $("#contentsfornewWindow").html()
    //var win = window.open('', 'title', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=1000,height=1000,left=200,top=70');

    //win.document.body.innerHTML = html;
});
// jQuery("#send_newsletter").click(function(){
//     if(jQuery('#newsletter_content').val() == ''){
//         jQuery('.newsletter-error').show();
//     }else{
//         jQuery('.newsletter-error').hide();
//         var users_ids = jQuery('.hiden_users_ids').val();
//         console.log(users_ids);
//         if (users_ids != '')
//         {
//             jQuery(".load-main").removeClass('hidden');
//             $.ajax({
//                 url:BASE_URL+'users/store_selected_user_for_send_newsletter',
//                 type: 'POST',
//                 data: {
//                 ids:users_ids,
//                 email_content:jQuery('#newsletter_content').val()
//                 },
//                 success: function(msg)
//                 {
//                     console.log(msg);
//                     if (msg=="true")
//                     {
//                         jQuery(".load-main").addClass('hidden');
//                         $('#newsletter').modal('hide');
//                         swal({
//                             title: "<?php _el('_send_successfully');?>",
//                             type: "success",
//                         });
//                         $('#users_list_table').DataTable().destroy();
//                         fetch_data();
//                         $('.newsletter-error').hide();
//                         $('#newsletter_content').summernote('reset');
//                     }
//                     else
//                     {
//                         swal({
//                             title: "<?php _el('access_denied', _l('users'));?>",
//                             type: "error",
//                         });
//                         jQuery(".load-main").removeClass('hidden');
//                     }
//                 }
//             });
//         }        
//     }
// });
/**
* Generates the notification on activity
*
* @param {str}  message    The message
* @param {str}  alertType  The alert type
*/
function jGrowlAlert(message, alertType) {

    var header_msg = alertType == 'success' ? 'Success!' : 'Oh Snap!';
    $.jGrowl(message, {
        header: header_msg,
        theme: 'bg-' + alertType
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

// start validation for import user form
jQuery("#import_csv").validate({    
    errorClass: 'validation-error',
    rules: {
        users_csv: {
            required: true,
            extension: "csv|xlsx|xls"
        },
    }, 
    messages: {
        users_csv: {
            required: 'Please upload csv or xlsx or xls file',
            extension: 'Please upload csv or xlsx or xls file only',
        },
    }, 
    errorPlacement: function(error, element) {
        if (element.attr("name") == "users_csv")
            error.insertAfter(".frm-import-users");  
        else
            error.insertAfter(element); 
    },
    submitHandler:function(form){
        jQuery(".load-main").removeClass('hidden');
        form.submit();
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
            url:BASE_URL+'users/delete',
            type: 'POST',
            data: {
                user_id:obj.id
            },
            dataType:'JSON',
            success: function(response)
            {
                jQuery('.load-main').addClass('hidden');
                if(response.success)
                {                        
                    $('#users_list_table').DataTable().ajax.reload();     
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
 * Remove tag when click on remove tag icon
 *
 * @param {int}  id  The identifier
 */
function remove_tag(obj) 
{ 

    swal({
        title: 'Are you sure you want to remove tag from this record?',
        // text: jQuery("#swal_text").val(),
        type: "warning", 
        showCancelButton: true, 
        cancelButtonText: jQuery("#swal_cancelButtonText").val(),
        confirmButtonText: jQuery("#swal_confirmButtonText").val(),  
    },
    function()
    {
        jQuery('.load-main').removeClass('hidden');
        $.ajax({
            url:BASE_URL+'users/remove_tag',
            type: 'POST',
            data: {
                user_id:obj.id
            },
            dataType:'JSON',
            success: function(response)
            {
                jQuery('.load-main').addClass('hidden');
                if(response.success)
                {                        
                    $('#users_list_table').DataTable().ajax.reload();     
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

function edit_record(obj)
{   
    jQuery(".load-main").removeClass('hidden');
    $.ajax({
        url:BASE_URL+'users/get_record_byID',
        type: 'POST',
        data: {
            user_id: obj.id,
        },
        dataType:'json',
        success: function(data) 
        {
            jQuery(".load-main").addClass('hidden');
            if(data.id){

                jQuery('#error_user_det').html('');
                var validator = $("#editUserdetailsform").validate();
                validator.resetForm();
                jQuery("#editUserdetailsform")[0].reset();

                jQuery('#edit_user_id').val(btoa(data.id));
                
                jQuery("#edit_username").val(data.name);
                jQuery("#edit_user_email").val(data.email);
                jQuery("#edit_user_phone").val(data.phone_number);

                jQuery("#editUserInfoModal").modal('show');
            } else {
                jGrowlAlert(data, 'danger');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            jQuery(".load-main").removeClass('hidden');
            jGrowlAlert("Something went wrong!", 'danger');
        }
    }); 
}

jQuery.validator.addMethod("customEmail", function(value, element, param) {
  return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Enter Correct E-mail Address');

jQuery("#editUserdetailsform").validate({
    errorElement: 'span',
    rules:{
        edit_username:{
            required:true,
            noSpace:true,
            noHTML:true,
            maxlength:40
        },
        edit_user_email:{
            required:true,
            noSpace:true,
            customEmail:true,
            remote: {
                        url: BASE_URL+"users/isUserEmailExists",
                        type: "POST",
                        data: {
                            record_id: function() {
                                return $('#edit_user_id').val();
                            },
                        }
                     },
            maxlength:100
        },
        edit_user_phone:{
            //required:true,
            //noSpace:true,
            number:true,
            minlength: 8,
            maxlength: 20,
        }  
    },
    messages: {
      edit_user_email:{
        remote:"Email already exist"
      }
    },
    submitHandler:function(form){      
        var form1 = $('#editUserdetailsform')[0];
        var formData = new FormData(form1);
        jQuery.ajax({
            url: BASE_URL+"users/edit",
            type: 'POST',
            data:formData,
            dataType:'JSON',
            contentType: false,
            processData: false,
            beforeSend: function () {
                  jQuery("#editUserdetailsform").hide();
                  jQuery("#loader_cont_user_det").removeClass('hidden');    
            }, 
            success: function(response) {

                jQuery("#editUserdetailsform").show();
                jQuery("#loader_cont_user_det").addClass('hidden');  
                
                    if(response.success == false) {

                      jQuery("#error_user_det").html(response.msg);
                      jQuery("#error_user_det").removeClass('hidden');

                      setTimeout(function(){

                        jQuery("#error_user_det").addClass('hidden');
                        jQuery("#error_user_det").html("");
                             
                        }, 3000);
                      
                    } else if(response.success == true) {

                      jQuery("#editUserdetailsform")[0].reset();
                      $('#editUserInfoModal').modal('hide');

                      $('#users_list_table').DataTable().destroy();
                      fetch_data(); 
                      jGrowlAlert(response.msg, 'success');
                                   
                    }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                jQuery("#editUserdetailsform").show();
                jQuery("#loader_cont_user_det").addClass('hidden'); 
                jGrowlAlert("Something went wrong!", 'danger');
            }
        });
    } 
});
</script>