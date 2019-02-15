<html>
	<head>
		<link href="/style1.css" rel="stylesheet">
		<meta charset='utf-8'/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>

	<body>

    <div class="header">
        <img height=100% align="left" src="/logo.png" onclick="window.location.href = '/'"/>
        <table>
            </tr>
                <td class="header_cell">Машина<br>Тьюринга</td>
                <td class="header_cell">Машина<br>Поста</td>
                <td class="header_cell">Игра<br>Жизнь</td>
                <td class="header_cell">Муравей<br>Лэнгтона</td>
                <td class="header_cell">Brain<br>Fuck</td>
                <td class="header_cell">Ещё<br>автоматы</td>
                <td class="header_cell_user" id="header_cell_user"> <?php include 'user_info.php' ?> </td>
            </tr>
        </table>

    </div>
    
    <script>
        function hihide() {
            document.getElementById('auth_popup').style.display = "none";
            document.getElementById('wrap').style.display = "none";
        }
    </script>

    <div id="wrap" onClick="hihide()"></div>

    <div id="auth_popup">
        <center><h2>Вход</h2></center>
        <form id="auth" action="auth.php" method="post" name="auth">
            <center>
            <p><input name="login" type="text" placeholder="Логин или email...">
            <p><input name="pword" type="password" placeholder="Пароль...">
			<p><input id="btn class="button" name="confirm" type= "submit" value = "Вход"></p>
			<p style='color:#a03' id='auth_alert_txt'></p>
            <p> <a href="page_forgot_password.php">Забыли пароль?</a><br>
                <a href="page_reg.php">Ещё нет аккаунта?</a></p>
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