<!DOCTYPE html>
<html lang='pl'>
<head>

    <meta charset='UTF-8'/>

    <?php
    if (isset($title))
        echo  '<title>' . $title . '</title>';
    else
        echo '<title>Kszton statistics</title>';
    ?>

    <link rel="stylesheet" href="public/css/style.css" type="text/css">
    <link rel="stylesheet" href="public/css/headerStyle.css" type="text/css">
    <link rel="stylesheet" href="public/css/admin.css" type="text/css">
    <link rel="stylesheet" href="public/css/zaklady_a.css" type="text/css">


</head>
<body>
