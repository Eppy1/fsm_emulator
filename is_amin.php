<?php
    function gcn() {
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

    $name = gcn();

    if($name == 'eppy' || $name == 'admin') echo 'yes';
    else echo 'no';
?>