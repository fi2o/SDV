<?php
require 'config.php';
require_once('templates/head.php');
$db = db();
$sql = '';
// -------------------------------------------------------
$sql = 'SELECT idvideosyt, linkv, nvideo FROM videosyt WHERE idsecciones != 4 ORDER BY fecha_entrada DESC LIMIT 4';	
$videos = $db->query($sql);

$sql = 'SELECT idprovincias, clase, provincias FROM provincias;';	
$provincias = $db->query($sql);

$sql2 = 'SELECT titulo FROM noticias ORDER BY fecha DESC LIMIT 5';	
$noticias = $db->query($sql2);

?>

<div class="main">
	<div class="map-wrap column main-section">
	
	<?php 
	$V_cont = 0;
	foreach($provincias as $pro)
	{
	?>
		<a href="provincia.php?ver_pro=<?php echo $pro['idprovincias'] ?>" class="map-point <?php echo $pro['clase'] ?>">
			<span class="point-graph fluid-transition"></span>
			<span class="map-loc-name fluid-transition"><?php echo $pro['provincias'] ?></span>
		</a>
	<?php 		
		}
	?>	
	</div>
	
	<div class="news-wrap column main-section">
		<h2 class="news-heading">Titulares: </h2>
	    	<div class="titles-wrap">
				<?php 
				foreach($noticias as $noti)
				{
				?>
				<h3 class="news-title transition-2"><?php echo $noti['titulo'] ?></h3>
				<?php 
				}	
				?> 
	        </div>
	
	</div>
	
	<div class="carousel-wrap column main-section">
		<h2 class="main-heading">Videos recientes</h2>
		
		<div class="carousel">
			<?php 
			foreach($videos as $vid)
			{
			?> 
				<div class="carousel-display">
	            <a title="ver" href="videospp.php?video=<?php echo $vid['idvideosyt'] ?>">
					<img name="imagen" src="http://img.youtube.com/vi/<?php echo $vid['linkv'] ?>/0.jpg"/>
					<h3 class="carousel-descrip-wrap"><?php echo $vid['nvideo'] ?></h3>
	                </a>
				</div>
			<?php 
			}	
			?> 
				
			<div class="carousel-thumb-wrap">
				<?php 
				foreach($videos as $vid)
				{
				?> 
					<span class="carousel-thumb transition-2"><img name="imagen" src="http://img.youtube.com/vi/<?php echo $vid['linkv'] ?>/mqdefault.jpg"/></span>
				
				<?php 
				}
				?>  
					<span class="carousel-active-mask"></span>
				
			</div>
		</div>
	</div>

</div>

<div class="aside">
	<a href="medios.php?views=1" class="extra-link mediums"></a>
	
	<div class="province-contents-wrap column">
		<h2 class="province-name-title sub-heading">Video en vivo</h2>
		<div class="live-vid-wrap small">		
	</div>
	<br />

	<a href="hhoy.php" class="extra-link daily-video last"></a>
		
	</div>
	
	<?php
		require 'templates/aside.php';
	?>
	
</div>

<script type="text/javascript" src="scripts/news-title-widget.js"></script>

<script type="text/javascript" src="scripts/carousel.js"></script>

<?php
	require_once('templates/footer.php');
?>