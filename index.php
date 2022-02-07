<?php
session_start();





require 'Routing.php';

    $path = trim($_SERVER['REQUEST_URI'], '/');
    $path = PARSE_URL($path, PHP_URL_PATH);

    Routing::get('', 'DefaultController');
    Routing::get('mojeZaklady', 'DefaultController');
    Routing::get('register', 'DefaultController');
    Routing::get('statystyki', 'DefaultController');

    Routing::post('dodajZaklad', 'DataController');
    Routing::post('loadMoreKupons', 'DataController');
    Routing::post('pobierzWybraneZaklady', 'DataController');

    Routing::get('mojeTagi', 'TagController');
    Routing::get('dodajTag', 'TagController');
    Routing::get('zmienAktywnosc', 'TagController');
    Routing::get('usunTag', 'TagController');


    Routing::post('login', 'SecurityController');
    Routing::post('logout', 'SecurityController');
    Routing::post('registerBG', 'SecurityController');
    Routing::post('isEmailAvailable', 'SecurityController');
    Routing::post('isLoginAvailable', 'SecurityController');

    Routing::post('zarzadzajZakladami', 'AdminController');
    Routing::post('zarzadzajMeczami', 'AdminController');
    Routing::post('a_zmienWartoscZakladu', 'AdminController');
    Routing::post('a_zmienRodzajZakladu', 'AdminController');
    Routing::post('stworzZaklad', 'AdminController');



    Routing::run($path);




