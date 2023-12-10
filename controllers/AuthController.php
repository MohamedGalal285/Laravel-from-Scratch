<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\LoginForm;
use app\core\middleware\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\User;

class AuthController extends Controller{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function login(Request $request , Response $response){

        $this->setLayout('auth');
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $response->redirect('/');
                return; 
            }
        }


        return $this->render('login',[
            'model' => $loginForm
        ]);
    }
    public function register(Request $request){

        $this->setLayout('auth');

        $user = new User() ; 

        if($request->isPost()){
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success' , 'You reqister successfully');
                Application::$app->response->redirect('/');
                
            }
            return $this->render('register' , [
                'model' => $user
            ]);
        }
        

        return $this->render('register' , [
            'model' => $user
        ]);
    }

    public function logout(Request $request , Response $response){
        Application::$app->logout();
        $response->redirect('/');
    }



}



// echo "<pre>";
// var_dump();
// echo "</pre>";
// exit;
