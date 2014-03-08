<?php
require('config.php');
$db = db();
$sql = '';
$hoy = "'".date("Y-m-d")."'";
// -------------------------------------------------------
$sql = 'SELECT idvideosyt FROM videosyt WHERE idsecciones = 4 AND fecha_publi='.$hoy.';';
$db->query($sql,FALSE);
$total_num_rows = $db->num_rows();

// -------------------------------------------------------
$sql = 'SELECT idsecciones, nvideo, idvideosyt, descv, linkv, fecha_publi FROM videosyt WHERE idsecciones = 4 AND fecha_publi='.$hoy.';';	

$videos_list = $db->query($sql);
$num_rows = $db->num_rows();
// -------------------------------------------------------
require_once('templates/head.php');

?>

<div class="main">
	<div class="section-main-wrap column main-section">
	
	<?
	if ($num_rows<1){
		echo '<div align="center">No hay historia de hoy.</div>';
	} 
					
	else{
	
	foreach ($videos_list as $videos) {
	?>
	
		<h2 id="video-perfil-title" class="main-heading"><?php echo $videos['nvideo'] ?></h2>
		<div id="video-perfil-iframe"><iframe width="728" height="405" src="//www.youtube.com/embed/<?php echo $videos['linkv'] ?>?autoplay=1" frameborder="0" allowfullscreen></iframe></div>
		
		<div class="share-wrap">
			<div class="share-button">
				<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
				<script type="text/javascript">
					!function (d, s, id) { 
						var js = undefined, 
							fjs = d.getElementsByTagName(s)[0];
						
						if (!d.getElementById(id)) { 
							js = d.createElement(s);
							js.id = id;
							js.src = '//platform.twitter.com/widgets.js';
							
							fjs.parentNode.insertBefore(js, fjs);
						}
					} (document, 'script', 'twitter-wjs');
				</script>
			</div>
			<div class="share-button">
				<div class="g-plusone" data-size="medium"></div>
				<script type="text/javascript">
					(function () { 
						var po = document.createElement('script'), 
							s = document.getElementsByTagName('script')[0];
						
						po.type = 'text/javascript';
						po.async = true;
						po.src = 'https://apis.google.com/js/plusone.js';
						
						s.parentNode.insertBefore(po, s);
					} )();
				</script>
			</div>
			<div class="share-button">	
				<div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false" data-font="arial"></div>
				<script type="text/javascript">
					(function (d, s, id) { 
						var js = undefined, 
							fjs = d.getElementsByTagName(s)[0];
						
						if (d.getElementById(id)) { 
							return;
						}
						
						js = d.createElement(s);
						js.id = id;
						js.src = '//connect.facebook.net/en_US/all.js#xfbml=1';
						
						fjs.parentNode.insertBefore(js, fjs);
					} (document, 'script', 'facebook-jssdk'));
				</script>
			</div>
		</div>
		<div id="video-perfil-desc"><?php echo $videos['descv']?></div>
		    <?php 
			}
			} ?>
	
	</div>
</div>

<div class="aside">
	
<a href="medios.php?views=1" class="extra-link mediums"></a>
	<? require 'templates/aside.php'; ?>
</div>

<?php

require 'templates/footer.php';
?>