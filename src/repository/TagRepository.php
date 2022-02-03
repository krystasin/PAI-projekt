<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Tag.php';


class TagRepository extends Repository
{


    public function getAllTags($username)
    {
        $con = $this->database->setConnection();

        $stmt = $con->prepare('SELECT t.*, (select count(*) liczba from kupony_tagi kt where kt.tag_id = t.tag_id GROUP BY t.tag_id) liczba 
FROM tagi t WHERE user_id = (SELECT id from usersdata WHERE username LIKE :username)');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tagi = [];
        foreach ($result as $t) {
            array_push($tagi, new Tag($t['tag_id'], $t['nazwa'], $t['kolor'], $t['aktywny'], $t['opis'], $t['liczba']));
        }
        return $tagi;
    }


    public function dodajTag($nazwa, $kolor, $aktywny, $opis, $username)
    {
        $con = $this->database->setConnection();

        $stmt = $con->prepare("
            INSERT INTO tagi(tag_id, nazwa, kolor, opis, aktywny, user_id)
            VALUES (nextval('tagi_tag_id_seq'),:nazwa, :kolor, :opis, :aktywny, 
            (SELECT id from usersdata WHERE username LIKE :username) ) RETURNING tag_id as id, nazwa, kolor, opis, aktywny ");




        $stmt->bindValue(':nazwa', $nazwa, PDO::PARAM_STR);
        $stmt->bindValue(':kolor', $kolor, PDO::PARAM_STR);
        $stmt->bindValue(':opis', $opis, PDO::PARAM_STR);
        $stmt->bindValue(':aktywny', $aktywny, PDO::PARAM_BOOL);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function zmienAktywnosc($idTagu, $stan){
        $con = $this->database->setConnection();

        $stmt = $con->prepare("
            UPDATE tagi set aktywny = :stan WHERE tag_id = :id RETURNING tag_id, aktywny
            ");

        $stmt->bindValue(':stan', $stan, PDO::PARAM_BOOL);
        $stmt->bindValue(':id', $idTagu, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function usunTag($idTagu){
        $con = $this->database->setConnection();

        $stmt = $con->prepare('DELETE FROM kupony_tagi WHERE tag_id = :id');
        $stmt->bindValue(':id', $idTagu, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $con->prepare('DELETE FROM tagi WHERE tag_id = :id');
        $stmt->bindValue(':id', $idTagu, PDO::PARAM_INT);
        $stmt->execute();

        return ['result' => true];
    }



}