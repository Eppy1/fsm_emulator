<html>
	<head>
		<link href="style.css" rel="stylesheet">
		<meta charset='utf-8'/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>

	<body>
		<div class="turing_frame">
			<form id="reg" action="reg.php" method="post" name="reg">
				<table style="border:none">
					<tr><td style="border:none; text-align:right;">Логин<span style="color:#a03">*</span>:</td>
					<td style="border:none" ><input name="login" type="text" value=""></td></tr>
					<tr><td style="border:none; text-align:right;">e-mail<span style="color:#a03">*</span>:</td>
					<td style="border:none" ><input name="email" type="text" value=""></td></tr>
					<tr><td style="border:none; text-align:right;">Пароль<span style="color:#a03">*</span>:</td>
					<td style="border:none" ><input name="pword" type="password" value=""></td></tr>
					<tr><td style="border:none; text-align:right;">Ещё раз<span style="color:#a03">*</span>:</td>
					<td style="border:none" ><input name="pword2" type="password" value=""></td></tr>
				</table>
				<p id='alert_txt'>...</p>
				<p><label><input name="confirm" type="checkbox" value=""> Я соглашаюсь с <a href="#">правилами</a></label></p>

				<input name="register" type="submit" value="Регистрация">

			</form>
			
			<script src="reg.js"></script>
		</div>

		<div class="turing_frame">
			<form id="auth" action="auth.php" method="post" name="auth">
				<p><label>Логин или email:<br>
				<input name="login" type="text"></label></p>
				<p><label>Пароль:<br>
				<input name="pword" type="password"></label></p> 
				<p><input name="confirm" type= "submit" value = "Вход"></p>
				<p id='auth_alert_txt'>...</p>
				<p>Еще не зарегистрированы, то <a href="#">зарегистрируйтесь</a>!</p>
			</form>

			<script src="auth.js"></script>
		</div>
	</body>
</html>