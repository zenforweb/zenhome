<?php
/*
*	CHAT :: INDEX
*
*/
?>
<script src="<?php echo base_url() . FRONT_END; ?>apps/chat/js/chat.js"></script>

<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
			<h3>Chat</h3>
		</div>
		<div class="span2 pull-right">
			<div class="dropdown pull-right">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="<? echo base_url(); ?>apps/motion/settings">Settings</a></li>
	  		</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<ul id="chat_display" style="overflow:auto; width:100%; height:500px;">
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
	</div>
</div>