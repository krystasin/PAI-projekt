<?php
require_once __DIR__ . '/headers/header.php';
?>


<content>
    <div class=login-content>


        <div class="loginPage-logo">
            <div class="message">
                <?php
                if (isset($messages))
                    foreach ($messages as $m)
                        print $m;
                ?>
            </div>
            <img src="../img/logo.png">
        </div>

        <div class="login-right" >
            <div style="background-color: #fff;">
                <form action="login" method="post" id="login-form">
                    <input name="login" type="text" placeholder="Login">
                    <input name="password" type="password" placeholder="Password">
                    <button type="submit">LOGIN</button>

                </form>
            </div>
            <div class="register-href">
                <p>Nie masz jeszcze konta ?</p> <a href="register">zarejestruj sie</a>
            </div>
        </div>


    </div>


</content>