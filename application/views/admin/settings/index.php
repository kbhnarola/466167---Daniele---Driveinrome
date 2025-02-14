<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4></i> <span class="text-semibold"><?php _el('settings'); ?></span></h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo admin_url('dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a>
			</li>
			<li class="active"><?php _el('settings'); ?></li>
		</ul>
	</div>
</div>
<!-- /Page header -->
<!-- Content area -->
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
									<a href="#group-general" data-toggle="tab"><?php _el('company_info'); ?></a>
								</li>
								<li>
									<a href="#group-date-time" data-toggle="tab"><?php _el('date_time'); ?></a>
								</li>
								<li>
									<a href="#group-social-media" data-toggle="tab"><?php _el('social_media'); ?></a>
								</li>
								<li>
									<a href="#group-dummy-1" data-toggle="tab"><?php _el('email'); ?></a>
								</li>
								<li>
									<a href="#group-dummy-2" data-toggle="tab"><?php _el('success_message_popup') ?></a>
								</li>
								<li>
									<a href="#group-home-banner" data-toggle="tab"><?php _el('set_home_page_banner'); ?></a>
								</li>
								<li>
									<a href="#group-blog-banner" data-toggle="tab"><?php _el('set_blog_page_banner'); ?></a>
								</li>
								<li>
									<a href="#group-minify-js" data-toggle="tab"><?php _el('minify_js'); ?></a>
								</li>
								<li>
									<a href="#group-topselling-tour-limit" data-toggle="tab"><?php _el('home_page'); ?></a>
								</li>
								<li>
									<a href="#partners-details" data-toggle="tab"><?php _el('partners_password'); ?></a>
								</li>
								<li style="display: none;">
									<a href="#active-campaign" data-toggle="tab"><?php _el('active_campaign'); ?></a>
								</li>
								<!-- <li>
									<a href="#civitavechha-details" data-toggle="tab"><?php _el('civitavechha_page'); ?></a>
								</li> -->
								<!-- <li>
									<a href="#rating-details" data-toggle="tab"><?php _el('google_rating'); ?></a>
								</li> -->
								<li>
									<a href="#payment-affiliate-details" data-toggle="tab"><?php _el('payment_affiliate'); ?></a>
								</li>
								<li>
									<a href="#review-platforms" data-toggle="tab"><?php _el('review_platforms'); ?></a>
								</li>
								<li>
									<a href="#google-recaptcha" data-toggle="tab"><?php _el('google_recaptcha'); ?></a>
								</li>
								<li>
									<a href="#villa-advertisement" data-toggle="tab"><?php _el('villa_advertisement'); ?></a>
								</li>
							</ul>
							<div class="tab-content">
								<!-- tab pane for group-company-info -->
								<div class="tab-pane active has-padding" id="group-general">
									<div class="form-group ">
										<label><?php _el('company_name'); ?>:</label>
										<input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo get_settings('company_name'); ?>">
									</div>
									<div class="form-group ">
										<label><?php _el('company_email'); ?>:</label>
										<input type="email" name="company_email" id="company_email" class="form-control" value="<?php echo get_settings('company_email'); ?>">
									</div>
									<div class="form-group ">
										<label><?php _el('company_logo'); ?>:</label>
										<input type="file" name="company_logo" id="company_logo" class="form-control" value="">
										<div id="feature_img_show" class="mr-t-5">
											<img src="<?php echo base_url('assets/images/' . get_settings('company_logo')); ?>" width="100" height="100" id="logo_image">
											<!-- <button title="close" type="button" class="btn remove_logo" value=""><i class="fa fa-close"></i></button> -->
										</div>
										<input type="hidden" name="company_logo_saved" id="company_logo_saved" class="form-control" value="<?php echo get_settings('company_logo'); ?>">
									</div>

								</div>
								<!-- /tab pane for group-company-info -->
								<!-- tab pane for group-date-time -->
								<div class="tab-pane has-padding" id="group-date-time">
									<div class="form-group ">
										<label>Date Format:</label>
										<select class="select form-control" name="date_format" id="role">
											<option value="j-M-Y" <?php echo (get_settings('date_format') == "j-M-Y") ? "selected" : " "; ?>>
												<?php echo date("j-M-Y"); ?>
											</option>
											<option value="j-m-Y" <?php echo (get_settings('date_format') == "j-m-Y") ? "selected" : " "; ?>>
												<?php echo date("j-m-Y"); ?>
											</option>
											<option value="jS F, Y" <?php echo (get_settings('date_format') == "jS F, Y") ? "selected" : " "; ?>>
												<?php echo date("jS F, Y"); ?>
											</option>
										</select>
									</div>
									<div class="form-group">
										<label>Time Format:</label>
										<select class="select form-control" name="time_format">
											<option value="h:i A" <?php echo (get_settings('time_format') == "h:i A") ? "selected" : " "; ?>>02:30 PM (12 hours)</option>
											<option value="H:i" <?php echo (get_settings('time_format') == "H:i") ? "selected" : " "; ?>>14:30 (24 hours)</option>
										</select>
									</div>
								</div>
								<!-- /tab pane for group-date-time -->
								<!-- tab pane for group-social-media -->
								<div class="tab-pane has-padding" id="group-social-media">
									<div class="form-group has-feedback has-feedback-left">
										<label>Facebook URL:</label>
										<input type="url" class="form-control" name="facebook_url" id="facebook_url" value="<?php echo get_settings('facebook_url'); ?>">
										<div class="form-control-feedback">
											<i class="icon-facebook2"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>YouTube URL:</label>
										<input type="url" class="form-control" name="youtube_url" id="youtube_url" value="<?php echo get_settings('youtube_url'); ?>">
										<div class="form-control-feedback">
											<i class="icon-youtube"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>Twitter URL:</label>
										<input type="url" class="form-control" name="twitter_url" id="twitter_url" value="<?php echo get_settings('twitter_url'); ?>">
										<div class="form-control-feedback">
											<i class="icon-twitter2"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>Instagram URL:</label>
										<input type="url" class="form-control" name="instagram_url" id="instagram_url" value="<?php echo get_settings('instagram_url'); ?>">
										<div class="form-control-feedback">
											<i class="icon-instagram"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>Google Map URL:</label>
										<input type="url" class="form-control" name="google_plus_url" id="google_plus_url" value="<?php echo get_settings('google_plus_url'); ?>">
										<div class="form-control-feedback">
											<!-- <i class="icon icon-location"></i> -->
											<i class="fa fa-map-marker setting_icon1" aria-hidden="true"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>Pinterest URL:</label>
										<input type="url" class="form-control" name="pinterest_url" id="pinterest_url" value="<?php echo get_settings('pinterest_url'); ?>">
										<div class="form-control-feedback">
											<i class="fa fa-pinterest" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<!-- /tab pane for group-social-media -->
								<!-- tab pane for group-email -->
								<div class="tab-pane has-padding" id="group-dummy-1">
									<div class="form-group">
										<label>SMTP Host:</label>
										<input type="text" name="smtp_host" id="smtp_host" class="form-control" value="<?php echo get_settings('smtp_host'); ?>">
									</div>
									<div class="form-group">
										<label>SMTP Port:</label>
										<input type="number" name="smtp_port" id="smtp_port" class="form-control" value="<?php echo get_settings('smtp_port'); ?>">
									</div>
									<div class="form-group">
										<label>SMTP Encryption:</label>
										<select class="select form-control" name="smtp_encryption" id="smtp_encryption">
											<option value="ssl" <?php if (get_settings('smtp_encryption') == 'ssl') echo 'selected'; ?>>SSL</option>
											<option value="tls" <?php if (get_settings('smtp_encryption') == 'tls') echo 'selected'; ?>>TLS</option>
										</select>
									</div>
									<div class="form-group">
										<label>SMTP User:</label>
										<input type="text" name="smtp_user" id="smtp_user" class="form-control" value="<?php echo get_settings('smtp_user'); ?>">
									</div>
									<div class="form-group">
										<label>SMTP Password:</label>
										<input type="password" name="smtp_password" id="smtp_password" class="form-control" value="<?php echo get_settings('smtp_password'); ?>">
									</div>
									<div class="form-group">
										<label>From Name:</label>
										<input type="text" name="from_name" id="from_name" class="form-control" value="<?php echo get_settings('from_name'); ?>">
									</div>
									<div class="form-group">
										<label>Reply to Email:</label>
										<input type="email" name="reply_to_email" id="reply_to_email" class="form-control" value="<?php echo get_settings('reply_to_email'); ?>">
									</div>
									<div class="form-group">
										<label>Reply to Name:</label>
										<input type="text" name="reply_to_name" id="reply_to_name" class="form-control" value="<?php echo get_settings('reply_to_name'); ?>">
									</div>
									<div class="form-group">
										<label>BCC All Emails to:</label>
										<input type="email" name="bcc_emails_to" id="bcc_emails_to" class="form-control" value="<?php echo get_settings('bcc_emails_to'); ?>">
									</div>
									<!-- <div class="form-group">
										<label>Email Signature:</label>
										<textarea name="email_signature" id="email_signature" rows="4" class="form-control"><?php //echo get_settings('email_signature'); 
																															?></textarea>
									</div>
									<div class="form-group">
										<label>Email Header:</label>
										<textarea name="email_header" id="email_header" rows="8" class="form-control" placeholder="Common Email Header in HTML format"><?php //echo get_settings('email_header'); 
																																										?></textarea>
									</div>
									<div class="form-group">
										<label>Email Footer:</label>
										<textarea name="email_footer" id="email_footer" rows="8" class="form-control" placeholder="Common Email Footer in HTML format"><?php //echo get_settings('email_footer'); 
																																										?></textarea>
									</div>	 -->
									<hr />
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
								</div>
								<!-- /tab pane for group-email -->
								<!-- tab pane for group-general -->
								<!-- <div class="tab-pane has-padding" id="group-dummy-2">
									<div class="form-group">
										<label><?php _el('log_activity'); ?> ?:</label>										
										<br>
										<input type="hidden" name="log_activity" value="0" />
										<input type="checkbox" name="log_activity" id="log_activity" value="1" class="switchery form-control" <?php if (get_settings('log_activity') == 1) echo 'checked'; ?> >
									</div>																	
								</div> -->
								<!-- /tab pane for group-general -->
								<!-- tab pane for success msg popup -->
								<div class="tab-pane has-padding" id="group-dummy-2">
									<div class="form-group">
										<label><?php _el('get_a_call_success_message'); ?></label>
										<br>
										<textarea row="2" name="get_a_call_success" id="get_a_call_success" class="form-control resize_box"><?php echo get_settings('get_a_call_success'); ?></textarea>
										<input type="hidden" name="log_activity" value="0" />
										<!-- <input type="checkbox" name="log_activity" id="log_activity" value="1" class="switchery form-control" <?php // if( get_settings('log_activity') == 1 ) echo 'checked'; 
																																					?> > -->
									</div>
								</div>
								<!-- /tab pane for group-general -->

								<!-- tab pane for home-page-banner -->
								<div class="tab-pane has-padding" id="group-home-banner">
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<label>Banner Image 1</label>
												<input type="file" id="home_banner1" class="form-control" name="home_banner1" autocomplete="off">
												<?php
												if (get_settings('home_banner1')) { ?>
													<a href="<?php echo base_url('assets/images/home_page_banner/' . get_settings('home_banner1')); ?>" class="imgClass" id="view_banner1_img" target="_blank" style="color:blue">View Banner Image</a>
												<?php } else { ?>
													<a href="javascript:" class="imgClass hidden" id="view_banner1_img" target="_blank" style="color:blue">View Banner Image</a>
												<?php } ?>
												<input type="hidden" name="banner1_saved" id="banner1_saved" class="form-control" value="<?php echo get_settings('home_banner1'); ?>">
											</div>

										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Banner1 Text small</label>
												<input type="text" id="banner1_text_small" class="form-control" name="banner1_text_small" autocomplete="off" placeholder="Banner1 Text Small" value="<?php echo get_settings('banner1_text_small'); ?>">
											</div>
											<div class="col-md-6">
												<label>Banner1 Text Big</label>
												<input type="text" id="banner1_text_big" class="form-control" name="banner1_text_big" autocomplete="off" placeholder="Banner1 Text Big" value="<?php echo get_settings('banner1_text_big'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<label>Banner Image 2</label>
												<input type="file" id="home_banner2" class="form-control" name="home_banner2" autocomplete="off">
												<?php
												if (get_settings('home_banner2')) { ?>
													<a href="<?php echo base_url('assets/images/home_page_banner/' . get_settings('home_banner2')); ?>" class="imgClass" id="view_banner2_img" target="_blank" style="color:blue">View Banner Image</a>
												<?php } else { ?>
													<a href="javascript:" class="imgClass hidden" id="view_banner2_img" target="_blank" style="color:blue">View Banner Image</a>
												<?php } ?>

												<input type="hidden" name="banner2_saved" id="banner2_saved" class="form-control" value="<?php echo get_settings('home_banner2'); ?>">
											</div>

										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Banner2 Text small</label>
												<input type="text" id="banner2_text_small" class="form-control" name="banner2_text_small" autocomplete="off" placeholder="Banner2 Text Small" value="<?php echo get_settings('banner2_text_small'); ?>">
											</div>
											<div class="col-md-6">
												<label>Banner2 Text Big</label>
												<input type="text" id="banner2_text_big" class="form-control" name="banner2_text_big" autocomplete="off" placeholder="Banner2 Text Big" value="<?php echo get_settings('banner2_text_big'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<label>Banner Image 3</label>
												<input type="file" id="home_banner3" class="form-control" name="home_banner3" autocomplete="off">

												<?php
												if (get_settings('home_banner3')) { ?>
													<a href="<?php echo base_url('assets/images/home_page_banner/' . get_settings('home_banner3')); ?>" class="imgClass" id="view_banner3_img" target="_blank" style="color:blue">View Banner Image</a>
												<?php } else { ?>
													<a href="javascript:" class="imgClass hidden" id="view_banner3_img" target="_blank" style="color:blue">View Banner Image</a>
												<?php } ?>

												<input type="hidden" name="banner3_saved" id="banner3_saved" class="form-control" value="<?php echo get_settings('home_banner3'); ?>">
											</div>

										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Banner3 Text small</label>
												<input type="text" id="banner3_text_small" class="form-control" name="banner3_text_small" autocomplete="off" placeholder="Banner3 Text Small" value="<?php echo get_settings('banner3_text_small'); ?>">
											</div>
											<div class="col-md-6">
												<label>Banner3 Text Big</label>
												<input type="text" id="banner3_text_big" class="form-control" name="banner3_text_big" autocomplete="off" placeholder="Banner3 Text Big" value="<?php echo get_settings('banner3_text_big'); ?>">
											</div>
										</div>
									</div>
								</div>
								<!-- /tab pane for group-home-page-banner -->
								<!-- tab pane for blog-banner -->
								<div class="tab-pane has-padding" id="group-blog-banner">
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<label>Blog Image</label>
												<input type="file" id="blog_banner" class="form-control" name="blog_banner" autocomplete="off">
												<?php
												if (get_settings('blog_banner')) { ?>
													<a href="<?php echo base_url('assets/images/blog_banner/' . get_settings('blog_banner')); ?>" class="imgClass" id="blog_banner_img" target="_blank" style="color:blue">View Banner Image</a>
												<?php } else { ?>
													<a href="javascript:" class="imgClass hidden" id="blog_banner_img" target="_blank" style="color:blue">View Banner Image</a>
												<?php } ?>
												<input type="hidden" name="blog_banner_saved" id="blog_banner_saved" class="form-control" value="<?php echo get_settings('blog_banner'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<label>Blog Banner Text</label>
												<input type="text" id="blog_banner_text" class="form-control" name="blog_banner_text" autocomplete="off" placeholder="Blog Banner Text" value="<?php echo get_settings('blog_banner_text'); ?>">
											</div>
										</div>
									</div>
								</div>
								<!-- /tab pane for blog-banner -->
								<div class="tab-pane has-padding" id="group-minify-js">
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<label>Minify JS: </label>
												<input type="checkbox" onchange="change_status(this);" class="switchery" name="minify_js" <?php if (get_settings('minify_js') == 1) {
																																				echo 'checked';
																																			} ?>>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane has-padding" id="group-topselling-tour-limit">
									<div class="form-group">
										<label>Limit for Top selling product on Home page:</label>
										<select name="top_selling_product_limit" class="form-control">
											<?php
											for ($i = 10; $i <= 100; $i += 10) {
												if ($i == get_settings('top_selling_product_limit')) { ?>
													<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
													<?php } else {
													if (get_settings('top_selling_product_limit')) { ?>
														<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
													<?php } else { ?>
														<option value="<?php echo $i; ?>" <?php if ($i == 20) { ?>selected<?php } ?>><?php echo $i; ?></option>
											<?php }
												}
											} ?>
										</select>
									</div>
									<div class="form-group">
										<label>Youtube Video URL</label>
										<input type="text" name="home_video" value="<?php echo get_settings('home_video'); ?>" class="form-control">
									</div>
									<div class="form-group">
										<label>Video Title</label>
										<input type="text" name="home_video_title" value="<?php echo get_settings('home_video_title'); ?>" class="form-control">
									</div>
									<div class="form-group">
										<label>Video Description</label>
										<textarea name="home_video_description" rows="6" class="form-control"><?php echo get_settings('home_video_description'); ?></textarea>
									</div>
								</div>
								<div class="tab-pane has-padding" id="partners-details">
									<div class="form-group">
										<label>Set Partners Password</label>
										<input type="text" name="partners_password" id="partners_password" class="form-control" value="<?php echo get_settings('partners_password'); ?>">
									</div>
								</div>
								<div class="tab-pane has-padding" id="active-campaign">
									<div class="form-group">
										<?php
										$automations = get_active_automation();
										?>
										<h6>Set active campaign automation for below form/process: (Default: Free guide)</h6>
										<br>
										<label for="contact_form_active_campaign">Contact form:</label>
										<select class="select form-control" name="contact_form_active_campaign" id="contact_form_active_campaign">
											<?php
											if ($automations) {
												foreach ($automations as $automation) {
													if (is_object($automation)) {
											?>
														<option value="<?php echo $automation->id ?>" <?php echo ((get_settings('contact_form_active_campaign') ? get_settings('contact_form_active_campaign') : DEFAULT_ACTIVE_CAMPAIGN_ID) == $automation->id) ? 'selected="selected"' : '' ?>><?php echo $automation->name; ?></option>
											<?php
													}
												}
											}
											?>
										</select>
										<label for="quick_quote_active_campaign">Quick quote form:</label>
										<select class="select form-control" name="quick_quote_active_campaign" id="quick_quote_active_campaign">
											<?php
											if ($automations) {
												foreach ($automations as $automation) {
													if (is_object($automation)) {
											?>
														<option value="<?php echo $automation->id ?>" <?php echo ((get_settings('quick_quote_active_campaign') ? get_settings('quick_quote_active_campaign') : DEFAULT_ACTIVE_CAMPAIGN_ID) == $automation->id) ? 'selected="selected"' : '' ?>><?php echo $automation->name; ?></option>
											<?php
													}
												}
											}
											?>
										</select>
										<label for="custom_booking_active_campaign">Custom booking process:</label>
										<select class="select form-control" name="custom_booking_active_campaign" id="custom_booking_active_campaign">
											<?php
											if ($automations) {
												foreach ($automations as $automation) {
													if (is_object($automation)) {
											?>
														<option value="<?php echo $automation->id ?>" <?php echo ((get_settings('custom_booking_active_campaign') ? get_settings('custom_booking_active_campaign') : DEFAULT_ACTIVE_CAMPAIGN_ID) == $automation->id) ? 'selected="selected"' : '' ?>><?php echo $automation->name; ?></option>
											<?php
													}
												}
											}
											?>
										</select>
									</div>
								</div>
								<!-- <div class="tab-pane has-padding" id="civitavechha-details">
									<div class="form-group">
										<label>Youtube Embed Video Url</label>
										<input type="text" name="civitavechha_video" value="<?php echo get_settings('civitavechha_video'); ?>" class="form-control">
									</div>
								</div> -->
								<div class="tab-pane has-padding d-none" id="rating-details">
									<div class="form-group">
										<label>Google star Rating out of 5</label>
										<input type="text" name="google_rating" value="<?php echo get_settings('google_rating'); ?>" class="form-control">
									</div>
									<div class="form-group">
										<label>Total Google Review</label>
										<input type="text" name="total_review" value="<?php echo get_settings('total_review'); ?>" class="form-control">
									</div>
								</div>
								<div class="tab-pane has-padding" id="payment-affiliate-details">
									<div class="form-group ">
										<label><?php _el('affiliate_description'); ?>:</label>
										<textarea name="affiliate_description" rows="6" class="form-control"><?php echo get_settings('affiliate_description'); ?></textarea>
									</div>
								</div>
								<div class="tab-pane has-padding" id="review-platforms">
									<div class="review_plat">
										<div class="form-group">
											<div class="row">
												<div class="col-md-10">
													<button name="add_Review_platform" id="add_Review_platform" type="button" class="btn btn-primary">Add More</button>
												</div>
											</div>
										</div>
										<?php 
											$review_details = unserialize(get_settings('platform_review_detail'));
											if (is_array($review_details) && sizeof($review_details) > 0) {
												$j = 0;
											  	foreach ($review_details as $res) {
													?>
													<div class="reviews">
														<div class="form-group">
															<div class="row">
																<div class="col-md-6">
																	<input type="file" class="form-control review_platform_image review_img" name="review_image[<?php echo $j; ?>]" id="review_image<?php echo $j; ?>" autocomplete="off" placeholder="Review Platform image" value="<?php echo !empty($res['review_image'])?$res['review_image']:NULL; ?>">
																	<?php 
																		if(!empty($res['review_image'])){
																			?>
																			<a href="<?php echo base_url('assets/images/review_imgs/' . $res['review_image']); ?>" class="imgClass" target="_blank" style="color:blue">Review Platform image</a>
																			<?php
																		}
																	?>
																</div>
																<div class="col-md-6">
																	<input type="url" class="form-control required review_links" name="review_links[<?php echo $j; ?>]" autocomplete="off" placeholder="Review Platform Links" value="<?php echo $res['review_links']; ?>">
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-6">
																	<input type="text" class="form-control required review_platform_name" name="review_platform_name[<?php echo $j; ?>]" autocomplete="off" placeholder="Review Platform Name" value="<?php echo $res['review_platform_name']; ?>" maxlength="30">
																</div>
																<div class="col-md-6">
																	<input type="number" class="form-control required review_platform_rating" name="review_platform_rating[<?php echo $j; ?>]" autocomplete="off" placeholder="Star Rating out of 5"value="<?php echo $res['review_platform_rating']; ?>" min="1" max="5">
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-6">
																	<input type="number" class="form-control required review_based_on" name="review_based_on[<?php echo $j; ?>]" autocomplete="off" placeholder="Total Review" value="<?php echo $res['review_based_on']; ?>" min="1">
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label class="form-check-label">
																		<input type="checkbox" class="form-check-input exclude_footer" name="exclude_footer[<?php echo $j; ?>]" id="exclude_footer<?php echo $j; ?>" <?php echo isset($res['exclude_footer']) && $res['exclude_footer'] ? 'checked' : ''; ?>>
																		Exclude from footer
																	</label>
																</div>
																<div class="col-md-4">
																	<label class="form-check-label">
																		<input type="checkbox" class="form-check-input exclude_review_page" name="exclude_review_page[<?php echo $j; ?>]" id="exclude_review_page<?php echo $j; ?>" <?php echo isset($res['exclude_review_page']) && $res['exclude_review_page'] ? 'checked' : ''; ?>>
																		Exclude from review page
																	</label>
																</div>
																<div class="col-md-4 btn-remove-plat">
																	<button name="remove_review_platform" type="button" class="btn btn-primary remove_review_platform">Remove</button>
																</div>
															</div>
														</div>
														<hr>
													</div>
													<?php 
													$j++;
												}
											}
										?>
									</div>
								</div>
								<div class="tab-pane has-padding" id="google-recaptcha">
									<div class="form-group ">
										<label>Site Key</label>
										<input type="text" name="gr_site_key" value="<?php echo get_settings('gr_site_key'); ?>" class="form-control required">
									</div>
									<div class="form-group ">
										<label>Secret Key</label>
										<input type="text" name="gr_secret_key" value="<?php echo get_settings('gr_secret_key'); ?>" class="form-control required">
									</div>
								</div>
								<!-- tab pane for villa_advertisement -->
								<div class="tab-pane has-padding" id="villa-advertisement">
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<label>Hide Villa Advertisement: </label>
												<input type="checkbox" onchange="hide_villa_adds(this);" class="switchery" name="hide_villa_advertisement" <?php if (get_settings('hide_villa_advertisement') == 1) { echo 'checked';} ?>>
											</div>
										</div>
									</div>
									<div class="villa-adv-wrapper" <?php echo (get_settings('hide_villa_advertisement') == 1) ? 'style="display: none;"' : ''; ?>>
										<div class="form-group">
											<label>Villa Popup Banner Image</label>
											<input type="file" id="villa_popup_banner" class="form-control" name="villa_popup_banner" autocomplete="off">
											<?php
											if (get_settings('villa_popup_banner')) { ?>
												<a href="<?php echo base_url('uploads/villa_popup_banner/' . get_settings('villa_popup_banner')); ?>" class="imgClass" id="villa_popup_banner_img" target="_blank" style="color:blue">View Villa Popup Banner Image</a>
											<?php } else { ?>
												<a href="javascript:" class="imgClass hidden" id="villa_popup_banner_img" target="_blank" style="color:blue">View Villa Popup Banner Image</a>
											<?php } ?>
											<input type="hidden" name="villa_popup_banner_saved" id="villa_popup_banner_saved" class="form-control" value="<?php echo get_settings('villa_popup_banner'); ?>">
										</div>
										<div class="form-group ">
											<label>Villa URL:</label>
											<input type="text" name="villa_url" id="villa_url" class="form-control" value="<?php echo get_settings('villa_url'); ?>">
										</div>
									</div>
								</div>
								<!-- /tab pane for villa_advertisement -->
							</div>
						</div>
					</div>
					<!-- /Panel body -->
				</div>
				<!-- /Panel -->
			</div>
		</div>
		<div class="btn-bottom-toolbar text-right btn-toolbar-container-out">
			<button type="submit" name="setting_submit" class="btn btn-success"><?php _el('save'); ?> <?php _el('settings') ?></button>
		</div>
	</form>
</div>
<!-- /Content area -->

<script type="text/javascript">
	var BASE_URL = "<?php echo admin_url(); ?>";
	$.validator.addMethod('filesize', function(value, element, param) {
		// param = size (en bytes) 
		// element = element to validate (<input>)
		// value = value of the element (file name)
		var iSize = ($('#' + element.id)[0].files[0].size / 1024);
		iSize = (Math.round(iSize * 100) / 100);

		if (iSize > 800) {
			//alert('File size exceeds 2 MB');
			return false;
		} else {
			return true
		}
		//return this.optional(element) || (element.files[0].size <= param) 
	});
	//$( "#settings_form" ).on( "submit", function( event ) {

	//event.preventDefault();

	// $.ajax({
	// 	url:BASE_URL+'admin/settings/add',
	// 	type: 'POST',
	// 	data: $(this).serialize(),
	// 	success: function(msg)
	// 	{ 
	// 		if (msg=='true')
	//            {                           
	//                jGrowlAlert("<?php _el('_updated_successfully', _l('settings')); ?>", 'success');
	//            }
	// 	}
	// });
	jQuery("#settings_form").validate({
		errorElement: 'span',
		rules: {
			'bcc_emails_to': {
				required: false,
				email: false,
			}
		},
		submitHandler: function(form) {
			var form1 = $('#settings_form')[0];
			var formData = new FormData(form1);
			$.ajax({
				url: BASE_URL + 'settings/add',
				type: 'POST',
				data: formData,
				dataType: "JSON",
				contentType: false,
				processData: false,
				success: function(res) {
					if (res.success) {
						if (res.imgurl) {
							$("#company_logo").val(null);
							jQuery("#logo_image").attr('src', res.imgurl);
							jQuery("#company_logo_saved").val(res.img_name);

						}
						if (res.home_banner1_url) {
							jQuery("#home_banner1").val(null);
							jQuery("#view_banner1_img").attr('href', res.home_banner1_url);
							jQuery("#view_banner1_img").removeClass('hidden');
							jQuery("#banner1_saved").val(res.home_banner1);
						}
						if (res.blog_banner_url) {
							jQuery("#blog_banner").val(null);
							jQuery("#blog_banner_img").attr('href', res.blog_banner_url);
							jQuery("#blog_banner_img").removeClass('hidden');
							jQuery("#blog_banner_saved").val(res.blog_banner);
						}
						if (res.villa_popup_banner_url) {
							jQuery("#villa_popup_banner").val(null);
							jQuery("#villa_popup_banner_img").attr('href', res.villa_popup_banner_url);
							jQuery("#villa_popup_banner_img").removeClass('hidden');
							jQuery("#villa_popup_banner_saved").val(res.villa_popup_banner);
						}
						if (res.home_banner2_url) {
							jQuery("#home_banner2").val(null);
							jQuery("#view_banner2_img").attr('href', res.home_banner2_url);
							jQuery("#view_banner2_img").removeClass('hidden');
							jQuery("#banner2_saved").val(res.home_banner2);
						}
						if (res.home_banner3_url) {
							jQuery("#home_banner3").val(null);
							jQuery("#view_banner3_img").attr('href', res.home_banner3_url);
							jQuery("#view_banner3_img").removeClass('hidden');
							jQuery("#banner3_saved").val(res.home_banner3);
						}
						jGrowlAlert("<?php _el('_updated_successfully', _l('settings')); ?>", 'success');
					} else {
						jGrowlAlert("Something Went wrong", 'danger');
					}
					// else if(msg=='false'){
					// 	jGrowlAlert("Something Went wrong", 'danger');
					// }
				}
			});
		}

	});

	//});

	$('.test_email').on('click', function() {
		var email = $('#test_email').val();
		if (email != '') {
			$(this).attr('disabled', true);
			$.post(BASE_URL + 'settings/send_smtp_test_email', {
				test_email: email
			}).done(function(msg) {
				if (msg == 'true') {
					jGrowlAlert('Seems like your SMTP settings are set correctly. Check your email now.', 'success');
				} else {
					jGrowlAlert('Seems like your SMTP settings are not set correctly. Please check again.', 'danger');
				}
				$('.test_email').removeAttr('disabled');
				$('#test_email').val('');
			});
		}
	});
	jQuery("#company_logo").change(function() {

		//sets up the validator
		//if(jQuery("#tour_gallery_img").val()==""){        
		jQuery("#settings_form").validate();
		jQuery(this).rules("add", {
			extension: "jpg,png,jpeg,svg",
			filesize: true,
			messages: {
				extension: 'File type must be JPG, JPEG or PNG',
				filesize: 'File size must be less than 800 KB'
			}
		});
		//} 
		$('#company_logo').valid();
	});
	$.validator.addMethod('minImageHeight', function(value, element, minWidth) {
		if (jQuery('#' + element.id).attr('uploadHeigth') < 1080) {
			return false;
		} else {
			return true;
		}
	});
	$.validator.addMethod('blogBannerminImageHeight', function(value, element, minWidth) {
		if (jQuery('#' + element.id).attr('uploadHeigth') < 530) {
			return false;
		} else {
			return true;
		}
	});

	$.validator.addMethod('minImageWidth', function(value, element, minWidth) {
		if (jQuery('#' + element.id).attr('uploadWidth') < 1920) {
			return false;
		} else {
			return true;
		}
	});
	$.validator.addMethod('blogBannerminImageWidth', function(value, element, minWidth) {
		if (jQuery('#' + element.id).attr('uploadWidth') < 1920) {
			return false;
		} else {
			return true;
		}
	});
	jQuery("#blog_banner").change(function() {
		element = $(this);
		var files = this.files;
		var _URL = window.URL || window.webkitURL;
		var image, file;
		image = new Image();
		image.src = _URL.createObjectURL(files[0]);
		image.onload = function() {
			element.attr('uploadWidth', this.width);
			element.attr('uploadHeigth', this.height);
		}

		jQuery("#settings_form").validate();
		jQuery(this).rules("add", {
			extension: "jpg,png,jpeg,svg",
			filesize: true,
			blogBannerminImageHeight: true,
			blogBannerminImageWidth: true,
			messages: {
				extension: 'File type must be JPG, JPEG or PNG',
				filesize: 'File size must be less than 800 KB',
				blogBannerminImageHeight: 'Min Height of image must be 530',
				blogBannerminImageWidth: 'Min Width of image must be 1920',
			}
		});


		$('#blog_banner').valid();
	});

	jQuery("#villa_popup_banner").change(function() {
		jQuery("#settings_form").validate();
		jQuery(this).rules("add", {
			extension: "jpg,png,jpeg,svg",
			filesize: true,
			messages: {
				extension: 'File type must be JPG, JPEG or PNG',
				filesize: 'File size must be less than 800 KB',
			}
		});


		$('#villa_popup_banner').valid();
	});
	
	jQuery("#home_banner1").change(function() {
		element = $(this);
		var files = this.files;
		var _URL = window.URL || window.webkitURL;
		var image, file;
		image = new Image();
		image.src = _URL.createObjectURL(files[0]);
		image.onload = function() {
			element.attr('uploadWidth', this.width);
			element.attr('uploadHeigth', this.height);
		}

		jQuery("#settings_form").validate();
		jQuery(this).rules("add", {
			extension: "jpg,png,jpeg,svg",
			filesize: true,
			minImageHeight: true,
			minImageWidth: true,
			messages: {
				extension: 'File type must be JPG, JPEG or PNG',
				filesize: 'File size must be less than 800 KB',
				minImageHeight: 'Min Height of image must be 1080',
				minImageWidth: 'Min Width of image must be 1920',
			}
		});


		$('#home_banner1').valid();
	});
	jQuery("#home_banner2").change(function() {
		element = $(this);
		var files = this.files;
		var _URL = window.URL || window.webkitURL;
		var image, file;
		image = new Image();
		image.src = _URL.createObjectURL(files[0]);
		image.onload = function() {
			element.attr('uploadWidth', this.width);
			element.attr('uploadHeigth', this.height);
		}

		jQuery("#settings_form").validate();
		jQuery(this).rules("add", {
			extension: "jpg,png,jpeg,svg",
			filesize: true,
			minImageHeight: true,
			minImageWidth: true,
			messages: {
				extension: 'File type must be JPG, JPEG or PNG',
				filesize: 'File size must be less than 800 KB',
				minImageHeight: 'Min Height of image must be 1080',
				minImageWidth: 'Min Width of image must be 1920'
			}
		});


		jQuery('#home_banner2').valid();
	});
	jQuery("#home_banner3").change(function() {
		element = $(this);
		var files = this.files;
		var _URL = window.URL || window.webkitURL;
		var image, file;
		image = new Image();
		image.src = _URL.createObjectURL(files[0]);
		image.onload = function() {
			element.attr('uploadWidth', this.width);
			element.attr('uploadHeigth', this.height);
		}

		jQuery("#settings_form").validate();
		jQuery(this).rules("add", {
			extension: "jpg,png,jpeg,svg",
			filesize: true,
			minImageHeight: true,
			minImageWidth: true,
			messages: {
				extension: 'File type must be JPG, JPEG or PNG',
				filesize: 'File size must be less than 800 KB',
				minImageHeight: 'Min Height of image must be 1080',
				minImageWidth: 'Min Width of image must be 1920'
			}
		});


		jQuery('#home_banner3').valid();
	});

	function hide_villa_adds(obj) {
		var checked = 0;

		if (obj.checked) {
			checked = 1;
			$('.villa-adv-wrapper').hide();
		}else{
			$('.villa-adv-wrapper').show();
		}

		//jQuery('.jGrowl-notification').trigger('jGrowl.close');
		jQuery.ajax({
			url: BASE_URL + 'settings/hide_show_villa_advertisement',
			type: 'POST',
			data: {
				//setting_id: obj.id,
				is_hide: checked
			},
			dataType: 'JSON',
			success: function(response) {
				$('.jGrowl-notification').trigger('jGrowl.close');
				if (response.success) {
					if (response.msg == 'true') {
						jGrowlAlert(response.alert_msg, 'success');
						//toast_success(response.alert_msg);
					} else {
						jGrowlAlert(response.alert_msg, 'success');
						//toast_success(response.alert_msg);
					}
				} else {
					jGrowlAlert('', 'error');
					//toast_error();
				}
			}
		});
	}
	function change_status(obj) {
		var checked = 0;

		if (obj.checked) {
			checked = 1;
		}
		//jQuery('.jGrowl-notification').trigger('jGrowl.close');
		jQuery.ajax({
			url: BASE_URL + 'settings/change_minifyjs_status',
			type: 'POST',
			data: {
				//setting_id: obj.id,
				is_active: checked
			},
			dataType: 'JSON',
			success: function(response) {
				$('.jGrowl-notification').trigger('jGrowl.close');
				if (response.success) {
					if (response.msg == 'true') {
						jGrowlAlert(response.alert_msg, 'success');
						//toast_success(response.alert_msg);
					} else {
						jGrowlAlert(response.alert_msg, 'success');
						//toast_success(response.alert_msg);
					}
				} else {
					jGrowlAlert('', 'error');
					//toast_error();
				}
			}
		});
	}

	jQuery(document).on('click', '#add_Review_platform', function () {
		var review_platform = jQuery(".review_platform_name").length;
		var links_field = `
		<div class="reviews">
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<input type="file" class="form-control required review_platform_image" name="review_image[]" autocomplete="off" placeholder="Review Platform image">
					</div>
					<div class="col-md-6">
						<input type="url" class="form-control required review_links" name="review_links[]" autocomplete="off" placeholder="Review Platform Links" >
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<input type="text" class="form-control required review_platform_name" name="review_platform_name[]" autocomplete="off" placeholder="Review Platform Name" maxlength="30">
					</div>
					<div class="col-md-6">
						<input type="number" class="form-control required review_platform_rating" name="review_platform_rating[]" autocomplete="off" placeholder="Star Rating out of 5" min="1" max="5">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<input type="number" class="form-control required review_based_on" name="review_based_on[]" autocomplete="off" placeholder="Total Review" min="1">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input exclude_footer" name="exclude_footer[]" id="exclude_footer">
							Exclude from footer
						</label>
					</div>
					<div class="col-md-4">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input exclude_review_page" name="exclude_review_page[]" id="exclude_review_page">
							Exclude from review page
						</label>
					</div>
					<div class="col-md-4">
						<button name="remove_review_platform" type="button" class="btn btn-primary remove_review_platform">Remove</button>
					</div>
				</div>
			</div>
			<hr>
		</div>
		`;
		jQuery(".review_plat").append(links_field);
		var d_cnt = 0;
		jQuery(".review_links").each(function (i, v) {
			$(this).attr("name", "review_links[" + d_cnt + "]");
			$('input[name="review_links[' + d_cnt + ']"]').rules("add", {
				required: true,
			});
			d_cnt++;
		});
		var c_cnt = 0;
		jQuery(".review_platform_image").each(function (i, v) {
			$(this).attr("name", "review_image[" + c_cnt + "]");
			$(this).attr("id", "review_image" + c_cnt);
			if (!$(this).hasClass("review_platform_image")) {
				$('input[name="review_image[' + c_cnt + ']"]').rules("add", {
					required: true,
					extension: "jpg,png,jpeg",
					file_size: true,
					messages: {
						//required:"Please Upload Feature Image",
						extension: 'File type must be JPG, JPEG or PNG',
						file_size: 'File size must be less than 800 KB'
					}
				});
			}
			c_cnt++;
		});
		var v_cnt = 0;
		jQuery(".review_platform_name").each(function (i, v) {
			$(this).attr("name", "review_platform_name[" + v_cnt + "]");
			$('input[name="review_platform_name[' + v_cnt + ']"]').rules("add", {
				required: true,
				maxlength: 30
			});
			v_cnt++;
		});
		var r_cnt = 0;
		jQuery(".review_platform_rating").each(function (i, v) {
			$(this).attr("name", "review_platform_rating[" + r_cnt + "]");
			$('input[name="review_platform_rating[' + r_cnt + ']"]').rules("add", {
				required: true,
				maxlength: 30
			});
			r_cnt++;
		});
		var b_cnt = 0;
		jQuery(".review_based_on").each(function (i, v) {
			$(this).attr("name", "review_based_on[" + b_cnt + "]");
			$('input[name="review_based_on[' + b_cnt + ']"]').rules("add", {
				required: true,
				maxlength: 30
			});
			b_cnt++;
		});
		var f_cnt = 0;
		jQuery(".exclude_footer").each(function (i, v) {
			$(this).attr("name", "exclude_footer[" + f_cnt + "]");
			$(this).attr("id", "exclude_footer_" + f_cnt);
			f_cnt++;
		});

		var e_cnt = 0;
		jQuery(".exclude_review_page").each(function (i, v) {
			$(this).attr("name", "exclude_review_page[" + e_cnt + "]");
			$(this).attr("id", "exclude_review_page_" + e_cnt);
			e_cnt++;
		});

	});

	jQuery(document).on('click', '.remove_review_platform', function () {
		var parentId = jQuery(this).closest('.reviews').remove();
		var d_cnt = 0;
		jQuery(".review_links").each(function (i, v) {
			$(this).attr("name", "review_links[" + d_cnt + "]");
			$("#settings_form").validate();
			$('input[name="review_links[' + d_cnt + ']"]').rules("add", {
				required: true,
			});
			d_cnt++;
		});
		var c_cnt = 0;
		jQuery(".review_platform_image").each(function (i, v) {
			$(this).attr("name", "review_image[" + c_cnt + "]");
			$(this).attr("id", "review_image" + c_cnt);
			if (!$(this).hasClass("review_platform_image")) {
				$("#settings_form").validate();
				$('input[name="review_image[' + c_cnt + ']"]').rules("add", {
					required: true,
					extension: "jpg,png,jpeg",
					file_size: true,
					messages: {
						//required:"Please Upload Feature Image",
						extension: 'File type must be JPG, JPEG or PNG',
						file_size: 'File size must be less than 800 KB'
					}
				});
			}
			c_cnt++;
		});
		var v_cnt = 0;
		jQuery(".review_platform_name").each(function (i, v) {
			$(this).attr("name", "review_platform_name[" + v_cnt + "]");
			$("#settings_form").validate();
			$('input[name="review_platform_name[' + v_cnt + ']"]').rules("add", {
				required: true,
				maxlength: 30
			});
			v_cnt++;
		});
		var r_cnt = 0;
		jQuery(".review_platform_rating").each(function (i, v) {
			$(this).attr("name", "review_platform_rating[" + r_cnt + "]");
			$("#settings_form").validate();
			$('input[name="review_platform_rating[' + r_cnt + ']"]').rules("add", {
				required: true,
				maxlength: 30
			});
			r_cnt++;
		});
		var b_cnt = 0;
		jQuery(".review_based_on").each(function (i, v) {
			$(this).attr("name", "review_based_on[" + b_cnt + "]");
			$("#settings_form").validate();
			$('input[name="review_based_on[' + b_cnt + ']"]').rules("add", {
				required: true,
				maxlength: 30
			});
			b_cnt++;
		});
		var f_cnt = 0;
		jQuery(".exclude_footer").each(function (i, v) {
			$(this).attr("name", "exclude_footer[" + f_cnt + "]");
			$("#settings_form").validate();
			f_cnt++;
		});
		var e_cnt = 0;
		jQuery(".exclude_review_page").each(function (i, v) {
			$(this).attr("name", "exclude_review_page[" + e_cnt + "]");
			$("#settings_form").validate();
			e_cnt++;
		});
	});
</script>