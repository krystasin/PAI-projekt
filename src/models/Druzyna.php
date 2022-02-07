<?php

class Druzyna
{
    public int $id;
    public string $nazwa;


    public function __construct(int $id, string $nazwa)
    {
        $this->id = $id;
        $this->nazwa = $nazwa;
    }

}