<?php
    function getCurrentUserId() {
        if(!isset($_COOKIE['fsmemutoken'])) {
            return '0';
        }

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
        if(!isset($_COOKIE['fsmemutoken'])) {
            return '-';
        }

        $name = '-';
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        
        $query=mysqli_query($connect,
        "SELECT * FROM `users` 
        WHERE token='{$_COOKIE['fsmemutoken']}'");

        if(mysqli_num_rows($query) > 0) $name = $query->fetch_assoc()['login'];
        
        mysqli_close($connect);
        return $name;
    }

    function getCurrentAuthorName() {
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        
        $name = "-";
        $query=mysqli_query($connect,
        "SELECT * FROM `programs` 
        WHERE id='{$_GET['id']}'");

        if(mysqli_num_rows($query) > 0) $name = $query->fetch_assoc()['author'];
        
        mysqli_close($connect);
        return $name;
    }

?>