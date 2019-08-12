<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['dashboard'] = 'dashboard';
$route['setting'] = 'setting';
$route['updatefimware'] = 'update_fimware';
$route['updatefimware/do_upload/(:any)'] = 'update_fimware/do_upload/$1';
$route['updatefimware/editdeviceiot/(:any)'] = 'update_fimware/edit_device_iot/$1';
$route['updatefimware/deletedeviceiot/(:any)'] = 'update_fimware/delete_device_iot/$1';
$route['updatefimware/createdeviceiot/(:any)'] = 'update_fimware/create_device_iot/$1';
$route['updatefimware/createdeviceio_action'] = 'update_fimware/create_device_iot_action';
$route['updatefimware/publish/(:any)'] = 'update_fimware/publish/$1';
$route['updatefimware/updateaction/(:any)'] = 'update_fimware/updateaction/$1';
$route['updatefimware/edit/(:any)'] = 'update_fimware/edit/$1';
$route['updatefimware/deletefile/(:any)'] = 'update_fimware/delete_file/$1';
$route['updatefimware/(:any)'] = 'update_fimware/$1';

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
