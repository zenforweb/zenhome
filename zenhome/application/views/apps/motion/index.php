<?php
/*
*	MOTION :: INDEX
*
*/
?>
<script type="text/javascript">
	jQuery('document').ready(function($){	
		function send_ajax( uri ){
			var update_url = base_url + 'apps/' + uri;
			$.ajax({ url: update_url, });
		}		
		
		// App enabled handler
    $('.app-ajax button').click( function(){
			var button   = $(this);
			if( ! button.hasClass('active') ){
				var app_box  = button.closest( 'div' ),
					  app_uri  = app_box.attr( 'data-uri' ),
			      value    = button.val(),
			      full_uri = app_uri + value;
			  send_ajax( full_uri );
			}
    });


    // Motion Cam
		$('.motion_cam').click( function( ){
			var cam 				= $(this),
					container 	= cam.parent(),
					btn         = container.find('.motion_placeholder');
			container.height( cam.height() );
			container.width( cam.width()  );	
			cam.remove();
			btn.show();
			var boogers = 'stuff';
			cam.append(boogers);
		});

		$('.motion_placeholder btn').click( function(){
			var something = '';

		});

	});


</script>

<style type="text/css">
	.motion_placeholder{
		margin-top: 24%;
		text-align: center;
	}
</style>

<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
			<h3>Motion</h3>
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
		<div class="span3">
			<div class="btn-group app-ajax" data-toggle="buttons-radio" data-uri="motion/arm/">
				<button type="button" value="1" class="btn btn-danger btn-large <? if( $status['armed'] == 1){ echo "active"; } ?>">Arm</button>
				<button type="button" value="0" class="btn btn-large <? if( $status['armed'] == 0){ echo "active"; } ?>">Disarm</button>
			</div>	
		</div>
	
		<div class="span3">
			<div id="myCarousel" class="carousel slide">
			  <!-- Carousel items -->
			  <div class="carousel-inner" style="height:250px;">
			    <?
			    if( isset( $images ) && is_array( $images ) && count( $images ) != 0 ){
						?>
						<div class="item active">
							<img src="http://zen.homedns.org/<? echo $images[0]; ?>" alt="">
						</div>
		       	<?
		    	  $i = 0;
		    	  foreach ($images as $image) {
		    	    if( $i == 0 ){
			    			$i++;
		    				continue;
		    	    }
		    	    ?>
			    		<div class="item">
								<img src="http://zen.homedns.org/<? echo $image; ?>" alt="">
								<? /*
								<div class="carousel-caption">
									<h4>First Thumbnail label</h4>
									<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta grav</p>
								</div>
								*/ ?>
							</div>
		    	    <?
		    	  }
			    } else {
			      ?>
			      <div class="item">No Images Today</div>
			      <?
			    }
			    ?>
			  </div>
			  <!-- Carousel nav -->
			  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
			</div>
		</div>
		
		<? if ( isset( $cameras ) ){ ?>
		<div class="span3">		
			<div class="">
				<div class="motion_placeholder" style="display:none;">
					<button class="btn btn-primary" data-cam="1" data-src="http://10.1.10.52:8081/" data-height="" data-width="">Show Cam 1</button>
				</div>
				<img id="cam_1" class="motion_cam" style="-webkit-user-select: none" src="http://10.1.10.52:8081/">	
			</div>
			<div class="">
				<div class="motion_placeholder" style="display:none;">
					<button class="btn btn-primary">Show Cam 2</button>
				</div>
				<div class="motion_placeholder hidden" src="#">
					stuff
				</div>
				<img id="cam_2" class="motion_cam" style="-webkit-user-select: none" src="http://10.1.10.52:8082/">
		</div>
		<? } ?>

	</div>
</div>