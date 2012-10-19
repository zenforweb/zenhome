<?
foreach ( $chat as $msg ) {
	?>
	<li id="chat_<? echo $msg['id']; ?>">
		<b><? echo ucfirst( $msg['user']['user_name'] ); ?>: </b>
		<? echo $msg['msg'] ?>
		<br />
		<small><? echo format_time( $msg['date'], 'D h:i:s' );; ?></small>
	</li>
	<?
}
?>