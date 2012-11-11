<?
/*
*	MOTION :: WIDGET CAMS
*
*/
?>

<? 
if( isset( $cameras ) ){
    ?>
    <div id="app_widget_motion_cams" class="widget span4 shadow">
    	 <div class="widget-header header-gradient">
	      <a href="<? base_url(); ?>apps/motion" class="pull-left">
	      	 <h2>Motion</h2>
	      </a>
			 	<div class="widget-controls pull-right">
					<span class="widget-slide icon-chevron-up"></span>
					<span class="icon-remove"></span>
				</div>		      
			</div>
			<div class="widget-body">
				<img style="-webkit-user-select: none" src="http://10.1.10.52:8081/">
				<img style="-webkit-user-select: none" src="http://10.1.10.52:8082/">
				<p>
					<a class="btn" href="<? echo base_url(); ?>apps/motion">More Feeds &raquo;</a>
				</p>
			</div>
    </div>
<? } ?>