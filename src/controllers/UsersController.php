<?php
namespace src\controllers;

use \core\Controller;
use src\models\Users;

class UsersController extends Controller {

    public function generateUser($id, $name, $email, $password, $cpf, $birthdate, $gender, $token, $student, $employee, $teacher) {
        $user = new Users();
        $user->id = $id;
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->cpf = $cpf;
        $user->birthdate = $birthdate;
        $user->gender = $gender;
        $user->token = $token;
        $user->student = $student;
        $user->employee = $employee;
        $user->teacher = $teacher;

        return $user;
    }

    public function findById($id){
        $user = Users::select()
            ->where('id', $id)
            ->get();

        if(count($user) > 0){
            $user = $this->generateUser($user[0]['id'], $user[0]['name'], $user[0]['email'], $user[0]['password'], $user[0]['cpf'],
            $user[0]['birthdate'], $user[0]['gender'], $user[0]['token'], $user[0]['student'], $user[0]['employee'], $user[0]['teacher']);

            return $user;
        }else{
            return false;
        }
    }

    public function findByCpf($cpf){
        $user = Users::select()
            ->where('cpf', $cpf)
            ->get();

        if(count($user) > 0){
            $user = $this->generateUser($user[0]['id'], $user[0]['name'], $user[0]['email'], $user[0]['password'], $user[0]['cpf'],
            $user[0]['birthdate'], $user[0]['gender'], $user[0]['token'], $user[0]['student'], $user[0]['employee'], $user[0]['teacher']);

            return $user;
        }else{
            return false;
        }
    }

    public function findByEmail($email){
        $user = Users::select()
            ->where('email', $email)
            ->get();

        if(count($user) > 0){
            $user = $this->generateUser($user[0]['id'], $user[0]['name'], $user[0]['email'], $user[0]['password'], $user[0]['cpf'],
            $user[0]['birthdate'], $user[0]['gender'], $user[0]['token'], $user[0]['student'], $user[0]['employee'], $user[0]['teacher']);

            return $user;
        }else{
            return false;
        }
    }

    public function findByToken($token){
        $user = Users::select()
            ->where('token', $token)
            ->get();

        if(count($user) > 0){
            $user = $this->generateUser($user[0]['id'], $user[0]['name'], $user[0]['email'], $user[0]['password'], $user[0]['cpf'],
            $user[0]['birthdate'], $user[0]['gender'], $user[0]['token'], $user[0]['student'], $user[0]['employee'], $user[0]['teacher']);

            return $user;
        }else{
            return false;
        }
    }

    public function getAll(){
        $user = Users::select()
            ->get();

        return $user;
    }

    public function updateUser(Users $user){
        Users::update()
            ->set('name', $user->name)
            ->set('email', $user->email)
            ->set('password', $user->password)
            ->set('gender', $user->gender)
            ->set('token', $user->token)
            ->where('id', $user->id)
            ->execute();
    }
}