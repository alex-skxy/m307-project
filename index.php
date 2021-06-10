<?php
require 'core/bootstrap.php';
require 'db_creds.php';

$routes = [
    '/' => 'HomeController@index',
    '/home' => 'HomeController@index',
    '/list' => 'OverviewController@index',
    '/create' => 'CreateController@index',
    '/edit' => 'EditController@index',
    '/validate' => 'ValidationController@index',

];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');
