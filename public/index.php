<?php

require_once "../vendor/autoload.php";

use controller\AuthController;
use controller\SiteController;
use controller\TaskController;
use core\Application;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];


$app = new Application(dirname(__DIR__), $config);

$app->router->get('/manager', [SiteController::class, 'manager']);

$app->router->get('/doctor', [SiteController::class, 'doctor']);

$app->router->get('/patient', [SiteController::class, 'patient']);

$app->router->get('/register', [AuthController::class, 'register']);

$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/', [AuthController::class, 'login']);

$app->router->post('/', [AuthController::class, 'login']);

$app->router->get('/logout', [AuthController::class, 'logout']);



$app->run();