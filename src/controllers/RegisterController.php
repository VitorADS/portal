<?php
namespace src\controllers;

use \core\Controller;

class RegisterController extends Controller {

    public function index() {
        $_SESSION['title'] = 'Captura de Ponto';
        
        $this->render('ponto/home');
    }
    
}