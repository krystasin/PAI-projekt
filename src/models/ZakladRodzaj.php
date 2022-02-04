<?php

require_once 'ZakladWartosc.php';
class ZakladRodzaj
{
    public int $id;
    public string $rodzaj;
    public array $wartosci;


    public function __construct(int $id, string $rodzaj)
    {
        $this->id = $id;
        $this->rodzaj = $rodzaj;
        $this->wartosci = array();
    }
    public function dodajWartosc(int $id, string $wartosc)
    {
        array_push($this->wartosci, new ZakladWartosc($id, $wartosc));
    }


}