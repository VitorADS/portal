<?php
namespace src\controllers;

use \core\Controller;
use src\models\Registers;
use src\models\RegistersMonths;

class RegisterController extends Controller {
    private $date;
    private $loggedUser;

    public function __construct(){
        date_default_timezone_set('America/Sao_Paulo');
        $this->date = date('Y-m-d H:i:s');

        if(!empty($_SESSION['token'])){
            $this->loggedUser = AuthController::checkLogin();
        }
    }

    public function notLogged(){
        if(!$this->loggedUser){
            $this->redirect('/');
        }
    }

    public function generateRegisterMonth($id, $idUser, $month, $date, $done){
        $registerMonth = new RegistersMonths();
        $registerMonth->id = $id;
        $registerMonth->idUser = $idUser;
        $registerMonth->month = $month;
        $registerMonth->date = $date;
        $registerMonth->done = $done;

        return $registerMonth;
    }

    public function generateRegister($id, $idUser, $month, $date){
        $register = new Registers();
        $register->id = $id;
        $register->idUser = $idUser;
        $register->month = $month;
        $register->date = $date;

        return $register;
    }

    public function findRegisterMonthById($id){
        $register = RegistersMonths::select()
            ->where('id', $id)
            ->get();
        
        if($register){
            $register = $this->generateRegisterMonth($register[0]['id'], $register[0]['idUser'], $register[0]['month'],
            $register[0]['date'], $register[0]['done']);

            return $register;
        }

        return false;
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

    public function getRegisters($month, $idUser){
        $array = [];
        $registers = Registers::select()
            ->where('idUser', $idUser)
            ->where('month', $month)
            ->get();

        if($registers){
            foreach($registers as $register){
                $register = $this->generateRegister($register['id'], $register['idUser'], $register['month'], $register['date']);
                $register->date = date('d/m/Y H:i:s', strtotime($register->date));

                $array[] = $register;
            }
        }

        return $array;
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
            'month' => $date,
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

    public function selectRegisterMonth($month){
        return RegistersMonths::select()
        ->where('month', $month)
        ->where('done', 0)
        ->get();
    }

    public function checkRegister(){
        $this->notLogged();
        $_SESSION['title'] = 'Verificar Ponto';
        $date = date('m', strtotime($this->date));

        $registers = $this->selectRegisterMonth($date);

        if($registers){
            $arrayRegisters = [];
            foreach($registers as $register){
                $register = $this->generateRegisterMonth($register['id'], $register['idUser'], $register['month'],
                    $register['date'], $register['done']);

                $arrayRegisters[] = $register;
            }
        }

        $arrayUsers = [];
        $users = new UsersController();
        foreach($arrayRegisters as $user){
            $user = $users->findById($user->idUser);
            $arrayUsers[] = $user;
        }

        $data = [
            'loggedUser' => $this->loggedUser,
            'users' => $arrayUsers,
            'registers' => $arrayRegisters
        ];

        $this->render('ponto/verificaPonto', $data);
    }

    public function registerDetail($id){
        $this->notLogged();
        $registerMonth = $this->findRegisterMonthById($id);
        $users = new UsersController();
        $user = $users->findById($registerMonth->idUser);

        $_SESSION['title'] = 'Ponto - '.$user->name;

        $registers = $this->getRegisters($registerMonth->month, $user->id);

        $data = [
            'loggedUser' => $this->loggedUser,
            'user' => $user,
            'registers' => $registers
        ];

        $this->render('ponto/registerDetail', $data);
    }
}