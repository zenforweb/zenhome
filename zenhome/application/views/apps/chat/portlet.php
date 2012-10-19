<?
/*
*	CHAT :: WIDGET
*
*/
?>

<script src="<?php echo base_url() . FRONT_END; ?>apps/chat/js/chat.js"></script>

<div id="app_chat_portlet" class="portlet span4">
	<h2>Chat</h2>
	<ul id="chat_display" style="overflow:auto; width:100%; height:300px;">
		<?
		foreach ( $chat as $msg ) {
			?>
			<li id="chat_<? echo $msg['id']; ?>">
				<b><? echo ucfirst( $msg['user']['user_name'] ); ?>: </b>
				<? echo $msg['msg'] ?>
				<br />
				<small><? echo format_time( $msg['date'], 'D h:i:s' ); ?></small>
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