<?php include 'header.php' ?>

<div class="content">
    <center>
    <h2>Registration</h2>

	<form id="reg" action="reg.php" method="post" name="reg">
		<table style="border:none; font-size: large;">
			<tr><td style="border:none; text-align:right;">Login<span style="color:#a03">*</span>:</td>
			<td style="border:none" ><input name="login" type="text" value=""></td></tr>
			<tr><td style="border:none; text-align:right;">e-mail<span style="color:#a03">*</span>:</td>
			<td style="border:none" ><input name="email" type="text" value=""></td></tr>
			<tr><td style="border:none; text-align:right;">Password<span style="color:#a03">*</span>:</td>
			<td style="border:none" ><input name="pword" type="password" value=""></td></tr>
			<tr><td style="border:none; text-align:right;">Once more<span style="color:#a03">*</span>:</td>
			<td style="border:none" ><input name="pword2" type="password" value=""></td></tr>
		</table>
		<p id='alert_txt'>...</p>
		<p><label><input name="confirm" type="checkbox" value=""> I accept <a href="#">The Rules</a></label></p>

		<input style="font-size: large; padding:8px" class="button" name="register" type="submit" value="Sign Up">
	</form>
    </center>        
    
	<script src="reg.js"></script>
</div>


<?php include 'footer.php' ?>