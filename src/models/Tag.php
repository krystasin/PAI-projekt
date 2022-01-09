<?php

class Tag
{
    private int $id;
    private string $nazwa;
    private string $kolor;
    private string $opis;
    private array $zastosowanie;
    private bool $aktywny;

    public function __construct(int $id, string $nazwa, string $kolor, bool $aktywny, string $opis = "", array $zastosowanie = [])
    {
        $this->id = $id;
        $this->nazwa = $nazwa;
        $this->kolor = $kolor;
        $this->opis = $opis;
        $this->zastosowanie = $zastosowanie;
        $this->aktywny = $aktywny;
    }


}