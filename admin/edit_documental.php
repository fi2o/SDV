<?php
require '../config.php';
require 'security.php';
require 'edit_documental.sc.php';
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


<form class="registerForm" name="frmadd_news" action="edit_documental.php" method="post" enctype="multipart/form-data">
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
	<input type="text" class="textField formField" name="ndocumental" maxlength="254" required="required"  value="<?php echo @$_POST['ndocumental'] ?>" /><br />
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
<label  class="fieldLbl">Descripción Video (<?php echo @$_POST['ndocumental'] ?>)</label>
<br />
<textarea id="descv" name="descv" class="mceEditor" rows="10" style="width:600px; height:150px"><?php echo @$_POST['descv'] ?></textarea><br />

<input type="submit" value="Guardar" class="save-button" />

</form>



<?php
require '../templates/footerAdmin.php';
?>