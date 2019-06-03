<?php

if(!isset($_GET['user'])) {
    return '0';
}

$ava = '0';
$connect=mysqli_connect('localhost', 'root', '', 'fsm');

$query=mysqli_query($connect,
"SELECT * FROM `users` 
WHERE login='{$_GET['user']}'");

if(mysqli_num_rows($query) > 0) $ava = $query->fetch_assoc()['icon'];

mysqli_close($connect);
echo $ava;

?>