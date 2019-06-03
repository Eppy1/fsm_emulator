<?php
    include 'utils.php';

    if(!isset($_POST['func'])) return;

    if($_POST['func'] == 'read') {
        $res = "";

        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $q = mysqli_query($connect, 
        "SELECT * FROM `comments` 
        WHERE program_id='{$_POST['program']}'
        ORDER BY date ASC");

        $row = $q->fetch_assoc();

        while($row != NULL) {
            $q1 = mysqli_query($connect, 
            "SELECT * FROM `users` 
            WHERE id='{$row['user_id']}'");

            $user=$q1->fetch_assoc()['login'];
            $date=$row['date'];
            $content=$row['content'];
            $id = $row['id'];

            $res .= $user;
            $res .= "||".$date;
            $res .= "||".$content;
            $res .= "||".$id."==";

            $row = $q->fetch_assoc();
        }
        
        echo $res;
    }

    if($_POST['func'] == 'write') {
        $user_id = getCurrentUserId();
        $program_id = $_POST['program'];
        $last_change = date("Y-m-d H:i:s");
        $content = $_POST['text'];

        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $q = mysqli_query($connect, 
        "INSERT INTO `comments`(user_id, program_id, date, content)
        VALUES ('{$user_id}', '{$program_id}', '{$last_change}', '{$content}')");
    
        echo $user_id." ".$program_id." ".$content;
    }

    if($_POST['func'] == 'delete') {
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $q = mysqli_query($connect, "DELETE FROM `comments` WHERE id=".$_POST['id']);
    }
?>