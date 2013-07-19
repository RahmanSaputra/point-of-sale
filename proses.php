<?php 
session_start();
require("koneksi.php");
$encrypt_pass = $_POST['password'];
$cek = "Select * from admin where username='$_POST[username]' and password='$encrypt_pass'";
$hasil = mysql_query($cek);
$hasil_cek = mysql_num_rows($hasil);
if ($hasil_cek==0){}
else
{
$_SESSION['username'] = $_POST['username'];
header("location: index.php");
}
?>
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
	<form class="form" id="form1" name="form1" method="post" action="proses.php">
	<fieldset>
	<div class="row">
    <input type="text" disabled="disabled" class="error" value="Username Salah" readonly="readonly" />
	<input type="text" class="login" name="username" placeholder="Username" />
    </div>
	<div class="row">
    <input type="text" disabled="disabled" class="error" value="Password Salah" readonly="readonly" />
	<input type="password" class="login" name="password" placeholder="Password"/>
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