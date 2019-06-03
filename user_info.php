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
        echo "<a class='white_link' onclick=\"window.location.href = 'page_reg.php'\">SIGN UP</a><br>";
        echo "<a class='white_link' onclick='showAuth();'>SIGN IN&nbsp;</a><br>";
    } else {
        //echo "<center>";
        $a = getCurrentUserAvatar();
        echo "<span class='white_link id=\"info_usrname\" onclick=\"window.location.href = 'person.php'\">" . $username . "&nbsp;";
        echo "<img class=\"avatar\" align=\"middle\" src=\"\\avas\\".$a.".png\"/ onclick=\"window.location.href = 'person.php'\"></span>";
        //echo "</center>";
    }
?>