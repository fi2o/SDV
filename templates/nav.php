<?php
if (!defined('APP_URI')) { exit; }

$URL = "$_SERVER[REQUEST_URI]";

?>

<div class="menuWrap transTw">
	<a class="transTw logo" href="#"><img class="transTw" src="images/logo-BC-W-1.png" alt="Blue Country" /></a>
	<div class="menuCenter">
		<a class="transTw menuItm <?php if(strpos($URL, '/bluevines/concurso.php') === 0){ echo 'active'; } ?>" href="concurso.php">Videos</a>
		<a class="transTw menuItm <?php if(strpos($URL, '/bluevines/reglas.php') === 0){ echo 'active'; } ?>" href="reglas.php">Bases del Concurso</a>
		<!-- <a class="transTw menuItm <?php if(strpos($URL, '/bluevines/contacto.php') === 0){ echo 'active'; } ?>" href="contacto.php">Contacto</a> -->
		<a class="transTw joinBtn siteBtn" href="participar.php">Participar</a>
	</div>
	<div class="socWrap transTw">
		<a class="facebook socIcon" target="_blank" href="https://www.facebook.com/BLUECOUNTRYJEANS?fref=ts"></a>
		<a class="twitter socIcon" target="_blank" href="https://twitter.com/bluecountrydr"></a>
		<a class="instagram socIcon" target="_blank" href="http://instagram.com/bluecountryjeans"></a>
		<a class="youtube socIcon" target="_blank" href="http://www.youtube.com/user/BlueCountryJeans"></a>
	</div>
	
</div>

<!-- <div id="modernbricksmenuline">&nbsp;</div> -->
