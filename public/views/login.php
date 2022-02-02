<?php require_once __DIR__ . '/headers/header.php'; ?>

<div class='container'>
    <div class=loggedOut-content>


        <div class="login-panel">

            <form action="login" method="post" id="login-form">
                <div class="login-row user-bg bg-input">
                    <input class="login-input" name="login" type="text" placeholder="">
                </div>

                <div class='login-row lock-bg bg-input'>
                    <input class="login-input" name="password" type="password" placeholder="">
                </div>
                <div class='register-href'>
                    <p>Nie masz jeszcze konta ?</p> <a href='register'>zarejestruj sie</a>
                </div>
                <button class="login-btn btn-color" type="submit">Login</button>
            </form>


        </div>

    </div>


    <?php require_once 'static/footer.php'; ?>

</div>

