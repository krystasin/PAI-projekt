<?php
require_once 'AppController.php';

require_once __DIR__ . '/../helpers/LoginMenager.php';
require_once(__DIR__ . '/../repository/DataRepository.php');
require_once(__DIR__ . '/../repository/StitiscticsRepository.php');


class DataController extends AppController
{
    private $DataRepo;

    public function __construct()
    {
        parent::__construct();
        $this->dataRepo = new DataRepository();
    }

    public function dodajZaklad()
    {

        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === "application/json") {

            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode( $this->dataRepo->dodajZaklad($decoded['data'], $_SESSION['user'],$decoded['stawka'],$decoded['tagi']));
        }

    }


    public function loadMoreKupons()
    {

        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === "application/json") {

            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode( $this->dataRepo->loadMoreKupons($decoded['lastID'], $_SESSION['user']));
        }

    }

    public function pobierzWybraneZaklady()
    {

        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === "application/json") {

            $statsRepo = new StitiscticsRepository();
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode( $statsRepo->pobierzWybraneZaklady($decoded['id'], $decoded['userId']));
        }

    }




}