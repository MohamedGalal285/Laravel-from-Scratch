<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller{

    public function home(){
        return $this->render('page');
    }
    public function contact(){
        return $this->render('contact');
    }
    public function handleContact(Request $request){
        $body = $request->getBody();
        return "Data";
    }
}