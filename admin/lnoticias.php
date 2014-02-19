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


$sql = 'SELECT idnoticias FROM noticias;';
$db->query($sql,FALSE);
$total_num_rows = $db->num_rows();
$sql = 'SELECT * FROM noticias';	

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
<h2 class="main-heading">Lista de noticias</h2>
<a href="edit_noticias.php" class="add-admin-item-btn">+ Agregar noticia</a>
<?php
if ($num_rows<1){
	echo '<div align="center">No hay noticias.</div>';
} 
				
else  {
?>

<script type="text/javascript">
$('nav_equipos').className = 'current';

function delete_noticias(id) {
	var q = confirm('¿Está seguro de que quiere eliminar esta noticia?.');
	
	if (q) {
		location.href = "delete_noticias.php?noticia="+id;
	}
}
</script>


<div class="admin-activities-wrap">
    <?php 
foreach($provincias as $pro)
{
	?> 
    <span class="item-count">noticias <?php echo ($index+1)." al ".($pag >= $maxPag ? $total_num_rows : $num_rows*$pag); ?>, de <?php echo $total_num_rows; ?></span>
    <h3 class="sub-heading"><?php echo $pro['provincias']; ?></h3>  
<?php
$n = 0;
foreach ($videos_list as $videos) {
?>
<?php if ($videos['idprovincias'] == $pro['idprovincias']){?>
	<div class="editable-row <?php echo $n%2==0 ? "" : "odd"; $n++; ?> ">
	<a href="<?php echo $videos['linkn'] ?>"><?php echo $videos['titulo'] ?></a>		
	<a class="usrListBtn usrListEdit transition-1" title="Editar" href="edit_noticias.php?action=show&news=<?php echo $videos['idnoticias'] ?>">Editar</a>
	<a class="usrListBtn usrListDelete transition-1" title="Borrar" href="javascript:delete_noticias(<?php echo $videos['idnoticias'] ?>)">Borrar</a>
</div>
<?php
}}}
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