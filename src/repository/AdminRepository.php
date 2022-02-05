<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/ZakladRodzaj.php';
require_once __DIR__ . '/../models/ZakladWartosc.php';


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
        return ['status' => true, 'id' => $id, 'rodzaj' => $rodzaj , 'wartosci' => $wart];

    }


}