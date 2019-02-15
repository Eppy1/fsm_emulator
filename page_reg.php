<?php include 'header.php' ?>

<div class="content">
    <center>
    <h2>Регистрация</h2>

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
    </center>        
    
	<script src="reg.js"></script>
</div>


<?php include 'footer.php' ?>