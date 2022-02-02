<?php
require_once 'AppController.php';

require_once __DIR__ . '/../models/Tag.php';
require_once(__DIR__ . '/../repository/TagRepository.php');


class TagController extends AppController
{
    private $tagRepo;

    public function __construct()
    {
        parent::__construct();
        $this->tagRepo = new TagRepository();
    }



    public function mojeTagi()
    {
        LoginMenager::redirectIfNotLoggedIn();
        $tagi = $this->tagRepo->getAllTags($_SESSION['user']);
        $this->render('mojeTagi', ['title' => 'Zarządzaj tagami', 'tagi' => $tagi ]);

    }

    public function dodajTag()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {

            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->tagRepo->dodajTag($decoded['nazwa'], $decoded['kolor'], $decoded['aktywny'], $decoded['opis'],$_SESSION['user']));
        }
    }

    public function zmienAktywnosc(){
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {

            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->tagRepo->zmienAktywnosc($decoded['id'], $decoded['value']));
        }
    }

    public function usunTag(){
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {

            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->tagRepo->usunTag($decoded['id']));
        }
    }


}