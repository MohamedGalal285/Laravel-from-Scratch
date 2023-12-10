<?php

namespace app\core;

abstract class Model{

    public const RULE_REQUIRED = 'required';
    public const RULE_Email = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public function loadData($data){
        foreach ($data as $key => $value) {
            if (property_exists($this,$key)) {
                $this->{$key} = $value ;
            }
        }
    }

    abstract public function rules(): array;

    public function lables(): array{
        return [] ;
    }

    public array $errors = [] ;

    public function validate(){
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach($rules as $rule){
                $ruleName = $rule ;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrors($attribute , self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_Email && !filter_var($value,FILTER_VALIDATE_EMAIL)) {
                    $this->addErrors($attribute , self::RULE_Email);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrors($attribute , self::RULE_MIN , $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addErrors($attribute , self::RULE_MAX , $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']} ) {
                    $this->addErrors($attribute , self::RULE_MATCH , $rule);
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Application:: $app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr ");
                    $statement->bindValue(":attr" , $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrors($attribute , self::RULE_UNIQUE , ['field' => $attribute] );
                    }
                }
            }
        }
        return empty($this->errors);
    }

    public function addErrors(string $attribute , string $rule , $params=[]){
        $messages = $this->errorMessages()[$rule] ?? '' ;
        foreach ($params as $key => $value) {
            $messages = str_replace("{{$key}}" , $value , $messages) ;
        }
        $this->errors[$attribute][] = $messages;
    }
    public function addError(string $attribute , string $messages){
        $this->errors[$attribute][] = $messages;
    }

    public function errorMessages(){
        return[
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_Email => 'This field must be a valid email address',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_UNIQUE => 'This {field} already exists',
        ];

    }
    public function hasError($attribute){
        return $this->errors[$attribute] ?? false ;
    }

    public function getFirstError($attribute){
        return $this->errors[$attribute][0] ?? false ;
    }


}