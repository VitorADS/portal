<?php
namespace src\controllers;

use \core\Controller;
use DateTime;
use src\models\Registers;

class RegisterController extends Controller {
    private $date;

    public function __construct(){
        date_default_timezone_set('America/Sao_Paulo');
        $this->date = date('Y-m-d H:i:s');
    }

    public function index() {
        $_SESSION['title'] = 'Captura de Ponto';
        
        $this->render('ponto/home');
    }

    public function addRegister($idUser, $datetime){
        Registers::insert([
            'idUser' => $idUser,
            'date' => $datetime
        ])->execute();
    }

    public function registraPonto(){
        $id = filter_input(INPUT_POST, 'id');

        $user = new UsersController();
        if($user = $user->findById($id)){
            $this->addRegister($user->id, $this->date);

            $this->date = date('d/m/Y H:i:s', strtotime($this->date));
            $_SESSION['flash'] = 'Ultimo usuario registrado: '.$user->id. ' Data: '.$this->date ;
            
        }else{
            $_SESSION['flash'] = 0;
        }

        $this->redirect('/ponto');
    }

}