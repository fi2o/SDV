<?php
define('PAGE_ID','buscar');
require 'config.php';
// -------------------------------------------------------
if (!isset($_GET['buscar'])) {
	goto2('index.php');
}
$buscar = "'%".$_GET['buscar']."%'";

$per_page = 10;

// -------------------------------------------------------
$pag = @$_GET['pag'];
if (!ctype_digit($pag) || $pag<0) {
	$pag = 1;
}

$sql = '';
// -------------------------------------------------------
$db = db();

// -------------------------------------------------------
$sql = 'SELECT idvideosyt FROM videosyt WHERE descv LIKE '.$buscar.' OR nvideo LIKE '.$buscar.';';
$db->query($sql,FALSE);
$total_num_rows = $db->num_rows();

// -------------------------------------------------------
$sql = 'SELECT * FROM videosyt WHERE descv LIKE '.$buscar.' OR nvideo LIKE '.$buscar.'';	

$index = ($pag * $per_page) - $per_page;
$sql.= ' LIMIT '. $index .','. $per_page .';';

$videos_list = $db->query($sql);
$num_rows = $db->num_rows();

// -------------------------------------------------------

require_once('templates/head.php');
?>
<div class="main">
	<div class="section-main-wrap column main-section">
		<h2 class="main-heading results-heading">Videos que contienen "<?php echo $_GET['buscar'];?>"</h2>
		<?php
		if ($_GET['buscar'] == ""){
			echo '<p align="center">Tu busqueda no puede estar vacía.</p>';
			} else{
		if ($num_rows<1){
			echo '<p align="center">No se ha encontrado nada con ese criterio de búsqueda.</p>';
		} 
						
		else{
		
		foreach ($videos_list as $videos) {
		?>
	
		<div class="video-thumb-detail">
		    <a href="videosp.php?video=<?php echo $videos['idvideosyt'] ?>" class="video-thumb-mask" >
				<img name="imagen" src="http://img.youtube.com/vi/<?php echo $videos['linkv'] ?>/mqdefault.jpg" />
			</a>
			<h3 class="video-thumb-title"><a href="videosp.php?video=<?php echo $videos['idvideosyt'] ?>"><?php echo $videos['nvideo'] ?></a></h3>
		</div>
		<?php 	
		}}
		
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
	
	<?
		require 'templates/aside.php';
	?>
</div>

<?php
require 'templates/footer.php';
?>