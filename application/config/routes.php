<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Customer_Controller/home';
$route['login'] = 'Auth_Controller/login';
$route['logout'] = 'Auth_Controller/logout';
$route['superadmin'] = 'Su_Controller/home';
$route['superadmin/home'] = 'Su_Controller/home';
$route['admin/home'] = 'Admin_Controller/home';
$route['admin'] = 'Admin_Controller/home';
$route['frontoffice'] = 'Front_Office_Controller/home';
$route['frontoffice/home'] = 'Front_Office_Controller/home';
$route['frontoffice/confirm_order'] = 'Front_Office_Controller/confirm_order';
$route['frontoffice/review_order'] = 'Front_Office_Controller/review_order';
$route['frontoffice/empty_image'] = 'Front_Office_Controller/empty_image';
$route['editing'] = 'Editing_Controller/home';
$route['editing/home'] = 'Editing_Controller/home';
$route['cashier'] = 'Cashier_Controller/home';
$route['cashier/home'] = 'Cashier_Office_Controller/home';
$route['customer'] = 'Customer_Controller/home';
$route['customer/order_lookup'] = 'Customer_Controller/order_lookup';
$route['customer/photo_download'] = 'Customer_Controller/get_photo';
$route['customer/download/photo/(:any)'] = 'Customer_Controller/download_photo/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
