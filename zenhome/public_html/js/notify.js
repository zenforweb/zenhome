jQuery('document').ready(function($){
    var notify = $('#notify ul');

    setTimeout(
	function(){
	    notify.find('li').each( function(){
		$(this).slideToggle();
	    });

	    if( $('#notify ul li').hasClass('alert-success') ){
		var alert_success_div = $(this).find('.alert-success');
		
		setTimeout(function() {
		    $('#notify ul .alert-success').slideToggle( function(){
			$('#notify ul .alert-success').remove();
		    });
		}, 2000);


		if( $('#notify ul li').hasClass('alert-info') ){
		    var alert_success_div = $(this).find('.alert-info');
		    setTimeout(function() {
			$('#notify ul .alert-info').slideToggle( function(){
			    $('#notify ul .alert-info').remove();
			});
		    }, 5000);
		}
	    }
	}, 750);

});

function add_notification( type, message){
    var list = '<li class="alert alert-' + type + '" style="display:none">' + message + '<button type="button" class="close" data-dismiss="alert">x</button></li>';
    var notify =  $('#notify ul');
    notify.append(list);
    var notification = notify.find('li:last');
    notification.slideToggle();
    if( notification.hasClass('alert-success') ){
	setTimeout(function() {
	    $('#notify ul .alert-success').slideToggle( function(){
		$('#notify ul .alert-success').remove();
	    });
	}, 2000);
    } else if(  notification.hasClass('alert-info') ){
	setTimeout(function() {
	    $('#notify ul .alert-success').slideToggle( function(){
		$('#notify ul .alert-success').remove();
	    });
	}, 5000);
    }
}