<?php
require_once 'AppController.php';

require_once __DIR__ . '/../helpers/LoginMenager.php';
require_once __DIR__ . '/../repository/AdminRepository.php';


class AdminController extends AppController
{
    private AdminRepository $repo;


    public function __construct()
    {
        parent::__construct();
        $this->repo = new AdminRepository();
    }
    public function zarzadzajZakladami()
    {
        $zaklady = $this->repo->getAllZaklady();
        $this->render('admin/zarzadzajZakladami', ['title' => 'Strona główna','zaklady' => $zaklady ]);
    }

    public function a_zmienWartoscZakladu()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json')
        {
            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->repo->zmienWartoscZakladu($decoded['zakladId'], $decoded['wartoscId'], $decoded['wartosc']));
        }
    }

    public function a_zmienRodzajZakladu()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json')
        {
            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->repo->zmienRodzajZakladu($decoded['zakladId'], $decoded['wartosc']));
        }
    }

    public function stworzZaklad()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json')
        {
            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->repo->stworzZaklad($decoded['nazwa'], $decoded['wartosci']));
        }
    }


}