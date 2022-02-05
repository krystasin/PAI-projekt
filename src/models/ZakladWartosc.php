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

    public function __toString(): string
    {
        return json_encode($this);
    }


}