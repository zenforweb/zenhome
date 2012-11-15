<?
/*
*	CHAT :: WIDGET
*
*/
?>
<div id="app-widget-chat" class="box span4 shadow">
  <script src="<?php echo base_url() . FRONT_END; ?>apps/chat/js/chat.js"></script>
  <link href="<?php echo base_url() . FRONT_END; ?>apps/chat/css/chat.css" rel="stylesheet">

	<div class="box-header header-gradient">
		<a href="<? base_url(); ?>apps/chat" class="pull-left">
			<h2>Chat</h2>
		</a>
		<div class="box-controls pull-right">
			<span class="icon-chevron-up"></span>
			<span class="icon-remove"></span>
		</div>	  
	</div>
	<div class="box-body">
		<ul id="chat_display" style="word-wrap:break-word; padding-right:5px;">
			<?
			foreach ( $chat as $msg ) {
				?>
				<li id="chat_<? echo $msg['id']; ?>" class="row-fluid">
					<div class="chat_image span1">
						<img src="http://0.gravatar.com/avatar/<? echo $msg['user']['gravatar']; ?>?s=50&r=pg&d=mm"/>
					</div>
					<div class="chat_details span9">
						<b><? echo ucfirst( $msg['user']['user_name'] ); ?>: </b> <br />
						<? echo $msg['msg'] ?>
						<br />
						<small><? echo format_time( $msg['date'], 'D h:i:s a' ); ?></small>
					</div
				</li>
				<?
			}
			?>
		</ul>
		<div class="input-append row-fluid">
			<input class="span9 pull-left" id="chat_input" size="16" type="text">
			<button class="span3 btn pull-right" id="chat_input_btn" type="button">Send</button>
		</div>
	</div>
</div>