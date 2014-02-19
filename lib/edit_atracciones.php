<?php
require '../config.php';
require 'security.php';
require 'add_atraccion.sc.php';
require '../templates/headerAdmin.php';
?>
<script type="text/javascript">
$('nav_equipos').className = 'current';
</script>

<script type="text/javascript" src="../js/limit_field.js"></script>
<script src="../scripts/CodoPlayer.js" type="text/javascript"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="../js/tiny_mce/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({
    selector: "textarea",
	toolbar: "insertfile undo redo |  bold italic | alignjustify | bullist | forecolor backcolor emoticons"
 });
</script>
<!-- /TinyMCE -->

<!--
<div id="nav_sub">
<a href="concursantes.php"><-----Volver al Listado de Concursantes</a>
</div>
-->

<!-- <div id="main_body"> -->


<form class="registerForm" name="frmadd_news" action="edit_atracciones.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="<?php echo $action ?>" />
<?php
if (isset($_GET['cont'])) {
	echo '<input type="hidden" name="news" value="'. $_GET['cont'] .'" />';
}

?>



<h1 class="formTitle"><?php echo $page_title ?></h1>


<?php
if ($msg!=FALSE) {
	echo '<div align="center" class="error_text">'. htmlentities($msg) .'</div><br />';
}
?>

<div class="fieldWrap first">
	<span class="fieldLbl">Nombre</span>
	<br />
	<input type="text" class="textField formField" name="nombreatrac" maxlength="254" required="required"  value="<?php echo @$_POST['nombreatrac'] ?>" />
</div>
<div class="fieldWrap first">
	<span class="fieldLbl">Descripcion</span>
	<br />
<textarea id="descatrac"  name="descatrac" class="mceEditor" rows="10" style="width:600px; height:150px"><?php echo @$_POST['descatrac'] ?></textarea>
</div>
<div class="fieldWrap first">
	<span class="fieldLbl">Logo</span>
	<br />
    <input name="fotosatrac" type="file" /><br />
    <img name="imagen" src="../<?php echo @$_POST['fotosatrac'] ?>" width="190" height="90" alt="" />
</div>
<div class="fieldWrap first">
	<span class="fieldLbl">Imagenes</span>
	<br />
    <input name="imagenali" type="file" />
    <img name="imagen" src="<?php echo @$_POST['ph1'] ?>" alt="" />
	<br />
    <input name="imagenali" type="file" />
    <img name="imagen" src="<?php echo @$_POST['ph2'] ?>" alt="" />
	<br />
    <input name="imagenali" type="file" />
    <img name="imagen" src="<?php echo @$_POST['ph3'] ?>" alt="" />
</div>

<input type="submit" value="Guardar" />

</form>



<?php
require '../templates/footer.php';
?>