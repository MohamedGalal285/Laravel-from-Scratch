<?php

use app\controllers\AdminController;
use app\controllers\CategoriesController;
use app\controllers\ProductsController;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\core\Application;
use app\models\User;

require_once __DIR__ . '/../vendor/autoload.php' ;
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];
 
$app = new Application(dirname(__DIR__) , $config ); 

//Admin controllers
$app->router->get('/admin', [AdminController::class , 'index']);
//category
$app->router->get('/admin/categories', [CategoriesController::class , 'index']);
$app->router->get('/admin/addcategory', [CategoriesController::class , 'add']);
$app->router->post('/admin/storecategory', [CategoriesController::class , 'store']);
$app->router->get('/admin/editcategory{$id}', [CategoriesController::class , 'edit']);
$app->router->post('/admin/updatecategory', [CategoriesController::class , 'update']);
$app->router->get('/admin/deletecategory{$id}', [CategoriesController::class , 'delete']);
//product
$app->router->get('/admin/products', [ProductsController::class , 'index']);
$app->router->get('/admin/addProduct', [ProductsController::class , 'add']);
$app->router->post('/admin/storeProduct', [ProductsController::class , 'store']);
$app->router->get('/admin/editProduct{$id}', [ProductsController::class , 'edit']);
$app->router->post('/admin/updateProduct', [ProductsController::class , 'update']);
$app->router->get('/admin/deleteProduct{$id}', [ProductsController::class , 'delete']);

//Site Controllers
$app->router->get('/', [SiteController::class , 'home']);
$app->router->get('/contact', [SiteController::class , 'contact']);

//Auth Controllers
$app->router->get('/login', [AuthController::class , 'login']);
$app->router->get('/register', [AuthController::class , 'register']);
$app->router->post('/login', [AuthController::class , 'login']);
$app->router->post('/register', [AuthController::class , 'register']);
$app->router->post('/logout', [AuthController::class , 'logout']);

$app->run();







