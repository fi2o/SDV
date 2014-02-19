<?php
define('PAGE_ID','secciones');
require 'config.php';
// -------------------------------------------------------
if (!ctype_digit($_GET['secciones'])) {
	goto2('index.php');
}
$IDNEWS = sprintf('%u',$_GET['secciones']);

$per_page = 10;

// -------------------------------------------------------
$pag = @$_GET['pag'];
if (!ctype_digit($pag) || $pag<0) {
	$pag = 1;
}

$sql = '';
// -------------------------------------------------------
$db = db();

$sec = $db->get_row('secciones',$IDNEWS);

if ($db->num_rows()!=1)
{
	goto2('index.php');
}

// -------------------------------------------------------
$sql = 'SELECT idvideosyt FROM videosyt WHERE idsecciones = '.$sec['idsecciones'].' ;';
$db->query($sql,FALSE);
$total_num_rows = $db->num_rows();

// -------------------------------------------------------
$sql = 'SELECT * FROM videosyt WHERE idsecciones = '.$sec['idsecciones'].'';	

$index = ($pag * $per_page) - $per_page;
$sql.= ' LIMIT '. $index .','. $per_page .';';

$videos_list = $db->query($sql);
$num_rows = $db->num_rows();

// -------------------------------------------------------
require_once('templates/head.php');
?>
<div class="main">
	<div class="section-main-wrap column main-section">
	<h2 class="main-heading"><?php echo $sec['nseccion']; ?></h2>
	
	<div id="vid" class="selected-vid-wrap">
		<div id="video-perfil-iframe">
			<iframe width="728" height="405" src="//www.youtube.com/embed/<?php echo $videos_list[0]["linkv"]; ?>" frameborder="0" allowfullscreen></iframe>
		</div>
		<h3 id="video-perfil-title" class="main-heading video-heading"><?php echo $videos_list[0]["nvideo"]; ?></h3>
	</div>
	<div class="video-list">	
		<h3 class="main-heading">Listado de Videos</h3> 
		
			<?php
			if ($num_rows<1){
				echo '<div align="center">No hay videos.</div>';
			} 
							
			else  {
			
			foreach ($videos_list as $videos) {
			?>
				<div class="video-thumb-detail">
					<a class="video-thumb-mask" data-video="<?php echo $videos['idvideosyt'] ?>" href="#vid"  >
						<img name="imagen" src="http://img.youtube.com/vi/<?php echo $videos['linkv'] ?>/mqdefault.jpg" />
					</a>
					<h4 class="video-thumb-title"><a href="videosp.php?video=<?php echo $videos['idvideosyt'] ?>"><?php echo $videos['nvideo'] ?></a></h4>
				</div>
			<?php 	
			
			}
		
			// -------------------------------------------------------
			libLoad('pagination');
			$pagination = new Pagination;
			$config['base_uri'] = $_SERVER['PHP_SELF'].'?';
			$config['total_rows'] = $total_num_rows;
			$config['per_page'] = $per_page;
			$config['num_links'] = 5;
			$config['cur_page'] = $pag;
			echo $pagination->generate($config);
			
			}
			?>
		
		</div>
	</div>	
</div>

<div class="aside">	
	<a href="#" class="extra-link mediums">
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
	<?php
		require 'templates/aside.php';
	?>
</div>

<script>
$('.video-thumb-detail').on('click', function(){
		var dataProvince = $(this).children('.video-thumb-mask').data('video'),
			video_wrap = $('.selected-vid-wrap');
				
		$(this).addClass('active').siblings().removeClass('active');

		video_wrap.animate({
			'opacity': '0',
			'left': '30px'
		}, 200);
		
		setTimeout( function(){
			$.get( "videosp.php",{id_video:dataProvince}, function( data ) {
				video_wrap.html( data ).animate({
					'opacity': '1',
					'left': '0'
				}, 200);
			});
		}, 210);
		
		return false;
		
	});
</script>
<?php
require 'templates/footer.php';
?>