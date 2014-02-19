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
$sql = 'SELECT iddirectorio FROM directorio;';
$db->query($sql,FALSE);
$total_num_rows = $db->num_rows();

$sql = 'SELECT * FROM directorio';

$index = ($pag * $per_page) - $per_page;
$sql.= ' LIMIT '. $index .','. $per_page .';';

$dir_list = $db->query($sql);
$num_rows = $db->num_rows();

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

<?php
if ($num_rows<1){
	echo '<div align="center">No hay Entradas.</div>';
} 
				
else  {
?>

<script type="text/javascript">
$('nav_equipos').className = 'current';

function delete_aliados(id) {
	var q = confirm('¿Está seguro de que quiere eliminar esta entrada?.');
	
	if (q) {
		location.href = "delete_aliados.php?aliados="+id;
	}
}
</script>

<h2 class="section-title">Directorio</h2>
<a href="edit_aliados.php"  class="add-admin-item-btn">+ Agregar entrada</a>
<span class="item-count">Dir <?php echo ($index+1)." al ".($pag >= $maxPag ? $total_num_rows : $num_rows*$pag); ?>, de <?php echo $total_num_rows; ?></span>

<div class="admin-ally-wrap">

<?php

$n = 0;
foreach ($dir_list as $dir) {
?>
	<div class="editable-row <?php echo $n%2==0 ? "" : "odd"; $n++; ?> ">
        <span class="ally-logo-wrap" ><img name="imagen" src="../images/noticias/thumb400/<?php echo $dir['imagen'] ?>" width="80" /></span>

		<a class="userListItem usrListName" href="<?php echo $dir['linkdir'] ?>"><?php echo $dir['nombre'] ?></a>
        <?php echo $dir['direccion'] ?>
        <?php echo $dir['telefono'] ?>
        <?php echo $dir['correo'] ?>
        <?php echo $dir['web'] ?>        
		<a class="usrListBtn usrListEdit transition-1" title="Editar" href="edit_directorio.php?action=show&news=<?php echo $dir['iddirectorio'] ?>">Editar</a>
		<a class="usrListBtn usrListDelete transition-1" title="Borrar" href="javascript:delete_directorio(<?php echo $dir['iddirectorio'] ?>)">Borrar</a>
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