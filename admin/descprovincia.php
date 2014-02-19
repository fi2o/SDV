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
$sql = 'SELECT idprovincias FROM provincias;';
$db->query($sql,FALSE);
$total_num_rows = $db->num_rows();

$sql = 'SELECT idprovincias, provincias FROM provincias';

$index = ($pag * $per_page) - $per_page;
$sql.= ' LIMIT '. $index .','. $per_page .';';

$per_list = $db->query($sql);
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
<h2 class="main-heading">Provincias</h2>
<?php
if ($num_rows<1){
	echo '<div align="center">No hay Provincias.</div>';
} 
				
else  {
?>

<span class="item-count">Prov. <?php echo ($index+1)." al ".($pag >= $maxPag ? $total_num_rows : $num_rows*$pag); ?>, de <?php echo $total_num_rows; ?></span>

<div class="admin-ally-wrap">

<?php

$n = 0;
foreach ($per_list as $dir) {
?>
	<div class="editable-row <?php echo $n%2==0 ? "" : "odd"; $n++; ?> ">
		<div class="dir-entry-details">
			<h3 class="dir-entry-name"><?php echo $dir['provincias'] ?></a></h3>
		</div>      
		<a class="usrListBtn usrListEdit transition-1" title="Editar" href="edit_provincias.php?action=show&news=<?php echo $dir['idprovincias'] ?>">Editar</a>
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