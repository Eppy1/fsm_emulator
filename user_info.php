<script>

    function showAuth() {
        document.getElementById('auth_popup').style.display = "block";
        document.getElementById('wrap').style.display = "block";
    }

</script>

<?php
    $username = 'GUEST';

    if(isset($_COOKIE['fsmemutoken'])) {
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $query=mysqli_query($connect,"SELECT * FROM `users` WHERE token='{$_COOKIE['fsmemutoken']}'");
        if(mysqli_num_rows($query) > 0) $username=$query->fetch_assoc()['login'];
    }

    if($username == 'GUEST') {
        echo '<a class=\'white_link\' href=\'page_reg.php\'>Регистрация&nbsp;</a><br>';
        echo '<a class=\'white_link\' href=\'#\'onclick=\'showAuth();\'>Вход&nbsp;</a>';
    } else {
        echo "<span id=\"info_usrname\" onclick=\"window.location.href = 'person.php'\">" . $username . "&nbsp;";
        echo "<img class=\"avatar\" align=\"middle\" src=\"ava_default.png\"/></span>";
    }
?>