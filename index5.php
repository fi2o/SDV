<script type="text/jscript">
function O_Provincia (P_ID, P_Clase, P_Nombre, P_Titulo, P_Video, P_Banner){
	this.ID = P_ID;
	this.clase = P_Clase;
	this.Nombre = P_Nombre;
	this.Titulo = P_Titulo;
	this.Video = P_Video;
	this.Banner = P_Banner;
}
var VL_provincias = new Array();
</script>
<?php
require 'config.php';
require_once('templates/head.php');
$db = db();
$sql = '';
// -------------------------------------------------------
$sql = 'SELECT * FROM videosyt ORDER BY fecha_entrada DESC LIMIT 4';	
$videos = $db->query($sql);

$sql = 'SELECT * FROM provincias;';	
$provincias = $db->query($sql);

$sql2 = 'SELECT * FROM noticias ORDER BY fecha DESC LIMIT 5';	
$noticias = $db->query($sql2);

?>


<div class="map-wrap column">
<?php 
$V_cont = 0;
foreach($provincias as $pro)
{
?>

<script type="text/jscript">
VL_provincias[<?php echo ($V_cont) ?>] = new O_Provincia(<?php echo $pro['idprovincias'] ?>, "<?php echo $pro['clase'] ?>", "<?php echo $pro['provincias'] ?>", "<?php echo $pro['provincias'] ?>", "<?php echo $pro['provincias'] ?>", "<?php echo $pro['provincias'] ?>"
);
</script>


	<span class="map-point <?php echo $pro['clase'] ?>" data-province="<?php echo $pro['clase'] ?>"><span class="point-graph fluid-transition"></span><span class="map-loc-name fluid-transition"><?php echo $pro['provincias'] ?></span></span>
	<?php 
	$V_cont++;
		}
		?>
</div>
<div class="province-contents-wrap column">
	<h2 class="province-name-title">Santo Domingo</h2>
	<p>Video en vivo</p>
	<div class="live-vid-wrap small">
		
	</div>
	<div class="prov-news-wrap">
		<h3>Últimas Noticias</h3>
	</div>
	<a href="" class="expand-province">Ver más</a>
</div>

<div class="carousel-wrap column">
	<h1 class="main-heaading">Videos recientes</h1>

	<?php 
	foreach($videos as $vid)
	{
	?> 
		<div class="carousel-display">
			<iframe width="560" height="315" src="//www.youtube.com/embed/<?php echo $vid['linkv'] ?>" frameborder="0" allowfullscreen></iframe>
			<p class="carousel-descrip-wrap"><?php echo $vid['descv'] ?></p>
		</div>
	<?php 
	}	
	?> 
		
	<div class="carousel-thumb-wrap">
		<?php 
		foreach($videos as $vid)
		{
		?> 
			<span class="carousel-thumb transition"><img name="imagen" src="http://img.youtube.com/vi/<?php echo $vid['linkv'] ?>/1.jpg"/></span>
		
		<?php 
		}
		?>  
	</div>
</div>
<div class="ads-wrap column">
	<div class="ad"></div>
	
	<div class="ad"></div>
</div>

<div class="news-wrap column">
<h1 class="main-heaading">Últimas Noticias</h1>
<?php 
foreach($noticias as $noti)
{
?>
	<div class="news-detail">
		<h2 class="noticias-title"><a href="noticiasp.php?noti=<?php echo $noti['idnoticias'] ?>"><?php echo $noti['titulo'] ?></a></h2>	
		<a href="" class="noticias-img"><img name="imagen" src="images/noticias/thumb180/<?php echo $noti['imagen'] ?>"  width="180" /></a>
		<p class="noticias-desc"><?php echo substr($noti['descripcion'], 0, 10); ?></p>
	</div>
<?php }?>  

</div>


</div>

<script>
	var Data_Provincia;
	var dataProvince,
		province_name;
	
	$('.map-point').on('click', function(){
		dataProvince = $(this).data('province');
				
		$('.map-point.active').removeClass('active');
		$(this).addClass('active');
		

	var v_cont1 = 0;
	
	while (v_cont1 < VL_provincias.length){		
			if(VL_provincias[v_cont1].clase ==  dataProvince){
				Data_Provincia = VL_provincias[v_cont1]; 
			}
		v_cont1++;		
	}			
		
		switch(dataProvince){
			case 'santo-domingo':
				province_name = "Santo Domingo";
				break;
			case 'hato-mayor':
				province_name = "Hato Mayor";
				break;
			case 'monte-plata':
				province_name = "Monte Plata";
				break;		
			default:
				province_name = "Santo Domingo";	
			
		}
		
		$('.province-contents-wrap').animate({
			'opacity': '0',
			'left': '30px'
		}, 200);
				
		setTimeout( function(){
			$('.province-contents-wrap').html('<h2 class="province-name-title">' + Data_Provincia.Titulo + '</h2><p>Video en vivo</p><div class="live-vid-wrap"></div><div class="prov-news-wrap"><h3>Últimas Noticias</h3></div><a href="provincia.php?prov=' + Data_Provincia.ID + '" class="expand-province">Ver más</a>').animate({
				'opacity': '1',
				'left': '0'
			}, 200)
		}, 250);
		
		
	});
</script>

<script type="text/javascript">
/* script used to make the carousel work.*/ 
		
	//sets initial order number as class for each carousel-display
	$('.carousel-wrap').children('.carousel-display').each(function(displayCnt){
		displayCnt++;
		$(this).addClass(''+displayCnt+'');
		if(displayCnt==1){
			$(this).addClass('active');
		}
		
	});
	
	//sets initial order number as data attribute for each carousel-thumb
	//this will be later used to select the corresponding carousel-display to show
	$('.carousel-thumb-wrap').children('.carousel-thumb').each(function(thumbCnt){
		thumbCnt++;
		$(this).attr('data-display', thumbCnt);
		if(thumbCnt==1){
			$(this).addClass('active');
		}
		
	});
	
	//sets carousel thumbs mask's new position
	function set_obj_posFN(){
		parent_pos = $('.carousel-thumb-wrap').offset().left, //gets active thumb's parent position
		obj_pos = $('.carousel-thumb.active').offset().left, //gets active thumb's position 
		new_pos = obj_pos - parent_pos; //calculates active thumb's relative position to its parent
		
		$('.carousel-active-mask').animate({left: new_pos}, 250);
	}
	
	//determines next thumb to set as active and
	//sets it's corresponding carousel-display as active
	function display_nextFN(){
		
		var next_active = $('.carousel-thumb.active').next(); 
		
		//next object is a thumb?
		if(next_active.hasClass('carousel-thumb')){
			var next_display = next_active.data('display');
		}
		
		//if not, restart carousel's rotation
		else{
			var next_active = $('.carousel-thumb').first(),
				next_display = 1;
		}
		
		//removes previous active thumb/display
		$('.carousel-thumb').removeClass('active');
		$('.carousel-display').fadeOut('fast').children('.carousel-descrip-wrap').animate({
			bottom: '-50px'
		}, 150);
		
		//adds active to next thumb and display in line
		next_active.addClass('active');
		$('.carousel-display.' + next_display).fadeIn('fast').children('.carousel-descrip-wrap').animate({
			bottom: '0'
		}, 150);
		
		set_obj_posFN();
	}
	
	//sets carousel's initial interval
	var chng_display_interval = setInterval(display_nextFN, 5000);
	
	//stops/starts the carousel on hover in/out
	$('.carousel-wrap').on({
		mouseenter: function(){
			clearInterval(chng_display_interval);
		},
		mouseleave: function(){
			chng_display_interval = setInterval(display_nextFN, 5000);
		}
	});
	
	//sets active thumb/display on user click
	$('.carousel-thumb').on('click', function(){
	
		if(!$(this).hasClass('active')){
				
			//removes previous active thumb/display
			$('.carousel-thumb').removeClass('active');
			$('.carousel-display').fadeOut('fast').children('.carousel-descrip-wrap').animate({
				bottom: '-50px'
			}, 150);
			
			//adds active to next thumb/display in line
			var next_display = $(this).data('display');
			
			$(this).addClass('active');
			$('.carousel-display.' + next_display).fadeIn('fast').children('.carousel-descrip-wrap').animate({
				bottom: '0'
			}, 150);
			
			set_obj_posFN();
		}

		
	});
</script>
<?php
require_once('templates/footer.php');

?>