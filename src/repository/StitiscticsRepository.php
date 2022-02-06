<?php
require_once 'Repository.php';


require_once __DIR__ . '/../models/Statystyka.php';

class StitiscticsRepository extends Repository
{


    public function getStandardStatistics($user)
    {
        $con = $this->database->setConnection();
        $stmt = $con->prepare("SELECT * FROM statystyka_poprzez_rodzaj_zakladu( :user )");
        $stmt->bindValue(':user', $user, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ret = array();
        foreach ($result as $row) {
            array_push($ret, new Statystyka(
                $row['user_id'],
                $row['zaklad_rodzaj_id'],
                $row['rodzaj_zakladu'],
                $row['razem'],
                $row['wygrane'],
                $row['przegrane'],
                $row['nierozstrzygniete']
            ));
        }

        return $ret;
    }

    public function pobierzWybraneZaklady($id, $userId)
    {

        $id = intval($id);
        $userId = intval($userId);

        $con = $this->database->setConnection();
        $stmt = $con->prepare("SELECT 
       z.zaklad_id as id,
       z.kurs,
       zw.wartosc_zakladu as zaklad,
       m.data_meczu as data,
       s.status,
       d1.druzyna_nazwa as gospodarz,
       d2.druzyna_nazwa as gosc,
       l.liga
    FROM zaklady z
                    INNER JOIN kupony k using (kupon_id)
                    INNER JOIN mecze m using (mecz_id)
                    JOIN druzyny d1 on m.druzyna_1_id = d1.druzyna_id
                    JOIN druzyny d2 on m.druzyna_2_id = d2.druzyna_id
                    JOIN _zaklady_wartosci zw USING (zaklad_rodzaj_id, zaklad_wartosc_id)
                    JOIN _status s on z.status_id = s.status_id
                    LEFT JOIN _ligi l using (liga_id)

                where z.zaklad_rodzaj_id = :id AND k.user_id = :userId");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}