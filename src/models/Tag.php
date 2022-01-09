<?php

class Tag
{
    private int $id;
    private string $nazwa;
    private string $kolor;
    private string $opis;
    private array $zastosowanie;
    private bool $aktywny;

    public function __construct(int $id, string $nazwa, string $kolor, bool $aktywny, ? string $opis = "", ? array $zastosowanie = [])
    {
        $this->id = $id;
        $this->nazwa = $nazwa;
        $this->kolor = $kolor;
        $this->aktywny = $aktywny;
        if($opis == null)
            $this->opis = $opis;
        else
            $this->opis = "";
        if($zastosowanie == null)
            $this->zastosowanie = $zastosowanie;
        else
            $this->zastosowanie = "";
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