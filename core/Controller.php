<?php

namespace app\core;

use app\core\middleware\BaseMiddleware;

class Controller
{
    public string $layout = 'main' ;
    protected $view;
    public array $middlewares = [] ;

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
    public function setLayout($layout)
    {
        $this->layout = $layout ;
    }

    public function registerMiddleware(BaseMiddleware $middleware){

        $this->middlewares[] = $middleware ;

    }

}