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

    public function generateDatabaseDate($date){
        list($date, $time) = explode(" ", $date);
        $date = implode('-', array_reverse(explode('/', $date))).' '.$time;

        return $date;
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

    public function generateRegister($id, $idUser, $month, $date, $invalid){
        $register = new Registers();
        $register->id = $id;
        $register->idUser = $idUser;
        $register->month = $month;
        $register->date = $date;
        $register->invalid = $invalid;

        return $register;
    }

    public function verifyRegisters(){
        $this->notLogged();
        $day = date('d', strtotime($this->date));
        $month = date('m', strtotime($this->date));
        $year = date('Y', strtotime($this->date));

        if(($day == 1 OR $day == 01) AND $month != 1 AND $month != 01){
            $registersMonth = $this->getRegistersMonth($month - 1);
            $date = $year. '-'. $month - 1 . '-'. $day. ' '. '00:00:00';

        }else if(($day == 1 OR $day == 01) AND ($month == 1 OR $month == 01)){
            $registersMonth = $this->getRegistersMonth(12);
            $date = $year - 1 . '-'. 12 . '-'. $day. ' '. '00:00:00'; 
        
        }else if($day > 1){
            $registersMonth = $this->getRegistersMonth($month);
            $date = $year. '-'. $month. '-'. $day. ' '. '00:00:00';

        }
        if($registersMonth != null){
            foreach($registersMonth as $registerMonth){
                $registers = $this->getRegisters($registerMonth->month, $registerMonth->idUser);
                $contaRegistro = 0;
                $registerDay = 0;
                $diaInvalido = 0;

                foreach($registers as $register){
                    $register->date = $this->generateDatabaseDate($register->date);
                    $contaRegistro++;
                    
                    $data = new DateTime($register->date);
                    $dataDia = $data->format('d');

                    if($contaRegistro == 0){
                        $diaInvalido = $register->date;
                    }

                    if($contaRegistro < 4 AND $registerDay != $dataDia){
                        $this->addInvalidRegister($register->idUser, $registerMonth->month, $diaInvalido);
                        $contaRegistro = 1;

                    }else if($contaRegistro == 4 AND $registerDay != $dataDia){
                        $this->addInvalidRegister($register->idUser, $registerMonth->month, $diaInvalido);
                        $contaRegistro = 1;

                    }else if($contaRegistro >= 4 AND $registerDay == $dataDia){
                        $contaRegistro = 0;
                    }

                    $registerDay = date('d', strtotime($register->date));
                }
            }
        }
        $_SESSION['flash'] = 'Verificado!';
        $this->redirect('/academico/verificarPonto');
    }

    public function getRegistersMonth($month){
        $registersMonth = RegistersMonths::select()
            ->where('month', $month)
            ->where('done', 0)
            ->get();

        $array = [];
        if(count($registersMonth) > 0){
            foreach($registersMonth as $registerMonth){
                $registerMonth = $this->generateRegisterMonth($registerMonth['id'], $registerMonth['idUser'],
                $registerMonth['month'], $registerMonth['date'], $registerMonth['done']);

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
                $register = $this->generateRegister($register['id'], $register['idUser'], $register['month'], $register['date'],
                    $register['invalid']);
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
            $register = $this->generateRegister($register[0]['id'], $register[0]['idUser'], $register[0]['month'], $register[0]['date'],
                $register[0]['invalid']);
            $register->date = date('d/m/Y H:i:s', strtotime($register->date));

            return $register;
        }

        return false;
    }

    public function index() {
        $_SESSION['title'] = 'Captura de Ponto';
        
        $this->render('ponto/home');
    }

    public function addInvalidRegister($idUser, $month, $date){
        Registers::insert([
            'idUser' => $idUser,
            'month' => $month,
            'date' => $date,
            'invalid' => 1
        ])->execute();
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
            'date' => $this->date,
            'invalid' => 0
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

        $date = $this->generateDatabaseDate($date);

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