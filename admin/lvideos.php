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
$VG_Orden = '';
if(isset($_GET['orden'])){
	$VG_Orden = $_GET['orden'];
}
// -------------------------------------------------------
$sql = '';

// -------------------------------------------------------
$db = db();

// -------------------------------------------------------

switch($VG_Orden){
	case '0' :
	    $sql = 'SELECT idvideosyt FROM videosyt;';
        $db->query($sql,FALSE);
        $total_num_rows = $db->num_rows();
		$sql = 'SELECT * FROM videosyt ORDER BY fecha_entrada DESC';
		break;
	case '1' :
	    $sql = 'SELECT idvideosyt FROM videosyt WHERE idsecciones = 1;';
        $db->query($sql,FALSE);
        $total_num_rows = $db->num_rows();
		$sql = 'SELECT * FROM videosyt WHERE idsecciones = 1 ORDER BY fecha_entrada DESC';
		break;
	case '3' :
	    $sql = 'SELECT idvideosyt FROM videosyt WHERE idsecciones = 3;';
        $db->query($sql,FALSE);
        $total_num_rows = $db->num_rows();
		$sql = 'SELECT * FROM videosyt WHERE idsecciones = 3 ORDER BY fecha_entrada DESC';
		break;
	case '4' :
        $hoy = "'".date("Y-m-d")."'";
	    $sql = 'SELECT idvideosyt FROM videosyt WHERE idsecciones = 4 AND fecha_publi='.$hoy.';';
        $db->query($sql,FALSE);
        $total_num_rows = $db->num_rows();
        $sql = 'SELECT * FROM videosyt WHERE idsecciones = 4 AND fecha_publi='.$hoy.' ORDER BY fecha_entrada DESC';
		break;
	case '5' :
	    $sql = 'SELECT idvideosyt FROM videosyt WHERE idsecciones = 5;';
        $db->query($sql,FALSE);
        $total_num_rows = $db->num_rows();
		$sql = 'SELECT * FROM videosyt WHERE idsecciones = 5 ORDER BY fecha_entrada DESC';
		break;
	case '6' :
	    $sql = 'SELECT idvideosyt FROM videosyt WHERE idsecciones = 6;';
        $db->query($sql,FALSE);
        $total_num_rows = $db->num_rows();
		$sql = 'SELECT * FROM videosyt WHERE idsecciones = 6 ORDER BY fecha_entrada DESC';
		break;
	case '7' :
	    $sql = 'SELECT idvideosyt FROM videosyt WHERE idsecciones = 7;';
        $db->query($sql,FALSE);
        $total_num_rows = $db->num_rows();
		$sql = 'SELECT * FROM videosyt WHERE idsecciones = 7 ORDER BY fecha_entrada DESC';
		break;														
	default:
		$sql = 'SELECT idvideosyt FROM videosyt;';
        $db->query($sql,FALSE);
        $total_num_rows = $db->num_rows();
		$sql = 'SELECT * FROM videosyt ORDER BY fecha_entrada DESC';	
	break;	
	}

$index = ($pag * $per_page) - $per_page;
$sql.= ' LIMIT '. $index .','. $per_page .';';

$videos_list = $db->query($sql);
$num_rows = $db->num_rows();

$maxPag = $total_num_rows/$per_page;

$sql2 = 'SELECT * FROM secciones;';
$sec_list = $db->query($sql2);

// -------------------------------------------------------
require '../templates/headerAdmin.php';
?>
<script>
    $(document).ready(function(){
        $('#orden').change(function(){
            ordenar.submit();
        });
    });
</script>
<!--
<style media="all">
@import url("../css/datagrid.css");
@import url("../css/pagination.css");  
</style>
-->
<h2 class="main-heading">Lista de Videos</h2>
<a href="edit_videos.php" class="add-admin-item-btn">+ Agregar video</a>
<form  name="ordenar" action="" method="get">
	<label class="fieldLbl">Grupo: </label>
	<select name="orden" id="orden" >
    <option value="0" <?php if ($VG_Orden == "0" ){echo 'selected="selected"';};?>>Todos los videos</option>
    <?php foreach ($sec_list as $sec) {
?>
	  <option value="<?php echo $sec['idsecciones'] ?>" <?php if ($VG_Orden == $sec['idsecciones'] ){echo 'selected="selected"';};?>><?php echo $sec['nseccion'] ?></option>
<?php }?>
	</select>
</form>
<?php
if ($num_rows<1){
	echo '<div align="center">No hay videos.</div>';
} 
				
else  {
?>

<script type="text/javascript">
$('nav_equipos').className = 'current';

function delete_videos(id) {
	var q = confirm('¿Está seguro de que quiere eliminar este video?.');
	
	if (q) {
		location.href = "delete_videos.php?video="+id;
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
        <img name="imagen" src="http://img.youtube.com/vi/<?php echo $videos['linkv'] ?>/1.jpg"  width="190" />

		<span class="userListItem usrListName"><?php echo $videos['nvideo'] ?></span>
				<a class="usrListBtn usrListEdit transition-1" title="Editar" href="edit_videos.php?action=show&news=<?php echo $videos['idvideosyt'] ?>">Editar</a>
		<a class="usrListBtn usrListDelete transition-1" title="Borrar" href="javascript:delete_videos(<?php echo $videos['idvideosyt'] ?>)">Borrar</a>
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