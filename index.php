<?php
    require 'Routing.php';
    $path = trim($_SERVER['REQUEST_URI'], '/');
    $PATH = PARSE_URL($path, PHP_URL_PATH);

    Routing::get('index', 'DefaultControler');
    Routing::get('projects', 'DefaultControler');
    Routing::run($path);


