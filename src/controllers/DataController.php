<?php
require_once 'AppController.php';

require_once __DIR__ . '/../helpers/LoginMenager.php';
require_once(__DIR__ . '/../repository/DataRepository.php');


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
            echo json_encode( $this->dataRepo->dodajZaklad($decoded['data'], $_SESSION['user']));
        }

    }


    public function test()
    {
        LoginMenager::redirectIfNotLoggedIn();
        if (!$this->isPost()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/mojeZaklady");
        }


        foreach ($_POST['mecz'] as $k => $v) {
            var_dump($_POST['status'][$k]);
            echo "<br/> ";
            var_dump($_POST['rodzajZakladu'][$k]);
            echo "<br/> ";
            var_dump($_POST['wartoscZakladu'][$k]);
            echo "<br/> ";
            var_dump($_POST['kurs'][$k]);
            echo "<br/> ";
            var_dump($_POST['status'][$k]);
            die(",");

            if ($_POST['status'][$k])


                echo $_POST['data'][$k] . " - ";
            echo $_POST['rodzajZakladu'][$k] . " - ";
            echo $_POST['wartoscZakladu'][$k] . " - ";
            echo $_POST['kurs'][$k] . " - ";
            echo $_POST['status'][$k] . " <br/>";
        }

        die("aaa");
    }


}