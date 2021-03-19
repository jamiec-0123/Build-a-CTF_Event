<?php

$page = $_GET['page'];

if (!$page)

    header("Location: /index.php?page=home.php");
else

    include($page);

?>
