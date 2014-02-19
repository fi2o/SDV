<?php
require '../config.php';
require 'security.php';
require 'add_banners.sc.php';
require '../templates/headerAdmin.php';

$VG_Orden = '';
if(isset($_GET['orden'])){
	$VG_Orden = $_GET['orden'];
}

switch($VG_Orden){
	case '0' :
	    $input = "Debe seleccionar el tipo de input";
		break;
	case '1' :
	    $input = '<input name="imagen" type="file" />';
		break;
	case '2' :
        $input = '<textarea name="content" rows="10" style="width:600px; height:150px"></textarea>';
		break;
	case '3' :
        $input = '<textarea name="content" rows="10" style="width:600px; height:150px"></textarea>';
		break;											
	default:
     $input = "Debe seleccionar el tipo de input";
	break;	
	}
?>
<script>
    $(document).ready(function(){
        $('#orden').change(function(){
            ordenar.submit();
        });
    });
</script>
<script type="text/javascript">
$('nav_equipos').className = 'current';
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#from" ).datepicker({
	  dateFormat: "yy-mm-dd",
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
	  dateFormat: "yy-mm-dd",	
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>
<form  name="ordenar" action="" method="get">
	<label class="fieldLbl">Tipo de publicidad(input): </label>
	<select name="orden" id="orden" >
     <option value="0"<?php if ($VG_Orden == "0" ){echo 'selected="selected"';};?>>Seleccionar</option>
     <option value="1"<?php if ($VG_Orden == "1" ){echo 'selected="selected"';};?>>Imagen</option>
     <option value="2"<?php if ($VG_Orden == "2" ){echo 'selected="selected"';};?>>Adsense</option>
     <option value="3"<?php if ($VG_Orden == "3" ){echo 'selected="selected"';};?>>Flash</option>
	</select>
</form>

<form class="registerForm" name="frmadd_news" action="edit_banners.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="<?php echo $action ?>" />
<?php
if (isset($_GET['news'])) {
	echo '<input type="hidden" name="news" value="'. $_GET['news'] .'" />';
}

?>



<h1 class="formTitle"><?php echo $page_title ?></h1>
<?php 
$provincias = $db->select('provincias');
$posicion = $db->select('posicion');

?>
<?php
if ($msg!=FALSE) {
	echo '<div align="center" class="error_text">'. htmlentities($msg) .'</div><br />';
}
?>

<div class="fieldWrap">
	<span class="fieldLbl">Cliente</span>
	<br />
	<input type="text" class="textField formField" name="cliente" maxlength="254" required="required"  placeholder="Nombre del cliente o empresa" value="<?php echo @$_POST['cliente'] ?>" />
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
<label class="fieldLbl">Posicion</label> 
<select name="idposicion">
 <option value="0">Seleccionar</option>
<?php 
foreach($posicion as $pros)
{
	?> 
  <option <?php if ($pros['idposicion'] == @$_POST['idposicion']){ echo 'selected="selected"';} ?> value="<?php echo $pros['idposicion'] ?>"><?php echo $pros['posicion'] ?></option>
  
<?php }?>  
</select><br />
</div>
<div class="fieldWrap first">
	<span class="fieldLbl">Fecha inicio</span>
	<br />
	<input type="text" id="from" readonly="readonly" class="textField formField" name="fstart" maxlength="254" required="required" placeholder="AAAA-MM-DD" value="<?php echo @$_POST['fstart'] ?>" />
</div>
<div class="fieldWrap first">
	<span class="fieldLbl">Fecha termina</span>
	<br />
	<input type="text" id="to" readonly="readonly" class="textField formField" name="ffinish" maxlength="254" required="required" placeholder="AAAA-MM-DD" value="<?php echo @$_POST['ffinish'] ?>" />
</div>

<div class="fieldWrap">
	<span class="fieldLbl">Contenido</span>
	<br />
    <?php if(@$_POST['idtec'] =="2" or @$_POST['idtec'] =="3"){?>
    <textarea name="content" rows="10" style="width:600px; height:150px"><?php echo @$_POST['content'] ?></textarea> 
	<?php }else{  echo $input;  ?> <input name="idtec" type="hidden" value="<?php echo $VG_Orden ?>" />
 <?php }?> 
    <?php if(!empty($_POST['imagen'])){ ?>
    	<img name="imagen" src="../images/banners/<?php echo @$_POST['imagen'] ?>" />
    <?php } ?>	
</div>

<div class="fieldWrap">
	<span class="fieldLbl">Link Banner</span>
	<br />
	<input type="text" class="textField formField" name="link" maxlength="254" required="required"  placeholder="Link Banner" value="<?php echo @$_POST['link'] ?>" />
</div>
<input type="submit" value="Guardar" />

</form>



<?php
require '../templates/footerAdmin.php';
?>