<?php
require_once __DIR__ . '/headers/header.php';
?>

<div class="container">

    <div class="loggedOut-content">

        <div class='register-panel'>

            <a href='/'>Wróć do strony logowania</a>
            <form class='register-form' action='register' method='post'>
                <?php
                if (isset($messages))
                    foreach ($messages as $message)
                        echo $message;
                ?>
                <div class="register-inputs">

                    <div class="register-col">
                        <label for="login" class="reg-label">login*</label>
                        <label for="email" class="reg-label">email*</label>
                        <label for="username" class="reg-label">username*</label>
                        <label for="passwor" class="reg-label">hasło*</label>
                        <label for="password2" class="reg-label">powtórz hasło*</label>
                    </div>
                    <div class="register-col">
                        <input name="login" type="text" class="regInput">
                        <input name="email" type="text" class="regInput">
                        <input name="username" type="text" class="regInput">
                        <input name="password" type="password" class="regInput">
                        <input name="password2" type="password" class="regInput">
                    </div>

                </div>
                <button class='login-btn btn-color' type='submit'>Zarejestruj</button>


            </form>
        </div>

    </div>

    <?php require_once 'static/footer.php'; ?>
</div>


