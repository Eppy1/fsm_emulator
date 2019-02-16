<?php include 'header.php' ?>

<div class="content">

<?php

    if(isset($_GET['fsm'])){
        $fsm = $_GET['fsm'];
        if($fsm == 'turing') {
            include 'turing.php';
        } else echo '404';
    }
?>

<button class="button" onclick="saveCode()">SAVE</button>

</div>
<?php include 'footer.php' ?>