jQuery.validator.addMethod("customEmail", function(value, element, param) {
          return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
      },'Your E-mail is wrong');

jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z," "]+$/i.test(value);
}, "Numbers and Special characters are not allowed"); 

jQuery.validator.addMethod("specical_chars", function(value, element) {
  return this.optional(element) || !/[~`!#$%\^&*+=\-\[\]\\'';,/{}|\\"":<>\?]/g.test(value);
}, "Numbers and Special characters are not allowed"); 

$("#myprofileform").validate(
{
  errorElement: 'span',
    rules: 
    {
    	username: {
    		required: true,
    		lettersonly:true,
          specical_chars:true,
          maxlength:25
    	},
        email: {
            required: true,
            email: true,
            customEmail:true
        },	      
    },
   	messages: 
   	{
    	username: {
            required:"Please Enter Username",
		},
        email: {
         	required:"Please Enter Email",
            email:"Please Enter Valid Email"
        },	      
    }	    
}); 

// $.validator.addMethod("matcholdpassword", function(value, element) 
// {
// 	var old_password = CryptoJS.MD5($(element).val());
// 	var user_password = "<?php  echo $user['password']; ?>";

// 	if (old_password == user_password)
// 		return true;
			
// }, "Incorrect password.");

$.validator.addMethod("blankSpace", function(value) { 
  return value.indexOf(" ") < 0 && value != ""; 
});

// jQuery.validator.addMethod("notEqual", function(value, element, param) {
//   return this.optional(element) || value != param;
// }, "Please Enter a different Password value");
jQuery.validator.addMethod("notEqual", function(value, element, param) {
 return this.optional(element) || value != $(param).val();
}, "Please Enter a different Password value");

$("#mypasswordform").validate({
	rules: {
		old_password: {
			required: true,
			remote: {
            			url: BASE_URL+"profile/check_user_oldpassword",
                        type: "POST"
                     },
			//matcholdpassword: true
		},
		new_password: {
			required: true,
			blankSpace:true,
      minlength:8,
      maxlength:20,
      notEqual: "#old_password"
		}, 
		confirm_password: {
			required: true,
			equalTo: "#new_password"
		},  
	},
	messages: {
		old_password: {
			required:"Please Enter Old Password",
			remote:'Incorrect password.'
		},
		new_password: {
			required:"Please Enter New Password",
			blankSpace:"Space not allowed",
			minlength: "Password length must be minimum 8 characters."
		},
		confirm_password: {
			required:"Please Enter Confirm Password",
			equalTo: "Confirm password does not match with password."
		},           
	}      
}); 


jQuery(document).ready(function(){
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
});

const toggleOldPassword = document.querySelector('#toggleOldPassword');
const toggleNewPassword = document.querySelector('#toggleNewPassword');
const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
const old_password = document.querySelector('#old_password');
const new_password = document.querySelector('#new_password');
const confirm_password = document.querySelector('#confirm_password');
toggleOldPassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = old_password.getAttribute('type') === 'password' ? 'text' : 'password';
    old_password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
toggleNewPassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = new_password.getAttribute('type') === 'password' ? 'text' : 'password';
    new_password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
toggleConfirmPassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = confirm_password.getAttribute('type') === 'password' ? 'text' : 'password';
    confirm_password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});