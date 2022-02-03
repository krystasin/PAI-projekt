<?php

class Tag
{
    public int $id;
    public string $nazwa;
    public string $kolor;
    public string $opis;
    public int $iloscUzyc;
    public bool $aktywny;

    public function __construct(int $id, string $nazwa, string $kolor, bool $aktywny, ?string $opis = "", ?int $iloscUzyc = 0)
    {
        $this->id = $id;
        $this->nazwa = $nazwa;
        $this->kolor = $kolor;
        $this->aktywny = $aktywny;

        if ($iloscUzyc === null)
            $this->iloscUzyc = 0;
        else
            $this->iloscUzyc = $iloscUzyc;

        if ($opis === null)
            $this->opis = "";
        else
            $this->opis = $opis;


    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getNazwa(): string
    {
        return $this->nazwa;
    }


    public function getKolor(): string
    {
        return $this->kolor;
    }


}