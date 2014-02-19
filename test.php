<?php 
$id_provincia=(int)$_GET["id_provincia"];
require 'config.php';
$db = db();

$sec = $db->get_row('provincias',$id_provincia);
$sql = 'SELECT covid, idprovincias FROM videosvivo WHERE idprovincias = '.$id_provincia.'';	
$covide= $db->query($sql);
$sql = 'SELECT idprovincias, titulo FROM noticias WHERE idprovincias = '.$id_provincia.'';	
$noticiasp = $db->query($sql);
$sql = 'SELECT * FROM banners WHERE idposicion=5 AND idprovincias='.$id_provincia.' LIMIT 1';
$banner_pro = $db->query($sql);
	 
?>

	<h2 class="province-name-title sub-heading"><?php echo $sec['provincias'] ?></h2>
	<p>Video en vivo</p>
	<div id='playerQUhDMlvLZdlX' class="live-vid-wrap small">
	<?php
	foreach($covide as $co){ ?>
    <script type='text/javascript'>
    jwplayer('playerQUhDMlvLZdlX').setup({
        file: '<?php echo $co['covid'] ?>',
        image: 'https://www.longtailvideo.com/content/images/jw-player/lWMJeVvV-876.jpg',
        title: 'Santo Domingo Vive',
        width: '300',
        height: '170',
        fallback: 'false',
        autostart: 'true'
    });
</script>
		
    <?php 
    } 
?>	
	</div>
	<div class="prov-news-wrap">
		<h3 class="sub-heading">Titulares de la provincia</h3>
<?php
if (empty($noticiasp)){
	echo '<p class="news-detail">No hay titulares en esta provincia.</p>';
} 
				
else{

	foreach($noticiasp as $nop){ ?>
		<h4 class="news-detail"><?php echo $nop['titulo'] ?></h4>
    <?php 
    }} 
?>
	</div>
	<a href="provincia.php?ver_pro=<?php  echo $id_provincia; ?>" class="expand-province view-more-btn">Ver más</a>
	<div class="ad small">
    <?php
	$hoya = date("Y-m-d");
	foreach ($banner_pro as $bannersf) {
	$fa = new DateTime($hoya);		
	$fb = new DateTime($bannersf['fstart']);
	$fc = new DateTime($bannersf['ffinish']);		
	if ($fa >= $fb and $fc > $fa){
	?>
    <a href="<?php echo $bannersf['link'];?>"><img src="images/banners/thumb270/<?php echo $bannersf['imagen'];?>" width="270" height="145" alt="pfront" /></a>
	<?php } else {echo "";} }?>
    </div>
	

