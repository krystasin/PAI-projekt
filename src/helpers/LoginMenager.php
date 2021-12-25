<?php

Class LoginMenager
{

    public static function redirectIfNotLoggedIn(){
        if(!isset($_SESSION['user']))
        {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
            exit();
        }
    }

}