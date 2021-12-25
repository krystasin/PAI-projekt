
Strona MAIN




<?php
require_once __DIR__ . '/../../src/models/User.php';

if(isset($_SESSION['user']))
    echo $_SESSION['user'];

echo "<br/>";

/*$client = new http\Client;
$request = new http\Client\Request;

$request->setRequestUrl('https://odds.p.rapidapi.com/v1/sports');
$request->setRequestMethod('GET');
$request->setHeaders([
    'x-rapidapi-host' => 'odds.p.rapidapi.com',
    'x-rapidapi-key' => 'SIGN-UP-FOR-KEY'
]);

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();*/