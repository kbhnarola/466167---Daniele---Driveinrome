<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
// $route['indian-shore-excursions-tours'] 	= 'home/indian_shore_excursions_tours';
// $route['chinese-shore-excursions-tours'] 	= 'home/chinese_shore_excursions_tours';
// $route['jappanese-shore-excursions-tours'] 	= 'home/jappanese_shore_excursions_tours';
// $route['russian-shore-excursions-tours'] 	= 'home/russian_shore_excursions_tours';
// $route['thai-shore-excursions-tours'] 		= 'home/thai_shore_excursions_tours';

$route['welcome-hindi'] 	= 'home/indian_shore_excursions_tours';
$route['welcome-chinese'] 	= 'home/chinese_shore_excursions_tours';
$route['welcome-japanese'] 	= 'home/jappanese_shore_excursions_tours';
$route['welcome-russian'] 	= 'home/russian_shore_excursions_tours';
$route['welcome-thai'] 		= 'home/thai_shore_excursions_tours';


/* Admin routes */
$route['folio'] = 'folio/authentication';
$route['folio/tour-types'] = 'folio/tour_types';
$route['folio/tour-categories'] = 'folio/tour_categories';
$route['folio/tour-extra-services'] = 'folio/tour_extra_services';
$route['folio/tour-extra-cost'] = 'folio/tour_extra_cost';
//$route['folio/edit/(:any)'] = 'folio/tours/add/$1';
$route['folio/transfer-types'] = 'folio/transfer_types';
$route['folio/transfer-categories'] = 'folio/transfer_categories';
$route['folio/transfer-tours'] = 'folio/transfer_tours';
$route['folio/transfer-tours/add'] = 'folio/transfer_tours/add';
$route['folio/transfer-tours/edit/(:any)'] = 'folio/transfer_tours/edit/$1';
$route['folio/cms-pages'] = 'folio/cms_pages';
$route['folio/users/add_user_notes'] = 'folio/users/add_user_notes';
$route['folio/emails/email-template/(:any)'] = 'folio/emails/email_template/$1';
$route['about-us'] = 'welcome/about_us';
$route['fleet'] = 'welcome/fleet';
$route['cancellation-policy'] = 'welcome/cancellation_policy';
$route['our-guarantee'] = 'welcome/our_guarantee';
$route['airport-meeting-instructions'] = 'welcome/airport_meeting_instructions';
$route['cruise-arrival-instructions'] = 'welcome/cruise_arrival_instructions';
$route['privacy-policy'] = 'welcome/privacy_policy';
$route['shore-excursions/(:any)'] = 'welcome/shore_excursions/$1';
$route['city-tours/(:any)'] = 'welcome/city_tours/$1';
// $route['transfers/(:any)'] = 'welcome/transfers/$1';
$route['transfer/(:any)'] = 'web/tours';
$route['transfer/(:any)/edit'] = 'web/tours';
$route['transfers/(:any)'] = 'web/tours/transfer_tours/$1';
$route['package-tour/(:any)'] = 'welcome/package_tour/$1';
$route['tours/(:any)'] = 'web/tours';
$route['tours/(:any)/edit'] = 'web/tours';
$route['summary'] = 'web/summary';
$route['information'] = 'web/information';
$route['payment'] = 'web/payment';
$route['thank_you'] = 'web/payment/thank_you';
$route['send-me-quote'] = 'web/tours/send_me_quote';
$route['send-me-transfer-quote'] = 'web/transfers/send_me_transfer_quote';
$route['get_quote'] = 'web/tours/get_quote';
$route['get_transfer_quote'] = 'web/transfers/get_transfer_quote';
$route['submit_quote_request'] = 'web/tours/submit_quote_request';
$route['submit_quote_request_for_transfer'] = 'web/transfers/submit_quote_request_for_transfer';
$route['add_ticket'] = 'web/tours/add_ticket';
$route['availability_ticket'] = 'web/tours/availability_ticket';
$route['add_tour_upgrades'] = 'web/tours/add_tour_upgrades';
$route['submit_order'] = 'web/payment/submit_order';
$route['thankyou'] = 'web/payment/thankyou';
$route['partners'] = 'web/partners';
$route['partners/shared_tour_variable'] = 'web/partners/shared_tour_variable';
$route['partners/(:any)'] = 'web/partners/search_shared_tour/$1';
$route['partners/(:any)/(:any)'] = 'web/partners/search_shared_tour/$1/$2';
$route['partners/(:any)/(:any)/(:any)'] = 'web/partners/search_shared_tour/$1/$2/$3';
$route['send_newsletter_to_susbscibe_users'] = 'welcome/send_newsletter_to_susbscibe_users';
$route['send_email_to_unsusbscibed_users'] = 'welcome/send_email_to_unsusbscibed_users';
$route['unsubscribe'] = 'welcome/unsubscribe';
$route['unsubscribed/(:any)'] = 'welcome/unsubscribed_direct/$1';
$route['folio/blog-categories'] = 'folio/blog_categories';
$route['folio/shared-tour'] = 'folio/shared_tour';
$route['folio/shared-tour/add'] = 'folio/shared_tour/add';
$route['folio/shared-tour/edit/(:any)'] = 'folio/shared_tour/edit/$1';
$route['blogs'] = 'welcome/blogs';
$route['blogs/(:num)'] = 'welcome/blogs';
$route['blogs/(:any)'] = 'welcome/blogs/$1';
$route['blogs/(:any)/(:any)'] = 'welcome/blogs/$1/$1';
$route['reviews/(:any)'] = 'web/reviews/index';
$route['reviews/(:any)/(:num)'] = 'web/reviews/index';
$route['reviews/(:any)/(:any)'] = 'web/reviews/get_review_details';
$route['travel-agent-landing-page'] = 'home/travel_landing_page';
$route['custom-booking'] = 'home/custom_booking_page';
$route['tour-landing-page/(:any)'] = 'home/tour_landing_page';
$route['page/(:any)/reviews'] = 'web/reviews/wheelchair_reviews';
$route['page/(:any)/reviews/(:num)'] = 'web/reviews/wheelchair_reviews';
$route['page/(:any)/reviews/(:any)'] = 'web/reviews/review_details';
$route['search-tour/(:any)'] = 'web/search/search_tour_list/$1';
$route['search-tour/(:any)/(:num)'] = 'web/search/search_tour_list/$1/$1';
$route['review'] = 'welcome/review';

// Umbriavilla Web page
$route['umbria-villa'] = 'web/Umbriavilla/index';
$route['load_experiences'] = 'web/Umbriavilla/load_experiences';
$route['get_availability_dates'] = 'web/Umbriavilla/get_availability_dates';
$route['inquire-villa'] = 'web/Umbriavilla/inquire_villa';

// Umbriavilla Admin Pages

// Banner
$route['folio/banner'] = 'folio/banner/index';

// Owner Details
$route['folio/owner_details'] = 'folio/owner_details/index';

// Overviews
$route['folio/overviews'] = 'folio/overviews/index';
$route['folio/get_overview_list'] = 'folio/overviews/get_overview_list';
$route['folio/get_overview_details'] = 'folio/overviews/get_overview_details';
$route['folio/overviews/change_status'] = 'folio/overviews/change_status';
$route['folio/delete_overview'] = 'folio/overviews/delete_overview';
$route['folio/save_overview_title'] = 'folio/overviews/save_overview_title';

// Terms & Conditions
$route['folio/terms'] = 'folio/terms/index';

// FAQ
$route['folio/faq'] = 'folio/faq/index';
$route['folio/get_faq_list'] = 'folio/faq/get_faq_list';
$route['folio/update_faq_sequence'] = 'folio/faq/update_faq_sequence';
$route['folio/get_faq_details'] = 'folio/faq/get_faq_details';
$route['folio/delete_faq'] = 'folio/faq/delete_faq';
$route['folio/delete_faq'] = 'folio/faq/delete_faq';

// Photos
$route['folio/photos'] = 'folio/photos/index';
$route['folio/get_photos_list'] = 'folio/photos/get_photos_list';
$route['folio/get_photo'] = 'folio/photos/get_photo';
$route['folio/delete_photo'] = 'folio/photos/delete_photo';
$route['folio/save_photo_order'] = 'folio/photos/save_photo_order';

// Experiences
$route['folio/experiences'] = 'folio/experiences/index';
$route['folio/get_experiences_list'] = 'folio/experiences/get_experiences_list';
$route['folio/get_experiences_details'] = 'folio/experiences/get_experiences_details';
$route['folio/delete_experiences'] = 'folio/experiences/delete_experiences';
$route['folio/save_experiences_title'] = 'folio/experiences/save_experiences_title';
$route['folio/experiences/change_status'] = 'folio/experiences/change_status';

// Footer
$route['folio/footer'] = 'folio/footer/index';

// Location
$route['folio/location'] = 'folio/location/index';

// Availability
$route['folio/availability'] = 'folio/availability/index';
$route['folio/availability_calendar'] = 'folio/availability/availability_calendar';
$route['folio/get_availability_dates'] = 'folio/availability/get_availability_dates';
$route['folio/availability_rates'] = 'folio/availability/availability_rates';
$route['folio/get_rates_list'] = 'folio/availability/get_rates_list';
$route['folio/get_rates_details'] = 'folio/availability/get_rates_details';
$route['folio/delete_rates'] = 'folio/availability/delete_rates';

/* End Admin routes */

$route['404_override'] = 'Error_controller';
$route['translate_uri_dashes'] = FALSE;