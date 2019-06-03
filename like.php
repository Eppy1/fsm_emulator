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
    $rating = $query->fetch_assoc()['rating'];
    ////
    $id = $_POST['program'];
    $user_id = getCurrentUserId();

    $connect=mysqli_connect('localhost', 'root', '', 'fsm');
    $query=mysqli_query($connect,"SELECT rating FROM `programs` WHERE id='{$id}'");
    $q2   =mysqli_query($connect,"SELECT * FROM `likes` WHERE user_id='{$user_id}' AND program_id='{$id}'");

    
    $img = mysqli_num_rows($q2) == 0 ? 'like_stroke.png' : 'like_fill.png';
    ////
    echo "".$rating." ".$img;
?>