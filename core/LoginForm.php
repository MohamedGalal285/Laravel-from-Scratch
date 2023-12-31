<?php

namespace app\core;

use app\models\User;

class LoginForm extends Model{

    public string $email ='' ;
    public string $password ='' ;
    public function rules():array{
        return [
            'email' => [self::RULE_REQUIRED , self::RULE_Email ],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function login(){
        $user = new User();
        $user = $user->findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email' , 'This is unvalid email');
            return false;
        }
        if (!password_verify($this->password , $user->password)) {
            $this->addError('password' , 'Password is incorrect');
            return false;
        }

//             echo "<pre>";
// var_dump($user);
// echo "</pre>";
// exit;

        return Application::$app->login($user);
    }



}