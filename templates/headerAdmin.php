<?php
if (!defined('APP_URI')) { exit; }

if (isset($_SESSION['IDUSERS'])) {
	$logged = TRUE;
} else {
	$logged = FALSE;
}

$db = db();
?>

<!DOCTYPE html>
<html class="admin">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Administrador ::</title>
<link rel="shortcut icon" href="../favicon.png" />

<link rel="stylesheet" href="../styles/styles.css" type="text/css"/>
<link rel="stylesheet" href="../styles/admin-style.css" type="text/css"/>
<link rel="stylesheet" href="../styles/font/FontAwesome/font-awesome.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300,600' rel='stylesheet' type='text/css'>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>

</head>
<body>
<div class="container">
	<div class="head">
		<div class="head-center">
			<img class="logo" src="../images/logo.png" alt="logo"/>
			
			<?php
	
			$URL = "$_SERVER[REQUEST_URI]";
	
			?>
			
			<div class="main-menu">
				<a class="menu-item transition-1 <?php echo (strpos($URL, '/mx/admin/index') === 0 or strpos($URL, '/mx/admin/portadaedit') === 0) ? 'active' : ''; ?>" href="index.php">Banners</a> 
				<a class="menu-item transition-1 <?php echo strpos($URL, '/mx/admin/lvideos.') === 0 ? 'active' : ''; ?>" href="lvideos.php">Videos</a> 
				<a class="menu-item transition-1 <?php echo (strpos($URL, '/mx/admin/lvideosv') === 0 or strpos($URL, '/mx/admin/edit_actividades') === 0) ? 'active' : ''; ?>" href="lvideosv.php">Videos en vivo</a>
                <a class="menu-item transition-1 <?php echo (strpos($URL, '/mx/admin/lnoticias') === 0 or strpos($URL, '/mx/admin/edit_noticias') === 0) ? 'active' : ''; ?>" href="lnoticias.php">Noticias</a>
				<a class="menu-item transition-1 <?php echo (strpos($URL, '/mx/admin/directorio') === 0 or strpos($URL, '/mx/admin/edit_directorio') === 0) ? 'active' : ''; ?>" href="directorio.php">Directorio</a>
                <a class="menu-item transition-1 <?php echo (strpos($URL, '/mx/admin/personajes') === 0 or strpos($URL, '/mx/admin/edit_personajes') === 0) ? 'active' : ''; ?>" href="personajes.php">Personajes</a>
                <a class="menu-item transition-1 <?php echo (strpos($URL, '/mx/admin/descprovincia') === 0 or strpos($URL, '/mx/admin/edit_provincias') === 0) ? 'active' : ''; ?>" href="descprovincia.php">Provincia</a>
                       
				<a class="transition-2 logoutBtn" href="logout.php">Salir</a>	
			</div>
			
			
		</div>
	</div>
	<div class="body">