<header class='header'>

    <nav class='navbar'>
        <ul class='navUl'>
            <li class='navLi'><a href='zarzadzajZakladami'> zarzadzaj zakladami </a></li>

        </ul>
    </nav>



    <div class='nav-user'>
        <ul>
            <li class='userLi'><a href='logout'><?php if (isset($_SESSION['user'])) {
                        echo $_SESSION['user'];
                    } else {
                        echo '{Użytkownik}';
                    } ?></a></li>
        </ul>
    </div>

</header>

