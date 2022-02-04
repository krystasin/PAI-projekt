<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="UTF-8"/>

    <?php
    if (isset($title)) {
        print  "<title>" . $title . "</title>";
    } else echo "<title>Kszton statistics</title>";

/*    if (isset($styles))
        foreach ($styles as $s)
            echo "<link rel=\"stylesheet\" href=\"public/css/" . $s . ".css\" type=\"text/css\">";*/


    ?>

    <link rel="stylesheet" href="public/css/style.css" type="text/css">
    <link rel="stylesheet" href="public/css/headerStyle.css" type="text/css">
    <link rel="stylesheet" href="public/css/loggedOutStyle.css" type="text/css">
    <link rel="stylesheet" href="public/css/mojeZaklady.css" type="text/css">
    <link rel="stylesheet" href="public/css/register.css" type="text/css">
    <link rel="stylesheet" href="public/css/mojeTagi.css" type="text/css">
    <link rel="stylesheet" href="public/css/sidebar.css" type="text/css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.15.4/css/all.css'
          integrity='sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm' crossorigin='anonymous'>
    <script src="https://kit.fontawesome.com/7b7c159c58.js" crossorigin="anonymous" ></script>

</head>
<body>
