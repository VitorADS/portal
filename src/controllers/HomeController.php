<?php
namespace src\controllers;

use \core\Controller;

class HomeController extends Controller {

    public function index() {
        $_SESSION['title'] = 'Portal';
        
        $this->render('home');
    }

}