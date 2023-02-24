<?php

namespace controller;
use core\Application;
use core\Request;
use core\Response;

class SiteController {
    public static function manager() {
        if(!empty($_SESSION['id'])){
            Application::$app->response->renderView('default', 'manager');
        }else {
            Application::$app->response->redirect('/');
        }
    }

    public static function doctor() {
        if(!empty($_SESSION['id'])){
            Application::$app->response->renderView('default', 'doctor');
        }else {
            Application::$app->response->redirect('/');
        }
    }

    public static function patient(Request $request, Response $response) {
        if(!empty($_SESSION['id'])){
            Application::$app->response->renderView('default', 'patient');
        }else {
            Application::$app->response->redirect('/');
        }
    }
}