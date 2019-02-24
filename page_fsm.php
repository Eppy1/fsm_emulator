<?php include 'header.php' ?>

<div class="content">

<?php

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $query=mysqli_query($connect,"SELECT * FROM `programs` WHERE id='{$id}'");

        include $query->fetch_assoc()['fsm_type'] . '.php';

        echo "<script> loadProg(parseInt(".$id.")); </script>";
    }
    else if(isset($_GET['fsm'])) {
        $fsm = $_GET['fsm'];
        if($fsm == 'turing') {
            include 'turing.php';
        } else echo '404';
    }
?>

<button class="button" onclick="saveCode()">SAVE</button>

<?php

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $query=mysqli_query($connect,"SELECT rating FROM `programs` WHERE id='{$id}'");

        echo "<br><span id='like_counter'>".$query->fetch_assoc()['rating']."</span> likes";
    }
?>

<br>
<button class="button" id="btn_like" onclick="like();">like!</button>

<?php include 'comment_form.php' ?>

</div>
<?php include 'footer.php' ?>