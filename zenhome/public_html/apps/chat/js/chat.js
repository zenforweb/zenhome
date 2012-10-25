jQuery('document').ready(function($){

	function send_message( msg ) {
		msg = encodeURIComponent( msg );
		msg = msg.split( '.' ).join( '%2E' );
		msg = msg.split( '!' ).join( '%21' );
		msg = msg.split( '%2F' ).join( '%800' );

		console.log( msg );
		$.ajax({ url: base_url + 'apps/chat/write/' + msg, });
	}

	function chat_refresh( ){
		var last 		= $('#chat_display li:last').attr('id'),
				last_id = last.replace('chat_', '');
		$.ajax({
			url: base_url + 'apps/chat/read_ajax/' + last_id,
			success: function(data) {
				console.log( data.indexOf("li") != -1  );
				if( data.indexOf("li") != -1 ){
					var chat_display = $('#chat_display');
					chat_display.append( data );
					chat_display.scrollTop( chat_display.get(0).scrollHeight );
				}
			}
		});
	}

	$('#chat_input_btn').click( function(){
		var chat_input = $('#chat_input').val()
		if( chat_input != '' ){
			send_message( $('#chat_input').val() );	
		}
	});

	$(function(){
		var chat_input = $('#chat_input');
    var code       = null;
		chat_input.keypress(function(e){
			code = (e.keyCode ? e.keyCode : e.which);
			if (code == 13){
			  chat_text =  chat_input.val();
			  chat_input.val('');
				send_message( chat_text );
				chat_refresh();
			}
    });
  });

	setInterval( function(){ 
		chat_refresh();
	}, 3000);

	$('#chat_display').scrollTop( $("#chat_display").get(0).scrollHeight );
});	