<?php
namespace src\controllers;

use \core\Controller;
use DateTime;
use src\models\Users;

class AuthController extends Controller {

    public static function checkLogin(){
        if(!empty($_SESSION['token'])){
            $users = new UsersController();
            $loggedUser = $users->findByToken($_SESSION['token']);

            if($loggedUser){
                return $loggedUser;
            }
        }

        return false;
    }

    public function registerAction(){ 
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $birthdate = filter_input(INPUT_POST, 'birthdate');
        $gender = filter_input(INPUT_POST, 'gender');
        $birthdate = date("Y-m-d", strtotime($birthdate));
        $teacher = filter_input(INPUT_POST, 'teacher');
        $student = filter_input(INPUT_POST, 'student');
        $employee = filter_input(INPUT_POST, 'employee');

        $users = new UsersController();
        if($name and $email and $cpf and $birthdate and $teacher and $student and $employee){
            if($users->findByCpf($cpf) or $users->findByEmail($email)){
                $_SESSION['flash'] = 'E-mail e ou CPF ja cadastrados!';
                $this->redirect('/academico/registrarUsuario');
            }else{
                $password = rand(0, 9999);
                Users::insert([
                    'name' => $name,
                    'email' => $email,
                    'cpf' => $cpf,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'birthdate' => $birthdate,
                    'gender' => $gender,
                    'teacher' => $teacher,
                    'student' => $student,
                    'employee' => $employee
                ])->execute();

                $user = $users->findByCpf($cpf);
                $_SESSION['flash'] = 'Usuario cadastrado! Codigo: '.$user->id. ' Senha: '.$password;
                $this->redirect('/academico/usuarios');
            }
        }else{
            $_SESSION['flash'] = 'Preencha todos os campos!';
            $this->redirect('/academico/registrarUsuario');
        }
    }

    public function login(){
        $login = filter_input(INPUT_POST, 'login');
        $password = filter_input(INPUT_POST, 'password');

        if($login && $password){
            $users = new UsersController();

            if(strlen($login) == 11){
                $user = $users->findByCpf($login);
            }else{
                $user = $users->findById($login);
            }
            if($user){
                if(password_verify($password, $user->password)){
                    $_SESSION['token'] = md5(rand(0, 999999).time());
                    $user->token = $_SESSION['token'];
                    $users->updateUser($user);
                    $this->redirect('/academico/menu');
                }
            }
        }
        $_SESSION['flash'] = 'Login e ou senha invalidos!';
        $this->redirect('/');
    }

    public function logout(){
        $_SESSION['token'] = null;
        session_unset();
        session_destroy();
        $this->redirect('/');
    }

}