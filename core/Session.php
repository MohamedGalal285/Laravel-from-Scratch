<?php

namespace app\core;

class Session{
    protected const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        session_start();
        $flashMassages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMassages as $key => &$flashMassage){
            $flashMassage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMassages ;

    }

    public function setFlash($key , $message){
        $_SESSION[self::FLASH_KEY][$key] = [
            'removed' => false,
            'value' => $message
        ];
    }

    public function getFlash($key){
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false ;
    }

    public function get($key){
        return $_SESSION[$key] ?? false ;
    }

    public function set($key , $value){
        $_SESSION[$key] = $value;
    }

    public function remove($key){
        unset($_SESSION[$key]);
    }

    public function __destruct()
    {
        $flashMassages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMassages as $key => &$flashMassage){
            if ($flashMassage['remove'])  {
                unset($flashMassages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMassages ;
    }

}