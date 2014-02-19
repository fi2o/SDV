<?php
require '../config.php';
require 'security.php';
require 'edit_personajes.sc.php';
require '../templates/headerAdmin.php';
$db = db();
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

<?php 
$provincias = $db->select('provincias');
?>

<form class="registerForm" name="frmadd_news" action="edit_personajes.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="<?php echo $action ?>" />
<?php
if (isset($_GET['news'])) {
	echo '<input type="hidden" name="news" value="'. $_GET['news'] .'" />';
}

?>



<h1 class="formTitle"><?php echo $page_title ?></h1>


<?php
if ($msg!=FALSE) {
	echo '<div align="center" class="error_text">'. htmlentities($msg) .'</div><br />';
}
?>
<div class="fieldWrap first">


	<label class="fieldLbl">Nombre</label>
	<br />
	<input type="text" class="textField formField" name="nombre" maxlength="254" required="required"  value="<?php echo @$_POST['nombre'] ?>" /><br />
</div>

<div class="fieldWrap first">

<br />
<label  class="fieldLbl">Descripción</label>
<br />
<textarea id="desc" name="desc" class="mceEditor" rows="10" style="width:600px; height:150px"><?php echo @$_POST['desc'] ?></textarea><br />
</div>
<div class="fieldWrap first">
<label class="fieldLbl">Provincia</label> 
<select name="idprovincias">
 <option value="0">Seleccionar</option>
<?php 
foreach($provincias as $pro)
{
	?> 
  <option <?php if ($pro['idprovincias'] == @$_POST['idprovincias']){ echo 'selected="selected"';} ?> value="<?php echo $pro['idprovincias'] ?>"><?php echo $pro['provincias'] ?></option>
  
<?php }?>  
</select><br />
</div>

<div class="fieldWrap">
	<span class="fieldLbl">Imagen</span>
	<br />
    <input name="imagen" type="file" /><br />
    
    <?php if(empty($_POST['imagen'])){} else{ ?>
    	<img name="imagen" src="../images/personajes/thumb400/<?php echo @$_POST['imagen'] ?>" width="140" />
    <?php } ?>	
</div>

<br />
<input type="submit" value="Guardar" class="save-button" /><br />


</form>



<?php
require '../templates/footerAdmin.php';
?>