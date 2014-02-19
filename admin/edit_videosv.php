<?php
require '../config.php';
require 'security.php';
require 'edit_videosv.sc.php';
require '../templates/headerAdmin.php';
$db = db();
?>
<script type="text/javascript">
$('nav_equipos').className = 'current';
</script>

<script type="text/javascript" src="../js/limit_field.js"></script>
<script src="../scripts/CodoPlayer.js" type="text/javascript"></script>


<?php 
$provincias = $db->select('provincias');
?>
<form class="registerForm" name="frmadd_news" action="edit_videosv.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="<?php echo $action ?>" />
<?php
if (isset($_GET['news'])) {
	echo '<input type="hidden" name="news" value="'. $_GET['news'] .'" />';
}

?>

<?php 
$provincias = $db->select('provincias');
?>

<h1 class="formTitle"><?php echo $page_title ?></h1>


<?php
if ($msg!=FALSE) {
	echo '<div align="center" class="error_text">'. htmlentities($msg) .'</div><br />';
}
?>
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
<br />
<label  class="fieldLbl">Codigo video en vivo</label>
<br />
<textarea id="covid" name="covid" rows="10" style="width:600px; height:150px"><?php echo @$_POST['covid'] ?></textarea><br />

<input type="submit" value="Guardar" class="save-button" />

</form>



<?php
require '../templates/footerAdmin.php';
?>