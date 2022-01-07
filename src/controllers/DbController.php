<?php
require_once 'AppController.php';

require_once __DIR__ . '/../helpers/LoginMenager.php';


class DbController extends AppController {


    public function dodajZaklad()    {
        LoginMenager::redirectIfNotLoggedIn();
        if (!$this->isPost()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/mojeZaklady");
        }

        foreach ($_POST['mecz'] as  $key => $value) {
            echo $_POST['mecz'][$key] . " - ";
            echo $_POST['data'][$key] . " - ";
            echo $_POST['rodzajZakladu'][$key] . " - ";
            echo $_POST['wartoscZakladu'][$key] . " - ";
            echo $_POST['kurs'][$key] . " - ";
            echo $_POST['status'][$key] . " <br/>";
        }





        die("aaa");


    }




}