<?php
require_once __DIR__ . '/headers/header.php';
?>

<script type='text/javascript' src='/public/assets/js/register.js' defer></script>
<div class="container">

    <div class="loggedOut-content">


        <div class="message"></div>

        <div class='register-panel'>

            <span>masz już konto? <a href='/'>zaloguj się!</a></span>
            <form class='register-form'  method='post' action="registerBG">
                <?php
                if (isset($messages))
                    foreach ($messages as $message)
                        echo $message;
                ?>
                <div class="register-inputs">

                    <div class="register-col">
                        <label for="login" class="reg-label">login*</label>
                        <label for="email" class="reg-label" >email*</label>
                        <label for="username" class="reg-label">username</label>
                        <label for="passwor" class="reg-label">hasło*</label>
                        <label for="password2" class="reg-label">powtórz hasło*</label>
                    </div>
                    <div class="register-col">
                        <input name="login" type="text" class="login-inp regInput" required>
                        <input name="email" type="email" class="email-inp regInput" required>
                        <input name="username" type="text" class="username-inp regInput">
                        <input name="password" type="password" class="pass1-inp regInput" required>
                        <input name="password2" type="password" class="pass2-inp regInput" required>
                    </div>

                </div>
                <button class='login-btn btn-color register-action-btn' type='button'>Zarejestruj</button>


            </form>
        </div>

    </div>

    <?php require_once 'static/footer.php'; ?>
</div>


