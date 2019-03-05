<html>
	<head>
		<link href="/style1.css" rel="stylesheet">
		<meta charset='utf-8'/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>

	<body>

    <div class="header">
        <img id="logo"align="left" src="/logo.png" onclick="window.location.href = '/'"/>
        <table height=100%>
            </tr>
                <td class="header_cell" onclick="window.location.href = 'page_fsm.php?fsm=turing'" >Turing<br>machine</td>
                <td class="header_cell" onclick="window.location.href = '#'" >Post<br>machine</td>
                <td class="header_cell" onclick="window.location.href = '#'" >Conway's<br>Game of Life</td>
                <td class="header_cell" onclick="window.location.href = '#'" >Langton's<br>ant</td>
                <td class="header_cell" onclick="window.location.href = '#'" >Brain<br>Fuck</td>
                <td class="header_cell" onclick="window.location.href = '#'" >More<br>machines</td>
                <td class="header_cell_user" id="header_cell_user"> <?php include 'user_info.php' ?> </td>
            </tr>
        </table>

    </div>
    
    <script>
        function hihide() {
            document.getElementById('auth_popup').style.display = "none";
            document.getElementById('wrap').style.display = "none";
            var h = document.getElementById('help_popup');
            if(h) h.style.display = "none"
        }
    </script>

    <div id="wrap" onClick="hihide()"></div>

    <div id="auth_popup">
        <center><h2>Sign in</h2></center>
        <form id="auth" action="auth.php" method="post" name="auth">
            <center>
            <p><input name="login" type="text" placeholder="Login or email...">
            <p><input name="pword" type="password" placeholder="Password...">
			<p><input style="font-size: large" id="btn" class="button" name="confirm" type= "submit" value = "Log in"></p>
			<p style='color:#a03' id='auth_alert_txt'></p>
            <p> <a href="page_forgot_password.php">Forgot password?</a><br>
                <a href="page_reg.php">Not a member?</a></p>
            </center>
        </form>

        <script>
            function hideAuth() {
                document.getElementById('auth_popup').style.display = "none";
                document.getElementById('wrap').style.display = "none";
            }

            $('#auth').submit(function(e){
                e.preventDefault();
                $.ajax({
                url: "auth.php",
                type: "POST",
                data: $('#auth').serialize(),
                success: function(response) {
                    hideAuth();
                    location.reload();
                },
                error: function(response) {
                    alert('lul');
                }
                });
            });
        </script>
    </div>