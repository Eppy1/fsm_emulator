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

</div>
<?php include 'footer.php' ?>