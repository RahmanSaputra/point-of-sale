<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">	
<title>Login Panel SpoS</title>
<link href="media/css/style.css" rel="stylesheet" type="text/css" />
<script src="media/js/jscript.js"></script>	
<link rel="shortcut icon" href="media/images/login.ico" />
</head>
<body>
<div class="main">
<div class="box">
<h2 align="center">Login Akun</h2>
<h3 align="center">Silahkan masukan nama dan sandi untuk login</h3>
	<form class="form" id="form1" name="form1" method="post" action="proses.php"><fieldset>
		<div class="row">
	<input type="text" class="login" name="username" placeholder="Username" />
		</div>
		<div class="row">
	<input type="password" class="password" name="password" placeholder="Password"/>
	<a class="forgot" href="#">Lupa kata sandi</a>
		</div>	
		<div class="row">
	<input type="checkbox" class="remember" name="remember" id="remember"  />
	<label for="remember">Biarkan saya tetap masuk</label>
	<input type="submit" value="Masuk" />
		</div>
	</fieldset>
	</form>		     
		</div>
		<span class="copy">Dev By : <font color="#0099FF">Dwi Rahman H</font></span>
		</div>
</body>
</html>