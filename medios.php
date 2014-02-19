<?php
require 'config.php';

$sqlline = '';
if (!empty($_GET['views'])) {
	$sqlline = " idtipos = ".$_GET['views']."";
	}
if (!empty($_GET['idprovincia'])) {
	if($sqlline != "") {
     $sqlline = $sqlline . " AND idprovincias = ".$_GET['idprovincia']."";   
   } else {
      $sqlline = "idprovincias = ".$_GET['idprovincia']."";
   }
}

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
$sql = 'SELECT iddirectorio FROM directorio WHERE '.$sqlline.';';
$db->query($sql,FALSE);
$total_num_rows = $db->num_rows();

// -------------------------------------------------------
$sql = 'SELECT *  FROM directorio WHERE '.$sqlline.'';	

$index = ($pag * $per_page) - $per_page;
$sql.= ' LIMIT '. $index .','. $per_page .';';

$dir_list = $db->query($sql);
$num_rows = $db->num_rows();

// -------------------------------------------------------
require_once('templates/head.php');

$URL = "$_SERVER[REQUEST_URI]";

?>

<div class="main">
	<div class="section-main-wrap column main-section">
		<h2 class="main-heading">Medios</h2>
		
		<div class="tabs-wrap">
	        <a class="tab-link <?php if(strpos($URL, '/mx/medios.php?views=3') === 0){ echo 'active'; } ?>" href="medios.php?views=3<?php if (!empty($_GET['idprovincia'])) {echo "&idprovincia=".$_GET['idprovincia']."";} ?>">Radio</a>
	        <a class="tab-link <?php if(strpos($URL, '/mx/medios.php?views=1') === 0){ echo 'active'; } ?>" href="medios.php?views=1<?php if (!empty($_GET['idprovincia'])) {echo "&idprovincia=".$_GET['idprovincia']."";} ?>">Prensa</a>
	        <a class="tab-link <?php if(strpos($URL, '/mx/medios.php?views=2') === 0){ echo 'active'; } ?>" href="medios.php?views=2<?php if (!empty($_GET['idprovincia'])) {echo "&idprovincia=".$_GET['idprovincia']."";} ?>">Televisión</a>
		</div>
<?php
		if ($num_rows<1){
			echo '<p align="center">No hay entradas.</p>';
		} 
				
		else {
		foreach ($dir_list as $dir) {
		?>
			<div class="directory-entry">
		        <a href="#"  class="dir-entry-thumb">
		      		<img name="imagen" src="images/noticias/thumb400/<?php echo $dir['imagen'] ?>" width="140px" />
		        </a>
				<div class="dir-entry-details">
					<h3 class="dir-entry-name"><a href="#"><?php echo $dir['nombre'] ?></a></h3>
					<br />
			        <a href="<?php echo $dir['web'] ?>"><?php echo $dir['web'] ?></a>
				</div>
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

<div class="aside">
	
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