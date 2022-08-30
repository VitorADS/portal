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
        $user->birthdate = date('d/m/Y', strtotime($birthdate));
        $user->gender = $gender;
        $user->token = $token;
        $user->student = $student;
        $user->employee = $employee;
        $user->teacher = $teacher;
        $user->gender == 1 ? $user->gender = 'Masculino' : $user->gender = 'Feminino';
        $user->student == 1 ? $user->student = 'Sim' : $user->student = 'Nao';
        $user->teacher == 1 ? $user->teacher = 'Sim' : $user->teacher = 'Nao';
        $user->employee == 1 ? $user->employee = 'Sim' : $user->employee = 'Nao';

        return $user;
    }

    public function generateUserUpdate(Users $user) {
        $user->gender == 'Masculino' ? $user->gender = 1 : $user->gender = 0;
        $user->student == 'Sim' ? $user->student = 1 : $user->student = 0;
        $user->teacher == 'Sim' ? $user->teacher = 1 : $user->teacher = 0;
        $user->employee == 'Sim' ? $user->employee = 1 : $user->employee = 0;

        return $user;
    }

    public function requestUser($id){
        $user = $this->findById($id);
        echo json_encode($user);
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
            ->execute();

        if(count($user) > 0){
            $user = $this->generateUser($user[0]['id'], $user[0]['name'], $user[0]['email'], $user[0]['password'], $user[0]['cpf'],
            $user[0]['birthdate'], $user[0]['gender'], $user[0]['token'], $user[0]['student'], $user[0]['employee'], $user[0]['teacher']);

            return $user;
        }else{
            return false;
        }
    }

    public function getAll(){
        $users = Users::select()->get();

        $array = [];

        foreach($users as $user){
            $data = $this->generateUser($user['id'], $user['name'], $user['email'], $user['password'], $user['cpf'],
            $user['birthdate'], $user['gender'], $user['token'], $user['student'], $user['employee'], $user['teacher']);

            $array[] = $data;
        }

        return $array;
    }

    public function updateUser(Users $user){
        $user = $this->generateUserUpdate($user);

        Users::update()
            ->set('name', $user->name)
            ->set('email', $user->email)
            ->set('password', $user->password)
            ->set('gender', $user->gender)
            ->set('token', $user->token)
            ->set('teacher', $user->teacher)
            ->set('student', $user->student)
            ->set('employee', $user->employee)
            ->where('id', $user->id)
            ->execute();
    }
}