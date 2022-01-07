<?php


require_once 'AppController.php';
require_once __DIR__ . '/../helpers/LoginMenager.php';
require_once __DIR__ . '/../repository/DataRepository.php';

class DefaultController extends AppController {

    public function index()    {
        LoginMenager::redirectIfLoggedIn();
        $this->render('login', ['title' => 'Strona główna']);
    }



    public function mojeZaklady()    {
        LoginMenager::redirectIfNotLoggedIn();
        $datarepo = new DataRepository();
        $kupony = $datarepo->getAllKupons($_SESSION['user']);
        $this->render('mojeZaklady',['title' => 'Strona główna', 'kupony' => $kupony]);

    }

    public function register()    {
        $this->render('register',['title' => 'Rejestracja']);

    }
    public function statystyki()    {
        $this->render('statystyki',['title' => 'Statystyki']);

    }


    public function mojeTagi()    {
        LoginMenager::redirectIfNotLoggedIn();
        $this->render('mojeTagi', ['title' => 'Zarządzaj tagami']);

    }
}