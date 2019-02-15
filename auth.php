<?php

    $connect=mysqli_connect('localhost', 'root', '', 'fsm');
    $login=$_POST['login'];
    $pword=$_POST['pword'];
    $md5=md5($login . $pword);

    $query=mysqli_query($connect,"SELECT * FROM `users` WHERE MD5_login='{$md5}' OR MD5_email='{$md5}'");
    $num=mysqli_num_rows($query);

    if($num == 0) echo 'Такого пользователя не знаем';
    else {
        echo 'Hello, '. $query->fetch_assoc()['login'].'!';
    }
?>
