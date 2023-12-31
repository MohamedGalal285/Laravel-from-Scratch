<?php
 
namespace app\core;

use app\models\User;

class Application{
    public string $layout = 'main';
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public static Application $app;
    public ?Controller $controller = null;
    public ?DbModel $user;
    public string $userClass;

    public function __construct($rootPath , array $config ) 
    {
        $this->db = new Database($config['db']);
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request , $this->response);
        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }else{
            $this->user = null;
        }
        
    }

    

    public function getController(){
        return $this->controller ;
    } 
    public function setController($controller){
        $this->controller = $controller ;
    } 

    public function login(DbModel $user){
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user' , $primaryValue);
        return true ;
    }
    public function logout(){
        $this->user = null;
        $this->session->remove('user');
    }

    public function run(){
        echo $this->router->resolve();
    }
}