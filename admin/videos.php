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
$sql = 'SELECT iddocumentales FROM documentales;';
$db->query($sql,FALSE);
$total_num_rows = $db->num_rows();

$index = ($pag * $per_page) - $per_page;
$sql.= ' LIMIT '. $index .','. $per_page .';';

$sql = 'SELECT * FROM documentales;';

$documentales_list = $db->query($sql);
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
<h2 class="section-title">Lista de Documentales</h2>
<a href="edit_documental.php" class="add-admin-item-btn">+ Agregar documental</a>
<?php
if ($num_rows<1){
	echo '<div align="center">No hay documentales.</div>';
} 
				
else  {
?>

<script type="text/javascript">
$('nav_equipos').className = 'current';

function delete_documental(id) {
	var q = confirm('¿Está seguro de que quiere eliminar esta actividad?.');
	
	if (q) {
		location.href = "delete_documental.php?documental="+id;
	}
}
</script>


<span class="item-count">Documental <?php echo ($index+1)." al ".($pag >= $maxPag ? $total_num_rows : $num_rows*$pag); ?>, de <?php echo $total_num_rows; ?></span>

<div class="admin-activities-wrap">

<?php

$n = 0;
foreach ($documentales_list as $documentales) {
?>
	<div class="editable-row <?php echo $n%2==0 ? "" : "odd"; $n++; ?> ">
        <img name="imagen" src="http://img.youtube.com/vi/<?php echo $documentales['linkv'] ?>/1.jpg"  width="190" />

		<span class="userListItem usrListName"><?php echo $documentales['ndocumental'] ?></span>
				<a class="usrListBtn usrListEdit transition-1" title="Editar" href="edit_documental.php?action=show&news=<?php echo $documentales['iddocumentales'] ?>">Editar</a>
		<a class="usrListBtn usrListDelete transition-1" title="Borrar" href="javascript:delete_documental(<?php echo $documentales['iddocumentales'] ?>)">Borrar</a>
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