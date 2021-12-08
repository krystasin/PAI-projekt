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
        else{
            ?>
            <form action="logout" method="post" id="logout-form">
                <button type="submit">LOGOUT</button>

            </form>
<?php
        }
    }







}