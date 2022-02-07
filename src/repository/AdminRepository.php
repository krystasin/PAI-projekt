<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/ZakladRodzaj.php';
require_once __DIR__ . '/../models/ZakladWartosc.php';
require_once __DIR__ . '/../models/Druzyna.php';
require_once __DIR__ . '/../models/Liga.php';


class AdminRepository extends Repository
{

    public function getAllZaklady()
    {
        $con = $this->database->setConnection();
        $stmt = $con->prepare("SELECT zaklad_rodzaj_id as id, rodzaj_zakladu as rodzaj FROM _zaklady_rodzaje ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $zaklady = array();
        foreach ($result as $r) {
            $zaklady[$r['id']] = new ZakladRodzaj($r['id'], $r['rodzaj']);
        }

        $stmt = $con->prepare('SELECT zaklad_rodzaj_id as id_z, zaklad_wartosc_id as id_w, wartosc_zakladu as wartosc FROM _zaklady_wartosci ORDER BY id_w ASC');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $w) {
            $zaklad = $zaklady[$w['id_z']];
            $zaklad->dodajWartosc($w['id_w'], $w['wartosc']);
        }

        return $zaklady;
    }


    public function zmienWartoscZakladu($zID, $wID, $wartosc)
    {
        $con = $this->database->setConnection();
        $stmt = $con->prepare('UPDATE _zaklady_wartosci SET wartosc_zakladu = :wartosc 
                                    WHERE zaklad_rodzaj_id = :zID AND zaklad_wartosc_id = :wID');
        $stmt->bindParam(':wartosc', $wartosc, PDO::PARAM_STR);
        $stmt->bindParam(':zID', $zID, PDO::PARAM_INT);
        $stmt->bindParam(':wID', $wID, PDO::PARAM_INT);
        $stmt->execute();
        return ['wiad' => 'ok'];
    }


    public function zmienRodzajZakladu($zID, $rodzaj)
    {

        $con = $this->database->setConnection();
        $stmt = $con->prepare('UPDATE _zaklady_rodzaje SET rodzaj_zakladu = :rodzaj WHERE zaklad_rodzaj_id = :zID returning *');

        $stmt->bindParam(':rodzaj', $rodzaj, PDO::PARAM_STR);
        $stmt->bindParam(':zID', $zID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }






    public function dodajMecz($gospId, $goscId, $ligaId, $data)
    {
        $con = $this->database->setConnection();
        $stmt = $con->prepare("INSERT INTO public.mecze (mecz_id, druzyna_1_id, druzyna_2_id, data_meczu, liga_id)
            VALUES (DEFAULT, :id1, :id2, :data_m, :idLiga)");
        $stmt->bindParam(':id1', $gospId, PDO::PARAM_INT);
        $stmt->bindParam(':id2', $goscId, PDO::PARAM_INT);
        $stmt->bindParam(':data_m', $data, PDO::PARAM_INT);
        $stmt->bindParam(':idLiga', $ligaId, PDO::PARAM_INT);
        $stmt->execute();

    }







    public function getMecze()
    {
        $con = $this->database->setConnection();
        $stmt = $con->prepare('select
       m.mecz_id as id,
       d1.druzyna_nazwa as gospodarz,
       d2.druzyna_nazwa as gosc,
       l.liga,
       m.data_meczu as data
from mecze m
         JOIN druzyny d1 on m.druzyna_1_id = d1.druzyna_id
         JOIN druzyny d2 on m.druzyna_2_id = d2.druzyna_id
         join _ligi l on m.liga_id = l.liga_id
ORDER BY m.data_meczu DESC');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    public function getMeczeMetaData()
    {
        $ret = array();
        $ret['druzyny'] = array();
        $ret['ligi'] = array();
        $con = $this->database->setConnection();
        $stmt = $con->prepare('SELECT * FROM druzyny ');
        $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

            array_push($ret['druzyny'], new Druzyna($row['druzyna_id'], $row['druzyna_nazwa']));
        }

        $con = $this->database->setConnection();
        $stmt = $con->prepare('SELECT * FROM _ligi ');
        $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

            array_push($ret['ligi'], new Liga($row['liga_id'], $row['liga']));
        }

        return $ret;
    }


    public function stworzZaklad($rodzaj, $wartosci)
    {


        $con = $this->database->setConnection();
        $stmt = $con->prepare('select count(*) as ile from _zaklady_rodzaje where rodzaj_zakladu LIKE :nazwa');
        $stmt->bindParam(':nazwa', $rodzaj, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['ile'] > 0) return ['status' => false, 'message' => 'istnieje juz zaklad o takiej nazwie'];


        $stmt = $con->prepare("INSERT INTO _zaklady_rodzaje 
                VALUES (nextval('_zaklady_rodzaje_zaklad_rodzaj_id_seq'), :nazwa) RETURNING zaklad_rodzaj_id as id");
        $stmt->bindParam(':nazwa', $rodzaj, PDO::PARAM_STR);
        $stmt->execute();
        $id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

        $i = 1;
        $wart = [];
        foreach ($wartosci as $w) {

            $stmt = $con->prepare("INSERT INTO _zaklady_wartosci
                VALUES ( :i, :id, :wartosc) RETURNING zaklad_rodzaj_id as id");

            $stmt->bindParam(':i', $i, 1);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':wartosc', $w, PDO::PARAM_STR);
            $stmt->execute();
            array_push($wart, ['id' => $i, 'wartosc' => $w]);
            $i++;
        }
        return ['status' => true, 'id' => $id, 'rodzaj' => $rodzaj, 'wartosci' => $wart];

    }


}