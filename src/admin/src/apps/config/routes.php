<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "dashboard";
$route['404_override'] = 'dashboard/notFound';

$route['login'] = "dashboard/login";
$route['logoff'] = "dashboard/logoff";
