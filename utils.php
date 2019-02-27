<?php
    function getCurrentUserId() {
        $id = '0';
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');

        $query=mysqli_query($connect,
        "SELECT * FROM `users` 
        WHERE token='{$_COOKIE['fsmemutoken']}'");

        if(mysqli_num_rows($query) > 0) $id = $query->fetch_assoc()['id'];
        
        mysqli_close($connect);
        return $id;
    }

    function getCurrentUserName() {
        $name = '-';
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');

        $query=mysqli_query($connect,
        "SELECT * FROM `users` 
        WHERE token='{$_COOKIE['fsmemutoken']}'");

        if(mysqli_num_rows($query) > 0) $name = $query->fetch_assoc()['login'];
        
        mysqli_close($connect);
        return $name;
    }
?>