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

<button class="button" onclick="saveCode()">Save this</button>

<?php
    include 'utils.php';

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $user_id = getCurrentUserId();

        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $query=mysqli_query($connect,"SELECT rating FROM `programs` WHERE id='{$id}'");
        $q2   =mysqli_query($connect,"SELECT * FROM `likes` WHERE user_id='{$user_id}' AND program_id='{$id}'");

        $img = mysqli_num_rows($query) == 0 ? 'like_stroke.png' : 'like_fill.png';

        echo "<div onclick='like();' style='cursor:pointer;'><br><img id='heart' style='align:bottom; height:5mm' src='{$img}' /><span id='like_counter' style='color:#935171; font-size:x-large;'>&nbsp;".$query->fetch_assoc()['rating']."</span>";
        echo "</div>";
    }
?>

<br>
<?php 
    if(isset($_GET['id']) && $_GET['id'] != '0') {
        include 'comment_form.php';
    } 
 ?>

<script>
    window.onload = function() {
        setup();
        setTimeout(cmt_update, 3500);
    }
</script>

</div>
<?php include 'footer.php' ?>