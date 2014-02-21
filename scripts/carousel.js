/* 
	script used to make the carousel work.
	Nothing earth shattering. If you are reading this,
	feel free to use however you like.
*/ 
		
	//sets initial order number as class for each carousel-display
	$('.carousel-wrap').find('.carousel-display').each(function(displayCnt){
		$(this).addClass(''+displayCnt+'');
		displayCnt == 0 ? $(this).addClass('active') : ""
		
	});
	
	//sets initial order number as data attribute for each carousel-thumb
	//this will be later used to select the corresponding carousel-display to show
	$('.carousel-thumb-wrap').children('.carousel-thumb').each(function(thumbCnt){
		$(this).attr('data-display', thumbCnt);
		thumbCnt == 0 ? $(this).addClass('active') : ""
	});
	
	//sets carousel thumbs mask's new position
	function set_obj_posFN(){
		parent_pos = $('.carousel-thumb-wrap').offset().top, //gets active thumb's parent position
		obj_pos = $('.carousel-thumb.active').offset().top, //gets active thumb's position 
		new_pos = obj_pos - parent_pos; //calculates active thumb's relative position to its parent
		
		$('.carousel-active-mask').animate({top: new_pos}, 250);
	}
	
	//determines next thumb to set as active and
	//sets its corresponding carousel-display as active
	function display_nextFN(elem){
		
		var next_active = $('.carousel-thumb.active').next(); 
		
		elem ? next_active = elem : ""
		
		//object is a thumb?
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
				
			display_nextFN($(this));

		}
	});
