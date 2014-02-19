<?php
require '../config.php';
require 'security.php';
require 'edit_provincias.sc.php';
require '../templates/headerAdmin.php';
$db = db();
?>
<script type="text/javascript">
$('nav_equipos').className = 'current';
</script>

<script type="text/javascript" src="../js/limit_field.js"></script>
<script src="../scripts/CodoPlayer.js" type="text/javascript"></script>
<!-- TinyMCE -->
<script src="../js/ckeditor/ckeditor.js"></script>
<!-- /TinyMCE -->

<!--
<div id="nav_sub">
<a href="concursantes.php"><-----Volver al Listado de Concursantes</a>
</div>
-->

<!-- <div id="main_body"> -->


<form class="registerForm" name="frmadd_news" action="edit_provincias.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="<?php echo $action ?>" />
<?php
if (isset($_GET['news'])) {
	echo '<input type="hidden" name="news" value="'. $_GET['news'] .'" />';
}

?>



<h1 class="formTitle"><?php echo $page_title ?>-<?php echo @$_POST['provincia'] ?></h1>


<?php
if ($msg!=FALSE) {
	echo '<div align="center" class="error_text">'. htmlentities($msg) .'</div><br />';
}
?>

<div class="fieldWrap first">

<label  class="fieldLbl">Descripción</label>
<br />
<textarea id="descprovincia" name="descprovincia" class="ckeditor" rows="10" style="width:600px; height:150px"><?php echo @$_POST['descprovincia'] ?></textarea><br />
</div>



<br />
<input type="submit" value="Guardar" class="save-button" /><br />


</form>



<?php
require '../templates/footerAdmin.php';
?>