<?php
use core\Router;
use src\controllers\AuthController;

$router = new Router();

$router->get('/', 'HomeController@index');

//Autenticacao
$router->post('/login', 'AuthController@login');
$router->get('/academico/logout', 'AuthController@logout');
$router->post('/academico/registrarUsuarioAction', 'AuthController@registerAction');

$router->get('/academico/menu', 'AcademicController@index');
$router->get('/academico/usuarios', 'AcademicController@users');
$router->get('/academico/registrarUsuario', 'AcademicController@registerUser');