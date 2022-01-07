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


    public function getAllKupons(string $username) : array
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

    public function getMetaData(){
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

    public function dodajZaklad($arr){
        $con = $this->database->setConnection();
        $stmt = $con->prepare("SELECT ");





    }






    private function dodajZakladyDoKuponow($result, $kupony) : ? array
    {

        foreach ($result as $r){
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
    private function stworzListeKuponow($result) : ? array
    {
        $kupony = [];
        foreach ($result as $r)
            if( !array_key_exists($r['kupon_id'], $kupony) )
                $kupony[$r['kupon_id']] = new Kupon(
                    $r['kupon_id'],
                    $r['status_zakladu'],
                    $r['stawka'],
                    $r['data_obstawienia'] );

        return $kupony;
    }





}

