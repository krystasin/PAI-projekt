<?php

class User
{
    private string $login;
    private string $password;
    private string $username;
    private string $email;
    private string $accountType;

    /**
     * @param string $login
     * @param string $password
     * @param string $username
     * @param string $email
     * @param string $accountType
     */
    public function __construct(string $login, string $password, string $username, string $email, string $accountType)
    {
        $this->login = $login;
        $this->password = $password;
        $this->username = $username;
        $this->email = $email;
        $this->accountType = $accountType;
    }


    public function getLogin(): string
    {
        return $this->login;
    }


    public function getPassword(): string
    {
        return $this->password;
    }


    public function getUsername(): string
    {
        return $this->username;
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAccountType(): string
    {
        return $this->accountType;
    }





}