<?php

require_once 'AppController.php';
require_once __DIR__ . '/../helpers/LoginMenager.php';

class DefaultController extends AppController {

    public function index()    {
        $this->render('login');
    }

    public function projects()    {
        LoginMenager::redirectIfNotLoggedIn();
        $this->render('projects');
    }

    public function main()    {
        LoginMenager::redirectIfNotLoggedIn();
        $this->render('main');
    }
    public function tags()    {
        LoginMenager::redirectIfNotLoggedIn();
        $this->render('tags');
    }
}