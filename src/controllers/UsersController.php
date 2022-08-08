<?php
namespace src\controllers;

use \core\Controller;
use src\models\Users;

class UsersController extends Controller {

    public function generateUser($id, $name, $email, $password, $cpf, $birthdate, $gender, $token) {
        $user = new Users();
        $user->id = $id;
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->cpf = $cpf;
        $user->birthdate = $birthdate;
        $user->gender = $gender;
        $user->token = $token;

        return $user;
    }

    public function findById($id){
        $user = Users::select()
            ->where('id', $id)
            ->execute();

        if(count($user) > 0){
            $user = $this->generateUser($user[0]['id'], $user[0]['name'], $user[0]['email'], $user[0]['password'], $user[0]['cpf'],
            $user[0]['birthdate'], $user[0]['gender'], $user[0]['token']);

            return $user;
        }else{
            return false;
        }
    }

    public function findByCpf($cpf){
        $user = Users::select()
        ->where('cpf', $cpf)
        ->execute();

        if(count($user) > 0){
            $user = $this->generateUser($user[0]['id'], $user[0]['name'], $user[0]['email'], $user[0]['password'], $user[0]['cpf'],
            $user[0]['birthdate'], $user[0]['gender'], $user[0]['token']);

            return $user;
        }else{
            return false;
        }
    }

    public function updateUser(Users $user){
        Users::update()
            ->set('name', $user->name)
            ->set('email', $user->email)
            ->set('password', $user->password)
            ->set('gender', $user->gender)
            ->set('token', $user->token)
            ->execute();
    }
}