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
<html lang="es" class="login">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>:: Login ::</title>
<link rel="shortcut icon" href="../favicon.png" />

<link rel="stylesheet" href="../styles/styles.css" type="text/css"/>
<link rel="stylesheet" href="../styles/admin-style.css" type="text/css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300,600' rel='stylesheet' type='text/css'>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>

</head>
<body class="login">
<div class="container">
	<div class="header">
	<div class="login-logo-wrap">
		<img class="form-logo" src="../images/sdv-plain-logo.png" alt="Santo Domingo Vive" title="Santo Domingo Vive"/>
		<h2 class="login-title">Consola Administrativa</h2>
	</div>
	</div>
	<div class="body">