<?php
namespace src\controllers;

use \core\Controller;

class AcademicController extends Controller {
    private $loggedUser;

    public function __construct(){
        $this->loggedUser = AuthController::checkLogin();

        if(!$this->loggedUser){
            $_SESSION['token'] = null;
            $this->redirect('/');
        }
    }

    public function index() {
        $_SESSION['title'] = 'Menu';
        $this->render('academic/academic');
    }

    public function acessoUsuario(){
        $_SESSION['title'] = 'Acesso Usuario';

        $this->render('academic/acessoUsuario');
    }

    public function users(){
        $_SESSION['title'] = 'Usuarios';

        $user = new UsersController();
        $users = $user->getAll();
        $array = [];

        foreach($users as $data){
            $data = $user->generateUser($data['id'], $data['name'], $data['email'], $data['password'],
            $data['cpf'], date('d/m/Y', strtotime($data['birthdate'])), $data['gender'], $data['token'], $data['student'],
            $data['employee'], $data['teacher']);

            $array[] = $data;
        }

        $data = [
            'users' => $array,
            'loggedUser' => $this->loggedUser
        ];

        $this->render('academic/users', $data);
    }

    public function registerUser(){
        $_SESSION['title'] = 'Registro de Usuario';
        $this->render('academic/registerUser');        
    }

}