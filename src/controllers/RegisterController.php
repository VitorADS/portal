<?php
namespace src\controllers;

use \core\Controller;
use DateTime;
use src\models\Registers;
use src\models\RegistersMonths;

class RegisterController extends Controller {
    private $date;
    private $loggedUser;

    public function __construct(){
        date_default_timezone_set('America/Sao_Paulo');
        $this->date = date('Y-m-d H:i:s');

        $this->loggedUser = AuthController::checkLogin();

        if(!$this->loggedUser){
            $_SESSION['token'] = null;
            $this->redirect('/');
        }
    }

    public function generateRegisterMonth($id, $idUser, $month, $date, $done){
        $registerMonth = new RegistersMonths();
        $registerMonth->id = $id;
        $registerMonth->idUser = $idUser;
        $registerMonth->date = $date;
        $registerMonth->done = $done;

        return $registerMonth;
    }

    public function findRegisterMonth($idUser, $month){
        $register = RegistersMonths::select()
            ->where('idUser', $idUser)
            ->where('month', $month)
            ->get();

        if(count($register) > 0){
            $register = $this->generateRegisterMonth($register['id'], $register['idUser'], $register['month'], $register['date'],
            $register['done']);

            return $register;
        }

        return false;
    }

    public function index() {
        $_SESSION['title'] = 'Captura de Ponto';
        
        $this->render('ponto/home');
    }

    public function addRegister($idUser){
        $date = date('m', strtotime($this->date));
        $registerMonth = $this->findRegisterMonth($idUser, $date);

        if(!$registerMonth){
            RegistersMonths::insert([
                'idUser' => $idUser,
                'month' => $date,
                'date' => $this->date,
                'done' => 0
            ])->execute();
        }

        Registers::insert([
            'idUser' => $idUser,
            'date' => $this->date
        ])->execute();
    }

    public function registraPonto(){
        $id = filter_input(INPUT_POST, 'id');

        $user = new UsersController();
        if($user = $user->findById($id)){
            $this->addRegister($user->id);

            $this->date = date('d/m/Y H:i:s', strtotime($this->date));
            $_SESSION['flash'] = 'Ultimo usuario registrado: '.$user->id. ' Data: '.$this->date ;
            
        }else{
            $_SESSION['flash'] = 0;
        }

        $this->redirect('/ponto');
    }

    public function checkRegister(){
        $_SESSION['title'] = 'Verificar Ponto';

        $data = [
            'loggedUser' => $this->loggedUser
        ];

        $this->render('ponto/verificaPonto', $data);
    }

}