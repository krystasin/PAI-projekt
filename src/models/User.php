<?php

class User
{
    private string $username;
    private string $email;
    private string $accountType;


    public function __construct(
        string $username,
        string $email,
        string $accountType)
    {
        $this->username = $username;
        $this->email = $email;
        $this->accountType = $accountType;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function getAccountType()
    {
        return $this->accountType;
    }


}