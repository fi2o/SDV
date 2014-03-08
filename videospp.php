<?php
define('PAGE_ID','video');

require('config.php');

// -------------------------------------------------------
if (!ctype_digit($_GET['video'])) {
	goto2('index.php');
}

$IDNEWS = sprintf('%u',$_GET['video']);

// -------------------------------------------------------
$db = db();

$noti = $db->get_row('videosyt',$IDNEWS);

if ($db->num_rows()!=1)
{
	goto2('index.php');
}

// -------------------------------------------------------
require_once('templates/head.php');
?>

<div class="main">
	<div class="section-main-wrap column main-section">
		<h2 id="video-perfil-title" class="main-heading"><?php echo $noti['nvideo'] ?></h2>
		<div id="video-perfil-iframe"><iframe width="720" height="405" src="//www.youtube.com/embed/<?php echo $noti['linkv'] ?>" frameborder="0" allowfullscreen></iframe></div>
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
				<div class="fb-like" data-send="false" data-layout="button_count" data-height="60" data-width="200" data-show-faces="false" data-font="arial"></div>
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
		<div id="video-perfil-desc"><?php echo $noti['descv'] ?></div>
	</div>
</div>
<div class="aside">
	
<a href="medios.php?views=1" class="extra-link mediums"></a>
	<a href="hhoy.php" class="extra-link daily-video last"></a>
	<?
		require 'templates/aside.php';
	?>
</div>

<?php

require 'templates/footer.php';
?>