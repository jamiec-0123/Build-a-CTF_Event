<?php

$page = $_GET['page'];

if (!$page)

    include("home.php");

else

    include($page);

?>
