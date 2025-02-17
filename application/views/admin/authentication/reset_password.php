<!-- Password recovery -->
<form  id="reset_form" action="<?php echo site_url($this->uri->uri_string()); ?>" method="POST">
	<div class="panel panel-body login-form">
		<div class="text-center">
			<div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
			<h5 class="content-group"><?php _el('reset_password');?></h5>

		</div>

		<?php $this->load->view('admin/includes/alerts');?>

		<div class="form-group has-feedback has-feedback-left">
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
			<input type="password" class="form-control" placeholder="<?php _el('new_password');?>" name="password" id="password">
			<i class="fa fa-eye toggle-password" id="toggleNewPassword"></i>
		</div>
		<div class="form-group has-feedback has-feedback-left">
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
			<input type="password" name="confirm_password" class="form-control" placeholder="<?php _el('confirm_password');?>" id="confirm_password">
			<i class="fa fa-eye toggle-password" id="toggleConfirmPassword"></i>
			<center><span id="message" align="center"></span></center>

		</div>

		<div class="form-group">
		<button type="submit" class="btn bg-blue btn-block" name="submit"><?php _el('reset_password');?> <i class="icon-arrow-right14 position-right"></i></button>
		</div>

		<a href="<?php echo admin_url('authentication') ?>"><?php _el('login');?></a>
	</div>
</form>

<script type="text/javascript">
$("#reset_form").validate({
	rules: {
		password: {
			required: true,
			minlength: 8
		},
		confirm_password: {
			required: true,
			equalTo: "#password"
		}
	},
	messages:{
		password: {
			required: "<?php _el('please_enter_', _l('password')) ?>",
			minlength: "<?php _el('password_min_length_must_be_', 8)?>"
		},
		confirm_password: {
			required: "<?php _el('please_enter_', _l('confirm_password')) ?>",
			equalTo: "<?php _el('conf_password_donot_match')?>"
		},
	},submitHandler:function(form){
	    	
	        jQuery('.load-main').removeClass('hidden');
	        form.submit();  
	    }
});
const toggleNewPassword = document.querySelector('#toggleNewPassword');
const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
const new_password = document.querySelector('#password');
const confirm_password = document.querySelector('#confirm_password');

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
</script>
