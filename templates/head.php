<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<meta name="HandheldFriendly" content="true" />

<title>Santo Domingo Vive</title>

<link rel="shortcut icon" href="favicon.png" />


<link rel="stylesheet" href="styles/font/FontAwesome/font-awesome.css">
<link rel="stylesheet" href="styles/styles.css" type="text/css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300,600' rel='stylesheet' type='text/css'>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>
<script src="http://jwpsrv.com/library/FozwWH1NEeO3eyIACmOLpg.js"></script>


<!--[if lt IE 8]><html class="ie ltie8 ltie10 "><![endif]-->
<!--[if IE 8]><html class="ie ie8 ltie9 ltie10 "><![endif]-->
<!--[if lt IE 9]><html class="ie ltie10 "><![endif]-->
<!--[if IE 9]><html class="ie ie9 lteie9 "><![endif]-->

</head>
<body>

<div class="container">
	<div class="head">
		
		<div class="head-center">
			<a href="/mx/index.php"><img class="logo" src="images/logo.png" alt="logo"/></a>

			<?php
			require_once('templates/banners.php');	
				
			$URL = "$_SERVER[REQUEST_URI]";
	
			?>
		
			<div class="main-menu">
				<a href="index.php" class="menu-item transition-1  <?php if(strpos($URL, '/mx/index') === 0){ echo 'active'; } ?>">Inicio</a>
				<a href="secciones.php?secciones=5" class="menu-item transition-1 <?php if(strpos($URL, '/mx/secciones.php?secciones=5') === 0){ echo 'active'; } ?>">Cine</a>
				<a href="secciones.php?secciones=1" class="menu-item transition-1 <?php if(strpos($URL, '/mx/secciones.php?secciones=1') === 0){ echo 'active'; } ?>">Documentales</a>
				<a href="secciones.php?secciones=3" class="menu-item transition-1 <?php if(strpos($URL, '/mx/secciones.php?secciones=3') === 0){ echo 'active'; } ?>">Joyas del ayer</a>
				<a href="secciones.php?secciones=6" class="menu-item transition-1 <?php if(strpos($URL, '/mx/secciones.php?secciones=6') === 0){ echo 'active'; } ?>">Música, radio, y teatro</a>
				<a href="secciones.php?secciones=7" class="menu-item transition-1 <?php if(strpos($URL, '/mx/secciones.php?secciones=7') === 0){ echo 'active'; } ?>">Series y Telenovelas</a>
				<a href="gozatiempo.php" class="menu-item transition-1 <?php if(strpos($URL, '/mx/gozatiempo') === 0){ echo 'active'; } ?>">Goza tiempo</a>
				<a href="medios.php?views=3" class="menu-item transition-1 <?php if(strpos($URL, '/mx/medios') === 0){ echo 'active'; } ?>">Medios</a>
				
				<form action="buscar.php" method="get" class="main-search-form" >
					<label class="form-lbl hidden-lbl">Buscar:</label>
					<input type="text" id="buscar" name="buscar" class="main-search-box transition-1" placeholder="Buscar..." />
					<button class="search-btn"></button>
				</form>
				
			</div>
			
			
		</div>
	</div>
	<div class="body group">
	
	