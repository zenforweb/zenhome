jQuery('document').ready(function($){
	$('.box-controls .icon-remove').live('click tap', function(){
		var btn  		= $(this),
			box  = btn.closest('.box');
		box.slideToggle( function(){
			box.remove();
		});
	});

	/* GETTING TOUCH SHIT WORKING! */
	$('.box-controls').live('touch', function(){
		$('body').css('background-image', 'none');
		$('body').css('background-color', 'red');
	});

	$('.box-controls .icon-chevron-up, .box-controls .icon-chevron-down' ).live('click', function(){
		var btn 		= $(this);
		btn.closest('.box').find('.box-body').slideToggle();
		if( btn.hasClass('icon-chevron-up') ){
			btn.removeClass('icon-chevron-up');
			btn.addClass('icon-chevron-down');
		} else {
			btn.removeClass('icon-chevron-down');
			btn.addClass('icon-chevron-up');
		}
	});
});		