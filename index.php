<?php
session_start();





require 'Routing.php';

    $path = trim($_SERVER['REQUEST_URI'], '/');
    $path = PARSE_URL($path, PHP_URL_PATH);

    Routing::get('', 'DefaultController');
    Routing::get('main', 'DefaultController');
    Routing::get('tags', 'DefaultController');
    Routing::post('login', 'SecurityController');
    Routing::post('logout', 'SecurityController');



    Routing::run($path);


