<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

//Autenticacao
$router->post('/login', 'AuthController@login');
$router->get('/academico/logout', 'AuthController@logout');