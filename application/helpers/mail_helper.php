<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Sends an email.
 *
 * @param  str  $email    The email
 * @param  str  $subject  The subject
 * @param  str  $message  The message
 *
 * @return bool True if mail is sent. False otherwise.
 */
function send_email($email, $subject, $message)
{
	$CI = &get_instance();
	$CI->load->helper('file');
	$CI->load->config('email');
	$CI->load->library('email');

	$CI->email->from(get_settings('smtp_user'), get_settings('from_name'));
	$CI->email->reply_to(get_settings('reply_to_email'), get_settings('reply_to_name'));


	$CI->email->to($email);

	/* if BCC email is set in settings, send mail to BCC email */
	if (get_settings('bcc_emails_to') != '') {
		$CI->email->bcc(get_settings('bcc_emails_to'));
	}

	$CI->email->subject($subject);
	$CI->email->message($message);

	if ($CI->email->send()) {
		return true;
	} else {
		// echo $CI->email->print_debugger();
		// die;
		return false;
	}
}

function email_send($email, $subject, $body, $attachment = "")
{

	$ci = &get_instance();

	$ci->load->library('Phpmailer_lib');
	$get_admin_settings = get_admin_settings();

	foreach ($get_admin_settings as $admin_setting) {
		if ($admin_setting['name'] == 'company_email') {
			$company_email = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'smtp_host') {
			$smtp_host = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'smtp_port') {
			$smtp_port = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'smtp_user') {
			$smtp_user = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'smtp_password') {
			$smtp_password = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'from_email') {
			$from_email = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'from_name') {
			$from_name = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'reply_to_email') {
			$reply_to_email = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'reply_to_name') {
			$reply_to_name = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'smtp_encryption') {
			$smtp_encryption = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'company_name') {
			$company_name = $admin_setting['value'];
		}
	}
	// PHPMailer object
	$mail = $ci->phpmailer_lib->load();

	$mail->IsSMTP(); // enable SMTP
	//$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = false; // authentication enabled
	$mail->SMTPSecure = $smtp_encryption; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = $smtp_host;
	$mail->Port = $smtp_port; // or 587
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->CharSet = 'utf-8';
	$mail->Encoding = 'quoted-printable';
	//$mail->Encoding = '16bit';
	$mail->Username = $smtp_user;
	//$mail->Username = "dev.narola2020@gmail.com";
	//$mail->Password = "Dev.narola@2020";
	$mail->Password = $smtp_password;
	$mail->SetFrom($smtp_user, $company_name);
	$mail->AddReplyTo($reply_to_email, $reply_to_name);
	//$mail->AddCC('allforeclosures@aol.com');
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($email);

	if (!$mail->Send()) {
		// echo "Mailer Error: " . $mail->ErrorInfo;
		// die;
		return false;
	} else {
		return true;
	}
}

function email_sending($to = '', $data = [], $template = '', $bcc = '')
{
	if (empty($data)) {
		return false;
	}

	$ci = &get_instance();
	// get settings from database
	$get_admin_settings = get_admin_settings();

	$get_new_email_body = (!empty($data['email_body'])) ? $data['email_body'] : '';

	foreach ($get_admin_settings as $admin_setting) {
		if ($admin_setting['name'] == 'company_email') {
			$company_email = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'smtp_host') {
			$smtp_host = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'smtp_port') {
			$smtp_port = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'smtp_user') {
			$smtp_user = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'smtp_password') {
			$smtp_password = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'from_email') {
			$from_email = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'from_name') {
			$from_name = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'reply_to_email') {
			$reply_to_email = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'reply_to_name') {
			$reply_to_name = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'smtp_encryption') {
			$smtp_encryption = $admin_setting['value'];
		} else if ($admin_setting['name'] == 'company_name') {
			$company_name = $admin_setting['value'];
		}
	}

	$ci->load->library('email');

	$config = array();

	$config['protocol'] = 'smtp';
	$config['smtp_host'] = $smtp_host;
	$config['smtp_port'] = $smtp_port;
	$config['smtp_user'] = $smtp_user;
	$config['smtp_pass'] = $smtp_password;
	$config['newline'] = "\r\n";
	$config['mailtype'] = 'html'; // or text

	$config['charset'] = 'utf-8';
	$config['newline'] = "\r\n";
	$config['crlf'] = "\r\n";
	$config['priority'] = 3;
	$config['smtp_crypto'] = $smtp_encryption;
	$config['smtp_timeout'] = 60;
	$config['validation'] = TRUE;

	$ci->email->initialize($config);
	$admin_user_header = 'header';
	$admin_user_footer = 'footer';
	if ($to) {
		$ci->email->to($to);
	} else {
		$admin_user_header = 'admin_header';
		$admin_user_footer = 'admin_footer';
		$ci->email->to($company_email);
	}
	if ($bcc) {
		$ci->email->bcc(get_settings('bcc_emails_to'));
	}
	$ci->email->from($from_email, $company_name);
	$ci->email->subject($data['subject']);
	$ci->email->reply_to(get_settings('reply_to_email'), get_settings('reply_to_name'));


	$template_path = 'email_template/';
	$data['title'] = $data['subject'];
	if ($template != '') {
		$mail_content = $ci->load->view($template_path . $admin_user_header, $data, TRUE);
		$mail_content .= $get_new_email_body;
		$mail_content .= $ci->load->view($template_path . $admin_user_footer, $data, TRUE);
	} else {
		$mail_content = $data['mail_content'];
	}

	$ci->email->message($mail_content);
	$sent = $ci->email->send();
	// $sent = true;
	// echo "mail : ".$sent;
	if ($sent) {
		if ($to) {
			if ($template) {
				if (write_file(APPPATH . "logs/email-log.txt", 'SUCCESS :  EMAIL - ' . $to . ' DATE - ' . date("Y-m-d h:i:sa") . ' TEMPLATE - ' . $template . "\n", "a+")) {
					return true;
				}
			} else {
				if (write_file(APPPATH . "logs/email-log.txt", 'SUCCESS :  EMAIL - ' . $to . ' DATE - ' . date("Y-m-d h:i:sa") . ' TEMPLATE - Cron Template' . "\n", "a+")) {
					return true;
				}
			}
		}
		return true;
	} else {
		if ($to) {
			if ($template) {
				if (write_file(APPPATH . "logs/email-log.txt", 'ERROR :  EMAIL - ' . $to . ' DATE - ' . date("Y-m-d h:i:sa") . ' TEMPLATE - ' . $template . "\n", "a+")) {
					return true;
				}
			} else {
				if (write_file(APPPATH . "logs/email-log.txt", 'ERROR :  EMAIL - ' . $to . ' DATE - ' . date("Y-m-d h:i:sa") . ' TEMPLATE - Cron Template' . "\n", "a+")) {
					return true;
				}
			}
		}
		return false;
	}
}
