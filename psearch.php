<?php
    header('Content-Type: application/json');

    $connect=mysqli_connect('localhost', 'root', '', 'fsm');

    //$sql_q = "SELECT * FROM `programs` WHERE 1";
    $sql_q = "SELECT * FROM `programs` WHERE ".$_POST['filter'];
    $query=mysqli_query($connect, $sql_q);
    
    $q = "";

    $row = $query->fetch_row();

    do {
        /////   
        //TODO LIKE_FILL
        //////

        $id=$row[0];
        $name=$row[1];
        $type=$row[2];
        $author=$row[4];
        $last_change=$row[5];
        $rating=$row[6];
        $shared=$row[7];

        $q .= $id;
        $q .= "||".$name;
        $q .= "||".$type;
        $q .= "||".$last_change;
        $q .= "||".$rating;
        $q .= "||".$shared;
        $q .= "||".$author."==";

        $row = $query->fetch_row();
    } while($row != NULL);

    echo json_encode($q);
     
?>