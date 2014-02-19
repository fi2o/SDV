<?php
require '../config.php';

if (isset($_SESSION['IDUSERS'])) {
	goto2('admin/index.php');
}


$msg = FALSE;

if ($_POST) {

	if ($_POST['username']=='' || $_POST['password']=='') {
		$msg = 'Rellene correctamente el nombre de usuario y contraseña.';
	} else {
	
		$username = $db->escape(@$_POST['username']);
		$password = md5(@$_POST['password']);
		$sql = "SELECT `IDUSERS` FROM `users` WHERE `username`='$username' AND `password`='$password' LIMIT 1;";
		
		$record = $db->query($sql);
		
		if ($db->num_rows()==1) {
			$_SESSION['IDUSERS'] = $record[0]['IDUSERS'];
			goto2('admin/index.php');
		} else {
			$msg = 'El nombre de usuario o contraseña es incorrecto.';
		}
	}
}

require '../templates/headerLogin.php';
?>

<form class="loginForm bodyCont" name="frmlogin" action="login.php" method="post">
	
	<span class="loginText">Login</span>

	<?php
	if ($msg!=FALSE) {
		echo '<br /><div align="center" class="error_text">'. htmlentities($msg) .'</div><br />';
	}
	?>
	
	<input class="textField formField" type="text" name="username" placeholder="Usuario"/>
	<br />
	<input class="textField formField" type="password" name="password" placeholder="Password" />
	<br />
	
	<input type="submit" class="submitBtn" value="Login" />

</form>

<?php
require '../templates/footerAdmin.php';
?>