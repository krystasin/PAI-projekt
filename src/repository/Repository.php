<?php


require_once __DIR__ . '/../../Database.php';

class Repository
{
    //todo zrobic singleton ? ? ?

    protected $database;
    public function __construct(){
        $this->database = new Database();
    }



}