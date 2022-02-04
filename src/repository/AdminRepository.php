<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/ZakladRodzaj.php';
require_once __DIR__ . '/../models/ZakladWartosc.php';


class AdminRepository extends Repository
{

    public function getAllZaklady(){
        $con = $this->database->setConnection();
        $stmt = $con->prepare("SELECT zaklad_rodzaj_id as id, rodzaj_zakladu as rodzaj FROM _zaklady_rodzaje ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $zaklady = array();
        foreach($result as $r) {
            $zaklady[$r['id']] = new ZakladRodzaj($r['id'], $r['rodzaj']);
        }

        $stmt = $con->prepare('SELECT zaklad_rodzaj_id as id_z, zaklad_wartosc_id as id_w, wartosc_zakladu as wartosc FROM _zaklady_wartosci ORDER BY id_w ASC');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $w){
            $zaklad = $zaklady[$w['id_z']];
            $zaklad->dodajWartosc($w['id_w'] , $w['wartosc']);
        }

        return $zaklady;
    }




}