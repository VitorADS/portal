<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->post('/login', 'AuthController@login');