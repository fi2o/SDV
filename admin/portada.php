<?php
require '../config.php';
require 'security.php';

// -------------------------------------------------------

$sql = '';

// -------------------------------------------------------
$db = db();

// -------------------------------------------------------
$sql = 'SELECT idpaginas FROM paginas;';
$db->query($sql,FALSE);
$total_num_rows = $db->num_rows();

// -------------------------------------------------------
$sql = 'SELECT * FROM paginas WHERE idpaginas = 1;';	

$pagina_list = $db->query($sql);
$num_rows = $db->num_rows();

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
	echo '<div align="center">La portada esta vacia.</div>';
} 
				
else  {
?>

<script type="text/javascript">
$('nav_equipos').className = 'current';

function delete_participante(id) {
	var q = confirm('¿Está seguro de que quiere eliminar a éste concursante?.');
	
	if (q) {
		location.href = "delete_participante.php?participante="+id;
	}
}
</script>

<script>
    $(document).ready(function(){
        $('#orden').change(function(){
            ordenar.submit();
        });
    });
</script>

<h2 class="sectTitle">Portada</h2>

<div class="bodyCont userListWrap">
<?php

$n = 0;
foreach ($pagina_list as $portada) {
?>
	<div class="userEntry">
		<span class="page-edit-btn"><a class="usrListBtn usrListEdit transOn" title="Editar" href="portadaedit.php?action=show&news=<?php echo $portada['idpaginas'] ?>">Editar</a></span>    
		<span class="page-name"><?php echo $portada['nombre']; ?> </span>
        <span class="page-video"><?php echo $portada['video']; ?> </span>
		<span class="page-desc"><?php echo $portada['descripcion']; ?> </span>
	</div>
<?php
}
?>
</div>
<?php
}

require '../templates/footer.php';
?>