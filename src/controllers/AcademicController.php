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

    public function users(){
        $_SESSION['title'] = 'Usuarios';
        $this->render('academic/users');
    }

    public function registerUser(){
        $_SESSION['title'] = 'Registro de Usuario';
        $this->render('academic/registerUser');        
    }

}