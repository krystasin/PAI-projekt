<?php

class ZakladWartosc
{
    public int $id;
    public string $wartosc;


    public function __construct(int $id, string $wartosc)
    {
        $this->id = $id;
        $this->wartosc = $wartosc;
    }


}