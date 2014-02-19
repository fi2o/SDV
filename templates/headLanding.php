<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<meta name="HandheldFriendly" content="true" />

<title>Peképolis</title>

<link rel="shortcut icon" href="/pekepolis/images/favicon.png" />

<link rel="stylesheet" href="/pekepolis/styles/main.css" type="text/css"/>

<script type="text/javascript" src="/pekepolis/scripts/jquery-1.10.2.min.js"></script>

<!--[if lt IE 8]><html class="ie ie8 ltie8 noAnim"><![endif]-->
<!--[if IE 8]><html class="ie ie8 ltie9 noAnim"><![endif]-->
<!--[if lt IE 9]><html class="ie ltie9 noAnim"><![endif]-->
<!--[if IE 9]><html class="ie ie9 lteie9 noAnim"><![endif]-->


</head>
<body>

<div class="container">
	<div class="head">
		<div class="buildings left buildLeftTwo">
			<img src="images/build-left-2.png"/>
		</div>
		<div class="buildings left buildLeftOne">
			<img src="images/build-left-1.png"/>
		</div>
		<div class="buildings left buildRightTwo">
			<img src="images/build-right-2.png"/>
			
		</div>
		<div class="buildings left buildRightOne">
			<img src="images/build-right-1.png"/>
		</div>
		
		<div class="clouds bigLeft"></div>
		<div class="clouds bigRight"></div>
		<div class="clouds bigLeft2"></div>
		<div class="clouds smallLeft"></div>
	
		<div class="logoWrap">
			<a class="logoURL" href="index.php">
				<img src="images/mainLogo.png" alt="Peképolis" />
			</a>
		</div>
		
	</div>
	<div class="bodyWrap">
	
		<?php

		$URL = "$_SERVER[REQUEST_URI]";

		?>
	
		<div class="mainMenu">
			<span class="menuItmWrap"><a href="index.php" class="menuItm transTw start <?php if(strpos($URL, '/pekepolis/index') === 0){ echo 'active'; } ?>">Inicio</a></span>
			<span class="menuItmWrap"><a href="actividades.php" class="menuItm odd transTw activities <?php if(strpos($URL, '/pekepolis/actividades') === 0){ echo 'active'; } ?>">Actividades</a></span>
			<span class="menuItmWrap"><a href="atracciones.php" class="menuItm transTw attractions <?php if(strpos($URL, '/pekepolis/atracciones') === 0){ echo 'active'; } ?>">Atracciones</a></span>
			<span class="menuItmWrap"><a href="aliados.php" class="menuItm odd transTw allies <?php if(strpos($URL, '/pekepolis/aliados') === 0){ echo 'active'; } ?>">Aliados</a></span>
			<span class="menuItmWrap"><a href="cumples.php" class="menuItm transTw bdays <?php if(strpos($URL, '/pekepolis/cumples') === 0){ echo 'active'; } ?>">Cumpleaños</a></span>
			<span class="menuItmWrap"><a href="contacto.php" class="menuItm odd transTw contact <?php if(strpos($URL, '/pekepolis/contacto') === 0){ echo 'active'; } ?>">Contacto</a></span>
		</div>
		<div class="body">
	
	