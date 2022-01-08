<?php


require_once __DIR__ . '/../../Database.php';
require_once __DIR__ . '/../models/Zaklad.php';
require_once __DIR__ . '/../models/Kupon.php';

class DataRepository
{
    //todo zrobic singleton ? ? ?

    protected $database;

    public function __construct()
    {
        $this->database = new Database();
    }


    public function getAllKupons(string $username): array
    {
        $con = $this->database->setConnection();
        $stmt = $con->prepare("SELECT 
               k.kupon_id, 
               k.data_obstawienia,
               k.stawka,
               z.zaklad_id,
               z.mecz_id, 
               z.kurs,
               s_z.status as status_zakladu, 
               s_k.status as status_kuponu,
               rz.rodzaj_zakladu, rw.wartosc_zakladu,
               m.data_meczu, 
               d1.druzyna_nazwa AS gospodarz,
               d2.druzyna_nazwa AS gość
        FROM zaklady z
            JOIN kupony k USING (kupon_id)
            JOIN _zaklady_rodzaje rz USING (zaklad_rodzaj_id)
            JOIN _zaklady_wartosci rw USING (zaklad_rodzaj_id, zaklad_wartosc_id)
            JOIN mecze m USING (mecz_id)
            JOIN druzyny d1 ON m.druzyna_1_id = d1.druzyna_id
            JOIN druzyny d2 ON m.druzyna_2_id = d2.druzyna_id
            JOIN usersdata u on k.user_id = u.id
            JOIN _status s_z on z.status_id = s_z.status_id
            JOIN _status s_k on k.status_id = s_k.status_id
        WHERE u.username LIKE :username
        ORDER BY k.kupon_id, z.zaklad_id");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $kupony = $this->stworzListeKuponow($result);
        return $this->dodajZakladyDoKuponow($result, $kupony);
    }

    public function getMetaData()
    {
        $metaData = [];
        $con = $this->database->setConnection();

        $stmt = $con->prepare("SELECT 
               m.*,
               d1.druzyna_nazwa AS gospodarz,
               d2.druzyna_nazwa AS gosc 
        FROM mecze m 
            JOIN druzyny d1 ON m.druzyna_1_id = d1.druzyna_id 
            JOIN druzyny d2 ON m.druzyna_2_id = d2.druzyna_id");
        $stmt->execute();
        $metaData['mecze'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $con->prepare("SELECT * FROM _zaklady_rodzaje");
        $stmt->execute();
        $metaData['rodzaj_zakladu'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $con->prepare("SELECT * FROM _zaklady_wartosci");
        $stmt->execute();
        $metaData['wartosc_zakladu'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $con->prepare("SELECT * FROM _status");
        $stmt->execute();
        $metaData['status'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $metaData;
    }

    public function dodajZaklad($data, $user)
    {
        $con = $this->database->setConnection();
        $status = 1;
        foreach ($data as $z)
            if ($z['status'] == 0) {
                $status = 0;
                break;
            }
        foreach ($data as $z)
            if ($z['status'] == -1) {
                $status = -1;
                break;
            }

        $stmt = $con->prepare(
            "INSERT into kupony (user_id, status_id, data_obstawienia)
            values 
            ((SELECT id from usersdata where username like :user ), :status ,NOW())
            RETURNING kupon_id"
        );
        $stmt->bindValue(':user', $user, PDO::PARAM_STR);
        $stmt->bindValue(':status', $status, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

/*        $stmt = $con->prepare("insert into test values (:kuponID, 222,333)");
        $stmt->bindValue(':kuponID', $result['kupon_id'], PDO::PARAM_INT);
        $stmt->execute();
        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);*/

        $nowyKupon = [];
        foreach ($data as $z) {

            $stmt = $con->prepare("INSERT INTO
            zaklady (zaklad_id, kupon_id, mecz_id, zaklad_rodzaj_id, zaklad_wartosc_id, status_id, kurs)
            VALUES (
                    nextval('zaklad_zaklad_id_seq'), 
                    :kuponId, 
                    :mecz_id, 
                    :zaklad_rodzaj_id, 
                    :zaklad_wartosc_id, 
                    :status_id, 
                    :kurs)
            RETURNING *;
                    ");
            $stmt->bindValue(':kuponId', $result['kupon_id'], PDO::PARAM_INT);
            $stmt->bindValue(':mecz_id', $z['mecz'], PDO::PARAM_INT);
            $stmt->bindValue(':zaklad_rodzaj_id', $z['zaklad_r'], PDO::PARAM_INT);
            $stmt->bindValue(':zaklad_wartosc_id', explode('_',$z['zaklad_w'])[0], PDO::PARAM_INT);
            $stmt->bindValue(':status_id', $z['status'], PDO::PARAM_INT);
            $stmt->bindValue(':kurs', $z['kurs'], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            array_push($nowyKupon, $result);

        }

        return $nowyKupon;
    }


    private function dodajZakladyDoKuponow($result, $kupony): ?array
    {

        foreach ($result as $r) {
            $zaklad = new Zaklad(
                $r['kupon_id'],
                $r['zaklad_id'],
                $r['mecz_id'],
                $r['gospodarz'],
                $r['gość'],
                $r['rodzaj_zakladu'],
                $r['wartosc_zakladu'],
                $r['data_meczu'],
                $r['status_zakladu'],
                $r['kurs']
            );
            $kupony[$r['kupon_id']]->dodajZaklad($zaklad);
        }

        return $kupony;
    }

    private function stworzListeKuponow($result): ?array
    {
        $kupony = [];
        foreach ($result as $r)
            if (!array_key_exists($r['kupon_id'], $kupony))
                $kupony[$r['kupon_id']] = new Kupon(
                    $r['kupon_id'],
                    $r['status_zakladu'],
                    $r['stawka'],
                    $r['data_obstawienia']);

        return $kupony;
    }


}

