<?php
require 'config.php';
require_once('templates/head.php');
$db = db();
$sql = '';
// -------------------------------------------------------
$sql = 'SELECT idvideosyt, linkv, nvideo FROM videosyt ORDER BY fecha_entrada DESC LIMIT 4';	
$videos = $db->query($sql);

$sql = 'SELECT idprovincias, clase, provincias FROM provincias;';	
$provincias = $db->query($sql);

$sql2 = 'SELECT titulo FROM noticias ORDER BY fecha DESC LIMIT 5';	
$noticias = $db->query($sql2);

?>

<div class="main">
	<div class="map-wrap column main-section">
	
	<?php 
	$V_cont = 0;
	foreach($provincias as $pro)
	{
	?>
		<a href="provincia.php?ver_pro=<?php echo $pro['idprovincias'] ?>" class="map-point <?php echo $pro['clase'] ?>">
			<span class="point-graph fluid-transition"></span>
			<span class="map-loc-name fluid-transition"><?php echo $pro['provincias'] ?></span>
		</a>
		<?php 
		
			}
			?>	
	</div>
	
	<div class="news-wrap column main-section">
		<h2 class="news-heading">Titulares: </h2>
	    	<div class="titles-wrap">
				<?php 
				foreach($noticias as $noti)
				{
				?>
				<h3 class="news-title transition-2"><?php echo $noti['titulo'] ?></h3>
				<?php 
				}	
				?> 
	        </div>
	
	</div>
	
	<div class="carousel-wrap column main-section">
		<h2 class="main-heading">Videos recientes</h2>
		
		<div class="carousel">
			<?php 
			foreach($videos as $vid)
			{
			?> 
				<div class="carousel-display">
	            <a title="ver" href="videospp.php?video=<?php echo $vid['idvideosyt'] ?>">
					<img name="imagen" src="http://img.youtube.com/vi/<?php echo $vid['linkv'] ?>/hqdefault.jpg"/>
					<h3 class="carousel-descrip-wrap"><?php echo $vid['nvideo'] ?></h3>
	                </a>
				</div>
			<?php 
			}	
			?> 
				
			<div class="carousel-thumb-wrap">
				<?php 
				foreach($videos as $vid)
				{
				?> 
					<span class="carousel-thumb transition"><img name="imagen" src="http://img.youtube.com/vi/<?php echo $vid['linkv'] ?>/mqdefault.jpg"/></span>
				
				<?php 
				}
				?>  
					<span class="carousel-active-mask"></span>
				
			</div>
		</div>
	</div>
<!--
	<div class="directoryWrap column main-section">
			<h2 class="main-heading media-title">Periódicos</h2>
	<?php 
			foreach($dir1 as $periodicos)
			{
			?> 
	           <h3><a title="ver" target="_blank" href="<?php echo $periodicos['web'] ?>"><?php echo $periodicos['nombre'] ?></a> - </h3>
				
			<?php 
			}	
			?> 
	        <h2 class="main-heading media-title">Radio</h2>
	<?php 
			foreach($dir3 as $radio)
			{
			?> 
	            <h3><a title="ver" target="_blank" href="<?php echo $radio['web'] ?>"><?php echo $radio['nombre'] ?></a> - </h3>
				
			<?php 
			}	
			?> 
	        <h2 class="main-heading media-title">Televisión</h2>
	<?php 
			foreach($dir2 as $television)
			{
			?> 
	           <h3><a title="ver" target="_blank" href="<?php echo $television['web'] ?>"><?php echo $television['nombre'] ?></a> - </h3>
				
			<?php 
			}	
			?>                 
	</div>
-->
</div>

<div class="aside">
	<a href="medios.php?views=3" class="extra-link mediums">
		<span class="extra-text">Medios</span>
		<i class="fa fa-file-text"></i>
		<i class="fa fa-desktop"></i>
		<i class="fa fa-globe bigger"></i>
		<i class="fa fa-microphone bigger"></i>
		
	</a>
	<a href="hhoy.php" class="extra-link daily-video last">
		<span class="extra-text">Historia de hoy</span>
		<i class="fa fa-desktop"></i>
		<i class="fa fa-play-circle-o"></i>		
	</a>
	<div class="province-contents-wrap column">
		<h2 class="province-name-title sub-heading">Video en vivo</h2>
		<div class="live-vid-wrap small">
			
		</div>
	
<!--
		
		<div class="ad extra-ad">
	        <?php
		$hoya = date("Y-m-d");
		foreach ($banner_por as $bannersf) {
		$fa = new DateTime($hoya);		
		$fb = new DateTime($bannersf['fstart']);
		$fc = new DateTime($bannersf['ffinish']);		
		if ($fa >= $fb and $fc > $fa){
		?>
	    <a href="<?php echo $bannersf['link'];?>"><img src="images/banners/thumb300/<?php echo $bannersf['imagen'];?>" width="300" height="250" alt="pfront" /></a>
		<?php } else {echo "";} }?>
	    </div>
-->
		
	</div>
	
	<?php
		require 'templates/aside.php';
	?>
	
</div>




<script src="scripts/news-title-widget.js"></script>

<!--
<script>
	
	var rotate_interval;
	
	function rotateNewsFN(){
		
		var current_news = $('.news-detail').first();
		current_news.fadeIn();
		
		function nextActiveFN(){
			
			current_news.fadeOut('fast');
			current_news = current_news.next('.news-detail');
			
			if(!current_news.hasClass('news-detail')){
				current_news = $('.news-detail').first();
			}
			
			current_news.fadeIn('fast');
		}
		
		rotate_interval = setInterval(nextActiveFN, 4000);
		
	}
	
	rotateNewsFN()

	$('.map-point').on('click', function(){
		var dataProvince = $(this).data('province'),
			province_wrap = $('.none');
				
		$(this).addClass('active').siblings().removeClass('active');

		province_wrap.animate({
			'opacity': '0',
			'left': '30px'
		}, 200);
		
		setTimeout( function(){
			$.get( "test.php",{id_provincia:dataProvince}, function( data ) {
				province_wrap.html( data ).animate({
					'opacity': '1',
					'left': '0'
				}, 200);
				
				clearInterval(rotate_interval);
				rotateNewsFN();
			});
		}, 250);
	});
</script>
-->

<script type="text/javascript">
/* script used to make the carousel work.*/ 
		
	//sets initial order number as class for each carousel-display
	$('.carousel-wrap').find('.carousel-display').each(function(displayCnt){
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
		parent_pos = $('.carousel-thumb-wrap').offset().top, //gets active thumb's parent position
		obj_pos = $('.carousel-thumb.active').offset().top, //gets active thumb's position 
		new_pos = obj_pos - parent_pos; //calculates active thumb's relative position to its parent
		
		$('.carousel-active-mask').animate({top: new_pos}, 250);
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