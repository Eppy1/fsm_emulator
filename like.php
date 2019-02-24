<?php
    $id = 0;
    $connect=mysqli_connect('localhost', 'root', '', 'fsm');
    $query=mysqli_query($connect,"SELECT * FROM `users` WHERE token='{$_COOKIE['fsmemutoken']}'");
    if(mysqli_num_rows($query) > 0) $id = $query->fetch_assoc()['id'];
    else {
        echo "wtf";
        return;
    }

    $query=mysqli_query($connect,"SELECT * FROM `likes` WHERE user_id='{$id}'");

    if(mysqli_num_rows($query) == 0) {
        mysqli_query($connect,"INSERT INTO `likes` (user_id, program_id) VALUES ('{$id}', '{$_POST['program']}')");
        mysqli_query($connect,"UPDATE `programs` SET rating = rating + 1 WHERE id = '{$_POST['program']}'");
    } else {
        mysqli_query($connect,"DELETE FROM `likes` WHERE program_id = '{$_POST['program']}'");
        mysqli_query($connect,"UPDATE `programs` SET rating = rating - 1 WHERE id = '{$_POST['program']}'");
    }

    $query = mysqli_query($connect,"SELECT * FROM `programs` WHERE id = '{$_POST['program']}'");
    echo "".$query->fetch_assoc()['rating'];
?>