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

$route['default_controller'] = "auth/login";

/*
   Auth routes
*/

$route['login']                     =  "auth/login";
$route['forgot-password']           =  "auth/forgot_password";
$route['logout']                    =  "auth/logout";
$route['register']                  =  "auth/create_user";

/*
   User dashboard routes
*/

$route['dashboard']                 =  "dash";
$route['dashboard/news']            =  "news";

/*
   User settings routes routes
*/

$route['settings/change-password']  =  "auth/change_password";

/*
   Admin dashboard routes
*/

$route['admin/users']                               =  "auth/user_management";
$route['admin/users/delete/(:num)']                 =  "auth/delete_user/$1";
$route['admin/users/edit/(:num)']                   =  "auth/edit_user/$1";
$route['admin/news']                                =  "news/news_management";
$route['admin/news/add']                            =  "news/add_news";
$route['admin/news/edit/(:num)']                    =  "news/edit_news/$1";
$route['admin/news/delete/(:num)']                  =  "news/delete_news/$1";



/* End of file routes.php */
/* Location: ./application/config/routes.php */