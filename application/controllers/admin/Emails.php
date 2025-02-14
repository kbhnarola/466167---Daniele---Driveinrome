<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('email_model', 'emails');
	}

	/**
	 * Loads the list of templates.
	 */
	public function index()
	{
		$this->set_page_title(_l('email_templates'));
		$data['templates'] = $this->emails->get_all();
		$data['content']   = $this->load->view('admin/emails/index', $data, TRUE);
		$this->load->view('admin/layouts/index', $data);
	}


	/**
	 * Updates the email template
	 *
	 * @param int  $id  The template id
	 */
	public function email_template($id = '')
	{
		// echo $this->uri->segment(3);
		// exit;
		$this->set_page_title('Email Templates | Edit');

		if($id)
		{
			$data['template'] = $this->emails->get(base64_decode($id));

			if ($this->input->post())
			{	
				$data = array(
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message')
				);

				$update = $this->emails->update(base64_decode($id), $data);
				
				if ($update)
				{
					set_alert('success', _l('_updated_successfully', 'Email template'));
					//log_activity("Email Template Updated [ID:$id]");
					redirect('admin/emails');
				} 
			}
			else
			{

				$data['content'] = $this->load->view('admin/emails/email_template', $data, TRUE);
				$this->load->view('admin/layouts/index', $data);
			}
		}
		else
		{
			redirect('admin/emails');
		}
	}

	/**
	 * Loads default templates data into the database if not already exists.
	 */
	private function load_default_templates()
	{
		$templates = $this->default_templates();

		foreach ($templates as $template)
		{
			$template_exists = $this->emails->count_by(['slug' => $template['slug']]);

			if ($template['name'] != '' && $template['slug'] != '')
			{
				if ($template_exists == 0)
				{
					$data = [
						'name'         => $template['name'],
						'slug'         => $template['slug'],
						'placeholders' => serialize($template['placeholders'])
					];

					$this->emails->insert($data);
				}
				else
				{
					$data = [
						'name'         => $template['name'],
						'placeholders' => serialize($template['placeholders'])
					];

					$this->emails->update_by(array('slug' => $template['slug']), $data);
				}
			}
		}
	}

	/**
	 * Contains the Default Email Templates to be used in the system.
	 * You can add or remove Templates in this function & it will reflect  * on the Email Templates Module
	 *
	 * @return [array]      The default email templates with their placeholders information
	 */
	public function default_templates()
	{
		$templates = [
			[
				'name'         => 'Forgot Password',
				'slug'         => 'forgot-password',
				'placeholders' => [
					//'{firstname}'          => 'User Firstname',
					//'{lastname}'           => 'User Lastname',
					'{username}'           => 'Username',
					'{email}'              => 'User Email',
					'{reset_password_url}' => 'Reset Password URL',
					'{email_signature}'    => 'Email Signature',
					'{company_name}'       => 'Company Name'
				]
			],
			[
				'name'         => 'New User Sign Up',
				'slug'         => 'new-user-signup',
				'placeholders' => [
					'{firstname}'              => 'User Firstname',
					'{lastname}'               => 'User Lastname',
					'{email_verification_url}' => 'Email Verification URL',
					'{email_signature}'        => 'Email Signature',
					'{company_name}'           => 'Company Name'
				]
			],
			[
				'name'         => 'Contact us',
				'slug'         => 'contact-us',
				'placeholders' => [
					'{name}'   => 'Full Name',
					'{email}'   => 'Email',
					'{phone}'   => 'Phone',
					'{number_of_passenger}'   => 'Number Of Passenger',
					'{message}' => 'Message',
					//'{where_are_you_from}'   => 'Where are you from',
					'{welcome_image}'   => 'Welcome Image',
				]
			],
			[
				'name'         => 'Get a Quote',
				'slug'         => 'get-quote-success',
				'placeholders' => [
					'{username}'   => 'username',
					'{tour_name}'   => 'Tour name',
					'{tour_rate}'   => 'Tour rate',
					'{enquiry_date}' => 'Enquiry Date',
					'{welcome_image}'   => 'Welcome image',
					'{passenger}'   => 'Passenger',
				]
			],
			[
				'name'         => 'Get a Quote',
				'slug'         => 'get-quote-error',
				'placeholders' => [
					'{username}'   => 'username',
					'{tour_name}'   => 'Tour name',
					'{enquiry_date}' => 'Enquiry Date',
					'{welcome_image}'   => 'Welcome Image',
					'{passenger}'   => 'Passenger',
				]
			],
			[
				'name'         => 'Quick quote',
				'slug'         => 'quick-quote',
				'placeholders' => [
					'{name}'   => 'Full Name',
					'{email}'   => 'Email',
					'{phone}'   => 'Phone',
					'{find_us}'   => 'How did you find us',
					'{notes}'   => 'Notes',
					'{welcome_image}'   => 'Welcome image',
				]
			],
		];

		return $templates;
	}
}
