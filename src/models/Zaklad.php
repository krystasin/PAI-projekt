<?php

class Zaklad
{


    public int $kuponId;
    public int $zakladId;
    public int $meczId;
    public string $status;
    public string $gospodarz;
    public string $gosc;
    public string $rodzajZakladu;
    public string $wartoscZakladu;
    public  $kurs;
    public DateTime $dataMeczu;


    public function __construct(int $kuponId, int $zakladId, int $meczId, string $gospodarz, string $gosc, string $rodzajZakladu, string $wartoscZakladu, string $dataMeczu, string $status, $kurs)
    {
        $this->kuponId = $kuponId;
        $this->zakladId = $zakladId;
        $this->meczId = $meczId;
        $this->gospodarz = $gospodarz;
        $this->gosc = $gosc;
        $this->rodzajZakladu = $rodzajZakladu;
        $this->wartoscZakladu = $wartoscZakladu;
        $this->dataMeczu = new DateTime($dataMeczu);
        $this->status = $status;
        $this->kurs = $kurs;
    }
}