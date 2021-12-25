<?php

require_once 'AppController.php';
require_once __DIR__ . '/../helpers/LoginMenager.php';

class DefaultController extends AppController {

    public function index()    {
        $this->render('login');
    }


    public function main()    {
        LoginMenager::redirectIfNotLoggedIn();
        $this->render('headers/header', ['title' => 'Strona główna']);
        $this->render('static/navigation');
        $this->render('main');
        $this->render('static/footer');
    }


    public function tags()    {
        LoginMenager::redirectIfNotLoggedIn();
        $this->render('headers/header', ['title' => 'Zarządzaj tagami']);

        $this->render('static/navigation');
        $this->render('tags');
        $this->render('static/footer');
    }
}