<?php
require_once 'AppController.php';

require_once __DIR__ . '/../helpers/LoginMenager.php';
require_once(__DIR__ . '/../repository/DataRepository.php');


class DbController extends AppController {


    public function dodajZaklad()    {

        return [ 0 => "odpowiedz"];
        LoginMenager::redirectIfNotLoggedIn();
        if (!$this->isPost()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/mojeZaklady");

            $repo = new DataRepository();
            $repo->dodajZaklad();


        }
    }





    public function test(){
        LoginMenager::redirectIfNotLoggedIn();
        if (!$this->isPost()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/mojeZaklady");
        }


        foreach ($_POST['mecz'] as  $k => $v) {
            var_dump($_POST['status'][$k]);
            echo  "<br/> ";
            var_dump($_POST['rodzajZakladu'][$k]);
            echo  "<br/> ";
            var_dump($_POST['wartoscZakladu'][$k]);
            echo  "<br/> ";
            var_dump($_POST['kurs'][$k]);
            echo  "<br/> ";
            var_dump($_POST['status'][$k]);
            die(",");

            if($_POST['status'][$k] )


                echo $_POST['data'][$k] . " - ";
            echo $_POST['rodzajZakladu'][$k] . " - ";
            echo $_POST['wartoscZakladu'][$k] . " - ";
            echo $_POST['kurs'][$k] . " - ";
            echo $_POST['status'][$k] . " <br/>";
        }

        die("aaa");
    }



}