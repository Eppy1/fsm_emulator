<?php include 'header.php' ?>

<div class="content">

<?php
    $username = 'GUEST';

    if(isset($_COOKIE['fsmemutoken'])) {
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $query=mysqli_query($connect,"SELECT * FROM `users` WHERE token='{$_COOKIE['fsmemutoken']}'");
        if(mysqli_num_rows($query) > 0) {
            
            $row = $query->fetch_assoc();
            $username=$row['login'];
            $email =  $row['email'];
 
            echo "<h2><img class=\"avatar\" style=\"border: 1px solid #333\" src=\"\\avas\\".getCurrentUserAvatar().".png\"/>";
            echo "&nbsp;<span id=\"usrname\">".$username."</span></h2><br>";
            echo "<span style='color:red;' id='admin_span'><br><br></span>";
            echo "email: " . $email;
        }
    }

    if($username == 'GUEST') {
        header("Location: /");
        die();
    } else {
    }
?>

<h3> Your programs: </h3> <br>

<script>

function checkIsAdmin() {
    var result = false;
    $.ajax({
      url : "is_amin.php",
      type : "get",
      async: true,
      success : function(msg) {
        result = msg == 'yes';
      },
      error: function() {
  
      }
   });

   return result;
}

if(checkIsAdmin()) {
    document.getElementById("admin_span").innerText = "You are Admin!";
} else document.getElementById("admin_span").style.display="none";

</script>

<div width=640px>
		<?php include 'psearch_form.php' ?>
        <script> 
            function getCookie(name) {
                var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
                ));
                //alert(matches ? decodeURIComponent(matches[1]) : undefined);
                return matches ? decodeURIComponent(matches[1]) : undefined;
            }
            psearch_update("author = '" + document.getElementById("usrname").innerHTML+ "'" + " ORDER BY last_change DESC, rating DESC");
        </script>
	</div>

<form action="exit.php"  method="post">
    <input class="button" type="submit" value="LOG OUT">
</form>

</div>

<?php include 'footer.php' ?>