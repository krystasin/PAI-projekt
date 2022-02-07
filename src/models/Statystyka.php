<?php

class Statystyka
{
    public int $userId;
    public int $id;
    public string $nazwa;
    public int $wszystkie;
    public int $wygrane;
    public int $przegrane;
    public int $nierozstrzygniete;
    public float $procent;


    public function __construct(int $userId, int $id, string $nazwa, int $wszystkie, int $wygrane, int $przegrane, int $nierozstrzygniete, string $procent)
    {
        $this->userId = $userId;
        $this->id = $id;
        $this->nazwa = $nazwa;
        $this->wszystkie = $wszystkie;
        $this->wygrane = $wygrane;
        $this->przegrane = $przegrane;
        $this->nierozstrzygniete = $nierozstrzygniete;
        $this->procent = floatval($procent);
    }


}