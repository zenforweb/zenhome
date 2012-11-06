<?
/*
*	MOTION :: PORTLET
*
*/
?>

<? 
if( isset( $cameras ) ){
    ?>
    <div id="app_motion_portlet" class="portlet span4">
    	 <a href="<? base_url(); ?>apps/motion">
	    <h2>Motion</h2>
	</a>
	<img style="-webkit-user-select: none" src="http://10.1.10.52:8081/">
	<img style="-webkit-user-select: none" src="http://10.1.10.52:8082/">
	
	<p>
		<a class="btn" href="<? echo base_url(); ?>apps/motion">More Feeds &raquo;</a>
	</p>
    </div>
<? } ?>