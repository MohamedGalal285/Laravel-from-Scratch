<?php

namespace app\models;

use app\core\DbModel;


class User extends DbModel{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public static function tableName(): string{
        return 'users' ;
    }
    public static function primaryKey(): string{
        return 'id' ;
    }


    public function save(){
        $this->password = password_hash($this->password , PASSWORD_DEFAULT);
        return parent::save();
    }
    public function rules():array{
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED , self::RULE_Email , [self::RULE_UNIQUE , 'class' => self::class]],
            'password' => [self::RULE_REQUIRED , [self::RULE_MAX ,'max' => 24] , [self::RULE_MIN ,'min' => 8]],
            'passwordConfirm' => [self::RULE_REQUIRED , [self::RULE_MATCH ,'match' => 'password']],
        ];
    }

    public function attributes(): array{
        return ['firstname' , 'lastname' , 'email' , 'password'];
    }
    public function lables(): array
    {
        return [
            'firstname' => 'First Name' ,
            'lastname' => 'Last Name'  ,
            'email' => 'Email' ,
            'password' => 'Password',
            'passwordConfirm' => 'Confirm Password'
            ];
    }

}