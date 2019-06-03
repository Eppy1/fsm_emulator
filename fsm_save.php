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

        $sql_q = "??";

        $name = $_POST['name'];
        $fsm_type = $_POST['fsm'];
        $data = $_POST['code'];
        $author = $username;
        $last_change = date("Y-m-d H:i:s");
        $rating = 0;
        $shared = 1;

        $id = $_POST['id'];

        if($id== '0') {
            $sql_q = "INSERT INTO `programs` (name, fsm_type, data, author, last_change, rating, shared) VALUES ('{$name}', '{$fsm_type}', '{$data}', '{$author}', '{$last_change}', '{$rating}', '{$shared}')";
            $res=mysqli_query($connect, $sql_q);
            echo mysqli_insert_id($connect);
            return;
        } else {   
            $qqq=mysqli_query($connect,"SELECT * FROM `programs` WHERE id='{$id}'");
            if($author == $qqq->fetch_assoc()['author']) {

                $sql_q = "UPDATE `programs` SET name = '{$name}', data = '{$data}', last_change = '{$last_change}' WHERE id = '{$id}'";
                $res=mysqli_query($connect, $sql_q);
            } else {
                $sql_q = "INSERT INTO `programs` (name, fsm_type, data, author, last_change, rating, shared) VALUES ('{$name}', '{$fsm_type}', '{$data}', '{$author}', '{$last_change}', '{$rating}', '{$shared}')";
                $res=mysqli_query($connect,$sql_q);
            }
        }

        echo json_encode($sql_q);
    }
     
?>