<?php
require '../config.php';
require 'security.php';

// -------------------------------------------------------
$per_page = 5;

// -------------------------------------------------------
$pag = @$_GET['pag'];
if (!ctype_digit($pag) || $pag<0) {
	$pag = 1;
}

// -------------------------------------------------------
$sql = '';

// -------------------------------------------------------
$db = db();

// -------------------------------------------------------


$sql = 'SELECT idvideosvivo FROM videosvivo;';
$db->query($sql,FALSE);
$total_num_rows = $db->num_rows();
$sql = 'SELECT * FROM videosvivo';	

$index = ($pag * $per_page) - $per_page;
$sql.= ' LIMIT '. $index .','. $per_page .';';

$videos_list = $db->query($sql);
$num_rows = $db->num_rows();

$maxPag = $total_num_rows/$per_page;

// -------------------------------------------------------
require '../templates/headerAdmin.php';
?>
<?php 
$provincias = $db->select('provincias');
?>

<!--
<style media="all">
@import url("../css/datagrid.css");
@import url("../css/pagination.css");  
</style>
-->
<h2 class="main-heading">Lista de Videos</h2>
<a href="edit_videosv.php" class="add-admin-item-btn">+ Agregar video</a>
<?php
if ($num_rows<1){
	echo '<div align="center">No hay videos en vivo.</div>';
} 
				
else  {
?>

<script type="text/javascript">
$('nav_equipos').className = 'current';

function delete_videos(id) {
	var q = confirm('¿Está seguro de que quiere eliminar este video?.');
	
	if (q) {
		location.href = "delete_videosv.php?videosv="+id;
	}
}
</script>


	<span class="item-count">Videos <?php echo ($index+1)." al ".($pag >= $maxPag ? $total_num_rows : $num_rows*$pag); ?>, de <?php echo $total_num_rows; ?></span>

	<div class="admin-activities-wrap">
	
	<?php
	
	$n = 0;
	foreach ($videos_list as $videos) {
	?>
	
	<div class="editable-row <?php echo $n%2==0 ? "" : "odd"; $n++; ?> ">
	<?php 
	foreach($provincias as $pro)
	{
		if ($pro['idprovincias'] == $videos['idprovincias']){ 
			?>
			<h3 class="sub-heading"><? echo $pro['provincias']; ?></h3>
			<?
		}
	
	}
	?>
		
		<p><? echo $videos['covid'] ?></p>
			
		<a class="usrListBtn usrListEdit transition-1" title="Editar" href="edit_videosv.php?action=show&news=<?php echo $videos['idvideosvivo'] ?>">Editar</a>
		<a class="usrListBtn usrListDelete transition-1" title="Borrar" href="javascript:delete_videos(<?php echo $videos['idvideosvivo'] ?>)">Borrar</a>
	</div>
<?php
}
?>
</div>
<?php
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

require '../templates/footerAdmin.php';
?>