<?php


require_once 'Zaklad.php';
require_once 'Tag.php';

class Kupon
{
    public int $id;
    public string $status;
    public $stawka;
    public $kurs;
    public DateTime $dataObstawienia;
    public array $zaklady;
    public array $tagi;




    public function __construct(int $id, string $status, $stawka, string $data)
    {
        $this->id = $id;
        $this->kurs = 1.0;
        $this->status = $status;
        $this->stawka = $stawka;
        $this->dataObstawienia = new DateTime($data);
        $this->zaklady = [];
        $this->tagi = [];
    }

    public function dodajZaklad(Zaklad $nowyZaklad){
        array_push($this->zaklady, $nowyZaklad);
        $this->kurs *= $nowyZaklad->kurs;
    }
    public function dodajTag(Tag $nowyTag){
        array_push($this->tagi, $nowyTag);
    }
    public function getTags(){
        return $this->tagi;
    }


}