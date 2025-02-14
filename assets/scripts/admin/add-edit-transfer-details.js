jQuery('[name="transfer_email_description"]')
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