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
        $this->render('academic');
    }

}