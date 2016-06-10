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

$route['default_controller'] = "users/login";
//$route['(:any)'] = "users/login/$1";
$route['users/create'] = 'users/create';
$route['users/(:any)'] = 'users/login/$1';
$route['users'] = 'users';


$route['users/test'] = 'users/test';


$route['users/login'] = 'users/login';
$route['users/register'] = 'users/register';
$route['users/login_check'] = 'users/login_check';
$route['users/logout'] = 'users/logout';
$route['users/dashboard'] = 'users/dashboard';
$route['users/settings_get_user'] = 'users/settings_get_user';
$route['users/settings_user_update'] = 'users/settings_user_update';
$route['users/settings_check_password'] = 'users/settings_check_password';
$route['users/change_password'] = 'users/change_password';
$route['users/preserve_datatable_view'] = 'users/preserve_datatable_view';

$route['home'] = 'home';
$route['home/logout']='home/logout';

$route['admin']='admin';
$route['admin/user_data']='admin/user_data';
$route['admin/user_update']='admin/user_update';
$route['admin/user_change_status']='admin/user_change_status';
$route['admin/user_delete_selected']='admin/user_delete_selected';
$route['admin/user_role']='admin/user_role';
$route['admin/user_role/(:any)'] = 'admin/user_role/$1';
$route['admin/add_new_role']='admin/add_new_role';
$route['admin/delete_user_role']='admin/delete_user_role';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/sales'] = 'admin/sales';
$route['admin/sales'] = 'admin/sales';
$route['admin/traffic'] = 'admin/traffic';
$route['admin/analytics'] = 'admin/analytics';


$route['sales'] = 'sales';
$route['sales/add_clients'] = 'sales/add_clients';
$route['sales/create_client'] = 'sales/create_client';
$route['sales/client_update'] = 'sales/client_update';

$route['traffic'] = 'traffic';

$route['analytics'] = 'analytics';



/* End of file routes.php */
/* Location: ./application/config/routes.php */