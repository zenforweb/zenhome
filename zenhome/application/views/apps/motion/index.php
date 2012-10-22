<?php
/*
*	MOTION :: INDEX
*
*/
	// Alix {debug}
	// Alix {debug}
	//echo "<pre>"; print_r( $images ); die();
?>
<script type="text/javascript">
	jQuery('document').ready(function($){	
		function send_ajax( uri ){
			var update_url = base_url + 'apps/' + uri;
			$.ajax({ url: update_url, });
			console.log( update_url );
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
		//	update_settings( app_id, 'enabled', value);
    });
	});
</script>

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
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              </div>
              */ ?>
            </div>
			    	<?
			    }
			    ?>
			  </div>
			  <!-- Carousel nav -->
			  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
			</div>
		</div>
		<div class="span3">
			<img style="-webkit-user-select: none" src="http://10.1.10.52:8081/">	
			<br />
			<img style="-webkit-user-select: none" src="http://10.1.10.52:8082/">			
			<br />
		</div>
	</div>
</div>