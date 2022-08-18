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

        $data = [
            'loggedUser' => $this->loggedUser
        ];

        $this->render('academic/academic', $data);
    }

    public function acessoUsuario(){
        $_SESSION['title'] = 'Acesso Usuario';

        $data = [
            'loggedUser' => $this->loggedUser
        ];

        $this->render('academic/acessoUsuario', $data);
    }

    public function users(){
        $_SESSION['title'] = 'Usuarios';

        $user = new UsersController();
        $users = $user->getAll();

        $data = [
            'users' => $users,
            'loggedUser' => $this->loggedUser
        ];

        $this->render('academic/users', $data);
    }

    public function registerUser(){
        $_SESSION['title'] = 'Registro de Usuario';

        $data = [
            'loggedUser' => $this->loggedUser
        ];

        $this->render('academic/registerUser', $data);        
    }

    public function home(){
        $_SESSION['title'] = 'Portal de Ensino';

        $data = [
            'loggedUser' => $this->loggedUser
        ];

        $this->render('academic/portal/home', $data);
    }

    public function personalData(){
        $_SESSION['title'] = 'Dados Pessoais';

        $data = [
            'loggedUser' => $this->loggedUser
        ];

        $this->render('academic/personalData', $data);
    }

}