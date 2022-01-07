<?php
session_start();





require 'Routing.php';

    $path = trim($_SERVER['REQUEST_URI'], '/');
    $path = PARSE_URL($path, PHP_URL_PATH);

    Routing::get('', 'DefaultController');
    Routing::get('mojeZaklady', 'DefaultController');
    Routing::get('mojeTagi', 'DefaultController');
    Routing::get('register', 'DefaultController');
    Routing::get('statystyki', 'DefaultController');

    Routing::post('dodajZaklad', 'DbController');


    Routing::post('login', 'SecurityController');
    Routing::post('logout', 'SecurityController');



    Routing::run($path);


require_once __DIR__ . '/public/views/static/footer.php';

