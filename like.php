<?php
    include 'utils.php';

    $id = getCurrentUserId();
    if($id == '0') {
        echo 'wtf';
        return;
    }

    $connect=mysqli_connect('localhost', 'root', '', 'fsm');
    $query=mysqli_query($connect,"SELECT * FROM `likes` WHERE user_id='{$id}' AND program_id='{$_POST['program']}'");

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