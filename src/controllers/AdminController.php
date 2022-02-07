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
        $this->render('admin/zarzadzajZakladami', ['title' => 'Strona główna', 'zaklady' => $zaklady]);
    }

    public function dodajNowyMecz()
    {

        $gosp = isset($_POST['gospodarz']) ? intval($_POST['gospodarz']) :false;
        $gosc = isset($_POST['gosc']) ? intval($_POST['gosc']) : false;
        $liga = isset($_POST['liga']) ? intval($_POST['liga']) : false;
        $data = (isset($_POST['data']) && $_POST['data'] !== "")? $_POST['data'] : false;
        $data = str_replace('T', ' ', $data);
        $data .= ":00.000000";

        $z = ($gosp !== $gosc);
        if ($gosp  && $gosc  && $liga  && $data && $z )        {
            $this->repo->dodajMecz($gosp  , $gosc  , $liga  , $data );
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/zarzadzajMeczami");
    }

    public function zarzadzajMeczami()
    {
        $metaData = $this->repo->getMeczeMetaData();
        $mecze = $this->repo->getMecze();

        $this->render('admin/zarzadzajMeczami', ['title' => 'Strona główna', 'metaData' => $metaData, 'mecze' => $mecze]);
    }


    public function a_zmienWartoscZakladu()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
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
        if ($contentType === 'application/json') {
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
        if ($contentType === 'application/json') {
            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->repo->stworzZaklad($decoded['nazwa'], $decoded['wartosci']));
        }
    }


}