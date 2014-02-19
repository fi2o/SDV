    <?php $sql = 'SELECT * FROM banners WHERE idposicion=4 AND idprovincias='.$id_provincia.' LIMIT 1';
	$banner_list = $db->query($sql);
	 ?>

    <?php
	$hoy = date("Y-m-d");
	foreach ($banner_list as $banners) {
	$f0 = new DateTime($hoy);		
	$f1 = new DateTime($banners['fstart']);
	$f2 = new DateTime($banners['ffinish']);		
	if ($f0 >= $f1 and $f2 > $f0){
	if($banners['idtec'] =="2" or $banners['idtec'] =="3"){echo '<span class="ad-banner">'.$banners['content'].'</span>'; 
	}else{	
	?>
    <a class="ad-banner" href="<?php echo $banners['link'];?>"><img src="images/banners/thumb728/<?php echo $banners['imagen'];?>" width="728" height="90" alt="top" /></a>
	<?php } } }?>