<?
/*
*	REMOTE ::
*
*/
?>
<script type="text/javascript">
	jQuery('document').ready( function($){

		function send_cmd( device, cmd, cmd_name ){
			var updateUrl = '<? echo base_url(); ?>' + 'apps/app_remote/command/' + device + '/' + cmd;
			$.ajax( {
				url: updateUrl,
				context: document.body,
				success: function(){
					console.log( 'sent command:' + cmd_name );
				}
			});
		}

		$('#app_remote_controls button').click( function(){
			var clicked = $(this),
					value   = clicked.attr('value'),
					name 		= clicked.text();
			send_cmd( 'reciever', value, name);
		});
	});
</script>
<div id="app_remote_portlet" class="portlet span4">
	<h2>Remote</h2>
	<p>
		Reciever
		<div id="app_remote_controls">
			<button value="1PWR01" class="btn btn-success btn-small">on</button>
			<button value="1PWR00" class="btn btn-danger btn-small">off</button>
			<br />
			Input
			<button value="1SLI00" class="btn btn-inverse btn-small">Apple Tv</button>
			<button value="1SLI02" class="btn btn-inverse btn-small">Xbox 360</button>
		</div>
</div>