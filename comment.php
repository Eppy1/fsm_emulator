<?php
    if(!isset($_POST['func'])) return;

    if($_POST['func'] == 'read') {
        $res = "";

        echo $res;
    }

    if($_POST['func'] == 'write') {
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');

        mysqli_query($connect, "INSERT INTO `comments`");
    }
?>