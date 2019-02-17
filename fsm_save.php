<?php
     header('Content-Type: application/json');

     if(isset($_COOKIE['fsmemutoken'])) {
        $username = "GUEST";
        $user_id = 0;

        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $query=mysqli_query($connect,"SELECT * FROM `users` WHERE token='{$_COOKIE['fsmemutoken']}'");
        if(mysqli_num_rows($query) > 0) {
            $username=$query->fetch_assoc()['login'];
            $user_id=$query->fetch_assoc()['id'];
        }

        if($username == "GUEST") return;

        $name = $_POST['name'];
        $fsm_type = $_POST['fsm'];
        $data = $_POST['code'];
        $last_change = date("Y-m-d H:i:s");
        $rating = 5;
        $shared = 1;

        $sql_q = "INSERT INTO `programs` (name, fsm_type, data, last_change, rating, shared) VALUES ('{$name}', '{$fsm_type}', '{$data}', '{$last_change}', '{$rating}', '{$shared}')";
        $res=mysqli_query($connect,$sql_q);

        echo json_encode($sql_q);
    }
     
?>