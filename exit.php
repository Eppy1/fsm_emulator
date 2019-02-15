<?php
    setcookie("fsmemutoken", 'xyi', time()+604800*50);
    header("Location: index.php");
    die();
?>