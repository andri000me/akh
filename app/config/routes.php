<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
// $route['modules'] = "";
// $route['john/(:any)']  = "john/$1";

// $route['modules/(:any)'] = "john";

// $route['default_controller'] = "welcome";
// $route['404_override'] = '';

$route['default_controller'] = "auth";
$route['404_override'] = 'error_404';

// $route['(:num)'] = "page/index/$1";
// $route['(:num)/(:any)'] = "page/index/$1/$2";

$route['login'] = "auth/login";
$route['logout'] = "auth/logout";


$route['admin'] = "user/admin";
$route['member'] = "user/member";

// bahasa
$route['^(en|id)/(.+)$'] = "$2";
$route['^(en|id)$'] = $route['default_controller'];

/*
 |---------------------------- 
 | BAHASA
 |----------------------------

$route['^fr/(.+)$'] = "$1";
$route['^en/(.+)$'] = "$1";
 
// '/en' and '/fr' -> use default controller
$route['^fr$'] = $route['default_controller'];
$route['^en$'] = $route['default_controller'];
*/
/* End of file routes.php */
/* Location: ./application/config/routes.php */