<?
foreach ( $chat as $msg ) {
	?>
	<li id="chat_<? echo $msg['id']; ?>" class="row-fluid">
		<div class="chat_image span2">
			<img src="http://0.gravatar.com/avatar/<? echo $msg['user']['gravatar']; ?>?s=50&r=pg&d=mm"/>
		</div>
		<div class="chat_details span10">
			<b><? echo ucfirst( $msg['user']['user_name'] ); ?>: </b> <br />
			<? echo $msg['msg'] ?>
			<br />
			<small><? echo format_time( $msg['date'], 'D h:i:s' ); ?></small>
		</div>
	</li>
	<?
}
?>