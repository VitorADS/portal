<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

//Autenticacao
$router->post('/login', 'AuthController@login');
$router->get('/academico/logout', 'AuthController@logout');
$router->post('/academico/registrarUsuarioAction', 'AuthController@registerAction');

//Academic
$router->get('/academico/menu', 'AcademicController@index');
$router->get('/academico/usuarios', 'AcademicController@users');
$router->get('/academico/registrarUsuario', 'AcademicController@registerUser');
$router->get('/academico/acessoUsuario', 'AcademicController@acessoUsuario');
$router->post('/academico/updateUser', 'AuthController@updateUser');
$router->get('academico/dadosPessoais', 'AcademicController@personalData');

//Portal
$router->get('/academico/portal/home', 'AcademicController@home');
$router->get('/academico/portal/folhaPagamento', 'AcademicController@colaborador');

//Requests
$router->get('/academico/user/{id}', 'UsersController@requestUser');