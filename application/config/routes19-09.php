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

/* Admin routes */
$route['folio'] = 'folio/authentication';
$route['folio/tour-types'] = 'folio/tour_types';
$route['folio/tour-categories'] = 'folio/tour_categories';
$route['folio/tour-extra-services'] = 'folio/tour_extra_services';
//$route['folio/edit/(:any)'] = 'folio/tours/add/$1';
$route['folio/transfer-types'] = 'folio/transfer_types';
$route['folio/transfer-categories'] = 'folio/transfer_categories';
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
$route['transfers/(:any)'] = 'welcome/transfers/$1';
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
/* End Admin routes */

$route['404_override'] = 'Error_controller';
$route['translate_uri_dashes'] = FALSE;
