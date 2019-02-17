<?php include 'header.php' ?>

<div class="content">

<?php

    if(isset($_GET['fsm'])) {
        $fsm = $_GET['fsm'];
        if($fsm == 'turing') {
            include 'turing.php';
        } else echo '404';
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        echo "<script> loadProg(parseInt(".$id.")); </script>";
    }
?>

<button class="button" onclick="saveCode()">SAVE</button>

</div>
<?php include 'footer.php' ?>