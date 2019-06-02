<?php include 'header.php'; ?>
<?php include 'utils.php'; ?>

<div class="content">

<style >
    #author {
        float:right;
        color: #777;
    }
</style>


<script>
    function showHelp() {
        document.getElementById('help_popup').style.display = "block";
        document.getElementById('wrap').style.display = "block";
    }
</script>

<div id="help_popup">
    <?php
    $fsm = "wtf";

    if(isset($_GET['fsm'])) {
            $fsm = $_GET['fsm'];
    } else if(isset($_GET['id'])) {
        $id = $_GET['id'];
            
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $query=mysqli_query($connect,"SELECT * FROM `programs` WHERE id='{$id}'");

        $fsm = $query->fetch_assoc()['fsm_type'];
    }

    include $fsm.'_help.php';

    ?>
</div>

<button class='button' onclick='showHelp()'>Help & Info</button>


<?php
    if(isset($_GET['id']) && $_GET['id'] != '0') {
        echo '<span id="author">Author: '.'??'.'</span><br>';
    }

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
        } else if($fsm == 'post') {
            include 'post.php';
        } else if($fsm == 'brainfuck') {
            include 'brainfuck.php';
        } else if($fsm == 'life') {
            include 'life.php';
        } else if($fsm == 'markov') {
            include 'markov.php';
        } else echo '404';
    }
?>

<?php
    if(getCurrentUserId() == '0') {
        echo '<a target="_blank" rel="noopener noreferrer"  href="/page_reg.php">Sign Up</a> or <a href="#" onclick="showAuth()">Sign In</a> to save your program!';
    } else {
        $text = "Save Code";

        if(isset($_GET['id']) && $_GET['id'] != '0') $text = "Save & Publish";

        echo '<button class="button" onclick="saveCode()">Save this</button>';
    }
?>


<?php

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $user_id = getCurrentUserId();

        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $query=mysqli_query($connect,"SELECT rating FROM `programs` WHERE id='{$id}'");
        $q2   =mysqli_query($connect,"SELECT * FROM `likes` WHERE user_id='{$user_id}' AND program_id='{$id}'");

        $img = mysqli_num_rows($q2) == 0 ? 'like_stroke.png' : 'like_fill.png';

        echo "<div onclick='like();' style='cursor:pointer;'><br><img id='heart' style='align:bottom; height:5mm' src='{$img}' /><span id='like_counter' style='color:#935171; font-size:x-large;'>&nbsp;".$query->fetch_assoc()['rating']."</span>";
        echo "</div>";
    }
?>

<br>

<?php 

    if(isset($_GET['id']) && $_GET['id'] != '0') {
        $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        
        echo '<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>'.
        '<script src="//yastatic.net/share2/share.js"></script>'.
        '<div class="ya-share2" data-services="vkontakte,facebook,twitter,lj,telegram"'.
        "data-url='http://127.0.0.1:1394/".$_SERVER['REQUEST_URI']."'></div>";
        
        echo "<div class='loader' id='loader'></div>";
        
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