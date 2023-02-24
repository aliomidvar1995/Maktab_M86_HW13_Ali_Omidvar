<?php

namespace core;
use model\Dbmodel;
use model\RegisterModel;

class Application {
    public static $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $database;
    public ?RegisterModel $user;
    public static Application $app;

    public function __construct($rootPath, array $config) {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->user = new RegisterModel();
        $this->router = new Router($this->request, $this->response);
        $this->database = new Database($config['db']);
        $primaryKey = $this->user::primaryKey();
        $primaryValue = $this->session->get($primaryKey);
        if($primaryValue) {
            $this->user = $this->user::findOne([$primaryKey => $primaryValue]);
        }else {
            $this->user = null;
        }
    }
    public function run() {
        return $this->router->render();
    }

    public function login(RegisterModel $user) {
        $this->user = $user;
        $primaryKey = $user::primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set($primaryKey, $primaryValue);
    }
    public function logout() {
        $this->user = null;
        $this->session->remove('id');
    }
}