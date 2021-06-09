<?php
require 'core/bootstrap.php';

$routes = [
    '/' => 'HomeController@index',
    '/home' => 'HomeController@index',
    '/list' => 'OverviewController@index',
    '/create' => 'CreateController@index',
    '/edit' => 'EditController@index',

];

$db = [
    'name' => 'meinedatenbank',
    'username' => 'root',
    'password' => '',
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');