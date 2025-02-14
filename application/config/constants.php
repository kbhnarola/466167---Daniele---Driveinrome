<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
Website Name
*/
define('WEBSITE_NAME', 'Driver In Rome');
define('SITE_TITLE', 'DriverInRome');
define('ADMIN_URL', 'folio');
$site_url = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https' : 'http';
$site_url .= '://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
$site_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$config['base_url'] = $site_url;
// define('BASE_URL', $site_url);
define('BASE_URL', $site_url);
define('ASSET', BASE_URL . "assets/");
define('EMAIL_WELCOME_PNG', ASSET . "images/emails/welcome.png");
define('EMAIL_OOPS_PNG', ASSET . "images/emails/ops.png");
define('DEFAULT_IMAGE', ASSET . "images/default/");
define('ADMIN_USERS', "admin_users");
define('TBL_TOUR_TYPE', "tbl_tour_type");
define('TBL_TOUR_CATEGORY', "tbl_tour_category");
define('TBL_TOUR', "tbl_tour");
define('TBL_TOUR_VARIATION', "tbl_tour_variation");
define('TBL_TOUR_PRICE_PLAN', "tbl_tour_price_plan");
define('TBL_EXTRA_SERVICES', "tbl_extra_services");
define('TBL_TOUR_EXTRA_SERVICES', "tbl_tour_extra_services");
define('TBL_TRANSFER_TYPE', "tbl_transfer_type");
define('TBL_TRANSFER_CATEGORY', "tbl_transfer_category");
define('TBL_TRANSFER', "tbl_transfer");
define('TBL_TRANSFER_VARIATION', "tbl_transfer_variation");
define('TBL_TRANSFER_PRICE_PLAN', "tbl_transfer_price_plan");
define('TBL_CMS_PAGES', "cms_pages");
define('TBL_EMAIL_TEMPLATES', "email_templates");
define('TBL_SETTINGS', "settings");
define('TBL_BOOKING', "tbl_booking");
define('TBL_USERS', "tbl_users");
define('TBL_TAG', "tbl_tag");
define('TBL_BLOGS', "tbl_blogs");
define('TBL_BLOG_CATEGORIES', "tbl_blog_categories");
define('TBL_NEWSLETTER', "tbl_newsletter");
define('TBL_REVIEW', "tbl_review");
define('TBL_NEWSLETTER_EMAILS', "tbl_newsletter_emails");
define('TBL_REVIEW_GALLERY_IMAGES', "tbl_review_gallery_images");
define('TBL_CMS_PAGES_STATIC_TEXT', "cms_pages_static_text");
define('TBL_SHARED_TOUR_CITY', "tbl_shared_tour_city");
define('TBL_SHARED_TOUR_VARIABLE', "tbl_shared_tour_variable");
define('TBL_SHARED_TOUR_LIST', "tbl_shared_tour_list");
define('TBL_EXTRA_COST', "tbl_extra_cost");
define('TBL_UMBRIAVILLA_DETAILS', "umbriavilla_details");
define('TBL_OVERVIEW_DETAILS', "overview");
define('TBL_FAQ_DETAILS', "faq");
define('TBL_PHOTOS_DETAILS', "photos");
define('TBL_EXPERIENCES_DETAILS', "experiences");
define('TBL_AVAILABILITY_CALENDAR', "availability_calendar");
define('TBL_AVAILABILITY_RATE', "availability_rates");

define('SECRET_KEY', "sk_test_Md2wQdQNN9okPsdgw2hgnLPG");
define('PUBLISHABLE_KEY', "pk_test_Sm8vU06Hy0Ov4pxLt1pVCRUc");
define('GOOGLE_SITE_KEY', "6LfO2AgbAAAAADF4flgACSrSOhONN46jIHw6Mj6M");

define("ACTIVE_CAMPAIGN_URL", "https://driverinrome.api-us1.com");
define("ACTIVE_CAMPAIGN_API_KEY", "7499f87ae56d7cc6ecdebfc5aa286fdc7a8242504420d5d94a4daeb66758179676554051");
define("DEFAULT_ACTIVE_CAMPAIGN_ID", 39);
define("VILLA_INQUIRY_ACTIVE_CAMPAIGN_ID", 58);

//6LfO2AgbAAAAADF4flgACSrSOhONN46jIHw6Mj6M
//6LfO2AgbAAAAACqKke_QjE-fppKNxqmUAXkIbJfq
#serialize array for Country list
define("COUNTRIES", serialize(array("Albania", "Andorra", "Armenia", "Austria", "Azerbaijan", "Belarus", "Belgium", "Bosnia and Herzegovina", "Bulgaria", "Croatia", "Cyprus", "Czechia", "Denmark", "Estonia", "Finland", "France", "Georgia", "Germany", "Greece", "Hungary", "Iceland", "Ireland", "Italy", "Kazakhstan", "Kosovo", "Latvia", "Liechtenstein", "Lithuania", "Luxembourg", "Malta", "Moldova", "Monaco", "Montenegro", "Netherlands", "Macedonia", "Norway", "Poland", "Portugal", "Romania", "Russia", "San Marino", "Serbia", "Slovakia", "Slovenia", "Spain", "Sweden", "Switzerland", "Turkey", "Ukraine", "United Kingdom", "Vatican City (Holy See)")));

define('RE_CAPTCHA_V3_SITE_KEY', "6LdgEyUqAAAAAGKdkr60vdFdGNJsNR6e2jJ_2a4w");
define('RE_CAPTCHA_V3_SECRET_KEY', "6LdgEyUqAAAAANrw7nIEg7gHB2VyyKEOS9Tls59Q");