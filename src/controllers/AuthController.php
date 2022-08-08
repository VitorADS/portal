<?php
namespace src\controllers;

use \core\Controller;

class AuthController extends Controller {

    public function login(){
        $login = filter_input('login', INPUT_POST);
        $password = filter_input(('password'), INPUT_POST);

        if($login && $password){
            $users = new UsersController();

            if(count($login) == 11){
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

}