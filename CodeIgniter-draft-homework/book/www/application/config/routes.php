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

# Welcome page
$route['default_controller']	= "welcome";
$route['welcome/page']			= "welcome";
$route['welcome/page/(:num)']	= "welcome";

# Book
$route['book/(:num)']			= "book/show";
$route['book']					= "book";
$route['book/page']				= "book";
$route['book/page/(:num)']		= "book";

# Rubric
$route['rubric/(:num)']			= "rubric/show";

# CRUD: book
$route['book/create']				= "crud_book/index/create";
$route['book/(:num)/edit']			= "crud_book/index/edit";
$route['book/(:num)/delete']		= "crud_book/delete/$1";
$route['book/new']					= "crud_book/create_AJAX";
$route['book/update']				= "crud_book/update_AJAX";
$route['book/upload_poster/(:num)']	= "crud_book/upload_poster/$1";



$route['404_override']			= '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */