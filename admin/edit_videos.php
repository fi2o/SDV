<?php
require '../config.php';
require 'security.php';
require 'edit_videos.sc.php';
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

  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({
	dateFormat: "yy-mm-dd"
	}
	);
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
$secciones = $db->select('secciones');
?>
<?php 
$provincias = $db->select('provincias');
?>
<form class="registerForm" name="frmadd_news" action="edit_videos.php" method="post" enctype="multipart/form-data">
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


	<label class="fieldLbl">Nombre del video</label>
	<br />
	<input type="text" class="textField formField" name="nvideo" maxlength="254" required="required"  value="<?php echo @$_POST['nvideo'] ?>" /><br />
</div>
<div class="fieldWrap first">
<label class="fieldLbl">Sección</label> 
<select name="idsecciones">
 <option value="0">Seleccionar</option>
<?php 
foreach($secciones as $sec)
{
	?> 
  <option <?php if ($sec['idsecciones'] == @$_POST['idsecciones']){ echo 'selected="selected"';} ?> value="<?php echo $sec['idsecciones'] ?>"><?php echo $sec['nseccion'] ?></option>
  
<?php }?>  
</select><br />
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
<div class="fieldWrap first">
	<label class="fieldLbl">URL del Vídeo</label>
	<br />
	<label class="url-label" >http://www.youtube.com/watch?v=</label><input type="text" class="textField formField" name="linkv" maxlength="254" required="required"  value="<?php echo @$_POST['linkv'] ?>" /><br />
    <?php if (@$_POST['linkv'] != ""){?>
    <iframe width="560" height="315" src="//www.youtube.com/embed/<?php echo @$_POST['linkv'] ?>" frameborder="0" allowfullscreen></iframe>
    <?php }?>
</div>

<br />
<div class="fieldWrap first">
	<label class="fieldLbl">Fecha Publicaci&oacute;n(Historia de hoy)</label>
	<br />
<input type="text" id="datepicker" readonly="readonly" class="textField formField" name="fecha_publi" maxlength="254" value="<?php echo @$_POST['fecha_publi'] ?>" /><br />
</div>

<br />
<label  class="fieldLbl">Descripción Video (<?php echo @$_POST['nvideo'] ?>)</label>
<br />
<textarea id="descv" name="descv" class="ckeditor" rows="10" style="width:600px; height:150px"><?php echo @$_POST['descv'] ?></textarea><br />

<input type="submit" value="Guardar" class="save-button" />

</form>



<?php
require '../templates/footerAdmin.php';
?>