<?php 
$sql = 'SELECT * FROM banners WHERE idposicion=6 AND idprovincias='.$id_provincia.' LIMIT 1';
$aside_1 = $db->query($sql);
$sql = 'SELECT * FROM banners WHERE idposicion=7 AND idprovincias='.$id_provincia.' LIMIT 1';
$aside_2 = $db->query($sql);
?>
<div class="ads-wrap column sections-extras">
	<div class="ad">
    <?php
	$hoy1 = date("Y-m-d");
	foreach ($aside_1 as $banners1) {
	$f3 = new DateTime($hoy);		
	$f4 = new DateTime($banners1['fstart']);
	$f5 = new DateTime($banners1['ffinish']);		
	if ($f3 >= $f4 and $f5 > $f3){
	if($banners1['idtec'] =="2" or $banners1['idtec'] =="3"){echo $banners1['content']; 
	}else{	
	?>
    <a href="<?php echo $banners1['link'];?>"><img src="images/banners/thumb300/<?php echo $banners1['imagen'];?>" width="300" height="250" alt="aside1" /></a>
	<?php }} }?>
    </div>
	
	<div class="ad">
        <?php
	$hoy2 = date("Y-m-d");
	foreach ($aside_2 as $banners2) {
	$f6 = new DateTime($hoy);		
	$f7 = new DateTime($banners2['fstart']);
	$f8 = new DateTime($banners2['ffinish']);		
	if ($f6 >= $f7 and $f8 > $f6){
	if($banners2['idtec'] =="2" or $banners2['idtec'] =="3"){echo $banners2['content']; 
	}else{	
	?>
    <a href="<?php echo $banners2['link'];?>"><img src="images/banners/thumb300/<?php echo $banners2['imagen'];?>" width="300" height="250" alt="aside2" /></a>
	<?php } } }?>
    </div>
	

	
</div>