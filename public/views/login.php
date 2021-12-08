<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="public/css/style.css" type="text/css">

    <title>LOGIN PAGE</title>

</head>
<body>


<div class="container">

<div class="message">
        <?php
            if(isset($messages)){
                foreach( $messages as $m){
                    print $m;
                }
            }
        ?>
    </div>

    <div class="logo">
        <img src="../img/logo.png">
    </div>

    <div class="login-container">

        <form action="login" method="post" id="login-form">
            <input name="login" type="text" placeholder="Login">
            <input name="password" type="password" placeholder="Password">
            <button type="submit">LOGIN</button>

        </form>
    </div>

<!--
    <form action="projects/" id="login-form">
        <div class="heading">Login to Everdwell</div>
        <div class="left">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" />
            <label for="pass">Password</label>
            <input type="password" name="password" id="pass" />
            <input type="submit" value="Login" />
        </div>
        <div class="right">
            <div class="connect">Connect with</div>
            <a href="" class="facebook">

                      <span class="fontawesome-facebook"></span> -->
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </a> <br />
            <a href="" class="twitter">
                <!--       <span class="fontawesome-twitter"></span> -->
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a> <br />
            <a href="" class="google-plus">
                <!--       <span class="fontawesome-google-plus"></span> -->
                <i class="fa fa-google-plus" aria-hidden="true"></i>
            </a>
        </div>
    </form>


-->

</div>


</body>