<?php
/*
*	CHAT :: INDEX
*
*/
?>
<script src="<?php echo base_url() . FRONT_END; ?>apps/chat/js/chat.js"></script>

<link href="<?php echo base_url() . FRONT_END; ?>apps/chat/css/chat.css" rel="stylesheet">

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
	    		<li><a href="<? echo base_url(); ?>apps/chat/settings">Settings</a></li>
	  		</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<ul id="chat_display" style="overflow:auto; width:80%; height:500px;">
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
	</div>
</div>