<?php


require_once 'AppController.php';
require_once __DIR__ . '/../helpers/LoginMenager.php';
require_once __DIR__ . '/../repository/DataRepository.php';

class DefaultController extends AppController
{

    private $datarepo;

    public function __construct()
    {
        parent::__construct();
        $this->datarepo = new DataRepository();
    }


    public function index()
    {
        LoginMenager::redirectIfLoggedIn();
        $this->render('login', ['title' => 'Strona główna']);
    }


    public function mojeZaklady()
    {
        LoginMenager::redirectIfNotLoggedIn();
        $kupony = $this->datarepo->getAllKupons($_SESSION['user']);
        $metaData = $this->datarepo->getMetaData();
        $this->render('mojeZaklady', ['title' => 'Strona główna', 'kupony' => $kupony, 'metaData' => $metaData]);

    }

    public function register()
    {
        $this->render('register', ['title' => 'Rejestracja']);

    }

    public function statystyki()
    {
        $this->render('statystyki', ['title' => 'Statystyki']);

    }


}