<?
/*
*	CHAT :: WIDGET
*
*/
?>

<script src="<?php echo base_url() . FRONT_END; ?>apps/chat/js/chat.js"></script>

<style type="text/css">
	.chat_details {
		width: 300px;
	}
</style>

<link href="<?php echo base_url() . FRONT_END; ?>apps/chat/css/chat.css" rel="stylesheet">

<div id="app_chat_portlet" class="portlet span4">
	<a href="<? base_url(); ?>apps/chat">
		<h2>Chat</h2>
	</a>
	<ul id="chat_display" style="overflow:auto; width:100%; height:300px;">
		<?
		foreach ( $chat as $msg ) {
			?>
			<li id="chat_<? echo $msg['id']; ?>">
				<div class="chat_image" style="width:50px">
					<img src="http://0.gravatar.com/avatar/<? echo $msg['user']['gravatar']; ?>?s=50&r=pg&d=mm"/>
				</div>
				<div class="chat_details">
					<b><? echo ucfirst( $msg['user']['user_name'] ); ?>: </b> <br />
					<? echo $msg['msg'] ?>
					<br />
					<small><? echo format_time( $msg['date'], 'D h:i:s' ); ?></small>
				</div>
				<div style="clear:both"></div>
			</li>
			<?
		}
		?>
	</ul>
	<div class="input-append">
  	<input class="span7" id="chat_input" size="16" type="text">
  	<button class="btn" id="chat_input_btn" type="button">Send</button>
	</div>
</div>