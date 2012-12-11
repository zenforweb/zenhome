<?php
/*
*	Xbmc :: Index template
*
*/
?>
<style type="text/css">
	.carousel-caption{
		top: 		140px;
		height:	200px;
	}
</style>

<? 
// setup typeahead for Tv Show Search
$tvshow_list_js = '';
foreach ($tvShows as $show) { $tvshow_list_js .= '"' . $show['show_name'] . '",'; } //@todo: 
?>

<script type="text/javascript">
	jQuery(document).ready( function(){
		$('#tvSearchBox').typeahead({
			source: [<? echo $tvshow_list_js; ?> ]
		});
	});
</script>

<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
			<h3>Xbmc</h3>
		</div>
		<div class="span2 pull-right">
			<div class="dropdown pull-right">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="<? echo base_url(); ?>apps/xbmc">XBMC</a></li>
				<li><a href="<? echo base_url(); ?>apps/xbmc/settings">Settings</a></li>
	  		</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div style="margin:auto; width:758px;">
			<div id="myCarousel" class="carousel slide">
		  	<div class="carousel-inner" style="height:250px;">
				<?
				foreach ( $recentDownloads as $key => $recent ) {
					?>
					<div class="item <? if( $key == 0){ echo 'active'; } ?>">	
						<img src="<? if( isset( $recent['show_art']['graphical'][0] ) ) { echo $recent['show_art']['graphical'][0]; }else{ echo "#"; } ?>">
						<div class="carousel-caption">
							<h4><? echo $recent['show_name']; ?> - <? echo $recent['episode_name']; ?> </h4>
							
							<p><? echo $recent['episode_aired']; ?></p>
							<p><? echo $recent['episode_desc']; ?></p>

						</div>
					</div>
				<? }?>
		  	</div>
		  <!-- Carousel nav -->
		  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>		  	
		  </div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span4 box">
			<div class="box-header header-gradient">
				<h2>Tv Show Search</h2>
			</div>
			<div class="box-body">
				<input id="tvSearchBox" type="text" class="span12" style="margin: 0 auto;">
			</div>
		</div>
	</div>

</div>