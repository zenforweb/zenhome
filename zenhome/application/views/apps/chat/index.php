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
		<div class="span10 box shadow">
			<div class="box-header header-gradient">
				<h2>Chat Box</h2>
				<div class="box-controls pull-right">
					<span class="icon-chevron-up"></span>	
				</div>
			</div>
			<div class="box-body">
				<ul id="chat_display" style="overflow:auto; height:500px;">
					<li style="text-align:center; margin-top:5px;">
						<button id="chat-load-more" class="btn btn-small btn-primary">Load More</button>
					</li>
					<?
					foreach ( $chat as $msg ) {
						?>
						<li id="chat_<? echo $msg['id']; ?>" class="row-fluid">
							<div class="chat_image span1">
								<img src="http://0.gravatar.com/avatar/<? echo $msg['user']['gravatar']; ?>?s=50&r=pg&d=mm"/>
							</div>
							<div class="chat_details span10">
								<b><? echo ucfirst( $msg['user']['user_name'] ); ?>: </b> <br />
								<? echo $msg['msg'] ?>
								<br />
								<small><? echo format_time( $msg['date'], 'D h:i:s a' ); ?></small>
							</div>
						</li>
						<?
					}
					?>
				</ul>
				<div id="chat_sound"></div>
				<div class="input-append">
			  		<input class="span10" id="chat_input" size="16" type="text">
			  		<button class="btn" id="chat_input_btn" type="button">Send</button>
				</div>
			</div>
		</div>
	</div>
</div>