<?php

session_destroy();
$url = "http://$_SERVER[HTTP_HOST]";
header("Location: {$url}/login");
exit();