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

        if(!empty($_SESSION['token'])){
            $this->loggedUser = AuthController::checkLogin();
        }
    }

    public function notLogged(){
        if(!$this->loggedUser){
            $this->redirect('/');
        }
    }

    public function validateDate($date, $format = 'Y-m-d H:i:s'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
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

    public function verifyRegisters(){
        $day = date('d', strtotime($this->date));
        $month = date('m', strtotime($this->date));
        $year = date('Y', strtotime($this->date));

        if(($day == 1 OR $day == 01) AND $month != 1 AND $month != 01){
            $registersMonth = $this->getRegistersMonth($month);

            if($registersMonth != null){
                
            }
        }else{

        }
    }

    public function getRegistersMonth($month){
        $registersMonth = RegistersMonths::select()
            ->where('month', $month)
            ->get();

        $array = [];
        if(count($registersMonth) > 0){
            foreach($registersMonth as $registerMonth){
                $registerMonth = $this->generateRegisterMonth($registerMonth[0]['id'], $registerMonth[0]['idUser'],
                $registerMonth[0]['month'], $registerMonth[0]['date'], $registerMonth[0]['done']);

                $array[] = $registerMonth;
            }
        }

        return $array;
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

    public function findRegisterById($id){
        $register = Registers::select()
            ->where('id', $id)
            ->get();

        if($register){
            $register = $this->generateRegister($register[0]['id'], $register[0]['idUser'], $register[0]['month'], $register[0]['date']);
            $register->date = date('d/m/Y H:i:s', strtotime($register->date));

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

    public function editarPonto($id){
        $this->notLogged();
        $register = $this->findRegisterById($id);
        $user = new UsersController();
        $user = $user->findById($register->idUser);

        $_SESSION['title'] = 'Editando Ponto - '.$user->name;

        $data = [
            'loggedUser' => $this->loggedUser,
            'user' => $user,
            'register' => $register
        ];

        $this->render('ponto/editarPonto', $data);
    }

    public function editarPontoAction(){
        $this->notLogged();
        $date = filter_input(INPUT_POST, 'date');
        $register = filter_input(INPUT_POST, 'register');

        list($date, $time) = explode(" ", $date);
        $date = implode('-', array_reverse(explode('/', $date))).' '.$time;

        if($this->validateDate($date)){
            Registers::update()
            ->set('date', $date)
            ->where('id', $register)
            ->execute();

            $_SESSION['flash'] = 1;
        }else{
            $_SESSION['flash'] = 'Data/Hora informados incorretamente!';
        }

        $this->redirect('/academico/verificarPonto');
    }
}