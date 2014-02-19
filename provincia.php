<?php
define('PAGE_ID','ver_pro');

require('config.php');

// -------------------------------------------------------
if (!ctype_digit($_GET['ver_pro'])) {
	goto2('index.php');
}
$id_provincia = sprintf('%u',$_GET['ver_pro']);

// -------------------------------------------------------
$db = db();
$provin = $db->get_row('provincias',$id_provincia);

if ($db->num_rows()!=1)
{
	goto2('index.php');
}

$sql = 'SELECT * FROM videosyt WHERE idprovincias = '.$id_provincia.' LIMIT 1;';	
$videos = $db->query($sql);

$sql = 'SELECT * FROM personajes WHERE idprovincias = '.$id_provincia.' LIMIT 2;';	
$personajes = $db->query($sql);

$sql2 = 'SELECT * FROM noticias WHERE idprovincias = '.$id_provincia.';';	
$noticias = $db->query($sql2);

$sql = 'SELECT covid, idprovincias FROM videosvivo WHERE idprovincias = '.$id_provincia.'';	
$covide= $db->query($sql);

// -------------------------------------------------------
require_once('templates/head.php');
?>

<div class="main">
	<div class="section-main-wrap column main-section">
		<h2 class="main-heading"><?php echo ($provin['provincias']) ?></h2>
		<h3>Video en vivo</h3>
		<div id="video-vivo" class="live-vid-wrap big">
	<?php
		foreach($covide as $co){ ?>
			    <script type='text/javascript'>
	    jwplayer('video-vivo').setup({
	        file: '<?php echo $co['covid'] ?>',
	        image: 'https://www.longtailvideo.com/content/images/jw-player/lWMJeVvV-876.jpg',
	        title: 'Santo Domingo Vive',
	        width: '728',
	        height: '400',
	        fallback: 'false',
	        autostart: 'true'
	    });
	</script>
	    <?php 
	    } 
	?>	
		</div>
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
	</div>
	
	
	
	<div class="news-wrap column main-section">
	<h3 class="news-heading">Titulares: </h3>
	<div class="titles-wrap">
		<?php 
		foreach($noticias as $no)
		{
		?>
		<h4 class="news-title transition-2"><?php echo $no['titulo'] ?></h4>
		<?php 
		}
		?>
	</div>
</div>
	
	
	<div class="section-main-wrap column main-section">
		<h3 class="main-heading">Historia de la Provincia</h3>
   <?php echo ($provin['descprovincia']) ?>
	</div>
</div>
<div class="aside">
	
	<a href="medios.php?views=3&idprovincia=<?php echo ($provin['idprovincias']) ?>" class="extra-link mediums">
		<span class="extra-text">Medios</span>
		<i class="fa fa-file-text"></i>
		<i class="fa fa-desktop"></i>
		<i class="fa fa-globe bigger"></i>
		<i class="fa fa-microphone bigger"></i>
		
	</a>
	<a href="hhoy.php" class="extra-link daily-video last">
		<span class="extra-text">Historia de hoy</span>
		<i class="fa fa-desktop"></i>
		<i class="fa fa-play-circle-o"></i>		
	</a>
	<div class="province-contents-wrap column related-wrap">	
		<h3 class="sub-heading">Video relacionado</h3>	
			<?php 
			foreach($videos as $vi)
			{
			?>
				<div class="related-vid-det"><iframe width="300" height="200" src="//www.youtube.com/embed/<?php echo $vi['linkv'] ?>" frameborder="0" allowfullscreen></iframe>
				</div>
			<?php 
			}	
			?>
			
		<h3 class="sub-heading">Personajes de la provincia</h3>
		
			<?php 
			foreach($personajes as $per)
			{
			?>
			<div class="related-char-wrap">	
				<div class="related-char-img">
					<img name="imagen" src="images/personajes/thumb400/<?php echo $per['imagen'] ?>"/>
				</div>
				<span class="related-char-name"><?php echo $per['nombre'] ?><?php echo $per['desc'] ?></span>
			</div>	
			<?php 
			}	
			?>	
			
	</div>

<?php require 'templates/asidep.php'; ?>
</div>


<script src="scripts/news-title-widget.js"></script>

<?php

require 'templates/footer.php';
?>