


var active_title = $('.news-title').first();
	active_title.addClass('active')
	
function change_titleFN(){
	var last_title = active_title;
	last_title.addClass('removed').removeClass('active');
	
	active_title = last_title.next('.news-title');
	if(!active_title.hasClass('news-title')){
		active_title = $('.news-title').first();
	}
	
	active_title.addClass('active');
	
	setTimeout(function(){
		last_title.hide().removeClass('removed');
		
		setTimeout(function(){
			last_title.show();
		}, 225);
	
	}, 220);
}

setInterval(change_titleFN, 3000);