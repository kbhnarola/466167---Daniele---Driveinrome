 $(document).ready(function(){

    //jQuery("#transfer_type").select2();
    // $('#templates_table').DataTable({
    //     // Processing indicator
    //     "processing": true,
    //     // DataTables server-side processing mode
    //     "serverSide": true,
    //     // Initial no order.
    //     "order": [],
    //     "searching": true,
        
    //     // Load data from an Ajax source
    //     "ajax": {
    //         "url": BASE_URL+'emails/getLists/',
    //         "type": "POST"
    //     },
    //     "columns": [
    //             { data: 'RecordID', 'sortable': false,"orderable": false }, //0
    //             { data: 'name' } , //1
    //             { data: 'subject' } , //2                
    //             { data: 'action' }, // 3
    //     ],
    //     //Set column definition initialisation properties
    //     "columnDefs": [ 
    //         {
    //         'targets': [3],
    //         'title': 'Actions',
    //          'searchable': false,
    //          'orderable': false,
    //          'className': 'dt-body-center',
    //          'render': function (data, type, full, meta){
    //             //var id = data.id;
    //             return '<a href="'+BASE_URL+'admin/emails/email-template/'+data+'" data-popup="tooltip" data-placement="top"  title="edit" class="text-info"><i class="icon-pencil7"></i></a>';
    //          }
    //         }          
    //     ]
    // });   
    if(jQuery('#templates_table').length){
        $('#templates_table').DataTable({
            'columnDefs': [ {
            'targets': [2], 
            'orderable': false, 
            }],
        });

        //add class to style style datatable select box
        $('div.dataTables_length select').addClass('datatable-select');
    }
}); 


// $('.summernote').summernote({
//         height: 350
// });
if(jQuery('[name="message"]').length){
    jQuery('[name="message"]')
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
            }).on('summernote.change', function(customEvent, contents, $editable) {

               jQuery('[name="message"]').valid();
            });
}
$('.copy').on('click', function(e){
	e.preventDefault();	
	jQuery('[name="message"]').summernote('editor.insertText', $(this).text());

});

$('#templateform').on('submit', function() {
    if($('.summernote').summernote('isEmpty'))
    {
    	$("#validation_msg").html("<p style='color:red'>Please Enter Template Message.</p>");
    	return false;
    }
    return true;
});

$("#templateform").validate({
    errorElement: 'span',
	rules: {
		subject:{
			required: true,
		},
	},
	messages: {
		subject:{
			required: 'Please Enter Template Subject',
		},
	},	
});