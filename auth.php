<?php
    $connect=mysqli_connect('localhost', 'root', '', 'fsm');
    $login=$_POST['login'];
    $pword=$_POST['pword'];
    $md5=md5($login . $pword);

    $query=mysqli_query($connect,"SELECT * FROM `users` WHERE MD5_login='{$md5}' OR MD5_email='{$md5}'");
    $num=mysqli_num_rows($query);

    if($num == 0) echo 'Такого пользователя не знаем';
    else {
        $token = md5($login . round(microtime(true) * 1000));
        setcookie("fsmemutoken", $token, time()+604800*50);
        mysqli_query($connect,"UPDATE `users` SET token='{$token}' WHERE MD5_login='{$md5}' OR MD5_email='{$md5}'");
    }
?>
