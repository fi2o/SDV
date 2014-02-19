<?php
require '../config.php';
require 'security.php';

// -------------------------------------------------------
$per_page = 10;

// -------------------------------------------------------
$pag = @$_GET['pag'];
if (!ctype_digit($pag) || $pag<0) {
	$pag = 1;
}

// -------------------------------------------------------
$sql = '';

// -------------------------------------------------------
$db = db();


$sql = 'SELECT idbanners FROM banners;';
$db->query($sql,FALSE);
$total_num_rows = $db->num_rows();

// -------------------------------------------------------
$sql = 'SELECT * FROM banners';
	
$index = ($pag * $per_page) - $per_page;
$sql.= ' LIMIT '. $index .','. $per_page .';';

$pagina_list = $db->query($sql);
$num_rows = $db->num_rows();
// -------------------------------------------------------
$maxPag = $total_num_rows/$per_page;

// -------------------------------------------------------
require '../templates/headerAdmin.php';

?>
<!--
<style media="all">
@import url("../css/datagrid.css");
@import url("../css/pagination.css");  
</style>
-->
<h2 class="main-heading">Lista de Banners</h2>
<a href="edit_banners.php" class="add-admin-item-btn">+ Agregar banner</a>
<?php
if ($num_rows<1){
	echo '<div align="center">No hay Banners.</div>';
} 
				
else  {
?>

<script type="text/javascript">
$('nav_equipos').className = 'current';

function delete_banner(id) {
	var q = confirm('¿Está seguro de que quiere eliminar este Banner?.');
	
	if (q) {
		location.href = "delete_banner.php?banner="+id;
	}
}
</script>


<span class="item-count">Banners <?php echo ($index+1)." al ".($pag >= $maxPag ? $total_num_rows : $num_rows*$pag); ?>, de <?php echo $total_num_rows; ?></span>

<div class="admin-activities-wrap">

<?php

$n = 0;
foreach ($pagina_list as $banners) {
?>
	<div class="editable-row <?php echo $n%2==0 ? "" : "odd"; $n++; ?> ">
		<span class="userListItem usrListName"><?php echo $banners['cliente'] ?> - <?php echo $banners['fstart'] ?> - <?php echo $banners['ffinish'] ?></span>
				<a class="usrListBtn usrListEdit transition-1" title="Editar" href="edit_banners.php?action=show&news=<?php echo $banners['idbanners'] ?>">Editar</a>
		<a class="usrListBtn usrListDelete transition-1" title="Borrar" href="javascript:delete_banner(<?php echo $banners['idbanners'] ?>)">Borrar</a>
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