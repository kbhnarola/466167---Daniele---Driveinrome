$(document).ready(function(){
    $(function() {
        $('#formsubmitbtn').click(function(e) {
            e.preventDefault();
            var name = $("#first_name").val();
            var email = $("#email").val();
            // if(name == '' && email == ''){
            //     alert('empty');
            // }
            // else{
            //     alert('else');
            //     $('#submitform').trigger('submit');
            // }
            // if (!$("#submitform").valid()) {
            //     alert('if');
            //     return false;
            //   }
            //   else{
            //     alert('else');
            //   }
            // if()
            //   $("#submitform").submit();
        });
        // $("#submitform").valid()
    });
    //   $("#submitform").on('submit', function(e){
    //     e.preventDefault();
    //     var form = $(this);

    //     form.parsley().validate();

    //     if (form.parsley().isValid()){
    //         alert('valid');
    //     }else{
    //         alert('in valid');
    //     }
    // });

    // $( '#submitform' ).parsley().validate();
    // $( "#formsubmitbtn" ).click(function() {
    //     if ( $( '#submitform' ).parsley().isValid()){
    //                 alert('valid');
    //                 // return false;
    //             }else{
    //                 alert('in valid');
    //             }
	// 	// $("#submitform").submit();
	// });


    // $("#submitform").parsley().whenValidate({
    //     group: 2
    // }).done(function() {
    //     alert('DFG');
    //     return false;
    //     // trigger step change
    // });

//     var $form = $('#submitform');
// $('#formsubmitbtn').click (function () {
//     if ( $form.parsley().validate() )
//       alert ( 'valid' );
//     else
//       alert ('invalid');
// });
});