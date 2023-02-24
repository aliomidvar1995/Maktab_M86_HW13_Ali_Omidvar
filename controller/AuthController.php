<?php

namespace controller;
use core\Application;
use core\Request;
use core\Response;
use model\LoginModel;
use model\RegisterModel;

class AuthController{
    public static function register() {
        $registerModel = new RegisterModel();
        if(Application::$app->request->isPost()) {
            
            $registerModel->loadData(Application::$app->request->getBody());
            $registerModel->validate();
            if(empty($registerModel->errors)) {
                $registerModel->save();
                Application::$app->session->setFlash('success', 'Thanks for registering');
                self::login();
                Application::$app->response->redirect('/'.Application::$app->user->rule);
            }
            Application::$app->response->renderView('default', 'register', [
                'errors' => $registerModel->errors
            ]);
        }
        Application::$app->response->renderView('default', 'register');
    }


    public static function login() {
        $loginModel = new LoginModel();
        if(Application::$app->request->isPost()) {
            $loginModel->loadData(Application::$app->request->getBody());
            $loginModel->validate();
            if(empty($loginModel->errors) && $loginModel->login()) {
                Application::$app->response->redirect('/'.Application::$app->user->rule);
            }
            // print_r($loginModel->errors);
            // exit();
            Application::$app->response->renderView('default', 'login', [
                'errors' => $loginModel->errors
            ]);
        }
        Application::$app->response->renderView('default', 'login');
    }
    public static function logout() {
        Application::$app->logout();
        Application::$app->response->redirect('/');
    }
}