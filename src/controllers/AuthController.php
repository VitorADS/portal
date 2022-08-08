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

        $users = new UsersController();

        if($users->findByCpf($cpf) or $users->findByEmail($email)){
            $_SESSION['flash'] = 'E-mail ou CPF ja cadastrados!';
            $this->redirect('/academico/registrarUsuario');
        }else{
            $password = rand(0, 9999);
            Users::insert([
                'name' => $name,
                'email' => $email,
                'cpf' => $cpf,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'birthdate' => $birthdate,
                'gender' => $gender
            ])->execute();

            $user = $users->findByCpf($cpf);
            $_SESSION['flash'] = 'Usuario cadastrado! Codigo: '.$user->id. ' Senha: '.$password;
            $this->redirect('/academico/usuarios');
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
                }else{
                    $_SESSION['flash'] = 'Login e ou senha invalidos!';
                    $this->redirect('/');
                }
            }else{
                $_SESSION['flash'] = 'Codigo ou CPF invalidos!';
                $this->redirect('/');
            }
        }else{
            $_SESSION['flash'] = 'Codigo e ou senha nao preenchidos!';
        }
    }

    public function logout(){
        $_SESSION['token'] = '';
        session_unset();
        session_destroy();
        $this->redirect('/');
    }

}