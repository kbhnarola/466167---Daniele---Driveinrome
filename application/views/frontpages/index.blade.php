@extends('layouts.app-admin')

@section('title')
	{{ $title }}
@endsection
@section('page_header')
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<!-- <i class="icon-users2 position-left"></i> -->
					<span class="text-semibold">{{__('setting')}}</span>
				</h4>
			</div>
		</div>
		@if ( isset( $breadcrumbs ) )
			@include('layouts.admin.breadcrumb', ['breadcrumbs' => $breadcrumbs])
		@endif
	</div>
@endsection
<!-- Content area -->
@section('content')
<div class="content">
	<form action="" method="POST" id="settings_form" name="settings_form">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<!-- Panel -->
				<div class="panel panel-flat">
					<!-- Panel body -->
					<div class="panel-body">
						<div class="tabbable nav-tabs-vertical nav-tabs-left">
							<ul class="nav nav-tabs nav-tabs-highlight">
								<li class="active">
									<a href="#group-general" data-toggle="tab">{{__('company_info')}}</a>
								</li>								
								<li>
									<a href="#group-social-media" data-toggle="tab">{{__('social_media')}}</a>
								</li>
								{{--<li>
									<a href="#group-dummy-1" data-toggle="tab">{{__('email')}}</a>
								</li>--}}
								<li>
									<a href="#group-dummy-2" data-toggle="tab">GDPR cookie policy</a>
								</li>
								
								<li>
									<a href="#group-dummy-4" data-toggle="tab">{{__('subscriber_plan')}}</a>
								</li>
							</ul>
							<div class="tab-content">
								<!-- tab pane for group-company-info -->
								<div class="tab-pane active has-padding" id="group-general">
									<div class="form-group ">										
										<label>{{__('company_name')}}:</label>
										<input type="text" name="company_name" id="company_name" class="form-control" value="{{get_settings('company_name')}}" >
									</div>
									<div class="form-group ">										
										<label>{{__('company_email')}}:</label>
										<input type="email" name="company_email" id="company_email" class="form-control" value="{{get_settings('company_email')}}" >
									</div>	
									
									<div class="form-group">
										<label>Phone No:</label>
										<input type="text" name="phone_no" id="phone_no" class="form-control" value="{{get_settings('phone_no')}}">
									</div>
									<div class="form-group ">										
										<label>{{__('company_logo')}}:</label>
										<input type="file" name="company_logo" id="company_logo" class="form-control" value="" >
										<div id="feature_img_show" class="mr-t-5">
											@if(get_settings('company_logo'))
												<img src="{{ asset('assets/images/'.get_settings('company_logo'))}}" width="100" height="100" id="logo_image">
											@else 
												<img src="" class="hidden" width="100" height="100" id="logo_image">
											@endif
		                                </div>
		                                <input type="hidden" name="company_logo_saved" id="company_logo_saved" class="form-control" value="{{get_settings('company_logo')}}" >
									</div>
									<div class="form-group ">										
										<label>{{__('footer_logo')}}:</label>
										<input type="file" name="company_footer_logo" id="company_footer_logo" class="form-control" value="" >
										<div id="company_footer_logo_show" class="mr-t-5">
											@if(get_settings('company_footer_logo'))
												<img src="{{ asset('assets/images/'.get_settings('company_footer_logo'))}}" width="100" height="100" id="footer_logo_image">
											@else 
												<img src="" class="hidden" width="100" height="100" id="footer_logo_image">
											@endif
		                                </div>
		                                <input type="hidden" name="footer_logo" id="footer_logo" class="form-control" value="{{get_settings('company_footer_logo')}}" >
									</div>
																	
								</div>
								
								<div class="tab-pane has-padding" id="group-social-media">
									<div class="form-group has-feedback has-feedback-left">
										<label>Facebook URL:</label>
										<input type="url" class="form-control" name="facebook_url" id="facebook_url" value="{{get_settings('facebook_url')}}">
										<div class="form-control-feedback">
											<i class="icon-facebook2"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>YouTube URL:</label>
										<input type="url" class="form-control" name="youtube_url" id="youtube_url" value="{{get_settings('youtube_url')}}">
										<div class="form-control-feedback">
											<i class="icon-youtube"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>Twitter URL:</label>
										<input type="url" class="form-control" name="twitter_url" id="twitter_url" value="{{get_settings('twitter_url')}}">
										<div class="form-control-feedback">
											<i class="icon-twitter2"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>Instagram URL:</label>
										<input type="url" class="form-control" name="instagram_url" id="instagram_url" value="{{get_settings('instagram_url')}}">
										<div class="form-control-feedback">
											<i class="icon-instagram"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>Google Map URL:</label>
										<input type="url" class="form-control" name="google_plus_url" id="google_plus_url" value="{{get_settings('google_plus_url')}}">
										<div class="form-control-feedback">
											<!-- <i class="icon icon-location"></i> -->
											<i class="fa fa-map-marker setting_icon1" aria-hidden="true"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>Pinterest URL:</label>
										<input type="url" class="form-control" name="pinterest_url" id="pinterest_url" value="{{get_settings('pinterest_url')}}">
										<div class="form-control-feedback">
											<i class="fa fa-pinterest" aria-hidden="true"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>Vimeo URL:</label>
										<input type="url" class="form-control" name="vimeo_url" id="vimeo_url" value="{{get_settings('vimeo_url')}}">
										<div class="form-control-feedback">
											<i class="fa fa-vimeo-square" aria-hidden="true"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>LinkedIn URL:</label>
										<input type="url" class="form-control" name="linkden_url" id="linkden_url" value="{{get_settings('linkden_url')}}">
										<div class="form-control-feedback">
											<i class="fa fa-linkedin-square" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<!-- /tab pane for group-social-media -->
								<!-- tab pane for group-email -->
								{{--<div class="tab-pane has-padding" id="group-dummy-1">									
									<div class="form-group">
										<label>SMTP Host:</label>
										<input type="text" name="smtp_host" id="smtp_host" class="form-control" value="{{get_settings('smtp_host')}}">
									</div>
									<div class="form-group">
										<label>SMTP Port:</label>
										<input type="number" name="smtp_port" id="smtp_port" class="form-control" value="{{get_settings('smtp_port')}}">
									</div>
									<div class="form-group">
										<label>SMTP Encryption:</label>										
										<select class="select form-control" name="smtp_encryption" id="smtp_encryption">
                            				<option value="ssl" @if(get_settings('smtp_encryption')=='ssl') selected @endif >SSL</option>
                            				<option value="tls" @if(get_settings('smtp_encryption')=='tls') selected @endif>TLS</option>
                            			</select>
									</div>
									<div class="form-group">
										<label>SMTP User:</label>
										<input type="text" name="smtp_user" id="smtp_user" class="form-control" value="{{get_settings('smtp_user')}}">
									</div>
									<div class="form-group">
										<label>SMTP Password:</label>
										<input type="text" name="smtp_password" id="smtp_password" class="form-control" value="{{get_settings('smtp_password')}}">
									</div>									
									<div class="form-group">
										<label>From Name:</label>
										<input type="text" name="from_name" id="from_name" class="form-control" value="{{get_settings('from_name')}}">
									</div>
									<div class="form-group">
										<label>Reply to Email:</label>
										<input type="email" name="reply_to_email" id="reply_to_email" class="form-control" value="{{get_settings('reply_to_email')}}">
									</div>
									<div class="form-group">
										<label>Reply to Name:</label>
										<input type="text" name="reply_to_name" id="reply_to_name" class="form-control" value="{{get_settings('reply_to_name')}}">
									</div>
									<div class="form-group">
										<label>BCC All Emails to:</label>
										<input type="email" name="bcc_emails_to" id="bcc_emails_to" class="form-control" value="{{get_settings('bcc_emails_to')}}">
									</div>
									
									<div class="form-group">
										<label>Email Header:</label>
										<textarea name="email_header" id="email_header" rows="8" class="form-control" placeholder="Common Email Header in HTML format">{{ get_settings('email_header')}}</textarea>
									</div>
									<div class="form-group">
										<label>Email Footer:</label>
										<textarea name="email_footer" id="email_footer" rows="8" class="form-control" placeholder="Common Email Footer in HTML format">{{ get_settings('email_footer')}}</textarea>
									</div>
									<hr/>
									<h5>Send Test Email</h5>
									<p class="text-muted">Send test email to make sure that your SMTP settings are set correctly.</p>
									<div class="form-group">
										<div class="input-group">										
										<input type="email" id="test_email" class="form-control" placeholder="Email Address">
										<div class="input-group-btn">
											<button type="button" class="btn btn-default test_email">Test</button>
										</div>
										</div>	
									</div>									
								</div>--}}
								<div class="tab-pane has-padding" id="group-dummy-2">	
									<div class="form-group">
										<label>GDPR cookie Dutch:</label>
										<input type="text" name="gdpr_cookie_dutch" id="gdpr_cookie_dutch" class="form-control" value="{{get_settings('gdpr_cookie_dutch')}}">
									</div>
									<div class="form-group">
										<label>GDPR cookie English:</label>
										<input type="text" name="gdpr_cookie_english" id="gdpr_cookie_english" class="form-control" value="{{get_settings('gdpr_cookie_english')}}">
									</div>
									<div class="form-group">
										<label>GDPR cookie Spanish:</label>
										<input type="text" name="gdpr_cookie_spanish" id="gdpr_cookie_spanish" class="form-control" value="{{get_settings('gdpr_cookie_spanish')}}">
									</div>
									<div class="form-group">
										<label>GDPR cookie German:</label>
										<input type="text" name="gdpr_cookie_german" id="gdpr_cookie_german" class="form-control" value="{{get_settings('gdpr_cookie_german')}}">
									</div>
								</div>
								
								<div class="tab-pane has-padding" id="group-dummy-4">
									<div class="form-group ">										
										<label>{{__('plan_price')}}:</label>
										<input type="text" name="subscribe_plan_price" id="subscribe_plan_price" class="form-control" value="{{get_settings('subscribe_plan_price')}}" >
									</div>
									<div class="form-group ">										
										<label>{{__('currency_symbol')}}:</label>
										<input type="text" name="currency_symbol" id="currency_symbol" class="form-control" value="{{get_settings('currency_symbol')}}" >
									</div>
									<div class="form-group ">										
										<label>{{__('stripe_public_key')}}:</label>
										<input type="text" name="stripe_public_key" id="stripe_public_key" class="form-control" value="{{get_settings('stripe_public_key')}}" >
									</div>
									<div class="form-group ">										
										<label>{{__('stripe_private_key')}}:</label>
										<input type="text" name="stripe_private_key" id="stripe_private_key" class="form-control" value="{{get_settings('stripe_private_key')}}" >
									</div>
									<div class="form-group ">										
										<label>{{__('stripe_price_id')}}:</label>
										<input type="text" name="stripe_price_id" id="stripe_price_id" class="form-control" value="{{get_settings('stripe_price_id')}}" readonly>
									</div>
									<div class="form-group ">										
										<label>{{__('ideal_public_key')}}:</label>
										<input type="text" name="ideal_public_key" id="ideal_public_key" class="form-control" value="{{get_settings('ideal_public_key')}}" >
									</div>
									<div class="form-group ">										
										<label>{{__('ideal_private_key')}}:</label>
										<input type="text" name="ideal_private_key" id="ideal_private_key" class="form-control" value="{{get_settings('ideal_private_key')}}" >
									</div>
									{{--<div class="form-group ">										
										<label>{{__('description')}}:</label>
										<textarea name="subscribe_plan_description" id="subscribe_plan_description" class="form-control resize_box" rows="15">{{get_settings('subscribe_plan_description')}}</textarea>
									</div>--}}
								</div>
							</div>
						</div>
					</div>
					<!-- /Panel body -->
				</div>
				<!-- /Panel -->
			</div>
		</div>			
		<div class="btn-bottom-toolbar text-right btn-toolbar-container-out">
			<button type="submit" name="setting_submit" class="btn btn-success">{{__('save_settings')}}</button>			
		</div>
	</form>
</div>
@endsection
<!-- /Content area -->
@section('footer_js')
	<script type="text/javascript">

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

jQuery("#settings_form").validate({
	submitHandler:function(form){
		var form1 = $('#settings_form')[0];
	    var formData = new FormData(form1);
		$.ajax({
			url:ADMIN_URL+'/setting/add',
			type: 'POST',
			data: formData,
			dataType:"JSON",
			contentType: false,
	        processData: false,
            beforeSend: function() {                        
                jQuery('.load-main').removeClass('hidden');
            },
			success: function(res)
			{ 
				jQuery('.load-main').addClass('hidden');
				if (res.success)
	            {  
	            	if(res.imgurl) {
	            		jQuery("#company_logo").val(null);
	            		jQuery("#logo_image").attr('src',res.imgurl);
	            		jQuery("#logo_image").removeClass('hidden');
	            		jQuery("#company_logo_saved").val(res.img_name);
					} 

					if(res.footer_logo_url) {
	            		jQuery("#company_footer_logo").val(null);
	            		jQuery("#footer_logo_image").attr('src',res.footer_logo_url);
	            		jQuery("#footer_logo_image").removeClass('hidden');
	            		jQuery("#footer_logo").val(res.footer_logo_name);
					} 
	            	
	            	     
	            	toast_success(res.alert_msg);            
	                
	            } else {
	            	toast_error(res.alert_msg);
	            }
	            
			}
		});
	}

});
	
$('.test_email').on('click', function() {
      var email = $('#test_email').val();
      if (email != '') {
       $(this).attr('disabled', true);
       $.post(ADMIN_URL+'/setting/send_smtp_test_email', {
        test_email: email
      }).done(function(msg) {
        	if (msg=='true')
            {   
            	toast_success('Seems like your SMTP settings are set correctly. Check your email now.');                                    
            }
            else
            {
            	toast_error('Seems like your SMTP settings are not set correctly. Please check again.');
            	//jGrowlAlert('Seems like your SMTP settings are not set correctly. Please check again.', 'danger');
            }
            $('.test_email').removeAttr('disabled');
            $('#test_email').val('');
      });
    }
  });
jQuery("#company_logo").change(function(){
            
        jQuery("#settings_form").validate();
        jQuery(this).rules("add", {
            extension:"jpg,png,jpeg,svg",
            filesize: true,
            messages:{
                extension:'File type must be JPG, JPEG or PNG',
                filesize:'File size must be less than 800 KB'
        }});
    
    $('#company_logo').valid();
});

jQuery("#company_footer_logo").change(function(){
            
        jQuery("#settings_form").validate();
        jQuery(this).rules("add", {
            extension:"jpg,png,jpeg,svg",
            filesize: true,
            messages:{
                extension:'File type must be JPG, JPEG or PNG',
                filesize:'File size must be less than 800 KB'
        }});
    
    $('#company_footer_logo').valid();
});



</script>
@endsection