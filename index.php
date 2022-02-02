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

    Routing::get('mojeTagi', 'TagController');
    Routing::get('dodajTag', 'TagController');
    Routing::get('zmienAktywnosc', 'TagController');
    Routing::get('usunTag', 'TagController');


    Routing::post('login', 'SecurityController');
    Routing::post('logout', 'SecurityController');



    Routing::run($path);




