<?php
if (!defined('APP_URI')) { exit; }

if (isset($_SESSION['IDUSERS'])) {
	$logged = TRUE;
} else {
	$logged = FALSE;
}

$db = db();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Concurso blue!</title>
<link rel="shortcut icon" href="../bluevines/favicon.png" />

<link rel="stylesheet" href="/mx/styles/styles.css" type="text/css"/>
<link rel="stylesheet" href="/mx/styles/admin-style.css" type="text/css"/>
<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>

</head>
<body>
<div class="container">
	<div class="header">
		<?php require 'templates/nav.php'; ?>
	</div>
	<div class="body">

<div id="fb-root"></div>

<!-- facebook stuff -->
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1&appId=326240324159581";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>



