<?php include 'header.php' ?>

<div class="content">

<?php
    $username = 'GUEST';

    if(isset($_COOKIE['fsmemutoken'])) {
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $query=mysqli_query($connect,"SELECT * FROM `users` WHERE token='{$_COOKIE['fsmemutoken']}'");
        if(mysqli_num_rows($query) > 0) {
            $username=$query->fetch_assoc()['login'];
            $mail =  $query->fetch_assoc()['login'];
 
            echo "<h3><img class=\"avatar\" style=\"border: 2px solid #4e73a0\" src=\"ava_default.png\"/>";
            echo "&nbsp;".$username."</h3><br>";
            echo "email: " . $mail;
        }
    }

    if($username == 'GUEST') {
        header("Location: /");
        die();
    } else {
    }
?>

<form action="exit.php"  method="post">
    <input class="button" type="submit" value="Выход">
</form>

</div>

<?php include 'footer.php' ?>