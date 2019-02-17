<?php
     header('Content-Type: application/json');

     if(isset($_POST['id'])) {
        $id = $_POST['id'];
        
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $query=mysqli_query($connect,"SELECT * FROM `programs` WHERE id='{$id}'");

        if(mysqli_num_rows($query) > 0) {
            $m = $query->fetch_assoc();
            $res = $m['id']."||".$m['name']."||".$m['data'];

            echo json_encode($res);
        }

    }
?>