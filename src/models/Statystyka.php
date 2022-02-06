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

    /**
     * @param int $userId
     * @param int $id
     * @param string $nazwa
     * @param int $wszystkie
     * @param int $wygrane
     * @param int $przegrane
     * @param int $nierozstrzygniete
     */
    public function __construct(int $userId, int $id, string $nazwa, int $wszystkie, int $wygrane, int $przegrane, int $nierozstrzygniete)
    {
        $this->userId = $userId;
        $this->id = $id;
        $this->nazwa = $nazwa;
        $this->wszystkie = $wszystkie;
        $this->wygrane = $wygrane;
        $this->przegrane = $przegrane;
        $this->nierozstrzygniete = $nierozstrzygniete;
    }


}