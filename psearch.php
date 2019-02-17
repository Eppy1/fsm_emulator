<?php
    header('Content-Type: application/json');

    $connect=mysqli_connect('localhost', 'root', '', 'fsm');
    $sql_q = "SELECT * FROM `programs` WHERE 1";
    $query=mysqli_query($connect, $sql_q);

    $q = "";


    $row = $query->fetch_row();

    do {
        $id=$row[0];
        $name=$row[1];
        $type=$row[2];
        $last_change=$row[4];
        $rating=$row[5];
        $shared=$row[6];

        $q .= $id."||".$name."||".$type."||".$last_change."||".$rating."||".$shared."==";

        $row = $query->fetch_row();
    } while($row != NULL);

    echo json_encode($q);
     
?>